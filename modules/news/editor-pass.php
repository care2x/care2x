<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require_once('./roots.php');
require_once($root_path.'include/inc_environment_global.php');
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

$allowedarea=&$allow_area['news'];

$append="?sid=$sid&lang=$lang";

$default_forward=$root_path.'modules/news/editor-4plus1-select-art.php';

$default_breakfile='newscolumns.php'.URL_APPEND;

# Filter probable errors in navigation
if(!isset($_SESSION['sess_file_editor']) || empty($_SESSION['sess_file_editor'])) $fileforward=$default_forward.URL_REDIRECT_APPEND;
   else $fileforward=$_SESSION['sess_file_editor'].URL_REDIRECT_APPEND;

if(!isset($_SESSION['sess_file_break']) || empty($_SESSION['sess_file_break'])) $breakfile=$default_breakfile.URL_APPEND;
   else $breakfile=$root_path.$_SESSION['sess_file_break'].URL_APPEND;

# Filter dept_nr if available save to session, else use default department = 1, public relations headline news
if(isset($dept_nr)&&$dept_nr) $_SESSION['sess_dept_nr']=$dept_nr;
	elseif(!$_SESSION['sess_dept_nr']) $_SESSION['sess_dept_nr']=1; # Headline news
# Filter title, if no supplied, use session stored title
$title= (empty($title)) ? $_SESSION['sess_title'] : $title ; 
   
$lognote="$title+editor";
$userck="ck_editor_user";					

//$fileforward=$_SESSION['sess_file_editor'].URL_REDIRECT_APPEND;
//$breakfile=$_SESSION['sess_file_break'].$URL_APPEND;

$thisfile=basename(__FILE__);							

$passtag=0;

//reset cookie;
# reset all 2nd level lock cookies
require($root_path.'include/inc_2level_reset.php'); 
setcookie('ck_2level_sid'.$sid,"");

# Check if the user is logged in globally
require($root_path.'include/inc_passcheck_internchk.php');
# If not logged in globally, check authentication
if (isset($pass) &&  ($pass=='check')) 	include($root_path.'include/inc_passcheck.php');

$errbuf=strtr($lognote,"+"," ");

require($root_path.'include/inc_passcheck_head.php');
?>

<BODY  onLoad="document.passwindow.userid.focus();" bgcolor=<?php echo $cfg['body_bgcolor']; ?>
<?php if (!$cfg['dhtml']){ echo ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>
<P>

<FONT  COLOR=<?php echo $cfg['top_txtcolor'] ?>  SIZE=6  FACE="verdana"> <b><?php echo $title; ?></b></font>

<table width=100% border=0 cellpadding="0" cellspacing="0"> 

<?php require($root_path.'include/inc_passcheck_mask.php'); ?>  

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
<!-- 
<p>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>"><?php echo $LDIntroTo." ".$title ?></a><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>"><?php echo $LDWhatTo." ".$title ?>?</a><br>
 -->
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</FONT>

</BODY>
</HTML>
