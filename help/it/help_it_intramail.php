<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
Posta intranet - 
<?php
	switch($src)
	{
	case "pass": switch($x1)
						{
							case "": print "Login";
												break;
							case "1": print "Inserimento di un nuovo utente";
												break;
						}
						break;
	case "mail": switch($x1)
						{
							case "compose": print "Scrivere una nuova mail";
												break;
							case "listmail": print "Elenco mail";
												break;
							case "sendmail": print "Mail inviate";
												break;
						}
						break;
	case "read": print "Lettura mail";
						break;
	case "address": print "Rubrica";
						break;
	}
 ?></b></font>
<p><font size=2 face="verdana,arial" >
<form action="#" >
<?php if($src=="pass") : ?>
<?php if($x1=="") : ?>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare ad effettuare il login?</b>
</font>
<ul>       	
 	<b>1: </b>Inserire l'indirizzo intranet (togliere la parte @xxx.it) nel campo <nobr>"<span style="background-color:yellow" > Indirizzo e-mail: </span>"</nobr>.<br>
 	<b>2: </b>Scegliere il dominio di posta in <nobr>"<span style="background-color:yellow" > @<select name="d">
                                                                                          	<option value="Test Domain 1"> Test 1</option>
                                                                                          	<option value="Test Domain 2"> Test 2</option>
                                                                                          </select>
                                                                                           </span>"</nobr>.<br>
 	<b>3: </b>Selezionare il bottone <input type="button" value="Login">  </span>per accedere.<br>
</ul>

	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Non ho ancora un indirizzo di posta, come faccio a procurarmene uno?</b>
</font>
<ul>       	
 	<b>1: </b>Selezionare il link "<span style="background-color:yellow" > Registrazione nuovi utenti. <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0') ?>> </span>" per aprire
	il modulo di registrazione.<br>
 	<b>2: </b>Premere il bottone "Aiuto" una volta per avere altre istruzioni.<br>
</ul>
	<?php endif;?>		
	<?php if($x1=="1") : ?>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a registrarsi?</b>
</font>
<ul>       	
 	<b>1: </b>Inserire nome e cognome nel campo "<span style="background-color:yellow" > Nome, cognome: </span>".<br>
 	<b>2: </b>Inserire l'indirizzo di posta desiderato nel campo "<span style="background-color:yellow" > Scegliere un indirizzo e-mail: </span>".<p>
 	<b>3: </b>Scegliere il dominio nel campo <nobr>"<span style="background-color:yellow" > @<select name="d">
                                                                                          	<option value="Test Domain 1"> Test 1</option>
                                                                                          	<option value="Test Domain 2"> Test 2</option>
                                                                                          </select>
                                                                                           </span>"</nobr>.<br>
 	<b>4: </b>Scegliere uno pseudonimo ed inserirlo nel campo "<span style="background-color:yellow" > Pseudonimo: </span>".<p>
 	<b>5: </b>Scegliere una password ed inserirla nel campo "<span style="background-color:yellow" > Password: </span>".<br>
 	<b>6: </b>Per controllo, inserire di nuovo la password nel campo "<span style="background-color:yellow" > Ripetere password: </span>".<br>
 	<b>3: </b>Selezionare il bottone <input type="button" value="Registra">.<br>
</ul>
	<?php endif;?>		
<?php endif;?>	
<?php if($src=="mail") : ?>
<?php if($x1=="listmail") : ?>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare per aprire una mail?</b>
</font>
<ul>       	
 	<b>1: </b>Selezionare oggetto, data, mittente o destinatario della mail oppure le icone <img src="../img/c-mail.gif" border=0 align="absmiddle"> or <img src="../img/o-mail.gif" border=0 align="absmiddle">.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Che cosa sono le icone <img src="../img/c-mail.gif" border=0 align="absmiddle"> e <img src="../img/o-mail.gif" border=0 align="absmiddle">?</b>
</font>
<ul>       	
 	<img src="../img/c-mail.gif" border=0 align="absmiddle"> = La mail non è ancora stata aperta.<br>
 	<img src="../img/o-mail.gif" border=0 align="absmiddle"> = La mail è già stata aperta.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a cancellare una mail?</b>
