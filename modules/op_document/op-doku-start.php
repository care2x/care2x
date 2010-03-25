<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/

# Default value for the maximum nr of rows per block displayed, define this to the value you wish
# In normal cases this value is derived from the db table "care_config_global" using the "pagin_insurance_list_max_block_rows" element.
define('MAX_BLOCK_ROWS',30); 
define('REDIRECT_SINGLERESULT',0); # Define to 1 if single result must be redirected to input page

function createElement($item,$err, $f_size=7, $mx=5)
{
    global $mode, $err_data, $result, $lang, $isTimeElement,$opdoc;
	
	if($mode=='saveok')
    {
       $ret_str= '<font color="#800000">'.$opdoc[$item].' &nbsp;</font>';
    } 
    else
    {
        $ret_str= '<input name="'.$item.'" type="text" size="'.$f_size.'"   maxlength='.$mx.' value="';
       if($err_data){
          $ret_str.=$err;
       }else{
          $ret_str.=$opdoc[$item];
       }	  
          
	   if($mode=='') $ret_str.='" ';
	     else $ret_str.='"';
		 
	   if($isTimeElement)  $ret_str.= ' onKeyUp="setTime(this,\''.$lang.'\')">';
	     else $ret_str.='>';		 
	}
	return $ret_str;
}
$lang_tables[]='departments.php';
$lang_tables[]='doctors.php';
$lang_tables[]='search.php';
$lang_tables[]='prompt.php';
$lang_tables[]='actions.php';
define('LANG_FILE','or.php');
$local_user='ck_opdoku_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');

//$db->debug=1;

# Check if department nr and OR nr are available from user config
if(!isset($dept_nr)||!$dept_nr){
	if(isset($cfg['thispc_dept_nr'])&&!empty($cfg['thispc_dept_nr'])){
		$dept_nr=$cfg['thispc_dept_nr'];
	}else{
		header('Location:op-doku-select-dept.php'.URL_REDIRECT_APPEND.'&target=entry');
		exit;
	}
}

if(!isset($target)||empty($target)) $target='entry';

# Create encounter object
require_once($root_path.'include/care_api_classes/class_encounter.php');
$enc_obj= new Encounter;
/* Save dept name to session */
if(!isset($_SESSION['sess_dept_name'])) $_SESSION['sess_dept_name'] = "";
/* Create dept object and preload dept info */
require_once($root_path.'include/care_api_classes/class_department.php');
$dept_obj=new Department;
$dept_obj->preloadDept($dept_nr);
$buffer=$dept_obj->LDvar();
if(isset($$buffer)&&!empty($$buffer)) $_SESSION['sess_dept_name']=$$buffer;
	else $_SESSION['sess_dept_name']=$dept_obj->FormalName();
/* Load global configs */
include_once($root_path.'include/care_api_classes/class_globalconfig.php');
$GLOBAL_CONFIG=array();
$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
$glob_obj->getConfig('patient_%');	


