<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b><?php echo "Laboratory - $x3" ?></b></font>
<form action="#" >
<p><font size=2 face="verdana,arial" >

<?php if($src=="") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como mostrar os gráficos dos parâmetros de teste?</b>
</font>
<ul>      
 	<b>Passo 1: </b>Clique na caixa de seleção <input type="checkbox" name="s" value="s" verififcado> correspondente ao parâmetro escolhido para selecioná-lo.<br>
		<b>Passo 2: </b>Se você quiser mostrar vários parâmetros de uma só vez, clique nas caixas de seleção correspondentes.<br>
		<b>Passo 3: </b>Clique no ícone <img <?php echo createComIcon('../','chart.gif','0') ?>>  para a exibição do gráfico.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Eu quero selecionar todos os parâmetros. Há um modo rápido de selecionar todos os parâmetros de uma só vez?</b>
</font>
<ul>      
		<b>Sim, há!</b><br>
		<b>Passo 1: </b>Clique  no botão <img <?php echo createComIcon('../','dwnarrowgrnlrg.gif','0') ?> border=0> para selecionar todos os parâmetros.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como desmarcar todos os parâmetros?</b>
</font>
<ul>      
		<b>Passo 1: </b>Clique no botão <img <?php echo createComIcon('../','dwnarrowgrnlrg.gif','0') ?> border=0> novamente para DESMARCAR todos os parâmetros.<br>
</ul>
<?php endif;?>
<?php if($src=="graph") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Como voltar para os resultados dos testes sem os gráficos? </b></font>
<ul> <b>Nota: </b>Se você quiser voltar, clique no botão <img <?php echo createLDImgSrc('../','back2.gif','0','absmiddle') ?>>.</ul>
<?php endif;?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Como fechar o laboratório <?php echo $x3 ?>? </b></font>
<ul> <b>Nota: </b>Se você quiser fechar, clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle">.</ul>


</form>

