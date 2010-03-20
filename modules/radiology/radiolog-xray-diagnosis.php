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

$thisfile=basename(__FILE__);
?>
<?php html_rtl($lang); ?>
<head>
<?php echo setCharSet(); ?>
</head>
<body>
<?php
require($root_path.'global_conf/inc_remoteservers_conf.php');

if($disc_pix_mode) $diagnosis=file($xray_diagnosis_localpath."thorax.txt");
	else $diagnosis=file($xray_diagnosis_server_http."thorax.txt");
	
while(list($x,$v)=each($diagnosis))
echo nl2br($v);

?><p>
<?php if ($mode!="preview") 
{
?>
<form action="radiolog-xray-diagnosis-write-pass.php">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="retpath" value="read_diagnosis">
<input type="submit" value="<?php echo $LDEditXrayDiag ?>">

</form>
<?php 
}
?>
</body>
</html>
