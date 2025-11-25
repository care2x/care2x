<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
OR Logbook - 
<?php
if($src=="create")
{
	switch($x1)
	{
	case "": print "Iniciar um novo documento de registro";
						break;
	case "fresh": print "Iniciar um novo documento de registro";
						break;
	case "get": print  "";
						break;
	case "logmain": print "Editar um registro documentado de uma opera��o";
						break;
	default: print "Registrar uma nova opera��o";	
	}
}
if($src=="time")
{
	print "Documentando ";
	switch($x1)
	{
	case "entry_out": print "tempos de entrada e sa�da";
						break;
	case "cut_close": print "tempos de corte e sutura";
						break;
	case "wait_time": print "tempos de espera (aguardando)";
						break;
	case "bandage_time": print "tempos de engessamento";
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
	case "assist":$person="um assistente cirurgi�o"; 
						break;
	case "scrub": $person="um enfermeiro scrub";
						break;
	case "rotating":$person="um enfermeiro rotativo"; 
						break;
	case "ana": $person="um anestesiologista";
	}
	print $person;
}
if($src=="search")
{
	switch($x1)
	{
	case "search": print "Selecionando um documento particular";
						break;
	case "": print "Pesqusiar um documento de registro de opera��o";
						break;
	case "get": print  "Documento registro de opera��o de paciente";
						break;
	case "fresh": print "Pesquisar um documento registro de opera��o";
	}
}
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
	case "search": print  "Lista de resultados da pesquisa de arquivos";
						break;
	case "select": print "Documento do paciente";
	}*/
}
 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<?php if($src=="person") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como inserir <?php echo $person ?> atrav�s da lista de sele��o r�pida?</b>
</font>
<ul>       	
 	<b>Nota: </b>Se <?php echo $person ?> foi selecionada emuma opera��o pr�via, seu nome ser� listado na lista de sele��o r�pida.<p>
 	<b>Passo 1: </b>Primeiro verifique se sua fun��o est� corretamente selecionada na caixa de sele��o " Fun��o Centro Cir�rgico ". Se n�o, selecione sua his correct Fun��o Centro Cir�rgico correta.<br>
 	<b>Passo 2: </b>Clique no nome de fam�lia, ou primeiro nome da <?php echo $person ?> ou o  
	<nobr>"<span style="background-color:yellow" > <img <?php echo createComIcon('../','uparrowgrnlrg.gif','0') ?>> Insira esta pessoa como <?php echo $person ?>... </span>"</nobr> link.
	O cirurgi�o ser� automaticamente adicionado na lista de "entradas correntes" .<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
<?php echo ucfirst($person) ?> n�o aparece na lista de sele��o r�pida. Como inserir <?php echo $person ?>?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Insira uma informa��o completa ou as primeiras letras do nome da fam�lia ou primeiro nome da <?php echo $person ?> no campo "<span style="background-color:yellow" > Pesquise uma nova <?php echo substr($person,2) ?>... </span>".<br>
 	<b>Passo 2: </b>Clique no bot�o <input type="button" value="OK"> para iniciar pesquisando por <?php echo $person ?>.<br>
 	<b>Passo 3: </b>A pesquisa ir� listar os resultados. Clique no nome da fam�lia, ou primeiro nome, ou no <nobr>"<span style="background-color:yellow" > <img <?php echo createComIcon('../','uparrowgrnlrg.gif','0') ?>> Insira esta pessoa como  <?php echo $person ?>... </span>"</nobr> link correspondente a <?php echo $person ?> que voc� quiser documentar.
</ul>


<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b> Como deletar uma <?php echo $person ?> da lista?</b></font> 
<ul>       	
 	<b>Passo 1: </b>Clique no �cone <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> � direita do nome da pessoa.<br>
 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b> Finalizei. Como voltar para o livro de registros?</b></font> 
<ul>       	
 	<b>Passo 1: </b>Clique no bot�o<img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle"> que ir� aparecer ap�s voc� ter selecionado <?php echo $person ?>.<br>
 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 Se voc� decidir cancelar clique no bot�o<img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
</ul>
<?php endif;?>

