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
define('LANG_FILE','stdpass.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'global_conf/areas_allow.php');

/*if ($pdaten=="ja") setcookie(pdatencookie,"ja");*/

$allowedarea=&$allow_area['lab_r'];

$fileforward='labor_data_patient_such.php?sid='.$sid.'&lang='.$lang;
$thisfile='labor_datasearch_pass.php';

 if ($pdatencookie=='ja') 
 	$breakfile='javascript:window.history.go(-(window.history.length))';
	else
	  $breakfile='labor.php?sid='.$sid.'&lang='.$lang;
	  
$title="$LDMedLab - $LDSeeData";

$lognote="$title ok";

$userck='ck_lab_user';

//reset cookie;
// reset all 2nd level lock cookies
setcookie($userck.$sid,'');
require($root_path.'include/inc_2level_reset.php'); setcookie(ck_2level_sid.$sid,'');

require($root_path.'include/inc_passcheck_internchk.php');
if ($pass=='check') 	
	include($root_path.'include/inc_passcheck.php');

$errbuf=$title;
$minimal=1;
require($root_path.'include/inc_passcheck_head.php');
?>

<BODY  onLoad="document.passwindow.userid.focus()">

<FONT    SIZE=-1  FACE="Arial">

<P>

<img <?php echo createComIcon($root_path,'micros.gif','0','absmiddle') ?>><FONT  COLOR="<?php echo $cfg[top_txtcolor] ?>"  SIZE=5  FACE="verdana"> <b><?php echo $title; ?></b></font>

<table width=100% border=0 cellpadding="0" cellspacing="0"> 
<tr>
<td colspan=3><img <?php echo createLDImgSrc($root_path,'such-b.gif','0') ?>><a href="labor_datainput_pass.php?sid=<?php echo "$sid&lang=$lang" ?>&route=validroute"><img <?php echo createLDImgSrc($root_path,'newdata-gray.gif','0') ?>></a></td>
</tr>

<?php require($root_path.'include/inc_passcheck_mask.php') ?>  

<p>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</FONT>


</BODY>
</HTML>
