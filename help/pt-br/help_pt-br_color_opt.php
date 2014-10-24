<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
Opções de Cor 
<?php
	switch($src)
	{
	case "ext": print " - Extendido";
						break;
	 }
?>
</b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<?php if($src=="") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como selecionar a cor de fundo?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique na cor de fundo do link "<span style="background-color:yellow" >  <img <?php echo createComIcon('../','settings_tree.gif','0') ?>> </span>" no quadro que você quiser.<br>
 	<b>Passo 2: </b>Uma janela aparecerá mostrando um conjunto de cores.<br>
 	<b>Passo 3: </b>Clique na cor que você quiser como fundo.<br>
 	<b>Passo 4: </b>Clique no botão <input type="button" value="Aplicar"> para aplicar a cor.<br>
 	<b>Passo 5: </b>Se você terminou, clique no botão <input type="button" value="OK"> .<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como selecionar a cor do texto?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique ou no link "<span style="background-color:yellow" > Cor do texto </span>" no  topo do quadro ou no link
	"<span style="background-color:yellow" > ítens do Menu </span>" no quadro do menu.<br>
 	<b>Passo 2: </b>Uma janela aparecerá mostrando um conjunto de cores.<br>
 	<b>Passo 3: </b>Clique na cor que você quiser para o texto.<br>
 	<b>Passo 4: </b>Clique no botão <input type="button" value="Aplicar"> para aplicar a cor.<br>
 	<b>Passo 5: </b>Se você terminou, clique no botão <input type="button" value="OK"> .<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como selecionar a cobertura e as cores dos links?</b>
</font>
<ul>       	
 	<b>Passo 5: </b>Clique no <input type="button" value="Opções extendidas de cores"> para ir à opção de cores ampliada.<br>
</ul>
<?php endif;?>

<?php if($src=="ext") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como selecionar o link ativo de  cor?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique tanto no link "<span style="background-color:yellow" > Link ativo </span>" no quadro principal ou no link
	"<span style="background-color:yellow" > Link ativo </span>" no quadro do menu.<br>
 	<b>Passo 2: </b>Uma janela aparecerá mostrando um conjunto de cores.<br>
 	<b>Passo 3: </b>Clique na cor que você quiser para o link ativo.<br>
 	<b>Passo 4: </b>Clique no botão <input type="button" value="Aplicar"> para aplicar a cor.<br>
 	<b>Passo 5: </b>Se você terminou, clique no botão <input type="button" value="OK"> .<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como selecionar a cor do link da cobertura?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique ou no link "<span style="background-color:yellow" > link de cobertura </span>" no quadro principal ou no link
	"<span style="background-color:yellow" > Hover link </span>" no quadro do menu.<br>
 	<b>Passo 2: </b>Uma janela aparecerá mostrando um conjunto de cores.<br>
 	<b>Passo 3: </b>Clique na cor que você quiser para o link da cobertura.<br>
 	<b>Passo 4: </b>Clique no botão <input type="button" value="Aplicar"> para aplicar a cor.<br>
 	<b>Passo 5: </b>Se você terminou, clique no botão <input type="button" value="OK"> .<br>
</ul>

<?php endif;?>
	</form>

