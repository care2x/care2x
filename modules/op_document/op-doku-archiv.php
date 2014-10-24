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

$lang_tables[]='departments.php';
$lang_tables[]='doctors.php';
$lang_tables[]='actions.php';
define('LANG_FILE','or.php');
$local_user='ck_opdoku_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');

# Check if department nr and OR nr are available from user config
if(!isset($dept_nr)||!$dept_nr){
	if(isset($cfg['thispc_dept_nr'])&&!empty($cfg['thispc_dept_nr'])){
		$dept_nr=$cfg['thispc_dept_nr'];
		$dept_ok=true;
	}else{
		header('Location:op-doku-select-dept.php'.URL_REDIRECT_APPEND.'&target=entry');
		exit;
	}
}

//$db->debug=1;

$thisfile=basename(__FILE__);
$breakfile=$root_path.'main/op-doku.php'.URL_APPEND;

# Save dept name to session 
if(!isset($_SESSION['sess_dept_name'])) $_SESSION['sess_dept_name'] = "";

# Create dept object and preload dept info
require_once($root_path.'include/care_api_classes/class_department.php');
$dept_obj=new Department;
$dept_obj->preloadDept($dept_nr);
$buffer=$dept_obj->LDvar();
if(isset($$buffer)&&!empty($$buffer)) $_SESSION['sess_dept_name']=$$buffer;
	else $_SESSION['sess_dept_name']=$dept_obj->FormalName();

# Create the encounter object
include_once($root_path.'include/care_api_classes/class_encounter.php');
$enc_obj=new Encounter();
		
$linecount=0;
$patientselected=FALSE;

function clean_it(&$d)
{
	$d=strtr($d,"°!§$&/()=?`´+'#{}[]\^","~~~~~~~~~~~~~~~~~~~~~");
	$d=str_replace("\"","~",$d);   //"
	$d=str_replace("~","",$d);
	return trim($d);
}

# Load date formatter
require_once($root_path.'include/core/inc_date_format_functions.php');
    

