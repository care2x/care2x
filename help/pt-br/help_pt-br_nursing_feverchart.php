<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<a name="howto">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b><?php echo "$x3" ?></b></font>
<form action="#" >
<p><font size=2 face="verdana,arial" >

<?php if($src=="main") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como ...?</b></font>
<ul type="disc"> 
		<li><a href="#cbp">entrar com a temperatura ou pressão sanguinea.</a>
		<li><a href="#movedate">mover ou mudar a data do gráfico.</a>
		<li><a href="#diet">entrar com um plano de dieta.</a>
		<li><a href="#allergy">entrar com informação de alergia.</a>
		<li><a href="#diag">entrar o diagnóstico principal ou plano de terapia.</a>
		<li><a href="#daydiag">entrar a informação de diagnóstico diário o plano de terapia.</a>
		<li><a href="#extra">entrar notas, diagnósticos extra, etc.</a>
		<li><a href="#pt">entrar informação sobre terapia física diária (Pt), ginástica anti-trombose (ATg), etc.</a>
		<li><a href="#coag">entrar anticoagulantes.</a>
		<li><a href="#daycoag">entrar com informação sobre a aplicação diária de anticoagulantes.</a>
		<li><a href="#lot">entrar notas sobre implantes, no.LOT , no. de débito, etc.</a>
		<li><a href="#med">entrar com o plano de medicação e dosagem.</a>
		<li><a href="#daymed">entrar com informação sobre aplicação e dosagem diária de medicação.</a>
		<li><a href="#iv">entrar com informação sobre o plano de aplicação e dosagem diária de medicação intravenosa.</a>
</ul>		
<hr>
<a name="cbp"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Como entrar com a temperatura ou pressão sanguinea?</b></font>
<ul> <b>Passo 1: </b>Clique na área de gráfico correspondente a data escolhida.<br>
		<b>Passo 2: </b>Uma janela para entrar com os dados de temperatura e/ou pressão sanguinea aparecerá.<br>
		<b>Passo 3: </b>Entre com os dados e horário.<br>
		<ul type="disc">
		<li>Entre o horário e a temperatura na coluna da direita "<font color="#0000ff">temperatura</font>" .<br>
		Exemplo: <input type="text" name="t" size=5 maxlength=5 value="12.35">&nbsp;&nbsp;<input type="text" name="u" size=8 maxlength=8 value="37.3">
		<li>Entre com o horário e pressão sanguinea na coluna da esquerda "<font color="#cc0000">Pressão sanguinea</font>" .<br>
		Exemplo: <input type="text" name="v" size=5 maxlength=5 value="10.05">&nbsp;&nbsp;<input type="text" name="w" size=8 maxlength=8 value="128/85">
		</ul>		
		<ul >
		<font color="#000099" size=1><b>Dica:</b> Para entrar com o horário atual, digite "n" ou "N" (significando AGORA) no campo de horário. O horário atual exato
		aparecerá automaticamente naquele campo.</font>
		</ul>
		<b>Passo 4: </b>Se você tiver vários dados, entre com todos eles antes de salvar.<br>
		<b>Passo 5: </b>Clique no botão <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> para salvar os dados recem entrados.<br>
		<b>Passo 6: </b>Se você quiser corrigir quaisquer erros, clique nos dados errados e substitua com os corretos.<br>
		<b>Passo 5: </b>Se voce terminou, clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> para fechar a janela e voltar ao gráfico.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Voltar a "Como ...?"</a></font>
