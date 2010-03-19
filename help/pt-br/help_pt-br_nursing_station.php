<font face="Verdana, Arial" size=3 color="#0000cc">
<b><?php echo "$x3 - $x2" ?></b></font>
<form action="#" >
<p><font size=2 face="verdana,arial" >
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como admitir um paciente a partir de uma lista de espera?</b></font>
<ul> <b>Passo 1: </b>Clique no nome do paciente da lista de espera.<p>
<img src="../help/en/img/en_ambulatory_waitlist.png" border=0 width=301 height=156>
                                                                     <p>
		<b>Passo 2: </b>Uma janela aparecerá mostrando a lista de ocupação da ala.<br>
		<b>Passo 3: </b>Clique no botão <img <?php echo createLDImgSrc('../','assign_here.gif','0') ?>> da cama assinalada ao paciente.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como assinalar uma cama a um paciente?</b> (Método antigo)</font>
<ul> 
<b>Note: </b> Este é o método antigo de admissão de um paciente internado para uma ala. O método preferido atualmente é o de usar a lista de espera. Veja os passos acima.<p>
<b>Passo 1: </b>Clique no botão <img <?php echo createComIcon('../','plus2.gif','0') ?>> correspondente ao número do quarto e cama. 
                                                                     <br>
		<b>Passo 2: </b>Uma janela aparecerá para a pesquisa de paciente.<br>
		<b>Passo 3: </b>Primeiro encontre o paciente entrando com uma palavra chave de pesquisa em um dos vários campos de entradas.<br>
		Se você quiser encontrar o paciente...<ul type="disc">
		<li>pelo seu número de paciente, entre com o número no campo <br>"<span style="background-color:yellow" >Patient no.:</span><input type="text" name="t" size=19 maxlength=10 value="22000109">" .
		<li>pelo seu sobrenome, entre seu sobrenome ou as primeiras poucas letras no campo <br>"<span style="background-color:yellow" >Sobrenome:</span><input type="text" name="t" size=19 maxlength=10 value="Schmitt">" .
		<li>pelo seu nome, entre seu nome ou as primeiras poucas letras no campo <br>"<span style="background-color:yellow" >Nome:</span><input type="text" name="t" size=19 maxlength=10 value="Peter">" .
		<li>pela sua data de nascimento, entre sua data de nascimento ou os primeiro poucos números no campo <br>"<span style="background-color:yellow" >Data de nascimento:</span><input type="text" name="t" size=19 maxlength=10 value="10.10.1966">" .
		</ul>
		<b>Passo 4: </b>Clique no botão <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> para iniciar a pesquisa de paciente.<br>
		<b>Passo 5: </b>Se a pesquisa encontrar um paciente ou vários pacientes, uma lista de pacientes será exibida.<br>
		<b>Passo 6: </b>Para selecionar o paciente certo, clique no botão&nbsp;<button><img <?php echo createComIcon('../','post_discussion.gif','0') ?>></button> correspondente a ele.<br>
</ul>

<?php if((($src=="")&&($x1=="ja"))||(($src=="fresh")&&($x1=="template"))) : ?>


<font face="Verdana, Arial" size=2>
<a name="open"></a>
<b>
<p><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000">Como abrir os gráficoa dos pacientes?</font></b><p>
<font face="Verdana, Arial" size=2>
<ul>
<b>Passo:</b> Clique nas barras coloridas para abrir o arquivo dos gráficos...<p>
<img src="../help/en/img/en_ambulatory_sbars.png" border=0 width=434 height=84><p>
<b>OU:</b> Clique no ícone <img <?php echo createComIcon($root_path,'open.gif','0'); ?>> para abrir o arquivo dos gráficos...<p>
<img src="../help/en/img/en_admission_folder.png" border=0 width=456 height=92>
</ul>
<a name="adata"></a>
<font face="Verdana, Arial" size=2>
<b>
<p><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000">Como exibir a data de admissão de um paciente?</font></b><p>
<font face="Verdana, Arial" size=2>
<ul>
<b>Passo:</b> Clique no ícone <img <?php echo createComIcon($root_path,'pdata.gif','0'); ?>> exibir a data de admissão ...<p>
<img src="../help/en/img/en_admission_listlink.png" border=0 width=456 height=92><p>
<b>OU:</b> Clique no sobrenome do paciente para a exibição da data de admissão.<p>
<img src="../help/en/img/en_ambulatory_name.png" border=0 width=434 height=84>
</ul>

<a name="transfer"></a>
<font face="Verdana, Arial" size=2>
<b>
<p><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000">Como transferir um paciente?</font></b><p>
<font face="Verdana, Arial" size=2>
<ul>
<b>Passo:</b> Clique no ícone <img <?php echo createComIcon($root_path,'xchange.gif','0'); ?>> para abrir a janela de transferência.<p>
<img src="../help/en/img/en_admission_transfer.png" border=0 width=456 height=92>
</ul>


<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como liberar um paciente da ala?</b></font>
<ul> <b>Passo 1: </b>Clique no botão <img <?php echo createComIcon('../','bestell.gif','0') ?>> correspondente ao paciente.
                                                                     <p>
