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
define('LANG_FILE','place.php');
$local_user='aufnahme_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');
# Load the insurance object
require_once($root_path.'include/care_api_classes/class_address.php');
$address_obj=new Address;

switch($retpath)
{
	case 'list': $breakfile='citytown_list.php'.URL_APPEND; break;
	case 'search': $breakfile='citytown_search.php'.URL_APPEND; break;
	default: $breakfile='citytown_manage.php'.URL_APPEND; 
}

if(isset($nr)&&$nr){
	if(isset($mode)&&$mode=='update'){
		if($address_obj->updateCityTownInfoFromArray($nr,$_POST)){
    		header("location:citytown_info.php?sid=$sid&lang=$lang&nr=$nr&mode=show&save_ok=1&retpath=$retpath");
			exit;
		}else{
			echo $address_obj->getLastQuery();
			$mode='bad_data';
		}	
	}elseif($row=$address_obj->getCityTownInfo($nr)){
		if(is_object($row)){
			$address=$row->FetchRow();
			# Globalize the array values
			extract($address);
		}
	}
}else{
	// Redirect to search function
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
 $smarty->assign('sToolbarTitle',"$LDAddress :: $LDUpdateData");

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('address_update.php')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',"$LDAddress :: $LDUpdateData");

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
    <td valign="bottom"><br><font class="warnprompt"><b>
<?php 
	switch($mode)
	{
		case 'bad_data':
		{
			echo $LDAlertNoCityTownName;
			break;
		}
		case 'citytown_exists':
		{
			echo "$LDCityTownExists<br>$LDDataNoSave";
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
<script language="javascript">
<!--
function check(d)
{
	if(d.iso_country_id.value==""){
		alert("<?php echo $LDEnterISOCountryCode.'\n'.$LDEnterQMark; ?>");
		d.iso_country_id.focus();
		return false;
	}else if(isNaN(d.unece_locode_type.value)){
		alert("UNECE location code type accepts only numbers between 0 and 99.\nIf you do not know the value please enter 0.");
		return false;
	}else{
		return true;
	}
}
// -->
</script>

<form action="<?php echo $thisfile; ?>" method="post" name="citytown"  onSubmit="return check(this)">
<table border=0>
  <tr>
    <td align=right class="adm_item"><?php echo $LDCityTownName ?>: </td>
    <td class="adm_input"><?php echo $name ?><br></td>
  </tr> 
  <!-- apmuthu added zip code -->
  <tr>
    <td align=right class="adm_item"><font color=#ff0000><b>*</b></font><?php echo $LDZipCode ?>: </td>
    <td class="adm_input"><input type="text" name="zip_code" size=50 maxlength=15 value="<?php echo $zip_code ?>"><br></td>
  </tr>  
  <!-- end:apmuthu added zip code  -->   
  <tr>
    <td align=right class="adm_item"><font color=#ff0000><b>*</b></font><?php echo $LDISOCountryCode ?>: </td>
    <td class="adm_input"><input type="text" name="iso_country_id" size=50 maxlength=3 value="<?php echo $iso_country_id ?>"><br></td>
  </tr> 
  <tr>
    <td align=right class="adm_item"><?php echo $LDWebsiteURL ?>: </td>
    <td class="adm_input"><input type="text" name="info_url"  size=50 maxlength=60 value="<?php echo $info_url ?>"></td>
  </tr>
   <tr>
    <td align=right class="adm_item"><?php echo $LDUNECELocalCode ?>: </td>
    <td class="adm_input"><input type="text" name="unece_locode"  size=50 maxlength=60 value="<?php echo $unece_locode ?>"></td>
  </tr>
  <tr>
    <td align=right class="adm_item"><?php echo $LDUNECEModifier ?>: </td>
    <td class="adm_input"><input type="text" name="unece_modifier"   size=50 maxlength=2 value="<?php echo $unece_modifier ?>"></td>
  </tr>
  <tr>
    <td align=right class="adm_item"><?php echo $LDUNECELocalCodeType ?>: </td>
    <td class="adm_input"><input type="text" name="unece_locode_type" size=50 maxlength=60 value="<?php echo $unece_locode_type ?>"></td>
  </tr>
  <tr>
    <td align=right class="adm_item"><?php echo $LDUNECECoordinates ?>: </td>
    <td class="adm_input"><input type="text" name="unece_coordinates" size=50 maxlength=60 value="<?php echo $unece_coordinates ?>"><br></td>
  </tr>
  <tr>
    <td><input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0'); ?>></td>
    <td  align=right><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?>></a></td>
  </tr>
</table>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="mode" value="update">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="nr" value="<?php echo $nr ?>">
<input type="hidden" name="name" value="<?php echo $name ?>">
<input type="hidden" name="retpath" value="<?php echo $retpath ?>">
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
