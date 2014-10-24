<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
Registro di sala operatoria - 
<?php
if($src=="create")
{
	switch($x1)
	{
	case "": print "Creare un nuovo registro";
						break;
	case "fresh": print "Creare un nuovo registro";
						break;
	case "get": print  "";
						break;
	case "logmain": print "Modificare la registrazione di un intervento";
						break;
	default: print "Registrare una nuova operazione";	
	}
}
if($src=="time")
{
	print "Registrazione dei ";
	switch($x1)
	{
	case "entry_out": print "tempi di ingresso ed uscita";
						break;
	case "cut_close": print "tempi di taglio e sutura";
						break;
	case "wait_time": print "tempi di inattività (attesa)";
						break;
	case "bandage_time": print "tempi di fasciatura";
						break;
	case "repos_time": print "tempi di riposizionamento";
	}
}
if($src=="person")
{
	print "Registrare ";
	switch($x1)
	{
	case "operator":$person="il chirurgo"; 
						break;
	case "assist":$person=" l'aiuto chirurgo"; 
						break;
	case "scrub": $person=" l'assistente sterile";
						break;
	case "rotating":$person=" l'assistente non sterile"; 
						break;
	case "ana": $person=" l'anestesista";
	}
	print $person;
}
if($src=="search")
{
	switch($x1)
	{
	case "search": print "Seleziona una registrazione";
						break;
	case "": print "Ricerca una certa operazione nella registrazione";
						break;
	case "get": print  "Registrazione delle operazioni ad un dato paziente";
						break;
	case "fresh": print "Ricerca una certa operazione nella registrazione";
	}
}
if($src=="arch")
{
	print "Archivio";	
	/*switch($x1)
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
	}*/
}
 ?></b></font>
