<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Como documentar um paciente em um prontuário</b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<?php if($src=="?") : ?>
<b>Passo 1</b>

<ul> Encontre os dados básicos do paciente.<br>
		Entre no campo "Documente o seguinte paciente:"  qualquer uma das seguintes informações:<br>
		<Ul type="disc">
			<li>número do paciente ou<br>
			<li>sobrenome do paciente ou<br>
			<li>nome do paciente <br>
		<font size=1 color="#000099" face="verdana,arial">
		<b>Dica:</b> Se o seu sistema estiver equipado com um scanner de código de barras, clique no campo "Documente o seguinte paciente:" para focá-lo
		e ler o código de barras no cartão do paciente com o scanner. Pule o passo 2.
		</font>
		</ul>
		
</ul>
<b>Passo 2</b>

<ul> Clique no botão <input type="button" value="Pesquise"> para iniciar a pesquisa.
		
</ul>
<b>Alternativa ao passo 2</b>
<ul> Você pode fazer qualquer destas ações:<br>
		<Ul type="disc">		
		<li>entre com o sobrenome do paciente no campo "Sobrenome:"  <br>
		<li>OU entre com o nome do paciente no campo "Nome:"  <br>
		</ul>
		 então clique na tecla "Enter" do teclado.
		
</ul>
<b>Passo 3</b>
<ul> Se a pesquisa retornar um único resultado, um formulário com os dados básicos do paciente será exibido.
		Entretanto, se a pesquisa retornar vários resultados, uma lista será mostrada.
<?php endif;?>

<?php if(($src=="?")||($x1>1)) : ?>

 <br>Para documentar um paciente da lista,
		Clique ou no botão <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> correspondente a ele, ou
		no sobrenome, ou nome, ou número do paciente, ou data de admissão.
</ul>
<?php endif;?>

<?php if($src=="?") : ?>
<b>Passo 4</b>
<?php endif;?>

<?php if(($src!="?")&&($x1==1)) : ?>
<b>Passo 1</b>
<?php endif;?>
<?php if(($x1=="1")||($src=="?")) : ?>
<ul> Uma vez que um novo formulário com os dados do paciente esteja exibido, você pode fazer o seguinte: 
		<Ul type="disc">		
    	<li>entre com informação adicional do segurador ou seguro no campo "Informção extra:" ,<br>
		<li>Clique "<span style="background-color:yellow" ><input type="radio" name="n" value="a">Sim</span>" nos botões de "Conselho médico" se o paciente recebeu conselho médico obrigatório,<br>
		<li>Clique "<span style="background-color:yellow" ><input type="radio" name="n" value="a">Não</span>"nos botões de "Conselho médico" se o paciente não recebeu conselho médico obrigatório,<br>
		<li>entre com o relatório de diagnóstico no campo "Diagnóstico:" ,<br>
		<li>entre com o relatório de terapia no campo "Terapia:" ,<br>
		<li>se necessário, mude a data no campo "Documentado em:" ,<br>
		<li>se necessário, mude o nome no campo "Documentado por:" ,<br>
		<li>se necessário, entre com um número chave no campo "Número chave:" ,<br>
		</ul>
</ul>
<b>Nota</b>
<ul> Se você decidir apagar suas entradas clique no botão <input type="button" value="Apagar">.
</ul>

<b>Passo <?php if($src!="?") print "2"; else print "5"; ?></b>
<ul> Clique no botão <input type="button" value="Salvar"> para salvar o documento.
</ul>
<?php endif;?>
<b>Nota</b>
<ul> Se você decidir cancelar o documento clique no botão <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
		
</ul>


</form>

