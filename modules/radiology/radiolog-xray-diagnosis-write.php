<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/*** CARE2X Integrated Hospital Information System beta 2.0.1 - 2004-07-04
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define("LANG_FILE","radio.php");
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');

$thisfile="radiolog-xray-diagnosis-write.php";
?>
<?php html_rtl($lang); ?>

<head>
<?php echo setCharSet(); ?>

</head>
<body>
<form>
<input type="submit" value="<?php echo $LDSave ?>">
<input type="reset" value="<?php echo $LDResetEntry ?>">
<input type="button" value="<?php echo $LDCancel ?>" onClick="javascript:window.top.location.replace('radiolog-xray-javastart.php?sid=<?php echo "$sid&lang=$lang" ?>&mode=display1')"><br>
<textarea name="diagnosis" cols=70 rows=20 wrap="physical">
<?php 
//$diagnosis=file("http://192.168.0.2/radiology/diagnosis/Thorax.txt"); 
//while(list($x,$v)=each($diagnosis)) echo $v;
require($root_path.'global_conf/inc_remoteservers_conf.php');

if($disc_pix_mode) readfile($xray_diagnosis_localpath."thorax.txt");
 else readfile($xray_diagnosis_server_http."thorax.txt");
?>
</textarea><br>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="submit" value="<?php echo $LDSave ?>">
<input type="reset" value="<?php echo $LDResetEntry ?>">
<input type="button" value="<?php echo $LDCancel ?>" onClick="javascript:window.top.location.replace('radiolog-xray-javastart.php?sid=<?php echo "$sid&lang=$lang" ?>&mode=display1')">
   
</form>

</body>
</html>
