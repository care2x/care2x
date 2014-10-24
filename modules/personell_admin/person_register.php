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
$lang_tables[]='personell.php';
$lang_tables[]='person.php';
define('LANG_FILE','aufnahme.php');
$local_user='aufnahme_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');

$thisfile=basename(__FILE__);
if($update) $breakfile='person_register_show.php'.URL_APPEND.'&pid='.$pid;
	elseif($_COOKIE['ck_login_logged'.$sid]) $breakfile=$root_path.'main/spediens.php'.URL_APPEND;
		else $breakfile='personell_admin_pass.php'.URL_APPEND.'&target='.$target;

if(!isset($_SESSION['sess_pid'])) $_SESSION['sess_pid'] = "";

# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('system_admin');

# Title in toolbar
 $smarty->assign('sToolbarTitle', "$LDPersonnelManagement :: $LDPersonRegister");

 # hide return button
 $smarty->assign('pbBack',FALSE);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('person_reg_newform.php')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',"$LDPersonnelManagement :: $LDPersonRegister");

# Colllect javascript code

ob_start();

?>

<table width=100% border=0 cellspacing="0" cellpadding=0>

<?php

require('./gui_bridge/default/gui_tabs_personell_reg.php');
?>

<tr>
<td colspan=3>

<ul>

<?php

require_once($root_path.'include/care_api_classes/class_gui_input_person.php');

$inperson = & new GuiInputPerson;

$inperson->setPID($pid);
//$inperson->pretext = $sTemp;
$inperson->setDisplayFile('person_register_show.php');

$inperson->display();

?>

</ul>

</td>
</tr>
</table>

<p>
<ul>
<a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?> alt="<?php echo $LDCancelClose ?>"></a>
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
