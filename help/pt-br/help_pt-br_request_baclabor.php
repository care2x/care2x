<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Requisição de teste do laboratorio bacteriológico </b></font>
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



<a name="sel"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Como selecionar um parâmetro de teste?</b></font>
<ul> 
	<b>Step: </b>Clique no pequeno retângulo rosa ao lado do parâmetro para "escurecê-lo".<p>
<img src="../help/en/img/en_request_baclabor.png" border=0 width=325 height=134>
</ul>

<a name="usel"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Como não selecionar um parâmetro de teste?</b></font>
<ul> 
	<b>Passo: </b>Clique novamente no pequeno retângulo "escurecido" abaixo do parâmentro para voltar à cor anterior.<br>
</ul>


<a name="send"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Como enviar a requisição de teste?</b></font>
<ul> 
	<b>Passo: </b>Clique no botão <img <?php echo createLDImgSrc('../','abschic.gif','0') ?>> .
</ul>

<?php
}
?>
