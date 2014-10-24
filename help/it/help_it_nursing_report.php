<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<un name="howto">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b><?php if($x1=="docs") print "Prescrizioni mediche"; else print "Referto infermieristico"; ?></b></font>
<form action="#" >
<p><font size=2 face="verdana,arial" >

<?php if($src=="") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: enter a <?php if($x1=="docs") print "Prescrizioni mediche"; else print "relazione infermieristica"; ?>?</b></font>
<ul> 
	<b>1: </b>Inserire la data nel campo "<span style="background-color:yellow" > Data: <input type="text" name="d" size=10 maxlength=10 value="10.10.2002"> </span>" nel campo "<?php if($x1=="docs") print "Prescrizioni mediche"; else print "Referto infermieristico"; ?>".<br>
		<font color="#000099" size=1><b>Note:</b>
		<ul type=disc>
		<li>Inserire "O" oppure "o" (oggi) per usare automaticamente la data odierna.<br>
		<li>In alternativa usare il bottone <img <?php echo createComIcon('../','arrow-t.gif','0') ?>> sotto al campo.
		<li>Inserire "I" oppure "i" (ieri) per usare automaticamente la data di ieri.<br>
		</font>
		</ul>
	<b>2: </b>Inserire l'ora nel campo "<span style="background-color:yellow" > Ora: <input type="text" name="d" size=5 maxlength=5 value="10.35"> </span>" nel campo "<?php if($x1=="docs") print "Prescrizioni mediche"; else print "Referto infermieristico"; ?>".<br>
		<font color="#000099" size=1><b>Nota:</b>
		<ul type=disc>
		<li>Per inserire l'ora attuale, usare "a" oppure "A" (come Adesso).
		<li>In alternativa selezionare il bottone <img <?php echo createComIcon('../','arrow-t.gif','0') ?>> sotto al campo.
		</font>
		</ul>
	<b>3: </b>Inserire la <?php if($x1=="docs") print "prescrizione medica"; else print "relazione infermieristica"; ?> nel campo "<span style="background-color:yellow" > <?php if($x1=="docs") print "Prescrizioni mediche"; else print "Referti infermieristici"; ?>: <input type="text" name="d" size=10 maxlength=10 value="test report"> </span>".<br>
		<font color="#000099" size=1><b>Note:</b>
		<ul type=disc>
		<li>Selezionare la casella "<span style="background-color:yellow" > <input type="checkbox" name="c" value="c"> <img <?php echo createComIcon('../','warn.gif','0') ?>>Inserire il simbolo all'inizio. </span>", se si desidera che il simbolo <img <?php echo createComIcon('../','warn.gif','0') ?>> appaia all'inizio della <?php if($x1=="docs") print "prescrizione medica"; else print "relazione infermieristica"; ?>.
		<li>Se si desidera evidenziare parte <?php if($x1=="docs") print "della prescrizione o"; ?> del rapporto, selezionare l'icona <img <?php echo createComIcon('../','hilite-s.gif','0') ?>> prima di inserire la parola o frase.
		Per terminare l'evidenziazione, selezionare l'icona <img <?php echo createComIcon('../','hilite-e.gif','0') ?>> dopo aver inserito l'ultimo carattere da evidenziare.
		</font>
		</ul>
	<b>4: </b>Inserire le iniziali del proprio nome nel campo "<span style="background-color:yellow" > Sigla: <input type="text" name="d" size=3 maxlength=3 value="GS"> </span>".<br>
  		<b>Nota: </b>Se si desidera annullare, premere il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.<br>
		<b>5: </b>Premere il bottone <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> per salvare le informazioni.<br>
		<b>6: </b>Alla fine, premere il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> per chiudere la finestra e tornare alla cartella dati paziente.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: inserire <?php if($x1=="docs") print "una domanda per il medico"; else print "un rapporto di efficacia terapeutica"; ?>?</b></font>
