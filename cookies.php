<?php 
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require_once('./roots.php');
require_once('include/inc_environment_global.php');
require("language/$lang/lang_".$lang."_startframe.php"); ?>
<html>
<head>
<?php 

include_once('include/inc_charset_fx.php');

echo setCharSet(); 

?>
<TITLE><?php echo $LDMainTitle ?></TITLE>
<meta name="Description" content="Care2x  Integrated Hospital & Healthcare Information System">
<meta name="Keywords" content="hospital, health, care, medicine, doctor, nurse, nursing, integrated information system for hospitals, integrated, information, barcode, patient, outpatient, inpatient, ambulant, emergency, unfall, notfall, praxis, hno, chirurgie, surgery, cardiology, obgyn, gyn, ambulance, CARE 2002, care, 2002, OSD, open source development, osd software, health care, health care management, research institute, elpidio, latorilla, bong, elatorilla, ebong, pflege, krankenpflege, interaktiv, stuttgart, pflegebuch, handbuch, soziologie, marienhospital, online, calendar, unterricht">
<meta name="Author" content="Elpidio Latorilla">
</head>
<BODY bgcolor=white>
<center>
<p><br><p><br>
<font color="#990000" size=4 face="verdana,arial">
<?php echo $LDAlertNoCookie ?>
<a href="<?php if($startframe) print "index.php?lang=$lang"; else print "index.php?lang=$lang&egal=1"; ?>" 
<?php if($startframe) print ' target="_top"'; ?>><font size=2><u> <?php echo $LDClkAfter ?></u></font></a>
<BR>
<p><br>
<p><br>
<font size=3>
<A HREF="<?php echo "index.php?lang=$lang&egal=1&sid=egal&cookie=egal" ?>" <?php if($startframe) print ' target="_top"'; ?>><u><?php echo $LDGoAheadEgalCookie ?></u></A>
</font>
<font size=2 color="#000000">
<p><br>
<?php echo "$LDCookieRef<p>$LDPrivPolicy" ?>
</font>

</font>
</center>
</BODY>
</html>
