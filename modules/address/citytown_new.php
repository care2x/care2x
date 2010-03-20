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
define('LANG_FILE','place.php');
$local_user='aufnahme_user';
require_once($root_path.'include/inc_front_chain_lang.php');
# Load the insurance object
require_once($root_path.'include/care_api_classes/class_address.php');
$address_obj=new Address;

//$db->debug=1;

switch($retpath)
{
	case 'list': $breakfile='citytown_list.php'.URL_APPEND; break;
	case 'search': $breakfile='citytown_search.php'.URL_APPEND; break;
	default: $breakfile='address_manage.php'.URL_APPEND; 
}

if(!isset($mode)){
	$mode='';
	$edit=true;		
}else{
	switch($mode)
	{
		case 'save':
		{
			#
			# Validate important data
			#
			$_POST['name']=trim($_POST['name']);
			if(!empty($_POST['name'])){
				#
				# Check if address exists
				#
				if($address_obj->CityTownExists($_POST['name'],$_POST['iso_country_id'])){
					#
					# Do notification
					#
					$mode='citytown_exists';
				}else{
					if($address_obj->saveCityTownInfoFromArray($_POST)){
						#
						# Get the last insert ID
						#
						$insid=$db->Insert_ID();
						#
						# Resolve the ID to the primary key
						#
						$nr=$address_obj->LastInsertPK('nr',$insid);

    					header("location:citytown_info.php?sid=$sid&lang=$lang&nr=$nr&mode=show&save_ok=1&retpath=$retpath");
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

# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('system_admin');

# Title in toolbar
 $smarty->assign('sToolbarTitle',"$LDAddress :: $LDNewCityTown");

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('address_new.php')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',"$LDAddress :: $LDNewCityTown");

# Coller Javascript code

ob_start();
?>

<script language="javascript">
<!-- 
function check(d)
{
	if((d.name.value=="")){
		alert("<?php echo "$LDAlertNoCityTownName \\n $LDPlsEnterInfo"; ?>");
		d.name.focus();
		return false;
	}else if(d.iso_country_id.value==""){
		alert("<?php echo $LDEnterISOCountryCode.'\n'.$LDEnterQMark; ?>");
		d.iso_country_id.focus();
		return false;
	}else if(isNaN(d.unece_locode_type.value)){
		alert("<?php echo $LDWrongUneceLocCode.'\n'.$LDEnterZero; ?>");
		d.unece_locode_type.focus();
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
&nbsp;<br>

<form action="<?php echo $thisfile; ?>" method="post" name="citytown" onSubmit="return check(this)">
<font face="Verdana, Arial" size=-1><?php echo $LDEnterAllFields ?>
<table border=0>
  <tr>
    <td align=right class="adm_item"><font color=#ff0000><b>*</b></font> <?php echo $LDCityTownName ?>: </td>
    <td class="adm_input"><input type="text" name="name" size=50 maxlength=60 value="<?php echo $name ?>"><br>
</td>
  </tr> 
  <!-- gjergji added zip code -->
  <tr>
    <td align=right class="adm_item"><font color=#ff0000><b>*</b></font><?php echo $LDZipCode ?>: </td>
    <td class="adm_input"><input type="text" name="zip_code" size=50 maxlength=5 value="<?php echo $zip_code ?>"><br></td>
  </tr>  
  <!-- end:gjergji added zip code -->   
  <tr>
    <td align=right class="adm_item"><?php echo $LDISOCountryCode ?>: </td>
    <td class="adm_input"><input type="text" name="iso_country_id" size=50 maxlength=3 value="<?php echo $iso_country_id ?>"><br></td>
  </tr> 
  <tr>
    <td align=right class="adm_item"><?php echo $LDUNECELocalCode ?>: </td>
    <td class="adm_input"><input type="text" name="unece_locode" size=50 maxlength=60 value="<?php echo $unece_locode ?>"><br></td>
  </tr>
  <tr>
    <td align=right class="adm_item"><?php echo $LDUNECEModifier ?>: </td>
    <td class="adm_input"><input type="text" name="unece_modifier" size=50 maxlength=60 value="<?php echo $unece_modifier ?>"><br></td>
  </tr>
  <tr>
    <td align=right class="adm_item"><?php echo $LDUNECELocalCodeType ?>: </td>
    <td class="adm_input"><input type="text" name="unece_locode_type" size=50 maxlength=60 value="<?php echo $unece_locode_type ?>"><br></td>
  </tr>
  <tr>
    <td align=right class="adm_item"><?php echo $LDUNECECoordinates ?>: </td>
    <td class="adm_input"><input type="text" name="unece_coordinates" size=50 maxlength=60 value="<?php echo $unece_coordinates ?>"><br></td>
  </tr>
  <tr>
    <td align=right class="adm_item"><?php echo $LDWebsiteURL ?>: </td>
    <td class="adm_input"><input type="text" name="info_url" size=50 maxlength=60 value="<?php echo $info_url ?>"><br></td>
  </tr>
  <tr>
    <td class=pblock><input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0'); ?>></td>
    <td  align=right><a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?> border="0"></a></td>
  </tr>
</table>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="mode" value="save">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="retpath" value="<?php echo $retpath ?>">
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