if($mode=='search'||$mode=='paginate'){
	# Initialize page´s control variables
	if($mode!='paginate'){
		# Reset paginator variables
		$pgx=0;
		$totalcount=0;
		$odir='ASC';
		$oitem='name_last';
		$_SESSION['sess_searchkey']=$matchcode;
	}
	# Paginator object
	require_once($root_path.'include/care_api_classes/class_paginator.php');
	$pagen=new Paginator($pgx,$thisfile,$_SESSION['sess_searchkey'],$root_path);

	# Load global configs
	$GLOBAL_CONFIG=array();
	require_once($root_path.'include/care_api_classes/class_globalconfig.php');
	$glob_obj=new GlobalConfig($GLOBAL_CONFIG);

	# Get the max nr of rows from global config
	$glob_obj->getConfig('pagin_patient_search_max_block_rows');
	if(empty($GLOBAL_CONFIG['pagin_patient_search_max_block_rows'])) $pagen->setMaxCount(MAX_BLOCK_ROWS); # Last resort, use the default defined at the start of this page
		else $pagen->setMaxCount($GLOBAL_CONFIG['pagin_patient_search_max_block_rows']);

			# Resolve the table prefix acc: to order item passed via http
	if($oitem=='encounter_nr') $prefx='e';
		elseif($oitem=='LD_var')
			$prefx='d';
		elseif($oitem=='op_date'||$oitem=='nr')
			 $prefx='o';
		else
			$prefx='p';
	
	$dbtable='care_op_med_doc';
			
	if($mode=='paginate'){
		$s2=$_SESSION['sess_searchkey'];
	}else{
		
							
						
							$s2="";
							if (clean_it(&$name)) $s2.=" p.name_last $sql_LIKE '".addslashes($name)."%'";
							if (clean_it(&$vorname))
								if($s2) $s2.=" AND p.name_first $sql_LIKE '".addslashes($vorname)."%'"; else $s2.=" p.name_first $sql_LIKE '".addslashes($vorname)."%'";
							if($gebdatum)
							{
							    $gebdatum=formatDate2STD($gebdatum,$date_format);
								if($s2) $s2.=" AND p.date_birth='$gebdatum'"; else $s2.=" p.date_birth='$gebdatum'";
							}
							if($op_date)
							{
							    $op_date=formatDate2STD($op_date,$date_format);
								if($s2) $s2.=" AND o.op_date='$op_date'"; else $s2.=" o.op_date='$op_date'";
							}
							if (clean_it(&$patnum))
							{
								if(is_numeric($patnum)) $patnum=(int)$patnum; else $patnum='"'.addslashes($patnum).'"';
								if($s2) $s2.=" AND o.encounter_nr=$patnum"; else $s2.=" o.encounter_nr=$patnum";
							}
							if(clean_it(&$operator))
								if($s2) $s2.=" AND o.operator='".addslashes($operator)."'"; else $s2.=" o.operator='".addslashes($operator)."'";
							if ($status)
								if($s2) $s2.=" AND e.encounter_class_nr='$status'"; else $s2.=" e.encounter_class_nr='$status'";
							if ($kasse)
								if($s2) $s2.=" AND e.insurance_firm_id='$kasse'"; else $s2.=" e.insurance_firm_id='$kasse'";
							if(clean_it(&$diagnosis))
								if($s2) $s2.=" AND o.diagnosis $sql_LIKE '%$diagnosis%'"; else $s2.=" o.diagnosis $sql_LIKE '%$diagnosis%'";
							if(clean_it(&$localize))
								if($s2) $s2.=" AND o.localize $sql_LIKE '%$localize%'"; else $s2.=" o.localize $sql_LIKE '%$localize%'";
							if(clean_it(&$therapy))
								if($s2) $s2.=" AND o.therapy $sql_LIKE '%$therapy%'"; else $s2.=" o.therapy $sql_LIKE '%$therapy%'";
							if(clean_it(&$special))
								if($s2) $s2.=" AND o.special $sql_LIKE '%$special%'"; else $s2.=" o.special $sql_LIKE '%$special%'";
							if(clean_it(&$klas_s))
								if($s2) $s2.=" AND o.class_s = '$klas_s'"; else $s2.=" o.class_s = '$klas_s'";
							if(clean_it(&$klas_m))
								if($s2) $s2.=" AND o.class_m = '$klas_m'"; else $s2.=" o.class_m = '$klas_m'";
							if(clean_it(&$klas_l))
								if($s2) $s2.=" AND o.class_l = '$klas_l'"; else $s2.=" o.class_l = '$klas_l'";
							if(clean_it(&$inst))
								if($s2) $s2.=" AND o.scrub_nurse='".addslashes($inst)."'"; else $s2.=" o.scrub_nurse='".addslashes($inst)."'";
							if(clean_it(&$opsaal))
								if($s2) $s2.=" AND o.op_room='".addslashes($opsaal)."'"; else $s2.=" o.op_room='".addslashes($opsaal)."'";

							$s2=trim($s2);
							if($s2=="")
								{
									header("location:$thisfile".URL_REDIRECT_APPEND."&dept_nr=$dept_nr&target=archiv&mode=?");
									exit;
								}
		#Save the search condition for pagination routines
		$_SESSION['sess_searchkey']=$s2;
	}
														
	$select_sql="SELECT o.*,  e.encounter_class_nr, p.name_last, p.name_first, p.date_birth, p.sex, d.name_formal, d.LD_var  AS \"LD_var\"";
	$from_sql="	FROM $dbtable AS o, care_encounter AS e, care_person AS p, care_department AS d WHERE ";
	$order_sql=" ORDER BY $prefx.$oitem $odir";
							
							$sql2=$from_sql.$s2." AND o.encounter_nr=e.encounter_nr AND e.pid=p.pid AND o.dept_nr=d.nr";
							
							
							$sql=$select_sql.$sql2.$order_sql;
							
							if($ergebnis=$db->SelectLimit($sql,$pagen->MaxCount(),$pgx)) 
							{			
								$rows=$ergebnis->RecordCount();
								if(!$rows)
								{
									//echo $sql;
									$s2=str_replace("='"," $sql_LIKE ~",$s2);
									$s2=str_replace("'","%'",$s2);
									$s2=str_replace("~","'",$s2);
									#Save the search condition for pagination routines
									$_SESSION['sess_searchkey']=$s2;
									$sql2=$from_sql.$s2." AND o.encounter_nr=e.encounter_nr AND e.pid=p.pid AND o.dept_nr=d.nr";
									$sql=$select_sql.$sql2.$order_sql;
									//echo $sql;
									if($ergebnis=$db->SelectLimit($sql,$pagen->MaxCount(),$pgx)) 
									{			
										$rows=$ergebnis->RecordCount();
									}
								}
							}else echo "$LDDbNoRead<p> $sql <p>";
														
							//echo $sql;
							
							if($rows==1&&!$mode=='paginate')
							 {
								$row=$ergebnis->FetchRow();
								$enc_obj->loadEncounterData($row['encounter_nr']);
								$mode='select';
								$patientselected=TRUE;
							}

	//echo $sql;
	//$linecount=$address_obj->LastRecordCount();
	$pagen->setTotalBlockCount($rows);
	# Count total available data
	if(isset($totalcount) && $totalcount){
		$pagen->setTotalDataCount($totalcount);
	}else{
		$sql="SELECT o.nr ".$sql2;
		if($cresult=$db->Execute($sql)) {		
			//echo "<p>$sql";	
			$totalcount=$cresult->RecordCount();
			//echo $totalcount;
		}
		$pagen->setTotalDataCount($totalcount);
	}
	$pagen->setSortItem($oitem);
	$pagen->setSortDirection($odir);
							
							
}elseif($mode=='select'){
			
							$dbtable='care_op_med_doc';
							
							$sql="SELECT * FROM $dbtable WHERE nr='$nr'";
							
							if($ergebnis=$db->Execute($sql)) 
							{			
								if($rows=$ergebnis->RecordCount())
								{
									$row=$ergebnis->FetchRow();
									$enc_obj->loadEncounterData($row['encounter_nr']);
									$patientselected=TRUE;
								}
							}else echo "$LDDbNoRead<p> $sql <p>";


							
}else{
	if($_COOKIE['ck_login_logged'.$sid]) $mode='dummy';
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

 $smarty->assign('sToolbarTitle',"$LDOrDocument :: $LDArchive (".$_SESSION['sess_dept_name'].")");

 $smarty->assign('pbHelp',"javascript:gethelp('opdoc_arch.php','arch','$mode','$rows')");

 # hide return button
 $smarty->assign('pbBack',FALSE);

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',"$LDOrDocument :: $LDArchive (".$_SESSION['sess_dept_name'].")");

$smarty->assign('sOnLoadJs','onLoad="if(window.focus) window.focus();"');

 /**
 * collect JavaScript for Smarty
 */
 ob_start();
?>

<script  language="javascript">
<!-- 

function hilite(idx,mode)
	{
	if(mode==1) idx.filters.alpha.opacity=100
	else idx.filters.alpha.opacity=70;
	}
function lookmatch(d)
{
	m=d.matchcode.value;
	if(m=="") return false;
	window.location.replace("op-doku-start.php?sid=<?php echo "$sid&lang=$lang" ?>&mode=match&matchcode="+m);
	return false;
}

function chkForm(d)
{
	if((d.op_date.value!="")||(d.operator.value!="")||(d.patnum.value!="")||(d.name.value!="")||(d.vorname.value!="")||(d.gebdatum.value!=""))return true;
	if((d.status[0].checked)||(d.status[1].checked)||(d.kasse[0].checked)||(d.kasse[1].checked)||(d.kasse[2].checked))return true;
	if((d.diagnosis.value!="")||(d.localize.value!="")||(d.special.value!="")||(d.therapy.value!="")||(d.klas_s.value!="")||(d.klas_m.value!=""))return true;
	if((d.klas_l.value!="")||(d.inst.value!="")||(d.opsaal.value!=""))return true;
	return false;
}

<?php 
require($root_path.'include/core/inc_checkdate_lang.php'); 
?>

// -->
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
<td colspan=2><p><br>
<ul>
<?php 
//if($mode=='search')echo "<FONT  SIZE=2 FACE='verdana,Arial'>$LDSrcCondition: $s2"; 

if($rows&&!$patientselected) { 
?>
<table border=0>
  <tr>
    <td><img <?php echo createMascot($root_path,'mascot1_r.gif','0','bottom') ?> align="absmiddle"></td>
    <td class="prompt">
<?php
if (($mode=='search'||$mode=='paginate')){
	if($rows) echo str_replace("~nr~",$totalcount,$LDSearchFound).' '.$LDShowing.' '.$pagen->BlockStartNr().' '.$LDTo.' '.$pagen->BlockEndNr().'.';
		else echo str_replace('~nr~','0',$LDSearchFound); 

$append="&dept_nr=$dept_nr&target=archiv&all_depts=$all_depts";		
	# Preload  common icon images
	$img_male=createComIcon($root_path,'spm.gif','0','',TRUE);
	$img_female=createComIcon($root_path,'spf.gif','0','',TRUE);
	$bgimg='tableHeaderbg3.gif';
	$tbg= 'background="'.$root_path.'gui/img/common/'.$theme_com_icon.'/'.$bgimg.'"';
		
?>
	</td>
  </tr>
</table>

<table border=0 cellpadding=0 cellspacing=0>
  <tr class="wardlisttitlerow">
      <td><b>
	  <?php echo $pagen->makeSortLink($LDSex,'sex',$oitem,$odir,$append);  ?></b></td>
      <td><b>
	  <?php echo $pagen->makeSortLink($LDLastName,'name_last',$oitem,$odir,$append);  ?></b></td>
      <td><b>
	  <?php echo $pagen->makeSortLink($LDName,'name_first',$oitem,$odir,$append);  ?></b></td>
      <td><b>
	  <?php echo $pagen->makeSortLink($LDBday,'date_birth',$oitem,$odir,$append);  ?></b></td>
       <td><b>
	  <?php echo $pagen->makeSortLink($LDPatientNr,'encounter_nr',$oitem,$odir,$append);  ?></b></td>
      <td><b>
	  <?php echo $pagen->makeSortLink($LDSrcListElements[5],'op_date',$oitem,$odir,$append);  ?></b></td>
      <td><b>
	  <?php echo $pagen->makeSortLink($LDDepartment,'LD_var',$oitem,$odir,$append);  ?></b></td>
       <td><b>
	  <?php echo $pagen->makeSortLink($LDOpNr,'nr',$oitem,$odir,$append);  ?></b></td>
  </tr>
 <?php 
 $toggle=0;
 while($row=$ergebnis->FetchRow())
 {
 	echo'
  <tr ';
  if($toggle){ echo "class=wardlistrow2"; $toggle=0;} else {echo "class=wardlistrow1"; $toggle=1;}
  # Prepare the url get values
  $buf="op-doku-search.php".URL_APPEND."&dept_nr=".$row['dept_nr']."&target=search&mode=select&nr=".$row['nr']."&all_depts=".$all_depts;
  echo '><td>';
 
 
	switch($row['sex']){
		case 'f': echo '<img '.$img_female.'>'; break;
		case 'm': echo '<img '.$img_male.'>'; break;
		default: echo '&nbsp;'; break;
	}
 
  
  echo '
	</td>
    <td>&nbsp; <a href="'.$buf.'" title="'.$LDClk2Show.'">'.$row['name_last'].'</a></td>
    <td>&nbsp; &nbsp;'.$row['name_first'].'</td>
    <td>&nbsp; &nbsp;'.formatDate2Local($row['date_birth'],$date_format).'</td>
    <td>&nbsp; &nbsp;';

	echo $row['encounter_nr'].'</td>
    <td>&nbsp; &nbsp;<a href="'.$buf.'" title="'.$LDClk2Show.'">'.formatDate2Local($row['op_date'],$date_format).'</a></td>
    <td>&nbsp; &nbsp;';

	$buffer=$row['LD_var'];
	if(isset($$buffer)&&!empty($$buffer)) echo $$buffer;
		else echo $row['name_formal'];
		
	echo '</td>
    <td align=right>&nbsp; &nbsp;<a href="'.$buf.'" title="'.$LDClk2Show.'">'.$row['nr'].'</a>&nbsp; &nbsp;</td>
  </tr>
  <tr class="thinrow_vspacer">
  <td colspan=8 height=1><img src="'.$root_path.'gui/img/common/default/pixel.gif" border=0 width=1 height=1 align="absmiddle"></td>
  </tr>';
  }
	echo '
						<tr><td colspan=7>'.$pagen->makePrevLink($LDPrevious,$append).'</td>
						<td align=right>'.$pagen->makeNextLink($LDNext,$append).'</td>
						</tr>';

}						
?>
</table>
<p>
<form method="post"  action="op-doku-archiv.php">

<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="target" value="archiv">
<input type="hidden" name="dept_nr" value="<?php echo $dept_nr ?>">
<input type="hidden" name="mode" value="dummy">
<input type="submit" value="<?php echo $LDNewArchiveSearch ?>" >
                             </form>
<?php 

}else{

	if($mode=='search'){
?>
<table border=0>
  <tr>
    <td><img <?php echo createMascot($root_path,'mascot2_r.gif','0','bottom') ?> align="absmiddle"></td>
    <td class="warnprompt">
<b><?php echo ''.$LDSorryNotFound.'</font>'; ?>
</td>
  </tr>
</table>
<?php
	}
?>


<table border="0"  bgcolor="#ffffff">

<form method="post" name="opdoc" <?php if($mode=="select") echo 'action="op-doku-start.php"'; else echo 'action="op-doku-archiv.php"  onSubmit="return chkForm(this)"'; ?>>
<tr <?php if($mode=="select") echo "bgcolor=#ffffff"; ?>>
<td><?php echo $LDOpDate ?>:<br>
</td>
<td>
<?php
//gjergji : new calendar
require_once ('../../js/jscalendar/calendar.php');
$calendar = new DHTML_Calendar('../../js/jscalendar/', $lang, 'calendar-system', true);
$calendar->load_files();
//end : gjergji

echo $calendar->show_calendar($calendar,$date_format,'op_date',$row['op_date']);

?>
 
<font color="#000000">&nbsp; &nbsp;<?php echo $LDOperator ?>:
<?php 
	if($mode=="select") echo '<font color="#800000">'.$row[operator]; 
		else echo '
		<input name="operator" type="text" size="14" >';
 ?>
</td>
</tr>
<tr <?php if($mode=="select") echo "bgcolor=#ffffff"; ?>>
<td>
<p>
<?php echo $LDPatientNr ?>:
</td>
<td>
<?php if($mode=="select") {
	echo '<font color="#000099">';

	echo $row['encounter_nr'];
  }
	else echo '
	<input name="patnum" type="text" size="14">';
?>
</td>
</tr>
<tr <?php if($mode=="select") echo "bgcolor=#ffffff"; ?>>
<td><?php echo $LDLastName ?>:
</td>
<td>
<?php if($mode=="select") echo '<font color="#000099"><b>'.$enc_obj->LastName().'</b>'; 
	else echo '
	<input name="name" type="text" size="14">';
?>
</td>
</tr>
<tr <?php if($mode=="select") echo "bgcolor=#ffffff"; ?>>
<td><?php echo $LDName ?>:
</td>
<td>
<?php if($mode=="select") echo '<font color="#000099"><b>'.$enc_obj->FirstName().'</b>'; 
	else echo '
	<input name="vorname" type="text" size="14" >';
?>
</td>
</tr>
<tr <?php if($mode=="select") echo "bgcolor=#ffffff"; ?>>
<td><?php echo $LDBday ?>:
</td>
<td>
<?php 
//echo $calendar->show_calendar($calendar,$date_format,'gebdatum',$enc_obj->BirthDate());
if($mode=="select") {
    echo '<font color="#000099">'.formatDate2Local($enc_obj->BirthDate(),$date_format); 
}else{
  echo $calendar->show_calendar($calendar,$date_format,'gebdatum',$enc_obj->BirthDate());
}
?> 

</td>
</tr>
<tr <?php if($mode=="select") echo "bgcolor=#ffffff"; ?>>
<td>
</td>
<td>
<?php if($mode=="select") : ?>
<font color="#000099">
<?php switch($row[status])
	{
		case "stat": echo $LDStationary;break;
		case "amb": echo $LDAmbulant; break;
	}
	echo "<br>";
	echo ucfirst($row[kasse]);
?>
<?php else : ?>
<input name="status" type="radio" value="2" <?php if (($row[status]==2)||($status==2))echo "checked" ?> ><?php echo $LDAmbulant ?>  <input name="status" type="radio" value="1"  <?php if(($row[status]==1)||($status==1)) echo "checked" ?> ><?php echo $LDStationary ?><br>
</font>
<FONT SIZE=-1  FACE="Arial" <?php if($err_kasse) echo 'color=#cc0000'; ?>><input name="kasse" type="radio" value="kasse" <?php if (($row[kasse]=="kasse")||($row[kasse]=="kasse")||($kasse=="kasse")) echo "checked" ?> ><?php echo $LDInsurance ?>  <input name="kasse" type="radio" value="privat"  <?php if (($row[kasse]=="privat")||($row[kasse]=="privat")||($kasse=="privat")) echo "checked" ?> ><?php echo $LDPrivate ?> <input name="kasse" type="radio" value="x"  <?php if (($row[kasse]=="x")||($row[kasse]=="x")||($kasse=="x")) echo "checked" ?> ><?php echo $LDSelfPay ?>
<?php endif ?>
</td>
</tr>
<tr <?php if($mode=="select") echo "bgcolor=#ffffff"; ?>>
<td><?php echo $LDDiagnosis ?>:
</td>
<td>
<?php if($mode=="select") echo '<font color="#800000">'.$row[diagnosis]; 
	else echo '
	<input name="diagnosis" type="text" size="60" >';
?>
</td>
</tr>
<tr <?php if($mode=="select") echo "bgcolor=#ffffff"; ?>>
<td><?php echo $LDLocalization ?>:
</td>
<td>
<?php if($mode=="select") echo '<font color="#800000">'.$row[localize]; 
	else echo '
	<input name="localize" type="text" size="60" >';
?>
</td>
</tr>
<tr <?php if($mode=="select") echo "bgcolor=#ffffff"; ?>>
<td><?php echo $LDTherapy ?>:
</td>
<td>

<?php if($mode=="select") echo '<font color="#800000">'.$row[therapy]; 
	else echo '
	<input name="therapy" type="text" size="60" >';
?>
</td>
</tr >
<tr <?php if($mode=="select") echo "bgcolor=#ffffff"; ?>>
<td><?php echo $LDSpecials ?>:
</td>
<td>
<?php if($mode=="select") echo '<font color="#800000">'.$row[special]; 
	else echo '
	<input name="special" type="text" size="60" >';
?>
</td>
</tr>
<tr <?php if($mode=="select") echo "bgcolor=#ffffff"; ?>>
<td><?php echo $LDClassification ?>:
</td>
<td>
<?php if($mode=="select") : ?>
<font color="#800000">
<?php
if($row[class_s]) echo "$row[class_s] $LDMinor  &nbsp; ";
   	if($row[class_m]) echo "$row[class_m] $LDMiddle &nbsp; ";
   	if($row[class_l]) echo "$row[class_l] $LDMajor";
	echo " $LDOperation";
?>
<?php else : ?>

<select name="klas_s">
			<option value="0"> </option>
<?php
	for($i=1;$i<9;$i++){
		echo "
			<option value=\"$i\">$i</option>";
	}
?>
</select>
<?php echo $LDMinor ?>&nbsp;
<select name="klas_m">
			<option value="0"> </option>
<?php
	for($i=1;$i<9;$i++){
		echo "
			<option value=\"$i\">$i</option>";
	}
?>
?>
</select>
<?php echo $LDMiddle ?>&nbsp;
<select name="klas_l">
			<option value="0"> </option>
<?php
	for($i=1;$i<9;$i++){
		echo "
			<option value=\"$i\">$i</option>";
	}
?>
</select>
<?php echo "$LDMajor $LDOperation" ?>

<?php endif ?>
</td>
</tr>
</table>
<p>
 
<font color="#0"> &nbsp; <?php echo $LDScrubNurse ?>: 
<?php if($mode=="select") echo '<font color="#800000">'.$row[scrub_nurse].' &nbsp;'; 
	else echo '
	<input name="inst" type="text" size="14" >';
?>
<font color="#0"> &nbsp; <?php echo $LDOpRoom ?>: <font color="#0">
<?php if($mode=="select") echo '<font color="#800000">'.$row[op_room]; 
	else echo '
	<input name="opsaal" type="text" size="3" >';
?>
<p>
<?php if($mode=="select") : ?>
<input type="hidden" name="nr" value="<?php echo $row['nr'] ?>">
<input type="hidden" name="pn" value="<?php echo $row['encounter_nr'] ?>">
<input type="hidden" name="mode" value="update">
<input type="hidden" name="target" value="entry">
<!-- <input type="submit" value="<?php echo $LDUpdateData ?>">
 -->
 <input type="image"<?php echo createLDImgSrc($root_path,'update_data.gif') ?>>
<p>
<input type="button" value="<?php echo $LDNewArchiveSearch ?>" onClick="window.location.href='op-doku-archiv.php<?php echo URL_REDIRECT_APPEND."&dept_nr=$dept_nr" ?>&target=archiv&mode=?'">

<?php else : ?>
<input type="hidden" name="target" value="archiv">
<input  type="image" <?php echo createLDImgSrc($root_path,'searchlamp.gif','0') ?> border=0  alt="<?php echo $LDSearch ?>">
<input type="hidden" name="mode" value="search">
<a href="javascript:document.opdoc.reset()"><img <?php echo createLDImgSrc($root_path,'reset.gif','0') ?> alt="<?php echo $LDResetAll ?>" ></a>
<?php endif ?>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="dept_nr" value="<?php echo $dept_nr ?>">
</form>
<?php 
} 
?>
<p>
</ul>

</FONT>
<p>
</td>
</tr>
</table>        
<hr>
<ul>
<FONT    SIZE=2  FACE="Arial">
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="op-doku-start.php<?php echo URL_APPEND."&target=entry&dept_nr=$dept_nr"; ?>&mode=dummy"><?php echo $LDStartNewDocu ?></a><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="op-doku-search.php<?php echo URL_APPEND."&target=archiv&dept_nr=$dept_nr"; ?>&mode=dummy"><?php echo $LDSearchDocu ?></a><br>
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
