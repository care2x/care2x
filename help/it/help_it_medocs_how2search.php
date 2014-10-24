<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Come cercare un medoc</b></font>
<p><font size=2 face="verdana,arial" >
<form action="#" >
<?php if(($src=="?")||($x1=="0")) : ?>
<b>1</b>

<ul> Inserire nel campo "<span style="background-color:yellow" >medoc di:</span>" qualche dato del paziente, per esempio il codice o il nome
(bastano poche lettere).
		<p>Esempio 1: inserire "21000012" o "12".
		<br>Esempio 2: inserire "Rossi" o "ros".
		<br>Esempio 3: inserire "Mario" o "mar".
</ul>
<b>2</b>
<ul> Selezionare il bottone <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> per avviare la ricerca.<p>
</ul>
<b>3</b>
<ul> Se la ricerca trova un solo medoc, questo sarà immediatamente mostrato.
Se ne vengono trovati più di uno, apparirà una lista per la selezione..<p>
Per visualizzare i documenti del paziente desiderato, selezionare il bottone <img <?php echo createComIcon('../','r_arrowgrnsm.gif') ?>> corrispondente,
oppure il cognome, il codice del documento o la data.
</ul>
<?php endif;?>
<?php if($x1>1) : ?>
Per visualizzare i documenti del paziente desiderato, selezionare il bottone <img <?php echo createComIcon('../','r_arrowgrnsm.gif') ?>> corrispondente,
oppure il cognome, il codice del documento o la data.
<?php endif;?>
<?php if(($src!="?")&&($x1=="1")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Desidero aggiornare il documento</b></font>
<ul> Per aggiornare il documento visualizzato, selezionare il bottone <input type="button" value="Update data">.
</ul>
<?php endif;?>
<b>Nota</b>
<ul> Per annullare la ricerca, selezionare il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.
</ul>
</form>
