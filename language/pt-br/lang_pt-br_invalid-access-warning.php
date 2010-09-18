<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
require_once($root_path.'include/core/inc_img_fx.php');
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
 <TITLE>P�gina de Acesso N�o Autorizado</TITLE>
</HEAD>

<BODY bgcolor="#ffffff">

<table width=100% border=1>
<tr>
<td bgcolor="navy">
<FONT  COLOR="white"  SIZE=+3  FACE="Arial"><STRONG>&nbsp;P�gina de Acesso N�o Autorizado</STRONG></FONT>
</td>
</tr>
<tr>
<td ><p><br>


<center>
<FONT    SIZE=3 color=red  FACE="Arial">
<b>Voc� n�o tem permiss�o de acesso para abrir este documento!</b></font><p>
<FORM >
<INPUT type="button"  value=" OK "  onClick="<?php if ($mode=="close") print 'window.close()'; else print 'history.back()'; ?>"></FORM>
<p>
</font>
</center>
<p>
<ul>  
<font size=3 face="verdana,arial">
Prov�vel causas deste problema:
</FONT><p>
<font size=2 face="verdana,arial">
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Voce prov�velmente usou os bot�es padr�o "Back" ou "Forward" do seu navegador. Evite o uso deste bot�es.<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Voce pode ter rejeitado um cookie. O programa � dependente dos cookies para uma opera��o adequada. Ent�o por favor aceite os cookies.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Seu navegador poss�vilmente n�o aceita cookies. Por favor configure o seu navegador para aceitar os cookies automaticamente.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
O seu navegador provavelmente n�o foi capaz de executar javascript ou o javascript pode estar disabilitado. Por favor habilite o javascript em seu navegador.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
em raros casos pode ter acontecido um erro na transfer�ncia de dados. Para corrigir essa situa��o apenas click no bot�o
"reload" do seu navegador.
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
