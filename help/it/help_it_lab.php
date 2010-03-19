<font face="Verdana, Arial" size=3 color="#0000cc">
<?php error_reporting(E_ALL); ?>
<b>
Laboratorio medico - 
<?php
if($src=="create")
{
	switch($x1)
	{
	case "": print "Creazione di un nuovo registro";
						break;
	case "fresh": print "Creazione di un nuovo registro";
						break;
	case "get": print  "";
						break;
	case "logmain": print "Modifica di un registro esistente";
						break;
	default: print "Registrazione di una nuova operazione";	
	}
}
if($src=="time")
{
	print "Registrazione di ";
	switch($x1)
	{
	case "entry_out": print "tempi di inizio e fine";
						break;
	case "cut_close": print "tempi di taglio e sutura";
						break;
	case "wait_time": print "tempi di attesa (inattività)";
						break;
	case "bandage_time": print "tempi di fasciatura";
						break;
	case "repos_time": print "tempi di riposizionamento";
	}
}
if($src=="person")
{
	print "Registrazione di ";
	switch($x1)
	{
	case "operator":$person="medico chirurgo"; 
						break;
	case "assist":$person="aiuto chirurgo"; 
						break;
	case "scrub": $person="assistente sterile";
						break;
	case "rotating":$person="assistente non sterile"; 
						break;
	case "ana": $person="anestesista";
	}
	print $person;
}
if($src=="search")
{
	print "Ricerca di un paziente";	
/*	switch($x1)
	{
	case "search": print "Selezione di un documento specifico";
						break;
	case "": 
						break;
	case "get": print  "Registro delle operazioni ad un paziente";
						break;
	case "fresh": print "Ricerca di un'operazione registrata";
	}
*/}
if($src=="arch")
{
	print "Archive";	
	/*switch($x1)
	{
	case "dummy": print "Archivio";
						break;
	case "": print "Archivio";
						break;
	case "?": print "Archivio";
						break;
	case "search": print  "Risultati della ricerca negli archivi";
						break;
	case "select": print "Documenti del paziente";
	}*/
}
if($src=="input")
{
	print "Inserire i risultati del test";
	/*switch($x1)
	{
	case "dummy": print "Archivio";
						break;
	case "": print "Archivio";
						break;
	case "?": print "Archivio";
						break;
	case "search": print  "Risultati della ricerca negli archivi";
						break;
	case "select": print "Documenti del paziente";
	}*/
}
 ?></b></font>
<p><font size=2 face="verdana,arial" >
<form action="#" >
<?php if($src=="person") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come inserire <?php echo $person ?> tramite la lista di selezione rapida?</b>
</font>
<ul>       	
 	<b>Nota: </b>Se si è scelto <?php echo $person ?> in un'operazione precedente, il nome sarà mostrato nella lista di selezione rapida.<p>
 	<b>1: </b>Controllare che la sua funzione sia scelta correttamente nella casella " Sala Operatoria "; altrimenti, scegliere la funzione di sala corretta.<br>
 	<b>2: </b>Selezionare Cognome o Nome di <?php echo $person ?>, oppure 
	<nobr>"<span style="background-color:yellow" > <img <?php echo createComIcon('../','uparrowgrnlrg.gif','0') ?>> Inserire questa persona come link <?php echo $person ?>... </span>"</nobr>.
	Il chirurgo sarà automaticamente aggiunto nell'elenco "current entries".<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
<?php echo ucfirst($person) ?> non appare nella lista di selezione rapida: come inserirla?</b>
</font>
<ul>       	
 	<b>1: </b>Inserire il nome o il cognome (o le prime lettere che lo compongono) nel campo nome o cognome di <?php echo $person ?> nel campo "<span style="background-color:yellow" > Ricerca nuova <?php echo substr($person,2) ?>... </span>".<br>
 	<b>2: </b>Selezionare il bottone <input type="button" value="OK"> per iniziare la ricerca di <?php echo $person ?>.<br>
 	<b>3: </b>A fine ricerca appariranno i risultati: clickare il nome, il cognome o <nobr>"<span style="background-color:yellow" > <img <?php echo createComIcon('../','uparrowgrnlrg.gif','0') ?>> Inserire persona come<?php echo $person ?>... </span>"</nobr> corrispondente a <?php echo $person ?> per cui si inseriscono i dati.
