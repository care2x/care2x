<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<a name="howto">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b><?php if($x1=="docs") print "Ordens médicas"; else print "Relatório de enfermagem"; ?></b></font>
<form action="#" >
<p><font size=2 face="verdana,arial" >

<?php if($src=="") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como entrar com <?php if($x1=="docs") print "Ordens médicas"; else print "Relatório de enfermagem"; ?>?</b></font>
<ul> 
	<b>Passo 1: </b>Entre com a data no campo "<span style="background-color:yellow" > Data: <input Type="text" name="d" size=10 maxlength=10 value="10.10.2002"> </span>" na coluna "<?php if($x1=="docs") print "Ordens médicas"; else print "Relatório de enfermagem"; ?>" .<br>
		<font color="#000099" size=1><b>Dicas:</b>
		<ul Type=disc>
		<li>Para entrar com a data atual, digite "t" ou "T" (significando HOJE) no campo de data. A data atual aparecerá automaticamente no campo de data.
		<li>Ou clique no botão <img <?php echo createComIcon('../','arrow-t.gif','0') ?>> abaixo do campo. A data atual aparecerá automaticamente no campo de data.
		<li>Para entrar com a data de  ONTEM, digite "y" ou "Y" (significando ONTEM) no campo de data. A data de ONTEM aparecerá automaticamente no campo de data.
		</font>
		</ul>
	<b>Passo 2: </b>Entre com o horário no campo "<span style="background-color:yellow" > Horário: <input Type="text" name="d" size=5 maxlength=5 value="10.35"> </span>" na coluna "<?php if($x1=="docs") print "Ordens médicas"; else print "Relatório de enfermagem"; ?>" .<br>
		<font color="#000099" size=1><b>Dica:</b>
		<ul Type=disc>
		<li>Para entrar  com o horário atual, digite "n" ou "N" (significando AGORA) no campo de horário. O horário atual aparecerá automaticamente no campo de horário.
		<li>Ou clique no botão <img <?php echo createComIcon('../','arrow-t.gif','0') ?>> abaixo do campo de horário. O horário atual aparecerá automaticamente no campo de horário.
		</font>
		</ul>
	<b>Passo 3: </b>Digite <?php if($x1=="docs") print "Ordens médicas"; else print "Relatório de enfermagem"; ?> no campo "<span style="background-color:yellow" > <?php if($x1=="docs") print "Ordens médicas"; else print "Relatório de enfermagem"; ?>: <input Type="text" name="d" size=10 maxlength=10 value="relatório de teste"> </span>" .<br>
		<font color="#000099" size=1><b>Dicas:</b>
		<ul Type=disc>
		<li>Clique na caixa de verificação "<span style="background-color:yellow" > <input Type="caixa de verificação" name="c" value="c"> <img <?php echo createComIcon('../','warn.gif','0') ?>>Coloque este símbolo no início. </span>", se você quiser que o símbolo <img <?php echo createComIcon('../','warn.gif','0') ?>> apareça no início de <?php if($x1=="docs") print "Ordens médicas"; else print "Relatório de enfermagem"; ?>.
		<li>Se você quiser destacar parte da <?php if($x1=="docs") print "diretiva ou"; ?> relatório, clique no ícone <img <?php echo createComIcon('../','hilite-s.gif','0') ?>> antes de digitar a palavra ou frase. Para finalizar o
		destaque, clique no ícone <img <?php echo createComIcon('../','hilite-e.gif','0') ?>> depois de digitar a última letra da parte destacada.
		</font>
		</ul>
	<b>Passo 4: </b>Entre com as iniciais de seu nome no campo "<span style="background-color:yellow" > Sinal: <input Type="text" name="d" size=3 maxlength=3 value="ela"> </span>" .<br>
  		<b>Nota: </b>Se você quiser cancelar, clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.<br>
		<b>Passo 5: </b>clique no botão <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> para salvar a informação.<br>
		<b>Passo 6: </b>Se você terminou, clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> para fechar a janela e voltar ao arquivo de dados do paciente.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como entrar  <?php if($x1=="docs") print "uma pergunta ao médico"; else print "um relatório de efetividade"; ?>?</b></font>
