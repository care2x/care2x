<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
<?php
if($x2=="pharma") echo "Farmacia - "; else echo "Deposito medicinali - ";
	switch($src)
	{
	case "head": if($x2=="pharma") echo "Ordinare prodotti farmaceutici"; 
						else echo "Ordine prodotti";
						break;
	case "catalog": echo "Catalogo ordini";
						break;
	case "orderlist": echo "Lista degli ordini";
						break;
	case "final": echo "Lista ordini finale";
						break;
	case "maincat": echo "Catalogo ordini";
						break;
	case "arch": echo "Archivio ordini";
						break;
	case "archshow": echo "Archivio ordini";
						break;
	case "db": switch($x3)
					{
						case "input": echo "Inserimento nuovo prodotto in banca dati";
						break;
					}
					break;
	case "how2":echo "Come fare a: ordinare ";
						  if($x2=="pharma") echo "prodotti farmaceutici"; else echo "prodotti";
	}
 ?></b></font>
<p><font size=2 face="verdana,arial" >
<form action="#" >
<?php if($src=="maincat") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: aggiungere un articolo nel catalogo ordini?</b>
</font>
<ul>       	
 	<b>1: </b>Prima di tutto è necessario trovare l'articolo: inserire i dati completi (bastano poche lettere) della Casa, del nome, del codice ordine, etc. nel campo 
				<nobr><span style="background-color:yellow" >" Chiave di ricerca: <input type="text" name="s" size=10 maxlength=10> "</span></nobr>.<br>
 	<b>2: </b>Premere il bottone <input type="button" value="Trova articolo"> per trovare l'articolo.<br>
 	<b>3: </b>Se la ricerca identifica un solo articolo, saranno visualizzate informazioni dettagliate.<br>
 	<b>4: </b>Premere il bottone <input type="button" value="Metti a catalogo"> per aggiungere l'articolo nel catalogo.<p>
 	<b>Nota: </b>Se non si vuole mettere l'articolo a catalogo, continuare semplicemente la ricerca per altri articoli.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: continuare la ricerca?</b>
</font>
<ul>       	
 	Seguire semplicemente le istruzioni per cercare un articolo.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
La ricerca ha identificato più articoli che soddisfano i miei criteri. Che devo fare?</b>
</font>
<ul>       	
 	<b>1: </b>Dall'elenco visualizzato, selezionare il bottone <img <?php echo createComIcon('../','dwnarrowgrnlrg.gif','0') ?>> per mettere l'articolo a catalogo.<br>
 	<b>2: </b>Se si desidera vedere prima tutte le informazioni sull'articolo, selezionare o il nome o il bottone <img <?php echo createComIcon('../','info3.gif','0') ?>>.<br>
 	<b>3: </b>Appariranno le informazioni sull'articolo.<br>
 	<b>4: </b>Premere il bottone <input type="button" value="Metti a catalogo">.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Desidero vedere più informazioni sull'articolo. Che devo fare?</b>
</font>
<ul>       	
 	<b>1: </b>Selezionare o il bottone <img <?php echo createComIcon('../','info3.gif','0') ?>> o il nome.<br>
 	<b>2: </b>Appariranno tutte le informazioni sul prodotto.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: rimuovere un articolo dal catalogo?</b>
</font>
<ul>       	
 	<b>1: </b>Premere il bottone <img <?php echo createComIcon('../','delete2.gif') ?>> dell'articolo.<br>
</ul>
<?php endif;?>
<?php if($src=="how2") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: ordinare <?php if($x2=="pharma") echo "prodotti farmaceutici"; else echo "prodotto dal deposito medicinali"; ?>?
</b>
</font>
<ul>       	
 	<b>1: </b>Selezionare l'opzione di menu "<span style="background-color:yellow" > <img <?php echo createComIcon('../','bestell.gif','0') ?>> Ordini </span>" per passare agli ordini.<br>
 	<b>2: </b>Se si è già effettuato il login, appariranno il catalogo ordini e la lista ordini. In caso contrario, il sistema chiederà username
 	e  password.<br>
 	<b>3: </b>Se necessario, inserire username e password, poi selezionare il bottone <img <?php echo createLDImgSrc('../','continue.gif') ?>>.<br>
 	<b>4: </b>Creare una nuova lista: il riquadro di destra contiene 
il catalogo ordini del dipartimento, o corsia, o sala operatoria.<p>
 	<b>5: </b>Se l'articolo richiesto è nella lista, selezionare il corrispondente bottone <img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>> per mettere <b>un pezzo</b> dell'articolo nell'ordine presente nel riquadro a sinistra.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Desidero mettere più di un pezzo dell'articolo nell'ordine. Come fare?</b>