<img src="../help/en/img/en_admission_discharge.png" border=0 width=456 height=92><p>
		<b>Passo 2: </b>O formulário de liberação do paciente apareceráT.<br>
		<b>Passo 3: </b>Se você tiver certeza em liberar o paciente, <br>clique no campo da caixa de verificação 
		"<input type="checkbox" name="g" ><span style="background-color:yellow" > Sim, tenho certeza. Libere o paciente.</span>" para
		ativá-la.<br>
       	<b>Passo 4: </b>Clique no botão <input type="button" value="libere"> para liberar o paciente.<p>
       	<b>Note: </b>Se você quiser cancelar, clique no botão <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> e o paciente não será liberado.<br>
</ul>




<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como bloquear uma cama?</b></font>
<ul> <b>Passo 1: </b>Clique no botão <img <?php echo createComIcon('../','plus2.gif','0') ?>>correspondente ao número do quarto e cama.
                                                                     <br>
		<b>Passo 2: </b>Uma janela para a pesquisa do paciente aparecerá.<br>
		<b>Passo 3: </b>Clique no botão "<span style="background-color:yellow" > <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> <font color="#0000ff">Bloqueie esta cama</font> </span>".<br>
		<b>Passo 4: </b>Choose&nbsp;<button>OK</button> quando perguntado por confirmação.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Eu quero apagar um paciente da lista</b></font>
<ul> <b>Nota: </b>Você NÃO PODE simplesmante apagar um paciente da lista. Para remover o paciente você deve liberá-lo regularmente. Para fazer isto,
				siga as instruções de como liberar um paciente da ala conforme anteriormente descrito.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>O que estas barras  <img <?php echo createComIcon('../','s_colorbar.gif','0') ?>> coloridas significam? </b></font>
<ul> <b>Nota: </b>Cada uma desta barras coloridas quando "assinaladas visíveis" sinalizam a disponibilidade de uma informação em particular, uma instrução, uma mudança, ou uma pergunta, etc.<br>
			O significado de cada barra colorida pode ser assinalado em cada ala. 
</ul>
<!-- <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>O que significa este ícone <img <?php echo createComIcon('../','patdata.gif','0') ?>> ? </b></font>
<ul> <b>Nota: </b>Este é o botão de arquivo de dados do paciente. Para exibir o arquivo de dados do paciente, clique neste ícone. Uma janela aparecerá
			mostrando a informação básica do paciente, sua foto de identificação se disponível, e muitas outras opções.<br>
</ul> -->
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>O que significa este ícone <img <?php echo createComIcon('../','bubble2.gif','0') ?>> ? </b></font>
<ul> <b>Nota: </b>Este é o botão de Ler/Escrever notas. Clicando nele Uma janela aparecerá para ler ou escrever notas a respeito do paciente.<br>
			O ícone simples <img <?php echo createComIcon('../','bubble2.gif','0') ?>> significa que não há notas ou observações sobre o paciente. Para escrever uma nota ou observação clique neste ícone.
			O ícone <img <?php echo createComIcon('../','bubble3.gif','0') ?>> significa que há uma nota ou observação armazenada sobre o paciente. Para ler ou anexar notas ou observações
			clique neste ícone.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>O que significa este ícone <img <?php echo createComIcon('../','bestell.gif','0') ?>> ? </b></font>
<ul> <b>Nota: </b>Este é o botão de liberação do paciente. Para liberar um paciente, clique para abrir o formulário de liberação do paciente.<br>
</ul>
<?php elseif(($src=="")&&($x1=="template")) : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
O que eu devo fazer quando <span style="background-color:yellow" >a lista de hoje ainda não foi criada</span>?</b></font>
<ul> <b>Passo 1: </b>Clique no botão <input type="button" value="Mostre a última lista de ocupação"> para encontrara a última lista gravada.
                                                                     <br>
		<b>Passo 2: </b>Quando uma lista gravada é encontrada dentro dos últimos 31 dias, ela será exibida.<br>
		<b>Passo 3: </b>Clique no botão <input type="button" value="Copie esta lista para hoje."><br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Eu não quero ver a última lista de ocupação. Como criar a nova lista?</b></font>
