<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Come fare a: 
<?php
switch($x1)
{
 	case "search": echo 'cercare un numero di telefono'; break;
	case "dir": echo 'aprire l\'elenco telefonico';break;
	case "newphone": echo 'inserire un nuovo telefono';break;
 }
 ?></b></font>
<p><font size=2 face="verdana,arial" >
<form action="#" >
<?php if($x1=="search") : ?>
	<?php if($src=="newphone") { ?>
	<b>1</b>
	<ul> Selezionare il bottone <img <?php echo createLDImgSrc('../','such-gray.gif','0') ?>>.
	</ul>
	<?php } ?>
<b><?php if($src=="newphone") echo "2"; else echo "1"; ?></b>

<ul>Inserire l'elemento da cercare (bastano poche lettere) nel campo "<span style="background-color:yellow" >Nuova ricerca</span>"; per esempio si possono
iserire il dipartimento, il nome o il cognome.
		<br>Example 1: enter "m9a" or "M9A" or "M9".
		<br>Example 2: enter "Rossi" or "ros".
		<br>Example 3: enter "Mario" or "mar".
		<br>Example 4: enter "op11" or "OP11" or "op".
</ul>
<b><?php if($src=="newphone") echo "3"; else echo "2"; ?></b>
<ul> Selezionare il bottone <input type="button" value="SEARCH"> per avviare la ricerca.<p>
</ul>
<b><?php if($src=="newphone") echo "4"; else echo "3"; ?></b>
<ul> Se la ricerca trova dei dati, apparirà un elenco.<p>
</ul>
<?php endif;?>
<?php if($x1=="dir") : ?>
<b>1</b>
<ul> Selezionare il bottone <img <?php echo createLDImgSrc('../','phonedir-gray.gif','0') ?>>.
</ul>
<?php endif;?>
<?php if($x1=="newphone") : ?>
	<?php if($src=="search") { ?>
<b>1</b>
<ul> Selezionare il bottone <img <?php echo createLDImgSrc('../','newdata-gray.gif','0') ?>>.
</ul>
<b>2</b>
<ul> Se si è fatto login precedentemente e si hanno i privilegi di accesso sufficienti,
nella finestra centrale apparirà il modulo da compilare per inserire un nuovo
telefono.<br>
		Se invece non si è ancora effettuato il login, verrà richiesto di inserire username e password. <p>
	<?php } ?>
		Inserire username e password, poi selezionare il bottone <img <?php echo createLDImgSrc('../','continue.gif','0') ?>>.<p>
</ul><?php endif;?>
<b>Nota</b>
<ul> Per 
<?php
switch($x1)
{
 	case "search": echo ' annullare la ricerca selezionare il bottone <img '.createLDImgSrc('../','cancel.gif','0').' border=0>.'; break;
	case "dir": echo ' chiudere l\'elenco selezionare il bottone <input type="button" value="Annulla">.';break;
	case "newphone": echo ' annullre selezionare il bottone <img '.createLDImgSrc('../','cancel.gif','0').' border=0>.';break;
 }
 ?>
</ul>
</form>
