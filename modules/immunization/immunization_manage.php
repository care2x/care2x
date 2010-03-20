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

$breakfile=$root_path."main/spediens.php".URL_APPEND;

# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('system_admin');

# Title in toolbar
 $smarty->assign('sToolbarTitle',"$LDImmunization :: $LDManager");

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('immunization_manage.php','main')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',"$LDImmunization :: $LDManager");

# Buffer page output

ob_start();
?>

  <p><br>
  <table border=0 cellpadding=5 >
    <tr>
      <td></td>
      <td valign=top><FONT face="Verdana,Helvetica,Arial" size=2 >
	  		<a href="immunization_new.php<?php echo URL_APPEND; ?>"><b><?php echo $LDNewData; ?></b></a><br>
	  		&nbsp;<?php echo $LDNewDataTxt ?>
			<p>
			<a href="immunization_list.php<?php echo URL_APPEND; ?>"><b><?php echo $LDListAll ?></b></a><br>
			&nbsp;<?php echo $LDListAllTxt ?>
			<p>
			<a href="immunization_search.php<?php echo URL_APPEND; ?>"><b><?php echo $LDSearch ?></b></a><br>
			&nbsp;<?php echo $LDSearchTxt ?>
			<p>
		</td>
      <td></td>
    </tr>
  </table>
  
</FONT>
<p>
<ul>
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> border="0"></a>
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