</font>
<ul>       	
 	<b>1: </b>Selezionare la casella <input type="checkbox" name="a" value="a" checked> corrispondente all'articolo da scegliere.<br>
 	<b>2: </b>Inserire il quantitativo nel campo " Pezzi <input type="text" name="d" size=2 maxlength=2> " corrispondente all'articolo.<br>
 	<b>3: </b>Premere il bottone <input type="button" value="Aggiungi alla lista"> per inserire l'articolo nella lista.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
L'articolo non è a catalogo. Che devo fare?</b>
</font>
<ul>       	
 	<b>1: </b>E' necessario trovare l'articolo. Inserire i dati completi (bastano poche lettere) della Casa, del nome, del codice ordine, etc. nel campo
				<nobr><span style="background-color:yellow" >" Chiave di ricerca: <input type="text" name="s" size=10 maxlength=10> "</span></nobr>.<br>
 	<b>2: </b>Premere il bottone <input type="button" value="Trova articolo"> per trovare l'articolo.<br>
 	<b>3: </b>Se la ricerca trova più di un articolo, apparirà un elenco.<br>
 	<b>4: </b>Se si desidera inserire un pezzo dell'articolo nell'ordine, selezionare il bottone <img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>>. The article will be put in the basket e at the same it will be included in the catalog listing.<br>
 	<b>5: </b>Se si desidera aggiungere il catalogo solo alla lista, selezionare il bottone <img <?php echo createComIcon('../','dwnarrowgrnlrg.gif','0') ?>>.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Desidero vedere più informazioni sull'articolo. Che devo fare?</b>
</font>
<ul>       	
 	<b>1: </b>Selezionare o il bottone <img <?php echo createComIcon('../','info3.gif','0') ?>> o il nome.<br>
 	<b>2: </b>Apparirà una finestrella con tutte le informazioni sull'articolo.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: rimuovere un articolo dal catalogo?</b>
</font>
<ul>       	
 	<b>1: </b>Premere il bottone <img <?php echo createComIcon('../','delete2.gif') ?>> dell'articolo.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Posso cambiare il numero di pezzi da ordinare?
</b>
</font>
<ul>       	
 	<b>Sì:</b> basta sostituire il valore corrente con quello desiderato prima di chiudere la lista.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
L'ordine è completo: cosa faccio ora?</b>
</font>
<ul>       	
 	<b>1: </b>Si può procedere inviando l'ordine <?php if($x2=="pharma") echo "alla farmacia"; else echo "al deposito medicinali"; ?>. <br>Premere il bottone <input type="button" value="Chiudere ordine"> per avviare la procedura.<br>
 	<b>2: </b>L'elenco apparirà di nuovo: inserire il proprio nome nel campo <nobr>"<span style="background-color:yellow" > Creato da <input type="text" name="c" size=15 maxlength=10> </span>"</nobr>.<br>
 	<b>3: </b>Scegliere la priorità dell'ordine da "<span style="background-color:yellow" > Normale<input type="radio" name="x" value="s" checked> Urgente<input type="radio" name="x" > </span>" tramite la casella più adatta.<br>
 	<b>4: </b>Chi convalida l'ordine (medico o chirurgo) deve inserire il proprio nome nel campo <nobr>"<span style="background-color:yellow" > Convalidato da <input type="text" name="c" size=15 maxlength=10> </span>"</nobr>.<br>
 	<b>5: </b>Chi convalida l'ordine (medico o chirurgo) deve inserire la propria password nel campo <nobr>"<span style="background-color:yellow" > Password: <input type="text" name="c" size=15 maxlength=10> </span>"</nobr>.<br>
 	<b>6: </b>Premere il bottone <input type="button" value="Inviare l'ordine <?php if($x2=="pharma") echo "alla farmacia"; else echo "al deposito medicinali"; ?>"> per spedire la lista.<br>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 Per annullare l'invio dell'ordine, selezionare "<span style="background-color:yellow" > << Torna alla modifica lista </span>".
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Desidero chiudere l'ordine adesso. Che devo fare?</b>
</font>
<ul>     
 	<b>1: </b>Selezionare il link "<span style="background-color:yellow" > <img <?php echo createComIcon('../','arrow-blu.gif','0') ?>> Chiudere ordine </span>" per tornare al menu <?php if($x2=="pharma") echo "farmacia"; else echo "deposito medicinali"; ?>.<br>
