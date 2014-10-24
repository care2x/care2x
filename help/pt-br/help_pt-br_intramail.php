<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
Email - Intranet 
<?php
	switch($src)
	{
	case "pass": switch($x1)
						{
							case "": print "Log in";
												break;
							case "1": print "Registrando um novo usuário";
												break;
						}
						break;
	case "mail": switch($x1)
						{
							case "compose": print "Criar uma nova mensagem";
												break;
							case "listmail": print "Lista de mensagens";
												break;
							case "sendmail": print "Mensagem enviada";
												break;
						}
						break;
	case "read": print "Ler mensagens";
						break;
	case "endereço": print "Livro de endereços";
						break;

	}


 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >

	

<?php if($src=="pass") : ?>
<?php if($x1=="") : ?>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como fazer o log in?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Entre com o seu endereço de email da intranet (sem a parte @xxxxxx ) no campo <nobr>"<span style="background-color:yellow" > Seu endereço de email: </span>"</nobr> .<br>
 	<b>Passo 2: </b>Selecione a parte de domínio no campo <nobr>"<span style="background-color:yellow" > @<select name="d">
                                                                                          	<option value="Teste Domínio 1"> Teste Domínio 1</option>
                                                                                          	<option value="Teste Domínio 2"> Teste Domínio 2</option>
                                                                                          </select>
                                                                                           </span>"</nobr> .<br>
 	<b>Passo 3: </b>Clique no botão <input type="button" value="Login"> para fazer o log in.<br>
</ul>

	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Eu ainda não tenho endereço. Como consigo um endereço?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no link "<span style="background-color:yellow" > Novo usuário pode se registrar aqui. <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0') ?>> </span>" para abrir o 
	formulário de registro.<br>
 	<b>Passo 2: </b>Para maiores instruções, clique no botão "Ajuda" após o formulário de registro ter sido mostrado.<br>
</ul>
	<?php endif;?>		
	<?php if($x1=="1") : ?>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como se registrar?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Entre com o sobrenome e nome no campo "<span style="background-color:yellow" > Sobrenome, nome: </span>" .<br>
 	<b>Passo 2: </b>Entre com o seu endereço de email de sua escolha no campo "<span style="background-color:yellow" > Escolha de endereço de email: </span>" .<p>
 	<b>Passo 3: </b>Selecione a parte de domínio  no campo  <nobr>"<span style="background-color:yellow" > @<select name="d">
                                                                                          	<option value="Teste Domínio 1"> Teste Domínio 1</option>
                                                                                          	<option value="Teste Domínio 2"> Teste Domínio 2</option>
                                                                                          </select>
                                                                                           </span>"</nobr> .<br>
 	<b>Passo 4: </b>Entre com o alias de sua escolha no campo "<span style="background-color:yellow" > Alias: </span>" .<p>
 	<b>Passo 5: </b>Entre com a senha de sua escolha no campo "<span style="background-color:yellow" > Senha escolhida: </span>" .<br>
 	<b>Passo 6: </b>Entre novamente com a senha no campo "<span style="background-color:yellow" > Entre novamente com a senha: </span>" .<br>
 	<b>Passo 7: </b>Clique no botão <input type="button" value="Registre"> para se registrar.<br>
</ul>

	<?php endif;?>		
<?php endif;?>	

<?php if($src=="mail") : ?>
<?php if($x1=="listmail") : ?>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como abrir uma mensagem?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique ou no destinatário da mensagem, ou em quem enviou, ou assunto, ou data, ou nos ícones <img src="../img/c-mail.gif" border=0 align="absmiddle"> ou <img src="../img/o-mail.gif" border=0 align="absmiddle">.<br>
</ul>

	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
