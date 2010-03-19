<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Como pesquisar nos arquivos de prontuário</b></font>
<form action="#" >
<p><font size=2 face="verdana,arial" >

<?php if($src=="select") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Eu quero atualizar o documento de prontuário exibido</b></font>
<ul> <b>Passo : </b>Clique no botão <input type="button" value="Atualizar dados"> para iniciar a edição do documento.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Eu quero iniciar uma nova pesquisa nos arquivos</b></font>
<ul> <b>Passo : </b>Clique no botão <input type="button" value="Nova pesquisa em arquivo"> iniciar uma nova pesquisa.<br>
</ul>
<?php elseif(($src=="search")&&($x1)) : ?>
<b>Note</b>
<ul><?php if($x1==1) : ?> Se a pesquisa retornar um resultado,  o documento completo será exibido imediatamente.<br>
		Entretanto, se a pesquisa retornar vários resultados, uma lista será mostrada.<br>
		<?php endif;?>
		Para ver a informação para o paciente que você está procurando, clique ou o botão <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> correspondente a ele, ou
		o nome, ou o sobrenome ou a data de admissão.
</ul>
<b>Nota</b>
<ul> Se você quiser iniciar uma nova pesquisa clique no botão <input type="button" value="Nova pesquisa em arquivo">.
</ul>
<?php else : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Eu quero listar todos os documentos de prontuário de um certo departamento</b></font>
<ul> <b>Passo 1: </b>Entre com o código do departamento no campo  "Departamento:". <br>
		<b>Passo 2: </b>Deixe todos os outros campos vazios ou em branco.<br>
		<b>Passo 3: </b>Clique no botão <input type="button" value="Pesquise">  para iniciar a pesquisa.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Eu estou procurando por um certo documento de prontuário de um certo paciente</b></font>
<ul> <b>Passo 1: </b>Entre com a palavra chave no campo correspondente. Pode ser uma palavra completa ou frase ou umas poucas letras de uma palavra de dados pessoais de um paciente. <br>
		<ul><font size=1 color="#000099" >
		<b>Os seguintes campos podem ser preenchidos com uma palavra chave:</b>
		<br> Número do paciente
		<br> Sobrenome
		<br> Nome
		<br> Data de nascimento
		<br> Endereço
		</font>
		</ul><b>Passo 2: </b>Deixe todos os outros campos vazios ou em branco.<br>
		<b>Passo 3: </b>Clique no botão <input type="button" value="Pesquise">  para iniciar a pesquisa.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Eu quero listar todos os documentos de prontuário com uma certa organização de seguros</b></font>
<ul> <b>Passo 1: </b>Entre com a sigla da organização de seguros no campo "Seguro:". <br>
		<b>Passo 2: </b>Deixe todos os outros campos vazios ou em branco.<br>
		<b>Passo 3: </b>Clique no botão <input type="button" value="Pesquise">  para iniciar a pesquisa.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Eu quero listar todos os documentos de prontuário com uma certa informação adicional de seguro</b></font>
<ul> <b>Passo 1: </b>Entre a palavra chave no campo "Informação Extra:". <br>
		<b>Passo 2: </b>Deixe todos os outros campos vazios ou em branco.<br>
		<b>Passo 3: </b>Clique no botão <input type="button" value="Pesquise">  para iniciar a pesquisa.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Eu quero listar todos os documentos de prontuário de pacientes MASCULINOS </b></font>
<ul> <b>Passo 1: </b>Clique no botão de radio "<span style="background-color:yellow" >Sexo <input type="radio" name="r" value="1">masculino</span>". <br>
		<b>Passo 2: </b>Deixe todos os outros campos vazios ou em branco.<br>
		<b>Passo 3: </b>Clique no botão <input type="button" value="Pesquise">  para iniciar a pesquisa.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Eu quero listar todos os documentos de prontuário de pacientes FEMININAS </b></font>
<ul> <b>Passo 1: </b>Clique no botão de radio "<span style="background-color:yellow" ><input type="radio" name="r" value="1">feminina</span>". <br>
		<b>Passo 2: </b>Deixe todos os outros campos vazios ou em branco.<br>
		<b>Passo 3: </b>Clique no botão <input type="button" value="Pesquise">  para iniciar a pesquisa.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Eu quero listar todos os documentos de prontuário de pacientes que receberam conselho médico obrigatório</b></font>
