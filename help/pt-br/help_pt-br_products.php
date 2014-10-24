<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
<?php
if($x2=="pharma") print "Farmacia - "; else print "Suprimento médico - ";
	switch($src)
	{
	case "head": if($x2=="pharma") print "Requisitando produtos farmaceuticos"; 
						else print "Requisitando produtos";
						break;
	case "catalog": print "Requisitar catalogo";
						break;
	case "orderlist": print "Requisitar cesta ( lista de requisição )";
						break;
	case "final": print "Lista final de requisições";
						break;
	case "maincat": print "Requisitar catalogo";
						break;
	case "arch": print "Requisitar arquivo";
						break;
	case "archshow": print "Requisitar arquivo";
						break;
	case "db": switch($x3)
					{
						case "input": print "Inserindo um novo produto no banco de dados";
						break;
					}
					break;
	case "how2":print "Como requisitar ";
						  if($x2=="pharma") print "produtos farmaceuticos products"; else print "produtos";
	}


 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<?php if($src=="maincat") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como adicionar um artigo no catálogo de requisições?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Primero você deve encontrar o artigo.  Insira uma informação completa ou as primeiras letras da marca, ou o nome genérico, ou o número do pedido, etc. No 
 campo		<nobr><span style="background-color:yellow" >" Procura por palavra-chave: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> .<br>
 	<b>Passo 2: </b>Clique no botão <input type="button" value="Encontrar artigo"> para encontrar o artigo.<br>
 	<b>Passo 3: </b>Se a pesquisa encontrou o artigo que exatamente coincide com a palavra-chave, serão exibidas informações detalhadas do artigo.<br>
 	<b>Passo 4: </b>Clique no botão <input type="button" value="Coloque este artigo no catalogo"> para adicionar o artigo no catalogo.<p>
 	<b>Nota: </b>Se você não quer colocar este artigo no catalogo apenas continue procurando por outro artigo.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como continuar pesquisando?</b>
</font>
<ul>       	
 	Apenas siga as instruções acima para encontrar um artigo.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
A pesquisa encontrou diversos artigos parecidos com minha palavra-chave. O que devo fazer?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Se a pesquisa encotrar o artigo ou informações do artigo que aproximam-se das palavras-chave, uma lista será exibida.<br>
 	<b>Passo 2: </b>Clique no botão <img <?php echo createComIcon('../','dwnarrowgrnlrg.gif','0') ?>>. O artigo será adicionado na listagem do catálogo.<br>
 	<b>Passo 3: </b>Se você desejar ver primeiro uma lista uma informação completa no artigo, clique no seu nome ou no seu botão <img <?php echo createComIcon('../','info3.gif','0') ?>>.<br>
 	<b>Passo 4: </b>A informação completa do artigo será exibida.<br>
 	<b>Passo 5: </b>Clique no botão <input type="button" value="Insira este artigo no catálogo">.<p>
</ul>
	

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Eu quero saber mais informações sobre o artigo. O que eu deveria fazer?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no botão <img <?php echo createComIcon('../','info3.gif','0') ?>> ou no nome do artigo.<br>
 	<b>Passo 2: </b>A informação completa sobre o produto será exibida.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como remover um artigo da lista do catálogo?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no botão <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> do artigo.<br>
</ul>

<?php endif;?>

