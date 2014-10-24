<?php
$foreword='
<form action="#">

<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Como iniciar ';

switch($x1)
{
 	case "entry": print $foreword.'uma nova admissão de paciente'; break;
	case "search": print $foreword.'pesquisa por dados de admissão de um paciente';break;
	case "archiv": print $foreword.'pesquisando nos arquivos';break;
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
<ul> Clique no botão <img src="../gui/img/control/default/en/en<?php switch($x1)
																			{
																				case "entry": print '_admit-gray.gif'; break;
																				case "search": print '_such-gray.gif'; break;
																				case "archiv": print '_arch-gray.gif'; break;
																			}
?>" border="0"> .
		
</ul>
<b>Passo 2</b>
<?php endif;?>
<ul> Se você já estiver logado e tiver direito de acesso a esta função, o 
<?php switch($x1)
	{
		case "entry": print 'formulário de admissão do paciente'; break;
		case "search": print 'campo de pesquisa '; break;
		case "archiv": print 'campo de pesquisa de arquivo'; break;
	}
  echo 'aparecerá na tela principal.<br>';
  echo 'De outra forma, se você não estive logado, haverá a necessidade de entrar com o usuário e senha. <p>';
  echo 'Entre com seu usuário e senha e clique no botão <img=';
  createLDImgSrc('../','continue.gif','0'); ?> ><p>
		Se você decidir cancelar clique no botão <img <?php echo createLDImgSrc('../','cancel.gif','0'); ?> >.
?>		
</ul>


</form>
<?php endif;?>
