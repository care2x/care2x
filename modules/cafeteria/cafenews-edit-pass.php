<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require_once('./roots.php');
require_once($root_path.'include/core/inc_environment_global.php');
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
require_once($root_path.'include/core/inc_front_chain_lang.php');

require_once($root_path.'global_conf/areas_allow.php');
$allowedarea=&$allow_area['cafenews'];

$fileforward=$_SESSION['sess_file_editor'].URL_REDIRECT_APPEND;

$breakfile='cafenews.php'.URL_APPEND;

$title= $_SESSION['sess_title']; 

$lognote="$title $LDEdit ok";

$userck="ck_cafenews_user";

//reset cookie;
// reset all 2nd level lock cookies
setcookie($userck.$sid,'');
require($root_path.'include/core/inc_2level_reset.php'); setcookie('ck_2level_sid'.$sid,'',0,'/');

require($root_path.'include/core/inc_passcheck_internchk.php');
if ($pass=='check') 	
	include($root_path.'include/core/inc_passcheck.php');

$errbuf="$title $LDEdit";

require($root_path.'include/core/inc_passcheck_head.php');
?>

<BODY bgcolor="#ffffff" onLoad="document.passwindow.userid.focus()">


<FONT    SIZE=-1  FACE="Arial">

<P>

<img <?php echo createComIcon($root_path,'basket.gif','0') ?>>
<FONT  COLOR=#cc6600  SIZE=6  FACE="verdana"> <b><?php echo $title; ?></b></font>

<table width=100% border=0 cellpadding="0" cellspacing="0"> 

<?php require($root_path.'include/core/inc_passcheck_mask.php') ?>  

<p>
<!--<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>"><?php echo "$LDIntroTo $title $LDEdit" ?></a><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>"><?php echo "$LDWhatTo $title $LDEdit" ?>?</a><br>
<HR>-->
<?php
require($root_path.'include/core/inc_load_copyrite.php');
 ?>

</FONT>


</BODY>
</HTML>
