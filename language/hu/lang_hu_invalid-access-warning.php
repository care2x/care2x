<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
require_once($root_path.'include/inc_img_fx.php');
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<meta http-equiv="�sszetev� T�pusa" content="text/html; charset=utf8">
 <TITLE>Nem �rv�nyes hozz�f�r�s figyelmeztet�s</TITLE>
</HEAD>

<BODY bgcolor="#ffffff">

<table width=100% border=1>
<tr>
<td bgcolor="navy">
<FONT  COLOR="white"  SIZE=+3  FACE="Arial"><STRONG>&nbsp;Igazolatlan oldal hozz�f�r�s</STRONG></FONT>
</td>
</tr>
<tr>
<td ><p><br>


<center>
<FONT    SIZE=3 color=red  FACE="Arial">
<b>�nnek nincs hozz�f�r�si jogosults�ga a dokumentumhoz!</b></font><p>
<FORM >
<INPUT type="button"  value=" OK "  onClick="<?php if ($mode=="close") print 'window.close()'; else print 'history.back()'; ?>"></FORM>
<p>
</font>
</center>
<p>
<ul>
<font size=3 face="verdana,arial">
A probl�m�t okozhatja az al�bbiak egyike:
</FONT><p>
<font size=2 face="verdana,arial">
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Haszn�lhatja ink�bb a b�ng�sz� "Vissza (Back)" or "El�re (Forward)" funkci�j�t. Ker�lje ezeknek a gomboknak a haszn�lat�t.<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
A "cookie"-k tiltva vannak. A program megfelel� m�k�d�s�hez elengedhetetlen a "cookie"-k haszn�lata, ez�rt k�rj�k enged�lyezze.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
A b�ng�sz�je nem fogadja a "cookie"-kat. K�rj�k �ll�tsa be a b�ng�sz�ben, hogy a "cookie"-k automatikusan fogad�sra ker�ljenek"
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
A b�ng�sz�je val�sz�n�leg nem tudja futtatni a java szkripetet vagy a java szkript futtat�sa tiltva van. K�rj�k enged�lyezze a b�ng�sz�ben a java szkriptek futtat�s�t.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
El�rodulthat -ritka esetben-, hogy az adat�tvitel nem siker�l. Ilyenkor k�rj�k nyomja meg a b�ng�sz�ben a
"Friss�t�s (reload)" gombot, a probl�ma kik�sz�b�l�s�re.
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
