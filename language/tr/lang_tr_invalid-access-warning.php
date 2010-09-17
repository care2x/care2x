<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
require_once($root_path.'include/inc_img_fx.php');
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
 <TITLE>Ge�ersiz Eri�im Uyar�s� </TITLE>
</HEAD>

<BODY bgcolor="#ffffff">

<table width=100% border=1>
<tr>
<td bgcolor="navy">
<FONT  COLOR="white"  SIZE=+3  FACE="Arial"><STRONG>&nbsp;Yetkisiz Sayfa Eri�imi </STRONG></FONT>
</td>
</tr>
<tr>
<td ><p><br>


<center>
<FONT    SIZE=3 color=red  FACE="Arial">
<b>Bu belgeye eri�im hakk�n�z bulunmamaktad�r!</b></font><p>
<FORM >
<INPUT type="button"  value=" Tamam "  onClick="<?php if ($mode=="close") print 'window.close()'; else print 'history.back()'; ?></FORM>
<p>
</font>
</center>
<p>
<ul>
<font size=3 face="verdana,arial">
Bu problemin muhtemel sebepleri:
</FONT><p>
<font size=2 face="verdana,arial">
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Taray�c�n�z�n standart "geri" veya "ileri" d��mesini kulland�n�z. Bu d��meleri kullanmaktan ka��n�n�z.<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Bir �erezi reddetmi� olabilirsiniz. Bu program�n d�zg�n olarak �al��mas� i�in �erezler gerekiyor. O bak�mdan l�tfen �erezleri kabul ediniz.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Taray�c�n�z �erezleri kabul etmiyor olabilir. �erezleri otomatik kabul edecek �ekilde aray�n�z.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Taray�c�n�z javascript �al��t�ramaya bilir ya da kapat�lm�� olabilir.L�tfen taray�c�n�zda javascriptleri etkinle�tiriniz.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Nadir hallerde veri transferinde bir hata olabilir. Bu durumu d�zeltmek i�in taray�c�n�z�n "yenile" d��mesini t�klay�n�z.
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
