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
define('LANG_FILE','edp.php');
$local_user='ck_edv_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');

$breakfile='edv-system-admi-welcome.php'.URL_APPEND;
$returnfile='edv_user_access_list.php'.URL_APPEND;
//$_SESSION['sess_file_return']='edv.php';

require_once($root_path.'include/care_api_classes/class_access.php');
$user = & new Access($itemname);

if($user->UserExists()){

	if ($finalcommand=='delete') {

		if($user->Delete()) {
                	header("Location: edv_user_access_list.php?sid=$sid&lang=$lang&remark=itemdelete");
			exit;
		} else {
			echo '<p>'.$LDDbNoDelete.'<p>'.$user->getLastQuery();
		}
	}
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
 $smarty->assign('sToolbarTitle',"$LDEDP::$LDAccessRight::$LDDelete");

 # hide return button
 $smarty->assign('pbBack',$returnfile);

# href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('edp.php','access','delete')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',"$LDEDP::$LDAccessRight::$LDDelete");

 # Buffer page output

 ob_start();
?>

<p>

<center>
<table width=50% border=1 cellpadding="20">
<tr>
<td bgcolor="#ffffdd"><font face=verdana,arial size=2>
<p>
<?php echo $LDSureDelete ?><p>

<table border="0" cellpadding="5" cellspacing="1">
<tr>
<td align=right><font face=verdana,arial size=2 color=#000080><?php echo $LDName ?>:
</td><td><font face=verdana,arial size=2 color=#800000>
<?php
echo $user->Name();
?>
</td>
</tr>
<tr>
<td align=right><font face=verdana,arial size=2 color=#000080><?php echo $LDUserId ?>:</td>
<td><font face=verdana,arial size=2 color=#800000>
<?php
echo $user->LoginName();
?>
</td>
</tr>
<!-- <tr>
<td align=right><font face=verdana,arial size=2 color=#000080><?php echo $LDPassword ?>:</td>
<td><font face=verdana,arial size=2 color=#800000>
<?php
echo $zeile['password'];
?>
</td>
</tr> -->
</table>

<br>
<FORM action="edv_user_access_delete.php" method="post">
<INPUT type="hidden" name="itemname" value="<?php echo $itemname ?>">
<input type="hidden" name="finalcommand" value="delete">
<input type="hidden" name="sid" value="<?php echo $sid;?>">
<input type="hidden" name="lang" value="<?php echo $lang;?>">
<INPUT type="submit" name="versand" value="<?php echo $LDYesDelete ?>"></font></FORM>
<p>
<a href="<?php echo $returnfile ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?>  alt="<?php echo $LDCancel ?>" align="middle"></a>

</center>

</td>
</tr>
</table>        

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
