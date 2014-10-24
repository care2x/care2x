<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<a name="howto">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b><?php echo "$x3" ?></b></font>
<form action="#" >
<p><font size=2 face="verdana,arial" >

<?php if($src=="main") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come si fa per...</b></font>
<ul type="disc"> 
		<li><a href="#cbp">...Inserire temperatura o pressione sanguigna.</a>
		<li><a href="#movedate">...Modificare la data del grafico.</a>
		<li><a href="#diet">...Inserire un piano di dieta.</a>
		<li><a href="#allergy">...Inserire informazioni allergologiche.</a>
		<li><a href="#diag">...Inserire la diagnosi o terapia principali.</a>
		<li><a href="#daydiag">...Inserire la diagnosi o il piano terapeutico giornalieri.</a>
		<li><a href="#extra">...Inserire note, diagnosi aggiuntive, etc.</a>
		<li><a href="#pt">...Inserire informazioni su terapia fisica giornaliera, ginnastica anti-trombosi, etc.</a>
		<li><a href="#coag">...Specificare anticoagulanti.</a>
		<li><a href="#daycoag">...Inserire informazioni sulla terapia anticoagulatoria giornaliera.</a>
		<li><a href="#lot">...Inserire note su implants, LOT nr, charge nr, etc.</a>
		<li><a href="#med">...Specificare medicinali e piano di dosaggio.</a>
		<li><a href="#daymed">...Specificare medicinali da erogare giornalmente e relativi dosaggi.</a>
		<li><a href="#iv">...Specificare trattamenti endovena giornalieri e relativi dosaggi.</a>
</ul>
<hr>
<a name="cbp"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Come inserire temperatura o pressione sanguigna</b></font>
<ul> <b>1: </b>Selezionare sul grafico in prossimit&agrave della data desiderata.<br>
		<b>2: </b>Comparir&agrave una finestrella in cui inserire temperatura e/o pressione.<br>
		<b>3: </b>Inserire i dati e l'orario.<br>
		<ul type="disc">
		<li>Inserire orario e temperatura nella colonna "<font color="#0000ff">Temperatura</font>" a destra.<br>
		Esempio: <input type="text" name="t" size=5 maxlength=5 value="12.35">&nbsp;&nbsp;<input type="text" name="u" size=8 maxlength=8 value="37.3">
		<li>Inserire orario e pressione nella colonna "<font color="#cc0000">Pressione sang.</font>" a sinistra.<br>
		Esempio: <input type="text" name="v" size=5 maxlength=5 value="10.05">&nbsp;&nbsp;<input type="text" name="w" size=8 maxlength=8 value="128/85">
		</ul>		
		<ul >
		<font color="#000099" size=1><b>Nota:</b> per inserire l'orario attuale , premere "a" o "A"  nel campo 'orario'.</font>
		</ul>
		<b>4: </b>Se ci sono molti dati, inserirli tutti prima di salvare.<br>
		<b>5: </b>Premere il bottone <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> per salvare i dati appena inseriti.<br>
		<b>6: </b>Se si desidera correggere un errore, clickare sul dato sbagliato e sostituirlo.<br>
		<b>5: </b>Alla fine, clickare il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> per chiudere la finestra e ritornare al grafico.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Tornare a "Come si fa per..."</a></font>
