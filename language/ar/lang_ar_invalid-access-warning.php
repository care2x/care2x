<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
require_once($root_path.'include/inc_img_fx.php');
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
<FONT  COLOR="white"  SIZE=+3  FACE="arial"><STRONG>&nbsp;صفحة غير مرخص بالوصول</STRONG></FONT>
</td>
</tr>

<tr>
<td align=right>
<p><br>
<center>
<FONT    SIZE=3 color=red  FACE="Tahoma">
<b>ليس لديك الحق لفتح هذا المستند</b></font>
<p>
<FORM >
<INPUT type="button"  value=" موافق "  onClick="<?php if ($mode=="close") print 'window.close()'; else print 'history.back()'; ?>"></FORM>
<p>
</font>
</center>
<p>

<ul>
<font size=3 face="Tahoma">
إحتمالات أسباب حدوث هذه المشكلة:
</FONT>

<p>
<font size=2 face="Tahoma">
<img <?php echo createComIcon('../../','achtung.gif') ?>>
من الممكن إنه تم إستخدام أزرار التقدم و الرجوع في مستعرضك الخاص.<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
من الممكن إنك رفضت خاصية الكوكي, هذا البرنامج يعتمد على الكوكي ليعمل بدقة, لذى إقبل خاصية الكوكي إذا طلب منك البرنامج \لك مرة أخرى.<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
من الممكن أن مستعرضك لا يقبل الكوكي, لذى قم باعداد مستعرضك ليقبل الكوكي تلقائيا.<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
من الممكن أن يكون مستعرضك غير قادر على تشغيل الجافاسكربت, أو ان جافاسكربت قد تم إبطالها, لذى قم بتمكين جافاسكربت.<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
في حالات نادرة من الممكن أن يكون هناك خطأ في عملية نقل البيانات, لتصحيح هذا الوضع قم بالضغط على زر الانعاش F5 في مستعرضك.
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
