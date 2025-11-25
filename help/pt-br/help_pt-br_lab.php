<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
Laboratorio m�dico- 
<?php
if($src=="create")
{
	switch($x1)
	{
	case "": print "Inicie um novo documento de registro";
						break;
	case "fresh": print "Inicie um novo documento de registro";
						break;
	case "get": print  "";
						break;
	case "logmain": print "Edite as entradas documentadas no registro de uma opera��o";
						break;
	default: print "Registre uma nova opera��o";	
	}
}
if($src=="time")
{
	print "Documentando ";
	switch($x1)
	{
	case "entry_out": print "hor�rio de entrada e sa�da";
						break;
	case "cut_close": print "tempos de incis�o e sutura";
						break;
	case "wait_time": print "tempos de espera";
						break;
	case "bandage_time": print "tempos de curativo";
						break;
	case "repos_time": print "tempos de reposi��o";
	}
}
if($src=="person")
{
	print "Documentando ";
	switch($x1)
	{
	case "operator":$person="um cirurgi�o"; 
						break;
	case "assist":$person="um assistente de cirurgi�o"; 
						break;
	case "scrub": $person="um enfermeiro instrumentista";
						break;
	case "rotating":$person="um enfermeiro rotativo"; 
						break;
	case "ana": $person="um  anestesiologista";
	}
	print $person;
}
if($src=="search")
{
	print "Pesquise um paciente";	
/*	switch($x1)
	{
	case "search": print "Selecionando um documento em particular";
						break;
	case "": 
						break;
	case "get": print  "Documenta��o de registro de opera��o de um paciente";
						break;
	case "fresh": print "Pesquise a documenta��o de registro de opera��o de um paciente";
	}
*/}
if($src=="arch")
{
	print "Archive";	
	/*switch($x1)
	{
	case "dummy": print "Arquivo";
						break;
	case "": print "Arquivo";
						break;
	case "?": print "Arquivo";
						break;
	case "search": print  "Lista de resultados de pesquisa do arquivo";
						break;
	case "select": print "Documentos do paciente";
	}*/
}
if($src=="input")
{
	print "Entrando com resultados de teste";	
	/*switch($x1)
	{
	case "dummy": print "Arquivo";
						break;
	case "": print "Arquivo";
						break;
	case "?": print "Arquivo";
						break;
	case "search": print  "Lista de resultados da pesquisa do arquivo";
						break;
	case "select": print "Documentos do paciente";
	}*/
}
 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<?php if($src=="person") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como entrar <?php echo $person ?> via lista de sele��o r�pida?</b>
</font>
<ul>       	
 	<b>Nota: </b>Se <?php echo $person ?> foi  selecionado em uma opera��o anterior, seu nome ser� listado na lista de sele��o r�pida.<p>
 	<b>Passo 1: </b>Verifique primeiro se sua  fun��o est� corretamente selecionada na caixa de sele��o " Fun��o OR" . Se n�o estiver, selecione sua fun��o OR correta.<br>
 	<b>Passo 2: </b>Clique no sobrenome do <?php echo $person ?>, ou  nome, ou o 
	<nobr>"<span style="background-color:yellow" > <img <?php echo createComIcon('../','uparrowgrnlrg.gif','0') ?>> Entre esta pessoa como link <?php echo $person ?>... </span>"</nobr> .
	O cirurgi�o ser� acrescentado automaticamente na lista "entradas correntes"  .<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
<?php echo ucfirst($person) ?> n�o aparece na lista de sele��o r�pida; como entrar <?php echo $person ?>?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Entre  ou com uma informa��o completa ou com umas poucas letras de informa��o, como por exemplo, o sobrenome, ou  nome do <?php echo $person ?> no campo "<span style="background-color:yellow" > Pesquise um novo <?php echo substr($person,2) ?>... </span>".<br>
 	<b>Passo 2: </b>Clique no bot�o <input type="button" value="OK"> para iniciar a pesquisa por <?php echo $person ?>.<br>
 	<b>Passo 3: </b>A pesquisa listar� os resultados. clique no sobrenome, ou nome, ou  <nobr>"<span style="background-color:yellow" > <img <?php echo createComIcon('../','uparrowgrnlrg.gif','0') ?>> Entre esta pessoa como um link <?php echo $person ?>... </span>"</nobr> correspondente a <?php echo $person ?> que voc� quer documentar.
