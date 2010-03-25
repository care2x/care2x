<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
define('LANG_FILE','stdpass.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/core/inc_front_chain_lang.php');

require_once($root_path.'global_conf/areas_allow.php');

$allowedarea=&$allow_area['doctors'];
//$append="?sid=$sid&lang=$lang&from=pass"; 

switch($target)
{
	case 'dutyplan': $fileforward="doctors-dienstplan-planen.php".URL_REDIRECT_APPEND."&dept_nr=$dept_nr&retpath=$retpath&pmonth=$pmonth&pyear=$pyear";
							$title=$LDDOCScheduler;
							break;
	case 'setpersonal': $fileforward="doctors-dienst-personalliste.php".URL_REDIRECT_APPEND."&ipath=$retpath&retpath=$retpath";
							$title=$LDDocsList;
							break;
	default:{ header("Location:".$root_path."language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}
}

							
$thisfile=basename(__FILE__);

switch($retpath){
	case 'op': $breakfile=$root_path.'main/op-doku.php'.URL_APPEND;
	default: $breakfile='doctors.php'.URL_APPEND;
}

$lognote="Doctors $title ok";

$userck='ck_doctors_dienstplan_user';

//reset cookie;
// reset all 2nd level lock cookies
setcookie($userck.$sid,'');
require($root_path.'include/core/inc_2level_reset.php'); setcookie(ck_2level_sid.$sid,'');

require($root_path.'include/core/inc_passcheck_internchk.php');
if ($pass=='check') 	
	include($root_path.'include/core/inc_passcheck.php');

$errbuf="Doctors $title";

require($root_path.'include/core/inc_passcheck_head.php');
?>

<BODY  onLoad="document.passwindow.userid.focus();" bgcolor=<?php echo $cfg['body_bgcolor']; ?>
<?php if (!$cfg['dhtml']){ echo ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>
<FONT    SIZE=-1  FACE="Arial">

<P>

<img <?php echo createComIcon($root_path,'employee.gif','0','top') ?>>
<FONT  COLOR="<?php echo$cfg['top_txtcolor'] ?>"  SIZE=6  FACE="verdana"> <b><?php echo $title ?></b></font>

<table width=100% border=0 cellpadding="0" cellspacing="0"> 

<?php require($root_path.'include/core/inc_passcheck_mask.php') ?>  

<p>
<!-- <img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>"><?php echo "$LDIntro2 $title" ?></a><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>"><?php echo "$LDWhat2Do $title" ?></a><br>
 -->
<?php
require($root_path.'include/core/inc_load_copyrite.php');
?>

</FONT>


</BODY>
</HTML>
