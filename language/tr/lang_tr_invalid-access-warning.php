<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
require_once($root_path.'include/core/inc_img_fx.php');
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
 <TITLE>Geçersiz Eriþim Uyarýsý </TITLE>
</HEAD>

<BODY bgcolor="#ffffff">

<table width=100% border=1>
<tr>
<td bgcolor="navy">
<FONT  COLOR="white"  SIZE=+3  FACE="Arial"><STRONG>&nbsp;Yetkisiz Sayfa Eriþimi </STRONG></FONT>
</td>
</tr>
<tr>
<td ><p><br>


<center>
<FONT    SIZE=3 color=red  FACE="Arial">
<b>Bu belgeye eriþim hakkýnýz bulunmamaktadýr!</b></font><p>
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
Tarayýcýnýzýn standart "geri" veya "ileri" düðmesini kullandýnýz. Bu düðmeleri kullanmaktan kaçýnýnýz.<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Bir çerezi reddetmiþ olabilirsiniz. Bu programýn düzgün olarak çalýþmasý için çerezler gerekiyor. O bakýmdan lütfen çerezleri kabul ediniz.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Tarayýcýnýz çerezleri kabul etmiyor olabilir. Çerezleri otomatik kabul edecek þekilde arayýnýz.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Tarayýcýnýz javascript çalýþtýramaya bilir ya da kapatýlmýþ olabilir.Lütfen tarayýcýnýzda javascriptleri etkinleþtiriniz.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Nadir hallerde veri transferinde bir hata olabilir. Bu durumu düzeltmek için tarayýcýnýzýn "yenile" düðmesini týklayýnýz.
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
