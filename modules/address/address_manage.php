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
 $smarty->assign('sToolbarTitle',"$LDAddress :: $LDManager");

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('address_manage.php')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',"$LDAddress :: $LDManager");

# Buffer page output

ob_start();
?>

  <p><br>
  
  <table border=0 cellpadding=5>
    <tr>
      <td><!-- <a href="citytown_new.php<?php echo URL_APPEND; ?>"><img <?php  echo createComIcon($root_path,'form_pen.gif','0'); ?>></a> --></td>
      <td>
	  		<a href="citytown_new.php<?php echo URL_APPEND; ?>"><b><font color="#990000"><?php echo $LDNewData; ?></font></b></a><br>
	  		<?php echo $LDNewDataTxt ?></td>
    </tr>
    <tr>
      <td><!-- <a href="citytown_list.php<?php echo URL_APPEND; ?>"><img <?php  echo createComIcon($root_path,'form_pen.gif','0'); ?>></a> --></td>
      <td>
	  		<a href="citytown_list.php<?php echo URL_APPEND; ?>"><b><font color="#990000"><?php echo $LDListAll ?></font></b></a><br>
			<?php echo $LDListAllTxt ?></td>
    </tr>
    <tr>
      <td><!-- <a href="citytown_search.php<?php echo URL_APPEND; ?>"><img <?php  echo createComIcon($root_path,'search_glass.gif','0'); ?>></a> --></td>
      <td>
	  	<a href="citytown_search.php<?php echo URL_APPEND; ?>"><b><font color="#990000"><?php echo $LDSearch ?></font></b></a><br>
			<?php echo $LDSearchTxt ?></td>
    </tr>
  </table>
  
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
