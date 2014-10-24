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
	case "logmain": print "Editar um registro documentado de uma operação";
						break;
	default: print "Registrar uma nova operação";	
	}
}
if($src=="time")
{
	print "Documentando ";
	switch($x1)
	{
	case "entry_out": print "tempos de entrada e saída";
						break;
	case "cut_close": print "tempos de corte e sutura";
						break;
	case "wait_time": print "tempos de espera (aguardando)";
						break;
	case "bandage_time": print "tempos de engessamento";
						break;
	case "repos_time": print "tempos de reposição";
	}
}
if($src=="person")
{
	print "Documentando ";
	switch($x1)
	{
	case "operator":$person="um cirurgião"; 
						break;
	case "assist":$person="um assistente cirurgião"; 
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
	case "": print "Pesqusiar um documento de registro de operação";
						break;
	case "get": print  "Documento registro de operação de paciente";
						break;
	case "fresh": print "Pesquisar um documento registro de operação";
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
Como inserir <?php echo $person ?> através da lista de seleção rápida?</b>
</font>
<ul>       	
 	<b>Nota: </b>Se <?php echo $person ?> foi selecionada emuma operação prévia, seu nome será listado na lista de seleção rápida.<p>
 	<b>Passo 1: </b>Primeiro verifique se sua função está corretamente selecionada na caixa de seleção " Função Centro Cirúrgico ". Se não, selecione sua his correct Função Centro Cirúrgico correta.<br>
 	<b>Passo 2: </b>Clique no nome de família, ou primeiro nome da <?php echo $person ?> ou o  
	<nobr>"<span style="background-color:yellow" > <img <?php echo createComIcon('../','uparrowgrnlrg.gif','0') ?>> Insira esta pessoa como <?php echo $person ?>... </span>"</nobr> link.
	O cirurgião será automaticamente adicionado na lista de "entradas correntes" .<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
<?php echo ucfirst($person) ?> não aparece na lista de seleção rápida. Como inserir <?php echo $person ?>?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Insira uma informação completa ou as primeiras letras do nome da família ou primeiro nome da <?php echo $person ?> no campo "<span style="background-color:yellow" > Pesquise uma nova <?php echo substr($person,2) ?>... </span>".<br>
 	<b>Passo 2: </b>Clique no botão <input type="button" value="OK"> para iniciar pesquisando por <?php echo $person ?>.<br>
 	<b>Passo 3: </b>A pesquisa irá listar os resultados. Clique no nome da família, ou primeiro nome, ou no <nobr>"<span style="background-color:yellow" > <img <?php echo createComIcon('../','uparrowgrnlrg.gif','0') ?>> Insira esta pessoa como  <?php echo $person ?>... </span>"</nobr> link correspondente a <?php echo $person ?> que você quiser documentar.
</ul>


<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b> Como deletar uma <?php echo $person ?> da lista?</b></font> 
<ul>       	
 	<b>Passo 1: </b>Clique no ícone <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> à direita do nome da pessoa.<br>
 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b> Finalizei. Como voltar para o livro de registros?</b></font> 
<ul>       	
 	<b>Passo 1: </b>Clique no botão<img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle"> que irá aparecer após você ter selecionado <?php echo $person ?>.<br>
 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 Se você decidir cancelar clique no botão<img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
</ul>
<?php endif;?>

<?php if($src=="time") : ?>
	<?php if($x1=="entry_out") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como documentar os tempos de entrada e saída?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Insira o tempo de entrada no campo "<span style="background-color:yellow" > de: <input type="text" name="d" size=5 maxlength=5> </span>" na coluna da esquerda.<br>
 	<b>Passo 2: </b>Insira o tempo de saída no campo "<span style="background-color:yellow" > até: <input type="text" name="d" size=5 maxlength=5> </span>" na coluna da direita.<p>
<ul>       	
 	<b>Dica: </b>Insira "n" ou "N" (significando "agora") no campo de entrada para automaticamente inserir o tempo corrente.
</ul><br>
 	<b>Nota: </b>Você pode inserir diversos tempos de entrada e saída todos de uma vez antes de salvar a informação.<p>
</ul>

	<?php endif;?>
	<?php if($x1=="cut_close") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como documentar tempos de corte e sutura?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Insira o tempo de corte no campo "<span style="background-color:yellow" > de: <input type="text" name="d" size=5 maxlength=5> </span>" na coluna da esquerda.<br>
 	<b>Passo 2: </b>Insira o tempo de sutura no campo "<span style="background-color:yellow" > até: <input type="text" name="d" size=5 maxlength=5> </span>"  na coluna da direita.<p>
<ul>       	
 	<b>Dica: </b>Insira "n" ou "N" (significando agora) no campo de entrada para automaticamente insirir o tempo corrente.
</ul><br>
 	<b>Nota: </b>Você pode inserir diversos tempos de corte e sutura todos juntos antes de salvar a informação.<p>
</ul>

	<?php endif;?>
	<?php if($x1=="wait_time") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como documentar tempo de espera (aguardando)?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Insira o tempo de início no campo "<span style="background-color:yellow" > de: <input type="text" name="d" size=5 maxlength=5> </span>" na coluna da esquerda.<br>
 	<b>Passo 2: </b>Insira o tempo de fim no campo "<span style="background-color:yellow" > até: <input type="text" name="d" size=5 maxlength=5> </span>" na coluna da direita.<p>
<ul>       	
 	<b>Tip: </b>Insira "n" ou "N" (significando agora) no campo de entrada para automaticamente insirir o tempo corrente.
</ul><br>
 	<b>Passo 3: </b>Selecione a razão na caixa de seleção na terceira coluna (Razão) column.<p>
 	<b>Nota: </b>Você pode inserir diversos tempos de início e fim e razões todos juntos antes de salvar a informação.<p>
</ul>

	<?php endif;?>
	<?php if($x1=="bandage_time") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como documentar tempos de engessamento?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Insira o tempo de início no campo "<span style="background-color:yellow" > de: <input type="text" name="d" size=5 maxlength=5> </span>" na coluna da esquerda.<br>
 	<b>Passo 2: </b>Insira o tempo de fim no campo "<span style="background-color:yellow" > até: <input type="text" name="d" size=5 maxlength=5> </span>" na coluna da direita.<p>
<ul>       	
 	<b>Tip: </b>Insira "n" ou "N" (significando agora) no campo de entrada para automaticamente insirir o tempo corrente.
</ul><br>
 	<b>Note: </b>Você pode inserir diversos tempos de início e fim e razões todos juntos antes de salvar a informação.<p>
</ul>

	<?php endif;?>
	<?php if($x1=="repos_time") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como documentar tempos de reposição?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Insira o tempo de início no campo "<span style="background-color:yellow" > from: <input type="text" name="d" size=5 maxlength=5> </span>" na coluna da esquerda.<br>
 	<b>Passo 2: </b>Insira o tempo de fim no campo "<span style="background-color:yellow" > to: <input type="text" name="d" size=5 maxlength=5> </span>" na coluna da direita.<p>
<ul>       	
 	<b>Tip: </b>Insira "n" ou "N" (significando agora) no campo de entrada para automaticamente insirir o tempo corrente.
</ul><br>
 	<b>Note: </b>Você pode inserir diversos tempos de início e fim e razões todos juntos antes de salvar a informação.<p>
</ul>

	<?php endif;?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como salvar a informação?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no botão<img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> para salvar a informação<br>
 	<b>Passo 2: </b>Se você terminou, clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> para fechar a janela e voltar ao livro de registros.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b> Desejo deletar as entradas, mas clicando no botão "Reseta dados" nada parece acontecer. O que devo fazer?</b></font> 
<ul>       	
 	<b>Nota: </b>Clicando no botão  "Reseta dados" irá apenas apagar as entradas que ainda não foram salvas. Se você desejar deletar entradas
	que foram salvas previamente, siga estas instruções:<p>
 	<b>Passo 1: </b>Clique no campo de entrada do tempo que você quer deletar.<br>
 	<b>Passo 2: </b>Delete o tempo manualmente usando as teclas "Del" ou "Backspace" do teclado.<br>
 	<b>Passo 3: </b>Clique no botão<img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> para salvar as mudanças.<br>
 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Note:</b></font> 
<ul>       	
 Se você decidir cancelar clique no botão<img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
</ul>
<?php endif;?>


<?php if($src=="create") : ?>
	<?php if($x1=="logmain") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como editar uma entrada de registro de operação?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no botão<img <?php echo createComIcon('../','dwnarrowgrnlrg.gif','0') ?>> correspondente ao registro de entrada do paciente.<br>
 	<b>Passo 2: </b>A entrada de registro do paciente será copiada para o quadro editor. Agora você pode editar a entrada seguindo as instruções para documentar um operação.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como abrir a pasta de dados do paciente?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no botão<img <?php echo createComIcon('../','info3.gif','0') ?>> à esquerda do númenro do paciente.<br>
 	<b>Passo 2: </b>A pasta de dados do paciente irá aparecer.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como mudar para outro departamento e/ou Centro Cirúrgico?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Selecione o departmento da caixa de seleção 
				<select name="dept" size=1>
				<?php
$Or2Dept=get_meta_tags("../global_conf/resolve_or2ordept.pid");
					$opabt=get_meta_tags("../global_conf/$lang/op_tag_dept.pid");

					while(list($x,$v)=each($opabt))
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
 	<b>Passo 2: </b>Selecione o Centro Cirúrgico da caixa de seleção <select name="saal" size=1 >
				<?php
while(list($x,$v)=each($Or2Dept))
					{
						print'
					<option value="'.$x.'"';
						if ($saal==$x) print " selected";
						print '> '.$x.'</option>';
					}
				?>
				</select>.
<br>
 	<b>Passo 3: </b>Clique no botão<input type="button" value="Change"> para mudar para outro departamento e/ou centro cirúrgico.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como exibir os registros de entrada de um  dia que não está sendo exibido?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Para exibir os registros de entrada de dia(s) anterior(es), clique no link "<span style="background-color:yellow" > Dia anterior </span>" no canto esquerdo superior da tabela.<br>
	Clique as many times as needed until the log entries of the desired day is displayed.<br>
 	<b>Passo 2: </b>Para exibir os registros de entrada do(s) dia(s) seguinte(s) , clique no link "<span style="background-color:yellow" > Next day </span>" no canto direito superior da tabela.<br>
	Clique tantas vezes quantas forem necessárias até que os registros de entrada dos dias desejados sejam exibidos.<br>
</ul>

<hr>

	<?php endif;?>
	
	<?php if($x2=="material") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como documentar um material usado para a operação?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Digite o númenro do artifo do material no campo "<span style="background-color:yellow" > Num. Artigo: </span>" .<p>
	<b>Formas alternativas: </b>
	<ul type=disc>  	
	<li>Insira uma informação completa ou as primeiras letras no nome do material, descrução do produto, genérico, númenro de licença, ou númenro do pedido no campo "<span style="background-color:yellow" > Num. artigo: </span>" .
	<li>Scaneie o código de barras do artigo com o scaner.
	</ul><br> 
 	<b>Passo 2: </b>Clique no botão <input type="button" value="OK"> ou pressione o botão "Inserir" no teclado para pesquisar o produto.<p> 
<ul>       	
 	<b>Nota: </b>Se a pesquisa encontrar um resultado, a informação do material será imediatamente exibida no documento.<p> 
 	<b>Nota: </b>Se a pesquisa encontrar diversos resultados, uma lista será exibida. Clique no botão <img <?php echo createComIcon('../','bul_arrowgrnlrg.gif','0') ?>> ou no númenro do artigo, ou no nome do artigo para adicionar ao documento.<p> 
	</ul>
 	<b>Passo 3: </b>Se o artigo está adicionado ao documento, você pode mudar a entrada no campo "<span style="background-color:yellow" > Num.Peças.</span>" caso necessário.<p> 
<ul>       	
 	<b>Nota: </b>Uma vez que você mudar a entrada no campo "Num.Peças", os botões "Salvar" e "Reseta dado" irão aparecer.<p> 
	</ul>
 	<b>Passo 4: </b>Se você mudou a entrada no campo "Num.Peças", clique no botão <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> para salvar as mudanças.<p> 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como remover um artigo da lista?</b>
</font>
<ul> 
 	<b>Passo 1: </b>Clique no ícone <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> correspondente ao artigo.<br> 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
O artigo não foi encotrado. Como inserir manualmente (forçando)uma informação de um artigo?</b>
</font>
<ul> 
 	<b>Passo 1: </b>Clique no link "<span style="background-color:yellow" > <img <?php echo createComIcon('../','accessrights.gif','0') ?>> Para inserir o artigo manualmente, clique aqui. </span>" .<br> 
 	<b>Passo 2: </b>Manualmente insira a informação do artigo nos campos correspondentes.<p> 
 	<b>Passo 3: </b>Clique no botão<img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> para adicionar a informação do artigo no documento<p> 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Note:</b></font> 
<ul>       	
 Se você decidir cancelar, clique no botão <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
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
Como iniciar um registro de documento para uma operação?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Primeiro encontre o paciente. Digite o númenro do paciente no campo "<span style="background-color:yellow" > Num. do Paciente: </span>" .<p>
	<b>Modos alternativos: </b>
	<ul type=disc>  	
	<li>Insira uma informação completa ou as primeiras letras do nome de família, ou primeiro nome do paciente no campo "<span style="background-color:yellow" > Nome de Família, Primeiro nome </span>" .
	<li>Insira uma data completa ou os primeiros dígitos da data de nascimento do paciente no campo "<span style="background-color:yellow" > Data de nascimento </span>" .
	</ul>
 	<b>Passo 2: </b>Clique no botão <input type="button" value="Search patient"> para iniciar a pesquisa pelo paciente.<p> 
<ul>       	
 	<b>Nota: </b>Se a pesquisa encontrar um resultado, os dados básicos do paciente serão inseridos imediatamente nos seus campos correspondentes.<p> 
 	<b>Nota: </b>Se a pesquisa encontrar diversos resultados, uma lista será exibida. Clique no nome de família do paciente, ou primeiro nome para seleciona-lo para documentação.<p> 
	</ul>
 	<b>Passo 3: </b>Clique no botão <img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>> novamente para maiores instruções.<p> 

</ul>

	<?php else : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como inserir o diagnosticos para a operação?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Digite o diagnóstico no campo "<span style="background-color:yellow" > Diagnóstico: </span>" .<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como inserir a informação do cirurgião?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no link "<span style="background-color:yellow" > Cirurgião </span>" .<br>
 	<b>Passo 2: </b>Uma janela pop-up para inserção de informações de cirurgiões irá aparecer. <br>
 	<b>Passo 3: </b>Siga as instruções na janela ou clique no botão "Ajuda" dentro da janela para maiores informações de ajuda. <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como inserir as informações do assistente do cirurgião?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no link "<span style="background-color:yellow" > Assistente </span>" .<br>
 	<b>Passo 2: </b>Uma janela pop-up para inserção de informações de assistentes de cirurgiões irá aparecer. <br>
 	<b>Passo 3: </b>Siga as instruções na janela ou clique no botão "Ajuda" dentro da janela para maiores informações de ajuda. <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como insirir informações de enfermeiros instrumentistas?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no link "<span style="background-color:yellow" > Enfermeiro instrumentista </span>" .<br>
 	<b>Passo 2: </b>Uma janela pop-up para inserção de informações de enfermeiro instrumentista irá aparecer. <br>
 	<b>Passo 3: </b>Siga as instruções na janela ou clique no botão "Ajuda" dentro da janela para maiores informações de ajuda. <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como inserir informações de enfermeiros rotativos?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no link "<span style="background-color:yellow" > Enfermeiros rotativos</span>" .<br>
 	<b>Passo 2: </b>Uma janela pop-up para inserção de informações de enfermeiros rotativos irá aparecer. <br>
 	<b>Passo 3: </b>Siga as instruções na janela ou clique no botão "Ajuda" dentro da janela para maiores informações de ajuda. <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como inserir o tipo de anestesia usado para a operação?</b>
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
 	<li><b>AS: </b>Sedação analgésica<br>
 	<li><b>DS: </b>Equivalente à AS<br>
 	<li><b>Plexus: </b>Anestesia Local Nervus plexus<br>
	</ul>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como inserir a informação do Anestesiologista ?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no link "<span style="background-color:yellow" > Anestesiologista </span>" .<br>
 	<b>Passo 2: </b>Uma janela pop-up para inserção de informações de Anestesiologistas irá aparecer. <br>
 	<b>Passo 3: </b>Siga as instruções na janela ou clique no botão "Ajuda" dentro da janela para maiores informações de ajuda. <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como inserir tempos de entrada, corte, sutura e saída diretamente dos seus campos correspondentes?</b>
</font>
<ul>       	
 	<b>Tempo de entrada: </b>Insira o tempo no campo  "<span style="background-color:yellow" > Entrada:<input type="text" name="t" size=5 maxlength=5> </span>" .<br>
 	<b>Tempo de corte: </b>Insira o tempo no campo"<span style="background-color:yellow" > Corte: <input type="text" name="t" size=5 maxlength=5> </span>" .<br>
 	<b>Tempo de sutura: </b>Insira o tempo no campo"<span style="background-color:yellow" > Sutura: <input type="text" name="t" size=5 maxlength=5> </span>" .<br>
 	<b>Tempo de saída: </b>Insira o tempo no campo"<span style="background-color:yellow" > Saída: <input type="text" name="t" size=5 maxlength=5> </span>" .<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como insirir diversas informações de tempo todas de uma vez?</b>
</font>
<ul> <b>Passo 1: </b><p>    	
 	<b>Tempo de Entrada/Saída: </b>
 	Clique no link "<span style="background-color:yellow" > Entrada/Saída <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>" situado no canto inferior esquerdo.<p>
 	<b>Cut/Suture time:</b>
 	Clique no link"<span style="background-color:yellow" > Corte/Sutura <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>" situado no canto inferior esquerdo.<p>
 	<b>Idle time: </b>
 	Clique no link"<span style="background-color:yellow" > Tempo de espera <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>" situado no canto inferior esquerdo.<p>
 	<b>Plaster/Cast time:</b>
 	Clique no link"<span style="background-color:yellow" > Engessamento <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>" situado no canto inferior esquerdo.<p>
 	<b>Reposition time: </b>
 	Clique no link"<span style="background-color:yellow" > Reposição <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>" situado no canto inferior esquerdo.<p>
 	<b>Passo 2: </b>Uma janela pop-up para inserir informações de tempo irá aparecer. <br>
 	<b>Passo 3: </b>Siga as instruções da janela ou clique no botão "Ajuda" para maiores instruções. <br>
	</ul>

	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como Iiserir informações de tempo na carta de tempo gráfica?</b>
</font>
<ul> <b>Passo 1: </b>Mova o ponteiro do mouse para o tempo escolhido na escala de tempo correspondente à informação de tempo (eg. Engessamento).<br>
 	<b>Passo 2: </b>Clique na escala de tempo correspondente ao tempo escolhido.<p>
<b>Nota:</b> As primeiras entradas serão as de tempo de início, as segundas serão de tempo de fim, as terceiras entradas serão do segundo tempo de início, etc.
	</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como inserir a informação de terapia ou operação?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Digite a terapia ou operação no campo "<span style="background-color:yellow" > Terapia/Operação: </span>" .<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como inserir resultados, observações, noticias extras?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Digite no campo "<span style="background-color:yellow" > Resultados: </span>" .<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como salvar o documento de registro?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no botão<img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>><br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como iniciar um novo registro de documento?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no botão<img <?php echo createLDImgSrc('../','newpat2.gif','0') ?>><br>
 	<b>Passo 2: </b>Clique no botão<img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>> novamente para mais instruções de ajuda.<br>
	</ul>
	
<b>Nota</b>
<ul> Se você decidir fechar, clique no botão<img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.
</ul>
	<?php endif;?>

<?php endif;?>



<?php if($src=="search") : ?>
	<?php if(($x1=="fresh")||($x1=="")) : ?>


<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como pesquisar por um documento de um paciente em particular?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Insira uma informação completa ou as primeiras letras do nome de família do paciente, 
	ou o primeiro nome, ou data de nascimento no campo "<span style="background-color:yellow" > Palavra-chave: <input type="text" name="m" size=20 maxlength=20> </span>" . <br>
 	<b>Passo 2: </b>Clique no botão<input type="button" value="Pesquisa"> para iniciar a pesquisa pelo documento do paciente.<p> 
<ul>       	
 	<b>Nota: </b>Se a pesquisa encontrar um resultado que coincide com a palavra-chave, o(s) documento(s) do paciente serão exibidos imediatamente.<p> 
 	<b>Nota: </b>Se a pesquisa encontrar apenas uma aproximação, uma lista será exibida. 
	Clique no nome de família do paciente para exibir seus documentos.<p> 
	</ul>
</ul>
	<?php endif;?>
<?php if(($x1=="search")&&($x3!="1")) : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como selecionar um documento particular para exibir?</b>
</font>
<ul>       	
 	<b>Nota: </b> Clique no nome de família do paciente para exibir seus documentos.<p> 
</ul>

	<?php endif;?>
<?php if(($x1=="get")||($x3=="1")) : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como atualziar ou editar um registro de documento exibido?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no botão <img src="../img/update3.gif" border=0> situado abaixo da data de operação na coluna da esquerda para trocar para o modo de edição.<br>
 	<b>Passo 2: </b>No modo de edição, clique no botão "Ajuda" se você necessita mais instruções na edição do documento.<p> 
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como abrir a pasta de dados do paciente?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no botão <img src="../img/info2.gif" border=0> na esquerda do número do paciente.<br>
 	<b>Passo 2: </b>A pasta de dados do paciente irá aparecer. Clique no botão "Ajuda" na janela se você necessita mais instruções.<p> 
	</ul>

<?php endif;?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como continuar pesquisando?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Insira uma informação completa ou as primeiras letras do nome de família do paciente, 
	ou o primeiro nome, ou data de nascimento no campo "<span style="background-color:yellow" > Keyword: <input type="text" name="m" size=20 maxlength=20> </span>" . <br>
 	<b>Passo 2: </b>Clique no botão<input type="button" value="Search"> para iniciar a pesquisa pelos documentos do paciente.<p> 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Note:</b></font> 
<ul>       	
 Se você decidir fechar clique no botão<img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.
</ul>
<?php endif;?>

<?php if($src=="arch") : ?>
	<?php if($x2=="1") : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota: últimas entradas de registro</b></font> 
<ul>  Cada vez que você trocar de arquivo, as últimas operações registradas serão exibidas imediatamente.
</ul>
	<?php endif;?>
	<?php if(($x3=="")&&($x1!="0")) : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nenhuma operação feita neste dia.</b></font> 
<ul>       	
Clique em "Opções" para abrir a caixa de opções.<br>
Clique em "Pesquisa" para trocar para o modo de pesquisa.</ul>
	
	<?php endif;?>
	



<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Desejo ver os registros de entradas arquivados de outro dia.</b></font>
<ul> <b>Para exibir o dia anterior: </b>Clique no link "<span style="background-color:yellow" > Dia anterior </span>" na coluna esquerda superior. 
				Clique neste link tantas vezes forem necessárias até o dia desejado ser exibido.<p>
 <b>Para exibir o dia seguinte: </b>Clique no link "<span style="background-color:yellow" > Dia seguinte </span>" na coluna direita superior. 
				Clique neste link tantas vezes forem necessárias até o dia desejado ser exibido.<br>		
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Desejo ver os registros de entrada arquivados de outros departamentos ou centros cirúrgicos.</b></font>
<ul> <b>Passo 1: </b>Selecione o departmento na caixa de seleção <nobr>"<span style="background-color:yellow" > Mude o departamento ou centro cirúrgico <select name="o">
                                                                                                                                         	<option > Departmento exemplo 1</option>
                                                                                                                                         	<option > Departmento exemplo 2</option>
                                                                                                                                         </select>
                                                                                                                                          </span>".</nobr> <br>																  
	<b>Passo 2: </b>Ou selecione o centro cirúrgico na caixa de seleção <nobr>"<span style="background-color:yellow" > <select name="o">
                                                                                                                                         	<option > Centro cirúrgico exemplo 1</option>
                                                                                                                                         	<option > Centro cirúrgico exemplo 2</option>
                                                                                                                                         </select>
                                                                                                                                          </span>".</nobr> <br> 						  																																		  
		<b>Passo 3: </b>Clique no botão<input type="button" value="Change">  para mudar para o novo departmento ou centro cirúrgico.<br>
</ul>
<?php if(($x3!="")) : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como atualizar ou editar um registro de documento exibido?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no botão <img src="../img/update3.gif" border=0> situado abaixo da data da operação na coluna da esquerda para trocar para o modo de edição.<br>
 	<b>Passo 2: </b>No modo de edição, clique no botão "Ajuda" se você necessita mais instruções na edição do documento.<p> 
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como abrir a pasta de dados do paciente?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no botão <img src="../img/info2.gif" border=0> na esquerda do númenro do paciente.<br>
 	<b>Passo 2: </b>A pasta de dados do paciente irá abrir. Clique no botão "Ajuda" na janela se você necessita mais instruções.<p> 
	</ul>
	<?php endif;?>
	
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Note:</b></font> 
<ul>       	
 Se você decidir cancelar clique no botão <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
</ul>


	<?php endif;?>


</form>