</ul>
<a name="movedate"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Come modificare la data del grafico</b></font>
<ul> 
	<li><font color="#660000"><b>Per spostare la data un giorno indietro:</b></font><br>
	<b>1: </b>Selezionare sull'icona <img <?php echo createComIcon('../','l_arrowgrnsm.gif','0') ?>> nella colonna data <span style="background-color:yellow" >pi&ugrave a sinistra</span> nel grafico.<p>
	<li><font color="#660000"><b>Per spostare la data un giorno avanti:</b></font><br>
	<b>1: </b>Selezionare sull'icona <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0') ?>> nella colonna data <span style="background-color:yellow" >pi&ugrave  destra</span> nel grafico.
                                                                     <p>
	<li><font color="#660000"><b>Per impostare una nuova data iniziale:</b></font><br>
	<b>1: </b>Selezionare con il <span style="background-color:yellow" >tasto destro</span> sull'icona <img <?php echo createComIcon('../','l_arrowgrnsm.gif','0') ?>> della colonna data <span style="background-color:yellow" >pi&ugrave a sinistra</span> nel grafico.<br>
	<b>2: </b>Selezionare <input type="button" value="OK"> per confermare.<br>
	<b>3: </b>Apparir&agrave una finestrella che chiede di inserire la nuova data iniziale.<br>
	<b>4: </b>Inserire giorno, mese ed anno.<br>
	<b>5: </b>Selezionare il bottone <input type="button" value="OK"> per confermare la variazione.<br>
	La finestrella si chiuder&agrave ed nel grafico la data iniziale risulter&agrave aggiornata.<p>
	
	<li><font color="#660000"><b>Per impostare una nuova data finale:</b></font><br>
	<b>1: </b>Selezionare con il <span style="background-color:yellow" >tasto destro</span> sull'icona <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0') ?>> della colonna data <span style="background-color:yellow" >pi&ugrave a destra</span> nel grafico.<br>
	<b>2: </b>Selezionare <input type="button" value="OK"> per confermare.<br>
	<b>3: </b>Apparir&agrave una finestrella che chiede di inserire la nuova data finale.<br>
	<b>4: </b>Inserire giorno, mese ed anno.<br>
	<b>5: </b>Selezionare il bottone <input type="button" value="OK"> per confermare la variazione.<br>
	La finestrella si chiuder&agrave ed nel grafico la data finale risulter&agrave aggiornata.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Tornare a "Come fare per ...."</a></font>
</ul>
<a name="diet"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Come inserire un piano di dieta</b></font>
<ul> <b>1: </b>Selezionare "<span style="background-color:yellow" >dieta</span>" in corrispondenza della data desiderata.<br>
		<b>2: </b>Apparir&agrave una finestrella in cui inserire o modificare il piano di dieta.<br>
		<b>3: </b>Inserire la dieta.<br>
		<b>4: </b>Selezionare il bottone <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> per salvare il nuovo piano.<br>
  		<b>Nota: </b>Per annullare l'operazione, clickare il bottone <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> border=0 align="absmiddle">.<br>
		<b>5: </b>Per correggere un errore, clickare sul dato sbagliato e sostituirlo con quello giusto.<br>
		<b>6: </b>Al termine, clickare il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> per tornare al grafico.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Tornare a "Come fare per ...."</a></font>
</ul>
<a name="allergy"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Come inserire informazioni allergologiche</b></font>
<ul> 
	<b>1: </b>Selezionare sull'icona <img <?php echo createComIcon('../','clip.gif','0') ?>> nella colonna "<span style="background-color:yellow" >Allergie<img <?php echo createComIcon('../','clip.gif','0') ?>> </span>".<br>
	<b>2: </b>Apparir&agrave una finestrella in cui inserire le informazioni allergologiche.<br>
	<b>3: </b>Inserire allergie o CAVE nel campo<br> "<span style="background-color:yellow" > Inserire qui le nuove informazioni: </span>".<br>
  		<b>Nota: </b>Se occorre, &egrave possibile modificare i dati correnti <br>dal campo "<span style="background-color:yellow" >Dati correnti:</span>".<br>
  		<b>Nota: </b>Per annullare l'operazione, clickare il bottone <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> border=0 align="absmiddle">.<br>
		<b>4: </b>Selezionare il bottone <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> per salvare.<br>
		<b>5: </b>Se si desidera correggere un errore, clickare sul dato sbagliato e sostituirlo.<br>
		<b>6: </b>Al termine, clickare il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> per tornare al grafico.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Tornare a "Come fare per ...."</a></font>
</ul>

