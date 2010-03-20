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
$lang_tables[]='departments.php';
define('LANG_FILE','edp.php');
$local_user='ck_edv_user';
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/care_api_classes/class_oproom.php');
require_once($root_path.'include/inc_date_format_functions.php');

$breakfile=$root_path.'modules/system_admin/edv-system-admi-welcome.php'.URL_APPEND	;

# Create the OR object
$OR_obj=& new OPRoom;

# Get the OR info
$OR_info=$OR_obj->ORRecordInfo($nr);
if(is_object($OR_info)){
	$ORoom=$OR_info->FetchRow();
	//echo $OR_obj->getLastQuery();
}else{
	$ORoom=array();
}

# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('system_admin');

# Title in toolbar
 $smarty->assign('sToolbarTitle',$LDOR.' :: '.$ORoom['room_nr']);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('or_info.php')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',$LDOR.' :: '.$ORoom['room_nr']);

 # Collect javascript code
 ob_start();
?>

<ul>
<?php if($rows) : ?>

<img <?php echo createMascot($root_path,'mascot1_r.gif','0','bottom') ?> align="absmiddle"><font class="prompt">
<b><?php echo str_replace("~station~",strtoupper($station),$LDStationExists) ?></b></font><p>
<?php endif ?>
<?php echo $LDEnterAllFields ?>

<form action="or_new.php" method="post" name="newstat">

<table border=0 cellpadding=4>
<tbody class="submenu">
  <tr>
    <td class= align=right bgColor="#eeeeee"><?php echo $LDORNr ?>: </td>
    <td class= bgColor="#f9f9f9">
	<?php 	
		echo $ORoom['room_nr'];
 	?>
</td>
  </tr> 
  <tr>
    <td class= align=right bgColor="#eeeeee"><?php echo $LDOPTableNr ?>: </td>
    <td class= bgColor="#f9f9f9"><?php echo $ORoom['nr_of_beds'] ?>
</td>
  </tr> 
  
  <tr>
    <td class= align=right bgColor="#eeeeee"><?php echo $LDDateCreation ?>: </td>
    <td class= bgColor="#f9f9f9"><?php echo formatDate2Local($ORoom['date_create'],$date_format) ?>
</td>
  </tr>
  <tr>
    <td class= align=right bgColor="#eeeeee"><?php echo $LDORName ?>: </td>
    <td class= bgColor="#f9f9f9"><?php echo $ORoom['info'] ?>
</td>
  </tr>
  <tr>
    <td class= align=right bgColor="#eeeeee"><?php echo $LDOwnerWard ?>: </td>
    <td class= bgColor="#f9f9f9">
<?php
if(!empty($ORoom['ward_id'])){
	if(defined('SHOW_COMBINE_WARDIDNAME')&&SHOW_COMBINE_WARDIDNAME){
		$buffer= '[ '.$ORoom['ward_id'].' ] '.$ORoom['wardname'];
	}else{
		if(defined('SHOW_FULL_WARDNAME')&&SHOW_FULL_WARDNAME) $buffer= $ORoom['wardname'];
			else $buffer= $ORoom['ward_id'];
	}
	echo $buffer;
}else{
	echo '&nbsp;';
}
 ?>
</td>
  </tr>

<tr>
    <td class= align=right bgColor="#eeeeee"><?php echo $LDOwnerDept ?>: </td>
    <td class= bgColor="#f9f9f9"><?php 
								if(isset($$ORoom['LD_var'])&&!empty($$ORoom['LD_var'])) echo $$ORoom['LD_var'];
									else echo $ORoom['deptname'];
							?>
</td>
  </tr>
   
  <tr>
    <td class= align=right bgColor="#eeeeee"><?php echo $LDTempClosed ?>: </td>
    <td class= bgColor="#f9f9f9"><?php 
								if($ORoom['is_temp_closed']) echo $LDYes;
									else echo $LDNo;
							?>
</td>
  </tr> 
</tbody>
</table>
<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="OR_nr" value="<?php echo $ORoom['room_nr']; ?>">
<input type="hidden" name="nr" value="<?php echo $ORoom['nr']; ?>">
<input type="hidden" name="mode" value="select">
<input type="submit" value="<?php echo $LDUpdateData; ?>">
</form>
<p>

<a href="javascript:history.back()"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?> border="0"></a>
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