</ul>
<a name="movedate"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Como mover ou mudar a data do gráfico?</b></font>
<ul> 
	<li><font color="#660000"><b>Para mover a data um dia para trás:</b></font><br>
	<b>Passo 1: </b>Clique no ícone da data <img <?php echo createComIcon('../','l_arrowgrnsm.gif','0') ?>> na coluna <span style="background-color:yellow" >mais à esquerda</span> do gráfico.<p>
	<li><font color="#660000"><b>Para mover a data um dia para frente:</b></font><br>
	<b>Passo 1: </b>Clique no ícone da data <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0') ?>> na coluna <span style="background-color:yellow" >mais à direita</span> do gráfico.
                                                                     <p>
	<li><font color="#660000"><b>Para marcar diretamente a data de início do gráfico:</b></font><br>
	<b>Passo 1: </b>Clique no <span style="background-color:yellow" >botão da direita do mouse</span> no ícone <img <?php echo createComIcon('../','l_arrowgrnsm.gif','0') ?>> na coluna de data <span style="background-color:yellow" >mais à esquerda</span> do gráfico.<br>
	<b>Passo 2: </b>Clique <input type="button" value="OK"> quando perguntado por confirmação.<br>
	<b>Passo 3: </b>Uma pequena janela aparecerá mostrando os campos de seleção para a data de início.<br>
	<b>Passo 4: </b>Selecione o dia, mes, e ano.<br>
	<b>Passo 5: </b>Clique no botão <input type="button" value="OK"> para permitir a mudança.<br>
	A pequena janela fechará automaticamente e o gráfico se ajustará à mudança de data.<p>
	
	<li><font color="#660000"><b>Para marcar diretamente a data de fim do gráfico:</b></font><br>
	<b>Passo 1: </b>Clique no <span style="background-color:yellow" >botão da direita do mouse</span> no ícone <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0') ?>> na coluna de data <span style="background-color:yellow" >mais à direita</span> do gráfico.<br>
	<b>Passo 2: </b>Clique <input type="button" value="OK"> quando perguntado por confirmação.<br>
	<b>Passo 3: </b>Uma pequena janela aparecerá mostrando os campos de seleção para a data de fim.<br>
	<b>Passo 4: </b>Selecione o dia, mes, e ano.<br>
	<b>Passo 5: </b>Clique no botão <input type="button" value="OK"> para permitir a mudança.<br>
	A pequena janela fechará automaticamente e o gráfico se ajustará à mudança de data.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Voltar a "Como ...?"</a></font>
</ul>
<a name="diet"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Como entrar com um plano de dieta?</b></font>
<ul> <b>Passo 1: </b>Clique no "<span style="background-color:yellow" > Plano de dieta </span>" correspondente à data escolhida.<br>
		<b>Passo 2: </b>A janela para entrar ou editar o plano de dieta aparecerá.<br>
		<b>Passo 3: </b>Entre com o plano de dieta.<br>
		<b>Passo 4: </b>Clique no botão <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> para salvar o novo plano de dieta que foi entrado.<br>
  		<b>Nota: </b>Se você quiser cancelar, clique no botão <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>Passo 5: </b>Se você quiser corrigir quaisquer erros, clique nos dados errados e substitua com os corretos.<br>
		<b>Passo 6: </b>Se você terminou, clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> para fechar a janela e voltar ao gráfico.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Voltar a  "Como ...?"</a></font>
</ul>
<a name="allergy"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Como entrar com informação de alergia?</b></font>
<ul> 
	<b>Passo 1: </b>Clique no ícone (clip) <img <?php echo createComIcon('../','clip.gif','0') ?>>  na "<span style="background-color:yellow" > Alergia <img <?php echo createComIcon('../','clip.gif','0') ?>> </span>".<br>
	<b>Passo 2: </b>Uma janela aparecerá mostrando o campo de entrada para informação de alergia.<br>
	<b>Passo 3: </b>Digite a informação de alergia ou CAVE no campo<br> "<span style="background-color:yellow" > Por favor entre nova informação aqui: </span>" .<br>
  		<b>Nota: </b>Você tambem pode editar as entradas atuais <br>no campo "<span style="background-color:yellow" > Entradas atuais: </span>" se necessário.<br>
  		<b>Nota: </b>Se você quiser cancelar, clique no botão <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>Passo 4: </b>Clique no botão <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> para salvar a informação.<br>
		<b>Passo 5: </b>Se você quiser corrigir quaisquer erros, clique nos dados errados e substitua com os corretos e salve novamente.<br>
		<b>Passo 6: </b>Se você terminou, clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> para fechar a janela e voltar ao gráfico.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Voltar a  "Como ...?"</a></font>
</ul>