</ul>


<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b> Como apagar <?php echo $person ?> da lista?</b></font> 
<ul>       	
 	<b>Passo 1: </b>Clique no �cone <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> � direita do nome da pessoa.<br>
 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b> Eu terminei. Como voltar ao livro de registros?</b></font> 
<ul>       	
 	<b>Passo 1: </b>Clique no bot�o <img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle"> que aparecer� depois que voc� selecionou <?php echo $person ?>.<br>
 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 Se voc� decidir cancelar clique no bot�o <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
</ul>
<?php endif;?>

<?php if($src=="time") : ?>
	<?php if($x1=="entry_out") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como documentar o hor�rio de entrada e sa�da?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Entre com o hor�rio de entrada no campo "<span style="background-color:yellow" > de: <input type="text" name="d" size=5 maxlength=5> </span>" na coluna da esquerda.<br>
 	<b>Passo 2: </b>Entre com o hor�rio de sa�da no campo "<span style="background-color:yellow" > at�: <input type="text" name="d" size=5 maxlength=5> </span>" na coluna da direita.<p>
<ul>       	
 	<b>Dica: </b>Entre ou com "n" ou "N" (significando Agora) no campo de entrada para automaticamente entrar com o hor�rio atual.
</ul><br>
 	<b>Nota: </b>Voc� pode entrar com v�rios hor�rios de entrada e sa�da todos de uma vez s� antes de voc� salvar a informa��o.<p>
</ul>

	<?php endif;?>
	<?php if($x1=="cut_close") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como documentar os tempos de incis�o e sutura?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Entre com a hora de incis�o no campo "<span style="background-color:yellow" > de: <input type="text" name="d" size=5 maxlength=5> </span>" na coluna da esquerda.<br>
 	<b>Passo 2: </b>Entre com a hora da sutura no campo "<span style="background-color:yellow" > at�: <input type="text" name="d" size=5 maxlength=5> </span>" na coluna da direita.<p>
<ul>       	
 	<b>Dica: </b>Entre ou com "n" ou "N" (significando Agora) no campo de entrada para automaticamente entrar com a hora atual.
</ul><br>
 	<b>Nota: </b>Voc� pode entrar com v�rios hor�rios de incis�o e sutura, todos de uma vez s�, antes de voc� salvar a informa��o.<p>
</ul>

	<?php endif;?>
	<?php if($x1=="wait_time") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como documentar tempos ociosos (em espera)?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Entre com o hor�rio de in�cio no campo "<span style="background-color:yellow" > de: <input type="text" name="d" size=5 maxlength=5> </span>" na primeira coluna.<br>
 	<b>Passo 2: </b>Entre com o hor�rio de fim no campo "<span style="background-color:yellow" > at�: <input type="text" name="d" size=5 maxlength=5> </span>" na segunda coluna.<p>
<ul>       	
 	<b>Tip: </b>Entre ou com "n" ou "N" (significando Agora) no campo de entrada para automaticamente entrar com o hor�rio atual.
</ul><br>
 	<b>Passo 3: </b>Selecione a raz�o a partir da caixa de sele��o na terceira coluna (Raz�o).<p>
 	<b>Nota: </b>Voc� pode entrar com v�rios hor�rios de in�cio e fim, e raz�es todos de uma vez s�, antes de voc� salvar a informa��o.<p>
</ul>

	<?php endif;?>
	<?php if($x1=="bandage_time") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como documentar tempos de curativo?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Entre com o hor�rio de in�cio no campo "<span style="background-color:yellow" > de: <input type="text" name="d" size=5 maxlength=5> </span>" na coluna da esquerda.<br>
 	<b>Passo 2: </b>Entre com o hor�rio de fim no campo "<span style="background-color:yellow" > at�: <input type="text" name="d" size=5 maxlength=5> </span>" na coluna da direita.<p>
<ul>       	
 	<b>Dica: </b>Entre ou com "n" ou "N" (significando Agora) no campo de entrada para automaticamente entrar com o hor�rio atual.