<?php if($src=="how2") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como solicitar <?php if($x2=="pharma") print "produtos farmaceuticos"; else print "produtos do suprimento médico"; ?>?
</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no menu de opções "<span style="background-color:yellow" > <img <?php echo createComIcon('../','bestell.gif','0') ?>> Ordering </span>" para trocar para solicitação.<br>
 	<b>Passo 2: </b>Se você estiver logado anteriormente, a cesta de solicitações e o catálogo de solicitações serão exibidos. Entretanto, se você não estiver logado anteriormente, você será solicitado a inserir seu nome de usuário e sua senha.<br>

 	<b>Passo 3: </b>Caso solicitado, insira seu nome de usuário e sua senha. Clique no botão <img <?php echo createLDImgSrc('../','continue.gif','0') ?>>.<br>
 	<b>Passo 4: </b>Inicie criando uma lista de pedidos. No quadro direito você verá o catálogo de pedido do seu departamento, ou hospital, ou sala de operações.<p>
 	<b>Passo 5: </b>Se o artigo que você precisa está na lista do catálogo, clique no seu botão <img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>> para colocar <b>uma peça</b> do artigo na cesta (lista de pedido) no quadro da esquerda.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Eu quero colocar mais de uma peça de um artigo no cesto de pedidos. Como fazer isso?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique o botão de selecionar 	<input type="checkbox" name="a" value="a" checked> correspondente ao artigo para selecioná-lo.<br>
 	<b>Passo 2: </b>Insira o número de peças no " Pcs. <input type="text" name="d" size=2 maxlength=2> " campo correspondente ao artigo.<br>
 	<b>Passo 3: </b>Clique no botão <input type="button" value="Colocar no cesto"> para colocar o artigo no cesto (lista de pedidos).<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
O artigo que preciso não está na lista do catálogo. O que devo fazer?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Você deve encontrar o artigo.  Insira uma informação completa ou as primeiras letras da marca, ou o nome genérico, ou o número do pedido, etc. No
campo		<nobr><span style="background-color:yellow" >" Pesquisa palavra-chave: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> .<br>
 	<b>Passo 2: </b>Clique no botão <input type="button" value="Encontrar artigo"> para encontrar o artigo.<br>
 	<b>Passo 3: </b>Se a pesquisa encontrar o artigo ou a informação do artigo que approxima-se da palavra-chave, uma lista será exibida.<br>
 	<b>Passo 4: </b>Se você deseja colocar uma peça do artigo no cesto de pedidos, clique no botão <img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>>. O artigo será colocado no cesto ao mesmo tempo que será incluído na listagem do catálogo.<br>
 	<b>Passo 5: </b>Se você deseja apenas adicionar o artigo na listagem do catálogo, clique no botão <img <?php echo createComIcon('../','dwnarrowgrnlrg.gif','0') ?>>.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Desejo ver mais informações sobre o artigo. O que devo fazer?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no botão <img <?php echo createComIcon('../','info3.gif','0') ?>> ou no nome do artigo.<br>
 	<b>Passo 2: </b>Uma janela exibindo a informação completa sobre o produto irá aparecer.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como remover um artigo da lista do catálogo?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no botão <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> do artigo.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Posso mudar o número de peças do cesto de pedidos?
</b>
</font>
<ul>       	
 	<b>Sim.</b> Apenas substitua o dado com o número de peças antes de finalizar a lista de pedidos.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Todos os artigos que necessito estão no cesto agora. O que devo fazer a seguir?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Você pode continuar enviando a lista de pedidos para a  <?php if($x2=="pharma") print "farmácia"; else print "Repositório médico"; ?>. <br>Clique no botão <input type="button" value="Encerrar a lista de pedidos"> para iniciar o procedimento.<br>
 	<b>Passo 2: </b>A lista de pedidos será exibida novamente. Insira seu nome no campo <nobr>"<span style="background-color:yellow" > Created by <input type="text" name="c" size=15 maxlength=10> </span>"</nobr> .<br>
 	<b>Passo 3: </b>Selecione a prioridade do pedido entre "<span style="background-color:yellow" > Normal<input type="radio" name="x" value="s" checked> Urgente<input type="radio" name="x" > </span>". Marque o botão apropriado.<br>
 	<b>Passo 4: </b>O validador (médico ou cirurgião) deve inserir seu nome no campo <nobr>"<span style="background-color:yellow" > Validado por <input type="text" name="c" size=15 maxlength=10> </span>"</nobr> .<br>
 	<b>Passo 5: </b>O validador (médico ou cirurgião) deve inserir sua senha no campo <nobr>"<span style="background-color:yellow" > Senha: <input type="text" name="c" size=15 maxlength=10> </span>"</nobr> .<br>
 	<b>Passo 6: </b>Clique no botão <input type="button" value="Envia esta lista de pedidos para a <?php if($x2=="pharma") print "farmácia"; else print "repositório médico"; ?>"> para enviar a lista de pedidos.<br>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Note:</b></font> 
