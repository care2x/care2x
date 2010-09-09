<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
require_once($root_path.'include/inc_img_fx.php');
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
 <TITLE>Invalid Access Warning</TITLE>
</HEAD>

<BODY bgcolor="#ffffff">

<table width=100% border=1>
<tr>
<td bgcolor="navy">
<FONT  COLOR="white"  SIZE=+3  FACE="Arial"><STRONG>&nbsp;Unauthorized Page Access</STRONG></FONT>
</td>
</tr>
<tr>
<td ><p><br>


<center>
<FONT    SIZE=3 color=red  FACE="Arial">
<b>You have no access rights to open this document!</b></font><p>
<FORM >
<INPUT type="button"  value=" OK "  onClick="<?php if ($mode=="close") print 'window.close()'; else print 'history.back()'; ?>"></FORM>
<p>
</font>
</center>
<p>
<ul>
<font size=3 face="verdana,arial">
Probable causes of this problem:
</FONT><p>
<font size=2 face="verdana,arial">
<img <?php echo createComIcon('../../','achtung.gif') ?>>
You might have used the standard "Back" or "Forward" function of your browser. Avoid using these buttons.<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
You might have rejected a cookie. The program is dependent on cookies to operate properly. So please accept the
cookies.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Your browser might not be accepting cookies. Please set up your browser to accept cookies automatically.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Your browser might not be able to run javascript or the javascript might be disabled. Please enable the javascript in your browser.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
In rare cases there might have been an error in the data transfer. To correct the situation just click the
"reload" button of your browser.
<p>
</FONT>
<p>
</ul>
</td>
</tr>
</table>        
<p>


</FONT>


</BODY>
</HTML>
