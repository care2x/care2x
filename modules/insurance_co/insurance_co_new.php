<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.2 - 2006-07-10
* GNU General Public License
* Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','finance.php');
$local_user='aufnahme_user';
require_once($root_path.'include/inc_front_chain_lang.php');
/* Load the insurance object */
require_once($root_path.'include/care_api_classes/class_insurance.php');
$ins_obj=new Insurance;

//$db->debug=1;

switch($retpath)
{
	case 'list': $breakfile='insurance_co_list.php'.URL_APPEND; break;
	case 'search': $breakfile='insurance_co_search.php'.URL_APPEND; break;
	default: $breakfile='insurance_co_manage.php'.URL_APPEND; 
}

if(!isset($mode)){
	$mode='';
	$edit=true;		
}else{
	switch($mode)
	{
		case 'save':
		{
			//$db->debug=true;
			/* Validate important data */
			$_POST['firm_id']=trim($_POST['firm_id']);
			$_POST['name']=trim($_POST['name']);
			if(!(empty($_POST['firm_id'])||empty($_POST['name']))){
				
				# Check if insurance ID exists
				if($ins_obj->FirmIDExists($_POST['firm_id'])){

				# Notify
					$mode='firm_exists';
				
				}else{
					if($ins_obj->saveFirmInfoFromArray($_POST)){
    					header("location:insurance_co_info.php?sid=$sid&lang=$lang&firm_id=$firm_id&mode=show&save_ok=1&retpath=$retpath");
						exit;
					}else{echo "$sql<br>$LDDbNoSave";}
				}
			}else{
					$mode='bad_data';
			}
			break;
		}
	} // end of switch($mode)
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
 $smarty->assign('sToolbarTitle',"$LDInsuranceCo :: $LDNewData");

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('insurance_new.php','new')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',"$LDInsuranceCo :: $LDNewData");

# Colllect javascript code

ob_start();

?>

<script language="javascript">
<!-- 
function check(d)
{
	if((d.firm_id.value=="")){
		alert("<?php echo "$LDAlertFirmID \\n $LDPlsEnterInfo"; ?>");
		d.firm_id.select();
		return false;
	}else if((d.name.value=="")){
		alert("<?php echo "$LDAlertFirmName \\n $LDPlsEnterInfo"; ?>");
		d.name.select();
		return false;
	}else if((d.addr_mail.value=="")){
		alert("<?php echo "$LDAlertMailingAddress \\n $LDPlsEnterInfo"; ?>");
		d.addr_mail.select();
		return false;
	}else if((d.addr_billing.value=="")){
		alert("<?php echo "$LDAlertBillingAddress \\n $LDPlsEnterInfo"; ?>");
		d.addr_billing.select();
		return false;
	}else{
		return true;
	}
}
// -->
</script>

<?php

$sTemp = ob_get_contents();
ob_end_clean();

$smarty->append('JavaScript',$sTemp);

# Buffer page output

ob_start();

?>

 <ul>
<?php
if(!empty($mode)){ 
?>
<table border=0>
  <tr>
    <td><img <?php echo createMascot($root_path,'mascot1_r.gif','0','bottom') ?>></td>
    <td valign="bottom"><br><font face="Verdana, Arial" size=3 color="#880000"><b>
<?php 
	switch($mode)
	{
		case 'bad_data':
		{
			echo $LDMissingFirmInfo;
			break;
		}
		case 'firm_exists':
		{
			echo "$LDFirmExists<br>$LDDataNoSave<br>$LDPlsChangeFirmID";
		}
	}
?>
	</b></font><p>
</td>
  </tr>
</table>
<?php 
} 
?>
<form action="<?php echo $thisfile; ?>" method="post" name="insurance_co" onSubmit="return check(this)">
<font face="Verdana, Arial" size=-1><?php echo $LDEnterAllFields ?>
<table border=0>
  <tr>
    <td align=right class="adm_item"><font color=#ff0000><b>*</b></font><?php echo $LDInsuranceCoID ?>: </td>
    <td class="adm_input"><input type="text" name="firm_id" size=50 maxlength=60 value="<?php echo $firm_id ?>"><br>
</td>
  </tr> 
  <tr>
    <td align=right class="adm_item"><font color=#ff0000><b>*</b></font><?php echo $LDInsuranceCoName ?>: </td>
    <td class="adm_input"><input type="text" name="name" size=50 maxlength=60 value="<?php echo $name ?>"><br></td>
  </tr> 
  <tr>
    <td align=right class="adm_item"><font color=#ff0000></font><?php echo $LDAddress ?>: </td>
    <td class="adm_input"><textarea name="addr" cols=40 rows=4 wrap="physical"><?php echo $addr ?></textarea></td>
  </tr>
   <tr>
    <td align=right class="adm_item"><font color=#ff0000><b>*</b></font><?php echo $LDMailingAddress ?>: </td>
    <td class="adm_input"><textarea name="addr_mail" cols=40 rows=4 wrap="physical"><?php echo $addr_mail ?></textarea></td>
  </tr>
  <tr>
    <td align=right class="adm_item"><font color=#ff0000><b>*</b></font><?php echo $LDBillingAddress ?>: </td>
    <td class="adm_input"><textarea name="addr_billing" cols=40 rows=4 wrap="physical"><?php echo $addr_billing ?></textarea></td>
  </tr>
  <tr>
    <td align=right class="adm_item"><?php echo $LDEmailAddress ?>: </td>
    <td class="adm_input"><input type="text" name="addr_email" size=50 maxlength=60 value="<?php echo $addr_email ?>"><br></td>
  </tr>
  <tr>
    <td align=right class="adm_item"><?php echo $LDMainPhoneNr ?>: </td>
    <td class="adm_input"><input type="text" name="phone_main" size=50 maxlength=60 value="<?php echo $phone_main ?>"><br></td>
  </tr>
  <tr>
    <td align=right class="adm_item"><?php echo $LDAuxPhoneNr ?>: </td>
    <td class="adm_input"><input type="text" name="phone_aux" size=50 maxlength=60 value="<?php echo $phone_aux ?>"><br></td>
  </tr>
  <tr>
    <td align=right class="adm_item"><?php echo $LDMainFaxNr ?>: </td>
    <td class="adm_input"><input type="text" name="fax_main" size=50 maxlength=60 value="<?php echo $fax_main ?>"><br></td>
  </tr>
  <tr>
    <td align=right class="adm_item"><?php echo $LDAuxFaxNr ?>: </td>
    <td class="adm_input"><input type="text" name="fax_aux" size=50 maxlength=60 value="<?php echo $fax_aux ?>"><br></td>
  </tr>
  <tr>
    <td align=right class="adm_item"><?php echo $LDContactPerson ?>: </td>
    <td class="adm_input"><input type="text" name="contact_person" size=50 maxlength=60 value="<?php echo $contact_person ?>"><br></td>
  </tr>
  <tr>
    <td align=right class="adm_item"><?php echo $LDContactPersonEmailAddr ?>: </td>
    <td class="adm_input"><input type="text" name="contact_email" size=50 maxlength=60 value="<?php echo $contact_email ?>"><br></td>
  </tr>
  <tr>
    <td align=right class="adm_item"><?php echo $LDContactPersonPhoneNr ?>: </td>
    <td class="adm_input"><input type="text" name="contact_phone" size=50 maxlength=60 value="<?php echo $contact_phone ?>"><br></td>
  </tr>
  <tr>
    <td align=right class="adm_item"><?php echo $LDContactPersonFaxNr ?>: </td>
    <td class="adm_input"><input type="text" name="contact_fax" size=50 maxlength=60 value="<?php echo $contact_fax ?>"><br></td>
  </tr>
  <tr>
    <td><input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0'); ?>></td>
    <td  align=right><a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?> border="0"></a></td>
  </tr>
</table>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="mode" value="save">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="retpath" value="<?php echo $retpath ?>">
</form>
<p>

</FONT>
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
