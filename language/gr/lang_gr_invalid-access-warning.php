<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
require_once($root_path.'include/core/inc_img_fx.php');
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-7">
 <TITLE>Ðñïåéäïðïßçóç áðïôõ÷çìÝíçò ðñüóâáóçò</TITLE>
</HEAD>

<BODY bgcolor="#ffffff">

<table width=100% border=1>
<tr>
<td bgcolor="navy">
<FONT  COLOR="white"  SIZE=+3  FACE="Arial"><STRONG>&nbsp;ÐñïóðÜèåéá ìç åîïõóéïäïôçìÝíçò ðñüóâáóçò óåëßäùí</STRONG></FONT>
</td>
</tr>
<tr>
<td ><p><br>


<center>
<FONT    SIZE=3 color=red  FACE="Arial">
<b>Äåí Ý÷åôå Üäåéá ðñüóâáóçò óå áõôü ôï Ýããñáöï!</b></font><p>
<FORM >
<INPUT type="button"  value=" OK "  onClick="<?php if ($mode=="close") print 'window.close()'; else print 'history.back()'; ?>"></FORM>
<p>
</font>
</center>
<p>
<ul>
<font size=3 face="verdana,arial">
ÐéèáíÝò áéôßåò ôïõ ðñïâëÞìáôïò:
</FONT><p>
<font size=2 face="verdana,arial">
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Ìðïñåß íá Ý÷åôå ÷ñçóéìïðïéÞóåé ôá êïõìðéÜ "ðßóù" Þ "åìðñüò" ôïõ ðåñéçãçôÞ(browser) éóôïóåëßäùí. Áðïöýãåôå áõôÜ ôá êïõìðéÜ.<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Ìðïñåß íá Ý÷åôå áðïññßøåé Ýíá cookie. Ôï ðñüãñáììá åîáñôÜôáé áðü ôá cookies ãéá íá ëåéôïõñãÞóåé óùóôÜ. Ðáñáêáëþ íá äÝ÷åóôå ôá cookies.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Ï ðåñéçãçôÞò óáò ìðïñåß íá ìçí äÝ÷åôáé ôá cookies. Ðáñáêáëþ ñõèìßóôå ôïí ðåñéçãçôÞ óáò þóôå íá äÝ÷åôáé ôá cookies áõôüìáôá.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Ï ðåñéçãçôÞò óáò ìðïñåß íá ìçí åßíáé óå èÝóç íá ôñÝîåé javascript Þ ôï javascript íá Ý÷åé ôåèåß åêôüò ëåéôïõñãßáò. Ðáñáêáëþ åíåñãïðïéÞóôå ôï javascript óôïí ðåñéçãçôÞ óáò.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Óå óðÜíéåò ðåñéðôþóåéò ìðïñåß íá Ý÷åé õðÜñîåé Ýíá ëÜèïò óôç ìåôáöïñÜ
ôùí óôïé÷åßùí.  Ãéá íá äéïñèþóåôå ôçí êáôÜóôáóç êÜíôå êëéê óôï êïõìðß "áíáíÝùóç" ôïõ ðåñéçãçôÞ éóôïóåëßäùí.
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
