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
define('LANG_FILE','immunization.php');
$local_user='aufnahme_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');
# Load the insurance object
require_once($root_path.'include/care_api_classes/class_immunization.php');
$immu_obj=new Immunization();

switch($retpath)
{
	case 'list': $breakfile='immunization_list.php'.URL_APPEND; break;
	case 'search': $breakfile='immunization_search.php'.URL_APPEND; break;
	default: $breakfile='immunization_manage.php'.URL_APPEND; 
}

if(isset($immu_id) && $immu_id&&($row=$immu_obj->getImmuTypeInfo($immu_id))){
	$immu=$row->FetchRow();
	$edit=true;
}else{
	// Redirect to search function
}

$bgc=$root_path.'gui/img/skin/default/tableHeaderbg3.gif';
$bgc2='#eeeeee';

# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('system_admin');

# Title in toolbar
 $smarty->assign('sToolbarTitle',"$LDImmunization :: $LDData");

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('insurance_info.php')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',"$LDImmunization :: $LDData");

# Colllect javascript code

ob_start();

?>

 <ul>
<?php
if(isset($save_ok) && $save_ok){ 
?>
<img <?php echo createMascot($root_path,'mascot1_r.gif','0','absmiddle') ?>><font class="prompt">
<b>
<?php 
 	echo $LDImmuInfoSaved;
?>
</b></font>
<?php 
} 
?>
<table border=0 cellpadding=4 >
  <tr>
    <td align=right class="adm_item"></font><?php echo $LDImmuName ?>: </td>
    <td class="adm_input"><?php echo $immu['name'] ?><br>
</td>
  </tr> 
  <tr>
    <td align=right class="adm_item"></font><?php echo $LDImmuType ?>: </td>
    <td class="adm_input"><?php echo $immu['type'] ?><br></td>
  </tr> 
  <tr>
    <td align=right class="adm_item"><font color=#ff0000></font><?php echo $LDImmuPeriod ?>: </td>
    <td class="adm_input"><?php echo nl2br($immu['period']); ?></td>
  </tr>
   <tr>
    <td align=right class="adm_item"></font><?php echo $LDImmuTolerance ?>: </td>
    <td class="adm_input"><?php echo nl2br($immu['tolerance']); ?></td>
  </tr>
  <tr>
    <td align=right class="adm_item"></font><?php echo $LDImmuDosage ?>: </td>
    <td class="adm_input"><?php echo nl2br($immu['dosage']); ?></td>
  </tr>
  <tr>
    <td align=right class="adm_item"><?php echo $LDImmuMedicine ?>: </td>
    <td class="adm_input"><?php echo $immu['medicine'] ?><br></td>
  </tr>
  <tr>
    <td align=right class="adm_item"><?php echo $LDImmuTiter ?>: </td>
    <td class="adm_input"><?php echo $immu['titer'] ?><br></td>
  </tr>
  <tr>
    <td align=right class="adm_item"><?php echo $LDImmuNote ?>: </td>
    <td class="adm_input"><?php echo $immu['note'] ?><br></td>
  </tr>
  <tr>
    <td align=right class="adm_item"><?php echo $LDImmuApplication ?>: </td>
    <td class="adm_input"><?php echo $immu['application'] ?><br></td>
  </tr>
  <tr>
    <td align=right class="adm_item"><?php echo $LDImmuStatus ?>: </td>
    <td class="adm_input"><?php echo $immu['status'] ?><br></td>
  </tr>
  <tr>
    <td><a href="immunization_update.php<?php echo URL_APPEND.'&retpath='.$retpath.'&immu_id='.$immu['nr']; ?>"><img <?php echo createLDImgSrc($root_path,'update.gif','0') ?> border="0"></a></td>
    <td  align=right><a href="immunization_list.php<?php echo URL_APPEND; ?>"><img <?php echo createLDImgSrc($root_path,'list_all.gif','0') ?> border="0"></a><a href="<?php echo $breakfile; ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?> border="0"></a></td>
  </tr>
</table>
<p>
<form action="immunization_new.php" method="post">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="retpath" value="<?php echo $retpath ?>">
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