</ul>


<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b> Come cancellare <?php echo $person ?> dall'elenco?</b></font> 
<ul>       	
 	Selezionare l'icona <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> a destra del nome.<br>
 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b> Ho finia: come faccio a tornare al registro?</b></font> 
<ul>       	
 	Selezionare il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle"> che appare dopo aver selezionato <?php echo $person ?>.<br>
 
</ul><img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>Premere <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> border=0> per annullare l'operazione.</ul>
<?php endif;?>

<?php if($src=="time") : ?>
	<?php if($x1=="entry_out") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come documentare gli orari di inizio e fine?</b>
</font>
<ul>       	
 	<b>1: </b>Inserire l'orario di inizio nel campo "<span style="background-color:yellow" > da: <input type="text" name="d" size=5 maxlength=5> </span>" nella colonna a sinistra.<br>
 	<b>2: </b>Inserire l'orario di fine nel campo "<span style="background-color:yellow" > a: <input type="text" name="d" size=5 maxlength=5> </span>" nella colonna a destra.<p>
<ul>       	
 	<b>Nota: </b>Premere "A" oppure "a" (adesso) per inserire automaticamente l'orario corrente.
</ul><br>
 	<b>Nota: </b>E' possibile inserire più orari di inizio e fine e salvare tutto in una volta.<p>
</ul>

	<?php endif;?>
	<?php if($x1=="cut_close") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come documentare tempi di taglio e sutura?</b>
</font>
<ul>       	
 	<b>1: </b>Inserire l'orario di taglio nel campo "<span style="background-color:yellow" > da: <input type="text" name="d" size=5 maxlength=5> </span>" nella colonna di sinistra.<br>
 	<b>2: </b>Inserire l'orario di sutura nel campo "<span style="background-color:yellow" > a: <input type="text" name="d" size=5 maxlength=5> </span>" nella colonna di destra.<p>
<ul>       	
 	<b>Nota: </b>Premere "A" oppure "a" (adesso) per inserire automaticamente l'orario corrente.
</ul><br>
 	<b>Nota: </b>E' possibile inserire più orari di taglio e sutura e salvare tutto in una volta.<p>
</ul>

	<?php endif;?>
	<?php if($x1=="wait_time") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come documentare il tempo di attesa?</b>
</font>
<ul>       	
 	<b>1: </b>Inserire il tempo iniziale nel campo "<span style="background-color:yellow" > da: <input type="text" name="d" size=5 maxlength=5> </span>" field nella prima colonna.<br>
 	<b>2: </b>Inserire il tempo finale nel campo "<span style="background-color:yellow" > a: <input type="text" name="d" size=5 maxlength=5> </span>" field nella seconda colonna.<p>
<ul>       	
 	<b>Nota: </b>Premere "A" oppure "a" (adesso) per inserire automaticamente l'orario corrente.
</ul><br>
 	<b>3: </b>Scegliere la ragione dell'attesa tra quelle elencate nella terza colonna (Causa).<p>
 	<b>Nota: </b>E' possibile inserire più tempi iniziali, finali e ragioni e salvare tutto in una volta.<p>
</ul>

	<?php endif;?>
	<?php if($x1=="bandage_time") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come documentare i tempi di fasciatura?</b>
</font>
<ul>       	
 	<b>1: </b>Inserire il tempo iniziale nel campo "<span style="background-color:yellow" > da: <input type="text" name="d" size=5 maxlength=5> </span>" field nella colonna di sinistra.<br>
 	<b>2: </b>Inserire il tempo finale nel campo "<span style="background-color:yellow" > a: <input type="text" name="d" size=5 maxlength=5> </span>" field nella colonna di destra.<p>