<a name="diag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Como entrar com o diagnóstico principal e/ou terapia?</b></font>
<ul> 
	<b>Passo 1: </b>Clique no ícone (clip) <img <?php echo createComIcon('../','clip.gif','0') ?>> no campo "<span style="background-color:yellow" > Diagnóstico/Terapia <img <?php echo createComIcon('../','clip.gif','0') ?>> </span>".<br>
	<b>Passo 2: </b>Uma janela aparecerá mostrando o campo de entrada para informação sobre diagnóstico/terapia.<br>
	<b>Passo 3: </b>Digite a informação de diagnóstico ou terapia no campo<br> "<span style="background-color:yellow" > Por favor entre nova informação aqui: </span>" .<br>
  		<b>Nota: </b>Você tambem pode editar as entradas atuais <br>no campo "<span style="background-color:yellow" > Entradas atuais: </span>" se necessário.<br>
  		<b>Nota: </b>Se você quiser cancelar, clique no botão <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>Passo 4: </b>Clique no botão <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> para salvar a informação.<br>
		<b>Passo 5: </b>Se você quiser corrigir quaisquer erros, clique nos dados errados e substitua com os corretos e salve novamente.<br>
		<b>Passo 6: </b>Se você terminou, clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> para fechar a janela e voltar ao gráfico.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Voltar a  "Como ...?"</a></font>
</ul>
<a name="daydiag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Como entrar com informação diária de diagnóstico ou plano de terapia?</b></font>
<ul> 
	<b>Passo 1: </b>Clique ou na coluna vazia ou no diagnóstico/terapia diária existente, correspondente à data escolhida.<br>
	<b>Passo 2: </b>Uma janela aparecerá mostrando o campo de entrada para a informação de diagnóstico/terapia  para a data escolhida.<br>
	<b>Passo 3: </b>Digite a informação de diagnóstico ou terapia  no campo<br> "<span style="background-color:yellow" > Por favor entre nova informação aqui: </span>" .<br>
  		<b>Nota: </b>Voce tambem pode editar as entradas atuais <br>no campo "<span style="background-color:yellow" > Entradas atuais: </span>" se necessário.<br>
  		<b>Nota: </b>Se você quiser cancelar, clique no botão <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>Passo 4: </b>Clique no botão <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> para salvar the informação.<br>
		<b>Passo 5: </b>Se você quiser corrigir quaisquer erros, clique nos dados errados e substitua com os corretos e salve novamente.<br>
		<b>Passo 6: </b>Se você terminou, clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> para fechar a janela e voltar ao gráfico.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Voltar a  "Como ...?"</a></font>
</ul>
<a name="extra"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Como entrar com notas, diagnósticos extra?</b></font>
<ul> 
	<b>Passo 1: </b>Clique no ícone (clip) <img <?php echo createComIcon('../','clip.gif','0') ?>> em "<span style="background-color:yellow" > Notas, diagnóstico extra <img <?php echo createComIcon('../','clip.gif','0') ?>> </span>".<br>
	<b>Passo 2: </b>Uma janela aparecerá mostrando o campo de entrada para notas e diagnóstico extra.<br>
	<b>Passo 3: </b>Digite as notas ou diagnóstico extra no campo <br> "<span style="background-color:yellow" > Por favor entre nova informação aqui: </span>" .<br>
  		<b>Nota: </b>Você tambem pode editar as entradas atuais <br>no campo "<span style="background-color:yellow" > Entradas atuais: </span>" se necessário.<br>
  		<b>Nota: </b>Se você quiser cancelar, clique no botão <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>Passo 4: </b>Clique no botão <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> para salvar the informação.<br>
		<b>Passo 5: </b>Se você quiser corrigir quaisquer erros, clique nos dados errados e substitua com os corretos e salve novamente.<br>
		<b>Passo 6: </b>Se você terminou, clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> para fechar a janela e voltar ao gráfico.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Voltar a  "Como ...?"</a></font>
