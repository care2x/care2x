<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
Documentazione di sala operatoria - 
<?php
if($src=="create")
{
	switch($x1)
	{
	case "dummy": print "Creare un nuovo documento";
						break;
	case "": print "Creare un nuovo documento";
						break;
	case "saveok": print  " - Il documento è stato salvato";
						break;
	case "update": print "Aggiornare il documento corrente";
	}
}
if($src=="search")
{
	switch($x1)
	{
	case "dummy": print "Ricerca di un documento";
						break;
	case "": print "Ricerca di un documento";
						break;
	case "match": print  "List of search results";
						break;
	case "select": print "Registro del paziente";
	}
}
if($src=="arch")
{
	switch($x1)
	{
	case "dummy": print "Archivio";
						break;
	case "": print "Archivio";
						break;
	case "?": print "Archivio";
						break;
	case "search": print  "Risultati della ricerca in archivio";
						break;
	case "select": print "Registro del paziente";
	}
}
 ?></b></font>
<p><font size=2 face="verdana,arial" >
<form action="#" >
<?php if($src=="create") : ?>


<?php if($x1=="saveok") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: modificare il documento corrente?</b>
</font>
<ul>       	
 	<b>1: </b>Premere il bottone <input type="button" value="Aggiorna i dati"> per passare al modo modifica.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: creare un nuovo documento?</b>
</font>
<ul>       	
 	<b>1: </b>Premere il bottone <input type="button" value="Crea un nuovo documento">.<br>
	</ul>
<b>Nota</b>
<ul> Per chiudere premere il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.
</ul>
<?php endif;?>
<?php if($x1=="update") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: modificare il documento corrente?</b>
</font>
<ul>       	
 	<b>1: </b>Dopo essere passati al modo modifica, è possibile modificare i dati.<br> 
 	<b>2: </b>Per salvare il documento, premere il bottone <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> .<br> 
	</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 Per chiudere premere il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.
</ul>
<?php endif;?>
<?php if($x1=="dummy") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: creare un nuovo documento?</b>
</font>
<ul>       	
 	<b>1: </b>Prima di tutto, trovare il paziente inserendo nel campo "<span style="background-color:yellow" > Criterio di ricerca <input type="text" name="m" size=20 maxlength=20> </span>" 
 	il nome o il cognome del paziente (bastano poche lettere).<br>
 	<b>2: </b>Premere il bottone <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> per attivare la ricerca.<p> 
<ul>       	
 	<b>Nota: </b>Se la ricerca trova un solo risultato, i dati fondamentali del paziente saranno copiati nei campi appropriati.<p> 
 	<b>Nota: </b>Se invece ci sono più risultati, apparirà un elenco. Selezionare il cognome del paziente per selezionare la sua documentazione.<p> 
	</ul>
 	<b>3: </b>Dopo aver caricato i dati fondamentali, è possibile aggiungere altre
 	informazioni aggiuntive nei campi appropriati.<br> 
 	<b>4: </b>Per salvare il documento, premere il bottone <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> .<br> 
	</ul>
	<?php endif;?>
