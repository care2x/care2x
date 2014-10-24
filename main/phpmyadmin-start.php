<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
require_once($root_path.'include/core/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','edp.php');
$local_user='ck_edv_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');
?>
<?php html_rtl($lang); ?>
<head>
<?php echo setCharSet(); ?>
<title></title>
</head>
<body>
<font size=3 face="verdana,arial" color="#990000">
<center>
<img <?php echo createMascot($root_path,'mascot1_r.gif','0','bottom') ?> align="absmiddle"><b><?php echo $LDMySQLManage ?></b><p>
<form action="<?php echo $root_path; ?>modules/phpmyadmin_2_3_2/index.php" method="post">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="submit" value="<?php echo $LDContinue ?>">
</form><p>
<form action="edv.php" method="post">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="hidden" name="target" value="sqldb">
<input type="submit" value="<?php echo $LDCancel ?>">
</form>
</font>
</body>
</html>