<ul>       	
 Se você decidir cancelar o envio da lista de pedidos, clique no link "<span style="background-color:yellow" > << Voltar e editar a lista </span>" para voltar à lista de pedidos.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Desejo encerrar os pedidos agora. O que devo fazer?</b>
</font>
<ul>     
 	<b>Passo 1: </b>Clique no link "<span style="background-color:yellow" > <img <?php echo createComIcon('../','arrow-blu.gif','0') ?>> Finalizar pedidos </span>" para voltar o submenu do<?php if($x2=="pharma") print "farmácia"; else print "repositório medico"; ?> submenu.<br>
</ul>	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Desejo criar uma nova lista de pedidos. O que devo fazer?</b>
</font>
<ul>     
 	<b>Passo 1: </b>Clique no link "<span style="background-color:yellow" > <img <?php echo createComIcon('../','arrow-blu.gif','0') ?>> Iniciar uma nova lista de pedidos </span>" para criar um cesto vazio de pedidos.<br>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 Você pode obter instruções detalhadas do cesto de pedidos ou do catálogo listando ao clicar no botão <img <?php echo createComIcon('../','frage.gif','0') ?>> dentro da janela.
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 Se você decidir fechar clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.
</ul>
<?php endif;?>


<?php if($src=="head") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como solicitar <?php if($x2=="pharma") print "produtos farmaceuticos"; 
						else print "produtos do repositório medico"; ?>?
</b>
</font>
<ul>       	

 	<b>Passo 1: </b>Primeiro crie uma lista de pedidos. No quadro direito você vai ver o catálogo de pedidos para o seu departamento, ou hospital, ou sala de operações.<p>
 	<b>Passo 2: </b>Se o artigo que você precisa está na listagem do catálogo, clique no seu botão <img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>> para colocar <b>uma peça</b> do artigo no cesto (lista de pedidos) no quadro do lado esquerdo.<p>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 Você pode obter instruções detalhadas no cesto de pedidos ou na listagem do catalogo clicando no botão <img <?php echo createComIcon('../','frage.gif','0') ?>> dentro da janela.
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Note:</b></font> 
<ul>       	
 Se você decidir fechar, clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.
</ul>
<?php endif;?>

<?php if($src=="catalog") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como colocar um artigo no cesto (lista de pedidos)?
</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Se o artigo que você precisa está la lista do catálogo, clique no seu botão <img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>> para colocar <b>uma peça</b> do artigo na lista de pedidos (cesto) no quadro esquerdo.<p>
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Desejo colocar mais de uma peça do artigo no cesto de pedidos. Como fazer isso?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no botão selecionar <input type="checkbox" name="a" value="a" checked> correspondente ao artigo para selecioná-lo.<br>
 	<b>Passo 2: </b>Insira o número de peças no campo " Pcs. <input type="text" name="d" size=2 maxlength=2> "  correspondente ao artigo.<br>
 	<b>Passo 3: </b>Clique no botão <input type="button" value="Colocar no cesto"> para colocar o artigo dentro do cesto (lista de pedidos).<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
