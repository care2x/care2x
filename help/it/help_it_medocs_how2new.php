<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Come fare a: inserire in un medoc i documenti di un paziente</b></font>
<p><font size=2 face="verdana,arial" >
<form action="#" >
<?php if($src=="?") : ?>
<b>1</b>
<ul>Trovare i dati fondamentali di un paziente.<br>
		Nel campo "Documenti del seguente paziente:" inserire:<br>
		<Ul type="disc">
			<li>il codice paziente, oppure<br>
			<li>il cognome, oppure<br>
			<li>il nome<br>
		<font size=1 color="#000099" face="verdana,arial">
		<b>Nota:</b>Se il sistema è dotato di lettore di codici a barre, selezionare il campo "Documenti del seguente paziente:"
		e leggere il codice del paziente con lo scanner. In questo caso, saltare direttamente al passo 2.
		</font>
		</ul>
</ul>
<b>2</b>
<ul> Selezionare il bottone <input type="button" value="Ricerca"> per attivare la ricerca.
</ul>
<b>Alternative al passo 2</b>
<ul>Si può anche:<br>
		<Ul type="disc">		
		<li>Inserire il cognome nel campo "Cognome:"<br>
		<li>oppure inserire il nome nel campo "Nome:"<br>
		</ul>
		e poi premere il tasto "Enter".
</ul>
<b>3</b>
<ul> Se la ricerca trova un solo risultato, apparirà una pagina con i dati fondamentali del paziente.
Se invece la ricerca trova più risultati, apparirà un elenco.
<?php endif;?>
<?php if(($src=="?")||($x1>1)) : ?>
 <br>Per inserire documenti di un paziente nella lista,
		selezionare il bottone <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> corrispondente, oppure
		il cognome, il nome, il codice paziente, o la data di accettazione.
</ul>
<?php endif;?>
<?php if($src=="?") : ?>
<b>4</b>
<?php endif;?>
<?php if(($src!="?")&&($x1==1)) : ?>
<b>1</b>
<?php endif;?>
<?php if(($x1=="1")||($src=="?")) : ?>
<ul> Una volta che è apparso il modulo con i dati paziente, è possibile: 
		<Ul type="disc">		
    <li>inserire ulteriori informazioni sull'assicurazione nel campo "Informazioni aggiuntive:",<br>
		<li>selezionare "<span style="background-color:yellow" ><input type="radio" name="n" value="a">Sì</span>" nei campi "Medical advice" se il paziente ha ricevuto le informative,<br>
		<li>click "<span style="background-color:yellow" ><input type="radio" name="n" value="a">No</span>" in caso contrario,<br>
		<li>inserire un rapporto diagnostico nel campo "Diagnosi",<br>
		<li>inserire un rapporto terapico nel campo "Terapia:",<br>
		<li>Se necessario, cambiare la data nel campo "Registrato il:",<br>
		<li>Se necessario, cambiare il nome nel campo "Registrato da:",<br>
		<li>Se necessario, inserire un numero chiave nel campo "Numero chiave:",<br>
		</ul>
</ul>
<b>Nota</b>
<ul> Per cancellare i dati inseriti selezionare il bottone <input type="button" value="Reset">.
</ul>

<b><?php if($src!="?") print "2"; else print "5"; ?></b>
<ul> Selezionare il bottone <input type="button" value="Salva"> per salvare il documento.
</ul>
<?php endif;?>
<b>Nota</b>
<ul> Per cancellare il documento selezionare il bottone <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> border=0>.
</ul>
</form>