<?php if($src=="time") : ?>
	<?php if($x1=="entry_out") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como documentar os tempos de entrada e sa�da?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Insira o tempo de entrada no campo "<span style="background-color:yellow" > de: <input type="text" name="d" size=5 maxlength=5> </span>" na coluna da esquerda.<br>
 	<b>Passo 2: </b>Insira o tempo de sa�da no campo "<span style="background-color:yellow" > at�: <input type="text" name="d" size=5 maxlength=5> </span>" na coluna da direita.<p>
<ul>       	
 	<b>Dica: </b>Insira "n" ou "N" (significando "agora") no campo de entrada para automaticamente inserir o tempo corrente.
</ul><br>
 	<b>Nota: </b>Voc� pode inserir diversos tempos de entrada e sa�da todos de uma vez antes de salvar a informa��o.<p>
</ul>

	<?php endif;?>
	<?php if($x1=="cut_close") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como documentar tempos de corte e sutura?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Insira o tempo de corte no campo "<span style="background-color:yellow" > de: <input type="text" name="d" size=5 maxlength=5> </span>" na coluna da esquerda.<br>
 	<b>Passo 2: </b>Insira o tempo de sutura no campo "<span style="background-color:yellow" > at�: <input type="text" name="d" size=5 maxlength=5> </span>"  na coluna da direita.<p>
<ul>       	
 	<b>Dica: </b>Insira "n" ou "N" (significando agora) no campo de entrada para automaticamente insirir o tempo corrente.
</ul><br>
 	<b>Nota: </b>Voc� pode inserir diversos tempos de corte e sutura todos juntos antes de salvar a informa��o.<p>
</ul>

	<?php endif;?>
	<?php if($x1=="wait_time") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como documentar tempo de espera (aguardando)?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Insira o tempo de in�cio no campo "<span style="background-color:yellow" > de: <input type="text" name="d" size=5 maxlength=5> </span>" na coluna da esquerda.<br>
 	<b>Passo 2: </b>Insira o tempo de fim no campo "<span style="background-color:yellow" > at�: <input type="text" name="d" size=5 maxlength=5> </span>" na coluna da direita.<p>
<ul>       	
 	<b>Tip: </b>Insira "n" ou "N" (significando agora) no campo de entrada para automaticamente insirir o tempo corrente.
</ul><br>
 	<b>Passo 3: </b>Selecione a raz�o na caixa de sele��o na terceira coluna (Raz�o) column.<p>
 	<b>Nota: </b>Voc� pode inserir diversos tempos de in�cio e fim e raz�es todos juntos antes de salvar a informa��o.<p>
</ul>

	<?php endif;?>
	<?php if($x1=="bandage_time") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como documentar tempos de engessamento?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Insira o tempo de in�cio no campo "<span style="background-color:yellow" > de: <input type="text" name="d" size=5 maxlength=5> </span>" na coluna da esquerda.<br>
 	<b>Passo 2: </b>Insira o tempo de fim no campo "<span style="background-color:yellow" > at�: <input type="text" name="d" size=5 maxlength=5> </span>" na coluna da direita.<p>
<ul>       	
 	<b>Tip: </b>Insira "n" ou "N" (significando agora) no campo de entrada para automaticamente insirir o tempo corrente.
</ul><br>
 	<b>Note: </b>Voc� pode inserir diversos tempos de in�cio e fim e raz�es todos juntos antes de salvar a informa��o.<p>
</ul>

	<?php endif;?>
	<?php if($x1=="repos_time") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como documentar tempos de reposi��o?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Insira o tempo de in�cio no campo "<span style="background-color:yellow" > from: <input type="text" name="d" size=5 maxlength=5> </span>" na coluna da esquerda.<br>
 	<b>Passo 2: </b>Insira o tempo de fim no campo "<span style="background-color:yellow" > to: <input type="text" name="d" size=5 maxlength=5> </span>" na coluna da direita.<p>
<ul>       	
 	<b>Tip: </b>Insira "n" ou "N" (significando agora) no campo de entrada para automaticamente insirir o tempo corrente.
</ul><br>
 	<b>Note: </b>Voc� pode inserir diversos tempos de in�cio e fim e raz�es todos juntos antes de salvar a informa��o.<p>
