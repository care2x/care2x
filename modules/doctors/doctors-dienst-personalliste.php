<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
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

$lang_tables[]='search.php';
$lang_tables[]='departments.php';
define('LANG_FILE','doctors.php');
if($_SESSION['sess_user_origin']=='personell_admin'){
	$local_user='aufnahme_user';
	$bShowSearchEntry = FALSE;
	if(!isset($saved)||!$saved){
		$mode='search';
		$searchkey=$nr;
	}
	$breakfile=$root_path.'modules/personell_admin/personell_register_show.php'.URL_APPEND.'&target=personell_reg&personell_nr='.$nr;
}else{
	$local_user='ck_doctors_dienstplan_user';
	$breakfile='javascript:history.back()';
	$bShowSearchEntry = TRUE;
}
require_once($root_path.'include/inc_front_chain_lang.php');

# Check for the department nr., else show department selector
if(!isset($dept_nr)||!$dept_nr){
	if($cfg['thispc_dept_nr']){
		$dept_nr=$cfg['thispc_dept_nr'];
	}else{
		header('Location:doctors-select-dept.php'.URL_REDIRECT_APPEND.'&target=plist&retpath='.$retpath);
		exit;
	}
}

$thisfile=basename(__FILE__);

# Load the department list with oncall doctors
require_once($root_path.'include/care_api_classes/class_department.php');
$dept_obj=new Department;
$dept_obj->preloadDept($dept_nr);
$dept_list=&$dept_obj->getAllMedical();
# Load the dept doctors
require_once($root_path.'include/care_api_classes/class_personell.php');
$pers_obj=new Personell;
$doctors=&$pers_obj->getDoctorsOfDept($dept_nr);
# Load global values
$GLOBAL_CONFIG=array();
require_once($root_path.'include/care_api_classes/class_globalconfig.php');
$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
$glob_obj->getConfig('personell_%');

# Set color values for the search mask
$searchmask_bgcolor='#f3f3f3';
$searchprompt=$LDEntryPrompt;
$entry_block_bgcolor='#fff3f3';
$entry_border_bgcolor='#6666ee';
$entry_body_bgcolor='#ffffff';

if(!isset($searchkey)) $searchkey='';
if(!isset($mode)) $mode='';

if(!empty($ipath)){
	switch($ipath)
	{
		case 'menu': $breakfile="doctors.php".URL_APPEND; break;
		case 'qview': $breakfile="doctors-dienst-schnellsicht.php".URL_APPEND."&hilitedept=$dept_nr"; break;
		case 'plan': $breakfile="doctors-dienstplan-planen.php".URL_APPEND."&dept_nr=$dept_nr&pmonth=$pmonth&pyear=$pyear&retpath=$retpath"; break;
		default: $breakfile="javascript:window.history.back()";
	}
}

$append='&retpath='.$retpath.'&ipath='.$ipath;

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


# Get the max nr of rows from global config
$glob_obj->getConfig('pagin_personell_search_max_block_rows');
if(empty($GLOBAL_CONFIG['pagin_personell_search_max_block_rows'])) $pagen->setMaxCount(MAX_BLOCK_ROWS); # Last resort, use the default defined at the start of this page
	else $pagen->setMaxCount($GLOBAL_CONFIG['pagin_personell_search_max_block_rows']);


# Load date formatter
require_once($root_path.'include/inc_date_format_functions.php');
# Check mode
if($mode=='search'||$mode=='paginate'){
	# Convert other wildcards
	$searchkey=strtr($searchkey,'*?','%_');
	# Save the search keyword for eventual pagination routines
	if($mode=='search') $_SESSION['sess_searchkey']=$searchkey;

	$search_result=&$pers_obj->searchLimitPersonellBasicInfo($searchkey,$pagen->MaxCount(),$pgx,$oitem,$odir);
	//echo $pers_obj->getLastQuery();
	# Get the resulting record count
	$linecount=$pers_obj->LastRecordCount();
	//$linecount=$address_obj->LastRecordCount();
	$pagen->setTotalBlockCount($linecount);
	# Count total available data
	if(isset($totalcount)&&$totalcount){
		$pagen->setTotalDataCount($totalcount);
	}else{
		@$pers_obj->searchPersonellBasicInfo($searchkey,''); # The second param is empty to prevent sorting
		$totalcount=$pers_obj->LastRecordCount();
		$pagen->setTotalDataCount($totalcount);
	}
	$pagen->setSortItem($oitem);
	$pagen->setSortDirection($odir);
}

