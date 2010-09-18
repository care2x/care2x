<?php
/* Translation by Emir Prcic <e.prcic@gmx.net> */
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
require_once($root_path.'include/core/inc_img_fx.php');
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php
/* Translation by Emir Prcic <e.prcic@gmx.net> */ html_rtl($lang); ?>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
 <TITLE>Invalid Access Warning</TITLE>
</HEAD>

<BODY bgcolor="#ffffff">

<table width=100% border=1>
<tr>
<td bgcolor="navy">
<FONT  COLOR="white"  SIZE=+3  FACE="Arial"><STRONG>&nbsp;Ne Autoriziran pristup stranici</STRONG></FONT>
</td>
</tr>
<tr>
<td ><p><br>


<center>
<FONT    SIZE=3 color=red  FACE="Arial">
<b>Vi nemate pristupnih prava da otvorite ovaj dokumenat!</b></font><p>
<FORM >
<INPUT type="button"  value=" OK "  onClick="<?php
/* Translation by Emir Prcic <e.prcic@gmx.net> */ if ($mode=="close") print 'window.close()'; else print 'history.back()'; ?>"></FORM>
<p>
</font>
</center>
<p>
<ul>
<font size=3 face="verdana,arial">
Najvjerovatniji razlog ovog problema:
</FONT><p>
<font size=2 face="verdana,arial">
<img <?php
/* Translation by Emir Prcic <e.prcic@gmx.net> */ echo createComIcon('../../','achtung.gif') ?>>
Mo�da ste koristili standardne "Back" or "Forward" funkcije va�eg browsera. Izbjegavajte koristiti te standardne funkcije.<br>
<img <?php
/* Translation by Emir Prcic <e.prcic@gmx.net> */ echo createComIcon('../../','achtung.gif') ?>>
Mo�da ste odbili primiti cookie. Ovaj program ovidi o cookies. Molimo vas da prihvatite cookies
<br>
<img <?php
/* Translation by Emir Prcic <e.prcic@gmx.net> */ echo createComIcon('../../','achtung.gif') ?>>
Va� browser ne mo�e primiti. Molimo vas da korektno podesite browser.
<br>
<img <?php
/* Translation by Emir Prcic <e.prcic@gmx.net> */ echo createComIcon('../../','achtung.gif') ?>>
Nemate podr�ku za Javascript. Molimo da ukljucite JavaScript u va�em browseru.
<br>
<img <?php
/* Translation by Emir Prcic <e.prcic@gmx.net> */ echo createComIcon('../../','achtung.gif') ?>>
U rijetkim slu�ajevima mo�e se dogoditi da je do�lo do gre�ke u komunikaciji. Da bi ispravili ovu gre�ku samo kliknite na
"reload" dugme u va�em browseru.
<p>
</FONT>
<p>
</ul>
</td>
</tr>
</table>        
<p>

<?php
/* Translation by Emir Prcic <e.prcic@gmx.net> */
require($root_path.'include/core/inc_load_copyrite.php'); 
?>
</FONT>


</BODY>
</HTML>