<a name="diag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Come inserire la diagnosi o terapia principali</b></font>
<ul> 
	<b>1: </b>Selezionare sull'icona <img <?php echo createComIcon('../','clip.gif','0') ?>> in "<span style="background-color:yellow" > Diagnosis/Therapy <img <?php echo createComIcon('../','clip.gif','0') ?>> </span>".<br>
	<b>2: </b>Apparir&agrave una finestrella in cui inserire la diagnosi/terapia.<br>
	<b>3: </b>Inserire le informazioni di diagnosi o terapia nel campo <br> "<span style="background-color:yellow" >Inserire qui le nuove informazioni: </span>".<br>
  		<b>Nota: </b>Se occorre, &egrave possibile modificare i dati correnti <br>dal campo "<span style="background-color:yellow" >Dati correnti:</span>".<br>
  		<b>Nota: </b>Per annullare l'operazione, clickare il bottone <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> border=0 align="absmiddle">.<br>
		<b>4: </b>Selezionare il bottone <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> per salvare.<br>
		<b>5: </b>Se si desidera correggere un errore, clickare sul dato sbagliato e sostituirlo.<br>
		<b>6: </b>Al termine, clickare il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> per tornare al grafico.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Tornare a "Come fare per ...."</a></font>
</ul>
<a name="daydiag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Come inserire la diagnosi o il piano terapeutico giornalieri</b></font>
<ul> 
	<b>1: </b>Selezionare o la colonna vuota o la diagnosi/terapia giornaliera corrispondente alla data scelta.<br>
	<b>2: </b>Apparir&agrave una finestrella in cui inserire la diagnosi/terapia per la data scelta.<br>
	<b>3: </b>Inserire le informazioni di diagnosi o terapia nel campo <br> "<span style="background-color:yellow" >Inserire qui le nuove informazioni: </span>".<br>
  		<b>Nota: </b>Se occorre, &egrave possibile modificare i dati correnti <br>dal campo "<span style="background-color:yellow" >Dati correnti:</span>".<br>
  		<b>Nota: </b>Per annullare l'operazione, clickare il bottone <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> border=0 align="absmiddle">.<br>
		<b>4: </b>Selezionare il bottone <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> per salvare.<br>
		<b>5: </b>Se si desidera correggere un errore, clickare sul dato sbagliato e sostituirlo.<br>
		<b>6: </b>Al termine, clickare il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> per tornare al grafico.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Tornare a "Come fare per ...."</a></font>
</ul>
<a name="extra"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Come inserire note, diagnosi aggiuntive, etc.</b></font>
<ul> 
	<b>1: </b>Selezionare l'icona <img <?php echo createComIcon('../','clip.gif','0') ?>> in "<span style="background-color:yellow" > Note, diagnosi aggiuntive <img <?php echo createComIcon('../','clip.gif','0') ?>> </span>".<br>
	<b>2: </b>Apparir&agrave una finestrella in cui inserire notes and extra diagnoses.<br>
	<b>3: </b>Inserire le note o diagnosi aggiuntive nel campo <br> "<span style="background-color:yellow" >Inserire qui le nuove informazioni: </span>".<br>
  		<b>Nota: </b>Se occorre, &egrave possibile modificare i dati correnti <br>dal campo "<span style="background-color:yellow" >Dati correnti:</span>".<br>
  		<b>Nota: </b>Per annullare l'operazione, clickare il bottone <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> border=0 align="absmiddle">.<br>
		<b>4: </b>Selezionare il bottone <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> per salvare.<br>
		<b>5: </b>Se si desidera correggere un errore, clickare sul dato sbagliato e sostituirlo.<br>
		<b>6: </b>Al termine, clickare il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> per tornare al grafico.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Tornare a "Come fare per ...."</a></font>