</ul>
<a name="pt"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Como entrar com a informação de terapia física diária (PT), ginástica anti-trombosis (Atg), etc.?</b></font>
<ul> 
	<b>Passo 1: </b>Clique no "<span style="background-color:yellow" > Pt,Atg,etc: </span>" correspondente à data escolhida.<br>
	<b>Passo 2: </b>Uma janela aparecerá mostrando o campo de entrada para a data escolhida.<br>
	<b>Passo 3: </b>Digite a informação no campo <br> "<span style="background-color:yellow" > Por favor entre nova informação aqui: </span>" .<br>
  		<b>Nota: </b>Você tambem pode editar as entradas atuais <br>no campo "<span style="background-color:yellow" > Entradas atuais: </span>" se necessário.<br>
  		<b>Nota: </b>Se você quiser cancelar, clique no botão <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>Passo 4: </b>Clique no botão <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> para salvar a informação.<br>
		<b>Passo 5: </b>Se você quiser corrigir quaisquer erros, clique nos dados errados e substitua com os corretos e salve novamente.<br>
		<b>Passo 6: </b>Se você terminou, clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> para fechar a janela e voltar ao gráfico.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Voltar a  "Como ...?"</a></font>
</ul>
<a name="coag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Como entrar anticoagulantes?</b></font>
<ul> 
	<b>Passo 1: </b>Clique no ícone (clip) <img <?php echo createComIcon('../','clip.gif','0') ?>> no "<span style="background-color:yellow" > Anticoagulantes <img <?php echo createComIcon('../','clip.gif','0') ?>> </span>".<br>
	<b>Passo 2: </b>Uma janela aparecerá mostrando o campo de entrada para anticoagulantes.<br>
	<b>Passo 3: </b>Digite a informação de anticoagulantes e/ou dosagem no campo<br> "<span style="background-color:yellow" > Por favor entre nova informação aqui: </span>" .<br>
  		<b>Nota: </b>Você tambem pode editar as entradas atuais <br>no campo "<span style="background-color:yellow" > Entradas atuais: </span>" se necessário.<br>
  		<b>Nota: </b>Se você quiser cancelar, clique no botão <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>Passo 4: </b>Clique no botão <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> para salvar the informação.<br>
		<b>Passo 5: </b>Se você quiser corrigir quaisquer erros, clique nos dados errados e substitua com os corretos e salve novamente.<br>
		<b>Passo 6: </b>Se você terminou, clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> para fechar a janela e voltar ao gráfico.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Voltar a  "Como ...?"</a></font>
</ul>
<a name="daycoag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Como entrar com informação sobre aplicação diária de anticoagulante?</b></font>
<ul> 
	<b>Passo 1: </b>Clique ou na coluna vazia ou na informação existente de anticoagulante correspondente à data escolhida.<br>
	<b>Passo 2: </b>Uma janela aparecerá mostrando o campo de entrada aplicação diária de anticoagulante para a data escolhida.<br>
	<b>Passo 3: </b>Digite ou a dosagem, ou a  informação do aplicador no campo<br> "<span style="background-color:yellow" > Entre a nova informação aqui ou edite as Entradas atuais: </span>" .<br>
  		<b>Nota: </b>Se você quiser cancelar, clique no botão <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>Passo 4: </b>Clique no botão <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> para salvar a informação.<br>
		<b>Passo 5: </b>Se você quiser corrigir quaisquer erros, clique nos dados errados e substitua com os corretos e salve novamente.<br>
		<b>Passo 6: </b>Se você terminou, clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> para fechar a janela e voltar ao gráfico.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Voltar a  "Como ...?"</a></font>
</ul>
<a name="lot"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Como entrar com notas sobre implantes, no. LOT , no. débito, etc?</b></font>
<ul> 
	<b>Passo 1: </b>Clique no ícone (clip) <img <?php echo createComIcon('../','clip.gif','0') ?>> em "<span style="background-color:yellow" > Notas <img <?php echo createComIcon('../','clip.gif','0') ?>> </span>".<br>
	<b>Passo 2: </b>Uma janela aparecerá mostrando o campo de entrada notas auxiliares.<br>
	<b>Passo 3: </b>Digite a informação do LOT, no. débito, implantes no campo<br> "<span style="background-color:yellow" > Por favor entre nova informação aqui: </span>" .<br>
  		<b>Nota: </b>Você tambem pode editar as entradas atuais <br>no campo "<span style="background-color:yellow" > Entradas atuais: </span>" se necessário.<br>
  		<b>Nota: </b>Se você quiser cancelar, clique no botão <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>Passo 4: </b>Clique no botão <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> para salvar a informação.<br>
		<b>Passo 5: </b>Se você quiser corrigir quaisquer erros, clique nos dados errados e substitua com os corretos e salve novamente.<br>
		<b>Passo 6: </b>Se você terminou, clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> para fechar a janela e voltar ao gráfico.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Voltar a  "Como ...?"</a></font>