<ul>       	
 	<b>Nota: </b>Premere "A" oppure "a" (adesso) per inserire automaticamente l'orario corrente.
</ul><br>
 	<b>Nota: </b>E' possibile inserire più tempi iniziali e finali e salvare tutto in una volta.<p>
</ul>

	<?php endif;?>
	<?php if($x1=="repos_time") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come documentare tempi di riposizionamento?</b>
</font>
<ul>       	
 	<b>1: </b>Inserire il tempo iniziale nel campo "<span style="background-color:yellow" > da: <input type="text" name="d" size=5 maxlength=5> </span>" nella colonna di sinistra.<br>
 	<b>2: </b>Inserire il tempo finale nel campo "<span style="background-color:yellow" > a: <input type="text" name="d" size=5 maxlength=5> </span>" nella colonna di destra.<p>
<ul>       	
 	<b>Nota: </b>Premere "A" oppure "a" (adesso) per inserire automaticamente l'orario corrente.
</ul><br>
 	<b>Nota: </b>E' possibile inserire più orari di inizio e fine e salvare tutto in una volta.<p>
</ul>

	<?php endif;?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come salvare le informazioni?</b>
</font>
<ul>       	
 	<b>1: </b>Selezionare il bottone <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> per salvare<br>
 	<b>2: </b>Al termine, selezionare il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> per chiudere la finestra e tornare al registro.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b> Voglio cancellare dei dati, ma premendo su "Annulla dati" non succede niente. Che faccio?</b></font> 
<ul>       	
 	<b>Attenzione: </b>Il bottone "Annulla dati" cancella solo i dati non ancora salvati; ecco invece la procedura per cancellare
 	dei dati già salvati:<p>
 	<b>1: </b>Selezionare i campi che si vogliono cancellare relativi ad un certo orario.<br>
 	<b>2: </b>Cancellare gli orari manualmente con i tasti "Del" o "Backspace".<br>
 	<b>3: </b>Selezionare il bottone <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> per salvare.<br>
 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>Premere <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> border=0> per annullare l'operazione.</ul>
<?php endif;?>


<?php if($src=="create") : ?>
	<?php if($x1=="logmain") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come modificare la documentazione di un'operazione</b>
</font>
<ul>       	
 	<b>1: </b>Selezionare il bottone <img src="../img/update3.gif" width=15 height=14 border=0> che corrisponde alla documentazione paziente da cambiare.<br>
 	<b>2: </b>I dati saranno copiati nell'editor, e sarà a questo punto possibile modificarli seguendo le istruzioni per
 	documentare l'operazione.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come aprire la cartella dei dati paziente</b>
</font>
<ul>       	
 	<b>1: </b>Selezionare il bottone <img <?php echo createComIcon('../','info3.gif','0') ?>> a sinistra del codice paziente.<br>
 	<b>2: </b>Apparirà una finestrella con i dati paziente.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come spostare ad un altro dipartimento e/o sala operatoria</b>
</font>
<ul>       	
 	<b>1: </b>Scegliere il dipartimento dall'elenco
				<select name="dept" size=1>
				<?php
					$Or2Dept=get_meta_tags("../global_conf/resolve_or2ordept.pid");
					$opabt=get_meta_tags("../global_conf/$lang/op_tag_dept.pid");

					while(list($x,$v)=each($opabt))
					{
						if($x=="anaesth") continue;
						print'
					<option value="'.$x.'"';
						if ($dept==$x) print " selezionato";
						print '> '.$v.'</option>';
					}
				?>
					
				</select>.
<br>
 	<b>2: </b>Scegliere la sala operatoria dall'elenco <select name="saal" size=1 >
				<?php

					while(list($x,$v)=each($Or2Dept))
					{
						print'
					<option value="'.$x.'"';
						if ($saal==$x) print " selezionata";
						print '> '.$x.'</option>';
					}
				?>
				</select>.