</ul>
<a name="pt"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Come inserire informazioni su terapia fisica giornaliera, ginnastica anti-trombosi, etc.</b></font>
<ul> 
	<b>1: </b>Click the "<span style="background-color:yellow" > Pt,Atg,etc: </span>" corresponding to the chosen date.<br>
	<b>2: </b>Apparir&agrave una finestrella in cui inserire the chosen date.<br>
	<b>3: </b>Inserire la terapia fisica giornaliera nel campo <br> "<span style="background-color:yellow" >Inserire qui le nuove informazioni: </span>".<br>
  		<b>Nota: </b>Se occorre, &egrave possibile modificare i dati correnti <br>dal campo "<span style="background-color:yellow" >Dati correnti:</span>".<br>
  		<b>Nota: </b>Per annullare l'operazione, clickare il bottone <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> border=0 align="absmiddle">.<br>
		<b>4: </b>Selezionare il bottone <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> per salvare.<br>
		<b>5: </b>Se si desidera correggere un errore, clickare sul dato sbagliato e sostituirlo.<br>
		<b>6: </b>Al termine, clickare il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> per tornare al grafico.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Tornare a "Come fare per ...."</a></font>
</ul>
<a name="coag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Come specificare gli anticoagulanti</b></font>
<ul> 
	<b>1: </b>Click the <img <?php echo createComIcon('../','clip.gif','0') ?>> (clip) icon on the "<span style="background-color:yellow" > Anticoagulants <img <?php echo createComIcon('../','clip.gif','0') ?>> </span>".<br>
	<b>2: </b>Apparir&agrave una finestrella in cui inserire anticoagulants.<br>
	<b>3: </b>Specificare gli anticoagulanti e/o il dosaggio nel campo <br> "<span style="background-color:yellow" > Inserire qui le nuove informazioni: </span>" field.<br>
  		<b>Nota: </b>Se occorre, &egrave possibile modificare i dati correnti <br>dal campo "<span style="background-color:yellow" >Dati correnti:</span>".<br>
  		<b>Nota: </b>Per annullare l'operazione, clickare il bottone <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> border=0 align="absmiddle">.<br>
		<b>4: </b>Selezionare il bottone <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> per salvare.<br>
		<b>5: </b>Se si desidera correggere un errore, clickare sul dato sbagliato e sostituirlo.<br>
		<b>6: </b>Al termine, clickare il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> per tornare al grafico.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Tornare a "Come fare per ...."</a></font>
</ul>
<a name="daycoag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Come inserire informazioni sulla terapia anticoagulatoria giornaliera</b></font>
<ul> 
	<b>1: </b>Selezionare o sulla colonna vuota o sulle informazioni esistenti sugli anticoagulanti corrispondenti alla data scelta.<br>
	<b>2: </b>Apparir&agrave una finestrella in cui inserire la terapia anticoagulatoria giornaliera per la data scelta.<br>
	<b>3: </b>Inserire il dosaggio oppure il terapista nel campo <br> "<span style="background-color:yellow" > Inserire nuove informazioni o modificare quelle esistenti:</span>" .<br>
  		<b>Nota: </b>Per annullare l'operazione, clickare il bottone <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> border=0 align="absmiddle">.<br>
		<b>4: </b>Selezionare il bottone <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> per salvare.<br>
		<b>5: </b>Se si desidera correggere un errore, clickare sul dato sbagliato e sostituirlo.<br>
		<b>6: </b>Al termine, clickare il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> per tornare al grafico.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Tornare a "Come fare per ...."</a></font>
