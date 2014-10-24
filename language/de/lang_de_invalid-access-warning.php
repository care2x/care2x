<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
require_once($root_path.'include/core/inc_img_fx.php');
$lang='de';
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
 <TITLE>Unerlaubter Zugriff</TITLE>
</HEAD>

<BODY bgcolor="#ffffff">

<table width=100% border=1>
<tr>
<td bgcolor="navy">
<FONT  COLOR="white"  SIZE=+3  FACE="Arial"><STRONG>&nbsp;Unerlaubter Zugriff</STRONG></FONT>
</td>
</tr>
<tr>
<td ><p><br>


<center>
<FONT    SIZE=3 color=red  FACE="Arial">
<b>Sie sind nicht berechtigt dieses Dokument zu öffnen!</b></font><p>
<FORM >
<INPUT type="button"  value=" OK "  onClick="<?php if ($mode=="close") print 'window.close()'; else print 'history.back()'; ?>"></FORM>
<p>
</font>
</center>

<p>
<ul>
<font size=3 face="verdana,arial">
M&#246;gliche Ursachen des Problems:
</FONT><p>
<font size=2 face="verdana,arial">
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Sie h&#228;tten die "Zur&#252;ck" oder "Vorw&#228;rts" Funktion des Browsers benutzt. Vermeiden Sie bitte diese Funktionen bzw. Kn&#246;pfe zu benutzen.<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Sie h&#228;tten eine Cookie abgelehnt. Dieses Program ist von Cookies abh&#228;ngig um einwandfrei zu laufen. Nehmen Sie bitte
die Cookies an.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Ihr Browser nehme keine Cookies an. Stellen Sie bitte Ihren Browser zur automatischen Annahme von Cookies ein.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Ihr Browser w&#252;rde Javascript nicht unterst&#252;tzen oder das Javascript k&#246;nnte ausgeschaltet sein. Schalten Sie bitte das
Javascript ein.<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
In seltenen F&#252;llen k&#246;nnte die Daten&#252;bertragung gest&#246;rt gewesen sein. Klicken Sie den "Aktualisieren" in Ihrem Browser an.
<p>

</FONT>
<p>
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