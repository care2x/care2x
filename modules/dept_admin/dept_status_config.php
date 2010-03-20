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
$lang_tables=array('departments.php');
define('LANG_FILE','edp.php');
$local_user='ck_edv_user';
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/care_api_classes/class_department.php');

$breakfile='dept_list_config.php'.URL_APPEND;

if(!isset($mode)) $mode='';

$dept_obj=new Department;

//$db->debug=1;

if($mode){
			switch($mode){
				
				case 'update':
									$_POST['history']=$dept_obj->ConcatHistory("Update: ".date('Y-m-d H:i:s')." = ".$_SESSION['sess_user_name']."\n");
									$_POST['modify_id']=$_SESSION['sess_user_name'];
									$_POST['modify_time']=date('YmdHis');
									$dept_obj->setTable('care_department');
									$dept_obj->setDataArray($_POST);
									$dept_obj->where=' nr='.$dept_nr;
									if($dept_obj->updateDataFromInternalArray($dept_nr)){
										header("location:dept_status_config.php".URL_REDIRECT_APPEND."&edit=1&updateok=1&dept_nr=$dept_nr");
										exit;
									}else{
										echo "$sql<br>$LDDbNoSave";
									}
									break;
									
			}// end of switch
}

$depttypes=$dept_obj->getTypes();
$dept=$dept_obj->getDeptAllInfo($dept_nr);
extract($dept);

# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('system_admin');

# Title in toolbar
 $smarty->assign('sToolbarTitle',"$LDDept :: $LDStatus");

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('dept_status.php')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',"$LDDept :: $LDStatus");

# Buffer page output

ob_start();

?>

<style type="text/css" name="formstyle">

div.box { border: solid; border-width: thin; width: 100% }
div.pcont{ margin-left: 3; }

</style>

<script language="javascript">
<!-- 

function check(d)
{
	if((d.station.value=="")||(d.name.value=="")||(d.station.start_no=="")||(d.end_no.value==""))
	{
		alert("<?php echo $LDAlertIncomplete ?>");
		return false;
	}
	if(parseInt(d.start_no.value)>=parseInt(d.end_no.value)) 
	{
		alert("<?php echo $LDAlertRoomNr ?>");
		return false;
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
<?php if(isset($updateok)&&$updateok) { 
	$backimg='close2.gif';
?>
<img <?php echo createMascot($root_path,'mascot1_r.gif','0','bottom') ?> align="middle"><font class="prompt">
<?php echo $LDUpdateOk; ?></font>

<?php 
}else{
	$backimg='cancel.gif';
} ?>
&nbsp;
<br>
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2>
<?php 
if(isset($$LD_var)&&$$LD_var) echo $$LD_var;
			else echo $name_formal; 
?></font>

<?php echo $LDEnterAllFields ?>

<form action="dept_status_config.php" method="post" name="newstat">
<table border=0>
<tbody class="submenu">
  <tr>
    <td align=right bgColor="#eeeeee"><?php echo $LDDeptStatus ?>: </td>
    <td>	<input type="radio" name="is_inactive" value="0" <?php if(!$is_inactive) echo 'checked'; ?>> <?php echo $LDActive ?>
    <td>	<input type="radio" name="is_inactive" value="1" <?php if($is_inactive) echo 'checked'; ?>> <?php echo $LDInactive ?>
	</td>
  </tr> 
  <tr>
    <td align=right bgColor="#eeeeee"><?php echo $LDRecordStatus ?>: </td>
    <td>	<input type="radio" name="status" value="visible" <?php if($status!='hidden') echo 'checked'; ?>> <?php echo $LDVisible ?>
    <td>	<input type="radio" name="status" value="hidden" <?php if($status=='hidden') echo 'checked'; ?>> <?php echo $LDHidden ?>
	</td>
  </tr> 
</tbody> 
</table>
<p>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="edit" value="<?php echo $edit ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="mode" value="update">
<input type="hidden" name="dept_nr" value="<?php echo $nr ?>">
<input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0'); ?>>

</form>
<p>

<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,$backimg,'0') ?> border="0"></a>

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
