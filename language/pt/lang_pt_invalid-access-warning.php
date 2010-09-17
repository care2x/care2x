<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
require_once($root_path.'include/inc_img_fx.php');
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
 <TITLE>Aviso de Acesso Inv�lido</TITLE>
</HEAD>

<BODY bgcolor="#ffffff">

<table width=100% border=1>
<tr>
<td bgcolor="navy">
<FONT  COLOR="white"  SIZE=+3  FACE="Arial"><STRONG>&nbsp;Acesso N�o Autorizado</STRONG></FONT>
</td>
</tr>
<tr>
<td ><p><br>


<center>
<FONT    SIZE=3 color=red  FACE="Arial">
<b>N�o tem permiss�es de acesso para abrir este documento !</b></font><p>
<FORM >
<INPUT type="button"  value=" OK "  onClick="<?php if ($mode=="close") print 'window.close()'; else print 'history.back()'; ?>"></FORM>
<p>
</font>
</center>
<p>
<ul>
<font size=3 face="verdana,arial">
As causas prov�veis deste problema s�o:
</FONT><p>
<font size=2 face="verdana,arial">
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Pode ter utilizado os bot�es standard para "Retroceder" ou "Avan�ar" do seu browser. Evite a utiliza��o destes bot�es.<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Pode ter rejeitado um cookie. Este programa depende da utiliza��o de cookies para funcionar correctamente. Por favor aceite os cookies.<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
O seu browser pode n�o estar a aceitar os cookies. Por favor altere a configura��o do seu browser para aceitar cookies autom�ticamente.<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
O seu browser pode n�o ser capaz de executar javascript ou estar configurado para n�o executar javascript. Por favor altere a configura��o do seu browser para permitir a execu��o de javascript.<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Embora raramente, pode tamb�m ter havido um erro na transfer�ncia de dados. Para corrigir este tipo de situa��o basta carregar novamente no bot�o "Actualizar" do seu browser.
<p>
</FONT>
<p>
</ul>
</td>
</tr>
</table>        
<p>

<?php
$root_path='../../';
require('pt_copyrite.php'); 
?>
</FONT>


</BODY>
</HTML>