</ul>
<a name="lot"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Come inserire note su innesti, LOT nr, charge nr, etc?</b></font>
<ul> 
	<b>1: </b>Selezionare l'icona <img <?php echo createComIcon('../','clip.gif','0') ?>> in  "<span style="background-color:yellow" > Notes <img <?php echo createComIcon('../','clip.gif','0') ?>> </span>".<br>
	<b>2: </b>Apparir&agrave una finestrella in cui inserire le note ausiliarie.<br>
	<b>3: </b>Inserire le informazioni su innesti, LOT, charge nr, nel campo <br> "<span style="background-color:yellow" > Inserire qui le nuove informazioni: </span>".<br>
  		<b>Nota: </b>Se occorre, &egrave possibile modificare i dati correnti <br>dal campo "<span style="background-color:yellow" >Dati correnti:</span>".<br>
  		<b>Nota: </b>Per annullare l'operazione, clickare il bottone <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> border=0 align="absmiddle">.<br>
		<b>4: </b>Selezionare il bottone <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> per salvare.<br>
		<b>5: </b>Se si desidera correggere un errore, clickare sul dato sbagliato e sostituirlo.<br>
		<b>6: </b>Al termine, clickare il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> per tornare al grafico.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Tornare a "Come fare per ...."</a></font>
</ul>
<a name="med"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Come specificare medicinali e piano di dosaggio</b></font>
<ul> 
	<b>1: </b>Selezionare "<span style="background-color:yellow" > Medicinali </span>".<br>
	<b>2: </b>Apparir&agrave una finestrella in cui inserire medicinali e piani di dosaggio.<br>
	<b>3: </b>Inserire il medicinale nella colonna sinistra.<br> 
	<b>4: </b>Inserire il piano di dosaggio nella colonna di destra.<br> 
	<b>5: </b>Inserire il codice colore della medicazione, se necessario.<br> 
	<ul type=disc>
		<li>Bianco: normale (default).
		<li><span style="background-color:#00ff00" >Verde</span> per antibiotici e loro derivati.
		<li><span style="background-color:yellow" >Giallo</span> per medicinali dialitici.
		<li><span style="background-color:#0099ff" >Blu</span> per medicinali emolitici (coagulanti o anticoagulanti).
		<li><span style="background-color:#ff0000" >Rosso</span> per medicinali da somministrare via endovenosa.
	</ul>
 		<b>Nota: </b>Se occorre, &egrave possibile modificare i dati correnti.<br>
	<b>6: </b>Inserire il proprio nome nel campo "<span style="background-color:yellow" > Terapeuta: </span>".<br> 
  		<b>Nota: </b>Per annullare l'operazione, clickare il bottone <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> border=0 align="absmiddle">.<br>
		<b>7: </b>Selezionare il bottone <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> to save the medication plan.<br>
		<b>8: </b>Se si desidera correggere un errore, clickare sul dato sbagliato e sostituirlo.<br>
		<b>9: </b>Al termine, clickare il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> per tornare al grafico.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Tornare a "Come fare per ...."</a></font>
</ul>
<a name="daymed"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Come specificare medicinali da erogare giornalmente e relativi dosaggi</b></font>
<ul> 
	<b>1: </b>Selezionare o sulla colonna vuota o sulle informazioni esistenti corrispondenti alla data scelta.<br>
	<b>2: </b>Apparir&agrave una finestrella in cui inserire medicinali e piano di dosaggio per la data scelta.<br>
	<b>3: </b>Selezionare il campo corrispondente al medicinale scelto.<br>
	<b>4: </b>Inserire il dosaggio, il terapeuta e/o i simboli di inizio/fine.<br>
  		<b>Nota: </b>Per annullare l'operazione, clickare il bottone <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> border=0 align="absmiddle">.<br>
		<b>5: </b>Se ci sono molti dati, inserirli tutti prima di salvare.<br>
		<b>6: </b>Selezionare il bottone <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> per salvare.<br>
		<b>7: </b>Se si desidera correggere un errore, clickare sul dato sbagliato e sostituirlo.<br>
		<b>8: </b>Al termine, clickare il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> per tornare al grafico.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Tornare a "Come fare per ...."</a></font>
