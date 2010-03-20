<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
require_once($root_path.'include/inc_img_fx.php');
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <TITLE>Página de Acesso Não Autorizado</TITLE>
</HEAD>

<BODY bgcolor="#ffffff">

<table width=100% border=1>
<tr>
<td bgcolor="navy">
<FONT  COLOR="white"  SIZE=+3  FACE="Arial"><STRONG>&nbsp;Página de Acesso Não Autorizado</STRONG></FONT>
</td>
</tr>
<tr>
<td ><p><br>


<center>
<FONT    SIZE=3 color=red  FACE="Arial">
<b>Você não tem permissão de acesso para abrir este documento!</b></font><p>
<FORM >
<INPUT type="button"  value=" OK "  onClick="<?php if ($mode=="close") print 'window.close()'; else print 'history.back()'; ?>"></FORM>
<p>
</font>
</center>
<p>
<ul>  
<font size=3 face="verdana,arial">
Provável causas deste problema:
</FONT><p>
<font size=2 face="verdana,arial">
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Voce provávelmente usou os botões padrão "Back" ou "Forward" do seu navegador. Evite o uso deste botões.<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Voce pode ter rejeitado um cookie. O programa é dependente dos cookies para uma operação adequada. Então por favor aceite os cookies.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Seu navegador possívilmente não aceita cookies. Por favor configure o seu navegador para aceitar os cookies automaticamente.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
O seu navegador provavelmente não foi capaz de executar javascript ou o javascript pode estar disabilitado. Por favor habilite o javascript em seu navegador.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
em raros casos pode ter acontecido um erro na transferência de dados. Para corrigir essa situação apenas click no botão
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
require($root_path.'include/inc_load_copyrite.php'); 
?>
</FONT>


</BODY>
</HTML>
