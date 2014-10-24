<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Come cercare negli archivi</b></font>
<form action="#" >
<p><font size=2 face="verdana,arial" >

<?php if($src=="select") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Ho bisogno di aggiornare i dati visualizzati</b></font>
<ul> Selezionare il bottone <input type="button" value="Modifica dati"> per iniziare le modifiche.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Voglio effettuare una nuova ricerca in archivio</b></font>
<ul> Selezionare il bottone <input type="button" value="Nuova ricerca in archivio"> per avviare una nuova ricerca.<br>
</ul>
<?php elseif($src=="search") : ?>
<b>Nota</b>
<ul>Se la ricerca trova un solo risultato, questo sarà mostrato immediatamente;<br>
in caso di più risultati apparirà invece una lista.<br>
Per visualizzare le informazioni sul paziente che si sta cercando, premere o il bottone <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> corrispondente, 
oppure il nome, il cognome o la data di accettazione.
</ul>
<b>Nota</b>
<ul>Per avviare una nuova ricerca, clickare il bottone <input type="button" value="Nuova ricerca in archivio">.
</ul>
<?php else : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Mi serve la lista dei pazienti accettati oggi</b></font>
<ul> <b>1: </b>Inserire la data odierna nel campo "Data di accettazione - da:". <br>
		<ul><font size=1 color="#000099">
		<b>Nota:</b> Premere "O" oppure "o" per inserire la data odierna automaticamente.<br>
		</font>
		</ul><b>2: </b>Lasciare il campo "a:" vuoto.<br>
		<b>3: </b>Selezionare il bottone <input type="button" value="Cerca">  per iniziare la ricerca.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Mi serve la lista dei pazienti accettati in un certo arco di tempo</b></font>
<ul> <b>1: </b>Inserire la data iniziale nel campo "Data di accettazione - da:". <br>
		<ul><font size=1 color="#000099">
		<b>Nota:</b> Premere "O" or "o" per inserire la data odierna automaticamente.<br>
		<b>Nota:</b> Premere "I" or "i" per inserire la data di ieri automaticamente.<br>
		</font>
		</ul><b>2: </b>Inserire la data finale nel campo "a:".<br>
		<b>3: </b>Selezionare il bottone <input type="button" value="Cerca">  per iniziare la ricerca.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Ho bisogno della lista di tutti i pazienti maschi accettati</b></font>
<ul> <b>1: </b>Selezionare 'maschio' nel campo "Sesso <input type="radio" name="r" value="1">". <br>
		<b>2: </b>Lasciare gli altri campi vuoti.<br>
		<b>3: </b>Selezionare il bottone <input type="button" value="Cerca">  per iniziare la ricerca.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Ho bisogno della lista di tutti i pazienti femmine accettati</b></font>
<ul> <b>1: </b>Selezionare 'femmina' nel campo "Sesso <input type="radio" name="r" value="1">". <br>
		<b>2: </b>Lasciare gli altri campi vuoti.<br>
		<b>3: </b>Selezionare il bottone <input type="button" value="Cerca">  per iniziare la ricerca.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Mi serve la lista dei pazienti accettati deambulanti</b></font>
<ul> <b>1: </b>Selezionare il campo "<input type="radio" name="r" value="1">Deambulante". <br>
		<b>2: </b>Lasciare gli altri campi vuoti.<br>
		<b>3: </b>Selezionare il bottone <input type="button" value="Cerca">  per iniziare la ricerca.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Mi serve la lista dei pazienti accettati non deambulanti</b></font>
<ul> <b>1: </b>Selezionare il campo "<input type="radio" name="r" value="1">Non deambulante". <br>
		<b>2: </b>Lasciare gli altri campi vuoti.<br>
		<b>3: </b>Selezionare il bottone <input type="button" value="Cerca">  per iniziare la ricerca.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Voglio la lista di tutti i pazienti che sostengono da soli le spese</b></font>
