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
$lang_tables=array('departments.php');
define('LANG_FILE','edp.php');
$local_user='ck_edv_user';
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_date_format_functions.php');
require_once($root_path.'include/care_api_classes/class_oproom.php');

//$breakfile='dept_manage.php'.URL_APPEND;
$breakfile=$root_path.'modules/system_admin/edv-system-admi-welcome.php'.URL_APPEND	;

if($pday=='') $pday=date('d');
if($pmonth=='') $pmonth=date('m');
if($pyear=='') $pyear=date('Y');
$t_date=$pday.'.'.$pmonth.'.'.$pyear;

# Create the OR object
$OR_obj=& new OPRoom;
# Get all OR
$OR_rooms=$OR_obj->AllORInfo();
# Get the number or returned ORs
$rows=$OR_obj->LastRecordCount();

# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common');

# Title in toolbar
 $smarty->assign('sToolbarTitle',"$LDOR :: $LDListConfig");

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('or_config.php')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',"$LDOR :: $LDListConfig");

# Buffer page output
ob_start();

?>

<table border=0>
<tbody class="submenu">
  <tr class="wardlisttitlerow">
<!-- 	<td bgcolor="#e9e9e9"></td>
 -->    
 	<td align=center><?php echo $LDORNr ?></td>
 	<td align=center><?php echo $LDORName ?></td>
 	<td align=center><?php echo $LDOPTable ?></td>
    <td align=center><?php echo $LDTempClosed ?></td>
<!--     <td align=center><?php echo $LDStatus ?></td>
 --> 	<td align=center><?php echo $LDDateCreation ?></td>
    <td align=center><?php echo $LDOwnerWard ?></td>
    <td  align=center><?php echo $LDOwnerDept ?></td>
 </tr>
  
<?php
if(is_object($OR_rooms)){

	while($ORoom=$OR_rooms->FetchRow()){
?>
  <tr>
 	<td align=center><a href="or_info.php<?php echo URL_APPEND."&nr=".$ORoom['nr']."&OR_nr=".$ORoom['room_nr']; ?>">
	<?php 
		 echo $ORoom['room_nr']; 
	?></a> </td>
    <td>
<?php
	if(!empty($ORoom['info'])){
	?>
	<a href="or_info.php<?php echo URL_APPEND."&nr=".$ORoom['nr']."&OR_nr=".$ORoom['room_nr']; ?>">
	<?php
	}
	 echo $ORoom['info'];
	if(!empty($ORoom['info'])) echo '</a>';
	 ?></td>
    <td  align=center><?php echo $ORoom['nr_of_beds'] ?> </td>
    <td><?php
	 if($ORoom['is_temp_closed']=='1'){
	 	echo '<font color="red">'.$LDYes.'</font>'; 
	 }else{
		echo $LDNo;
	}
	echo '&nbsp;&nbsp;&nbsp;&nbsp;';
	echo '<a href="or_new.php'.URL_APPEND.'&mode=select&nr='.$ORoom['nr'].'&OR_nr='.$ORoom['room_nr'].'">';
	echo $LDChange;
	 ?></a> </td>
<!--     <td><?php if($ORoom['status']=='inactive') echo '<font color="red">'.$LDInactive.'</font>'; else echo $LDNormal ?> </td>
 -->    <td><?php  echo formatDate2Local($ORoom['date_create'],$date_format) ?> </td>
    <td><?php echo  $ORoom['ward_id'] ?> </td>
    <td>
	<?php 
	
		$buf=$ORoom['LD_var'];
		if(!empty($buf)&&isset($$buf)&&!empty($$buf)) echo $$buf;
			else echo $ORoom['deptshort'];
	?> </td>
 </tr> 
<?php
	}
}
 ?>
</tbody>
</table>

<p>

<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?> border="0"></a>

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
