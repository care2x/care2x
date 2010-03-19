<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
<?php
if($x2=="pharma") print "Farmacia - "; else print "Deposito medicinali - ";
	switch($src)
	{
	case "input": print "Inserimento nuovo prodotto in banca dati";
					break;
	case "search": print "Ricerca un prodotto";
					break;
	case "mng": print "Gestione prodotti in banca dati";
					break;
	case "cancellare": print "Eliminazione di un prodotto dalla banca dati";
					break;
	}

 ?></b></font>
<p><font size=2 face="verdana,arial" >
<form action="#" >
<?php if($src=="input") : ?>
	<?php if($x1=="") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: inserire un nuovo prodotto in banca dati?</b>
</font>
<ul>       	
 	<b>1: </b>Prima di tutto inserire tutte le informazioni disponibili nei campi appropriati.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Desidero selezionare un'immagine di un prodotto. Come fare?</b>
</font>
<ul>       	
 	<b>1: </b>Premere il bottone <input type="button" value="Mostra..."> nel campo "<span style="background-color:yellow" > Immagine </span>".<br>
 	<b>2: </b>Apparirà una finestrella con le immagini: scegliere quella che si desidera e premere "OK".<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ho finito di inserire le informazioni che avevo. Come fare a salvarle?</b>
</font>
<ul>       	
 	<b>1: </b>Premere il bottone <input type="button" value="Salva">.<br>
</ul>
	<?php endif;?>	
	<?php if($x1=="save") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: inserire un nuovo prodotto in banca dati?</b>
</font>
<ul>       	
 	<b>1: </b>Premere il bottone <input type="button" value="Nuovo prodotto">.<br>
 	<b>2: </b>Apparirà il modulo di inserimento dati.<br>
 	<b>3: </b>Inserire le informazioni disponibili sul prodotto.<br>
 	<b>4: </b>Premere il bottone <input type="button" value="Salva"> per salvare le informazioni.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Desidero modificare il prodotto attualmente visualizzato: come fare?</b>
</font>
<ul>       	
 	<b>1: </b>Premere il bottone <input type="button" value="Modifica o aggiorna">.<br>
 	<b>2: </b>I dati del prodotto saranno inseriti automaticamente nel modulo.<br>
 	<b>3: </b>Modificare i dati.<br>
 	<b>4: </b>Premere il bottone <input type="button" value="Salva"> per salvare i nuovi dati.<br>
</ul>
	<?php endif;?>	
<?php endif;?>	
<?php if($src=="search") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: search un prodotto?</b>
</font>
<ul>       	
 	<b>1: </b>Inserire i dati completi (bastano poche lettere) della Casa, del nome, del codice ordine, etc. nel campo 
				<nobr><span style="background-color:yellow" >" Chiave di ricerca: <input type="text" name="s" size=10 maxlength=10> "</span></nobr>.<br>
 	<b>2: </b>Premere il bottone <input type="button" value="Ricerca"> per trovare l'articolo.<br>
 	<b>3: </b>Se la ricerca identifica un solo articolo, saranno visualizzate informazioni dettagliate.<br>
 	<b>4: </b>Se la ricerca trova più di un articolo, apparirà un elenco.<br>
</ul>
	<?php if($x1!="multiple") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a vedere informazioni su uno specifico articolo di una lista?</b>
</font>
<ul>       	
 	<b>1: </b>Selezionare o il bottone <img <?php echo createComIcon('../','info3.gif','0') ?>> o il nome.<br>
</ul>
	<?php endif;?>
	<?php if($x1=="multiple") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Desidero vedere la precedente lista di articoli. Che devo fare?</b>
</font>
<ul>       	
 	<b>1: </b>Premere il bottone <input type="button" value="Indietro">.<br>
</ul>
	<?php endif;?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 Per annullare premere il bottone <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