<p><font size=2 face="verdana,arial" >
<form action="#" >
<?php if($src=="person") { ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a inserire <?php $person ?> tramite la lista di selezione rapida?</b>
</font>
<ul>       	
 	<b>Nota: </b>Se si è già scelto <?php $person ?>, il nome apparirà nella lista di selezione rapida.<p>
 	<b>1: </b>Controllare se la funzione nel riquadro" Funzioni di sala op. " è correttamente impostata:
 	in caso contrario, scegliere quella giusta.<br>
 	<b>2: </b>Selezionare il nome o il cognome di <?php $person ?>, oppure
	<nobr>"<span style="background-color:yellow" > <img <?php echo createComIcon('../','uparrowgrnlrg.gif','0') ?>> Assegna questa persona come <?php $person ?>... </span>"</nobr> link.
	Il chirurgo sarà automaticamente aggiunto alla lista delle "voci correnti".<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
<?php ucfirst($person) ?> non è nella lista di selezione rapida: come faccio a inserirla?</b>
</font>
<ul>       	
 	<b>1: </b>Inserire il nome o il cognome di <?php $person ?>> (bastano poche lettere) nel campo "<span style="background-color:yellow" > Ricerca nuovo <?php substr($person,3) ?>... </span>".<br>
 	<b>2: </b>Premere il bottone <input type="button" value="OK"> per cercare <?php $person ?>.<br>
 	<b>3: </b>Alla fine della ricerca appariranno i risultati. Selezionare il nome o il cognome, oppure il link <nobr>"<span style="background-color:yellow" > <img <?php echo createComIcon('../','uparrowgrnlrg.gif','0') ?>> Assegna questa persona come <?php $person ?>... </span>"</nobr> corrispondente alla funzione da registrare.
</ul>


<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b> Come fare a cancellare <?php $person ?> dalla lista?</b></font> 
<ul>       	
 	<b>1: </b>Selezionare l'icona <img src="../img/erase2.gif" border=0 align="absmiddle"> a destra del nome.<br>
 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b> Ho finito. Come faccio a tornare al registro?</b></font> 
<ul>       	
 	<b>1: </b>Premere il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle"> che apparirà dopo aver scelto <?php $person ?>.<br>
 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 Per annullare, selezionare il bottone <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
</ul>
<?php } ?>
<?php if($src=="time") : ?>
	<?php if($x1=="entry_out") { ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a registrare i tempi di ingresso ed uscita?</b>
</font>
<ul>       	
 	<b>1: </b>Inserire il tempo iniziale nel campo "<span style="background-color:yellow" > da: <input type="text" name="d" size=5 maxlength=5> </span>" nella colonna a sinistra.<br>
 	<b>2: </b>Inserire il tempo finale nel campo "<span style="background-color:yellow" > a: <input type="text" name="d" size=5 maxlength=5> </span>" nella colonna a destra.<p>
<ul>       	
 	<b>Nota: </b>Inserire "a" oppure "A" (come Adesso) nel campo per inserire automaticamente l'ora attuale.
</ul><br>
 	<b>Nota: </b>E' possibile inserire più di un tempo di ingresso ed uscita prima di salvare.<p>
</ul>
	<?php } ?>
	<?php if($x1=="cut_close") { ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a registrare tempi di taglio e sutura?</b>
</font>
<ul>       	
 	<b>1: </b>Inserire il tempo di taglio nel campo "<span style="background-color:yellow" > da: <input type="text" name="d" size=5 maxlength=5> </span>" nella colonna a sinistra.<br>
 	<b>2: </b>Inserire il tempo di sutura nel campo "<span style="background-color:yellow" > a: <input type="text" name="d" size=5 maxlength=5> </span>" nella colonna a destra.<p>
<ul>       	
 	<b>Nota: </b>Inserire "a" oppure "A" (come Adesso) nel campo per inserire automaticamente l'ora attuale.
</ul><br>
 	<b>Nota: </b>E' possibile inserire più tempi di taglio e sutura prima di salvare.<p>
</ul>

	<?php } ?>
	<?php if($x1=="wait_time") { ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a registrare tempi di inattività (attesa)?</b>
</font>
<ul>       	
 	<b>1: </b>Inserire il tempo iniziale nel campo "<span style="background-color:yellow" > da: <input type="text" name="d" size=5 maxlength=5> </span>" nella prima colonna.<br>
 	<b>2: </b>Inserire il tempo finale nel campo "<span style="background-color:yellow" > a: <input type="text" name="d" size=5 maxlength=5> </span>" nella seconda colonna.<p>
<ul>       	
 	<b>Nota: </b>Inserire "a" oppure "A" (come Adesso) nel campo per inserire automaticamente l'ora attuale.
</ul><br>
 	<b>3: </b>Scegliere la motivazione dal riquadro di selezione nella terza colonna (Motivo).<p>
 	<b>Nota: </b>E' possibile inserire più tempi iniziali/finali e motivazioni prima di salvare.<p>
</ul>
	<?php } ?>
	<?php if($x1=="bandage_time") { ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a registrare tempi di fasciatura?</b>
</font>
<ul>       	
 	<b>1: </b>Inserire il tempo iniziale nel campo "<span style="background-color:yellow" > da: <input type="text" name="d" size=5 maxlength=5> </span>" nella colonna a sinistra.<br>
 	<b>2: </b>Inserire il tempo finale nel campo "<span style="background-color:yellow" > a: <input type="text" name="d" size=5 maxlength=5> </span>" nella colonna a destra.<p>
<ul>       	
 	<b>Nota: </b>Inserire "a" oppure "A" (come Adesso) nel campo per inserire automaticamente l'ora attuale.
</ul><br>
 	<b>Nota: </b>E' possibile inserire più tempi iniziali e finali prima di salvare.<p>
</ul>
	<?php } ?>
	<?php if($x1=="repos_time") { ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a registrare tempi di riposizionamento?</b>
</font>
<ul>       	
 	<b>1: </b>Inserire il tempo iniziale nel campo "<span style="background-color:yellow" > da: <input type="text" name="d" size=5 maxlength=5> </span>" nella colonna a sinistra.<br>
 	<b>2: </b>Inserire il tempo finale nel campo "<span style="background-color:yellow" > a: <input type="text" name="d" size=5 maxlength=5> </span>" nella colonna a destra.<p>
<ul>       	
 	<b>Nota: </b>Inserire "a" oppure "A" (come Adesso) nel campo per inserire automaticamente l'ora attuale.
</ul><br>
 	<b>Nota: </b>E' possibile inserire più tempi iniziali e finali prima di salvare.<p>
</ul>
	<?php } ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a salvare le informazioni?</b>
