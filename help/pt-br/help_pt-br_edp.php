<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
EDP - 
<?php
	if($x1=='edit') $x1='update';
	switch($src)
	{
	case "access": 
		switch($x1)
						{
							case "": print "Criando direito de acesso";
												break;
							case "save": print "Direito de novo acesso salvo";
												break;
							case "list": print "Direitos de acesso existentes";
												break;
							case "update": print "Editando um direito de acesso existente";
												break;
							case "lock":  if($x2=="0") print "Bloqueando"; else print "Desbloqueando"; print  " um direito existente";
												break;
							case "delete": print "Apagando um direito de acesso";
												break;
						}
						break;
	}


 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >

	

<?php if($src=="access") : ?>
	<?php if($x1=="") : ?>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como criar permissões de acesso para um colaborador do hospital ?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Primeiro encontre o colaborador. clique no botão <input type="button" value="Encontre um colaborador"> .<p>
 	<b>Passo 2: </b>Uma página de pesquisa aparecerá. Siga as intruções de ajuda suplementar em como pesquisar pelo colaborador.<p>
</ul>

		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como criar um novo direito de acesso?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Entre com o nome completo da pessoa, ou departamento, ou clínica, etc no campo "<span style="background-color:yellow" > Nome </span>" .<br>
 	<b>Passo 2: </b>Entre com o nome de usuário no campo "<span style="background-color:yellow" > nome de login de usuário </span>" .<p>
	<b>Nota:</b> A tecla de Espaço não é permitida para o nome de usuário.<p>
 	<b>Passo 3: </b>Entre com a senha para o nome do usuário no campo "<span style="background-color:yellow" > Senha </span>" .<p>
 	<b>Passo 4: </b>Verifique as areas tem permissão de acessar na "árvore" de permissões.<p>
</ul>

	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Eu terminei de entrar com todas as informações relevantes. Como salvo?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no botão <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> .<br>
</ul>
	<?php endif;?>	
	<?php if($x1=="save") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
O novo direito de acesso está salvo agora. Como criar outro direito de acesso?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no botão <input type="button" value="OK"> .<br>
 	<b>Passo 2: </b>O formulário para entrada de dados aparecerá.<br>
 	<b>Passo 3: </b>Para ver mais instruções de como criar um direito de acesso, clique no botão "Ajuda" .<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Eu quero ver a lista dos direitos de acesso existentes. Como é que eu faço?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no botão <input type="button" value="Liste os direitos de acesso atuais">.<br>
 	<b>Passo 2: </b>Os direitos de acesso atuais serão listados<br>
</ul>
	
	<?php endif;?>	
	<?php if($x1=="list") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
O que significam os botões <img <?php echo createComIcon('../','padlock.gif','0','absmiddle') ?>> e <img <?php echo createComIcon('../','arrow-gr.gif','0','absmiddle') ?>> ?</b>
</font>
<ul>       	
 	<img <?php echo createComIcon('../','padlock.gif','0','absmiddle') ?>> = O direito de acesso do usuário está bloqueado ou "congelado". Ele não pode entrar nas áreas marcadas como acessíveis.<br>
 	<img <?php echo createComIcon('../','arrow-gr.gif','0','absmiddle') ?>> = O direito de acesso do usuário não está bloqueado . Ele pode entrar nas áreas marcadas como acessíveis.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
O que significam as opções "C","L", e "D", ou "U" ?</b>
</font>
<ul>       	
 	<b>C: </b> = Altera ou edita os dados de acesso do usuário.<br>
 	<b>L: </b> = Bloqueia os direitos de acesso do usuário.<br>
 	<b>D: </b> = Apaga os direitos de acesso do usuário.<br>
 	<b>U: </b> = Libera os direitos de acesso do usuário (se estiver bloqueado).<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como mudar ou editar os dados do direito de acesso do usuário?</b>
</font>
<ul>       	
 	Clique na opção "<span style="background-color:yellow" > C </span>" correspondente ao usuário.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como bloquear os direitos de acesso do usuário?</b>
</font>
<ul>       	
 	Clique na opção "<span style="background-color:yellow" > L </span>" correspondente ao usuário.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como liberar os direitos de acesso do usuário? (se estiver bloqueado)</b>
</font>
<ul>       	
 	Clique na opção "<span style="background-color:yellow" > U </span>" correspondente ao usuário.<br>
</ul>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como apagar um direito de acesso?</b>
</font>
<ul>       	
 	Clique na opção "<span style="background-color:yellow" > D </span>" correspondente ao usuário.<br>
</ul>

	<?php endif;?>	
	
	<?php if($x1=="update") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como editar um direito de acesso?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Edite a informação.<br>
 	<b>Passo 2: </b>Clique no botão <img <?php echo createLDImgSrc('../','savedisc.gif','0','absmiddle') ?>>  .<br>
</ul>
	<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b>
Nota:</b>
</font>
<ul>       	
 	Se você decidir não editar, clique no botão <img <?php echo createLDImgSrc('../','cancel.gif','0','absmiddle') ?>>  .<br>
</ul>
	
	<?php endif;?>		
	<?php if($x1=="delete") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como deletar um direito de acesso?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Se você tem certeza de que quer apagar o direito de acesso,<br>
	 clique no botão <input type="button" value="Sim, tenho certeza absoluta. Apague o direito de acesso.">.<br>
</ul>
	<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b>
Nota:</b>
</font>
<ul>       	
 	Se você decidir não apagar clique no botão <input type="button" value="Não. Volte.">.<br>
</ul>
	
	<?php endif;?>		
	
	<?php if($x1=="lock") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como <?php if($x2=="0") print "bloquear"; else print "liberar"; ?> um direito de acesso?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Se você tem certeza de que quer <?php if($x2=="0") print "bloquear"; else print "liberar"; ?> o direito de acesso,<br>
	 clique no botão <input type="button" value="Sim, tenho certeza.">.<br>
</ul>
	<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b>
Note:</b>
</font>
<ul>       	
 	Se você decidir não <?php if($x2=="0") print "bloquear"; else print "lliberar"; ?> clique no botão <input type="button" value="Não. Volte.">.<br>
</ul>
	
	<?php endif;?>		
<?php endif;?>	

	</form>

