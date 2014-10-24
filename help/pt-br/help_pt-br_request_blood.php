<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Requisição de produtos sanguíneos</b></font>
<p>
<font size=2 face="verdana,arial" >

<?php
if(!$src){
?>
<a name="sday"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
O rótulo do paciente não está anexado. O que devo fazer?</b></font>
<ul> 
		<b>Passo 1: </b>Insira uma informação completa ou algumas letras da informação do paciente, como o primeiro nome, ou o nome da família, 
		ou o número de registro.
		<p>Exemplo 1: insira "21000012" ou "12".
		<br>Exemplo 2: insira "Guerero" ou "gue".
		<br>Exemplo 3: insira "Alfredo" ou "Alf".<p>
	<b>Passo 2: </b>Clique no botão <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> para iniciar a pesquisa. <p>
	<b>Passo 3: </b> Se a pesquisa encontrar um resultado, selecione a pessoa correta na lista exibida clicando no seu botão 
	 <img <?php echo createLDImgSrc('../','ok_small.gif','0') ?>> .
</ul>
<?php
}else{
?>

<a name="stime"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
O que preencher no formulário de requisição?</b></font>
<ul> 
	<b>Os campos obrigatórios para preencher são:</b> 
<ul> 
	<li>Grupo sanguíneo
	<li>Fator Rh
	<li>Kell
	<li>Num. de pcs. de produtos solicitados
	<li>Data de transfusão
	<li>Data de Pedido
	<li>Nome do médico responsável pelo pedido.
</ul>
</ul>

<a name="send"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Alguns valores ainda não estão disponíveis. Posso ainda enviar o formulário de requisição sem estes valores?</b></font>
<ul> 
	<b>Nota: </b>Você pode inserir "?" (ponto de interrogação) nos seguintes campos se os valores não estão disponíveis:
<ul> 
	<li>Grupo sanguíneo
	<li>Fator Rh
	<li>Kell 
</ul>
</ul>

<a name="send"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Como enviar a requisição do teste?</b></font>
<ul> 
	<b>Passo: </b>Clique no botão <img <?php echo createLDImgSrc('../','abschic.gif','0') ?>> .
</ul>

<?php
}
?>