</font>
<ul>       	
 	<b>1: </b>Premere il bottone <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>><br>
 	<b>2: </b>Alla fine, selezionare <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> per chiudere la finestra e tornare al registro.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b> Desidero cancellare alcune voci ma il bottone "Annulla" non funziona. Che devo fare?</b></font> 
<ul>       	
 	<b>Nota: </b>Il bottone "Annulla" cancella solo le voci non ancora salvate. Per cancellare voci
	già salvate, seguire queste istruzioni:<p>
 	<b>1: </b>Selezionare la voce da cancellare.<br>
 	<b>2: </b>Cancellare il tempo manualmente con i tasti "Del" e "Backspace".<br>
 	<b>3: </b>Premere il bottone <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> per salvare le modifiche.<br>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>Per annullare selezionare il bottone <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
</ul>
<?php endif;?>
<?php if($src=="create") : ?>
	<?php if($x1=="logmain") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a modificare il registro di un'operazione?</b>
</font>
<ul>       	
 	<b>1: </b>Premere il bottone <img src="../img/update3.gif" width=15 height=14 border=0> corrispondente alla voce desiderata nel registro del paziente.<br>
 	<b>2: </b>Nella finestra di modifica appariranno le voci relative al paziente. E' possibile 
 	modificarle seguendo le istruzioni per registrare un'operazione.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare ad: aprire la cartella dati di un paziente?</b>
</font>
<ul>       	
 	<b>1: </b>Premere il bottone <img <?php echo createComIcon('../','info3.gif','0') ?>> a sinistra del codice paziente.<br>
 	<b>2: </b>Apparirà la cartella dei dati paziente.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: selezionare un altro dipartimento e/o sala operatoria?</b>
</font>
<ul>       	
 	<b>1: </b>Scegliere il dipartimento dal riquadro di selezione 
				<select name="dept" size=1>
				<?php
					$Or2Dept=get_meta_tags("../global_conf/resolve_or2ordept.pid");
					$opabt=get_meta_tags("../global_conf/$lang/op_tag_dept.pid");
					while(list($x,$v)=each($opabt))
					{
						if($x=="anaesth") continue;
						print'
					<option value="'.$x.'"';
						if ($dept==$x) print " scelto";
						print '> '.$v.'</option>';
					}
				?>
				</select>.
<br>
 	<b>2: </b>Scegliere la sala operatoria dal riquadro di selezione <select name="saal" size=1 >
				<?php
					while(list($x,$v)=each($Or2Dept))
					{
						print'
					<option value="'.$x.'"';
						if ($saal==$x) print " scelto";
						print '> '.$x.'</option>';
					}
				?>
				</select>.
<br>
 	<b>3: </b>Premere il bottone <input type="button" value="Cambia"> per selezionare un altro dipartimento e/o sala operatoria.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: visualizzare le registrazioni di un giorno differente da quello attualmente mostrato?</b>
</font>
<ul>       	
 	<b>1: </b>Per visualizzare le registrazioni di giorni precedenti, selezionare il link "<span style="background-color:yellow" > Giorno precedente </span>" nell'angolo in alto a sinistra della tabella.<br>
	Selezionare il link fino a quando non appare il giorno desiderato.<br>
 	<b>2: </b>Per visualizzare le registrazioni di giorni successivi, selezionare "<span style="background-color:yellow" > Giorno successivo </span>" link nell'angolo in alto a destra della tabella.<br>
	Selezionare il link fino a quando non appare il giorno desiderato.<br>
</ul>
<hr>
	<?php endif;?>
	<?php if($x2=="material") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a registrare il materiale usato durante l'operazione?</b>
