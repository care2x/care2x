<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System version deployment 1.1 (mysql) 2004-01-11
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* , elpidio@care2x.org
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables=array('departments.php');
define('LANG_FILE','edp.php');
$local_user='ck_edv_user';
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/care_api_classes/class_department.php');

//$breakfile='dept_manage.php'.URL_APPEND;
$breakfile=$root_path.'modules/system_admin/edv-system-admi-welcome.php'.URL_APPEND	;

if($pday=='') $pday=date('d');
if($pmonth=='') $pmonth=date('m');
if($pyear=='') $pyear=date('Y');
$t_date=$pday.'.'.$pmonth.'.'.$pyear;

$dept_obj=new Department;
///$db->debug=true;
$deptarray=$dept_obj->getAllNoCondition('name_formal');

# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common');

# Title in toolbar
 $smarty->assign('sToolbarTitle',"$LDDepartment :: $LDList");

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('dept_config.php')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',"$LDDepartment :: $LDList");

 # Buffer page output
 ob_start();

?>

<style type="text/css" name="formstyle">

td.pblock{ font-family: verdana,arial; font-size: 12}
div.box { border: solid; border-width: thin; width: 100% }
div.pcont{ margin-left: 3; }

</style>

<?php 

$sTemp = ob_get_contents();
ob_end_clean();

$smarty->append('JavaScript',$sTemp);

# Buffer page output
ob_start();

?>

 <ul>

<?php echo $LDEnterAllFields ?>

<table border=0>
  <tr class="wardlisttitlerow">
<!-- 	<td bgcolor="#e9e9e9"></td>
 -->    
 	<td class=pblock align=center><?php echo $LDDept ?></td>
    <td class=pblock align=center><?php echo $LDDeptStatus ?></td>
    <td class=pblock align=center><?php echo $LDRecordStatus ?></td>
    <td class=pblock align=center></td>
 </tr> 
  
<?php
while(list($x,$v)=each($deptarray)){
?>
  <tr>
	<td bgcolor="#e9e9e9"><img <?php echo createComIcon($root_path,'arrow_blueW.gif','0'); ?>></td>
    
 	<td class=pblock  bgColor="#eeeeee"><a href="dept_info.php<?php echo URL_APPEND."&dept_nr=".$v['nr']; ?>">
	<?php 
		if(isset($$v['LD_var'])&&$$v['LD_var']) echo $$v['LD_var'];
			else echo $v['name_formal']; 
	?></a> </td>
    <td class=pblock  bgColor="#eeeeee"><?php if($v['is_inactive']) echo '<font color="red">'.$LDInactive.'</font>'; else echo $LDActive ?> 
[<a href="dept_status.php<?php echo URL_APPEND; ?>&nr=<?PHP echo $v['nr']."&active=".$v['is_inactive']; ?>">x</a>]
</td>
    <td class=pblock  bgColor="#eeeeee"><?php if($v['status']=='hidden') echo '<font color="red">'.$LDHidden.'</font>'; else echo $LDVisible ?> 
[<a href="dept_status.php<?php echo URL_APPEND; ?>&nr=<?PHP echo $v['nr']; ?>&status=<?PHP if($v['status']=='hidden') echo 'visible'; else echo "hidden"; ?>">x</a>]
</td>
 	<td class=pblock  bgColor="#eeeeee"><a href="dept_status_config.php<?php echo URL_APPEND."&dept_nr=".$v['nr']; ?>"><?php echo $LDChange; ?></a> </td>
 </tr> 
<?php
}
 ?>
 
</table>

<p>

<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?> border="0"></a>

</ul>
<?php

$sTemp = ob_get_contents();
 ob_end_clean();

# Assign the data  to the main frame template

 $smarty->assign('sMainFrameBlockData',$sTemp);

 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');

?>
