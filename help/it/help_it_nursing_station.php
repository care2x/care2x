<font face="Verdana, Arial" size=3 color="#0000cc">
<b><?php echo "$x3 - $x2" ?></b></font>
<form action="#" >
<p><font size=2 face="verdana,arial" >

<?php if((($src=="")&&($x1=="ja"))||(($src=="fresh")&&($x1=="template"))) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: assegnare un letto a un paziente?</b></font>
<ul> <b>1: </b>Selezionare il <img <?php echo createComIcon('../','plus2.gif','0') ?>> corrispondente alla stanza ed al letto.<br>
		<b>2: </b>Apparirà una finestrella per cercare il paziente.<br>
		<b>3: </b>Prima di tutto cercare il paziente inserendo una chiave di ricerca in uno o più campi.<br>
		Se si vuole cercare il paziente...<ul type="disc">
		<li>tramite il codice paziente, inserire il codice nel campo <br>"<span style="background-color:yellow" >Codice paziente:</span><input type="text" name="t" size=19 maxlength=10 value="22000109">".
		<li>tramite il cognome, inserire il cognome (bastano poche lettere) nel campo <br>"<span style="background-color:yellow" >Cognome:</span><input type="text" name="t" size=19 maxlength=10 value="Rossi">".
		<li>tramite il nome, inserire il nome (bastano poche lettere) nel campo <br>"<span style="background-color:yellow" >nome:</span><input type="text" name="t" size=19 maxlength=10 value="Mario">".
		<li>tramite la data di nascita, inserirla (bastano poche cifre) nel campo <br>"<span style="background-color:yellow" >Data di nascita:</span><input type="text" name="t" size=19 maxlength=10 value="10.10.1966">".
		</ul>
		<b>4: </b>Premere il bottone <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> per attivare la ricerca.<br>
		<b>5: </b>Se la ricerca trova uno o più pazienti, apparirà un elenco.<br>
		<b>6: </b>Per scegliere il paziente desiderato, selezionare il il bottone ;<button><img <?php echo createComIcon('../','post_discussion.gif','0') ?>></button> corrispondente.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: rimuovere un paziente da quelli in carico ad una corsia?</b></font>
<ul> <b>1: </b>Selezionare <img <?php echo createComIcon('../','bestell.gif','0') ?>> corrispondente al paziente.<br>
		<b>2: </b>Apparirà il modulo di scarico del paziente.<br>
		<b>3: </b>Se si vuole effettuare lo scarico, <br>selezionare  
		"<input type="checkbox" name="g" ><span style="background-color:yellow" > Sì, il paziente non è più in carico.</span>".<br>
       	<b>4: </b>Premere il bottone <input type="button" value="discharge"> per effettuare lo scarico.<p>
       	<b>Nota: </b>Se si desidera annullare l'operazione, selezionare il bottone <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: bloccare un letto?</b></font>
<ul> <b>1: </b>Selezionare the <img <?php echo createComIcon('../','plus2.gif','0') ?>> corrispondente alla stanza ed al letto.<br>
		<b>2: </b>Apparirà una finestrella per cercare il paziente.<br>
		<b>3: </b>Selezionare "<span style="background-color:yellow" > <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> <font color="#0000ff">Blocca questo letto</font> </span>".<br>
		<b>4: </b>Scegliere <button>OK</button> per confermare.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Desidero cancellare un paziente dalla lista</b></font>
<ul> <b>Nota: </b>NON si può semplicemente cancellare un paziente dalla lista. Prima di tutto, bisogna effettuare
lo scarico seguendo le istruzioni in 'rimuovere un paziente da quelli in carico ad una corsia'.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Che cosa significano le <img <?php echo createComIcon('../','s_colorbar.gif','0') ?>> barre colorate? </b></font>
<ul> <b>Nota: </b>Ciascuna barra colorata quando "visibile" indica la disponibilità di informazioni specifiche, istruzioni, cambiamenti, domande, etc.<br>
			Il significato di un colore è modificabile per ciascuna corsia. 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Che cosa significa l'icona <img <?php echo createComIcon('../','patdata.gif','0') ?>>? </b></font>
<ul> <b>Nota: </b>E' il bottone dell'archivio dati paziente. Per aprire la cartella dati, selezionare questa icona. Apparirà una finestrella
			con le informazioni essenziali sul paziente, la foto se disponibile, ed altre opzioni.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Che cosa significa l'icona <img <?php echo createComIcon('../','bubble2.gif','0') ?>>? </b></font>
