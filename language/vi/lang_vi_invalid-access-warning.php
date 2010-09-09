<?php
# Translated by Phu Nguyen Manh <nmphu_vn@yahoo.com>
# 2004-01-05
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
require_once($root_path.'include/inc_img_fx.php');
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
 <TITLE>C&#7843;nh b&#225;o truy nh&#7853;p kh&#244;ng h&#7907;p l&#7879;</TITLE>
</HEAD>

<BODY bgcolor="#ffffff">

<table width=100% border=1>
<tr>
<td bgcolor="navy">
<FONT  COLOR="white"  SIZE=+3  FACE="Arial"><STRONG>&nbsp;Truy nh&#7853;p trang kh&#244;ng &#273;&#432;&#7907;c ph&#233;p</STRONG></FONT>
</td>
</tr>
<tr>
<td ><p><br>


<center>
<FONT    SIZE=3 color=red  FACE="Arial">
<b>B&#7841;n kh&#244;ng c&#243; quy&#7873;n &#273;&#7875; m&#7903; t&#224;i li&#7879;u n&#224;y!</b></font><p>
<FORM >
<INPUT type="button"  value="&#272;&#243;ng l&#7841;i"  onClick="<?php if ($mode=="close") print 'window.close()'; else print 'history.back()'; ?>"></FORM>
<p>
</font>
</center>
<p>
<ul>
<font size=3 face="verdana,arial">
C&#225;c nguy&#234;n nh&#226;n c&#243; th&#7875; c&#7911;a v&#7845;n &#273;&#7873; n&#224;y l&#224;:
</FONT><p>
<font size=2 face="verdana,arial">
<img <?php echo createComIcon('../../','achtung.gif') ?>>
C&#243; th&#7875; b&#7841;n v&#7915;a m&#7899;i s&#7917; d&#7909;ng ch&#7913;c n&#259;ng <b>"Back"</b> ho&#7863;c <b>"Forward"</b> chu&#7849;n c&#7911;a tr&#236;nh duy&#7879;t. Tr&#225;nh s&#7917; d&#7909;ng c&#225;c n&#250;t n&#224;y.<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
C&#243; th&#7875; b&#7841;n v&#7915;a t&#7915; ch&#7889;i m&#7897;t cookie. Ch&#432;&#417;ng tr&#236;nh n&#224;y ph&#7909; thu&#7897;c v&#224;o c&#225;c cookie &#273;&#7875; ho&#7841;t &#273;&#7897;ng &#273;&#432;&#7907;c &#273;&#250;ng.
H&#227;y ch&#7845;p nh&#7853;n c&#225;c cookie.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
C&#243; th&#7875; tr&#236;nh duy&#7879;t c&#7911;a b&#7841;n &#273;ang kh&#244;ng ch&#7845;p nh&#7853;n c&#225;c cookie.
H&#227;y thi&#7871;t l&#7853;p tr&#236;nh duy&#7879;t c&#7911;a b&#7841;n ch&#7845;p nh&#7853;n c&#225;c cookie m&#7897;t c&#225;ch t&#7921; &#273;&#7897;ng.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Tr&#236;nh duy&#7879;t c&#7911;a b&#7841;n c&#243; th&#7875; kh&#244;ng ch&#7841;y &#273;&#432;&#7907;c javascript ho&#7863;c javascript b&#7883; v&#244; hi&#7879;u ho&#225;.
H&#227;y ho&#7841;t ho&#225; javascript trong tr&#236;nh duy&#7879;t c&#7911;a b&#7841;n.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Trong c&#225;c tr&#432;&#7901;ng h&#7907;p hi&#7871;m v&#7851;n c&#243; th&#7875; c&#243; m&#7897;t l&#7895;i trong vi&#7879;c truy&#7873;n d&#7919; li&#7879;u.
&#272;&#7875; kh&#7855;c ph&#7909;c t&#236;nh hu&#7889;ng n&#224;y ch&#7881; vi&#7879;c b&#7845;m v&#224;o n&#250;t <b>"Reload"</b> c&#7911;a tr&#236;nh duy&#7879;t.
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
