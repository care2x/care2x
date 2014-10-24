<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title></title>

</head>
<body>
<form >
<font face="Verdana, Arial" size=2>
<font  size=3 color="#0000cc">
<b>

<?php
print "Suporte técnico - ";	
switch($src)
	{
		case "request": print "Requisição para serviço de reparo";
							break;
		case "report": print "Relatar serviços de reparo concluídos";
							break;
		case "queries": print "Enviar uma pergunta ou dúvida";
							break;
		case "arch": print "Pesquisar nos arquivos";
							break;
		case "showarch": print "Relatório";
							break;
	}
?>
</b>
</font>
<p>

<?php if($src=="request") : ?>
<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como enviar uma requisição para um serviço de reparo ?</b></font>
<ul> <b>Passo 1: </b>Informe a localização do dano na  
<nobr>"<span style="background-color:yellow" > Campo de localização do dano <input type="text" name="d" size=20 maxlength=10> </span>"</nobr> .<p>
<b>Passo 2: </b>Informe o seu nome no campo <nobr>"<span style="background-color:yellow" > Solicitado por: <input type="text" name="d" size=20 maxlength=10> </span>"</nobr> .<br>
 <b>Passo 3: </b>Informe seu número pessoal no campo <nobr>"<span style="background-color:yellow" > Num. Pessoal: <input type="text" name="d" size=20 maxlength=5> </span>"</nobr> .<br>
 <b>Passo 4: </b>Informe o seu número de telefone no campo <nobr>"<span style="background-color:yellow" > Num. Telefone: <input type="text" name="d" size=20 maxlength=5> </span>"</nobr> caso o departamento de suporte técnico ter alguma dúvida sobre sua requisição.<p>
 <b>Passo 5: </b>Digite a descrição do dano no campo <nobr>"<span style="background-color:yellow" > Descreva a natureza do dano: <input type="text" name="d" size=20 maxlength=5> </span>"</nobr> .<br>
 <b>Passo 6: </b>Clique no botão <img <?php echo createLDImgSrc('../','abschic.gif','0') ?>> para enviar sua requisição. <br>
</ul>
<b>Nota</b>
<ul> Se você decidir fechar o formulário de requisição, clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.
</ul>
<?php endif;?>
<?php if($src=="report") : ?>
<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como relatar um serviço de reparo concluído?</b></font>
<ul> <b>Passo 1: </b>Insira a localização do dano no  campo
<nobr>"<span style="background-color:yellow" > Localização do dano <input type="text" name="d" size=20 maxlength=10> </span>"</nobr> .<p>
<b>Passo 2: </b>Insira o número do serviço no campo <nobr>"<span style="background-color:yellow" > Num. do Serviço: <input type="text" name="d" size=20 maxlength=10> </span>"</nobr> .<br>
<b>Passo 3: </b>Insira seu nome no campo <nobr>"<span style="background-color:yellow" > Técnico: <input type="text" name="d" size=20 maxlength=10> </span>"</nobr> .<br>
 <b>Passo 4: </b>Insira seu número pessoal no campo <nobr>"<span style="background-color:yellow" > Núm. pessoal: <input type="text" name="d" size=20 maxlength=5> </span>"</nobr> .<br>
 <b>Passo 5: </b>Digite a descrição do serviço de reparo realizado no campo <nobr>"<span style="background-color:yellow" > Por favor descreva o serviço de reparo realizado por você: <input type="text" name="d" size=20 maxlength=5> </span>"</nobr> .<br>
 <b>Passo 6: </b>Clique no botão <input type="button" value="Enviar Relatório"> para enviar seu relatório. <br>
</ul>
<b>Nota</b>
<ul> Se você decidir fechar o formulário de requisição, clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.
</ul>
<?php endif;?>
<?php if($src=="queries") : ?>
<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como enviar uma dúvida ou questão para o departamento de suporte técnico? </b></font>
<ul> <b>Passo 1: </b>Digite sua dúvida ou questão no campo <nobr>"<span style="background-color:yellow" > Digite sua questão: <input type="text" name="d" size=20 maxlength=5> </span>"</nobr> .<br>
<b>Passo 2: </b>Insira seu nome no campo <nobr>"<span style="background-color:yellow" > Nome: <input type="text" name="d" size=20 maxlength=10> </span>"</nobr> .<br>
 <b>Passo 3: </b>Insira seu departamento no campo <nobr>"<span style="background-color:yellow" > Departmento: <input type="text" name="d" size=20 maxlength=5> </span>"</nobr> .<br>
 <b>Passo 4: </b>Clique no botão <input type="botão" value="Send inquiry"> para enviar sua dúvida. <br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como ver minhas dúvidas anteriores e as respostas do departamento técnico ? </b></font>
<ul> <b>Passo 1: </b>Primeiro você deve logar-se. Digite seu nome no campo <nobr>"<span style="background-color:yellow" > from: <input type="text" name="d" size=20 maxlength=5> </span>"</nobr> no canto direito superior.<br>
 <b>Passo 2: </b>Clique no <input type="button" value="Login">. <br>
 <b>Passo 3: </b>Se você possui dúvidas anteriores, elas estarão listadas de forma resumida.  <br>
 <b>Passo 4: </b>Se sua dúvida for respondida pelo departamento técnico, o símbolo <img src="../img/warn.gif" border=0 width=16 height=16 align="absmiddle"> irá
 ser exibido no final. <br>
 <b>Passo 5: </b>Para ler sua dúvida e a resposta do departamento técnico, clique sobre ela. <br>
</ul>
<b>Nota</b>
<ul> Se você decidir fechar o formulário de dúvida clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.
</ul>
<?php endif;?>
<?php if($src=="arch") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como ler relatórios técnicos?</b></font>
<ul> 
		<b>Nota: </b>Os relatórios técnicos que ainda não foram lidos ou impressos são listados imediatamente.<p>