<ul> <b>Passo 1: </b>Clique no botão de radio "<span style="background-color:yellow" >Conselho médico: <input type="radio" name="r" value="1">Sim</span>". <br>
		<b>Passo 2: </b>Deixe todos os outros campos vazios ou em branco.<br>
		<b>Passo 3: </b>Clique no botão <input type="button" value="Pesquise">  para iniciar a pesquisa.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Eu quero listar todos os documentos de prontuário de pacientes que NÃO receberam conselho médico obrigatório</b></font>
<ul> <b>Passo 1: </b>Clique no botão de radio "<span style="background-color:yellow" ><input type="radio" name="r" value="1">Não</span>". <br>
		<b>Passo 2: </b>Deixe todos os outros campos vazios ou em branco.<br>
		<b>Passo 3: </b>Clique no botão <input type="button" value="Pesquise">  para iniciar a pesquisa.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Eu quero listar todos os documentos de prontuário com uma certa palavra chave</b></font>
<ul> <b>Passo 1: </b>Entre a palavra chave no campo correspondente. Pode ser uma palavra completa ou frase ou umas poucas letras de uma palavra. <br>
		<ul><font size=1 color="#000099" >
		<b>Exemplo:</b> Para uma palavra chave de diagnóstico entre no campo "Diagnóstico" .<br>
		<b>Exemplo:</b> Para uma palavra chave de terapia entre no campo "Terapia sugerida" .<br>
		</font>
		</ul><b>Passo 2: </b>Deixe todos os outros campos vazios ou em branco.<br>
		<b>Passo 3: </b>Clique no botão <input type="button" value="Pesquise">  para iniciar a pesquisa.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Eu quero listar todos os documentos de prontuário escritos em uma determinada data</b></font>
<ul> <b>Passo 1: </b>Entre com a data do documento no campo "Documentado em:". <br>
		<ul><font size=1 color="#000099">
		<b>Dica:</b> Entre "T" ou "t" para gerar automaticamente a data de hoje.<br>
		<b>Dica:</b> Entre "Y" ou "y" para gerar automaticamente a data de ontem.<br>
		</font>
		</ul><b>Passo 2: </b>Deixe todos os outros campos vazios ou em branco.<br>
		<b>Passo 3: </b>Clique no botão <input type="button" value="Pesquise">  para iniciar a pesquisa.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Eu quero listar todos os documentos de prontuário escritos por uma certa pessoa</b></font>
<ul> <b>Passo 1: </b>Entre com o nome completo da pessoa ou suas primeiras letras no campo "Documentado por:". <br>
		<b>Passo 2: </b>Deixe todos os outros campos vazios ou em branco.<br>
		<b>Passo 3: </b>Clique no botão <input type="button" value="Pesquise">  para iniciar a pesquisa.<br>
</ul>
<b>Nota</b>
<ul> Você pode combinar várias condições de pesquisa. Por exemplo: Se você quiser listar todos os pacientes MASCULINOS que foram operados em uma
		cirurgia plástica, que receberam o conselho médico obrigatório, e que tem na terapia uma palavra que inicie com "lipo":<p>
		<b>Passo 1: </b>Entre "plop" no campo "Departamento:". <br>
		<b>Passo 2: </b>Clique no botão de radio "<span style="background-color:yellow" >Sexo<input type="radio" name="r" value="1">masculino</span>".<br>
		<b>Passo 3: </b>Clique no botão de radio "<span style="background-color:yellow" >Conselho médico:<input type="radio" name="r" value="1">Sim</span>".<br>
		<b>Passo 4: </b>Entre "lipo" no campo "Terapia:". <br>
		<b>Passo 5: </b>Clique no botão <input type="button" value="Pesquise">  para iniciar a pesquisa.<br>
</ul>
<b>Nota</b>
<ul> Se a pesquisa encontrar um resultado único, o documento completo será exibido imediatamente.<br>
		Entretanto, se a pesquisa retornar vários resultados, uma lista será mostrada.<br>
		Para abrir o documento do paciente que você está procurando, clique ou no botão <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> correspondente a ele, ou
		no nome, sobrenome ou data de admissão.
</ul>

<?php endif;?>
<b>Nota</b>
<ul> Se você decidir cancelar a pesquisa clique no botão <input type="button" value="Fechar">.
</ul>
</form>

