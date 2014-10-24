<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Como
<?php
switch($x1)
{
 	case "search": print 'pesquisa um número de telefone'; break;
	case "dir": print 'abre toda a lista telefônica';break;
	case "newphone": print 'insere uma nova informação de telefone';break;
 }
 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<?php if($x1=="search") : ?>
	<?php if($src=="newphone") : ?>
	<b>Passo 1</b>
	<ul> Clique no botão <img <?php echo createLDImgSrc('../','such-gray.gif','0') ?>>.
	</ul>
	<?php endif;?>
<b>Passo <?php if($src=="newphone") print "2"; else print "1"; ?></b>

<ul> Insira o campo "<span style="background-color:yellow" >Insira a palavra chave.</span>" com uma informação completa ou algumas letras, como por exemplo o hospital ou código do departamento, nome de família, ou primeiro nome,
		ou o númenro do quarto.
		<br>Exemplo 1: insira  "m9a" ou "M9A" ou "M9".
		<br>Exemplo 2: insira "Guerero" ou "gue".
		<br>Exemplo 3: insira "Alfredo" ou "Alf".
		<br>Exemplo 4: insira "op11" ou "OP11" ou "op".
		
</ul>
<b>Passo <?php if($src=="newphone") print "3"; else print "2"; ?></b>
<ul> Clique no botão <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> para iniciar a pesquisa.<p>
</ul>
<b>Passo <?php if($src=="newphone") print "4"; else print "3"; ?></b>
<ul> Se a pesquisa encontrar resultado(s), uma lista será exibida.<p>
</ul>
<?php endif;?>
<?php if($x1=="dir") : ?>
<b>Passo 1</b>
<ul> Clique no botão <img <?php echo createLDImgSrc('../','phonedir-gray.gif','0') ?>>.
</ul>
<?php endif;?>
<?php if($x1=="newphone") : ?>
	<?php if($src=="search") : ?>
<b>Step 1</b>
<ul> Clique no botão <img <?php echo createLDImgSrc('../','newdata-gray.gif','0') ?>>.
</ul>
<b>Passo 2</b>
<ul> Se você estiver logado anteriormente a tem um direito de acesso para esta função, o formulário de entrada para uma 
		nova informação de telefone irá aparecer no quadro principal.<br>
		De outra forma, se você não estiver logado, você será requisitado a inserir seu nome de usuário e senha. <p>
	<?php endif;?>
		Insira seu nome de usuário e senha e clique no botão <img <?php echo createLDImgSrc('../','continue.gif','0') ?>>.<p>
		
</ul><?php endif;?>

<b>Nota</b>
<ul> Se você decidir cancelar 
<?php
switch($x1)
{

	case "search": print 'search click the button <img '.createLDImgSrc('../','cancel.gif','0').'>.'; break;
	case "dir": print ' the directory click the button <input type="button" value="Cancel">.';break;
	case "newphone": print ' click the button <img '.createLDImgSrc('../','cancel.gif','0').'>.';break;

 }
 ?>
</ul>


</form>