<ul> 
	<b>Passo 1: </b>Entre com a data no campo "<span style="background-color:yellow" > Data: <input Type="text" name="d" size=10 maxlength=10 value="10.10.2002"> </span>" na coluna "<?php if($x1=="docs") print "Perguntas ao médico"; else print "Relatório de efetividade"; ?>" .<br>
		<font color="#000099" size=1><b>Dicas:</b>
		<ul Type=disc>
		<li>Para entrar com a data atual, digite "t" ou "T" (significando HOJE) no campo de data. A data atual aparecerá automaticamente no campo de data.
		<li>Ou clique no botão <img <?php echo createComIcon('../','arrow-t.gif','0') ?>> abaixo do campo. A data atual aparecerá automaticamente no campo de data.
		<li>Para entrar com a data de ONTEM, digite "y" ou "Y" (significando ONTEM) no campo de data. A data de ONTEM aparecerá automaticamente no campo de data.
		</font>
		</ul>
	<b>Passo 2: </b>Digite <?php if($x1=="docs") print "pergunta"; else print "relatório de efetividade"; ?> no campo "<span style="background-color:yellow" > <?php if($x1=="docs") print "Perguntas ao médico"; else print "Relatório de efetividade"; ?>: <input Type="text" name="d" size=10 maxlength=10 value="Relatório de teste"> </span>" .<br>
		<font color="#000099" size=1><b>Dicas:</b>
		<ul Type=disc>
		<li>Clique na caixa de verificação "<span style="background-color:yellow" > <input Type="caixa de verificação" name="c" value="c"> <img <?php echo createComIcon('../','warn.gif','0') ?>>Coloque este símbolo no início. </span>", se você quiser que o símbolo <img <?php echo createComIcon('../','warn.gif','0') ?>> apareça no início de <?php if($x1=="docs") print "pergunta"; else print "Relatório de efetividade"; ?>.
		<li>Se você quiser destacar parte da <?php if($x1=="docs") print "diretiva ou"; ?> relatório, clique no ícone <img <?php echo createComIcon('../','hilite-s.gif','0') ?>> antes de digitar a palavra ou frase. Para terminar o
		destaque, clique no ícone <img <?php echo createComIcon('../','hilite-e.gif','0') ?>> depois de digitar a última letra da parte destacada.
		</font>
		</ul>
	<b>Passo 3: </b>Entre com as iniciais de seu nome no campo "<span style="background-color:yellow" > Sign: <input Type="text" name="d" size=3 maxlength=3 value="ela"> </span>" .<br>
  		<b>Nota: </b>Se você quiser cancelar, clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.<br>
		<b>Passo 4: </b>clique no botão <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> para salvar a informação.<br>
		<b>Passo 5: </b>Se você terminou, clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> para fechar a janela e voltar ao arquivo de dados do paciente.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Nota:</b></font>
<ul> 
	Você pode tambem entrar com ambos <?php if($x1=="docs") print "ordens médicas e perguntas ao médico"; else print "enfermagem e relatório de efetividade"; ?> ao mesmo tempo.</ul>

<?php endif;?>
<?php if($src=="diagnosis") : ?>
<a name="extra"><a name="diag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a></a>
Como exibir um relatório de diagnóstico?</b></font>
<ul> 
  		<b>Nota: </b>Se um relatório de diagnóstico estiver disponível, uma nota breve da data de sua criação e a clínica de diagnóstico ou departamento que o criou será exibida na coluna da esquerda.<p>
  		<b>Nota: </b>O primeiro relatório da lista será exibido imediatamente.<p>
	<b>Passo 1: </b>Clique na breve nota do relatório de diagnóstico que você quer exibir.<br>	
