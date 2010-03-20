<?php 
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
require_once($root_path.'include/inc_img_fx.php');
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <TITLE>Attenzione: accesso non valido</TITLE>
</HEAD>
<BODY BACKGROUND="leinwand.gif">
<table width=100% border=1>
<tr>
<td bgcolor="navy">
<FONT  COLOR="white"  SIZE=+3  FACE="Arial"><STRONG>&nbsp;Accesso negato alla pagina</STRONG></FONT>
</td>
</tr>
<tr>
<td ><p><br>
<center>
<FONT    SIZE=3 color=red  FACE="Arial">
<b>Non si hanno i diritti di accesso a questo documento!</b></font><p>
<FORM >
<INPUT type="button"  value=" OK "  onClick="<?php if ($mode=="close") print 'window.close()'; else print 'history.back()'; ?>"></FORM>
<p>
</font>
</center>
<p>
<ul>
<font size=3 face="verdana,arial">
Alcune cause possono essere:
</FONT><p>
<font size=2 face="verdana,arial">
<img <?php echo createComIcon('../../','achtung.gif') ?>>
si è fatto uso dei tasti "Avanti" e "Indietro" del browser: bisognerebbe evitare di usarli.<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
il browser ha rifiutato un cookie. Configurare il browser in modo da accettarli, perché l'applicativo
nel fa uso.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
il browser potrebbe non essere in grado di eseguire javascript, oppure i javascript potrebbero essere
disattivati. Dato che l'applicativo li usa, è necessario attivarli.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
In alcuni rari casi, possono esserci stati degli errori di trasferimento dati: in questo caso è 
sufficiente premere il bottone "Ricarica" del browser.
<p>
</FONT>
<p>
</ul>
</td>
</tr>
</table>        
<p>
<?php
$root_path='../../';
require('it_copyrite.php'); 
?>
</FONT>
</BODY>
</HTML>