</ul>
<?php endif;?>
<?php if($src=="mng") : ?>
	<?php if(($x3=="1")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: modificare le informazioni sul prodotto?</b>
</font>
<ul>       	
 	<b>1: </b>Modificare i dati del prodotto.<br>
 	<b>2: </b>Premere il bottone <input type="button" value="Salva"> per salvare i nuovi dati.<br>
</ul>
	<?php endif;?>
	<?php if($x1=="multiple") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Desidero modificare il prodotto attualmente visualizzato: come fare?</b>
</font>
<ul>       	
 	<b>1: </b>Premere il bottone <input type="button" value="Aggiorna o modifica">.<br>
 	<b>2: </b>I dati del prodotto saranno inseriti automaticamente nel modulo.<br>
 	<b>3: </b>Modificare i dati.<br>
 	<b>4: </b>Premere il bottone <input type="button" value="Salva"> per salvare i nuovi dati.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: rimuovere un articolo dal catalogo?</b>
</font>
<ul>       	
 	<b>1: </b>Premere il bottone <input type="button" value="Rimuovere dalla banca dati">.<br>
 	<b>2: </b>Sarà chiesta conferma prima della cancellazione<br>
 	<b>3: </b>Se si desidera realmente procedere, premere il bottone <input type="button" value="Sono sicuro: rimuovere i dati."><p>
 	<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> I dati cancellati non sono recuperabili.<br>
</ul>	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Non voglio cancellare le informazioni sul prodotto: che devo fare?</b>
</font>
<ul>       	
 	<b>1: </b>Selezionare il link "<span style="background-color:yellow" > << No, non cancellare. Indietro </span>".<br>
</ul>	
<?php endif;?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: gestire un prodotto in banca dati?</b>
</font>
<ul>       	
 	<b>1: </b>Prima di tutto è necessario trovare l'articolo: inserire i dati completi (bastano poche lettere) della Casa, del nome, del codice ordine, etc. nel campo 
				<nobr><span style="background-color:yellow" >" Chiave di ricerca: <input type="text" name="s" size=10 maxlength=10> "</span></nobr>.<br>
 	<b>2: </b>Premere il bottone <input type="button" value="Ricerca"> per trovare l'articolo.<br>
 	<b>3: </b>Se la ricerca identifica un solo articolo, saranno visualizzate informazioni dettagliate.<br>
 	<b>4: </b>Se la ricerca trova più di un articolo, apparirà un elenco.<br>
</ul>
	<?php if(($x1!="multiple")&&($x3=="")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
La lista contiene più articoli: come fare a visualizzarne uno in particolare?</b>
</font>
<ul>       	
 	<b>1: </b>Selezionare o il bottone <img <?php echo createComIcon('../','info3.gif','0') ?>> o il nome.<br>
</ul>
	<?php endif;?>
	<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 Per annullare premere il bottone <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
</ul>
<?php endif;?>
<?php if($src=="cancellare") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Desidero rimuovere il prodotto dalla banca dati. Che devo fare?</b>
</font>
<ul>       	
 	<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> I dati cancellati non sono recuperabili.<br>
 	<b>1: </b>Se si desidera realmente procedere, premere il bottone <input type="button" value="Sono sicuro: rimuovere i dati."><p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Non voglio cancellare le informazioni sul prodotto: che devo fare?</b>
</font>
<ul>       	
 	<b>1: </b>Selezionare il link "<span style="background-color:yellow" > << No, non cancellare. Indietro </span>".<br>
</ul>	
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 Per annullare premere il bottone <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
</ul>
<?php endif;?>	
<?php if($src=="report") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: scrivere un report?</b>
</font>
<ul>       	
 	<b>1: </b>Scrivere il report nel campo <nobr><span style="background-color:yellow" >" Report: <input type="text" name="s" size=10 maxlength=10> "</span></nobr>.<br>
 	<b>2: </b>Inserire il proprio nome nel campo <nobr><span style="background-color:yellow" >" Autore: <input type="text" name="s" size=10 maxlength=10> "</span></nobr>.<br>
 	<b>3: </b>Inserire il proprio codice nel campo <nobr><span style="background-color:yellow" >" Codice personale: <input type="text" name="s" size=10 maxlength=10> "</span></nobr>.<br>
 	<b>4: </b>Premere il bottone <input type="button" value="Invia"> per inviare il report.<br>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b><br></font> 
       	
Per annullare o terminare premere il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.
</ul>
<?php endif;?>	
</form>
