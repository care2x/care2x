<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables=array('person.php','actions.php','specials.php');
define('LANG_FILE','stdpass.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');

require_once($root_path.'global_conf/areas_allow.php');

$allowedarea=&$allow_area['admit'];
$append=URL_REDIRECT_APPEND; 
switch($target)
{
	case 'person_reg':$fileforward='personell_register.php'.$append.'&origin=pass&target=personell_reg'; 
						$lognote='Person register ok';
						break;
	case 'personell_reg':$fileforward='personell_register.php'.$append.'&origin=pass&target=person_reg'; 
						$lognote='personell data entry ok';
						break;
	case 'personell_search':$fileforward='personell_search.php'.$append.'&fwd_nr='.$fwd_nr.'&origin=pass&target=personell_search'; 
						$lognote='Personell search  ok';
						 break;
	case 'personell_listall':$fileforward='personell_listall.php'.$append.'&origin=pass&target=personell_listall'; 
						$lognote='Personell list all  ok';
						 break;
	default: $target='person_reg';
				$lognote='Person register ok';
				$fileforward='personell_register.php'.$append.'&fwd_nr='.$fwd_nr.'&origin=pass&target=personell_reg'; 
}


$thisfile=basename(__FILE__);
$breakfile=$root_path.'main/spediens.php'.URL_APPEND;

$userck='aufnahme_user';
//reset cookie;
// reset all 2nd level lock cookies
setcookie($userck.$sid,'',0,'/');
require($root_path.'include/inc_2level_reset.php');
setcookie(ck_2level_sid.$sid,'',0,'/');

require($root_path.'include/inc_passcheck_internchk.php');
if ($pass=='check') 	
	include($root_path.'include/inc_passcheck.php');

$errbuf=$LDAdmission;

/* erase the user_origin */
if(isset($_SESSION['sess_user_origin'])) $_SESSION['sess_user_origin']='';

require($root_path.'include/inc_passcheck_head.php');
?>

<BODY  onLoad="document.passwindow.userid.focus();" bgcolor=<?php echo $cfg['body_bgcolor']; ?>
<?php if (!$cfg['dhtml']){ echo ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<FONT    SIZE=-1  FACE="Arial">

<P>
<?php

$buf=$LDPersonellMngmnt;
echo '
<img '.createComIcon($root_path,'persons.gif','0','top').'><FONT  COLOR="'.$cfg['top_txtcolor'].'"  SIZE=6  FACE="verdana"> <b>'.$buf.'</b></font>';

 ?>

  
<table width=100% border=0 cellpadding="0" cellspacing="0"> 
<tr>
<td colspan=3><?php if($target=="personell_reg") echo '<img '.createLDImgSrc($root_path,'add_employee_blue.gif','0').' alt="'.$LDAdmit.'">';
								else{ echo'<a href="'.$thisfile.URL_APPEND.'&target=personell_reg"><img '.createLDImgSrc($root_path,'add_employee_gray.gif','0').' alt="'.$LDAdmit.'"'; if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; echo '></a>';}
							if($target=="personell_search") echo '<img '.createLDImgSrc($root_path,'src_emp_blu.gif','0').' alt="'.$LDSearch.'">';
								else{ echo '<a href="'.$thisfile.URL_APPEND.'&target=personell_search"><img '.createLDImgSrc($root_path,'src_emp_gray.gif','0').' alt="'.$LDSearch.'" ';if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; echo '></a>';}
							if($target=="personell_listall") echo '<img '.createLDImgSrc($root_path,'lista-blu.gif','0').' alt="'.$LDSearch.'">';
								else{ echo '<a href="'.$thisfile.URL_APPEND.'&target=personell_listall"><img '.createLDImgSrc($root_path,'lista-gray.gif','0').' alt="'.$LDSearch.'" ';if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; echo '></a>';}
							echo '<img src="'.$root_path.'gui/img/common/default/pixel.gif" width=20>';
							if($target=="person_reg") echo '<img '.createLDImgSrc($root_path,'register_blue.gif','0').' alt="'.$LDSearch.'">';
								else{ echo '<a href="'.$thisfile.URL_APPEND.'&target=person_reg"><img '.createLDImgSrc($root_path,'register_gray.gif','0').' alt="'.$LDSearch.'" ';if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; echo '></a>';}
						?></td>
</tr>

<?php require($root_path.'include/inc_passcheck_mask.php') ?>  

<p>
<p>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</FONT>
</BODY>
</HTML>