<?php endif;?>
<?php if($src=="search") : ?>
	<?php if(($x1=="dummy")||($x1=="")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: cercare il documento per un determinato paziente?</b>
</font>
<ul>       	
 	<b>1: </b>Inserire nel campo "<span style="background-color:yellow" > Chiave di ricerca: es. nome o cognome <input type="text" name="m" size=20 maxlength=20> </span>" 
	il nome o il cognome del paziente (bastano poche lettere).<br>
 	<b>2: </b>Premere il bottone <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> per attivare la ricerca.<p> 
<ul>       	
 	<b>Nota: </b>Se la ricerca trova un solo risultato, i dati del paziente saranno visualizzati subito.<p> 
 	<b>Nota: </b>Se invece ci sono più risultati, apparirà un elenco. Selezionare il cognome del paziente, la data o il codice operazione per vedere la documentazione.<p> 
	</ul>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 Per chiudere premere il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.
</ul>
	<?php endif;?>
<?php if(($x1=="match")&&($x2>0)) : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: selezionare uno specifico documento da visualizzare?</b>
</font>
<ul>       	
 	<b>Nota: </b> Selezionare il cognome del paziente, oppure  data o codice operazione per visualizzare i suoi documenti.<p> 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: continuare la ricerca?</b>
</font>
<ul>       	
 	<b>1: </b>Inserire nel campo "<span style="background-color:yellow" > Chiave di ricerca: es. nome o cognome <input type="text" name="m" size=20 maxlength=20> </span>" 
	il nome o il cognome del paziente (bastano poche lettere).<br>
 	<b>2: </b>Premere il bottone <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> per attivare la ricerca.<p> 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 Per chiudere premere il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.
</ul>
	<?php endif;?>
<?php if(($x1=="select")&&($x2==1)) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: modificare il documento corrente?</b>
</font>
<ul>       	
 	<b>1: </b>Premere il bottone <input type="button" value="Aggiorna i dati"> per passare al modo modifica.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: continuare la ricerca?</b>
</font>
<ul>       	
 	<b>1: </b>Inserire nel campo "<span style="background-color:yellow" > Chiave di ricerca: es. nome o cognome <input type="text" name="m" size=20 maxlength=20> </span>" 
	il nome o il cognome del paziente (bastano poche lettere).<br>
 	<b>2: </b>Premere il bottone <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> per attivare la ricerca.<p> 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 Per chiudere premere il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.
</ul>
<?php endif;?>
<?php endif;?>
<?php if($src=="arch") : ?>
	<?php if(($x1=="dummy")||($x1=="?")||($x1=="")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Desidero l'elenco di tutti i documenti delle operazioni fatte in una certa data</b></font>
<ul> <b>1: </b>Inserire la data nel campo "<span style="background-color:yellow" > Data operazione: </span>". <br>
		<ul><font size=1 color="#000099">
		<!-- <b>Nota:</b> Inserire "O" oppure "o" (oggi) per usare automaticamente la data odierna.<br>
		<b>Nota:</b> Enter "I" oppure "i" (ieri) per usare automaticamente la data di ieri.<br> -->
		</font>
		</ul><b>2: </b>Lasciare in bianco gli altri campi.<br>
		<b>3: </b>Premere il bottone <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  per avviare la ricerca.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Desidero la documentazione delle operazioni fatte ad un certo paziente</b></font>
<ul> <b>1: </b>Inserire la chiave di ricerca nel campo appropriato. Può essere una parola completa,
una frase o un insieme di lettere presenti nei dati personali del paziente. <br>
		<ul><font size=1 color="#000099" >
		<b>Ecco i campi che è possibile usare come chiave:</b>
		<br> Codice paziente
		<br> Cognome
		<br> Nome
		<br> Data di nascita
		</font>
		</ul><b>2: </b>Lasciare in bianco gli altri campi.<br>
		<b>3: </b>Premere il bottone <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  per avviare la ricerca.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Desidero la documentazione delle operazioni fatte da un certo chirurgo.</b></font>
<ul> <b>1: </b>Inserire il nome del chirurgo nel campo "<span style="background-color:yellow" > Chirurgo: </span>". <br>
		<b>2: </b>Lasciare in bianco gli altri campi.<br>
		<b>3: </b>Premere il bottone <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  per avviare la ricerca.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Desidero la documentazione delle operazioni fatte a pazienti esterni</b></font>
<ul> <b>1: </b>Selezionare la casella "<span style="background-color:yellow" >Paziente esterno <input type="radio" name="r" value="1"></span>". <br>
		<b>2: </b>Lasciare in bianco gli altri campi.<br>
		<b>3: </b>Premere il bottone <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  per avviare la ricerca.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Desidero la documentazione delle operazioni fatte a pazienti interni </b></font>
<ul> <b>1: </b>Selezionare la casella "<span style="background-color:yellow" ><input type="radio" name="r" value="1">Paziente interno</span>". <br>
		<b>2: </b>Lasciare in bianco gli altri campi.<br>
		<b>3: </b>Premere il bottone <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  per avviare la ricerca.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Desidero la documentazione delle operazioni fatte a pazienti in mutua</b></font>
<ul> <b>1: </b>Selezionare la casella "<span style="background-color:yellow" ><input type="radio" name="r" value="1">Mutua</span>". <br>
		<b>2: </b>Lasciare in bianco gli altri campi.<br>
		<b>3: </b>Premere il bottone <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  per avviare la ricerca.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Desidero la documentazione delle operazioni fatte a pazienti con assicurazione privata</b></font>
<ul> <b>1: </b>Selezionare la casella "<span style="background-color:yellow" ><input type="radio" name="r" value="1">Privato</span>". <br>
		<b>2: </b>Lasciare in bianco gli altri campi.<br>
		<b>3: </b>Premere il bottone <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  per avviare la ricerca.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Desidero la documentazione delle operazioni fatte a pazienti a proprio carico </b></font>
<ul> <b>1: </b>Selezionare la casella "<span style="background-color:yellow" ><input type="radio" name="r" value="1">A proprio carico</span>". <br>
		<b>2: </b>Lasciare in bianco gli altri campi.<br>
		<b>3: </b>Premere il bottone <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  per avviare la ricerca.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Desidero la documentazione delle operazioni che contengono una certa parola</b></font>
<ul> <b>1: </b>Inserire la chiave di ricerca nel campo appropriato. Può essere una parola completa,
una frase o un insieme di lettere. <br>
		<ul><font size=2 color="#000099" >
		<b>Esempio:</b> Inserire una parola del mondo diagnostico nel campo "Diagnosi".<br>
		<b>Esempio:</b> Inserire una parola del mondo terapeutico nel campo "Terapia".<br>
		<b>Esempio:</b> Per cercare parole nelle note speciali, inserirle nel campo "Nota speciale".<br>
		</font>
		</ul><b>2: </b>Lasciare in bianco gli altri campi.<br>
		<b>3: </b>Premere il bottone <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  per avviare la ricerca.<br>
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Desidero la documentazione delle operazioni classificate in un determinato modo</b></font>
<ul> <b>1: </b>Inserire la chiave di ricerca nel campo appropriato. Può essere una parola completa,
una frase o un insieme di lettere. <br>
		<ul><font size=2 color="#000099" >
		<b>Esempio:</b> Per operazioni minori inserire il codice nel campo "<span style="background-color:yellow" > <input type="text" name="m" size=4 maxlength=2> minore </span>".<br>
		<b>Esempio:</b> Per operazioni medie inserire il codice nel campo "<span style="background-color:yellow" > <input type="text" name="m" size=4 maxlength=2> media </span>".<br>
		<b>Esempio:</b> Per operazioni maggiori inserire il codice nel campo "<span style="background-color:yellow" > <input type="text" name="m" size=4 maxlength=2> maggiore </span>".<br>
		</font>
		</ul><b>2: </b>Lasciare in bianco gli altri campi.<br>
		<b>3: </b>Premere il bottone <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  per avviare la ricerca.<br>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>><b><font color="#990000"> Nota:</font></b>
<ul> Si possono combinare più condizioni di ricerca, per esempio per trovare la lista dei pazienti interni operate dal medico "Bianchi" 
		e che hanno avuto una terapia che comincia per "lipo":<p>
		<b>1: </b>Inserire "Bianchi" nel campo "<span style="background-color:yellow" > Chirurgo: <input type="text" name="s" size=15 maxlength=4 value="Bianchi"> </span>".<br>
		<b>2: </b>Selezionare la casella "<span style="background-color:yellow" > <input type="radio" name="r" value="1" checked>Paziente interno </span>".<br>
		<b>3: </b>Inserire "lipo" nel campo "<span style="background-color:yellow" > Terapia: <input type="text" name="s" size=20 maxlength=4 value="lipo"> </span>". <br>
		<b>4: </b>Premere il bottone <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  per avviare la ricerca.<p>
<b>Nota</b><br>
 	<b>Nota: </b>Se la ricerca trova un solo risultato, i dati appariranno subito.<p> 
 	<b>Nota: </b>Se invece ci sono più risultati, apparirà un elenco.<br>
 	Per aprire i documenti del paziente desiderato, premere o il bottone <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> corrispondente, o
 	il nome, il cognome, la data o il codice dell'operazione.
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 Per chiudere premere il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.
</ul>
	<?php endif;?>
<?php if(($x1=="search")&&($x2>0)) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: visualizzare un determinato documento?</b>
</font>
<ul>       	
 	<b>Nota: </b> Selezionare il cognome del paziente, il nome, oppure data o codice operazione per visualizzare il documento.<p> 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: continuare la ricerca negli archivi?</b>
</font>
<ul>       	
 	<b>1: </b>Premere il bottone <input type="button" value="Nuova ricerca in archivio"> per tornare alla ricerca.<p> 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 Per chiudere premere il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.
</ul>
	<?php endif;?>
<?php if(($x1=="select")&&($x2==1)) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: modificare il documento visualizzato?</b>
</font>
<ul>       	
 	<b>1: </b>Premere il bottone <input type="button" value="Aggiorna i dati"> per passare al modo modifica.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: continuare la ricerca in archivio?</b>
</font>
<ul>       	
 	<b>1: </b>Premere il bottone <input type="button" value="Nuova ricerca in archivio"> per tornare alla ricerca.<p> 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 Per chiudere premere il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.
</ul>
<?php endif;?>
<?php endif;?>
</form>
