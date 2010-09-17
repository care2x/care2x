<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
require_once($root_path.'include/core/inc_img_fx.php');
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
 <TITLE>ÎÞÐ§·ÃÎÊµÄ¾¯Ê¾</TITLE>
</HEAD>

<BODY bgcolor="#ffffff">

<table width=100% border=1>
<tr>
<td bgcolor="navy">
<FONT  COLOR="white"  SIZE=+3  FACE="Arial"><STRONG>&nbsp;Î´ÊÚÈ¨Ò³ÃæµÄ·ÃÎÊ</STRONG></FONT>
</td>
</tr>
<tr>
<td ><p><br>


<center>
<FONT    SIZE=3 color=red  FACE="Arial">
<b>ÄúÃ»ÓÐÈ¨ÏÞ´ò¿ª´ËÎÄµµ£¡</b></font><p>
<FORM >
<INPUT type="button"  value=" OK "  onClick="<?php if ($mode=="close") print 'window.close()'; else print 'history.back()'; ?>"></FORM>
<p>
</font>
</center>
<p>
<ul>
<font size=3 face="verdana,arial">
Òý·¢´ËÎÊÌâµÄ¿ÉÄÜÔ­Òò£º
</FONT><p>
<font size=2 face="verdana,arial">
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Äú¿ÉÄÜÊ¹ÓÃÁËä¯ÀÀÆ÷ÖÐµÄ¡°ºóÍË¡±»ò¡°Ç°½ø¡±¹¦ÄÜ¡£Çë±ÜÃâÊ¹ÓÃÕâÐ©°´Å¥¡£<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Äú¿ÉÄÜ¾Ü¾ø½ÓÊÜcookie¡£±¾³ÌÐòµÄÕýÈ·ÔËÐÐÒÀÀµÓÚcookies¡£ÇëÉè¶¨ÄúµÄä¯ÀÀÆ÷½ÓÊÜcookies¡£<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
ÄúµÄä¯ÀÀÆ÷Ã»ÓÐ½ÓÊÜcookies¡£ÇëÉè¶¨ÄúµÄä¯ÀÀÆ÷×Ô¶¯½ÓÊÜcookies¡£<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
ÄúµÄä¯ÀÀÆ÷²»ÄÜÔËÐÐJavaScript»òJavaScript±»½ûÖ¹¡£ÇëÉè¶¨ÄúµÄä¯ÀÀÆ÷ÔÊÐíÔËÐÐJavaScript¡£<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
¼«ÉÙÊýÇé¿öÏÂÔÚÊý¾Ý´«Êä¹ý³ÌÖÐ·¢ÉúÁË´íÎó£¬´ËÊ±ÇëÔÚä¯ÀÀÆ÷ÄÚµã»÷¡°Ë¢ÐÂ¡±°´Å¥¡£<p>
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