# Load the common icons
$img_options_contact=createComIcon($root_path,'violet_phone.gif','0');
$img_options_delete=createComIcon($root_path,'delete2.gif','0');

# Prepare page title
 $sTitle = "$LDDocsList :: ";
 $LDvar=$dept_obj->LDvar();
 if(isset($$LDvar)&&$$LDvar) $sTitle = $sTitle.$$LDvar;
   else $sTitle = $sTitle.$dept_obj->FormalName();

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common');

# Title in toolbar
 $smarty->assign('sToolbarTitle',$sTitle);

 # href for return button
 $smarty->assign('pbBack',$breakfile);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('docs_personallist_edit.php')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',$sTitle);

  # Body onLoad javascript
 $smarty->assign('sOnLoadJs','onLoad="document.searchform.searchkey.focus()"');

 # Collect extra javascript

 ob_start();

?>

<script language="javascript">
<!-- 
  var urlholder;
function popinfo(l,d){
	urlholder="doctors-dienstplan-popinfo.php<?php echo URL_REDIRECT_APPEND ?>&nr="+l+"&dept_nr="+d+"&user=<?php echo $aufnahme_user.'"' ?>;
	infowin=window.open(urlholder,"dienstinfo","width=400,height=300,menubar=no,resizable=yes,scrollbars=yes");
}
function deleteItem(nr){
	if(confirm('<?php echo $LDSureToDeleteEntry; ?>')){
		window.location.replace("doctors-list-add.php<?php echo URL_REDIRECT_APPEND; ?>&item_nr="+nr+"&dept_nr=<?php echo $dept_nr.'&mode=delete&retpath='.$retpath.'&ipath='.$ipath; ?>");
	}
}
-->
</script>

<script language="javascript">
<?php require($root_path.'include/inc_checkdate_lang.php'); ?>
</script>

<?php
 
 $sTemp=ob_get_contents();
 ob_end_clean();
 $smarty->append('JavaScript',$sTemp);

 # Buffer form

 ob_start();

?>

<ul>
<p><br>
<font face="arial,verdana,helvetica" size=2>
<?php
if(is_object($doctors)&&$doctors->RecordCount()){
	# Preload  common icon images
	$img_male=createComIcon($root_path,'spm.gif','0');
	$img_female=createComIcon($root_path,'spf.gif','0');
?>
<table border=0  bgcolor="#6f6f6f" cellspacing=0 cellpadding=0>
  <tr>
    <td>
	
	<table border=0  cellspacing=1>
  	<tr bgcolor="#cfcfcf" >
    <td  align=center class="v13" colspan=3><nobr>&nbsp;</nobr></td>
    <td  align=center class="v13" colspan=3><nobr>&nbsp;<?php echo $LDFamilyName; ?></nobr></td>
    <td  align=center class="v13" colspan=2><font><nobr>&nbsp;<?php echo $LDGivenName; ?></nobr></td>
<!--     <td  align=center  class="v13" colspan=2><font><nobr>&nbsp;<?php echo $LDDateOfBirth; ?></nobr></td>
 -->    <td  align=center  class="v13" colspan=2><nobr>&nbsp;<?php echo $LDFunction; ?></nobr></td>
    <td  align=center  class="v13" colspan=2><nobr>&nbsp;<?php echo $LDMoreInfo; ?></nobr></td>
    <td  align=center  class="v13" colspan=2><nobr>&nbsp;</nobr></td>
  	</tr>
	
	<?php 
		while($row=$doctors->FetchRow()){
	?>
  	<tr bgcolor="#ffffff">
    <td  class="v13" colspan=3><nobr>&nbsp;
	<?php  
		switch($row['sex']){
			case 'f': echo '<img '.$img_female.'>'; break;
			case 'm': echo '<img '.$img_male.'>'; break;
			default: echo '&nbsp;'; break;
		}	
	?></nobr></td>
    <td  class="v13" colspan=3><nobr>&nbsp;<?php echo $row['name_last']; ?></nobr></td>
    <td  class="v13" colspan=2><nobr><fon >&nbsp;<?php echo $row['name_first']; ?></nobr></td>
<!--     <td  class="v13" colspan=2><font>&nbsp;<?php echo formatDate2Local($row['date_birth'],$date_format); ?></td>
 -->    <td  class="v13" colspan=2><nobr>&nbsp;<?php echo $row['job_function_title']; ?></nobr></td>
    <td  class="v13" colspan=2>&nbsp;<?php echo '
						&nbsp;
							<a href="javascript:popinfo(\''.$row['personell_nr'].'\',\''.$dept_nr.'\')" title="'.$LDContactInfo.'">
							<img '.$img_options_contact.' alt="'.$LDShowData.'"></a>&nbsp;';	 ?></td>
	<td><a href="javascript:deleteItem('<?php echo $row['nr']; ?>')" title="<?php echo $LDDelete; ?>">
							<img <?php echo $img_options_delete.' alt="'.$LDDelete.'"'; ?>></a>&nbsp</td>  	
							
							
	</tr>
	
	<?php
	}
	?>
	
  	</table>
  
  </td>
  </tr>
</table>
<?php
}else{
 echo '
 	<table border=0>
    <tr>
      <td><img '.createMascot($root_path,'mascot1_r.gif','0','left').'  ></td>
      <td><font face="verdana,arial" size=3><b>'.$LDNoPersonList.'</b></td>
    </tr>
  </table>';
}