<ul> 
	<b>1: </b>Inserire la data nel campo "<span style="background-color:yellow" > Data: <input type="text" name="d" size=10 maxlength=10 value="10.10.2002"> </span>" nel campo "<?php if($x1=="docs") print "Domande per il medico"; else print "Rapporto sull'efficacia"; ?>".<br>
		<font color="#000099" size=1><b>Note:</b>
		<ul type=disc>
		<li>Inserire "O" oppure "o" (oggi) per usare automaticamente la data odierna.<br>
		<li>In alternativa usare il bottone <img <?php echo createComIcon('../','arrow-t.gif','0') ?>> sotto al campo.
		<li>Inserire "I" oppure "i" (ieri) per usare automaticamente la data di ieri.<br>
		</font>
		</ul>
	<b>2: </b>Inserire <?php if($x1=="docs") print "la domanda"; else print "il rapporto sull'efficacia"; ?> nel campo "<span style="background-color:yellow" > <?php if($x1=="docs") print "Domande per il medico"; else print "Rapporto sull'efficacia"; ?>: <input type="text" name="d" size=10 maxlength=10 value="test report"> </span>".<br>
		<font color="#000099" size=1><b>Note:</b>
		<ul type=disc>
		<li>Selezionare la casella "<span style="background-color:yellow" > <input type="checkbox" name="c" value="c"> <img <?php echo createComIcon('../','warn.gif','0') ?>> Inserisci il simbolo all'inizio. </span>", se si desidera che il simbolo <img <?php echo createComIcon('../','warn.gif','0') ?>> appaia all'inizio <?php if($x1=="docs") print "della domanda"; else print "del rapporto sull'efficacia"; ?>.
		<li>Se si desidera evidenziare parte <?php if($x1=="docs") print "della prescrizione o"; ?> del rapporto, selezionare l'icona <img <?php echo createComIcon('../','hilite-s.gif','0') ?>> prima di inserire la parola o frase.
		Per terminare l'evidenziazione, selezionare l'icona <img <?php echo createComIcon('../','hilite-e.gif','0') ?>> dopo aver inserito l'ultimo carattere da evidenziare.
		</font>
		</ul>
	<b>3: </b>Inserire le iniziali del proprio nome nel campo "<span style="background-color:yellow" > Sigla: <input type="text" name="d" size=3 maxlength=3 value="GS"> </span>".<br>
  		<b>Nota: </b>Se si desidera annullare, premere il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.<br>
		<b>4: </b>Premere il bottone <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> per salvare le informazioni.<br>
		<b>5: </b>Alla fine, premere il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> per chiudere la finestra e tornare alla cartella dati paziente.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Nota:</b></font>
<ul> 
	E' anche possibile inserire <?php if($x1=="docs") print "sia prescrizioni mediche che domande per il medico"; else print "i rapporti sia infermieristico che sull'efficacia terapeutica"; ?>.</ul>
<?php endif;?>
<?php if($src=="diagnosis") : ?>
<un name="extra"><un name="diag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a></a>
Come fare a: visualizzare un rapporto diagnostico?</b></font>
<ul> 
  		<b>Nota: </b>Se è disponibile un report diagnostico, nella colonna a sinistra appariranno delle brevi note sulla data di creazione ed il reparto/clinica che lo ha prodotto.<p>
  		<b>Nota: </b>Il primo report della lista sarà mostrato subito.<p>
	<b>1: </b>Selezionare la nota relativa al report che si vuole vedere.<br>	
</ul>
<?php endif;?>
<?php if($src=="kg_atg_etc") : ?>
<un name="pt"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Come fare a: inserire informazioni su terapia fisica giornaliera, ginnastica anti-trombosi, etc.?</b></font>
<ul> 
	<b>1: </b>Inserire le informazioni nel campo <br> "<span style="background-color:yellow" > Inserire qui le nuove informazioni: </span>".<br>
  		<b>Nota: </b>E' anche possibile modificare le informazioni esistenti nel campo "<span style="background-color:yellow" > Voci correnti: </span>".<br>
  		<b>Nota: </b>Se si desidera annullare, premere il bottone <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>2: </b>Premere il bottone <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> per salvare le informazioni.<br>
		<b>3: </b>Se si desidera correggere un errore, selezionare i dati sbagliati e sostituirli con quelli giusti, poi salvare.<br>
		<b>4: </b>Alla fine, premere il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> per chiudere la finestra e tornare al grafico.<br>
		