</ul><br>
 	<b>Nota: </b>Voc� pode entrar com v�rios hor�rios de de in�cio e fim, todos de uma vez s�, antes de voc� salvar a informa��o.<p>
</ul>

	<?php endif;?>
	<?php if($x1=="repos_time") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Com documentar tempos de reposi��o?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Entre com o hor�rio de in�cio no campo "<span style="background-color:yellow" > de: <input type="text" name="d" size=5 maxlength=5> </span>" na coluna da esquerda.<br>
 	<b>Passo 2: </b>Entre com o hor�rio de fim no campo "<span style="background-color:yellow" > at�: <input type="text" name="d" size=5 maxlength=5> </span>" na coluna da direita.<p>
<ul>       	
 	<b>Dica: </b>Entre ou com "n" ou "N" (significando Agora) no campo de entrada para automaticamente entrar com o hor�rio atual.
</ul><br>
 	<b>Nota: </b>Voc� pode entrar com v�rios hor�rios de de in�cio e fim, todos de uma vez s�, antes de voc� salvar a informa��o.<p>
</ul>

	<?php endif;?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como salvar a informa��o?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no bot�o <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> para salvar a informa��o<br>
 	<b>Passo 2: </b>Se voc� terminou, clique no bot�o <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> para fechar a janela e voltar ao livro de registros.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b> Eu quero apagar as entradas mas clicando no bot�o "Apagar dados" parece que n�o funciona. O que devo fazer?</b></font> 
<ul>       	
 	<b>Nota: </b>Clicando no bot�o  "Apagar dados" apagar� somente as entradas que n�o foram salvas ainda. Se voc� quiser apagar entradas
	que foram salvas previamente, siga estas instru��es:<p>
 	<b>Passo 1: </b>Clique no campo de entrada do hor�rio que voc� quer apagar.<br>
 	<b>Passo 2: </b>Apague o hor�rio manualmente usando as teclas "Del" ou "Backspace" do teclado.<br>
 	<b>Passo 3: </b>Clique no bot�o <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> para salvar as altera��es.<br>
 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 Se voc� decidir cancelar clique no bot�o <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
</ul>
<?php endif;?>


<?php if($src=="create") : ?>
	<?php if($x1=="logmain") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como editar as entradas de registro de uma opera��o?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no bot�o <img src="../img/update3.gif" width=15 height=14 border=0> correspondente �s entradas de registro do paciente.<br>
 	<b>Passo 2: </b>As entradas do registro do paciente ser�o copiadas para o quadro de edi��o. Voc� pode editar as entradas seguindo as instru��es para documenta��o
		de uma opera��o.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como abrir o arquivo de dados de um paciente?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no bot�o <img <?php echo createComIcon('../','info3.gif','0') ?>> � esquerda do n�mero do paciente.<br>
 	<b>Passo 2: </b>O arquivo de dados do paciente abrir�.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como mudar para outro departmento e/ou sala de opera��o?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Selecione o departamento a partir da caixa de sele��o 
				<select name="dept" size=1>
				<?php
$Or2Dept=get_meta_tags("../global_conf/resolve_or2ordept.pid");
					$opabt=get_meta_tags("../global_conf/$lang/op_tag_dept.pid");

					foreach($opabt as $x=>$v)
					{
						if($x=="anaesth") continue;
						print'
					<option value="'.$x.'"';
						if ($dept==$x) print " selecionado";
						print '> '.$v.'</option>';
					}
				?>
					
				</select>.
<br>
 	<b>Passo 2: </b>Selecione a sala de opera��o a partir da caixa de sele��o <select name="saal" size=1 >
				<?php
foreach($Or2Dept as $x=>$v)
					{
						print'
					<option value="'.$x.'"';
						if ($saal==$x) print " selecionado";
						print '> '.$x.'</option>';
					}
				?>
				</select>.
