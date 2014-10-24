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
$lang_tables=array('person.php','actions.php');
define('LANG_FILE','stdpass.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/core/inc_front_chain_lang.php');

require_once($root_path.'global_conf/areas_allow.php');

$allowedarea=&$allow_area['admit'];
$append=URL_REDIRECT_APPEND;
//$fileforward='appt_show.php'.$append.'&origin=pass&target=list&dept_nr='.$dept_nr;
$fileforward='appt_show.php'.$append.'&origin=pass&target=list&dept_nr='.$dept_nr;
$lognote=$LDAppointments.'ok';

$thisfile=basename(__FILE__);
# Set the break (return) file
switch($_SESSION['sess_user_origin']){
	case 'amb': $breakfile=$root_path.'modules/ambulatory/ambulatory.php'.URL_APPEND; break;
	default: $breakfile=$root_path.'main/startframe.php'.URL_APPEND;
}

$userck='aufnahme_user';
//reset cookie;
// reset all 2nd level lock cookies
setcookie($userck.$sid,'',0,'/');
require($root_path.'include/core/inc_2level_reset.php'); setcookie(ck_2level_sid.$sid,'',0,'/');

require($root_path.'include/core/inc_passcheck_internchk.php');
if ($pass=='check') include($root_path.'include/core/inc_passcheck.php');

$errbuf=$LDAppointments;

require($root_path.'include/core/inc_passcheck_head.php');
?>

<BODY  onLoad="document.passwindow.userid.focus();" bgcolor=<?php echo $cfg['body_bgcolor']; ?>
<?php if (!$cfg['dhtml']){ echo ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<FONT    SIZE=-1  FACE="Arial">

<P>
<?php
$buf=$LDAppointments; 
if($dept) $buf.=' <nobr>:: '.$dept.'</nobr>';
echo '
<img '.createComIcon($root_path,'clockpaper.gif','0','top').'><FONT  COLOR="'.$cfg['top_txtcolor'].'"  SIZE=6  FACE="verdana"> <b>'.$buf.'</b></font>';
 ?>
  
<table width=100% border=0 cellpadding="0" cellspacing="0"> 

<?php require($root_path.'include/core/inc_passcheck_mask.php') ?>  

<p>
<?php
require($root_path.'include/core/inc_load_copyrite.php');
?>
</FONT>
</BODY>
</HTML>
