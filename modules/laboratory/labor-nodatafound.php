<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.2 - 2006-07-10
* GNU General Public License
* Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','lab.php');
$local_user='ck_lab_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');
if(isset($from) && $from=='input'){
	$backfile="labor_datainput.php".URL_APPEND."&encounter_nr=$encounter_nr&job_id=$job_id&parameterselect=$parameterselect&allow_update=$allow_update&user_origin=$user_origin";
}else{
	$backfile="labor_data_patient_such.php".URL_APPEND."&search=1";
}
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
</HEAD>

<BODY bgcolor="#ffffff">
<P><br>
<table border=0>
  <tr>
    <td valign="top"><img <?php echo createMascot($root_path,'mascot1_r.gif','0','bottom') ?> align="left"></td>
    <td><font face=verdana,arial size=5 color=maroon><?php echo "$LDNoLabReport <br>".ucfirst($ln).", ".ucfirst($fn)." ".$bd ?>.<br> (<?php echo "$LDCaseNr $encounter_nr" ?>)
			<p><br><a href="<?php echo $backfile ?>">
			<img <?php echo createLDImgSrc($root_path,'back2.gif','0') ?>></a>
	</td>
  </tr>
</table>


<p>
<?php
require($root_path.'include/core/inc_load_copyrite.php');
?>

</FONT>


</BODY>
</HTML>