</ul>

	<?php endif;?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como salvar a informa��o?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no bot�o<img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> para salvar a informa��o<br>
 	<b>Passo 2: </b>Se voc� terminou, clique no bot�o <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> para fechar a janela e voltar ao livro de registros.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b> Desejo deletar as entradas, mas clicando no bot�o "Reseta dados" nada parece acontecer. O que devo fazer?</b></font> 
<ul>       	
 	<b>Nota: </b>Clicando no bot�o  "Reseta dados" ir� apenas apagar as entradas que ainda n�o foram salvas. Se voc� desejar deletar entradas
	que foram salvas previamente, siga estas instru��es:<p>
 	<b>Passo 1: </b>Clique no campo de entrada do tempo que voc� quer deletar.<br>
 	<b>Passo 2: </b>Delete o tempo manualmente usando as teclas "Del" ou "Backspace" do teclado.<br>
 	<b>Passo 3: </b>Clique no bot�o<img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> para salvar as mudan�as.<br>
 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Note:</b></font> 
<ul>       	
 Se voc� decidir cancelar clique no bot�o<img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
</ul>
<?php endif;?>


<?php if($src=="create") : ?>
	<?php if($x1=="logmain") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como editar uma entrada de registro de opera��o?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no bot�o<img <?php echo createComIcon('../','dwnarrowgrnlrg.gif','0') ?>> correspondente ao registro de entrada do paciente.<br>
 	<b>Passo 2: </b>A entrada de registro do paciente ser� copiada para o quadro editor. Agora voc� pode editar a entrada seguindo as instru��es para documentar um opera��o.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como abrir a pasta de dados do paciente?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no bot�o<img <?php echo createComIcon('../','info3.gif','0') ?>> � esquerda do n�menro do paciente.<br>
 	<b>Passo 2: </b>A pasta de dados do paciente ir� aparecer.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como mudar para outro departamento e/ou Centro Cir�rgico?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Selecione o departmento da caixa de sele��o 
				<select name="dept" size=1>
				<?php
$Or2Dept=get_meta_tags("../global_conf/resolve_or2ordept.pid");
					$opabt=get_meta_tags("../global_conf/$lang/op_tag_dept.pid");

					foreach($opabt as $x=>$v)
					{
						if($x=="anaesth") continue;
						print'
					<option value="'.$x.'"';
						if ($dept==$x) print " selected";
						print '> '.$v.'</option>';
					}
				?>
					
				</select>.
<br>
 	<b>Passo 2: </b>Selecione o Centro Cir�rgico da caixa de sele��o <select name="saal" size=1 >
				<?php
foreach($Or2Dept as $x=>$v)
					{
						print'
					<option value="'.$x.'"';
						if ($saal==$x) print " selected";
						print '> '.$x.'</option>';
					}
				?>
				</select>.
<br>
 	<b>Passo 3: </b>Clique no bot�o<input type="button" value="Change"> para mudar para outro departamento e/ou centro cir�rgico.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como exibir os registros de entrada de um  dia que n�o est� sendo exibido?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Para exibir os registros de entrada de dia(s) anterior(es), clique no link "<span style="background-color:yellow" > Dia anterior </span>" no canto esquerdo superior da tabela.<br>
	Clique as many times as needed until the log entries of the desired day is displayed.<br>
 	<b>Passo 2: </b>Para exibir os registros de entrada do(s) dia(s) seguinte(s) , clique no link "<span style="background-color:yellow" > Next day </span>" no canto direito superior da tabela.<br>
	Clique tantas vezes quantas forem necess�rias at� que os registros de entrada dos dias desejados sejam exibidos.<br>
</ul>

<hr>

	<?php endif;?>
	
	<?php if($x2=="material") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como documentar um material usado para a opera��o?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Digite o n�menro do artifo do material no campo "<span style="background-color:yellow" > Num. Artigo: </span>" .<p>
	<b>Formas alternativas: </b>
	<ul type=disc>  	
	<li>Insira uma informa��o completa ou as primeiras letras no nome do material, descru��o do produto, gen�rico, n�menro de licen�a, ou n�menro do pedido no campo "<span style="background-color:yellow" > Num. artigo: </span>" .
	<li>Scaneie o c�digo de barras do artigo com o scaner.
	</ul><br> 
 	<b>Passo 2: </b>Clique no bot�o <input type="button" value="OK"> ou pressione o bot�o "Inserir" no teclado para pesquisar o produto.<p> 
