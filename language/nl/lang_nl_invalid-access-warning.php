<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
require_once($root_path.'include/core/inc_img_fx.php');
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
 <TITLE>ONGELDIGE TOEGANG</TITLE>
</HEAD>

<BODY bgcolor="#ffffff">

<table width=100% border=1>
<tr>
<td bgcolor="navy">
<FONT  COLOR="white"  SIZE=+3  FACE="Arial"><STRONG>&nbsp;Geen toegang tot pagina</STRONG></FONT>
</td>
</tr>
<tr>
<td ><p><br>


<center>
<FONT    SIZE=3 color=red  FACE="Arial">
<b>U heeft geen toegangsrechten om deze pagina te openen!</b></font><p>
<FORM >
<INPUT type="button"  value=" OK "  onClick="<?php if ($mode=="close") print 'window.close()'; else print 'history.back()'; ?>"></FORM>
<p>
</font>
</center>
<p>
<ul>
<font size=3 face="verdana,arial">
Mogelijke oorzaak van dit probleem:
</FONT><p>
<font size=2 face="verdana,arial">
<img <?php echo createComIcon('../../','achtung.gif') ?>>
U heeft de standaard "Vorige" of "Volgende" knoppen gebruikt van uw browser. Probeer deze knoppen niet te gebruiken.<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
U browser ONDERSTEUND geen cookies. Het programma gebruik cookies. Controleer de versie van uw browser.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
U browser ACCEPTEERD geen cookies. Het programma gebruik cookies. Controleer de instellingen van uw browser.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Uw browser accepteerd geen javascript. Controleer de instellingen.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Er is een probleem met de datatransfer. Klik op vernieuwen om dit op te lossen
<p>
</FONT>
<p>
</ul>
</td>
</tr>
</table>        
<p>

<?php
require($root_path.'include/inc_load_copyrite.php'); 
?>
</FONT>


</BODY>
</HTML>
