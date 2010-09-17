<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
require_once($root_path.'include/inc_img_fx.php');
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
 <TITLE>Varov�n� neplatn�ho p��stupu</TITLE>
</HEAD>

<BODY bgcolor="#ffffff">

<table width=100% border=1>
<tr>
<td bgcolor="navy">
<FONT  COLOR="white"  SIZE=+3  FACE="Arial"><STRONG>&nbsp;Neautorizovan� p��stup ke str�nce</STRONG></FONT>
</td>
</tr>
<tr>
<td ><p><br>


<center>
<FONT    SIZE=3 color=red  FACE="Arial">
<b>Nem�te platn� �i dostate�n� p��stupov� pr�va na otev�en� tohoto dokumentu!</b></font><p>
<FORM >
<INPUT type="button"  value=" OK "  onClick="<?php if ($mode=="close") print 'window.close()'; else print 'history.back()'; ?>"></FORM>
<p>
</font>
</center>
<p>
<ul>
<font size=3 face="verdana,arial">
Pravd�podobn� p���iny tohoto probl�mu:
</FONT><p>
<font size=2 face="verdana,arial">
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Pravd�podob� jste pou�il(a) tla��tka "Zp�t / Back" nebo  "Vp�ed / Forward"  Va�eho prohl�e�e. Pros�m vyvarujte se jejich pou��v�n�.<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
V� prohl�e� neakceptuje "cookie", kter� jsou nezbytn� pro spr�vnou funkci programu. Pros�m zm��te nastaven� Va�eho prohl�e�e.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
M�te zak�z�n p��jem "cookie". Pros�m zm��te nastaven� V�eho prohl�e�e.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
V� prohl�e� nen� schopen spou�t�t javascripty nebo je jejich spou�t�n� zak�z�no. Pros�m povolte spou�t�n� javascript�.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Ob�as se m�e jednat o chybu p�enosu dat ze serveru. Jednodu�e stiskn�te tla��tko  "Obnovit / Reload".
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
require('cs-iso_copyrite.php');
?>
</FONT>


</BODY>
</HTML>