</ul>
<a name="iv"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Come specificare trattamenti endovena giornalieri e relativi dosaggi</b></font>
<ul> 
	<b>1: </b>Selezionare o sulla colonna vuota o sulle informazioni esistenti accanto al campo <br>"<span style="background-color:yellow" > Endovena>> </span>" corrispondente alla data scelta.<br>
	<b>2: </b>Apparir&agrave una finestrella in cui specificare le medicazioni endovenose del giorno.<br>
	<b>3: </b>Inserire il dosaggio, il terapeuta e/o i simboli di inizio/fine nel campo "<span style="background-color:yellow" > Inserire o modificare i dati: </span>".<br>
  		<b>Nota: </b>Per annullare l'operazione, clickare il bottone <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> border=0 align="absmiddle">.<br>
		<b>4: </b>Selezionare il bottone <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> per salvare.<br>
		<b>5: </b>Se si desidera correggere un errore, clickare sul dato sbagliato e sostituirlo.<br>
		<b>6: </b>Al termine, clickare il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> per tornare al grafico.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Tornare a "Come fare per ...."</a></font>
</ul>
<?php elseif(($src=="")&&($x1=="template")) : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Che fare se <span style="background-color:yellow" >la lista occupazione letti non esiste ancora</span>?</b></font>
<ul> <b>1: </b>Selezionare il bottone <input type="button" value="Mostra lista occupazione letti"> per cercare l'ultima lista archiviata.<br>
		<b>2: </b>Se esiste almeno una lista archiviata negli ultimi 31 giorni, essa verr&agrave mostrata.<br>
		<b>3: </b>Selezionare il bottone <input type="button" value="Usa questa lista come lista di oggi"><br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Non voglio cercare la lista occupazione letti. Come posso crearne una nuova?</b></font>
<ul> <b>1: </b>Selezionare sul bottone <img <?php echo createComIcon('../','plus2.gif','0') ?>> corrispondente al numero di camera e di letto.
<br>
		<b>2: </b>Apparir&agrave una finestrella per la ricerca paziente.<br>
		<b>3: </b>Prima di tutto, cercare il paziente inserendo una parola chiave in uno dei tanti campi di ricerca.<br>
		Se si desidera trovare il paziente...<ul type="disc">
		<li>in base al suo codice, inserirlo nel campo <br>"<span style="background-color:yellow" >Codice paziente:</span><input type="text" name="t" size=19 maxlength=10 value="22000109">".
		<li>in base al cognome, inserirne qualche lettera nel campo <br>"<span style="background-color:yellow" >Cognome:</span><input type="text" name="t" size=19 maxlength=10 value="Rossi">".
		<li>in base al nome, inserirne qualche lettera nel campo <br>"<span style="background-color:yellow" >Nome:</span><input type="text" name="t" size=19 maxlength=10 value="Mario">".
		<li>in base alla data di nascita, inserire la data o le prime cifre nel campo <br>"<span style="background-color:yellow" >Data:</span><input type="text" name="t" size=19 maxlength=10 value="27.1.1967">".
		</ul>
		<b>4: </b>Selezionare il bottone <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> per avviare la ricerca.<br>
		<b>5: </b>Se la ricerca identifica qualche paziente, apparir&agrave una lista da cui scegliere.<br>
		<b>6: </b>Per scegliere il paziente giusto, clickare il bottone&nbsp;<button><img <?php echo createComIcon('../','post_discussion.gif','0') ?>></button> corrispondente.<br>
