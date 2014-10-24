<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
Laboratorio fotografico - 
<?php
	switch($src)
	{
	case "init": print "Inizializzazione";
												break;
	case "input": print "Selezione foto da archiviare";
												break;
	case "maindata": print "Dati paziente";
												break;
	case "save": print "Foto archiviate";
												break;
	}
 ?></b></font>
<p><font size=2 face="verdana,arial" >
<form action="#" >
<?php if($src=="input") : ?>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Vedo i campi per l'inserimento dati: che cosa devo fare?</b>
</font>
<ul>       	
 	<b>1: </b>Premere il bottone <input type="button" value="Visualizza..."> per trovare le foto da archiviare.<br>
 	<b>2: </b>Apparirà la finestrella "Selezione file". Segliere il file da archiviare e premere "Apri".<br>
 	<b>3: </b>Se il file selezionato è in un formato grafico valido, apparirà l'anteprima dell'immagine nell'angolo in alto a destra. Altrimenti, ripetere i passi 1 e 2.<br>
 	<b>4: </b>Inserire la data in cui la foto è stata scattata nel campo "<span style="background-color:yellow" > Data foto </span>".<p>
 	<img src="../img/warn.gif" border=0> <b>Attenzione! </b>La data può essere modificata se si sceglie la funzione 'data' nei dati paziente in basso a destra .<br>
 	 Nota: se questa data deve rimanere diversa da quella inserita nei dati paziente, lasciarla per ora in bianco e riempirla in un secondo tempo.<p>
 	<b>5: </b>Inserire il numero della foto nel campo "<span style="background-color:yellow" > Numero </span>".<p>
 	<img src="../img/warn.gif" border=0> <b>Attenzione! </b>Se si desidera scegliere questa foto come "foto principale", inserire 'main' invece del numero; la  "foto principale" è quella che appare sulla
 	cartella paziente e sugli altri documenti.<p>
 	<font color="#990000">Che cosa fare dopo?</font><p>
	<b>6: </b>Trovare i dati paziente. Inserire il codice paziente nel campo "<span style="background-color:yellow" > Codice paziente </span>".<br>
 	<b>7: </b>Premere il bottone <input type="button" value="Ricerca">.<br>
 	<b>8: </b>Quando si è trovato il paziente, i suoi dati appariranno nei campi appropriati.<br>
 	<b>9: </b>Se tutte o la maggior parte delle foto risalgono alla stessa data, inserirla nel campo <nobr>"<span style="background-color:yellow" > Data foto </span>"</nobr>.<br>
 	<b>10: </b>Premere il bottone <img src="../img/preset-add.gif" border=0 align="absmiddle"> per assegnare questa data a tutte le foto. La data
 	apparirà automaticamente nel campo "Data foto" nel riquadro a sinistra.<p>
 	<img src="../img/warn.gif" border=0><b> Attenzione! </b>Se ci sono delle foto con data differente, modificare il campo "Data foto":
 	lo si può fare quando si è ultimato il passo 10.<p>
 	<b>11: </b>Premere il bottone <input type="button" value="Salva"> per salvare le foto in banca dati.<br>
</ul>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: vedere l'anteprima delle foto?</b>
</font>
<ul>       	
 	<b>1: </b>Selezionare il simbolo <img src="../img/lilcamera.gif" border=0> della foto.<br>
</ul>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Non riesco a trovare il paziente tramite il codice: non posso inserire semplicemente i dati a mano e salvare le foto?</b>
</font>
<ul>       	
 	<b>No. </b>In questa versione del programma, è possibile salvare le foto di un paziente solo se esiste un codice valido.<br>
</ul>
<?php endif;?>	
<?php if($src=="maindata") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: trovare i dati paziente?</b>
</font>
<ul>	
	<b>1: </b>Inserire il codice paziente o il codice del caso nel campo "<span style="background-color:yellow" > Codice paziente </span>".<br>
 	<b>2: </b>Premere il bottone <input type="button" value="Ricerca"> per avviare la ricerca.<br>
 	<b>3: </b>Quando il paziente viene trovato, i suoi dati appariranno nei campi appropriati.<br>
 	<b>4: </b>Se tutte o la maggior parte delle foto risalgono alla stessa data, inserirla nel campo <nobr>"<span style="background-color:yellow" > Data foto </span>"</nobr>.<br>
 	<b>5: </b>Premere il bottone <img src="../img/preset-add.gif" border=0 align="absmiddle"> per assegnare questa data a tutte le foto. La data
 	apparirà automaticamente nel campo "Data foto" nel riquadro a sinistra.<p>
 	<img src="../img/warn.gif" border=0><b> Attenzione! </b>Se ci sono delle foto con data differente, modificare il campo "Data foto":
 	lo si può fare quando si è ultimato il passo 5.<p>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Non riesco a trovare il paziente tramite il codice: non posso inserire semplicemente i dati a mano e salvare le foto?</b>
</font>
<ul>       	
 	<b>No. </b>In questa versione del programma, è possibile salvare le foto di un paziente solo se esiste un codice valido.<br>
</ul>

	<?php endif;?>	
<?php if($src=="save") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a salvare ulteriori foto dello stesso paziente?</b>
</font>
<ul>	
	<b>1: </b>Inserire il numero di foto da memorizzare nel campo <nobr>"<input type="text" name="g" size=3 maxlength=2> foto aggiuntive dello <span style="background-color:yellow" > stesso paziente. </span>"</nobr>.<br>
 	<b>2: </b>Premere il bottone <input type="button" value="OK">.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a salvare foto di un altro paziente?</b>
</font>
<ul>	
	<b>1: </b>Inserire il numero di foto da memorizzare nel campo <nobr>"<input type="text" name="g" size=3 maxlength=2> foto aggiuntive dello <span style="background-color:yellow" > stesso paziente. </span>"</nobr>.<br>
 	<b>2: </b>Premere il bottone <input type="button" value="OK">.<br>
</ul>
	<?php endif;?>	
<?php if($src=="init") : ?>
	<?php if($x1=="") : ?>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a salvare le foto in banca dati?</b>
</font>
<ul>       	
 	<b>1: </b>Prima di tutto, inizializzare. Inserire il numero di foto da memorizzare in banca dati.<br>
 	<b>2: </b>Premere il bottone <input type="button" value="OK Continua...">.<br>
 	<b>3: </b>Apparirà il modulo di inserimento foto. Premere il bottone "Aiuto" per altre istruzioni.<br>
</ul>
	<?php endif;?>	
<?php endif;?>	
	</form>