<ul> <b>Nota: </b>E' il bottone di lettura/scrittura note: selezionandola apparirà una finestrella che permette di leggere o scrivere note sul paziente.<br>
			L'icona <img <?php echo createComIcon('../','bubble2.gif','0') ?>> indica che non ci sono note about sul paziente: per scriverne una selezionare l'icona.
			Invece l'icona <img <?php echo createComIcon('../','bubble3.gif','0') ?>> indica che ci sono note. Per leggerle o per aggiungerne altre, selezionare l'icona.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Che cosa significa l'icona <img <?php echo createComIcon('../','bestell.gif','0') ?>>? </b></font>
<ul> <b>Nota: </b>E' il bottone di scarico paziente: selezionandola, appare il modulo di scarico.<br>
</ul>
<?php elseif(($src=="")&&($x1=="template")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come devo fare se <span style="background-color:yellow" >la lista di occupazione di oggi non esiste ancora</span>?</b></font>
<ul> <b>1: </b>Premere il bottone <input type="button" value="Visualizza l'ultima lista di occupazione"> per trovare l'ultima lista registrata.<br>
		<b>2: </b>Se esiste una lista creata negli ultimi 31 giorni, essa sarà visualizzata.<br>
		<b>3: </b>Premere il bottone <input type="button" value="Copiala lo stesso come lista di oggi."><br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Non voglio visualizzare l'ultima lista di occupazione. Come fare a: creare una nuova lista?</b></font>
<ul> <b>1: </b>Selezionare <img <?php echo createComIcon('../','plus2.gif','0') ?>> corrispondente alla stanza ed al letto.<br>
		<b>2: </b>Apparirà una finestrella per cercare il paziente.<br>
		<b>3: </b>Prima di tutto cercare il paziente inserendo una chiave di ricerca in uno o più campi.<br>
		Se si vuole cercare il paziente...<ul type="disc">
		<li>tramite il codice paziente, inserirlo nel campo <br>"<span style="background-color:yellow" >Codice paziente:</span><input type="text" name="t" size=19 maxlength=10 value="22000109">".
		<li>tramite il cognome, inserirlo (bastano poche lettere) nel campo <br>"<span style="background-color:yellow" >Cognome:</span><input type="text" name="t" size=19 maxlength=10 value="Rossi">".
		<li>tramite il nome, inserirlo (bastano poche lettere) nel campo <br>"<span style="background-color:yellow" >nome:</span><input type="text" name="t" size=19 maxlength=10 value="Mario">".
		<li>tramite la data di nascita, inserirla (bastano poche cifre) nel campo <br>"<span style="background-color:yellow" >Data di nascita:</span><input type="text" name="t" size=19 maxlength=10 value="10.10.1966">".
		</ul>
		<b>4: </b>Premere il bottone <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> per attivare la ricerca.<br>
		<b>5: </b>Se la ricerca trova uno o più pazienti, apparirà un elenco.<br>
		<b>6: </b>Per scegliere il paziente desiderato, selezionare il bottone &nbsp;<button><img <?php echo createComIcon('../','post_discussion.gif','0') ?>></button> corrispondente.<br>
</ul>
<?php elseif(($src=="getlast")&&($x1=="last")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: usare l'ultima lista registrata come lista di occupazione di oggi?</b></font>
<ul> <b>1: </b>Premere il bottone <input type="button" value="Copiala lo stesso come lista di oggi.">.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Vedo l'ultima lista di occupazione ma non voglio copiarla. Come fare a creare una nuova lista?</b></font>
<ul> <b>1: </b>Premere il bottone <input type="button" value="Non copiarla e creane una nuova.">.
</ul>
<?php elseif($src=="assign") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: assegnare un letto a un paziente?</b></font>
<ul> <b>1: </b>Prima di tutto cercare il paziente inserendo una chiave di ricerca in uno o più campi.<br>
		Se si vuole cercare il paziente...<ul type="disc">
		<li>tramite il codice paziente, inserirlo nel campo <br>"<span style="background-color:yellow" >Codice paziente:</span><input type="text" name="t" size=19 maxlength=10 value="22000109">".
		<li>tramite il cognome, inserirlo (bastano poche lettere) nel campo <br>"<span style="background-color:yellow" >Cognome:</span><input type="text" name="t" size=19 maxlength=10 value="Rossi">".
		<li>tramite il nome, inserirlo (bastano poche lettere) nel campo <br>"<span style="background-color:yellow" >nome:</span><input type="text" name="t" size=19 maxlength=10 value="Mario">".
		<li>tramite la data di nascita, inserirla (bastano poche cifre) nel campo <br>"<span style="background-color:yellow" >Data di nascita:</span><input type="text" name="t" size=19 maxlength=10 value="10.10.1966">".
		</ul>
		<b>2: </b>Premere il bottone <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> per attivare la ricerca.<br>
		<b>3: </b>Se la ricerca trova uno o più pazienti, apparirà un elenco.<br>
		<b>4: </b>Per scegliere il paziente desiderato, selezionare il bottone <button><img <?php echo createComIcon('../','post_discussion.gif','0') ?>></button> corrispondente.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: bloccare un letto?</b></font>
<ul> <b>1: </b>Selezionare il campo "<span style="background-color:yellow" > <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> <font color="#0000ff">Blocca questo letto</font> </span>".<br>
		<b>2: </b>Selezionare <button>OK</button> per confermare.<p>
</ul>
  <b>Nota: </b>Se si desidera annullare, selezionare il bottone <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> >.</ul>
<?php elseif($src=="remarks") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: inserire note e osservazioni sul paziente?</b></font>
<ul> <b>1: </b>Selezionare the text entry.<br>
		<b>2: </b>Inserire la nota o osservazione<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ho finito di scrivere. Come fare a salvare la nota?</b></font>
<ul> 	<b>1: </b>Premere il bottone <input type="button" value="Salva">.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come faccio a chiudere la finestra dopo aver salvato?</b></font>
<ul> 	<b>1: </b>Premere il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle"> per chiudere la finestra.<p>
</ul>
<?php elseif($src=="discharge") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: dimettere un paziente?</b></font>
<ul> <b>1: </b>Scegliere il tipo di dimissione selezionando il bottone corrispondente<br>
	<ul><br>
		<input type="radio" name="relart" value="reg" checked> Dimissione normale<br>
                 	<input type="radio" name="relart" value="self"> Il paziente ha voluto lasciare l'ospedale<br>
                 	<input type="radio" name="relart" value="emgcy"> Dimissione di emergenza/urgenza<br>  <br>
	</ul>
		<b>2: </b>Inserire le note aggiuntive nel campo "<span style="background-color:yellow" > Note: </span>" se ce ne sono. <br>
		<b>3: </b>Inserire il proprio nome nel campo "<span style="background-color:yellow" > Infermiere/a: <input type="text" name="a" size=20 maxlength=20></span>" se è vuoto. <br>
		<b>4: </b>Selezionare " <span style="background-color:yellow" ><input type="checkbox" name="d" value="d"> Sì, dimetti il paziente. </span>". <br>
		<b>5: </b>Premere il bottone <input type="button" value="discharge"> per effettuare la dimissione.<p>
		<b>6: </b>Premere il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle"> per tornare 
alla lista di occupazione della corsia.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ho provato a selezionare il bottone <input type="button" value="discharge">, ma senza effetto. Perché?</b></font>
<ul> <b>Nota: </b>c'è una casella da selezionare, che deve apparire così:<br>
 " <span style="background-color:yellow" ><input type="checkbox" name="d" value="d" checked> Sì, dimetti il paziente. </span>". <p>
		<b>1: </b>Selezionare la casella se non lo è già.<p>
</ul>
  <b>Nota: </b>Se si desidera annullare, selezionare il bottone <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> border=0 align="absmiddle">.</ul>
<?php endif;?>
<?php if(($src!="assign")&&($src!="remarks")&&($src!="discharge")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Cosa significa "<span style="background-color:yellow" > <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> <font color="#0000ff">Bloccato</font> </span>"? </b></font>
<ul> <b>Nota: </b>Significa che il letto è bloccato e non può essere assegnato. Per sbloccarlo, selezionare "<span style="background-color:yellow" ><font color="#0000ff">Bloccato</font></span>" e premere &nbsp;<button>OK</button>
			per confermare.<br>
 <b>Nota: </b>A seconda della versione del software e della configurazione, potrebbe servire una password
 per sbloccare il letto.</ul>
<?php endif;?>
</form>