</ul>
<a name="med"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Como entrar com a medicação e plano de dosagem?</b></font>
<ul> 
	<b>Passo 1: </b>Clique em "<span style="background-color:yellow" > Medicação </span>".<br>
	<b>Passo 2: </b>Uma janela aparecerá mostrando os campos de entrada para medicação e plano de dosagem.<br>
	<b>Passo 3: </b>Digite a medicação na coluna da esquerda.<br> 
	<b>Passo 4: </b>Digite o plano de dosagem na coluna do meio.<br> 
	<b>Passo 5: </b>Clique no botão de radio do código de cores para a medicação, se necessário.<br> 
	<ul type=disc>
		<li>Branco para normal ou padrão.
		<li><span style="background-color:#00ff00" >Verde</span> para antibióticos e seus derivados.
		<li><span style="background-color:yellow" >Amarelo</span> para remédios dialíticos.
		<li><span style="background-color:#0099ff" >Azul</span> para remédios hemolíticos (coagulante ou anticoagulante).
		<li><span style="background-color:#ff0000" >Vermelho</span> para remédios aplicados intravenosos.
	</ul>
  	<b>Nota: </b>Você tambem pode editar as entradas atuais <br>se necessário.<br>
	<b>Passo 6: </b>Entre seu nome no campo "<span style="background-color:yellow" > Enfermeiro: </span>" .<br> 
  		<b>Nota: </b>Se você quiser cancelar, clique no botão <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>Passo 7: </b>Clique no botão <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> para salvar o plano de medicação.<br>
		<b>Passo 8: </b>Se você quiser corrigir quaisquer erros, clique nos dados errados e substitua com os corretos e salve novamente.<br>
		<b>Passo 9: </b>Se você terminou, clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> para fechar a janela e voltar ao gráfico.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Voltar a  "Como ...?"</a></font>
</ul>
<a name="daymed"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Como entrar com a informação de applicação de medicação diária e dosagem?</b></font>
<ul> 
	<b>Passo 1: </b>Clique ou numa coluna vazia de medicação ou numa informação existente correspondente à data escolhida.<br>
	<b>Passo 2: </b>Uma janela aparecerá mostrando a medicação e plano de dosagem com o campo de entradas para a informação do dia.<br>
	<b>Passo 3: </b>Clique no campo de entrada correspondente medicação escolhida.<br>
	<b>Passo 4: </b>Digite ou na dosagem, informação do aplicador,ou símbolos de início/fim no campo.<br>
  		<b>Nota: </b>Se você quiser cancelar, clique no botão <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>Passo 5: </b>Se você tiver várias entradas, entre com todas elas antes de salvar.<br>
		<b>Passo 6: </b>Clique no botão <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> para salvar the informação.<br>
		<b>Passo 7: </b>Se você quiser corrigir quaisquer erros, clique nos dados errados e substitua com os corretos e salve novamente.<br>
		<b>Passo 8: </b>Se você terminou, clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> para fechar a janela e voltar ao gráfico.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Voltar a  "Como ...?"</a></font>
</ul>
<a name="iv"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Como entrar com a informação diária de aplicação e dosagem de medicação intravenosa?</b></font>
<ul> 
	<b>Passo 1: </b>Clique ou numa coluna vazia de medicação ou numa informação existente ao lado de <br>"<span style="background-color:yellow" > Intravenoso>> </span>" correspondente à data escolhida.<br>
	<b>Passo 2: </b>Uma janela aparecerá mostrando o campo de entrada para o dia da informação da medicação intravenosa.<br>
	<b>Passo 3: </b>Digite ou a dosagem, a informação do aplicador, ou símbolos de início/fim no campo "<span style="background-color:yellow" > Entre com a nova informação aqui ou edite o campo das Entradas atuais: </span>" .<br>
  		<b>Nota: </b>Se você quiser cancelar, clique no botão <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>Passo 4: </b>Clique no botão <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> para salvar the informação.<br>
		<b>Passo 5: </b>Se você quiser corrigir quaisquer erros, clique nos dados errados e substitua com os corretos e salve novamente.<br>
		<b>Passo 6: </b>Se você terminou, clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> para fechar a janela e voltar ao gráfico.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Voltar a  "Como ...?"</a></font>