O que os ícones <img src="../img/c-mail.gif" border=0 align="absmiddle"> e <img src="../img/o-mail.gif" border=0 align="absmiddle"> significam?</b>
</font>
<ul>       	
 	<img src="../img/c-mail.gif" border=0 align="absmiddle"> = Mensagem ainda não foi aberta ou lida. <br>
 	<img src="../img/o-mail.gif" border=0 align="absmiddle"> = Mensagem já foi aberta ou lida. <br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como apagar uma mensagem?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Marque na caixa de verificação da mensagem <input type="checkbox" name="a" value="s" verificado> para selecioná-la.<br>
 	<b>Passo 2: </b>Clique no botão <input type="button" value="Apagar"> .<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como ir de um arquivo para outro?</b>
</font>
<ul>       	
 	<b>Passo 1: </b> Clique no botão com o nome do arquivo.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como compor ou escrever uma nova mensagem?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no link "<span style="background-color:yellow" > Novo Email </span>".<br>
</ul>
	<?php endif;?>		
	<?php if($x1=="compose") : ?>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como escrever uma nova mensagem?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Entre com o endereço de email do destinatário no campo "<span style="background-color:yellow" > Destinatário: </span>" .<br>
 	<b>Passo 2: </b>Se você quiser enviar uma cópia para alguem entre com seu endereço de email no campo "<span style="background-color:yellow" > (CC) </span>" .<br>
 	<b>Passo 3: </b>Se você quiser enviar uma cópia para alguem (sem mostrar o endereço) entre seu endereço de email no campo "<span style="background-color:yellow" > (BCC) </span>" .<br>
 	<b>Passo 4: </b>Entre com o assunto de sua mensagem no campo "<span style="background-color:yellow" > Assunto: </span>" .<br>
 	<b>Passo 5: </b>Digite sua mensagem no campo de entrada de texto.<br>
 	<b>Passo 6: </b>Clique no botão <input type="button" value="Enviar"> para enviar a mensagem.<br>
</ul>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Eu planejo salvar a mensagem como rascunho. Como fazer isto?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Digite sua mensagem no campo de entrada de text.<br>
 	<b>Passo 2: </b>Depois de digitar sua mensagem, clique no botão <input type="button" value="Salvar como rascunho"> .<br>
</ul>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como usar endereços de email diretamente de meu livro de endereços?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no botão <input type="button" value="Mostre todos"> "Endereço rápido".<br>
 	<b>Passo 2: </b>Uma pequena janela se abrirá com o livro de endereços.<br>
 	<b>Passo 3: </b>Clique no botão do radio de um endereço correspondente ao campo para onde deve ser copiado.<p>
<ul>   
		Clique "To<input type="radio" name="t" value="a">" para copiar o endereço para o campo "Destinatário" .<br>
		Clique "CC<input type="radio" name="t" value="a">" para copiar o endereço para o campo "CC" .<br>
		Clique "BCC<input type="radio" name="t" value="a">" para copiar o endereço para o campo "BCC" .<p>
</ul>
        <img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <b>Nota:</b>  Se você quiser 
		desmarcar um botão do radio, clique no ícone do botão correspondente <img src="../img/redpfeil.gif" border=0> .<br> 	
        <img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <b>Nota:</b> Você pode selecionar vários endereços
		ao mesmo tempo. 	<p>
 	<b>Passo 4: </b>Clique no botão <input type="button" value="Assumir"> para copiar os endereços selecionados para a mensagem que está sendo composta.<br>
 	<b>Passo 5: </b>Clique no botão "<span style="background-color:yellow" > <img src="../img/l_arrowGrnSm.gif" border=0> Close </span>"
	 para fechar a janela aberta.<br>
</ul>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como é que funciona o "Endereço rápido" ?</b>
</font>
<ul>       	
 	<b>Nota: </b>Se você tem endereços de email armazenados em  "Endereço rápido" , oa cinco primeiros serão listados no "Endereço rápido".<p>
 	<b>Passo 1: </b>Clique primeiro no campo onde você quer por o endereço (por exemplo: "Destinatário" ou "CC" ou "BCC") .<br>
 	<b>Passo 2: </b>Clique no botão Endereço na lista do "Endereço rápido" . Este endereço será copiado para o campo de entrada que você clicou previamente.<br>
</ul>

	<?php endif;?>		
