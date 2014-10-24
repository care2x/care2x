<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
define('LANG_FILE','stdpass.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/core/inc_front_chain_lang.php');
require_once($root_path.'global_conf/areas_allow.php');

$allowedarea=&$allow_area['op_docs'];

$thisfile=basename(__FILE__);

/*
$fileforward="op-doku-javastart.php?sid=$sid&lang=$lang&target=";

switch($target)
{
	case 'search':$fileforward.="search";
						$lognote="search";
						break;
	case 'archiv':$fileforward.="archiv";
						$lognote="archive";
						break;
	default:$fileforward.="entry"; 
				$target="entry";
}*/

switch($target)
{
	case 'search':$fileforward.="op-doku-search.php?sid=$sid&lang=$lang&target=search";
						$lognote="search";
						break;
	case 'archiv':$fileforward.="op-doku-archiv.php?sid=$sid&lang=$lang&target=archiv";
						$lognote="archive";
						break;
	default:$fileforward.="op-doku-start.php?sid=$sid&lang=$lang&target=entry";
				$target="entry";
}

$lognote="OP docs $lognote ok";

$breakfile=$root_path.'main/op-doku.php'.URL_APPEND;

$userck='ck_opdoku_user';

//reset cookie;
// reset all 2nd level lock cookies
setcookie($userck.$sid,'');
require($root_path.'include/core/inc_2level_reset.php'); setcookie(ck_2level_sid.$sid,"");

require($root_path.'include/core/inc_passcheck_internchk.php');
if ($pass=='check') 	
	include($root_path.'include/core/inc_passcheck.php');

$errbuf="OP docs $target";

require($root_path.'include/core/inc_passcheck_head.php');
?>
<BODY  onLoad="document.passwindow.userid.focus();" bgcolor=<?php echo $cfg['body_bgcolor']; ?>
<?php if (!$cfg['dhtml']){ echo ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<FONT    SIZE=-1  FACE="Arial">

<P>

<img <?php echo createComIcon($root_path,'swimring.gif','0','top') ?>>
<FONT  COLOR="<?php echo $cfg[top_txtcolor] ?>"  SIZE=6  FACE="verdana"> <b><?php echo $LDOrDocu ?></b></font>

<table width=100% border=0 cellpadding="0" cellspacing="0"> 
<tr>

<td colspan=3><?php if($target=="entry") echo '<img '.createLDImgSrc($root_path,'newdata-b.gif','0').'>';
								else echo'<a href="op-doku-pass.php?sid='.$sid.'&lang='.$lang.'&target=entry"><img '.createLDImgSrc($root_path,'newdata-gray.gif','0').'></a>';
							if($target=="search") echo '<img '.createLDImgSrc($root_path,'such-b.gif','0').'>';
								else echo '<a href="op-doku-pass.php?sid='.$sid.'&lang='.$lang.'&target=search"><img '.createLDImgSrc($root_path,'such-gray.gif','0').'></a>';
							if($target=="archiv") echo '<img '.createLDImgSrc($root_path,'arch-blu.gif','0').'>';
								else echo '<a href="op-doku-pass.php?sid='.$sid.'&lang='.$lang.'&target=archiv"><img '.createLDImgSrc($root_path,'arch-gray.gif','0').'></a>';
						?></td>
</tr>

<?php require($root_path.'include/core/inc_passcheck_mask.php') ?>  

<p>
<!-- 
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>"><?php echo "$LDIntro2 $LDOrDocu" ?></a><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>"><?php echo "$LDWhat2Do $LDOrDocu" ?></a><br> -->
<!-- <HR> -->
<?php
require($root_path.'include/core/inc_load_copyrite.php');
?>

</FONT>


</BODY>
</HTML>
