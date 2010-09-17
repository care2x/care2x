<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
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
<FONT  COLOR="white"  SIZE=+3  FACE="arial"><STRONG>&nbsp;���� ��� ���� �������</STRONG></FONT>
</td>
</tr>

<tr>
<td align=right>
<p><br>
<center>
<FONT    SIZE=3 color=red  FACE="Tahoma">
<b>��� ���� ���� ���� ��� �������</b></font>
<p>
<FORM >
<INPUT type="button"  value=" ����� "  onClick="<?php if ($mode=="close") print 'window.close()'; else print 'history.back()'; ?>"></FORM>
<p>
</font>
</center>
<p>

<ul>
<font size=3 face="Tahoma">
�������� ����� ���� ��� �������:
</FONT>

<p>
<font size=2 face="Tahoma">
<img <?php echo createComIcon('../../','achtung.gif') ?>>
�� ������ ��� �� ������� ����� ������ � ������ �� ������� �����.<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
�� ������ ��� ���� ����� ������, ��� �������� ����� ��� ������ ����� ����, ��� ���� ����� ������ ��� ��� ��� �������� \�� ��� ����.<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
�� ������ �� ������� �� ���� ������, ��� �� ������ ������� ����� ������ �������.<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
�� ������ �� ���� ������� ��� ���� ��� ����� �����������, �� �� ��������� �� �� �������, ��� �� ������ ���������.<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
�� ����� ����� �� ������ �� ���� ���� ��� �� ����� ��� ��������, ������ ��� ����� �� ������ ��� �� ������� F5 �� �������.
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
