<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);

$foreword='
<form action="#">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Como iniciar ';

switch($x1)
{
 	case "entry": print $foreword.'um documento de prontuário novo'; break;
	case "search": print $foreword.'uma pesquisa por um documento de prontuário';break;
	case "archiv": print $foreword.'pesquisando nos arquivos de prontuário';break;
 }
?>

<?php if(!$x1) : ?>
		<?php require("help_en_main.php"); ?>
<?php else : ?>
</b></font>
 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<p>
<font face="Verdana, Arial" size=2>

<?php if($src!=$x1) : ?>
<b>Passo 1</b>
<ul> Clique no botão <img src="../img/en/en<?php switch($x1)
																			{
																				case "entry": print '_newdata-gray.gif'; break;
																				case "search": print '_such-gray.gif'; break;
																				case "archiv": print '_arch-gray.gif'; break;
																			}
?>" border="0">.
		
</ul>
<b>Passo 2</b>
<?php endif;?>
<ul> Se você estiver logado e com direito de acesso para esta função, o 
<?php switch($x1)
	{
		case "entry": print 'formulário para o documento inicial'; break;
		case "search": print 'campo de pesquisa'; break;
		case "archiv": print 'campo de pesquisa de arquivo'; break;
	}
?>  aparecerá na tela principal.<br>
		De outro modo, se você não estiver logado, será necessário você entrar com seu usuário e senha. <p>
		Entre seu usuário e senha e clique no botão <img <?php echo createLDImgSrc('../','continue.gif','0') ?>>.<p>
		Se você decidir cancelar clique no botão <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
		
</ul>


</form>
<?php endif;?>
