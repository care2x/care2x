<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
CED - 
<?php
	switch($src)
	{
	case "access": switch($x1)
						{
							case "": print "Creazione privilegi di accesso";
												break;
							case "save": print "Nuovi privilegi di accesso salvati";
												break;
							case "list": print "Privilegi di accesso esistenti";
												break;
							case "update": print "Modificare privilegi di accesso esistenti";
												break;
							case "lock":  if($x2=="0") print "Bloccare"; else print "Sbloccare"; print  " privilegi esistenti";
												break;
							case "cancellare": print "Eliminare un privilegio di accesso";
												break;
						}
						break;
	}


 ?></b></font>
<p><font size=2 face="verdana,arial" >
<form action="#" >

	

<?php if($src=="access") : ?>
	<?php if($x1=="") : ?>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come creare un nuovo privilegio di accesso?</b>
</font>
<ul>       	
 	<b>1: </b>Inserire il nome completo della persona, o il dipartimento, o la clinica , etc nel campo "<span style="background-color:yellow" > Nome </span>".<br>
 	<b>2: </b>Inserire lo username nel campo "<span style="background-color:yellow" > Login </span>".<p>
	<b>Nota:</b> non si possono usare caratteri spazio nello username.<p>
 	<b>3: </b>Inserire la password nel campo "<span style="background-color:yellow" > Password </span>".<br>
 	<b>4: </b>Scegliere le aree a cui l'utente può accedere nel campo "<span style="background-color:yellow" > # Area </span>".<p>
	<b>Nota:</b> ogni utente può accedere ad un massimo di dieci aree (da Area 1 ad Area 10).<p>
</ul>

	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ho finito di inserire le informazioni necessarie. Come fare a salvare?</b>
</font>
<ul>       	
 	<b>1: </b>Premere il bottone <input type="button" value="Salva">.<br>
</ul>
	<?php endif;?>	
	<?php if($x1=="save") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ho salvato i nuovi diritti di accesso: come fare a crearne altri?</b>
</font>
<ul>       	
 	<b>1: </b>Premere il bottone <input type="button" value="OK">.<br>
 	<b>2: </b>Apparirà il modulo per inserire i nuovi dati.<br>
 	<b>3: </b>Per ricevere altre istruzioni, selezionare il tasto "Aiuto".<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Desidero vedere the lista dei privilegi di accesso esistenti. Come fare?</b>
</font>
<ul>       	
 	<b>1: </b>Premere il bottone <input type="button" value="Lista privilegi di accesso">.<br>
</ul>

	<?php endif;?>	
	<?php if($x1=="list") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
What do the buttons <img <?php echo createComIcon('../','padlock.gif','0','absmiddle') ?>> e <img <?php echo createComIcon('../','arrow-gr.gif','0','absmiddle') ?>> mean?</b>
</font>
<ul>       	
 	<img <?php echo createComIcon('../','padlock.gif','0','absmiddle') ?>> = I privilegi dell'utente sono bloccati o "congelati", quindi non può accedere alle aree.<br>
 	<img <?php echo createComIcon('../','arrow-gr.gif','0','absmiddle') ?>> = I privilegi dell'utente non sono bloccati: l'accesso alle aree abilitate è possibile.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Che cosa sono le opzioni "M", "B", "R" ed "S"?</b>
</font>
<ul>       	
 	<b>M: </b> = Modifica i diritti di accesso dell'utente.<br>
 	<b>B: </b> = Blocca l'utente.<br>
 	<b>R: </b> = Rimuovi i privilegi dell'utente.<br>
 	<b>S: </b> = Sblocca l'utente (se bloccato).<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: modificare i privilegi di accesso?</b>
</font>
<ul>       	
 	Scegliere l'opzione "<span style="background-color:yellow" > M </span>" corrispondente all'utente.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: bloccare un utente?</b>
</font>
<ul>       	
 	Scegliere l'opzione "<span style="background-color:yellow" > B </span>" corrispondente all'utente.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: sbloccare un utente? (se bloccato)</b>
</font>
<ul>       	
 	Scegliere l'opzione "<span style="background-color:yellow" > S </span>" corrispondente all'utente.<br>
</ul>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: rimuovere i diritti di accesso?</b>
</font>
<ul>       	
 	Scegliere l'opzione "<span style="background-color:yellow" > R </span>" corrispondente all'utente.<br>
</ul>
	<?php endif;?>	
	<?php if($x1=="update") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: modificare i diritti di accesso?</b>
</font>
<ul>       	
 	<b>1: </b>Modificare i dati.<br>
 	<b>2: </b>Premere il bottone <input type="button" value="Salva">.<br>
</ul>
	<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b>
Nota:</b>
</font>
<ul>       	
 	E' possibile annullare le modifiche premendo il bottone <input type="button" value="Annulla">.<br>
</ul>
	<?php endif;?>		
	<?php if($x1=="cancellare") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: rimuovere i diritti di accesso?</b>
</font>
<ul>       	
 	<b>1: </b>se si è sicuri della cancellazione,<br>
	 selezionare il bottone <input type="button" value="Sì, sono sicuro: cancella i diritti di accesso.">.<br>
</ul>
	<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b>
Nota:</b>
</font>
<ul>       	
 	E' possibile annullare le modifiche premendo il bottone <input type="button" value="No. Indietro.">.<br>
</ul>
	<?php endif;?>		
	<?php if($x1=="lock") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: <?php if($x2=="0") print "bloccare"; else print "sbloccare"; ?> i diritti di accesso?</b>
</font>
<ul>       	
 	<b>1: </b>Se si è sicuri di <?php if($x2=="0") print "bloccare"; else print "sbloccare"; ?> i diritti di accesso,<br>
	 selezionare il bottone <input type="button" value="Sì">.<br>
</ul>
	<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b>
Nota:</b>
</font>
<ul>       	
 	E' possibile annullare <?php if($x2=="0") print "il blocco"; else print "lo sblocco"; ?> selezionando il bottone <input type="button" value="No. Indietro.">.<br>
</ul>
	
	<?php endif;?>		
<?php endif;?>	
</form>
