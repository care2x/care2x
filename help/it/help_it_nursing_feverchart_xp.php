<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<un name="howto">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b><?php "$x3" ?></b></font>
<form action="#" >
<p><font size=2 face="verdana,arial" >

<?php if($src=="bp_temp") : ?>
<un name="cbp"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Come fare a inserire temperatura o pressione sanguigna</b></font>
<ul> <b>1: </b>Inserire data e ora.<br>
		<ul type="disc">
		<li>Inserire l'ora e la pressione sanguigna nella colonna a sinistra "<font color="#cc0000">Pressione sanguigna</font>".<br>
		Esempio: <input type="text" name="v" size=5 maxlength=5 value="10.05">&nbsp;&nbsp;<input type="text" name="w" size=8 maxlength=8 value="128/85">
		<li>Inserire l'ora e la temperatura nella colonna di destra "<font color="#0000ff">Temperatura</font>".<br>
		Esempio: <input type="text" name="t" size=5 maxlength=5 value="12.35">&nbsp;&nbsp;<input type="text" name="u" size=8 maxlength=8 value="37.3">
		</ul>		
		<ul >
		<font color="#000099" size=1><b>Nota:</b> Per inserire l'ora attuale, usare "a" oppure "A" (come Adesso).</font>
		</ul>
		<b>2: </b>E' possibile inserire più dati e salvarli tutti alla fine.<br>
		<b>3: </b>Premere il bottone <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> per salvare i nuovi dati.<br>
		<b>4: </b>Se si desidera correggere un errore, selezionare i dati sbagliati e sostituirli con quelli giusti, poi salvare.<br>
		<b>5: </b>Alla fine, selezionare il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> per chiudere la finestra e tornare al grafico.<br>
</ul>
<?php endif;?>
<?php if($src=="diet") : ?>
<un name="diet"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Come fare a: inserire un regime di dieta?</b></font>
<ul> <b>1: </b>Inserire il regime di dieta nel campo <br> "<span style="background-color:yellow" > Inserire qui le nuove informazioni o modificare quelle esistenti </span>".<br>
		<b>2: </b>Premere il bottone <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> per salvare il regime di dieta.<br>
  		<b>Nota: </b>Se si desidera annullare, selezionare il bottone <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>3: </b>Se si desidera correggere un errore, selezionare i dati sbagliati e sostituirli con quelli giusti, poi salvare.<br>
		<b>4: </b>Alla fine, selezionare il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> per chiudere la finestra e tornare al grafico.<br>
</ul>
<?php endif;?>
<?php if($src=="allergy") : ?>
<un name="allergy"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Come fare a: inserire informazioni allergologiche?</b></font>
<ul> 
	<b>1: </b>Inserire le informazioni allergologiche o CAVE nel campo <br> "<span style="background-color:yellow" > Inserire qui le nuove informazioni: </span>".<br>
  		<b>Nota: </b>E' anche possibile modificare le informazioni esistenti nel campo "<span style="background-color:yellow" > Voci correnti: </span>".<br>
  		<b>Nota: </b>Se si desidera annullare, selezionare il bottone <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>2: </b>Premere il bottone <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> to salvare le informazioni.<br>
		<b>3: </b>Se si desidera correggere un errore, selezionare i dati sbagliati e sostituirli con quelli giusti, poi salvare.<br>
		<b>4: </b>Alla fine, selezionare il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> per chiudere la finestra e tornare al grafico.<br>
</ul>
<?php endif;?>
<?php if($src=="diag_ther") : ?>
<un name="diag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Come fare a: inserire la diagnosi principale e/o la terapia?</b></font>
<ul> 
	<b>1: </b>Inserire la diagnosi o la terapia nel campo <br> "<span style="background-color:yellow" > Inserire qui le nuove informazioni: </span>".<br>
  		<b>Nota: </b>E' anche possibile modificare le informazioni esistenti nel campo "<span style="background-color:yellow" > Voci correnti: </span>".<br>
  		<b>Nota: </b>Se si desidera annullare, selezionare il bottone <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>2: </b>Premere il bottone <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> to salvare le informazioni.<br>
		<b>3: </b>Se si desidera correggere un errore, selezionare i dati sbagliati e sostituirli con quelli giusti, poi salvare.<br>
		<b>4: </b>Alla fine, selezionare il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> per chiudere la finestra e tornare al grafico.<br>