</ul>
<?php endif;?>
<?php if($src=="fotos") : ?>
<un name="coag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Come fare a: vedere una foto in anteprima?</b></font>
<ul> 
	<b>1: </b>Selezionare una delle piccole immagini nel riquadro a sinistra: a destra apparirà l'immagine a dimensione piena, completa di data e numero della foto.<br>
</ul>
<?php endif;?>
<?php if($src=="anticoag_dailydose") : ?>
<un name="daycoag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Come fare a: inserire informazioni su terapia anticoagulatoria giornaliera?</b></font>
<ul> 
	<b>1: </b>Inserire il dosaggio, or chi ha effettuato l'erogazione nel campo <br> "<span style="background-color:yellow" > Inserire qui le nuove informazioni o modificare quelle esistenti: </span>".<br>
  		<b>Nota: </b>Se si desidera annullare, premere il bottone <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>2: </b>Premere il bottone <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> per salvare le informazioni.<br>
		<b>3: </b>Se si desidera correggere un errore, selezionare i dati sbagliati e sostituirli con quelli giusti, poi salvare.<br>
		<b>4: </b>Alla fine, premere il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> per chiudere la finestra e tornare al grafico.<br>
</ul>
<?php endif;?>
<?php if($src=="lot_mat_etc") : ?>
<un name="lot"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Come fare a: inserire note on implants, LOT nr, charge nr, etc?</b></font>
<ul> 
	<b>1: </b>Inserire le informazioni on the LOT, charge nr, implants nel campo <br> "<span style="background-color:yellow" > Inserire qui le nuove informazioni: </span>".<br>
  		<b>Nota: </b>E' anche possibile modificare le informazioni esistenti nel campo "<span style="background-color:yellow" > Voci correnti: </span>".<br>
  		<b>Nota: </b>Se si desidera annullare, premere il bottone <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>2: </b>Premere il bottone <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> per salvare le informazioni.<br>
		<b>3: </b>Se si desidera correggere un errore, selezionare i dati sbagliati e sostituirli con quelli giusti, poi salvare.<br>
		<b>4: </b>Alla fine, premere il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> per chiudere la finestra e tornare al grafico.<br>
</ul>
<?php endif;?>
<?php if($src=="medication") : ?>
<un name="med"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Come fare a: inserire medicinali e piani di dosaggio?</b></font>
<ul> 
	<b>1: </b>Inserire il medicinale nella colonna sinistra.<br> 
	<b>2: </b>Inserire il piano di dosaggio nella colonna centrale.<br> 
	<b>3: </b>Selezionare il codice colore del medicinale, se necessario.<br> 
	<ul type=disc>
		<li>Bianco per normale (scelta standard).
		<li><span style="background-color:#00ff00" >Verde</span> per antibiotici e loro derivati.
		<li><span style="background-color:yellow" >Giallo</span> per dialitici.
		<li><span style="background-color:#0099ff" >Blu</span> per emolitici (coagulanti o anticoagulanti).
		<li><span style="background-color:#ff0000" >Rosso</span> per medicinali applicati via endovenosa.
	</ul>
  	<b>Nota: </b>E' anche possibile modificare le informazioni esistenti Se necessario.<br>
	<b>4: </b>Inserire il proprio nome nel campo "<span style="background-color:yellow" > Infermiere/a: </span>".<br> 
  		<b>Nota: </b>Se si desidera annullare, premere il bottone <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>5: </b>Premere il bottone <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> per salvare il piano di medicazione.<br>
		<b>6: </b>Se si desidera correggere un errore, selezionare i dati sbagliati e sostituirli con quelli giusti, poi salvare.<br>
		<b>7: </b>Alla fine, premere il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> per chiudere la finestra e tornare al grafico.<br>
