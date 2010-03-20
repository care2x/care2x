<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
# Default value for the maximum nr of rows per block displayed, define this to the value you wish
# In normal cases this value is derived from the db table "care_config_global" using the "pagin_insurance_list_max_block_rows" element.
define('MAX_BLOCK_ROWS',30); 

$lang_tables[]='search.php';
define('LANG_FILE','immunization.php');
$local_user='aufnahme_user';
require_once($root_path.'include/inc_front_chain_lang.php');
# Load the insurance object
require_once($root_path.'include/care_api_classes/class_immunization.php');
$immu_obj=new Immunization();

$breakfile='immunization_manage.php'.URL_APPEND;
$thisfile=basename(__FILE__);

# Initialize page´s control variables
if($mode!='paginate'){
	# Reset paginator variables
	$pgx=0;
	$totalcount=0;
	# Set the sort parameters
	if(empty($oitem)) $oitem='name';
	if(empty($odir)) $odir='ASC';
}

$GLOBAL_CONFIG=array();
include_once($root_path.'include/care_api_classes/class_globalconfig.php');
$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
$glob_obj->getConfig('pagin_insurance_list_max_block_rows');
if(empty($GLOBAL_CONFIG['pagin_insurance_list_max_block_rows'])) $GLOBAL_CONFIG['pagin_insurance_list_max_block_rows']=MAX_BLOCK_ROWS; # Last resort, use the default defined at the start of this page

#Load and create paginator object
require_once($root_path.'include/care_api_classes/class_paginator.php');
$pagen=new Paginator($pgx,$thisfile,$_SESSION['sess_searchkey'],$root_path);
# Adjust the max nr of rows in a block
$pagen->setMaxCount($GLOBAL_CONFIG['pagin_insurance_list_max_block_rows']);

# Get all the active firms info
$immu=$immu_obj->getLimitActiveImmuInfo($GLOBAL_CONFIG['pagin_insurance_list_max_block_rows'],$pgx,$oitem,$odir);

$linecount=$immu_obj->LastRecordCount();
$pagen->setTotalBlockCount($linecount);
# Count total available data
if(isset($totalcount)&&$totalcount){
	$pagen->setTotalDataCount($totalcount);
}else{
	$totalcount=$immu_obj->countAllActiveImmu();
	$pagen->setTotalDataCount($totalcount);
}

$pagen->setSortItem($oitem);
$pagen->setSortDirection($odir);


# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('system_admin');

# Title in toolbar
 $smarty->assign('sToolbarTitle',"$LDImmunization :: $LDListAll");

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('insurance_list.php')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',"$LDImmunization :: $LDListAll");

# Buffer page output

ob_start();

?>

<ul>

<?php 
if(is_object($immu)){
	
	if ($linecount) echo str_replace("~nr~",$totalcount,$LDSearchFound).' '.$LDShowing.' '.$pagen->BlockStartNr().' '.$LDTo.' '.$pagen->BlockEndNr().'.';
		else echo str_replace('~nr~','0',$LDSearchFound);

?>
<table border=0 cellpadding=2 cellspacing=1>
  <tr class="wardlisttitlerow">
      <td><b>
	  <?php echo $pagen->makeSortLink($LDImmuID,'nr',$oitem,$odir);  ?></b>
	</td>
      <td><b>
	  <?php echo $pagen->makeSortLink($LDImmuName,'name',$oitem,$odir);  ?></b>
	</td>
      <td><b>
	  <?php echo $pagen->makeSortLink($LDImmuPeriod,'period',$oitem,$odir);  ?></b>
	</td>
      <td><b>
	  <?php echo $pagen->makeSortLink($LDImmuTolerance,'tolerance',$oitem,$odir);  ?></b>
	</td>
      <td><b>
	  <?php echo $pagen->makeSortLink($LDImmuMedicine,'medicine',$oitem,$odir);  ?></b>
	</td>
  </tr> 
<?php
	$toggle=0;
	while($immuns=$immu->FetchRow()){
		if($toggle) $bgc='#dddddd';
			else $bgc='#efefef';
		$toggle=!$toggle;
?>
  <tr  bgcolor="<?php echo $bgc ?>">
    <td><a href="immunization_info.php<?php echo URL_APPEND.'&retpath=list&immu_id='.$immuns['nr']; ?>"><?php echo $immuns['nr']; ?></a></td>
    <td><a href="immunization_info.php<?php echo URL_APPEND.'&retpath=list&immu_id='.$immuns['nr']; ?>"><?php echo $immuns['name']; ?></a></td>
    <td><?php echo $immuns['period']; ?></td>
    <td><?php echo $immuns['tolerance']; ?></td>
    <td><?php echo $immuns['medicine']; ?></td>
</td>
  </tr> 
<?php
	}
	echo '
	<tr><td colspan=4>'.$pagen->makePrevLink($LDPrevious).'</td>
	<td align=right>'.$pagen->makeNextLink($LDNext).'</td>
	</tr>';
?>
  </table>
<?php
}else{
	 echo str_replace('~nr~','0',$LDSearchFound);
}
?>
<p>
<form action="immunization_new.php" method="post">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="submit" value="<?php echo $LDNeedEmptyFormPls ?>">
</form>
</ul>

<?php

$sTemp = ob_get_contents();
ob_end_clean();

# Assign page output to the mainframe template

$smarty->assign('sMainFrameBlockData',$sTemp);
 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');

?>
