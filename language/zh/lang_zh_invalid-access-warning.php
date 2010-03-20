<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
require_once($root_path.'include/inc_img_fx.php');
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
 <TITLE>无效访问的警示</TITLE>
</HEAD>

<BODY bgcolor="#ffffff">

<table width=100% border=1>
<tr>
<td bgcolor="navy">
<FONT  COLOR="white"  SIZE=+3  FACE="Arial"><STRONG>&nbsp;未授权页面的访问</STRONG></FONT>
</td>
</tr>
<tr>
<td ><p><br>


<center>
<FONT    SIZE=3 color=red  FACE="Arial">
<b>您没有权限打开此文档！</b></font><p>
<FORM >
<INPUT type="button"  value=" OK "  onClick="<?php if ($mode=="close") print 'window.close()'; else print 'history.back()'; ?>"></FORM>
<p>
</font>
</center>
<p>
<ul>
<font size=3 face="verdana,arial">
引发此问题的可能原因：
</FONT><p>
<font size=2 face="verdana,arial">
<img <?php echo createComIcon('../../','achtung.gif') ?>>
您可能使用了浏览器中的“后退”或“前进”功能。请避免使用这些按钮。<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
您可能拒绝接受cookie。本程序的正确运行依赖于cookies。请设定您的浏览器接受cookies。<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
您的浏览器没有接受cookies。请设定您的浏览器自动接受cookies。<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
您的浏览器不能运行JavaScript或JavaScript被禁止。请设定您的浏览器允许运行JavaScript。<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
极少数情况下在数据传输过程中发生了错误，此时请在浏览器内点击“刷新”按钮。<p>
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