</ul>
<?php endif;?>
<?php if($src=="diag_ther_dailyreport") : ?>
<un name="daydiag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Come fare a: inserire informazioni sulla diagnosi o piano terapico giornalieri?</b></font>
<ul> 
	<b>1: </b>Inserire la diagnosi or terapia information nel campo <br> "<span style="background-color:yellow" > Inserire qui le nuove informazioni: </span>".<br>
  		<b>Nota: </b>E' anche possibile modificare le informazioni esistenti nel campo "<span style="background-color:yellow" > Voci correnti: </span>".<br>
  		<b>Nota: </b>Se si desidera annullare, selezionare il bottone <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>2: </b>Premere il bottone <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> to salvare le informazioni.<br>
		<b>3: </b>Se si desidera correggere un errore, selezionare i dati sbagliati e sostituirli con quelli giusti, poi salvare.<br>
		<b>4: </b>Alla fine, selezionare il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> per chiudere la finestra e tornare al grafico.<br>
</ul>
<?php endif;?>
<?php if($src=="xdiag_specials") : ?>
<un name="extra"><un name="diag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a></a>
Come fare a: inserire note o diagnosi aggiuntive?</b></font>
<ul> 
	<b>1: </b>Inserire le note o diagnosi aggiuntive nel campo <br> "<span style="background-color:yellow" > Inserire qui le nuove informazioni: </span>".<br>
  		<b>Nota: </b>E' anche possibile modificare le informazioni esistenti nel campo "<span style="background-color:yellow" > Voci correnti: </span>".<br>
  		<b>Nota: </b>Se si desidera annullare, selezionare il bottone <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>2: </b>Premere il bottone <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> to salvare le informazioni.<br>
		<b>3: </b>Se si desidera correggere un errore, selezionare i dati sbagliati e sostituirli con quelli giusti, poi salvare.<br>
		<b>4: </b>Alla fine, selezionare il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> per chiudere la finestra e tornare al grafico.<br>
</ul>
<?php endif;?>
<?php if($src=="kg_atg_etc") : ?>
<un name="pt"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Come fare a: inserire informazioni su terapia fisica giornaliera, ginnastica anti-trombosi, etc.?</b></font>
<ul> 
	<b>1: </b>Inserire le informazioni nel campo <br> "<span style="background-color:yellow" > Inserire qui le nuove informazioni: </span>".<br>
  		<b>Nota: </b>E' anche possibile modificare le informazioni esistenti nel campo "<span style="background-color:yellow" > Voci correnti: </span>".<br>
  		<b>Nota: </b>Se si desidera annullare, selezionare il bottone <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>2: </b>Premere il bottone <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> to salvare le informazioni.<br>
		<b>3: </b>Se si desidera correggere un errore, selezionare i dati sbagliati e sostituirli con quelli giusti, poi salvare.<br>
		<b>4: </b>Alla fine, selezionare il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> per chiudere la finestra e tornare al grafico.<br>
</ul>
<?php endif;?>
<?php if($src=="anticoag") : ?>
<un name="coag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Come fare a: inserire gli anticoagulanti?</b></font>
<ul> 
	<b>1: </b>Inserire le informazioni sugli anticoagulanti e/o il dosaggio nel campo <br> "<span style="background-color:yellow" > Inserire qui le nuove informazioni: </span>".<br>
  		<b>Nota: </b>E' anche possibile modificare le informazioni esistenti nel campo "<span style="background-color:yellow" > Voci correnti: </span>".<br>
  		<b>Nota: </b>Se si desidera annullare, selezionare il bottone <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>2: </b>Premere il bottone <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> to salvare le informazioni.<br>
		<b>3: </b>Se si desidera correggere un errore, selezionare i dati sbagliati e sostituirli con quelli giusti, poi salvare.<br>
		<b>4: </b>Alla fine, selezionare il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> per chiudere la finestra e tornare al grafico.<br>
</ul>
<?php endif;?>
<?php if($src=="anticoag_dailydose") : ?>
<un name="daycoag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Come fare a: inserire informazioni sull'applicazione giornaliera di anticoagulanti?</b></font>
<ul> 
	<b>1: </b>Type il dosaggio oppure il nome dell'erogatore nel campo <br> "<span style="background-color:yellow" > Inserire qui le nuove informazioni o modificare quelle esistenti: </span>".<br>
  		<b>Nota: </b>Se si desidera annullare, selezionare il bottone <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>2: </b>Premere il bottone <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> to salvare le informazioni.<br>
		<b>3: </b>Se si desidera correggere un errore, selezionare i dati sbagliati e sostituirli con quelli giusti, poi salvare.<br>
		<b>4: </b>Alla fine, selezionare il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> per chiudere la finestra e tornare al grafico.<br>
