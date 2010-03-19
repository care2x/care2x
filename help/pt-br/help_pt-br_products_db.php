<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
<?php
if($x2=="pharma") print "Farmacia - "; else print "Suprimentos médicos - ";
	switch($src)
	{
	case "input": if($x1=="update") print "Editando uma informação de produto";
                          else print "Inserindo um novo produto no banco de dados";
					break;
	case "search": print "Pesquisar um produto";
					break;
	case "mng": print "Gerenciar produtos no banco de dados";
					break;
	case "delete": print "Removendo um produto do banco de dados";
					break;
	}


 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >

	

<?php if($src=="input") : ?>
	<?php if($x1=="") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como inserir um novo produto no banco da dados?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Primeiro insira todas informações disponíveis sobre o produto nos seus campos correspondentes.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Eu quero selecionar uma figura do produto. Como fazer isso?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no botão <input type="button" value="Procurar..."> no campo "<span style="background-color:yellow" > arquivo da figura </span>" .<br>
 	<b>Passo 2: </b>Uma pequena janela para selecionar um arquivo irá aparecer. Selecione o arquivo com a figura de sua escolha e clique em "OK".<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Finalizei a entrada de todas as informações de produto disponíveis. Como salvar?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no botão <input type="button" value="Salvar">.<br>
</ul>
	<?php endif;?>	
	<?php if($x1=="save") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como inserir um novo produto no banco de dados?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no botão <input type="button" value="Novo produto"> .<br>
 	<b>Passo 2: </b>O formulário de entrada irá aparecer.<br>
 	<b>Passo 3: </b>Insira todas as informações disponíveis sobre o novo produto.<br>
 	<b>Passo 4: </b>Clique no botão <input type="button" value="Salvar"> para salvar as informações.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Eu quero editar um produto que já está cadastrado. Como fazer isso?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no botão <input type="button" value="Atualizar ou Editar">.<br>
 	<b>Passo 2: </b>A informação do produto será automaticamente mostrada junto ao formulário de edição.<br>
 	<b>Passo 3: </b>Edite a informação.<br>
 	<b>Passo 4: </b>Clique no botão <input type="button" value="Salvar"> para salvar a nova informação.<br>
</ul>
	
	<?php endif;?>	
	<?php if($x1=="update") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Eu quero editar o produto que está sendo mostrado agora. Como fazer isso?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Se necessário primeiramente apague as informações existentes em um campo.<p>
 	<b>Passo 2: </b>Digite a nova informação no campo apropriado.<p>
 	<b>Passo 3: </b>Clique no botão <input type="button" value="Salvar"> para salvar a nova informação.<br>
</ul>
	<?php endif;?>	
<?php endif;?>	

<?php if($src=="search") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como pesquisar um produto?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Insira uma informação completa ou as primeiras letras da marca, ou o nome genérico, ou o número do pedido, etc. No 
 campo				<nobr><span style="background-color:yellow" >" Procura por palavra-chave...: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> .<br>
 	<b>Passo 2: </b>Clique no botão <input type="button" value="Pesquisar"> para encontrar o artigo.<br>
 	<b>Passo 3: </b>Se a pesquisa encontrou o artigo que exatamente coincide com a palavra-chave, serão exibidas informações detalhadas do artigo.<br>
 	<b>Passo 4: </b>Se a pesquisa encontrar diversos artigos relacionados com a palavra-chave, uma lista dos artigos será exibida.<br>
</ul>
	<?php if($x1!="multiple") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Uma lista com diversos artigos está listada. Como ver as informações de um artigo em particular?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no botão <img <?php echo createComIcon('../','info3.gif','0') ?>> ou no nome do artigo.<br>
</ul>
	<?php endif;?>
	<?php if($x1=="multiple") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Desejo ver a lista prévia dos artigos. O que eu deveria fazer?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no botão <input type="button" value="Voltar">.<br>
</ul>
	<?php endif;?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 Se você decidir cancelar clique no botão <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
</ul>