</ul>
<?php endif;?>
<?php if($src=="kg_atg_etc") : ?>
<a name="pt"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Como entrar com informação sobre a terapia física diária (PT), ginástica anti-trombose (Atg), etc.?</b></font>
<ul> 
	<b>Passo 1: </b>Digite a informação no campo <br> "<span style="background-color:yellow" > Por favor entre nova informação aqui: </span>" .<br>
  		<b>Nota: </b>Você tambem pode editar as entradas atuais no campo "<span style="background-color:yellow" > Entradas atuais: </span>" se necessário.<br>
  		<b>Nota: </b>Se você quiser cancelar, clique no botão <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>Passo 2: </b>clique no botão <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> para salvar a informação.<br>
		<b>Passo 3: </b>Se você quiser corrigir quaisquer erros, clique nos dados errados e substitua com os corretos e salve novamente.<br>
		<b>Passo 4: </b>Se você terminou, clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> para fechar a janela e voltar ao gráfico.<br>
		
</ul>
<?php endif;?>
<?php if($src=="fotos") : ?>
<a name="coag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Como visualizar uma foto?</b></font>
<ul> 
	<b>Passo 1: </b>Clique na miniatura no quadro a esquerda. A imagem em tamanho integral será exibida no quadro a direita incluindo a data de tomada e o número da foto.<br>
</ul>
<?php endif;?>
<?php if($src=="anticoag_dailydose") : ?>
<a name="daycoag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Como entrar com informação sobre a aplicação diária de anticoagulantes?</b></font>
<ul> 
	<b>Passo 1: </b>Digite a informação ou de dosagem, ou aplicador  no campo <br> "<span style="background-color:yellow" > Entre a nova informação aqui ou edite as entradas atuais: </span>" .<br>
  		<b>Nota: </b>Se você quiser cancelar, clique no botão <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>Passo 2: </b>clique no botão <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> para salvar a informação.<br>
		<b>Passo 3: </b>Se você quiser corrigir quaisquer erros, clique nos dados errados e substitua com os corretos e salve novamente.<br>
		<b>Passo 4: </b>Se você terminou, clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> para fechar a janela e voltar ao gráfico.<br>
		
</ul>
<?php endif;?>
<?php if($src=="lot_mat_etc") : ?>
<a name="lot"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Como entrar com Notas sobre implantes, no. LOT, no. débito, etc?</b></font>
<ul> 
	<b>Passo 1: </b>Digite informação sobre implantes, no. LOT, no. débito no campo<br> "<span style="background-color:yellow" > Por favor entre a nova informação aqui: </span>" .<br>
  		<b>Nota: </b>Você tambem pode editar as entradas atuais no campo "<span style="background-color:yellow" > Entradas atuais: </span>" se necessário.<br>
  		<b>Nota: </b>Se você quiser cancelar, clique no botão <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>Passo 2: </b>clique no botão <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> para salvar a informação.<br>
		<b>Passo 3: </b>Se você quiser corrigir quaisquer erros, clique nos dados errados e substitua com os corretos e salve novamente.<br>
		<b>Passo 4: </b>Se você terminou, clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> para fechar a janela e voltar ao gráfico.<br>
		
</ul>
<?php endif;?>
<?php if($src=="medication") : ?>
<a name="med"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Como entrar com a medicação e plano de dosagem?</b></font>
<ul> 
	<b>Passo 1: </b>Digite a medicação na coluna da esquerda.<br> 
	<b>Passo 2: </b>Digite o plano de dosagem na coluna do meio.<br> 
	<b>Passo 3: </b>Clique no botão de radio do código de cores para a medicação se necessário.<br> 
	<ul Type=disc>
		<li>Branco para normal ou padrão.
		<li><span style="background-color:#00ff00" >Verde</span> para antibióticos e seus derivados.
		<li><span style="background-color:yellow" >Amarelo</span> para remédios dialíticos.
		<li><span style="background-color:#0099ff" >Azul</span> para remédios hemolíticos (coagulante ou anticoagulante).
		<li><span style="background-color:#ff0000" >Vermelho</span> para remédios aplicados intravenosos.
	</ul>
  	<b>Nota: </b>Você tambem pode editar as entradas atuais se necessário.<br>
	<b>Passo 4: </b>Entre seu nome no campo "<span style="background-color:yellow" > Enfermeiro: </span>" .<br> 
  		<b>Nota: </b>Se você quiser cancelar, clique no botão <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>Passo 5: </b>clique no botão <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> para salvar o plano de medicação.<br>
		<b>Passo 6: </b>Se você quiser corrigir quaisquer erros, clique nos dados errados e substitua com os corretos e salve novamente.<br>
		<b>Passo 7: </b>Se você terminou, clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> para fechar a janela e voltar ao gráfico.<br>
		
