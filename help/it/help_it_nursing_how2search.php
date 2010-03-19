<font face='Verdana, Arial' size=3 color='#0000cc'>
<b>
<?php
switch($x2)
{
	case 'search': print 'Come fare a: '; 
 						if($x1) print 'mostrare la lista occupazione letti del padiglione identificato dalla ricerca';
						else  print 'cercare un paziente';
						break;
	case 'quick': print  'Infermieri - Quadro d\'insieme dell\'occupazione padiglione';
						break;
	case 'arch': print 'Presidio infermieristico - Archivio';
}
 ?></b></font>
<p><font size=2 face='verdana,arial' >
<form action='#' >
<?php if($x2=='search') : ?>
<?php if(!$x1) : ?>
<b>1</b>

<ul> Nel campo '<span style='background-color:yellow' >Inserire un criterio di ricerca.</span>' 
	inserire un nome, un cognome o entrambi (bastano poche lettere).
		<ul type=disc><li>Esempio 1: enter 'Rossi' or 'ros'.
		<li>Esempio 2: enter 'Mario' or 'mar'.
		<li>Esempio 3: enter 'Rossi, Mar'.
	</ul>	
</ul>
<b>2</b>
<ul> Premere il bottone <input type='button' value='Ricerca'> per avviare la ricerca.<p>
</ul>
<b>3</b>
<ul> Se la ricerca trova un solo risultato, apparirà la lista di occupazione del padiglione identificato dalla ricerca.<p>
</ul>
<b>4</b>
<ul> Se la ricerca trova più risultati, apparirà una lista.<p>
</ul>
<b>Nota</b>
<ul> Per annullare la ricerca premere il bottone <img <?php echo createLDImgSrc('../','cancel.gif','absmiddle') ?>>.
</ul><?php endif;?>
<b><?php if($x1) print '1'; else print '5'; ?></b><ul>Premere il bottone <img <?php echo createComIcon('../','bul_arrowblusm.gif','absmiddle') ?>>,
 o la data , o il padiglione per mostrare la lista di occupazione.
<p><b>Nota:</b> nella lista la chiave di ricerca apparirà evidenziata.
<br><b>Nota:</b> La lista non è modificabile: se si tenta di aprire la cartella dati di un paziente selezionando il nome,
 sarà richiesto di inserire username e password.
</ul>
<?php endif;?>
<?php if($x2=='quick') : ?>
	<?php if($x1) : ?>
<img <?php echo createComIcon('../','frage.gif','absmiddle') ?>> <font color='#990000'><b>
Come fare a: visualizzare la lista di occupazione del padiglione?</b>
</font>
<ul>       	
 	<b>1: </b>Selezionare il codice o il nome del padiglione nella colonna sinistra.<br>
	<b>Nota: </b>La lista di occupazione visualizzata è di 'sola lettura'. non è possibile modificare i dati dei pazienti.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','absmiddle') ?>> <font color='#990000'><b>
Come fare a: visualizzare la lista di occupazione del padiglione per poterla modificare?</b>
</font>
<ul>       	
 	<b>1: </b>Selezionare l'icona <img <?php echo createComIcon('../','statbel2.gif','absmiddle') ?>> corrispondenti al padiglione scelto.<br>
 	<b>2: </b>Se si è già effettuato il login e si hanno i diritti di accesso sufficienti, apparirà subito la lista di occupazione.<br>
		Altrimenti, sarà richiesto di inserire username e password.<br>
 	<b>3: </b>Inserire se richiesto username e password.<br>
 	<b>4: </b>Premere il bottone <input type='button' value='Continua...'>.<br>
 	<b>5: </b>Se si hanno i diritti di accesso sufficienti, apparirà la lista di occupazione.<br>
	<b>Nota: </b>La lista di occupazione visualizzata è modificabile. Saranno presenti anche le opzioni per la modifica dei dati paziente.
		E' anche possibile aprire la cartella del paziente per ulteriori modifiche.<br>
	</ul>
	<?php else : ?>
<img <?php echo createComIcon('../','warn.gif','absmiddle') ?>> <font color='#990000'><b>
Al momento non c'è una lista di occupazione!</b>
</font><p>
<img <?php echo createComIcon('../','frage.gif','absmiddle') ?>> <font color='#990000'><b>
Come fare a: Mostrare la precedente lista di occupazione tramite l'archivio?</b>
</font>
<ul>       	
 	<b>1: </b>Click '<span style='background-color:yellow' > Selezionare per accedere all'archivio <img <?php echo createComIcon('../','bul_arrowgrnlrg.gif','absmiddle') ?>> </span>'.<br>
 	<b>2: </b>Apparirà un calendario.<br>
 	<b>3: </b>Selezionare dal calendario la data per la quale si vuole vedere la lista di occupazione.<br>
	</ul>
	<?php endif;?>
<b>Nota</b>
<ul> Per chiudere premere il bottone <img <?php echo createLDImgSrc('../','close2.gif','absmiddle') ?>>.
</ul><?php endif;?>
<?php if($x2=='arch') : ?>
<img <?php echo createComIcon('../','frage.gif','absmiddle') ?>> <font color='#990000'><b>
Come fare a: Mostrare la precedente lista di occupazione tramite l'archivio?</b>
</font>
<ul>       	
 	<b>1: </b>Selezionare dal calendario la data per la quale si vuole vedere la lista di occupazione.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','absmiddle') ?>> <font color='#990000'><b>
Come fare a: cambiare il mese del calendario?</b>
</font>
<ul>       	
 	<b>1: </b>Per passare al mese successivo, selezionare il nome nell'angolo in alto a destra del calendario.
								Ripetere l'operazione fino a quando il mese desiderato non appare.<p>
 	<b>2: </b>Per passare al mese precedente, il nome nell'angolo in alto a sinistra del calendario.
								Ripetere l'operazione fino a quando il mese desiderato non appare.<br>
	</ul>
	<?php endif;?>
</form>
