<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
require_once($root_path.'include/core/inc_img_fx.php');
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML dir=rtl>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1256">
<TITLE>Invalid Access Warning</TITLE>
</HEAD>

<BODY bgcolor="#ffffff">

<table width=100% border=1>

<tr>
<td bgcolor="navy" align=right >
<FONT  COLOR="white"  SIZE=+3  FACE="arial"><STRONG>&nbsp;ÕÝÍÉ ÛíÑ ãÑÎÕ ÈÇáæÕæá</STRONG></FONT>
</td>
</tr>

<tr>
<td align=right>
<p><br>
<center>
<FONT    SIZE=3 color=red  FACE="Tahoma">
<b>áíÓ áÏíß ÇáÍÞ áÝÊÍ åÐÇ ÇáãÓÊäÏ</b></font>
<p>
<FORM >
<INPUT type="button"  value=" ãæÇÝÞ "  onClick="<?php if ($mode=="close") print 'window.close()'; else print 'history.back()'; ?>"></FORM>
<p>
</font>
</center>
<p>

<ul>
<font size=3 face="Tahoma">
ÅÍÊãÇáÇÊ ÃÓÈÇÈ ÍÏæË åÐå ÇáãÔßáÉ:
</FONT>

<p>
<font size=2 face="Tahoma">
<img <?php echo createComIcon('../../','achtung.gif') ?>>
ãä Çáããßä Åäå Êã ÅÓÊÎÏÇã ÃÒÑÇÑ ÇáÊÞÏã æ ÇáÑÌæÚ Ýí ãÓÊÚÑÖß ÇáÎÇÕ.<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
ãä Çáããßä Åäß ÑÝÖÊ ÎÇÕíÉ Çáßæßí, åÐÇ ÇáÈÑäÇãÌ íÚÊãÏ Úáì Çáßæßí áíÚãá ÈÏÞÉ, áÐì ÅÞÈá ÎÇÕíÉ Çáßæßí ÅÐÇ ØáÈ ãäß ÇáÈÑäÇãÌ \áß ãÑÉ ÃÎÑì.<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
ãä Çáããßä Ãä ãÓÊÚÑÖß áÇ íÞÈá Çáßæßí, áÐì Þã ÈÇÚÏÇÏ ãÓÊÚÑÖß áíÞÈá Çáßæßí ÊáÞÇÆíÇ.<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
ãä Çáããßä Ãä íßæä ãÓÊÚÑÖß ÛíÑ ÞÇÏÑ Úáì ÊÔÛíá ÇáÌÇÝÇÓßÑÈÊ, Ãæ Çä ÌÇÝÇÓßÑÈÊ ÞÏ Êã ÅÈØÇáåÇ, áÐì Þã ÈÊãßíä ÌÇÝÇÓßÑÈÊ.<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Ýí ÍÇáÇÊ äÇÏÑÉ ãä Çáããßä Ãä íßæä åäÇß ÎØÃ Ýí ÚãáíÉ äÞá ÇáÈíÇäÇÊ, áÊÕÍíÍ åÐÇ ÇáæÖÚ Þã ÈÇáÖÛØ Úáì ÒÑ ÇáÇäÚÇÔ F5 Ýí ãÓÊÚÑÖß.
<p>
</FONT>
<p>
</ul>
</td>
</tr>
</table>        
<p>

<?php
require($root_path.'include/core/inc_load_copyrite.php'); 
?>
</FONT>


</BODY>
</HTML>
