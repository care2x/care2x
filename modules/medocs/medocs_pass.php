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
define('LANG_FILE','stdpass.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/core/inc_front_chain_lang.php');

require_once($root_path.'global_conf/areas_allow.php');

$allowedarea=&$allow_area['admit'];
$append=URL_REDIRECT_APPEND.'&from=pass'; 

if(!isset($_SESSION['sess_user_origin'])) $_SESSION['sess_user_origin'] = "";

switch($target)
{
	case 'entry':$fileforward='medocs_start.php'.$append; 
						$lognote='Medocs ok';
						break;
	case 'search':$fileforward='medocs_data_search.php'.$append; 
						$lognote='Medocs search ok';
						break;
	case 'archiv':$fileforward='medocs_archive.php'.$append;
						$lognote='Medocs archive ok';
						 break;
	default: $target='entry';
				$lognote='Medocs ok';
				$fileforward='medocs_start.php'.$append;
}


$thisfile=basename(__FILE__);
//$breakfile='startframe.php'.URL_APPEND;
$breakfile=$root_path.'main/startframe.php'.URL_APPEND;

$userck='medocs_user';

setcookie($userck.$sid,'');
require($root_path.'include/core/inc_2level_reset.php'); 
setcookie(ck_2level_sid.$sid,'');

# reset the user origin
$_SESSION['sess_user_origin']='';

require($root_path.'include/core/inc_passcheck_internchk.php');
if ($pass=='check') 	
	include($root_path.'include/core/inc_passcheck.php');

$errbuf=$LDMedocs;

require($root_path.'include/core/inc_passcheck_head.php');
?>

<BODY  onLoad="document.passwindow.userid.focus();" bgcolor=<?php echo $cfg['body_bgcolor']; ?>
<?php if (!$cfg['dhtml']){ echo ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<FONT    SIZE=-1  FACE="Arial">

<P>
<?php
if($cfg['dhtml'])
 {
 switch($target)
{
	case 'entry':$buf=$LDMedocs; break;
	case 'search':$buf=$LDMedocs; break;
	case 'archiv':$buf=$LDMedocs; break;
	default: $target="entry";$buf=$LDMedocs;
}

echo '
<script language=javascript>
<!--
 if (window.screen.width) 
 { if((window.screen.width)>1000) document.write(\'<img '.createComIcon($root_path,'penpaper.gif','0','top').'><FONT  COLOR="'.$cfg['top_txtcolor'].'"  SIZE=6  FACE="verdana"> <b>'.$buf.'</b></font>\');}
 //-->
 </script>';
 }
 ?>

  
<table width=100% border=0 cellpadding="0" cellspacing="0"> 
<tr>
<td colspan=3><?php if($target=="entry") echo '<img '.createLDImgSrc($root_path,'newdata-b.gif','0').' alt="'.$LDAdmit.'">';
								else{ echo'<a href="medocs_pass.php?sid='.$sid.'&target=entry&lang='.$lang.'"><img '.createLDImgSrc($root_path,'newdata-gray.gif','0').' alt="'.$LDAdmit.'"'; if($cfg['dhtml'])echo'class="fadeOut" '; echo '></a>';}
							if($target=="search") echo '<img '.createLDImgSrc($root_path,'such-b.gif','0').' alt="'.$LDSearch.'">';
								else{ echo '<a href="medocs_pass.php?sid='.$sid.'&target=search&lang='.$lang.'"><img '.createLDImgSrc($root_path,'such-gray.gif','0').' alt="'.$LDSearch.'" ';if($cfg['dhtml'])echo'class="fadeOut" '; echo '></a>';}
/*							if($target=="archiv") echo '<img '.createLDImgSrc($root_path,'arch-blu.gif','0').'  alt="'.$LDArchive.'">';
								else{ echo '<a href="medocs_pass.php?sid='.$sid.'&target=archiv&lang='.$lang.'"><img '.createLDImgSrc($root_path,'arch-gray.gif','0').' alt="'.$LDArchive.'" ';if($cfg['dhtml'])echo'class="fadeOut" '; echo '></a>';}
*/						?></td>
</tr>

<?php require($root_path.'include/core/inc_passcheck_mask.php') ?>  

<p>
<?php
require($root_path.'include/core/inc_load_copyrite.php');
?>
</FONT>
</BODY>
</HTML>
