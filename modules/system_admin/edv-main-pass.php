<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require_once('./roots.php');
require_once($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','stdpass.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');

require_once($root_path.'global_conf/areas_allow.php');

$allowedarea=&$allow_area['edp'];
$breakfile='edv.php?sid='.$sid.'&lang='.$lang;

switch($target)
{
/*	case 'sqldb':		 $title=$LDSqlDb;
								//$userck="ck_edv_mysql_user";
								$fileforward='phpmyadmin-start.php?lang='.$lang.'&sid='.$sid;
								//$fileforward="../start.php";
								break;*/
	case 'adminlogin':	$title=$LDSystemLogin;
								//$userck='ck_edv_admin_user';
								$fileforward='edv_system_admin_mframe.php?lang='.$lang.'&sid='.$sid;
								break;
	case 'currency_admin':	$title=$LDSystemLogin;
								//$userck='ck_edv_admin_user';
								$fileforward="edv_system_format_currency_add.php?sid=$sid&lang=$lang&from=$from";
								break;
	case 'modulgenerator':	$title=$LDSystemLogin;
								//$userck='ck_edv_admin_user';
								$fileforward=$root_path."modules/system_admin/sub_modul_neu.php?sid=$sid&lang=$lang&from=$from";
								break;
	default:{header('Location:'.$root_path.'language/'.$lang.'/lang_'.$lang.'_invalid-access-warning.php'); exit;}; 
}

$userck='ck_edv_user';
$thisfile='edv-main-pass.php';
$lognote="$title ok";

// reset all 2nd level lock cookies
setcookie($userck.$sid,'');
require($root_path.'include/inc_2level_reset.php'); setcookie('ck_2level_sid'.$sid,'');

require($root_path.'include/inc_passcheck_internchk.php');
if ($pass=='check') 	
	include($root_path.'include/inc_passcheck.php');

$errbuf=$title;
$minimal=1;
require($root_path.'include/inc_passcheck_head.php');
?>

<BODY  <?php if (!$nofocus) echo 'onLoad="document.passwindow.userid.focus()"'; echo  ' bgcolor='.$cfg['body_bgcolor']; 
 if (!$cfg['dhtml']){ echo ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } 
?>>

<P>
<img src="../../gui/img/common/default/kwheel.gif" border=0 align="middle">
<FONT  COLOR="<?php echo $cfg[top_txtcolor] ?>"  SIZE=5  FACE="verdana"> <b><?php echo $title ?></b></font>
<p>
<table width=100% border=0 cellpadding="0" cellspacing="0"> 

<?php require($root_path.'include/inc_passcheck_mask.php') ?>  

<p>
<!-- <img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>"><?php echo "$LDIntro2 $title " ?></a><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>"><?php echo "$LDWhat2Do $title " ?>?</a><br>
 -->
<p>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>

</BODY>
</HTML>
