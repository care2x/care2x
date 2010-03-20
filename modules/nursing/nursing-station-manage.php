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
define('LANG_FILE','nursing.php');
$local_user='ck_pflege_user';
require_once($root_path.'include/inc_front_chain_lang.php');

$breakfile="nursing.php".URL_APPEND;

# Start the smarty templating
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('nursing');

# Added for the common header top block

 $smarty->assign('sToolbarTitle',$LDNursingManage);

 $smarty->assign('pbHelp',"javascript:gethelp('nursing_ward_mng.php','main')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',$LDNursingManage);
 
 # Assign submenu items
 $smarty->assign('LDProfile',$LDProfile);
 $smarty->assign('sCreate',"<a href=\"nursing-station-new.php".URL_APPEND."&mw=1&station=$ck_thispc_station&name=$ck_thispc_dept\"><b>$LDCreate</b></a>");
 $smarty->assign('LDNewStation',$LDNewStation);
 
 if ($ck_thispc_station) $mode="show";
 $smarty->assign('sShowStationData',"<a href=\"nursing-station-info.php".URL_APPEND."&mode=$mode&station=$ck_thispc_station\"><b>$LDShowStationData</b></a>");

 $smarty->assign('LDShowStationDataTxt',$LDShowStationDataTxt);
 
 $smarty->assign('sCancel','<a href="'.$breakfile.'"><img '.createLDImgSrc($root_path,'cancel.gif','0').' border="0"></a>');
/*
# Buffer page output

ob_start();

?>

  <table border=1 cellpadding=5 >
    <tr>
      <td >&nbsp;</td>
      <td bgcolor="#0066aa"><FONT face="Verdana,Helvetica,Arial" size=2 color="#ffffff"><b><?php echo $LDProfile ?></b></td>
      <td >&nbsp;</td>
      <!-- <td bgcolor="#0066aa"><FONT face="Verdana,Helvetica,Arial" size=2 color="#ffffff"><b>Kommunikation</b></td> -->
    </tr>
    <tr>
      <td></td>
      <td valign=top><FONT face="Verdana,Helvetica,Arial" size=2 ><a href="nursing-station-new.php?sid=<?php echo $sid ?>&mw=1<?php echo "&lang=$lang&station=$ck_thispc_station&name=$ck_thispc_dept" ?>"><b><?php echo $LDCreate ?></b></a><br>
	  		&nbsp;<?php echo $LDNewStation ?><p>
			<?php if ($ck_thispc_station) $mode="show"; ?>
			<a href="nursing-station-info.php?sid=<?php echo "$sid&lang=$lang&mode=$mode&station=$ck_thispc_station" ?>"><b><?php echo $LDShowStationData ?></b></a><br>
			<?php echo $LDShowStationDataTxt ?><p>
<!-- 			<a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>"><b><?php echo $LDLockBed ?></b></a><br>
			<?php echo $LDLockBedTxt ?><p>
			<a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>"><b><?php echo $LDAccessRights ?></b></a><br>
			<?php echo $LDAccessRightsTxt ?>
 -->			</td>
      <td></td>
    </tr>
  </table>

<p>
<ul>
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?> border="0"></a>
</ul>

<?php

$sTemp = ob_get_contents();
 ob_end_clean();
*/
# Assign the include file to main frame template

 $smarty->assign('sMainBlockIncludeFile','nursing/ward_manage_submenu.tpl');

 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');

?>