if ((substr($matchcode,0,1)=='%')||(substr($matchcode,0,1)=='&')) {header("Location:'.$root_path.'language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 

$breakfile=$root_path.'main/op-doku.php'.URL_APPEND;
$thisfile=basename(__FILE__);

 /* Set color values for the search mask */
$searchmask_bgcolor='#f3f3f3';
$searchprompt=$LDEntryPrompt;
$entry_block_bgcolor='#fff3f3';
$entry_border_bgcolor='#6666ee';
$entry_body_bgcolor='#ffffff';

if(!isset($dept)||empty($dept))
	if($_COOKIE['ck_thispc_dept']) $dept=$_COOKIE['ck_thispc_dept'];
		else $dept='plop'; // default department is plop

$linecount=0;

# check date for completeness

if($mode=='save')
{
	$err_data=0;
	if(!$op_date) {$err_op_date=1; $err_data=1;}
	if(!$operator) {$err_operator=1;$err_data=1;}
	if(!$diagnosis) {$err_diagnosis=1;$err_data=1;}
	if(!$localize) {$err_localize=1;$err_data=1;}
	if(!$therapy) {$err_therapy=1;$err_data=1;}
	if(!$special) {$err_special=1;$err_data=1;}
	if(!(($class_s)||($class_m)||($class_l))) {$err_klas=1;$err_data=1;}
	if(!$op_start) {$err_op_start=1;$err_data=1;}
	if(!$op_end) {$err_op_end=1;$err_data=1;}
	if(!$scrub_nurse) {$err_scrub_nurse=1;$err_data=1;}
	if(!$op_room) {$err_op_room=1;$err_data=1;}
	
	if($err_data) $mode='?';
	
}

    /* Load date formatter */
    include_once($root_path.'include/core/inc_date_format_functions.php');
    
	
	/* If the patient number is available = $patnum , get the data from the admission table */
	if(isset($pn) && !empty($pn)){
		$enc_obj->where=" encounter_nr=$pn";
	    if( $enc_obj->loadEncounterData($pn)) {
			
			$full_en=$pn;

			if( $enc_obj->is_loaded){
				$result=&$enc_obj->encounter;		
				$rows=$enc_obj->record_count;	
			}
		}else{ 
			echo "$sql<br>$LDDbNoRead";
			$mode='?';
		} 	
	}
	
	if($mode=='search'||$mode=='paginate'){	# Filter the search and paginate modes

		# Initialize page´s control variables
		if($mode=='paginate'){
			$searchkey=$_SESSION['sess_searchkey'];
			//$searchkey='USE_SESSION_SEARCHKEY';
			//$mode='search';
		}else{
			# Reset paginator variables
			$pgx=0;
			$totalcount=0;
			$odir='ASC';
			$oitem='name_last';
		}
		# Paginator object
		require_once($root_path.'include/care_api_classes/class_paginator.php');
		$pagen=new Paginator($pgx,$thisfile,$_SESSION['sess_searchkey'],$root_path);

		//require_once($root_path.'include/care_api_classes/class_globalconfig.php');
		//$glob_obj=new GlobalConfig($GLOBAL_CONFIG);

		# Get the max nr of rows from global config
		$glob_obj->getConfig('pagin_patient_search_max_block_rows');
		if(empty($GLOBAL_CONFIG['pagin_patient_search_max_block_rows'])) $pagen->setMaxCount(MAX_BLOCK_ROWS); # Last resort, use the default defined at the start of this page
			else $pagen->setMaxCount($GLOBAL_CONFIG['pagin_patient_search_max_block_rows']);

		# Convert other wildcards
		$searchkey=strtr($searchkey,'*?','%_');
		# Save the search keyword for eventual pagination routines
		if($mode=='search') $_SESSION['sess_searchkey']=$searchkey;

		include_once($root_path.'include/core/inc_date_format_functions.php');
		include_once($root_path.'include/care_api_classes/class_encounter.php');
		$enc_obj=new Encounter;

		$encounter=& $enc_obj->searchLimitEncounterBasicInfo($searchkey,$pagen->MaxCount(),$pgx,$oitem,$odir);
		//echo $enc_obj->getLastQuery();
		# Get the resulting record count
		$rows=$enc_obj->LastRecordCount();
		if($rows==1&&$mode=='search'){
			$row=$encounter->FetchRow();
			header("location:op-doku-start.php?sid=$sid&lang=$lang&target=$target&pn=".$row['encounter_nr']."&dept_nr=$dept_nr");
			exit;
		}
		//$linecount=$address_obj->LastRecordCount();
		$pagen->setTotalBlockCount($linecount);
		# Count total available data
		if(isset($totalcount)&&$totalcount){
			$pagen->setTotalDataCount($totalcount);
		}else{
			@$enc_obj->searchEncounterBasicInfo($searchkey);
			$totalcount=$enc_obj->LastRecordCount();
			$pagen->setTotalDataCount($totalcount);
		}
		$pagen->setSortItem($oitem);
		$pagen->setSortDirection($odir);
	
	}else{

		# switch possible modes
		
		switch($mode){
									
			case 'update':
			
							$dbtable='care_op_med_doc';
							
							$sql="SELECT * FROM $dbtable WHERE  nr='$nr'";
																			
							if($ergebnis=$db->Execute($sql)) 
							{			
								if($rows=$ergebnis->RecordCount())
								{
									$opdoc=$ergebnis->FetchRow();
								}
							}else echo "$sql<br>$LDDbNoRead"; 
							//echo $sql;
							break;
							
			case 'save':
			
					$dbtable='care_op_med_doc';
					
					/* Prepare the time data */
					
					$op_start=strtr($op_start,'.;,',':::');
					$s_count=substr_count($op_start,':');
					switch($s_count)
					{
					   case 0: $op_start.=':00:00'; break;
					   case 1: $op_start.=':00';break;
					   case '': $op_start.=':00:00';
					}
					
					$op_end=strtr($op_end,'.;,',':::');
					$s_count=substr_count($op_end,':');
					switch($s_count)
					{
					   case 0: $op_end.=':00:00';break;
					   case 1: $op_end.=':00';break;
					   case '': $op_end.=':00:00';
					}
					
					if($update)
					{
					  
						$sql="UPDATE $dbtable SET
									op_date='".formatDate2STD($op_date,$date_format)."',
									operator='$operator',
									diagnosis='$diagnosis',
									localize='$localize',
									therapy='$therapy',
									special='$special',
									class_s='$class_s',
									class_m='$class_m',
									class_l='$class_l',
									op_start='$op_start',
									op_end='$op_end',
									scrub_nurse='$scrub_nurse',
									op_room='$op_room',
									history=".$enc_obj->ConcatHistory("Update: ".date('Y-m-d H:i:s')." = ".$_SESSION['sess_user_name']."\n").",
									modify_id='".$_SESSION['sess_user_name']."',
									modify_time='".date('YmdHis')."'
									WHERE nr='$nr'";
									
						if($ergebnis=$enc_obj->Transact($sql))
						{
								header("location:op-doku-start.php?sid=$sid&lang=$lang&target=$target&mode=saveok&pn=$pn&nr=$nr&dept_nr=$dept_nr");
								exit;
						}else echo "$sql<br>$LDDbNoUpdate"; 
					}
					else
					{

								$sql="INSERT INTO $dbtable
								(	dept_nr,
									op_date,
									operator,
									encounter_nr,
									diagnosis,
									localize,
									therapy,
									special,
									class_s,
									class_m,
									class_l,
									op_start,
									op_end,
									scrub_nurse,
									op_room,
									history,
									create_id,
									create_time
									 ) 
								VALUES (
									'$dept_nr',
									'".formatDate2STD($op_date,$date_format)."',
									'$operator', 
									'$pn',
									'".htmlspecialchars($diagnosis)."', 
									'".htmlspecialchars($localize)."', 
									'".htmlspecialchars($therapy)."', 
									'".htmlspecialchars($special)."', 
									'$class_s', 
									'$class_m', 
									'$class_l', 
									'$op_start',
									'$op_end',
									'$scrub_nurse',
									'$op_room',
									'Create: ".date('Y-m-d H:i:s')." = ".$_SESSION['sess_user_name']."\n',
									'".$_SESSION['sess_user_name']."',
									'".date('YmdHis')."'
								)";
								//echo $sql;
								if($ergebnis=$enc_obj->Transact($sql))
								{
		                                $oid=$db->Insert_ID();
										$enc_obj->coretable=$dbtable;
										$nr = $enc_obj->LastInsertPK('nr',$oid);
							  			
										header("location:op-doku-start.php?sid=$sid&lang=$lang&target=$target&mode=saveok&pn=$pn&nr=$nr&dept_nr=$dept_nr");
										exit;
										
  							    }else echo "$sql<br>$LDDbNoSave"; 

					} // end of if(update) else
							//$sdate=date(YmdHis); // time stamp
					break;
					
			case 'saveok':
			
					$dbtable='care_op_med_doc';
					
					$sql="SELECT * FROM $dbtable WHERE  nr='$nr'";
					
					if($ergebnis=$db->Execute($sql)) 
					{			

						if($rows=$ergebnis->RecordCount())
						{
							$opdoc=$ergebnis->FetchRow();
						}
					}else echo "$sql<br>$LDDbNoRead"; 
					break;

			case 'select': break;

			default:

					if($_COOKIE["ck_login_logged".$sid]) $mode="dummy";
					
		} // end of switch
	}

# Start the smarty templating
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('nursing');

# Added for the common header top block

 $smarty->assign('sToolbarTitle',"$LDOrDocument :: (".$_SESSION['sess_dept_name'].")");

 # href for help button
 if(!$mode) $sBuffer ='dummy';
 	else $sBuffer = $mode;

 $smarty->assign('pbHelp',"javascript:gethelp('opdoc.php','create','$sBuffer')");

 # hide return button
 $smarty->assign('pbBack',FALSE);

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',"$LDOrDocument :: (".$_SESSION['sess_dept_name'].")");

 # Prepare Body onLoad javascript code
 if(!isset($mode) || empty($mode) || ($mode=='search'&&!$rows) || $mode=='dummy') {
	$smarty->assign('sOnLoadJs','onLoad="document.searchform.searchkey.focus();"');
 }
 /**
 * collect JavaScript for Smarty
 */
 ob_start();
?>

<script  language="javascript">
<!-- 
var iscat=true;
var cat=new Image();
var pix=new Image();


function hilite(idx,mode) 
	{
	if(mode==1) idx.filters.alpha.opacity=100
	else idx.filters.alpha.opacity=70;
	}
function lookmatch(d)
{
	m=d.matchcode.value;
	if(m=="") return false;
	if((m.substr(0,1)=="%")||(m.substr(0,1)=="&"))
	{
		d.matchcode.value="";
		d.matchcode.focus();
		return false;
	}
	window.location.replace("op-doku-start.php?sid=<?php echo "$sid&lang=$lang" ?>&mode=match&matchcode="+m);
	return false;
}

<?php 
if($mode!='saveok'){
?>
function chkForm(d){
	if(d.op_date.value==""){
		alert("<?php echo $LDPlsEnterDate; ?>");
		d.op_date.focus();
		return false;
	}else if(d.operator.value==""){
		alert("<?php echo $LDPlsEnterDoctor; ?>");
		d.operator.focus();
		return false;
	}else if(d.diagnosis.value==""){
		alert("<?php echo $LDPlsEnterDiagnosis; ?>");
		d.diagnosis.focus();
		return false;
	}else if(d.localize.value==""){
		alert("<?php echo $LDPlsEnterLocalization; ?>");
		d.localize.focus();
		return false;
	}else if(d.therapy.value==""){
		alert("<?php echo $LDPlsEnterTherapy; ?>");
		d.therapy.focus();
		return false;
	}else if(d.special.value==""){
		alert("<?php echo $LDPlsEnterNotes; ?>");
		d.special.focus();
		return false;
	}else if(d.class_s.value==""&&d.class_m.value==""&&d.class_l.value==""){
		alert("<?php echo $LDPlsEnterClassification; ?>");
		d.class_s.focus();
		return false;
	}else if(d.op_start.value==""){
		alert("<?php echo $LDPlsEnterStartTime; ?>");
		d.op_start.focus();
		return false;
	}else if(d.op_end.value==""){
		alert("<?php echo $LDPlsEnterEndTime; ?>");
		d.op_end.focus();
		return false;
	}else if(d.scrub_nurse.value==""){
		alert("<?php echo $LDPlsEnterScrubNurse; ?>");
		d.scrub_nurse.focus();
		return false;
	}else if(d.op_room.value==""){
		alert("<?php echo $LDPlsEnterORNr; ?>");
		d.op_room.focus();
		return false;
	}else{
		return true;
	}
}
<?php
}
?>
<?php require($root_path.'include/core/inc_checkdate_lang.php'); ?>
//-->
</script>
<?php

$sTemp = ob_get_contents();
ob_end_clean();

$smarty->append('JavaScript',$sTemp);

# Buffer page output

ob_start();

?>

<table width=100% border=0 cellspacing=0 cellpadding=0>

<?php require('./gui_tabs_op_doku.php'); ?>
<tr>
<td colspan=2><p>

<ul>
<?php
if(($mode=='search'||$mode=='paginate')&&$rows){

	$append='&dept_nr='.$dept_nr.'&target='.$target;
	# Preload  common icon images
	$img_male=createComIcon($root_path,'spm.gif','0','',TRUE);
	$img_female=createComIcon($root_path,'spf.gif','0','',TRUE);
	$bgimg='tableHeaderbg3.gif';
	$tbg= 'background="'.$root_path.'gui/img/common/'.$theme_com_icon.'/'.$bgimg.'"';
?>

<table border=0>
  <tr>
    <td><img <?php echo createMascot($root_path,'mascot1_r.gif','0','bottom') ?> align="absmiddle"></td>
    <td class="prompt">
<b>
<?php 

	if ($rows) echo str_replace("~nr~",$totalcount,$LDSearchFound).' '.$LDShowing.' '.$pagen->BlockStartNr().' '.$LDTo.' '.$pagen->BlockEndNr().'.';
		else echo str_replace('~nr~','0',$LDSearchFound); 
 ?></b></font></td>
  </tr>
</table>

<table border=0 cellpadding=0 cellspacing=0>
  <tr class="wardlisttitlerow">
     <td> <b>
	  <?php echo $pagen->makeSortLink($LDPatientNr,'encounter_nr',$oitem,$odir,$append);  ?></b></td>
      <td> <b>
	  <?php echo $pagen->makeSortLink($LDSex,'sex',$oitem,$odir,$append);  ?></b></td>
      <td> <b>
	  <?php echo $pagen->makeSortLink($LDLastName,'name_last',$oitem,$odir,$append);  ?></b></td>
      <td> <b>
	  <?php echo $pagen->makeSortLink($LDName,'name_first',$oitem,$odir,$append);  ?></b></td>
      <td> <b>
	  <?php echo $pagen->makeSortLink($LDBday,'date_birth',$oitem,$odir,$append);  ?></b></td>
    <td background="<?php echo createBgSkin($root_path,'tableHeaderbg.gif'); ?>" align=center><font face=arial size=2 color="#ffffff"><b><?php echo $LDSelect; ?></td>

	</tr>

<?php 
$toggle=0;
while($enc_row=$encounter->FetchRow()){
 	echo'
  <tr ';
  if($toggle){ echo 'class="wardlistrow2"'; $toggle=0;} else {echo 'class="wardlistrow1"'; $toggle=1;}
  echo '>
    <td>&nbsp;';
	echo $enc_row['encounter_nr'];
   echo '&nbsp;</td><td>';
  
	switch($enc_row['sex']){
		case 'f': echo '<img '.$img_female.'>'; break;
		case 'm': echo '<img '.$img_male.'>'; break;
		default: echo '&nbsp;'; break;
	}	
   
   echo '
    <td>&nbsp; <a href="'.$thisfile.URL_APPEND.'&mode=select&pn='.$enc_row['encounter_nr'].'&dept_nr='.$dept_nr.'&target='.$target.'">'.$enc_row['name_last'].'</a></td>
    <td>&nbsp; &nbsp;'.$enc_row['name_first'].'</td>
    <td>&nbsp; &nbsp;'.formatDate2Local($enc_row['date_birth'],$date_format).'</td>';
	echo '
	<td><font face=arial size=2>&nbsp;';
	echo '<a href="'.$thisfile.URL_APPEND.'&mode=select&pn='.$enc_row['encounter_nr'].'&dept_nr='.$dept_nr.'&target='.$target.'">';
	echo '	
	<img '.createLDImgSrc($root_path,'ok_small.gif','0').' alt="'.$LDTestThisPatient.'"></a>&nbsp;';
							
	if(!file_exists($root_path."cache/barcodes/en_".$full_en.".png")){
		echo "<img src='".$root_path."classes/barcode/image.php?code=".$full_en."&style=68&type=I25&width=180&height=50&xres=2&font=5&label=2&form_file=en' border=0 width=0 height=0>";
	}
	echo '</td>';
	echo '</tr>
  <tr class="thinrow_vspacer">
  <td colspan=6 height=1><img src="'.$root_path.'gui/img/common/default/pixel.gif" border=0 width=1 height=1 align="absmiddle"></td>
  </tr>';
}

echo '
	<tr><td colspan=5><font face=arial size=2>'.$pagen->makePrevLink($LDPrevious,$append).'</td>
	<td align=right><font face=arial size=2>'.$pagen->makeNextLink($LDNext,$append).'</td>
	</tr>';
?>
</table>
<p>
<?php 
}else{

   if(!$rows&&!$err_data) {
?>
	<table border="0">
          <tr>
            <td><img <?php echo createComIcon($root_path,'angle_down_l.gif','0','absmiddle',TRUE) ?>></td>
            <td class="prompt">
			<?php 
				if($mode=='search') echo '<font color=maroon>'.$LDSorryNotFound.'</font>';
					else echo $LDPlsSelectPatientFirst; 
			?>
			</td>
            <td valign="top"> 
			<img <?php echo createMascot($root_path,'mascot1_l.gif','0','absmiddle') ?>>
			</td>
          </tr>
	</table>

	<table border=0 cellpadding=10 bgcolor="<?php echo $entry_border_bgcolor ?>">
     <tr>
       <td>
	   <?php
            include($root_path.'include/core/inc_patient_searchmask.php');
	   ?>
		</td>
    </tr>
   </table>

	<?php
	}
	?>

	
<?php 
if($rows || $err_data){

$bg_img=$root_path.'gui/img/common/default/tableHeaderbg3.gif';

	if($err_data){
?>
	<table border="0">
          <tr>
            <td> <img <?php echo createMascot($root_path,'mascot2_r.gif','0','absmiddle') ?>></td>
            <td class="prompt"><?php echo $LDPlsFillInfo ?></td>
          </tr>
	</table>
<?php
	}
?>
<table border=0 cellpadding=3 >

<form method="post" action="op-doku-start.php" name="opdoc" <?php if($mode!='saveok') echo 'onSubmit="return chkForm(this)"'; ?>>
<tr <?php if($mode=='saveok') echo "bgcolor=#ffffff"; ?>>
<td background="<?php echo $bg_img; ?>"><FONT color=red><?php if($err_op_date) echo '*'; ?><?php echo $LDOpDate ?>:<br>
</td>
<td>

<?php 

//gjergji : new calendar
require_once ('../../js/jscalendar/calendar.php');
$calendar = new DHTML_Calendar('../../js/jscalendar/', $lang, 'calendar-system', true);
$calendar->load_files();
//end : gjergji

if($mode=='saveok'){
   echo '<b>'.formatDate2Local($opdoc['op_date'],$date_format).'</b>'; 
}else{
	//gjergji : new calendar
	echo $calendar->show_calendar($calendar,$date_format,'op_date');	
	//end : gjergji 
}
  

?> 

<font size=2 face="arial" color=red>&nbsp; &nbsp;<?php if($err_operator) echo 'color=#cc0000'; ?> <?php echo $LDOperator ?>:
<?php 
if($mode=='saveok'){
	echo '<font color="#800000">'.$opdoc['operator'];
}else{
	 echo '
	<input name="operator" type="text" size="25" value="';
	if($err_data){
	  	echo $operator; 
	 }else{
		    echo $_COOKIE[$local_user.$sid];
	  }
	echo '">';
}
 ?>
</td>
</tr>
<tr <?php if($mode=='saveok') echo "bgcolor=#ffffff"; ?>>
<td background="<?php echo $bg_img; ?>">
<p>
<FONT <?php if($err_patnum) echo 'color=#cc0000'; ?>><?php echo $LDPatientNr ?>:
</td>
<td><FONT color="#000099">

<?php 

   echo '<b>'.$full_en.'</b>'; 

?>
</td>
</tr>
<tr <?php if($mode=='saveok') echo "bgcolor=#ffffff"; ?>>
<td background="<?php echo $bg_img; ?>"><FONT <?php if($err_name) echo 'color=#cc0000'; ?>><?php echo $LDLastName ?>:
</td>
<td><FONT color="#000099">

<?php 

   echo '<b>'.$result['name_last'].'</b>'; 

?>
</td>
</tr>
<tr <?php if($mode=='saveok') echo "bgcolor=#ffffff"; ?>>
<td background="<?php echo $bg_img; ?>"><FONT <?php if($err_vorname) echo 'color=#cc0000'; ?>><?php echo $LDName ?>:
</td>
<td><FONT color="#000099">
<?php 

   echo '<b>'.$result['name_first'].'</b>'; 

?>
</td>
</tr>
<tr <?php if($mode=='saveok') echo "bgcolor=#ffffff"; ?>>
<td background="<?php echo $bg_img; ?>"><FONT <?php if($err_gebdatum) echo 'color=#cc0000'; ?>><?php echo $LDBday ?>:
</td>
<td><FONT color="#000099">
<?php

      echo @formatDate2Local($result['date_birth'],$date_format);

?>
</td>
</tr>
<tr <?php if($mode=='saveok') echo "bgcolor=#ffffff"; ?>>
<td>
</td>
<td><FONT  color="#000099">

<font color="#000099">
<?php 


switch($result['status'])
	{
		case "stat": echo $LDStationary;break;
		case "amb": echo $LDAmbulant; break;
	}
?>

</font>
<br>
<FONT color="#000099">
<?php 

if ($result['kasse']=="kasse")
{
   echo $LDInsurance;
}
 elseif($result['kasse']=="privat")
 {
	 echo $LDPrivate;
  }
   elseif($result['kasse']=="x")
   {
	  echo $LDSelfPay;
    }

?>     

</td>
</tr>

<tr <?php if($mode=='saveok') echo "bgcolor=#ffffff"; ?>>
<td background="<?php echo $bg_img; ?>"><FONT  color=red><?php if($err_diagnosis) echo '*'; ?><?php echo $LDDiagnosis ?>:
</td>
<td>
<?php

 echo createElement('diagnosis',$diagnosis,60,100); 
 
?>
</td>
</tr>
<tr <?php if($mode=='saveok') echo "bgcolor=#ffffff"; ?>>
<td background="<?php echo $bg_img; ?>"><FONT  color=red> <?php if($err_localize) echo '*'; ?><?php echo $LDLocalization ?>:
</td>
<td>

<?php

 echo createElement('localize',$localize,60,100); 
 
?>
</td>
</tr>
<tr <?php if($mode=='saveok') echo "bgcolor=#ffffff"; ?>>
<td background="<?php echo $bg_img; ?>"><FONT  color=red><?php if($err_therapy) echo '*'; ?><?php echo $LDTherapy ?>:
</td>
<td>


<?php

 echo createElement('therapy',$therapy,60,100); 
 
?>
</td>
</tr >
<tr <?php if($mode=='saveok') echo "bgcolor=#ffffff"; ?>>
<td background="<?php echo $bg_img; ?>"><FONT color=red><?php if($err_special) echo '*'; ?><?php echo $LDSpecials ?>:
</td>
<td>

<?php

echo createElement('special',$special,60,100); 

?>
</td>
</tr>
<tr <?php if($mode=='saveok') echo "bgcolor=#ffffff"; ?>>
<td background="<?php echo $bg_img; ?>"><FONT  color=red><?php if($err_klas) echo '*'; ?><?php echo $LDClassification ?>:
</td>
<td><font color="#800000">
<?php if($mode=='saveok')
{

    if($opdoc[class_s]) echo "$opdoc[class_s] $LDMinor  &nbsp; ";
   	if($opdoc[class_m]) echo "$opdoc[class_m] $LDMiddle &nbsp; ";
   	if($opdoc[class_l]) echo "$opdoc[class_l] $LDMajor";
	echo " $LDOperation";
}
else
{
?>
<select name="class_s">
			<option value="0"> </option>
<?php
	for($i=1;$i<9;$i++){
		echo "
			<option value=\"$i\"";
		if($err_data) $buf= $class_s; else $buf = $opdoc['class_s'];
		if($i == $buf) echo 'selected';
		echo ">$i</option>";
	}
?>
</select>
<?php echo $LDMinor ?>&nbsp;
<select name="class_m">
			<option value="0"> </option>
<?php
	for($i=1;$i<9;$i++){
		echo "
			<option value=\"$i\"";
		if($err_data) $buf= class_m; else $buf = $opdoc['class_m'];
		if($i == $buf) echo 'selected';
		echo ">$i</option>";
	}
?>
?>
</select>
<?php echo $LDMiddle ?>&nbsp;
<select name="class_l">
			<option value="0"> </option>
<?php
	for($i=1;$i<9;$i++){
		echo "
			<option value=\"$i\"";
		if($err_data) $buf= class_l; else $buf = $opdoc['class_l'];
		if($i == $buf) echo 'selected';
		echo ">$i</option>";
	}
?>
</select>
<?php echo "$LDMajor $LDOperation" ?>
<?php
}
?>
</td>
</tr>

<?php
}
?>

</table>

<?php 
if($rows || $err_data) 
{
?>

<p>
 <FONT color=red><?php if($err_op_start) echo '*'; ?>
<?php 

/* Set the global $isTimeElement to 1 to cause the function to insert the setTime Code in the form input code */
$isTimeElement=1;

echo $LDOpStart.':';

echo createElement('op_start',$op_start);

echo '<font color="red">';if($err_op_end) echo '<font color="*">'; ?> &nbsp; <?php echo $LDOpEnd.':';
 
echo createElement('op_end',$op_end);

/* Reset the global $isTimeElement to 1 to disable the setTime code insertion*/
$isTimeElement=0;

echo '<font color="red">';if($err_scrub_nurse) echo '<font color="*">'; ?> &nbsp; <?php echo $LDScrubNurse.':';

echo createElement('scrub_nurse',$scrub_nurse);	

echo '<font color="red">';if($err_op_room) echo '<font color="*">'; ?>  &nbsp; <?php echo $LDOpRoom.':';

echo createElement('op_room',$op_room);

?>
<p>

<?php if($mode=='saveok') : ?>

 <input  type="image" <?php echo createLDImgSrc($root_path,'update_data.gif','0','absmiddle') ?>  alt="<?php echo $LDSave ?>">
<input type="button" value="<?php echo $LDStartNewDocu ?>" onclick="window.location.replace('op-doku-start.php<?php echo URL_REDIRECT_APPEND."&target=$target&dept_nr=$dept_nr"; ?>&mode=dummy')">

<?php else : ?>

<input  type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0') ?>  alt="<?php echo $LDSave ?>">
<a href="javascript:document.opdoc.reset()"><img <?php echo createLDImgSrc($root_path,'reset.gif','0') ?> alt="<?php echo $LDResetAll ?>" ></a>

<?php endif ?>

<input type="hidden" name="mode" value="<?php if($mode=='saveok') echo 'update'; else echo 'save' ?>">
<input type="hidden" name="dept_nr" value="<?php echo $dept_nr ?>">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="update" value="<?php if ($mode=='update') echo '1' ?>">
<input type="hidden" name="pn" value="<?php if($mode=='match' && $rows==1) echo $result['encounter_nr']; else echo $pn ?>">
<input type="hidden" name="nr" value="<?php echo $nr ?>">
<input type="hidden" name="target" value="<?php echo $target ?>">

</form>

<?php
}
?>


<?php
} 
?>

<p>
</ul>

<p>
<?php
if(($mode=='search'||$mode=='paginate')&&$rows){
?>
</td>
</tr>
</table>
<?php
}
?>
<hr>
<ul>

<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="op-doku-search.php<?php echo URL_APPEND."&target=search&dept_nr=$dept_nr"; ?>&mode=dummy"><?php echo $LDSearchDocu ?></a><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="op-doku-archiv.php<?php echo URL_APPEND."&target=archiv&dept_nr=$dept_nr"; ?>&mode=dummy"><?php echo $LDResearchArchive ?></a><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="op-doku-select-dept.php<?php echo URL_APPEND."&target=$target&dept_nr=$dept_nr"; ?>&mode=dummy"><?php echo $LDChangeOnlyDept ?></a><br>

<p>

<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  alt="<?php echo $LDClose ?>"></a>
</ul><p>

<?php

$sTemp = ob_get_contents();
 ob_end_clean();

# Assign the page output to main frame template

 $smarty->assign('sMainFrameBlockData',$sTemp);

 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');

?>
