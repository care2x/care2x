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
$lang_tables[]='prompt.php';
$lang_tables[]='person.php';
define('LANG_FILE','aufnahme.php');
$local_user='aufnahme_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');

$thisfile=basename(__FILE__);
if($_COOKIE['ck_login_logged'.$sid]) $breakfile=$root_path.'main/spediens.php'.URL_APPEND;
	else $breakfile='personell_admin_pass.php'.URL_APPEND.'&target='.$target;
	
$admissionfile='aufnahme_start.php'.URL_APPEND;

if((!isset($pid)||!$pid)&&$HTPP_SESSION_VARS['sess_pid']) $pid=$HTPP_SESSION_VARS['sess_pid'];

$_SESSION['sess_path_referer']=$top_dir.$thisfile;
$_SESSION['sess_pid']=$pid;
$_SESSION['sess_full_pid']=$pid;
$_SESSION['sess_parent_mod']='registration';


# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('system_admin');

# Title in toolbar
 $smarty->assign('sToolbarTitle', "$LDPersonnelManagement :: $LDPersonData ($pid)");

 # hide return button
 $smarty->assign('pbBack',FALSE);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('employee_show.php')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',"$LDPersonnelManagement :: $LDPersonData ($pid)");

# Buffer page output

ob_start();
?>

<table width=100% border=0 cellspacing="0"  cellpadding=0 >

<?php
/* Create the tabs */
$tab_bot_line='#66ee66';
require('./gui_bridge/default/gui_tabs_personell_reg.php');
?>

<tr>
<td colspan=3>

<?php

	# Display the person´s demographic data using the object class class_gui_person_show.php

	require_once($root_path.'include/care_api_classes/class_gui_person_show.php');
	$person = & new GuiPersonShow;
	$person->setPID($pid);
	$person->display();

?>

<p>

<?php if (!$newdata) { ?>

<?php if($target=="search") $newsearchfile='personell_search.php'.URL_APPEND.'&target=personell_search';
    else $newsearchfile='personell_register_search.php'.URL_APPEND.'&target=person_reg';
?>
<a href="<?php echo $newsearchfile ?>"><img
<?php echo createLDImgSrc($root_path,'new_search.gif','0','absmiddle') ?>></a>
<?php } ?>
<a href="person_register.php<?php echo URL_APPEND ?>&pid=<?php echo $pid ?>&update=1"><img 
<?php echo createLDImgSrc($root_path,'update_data.gif','0','absmiddle') ?>></a>
<?php
if(isset($current_employ)&&$current_employ){
?>
<a href="personell_register_show.php<?php echo URL_APPEND ?>&personell_nr=<?php echo $current_employ ?>&target=personell_reg"><img <?php echo createLDImgSrc($root_path,'employment_data.gif','0','absmiddle') ?>></a>
<?php
}elseif($person->DeathDate() == DBF_NODATE){
?>
<a href="personell_register.php<?php echo URL_APPEND ?>&pid=<?php echo $pid ?>&target=personell_reg"><img <?php echo createLDImgSrc($root_path,'add_employ.gif','0','absmiddle') ?>></a>

<?php
}
?>
<form action="person_register.php" method=post>
<input type=submit value="<?php echo $LDNewForm ?>" >
<input type=hidden name="sid" value=<?php echo $sid; ?>>
<input type=hidden name="lang" value="<?php echo $lang; ?>">
<input type=hidden name="target" value="person_reg">
</form>

</ul>

<p>
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