<ul> <b>Passo 1: </b>Clique no botão <img <?php echo createComIcon('../','plus2.gif','0') ?>> correspondente ao número do quarto e cama.
                                                                     <br>
		<b>Passo 2: </b>Uma janela para a pesquisa do paciente aparecerá.<br>
		<b>Passo 3: </b>Primeiro encontre o paciente entrando com uma palavra chave de pesquisa em um dos vários campos de entradas.<br>
		Se você quiser encontrar o paciente...<ul type="disc">
		<li>pelo seu número de paciente, entre com o número no campo <br>"<span style="background-color:yellow" >No. paciente:</span><input type="text" name="t" size=19 maxlength=10 value="22000109">" .
		<li>pelo seu sobrenome, entre seu sobrenome ou as primeiras poucas letras no campo <br>"<span style="background-color:yellow" >Sobrenome:</span><input type="text" name="t" size=19 maxlength=10 value="Schmitt">" .
		<li>pelo seu nome, entre seu nome ou as primeiras poucas letras no campo <br>"<span style="background-color:yellow" >Nome:</span><input type="text" name="t" size=19 maxlength=10 value="Peter">" .
		<li>pela sua data de nascimento, entre sua data de nascimento ou os primeiro poucos números no campo <br>"<span style="background-color:yellow" >Data de nascimento:</span><input type="text" name="t" size=19 maxlength=10 value="10.10.1966">" .
		</ul>
		<b>Passo 4: </b>Clique no botão <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> para iniciar a pesquisa de paciente.<br>
		<b>Passo 5: </b>Se a pesquisa encontrar um paciente ou vários pacientes, uma lista de pacientes será exibida.<br>
		<b>Passo 6: </b>Para selecionar o paciente certo, clique no botão&nbsp;<button><img <?php echo createComIcon('../','post_discussion.gif','0') ?>></button> correspondente a ele.<br>
</ul>
<?php elseif(($src=="getlast")&&($x1=="last")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como copiar a última lista gravada exibida para a lista de ocupação de hoje?</b></font>
<ul> <b>Passo 1: </b>Clique no botão <input type="button" value="Copie esta lista para hoje."> para copiar a última lista gravada.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
A última lista de ocupação está sendo exibida mas eu não quero copiá-la. Como iniciar uma nova lista? </b></font>
<ul> <b>Passo 1: </b>Clique no botão <input type="button" value="Não copie isto! Crie uma nova lista."> para iniciar uma nova lista.
</ul>
<?php elseif($src=="assign") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como assinalar uma cama a um paciente?</b></font>
<ul> <b>Passo 1: </b>Primeiro encontre o paciente entrando com uma palavra chave de pesquisa em um dos vários campos de entradas.<br>
		Se você quiser encontrar o paciente...<ul type="disc">
		<li>pelo seu número de paciente, entre com o número no campo <br>"<span style="background-color:yellow" >No. paciente:</span><input type="text" name="t" size=19 maxlength=10 value="22000109">" .
		<li>pelo seu sobrenome, entre seu sobrenome ou as primeiras poucas letras no campo <br>"<span style="background-color:yellow" >Sobrenome:</span><input type="text" name="t" size=19 maxlength=10 value="Schmitt">" .
		<li>pelo seu nome, entre seu nome ou as primeiras poucas letras no campo <br>"<span style="background-color:yellow" >Nome:</span><input type="text" name="t" size=19 maxlength=10 value="Peter">" .
		<li>pela sua data de nascimento, entre sua data de nascimento ou os primeiro poucos números no campo <br>"<span style="background-color:yellow" >Data de nascimento:</span><input type="text" name="t" size=19 maxlength=10 value="10.10.1966">" .
		</ul>
		<b>Passo 2: </b>Clique no botão <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> para iniciar a pesquisa de paciente.<br>
		<b>Passo 3: </b>Se a pesquisa encontrar um paciente ou vários pacientes, uma lista de pacientes será exibida.<br>
		<b>Passo 4: </b>Para selecionar o paciente certo, clique no botão&nbsp;<button><img <?php echo createComIcon('../','post_discussion.gif','0') ?>></button> correspondente a ele.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como bloquear uma cama?</b></font>
<ul> <b>Passo 1: </b>Clique em "<span style="background-color:yellow" > <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> <font color="#0000ff">Bloqueie esta cama</font> </span>".<br>
		<b>Passo 2: </b>Choose&nbsp;<button>OK</button> quando for perguntado por confirmação.<p>
</ul>
  <b>Nota: </b>Se você quiser cancelar, clique no botão <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.</ul>
  
<?php endif;?>

<?php if(($src!="assign")&&($src!="remarks")&&($src!="discharge")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>O que significa "<span style="background-color:yellow" > <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> <font color="#0000ff">Bloqueado</font> </span>" ? </b></font>
<ul> <b>Nota: </b>Isto significa que a cama está bloqueada e não pode ser assinalada a um paciente. Para desbloqueá-la, clique no botão "<span style="background-color:yellow" ><font color="#0000ff">Bloqueado</font></span>" and choose&nbsp;<button>OK</button>
			quando for perguntado por confirmação.<br>
 <b>Nota: </b>Dependendo da configuração da versão do programa ou configurações de setup, para desfazer o bloqueamento de uma cama pode ser necessário uma senha.</ul>

<?php endif;?>

<a name="pic"></a>
<font face="Verdana, Arial" size=2>
<b>
<p><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000">Como exibir a foto de identificação de um paciente?</font></b><p>
<font face="Verdana, Arial" size=2>
<ul>
<b>Passo:</b> Clique no ícone <img <?php echo createComIcon($root_path,'spf.gif','0'); ?>> ou  <img <?php echo createComIcon($root_path,'spm.gif','0'); ?>> .<p>
<img src="../help/en/img/en_ambulatory_sex.png" border=0 width=434 height=84>
</ul>


</form>