<ul>       	
 	<b>Nota: </b>Se a pesquisa encontrar um resultado, a informa��o do material ser� imediatamente exibida no documento.<p> 
 	<b>Nota: </b>Se a pesquisa encontrar diversos resultados, uma lista ser� exibida. Clique no bot�o <img <?php echo createComIcon('../','bul_arrowgrnlrg.gif','0') ?>> ou no n�menro do artigo, ou no nome do artigo para adicionar ao documento.<p> 
	</ul>
 	<b>Passo 3: </b>Se o artigo est� adicionado ao documento, voc� pode mudar a entrada no campo "<span style="background-color:yellow" > Num.Pe�as.</span>" caso necess�rio.<p> 
<ul>       	
 	<b>Nota: </b>Uma vez que voc� mudar a entrada no campo "Num.Pe�as", os bot�es "Salvar" e "Reseta dado" ir�o aparecer.<p> 
	</ul>
 	<b>Passo 4: </b>Se voc� mudou a entrada no campo "Num.Pe�as", clique no bot�o <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> para salvar as mudan�as.<p> 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como remover um artigo da lista?</b>
</font>
<ul> 
 	<b>Passo 1: </b>Clique no �cone <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> correspondente ao artigo.<br> 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
O artigo n�o foi encotrado. Como inserir manualmente (for�ando)uma informa��o de um artigo?</b>
</font>
<ul> 
 	<b>Passo 1: </b>Clique no link "<span style="background-color:yellow" > <img <?php echo createComIcon('../','accessrights.gif','0') ?>> Para inserir o artigo manualmente, clique aqui. </span>" .<br> 
 	<b>Passo 2: </b>Manualmente insira a informa��o do artigo nos campos correspondentes.<p> 
 	<b>Passo 3: </b>Clique no bot�o<img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> para adicionar a informa��o do artigo no documento<p> 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Note:</b></font> 
<ul>       	
 Se voc� decidir cancelar, clique no bot�o <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como exibir o livro de registros principal novamente?</b>
</font>
<ul> 
 	<b>Passo 1: </b>Clique no link "<span style="background-color:yellow" > <img <?php echo createComIcon('../','manfldr.gif','0') ?>> Mostrar Livro de Registros. </span>" .<br> 