<br>
 	<b>3: </b>Selezionare il bottone <input type="button" value="Change"> per spostare ad altro dipartimento e/o sala operatoria.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come visualizzare il registro per un giorno diverso da quello mostrato in questo momento</b>
</font>
<ul>       	
 	<b>1: </b>Per il registro di giorni precedenti, selezionare il link "<span style="background-color:yellow" > Precedente </span>" nell'angolo in alto a sinistra della tabella.<br>
	Premere il link tante volte quanti sono i giorni di cui si vuole retrocedere.<br>
 	<b>2: </b>Se invece si vuole il registro di giorni successivi, utilizzare il link "<span style="background-color:yellow" > Next day </span>" in alto a destra,<br>
 	premendolo tante volte quanti sono i giorni di cui si vuole avanzare.<br>
</ul>

<hr>

	<?php endif;?>
	
	<?php if($x2=="material") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come documentare il materiale usato per l'operazione</b>
</font>
<ul>       	
 	<b>1: </b>Inserire il codice articolo del materiale nel campo "<span style="background-color:yellow" > N. articolo: </span>".<p>
	<b>In alternativa: </b>
	<ul type=disc>  	
	<li>Inserire il nome del materiale (bastano anche poche lettere), o la descrizione, il numero di licenza o di ordine nel campo "<span style="background-color:yellow" > N. articolo: </span>".
	<li>Leggere il codice a barre dell'articolo con l'apposito lettore.
	</ul><br> 
 	<b>2: </b>Selezionare <input type="button" value="OK"> o premere il tasto "enter" per cercare il prodotto.<p> 
<ul>       	
 	<b>Nota: </b>Se la ricerca identifica un risultato, i dati del materiale sono copiati subito nel documento.<p> 
 	<b>Nota: </b>Se invece ci sono più risultati, apparirà una lista: selezionando il bottone <img <?php echo createComIcon('../','bul_arrowgrnlrg.gif','0') ?>> oppure numero o nome dell'articolo desiderato, lo si inserirà nel documento.<p> 
	</ul>
 	<b>3: </b>Una volta aggiunto l'articolo, si può cambiare la quantità nel campo "<span style="background-color:yellow" > pezzi </span>" se necessario.<p> 
<ul>       	
 	<b>Nota: </b>Una volta inserita la quantità, compariranno i bottoni "Salva" ed "Annulla".<p> 
	</ul>
 	<b>4: </b>Se si cambia il numero di pezzi, scegliere il bottone <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> per salvare.<p> 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come rimuovere un articolo dall'elenco?</b>
</font>
<ul> 
 	<b>1: </b>Selezionare l'icona <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> corrispondente all'articolo.<br> 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
L'articolo non è presente. Si può forzarne l'inserimento a mano?</b>
</font>
<ul> 
 	<b>1: </b>selezionare il link "<span style="background-color:yellow" > <img <?php echo createComIcon('../','accessrights.gif','0') ?>> Forza inserimento manuale . </span>".<br> 
 	<b>2: </b>Inserire manualmente le informazioni sul materiale nei vari campi.<p> 
 	<b>3: </b>Selezionare il bottone <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> per aggiungere l'articolo nel documento<p> 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>Premere <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> border=0> per annullare l'operazione.</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come tornare al registro principale?</b>
</font>
<ul> 
 	<b>1: </b>selezionare il link "<span style="background-color:yellow" > <img <?php echo createComIcon('../','manfldr.gif','0') ?>> Registro </span>".<br> 
