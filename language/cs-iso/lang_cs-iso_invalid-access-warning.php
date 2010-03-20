<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
require_once($root_path.'include/inc_img_fx.php');
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
 <TITLE>Varování neplatného přístupu</TITLE>
</HEAD>

<BODY bgcolor="#ffffff">

<table width=100% border=1>
<tr>
<td bgcolor="navy">
<FONT  COLOR="white"  SIZE=+3  FACE="Arial"><STRONG>&nbsp;Neautorizovaný přístup ke stránce</STRONG></FONT>
</td>
</tr>
<tr>
<td ><p><br>


<center>
<FONT    SIZE=3 color=red  FACE="Arial">
<b>Nemáte platná či dostatečná přístupová práva na otevření tohoto dokumentu!</b></font><p>
<FORM >
<INPUT type="button"  value=" OK "  onClick="<?php if ($mode=="close") print 'window.close()'; else print 'history.back()'; ?>"></FORM>
<p>
</font>
</center>
<p>
<ul>
<font size=3 face="verdana,arial">
Pravděpodobné příčiny tohoto problému:
</FONT><p>
<font size=2 face="verdana,arial">
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Pravděpodobě jste použil(a) tlačítka "Zpět / Back" nebo  "Vpřed / Forward"  Vašeho prohlížeče. Prosím vyvarujte se jejich používání.<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Váš prohlížeč neakceptuje "cookie", které jsou nezbytné pro správnou funkci programu. Prosím změňte nastavení Vašeho prohlížeče.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Máte zakázán příjem "cookie". Prosím změňte nastavení Všeho prohlížeče.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Váš prohlížeč není schopen spouštět javascripty nebo je jejich spouštění zakázáno. Prosím povolte spouštění javascriptů.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Občas se může jednat o chybu přenosu dat ze serveru. Jednoduše stiskněte tlačítko  "Obnovit / Reload".
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
