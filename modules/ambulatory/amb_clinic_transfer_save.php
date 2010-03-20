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

define('LANG_FILE','prompt.php');
define('NO_2LEVEL_CHK',1);
$local_user='ck_pflege_user';
require_once($root_path.'include/inc_front_chain_lang.php');

if(empty($_COOKIE[$local_user.$sid])){
    $edit=0;
	include($root_path."language/".$lang."/lang_".$lang."_".LANG_FILE);
}


$fileappend="&dept_nr=$dept_nr&edit=$edit&mode=&pday=$pday&pmonth=$pmonth&pyear=$pyear&station=$station";
$breakfile="location:amb_clinic_patients.php".URL_APPEND.$fileappend;
$forwardfile="location:amb_clinic_patients.php".URL_REDIRECT_APPEND.$fileappend;
# Create ward object
require_once($root_path.'include/care_api_classes/class_encounter.php');
$enc_obj= new Encounter;

if(isset($mode)&&$mode=='transferdept'){	
	
	$date=date('Y-m-d');
	$time=date('H:i:s');
	# first discharge from current dept
	if($enc_obj->DischargeFromDept($pn,8,$date,$time)) {# discharge type nr 8 = change of department
		# Now we set new dept
		if($enc_obj->setCurrentDept($pn,$tgt_nr)){
   			header($forwardfile);
   			exit;
		}
/*		# Now we assign to new location
		if($enc_obj->assignInDept($pn,$tgt_nr,$tgt_nr,$date,$time)){
   			header($forwardfile);
   			exit;
		}
*/
	}
}else{
	header($forwardfile);
	exit;
}

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php

echo setCharSet();

require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>

<style type="text/css" name="s2">
td.vn { font-family:verdana,arial; color:#000088; font-size:10}

</style>
</HEAD>

<BODY bgcolor=<?php echo $cfg['body_bgcolor']; ?> topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<table border=0>
  <tr>
    <td><img <?php 	echo createMascot($root_path,'mascot2_r.gif','0'); ?>></td>
    <td><FONT SIZE=3  FACE="Arial" color="maroon"><?php 	echo $LDErrorOccured.'<br>'.$LDTryOrNotifyEDP; ?></td>
  </tr>
</table>

<p>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</BODY>
</HTML>