</font>
<ul>       	
 	<b>1: </b>Inserire il codice articolo del materiale nel campo "<span style="background-color:yellow" > Codice art.: </span>".<p>
	<b>Metodi alternativi: </b>
	<ul type=disc>  	
	<li>Inserire il nome del materiale (bastano anche poche lettere), la descrizione prodotto, il generico, il numero di licenza o il codice d'ordine nel campo "<span style="background-color:yellow" > Codice art.: </span>".
	<li>Leggere il codice dell'articolo con il lettore di codici a barre.
	</ul><br> 
 	<b>2: </b>Premere il bottone <input type="button" value="OK"> o premere "enter" per cercare il prodotto.<p> 
<ul>       	
 	<b>Nota: </b>Se la ricerca trova un solo risultato, le informazioni saranno inserite immediatamente nel documento.<p> 
 	<b>Nota: </b>Se invece ci sono più risultati, apparirà un elenco. Premere il bottone <img <?php echo createComIcon('../','bul_arrowgrnlrg.gif','0') ?>> il codice articolo, o il nome per aggiungerlo al documento.<p> 
	</ul>
 	<b>3: </b>Se necessario, è possibile modificare il campo "<span style="background-color:yellow" > pezzi </span>" per l'articolo.<p> 
<ul>       	
 	<b>Nota: </b>Una volta modificato il campo "pezzi", appariranno i bottoni "Salva" e "Annulla".<p> 
	</ul>
 	<b>4: </b>Premere il bottone <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> per salvare le modifiche.<p> 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: rimuovere un articolo dalla lista?</b>
</font>
<ul> 
 	<b>1: </b>Selezionare l'icona <img src="../img/cancellare2.gif" border=0 align="absmiddle"> corrispondente all'articolo.<br> 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
L'articolo non è presente. E' possibile inserirlo manualmente?</b>
</font>
<ul> 
 	<b>1: </b>Selezionare il link "<span style="background-color:yellow" > <img <?php echo createComIcon('../','accessrights.gif','0') ?>> Selezionare qui per inserire l'articolo a mano. </span>".<br> 
 	<b>2: </b>Inserire a mano le informazioni sull'articolo nei campi appropriati.<p> 
 	<b>3: </b>Premere il bottone <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> per aggiungere l'articolo al documento<p> 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 Per annullare selezionare il bottone <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: visualizzare di nuovo il registro principale?</b>
</font>
<ul> 
 	<b>1: </b>Selezionare il link "<span style="background-color:yellow" > <img <?php echo createComIcon('../','manfldr.gif','0') ?>> Visualizza registro. </span>".<br> 