<ul> <b>1: </b>Selezionare il campo "<input type="radio" name="r" value="1">Proprio carico". <br>
		<b>2: </b>Lasciare gli altri campi vuoti.<br>
		<b>3: </b>Selezionare il bottone <input type="button" value="Cerca">  per iniziare la ricerca.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Voglio la lista dei pazienti con assicurazione privata</b></font>
<ul> <b>1: </b>Selezionare il campo "<input type="radio" name="r" value="1">Ass. privata". <br>
		<b>2: </b>Lasciare gli altri campi vuoti.<br>
		<b>3: </b>Selezionare il bottone <input type="button" value="Cerca">  per iniziare la ricerca.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Voglio la lista di tutti i pazienti mutuati</b></font>
<ul> <b>1: </b>Selezionare il campo "<input type="radio" name="r" value="1">Mutuato". <br>
		<b>2: </b>Lasciare gli altri campi vuoti.<br>
		<b>3: </b>Selezionare il bottone <input type="button" value="Cerca">  per iniziare la ricerca.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Mi serve la lista dei pazienti assicurati con una certa compagnia</b></font>
<ul> <b>1: </b>Inserire l'acronimo della compagnia assicurativa nel campo "Assicurazione". <br>
		<b>2: </b>Lasciare gli altri campi vuoti.<br>
		<b>3: </b>Selezionare il bottone <input type="button" value="Cerca">  per iniziare la ricerca.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Mi occorre la lista dei pazienti in base ad una certa parola chiave</b></font>
<ul> <b>1: </b>Inserire la parola chiave nel campo corrispondente. Non è necessario sia una parola intera, bastano poche lettere. <br>
		<ul><font size=1 color="#000099" >
		<b>Esempio:</b> inserire chiavi relative alla diagnosi nel campo "Diagnosi".<br>
		<b>Esempio:</b> inserire il raccomandante nel campo "Raccomandato da".<br>
		<b>Esempio:</b> inserire chiavi terapeutiche nel campo "Terapia suggerita".<br>
		<b>Esempio:</b> inserire chiavi particolari nel campo "Note speciali".<br>
		</font>
		</ul><b>2: </b>Lasciare gli altri campi vuoti.<br>
		<b>3: </b>Selezionare il bottone <input type="button" value="Cerca">  per iniziare la ricerca.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Sto cercando un certo paziente tramite una parola chiave</b></font>
<ul> <b>1: </b>Inserire la parola chiave nel campo corrispondente. Non è necessario sia una parola intera, bastano poche lettere. <br>
		<ul><font size=1 color="#000099" >
		<b>Ecco i campi che è possibile usare come chiavefields can be filled with a keyword:</b>
		<br> Codice paziente
		<br> Cognome
		<br> Nome
		<br> Data di nascita
		<br> Indirizzo
		</font>
		</ul><b>2: </b>Lasciare gli altri campi vuoti.<br>
		<b>3: </b>Selezionare il bottone <input type="button" value="Cerca">  per iniziare la ricerca.<br>
</ul>
<b>Nota</b>
<ul>E' anche possibile combinare varie condizioni di ricerca. Per esempio, se si vogliono tutti i pazienti
maschi accettati tra il 10.12.1999 ed il 24.01.2001 compresi:<p>
		<b>1: </b>Inserire "10.12.1999" nel campo "Data di accettazione - da:". <br>
		<b>2: </b>Inserire "24.01.2001 nel campo "a:".<br>
		<b>3: </b>Selezionare 'maschio' nel campo "Sesso <input type="radio" name="r" value="1">".<br>
		<b>4: </b>Selezionare il bottone <input type="button" value="Cerca">  per iniziare la ricerca.<br>
</ul>
<b>Nota</b>
<ul>Se la ricerca trova un solo risultato, questo sarà mostrato immediatamente;<br>
in caso di più risultati apparirà invece una lista.<br>
Per visualizzare le informazioni sul paziente che si sta cercando, premere o il bottone <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> corrispondente, 
oppure il nome, il cognome o la data di accettazione.
</ul>
<?php endif;?>
<b>Nota</b>
<ul>Per annullare la ricerca, clickare il bottone <input type="button" value="Annulla">.
</ul>
</form>
