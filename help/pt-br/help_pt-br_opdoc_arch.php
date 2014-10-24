<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
OR documentoation - 
<?php
if($src=="arch")
{
	switch($x1)
	{
	case "dummy": print "Arquivo";
						break;
	case "": print "Arquivo";
						break;
	case "?": print "Arquivo";
						break;
	case "search": print  "Lista de reultados da busca de arquivos";
						break;
	case "select": print "Documentos do paciente";
	}
}
 ?></b></font>
<p><font size=2 face="verana,arial" >
<Param action="#" >

<?php if($src=="arch") : ?>
	<?php if(($x1=="dummy")||($x1=="?")||($x1=="")||!$x2) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Desejo listar todos os  documentos de operações feitos em uma certa data</b></font>
<ul> <b>Passo 1: </b>Insira a data da operação no campo "<span style="background-color:yellow" > Data da operação: </span>". <br>
		<ul><font size=1 color="#000099">
		<!-- <b>Tip:</b> Digite "T" ou "t" para automaticamente produzir a data de hoje.<br>
		<b>Dica:</b> Digite "Y" ou "y" para automaticamente produzir a data de ontem.<br> -->
		</font>
		</ul><b>Passo 2: </b>Deixe todos os outros campos em branco ou vazios.<br>
		<b>Passo 3: </b>Clique no botão <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  para iniciar a pesquisa.<br>
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Desejo listar todos os documentos do Centro Cirúrgico de um certo paciente.</b></font>
<ul> <b>Passo 1: </b>Insira a palavra-chave no campo correspondente. Pode ser uma palavra inteira ou algumas letras dos dados pessoais do paciente. <br>
		<ul><font size=1 color="#000099" >
		<b>Os seguintes campos podem ser preenchidos com a palavra-chave:</b>
		<br> Num. do paciente
		<br> Nome de família
		<br> Primeiro nome
		<br> Data de nascimento
		</font>
		</ul><b>Passo 2: </b>Deixe todos os outros campos em branco ou vazios.<br>
		<b>Passo 3: </b>Clique no botão <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  para iniciar a pesquisa.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Desejo listar todos os documentos do Centro Cirúrgico feitos por um cirurgião.</b></font>
<ul> <b>Passo 1: </b>Insira o nome do cirurgião no campo "<span style="background-color:yellow" > Cirurgião: </span>". <br>
		<b>Passo 2: </b>Deixe todos os outros campos em branco ou vazios.<br>
		<b>Passo 3: </b>Clique no botão <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  para iniciar a pesquisa.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Desejo listar todos os documentos do Centro Cirúrgico  de pacientes ambulatoriais  </b></font>
<ul> <b>Passo 1: </b>Clique no botão rádio"<span style="background-color:yellow" >Paciente ambulatorial <input type="radio" name="r" value="1"></span>". <br>
		<b>Passo 2: </b>Deixe todos os outros campos em branco ou vazios.<br>
		<b>Passo 3: </b>Clique no botão <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  para iniciar a pesquisa.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Desejo listar todos os documentos do Centro Cirúrgico  de pacientes internados</b></font>
<ul> <b>Passo 1: </b>Clique no botão rádio "<span style="background-color:yellow" ><input type="radio" name="r" value="1">paciente internado</span>". <br>
		<b>Passo 2: </b>Deixe todos os outros campos em branco ou vazios.<br>
		<b>Passo 3: </b>Clique no botão <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  para iniciar a pesquisa.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Desejo listar todos os documentos do Centro Cirúrgico  of pacientes  geralmente segurados</b></font>
<ul> <b>Passo 1: </b>Clique no botão rádio "<span style="background-color:yellow" ><input type="radio" name="r" value="1">Seguro</span>". <br>
		<b>Passo 2: </b>Deixe todos os outros campos em branco ou vazios.<br>
		<b>Passo 3: </b>Clique no botão <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  para iniciar a pesquisa.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Desejo listar todos os documentos do Centro Cirúrgico  de pacientes segurados de Parama privada </b></font>
<ul> <b>Passo 1: </b>Clique no botão rádio "<span style="background-color:yellow" ><input type="radio" name="r" value="1">Privado</span>". <br>
		<b>Passo 2: </b>Deixe todos os outros campos em branco ou vazios.<br>
		<b>Passo 3: </b>Clique no botão <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  para iniciar a pesquisa.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Desejo listar todos os documentos do Centro Cirúrgico de pacientes auto-pagantes </b></font>
<ul> <b>Passo 1: </b>Clique no botão rádio "<span style="background-color:yellow" ><input type="radio" name="r" value="1">Auto paga</span>". <br>
		<b>Passo 2: </b>Deixe todos os outros campos em branco ou vazios.<br>
		<b>Passo 3: </b>Clique no botão <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  para iniciar a pesquisa.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Desejo listar todos os documentos do Centro Cirúrgico  com uma determinada palavra-chave</b></font>