</ul>
<?php endif;?>
<?php if($src=="medication_dailydose") : ?>
	<?php if($x2) : ?>

<a name="daymed"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Como entrar com a informação de applicação de medicação diária e dosagem?</b></font>
<ul> 
	<b>Passo 1: </b>Clique no campo de entrada correspondente medicação escolhida.<br>
	<b>Passo 2: </b>Digite ou a dosagem, ou a  informação do aplicador,ou símbolos de início/fim no campo.<br>
  		<b>Nota: </b>Se você quiser cancelar, clique no botão <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>Passo 3: </b>Se você tiver várias entradas, entre com todas elas antes de salvar.<br>
		<b>Passo 4: </b>clique no botão <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> para salvar a informação.<br>
		<b>Passo 5: </b>Se você quiser corrigir quaisquer erros, clique nos dados errados e substitua com os corretos e salve novamente.<br>
		<b>Passo 6: </b>Se você terminou, clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> para fechar a janela e voltar ao gráfico.<br>
		
</ul>
	<?php else : ?>
<a name="daymed"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Aparece "Não há medicação ainda". O que devo fazer?</b></font>
<ul> 
		<b>Passo 1: </b>clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> para fechar a janela e voltar ao gráfico.<br>
	<b>Passo 2: </b>Clique em "<span style="background-color:yellow" > Medicação </span>".<br>
	<b>Passo 3: </b>Uma janela aparecerá mostrando os campos de entrada para a medicação e plano de dosagem.<br>
	<b>Passo 4: </b>Digite a medicação na coluna da esquerda.<br> 
	<b>Passo 5: </b>Digite o plano de dosagem na coluna do meio.<br> 
	<b>Passo 6: </b>Clique no botão de radio do código de cores para a medicação se necessário.<br> 
	<ul Type=disc>
		<li>Branco para normal ou padrão.
		<li><span style="background-color:#00ff00" >Verde</span> para antibióticos e seus derivados.
		<li><span style="background-color:yellow" >Amarelo</span> para remédios dialíticos.
		<li><span style="background-color:#0099ff" >Azul</span> ara remédios hemolíticos (coagulante ou anticoagulante).
		<li><span style="background-color:#ff0000" >Vermelho</span> para remédios aplicados intravenosos.
	</ul>
  	<b>Nota: </b>Você tambem pode editar as entradas atuais <br>se necessário.<br>
	<b>Passo 7: </b>Entre seu nome no campo "<span style="background-color:yellow" > Enfermeiro: </span>" .<br> 
  		<b>Nota: </b>Se você quiser cancelar, clique no botão <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>Passo 8: </b>clique no botão <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> para salvar o plano de medicação.<br>
		<b>Passo 9: </b>Se você quiser corrigir quaisquer erros, clique nos dados errados e substitua com os corretos e salve novamente.<br>
		<b>Passo 10: </b>Se você terminou, clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> para fechar a janela e voltar ao gráfico.<br>
</ul>
	<?php endif;?>
<?php endif;?>
<?php if($src=="iv_needle") : ?>
<a name="iv"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Como entrar com a informação diária de aplicação e dosagem de medicação intravenosa?</b></font>
<ul> 
	<b>Passo 1: </b>Digite ou a dosagem, a informação do aplicador, ou símbolos de início/fim no campo "<span style="background-color:yellow" > Entre com a nova informação aqui ou edite o campo das Entradas atuais: </span>" .<br>
  		<b>Nota: </b>Se você quiser cancelar, clique no botão <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>Passo 2: </b>clique no botão <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> para salvar a informação.<br>
		<b>Passo 3: </b>Se você quiser corrigir quaisquer erros, clique nos dados errados e substitua com os corretos e salve novamente.<br>
		<b>Passo 4: </b>Se você terminou, clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> para fechar a janela e voltar ao gráfico.<br>
		
</ul>

<?php endif;?>

</form>

