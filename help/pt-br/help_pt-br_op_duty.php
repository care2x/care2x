<html>

<head>
<title></title>

</head>
<body>
<form >
<font face="Verdana, Arial" size=2>
<font  size=3 color="#0000cc">
<b>

<?php
	switch($src)
	{
		case "show": print "Enfermeiros de plantão - Plano de trabalho";
							break;
		case "quick": print "Enfermeiros de plantão - Visão rápida";
							break;
		case "plan": print "Enfermeiros de plantão - Criar plano de trabalho";
							break;
		case "personlist": print "Criar uma lista de pessoal";
							break;
		case "dutydoc": print "Enfermeiros de plantão - Documentando trabalho executado em horário de plantão";
							break;
	}
?>
</b>
</font>
<p>

<?php if($src=="quick") : ?>
<p><font color="#990000" face="Verdana, Arial">O que eu posso fazer aqui?</font></b><p>
<font face="Verdana, Arial" size=2>
<img <?php echo createComIcon('../','update.gif','0','absmiddle') ?>><b> Obter informação adicional (se disponível) sobre os enfermeiros de plantão.</b>
<ul>Para ver a informação adicional, <span style="background-color:yellow" >clique no nome</span> da
pessoa sa lista. Uma janela aparecerá mostrando infromação relevante.</ul><p>
<img <?php echo createComIcon('../','update.gif','0','absmiddle') ?>><b> Veja o plano de trabalho para o mes inteiro.</b>
<ul>Para exibir o plano de trabalho para o mes inteiro, clique no ícone correspondente &nbsp;<button><img <?php echo createComIcon('../','new_address.gif','0','absmiddle') ?>> <font size=1>Mostre</font></button>.<br>
			O plano de trabalho será exibido.</ul><p>
<font face="Verdana, Arial" size=3 color="#990000">
<p><b>O que o visão rápida irá exibir?</b></font></b><p>
<font face="Verdana, Arial" size=2>
</b><li><b>Departamento OR</b> :<ul>A lista dos departamentos existentes que tem médicos/cirurgiões de prontidão e/ou em plantão.</ul><p>
<li><b>Prontidão </b> :<ul>O enfermeiro de prontidão.</ul><p>
<li><b>Bip/Telefone</b> :<ul>Informação de bip/telefone do enfermeiro de prontidão</ul>
<li><b>Sobre-aviso </b> :<ul>O enfermeiro de sobre-aviso.</ul><p>
<li><b>Bip/Telefone</b> :<ul>Informação de Bip/Telefone de quem está de sobre-aviso.</ul><p>
<li><b>Plano de trabalho</b> :<ul>Ícone clicável. Faz o link ao plano de trabalho do departamento para o mes inteiro. Clique no ícone&nbsp;<button><img <?php echo createComIcon('../','new_address.gif','0','absmiddle') ?>> <font size=1>Show</font></button>
			se você quiser abrir o plano de trabalho para o mes inteiro e eventualmente criar ou editar o plano de trabalho.</ul>

<?php endif;?>
<?php if($src=="show") : ?>
<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Eu quero criar um novo plano de trabalho para o mes que está sendo exibido</b></font>
<ul> <b>Passo 1: </b>Clique no botão  <img <?php echo createLDImgSrc('../','newplan.gif','0') ?>> .<br>
</ul>
<ul><b>Passo 2:</b>
 Se você estiver logado e tem direito de acesso a esta função, o 
		modo de edição para o plano de trabalho  aparecerá na tela principal.<br>
		De outro modo, você será solicitado a entrar com seu nome de usuário e senha. <p>
		Entre com seu nome de usuário e senha e clique no botão <img <?php echo createLDImgSrc('../','continue.gif','0') ?>>.<p>
		Se você quiser cancelar, clique no botão <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.

</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Eu quero to criar um plano para um certo mes, mas o plano que está sendo exibido é para um mes diferente.</b></font>
<ul> <b>Passo 1: </b>Clique repetidamente no link clicável "Mes" até que o mes que você quer apareça. <br>
								Clique à direita do link clicável "mes" para avançar o mes.<br>
								Clique à esquerda do link clicável "mes" para retroceder o mes.<br>
		<b>Passo 2: </b>Siga as instruções anteriores para criar um novo plano de trabalho.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Eu quero voltar à visão rápida </b></font>
<ul> <b>Passo 1: </b>Clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?> >.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Eu quero ver os números do bip e telefone dos enfermeiros de plantão </b></font>
<ul> <b>Passo 1: </b><span style="background-color:yellow" >Clique no nome da pessoa</span>.  Uma janela aparecerá mostrando as informações relevantes.<br>
<u1>


<b>Nota</b>
<ul> Se você decidir fechar o plano de trabalho  clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.
</ul>
<?php endif;?>
<?php if($src=="plan") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Eu quero agendar um enfermeiro para plantão isando a lista de enfermeiros</b></font>
<ul> <b>Passo 1: </b>Clique no botão &nbsp;<button><img <?php echo createComIcon('../','patdata.gif','0') ?>></button> do dia selecionado para abrir a lista de enfermeiros. <br>
			Uma janela aparecerá mostrando a lista de enfermeiros.<br>
			<ul type=disc>
			<li>Clique no ícone na coluna da esquerda "Prontidão" para agendar um plantão em prontidão.<br>
			<li>Clique no ícone na coluna da direita "On-call" para agendar um sobre-aviso de plantão.
			</ul>
		<b>Passo 2: </b><span style="background-color:yellow" >Clique no nome do enfermeiro</span> para copiá-lo ao plano de trabalho.<br>
		<b>Passo 3: </b>Se você clicou no nome errado, repita o passo 2 e clique no nome correto.<br>
		<b>Passo 4: </b>Se você terminou, clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> na janela da lista de enfermeiros.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Eu quero entrar manualmente com o nome do enfermeiro no plano de trabalho</b></font>