The artigo que necessito não está na lista do catálogo. O que devo fazer?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Você deve encontrar o artigo. Insira uma informação completa ou as primeiras letras da marca, ou o nome genérico, ou o número do pedido, etc. No campo 
<nobr><span style="background-color:yellow" >" Search palavra-chave: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> .<br>
 	<b>Passo 2: </b>Clique no botão <input type="button" value="Encontrar artigo"> para encontrar o artigo.<br>
 	<b>Passo 3: </b>Se a pesquisa encontrou o artigo que exatamente coincide com a palavra-chave, serão exibidas informações detalhadas do artigo.<br>
 	<b>Passo 4: </b>Se você deseja inserir uma peça do artigo no cesto de pedidos, clique no botão <img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>>. O artigo será colcoado no cesto e ao mesmo tempo será incluído na listagem do catálogo.<br>
 	<b>Passo 5: </b>Se você deseja apenas adicionar o artigo na listagem do catalogo, clique no botão <img <?php echo createComIcon('../','dwnarrowgrnlrg.gif','0') ?>>.<br>

</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Desejo ver mais informações sobre artigo. O que devo fazer?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no botão <img <?php echo createComIcon('../','info3.gif','0') ?>> ou no nome do artigo.<br>
 	<b>Passo 2: </b>Uma janela mostrando a informação completa sobre o produto irá aparecer.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como remover um artigo da lista do catálogo?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no botão <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> do artigo.<br>
</ul>

<?php endif;?>

<?php if($src=="orderlist") : ?>
	<?php if($x1=="0") : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 O cesto está vazio neste momento.<p>
 Para criar uma lista de pedidos, selecione o artigo que você precisa da lista do catálogo no quadro direito e coloque no cesto.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como colocar um artigo no cesto (lista de pedidos)?
</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Se o artigo que você precisa está na lista do catálogo, clique no seu botão <img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>> para colocar <b>uma peça</b> do artigo na lista de pedidos (cesto).<br> A lista de pedidos irá
	ser exibida automaticamente no cesto do quadro da esquerda.<p>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Note:</b></font> 
<ul>       	
 Para instruções detalhadas sobre como pesquisar, selecionar e colocar artigos artigos da lista do catalogo no cesto, clique no botão <img <?php echo createComIcon('../','frage.gif','0') ?>> dentro do quadro do catalogo de pedidos à direita.<p>
</ul>

	<?php else : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Posso mudar o número de peças no cesto de pedidos?
</b>
</font>
<ul>       	
 	<b>Sim.</b> Apenas substitua a entrada com o númenro de peças antes de finalizar a lista de pedidos.
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Desejo ver mais informações sobre o artigo. O que devo fazer?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no botão <img <?php echo createComIcon('../','info3.gif','0') ?>> do artigo.<br>
 	<b>Passo 2: </b>Uma janela mostrando informações completas sobre o produto irá aparecer.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como remover um artigo do cesto?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no botão <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> do artigo.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Todos os artigos que necessito estão no cesto agora. O que devo fazer a seguir?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Você pode proceder enviando a lista de pedidos para a farmácia. <br>Clique no botão <input type="button" value="Finalizar a lista de pedidos"> para iniciar o procedimento.<br>
 	<b>Passo 2: </b>A lista de pedidos será exibida novamente. Insira seu nome no campo <nobr>"<span style="background-color:yellow" > Criado por <input type="text" name="c" size=15 maxlength=10> </span>"</nobr> .<br>
 	<b>Passo 3: </b>Selecione o status de prioridade do pedido entre "<span style="background-color:yellow" > Normal<input type="radio" name="x" value="s" checked> Urgente<input type="radio" name="x" > </span>". Clique no botão apropriado.<br>
 	<b>Passo 4: </b>O validador (médico ou cirurgião) deve inserir seu nome no campo <nobr>"<span style="background-color:yellow" > Validado por <input type="text" name="c" size=15 maxlength=10> </span>"</nobr> .<br>
 	<b>Passo 5: </b>O validador (médico ou cirurgião) deve inserir sua senha no campo <nobr>"<span style="background-color:yellow" > Senha: <input type="text" name="c" size=15 maxlength=10> </span>"</nobr> .<br>
 	<b>Passo 6: </b>Clique no botão <input type="button" value="Envia sua lista de pedidos para a farmácia"> para enviar a lista de pedidos.<br>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Note:</b></font> 
