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
$lang_tables[]='startframe.php';
define('LANG_FILE','edp.php');
$local_user='ck_edv_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');

$breakfile='edv-system-admi-welcome.php'.URL_APPEND;
$thisfile=basename(__FILE__);

$GLOBAL_CONFIG=array();
require_once($root_path.'include/care_api_classes/class_globalconfig.php');
$glob_obj=new GlobalConfig($GLOBAL_CONFIG);

# Save data if save mode
if(isset($mode) && $mode=='save'){
	$glob_obj->saveConfigArray($_POST,'pagin_',TRUE,20);
	header("location:$thisfile".URL_REDIRECT_APPEND."&save_ok=1");
	exit;
# Else get current global data
}else{ 
	$glob_obj->getConfig('pagin_%');
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
 $smarty->assign('sToolbarTitle',$LDPaginatorMaxRows);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('paginator_maxrows_config.php')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',$LDPaginatorMaxRows);

# Buffer page output

ob_start();

?>

<ul>
<FONT class="prompt"><p>
<?php
if(isset($save_ok) && $save_ok) echo '<img '.createMascot($root_path,'mascot1_r.gif','0','absmiddle').'>'.$LDDataSaved.'<p>';

echo $LDEnterMaxRows;
?></font><p>

<form action="<?php echo $thisfile ?>" method="post" name="quickinfo">
<table border=0 cellspacing=1 cellpadding=5>  
<tr>
	<td class="adm_item"><FONT  color="#0000cc"><?php echo "<b>$LDAddressList</b><br><font color=#000000>$LDAddressListTxt</font><br>" ?></FONT></td>
	<td class="adm_input"><input type="text" name="pagin_address_list_max_block_rows" size=2 maxlength=2 value="<?php echo $GLOBAL_CONFIG['pagin_address_list_max_block_rows'] ?>">
      </td>  
	</tr>
<tr>
	<td class="adm_item"><FONT  color="#0000cc"><?php echo "<b>$LDAddressSearch</b><br><font color=#000000>$LDAddressSearchTxt</font><br>" ?></FONT></td>
	<td class="adm_input"><input type="text" name="pagin_address_search_max_block_rows" size=2 maxlength=2 value="<?php echo $GLOBAL_CONFIG['pagin_address_search_max_block_rows'] ?>">
      </td>  
	</tr>
<tr>
	<td class="adm_item"><FONT  color="#0000cc"><?php echo "<b>$LDInsuranceList</b><br><font color=#000000>$LDInsuranceListTxt</font><br>" ?></FONT></td>
	<td class="adm_input"><input type="text" name="pagin_insurance_list_max_block_rows" size=2 maxlength=2 value="<?php echo $GLOBAL_CONFIG['pagin_insurance_list_max_block_rows'] ?>">
      </td>  
	</tr>
<tr>
	<td class="adm_item"><FONT  color="#0000cc"><?php echo "<b>$LDInsuranceSearch</b><br><font color=#000000>$LDInsuranceSearchTxt</font><br>" ?></FONT></td>
	<td class="adm_input"><input type="text" name="pagin_insurance_search_max_block_rows" size=2 maxlength=2 value="<?php echo $GLOBAL_CONFIG['pagin_insurance_search_max_block_rows'] ?>">
      </td>  
	</tr>
<tr>
	<td class="adm_item"><FONT  color="#0000cc"><?php echo "<b>$LDPersonnelList</b><br><font color=#000000>$LDPersonnelListTxt</font><br>" ?></FONT></td>
	<td class="adm_input"><input type="text" name="pagin_personell_list_max_block_rows" size=2 maxlength=2 value="<?php echo $GLOBAL_CONFIG['pagin_personell_list_max_block_rows'] ?>">
      </td>  
	</tr>
<tr>
	<td class="adm_item"><FONT  color="#0000cc"><?php echo "<b>$LDPersonnelSearch</b><br><font color=#000000>$LDPersonnelSearchTxt</font><br>" ?></FONT></td>
	<td class="adm_input"><input type="text" name="pagin_personell_search_max_block_rows" size=2 maxlength=2 value="<?php echo $GLOBAL_CONFIG['pagin_personell_search_max_block_rows'] ?>">
      </td>  
	</tr>
<tr>
	<td class="adm_item"><FONT  color="#0000cc"><?php echo "<b>$LDPersonSearch</b><br><font color=#000000>$LDPersonSearchTxt</font><br>" ?></FONT></td>
	<td class="adm_input"><input type="text" name="pagin_person_search_max_block_rows" size=2 maxlength=2 value="<?php echo $GLOBAL_CONFIG['pagin_person_search_max_block_rows'] ?>">
      </td>  
	</tr>
<tr>
	<td class="adm_item"><FONT  color="#0000cc"><?php echo "<b>$LDPatientSearch</b><br><font color=#000000>$LDPatientSearchTxt</font><br>" ?></FONT></td>
	<td class="adm_input"><input type="text" name="pagin_patient_search_max_block_rows" size=2 maxlength=2 value="<?php echo $GLOBAL_CONFIG['pagin_patient_search_max_block_rows'] ?>">
      </td>  
	</tr>
<tr>
	<td class="adm_item"><FONT  color="#0000cc"><?php echo "<b>$LDORPatientSearch</b><br><font color=#000000>$LDORPatientSearchTxt</font><br>" ?></FONT></td>
	<td class="adm_input"><input type="text" name="pagin_or_patient_search_max_block_rows" size=2 maxlength=2 value="<?php echo $GLOBAL_CONFIG['pagin_or_patient_search_max_block_rows'] ?>">
      </td>  
	</tr>
</table>
<p>
<?php if($item_no) $save_button='update.gif'; else $save_button='savedisc.gif'; ?>
<input type="image" <?php echo createLDImgSrc($root_path,$save_button,'0') ?>>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?>></a>
<?php if($item_no) : ?>
<a href="<?php echo $thisfile.''.URL_APPEND.'&from='.$from ?>"><img <?php echo createLDImgSrc($root_path,'newcurrency.gif','0') ?>></a>
<?php endif ?>
<input type="hidden" name="sid" value="<?php echo $sid;?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="mode" value="save">
</form>
<p>
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