<br>
 	<b>Passo 3: </b>Clique no bot�o <input type="button" value="Altere"> para alterar para o outro departamento e/ou sala de opera��o.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como exibir as entaradas do registro de um certo dia diferente do que est� sendo exibido?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Para mostrar as entradas de registro do(s) dia(s) anterior(es), clique no link "<span style="background-color:yellow" > Dia anterior </span>" no canto superior esquerdo da tabela.<br>
	Clique tantas vezes quantas necess�rias at� que as entradas de registro do dia desejado sejam mostradas.<br>
 	<b>Passo 2: </b>Para mostrar as entradas de registro do(s) dia(s) posterior(es), clique no link "<span style="background-color:yellow" > Dia seguinte </span>" no canto superior direito da tabela.<br>
	Clique tantas vezes quantas necess�rias at� que as entradas de registro do dia desejado sejam mostradas.<br>
</ul>

<hr>

	<?php endif;?>
	
	<?php if($x2=="material") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como documentar um material usado para a opera��o?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Digite o n�mero de artigo do material no campo "<span style="background-color:yellow" > No. artigo: </span>" .<p>
	<b>Maneiras alternativas: </b>
	<ul type=disc>  	
	<li>Entre  ou com uma informa��o completa ou com umas poucas letras do nome do material, descri��o gen�rica do produto, n�mero de licen�a, ou n�mero da ordem no campo "<span style="background-color:yellow" > No. do artigo: </span>" .
	<li>Fa�a a varredura no c�digo de barras do artigo com o scanner.
	</ul><br> 
 	<b>Passo 2: </b>Clique no bot�o <input type="button" value="OK"> ou no "enter" do teclado para pesquisar o produto.<p> 
<ul>       	
 	<b>Nota: </b>Se a pesquisa encontrar um resultado, a informa��o do material ser� adicionada imediatamente no documento.<p> 
 	<b>Nota: </b>Se a pesquisa encontrar v�rios resultados, uma lista ser� mostrada. Clique no bot�o <img <?php echo createComIcon('../','bul_arrowgrnlrg.gif','0') ?>> ou no n�mero do artigo, ou no nome do artigo para adicion�-lo ao documento.<p> 
	</ul>
 	<b>Passo 3: </b>Se o artigo for acrescentado ao documento, voc� pode alterar a entrada no campo no.Pcs "<span style="background-color:yellow" > .</span>" se necess�rio.<p> 
<ul>       	
 	<b>Nota: </b>Depois que voc� alterou a entrada no campo "no.Pcs." , os bot�es "Salvar" e "Apague dados" aparecer�o.<p> 
	</ul>
 	<b>Passo 4: </b>Se voc� alterou a entrada no campo "no.Pcs.", clique no bot�o <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> para salvar as altera��es.<p> 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como remover um artigo da lista?</b>
</font>
<ul> 
 	<b>Passo 1: </b>Clique no �cone <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> correspondente ao artigo.<br> 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
O artigo n�o foi encontrado. Como entrar com as informa��es de um artigo manualmente?</b>
</font>
<ul> 
 	<b>Passo 1: </b>Clique no link "<span style="background-color:yellow" > <img <?php echo createComIcon('../','accessrights.gif','0') ?>> Para entrar manualmente com o artigo, clique aqui. </span>" .<br> 
 	<b>Passo 2: </b>Manualmente entre com as informa��es do artigo nos campos correspondentes.<p> 
 	<b>Passo 3: </b>Clique no bot�o <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> para acrescentar as informa��es do artigo no documento<p> 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 Se voc� decidir cancelar clique no bot�o <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como mostrar o livro principal de registros novamente?</b>
</font>
<ul> 
 	<b>Passo 1: </b>Clique no link "<span style="background-color:yellow" > <img <?php echo createComIcon('../','manfldr.gif','0') ?>> Mostre livro de registro. </span>" .<br> 