<ul>       	
 Se você decidir cancelar o envio da lista de pedidos, clique no link "<span style="background-color:yellow" > << Voltar e editar a lista </span>" para voltar para a lista de pedidos.
</ul>
	<?php endif;?>

<?php endif;?>


<?php if($src=="final") : ?>
	<?php if($x1=="1") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Desejo enviar os pedidos agora. O que devo fazer?</b>
</font>
<ul>     
 	<b>Passo 1: </b>Clique the link "<span style="background-color:yellow" > <img <?php echo createComIcon('../','arrow-blu.gif','0') ?>> Finalizar os pedidos </span>" para voltar para o submenu da farmácia.<br>
</ul>	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Desejo criar uma nova lista de pedidos. O que devo fazer?</b>
</font>
<ul>     
 	<b>Passo 1: </b>Clique no link "<span style="background-color:yellow" > <img <?php echo createComIcon('../','arrow-blu.gif','0') ?>> Iniciar a nova lista de pedidos </span>" para criar um cesto de pedidos vazio.<br>
</ul>		<?php else : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como enviar a lista de pedidos final?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Insira seu nome no campo <nobr>"<span style="background-color:yellow" > Criado por <input type="text" name="c" size=15 maxlength=10> </span>"</nobr> .<br>
 	<b>Passo 2: </b>Selecione a prioridade do pedido entre "<span style="background-color:yellow" > Normal<input type="radio" name="x" value="s" checked> Urgente<input type="radio" name="x" > </span>". Clique no botão apropriado.<br>
 	<b>Passo 3: </b>O validador (médico ou cirurgião) deve inserir seu nome no campo <nobr>"<span style="background-color:yellow" > Validado por <input type="text" name="c" size=15 maxlength=10> </span>"</nobr> .<br>
 	<b>Passo 4: </b>O validador (médico ou cirurgião) deve inserir sua senha no campo <nobr>"<span style="background-color:yellow" > Senha: <input type="text" name="c" size=15 maxlength=10> </span>"</nobr> .<br>
 	<b>Passo 5: </b>Clique no botão <input type="button" value="Envia sua lista de pedidos para a farmácia"> para enviar a lista de pedidos.<br>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 Se você decidir cancelar a lista de pedidos, clique no link "<span style="background-color:yellow" > << Voltar e editar a lista </span>" para voltar à lista de pedidos.
</ul>
	<?php endif;?>

<?php endif;?>
<!-- ++++++++++++++++++++++++++++++++++ archive +++++++++++++++++++++++++++++++++++++++++++ -->
<?php if($src=="arch") : ?>


<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Desejo ver as listas de pedidos arquivadas.</b></font>
<ul>  	<b>Passo 1: </b> Insira a informação completa ou algumas primeiras letras do nome do departmento, ou id, ou data do pedido, ou prioridade ("urgente") no 
			campo	<nobr><span style="background-color:yellow" >" Procura palavra-chave: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> .<br>
 	<b>Passo 2: </b>Marque ou desmarque as seguintes caixas de seleção para pesquisar as categorias:
<ul> 	
  	<input type="checkbox" name="d" checked> Data<br>
	<input type="checkbox" name="d" checked> Departmento<br>
  	<input type="checkbox" name="d" checked> Prioridade<br>
	Por padrão, todas as três caixas de seleção serão marcadas e a pesquisa irá pesquisar em todas as três categorias. Se você desejar excluir uma categoria clique na sua caixa de seleção para desmarca-la.