<ul> <b>Passo 1: </b>Clique no campo de entrada de texto "<input type="text" name="t" size=11 maxlength=4 >" do dia selecionado.<br>
		<b>Passo 2: </b>Digite manualmente o nome do enfermeiro<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Eu quero apagar um nome do plano de trabalho</b></font>
<ul> <b>Passo 1: </b>Clique no campo de entrada de texto "<input type="text" name="t" size=11 maxlength=4 value="Nome">" do nome a ser apagado.<br>
		<b>Passo 2: </b>Apague manualmente o nome, usando as teclas backspace ou delete do teclado.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Eu quero salvar o plano de trabalho</b></font>
<ul> <b>Passo 1: </b>clique no botão <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> .<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Eu salvei o plano e desejo terminar o planejamento, o que devo fazer? </b></font>
<ul> <b>Passo 1: </b>Se você terminou, clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> . <br>
</ul>
</font>
<?php endif;?>
<?php if($src=="personlist") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
O departamento exibido está errado. Eu quero mudar para o departamento certo.</b></font>
<ul> <b>Passo 1: </b>Selecione o departamento no campo <nobr>"<span style="background-color:yellow" >Altere departamento ou sala OP: </span><select name="s">
                                                                     	<option value="Departamento exemplo 1" selected> Departamento exemplo 1</option>
                                                                     	<option value="Departamento exemplo 2"> Departamento exemplo 2</option>
                                                                     	<option value="Departamento exemplo 3"> Departamento exemplo 3</option>
                                                                     	<option value="Departamento exemplo 4"> Departamento exemplo 4</option>
                                                                     </select>"</nobr> .
                                                                     <br>
		<b>Passo 2: </b>Clique no botão <input type="button" value="Altere"> para alterar o departamento selecionado.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Eu quero apagar um nome da lista</b></font>
<ul> <b>Passo 1: </b>Clique no campo de entrada de texto "<input type="text" name="t" size=11 maxlength=4 value="Nome">" do nome a ser apagado.<br>
		<b>Passo 2: </b>Apague manualmente o nome, usando as teclas backspace ou delete do teclado.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Eu quero salvar a lista de pessoal</b></font>
<ul> <b>Passo 1: </b>clique no botão <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>>.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Eu salvei a lista e quero fechá-la,o que devo fazer? </b></font>
<ul> <b>Passo 1: </b>Se você terminou, clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> . <br>
</ul>
<?php endif;?>
<?php if($src=="dutydoc") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como documentar um trabalho feito durante o horário de plantão?</b></font>
<ul> <b>Passo 1: </b>Entre com a data no campo " Data <input type="text" name="d" size=10 maxlength=10> ".<p>
	<ul> <b>Dica: </b>Entre ou com "t" ou com "T" (significando HOJE) para automaticamente entrar com a data de hoje.<br>
		<b>Dica: </b>Entre ou com "y" ou "Y" (significando ONTEM) para automaticamente entrar com a data de ontem.<p>
		</ul>
		<b>Passo 2: </b>Entre com o nome do enfermeiro de plantão no campo <nobr>"<span style="background-color:yellow" > Sobrenome, nome <input type="text" name="d" size=20 maxlength=10> </span>"</nobr> .<br>
 <b>Passo 3: </b>Entre com o horário do início do trabalho no campo "<span style="background-color:yellow" > de <input type="text" name="d" size=5 maxlength=5> </span>" .<br>
 <b>Passo 4: </b>Entre com o horário do fim do trabalho no campo "<span style="background-color:yellow" > até <input type="text" name="d" size=5 maxlength=5> </span>" .<p>
	<ul> <b>Dica: </b>Entre ou com "n" ou com "N" (significando AGORA) para automaticamente entrar com o horário atual.<p>
		</ul>.<p>
		</ul>
 <b>Passo 5: </b>Entre com o número OR no campo "<span style="background-color:yellow" > Sala OP <input type="text" name="d" size=5 maxlength=5> </span>" .<br>
 <b>Passo 6: </b>Entre com o diagnóstico, terapia, ou operação no campo <nobr>"<span style="background-color:yellow" > Diagnóstico/Terapia <input type="text" name="d" size=5 maxlength=5> </span>"</nobr> .<br>
 <b>Passo 7: </b>Entre com o nome do enfermeiro de prontidão no campo <nobr>"<span style="background-color:yellow" > Prontidão: <input type="text" name="d" size=5 maxlength=5> </span>"</nobr> .<br>
 <b>Passo 8: </b>Entre com o nome do enfermeiro de serviço no campo <nobr>"<span style="background-color:yellow" > Em serviço: <input type="text" name="d" size=5 maxlength=5> </span>"</nobr> se necessário.<br>
 <b>Passo 1: </b>Clique no botão <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> para salvar o documento. <br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Como imprimir o documento da lista?</b></font>
<ul> <b>Passo 1: </b>Clique no botão <img <?php echo createLDImgSrc('../','printout.gif','0') ?>>  e a janela de impressão aparecerá.<br>
	<b>Passo 2: </b>Siga as instruções da janela de impressão.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Eu salvei o documento e quero fechá-lo, o que devo fazer? </b></font>
<ul> <b>Passo 1: </b>Se você terminou, clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> . <br>
</ul>
<?php endif;?>

</form>
</body>
</html>
