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
 <TITLE>Aviso de Acesso Inválido</TITLE>
</HEAD>

<BODY bgcolor="#ffffff">

<table width=100% border=1>
<tr>
<td bgcolor="navy">
<FONT  COLOR="white"  SIZE=+3  FACE="Arial"><STRONG>&nbsp;Acesso Não Autorizado</STRONG></FONT>
</td>
</tr>
<tr>
<td ><p><br>


<center>
<FONT    SIZE=3 color=red  FACE="Arial">
<b>Não tem permissões de acesso para abrir este documento !</b></font><p>
<FORM >
<INPUT type="button"  value=" OK "  onClick="<?php if ($mode=="close") print 'window.close()'; else print 'history.back()'; ?>"></FORM>
<p>
</font>
</center>
<p>
<ul>
<font size=3 face="verdana,arial">
As causas prováveis deste problema são:
</FONT><p>
<font size=2 face="verdana,arial">
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Pode ter utilizado os botões standard para "Retroceder" ou "Avançar" do seu browser. Evite a utilização destes botões.<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Pode ter rejeitado um cookie. Este programa depende da utilização de cookies para funcionar correctamente. Por favor aceite os cookies.<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
O seu browser pode não estar a aceitar os cookies. Por favor altere a configuração do seu browser para aceitar cookies automáticamente.<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
O seu browser pode não ser capaz de executar javascript ou estar configurado para não executar javascript. Por favor altere a configuração do seu browser para permitir a execução de javascript.<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Embora raramente, pode também ter havido um erro na transferência de dados. Para corrigir este tipo de situação basta carregar novamente no botão "Actualizar" do seu browser.
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