<?php if(($x1=="sendmail")&&($x3=="1")) : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como compor ou escrever uma nova mensagem?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no link do botão  "<span style="background-color:yellow" > Novo Email </span>".<br>
</ul>
	<?php endif;?>		
<?php endif;?>	


<?php if($src=="read") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como imprimir a mensagem?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no link do botão  "<span style="background-color:yellow" > Versão de impressão <img src="../img/bul_arrowGrnSm.gif" border=0></span>".<br>
 	<b>Passo 2: </b>Uma janela abrirá mostrando uma versão de impressão da mensagem.<br>
 	<b>Passo 3: </b>Clique no botão opção "<span style="background-color:yellow" > < Print > </span>" para imprimir.<br>
 	<b>Passo 4: </b>O menu de impressoras do Windows© aparecerá. Clique no botão "OK".<br>
 	<b>Passo 5: </b>Para fechar a janela da versão de impressão, clique no botão de opção "<span style="background-color:yellow" > < Close > </span>".<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como re-enviar a mensagem?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no botão <input type="button" value="Re-enviar"> .<br>
 	<b>Passo 2: </b>Edite os endereços da mensagem se necessário.<br>
 	<b>Passo 3: </b>Clique no botão <input type="button" value="Enviar"> para finalmente re-enviar a mensagem.
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como encaminhar uma mensagem?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no botão <input type="button" value="Encaminhar"> .<br>
 	<b>Passo 2: </b>Entre com o endereço do destinatário.<br>
 	<b>Passo 3: </b>Clique no botão <input type="button" value="Enviar"> para finalmente encaminhar a mensagem.
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como apagar uma mensagem?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no botão <input type="button" value="Apagar"> .<br>
 	<b>Passo 2: </b>Você será perguntado se você realmente quer apagar a mensagem.<br>
 	<b>Passo 3: </b>Clique no botão <input type="button" value="OK"> para finalmente apagar a mensagem.<p>
	<b>Note:</b> Mensagens que são apagadas do arquivo da "Caixa de entrada"  ficam temporariamente armazenados no arquivo "Reciclar" .
</ul>
	<?php endif;?>		
	
<?php if($src=="endereço") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como acrescentar um endereço de email ao livro de endereços?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique no botão <input type="button" value="Acrescentar novo endereço de email"> .<br>
 	<b>Passo 2: </b>Um formulário de netrada aparecerá. Entre com o nome  no campo "<span style="background-color:yellow" > Sobrenome, Nome: </span>" .<br>
 	<b>Passo 3: </b>Entre com o alias ou apelido no campo "<span style="background-color:yellow" > Alias/Apelido: </span>" .<br>
 	<b>Passo 4: </b>Entre com o endereço de email no campo "<span style="background-color:yellow" > Endereço de Email: </span>" .<br>
 	<b>Passo 5: </b>Selecione a parte do domínio no campo  <nobr>"<span style="background-color:yellow" > @<select name="d">
                                                                                          	<option value="Teste de Domínio 1"> Teste de Domínio 1</option>
                                                                                          	<option value="Teste de Domínio 2"> Teste de Domínio 2</option>
                                                                                          </select>
                                                                                           </span>"</nobr> .<br>
 	<b>Passo 6: </b>Clique no botão <input type="button" value="Salvar"> .<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como remover um endereço de email do livro de endereços?</b>
</font>
<ul>       	
 	<b>Passo 1: </b>Clique na caixa de verificação <input type="checkbox" name="d" value="s" verificado> para selecionar o endereço que vai ser removido.<br>
 	<b>Passo 2: </b>Clique no botão <input type="button" value="Apagar"> .<br>
 	<b>Passo 3: </b>Você será perguntado se você realmente quer apagar o endereço.<br>
 	<b>Passo 4: </b>Clique no botão <input type="button" value="OK"> para finalmente remover o endereço.<p>
</ul>
	<?php endif;?>		

	<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b>
Nota:</b>
</font>
<ul>       	
 	A função de emails e endereços da intranet funcionam SOMENTE DENTRO do sistema da intranet e não podem ser usados para a internet.<br>
</ul>
	</form>