</ul>
<hr>
	<?php endif;?>

	<?php if(($x1=="")||($x1=="fresh")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como iniciar um documento de registro para uma opera��o?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Encontre primeiro o paciente. Digite o n�mero do paciente no campo "<span style="background-color:yellow" > No. do paciente: </span>" .<p>
	<b>Modos alternativos: </b>
	<ul type=disc>  	
	<li>Entre  ou com uma informa��o completa ou com umas poucas letras do sobrenome do paciente ou nome no campo "<span style="background-color:yellow" > Sobrenome, nome </span>" .
	<li>Entre com uma data completa ou os primeiros d�gitos da data de nascimento do paciente no campo "<span style="background-color:yellow" > Data de nascimento </span>" .
	</ul>
 	<b>Passo 2: </b>Clique no bot�o <input type="button" value="Pesquise paciente"> para iniciar a pesquisa de paciente.<p> 
<ul>       	
 	<b>Nota: </b>Se a pesquisa encontrar um resultado, os dados b�sicos do paciente ser�o entrados imediatamente nos seus campos correspondentes.<p> 
 	<b>Nota: </b>Se a pesquisa encontrar v�rios resultados,  uma lista ser� mostrada. Clique no sobrenome do paciente, ou nome para selecion�-lo para documenta��o.<p> 
	</ul>
 	<b>Passo 3: </b>Clique novamente no bot�o <img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>> novamente para maiores instru��es.<p> 

</ul>

	<?php else : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como entrar com o diagn�stico para a opera��o?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Digite o diagn�stico no campo "<span style="background-color:yellow" > Diagn�stico: </span>" .<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como entrar com a informa��o do cirurgi�o?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no link "<span style="background-color:yellow" > Cirurgi�o </span>" .<br>
 	<b>Passo 2: </b>Uma janela aparecer� para se entrar com a informa��o do cirurgi�o. <br>
 	<b>Passo 3: </b>Siga as instru��es da janela ou clique no bot�o "Ajuda" dentro da janela para maiores instru��es de ajuda. <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como entrar com as informa��es do assistente do cirurgi�o?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no link "<span style="background-color:yellow" > Assistente </span>" .<br>
 	<b>Passo 2: </b>Uma janela para entrar com as informa��es do assistente do cirurgi�o aparecer�. <br>
 	<b>Passo 3: </b>Siga as instru��es na janela ou clique no bot�o "Ajuda" dentro da janela para maiores instru��es de ajuda. <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como entrar com as informa��es dos enfermeiros instrumentistas?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no link "<span style="background-color:yellow" > Enfermeiro instrumentista </span>" .<br>
 	<b>Passo 2: </b>Uma janela para entrar com as informa��es do enfermeiro instrumentista aparecer�. <br>
 	<b>Passo 3: </b>Siga as instru��es na janela ou clique no bot�o "Ajuda" dentro da janela para maiores instru��es de ajuda. <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como entrar com as informa��es dos enfermeiros rotativos?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no link "<span style="background-color:yellow" > Enfermeiro rotativo </span>" .<br>
 	<b>Passo 2: </b>Uma janela para entrar com as informa��es do enfermeiro rotativo aparecer�. <br>
 	<b>Passo 3: </b>Siga as instru��es na janela ou clique no bot�o "Ajuda" dentro da janela para maiores instru��es de ajuda. <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como entrar com o tipo de anestesia utilizada para a opera��o?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Selecione o tipo de anestesia do campo "<span style="background-color:yellow" > Anestesia <select name="a">
                                                                     	<option > ITA</option>
                                                                     	<option > Plexus</option>
                                                                     	<option > ITA-Jet</option>
                                                                     	<option > ITA-Mask</option>
                                                                     	<option > LA</option>
                                                                     	<option > DS</option>
                                                                     	<option > AS</option>
                                                                     </select> </span>" .<p>
	<ul type=disc>       	
 	<li><b>ITA: </b>Anestesia Intra-traqueal <br>
 	<li><b>LA: </b>Anestesia local <br>
 	<li><b>AS: </b>Anestesia analg�sica-sedativa <br>
 	<li><b>DS: </b>Anestesia equivalente a AS <br>
 	<li><b>Plexus: </b>Anestesia local Nervus plexus <br>
	</ul>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como entrar com a informa��o do anestesista?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no link "<span style="background-color:yellow" > Anestesista </span>" .<br>
 	<b>Passo 2: </b>Uma janela para entrar com as informa��es do anestesista aparecer�. <br>
 	<b>Passo 3: </b>Siga as instru��es na janela ou clique no bot�o "Ajuda" dentro da janela para maiores instru��es de ajuda. <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como entrar com os hor�rios de entrada, incis�o, sutura, e saida diretamente nos seus campos correspondentes?</b>
</font>
<ul>       	
 	<b>Hor�rio de entrada: </b>Entre com o hor�rio no campo "<span style="background-color:yellow" > Entrada:<input type="text" name="t" size=5 maxlength=5> </span>" .<br>
 	<b>Hor�rio de incis�o: </b>Entre com o hor�rio no campo "<span style="background-color:yellow" > Incis�o: <input type="text" name="t" size=5 maxlength=5> </span>" .<br>
 	<b>Hor�rio de sutura: </b>Entre com o hor�rio no campo "<span style="background-color:yellow" > Sutura: <input type="text" name="t" size=5 maxlength=5> </span>" .<br>
 	<b>Hor�rio de sa�da: </b>Entre com o hor�rio no campo "<span style="background-color:yellow" > Sa�da: <input type="text" name="t" size=5 maxlength=5> </span>" .<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como entrar com v�rias informa��es de hor�rio, todas de uma vez s�?</b>
</font>
<ul> <b>Passo 1: </b><p>    	
 	<b>Hor�rio de Entrada/Sa�da: </b>
 	Clique no link "<span style="background-color:yellow" > Entrada/Sa�dat <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>"  situado no canto inferior esquerdo.<p>
 	<b>Hor�rio de Incis�o/Sutura:</b>
 	Clique no link "<span style="background-color:yellow" > Incis�o/Sutura <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>"  situado no canto inferior esquerdo.<p>
 	<b>Tempo de espera: </b>
 	Clique no link "<span style="background-color:yellow" > Tempo de espera <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>"  situado no canto inferior esquerdo.<p>
 	<b>Hor�rios de Curativo/tip�ia:</b>
 	Clique no link "<span style="background-color:yellow" > Curativo/tip�ia <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>"  situado no canto inferior esquerdo.<p>
 	<b>Hor�rio de reposi��o: </b>
 	Clique no link "<span style="background-color:yellow" > Reposi��o <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>"  situado no canto inferior esquerdo.<p>
 	<b>Passo 2: </b>Aparecer� uma janela para entrar com as informa��es de hor�rio. <br>
 	<b>Passo 3: </b>Siga as instru��es na janela ou clique no bot�o "Ajuda" dentro da janela para maiores instru��es de ajuda. <br>
	</ul>

	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como entrar com a informa��o de hor�rios para os gr�ficos de tempo?</b>
</font>
<ul> <b>Passo 1: </b>Mova o cursor para o hor�rio escolhido na escala de tempo correspondente � informa��o (por exemplo Curativa/tip�ia).<br>
 	<b>Passo 2: </b>Clique na escala de tempo correspondente ao hor�rio escolhido.<p>
<b>Nota:</b> A primeira entrada ser� o hor�rio de in�cio, a segunda ser� o hor�rio de fim, a terceira entrada ser� o segundo hor�rio de in�cio, etc.
	</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como entrar com a informa��o de terapia ou opera��o?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Digite a terapia/opera��o  no campo "<span style="background-color:yellow" > Terapia/Opera��o: </span>" .<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como entrar com resultados, observa��es, notas extra?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Digite no campo "<span style="background-color:yellow" > Resultados: </span>" .<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como salvar o documento de registro?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no bot�o <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>><br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como iniciar um documento novo de registro?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no bot�o <img <?php echo createLDImgSrc('../','newpat2.gif','0') ?>><br>
 	<b>Passo 2: </b>Clique novamente no bot�o <img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>> para maiores instru��es de ajuda.<br>
	</ul>
	
<b>Nota</b>
<ul> Se voc� decidir fechar clique no bot�o <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.
</ul>
	<?php endif;?>

<?php endif;?>



<?php if($src=="search") : ?>
<?php if(($x2!="")&&($x2!="0")) : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como selecionar um paciente em particular cujo relat�rio do laborat�rio quero <?php if($x1=="edit") print "editar"; else print "veja"; ?>?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no bot�o&nbsp;<button><img <?php echo createComIcon('../','update2.gif','0') ?>> <font size=1>Lab report</font></button> correspondente a um paciente em particular cujo relat�rio do laborat�rio quero  <?php if($x1=="edit") print "editar"; else print "ver"; ?>.<p> 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como continuar pesquisando?</b>
</font>
	<?php endif;?>
	<?php if(($x2=="")||($x2=="0")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como pesquisar por um paciente?</b>
</font>
	<?php endif;?>
	
	<ul>       	
 	<b>Passo 1: </b>Entre  ou com uma informa��o completa ou com umas poucas letras de informa��o do paciente, como por exemplo, o n�mero de encontro do paciente, ou sobrenome, ou  nome, 
	ou data de nascimento no campo "<span style="background-color:yellow" > Entre com uma palavra chave de pesquisa. <input type="text" name="m" size=20 maxlength=20> </span>" . <br>
 	<b>Passo 2: </b>Clique no bot�o <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> para iniciar a pesquisa de paciente.<p> 
<ul>       	
 	<b>Nota: </b>Se a pesquisa encontrar um resultado, uma lista ser� mostrada. <p>
	</ul>
	<?php if(($x2=="")||($x2=="0")) : ?>
 	<b>Passo 3: </b>Clique no bot�o&nbsp;<button><img <?php echo createComIcon('../','update2.gif','0') ?>> <font size=1>Lab report</font></button> correspondente a um paciente em particular cujo relat�rio do laborat�rio quero  <?php if($x1=="edit") print "editar"; else print "ver"; ?>.<p> 
	<?php endif;?>
</ul>

<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 Se voc� decidir cancelar clique no bot�o <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
</ul>
<?php endif;?>

<?php if($src=="arch") : ?>
	<?php if($x2=="1") : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota: As entradas mais recentes</b></font> 
<ul>  Cada vez que voc� retornar ao arquivo, as �ltimas opera��es registradas ser�o mostradas imediatamente.
</ul>
	<?php endif;?>
	<?php if(($x3=="")&&($x1!="0")) : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nenhuma opera��o foi realizada neste dia.</b></font> 
<ul>       	
Clique em "Op��es" para abrir a caixa de op��es.<br>
Clique em "Pesquise" para ir para o modo de pesquisa.</ul>
	
	<?php endif;?>
	



<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Eu quero ver os registros das entradas arquivadas de um outro dia.</b></font>
<ul> <b>Para mostrar um dia anterior: </b>Clique no link "<span style="background-color:yellow" > Dia anterior </span>" na coluna superior esquerda. 
				Clique neste link tantas vezes quantas necess�rias at� que o dia desejado seja mostrado.<p>
 <b>Para mostrar o pr�ximo dia: </b>Clique no link "<span style="background-color:yellow" > Pr�ximo dia </span>" na coluna superior direita. 
				Clique neste link tantas vezes quantas necess�rias at� que o dia desejado seja mostrado.<br>		
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Eu quero ver os registros das entradas arquivadas de uma outra sala de opera��o ou departamento.</b></font>
<ul> <b>Passo 1: </b>Selecione o departamento na caixa de sele��o <nobr>"<span style="background-color:yellow" > Altere o departamento ou sala de OP <select name="o">
                                                                                                                                         	<option > Departamento de exemplo 1</option>
                                                                                                                                         	<option > Departmento de exemplo 2</option>
                                                                                                                                         </select>
                                                                                                                                          </span>".</nobr> <br>A sala padr�o de opera��o se
		ajustar� automaticamente.<br>																																		  
	<b>Passo 2: </b>Ou selecione a sala de opera��o na caixa de sele��o <nobr>"<span style="background-color:yellow" > <select name="o">
                                                                                                                                         	<option > Exemplo OR 1</option>
                                                                                                                                         	<option > Exemplo OR 2</option>
                                                                                                                                         </select>
                                                                                                                                          </span>".</nobr> <br> O departamento
		correspondente se ajustar� automaticamente.<br>																																		  																																		  
		<b>Passo 3: </b>Clique no bot�o <input type="button" value="Altere">  para ir ao novo departamento ou sala de opera��o.<br>
</ul>
<?php if(($x3!="")) : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como atualizar ou editar um documento de registro que est� na tela?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no bot�o <img src="../img/update3.gif" border=0> situado abaixo da data de opera��o na coluna mais � esquerda para ir ao modo de edi��o.<br>
 	<b>Passo 2: </b>No modo de edi��o, clique no bot�o "Ajuda" se voc� necessitar de mais instru��es para editar o documento.<p> 
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como abrir o arquivo de dados do paciente?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no bot�o <img src="../img/info2.gif" border=0> � esquerda do n�mero do paciente.<br>
 	<b>Passo 2: </b>O arquivo de dados do paciente aparecer�. clique no bot�o "Ajuda" se voc� necessitar de mais instru��es.<p> 
	</ul>
	<?php endif;?>
	
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 Se voc� decidir cancelar clique no bot�o <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
</ul>


	<?php endif;?>

<?php if($src=="input") : ?>
	<?php if($x1=="main") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como entrar com valores de resultados de testes?</b>
</font>
<ul>       	
		<?php if($x2=="") 
			print '
 			<b>Passo 1: </b>Entre com o n�mero do lote no campo "<span style="background-color:yellow" > N�mero do lote: </span>" .<br>	
 			<b>Passo 2: </b>Entre com a data do exame no campo "<span style="background-color:yellow" > Data do exame </span>" se necess�rio.<br>	';
	
		?>

	
 	<b>Passo	<?php if($x2=="") 
			print "3"; else print "1";
		?>:</b> Entre com os valores nos seus correspondentes campos de par�metros.<br>	
 	<b>Passo <?php if($x2=="") 
			print "4"; else print "2";
		?>: </b> Clique no bot�o <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> para salvar os valores.<p> 
 	<b>Nota: </b>Depois que voc� salvou os valores e quiser fechar,<br> clique no bot�o <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.<br> 
</ul>
	<?php endif;?>
<?php if($x1=="few") : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Eu preciso entrar somente com uns poucos valores! Como fazer isto?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Entre com os valores dispon�veis em seus campos de par�metros correspondentes.<br> 
 	<b>Passo 2: </b>Clique no bot�o <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> para salvar os valores dos par�metros.<p> 
 	<b>Nota: </b>Se voc� terminou de entrar todos os valores dos par�metros e quiser fechar clique no bot�o <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.<br> 
</ul>
	<?php endif;?>
	<?php if($x1=="param") : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
O par�metro que eu preciso n�o foi mostrado! Como mudar para o grupo certo de par�metros?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Selecione o grupo de par�metro certo da caixa de sele��o <nobr>"<span style="background-color:yellow" > Selecione grupo de par�metros <select name="s">
     <option value="Par�metro exemplo"> Par�metro exemplo</option> </select> </span>"</nobr> caixa de sele��o.<p> 
 	<b>Passo 2: </b>Clique no bot�o <img <?php echo createLDImgSrc('../','auswahl2.gif','0') ?>> para ir para o grupo de par�metros selecionado.<p> 
</ul>
	<?php endif;?>
	<?php if($x1=="save") : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como devo salvar os valores?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no bot�o <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> salvar os valores dos par�metros.<p> 
 	<b>Nota: </b>Depois que voc� salvou os valores e quiser fechar,<br> clique no bot�o <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.<br> 
</ul>
	<?php endif;?>
	<?php if($x1=="correct") : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Eu salvei um valor errado. Como posso corrigir isto?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Entre com o valor correto no campo do par�metro correspondente.<br> 
 	<b>Passo 2: </b>Clique no bot�o <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> para salvar o valor correto.<p> 
 	<b>Nota: </b>Depois que voc� salvou os valores e quiser fechar,<br> clique no bot�o <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.<br> 
</ul>
	<?php endif;?>
	<?php if($x1=="Note") : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Eu preciso entrar com uma nota em vez de um valor. Como fazer isto?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Digite a nota no campo do par�metro correspondente.<br> 
 	<b>Passo 2: </b>Clique no bot�o <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> para salvar a nota.<p> 
 	<b>Nota: </b>Depois que voc� salvou e quiser fechar,<br> clique no bot�o <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.<br> 
</ul>
	<?php endif;?>
	<?php if($x1=="done") : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Estou pronto. E agora?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no bot�o <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> para salvar todos os valores.<p> 
 	<b>Nota: </b>Clique no bot�o <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.<br> 
</ul>
	<?php endif;?>
	

<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 Se voc� decidir cancelar clique no bot�o <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
</ul>
<?php endif;?>
</form>

