<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
Laboratorio médico- 
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
	case "logmain": print "Edite as entradas documentadas no registro de uma operação";
						break;
	default: print "Registre uma nova operação";	
	}
}
if($src=="time")
{
	print "Documentando ";
	switch($x1)
	{
	case "entry_out": print "horário de entrada e saída";
						break;
	case "cut_close": print "tempos de incisão e sutura";
						break;
	case "wait_time": print "tempos de espera";
						break;
	case "bandage_time": print "tempos de curativo";
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
	case "assist":$person="um assistente de cirurgião"; 
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
	case "get": print  "Documentação de registro de operação de um paciente";
						break;
	case "fresh": print "Pesquise a documentação de registro de operação de um paciente";
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
Como entrar <?php echo $person ?> via lista de seleção rápida?</b>
</font>
<ul>       	
 	<b>Nota: </b>Se <?php echo $person ?> foi  selecionado em uma operação anterior, seu nome será listado na lista de seleção rápida.<p>
 	<b>Passo 1: </b>Verifique primeiro se sua  função está corretamente selecionada na caixa de seleção " Função OR" . Se não estiver, selecione sua função OR correta.<br>
 	<b>Passo 2: </b>Clique no sobrenome do <?php echo $person ?>, ou  nome, ou o 
	<nobr>"<span style="background-color:yellow" > <img <?php echo createComIcon('../','uparrowgrnlrg.gif','0') ?>> Entre esta pessoa como link <?php echo $person ?>... </span>"</nobr> .
	O cirurgião será acrescentado automaticamente na lista "entradas correntes"  .<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
<?php echo ucfirst($person) ?> não aparece na lista de seleção rápida; como entrar <?php echo $person ?>?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Entre  ou com uma informação completa ou com umas poucas letras de informação, como por exemplo, o sobrenome, ou  nome do <?php echo $person ?> no campo "<span style="background-color:yellow" > Pesquise um novo <?php echo substr($person,2) ?>... </span>".<br>
 	<b>Passo 2: </b>Clique no botão <input type="button" value="OK"> para iniciar a pesquisa por <?php echo $person ?>.<br>
 	<b>Passo 3: </b>A pesquisa listará os resultados. clique no sobrenome, ou nome, ou  <nobr>"<span style="background-color:yellow" > <img <?php echo createComIcon('../','uparrowgrnlrg.gif','0') ?>> Entre esta pessoa como um link <?php echo $person ?>... </span>"</nobr> correspondente a <?php echo $person ?> que você quer documentar.
</ul>


<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b> Como apagar <?php echo $person ?> da lista?</b></font> 
<ul>       	
 	<b>Passo 1: </b>Clique no ícone <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> à direita do nome da pessoa.<br>
 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b> Eu terminei. Como voltar ao livro de registros?</b></font> 
<ul>       	
 	<b>Passo 1: </b>Clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle"> que aparecerá depois que você selecionou <?php echo $person ?>.<br>
 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 Se você decidir cancelar clique no botão <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
</ul>
<?php endif;?>

<?php if($src=="time") : ?>
	<?php if($x1=="entry_out") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como documentar o horário de entrada e saída?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Entre com o horário de entrada no campo "<span style="background-color:yellow" > de: <input type="text" name="d" size=5 maxlength=5> </span>" na coluna da esquerda.<br>
 	<b>Passo 2: </b>Entre com o horário de saída no campo "<span style="background-color:yellow" > até: <input type="text" name="d" size=5 maxlength=5> </span>" na coluna da direita.<p>
<ul>       	
 	<b>Dica: </b>Entre ou com "n" ou "N" (significando Agora) no campo de entrada para automaticamente entrar com o horário atual.
</ul><br>
 	<b>Nota: </b>Você pode entrar com vários horários de entrada e saída todos de uma vez só antes de você salvar a informação.<p>
</ul>

	<?php endif;?>
	<?php if($x1=="cut_close") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como documentar os tempos de incisão e sutura?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Entre com a hora de incisão no campo "<span style="background-color:yellow" > de: <input type="text" name="d" size=5 maxlength=5> </span>" na coluna da esquerda.<br>
 	<b>Passo 2: </b>Entre com a hora da sutura no campo "<span style="background-color:yellow" > até: <input type="text" name="d" size=5 maxlength=5> </span>" na coluna da direita.<p>
<ul>       	
 	<b>Dica: </b>Entre ou com "n" ou "N" (significando Agora) no campo de entrada para automaticamente entrar com a hora atual.
</ul><br>
 	<b>Nota: </b>Você pode entrar com vários horários de incisão e sutura, todos de uma vez só, antes de você salvar a informação.<p>
</ul>

	<?php endif;?>
	<?php if($x1=="wait_time") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como documentar tempos ociosos (em espera)?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Entre com o horário de início no campo "<span style="background-color:yellow" > de: <input type="text" name="d" size=5 maxlength=5> </span>" na primeira coluna.<br>
 	<b>Passo 2: </b>Entre com o horário de fim no campo "<span style="background-color:yellow" > até: <input type="text" name="d" size=5 maxlength=5> </span>" na segunda coluna.<p>
<ul>       	
 	<b>Tip: </b>Entre ou com "n" ou "N" (significando Agora) no campo de entrada para automaticamente entrar com o horário atual.
</ul><br>
 	<b>Passo 3: </b>Selecione a razão a partir da caixa de seleção na terceira coluna (Razão).<p>
 	<b>Nota: </b>Você pode entrar com vários horários de início e fim, e razões todos de uma vez só, antes de você salvar a informação.<p>
</ul>

	<?php endif;?>
	<?php if($x1=="bandage_time") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como documentar tempos de curativo?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Entre com o horário de início no campo "<span style="background-color:yellow" > de: <input type="text" name="d" size=5 maxlength=5> </span>" na coluna da esquerda.<br>
 	<b>Passo 2: </b>Entre com o horário de fim no campo "<span style="background-color:yellow" > até: <input type="text" name="d" size=5 maxlength=5> </span>" na coluna da direita.<p>
<ul>       	
 	<b>Dica: </b>Entre ou com "n" ou "N" (significando Agora) no campo de entrada para automaticamente entrar com o horário atual.
</ul><br>
 	<b>Nota: </b>Você pode entrar com vários horários de de início e fim, todos de uma vez só, antes de você salvar a informação.<p>
</ul>

	<?php endif;?>
	<?php if($x1=="repos_time") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Com documentar tempos de reposição?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Entre com o horário de início no campo "<span style="background-color:yellow" > de: <input type="text" name="d" size=5 maxlength=5> </span>" na coluna da esquerda.<br>
 	<b>Passo 2: </b>Entre com o horário de fim no campo "<span style="background-color:yellow" > até: <input type="text" name="d" size=5 maxlength=5> </span>" na coluna da direita.<p>
<ul>       	
 	<b>Dica: </b>Entre ou com "n" ou "N" (significando Agora) no campo de entrada para automaticamente entrar com o horário atual.
</ul><br>
 	<b>Nota: </b>Você pode entrar com vários horários de de início e fim, todos de uma vez só, antes de você salvar a informação.<p>
</ul>

	<?php endif;?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como salvar a informação?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no botão <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> para salvar a informação<br>
 	<b>Passo 2: </b>Se você terminou, clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> para fechar a janela e voltar ao livro de registros.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b> Eu quero apagar as entradas mas clicando no botão "Apagar dados" parece que não funciona. O que devo fazer?</b></font> 
<ul>       	
 	<b>Nota: </b>Clicando no botão  "Apagar dados" apagará somente as entradas que não foram salvas ainda. Se você quiser apagar entradas
	que foram salvas previamente, siga estas instruções:<p>
 	<b>Passo 1: </b>Clique no campo de entrada do horário que você quer apagar.<br>
 	<b>Passo 2: </b>Apague o horário manualmente usando as teclas "Del" ou "Backspace" do teclado.<br>
 	<b>Passo 3: </b>Clique no botão <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> para salvar as alterações.<br>
 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 Se você decidir cancelar clique no botão <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
</ul>
<?php endif;?>


<?php if($src=="create") : ?>
	<?php if($x1=="logmain") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como editar as entradas de registro de uma operação?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no botão <img src="../img/update3.gif" width=15 height=14 border=0> correspondente às entradas de registro do paciente.<br>
 	<b>Passo 2: </b>As entradas do registro do paciente serão copiadas para o quadro de edição. Você pode editar as entradas seguindo as instruções para documentação
		de uma operação.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como abrir o arquivo de dados de um paciente?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no botão <img <?php echo createComIcon('../','info3.gif','0') ?>> à esquerda do número do paciente.<br>
 	<b>Passo 2: </b>O arquivo de dados do paciente abrirá.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como mudar para outro departmento e/ou sala de operação?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Selecione o departamento a partir da caixa de seleção 
				<select name="dept" size=1>
				<?php
$Or2Dept=get_meta_tags("../global_conf/resolve_or2ordept.pid");
					$opabt=get_meta_tags("../global_conf/$lang/op_tag_dept.pid");

					while(list($x,$v)=each($opabt))
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
 	<b>Passo 2: </b>Selecione a sala de operação a partir da caixa de seleção <select name="saal" size=1 >
				<?php
while(list($x,$v)=each($Or2Dept))
					{
						print'
					<option value="'.$x.'"';
						if ($saal==$x) print " selecionado";
						print '> '.$x.'</option>';
					}
				?>
				</select>.
<br>
 	<b>Passo 3: </b>Clique no botão <input type="button" value="Altere"> para alterar para o outro departamento e/ou sala de operação.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como exibir as entaradas do registro de um certo dia diferente do que está sendo exibido?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Para mostrar as entradas de registro do(s) dia(s) anterior(es), clique no link "<span style="background-color:yellow" > Dia anterior </span>" no canto superior esquerdo da tabela.<br>
	Clique tantas vezes quantas necessárias até que as entradas de registro do dia desejado sejam mostradas.<br>
 	<b>Passo 2: </b>Para mostrar as entradas de registro do(s) dia(s) posterior(es), clique no link "<span style="background-color:yellow" > Dia seguinte </span>" no canto superior direito da tabela.<br>
	Clique tantas vezes quantas necessárias até que as entradas de registro do dia desejado sejam mostradas.<br>
</ul>

<hr>

	<?php endif;?>
	
	<?php if($x2=="material") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como documentar um material usado para a operação?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Digite o número de artigo do material no campo "<span style="background-color:yellow" > No. artigo: </span>" .<p>
	<b>Maneiras alternativas: </b>
	<ul type=disc>  	
	<li>Entre  ou com uma informação completa ou com umas poucas letras do nome do material, descrição genérica do produto, número de licença, ou número da ordem no campo "<span style="background-color:yellow" > No. do artigo: </span>" .
	<li>Faça a varredura no código de barras do artigo com o scanner.
	</ul><br> 
 	<b>Passo 2: </b>Clique no botão <input type="button" value="OK"> ou no "enter" do teclado para pesquisar o produto.<p> 
<ul>       	
 	<b>Nota: </b>Se a pesquisa encontrar um resultado, a informação do material será adicionada imediatamente no documento.<p> 
 	<b>Nota: </b>Se a pesquisa encontrar vários resultados, uma lista será mostrada. Clique no botão <img <?php echo createComIcon('../','bul_arrowgrnlrg.gif','0') ?>> ou no número do artigo, ou no nome do artigo para adicioná-lo ao documento.<p> 
	</ul>
 	<b>Passo 3: </b>Se o artigo for acrescentado ao documento, você pode alterar a entrada no campo no.Pcs "<span style="background-color:yellow" > .</span>" se necessário.<p> 
<ul>       	
 	<b>Nota: </b>Depois que você alterou a entrada no campo "no.Pcs." , os botões "Salvar" e "Apague dados" aparecerão.<p> 
	</ul>
 	<b>Passo 4: </b>Se você alterou a entrada no campo "no.Pcs.", clique no botão <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> para salvar as alterações.<p> 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como remover um artigo da lista?</b>
</font>
<ul> 
 	<b>Passo 1: </b>Clique no ícone <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> correspondente ao artigo.<br> 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
O artigo não foi encontrado. Como entrar com as informações de um artigo manualmente?</b>
</font>
<ul> 
 	<b>Passo 1: </b>Clique no link "<span style="background-color:yellow" > <img <?php echo createComIcon('../','accessrights.gif','0') ?>> Para entrar manualmente com o artigo, clique aqui. </span>" .<br> 
 	<b>Passo 2: </b>Manualmente entre com as informações do artigo nos campos correspondentes.<p> 
 	<b>Passo 3: </b>Clique no botão <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> para acrescentar as informações do artigo no documento<p> 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 Se você decidir cancelar clique no botão <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
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
Como iniciar um documento de registro para uma operação?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Encontre primeiro o paciente. Digite o número do paciente no campo "<span style="background-color:yellow" > No. do paciente: </span>" .<p>
	<b>Modos alternativos: </b>
	<ul type=disc>  	
	<li>Entre  ou com uma informação completa ou com umas poucas letras do sobrenome do paciente ou nome no campo "<span style="background-color:yellow" > Sobrenome, nome </span>" .
	<li>Entre com uma data completa ou os primeiros dígitos da data de nascimento do paciente no campo "<span style="background-color:yellow" > Data de nascimento </span>" .
	</ul>
 	<b>Passo 2: </b>Clique no botão <input type="button" value="Pesquise paciente"> para iniciar a pesquisa de paciente.<p> 
<ul>       	
 	<b>Nota: </b>Se a pesquisa encontrar um resultado, os dados básicos do paciente serão entrados imediatamente nos seus campos correspondentes.<p> 
 	<b>Nota: </b>Se a pesquisa encontrar vários resultados,  uma lista será mostrada. Clique no sobrenome do paciente, ou nome para selecioná-lo para documentação.<p> 
	</ul>
 	<b>Passo 3: </b>Clique novamente no botão <img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>> novamente para maiores instruções.<p> 

</ul>

	<?php else : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como entrar com o diagnóstico para a operação?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Digite o diagnóstico no campo "<span style="background-color:yellow" > Diagnóstico: </span>" .<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como entrar com a informação do cirurgião?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no link "<span style="background-color:yellow" > Cirurgião </span>" .<br>
 	<b>Passo 2: </b>Uma janela aparecerá para se entrar com a informação do cirurgião. <br>
 	<b>Passo 3: </b>Siga as instruções da janela ou clique no botão "Ajuda" dentro da janela para maiores instruções de ajuda. <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como entrar com as informações do assistente do cirurgião?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no link "<span style="background-color:yellow" > Assistente </span>" .<br>
 	<b>Passo 2: </b>Uma janela para entrar com as informações do assistente do cirurgião aparecerá. <br>
 	<b>Passo 3: </b>Siga as instruções na janela ou clique no botão "Ajuda" dentro da janela para maiores instruções de ajuda. <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como entrar com as informações dos enfermeiros instrumentistas?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no link "<span style="background-color:yellow" > Enfermeiro instrumentista </span>" .<br>
 	<b>Passo 2: </b>Uma janela para entrar com as informações do enfermeiro instrumentista aparecerá. <br>
 	<b>Passo 3: </b>Siga as instruções na janela ou clique no botão "Ajuda" dentro da janela para maiores instruções de ajuda. <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como entrar com as informações dos enfermeiros rotativos?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no link "<span style="background-color:yellow" > Enfermeiro rotativo </span>" .<br>
 	<b>Passo 2: </b>Uma janela para entrar com as informações do enfermeiro rotativo aparecerá. <br>
 	<b>Passo 3: </b>Siga as instruções na janela ou clique no botão "Ajuda" dentro da janela para maiores instruções de ajuda. <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como entrar com o tipo de anestesia utilizada para a operação?</b>
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
 	<li><b>AS: </b>Anestesia analgésica-sedativa <br>
 	<li><b>DS: </b>Anestesia equivalente a AS <br>
 	<li><b>Plexus: </b>Anestesia local Nervus plexus <br>
	</ul>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como entrar com a informação do anestesista?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no link "<span style="background-color:yellow" > Anestesista </span>" .<br>
 	<b>Passo 2: </b>Uma janela para entrar com as informações do anestesista aparecerá. <br>
 	<b>Passo 3: </b>Siga as instruções na janela ou clique no botão "Ajuda" dentro da janela para maiores instruções de ajuda. <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como entrar com os horários de entrada, incisão, sutura, e saida diretamente nos seus campos correspondentes?</b>
</font>
<ul>       	
 	<b>Horário de entrada: </b>Entre com o horário no campo "<span style="background-color:yellow" > Entrada:<input type="text" name="t" size=5 maxlength=5> </span>" .<br>
 	<b>Horário de incisão: </b>Entre com o horário no campo "<span style="background-color:yellow" > Incisão: <input type="text" name="t" size=5 maxlength=5> </span>" .<br>
 	<b>Horário de sutura: </b>Entre com o horário no campo "<span style="background-color:yellow" > Sutura: <input type="text" name="t" size=5 maxlength=5> </span>" .<br>
 	<b>Horário de saída: </b>Entre com o horário no campo "<span style="background-color:yellow" > Saída: <input type="text" name="t" size=5 maxlength=5> </span>" .<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como entrar com várias informações de horário, todas de uma vez só?</b>
</font>
<ul> <b>Passo 1: </b><p>    	
 	<b>Horário de Entrada/Saída: </b>
 	Clique no link "<span style="background-color:yellow" > Entrada/Saídat <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>"  situado no canto inferior esquerdo.<p>
 	<b>Horário de Incisão/Sutura:</b>
 	Clique no link "<span style="background-color:yellow" > Incisão/Sutura <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>"  situado no canto inferior esquerdo.<p>
 	<b>Tempo de espera: </b>
 	Clique no link "<span style="background-color:yellow" > Tempo de espera <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>"  situado no canto inferior esquerdo.<p>
 	<b>Horários de Curativo/tipóia:</b>
 	Clique no link "<span style="background-color:yellow" > Curativo/tipóia <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>"  situado no canto inferior esquerdo.<p>
 	<b>Horário de reposição: </b>
 	Clique no link "<span style="background-color:yellow" > Reposição <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>"  situado no canto inferior esquerdo.<p>
 	<b>Passo 2: </b>Aparecerá uma janela para entrar com as informações de horário. <br>
 	<b>Passo 3: </b>Siga as instruções na janela ou clique no botão "Ajuda" dentro da janela para maiores instruções de ajuda. <br>
	</ul>

	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como entrar com a informação de horários para os gráficos de tempo?</b>
</font>
<ul> <b>Passo 1: </b>Mova o cursor para o horário escolhido na escala de tempo correspondente à informação (por exemplo Curativa/tipóia).<br>
 	<b>Passo 2: </b>Clique na escala de tempo correspondente ao horário escolhido.<p>
<b>Nota:</b> A primeira entrada será o horário de início, a segunda será o horário de fim, a terceira entrada será o segundo horário de início, etc.
	</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como entrar com a informação de terapia ou operação?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Digite a terapia/operação  no campo "<span style="background-color:yellow" > Terapia/Operação: </span>" .<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como entrar com resultados, observações, notas extra?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Digite no campo "<span style="background-color:yellow" > Resultados: </span>" .<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como salvar o documento de registro?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no botão <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>><br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como iniciar um documento novo de registro?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no botão <img <?php echo createLDImgSrc('../','newpat2.gif','0') ?>><br>
 	<b>Passo 2: </b>Clique novamente no botão <img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>> para maiores instruções de ajuda.<br>
	</ul>
	
<b>Nota</b>
<ul> Se você decidir fechar clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.
</ul>
	<?php endif;?>

<?php endif;?>



<?php if($src=="search") : ?>
<?php if(($x2!="")&&($x2!="0")) : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como selecionar um paciente em particular cujo relatório do laboratório quero <?php if($x1=="edit") print "editar"; else print "veja"; ?>?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no botão&nbsp;<button><img <?php echo createComIcon('../','update2.gif','0') ?>> <font size=1>Lab report</font></button> correspondente a um paciente em particular cujo relatório do laboratório quero  <?php if($x1=="edit") print "editar"; else print "ver"; ?>.<p> 
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
 	<b>Passo 1: </b>Entre  ou com uma informação completa ou com umas poucas letras de informação do paciente, como por exemplo, o número de encontro do paciente, ou sobrenome, ou  nome, 
	ou data de nascimento no campo "<span style="background-color:yellow" > Entre com uma palavra chave de pesquisa. <input type="text" name="m" size=20 maxlength=20> </span>" . <br>
 	<b>Passo 2: </b>Clique no botão <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> para iniciar a pesquisa de paciente.<p> 
<ul>       	
 	<b>Nota: </b>Se a pesquisa encontrar um resultado, uma lista será mostrada. <p>
	</ul>
	<?php if(($x2=="")||($x2=="0")) : ?>
 	<b>Passo 3: </b>Clique no botão&nbsp;<button><img <?php echo createComIcon('../','update2.gif','0') ?>> <font size=1>Lab report</font></button> correspondente a um paciente em particular cujo relatório do laboratório quero  <?php if($x1=="edit") print "editar"; else print "ver"; ?>.<p> 
	<?php endif;?>
</ul>

<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 Se você decidir cancelar clique no botão <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
</ul>
<?php endif;?>

<?php if($src=="arch") : ?>
	<?php if($x2=="1") : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota: As entradas mais recentes</b></font> 
<ul>  Cada vez que você retornar ao arquivo, as últimas operações registradas serão mostradas imediatamente.
</ul>
	<?php endif;?>
	<?php if(($x3=="")&&($x1!="0")) : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nenhuma operação foi realizada neste dia.</b></font> 
<ul>       	
Clique em "Opções" para abrir a caixa de opções.<br>
Clique em "Pesquise" para ir para o modo de pesquisa.</ul>
	
	<?php endif;?>
	



<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Eu quero ver os registros das entradas arquivadas de um outro dia.</b></font>
<ul> <b>Para mostrar um dia anterior: </b>Clique no link "<span style="background-color:yellow" > Dia anterior </span>" na coluna superior esquerda. 
				Clique neste link tantas vezes quantas necessárias até que o dia desejado seja mostrado.<p>
 <b>Para mostrar o próximo dia: </b>Clique no link "<span style="background-color:yellow" > Próximo dia </span>" na coluna superior direita. 
				Clique neste link tantas vezes quantas necessárias até que o dia desejado seja mostrado.<br>		
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Eu quero ver os registros das entradas arquivadas de uma outra sala de operação ou departamento.</b></font>
<ul> <b>Passo 1: </b>Selecione o departamento na caixa de seleção <nobr>"<span style="background-color:yellow" > Altere o departamento ou sala de OP <select name="o">
                                                                                                                                         	<option > Departamento de exemplo 1</option>
                                                                                                                                         	<option > Departmento de exemplo 2</option>
                                                                                                                                         </select>
                                                                                                                                          </span>".</nobr> <br>A sala padrão de operação se
		ajustará automaticamente.<br>																																		  
	<b>Passo 2: </b>Ou selecione a sala de operação na caixa de seleção <nobr>"<span style="background-color:yellow" > <select name="o">
                                                                                                                                         	<option > Exemplo OR 1</option>
                                                                                                                                         	<option > Exemplo OR 2</option>
                                                                                                                                         </select>
                                                                                                                                          </span>".</nobr> <br> O departamento
		correspondente se ajustará automaticamente.<br>																																		  																																		  
		<b>Passo 3: </b>Clique no botão <input type="button" value="Altere">  para ir ao novo departamento ou sala de operação.<br>
</ul>
<?php if(($x3!="")) : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como atualizar ou editar um documento de registro que está na tela?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no botão <img src="../img/update3.gif" border=0> situado abaixo da data de operação na coluna mais à esquerda para ir ao modo de edição.<br>
 	<b>Passo 2: </b>No modo de edição, clique no botão "Ajuda" se você necessitar de mais instruções para editar o documento.<p> 
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como abrir o arquivo de dados do paciente?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no botão <img src="../img/info2.gif" border=0> à esquerda do número do paciente.<br>
 	<b>Passo 2: </b>O arquivo de dados do paciente aparecerá. clique no botão "Ajuda" se você necessitar de mais instruções.<p> 
	</ul>
	<?php endif;?>
	
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 Se você decidir cancelar clique no botão <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
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
 			<b>Passo 1: </b>Entre com o número do lote no campo "<span style="background-color:yellow" > Número do lote: </span>" .<br>	
 			<b>Passo 2: </b>Entre com a data do exame no campo "<span style="background-color:yellow" > Data do exame </span>" se necessário.<br>	';
	
		?>

	
 	<b>Passo	<?php if($x2=="") 
			print "3"; else print "1";
		?>:</b> Entre com os valores nos seus correspondentes campos de parâmetros.<br>	
 	<b>Passo <?php if($x2=="") 
			print "4"; else print "2";
		?>: </b> Clique no botão <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> para salvar os valores.<p> 
 	<b>Nota: </b>Depois que você salvou os valores e quiser fechar,<br> clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.<br> 
</ul>
	<?php endif;?>
<?php if($x1=="few") : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Eu preciso entrar somente com uns poucos valores! Como fazer isto?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Entre com os valores disponíveis em seus campos de parâmetros correspondentes.<br> 
 	<b>Passo 2: </b>Clique no botão <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> para salvar os valores dos parâmetros.<p> 
 	<b>Nota: </b>Se você terminou de entrar todos os valores dos parâmetros e quiser fechar clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.<br> 
</ul>
	<?php endif;?>
	<?php if($x1=="param") : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
O parâmetro que eu preciso não foi mostrado! Como mudar para o grupo certo de parâmetros?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Selecione o grupo de parâmetro certo da caixa de seleção <nobr>"<span style="background-color:yellow" > Selecione grupo de parâmetros <select name="s">
     <option value="Parâmetro exemplo"> Parâmetro exemplo</option> </select> </span>"</nobr> caixa de seleção.<p> 
 	<b>Passo 2: </b>Clique no botão <img <?php echo createLDImgSrc('../','auswahl2.gif','0') ?>> para ir para o grupo de parâmetros selecionado.<p> 
</ul>
	<?php endif;?>
	<?php if($x1=="save") : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como devo salvar os valores?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no botão <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> salvar os valores dos parâmetros.<p> 
 	<b>Nota: </b>Depois que você salvou os valores e quiser fechar,<br> clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.<br> 
</ul>
	<?php endif;?>
	<?php if($x1=="correct") : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Eu salvei um valor errado. Como posso corrigir isto?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Entre com o valor correto no campo do parâmetro correspondente.<br> 
 	<b>Passo 2: </b>Clique no botão <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> para salvar o valor correto.<p> 
 	<b>Nota: </b>Depois que você salvou os valores e quiser fechar,<br> clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.<br> 
</ul>
	<?php endif;?>
	<?php if($x1=="Note") : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Eu preciso entrar com uma nota em vez de um valor. Como fazer isto?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Digite a nota no campo do parâmetro correspondente.<br> 
 	<b>Passo 2: </b>Clique no botão <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> para salvar a nota.<p> 
 	<b>Nota: </b>Depois que você salvou e quiser fechar,<br> clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.<br> 
</ul>
	<?php endif;?>
	<?php if($x1=="done") : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Estou pronto. E agora?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no botão <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> para salvar todos os valores.<p> 
 	<b>Nota: </b>Clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.<br> 
</ul>
	<?php endif;?>
	

<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 Se você decidir cancelar clique no botão <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
</ul>
<?php endif;?>
</form>

