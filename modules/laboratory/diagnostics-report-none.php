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
define('LANG_FILE','nursing.php');
$local_user='ck_pflege_user';
require_once($root_path.'include/inc_front_chain_lang.php');

$breakfile=$root_path."modules/nursing/nursing-station-patientdaten.php".URL_APPEND."&station=$station&pn=$pn&edit=$edit";
?>
<?php html_rtl($lang); ?>
<head>
<title></title>
<?php require($root_path.'include/inc_css_a_hilitebu.php'); ?>
</head>
<body>

<table border=0>
  <tr>
    <td><img <?php  echo createMascot($root_path,'mascot1_r.gif','0') ?></td>
    <td class="warnprompt"><?php echo $LDNoDiagReport ?></td>
  </tr>
</table>
<p><br>
<a href="<?php echo $breakfile ?>" target="_top"><img <?php echo createLDImgSrc($root_path,'back2.gif','0') ?>>
</a>
</body>
</html>
