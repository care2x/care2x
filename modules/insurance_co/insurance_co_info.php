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
define('LANG_FILE','finance.php');
$local_user='aufnahme_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');
# Load the insurance object
require_once($root_path.'include/care_api_classes/class_insurance.php');
$ins_obj=new Insurance;

switch($retpath)
{
	case 'list': $breakfile='insurance_co_list.php'.URL_APPEND; break;
	case 'search': $breakfile='insurance_co_search.php'.URL_APPEND; break;
	default: $breakfile='insurance_co_manage.php'.URL_APPEND; 
}

if(isset($firm_id) && $firm_id&&($row=$ins_obj->getFirmInfo($firm_id))){
	$firm=$row->FetchRow();
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
 $smarty->assign('sToolbarTitle',"$LDInsuranceCo :: $LDData");

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('insurance_info.php')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',"$LDInsuranceCo :: $LDData");

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
 	echo $LDFirmInfoSaved;
?>
</b></font>
<?php 
} 
?>
<table border=0 cellpadding=4 >
  <tr>
    <td align=right class="adm_item"></font><?php echo $LDInsuranceCoID ?>: </td>
    <td class="adm_input"><?php echo $firm['firm_id'] ?><br>
</td>
  </tr> 
  <tr>
    <td align=right class="adm_item"></font><?php echo $LDInsuranceCoName ?>: </td>
    <td class="adm_input"><?php echo $firm['name'] ?><br></td>
  </tr> 
  <tr>
    <td align=right class="adm_item"><font color=#ff0000></font><?php echo $LDAddress ?>: </td>
    <td class="adm_input"><?php echo nl2br($firm['addr']); ?></td>
  </tr>
   <tr>
    <td align=right class="adm_item"></font><?php echo $LDMailingAddress ?>: </td>
    <td class="adm_input"><?php echo nl2br($firm['addr_mail']); ?></td>
  </tr>
  <tr>
    <td align=right class="adm_item"></font><?php echo $LDBillingAddress ?>: </td>
    <td class="adm_input"><?php echo nl2br($firm['addr_billing']); ?></td>
  </tr>
  <tr>
    <td align=right class="adm_item"><?php echo $LDEmailAddress ?>: </td>
    <td class="adm_input"><a href="mailto:<?php echo $firm['addr_email']; ?>"><?php echo $firm['addr_email'] ?></a><br></td>
  </tr>
  <tr>
    <td align=right class="adm_item"><?php echo $LDMainPhoneNr ?>: </td>
    <td class="adm_input"><?php echo $firm['phone_main'] ?><br></td>
  </tr>
  <tr>
    <td align=right class="adm_item"><?php echo $LDAuxPhoneNr ?>: </td>
    <td class="adm_input"><?php echo $firm['phone_aux'] ?><br></td>
  </tr>
  <tr>
    <td align=right class="adm_item"><?php echo $LDMainFaxNr ?>: </td>
    <td class="adm_input"><?php echo $firm['fax_main'] ?><br></td>
  </tr>
  <tr>
    <td align=right class="adm_item"><?php echo $LDAuxFaxNr ?>: </td>
    <td class="adm_input"><?php echo $firm['fax_aux'] ?><br></td>
  </tr>
  <tr>
    <td align=right class="adm_item"><?php echo $LDContactPerson ?>: </td>
    <td class="adm_input"><?php echo $firm['contact_person'] ?><br></td>
  </tr>
  <tr>
    <td align=right class="adm_item"><?php echo $LDContactPersonEmailAddr ?>: </td>
    <td class="adm_input"><a href="mailto:<?php echo $firm['contact_email']; ?>"><?php echo $firm['contact_email'] ?></a><br></td>
  </tr>
  <tr>
    <td align=right class="adm_item"><?php echo $LDContactPersonPhoneNr ?>: </td>
    <td class="adm_input"><?php echo $firm['contact_phone'] ?><br></td>
  </tr>
  <tr>
    <td align=right class="adm_item"><?php echo $LDContactPersonFaxNr ?>: </td>
    <td class="adm_input"><?php echo $firm['contact_fax'] ?><br></td>
  </tr>
  <tr>
    <td><a href="insurance_co_update.php<?php echo URL_APPEND.'&retpath='.$retpath.'&firm_id='.$firm['firm_id']; ?>"><img <?php echo createLDImgSrc($root_path,'update.gif','0') ?> border="0"></a></td>
    <td  align=right><a href="insurance_co_list.php<?php echo URL_APPEND; ?>"><img <?php echo createLDImgSrc($root_path,'list_all.gif','0') ?> border="0"></a><a href="<?php echo $breakfile; ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?> border="0"></a></td>
  </tr>
</table>
<p>
<form action="insurance_co_new.php" method="post">
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