if($bShowSearchEntry){

?>
<hr>
<font face="arial,verdana,helvetica" size=3 color="#990000"><b><?php echo "$LDAddDoctorToList $LDPlsSearchDoctor"; ?></b></font>
	<table border=0 cellpadding=10 bgcolor="<?php echo $entry_border_bgcolor ?>">
     <tr>
       <td>
	   <?php

           // include($root_path.'include/inc_patient_searchmask.php');
            include($root_path.'include/inc_searchmask.php');
       
	   ?>
		</td>
    </tr>
   </table>
<?php

}

if($mode=='search'||$mode=='paginate'){
	if($bShowSearchEntry){
		if ($linecount) echo str_replace("~nr~",$totalcount,$LDSearchFound).' '.$LDShowing.' '.$pagen->BlockStartNr().' '.$LDTo.' '.$pagen->BlockEndNr().'.';
			else echo str_replace('~nr~','0',$LDSearchFound);
	}
		  
	if (is_object($pers_obj)&&$linecount) { 

		# Load the common icons
		//$img_options_add=createComIcon($root_path,'add.gif','0');
		$img_options_add=createLDImgSrc($root_path,'add2list_sm.gif','0');
		$img_male=createComIcon($root_path,'spm.gif','0','',TRUE);
		$img_female=createComIcon($root_path,'spf.gif','0','',TRUE);

	echo '<p>
			<table border=0 cellpadding=2 cellspacing=1>
			<tr class="wardlisttitlerow">';
			
?>
     <td>
	  <?php echo $pagen->makeSortLink($LDPersonellNr,'nr',$oitem,$odir,$append);  ?></td>
     <td>
	  <?php echo $pagen->makeSortLink($LDSex,'sex',$oitem,$odir,$append);  ?></td>
      <td>
	  <?php echo $pagen->makeSortLink($LDFamilyName,'name_last',$oitem,$odir,$append);  ?></td>
      <td>
	  <?php echo $pagen->makeSortLink($LDGivenName,'name_first',$oitem,$odir,$append);  ?></td>
      <td>
	  <?php echo $pagen->makeSortLink($LDDateOfBirth,'date_birth',$oitem,$odir,$append);  ?></td>
      <td>
	  <?php echo $pagen->makeSortLink($LDFunction,'job_function_title',$oitem,$odir,$append);  ?></td>

    <td  background="<?php echo createBgSkin($root_path,'tableHeaderbg.gif'); ?>"  align=center><font face=arial size=2 color="#ffffff"><b><?php echo $LDAdd; ?></td>
    <td background="<?php echo createBgSkin($root_path,'tableHeaderbg.gif'); ?>" ><font face=arial size=2 color="#ffffff"><b><?php echo $LDMoreInfo; ?></td>

<?php
					echo"</tr>";

					while($row=$search_result->FetchRow())
					{
						echo "
							<tr class=";
						if($toggle) { echo "wardlistrow2>"; $toggle=0;} else {echo "wardlistrow1>"; $toggle=1;};
						echo"<td>";
                        echo '&nbsp;'.($row['nr']+$GLOBAL_CONFIG['personell_nr_adder']);
                        echo "</td><td>";	

						switch($row['sex']){
							case 'f': echo '<img '.$img_female.'>'; break;
							case 'm': echo '<img '.$img_male.'>'; break;
							default: echo '&nbsp;'; break;
						}	
						
						echo"</td><td>";
						echo "&nbsp;".ucfirst($row['name_last']);
                        echo "</td>";	
						echo"<td>";
						echo "&nbsp;".ucfirst($row['name_first']);
                        echo "</td>";	
						echo"<td>";
						echo "&nbsp;".formatDate2Local($row['date_birth'],$date_format);
                        echo "</td>";	
						echo"<td>";
						echo "&nbsp;".ucfirst($row['job_function_title']);
                        echo "</td>";	

					    if($_COOKIE[$local_user.$sid]) echo '
						<td>&nbsp;
							<a href="doctors-list-add.php'.URL_APPEND.'&nr='.$row['nr'].'&dept_nr='.$dept_nr.'&mode=save&retpath='.$retpath.'&ipath='.$ipath.'" title="'.$LDAddDoctorToList.'">
							<img '.$img_options_add.' alt="'.$LDShowData.'"></a>&nbsp;';
							
                       if(!file_exists($root_path.'cache/barcodes/en_'.$full_en.'.png'))
	      		       {
			               echo "<img src='".$root_path."classes/barcode/image.php?code=".$full_en."&style=68&type=I25&width=180&height=50&xres=2&font=5&label=2&form_file=en' border=0 width=0 height=0>";
		               }
						echo '</td>';
						echo '
						<td align=center>&nbsp;
							<a href="javascript:popinfo(\''.$row['nr'].'\',\''.$dept_nr.'\')" title="'.$LDContactInfo.'">
							<img '.$img_options_contact.' alt="'.$LDShowData.'"></a>&nbsp;</td>';						
						echo '</tr>';

					}
					echo '
						<tr><td colspan=7>'.$pagen->makePrevLink($LDPrevious,$append).'</td>
						<td align=right>'.$pagen->makeNextLink($LDNext,$append).'</td>
						</tr>
						</table>';
					if($linecount>$pagen->MaxCount())
					{
					    # Set the appending nr for the searchform
					    $searchform_count=2;
					?>
			<p>
		 <table border=0 cellpadding=10 bgcolor="<?php echo $entry_border_bgcolor ?>">
     <tr>
       <td>
	   <?php
            include($root_path.'include/inc_patient_searchmask.php');
	   ?>
</td>
     </tr>
   </table>
					<?php
					}
	}
}
?>
<hr>
<form action=<?php echo $thisfile ?> name="deptform">
<?php echo $LDChgDept ?>
<select name="dept_nr" >
<?php
while(list($x,$v)=each($dept_list))
	{
		echo '
		<option value="'.$v['nr'].'" ';
		if($dept_nr==$v['nr']) echo 'selected';
		echo '>';
		if(isset($$v['LD_var'])&&$$v['LD_var']) echo $$v['LD_var'];
			else echo $v['name_formal'];
		echo '</option>';
	}?>
</select>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="retpath" value="<?php echo $retpath ?>">
<input type="hidden" name="ipath" value="<?php echo $ipath ?>">
<input type="hidden" name="pmonth" value="<?php echo $pmonth ?>">
<input type="hidden" name="pyear" value="<?php echo $pyear ?>">
<input type="hidden" name="nr" value="<?php echo $nr ?>">
<input type="submit" value="<?php echo $LDChange ?>">
</form>

<p>
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0'); ?>></a>

</ul>

<?php

$sTemp = ob_get_contents();
 ob_end_clean();

# Assign the submenu to the mainframe center block

 $smarty->assign('sMainFrameBlockData',$sTemp);

 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');

?>
