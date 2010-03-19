<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b><?php echo "Patient's Data - $x3" ?></b></font>
<form action="#" >
<p><font size=2 face="verdana,arial" >

<?php if($src=="") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>O que estas barras coloridas significam?</b> <img <?php echo createComIcon('../','colorcodebar3.gif','0') ?> ></font>
<ul> <b>Nota: </b>Quando cada uma destas barras estiver visível, sinalizam a disponibilidade de uma informação particular, uma instrução, uma mundança, ou um pedido, etc.<br>
			O significado das cores pode ser modificado para cada ala. <br>
			A barra com a série cor-de-rosa na direita representa a aproximação do tempo quando uma instrução deve ser carregada.<br>
			Por exemplo: a sexta cor-de-rosa significa a "sexta hora" ou "6:00", a 22a cor da barra significa a "vigésima segunda hora" ou "22:00".
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
O que são os seguintes botões?</b></font>
<ul> <input type="button" value="Gráfico de febre">
	<ul>
		Este irá abrir o gráfico diário de febre do paciente. Você pode entrar, editar, ou deletar febre e dados BP no gráfico.<br>
		Os campos de dados editáveis adicionais:
	<ul type="disc">
	<li>Alergia<br>
	<li>Plano de dieta diário<br>
	<li>Diagnóstico principal/terapia<br>
	<li>Diagnóstico diário/terapia<br>
	<li>Notas, diagnósticos extras<br>
	<li>Tp (Terapia física), Atg (ginástica anti-trombose), etc.<br>
	<li>Anticoagulantes<br>
	<li>Documentação diária para anticoagulantes<br>
	<li>Medicação intravenosa & Bandage dressing<br> ??
	<li>Documentação diária para medicação intravenosa<br>
	<li>Notas<br>
	<li>Medicação (list)<br>
	<li>Documentação diária para medicação e dosagem<br>
	</ul>		
	</ul>
<input type="button" value="Relatório de enfermagem">
	<ul>
		Este irá abrir o formulário de relatório de enfermagem. Você pode documentar sua atividade de enfermagem, sua efetividade, observações, chamados, ou recomendações, etc.
	</ul>
	<input type="button" value="Ordens médicas">
	<ul>
	O médico responsável irá inserir aqui suas instruções, medicação, dosagem, respostas aos chamados de enfermeiros, ou instruções para mudanças, etc.
	</ul>	
	<input type="button" value="Relatórios de diagnóstico">
	<ul>
	Este armazena os relatórios de diagnósticos oriundos de diferentes clínicas de diagnóstico ou departamentos.
	</ul>	
<!-- 	<input type="button" value="Dados básicos">
	<ul>
	Este armazena os dados básicos de pacientes e informações pessoais como nome, primeiro nome, etc. Esta é também a documentação inicial da
	anamnese do paciente ou histórico médico que serve como fundamentação  para o plano de enfermagem individual.
	</ul>	
	<input type="button" value="Plano de enfermagem">
	<ul>
	Este é o plano individual de enfermagem. Você pode criar, editar, ou deletar o plano.
	</ul>	
 -->	
 <input type="button" value="DRG">
	<ul>
	Abre a janela composta de DRG.
	</ul>	
 <input type="button" value="Relatórios de Laboratório">
	<ul>
	Este armazena ambos relatórios médicos e de laboratórios patológicos.
	</ul>	
	<input type="button" value="Fotos">
	<ul>
	Este irá abrir o catálogo de fotos do paciente.
	</ul>	
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Qual é a função desta caixa de seleção  </b>	<select name="d"><option value="">Selecione a requisição de teste diagnóstico</option></select>?
</font>
<ul>       	<b>Nota: </b>Este irá selecionar o formulário de requisição para um teste diagnóstico em particular.<br>
 	<b>Passo 1: </b>Clique no <select name="d"><option value="">Selecione a requisição de teste diagnóstico</option></select>
                                                                     <br>
		<b>Passo 2: </b>Clique na clínica escolhida, departamento, ou teste diagnostico.<br>
		<b>Passo 3: </b>O formulário de requisição será automaticamente aberto.<br>
</ul>
<?php endif;?>

<?php if($src=="labor") : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b>Não há relatório de laboratório disponível no momento. </b></font>
<ul> Clique no botão  <input type="button" value="OK"> para voltar à pasta de dados do paciente.</ul>
<?php else  : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Como fechar a pasta de dados do paciente? </b></font>
<ul> <b>Nota: </b>Se você decidir fechar, clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle">.</ul>

<?php endif;?>

</form>