</ul>
<?php endif;?>
<?php if($src=="lot_mat_etc") : ?>
<un name="lot"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Come fare a: inserire note on implants, LOT nr, charge nr, etc?</b></font>
<ul> 
	<b>1: </b>Inserire le informazioni nel campo <br> "<span style="background-color:yellow" > Inserire qui le nuove informazioni: </span>".<br>
  		<b>Nota: </b>E' anche possibile modificare le informazioni esistenti nel campo "<span style="background-color:yellow" > Voci correnti: </span>".<br>
  		<b>Nota: </b>Se si desidera annullare, selezionare il bottone <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>2: </b>Premere il bottone <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> to salvare le informazioni.<br>
		<b>3: </b>Se si desidera correggere un errore, selezionare i dati sbagliati e sostituirli con quelli giusti, poi salvare.<br>
		<b>4: </b>Alla fine, selezionare il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> per chiudere la finestra e tornare al grafico.<br>
		
</ul>
<?php endif;?>
<?php if($src=="medication") : ?>
<un name="med"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Come fare a: enter medicinali e piani di dosaggio?</b></font>
<ul> 
	<b>1: </b>Inserire il medicinale nella colonna sinistra.<br> 
	<b>2: </b>Inserire il piano di dosaggio nella colonna centrale.<br> 
	<b>3: </b>Selezionare il codice colore del medicinale se necessario.<br> 
	<ul type=disc>
		<li>Bianco per normale (scelta standard).
		<li><span style="background-color:#00ff00" >Verde</span> per antibiotici e loro derivati.
		<li><span style="background-color:yellow" >Giallo</span> per dialitici.
		<li><span style="background-color:#0099ff" >Blu</span> per emolitici (coagulanti o anticoagulanti).
		<li><span style="background-color:#ff0000" >Rosso</span> per medicinali applicati via endovenosa.
	</ul>
  	<b>Nota: </b>E' anche possibile modificare le informazioni esistenti.<br>
	<b>4: </b>Inserire il proprio nome nel campo "<span style="background-color:yellow" > Infermiere/a: </span>".<br> 
  		<b>Nota: </b>Se si desidera annullare, selezionare il bottone <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>5: </b>Premere il bottone <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> per salvare.<br>
		<b>6: </b>Se si desidera correggere un errore, selezionare i dati sbagliati e sostituirli con quelli giusti, poi salvare.<br>
		<b>7: </b>Alla fine, selezionare il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> per chiudere la finestra e tornare al grafico.<br>
</ul>
<?php endif;?>
<?php if($src=="medication_dailydose") : ?>
	<?php if($x2) : ?>
<un name="daymed"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Come fare a: inserire informazioni sull'applicazione giornaliera di medicinali e loro dosaggio?</b></font>
<ul> 
	<b>1: </b>Selezionare la voce corrispondente al medicinale desiderato.<br>
	<b>2: </b>Inserire il dosaggio, chi ha effettuato l'erogazione, o i simboli di inizio/fine.<br>
  		<b>Nota: </b>Se si desidera annullare, selezionare il bottone <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>3: </b>If you have più entries, enter all of them before saving.<br>
		<b>4: </b>Premere il bottone <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> to salvare le informazioni.<br>
		<b>5: </b>Se si desidera correggere un errore, selezionare i dati sbagliati e sostituirli con quelli giusti, poi salvare.<br>
		<b>6: </b>Alla fine, selezionare il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> per chiudere la finestra e tornare al grafico.<br>
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
  		<b>Nota: </b>Se si desidera annullare, selezionare il bottone <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>8: </b>Premere il bottone <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> per salvare.<br>
		<b>9: </b>Se si desidera correggere un errore, selezionare i dati sbagliati e sostituirli con quelli giusti, poi salvare.<br>
		<b>10: </b>Alla fine, selezionare il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> per chiudere la finestra e tornare al grafico.<br>
</ul>
	<?php endif;?>
<?php endif;?>
<?php if($src=="iv_needle") : ?>
<un name="iv"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Come fare a: inserire informazioni sull'applicazione giornaliera di medicine via endovena?</b></font>
<ul> 
	<b>1: </b>Inserire il dosaggio, chi ha effettuato l'erogazione, o i simboli di inizio/fine nel campo "<span style="background-color:yellow" > Inserire qui le nuove informazioni o modificare quelle esistenti: </span>".<br>
  		<b>Nota: </b>Se si desidera annullare, selezionare il bottone <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>2: </b>Premere il bottone <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> to salvare le informazioni.<br>
		<b>3: </b>Se si desidera correggere un errore, selezionare i dati sbagliati e sostituirli con quelli giusti, poi salvare.<br>
		<b>4: </b>Alla fine, selezionare il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> per chiudere la finestra e tornare al grafico.<br>
</ul>
<?php endif;?>
</form>