</ul>
<hr>
	<?php endif;?>

	<?php if(($x1=="")||($x1=="fresh")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como iniciar um registro de documento para uma opera��o?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Primeiro encontre o paciente. Digite o n�menro do paciente no campo "<span style="background-color:yellow" > Num. do Paciente: </span>" .<p>
	<b>Modos alternativos: </b>
	<ul type=disc>  	
	<li>Insira uma informa��o completa ou as primeiras letras do nome de fam�lia, ou primeiro nome do paciente no campo "<span style="background-color:yellow" > Nome de Fam�lia, Primeiro nome </span>" .
	<li>Insira uma data completa ou os primeiros d�gitos da data de nascimento do paciente no campo "<span style="background-color:yellow" > Data de nascimento </span>" .
	</ul>
 	<b>Passo 2: </b>Clique no bot�o <input type="button" value="Search patient"> para iniciar a pesquisa pelo paciente.<p> 
<ul>       	
 	<b>Nota: </b>Se a pesquisa encontrar um resultado, os dados b�sicos do paciente ser�o inseridos imediatamente nos seus campos correspondentes.<p> 
 	<b>Nota: </b>Se a pesquisa encontrar diversos resultados, uma lista ser� exibida. Clique no nome de fam�lia do paciente, ou primeiro nome para seleciona-lo para documenta��o.<p> 
	</ul>
 	<b>Passo 3: </b>Clique no bot�o <img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>> novamente para maiores instru��es.<p> 

</ul>

	<?php else : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como inserir o diagnosticos para a opera��o?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Digite o diagn�stico no campo "<span style="background-color:yellow" > Diagn�stico: </span>" .<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como inserir a informa��o do cirurgi�o?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no link "<span style="background-color:yellow" > Cirurgi�o </span>" .<br>
 	<b>Passo 2: </b>Uma janela pop-up para inser��o de informa��es de cirurgi�es ir� aparecer. <br>
 	<b>Passo 3: </b>Siga as instru��es na janela ou clique no bot�o "Ajuda" dentro da janela para maiores informa��es de ajuda. <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como inserir as informa��es do assistente do cirurgi�o?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no link "<span style="background-color:yellow" > Assistente </span>" .<br>
 	<b>Passo 2: </b>Uma janela pop-up para inser��o de informa��es de assistentes de cirurgi�es ir� aparecer. <br>
 	<b>Passo 3: </b>Siga as instru��es na janela ou clique no bot�o "Ajuda" dentro da janela para maiores informa��es de ajuda. <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como insirir informa��es de enfermeiros instrumentistas?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no link "<span style="background-color:yellow" > Enfermeiro instrumentista </span>" .<br>
 	<b>Passo 2: </b>Uma janela pop-up para inser��o de informa��es de enfermeiro instrumentista ir� aparecer. <br>
 	<b>Passo 3: </b>Siga as instru��es na janela ou clique no bot�o "Ajuda" dentro da janela para maiores informa��es de ajuda. <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como inserir informa��es de enfermeiros rotativos?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no link "<span style="background-color:yellow" > Enfermeiros rotativos</span>" .<br>
 	<b>Passo 2: </b>Uma janela pop-up para inser��o de informa��es de enfermeiros rotativos ir� aparecer. <br>
 	<b>Passo 3: </b>Siga as instru��es na janela ou clique no bot�o "Ajuda" dentro da janela para maiores informa��es de ajuda. <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como inserir o tipo de anestesia usado para a opera��o?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Selecione o tipo de anestesia no campo "<span style="background-color:yellow" > Anestesia <select name="a">
                                                                     	<option > ITA</option>
                                                                     	<option > Plexus</option>
                                                                     	<option > ITA-Jet</option>
                                                                     	<option > ITA-Mask</option>
                                                                     	<option > LA</option>
                                                                     	<option > DS</option>
                                                                     	<option > AS</option>
                                                                     </select> </span>" field.<p>
	<ul type=disc>       	
 	<li><b>ITA: </b>Anestesia Intra-traqueal<br>
 	<li><b>LA: </b>Anestesia local<br>
 	<li><b>AS: </b>Seda��o analg�sica<br>
 	<li><b>DS: </b>Equivalente � AS<br>
 	<li><b>Plexus: </b>Anestesia Local Nervus plexus<br>
	</ul>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como inserir a informa��o do Anestesiologista ?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no link "<span style="background-color:yellow" > Anestesiologista </span>" .<br>
 	<b>Passo 2: </b>Uma janela pop-up para inser��o de informa��es de Anestesiologistas ir� aparecer. <br>
 	<b>Passo 3: </b>Siga as instru��es na janela ou clique no bot�o "Ajuda" dentro da janela para maiores informa��es de ajuda. <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como inserir tempos de entrada, corte, sutura e sa�da diretamente dos seus campos correspondentes?</b>
</font>
<ul>       	
 	<b>Tempo de entrada: </b>Insira o tempo no campo  "<span style="background-color:yellow" > Entrada:<input type="text" name="t" size=5 maxlength=5> </span>" .<br>
 	<b>Tempo de corte: </b>Insira o tempo no campo"<span style="background-color:yellow" > Corte: <input type="text" name="t" size=5 maxlength=5> </span>" .<br>
 	<b>Tempo de sutura: </b>Insira o tempo no campo"<span style="background-color:yellow" > Sutura: <input type="text" name="t" size=5 maxlength=5> </span>" .<br>
 	<b>Tempo de sa�da: </b>Insira o tempo no campo"<span style="background-color:yellow" > Sa�da: <input type="text" name="t" size=5 maxlength=5> </span>" .<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como insirir diversas informa��es de tempo todas de uma vez?</b>
</font>
<ul> <b>Passo 1: </b><p>    	
 	<b>Tempo de Entrada/Sa�da: </b>
 	Clique no link "<span style="background-color:yellow" > Entrada/Sa�da <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>" situado no canto inferior esquerdo.<p>
 	<b>Cut/Suture time:</b>
 	Clique no link"<span style="background-color:yellow" > Corte/Sutura <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>" situado no canto inferior esquerdo.<p>
 	<b>Idle time: </b>
 	Clique no link"<span style="background-color:yellow" > Tempo de espera <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>" situado no canto inferior esquerdo.<p>
 	<b>Plaster/Cast time:</b>
 	Clique no link"<span style="background-color:yellow" > Engessamento <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>" situado no canto inferior esquerdo.<p>
 	<b>Reposition time: </b>
 	Clique no link"<span style="background-color:yellow" > Reposi��o <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>" situado no canto inferior esquerdo.<p>
 	<b>Passo 2: </b>Uma janela pop-up para inserir informa��es de tempo ir� aparecer. <br>
 	<b>Passo 3: </b>Siga as instru��es da janela ou clique no bot�o "Ajuda" para maiores instru��es. <br>
	</ul>

	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como Iiserir informa��es de tempo na carta de tempo gr�fica?</b>
</font>
<ul> <b>Passo 1: </b>Mova o ponteiro do mouse para o tempo escolhido na escala de tempo correspondente � informa��o de tempo (eg. Engessamento).<br>
 	<b>Passo 2: </b>Clique na escala de tempo correspondente ao tempo escolhido.<p>
<b>Nota:</b> As primeiras entradas ser�o as de tempo de in�cio, as segundas ser�o de tempo de fim, as terceiras entradas ser�o do segundo tempo de in�cio, etc.
	</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como inserir a informa��o de terapia ou opera��o?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Digite a terapia ou opera��o no campo "<span style="background-color:yellow" > Terapia/Opera��o: </span>" .<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como inserir resultados, observa��es, noticias extras?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Digite no campo "<span style="background-color:yellow" > Resultados: </span>" .<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como salvar o documento de registro?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no bot�o<img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>><br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como iniciar um novo registro de documento?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no bot�o<img <?php echo createLDImgSrc('../','newpat2.gif','0') ?>><br>
 	<b>Passo 2: </b>Clique no bot�o<img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>> novamente para mais instru��es de ajuda.<br>
	</ul>
	
<b>Nota</b>
<ul> Se voc� decidir fechar, clique no bot�o<img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.
</ul>
	<?php endif;?>

<?php endif;?>



<?php if($src=="search") : ?>
	<?php if(($x1=="fresh")||($x1=="")) : ?>


<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como pesquisar por um documento de um paciente em particular?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Insira uma informa��o completa ou as primeiras letras do nome de fam�lia do paciente, 
	ou o primeiro nome, ou data de nascimento no campo "<span style="background-color:yellow" > Palavra-chave: <input type="text" name="m" size=20 maxlength=20> </span>" . <br>
 	<b>Passo 2: </b>Clique no bot�o<input type="button" value="Pesquisa"> para iniciar a pesquisa pelo documento do paciente.<p> 
<ul>       	
 	<b>Nota: </b>Se a pesquisa encontrar um resultado que coincide com a palavra-chave, o(s) documento(s) do paciente ser�o exibidos imediatamente.<p> 
 	<b>Nota: </b>Se a pesquisa encontrar apenas uma aproxima��o, uma lista ser� exibida. 
	Clique no nome de fam�lia do paciente para exibir seus documentos.<p> 
	</ul>
</ul>
	<?php endif;?>
<?php if(($x1=="search")&&($x3!="1")) : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como selecionar um documento particular para exibir?</b>
</font>
<ul>       	
 	<b>Nota: </b> Clique no nome de fam�lia do paciente para exibir seus documentos.<p> 
</ul>

	<?php endif;?>
<?php if(($x1=="get")||($x3=="1")) : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como atualziar ou editar um registro de documento exibido?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no bot�o <img src="../img/update3.gif" border=0> situado abaixo da data de opera��o na coluna da esquerda para trocar para o modo de edi��o.<br>
 	<b>Passo 2: </b>No modo de edi��o, clique no bot�o "Ajuda" se voc� necessita mais instru��es na edi��o do documento.<p> 
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como abrir a pasta de dados do paciente?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no bot�o <img src="../img/info2.gif" border=0> na esquerda do n�mero do paciente.<br>
 	<b>Passo 2: </b>A pasta de dados do paciente ir� aparecer. Clique no bot�o "Ajuda" na janela se voc� necessita mais instru��es.<p> 
	</ul>

<?php endif;?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como continuar pesquisando?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Insira uma informa��o completa ou as primeiras letras do nome de fam�lia do paciente, 
	ou o primeiro nome, ou data de nascimento no campo "<span style="background-color:yellow" > Keyword: <input type="text" name="m" size=20 maxlength=20> </span>" . <br>
 	<b>Passo 2: </b>Clique no bot�o<input type="button" value="Search"> para iniciar a pesquisa pelos documentos do paciente.<p> 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Note:</b></font> 
<ul>       	
 Se voc� decidir fechar clique no bot�o<img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.
</ul>
<?php endif;?>

<?php if($src=="arch") : ?>
	<?php if($x2=="1") : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota: �ltimas entradas de registro</b></font> 
<ul>  Cada vez que voc� trocar de arquivo, as �ltimas opera��es registradas ser�o exibidas imediatamente.
</ul>
	<?php endif;?>
	<?php if(($x3=="")&&($x1!="0")) : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nenhuma opera��o feita neste dia.</b></font> 
<ul>       	
Clique em "Op��es" para abrir a caixa de op��es.<br>
Clique em "Pesquisa" para trocar para o modo de pesquisa.</ul>
	
	<?php endif;?>
	



<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Desejo ver os registros de entradas arquivados de outro dia.</b></font>
<ul> <b>Para exibir o dia anterior: </b>Clique no link "<span style="background-color:yellow" > Dia anterior </span>" na coluna esquerda superior. 
				Clique neste link tantas vezes forem necess�rias at� o dia desejado ser exibido.<p>
 <b>Para exibir o dia seguinte: </b>Clique no link "<span style="background-color:yellow" > Dia seguinte </span>" na coluna direita superior. 
				Clique neste link tantas vezes forem necess�rias at� o dia desejado ser exibido.<br>		
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Desejo ver os registros de entrada arquivados de outros departamentos ou centros cir�rgicos.</b></font>
<ul> <b>Passo 1: </b>Selecione o departmento na caixa de sele��o <nobr>"<span style="background-color:yellow" > Mude o departamento ou centro cir�rgico <select name="o">
                                                                                                                                         	<option > Departmento exemplo 1</option>
                                                                                                                                         	<option > Departmento exemplo 2</option>
                                                                                                                                         </select>
                                                                                                                                          </span>".</nobr> <br>																  
	<b>Passo 2: </b>Ou selecione o centro cir�rgico na caixa de sele��o <nobr>"<span style="background-color:yellow" > <select name="o">
                                                                                                                                         	<option > Centro cir�rgico exemplo 1</option>
                                                                                                                                         	<option > Centro cir�rgico exemplo 2</option>
                                                                                                                                         </select>
                                                                                                                                          </span>".</nobr> <br> 						  																																		  
		<b>Passo 3: </b>Clique no bot�o<input type="button" value="Change">  para mudar para o novo departmento ou centro cir�rgico.<br>
</ul>
<?php if(($x3!="")) : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como atualizar ou editar um registro de documento exibido?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no bot�o <img src="../img/update3.gif" border=0> situado abaixo da data da opera��o na coluna da esquerda para trocar para o modo de edi��o.<br>
 	<b>Passo 2: </b>No modo de edi��o, clique no bot�o "Ajuda" se voc� necessita mais instru��es na edi��o do documento.<p> 
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como abrir a pasta de dados do paciente?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no bot�o <img src="../img/info2.gif" border=0> na esquerda do n�menro do paciente.<br>
 	<b>Passo 2: </b>A pasta de dados do paciente ir� abrir. Clique no bot�o "Ajuda" na janela se voc� necessita mais instru��es.<p> 
	</ul>
	<?php endif;?>
	
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Note:</b></font> 
<ul>       	
 Se voc� decidir cancelar clique no bot�o <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
</ul>


	<?php endif;?>


</form>

