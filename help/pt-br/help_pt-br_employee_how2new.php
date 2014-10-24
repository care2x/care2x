<font face="Verdana, Arial" size=3 color="#0000cc"><b>Gerencia de pessoal</b></font><p>
<?php 
if(!$src&&!$x1){
?>
<font size=2 face="verdana,arial" >
<b>Como empregar uma pessoa</b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<b>Passo 1</b>

<ul> 
<font color=#ff0000>Verifique primeiro se os dados básicos da pessoa já existem</font>.<p>
		 Entre  ou com uma informação completa ou umas poucas letras da informação, como só o nome por exemplo, ou sobrenome, 
		ou o PID (identificador de pessoa).
		<p>Exemplo 1: entre "21000012" ou "12".
		<br>Exemplo 2: entre "Guerero" ou "gue".
		<br>Exemplo 3: entre "Alfredo" ou "Alf".
		
</ul>

<b>Passo 2</b>
<ul> Clique no botão <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> para iniciar a pesquisa. 
</ul>

<b>Passo 3</b>
<ul> Se a pesquisa não encontrar resultado, você deve primeiro registrar a pessoa. Clique no botão  <img <?php echo createLDImgSrc('../','register_gray.gif','0') ?>>  e siga as instruções para o registro de uma pessoa.
</ul>
<b>Passo 4</b>
<ul> Se a pesquisa encontrar resultado, selecione a pessoa certa da lista mostrada, clicando no botão  <img <?php echo createLDImgSrc('../','ok_small.gif','0') ?>> ao lado dela.
</ul>
<b>Passo 5</b>
<ul> Uma vez que o formulário de emprego esteja mostrado, entre com todos os dados relevantes de emprego.<p>
		<img <?php echo createComIcon('../','warn.gif','0') ?>> Nota: Se a pessoa estiver empregada neste momento, seus dados de emprego serão mostrados.
</ul>
<b>Passo 6</b>
<ul> 
	 Clique no botão  <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> para
		salvar a informação de emprego.<p>
	
</ul>


<b>Nota</b>

<ul> Se estiver faltando uma informação, as entradas serão mostradas novamente e uma mensagem aparecerá solicitando que você
		entre com a informação no campo ou campos marcados em vermelho. Após, clique no botão <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> para
		salvar a informação completa.<p>
</ul>

<b>Nota</b>
<ul> Se você decidir cancelar a admissão clique no botão <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
		
</ul>
</form>
<?php
}else{
?>

<font size=2 face="verdana,arial" >
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<?php
	if($src){
?>
<font color="#990000"><b>Como atualizar os dados de emprego?</b></font>
<ul> 
	<b>Passo 1:</b> Entre com os novos dados nos campos apropriados.<p>
	<b>Passo 2:</b> Clique no botão <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> para salvar os dados de emprego atualizados.<p>
	<img <?php echo createComIcon('../','warn.gif','0') ?>> Nota: Se você quiser cancelar a atualização, clique no botão <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> .
</ul>
<?php
	}else{
?>
<font color="#990000"><b>Comoempregar a pessoa?</b></font>
<ul> 
	<b>Passo 1:</b> Entre com os dados de emprego nos campos apropriados .<p>
	<b>Passo 2:</b> Clique no botão <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>>  para salvar os dados de emprego.<p>
	<img <?php echo createComIcon('../','warn.gif','0') ?>> Nota: Se você quiser cancelar, clique no botão <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> .
</ul>
<?php
	}
}
?>