</font>
<ul>       	
 	<b>1: </b>Selezionare la casella <input type="checkbox" name="a" value="s" checked> della mail da cancellare.<br>
 	<b>2: </b>Selezionare il bottone <input type="button" value="Cancella">.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a passare da una cartella di posta ad un'altra?</b>
</font>
<ul>       	
 	<b>1: </b>E' sufficiente selezionare il nome della cartella.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a scrivere una nuova mail?</b>
</font>
<ul>       	
 	<b>1: </b>Selezionare il link "<span style="background-color:yellow" > New Email </span>".<br>
</ul>
	<?php endif;?>		
	<?php if($x1=="compose") : ?>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a scrivere una nuova mail?</b>
</font>
<ul>       	
 	<b>1: </b>Inserire l'indirizzo del destinatario nel campo "<span style="background-color:yellow" > A: </span>".<br>
 	<b>2: </b>Se si vuole mandare una copia anche a qualcun altro, inserire l'indirizzo nel campo "<span style="background-color:yellow" > (CC) </span>".<br>
 	<b>3: </b>Se si vuole mandare in segreto una copia a qualcuno (copia nascosta), inserire l'indirizzo nel campo "<span style="background-color:yellow" > (BCC) </span>".<br>
 	<b>4: </b>Inserire l'oggetto del messaggio nel campo "<span style="background-color:yellow" > Oggetto: </span>".<br>
 	<b>5: </b>Ora si può inserire il testo del messaggio.<br>
 	<b>6: </b>Selezionare il bottone <input type="button" value="Invia"> to send the mail.<br>
</ul>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
E' possibile salvare una mail in bozza senza spedirla?</b>
</font>
<ul>       	
 	<b>1: </b>Inserire il testo del messaggio.<br>
 	<b>2: </b>Selezionare il bottone <input type="button" value="Salva as draft">.<br>
</ul>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare ad usare un indirizzo che è nella mia rubrica?</b>
</font>
<ul>       	
 	<b>1: </b>Selezionare il bottone <input type="button" value="Visualizza all"> sotto a "Quick address".<br>
 	<b>2: </b>Apparirà una finestrella con gli indirizzi.<br>
 	<b>3: </b>Selezionare la casella corrispondente al campo in cui si vuole copiare l'indirizzo.<p>
<ul>   
		Click "A<input type="radio" name="t" value="a">" per copiare l'indirizzo nel campo "A".<br>
		Click "CC<input type="radio" name="t" value="a">" per copiare l'indirizzo nel campo "CC".<br>
		Click "BCC<input type="radio" name="t" value="a">" per copiare l'indirizzo nel campo "BCC".<p>
</ul>
        <img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <b>Nota:</b>  per annullare la
        scelta, selezionare la corrispondente icona <img src="../img/redpfeil.gif" border=0>.<br> 	
        <img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <b>Nota:</b> E' anche possibile
        selezionare più di un indirizzo per volta.<p>
 	<b>4: </b>Selezionare il bottone <input type="button" value="Copia"> per copiare gli indirizzi selezionati.<br>
 	<b>5: </b>Selezionare il link "<span style="background-color:yellow" > <img src="../img/l_arrowGrnSm.gif" border=0> Chiudi </span>"
	 per chiudere la finestrella.<br>
</ul>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come funziona "Quick address"?</b>
</font>
<ul>       	
 	<b>Nota: </b>"Quick address" mostra i primi cinque tra gli indirizzi e-mail che ha memorizzato.<p>
 	<b>1: </b>Scegliere dove mettere l'indirizzo (es. "A:", "CC" oppure "BCC").<br>
 	<b>2: </b>A questo punto selezionare uno degli indirizzi della "Quick address": esso sarà
 	eliminato e sostituito con il nuovo valore.<br>
</ul>
<?php endif;?>		
<?php if(($x1=="sendmail")&&($x3=="1")) : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a scrivere una nuova mail?</b>
</font>
<ul>       	
 	<b>1: </b>Selezionare il link "<span style="background-color:yellow" > Nuova mail </span>".<br>
