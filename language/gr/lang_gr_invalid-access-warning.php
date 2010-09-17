<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
require_once($root_path.'include/inc_img_fx.php');
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-7">
 <TITLE>������������� ������������ ���������</TITLE>
</HEAD>

<BODY bgcolor="#ffffff">

<table width=100% border=1>
<tr>
<td bgcolor="navy">
<FONT  COLOR="white"  SIZE=+3  FACE="Arial"><STRONG>&nbsp;���������� �� ���������������� ��������� �������</STRONG></FONT>
</td>
</tr>
<tr>
<td ><p><br>


<center>
<FONT    SIZE=3 color=red  FACE="Arial">
<b>��� ����� ����� ��������� �� ���� �� �������!</b></font><p>
<FORM >
<INPUT type="button"  value=" OK "  onClick="<?php if ($mode=="close") print 'window.close()'; else print 'history.back()'; ?>"></FORM>
<p>
</font>
</center>
<p>
<ul>
<font size=3 face="verdana,arial">
������� ������ ��� �����������:
</FONT><p>
<font size=2 face="verdana,arial">
<img <?php echo createComIcon('../../','achtung.gif') ?>>
������ �� ����� �������������� �� ������� "����" � "������" ��� ���������(browser) �����������. ��������� ���� �� �������.<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
������ �� ����� ��������� ��� cookie. �� ��������� ��������� ��� �� cookies ��� �� ������������ �����. �������� �� ������� �� cookies.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
� ���������� ��� ������ �� ��� ������� �� cookies. �������� �������� ��� ��������� ��� ���� �� ������� �� cookies ��������.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
� ���������� ��� ������ �� ��� ����� �� ���� �� ������ javascript � �� javascript �� ���� ����� ����� �����������. �������� ������������� �� javascript ���� ��������� ���.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
�� ������� ����������� ������ �� ���� ������� ��� ����� ��� ��������
��� ���������.  ��� �� ���������� ��� ��������� ����� ���� ��� ������ "��������" ��� ��������� �����������.
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