</ul>	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Desidero creare un nuovo ordine. Che devo fare?</b>
</font>
<ul>     
 	<b>1: </b>Selezionare il link "<span style="background-color:yellow" > <img <?php echo createComIcon('../','arrow-blu.gif','0') ?>> Creare un nuovo ordine </span>" per creare una lista vuota.<br>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 Premendo il bottone <img <?php echo createComIcon('../','frage.gif','0') ?>> si otterranno informazioni dettagliate sul catalogo o sull'ordine.
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 Per chiudere selezionare il bottone <img <?php echo createLDImgSrc('../','close2.gif') ?>>.
</ul>
<?php endif;?>
<?php if($src=="head") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: ordinare <?php if($x2=="pharma") echo "prodotti farmaceutici"; 
						else echo "prodotti del deposito medicinali"; ?>?
</b>
</font>
<ul>       	
 	<b>1: </b>Prima di tutto creare una lista. A destra apparirà il 
catalogo ordini del dipartimento, della corsia, o della sala 
operatoria.<p>
 	<b>2: </b>Se l'articolo richiesto è nel catalogo, premere il suo bottone <img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>> per mettere <b>un pezzo</b> dell'articolo nell'ordine presente nel riquadro a sinistra.<p>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 Premendo il bottone <img <?php echo createComIcon('../','frage.gif','0') ?>> si otterranno informazioni dettagliate sul catalogo o sull'ordine.
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 Per chiudere selezionare il bottone <img <?php echo createLDImgSrc('../','close2.gif') ?>>.
</ul>
<?php endif;?>
<?php if($src=="catalog") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: aggiungere un articolo all'ordine?
</b>
</font>
<ul>       	
 	<b>1: </b>Se l'articolo richiesto è nel catalogo, premere il suo bottone <img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>> per mettere <b>un pezzo</b> dell'articolo nell'ordine presente nel riquadro a sinistra.<p>
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Desidero mettere più di un pezzo nell'ordine. Come fare?</b>
</font>
<ul>       	
 	<b>1: </b>Selezionare la casella <input type="checkbox" name="a" value="a" checked> corrispondente all'articolo da scegliere.<br>
 	<b>2: </b>Inserire il quantitativo nel campo "Pezzi<input type="text" name="d" size=2 maxlength=2> " corrispondente all'articolo.<br>
 	<b>3: </b>Premere il bottone <input type="button" value="Aggiungere all'ordine">.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
L'articolo non è a catalogo. Che devo fare?</b>
</font>
<ul>       	
 	<b>1: </b>Prima di tutto è necessario trovare l'articolo: inserire i dati completi (bastano poche lettere) della Casa, del nome, del codice ordine, etc. nel campo 
				<nobr><span style="background-color:yellow" >" Chiave di ricerca: <input type="text" name="s" size=10 maxlength=10> "</span></nobr>.<br>
 	<b>2: </b>Premere il bottone <input type="button" value="Trova articolo"> per trovare l'articolo.<br>
 	<b>3: </b>Se la ricerca identifica un solo articolo, saranno visualizzate informazioni dettagliate.<br>
 	<b>4: </b>Se si desidera inserire un solo pezzo nell'ordine, selezionare il bottone <img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>>. L'articolo sarà aggiunto sia all'ordine che nel catalogo.<br>
 	<b>5: </b>Se si desidera solo aggiungere l'articolo al catalogo, selezionare il bottone <img <?php echo createComIcon('../','dwnarrowgrnlrg.gif','0') ?>>.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Desidero vedere più informazioni sull'articolo. Che devo fare?</b>
</font>
<ul>       	
 	<b>1: </b>Selezionare o il bottone <img <?php echo createComIcon('../','info3.gif','0') ?>> o il nome.<br>
 	<b>2: </b>Apparirà una finestrella con tutte le informazioni sull'articolo.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: rimuovere un articolo dal catalogo?</b>
</font>
<ul>       	
 	<b>1: </b>Premere il bottone <img <?php echo createComIcon('../','delete2.gif') ?>> dell'articolo.<br>
</ul>
<?php endif;?>
<?php if($src=="orderlist") : ?>
	<?php if($x1=="0") : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 Al momento l'ordine è vuoto.<p>
 Per comporre l'ordine, scegliere l'articolo richiesto dal catalogo a destra ed aggiungerlo all'ordine.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: aggiungere un articolo all'ordine?
