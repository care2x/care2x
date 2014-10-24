<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Come
<?php
switch($src)
{
 	case "search": print 'cercare un numero di telefono'; break;
	case "dir": print 'aprire tutto ´elenco';break;
	case "newphone": print 'inserire un nuovo numero';break;
 }
 ?></b></font>
<p><font size=2 face="verdana,arial" >
<form action="#" >
<?php if($src=="search") : ?>
<b>1:</b>
<ul> Inserire nel campo "<span style="background-color:yellow" >Chiave di ricerca.</span>" il dato che si sta cercando o qualche lettera, per esempio il nome o dipartimento del medico di guardia, un nome, un cognome
		o un numero di camera.
		<br>Esempio 1: "m9a" o "M9A" or "M9".
		<br>Esempio 2: "Rossi" o "Ros".
		<br>Esempio 3: "Alfredo" o "Alf".
		<br>Esempio 4: "op11" o "OP11" or "op".
</ul>
<b>2:</b>
<ul> Selezionare il bottone <input type="button" value="SEARCH"> per iniziare la ricerca.<p>
</ul>
<b>3:</b>
<ul> Se la ricerca da esito positivo, i risultati appariranno in un elenco.<p>
</ul>
<?php endif;?>
<?php if($src=="dir") : ?>
<ul> Selezionare il bottone <img <?php echo createLDImgSrc('../','phonedir-gray.gif','0') ?>>.
</ul>
<?php endif;?>
<?php if($src=="newphone") : ?>
<b>1:</b>
<ul> Selezionare il bottone <img <?php echo createLDImgSrc('../','newdata.gif','0') ?>>.
</ul>
<b>2:</b>
<ul> Se si è fatto login precedentemente e si hanno i diritti di accesso sufficienti, apparirà un
		modulo in cui inserire il nuovo telefono.<br>
		Se invece non si è ancora effettuato il login, verrà richiesto di inserire username e password. <p>
		Inserire i propri dati e premere il bottone <img <?php echo createLDImgSrc('../','continue.gif','0') ?>>.<p>
		Per annullare l'operazione, premere <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> border=0>.
</ul><?php endif;?>
<b>Nota</b>
<ul> Per annullare l'operazione di ricerca, premere <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> border=0>.
</ul>
</form>
