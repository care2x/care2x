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
 <TITLE>Acc�s non authoris� de la page</TITLE>
</HEAD>

<BODY bgcolor="#ffffff">

<table width=100% border=1>
<tr>
<td bgcolor="navy">
<FONT  COLOR="white"  SIZE=+3  FACE="Arial"><STRONG>&nbsp;Acc�s non authoris� de la page</STRONG></FONT>
</td>
</tr>
<tr>
<td ><p><br>


<center>
<FONT    SIZE=3 color=red  FACE="Arial">
<b>Vous n'avez pas les droits d'acc�s pour ouvrir ce document!</b></font><p>
<FORM >
<INPUT type="button"  value=" OK "  onClick="<?php if ($mode=="close") print 'window.close()'; else print 'history.back()'; ?>"></FORM>
<p>
</font>
</center>
<p>
<ul>
<font size=3 face="verdana,arial">
Les causes possibles de ce probl�me:
</FONT><p>
<font size=2 face="verdana,arial">
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Vous avez peut-�tre utilis� les touches standard "R�tour" ou "Avancer" de votre navigateur. Veuillez �vitez de les utiliser.<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Vous avez peut-�tre rejet� une cookie. Le programme d�pend des cookies pour fonctionner correctement. Veuillez accepter les cookies.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Votre navigateur n'accepte peut-�tre pas les cookies. Veuillez configurer votre navigateur afin d'accepter les cookies automatiquement.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Votre navigateur n'est peut-�tre pas capable d'ex�cuter javascript ou la fonction javasscript a �t� interdite. Veuillez activer javascript dans votre navigateur.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Dans de rares cas il a pu y avoir une erreur dans le transfert des donn�es. Afin de r�soudre cette situation, veuillez cliquer sur le bouton "Recharger".
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