</b>
</font>
<ul>       	
 	<b>1: </b>Se l'articolo richiesto è nel catalogo, premere il suo bottone <img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>> to put <b>one piece</b> dell'articolo to the order list (basket).
 	<br> Apparirà automaticamente la lista nel riquadro a sinistra.<p>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 Per informazioni dettagliate su come cercare, scegliere ed aggiungere articoli alla lista, selezionare <img <?php echo createComIcon('../','frage.gif','0') ?>> nel riquadro del catalogo a destra.<p>
</ul>
	<?php else : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Posso cambiare il numero di pezzi da ordinare?
</b>
</font>
<ul>       	
 	<b>Sì: basta sostituire il valore corrente con quello desiderato prima di chiudere la lista.</b>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Desidero vedere più informazioni sull'articolo. Che devo fare?</b>
</font>
<ul>       	
 	<b>1: </b>Premere il bottone <img <?php echo createComIcon('../','info3.gif','0') ?>> dell'articolo.<br>
 	<b>2: </b>Apparirà una finestrella con tutte le informazioni sull'articolo.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: rimuovere un articolo dall'ordine?</b>
</font>
<ul>       	
 	<b>1: </b>Premere il bottone <img <?php echo createComIcon('../','delete2.gif') ?>> dell'articolo.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
L'ordine è completo: che faccio ora?</b>
</font>
<ul>       	
 	<b>1: </b>Si può procedere inviando l'ordine alla farmacia. <br>Premere il bottone <input type="button" value="Chiudere ordine"> per avviare la procedura.<br>
 	<b>2: </b>L'elenco apparirà di nuovo: inserire il proprio nome nel campo <nobr>"<span style="background-color:yellow" > Creato da <input type="text" name="c" size=15 maxlength=10> </span>"</nobr>.<br>
 	<b>3: </b>Scegliere la priorità dell'ordine da "<span style="background-color:yellow" > Normale<input type="radio" name="x" value="s" checked> Urgente<input type="radio" name="x" > </span>" tramite la casella più adatta.<br>
 	<b>4: </b>Chi convalida l'ordine (medico o chirurgo) deve inserire il proprio nome nel campo <nobr>"<span style="background-color:yellow" > Convalidato da <input type="text" name="c" size=15 maxlength=10> </span>"</nobr>.<br>
 	<b>5: </b>Chi convalida l'ordine (medico o chirurgo) deve inserire la propria password nel campo <nobr>"<span style="background-color:yellow" > Password: <input type="text" name="c" size=15 maxlength=10> </span>"</nobr>.<br>
 	<b>6: </b>Premere il bottone <input type="button" value="Inviare l'ordine alla farmacia"> per spedire la lista.<br>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 Per annullare l'invio dell'ordine, selezionare il link "<span style="background-color:yellow" > << Torna alla modifica lista </span>".
</ul>
	<?php endif;?>
<?php endif;?>
<?php if($src=="final") : ?>
	<?php if($x1=="1") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Desidero chiudere l'ordine adesso. Che devo fare?</b>
</font>
<ul>     
 	<b>1: </b>Selezionare il link "<span style="background-color:yellow" > <img <?php echo createComIcon('../','arrow-blu.gif','0') ?>> Chiusura ordine </span>" per tornare al menu farmacia.<br>
</ul>	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Desidero creare un nuovo ordine. Che devo fare?</b>
</font>
<ul>     
 	<b>1: </b>Selezionare il link "<span style="background-color:yellow" > <img <?php echo createComIcon('../','arrow-blu.gif','0') ?>> Creare un nuovo ordine </span>" per creare una lista vuota.<br>
</ul>		<?php else : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come fare a: send the final order list?</b>
</font>
<ul>       	
 	<b>1: </b>Inserire il proprio nome nel campo <nobr>"<span style="background-color:yellow" > Creato da <input type="text" name="c" size=15 maxlength=10> </span>"</nobr>.<br>
 	<b>2: </b>Scegliere la priorità dell'ordine da "<span style="background-color:yellow" > Normale<input type="radio" name="x" value="s" checked> Urgente<input type="radio" name="x" > </span>" tramite la casella più adatta.<br>
 	<b>3: </b>Chi convalida l'ordine (medico o chirurgo) deve inserire il proprio nome nel campo <nobr>"<span style="background-color:yellow" > Convalidato da <input type="text" name="c" size=15 maxlength=10> </span>"</nobr>.<br>
 	<b>4: </b>Chi convalida l'ordine (medico o chirurgo) deve inserire la propria password nel campo <nobr>"<span style="background-color:yellow" > Password: <input type="text" name="c" size=15 maxlength=10> </span>"</nobr>.<br>
 	<b>5: </b>Premere il bottone <input type="button" value="Inviare l'ordine alla farmacia"> per spedire la lista.<br>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
 Per annullare l'invio dell'ordine, selezionare "<span style="background-color:yellow" > << Torna alla modifica lista </span>".