<ul> <b>Passo 1: </b>Insira a palabra-chave no campo correspondente. Pode ser uma palavra inteira ou algumas letras do documento. <br>
		<ul><font size=2 color="#000099" >
		<b>Exemplo:</b> Para palavras-chave de diagnóstico insira no campo "Diagnóstico".<br>
		<b>Exemplo:</b> Para palavras-chave de localização insira no campo "Localização".<br>
		<b>Exemplo:</b> Para  palavras-chave terapêuticas insira no campo "Terapia".<br>
		<b>Exemplo:</b> Para palavras-chave notas especiais insira no campo "Notas especiais".<br>
		</font>
		</ul><b>Passo 2: </b>Deixe todos os outros campos em branco ou vazios.<br>
		<b>Passo 3: </b>Clique no botão <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  para iniciar a pesquisa.<br>
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Desejo listar todos os documentos com uma certa classificação de operação</b></font>
<ul> <b>Passo 1: </b>Insira a palavra-chave no campo correspondente. Pode ser uma palavra inteira ou algumas letras do documento. <br>
		<ul><font size=2 color="#000099" >
		<b>Exemplo:</b> Para operações pequenas insira o número no campo"<span style="background-color:yellow" > <input type="text" name="m" size=4 maxlength=2> pequena </span>" .<br>
		<b>Exemplo:</b> Para operações médias insira o número no campo"<span style="background-color:yellow" > <input type="text" name="m" size=4 maxlength=2> média </span>" .<br>
		<b>Exemplo:</b> Para operações grandes insira o número no campo"<span style="background-color:yellow" > <input type="text" name="m" size=4 maxlength=2> grande </span>" .<br>
		</font>
		</ul><b>Passo 2: </b>Deixe todos os outros campos em branco ou vazios.<br>
		<b>Passo 3: </b>Clique no botão <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  para iniciar a pesquisa.<br>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>><b><font color="#990000"> Note:</font></b>
<ul> Você pode combinar diversas condições de pesquisa. Por exemplo: Se você deseja listar todos os pacientes internados que foram operados pelo Cirurgião "Smith" 
		e que possui um terapia contendo a palavra que inicia com "lipo":<p>
		<b>Passo 1: </b>Insira "Smith" no campo"<span style="background-color:yellow" > Cirurgião: <input type="text" name="s" size=15 maxlength=4 value="Smith"> </span>".<br>
		<b>Passo 2: </b>Clique no botão rádio "<span style="background-color:yellow" > <input type="radio" name="r" value="1" checked>paciente internado </span>".<br>
		<b>Passo 3: </b>Insira "lipo" no campo "<span style="background-color:yellow" > Terapia: <input type="text" name="s" size=20 maxlength=4 value="lipo"> </span>". <br>
		<b>Passo 4: </b>Clique no botão <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  para iniciar a pesquisa.<p>

<b>Note</b><br>
Se a pesquisa encontrar um resultado único, o documento completo será exibido imediatamente.<br>
		Entretanto, se a pesquisa encontrar diversos resultados, uma lista será exibida.<p>
		Para abrir o documento para o paciente que você estiver procurando, clique no botão <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> correspondente a este, ou
		o primeiro nome, ou o nome de família, ou a data, ou o número op <nobr>(op nr)</nobr>.
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Note:</b></font> 
<ul>       	
 Se você decidir fechar clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.
</ul>
	<?php endif;?>
<?php if(($x1=="search"||$x1='paginate')&&($x2>0)) : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como selecionar um arquivo particular para exibir?</b>
</font>
<ul>       	
 	<b>Nota: </b> Clique no nome de família do paciente, ou primeiro none, ou a data de op, ou o número op para exibir o documento.<p> 
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como organizar a lista?</b>
</font>
<ul>       	
 	<b>Nota: </b> Clique no título da coluna onde você deseja que a lista seja organizada.<p> 
	Por exemplo: Se você deseja organizar a lista pela data de operação, clique no título "Data OP". <br>A seguir, um clique irá inverter a ordem de organização:<p>
	<blockquote>
	<img src='../help/en/img/en_or_search_sort.png'>
	</blockquote>
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como continuar pesquisando nos arquivos?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no botão <input type="button" value="Nova pesquisa de arquivo"> para voltar à pesquisa de arquivo nos campos de entrada.<p> 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 Se você decidir fechar clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.
</ul>
	<?php endif;?>
<?php if(($x1=="select"||$x1='paginate')&&($x2==1)) : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como atualizar ou editar o docuemtno exibido?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no botão <input type="button" value="Update data"> para trocar para o modo de edição.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como continuar pesquisando nos arquivos?</b>
</font>
<ul>       	
 	<b>Metodo 1: </b>Clique no botão <input type="button" value="Nova pesquisa de arquivo"> para voltar à pesquisa de arquivos nos campos de entrada.<p> 
 	<b>OU Metodo 2: </b>Clique no botão <img <?php echo createLDImgSrc('../','arch-blu.gif','0','absmiddle') ?>> para voltar à pesquisa de arquivos nos campos de entrada.<p> 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 Se você decidir fechar clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.
</ul>

<?php endif;?>
<?php endif;?>

</Param>