<?php endif;?>

<?php if($src=="mng") : ?>
	<?php if(($x3=="1")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como editar a informação de um produto?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Editar a informação sobre um novo produto.<br>
 	<b>Passo 2: </b>Clique no botão <input type="button" value="Salvar"> para salvar a nova informação.<br>
</ul>
	<?php endif;?>

	<?php if($x1=="multiple") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como editar a informação do produto em exibição?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no botão <input type="button" value="Atualizar ou editar">.<br>
 	<b>Passo 2: </b>A informação do produto será automaticamente inserida no formulário de edição.<br>
 	<b>Passo 3: </b>Edite a informação.<br>
 	<b>Passo 4: </b>Clique no botão <input type="button" value="Salvar"> para salvar a nova informação.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como remover o produto que está atualmente sendo exibido?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no botão <input type="button" value="Remover do banco de dados">.<br>
 	<b>Passo 2: </b>Você será consultado se deseja realmente remover a informação do banco de dados.<br>
 	<b>Passo 3: </b>Se você realmente quer remover a informação do produto, clique no botão <input type="button" value="Sim, estou certo disso. Remova o dado."><p>
 	<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Note:</b></font> Remover ou apagar um dado não pode ser desfeito.<br>
</ul>	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Eu não quero remover a informação do produto. O que devo fazer?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no link "<span style="background-color:yellow" > << Não, não apague. Volte </span>".<br>
</ul>	
<?php endif;?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como gerenciar um produto no banco de dados?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Primeiro encontre o artigo. Insira a informação completa ou as primeiras letras da marca do artigo, ou nome generico, ou numero do pedido, etc. no 
			campo	<nobr><span style="background-color:yellow" >" Procura palavra-chave: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> .<br>
 	<b>Passo 2: </b>Clique no botão <input type="button" value="Pesquisar"> para encontrar o artigo.<br>
 	<b>Passo 3: </b>Se a pesquisa encontrou o artigo que exatamente coincide com a palavra-chave, serão exibidas informações detalhadas do artigo.<br>
 	<b>Passo 4: </b>Se a pesquisa encontrar diversos artigos relacionados com a palavra-chave, uma lista dos artigos será exibida.<br>
</ul>



	<?php if(($x1!="multiple")&&($x3=="")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Uma lista com diversos artigos está listada. Como ver as informações de um artigo em particular?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no botão <img <?php echo createComIcon('../','info3.gif','0') ?>> ou no nome do artigo.<br>
</ul>
	<?php endif;?>
	<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Note:</b></font> 
<ul>       	
 Se você decidir cancelar clique no botão <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
</ul>
<?php endif;?>



<?php if($src=="delete") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Desejo remover o produto do banco de dados. O que devo fazer?</b>
</font>
<ul>       	
 	<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> Remover ou apagar um produto não pode ser desfeito.<p>
 	<b>Passo 1: </b>Se você estiver certo que deseja apagar o produto, clique no botão <input type="button" value="Sim, estou certo. Apague o dado.">.<br>
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Eu não quero remover a informação do produto. O que devo fazer?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no link "<span style="background-color:yellow" > << Não, não apague. Voltar </span>".<br>
</ul>	

<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 Se você decidir cancelar clique no botão <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
</ul>

<?php endif;?>	

<?php if($src=="report") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como escrever um relatório?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Escreva seu relatório no campo
				<nobr><span style="background-color:yellow" >" Relatório: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> .<br>
 	<b>Passo 2: </b>Digite seu nome no campo
				<nobr><span style="background-color:yellow" >" Relator: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> .<br>
 	<b>Passo 3: </b>Insire seu número pessoal no campo
				<nobr><span style="background-color:yellow" >" Num pessoal: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> .<br>
 	<b>Passo 4: </b>Clique no botão <input type="button" value="Envia"> para enviar o relatório.<br>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b><br></font> 
       	
Se você decidir cancelar ou finalizar clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.
</ul>
<?php endif;?>	

</form>