</ul>
	<?php endif;?>
<?php endif;?>
<!-- ++++++++++++++++++++++++++++++++++ archive +++++++++++++++++++++++++++++++++++++++++++ -->
<?php if($src=="arch") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Desidero vedere gli ordini archiviati.</b></font>
<ul>  	<b>1: </b> Inserire o i dati completi (bastano poche lettere) del nome dipartimento, identificativo, data dell'ordine o priorità (es "urgente") nel campo 
				<nobr><span style="background-color:yellow" >" Chiave di ricerca: <input type="text" name="s" size=10 maxlength=10> "</span></nobr>.<br>
 	<b>2: </b>Selezionare o deselezionare le caselle per queste categorie di ricerca:
<ul> 	
  	<input type="checkbox" name="d" checked> Data<br>
	<input type="checkbox" name="d" checked> Dipartimento<br>
  	<input type="checkbox" name="d" checked> Priorità<br>
	Inizialmente tutte le caselle sono selezionate, quindi la ricerca avviene su tutte e tre le categorie. Se si desidera escludere una categoria, disattivare la casella.
</ul> 	
<b>3: </b>Premere il bottone <input type="button" value="Ricerca"> per trovare l'articolo.<br>
 	<b>4: </b>Se la ricerca identifica uno o più ordini, apparirà un elenco.<br>
 	<b>5: </b>Premere il bottone <img <?php echo createComIcon('../','uparrowgrnlrg.gif','0') ?>> della lista desiderata per vedere i dettagli dell'ordine<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>La lista contiene molti ordini. Come fare a: vederne uno in particolare?</b></font>
<ul>  	
 	<b>1: </b>Premere il bottone <img <?php echo createComIcon('../','uparrowgrnlrg.gif','0') ?>> dell'ordine desiderato.<br>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
Per terminare la ricerca e chiudere, selezionare il bottone <img <?php echo createLDImgSrc('../','close2.gif') ?>>.
</ul>
	<?php endif;?>
<?php if($src=="archshow") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Desidero vedere più informazioni sull'articolo. Che devo fare?</b>
</font>
<ul>       	
 	<b>1: </b>Selezionare <img <?php echo createComIcon('../','info3.gif','0') ?>> dell'articolo.<br>
 	<b>2: </b>Apparirà una finestrella con tutte le informazioni sull'articolo.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Che devo fare per vedere di nuovo l'elenco degli ordini archiviati?</b>
</font>
<ul>       	
 	<b>1: </b>Premere il bottone <input type="button" value="<< Indietro">.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Desidero effettuare una nuova ricerca in archivio. Che devo fare?</b></font>
<ul>  	<b>1: </b> Inserire o i dati completi (bastano poche lettere) del nome dipartimento, identificativo, data dell'ordine o priorità (es "urgente") nel campo 
				<nobr><span style="background-color:yellow" >" Chiave di ricerca: <input type="text" name="s" size=10 maxlength=10> "</span></nobr>.<br>
 	<b>2: </b>Selezionare o deselezionare le caselle per queste categorie di ricerca:
<ul> 	
  	<input type="checkbox" name="d" checked> Data<br>
	<input type="checkbox" name="d" checked> Dipartimento<br>
  	<input type="checkbox" name="d" checked> Priorità<br>
	Inizialmente tutte le caselle sono selezionate, quindi la ricerca avviene su tutte e tre le categorie. Se si desidera escludere una categoria, disattivare la casella.
</ul> 	
<b>3: </b>Premere il bottone <input type="button" value="Ricerca"> per trovare l'articolo.<br>
 	<b>4: </b>Se la ricerca identifica uno o più ordini, apparirà un elenco.<br>
</ul>
	<?php endif;?>	
<?php if($src=="db") : ?>
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
 	<b>1: </b>Premere il bottone <input type="button" value="Aggiorna o modifica">.<br>
 	<b>2: </b>I dati del prodotto saranno inseriti automaticamente nel modulo.<br>
 	<b>3: </b>Modificare i dati.<br>
 	<b>4: </b>Premere il bottone <input type="button" value="Salva"> per salvare i nuovi dati.<br>
</ul>
	<?php endif;?>	
<?php endif;?>	
</form>
