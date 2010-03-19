<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
<?php
switch($x2)
{
	case "search": print "Como... "; 
 						if($x1) print 'mostre a ocupação da ala onde a palavra chave de pesquisa foi encontrada';
						else  print 'pesquise por um paciente';
						break;
	case "quick": print  "Enfermagem - Visão rápida da ocupação de hoje da ala";
						break;
	case "arch": print "Ala de enfermagem - Arquivo";
}
 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<?php if($x2=="search") : ?>
<?php if(!$x1) : ?>
<b>Passo 1</b>

<ul> Entre no campo "<span style="background-color:yellow" >Por favor, entre com uma palavra chave de pesquisa.</span>" 
	ou com uma informação completa ou umas poucas letras de informação de um paciente,como exemplo, o nome, ou sobrenome ou ambos.
		<ul type=disc><li>Exemplo 1: entre "Guerero" ou "gue".
		<li>Exemplo 2: entre "Alfredo" ou "Alf".
		<li>Exemplo 3: entre "Guerero, Alf".
	</ul>	
</ul>
<b>Passo 2</b>
<ul> Clique no botão <input type="button" value="Pesquisa"> para iniciar a pesquisa.<p>
</ul>
<b>Passo 3</b>
<ul> Se a pesquisa encontrar um resultado, a lista de ocupação da ala será exibida, mostrando onde a palavra chave de pesquisa foi encontrada.<p>
</ul>
<b>Passo 4</b>
<ul> Se a pesquisa encontrar vários resultados, uma lista de resultados será mostrada.<p>
</ul>
<b>Nota</b>
<ul> Se você decidir cancelar a pesquisa clique no botão <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
</ul><?php endif;?>
<b>Passo <?php if($x1) print "1"; else print "5"; ?></b><ul>clique no botão <img <?php echo createComIcon('../','bul_arrowblusm.gif','0') ?>>,
 ou na data, ou na ala para exibir a lista de ocupação da ala.
<p><b>Nota:</b> A palavra chave de pesquisa estará grifada na lista.
<br><b>Nota:</b> A lista não pode ser editada; está em modo de "somente leitura". Se você tentar abrir o arquivo de dados do paciente clicando em seu nome, você será avisado para
entrar com seu nome de usuário e senha.
</ul>
<?php endif;?>
<?php if($x2=="quick") : ?>
	<?php if($x1) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como mostrar o status de ocupação de outros dias?</b>
</font>
<ul>       	
 	<b>Passo: </b>Clique na data do mini-calendário.<p>
	<img src="../help/en/img/en_mini_calendar_php.png" border=0 width=223 height=133><p>
	<b>Nota: </b>A lista antiga de ocupação será mostrada em modo de "somente leitura". Você não pode editar ou alterar quaisquer dados de paciente.<br>
	</ul>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como mostrar a lista de ocupação da ala?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique na identificação da ala ou seu nomena coluna à esquerda.<br>
	<b>Nota: </b>A lista de ocupação que será exibida será mostrada em modo de "somente leitura". Você não pode editar ou alterar quaisquer dados de paciente.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como mostrar a lista de ocupação da ala para a edição ou atualização de dados?</b>
</Você não pode>       	
 	<b>Passo 1: </b>Clique no ícone <img <?php echo createComIcon('../','statbel2.gif','0') ?>> correspondente a ala escolhida.<br>
 	<b>Passo 2: </b>Se você estiver logado e tiver direito de acesso para a função, a lista de ocupação será exibida imediatamente.<br>
		caso contrário,  você será solicitado a entrar com seu nome de usuário e senha.<br>
 	<b>Passo 3: </b>Se solicitado  entre com seu nome de usuário e senha.<br>
 	<b>Passo 4: </b>Clique no botão  <img <?php echo createLDImgSrc('../','continue.gif','0') ?>> .<br>
 	<b>Passo 5: </b>Se você tiver direito de acesso para a função, a lista de ocupação será exibida.<br>
	<b>Nota: </b>A lista de ocupação que será exibida pode ser "editada". Opções para edição ou atualização dos dados do paciente serão apresentadas.
		Você tambem pode abrir o arquivo de dados do paciente para continuar editando.<br>
	</ul>
	<?php else : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b>
Não há lista de ocupação disponível neste momento!</b>
</font><p>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como mostrar visões rápidas de uma ocupação anterior usando o arquivo?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique "<span style="background-color:yellow" > Clique aqui para ir ao arquivo <img <?php echo createComIcon('../','bul_arrowgrnlrg.gif','0') ?>> </span>".<br>
 	<b>Passo 2: </b>Um calendário guia aparecerá.<br>
 	<b>Passo 3: </b>Clique em uma data do calendário para que uma visão rápida da ocupação daquele dia seja mostrada.<br>
	</ul>
	
	<?php endif;?>
<b>Nota</b>
<ul> Se você decidir fecha a Visão rápida clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.
</ul><?php endif;?>

<?php if($x2=="arch") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como mostrar visões rápidas de uma ocupação anterior usando o arquivo?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique em uma data do calendário para exibir a visão rápida de ocupação daquele dia.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como mudar o mes do calendário guia?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Para mostrar o próximo mes clique no nome do mes no canto superior DIREITO do calendário guia.
								Clique quantas vezes for necessário até que o mes desejado seja mostrado.<p>
 	<b>Passo 2: </b>Para mostrar o mes anterior, clique no nome do mes no canto superior ESQUERDO do calendário guia.
								Clique quantas vezes for necessário até que o mes desejado seja mostrado.<br>
	</ul>
	
	<?php endif;?>


</form>