</ul>
	<?php endif;?>		
<?php endif;?>	
<?php if($src=="read") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a stampare una mail?</b>
</font>
<ul>       	
 	<b>1: </b>Selezionare il link "<span style="background-color:yellow" > Versione stampabile <img src="../img/bul_arrowGrnSm.gif" border=0></span>".<br>
 	<b>2: </b>Apparirà una finestrella con la versione stampabile della mail.<br>
 	<b>3: </b>Scegliere l'opzione "<span style="background-color:yellow" > < Stampa > </span>".<br>
 	<b>4: </b>Quando appare il menu stampante di Windows©, scegliere il bottone "OK".<br>
 	<b>5: </b>Per chiudere la finestra con la versione stampabile, scegliere l'opzione "<span style="background-color:yellow" > < Chiudi > </span>".<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare ad inviare di nuovo una mail?</b>
</font>
<ul>       	
 	<b>1: </b>Selezionare il bottone <input type="button" value="Ripeti invio">.<br>
 	<b>2: </b>Modificare gli indirizzi se necessario.<br>
 	<b>3: </b>Selezionare il bottone <input type="button" value="Invia"> per ripetere la spedizione della mail.
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a mandare a qualcuno copia di una mail?</b>
</font>
<ul>       	
	Nota: questa operazione è anche detta 'inoltro' o 'forward'.<br>
 	<b>1: </b>Selezionare il bottone <input type="button" value="Inoltra">.<br>
 	<b>2: </b>Inserire l'indirizzo di destinazione.<br>
 	<b>3: </b>Selezionare il bottone <input type="button" value="Invia"> per inoltrare la mail.
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a cancellare una mail?</b>
</font>
<ul>       	
 	<b>1: </b>Selezionare il bottone <input type="button" value="Cancella">.<br>
 	<b>2: </b>Prima della cancellazione, sarà chiesta conferma.<br>
 	<b>3: </b>Selezionare il bottone <input type="button" value="OK"> per cancellare la mail.<p>
	<b>Nota:</b> Le mail cancellate dalla cartella "In arrivo" sono temporaneamente messe nel "Cestino".
</ul>
	<?php endif;?>		
<?php if($src=="address") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare ad aggiungere un indirizzo alla rubrica?</b>
</font>
<ul>       	
 	<b>1: </b>Selezionare il bottone <input type="button" value="Aggiungi indirizzo">.<br>
 	<b>2: </b>Apparirà un modulo da riempire: inserire il nome nel campo "<span style="background-color:yellow" > Nome, Cognome: </span>".<br>
 	<b>3: </b>Inserire un eventuale pseudonimo nel campo "<span style="background-color:yellow" > Pseudonimo: </span>".<br>
 	<b>4: </b>Inserire l'indirizzo nel campo "<span style="background-color:yellow" > Indirizzo: </span>".<br>
 	<b>5: </b>Scegliere il dominio di posta nella lista <nobr>"<span style="background-color:yellow" > @<select name="d">
                                                                                          	<option value="Test Domain 1"> Test 1</option>
                                                                                          	<option value="Test Domain 2"> Test 2</option>
                                                                                          </select>
                                                                                           </span>"</nobr>.<br>
 	<b>6: </b>Selezionare il bottone <input type="button" value="Salva">.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a rimuovere un indirizzo dalla rubrica?</b>
</font>
<ul>       	
 	<b>1: </b>Selezionare la casella <input type="checkbox" name="d" value="s" checked> dell'indirizzo da rimuovere.<br>
 	<b>2: </b>Selezionare il bottone <input type="button" value="Cancella">.<br>
 	<b>3: </b>Prima della cancellazione, sarà chiesta conferma.<br>
 	<b>4: </b>Selezionare il bottone <input type="button" value="OK"> per cancellare l'indirizzo.<p>
</ul>
	<?php endif;?>		
	<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b>
Nota:</b>
</font>
<ul>       	
Gli indirizzi intranet funzionano ESCLUSIVAMENTE all'interno e non sono utilizzabili per inviare posta su Internet.<br>
</ul>
	</form>
