<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
Gestione padiglioni 
<?php
switch($src)
{
	case "main": print "";
						break;
	case "new": print  " - Crea un nuovo padiglione";
						break;
	case "arch": print "Presidio infermieristico - Archivio";
}
 ?></b></font>
<p><font size=2 face="verdana,arial" >
<form action="#" >
<?php if($src=="main") : ?>

<b>Creare</b>

<ul>Per creare un padiglione, selezionare questa opzione. 
	</ul>	
</ul>
<b>Profilo del padiglione</b>
<ul>Questa opzione mostra the profilo del padiglione e altri dati.
</ul>
<b>Assegna un letto</b>
<ul>Se si desidera bloccare uno o più letti in una sola volta, selezionare questa opzione. Apparirà il padiglione attualmente attivo o, se non disponibile,
il padiglione di default. Bloccare un letto richiede una password valida con diritti di accesso per questa funzione.
</ul>
<b>Privilegi di accesso</b>
<ul> Con questa opzione si possono creare, modificare, bloccare e cancellare i privilegi di accesso per un certo padiglione. Tutti i diritti di accesso
creati saranno relativi solo a quel particolare padiglione.
</ul>
<?php endif;?>
<?php if($x2=="quick") : ?>
	<?php if($x1) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: visualizzare la lista di occupazione del padiglione?</b>
</font>
<ul>       	
 	<b>1: </b>Selezionare il codice o il nome del padiglione nella colonna sinistra.<br>
	<b>Nota: </b>La lista di occupazione visualizzata è di "sola lettura". non è possibile modificare i dati dei pazienti.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: visualizzare la lista di occupazione del padiglione per poterla modificare?</b>
</font>
<ul>       	
 	<b>1: </b>Selezionare l'icona <img <?php echo createComIcon('../','statbel2.gif','0') ?>> corrispondenti al padiglione scelto.<br>
 	<b>2: </b>Se si è già effettuato il login e si hanno i diritti di accesso sufficienti, apparirà subito la lista di occupazione.<br>
		Otherwise,  sarà richiesto di inserire username e password.<br>
 	<b>3: </b>Inserire se richiesto username e password.<br>
 	<b>4: </b>Premere il bottone <input type="button" value="Continua...">.<br>
 	<b>5: </b>Se si hanno i diritti di accesso sufficienti, apparirà la lista di occupazione.<br>
	<b>Nota: </b>La lista di occupazione visualizzata è modificabile. Saranno presenti anche le opzioni per la modifica dei dati paziente.
		E' anche possibile aprire la cartella del paziente per ulteriori modifiche.<br>
	</ul>
	<?php else : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b>
Al momento non c'è una lista di occupazione!</b>
</font><p>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: Mostrare la precedente lista di occupazione tramite l'archivio?</b>
</font>
<ul>       	
 	<b>1: </b>Click "<span style="background-color:yellow" > Selezionare per accedere all'archivio <img <?php echo createComIcon('../','bul_arrowgrnlrg.gif','0') ?>> </span>".<br>
 	<b>2: </b>Apparirà un calendario.<br>
 	<b>3: </b>Selezionare dal calendario la data per la quale si vuole vedere la lista di occupazione.<br>
	</ul>
	
	<?php endif;?>
<b>Nota</b>
<ul> Per chiudere premere il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.
</ul><?php endif;?>

<?php if($src=="new") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: creare un padiglione?</b>
</font>
<ul>       	
 	<b>1: </b>Inserire il codice o il nome del padiglione nel campo "<span style="background-color:yellow" > Padiglione: </span>".<br>
 	<b>2: </b>Scegliere il reparto o la clinica a cui il padiglione appartiene nel campo "<span style="background-color:yellow" > Reparto: </span>".<br>
 	<b>3: </b>Inserire la descrizione del padiglione e altre informazioni nel campo "<span style="background-color:yellow" > Descrizione: </span>".<br>
 	<b>4: </b>Inserire il numero della prima stanza nel campo "<span style="background-color:yellow" > Numero della prima stanza: </span>".<br>
 	<b>5: </b>Inserire il numero dell'ultima stanza nel campo "<span style="background-color:yellow" > Numero dell'ultima stanza: </span>".<br>
 	<b>6: </b>Inserire il prefisso delle stanze nel campo "<span style="background-color:yellow" > Prefisso stanza: </span>".<br>
 	<b>7: </b>Inserire il nome della caposala nel campo "<span style="background-color:yellow" > Caposala: </span>".<br>
 	<b>8: </b>Inserire il nome della aiuto caposala nel campo "<span style="background-color:yellow" > Aiuto caposala: </span>".<br>
 	<b>9: </b>Inserire i nomi del personale infermieristico del padiglione nel campo "<span style="background-color:yellow" > Pers. infermieristico: </span>".<br>
 	<b>10: </b>Premere il bottone <input type="button" value="Crea padiglione"> per effettuare la creazione.<br>
	</ul>
<b>Nota</b>
<ul> Per annullare premere il bottone <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> border=0>.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Posso stabilire il numero di letti in una camera?</b>
</font>
<ul>       	
 	<b>No. </b>In questa versione del programma il numero di letti per stanza è fisso a due e non lo si può cambiare.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Posso stabilire il prefisso o codice di un letto?</b>
</font>
<ul>       	
 	<b>No. </b>In questa versione del programma il prefisso può essere soltanto 'a' oppure 'b'.<br>
	</ul>
<b>Nota</b>
<ul> Per annullare premere il bottone <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> border=0>.
</ul>
<?php endif;?>
<?php if($src=="show") : ?>
	<?php if($x1=="1") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: salvare il profilo del padiglione?</b>
</font>
<ul>       	
 	<b>1: </b>Premere il bottone <input type="button" value="Salva">.<br>
	</ul>
<b>Nota</b>
<ul> Per annullare premere il bottone <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> border=0>.
</ul>
	<?php else : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: modificare il profilo del padiglione?</b>
</font>
<ul>       	
 	<b>1: </b>Premere il bottone <input type="button" value="Modifica profilo del padiglione">.<br>
	</ul>
<b>Nota</b>
<ul> Per annullare premere il bottone <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> border=0>.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Desidero modificare il profilo di un padiglione diverso da quello mostrato ora. Che devo fare?</b>
</font>
<ul>       	
 	<b>1:</b> Selezionare il link "<span style="background-color:yellow" > <img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>> Altri padiglioni </span>" per vedere l'elenco dei padiglioni.<br>
 	<b>2:</b> Selezionare il padiglione da modificare.
	</ul>
<b>Nota</b>
<ul> Per annullare premere il bottone <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> border=0>.
</ul>
<?php endif;?>
<?php endif;?>
<?php if($src=="") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: scegliere un padiglione per modificarne il profilo?</b>
</font>
<ul>       	
 	<b>1: </b>Selezionare dalla lista il padiglione da modificare.<br>
	</ul>
<b>Nota</b>
<ul> Per annullare premere il bottone <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> border=0>.
</ul>
<?php endif;?>
</form>