</ul>
<hr>
	<?php endif;?>

	<?php if(($x1=="")||($x1=="fresh")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come creare il registro di un'operazione?</b>
</font>
<ul>       	
 	<b>1: </b>Prima di tutto, trovare il paziente inserendo il codice nel campo "<span style="background-color:yellow" > Codice paziente: </span>".<p>
	<b>In alternativa: </b>
	<ul type=disc>  	
	<li>Inserire nome o cognome del paziente (bastano poche lettere) nel campo "<span style="background-color:yellow" > Nome, cognome </span>".
	<li>Inserire la data di nascita (bastano poche cifre) nel campo "<span style="background-color:yellow" > Data di nascita </span>".
	</ul>
 	<b>2: </b>selezionare il bottone <input type="button" value="Cerca"> per iniziare la ricerca.<p> 
<ul>       	
 	<b>Nota: </b>Se la ricerca identifica un risultato, i dati del paziente sono copiati subito nei campi appropriati.<p> 
 	<b>Nota: </b>Se invece ci sono più risultati, apparirà una lista: selezionare il nome o cognome del paziente per inserire i dati nel documento.<p> 
	</ul>
 	<b>3: </b>selezionare di nuovo il bottone <img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>> per altre istruzioni.<p> 

</ul>

	<?php else : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come inserire la diagnosi</b>
</font>
<ul>       	
 	<b>1: </b>Inserire la diagnosi nel campo "<span style="background-color:yellow" > Diagnosi: </span>".<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come inserire informazioni sul chirurgo</b>
</font>
<ul>       	
 	<b>1: </b>selezionare il link "<span style="background-color:yellow" > Chirurgo </span>".<br>
 	<b>2: </b>Apparirà una finestrella in cui inserire le informazioni.<br>
 	<b>3: </b>Seguire le istruzioni nella finestra o premere il bottone "Help" per ricevere aiuto. <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come inserire informazioni sull'aiuto chirurgo</b>
</font>
<ul>       	
 	<b>1: </b>selezionare il link "<span style="background-color:yellow" > Aiuto chirurgo </span>".<br>
 	<b>2: </b>Apparirà una finestrella in cui inserire le informazioni.<br>
 	<b>3: </b>Seguire le istruzioni nella finestra o premere il bottone "Help" per ricevere aiuto. <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come inserire informazioni sugli assistenti sterili</b>
</font>
<ul>       	
 	<b>1: </b>selezionare il link "<span style="background-color:yellow" > Assistente sterile </span>".<br>
 	<b>2: </b>Apparirà una finestrella in cui inserire le informazioni.<br>
 	<b>3: </b>Seguire le istruzioni nella finestra o premere il bottone "Help" per ricevere aiuto. <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come inserire informazioni sugli assistenti non sterili</b>
</font>
<ul>       	
 	<b>1: </b>selezionare il link "<span style="background-color:yellow" > Assistente non sterile </span>".<br>
 	<b>2: </b>Apparirà una finestrella in cui inserire le informazioni.<br>
 	<b>3: </b>Seguire le istruzioni nella finestra o premere il bottone "Help" per ricevere aiuto. <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come inserire il tipo di anestesia usato per l'operazione</b>
</font>
<ul>       	
 	<b>1: </b>Scegliere il tipo di anestesia dal campo elenco "<span style="background-color:yellow" > Anestesia <select name="a">
                                                                     	<option > GEN</option>
                                                                     	<option > ARA</option>
                                                                     	<option > PER/option>
                                                                     	<option > NRV</option>
                                                                     	<option > LOC</option>
                                                                     </select> </span>".<p>
	<ul type=disc>       	
 	<li><b>GEN: </b>Anestesia generale<br>
 	<li><b>ARA: </b>Anestesia subaracnoidea<br>
 	<li><b>PER: </b>Anestesia peridurale<br>
 	<li><b>NRV: </b>Anestesia dei nervi<br>
 	<li><b>LOC: </b>Anestesia locale<br>
	</ul>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come inserire informazioni sull'anestesista</b>
</font>
<ul>       	
 	<b>1: </b>selezionare il link "<span style="background-color:yellow" > Anestesista </span>".<br>
 	<b>2: </b>Apparirà una finestrella in cui inserire le informazioni.<br>
 	<b>3: </b>Seguire le istruzioni nella finestra o premere il bottone "Help" per ricevere aiuto. <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come inserire tempi di inizio, taglio, sutura e fine direttamente nei campi corrispondenti</b>
</font>
<ul>       	
 	<b>Tempo di inizio: </b>Inserire il tempo nel campo "<span style="background-color:yellow" > Inizio:<input type="text" name="t" size=5 maxlength=5> </span>".<br>
 	<b>Tempo di taglio: </b>Inserire il tempo nel campo "<span style="background-color:yellow" > Tagli: <input type="text" name="t" size=5 maxlength=5> </span>".<br>
 	<b>Tempo di sutura: </b>Inserire il tempo nel campo "<span style="background-color:yellow" > Sutura: <input type="text" name="t" size=5 maxlength=5> </span>".<br>
 	<b>Tempo di fine: </b>Inserire il tempo nel campo "<span style="background-color:yellow" > Uscita: <input type="text" name="t" size=5 maxlength=5> </span>".<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come inserire più tempi in una volta sola</b>
</font>
<ul> <b>1: </b><p>    	
 	<b>Tempi di inizio/fine: </b>
 	selezionare "<span style="background-color:yellow" > inizio/fine <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>" nell'angolo in basso a sinistra.<p>
 	<b>Tempi di taglio/sutura:</b>
 	selezionare "<span style="background-color:yellow" > taglio/sutura <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>" nell'angolo in basso a sinistra.<p>
 	<b>Tempi di attesa: </b>
 	selezionare "<span style="background-color:yellow" > attesa <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>" nell'angolo in basso a sinistra.<p>
 	<b>Tempi di fasciatura/ingessatura:</b>
 	selezionare "<span style="background-color:yellow" > fasciatura/ingessatura <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>" nell'angolo in basso a sinistra.<p>
 	<b>Tempi di riposizionamento: </b>
 	selezionare "<span style="background-color:yellow" > riposizionamento <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>" nell'angolo in basso a sinistra.<p>
 	<b>2: </b>Apparirà una finestralla in cui inserire il tempo impiegato. <br>
 	<b>3: </b>Seguire le istruzioni o selezionare "Help" per ottenere altre informazioni. <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come inserire un tempo nel diagramma grafico dei tempi</b>
</font>
<ul> <b>1: </b>Posizionarsi con il mouse sul punto nella scala dei tempi corrispondente al tipo desiderato (es. Fasciatura/ingessatura).<br>
 	<b>2: </b>Selezionare l'orario sulla scala dei tempi.<p>
<b>Nota:</b> Il primo campo sarà il tempo iniziale, il secondo quello finale, il terzo sarà il successivo tempo iniziale e così via
	</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come inserire informazioni sulla terapia o l'operazione</b>
</font>
<ul>       	
 	<b>1: </b>Inserire le informazioni nel campo "<span style="background-color:yellow" > Terapia/Operazione: </span>".<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come inserire risultati, osservazioni ed altre note</b>
</font>
<ul>       	
 	<b>1: </b>Inserirle nel campo "<span style="background-color:yellow" > Risultati: </span>".<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come salvare i documenti di registrazione</b>
</font>
<ul>       	
 	<b>1: </b>Selezionare il bottone <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>><br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come iniziare una nuova registrazione</b>
</font>
<ul>       	
 	<b>1: </b>Selezionare il bottone <img <?php echo createLDImgSrc('../','newpat2.gif','0') ?>><br>
 	<b>2: </b>Selezionare nuovamente il bottone <img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>> per ulteriori informazioni.<br>
	</ul>
	
<b>Nota</b>
<ul>Per chiudere, selezionare il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.
</ul>
	<?php endif;?>
<?php endif;?>
<?php if($src=="search") : ?>
<?php if(($x2!="")&&($x2!="0")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come selezionare il paziente di cui voglio <?php if($x1=="edit") print "modificare"; else print "visualizzare"; ?> il referto di laboratorio?</b>
</font>
<ul>       	
 	<b>1: </b>selezionare button&nbsp;<button><img <?php echo createComIcon('../','update2.gif','0') ?>> <font size=1>Referti lab</font></button> corrispondenti al paziente di cui si vuole <?php if($x1=="edit") print "modificare"; else print "visualizzare"; ?> il referto.<p> 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come continuare la ricerca?</b>
</font>
	<?php endif;?>
	<?php if(($x2=="")||($x2=="0")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come cercare un paziente?</b>
</font>
	<?php endif;?>
	<ul>       	
 	<b>1: </b>Inserire il nome o il cognome o la data di nascita (o le prime lettere che lo compongono) nel campo 
	"<span style="background-color:yellow" > Inserire una parola chiave <input type="text" name="m" size=20 maxlength=20> </span>". <br>
 	<b>2: </b>Selezionare il bottone <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> per iniziare la ricerca sul paziente.<p> 
<ul>       	
 	<b>Nota: </b>Se la ricerca trova più risultati, apparirà una lista.<p>
	</ul>
	<?php if(($x2=="")||($x2=="0")) : ?>
 	<b>3: </b>selezionare il bottone &nbsp;<button><img <?php echo createComIcon('../','update2.gif','0') ?>> <font size=1>Referti lab</font></button> corrispondenti al paziente di cui si vuole <?php if($x1=="edit") print "modificare"; else print "visualizzare"; ?> il referto.<p> 
	<?php endif;?>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 <ul>Premere <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> border=0> per annullare l'operazione.</ul>
</ul>
<?php endif;?>
<?php if($src=="arch") : ?>
	<?php if($x2=="1") : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota sulle ultime voci inserite nel registro</b></font> 
<ul>  Ogni volta che si passa ad un archivio, le ultime operazioni inserite diventano immediatamente visibili.
</ul>
	<?php endif;?>
	<?php if(($x3=="")&&($x1!="0")) : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nessuna operazione in questo giorno.</b></font> 
<ul>       	
selezionare "Opzioni" per aprire la finestra delle opzioni.<br>
selezionare "Ricerca" per passare al modo ricerca.</ul>
	<?php endif;?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Voglio visualizzare le registrazioni per un giorno differente.</b></font>
 	<b>Giorni precedenti:</b> selezionare il link "<span style="background-color:yellow" > Precedente </span>" nell'angolo in alto a sinistra della tabella.<br>
	Premere il link tante volte quanti sono i giorni di cui si vuole retrocedere.<br>
 	<b>Giorni successivi:</b> utilizzare il link "<span style="background-color:yellow" > Next day </span>" in alto a destra,<br>
 	premendolo tante volte quanti sono i giorni di cui si vuole avanzare.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Visualizzare le informazioni archiviate di un'altra sala operatoria o dipartimento.</b></font>
<ul> <b>1: </b>Selezionare il dipartimento nella lista <nobr>"<span style="background-color:yellow" >Cambiare dipartimento o sala operatoria<select name="o"><br>
	<b>2: </b>oppure scegliere la sala operatoria nella lista <nobr>"<span style="background-color:yellow" ><select name="o"><br>
	<b>3: </b>Selezionare il bottone <input type="button" value="Cambia">  per passare al nuovo dipartimento o sala operatoria.<br>
</ul>
<?php if(($x3!="")) : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come modificare o aggiornare il registro attualmente visualizzato</b>
</font>
<ul>       	
 	<b>1: </b>selezionare il bottone <img src="../img/update3.gif" border=0> posto sotto la data di operazione nella colonna più a sinistra per passare al modo modifica.<br>
 	<b>2: </b>Una volta in modo modifica, selezionare il bottone "Aiuto" se servono altre istruzioni.<p> 
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come aprire la cartella di un paziente</b>
</font>
<ul>       	
 	<b>1: </b>selezionare il bottone <img src="../img/info2.gif" border=0> a sinistra del codice paziente.<br>
 	<b>2: </b>Apparirà la cartella dei dati paziente. Se occorre selezionare il bottone "Aiuto" per altre istruzioni.<p> 
	</ul>
	<?php endif;?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
<ul>Premere <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> border=0> per annullare l'operazione.</ul>
</ul>
	<?php endif;?>
<?php if($src=="input") : ?>
	<?php if($x1=="main") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come inserire i risultati di un test</b>
</font>
<ul>       	
		<?php if($x2=="") print '
 			<b>1: </b>Inserire il codice del batch nel campo "<span style="background-color:yellow" > Codice batch </span>".<br>	
 			<b>2: </b>Inserire la data dell\'esame nel campo "<span style="background-color:yellow" > Data esame </span>" se necessario.<br>';
		?>
 	<b>Step	<?php if($x2=="") 
			print "3"; else print "1";
		?>:</b> Inserire i valori nei campi appropriati.<br>	
 	<b><?php if($x2=="") 
			print "4"; else print "2";
		?>: </b> Selezionare il bottone <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> per salvare i valori.<p> 
 	<b>Nota: </b>Dopo il salvataggio, per chiudere selezionare <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.<br> 
</ul>
	<?php endif;?>
<?php if($x1=="few") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ho solo alcuni dei valori: come fare?</b>
</font>
<ul>       	
 	<b>1: </b>Inserire solo i valori disponibili nei campi appropriati.<br> 
 	<b>2: </b>Selezionare il bottone <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> per salvare.<p> 
 	<b>Nota: </b>Dopo il salvataggio, per chiudere selezionare <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.<br> 
</ul>
	<?php endif;?>
	<?php if($x1=="param") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
I parametri che mi servono non sono mostrati: come faccio a passare al gruppo giusto?</b>
</font>
<ul>       	
 	<b>1: </b>Scegliere il gruppo di parametri desiderato nella lista <nobr>"<span style="background-color:yellow" > Scelta gruppi di parametri <select name="s">
     <option value="Parametri esempio"> Parametri esempio</option> </select> </span>"</nobr>.<p> 
 	<b>2: </b>Selezionare il bottone <img <?php echo createLDImgSrc('../','auswahl2.gif','0') ?>> per passare al gruppo di parametri scelto.<p> 
</ul>
	<?php endif;?>
	<?php if($x1=="save") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come salvare i valori?</b>
</font>
<ul>       	
 	<b>1: </b>Selezionare il bottone <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> per salvare.<p> 
 	<b>Nota: </b>Dopo il salvataggio, per chiudere selezionare <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.<br> 
</ul>
	<?php endif;?>
	<?php if($x1=="correct") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ho salvato un valore sbagliato: posso correggerlo?</b>
</font>
<ul>       	
 	<b>1: </b>E' sufficiente inserire il valore giusto nel campo appropriato.<br> 
 	<b>2: </b>Selezionare il bottone <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> per salvare il valore giusto.<p> 
 	<b>Nota: </b>Dopo il salvataggio, per chiudere selezionare <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.<br> 
</ul>
	<?php endif;?>
	<?php if($x1=="note") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ho bisogno di inserire una nota invece di un valore: come faccio?</b>
</font>
<ul>       	
 	<b>1: </b>Inserire semplicemente la nota nel campo valore corrispondente.<br> 
 	<b>2: </b>Selezionare il bottone <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> per salvare la nota.<p> 
 	<b>Nota: </b>Dopo il salvataggio, per chiudere selezionare <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.<br> 
</ul>
	<?php endif;?>
	<?php if($x1=="done") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ho finito. E ora?</b>
</font>
<ul>       	
 	Selezionare il bottone <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> per salvare tutti i valori.<p> 
 	<b>Nota: </b>Selezionare il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.<br> 
</ul>
	<?php endif;?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 <ul>Premere <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> border=0> per annullare l'operazione.</ul>
</ul>
<?php endif;?>
</form>