</ul>
<hr>
	<?php endif;?>

	<?php if(($x1=="")||($x1=="fresh")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: creare un nuovo registro per un'operazione?</b>
</font>
<ul>       	
 	<b>1: </b>Prima di tutto cercare il paziente. Inserire il codice paziente nel campo "<span style="background-color:yellow" > Codice paziente: </span>".<p>
	<b>Metodi alternativi: </b>
	<ul type=disc>  	
	<li>Inserire il nome o il cognome del paziente (bastano poche lettere) nel campo "<span style="background-color:yellow" > Cognome, nome </span>".
	<li>Inserire la data di nascita del paziente (bastano poche cifre) nel campo "<span style="background-color:yellow" > Data di nascita </span>".
	</ul>
 	<b>2: </b>Premere il bottone <input type="button" value="Ricerca pazienti">  per attivare la ricerca for the patient.<p> 
<ul>       	
 	<b>Nota: </b>Se la ricerca trova un solo risultato, i dati fondamentali del paziente saranno subito inseriti nei campi appropriati.<p> 
 	<b>Nota: </b>Se invece ci sono più risultati, apparirà un elenco. Selezionare il cognome o il nome del paziente desiderato.<p> 
	</ul>
 	<b>3: </b>Selezionare di nuovo <img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>> per altre istruzioni.<p> 

</ul>

	<?php else : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: inserire la diagnosi per un'operazione?</b>
</font>
<ul>       	
 	<b>1: </b>Inserire la diagnosi nel campo "<span style="background-color:yellow" > Diagnosi: </span>".<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: inserire informazioni sul chirurgo?</b>
</font>
<ul>       	
 	<b>1: </b>Selezionare "<span style="background-color:yellow" > Chirurgo </span>".<br>
 	<b>2: </b>Apparirà una finestrella con le informazioni richieste.<br>
 	<b>3: </b>Seguire le istruzioni nella finestra o selezionare il tasto "Aiuto" nella finestra per altre istruzioni. <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: inserire informazioni sull'aiuto chirurgo?</b>
</font>
<ul>       	
 	<b>1: </b>Selezionare "<span style="background-color:yellow" > Aiuto </span>".<br>
 	<b>2: </b>Apparirà una finestrella con le informazioni richieste.<br>
 	<b>3: </b>Seguire le istruzioni nella finestra o selezionare il tasto "Aiuto" nella finestra per altre istruzioni. <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: inserire informazioni sull'assistente sterile?</b>
</font>
<ul>       	
 	<b>1: </b>Selezionare il link "<span style="background-color:yellow" > Assistente sterile </span>".<br>
 	<b>2: </b>Apparirà una finestrella con le informazioni richieste.<br>
 	<b>3: </b>Seguire le istruzioni nella finestra o selezionare il tasto "Aiuto" nella finestra per altre istruzioni.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: inserire informazioni sull'assistente non sterile?</b>
</font>
<ul>       	
 	<b>1: </b>Selezionare il link "<span style="background-color:yellow" > Assistente non sterile </span>".<br>
 	<b>2: </b>Apparirà una finestrella con le informazioni richieste.<br>
 	<b>3: </b>Seguire le istruzioni nella finestra o selezionare il tasto "Aiuto" nella finestra per altre istruzioni.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: enter the type of anesthesia used for the operation?</b>
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
 	<b>1: </b>Premere il bottone <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>><br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come iniziare una nuova registrazione</b>
</font>
<ul>       	
 	<b>1: </b>Premere il bottone <img <?php echo createLDImgSrc('../','newpat2.gif','0') ?>><br>
 	<b>2: </b>Selezionare nuovamente il bottone <img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>> per ulteriori informazioni.<br>
	</ul>
<b>Nota</b>
<ul>Per chiudere, selezionare il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.
</ul>
<?php endif;?>
<?php endif;?>
<?php if($src=="search") : ?>
	<?php if(($x1=="fresh")||($x1=="")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: cercare i documenti di un certo paziente?</b>
</font>
<ul>       	
 	<b>1: </b>Inserire il nome o il cognome o la data di nascita (o le prime lettere che lo compongono) nel campo 
	"<span style="background-color:yellow" > Inserire una parola chiave <input type="text" name="m" size=20 maxlength=20> </span>". <br>
 	<b>2: </b>Premere il bottone <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> per iniziare la ricerca sul paziente.<p> 
<ul>       	
 	<b>Nota: </b>Se la ricerca identifica un solo risultato, i documenti del paziente saranno visualizzati subito.<p> 
 	<b>Nota: </b>Se la ricerca identifica più risultati, apparirà un elenco. 
	Selezionare il cognome del paziente per visualizzare i suoi documenti.<p> 
	</ul>
</ul>
	<?php endif;?>
<?php if(($x1=="search")&&($x3!="1")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: selezionare uno specifico documento da visualizzare?</b>
</font>
<ul>       	
 	<b>Nota: </b> Selezionare il cognome del paziente per visualizzare i suoi documenti.<p> 
</ul>

	<?php endif;?>
<?php if(($x1=="get")||($x3=="1")) : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: aggiornare o modificare il registro visualizzato?</b>
</font>
<ul>       	
 	<b>1: </b>Selezionare <img src="../img/update3.gif" border=0> posto sotto la data dell'operazione nella colonna più a sinistra per passare al modo modifica.<br>
 	<b>2: </b>Una volta in modo modifica, selezionare il tasto "Aiuto" per altre istruzioni.<p> 
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: aprire la cartella dati di un paziente?</b>
</font>
<ul>       	
 	<b>1: </b>Selezionare <img src="../img/info2.gif" border=0> a sinistra del codice paziente.<br>
 	<b>2: </b>Apparirà la cartella dei dati paziente. Selezionare il tasto "Aiuto" nella finestra per altre istruzioni.<p> 
	</ul>

<?php endif;?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: continuare la ricerca?</b>
</font>
<ul>       	
 	<b>1: </b>Inserire il nome o il cognome o la data di nascita (o le prime lettere che lo compongono) nel campo "<span style="background-color:yellow" > Parola chiave: <input type="text" name="m" size=20 maxlength=20> </span>". <br>
 	<b>2: </b>Premere il bottone <input type="button" value="Ricerca"> per attivare la ricerca.<p> 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 Per chiudere selezionare il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.
</ul>
<?php endif;?>
<?php if($src=="arch") : ?>
	<?php if($x2=="1") : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota: ultime registrazioni inserite</b></font> 
<ul>Ogni volta che si ritorna all'archivio, le ultime operazioni registrate appariranno immediatamente.
</ul>
	<?php endif;?>
	<?php if(($x3=="")&&($x1!="0")) : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Non ci sono operazioni in questo giorno.</b></font> 
<ul>       	
Selezionare "Opzioni" per aprire la finestra opzioni.<br>
Selezionare "Ricerca" per passare al modo ricerca.</ul>
	<?php endif;?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Desidero visualizzare le registrazioni di un altro giorno.</b></font>
<ul> <b>Per il giorno precedente: </b>Selezionare il link "<span style="background-color:yellow" > Giorno precedente </span>" nella colonna in alto a sinistra. 
 <b>Per il giorno successivo: </b>Selezionare il link "<span style="background-color:yellow" > Giorno successivo </span>" nella colonna in alto a destra. 
				Premere il link fino a quando appare il giorno desiderato.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Desidero visualizzare le registrazioni di un'altra sala operatoria o dipartimento.</b></font>
<ul> <b>1: </b>Scegliere il dipartimento nel riquadro di selezione <nobr>"<span style="background-color:yellow" > Cambia sala op. o dipartimento <select name="o">
                                                                                                                                         	<option > Esempio 1</option>
                                                                                                                                         	<option > Esempio 2</option>
                                                                                                                                         </select>
                                                                                                                                          </span>".</nobr> <br>La sala operatoria
	sarà aggiornata automaticamente.<br>																																		  
	<b>2: </b>Oppure scegliere la sala operatoria nel riquadro di selezione <nobr>"<span style="background-color:yellow" > <select name="o">
                                                                                                                                         	<option > Sala 1</option>
                                                                                                                                         	<option > Sala 2</option>
                                                                                                                                         </select>
                                                                                                                                          </span>".</nobr> <br>Il dipartimento
	sarà aggiornato automaticamente.<br>																																		  																																		  
		<b>3: </b>Premere il bottone <input type="button" value="Cambia">  per passare al nuovo dipartimento o sala operatoria.<br>
</ul>
<?php if(($x3!="")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: aggiornare o modificare il registro visualizzato?</b>
</font>
<ul>       	
 	<b>1: </b>Selezionare <img src="../img/update3.gif" border=0> posto sotto la data dell'operazione nella colonna più a sinistra per passare al modo modifica.<br>
 	<b>2: </b>Una volta in modo modifica, selezionare il tasto "Aiuto" per altre istruzioni.<p> 
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: aprire la cartella dati di un paziente?</b>
</font>
<ul>       	
 	<b>1: </b>Selezionare <img src="../img/info2.gif" border=0> a sinistra del codice paziente.<br>
 	<b>2: </b>Apparirà la cartella dei dati paziente. Selezionare il tasto "Aiuto" nella finestra per altre istruzioni.<p> 
	</ul>
	<?php endif;?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 Per annullare selezionare il bottone <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
</ul>
	<?php endif;?>
</form>
