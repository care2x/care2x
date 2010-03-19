<?php
//error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
require_once($root_path.'include/access_log.php');
$logs = new AccessLog();
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
//$db->debug = true;
define('LANG_FILE','stdpass.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');
// reset all 2nd level lock cookies
require($root_path.'include/inc_2level_reset.php');

$fileforward='login-pc-config.php'.URL_REDIRECT_APPEND;
$thisfile='login.php';
$breakfile='startframe.php'.URL_APPEND;

if(!isset($pass)) $pass='';
if(!isset($keyword)) $keyword='';
if(!isset($userid)) $userid='';

if(!session_is_registered('sess_login_userid')) session_register('sess_login_userid');
if(!session_is_registered('sess_login_username')) session_register('sess_login_username');
if(!session_is_registered('sess_login_pw')) session_register('sess_login_pw');

if ((($pass=='check')&&($keyword!=''))&&($userid!=''))
{
	include_once($root_path.'include/care_api_classes/class_access.php');
	$user = & new Access($userid,$keyword);

	if($user->isKnown() && $user->hasValidPassword())
	{
		if($user->isNotLocked())
		{
			$_SESSION['sess_login_userid']=$user->LoginName();
			$_SESSION['sess_login_username']=$user->Name();
			//gjergji - modified to let each user access it's own ward
			$_SESSION['department_nr']=$user->PermittedDepartment();
			# Init the crypt object, encrypt the password, and store in cookie
    			$enc_login = new Crypt_HCEMD5($key_login,makeRand());

			$cipherpw=$enc_login->encodeMimeSelfRand($keyword);

			$_SESSION['sess_login_pw']=$cipherpw;

			# Set the login flag
			setcookie('ck_login_logged'.$sid,'true',0,'/');

			$logs->writeline(date('Y-m-d').'/'.date('H:i'),$REMOTE_ADDR,'Main Login: OK',$user->LoginName(),$user->Name(),'','','',1);

			header("Location: $fileforward");
			exit;

		}else { $passtag=3;}
	}else {$passtag=1;}
}

$errbuf='Log in';
$minimal=1;
require($root_path.'include/inc_passcheck_head.php');
?>

<?php echo setCharSet(); ?>

<BODY onLoad="<?php if(isset($is_logged_out) && $is_logged_out) echo "window.parent.STARTPAGE.location.href='indexframe.php?sid=$sid&lang=$lang';"; ?>document.passwindow.userid.focus();" bgcolor=<?php echo $cfg['body_bgcolor']; ?>
<?php if (!$cfg['dhtml']){ echo ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>
&nbsp;
<p>
<?php
if(isset($is_logged_out) && $is_logged_out) {
	echo '<div align="center"><FONT  FACE="Arial" SIZE=+4 ><b>'.$LDLoggedOut.'</b></FONT><p><font size=4>'.$LDNewLogin.':</font></p></div>';
}
?>
<p>
<table width=100% border=0 cellpadding="0" cellspacing="0">
<tr>
<td colspan=3><img <?php echo createLDImgSrc($root_path,'login-b.gif') ?>></td>
</tr>

<?php require($root_path.'include/inc_passcheck_mask.php') ?>

<p><!-- 
<img src="../img/small_help.gif" > <a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>">Was ist login?</a><br>
<img src="../img/small_help.gif" > <a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>">Wieso soll ich mich einloggen?</a><br>
<img src="../img/small_help.gif" > <a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>">Was bewirkt das einloggen?</a><br>
 -->
<p>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</FONT>
</BODY>
</HTML>