</ul>
<?php endif;?>
<?php if($src=="medication_dailydose") : ?>
	<?php if($x2) : ?>
<un name="daymed"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Come fare a: inserire informazioni su applicazione e dosaggio giornalieri di medicinali?</b></font>
<ul> 
	<b>1: </b>Selezionare la voce corrispondente al medicinale desiderato.<br>
	<b>2: </b>Inserire il dosaggio, chi ha effettuato l'erogazione, o i simboli di inizio/fine nel campo.<br>
  		<b>Nota: </b>Se si desidera annullare, premere il bottone <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>3: </b>E' possibile inserire più dati e salvare solo alla fine.<br>
		<b>4: </b>Premere il bottone <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> per salvare le informazioni.<br>
		<b>5: </b>Se si desidera correggere un errore, selezionare i dati sbagliati e sostituirli con quelli giusti, poi salvare.<br>
		<b>6: </b>Alla fine, premere il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> per chiudere la finestra e tornare al grafico.<br>
</ul>
	<?php else : ?>
<un name="daymed"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Dice "Non c'è ancora un medicinale". Che devo fare?</b></font>
<ul> 
		<b>1: </b>Premere il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> per chiudere la finestrella e tornare al grafico.<br>
	<b>2: </b>Selezionare "<span style="background-color:yellow" > Medicinale </span>".<br>
	<b>3: </b>Apparirà una finestrella che permette di inserire medicinali e piani di dosaggio.<br>
	<b>4: </b>Inserire il medicinale nella colonna sinistra.<br> 
	<b>5: </b>Inserire il piano di dosaggio nella colonna centrale.<br> 
	<b>6: </b>Selezionare il codice colore del medicinale, se necessario.<br> 
	<ul type=disc>
		<li>Bianco per normale (scelta standard).
		<li><span style="background-color:#00ff00" >Verde</span> per antibiotici e loro derivati.
		<li><span style="background-color:yellow" >Giallo</span> per dialitici.
		<li><span style="background-color:#0099ff" >Blu</span> per emolitici (coagulanti o anticoagulanti).
		<li><span style="background-color:#ff0000" >Rosso</span> per medicinali applicati via endovenosa.
	</ul>
  	<b>Nota: </b>E' anche possibile modificare le informazioni esistenti <br>Se necessario.<br>
	<b>7: </b>Inserire il proprio nome nel campo "<span style="background-color:yellow" > Infermiere/a: </span>".<br> 
  		<b>Nota: </b>Se si desidera annullare, premere il bottone <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>8: </b>Premere il bottone <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> per salvare il piano di medicazione.<br>
		<b>9: </b>Se si desidera correggere un errore, selezionare i dati sbagliati e sostituirli con quelli giusti, poi salvare.<br>
		<b>10: </b>Alla fine, premere il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> per chiudere la finestra e tornare al grafico.<br>
</ul>
	<?php endif;?>
<?php endif;?>
<?php if($src=="iv_needle") : ?>
<un name="iv"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Come fare a: inserire informazioni su somministrazione e dosaggio di medicinali via endovenosa?</b></font>
<ul> 
	<b>1: </b>Inserire il dosaggio, chi ha effettuato l'erogazione, o i simboli di inizio/fine nel campo "<span style="background-color:yellow" > Inserire qui le nuove informazioni o modificare quelle esistenti: </span>".<br>
  		<b>Nota: </b>Se si desidera annullare, premere il bottone <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>2: </b>Premere il bottone <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> per salvare le informazioni.<br>
		<b>3: </b>Se si desidera correggere un errore, selezionare i dati sbagliati e sostituirli con quelli giusti, poi salvare.<br>
		<b>4: </b>Alla fine, premere il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> per chiudere la finestra e tornare al grafico.<br>
</ul>
<?php endif;?>
</form>
