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
 <TITLE>Accès non authorisé de la page</TITLE>
</HEAD>

<BODY bgcolor="#ffffff">

<table width=100% border=1>
<tr>
<td bgcolor="navy">
<FONT  COLOR="white"  SIZE=+3  FACE="Arial"><STRONG>&nbsp;Accès non authorisé de la page</STRONG></FONT>
</td>
</tr>
<tr>
<td ><p><br>


<center>
<FONT    SIZE=3 color=red  FACE="Arial">
<b>Vous n'avez pas les droits d'accès pour ouvrir ce document!</b></font><p>
<FORM >
<INPUT type="button"  value=" OK "  onClick="<?php if ($mode=="close") print 'window.close()'; else print 'history.back()'; ?>"></FORM>
<p>
</font>
</center>
<p>
<ul>
<font size=3 face="verdana,arial">
Les causes possibles de ce problème:
</FONT><p>
<font size=2 face="verdana,arial">
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Vous avez peut-être utilisé les touches standard "Rétour" ou "Avancer" de votre navigateur. Veuillez évitez de les utiliser.<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Vous avez peut-être rejeté une cookie. Le programme dépend des cookies pour fonctionner correctement. Veuillez accepter les cookies.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Votre navigateur n'accepte peut-être pas les cookies. Veuillez configurer votre navigateur afin d'accepter les cookies automatiquement.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Votre navigateur n'est peut-être pas capable d'exécuter javascript ou la fonction javasscript a été interdite. Veuillez activer javascript dans votre navigateur.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Dans de rares cas il a pu y avoir une erreur dans le transfert des données. Afin de résoudre cette situation, veuillez cliquer sur le bouton "Recharger".
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
