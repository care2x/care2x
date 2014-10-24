<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
Gerenciamento de ala 
<?php
switch($src)
{
	case "main": print "";
						break;
	case "new": print  " - Criar uma nova ala";
						break;
	case "arch": print "Ala de enfermagem - Arquivo";
}
 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<?php if($src=="main") : ?>

<b>Criar</b>

<ul>Para criar uma nova ala, clique esta opção. 
	</ul>	
</ul>
<b>Perfil de dados da ala</b>
<ul>Esta opção exibirá o perfil de uma ala e outros dados relevantes.
</ul>
<b>Bloqueio de cama</b>
<ul>Se você quiser bloquear uma ou várias camas de uma vez só, clique esta opção. A ala assinalada será exibida ou se não disponível, a
ala padrão será exibida. O bloqueio de uma cama necessita de uma senha válida com direito de acesso a esta função.
</ul>
<b>Direitos d acesso</b>
<ul> Nesta opção você pode criar, editar, bloquear, ou apagar direitos de acesso para uma ala em particular. Todos os direitos de acesso criados terão um
acesso somente nesta ala particular.
</ul>
<?php endif;?>
<?php if($x2=="quick") : ?>
	<?php if($x1) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Mostre a lista de ocupação da ala?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>clique na identificação da ala ou nome na coluna da esquerda.<br>
	<b>Nota: </b>A lista de ocupação que será exibida está em modo de "somente leitura". Você não pode editar ou mudar quaisquer dados de paciente.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como exibir a lista de ocupação da ala para edição o atualização de dados?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>clique no ícone <img <?php echo createComIcon('../','statbel2.gif','0') ?>> correspondente a ala escolhida.<br>
 	<b>Passo 2: </b>Se você estiver logado e tem direito de acesso a esta função, a lista de ocupação será exibida imediatamente.<br>
		De outro modo, você será solicitado a entrar com seu nome de usuário e senha.<br>
 	<b>Passo 3: </b>Se solicitado, entre com seu nome de usuário e senha.<br>
 	<b>Passo 4: </b>clique no botão <input type="button" value="Continue...">.<br>
 	<b>Passo 5: </b>Se você tem direito de acesso a esta função, a lista de ocupação será exibida.<br>
	<b>Note: </b>A lista de ocupação que será exibida pode ser "editada". Opções para editar ou atualizar dados de pacientes serão exibidas.
		você pode tambem abrir o arquivo de dados de paciente para outras edições.<br>
	</ul>
	<?php else : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b>
Nào há lista de ocupação disponível neste momento!</b>
</font><p>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como exibir em visão rápida a ocupação usando o arquivo?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>clique "<span style="background-color:yellow" > para ir ao arquivo <img <?php echo createComIcon('../','bul_arrowgrnlrg.gif','0') ?>> </span>".<br>
 	<b>Passo 2: </b>Um calendário guia aparecerá.<br>
 	<b>Passo 3: </b>clique numa data do calendário para exibir uma visão rápida da ocupação daquele dia.<br>
	</ul>
	
	<?php endif;?>
<b>Nota</b>
<ul> Se você decidir fechar a visão rápida clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.
</ul><?php endif;?>

<?php if($src=="new") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como criar uma nova ala?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Entre com a ID da ala ou nome no campo "<span style="background-color:yellow" > Ala: </span>" .<br>
 	<b>Passo 2: </b>Selecione o departamento ou clínica a quem a ala pertence no campo de seleção "<span style="background-color:yellow" > Departamento: </span>" .<br>
 	<b>Passo 3: </b>Escreva a descrição da ala e outras informações no campo  "<span style="background-color:yellow" > Descrição: </span>" .<br>
 	<b>Passo 4: </b>Entre com o número do primeiro quarto da ala no campo "<span style="background-color:yellow" > Número do primeiro quarto: </span>" .<br>
 	<b>Passo 5: </b>Entre com o número do último quarto da  ala no campo "<span style="background-color:yellow" > Número do último quarto: </span>" .<br>
 	<b>Passo 6: </b>Entre com o prefixo do quarto no campo "<span style="background-color:yellow" >Prefixo do quarto: </span>" .<br>
 	<b>Passo 7: </b>Entre com o nome do enfermeiro chefe no campo "<span style="background-color:yellow" > Enfermeiro chefe: </span>" .<br>
 	<b>Passo 8: </b>Entre com o nome do assistente do enfermeiro chefe no campo de entrada de texto "<span style="background-color:yellow" > Assistente do enfermeiro chefe: </span>" .<br>
 	<b>Passo 9: </b>Digite os nomes dos enfermeiros da ala no campo "<span style="background-color:yellow" > Enfermeiros: </span>" .<br>
 	<b>Passo 10: </b>clique no botão <input type="button" value="Criar a ala"> para criar a ala.<br>
	</ul>
<b>Nota</b>
<ul> Se você quiser cancelar, clique no botão <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Posso assinalar o número de camas em um quarto?</b>
</font>
<ul>       	
 	<b>Não. </b>Nesta versão do programa o número de camas num quarto está fixado em 2. Você não pode mudar isto.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Posso assinalar o prefixo (ou id) para uma cama?</b>
</font>
<ul>       	
 	<b>Não. </b>Nesta versão do programa o prefixo (de id) para uma cama está fixado em a ou b . Você não pode mudar isto.<br>
	</ul>
<b>Nota</b>
<ul> Se você quiser cancelar, clique no botão  <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
</ul>
<?php endif;?>
	
<?php if($src=="sComo") : ?>
	<?php if($x1=="1") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como salvar o perfil de ume ala?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>clique no botão <input type="button" value="Salvar"> .<br>
	</ul>
<b>Nota</b>
<ul> Se você quiser cancelar, clique no botão  <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
</ul>

	<?php else : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como editar o perfil de uma ala?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>clique no botão <input type="button" value="Editar o perfil da ala"> .<br>
	</ul>
<b>Nota</b>
<ul> Se você quiser cancelar, clique no botão  <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Eu quero editar o perfil de uma estação diferente desta que está exibida. O que devo fazer?</b>
</font>
<ul>       	
 	<b>Passo 1:</b> clique no link "<span style="background-color:yellow" > <img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>> Outras alas </span>" para listar as alas disponíveis.<br>
 	<b>Passo 2:</b> Uma vez listadas as alas, clique na ala que você deseja editar.
	</ul>
<b>Nota</b>
<ul> Se você quiser cancelar, clique no botão  <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
</ul>

<?php endif;?>
<?php endif;?>


<?php if($src=="") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como selecionar uma ala para editar seu perfil?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>clique a ala da lista que você deseja editar.<br>
	</ul>
<b>Nota</b>
<ul> Se você quiser cancelar, clique no botão  <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
</ul>

<?php endif;?>


</form>

