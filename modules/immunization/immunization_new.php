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
define('LANG_FILE','immunization.php');
$local_user='aufnahme_user';
require_once($root_path.'include/inc_front_chain_lang.php');
/* Load the insurance object */
require_once($root_path.'include/care_api_classes/class_immunization.php');
$immu_obj=new Immunization();

//$db->debug=1;

switch($retpath)
{
	case 'list': $breakfile='immunization_list.php'.URL_APPEND; break;
	case 'search': $breakfile='immunization_search.php'.URL_APPEND; break;
	default: $breakfile='immunization_manage.php'.URL_APPEND; 
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
			$_POST['name']=trim($_POST['name']);
			if(!empty($_POST['name'])){
				
				# Check if insurance ID exists
				//TODO : find how to use it..
				if($immu_obj->ImmuExists($_POST['name'])){

				# Notify
					$mode='immu_exists';
				
				}else{
					if($immu_obj->saveImmuInfoFromArray($_POST)){
						$immu_save=$db->Insert_ID();
						$immu_id = $immu_obj->LastInsertPK('nr',$immu_save);
    					header("location:immunization_info.php?sid=$sid&lang=$lang&immu_id=$immu_id&mode=show&save_ok=1&retpath=$retpath");
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
 $smarty->assign('sToolbarTitle',"$LDImmunization :: $LDNewData");

 # href for help button
 $smarty->assign('pbHelp',"ja	vascript:gethelp('immunization_new.php','new')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',"$LDImmunization :: $LDNewData");

# Colllect javascript code

ob_start();

?>

<script language="javascript">
<!-- 
function check(d)
{
	if((d.type.value=="")){
		alert("<?php echo "$LDAlertType \\n $LDPlsEnterInfo"; ?>");
		d.type.select();
		return false;
	}else if((d.name.value=="")){
		alert("<?php echo "$LDAlertName \\n $LDPlsEnterInfo"; ?>");
		d.name.select();
		return false;
	}else if((d.tolerance.value=="")){
		alert("<?php echo "$LDAlertTolerance \\n $LDPlsEnterInfo"; ?>");
		d.tolerance.select();
		return false;
	}else if((d.dose.value=="")){
		alert("<?php echo "$LDAlertDose \\n $LDPlsEnterInfo"; ?>");
		d.dose.select();
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
			echo $LDMissingImmuInfo;
			break;
		}
		case 'immu_exists':
		{
			echo "$LDImmuExists<br>$LDDataNoSave<br>$LDPlsChangeName";
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
<form action="<?php echo $thisfile; ?>" method="post" name="immunization" onSubmit="return check(this)">
<font face="Verdana, Arial" size=-1><?php echo $LDEnterAllFields ?>
<table border=0>
  <tr>
    <td align=right class="adm_item"><font color=#ff0000><b>*</b></font><?php echo $LDImmuType ?>: </td>
    <td class="adm_input"><input type="text" name="type" size=50 maxlength=60 value="<?php echo $type ?>"><br>
</td>
  </tr> 
  <tr>
    <td align=right class="adm_item"><font color=#ff0000><b>*</b></font><?php echo $LDImmuName ?>: </td>
    <td class="adm_input"><input type="text" name="name" size=50 maxlength=60 value="<?php echo $name ?>"><br></td>
  </tr> 
  <tr>
    <td align=right class="adm_item"><font color=#ff0000></font><?php echo $LDImmuPeriod ?>: </td>
    <td class="adm_input"><textarea name="period" cols=40 rows=4 wrap="physical"><?php echo $period ?></textarea></td>
  </tr>
   <tr>
    <td align=right class="adm_item"><font color=#ff0000><b>*</b></font><?php echo $LDImmuTolerance ?>: </td>
    <td class="adm_input"><textarea name="tolerance" cols=40 rows=4 wrap="physical"><?php echo $tolerance ?></textarea></td>
  </tr>
  <tr>
    <td align=right class="adm_item"><font color=#ff0000><b>*</b></font><?php echo $LDImmuDosage ?>: </td>
    <td class="adm_input"><textarea name="dosage" cols=40 rows=4 wrap="physical"><?php echo $dosage ?></textarea></td>
  </tr>
  <tr>
    <td align=right class="adm_item"><?php echo $LDImmuMedicine ?>: </td>
    <td class="adm_input"><input type="text" name="medicine" size=50 maxlength=60 value="<?php echo $medicine ?>"><br></td>
  </tr>
  <tr>
    <td align=right class="adm_item"><?php echo $LDImmuTiter ?>: </td>
    <td class="adm_input"><input type="text" name="titer" size=50 maxlength=60 value="<?php echo $titer ?>"><br></td>
  </tr>
  <tr>
    <td align=right class="adm_item"><?php echo $LDImmuNote ?>: </td>
    <td class="adm_input"><input type="text" name="note" size=50 maxlength=60 value="<?php echo $note ?>"><br></td>
  </tr>
  <tr>
    <td align=right class="adm_item"><?php echo $LDImmuApplication ?>: </td>
    <td class="adm_input"><input type="text" name="application" size=50 maxlength=60 value="<?php echo $application ?>"><br></td>
  </tr>
  <tr>
    <td align=right class="adm_item"><?php echo $LDImmuStatus ?>: </td>
    <td class="adm_input"><input type="text" name="status" size=50 maxlength=60 value="<?php echo $status ?>"><br></td>
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