</ul>
<?php elseif(($src=="")&&($x1=="template")) : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
O que eu deveria fazer quando <span style="background-color:yellow" >a lista de hoje ainda não está criada</span>?</b></font>
<ul> <b>Passo 1: </b>Clique no botão <input type="button" value="Mostre a última lista de ocupação"> para encontrar a última lista que foi gravada.
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
		<li>pelo seu número de paciente, entre com o número no campo <br>"<span style="background-color:yellow" >Patient no.:</span><input type="text" name="t" size=19 maxlength=10 value="22000109">" .
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
A última lista de ocupação está sendo exibida mas eu não quero copiá-la. Como iniciar uma nova lista? </b></font>
<ul> <b>Passo 1: </b>Clique no botão <input type="button" value="Não copie isto! Crie uma nova lista."> para iniciar uma nova lista.
</ul>
<?php elseif($src=="assign") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como assinalar uma cama a um paciente?</b></font>
<ul> <b>Passo 1: </b>Primeiro encontre o paciente entrando com uma palavra chave de pesquisa em um dos vários campos de entradas.<br>
		Se você quiser encontrar o paciente...<ul type="disc">
		<li>pelo seu número de paciente, entre com o número no campo <br>"<span style="background-color:yellow" >No. do pacient:</span><input type="text" name="t" size=19 maxlength=10 value="22000109">" .
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
  
<?php elseif($src=="remarks") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como escrever observações ou notas sobre o paciente?</b></font>
<ul> <b>Passo 1: </b>Clique campo de entrada de texto.<br>
		<b>Passo 2: </b>Digite suas observações ou notas<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Eu terminei de escrever. Como  salvo as observações ou notas?</b></font>
<ul> 	<b>Passo 1: </b>Clique no botão <input type="button" value="Salvar"> para salvar.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Eu salvei as observações. Como fecho a janela?</b></font>
<ul> 	<b>Passo 1: </b>Clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle"> para fechar a janela.<p>
</ul>
<?php elseif($src=="discharge") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Como liberar um paciente?</b></font>
<ul> <b>Passo 1: </b>Selecione o tipo de liberação clicando no botão correspondente<br>
	<ul><br>
		<input type="radio" name="relart" value="reg" checked> Liberação Regular<br>
                 	<input type="radio" name="relart" value="auto"> O paciente deixou o hospital por vontade própria<br>
                 	<input type="radio" name="relart" value="emerg"> Liberação de Emergencia<br>  <br>
	</ul>
		<b>Passo 2: </b>Digite observações adicionais ou notas sobre a liberação no campo "<span style="background-color:yellow" > Observação: </span>" se disponível. <br>
		<b>Passo 3: </b>Digite seu nome no campo "<span style="background-color:yellow" > Enfermeiro: <input type="text" name="a" size=20 maxlength=20></span>" se estiver vazio. <br>
		<b>Passo 4: </b>Marque o campo " <span style="background-color:yellow" ><input type="checkbox" name="d" value="d"> Sim, tenho certeza. Libere o paciente. </span>" . <br>
		<b>Passo 5: </b>Clique no botão <input type="button" value="libere"> para liberar o paciente.<p>
		<b>Passo 6: </b>Clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle"> para Voltar para a nova lista de ocupação da ala.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Eu tentei, clicando no botão <input type="button" value="libere"> , mas não há resposta. Por que?</b></font>
<ul> <b>Nota: </b>O campo da caixa de verificação deve estar marcado conforme: <br>
 " <span style="background-color:yellow" ><input type="checkbox" name="d" value="d" verificado> Sim, tenho certeza. Libere o paciente. </span>". <p>
		<b>Passo 1: </b>Clique na caixa de verificação se ela não estiver marcada.<p>
</ul>
  <b>Nota: </b>Se você quiser cancelar, clique no botão <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.</ul>

<?php endif;?>

</form>