<b>Passo 1: </b>Clique no botão <img src="../img/upArrowGrnLrg.gif" border=0 width=16 height=16 align="absmiddle">  do relatório que você deseja abrir. <br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como pesquisar um relatório técnico específico?</b></font>
<ul> <b>Passo 1: </b>Insira uma informação completa ou as primeiras letras dos campos correspondentes como explicado a seguir.<br>
	<ul type=disc> 
	<li>Se você deseja encontrar relatórios escritos por um técnico em particular, insira o nome do técnico no campo "<span style="background-color:yellow" > Técnico: <input type="text" name="t" size=11 maxlength=4 value="Name"> </span>" .<br>
	<li>Se você deseja encontrar relatórios de trabalhos feitos em um departamento específico, insira o nome do departamento no campo "<span style="background-color:yellow" > Department: <input type="text" name="t" size=11 maxlength=4 value="Name"> </span>" .<br>
	<li>Se você deseja encontrar relatórios escritos em uma data particular, insira a data no campo "<span style="background-color:yellow" > Date from: <input type="text" name="t" size=11 maxlength=4 value="Name"> </span>" .<br>
	<li>Se você deseja encontrar todos os relatórios de um período de tempo, insira a data de início no campo "<span style="background-color:yellow" > De: <input type="text" name="t" size=11 maxlength=4 value="Name"> </span>" e
	entre com a data de fim no campo "<span style="background-color:yellow" > to: <input type="text" name="t" size=11 maxlength=4 value="Name"> </span>" .<br>
	</ul>
 <b>Passo 2: </b>Clique no botão <input type="button" value="Search"> para iniciar a pesquisa. <br>
<b>Passo 3: </b>Os resultados serão listados. Clique no ícone <img src="../img/upArrowGrnLrg.gif" border=0 width=16 height=16 align="absmiddle">  do relatório que você desejar abrir. <br>
	<b>Nota: </b>Relatórios tecnicos que são marcados com <img src="../img/check-r.gif" border=0  align="absmiddle"> já foram lidos ou impressos.<p>

</ul>
</font>
<?php endif;?>
<?php if($src=="showarch") : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b>
Marcando o relatório como lido.</b></font>
<ul> <b>Passo 1: </b>Clique no botão <input type="button" value="Marcar como 'Lido'">.<p>
	<b>Nota: </b>Quando o relatório for marcado como lido, ele não será listado imediatamente a cada início de pesquisa de arquivo. Eles podem somente ser encotrados novamente 
	através dos métodos usuais de pesquisa em arquivos.<p>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b>
Imprimindo o relatório.</b></font>
<ul> <b>Passo 1: </b>Clique no botão <input type="button" value="Imprimir">.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como voltar ao início da pesquisa de arquivos?</b></font>
<ul> <b>Passo 1: </b>Clique no botão <input type="button" value="<< Voltar">.<p>
</ul>
<?php endif;?>
<?php if($src=="dutydoc") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como documentar um trabalho feito durante horas de serviço ?</b></font>
<ul> <b>Passo 1: </b>Insira a data no campo " Date <input type="text" name="d" size=10 maxlength=10> " .<p>
	<ul> <b>Dica: </b>Digite "t" ou "T" (significando HOJE) para inserir a data de hoje automaticamente.<br>
		<b>Tip: </b>Digite "y" ou "Y" (significando ONTEM) para inserir a data de ontem automaticamente.<p>
		</ul>
		<b>Passo 2: </b>Insira o nome da enfermeira em serviço no campo  <nobr>"<span style="background-color:yellow" > Sobrenome, Nome <input type="text" name="d" size=20 maxlength=10> </span>"</nobr> .<br>
 <b>Passo 3: </b>Insira a hora de início do serviço no campo "<span style="background-color:yellow" > de <input type="text" name="d" size=5 maxlength=5> </span>" .<br>
 <b>Passo 4: </b>Insira a hora de fim do serviço no campo "<span style="background-color:yellow" > até <input type="text" name="d" size=5 maxlength=5> </span>" .<p>
	<ul> <b>Dica: </b>Insira "n" or "N" (significando AGORA) para inserir a hora atual imediatamente.<p>
		</ul>
 <b>Passo 5: </b>Insira o número de OR no campo "<span style="background-color:yellow" > Sala OP <input type="text" name="d" size=5 maxlength=5> </span>" .<br>
 <b>Passo 6: </b>Insira o diagnóstico, terapia, ou operação no campo <nobr>"<span style="background-color:yellow" > Diagnóstico/Terapia <input type="text" name="d" size=5 maxlength=5> </span>"</nobr> .<br>
 <b>Passo 7: </b>Insira o nome do enfermeiro de plantão no campo<nobr>"<span style="background-color:yellow" > Plantão: <input type="text" name="d" size=5 maxlength=5> </span>"</nobr> .<br>
 <b>Passo 8: </b>Insira o nome do enfermeiro de chamada no campo <nobr>"<span style="background-color:yellow" > De chamada: <input type="text" name="d" size=5 maxlength=5> </span>"</nobr> se necessário.<br>
 <b>Passo 9: </b>Clique no botão <input type="button" value="Salvar"> para salvar o documento. <br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Como imprimir a lista de documentos?</b></font>
<ul> <b>Passo 1: </b>Clique no botão <input type="button" value="Imprimir"> e a janela de impressão irá aparecer.<br>
	<b>Passo 2: </b>Siga as instruções da janela de impressão.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>EU salvei o documento e gostaria de fechá-lo, o que devo fazer? </b></font>
<ul> <b>Passo 1: </b>Se você terminou, clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> . <br>
</ul>
<?php endif;?>

</form>
</body>
</html>