</ul>
<?php elseif(($src=="getlast")&&($x1=="last")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come copiare l'ultima lista occupazione letti archiviata nella lista di oggi?</b></font>
<ul>Selezionare il bottone <input type="button" value="Usa questa lista come lista di oggi"> per copiare l'ultima lista archiviata.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Sto visualizzando l'ultima lista occupazione letti, ma non voglio copiarla. Come creare una nuova lista?</b></font>
<ul>Selezionare il bottone <input type="button" value="Non copiare, crea nuova lista"> per creare una lista nuova.
</ul>
<?php elseif($src=="assign") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come assegnare un letto ad un paziente?</b></font>
<ul><b>1: </b>Prima di tutto, cercare il paziente inserendo una parola chiave in uno dei tanti campi di ricerca.<br>
		Se si desidera trovare il paziente...<ul type="disc">
		<li>in base al suo codice, inserirlo nel campo <br>"<span style="background-color:yellow" >Codice paziente:</span><input type="text" name="t" size=19 maxlength=10 value="22000109">".
		<li>in base al cognome, inserirne qualche lettera nel campo <br>"<span style="background-color:yellow" >Cognome:</span><input type="text" name="t" size=19 maxlength=10 value="Rossi">".
		<li>in base al nome, inserirne qualche lettera nel campo <br>"<span style="background-color:yellow" >Nome:</span><input type="text" name="t" size=19 maxlength=10 value="Mario">".
		<li>in base alla data di nascita, inserire la data o le prime cifre nel campo <br>"<span style="background-color:yellow" >Data:</span><input type="text" name="t" size=19 maxlength=10 value="27.1.1967">".
		</ul>
		<b>2: </b>Selezionare il bottone <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> per avviare la ricerca.<br>
		<b>3: </b>Se la ricerca identifica qualche paziente, apparir&agrave una lista da cui scegliere.<br>
		<b>4: </b>Per scegliere il paziente giusto, clickare il bottone&nbsp;<button><img <?php echo createComIcon('../','post_discussion.gif','0') ?>></button> corrispondente.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come bloccare un letto?</b></font>
<ul><b>1: </b>Selezionare "<span style="background-color:yellow" ><img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> <font color="#0000ff">Bloccare un letto</font> </span>".<br>
		<b>2: </b>Scegliere <button>OK</button> per confermare.<p>
</ul>
<b>Nota: </b>Per annullare l'operazione, clickare il bottone <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> border=0 align="absmiddle">.</ul>
<?php elseif($src=="remarks") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come scrivere osservazioni e note su un paziente?</b></font>
<ul><b>1: </b>Selezionare il campo testo.<br>
		<b>2: </b>Inserire osservazioni e note<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ho finito di scrivere: come faccio a salvare le mie note?</b></font>
<ul><b>1: </b>Selezionare il bottone <input type="button" value="Salva">.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ho salvato le note: come faccio a chiudere la finestra?</b></font>
<ul>Selezionare il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle"> per chiudere la finestra.<p>
</ul>
<?php elseif($src=="discharge") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come dimettere un paziente?</b></font>
<ul> <b>1: </b>Scegliere il tipo di dimissione premendo il bottone corrispondente<br>
<ul><br>
		<input type="radio" name="relart" value="reg" checked> Dimissione regolare<br>
                 	<input type="radio" name="relart" value="self"> Il paziente lascia l'ospedale di propria volontà<br>
                 	<input type="radio" name="relart" value="emgcy">Dimissione di emergenza<br><br>
	</ul>
		<b>2: </b>Inserire eventuali note aggiuntive nel campo "<span style="background-color:yellow" > Note: </span>".<br>
		<b>3: </b>Inserire il proprio nome nel campo "<span style="background-color:yellow" > Assistente medico: <input type="text" name="a" size=20 maxlength=20></span>" se questo è vuoto. <br>
		<b>4: </b>Selezionare la casella " <span style="background-color:yellow" ><input type="checkbox" name="d" value="d">Confermo la dimissione del paziente</span>". <br>
		<b>5: </b>Selezionare il bottone <input type="button" value="dimetti"> per dimettere il paziente.<p>
		<b>6: </b>Selezionare il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle"> per ritornare alla lista occupazione letti.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ho clickato il bottone <input type="button" value="dimetti">, ma non è successo niente: perché?</b></font>
<ul> E' necessario che la casella <br>
 " <span style="background-color:yellow" ><input type="checkbox" name="d" value="d" checked>Confermo la dimissione del paziente</span>" sia selezionata.<br>
 Se non lo è, occorre selezionarla.
</ul>
  <b>Nota: </b>Per annullare l'operazione, clickare il bottone <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> border=0 align="absmiddle">.</ul>
<?php endif;?>
</form>