</ul> 	
<b>Passo 3: </b>Clique no botão <input type="button" value="Pesquisa"> para encontrar o artigo.<br>
 	<b>Passo 4: </b>Se a pesquisa encontrar o pedido ou os pedidos que approximam-se às palavras-chave, uma lista será exibida.<br>
 	<b>Passo 5: </b>Clique no botão da lista de pedidos <img <?php echo createComIcon('../','uparrowgrnlrg.gif','0') ?>>. Os detalhes do pedido serão exibidos<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Diversos pedidos serão listados. Como ver um pedido em particular?</b></font>
<ul>  	
 	<b>Passo 1: </b>Clique no botão de pedidos <img <?php echo createComIcon('../','uparrowgrnlrg.gif','0') ?>>. Os detalhes dos pedidos serão exibidos<br>
</ul>

<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Note:</b></font> 
<ul>       	
 Se você decidir terminar sua pesquisa e fechar, clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.
</ul>


	<?php endif;?>
	
<?php if($src=="archshow") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Desejo ver mais informações sobre um artigo na lista de pedidos. O que devo fazer?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no botão do artigo <img <?php echo createComIcon('../','info3.gif','0') ?>> .<br>
 	<b>Passo 2: </b>Uma janela mostrando a informação completa sobre o produto irá aparecer.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Desejo ver a lista dos pedidos arquivados novamente. O que devo fazer?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no botão <img <?php echo createLDImgSrc('../','back2.gif','0') ?>> .<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Desejo fazer uma nova pesquisa na lista de pedidos arquivados. O que devo fazer?</b></font>
<ul>  	<b>Passo 1: </b> Insira uma informação completa ou as primeiras letras do nome do departamento, ou id, ou data do pedido, ou prioridade ("urgente") no campo 
				<nobr><span style="background-color:yellow" >" Procura palavra-chave: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> .<br>
 	<b>Passo 2: </b>Marque ou desmarque as seguintes caixas de seleção para a pesquisa por categorias:
<ul> 	
  	<input type="checkbox" name="d" checked> Data<br>
	<input type="checkbox" name="d" checked> Departmento<br>
  	<input type="checkbox" name="d" checked> Prioridade<br>
	Por padrão, todas as três caixas de seleção serão marcadas e a pesquisa irá pesquisar em todas categorias. Se você desejar excluir uma categoria clique na sua caixa de seleção para desmarcar.
</ul> 	
<b>Passo 3: </b>Clique no botão <input type="button" value="Pesquisar"> para encontrar o artigo.<br>
 	<b>Passo 4: </b>Se a pesquisa encontrar o pedido ou pedidos que aproximam-se a palavra-chave, uma lista será exibida.<br>
</ul>
	<?php endif;?>	
	

<?php if($src=="db") : ?>
	<?php if($x1=="") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como inserir um novo produto na base de dados?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Primeiro insira todas as informações disponíveis sobre o produto nos seus campos correspondentes.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Desejo selecionar uma figura do produto. Como fazer isso?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no botão <input type="button" value="Selecionar..."> no campo "<span style="background-color:yellow" > Picture file </span>" .<br>
 	<b>Passo 2: </b>Uma pequena janelapara selecionar um arquivo irá aparecer. Selecione o arquivo da figura da sua escolha e clique "OK".<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Finalizei a entrada de todas as informações disponíveis. Como salvar?</b>
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
 	<b>Passo 3: </b>Insira as informações disponíveis sobre o novo produto.<br>
 	<b>Passo 4: </b>Clique no botão <input type="button" value="Salvar"> para salvar a informação.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Desejo editar o produto que está atualmente sendo exibido. Como fazer isso?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no botão <input type="button" value="Atualizar ou editar">.<br>
 	<b>Passo 2: </b>A informação do produto será automaticamente inserida no formulário de edição.<br>
 	<b>Passo 3: </b>Edite a informação.<br>
 	<b>Passo 4: </b>Clique no botão <input type="button" value="Save"> para salvar a nova informação.<br>
</ul>
	
	<?php endif;?>	
<?php endif;?>	
</form>

