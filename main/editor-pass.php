<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
define('LANG_FILE','stdpass.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');

require_once($root_path.'include/inc_config_color.php');

require_once($root_path.'global_conf/areas_allow.php');

$allowedarea=&$allow_area['news'];

$append="?sid=$sid&lang=$lang&target=$target&user_origin=$user_origin&title=".strtr($title," ","+");

$default_forward='editor-4plus1-select-art.php'.$append;

$breakfile='newscolumns.php'.$append;

$fileforward=$default_forward;
$lognote="$title+editor";
$userck="ck_editor_user";


/**
*   This is the traffic controller 
*  All redirections must be coded here
*/
switch($target)
{
	case "headline": $allowedarea[]='headline';
							$fileforward='headline-edit-select-art.php'.$append;
							$breakfile=$root_path.'main/startframe.php'.URL_APPEND;
							break;
	case "cafenews": $allowedarea[]='cafenews';
							$fileforward='cafenews-edit-select.php'.$append;
							$userck="ck_cafenews_user";
							$breakfile="cafenews.php?sid=".$sid."&lang=".$lang;
							break;
	case "management": $allowedarea[]="management";
							$breakfile="startframe.php?sid=$sid&lang=$lang&title=".strtr($title," ","+");
							break;
	case "healthtips": $allowedarea[]="healthtip";
							break;
	case "physiotherapy": $allowedarea[]="physiotherapy";
							break;
	case "adv_studies": $allowedarea[]="advstudies";
							break;
	case "prof_training": $allowedarea[]="proftraining";
							break;
	case "events": $allowedarea[]="events";
							break;
	case "patient_admission": $allowedarea[]="events";
							break;
}
							

$thisfile="editor-pass.php";							

$passtag=0;

//reset cookie;
// reset all 2nd level lock cookies
require($root_path.'include/inc_2level_reset.php'); 
setcookie(ck_2level_sid.$sid,"");

require($root_path.'include/inc_passcheck_internchk.php');
if ($pass=='check') 	
	include($root_path.'include/inc_passcheck.php');

$errbuf=strtr($lognote,"+"," ");

require($root_path.'include/inc_passcheck_head.php');
?>
<?php echo setCharSet(); ?>
<BODY  onLoad="document.passwindow.userid.focus();" bgcolor=<?php echo $cfg['body_bgcolor']; ?>
<?php if (!$cfg['dhtml']){ echo ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>
<P>

<FONT  COLOR=<?php echo $cfg[top_txtcolor] ?>  SIZE=6  FACE="verdana"> <b><?php echo $title ?></b></font>

<table width=100% border=0 cellpadding="0" cellspacing="0"> 

<?php require($root_path.'include/inc_passcheck_mask.php') ?>  

<p><br>

</center>

</td>
<td bgcolor=#333399><font size=1>&nbsp;</td>
</tr>

<tr >
<td bgcolor="#333399" colspan=3><font size=1>
&nbsp; 
</td>
</tr>
</table>        
<FONT    SIZE=2  FACE="Arial">

<p>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>"><?php echo $LDIntroTo." ".$title ?></a><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>"><?php echo $LDWhatTo." ".$title ?>?</a><br>
<HR>
<?php
 // get a  page into an array and echo it out
require("../language/".$lang."/".$lang."_copyrite.php");
 ?>

</FONT>


</BODY>
</HTML>
