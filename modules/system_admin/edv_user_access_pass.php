<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
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

$allowedarea=&$allow_area['edp'];

$userck='ck_edv_user';
$append="?sid=$sid&lang=$lang&fwck=$userck";
switch($target)
{
/*	case 'entry':$fileforward='edv_user_access_edit.php'.$append; 
						$title="$LDManageAccess - $LDNewData";
						break;
*/
	case 'entry':$fileforward='edv_user_access_edit.php'.$append; 
						$title="$LDManageAccess - $LDNewData";
						break;

	case 'search':$fileforward='edv_user_access_search.php'.$append; 
						$title="$LDManageAccess - $LDSearch";
						break;
	case 'archiv':$fileforward='edv_user_access_list.php'.$append; 
						$title="$LDManageAccess - $LDListAll";
						break;
	default: $target='entry';
				$fileforward='edv_user_access_edit.php'.$append; 
				$title="$LDManageAccess $LDNewData";
}

$thisfile='edv_user_access_pass.php';
$breakfile='edv.php?sid='.$sid.'&lang='.$lang;


$lognote="$title ok";

// reset all 2nd level lock cookies
setcookie($userck.$sid,'');
require($root_path.'include/core/inc_2level_reset.php'); setcookie(ck_2level_sid.$sid,'');

require($root_path.'include/core/inc_passcheck_internchk.php');
if ($pass=='check') 	
	include($root_path.'include/core/inc_passcheck.php');

$errbuf=$title;
$minimal=1;
require($root_path.'include/core/inc_passcheck_head.php');
?>

<BODY  <?php if (!$nofocus) echo 'onLoad="document.passwindow.userid.focus()"'; echo  ' bgcolor='.$cfg['body_bgcolor']; 
 if (!$cfg['dhtml']){ echo ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } 
?>>

<p>
<FONT    SIZE=-1  FACE="Arial">

<P>
<FONT  COLOR="<?php echo $cfg[top_txtcolor] ?>"  SIZE=5  FACE="verdana"> <b><?php echo $title ?></b></font>
<p>
<table width=100% border=0 cellpadding="0" cellspacing="0"> 

<tr>
<td colspan=3><?php if($target=="entry") echo '<img '.createLDImgSrc($root_path,'newdata-b.gif','0').' alt="'.$LDNewData.'">';
								else{ echo'<a href="'.$thisfile.$append.'&target=entry"><img '.createLDImgSrc($root_path,'newdata-gray.gif','0').'  alt="'.$LDNewData.'" width=130 height=25 border=0 ';if($cfg['dhtml'])echo'class="fadeOut" '; echo '></a>';}
							if($target=="search") echo '<img '.createLDImgSrc($root_path,'such-b.gif','0').' alt="'.$LDSearch.'">';
								else{ echo '<a href="'.$thisfile.$append.'&target=search"><img '.createLDImgSrc($root_path,'such-gray.gif','0').' alt="'.$LDSearch.'"  ';if($cfg['dhtml'])echo'class="fadeOut" '; echo '></a>';}
							if($target=="archiv") echo '<img '.createLDImgSrc($root_path,'arch-blu.gif','0').' alt="'.$LDArchive.'">';
								else{ echo '<a href="'.$thisfile.$append.'&target=archiv"><img '.createLDImgSrc($root_path,'arch-gray.gif','0').' alt="'.$LDArchive.'"  ';if($cfg['dhtml'])echo'class="fadeOut" '; echo '></a>';}
						?></td>

</tr>

<?php require($root_path.'include/core/inc_passcheck_mask.php') ?>  

<p>
<!-- <img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>"><?php echo "$LDIntro2 $title " ?></a><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>"><?php echo "$LDWhat2Do $title " ?>?</a><br>
 --><HR>
<p>

<?php
require($root_path.'include/core/inc_load_copyrite.php');
?>
</FONT>
</BODY>
</HTML>
