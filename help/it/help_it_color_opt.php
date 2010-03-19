<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
Color options 
<?php
	switch($src)
	{
	case "ext": print " - Extended";
						break;
	 }
?>
</b></font>
<p><font size=2 face="verdana,arial" >
<form action="#" >
<?php if($src=="") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come scegliere il colore di sfondo?</b>
</font>
<ul>       	
 	<b>1: </b>Selezionare il link "<span style="background-color:yellow" > Colore di sfondo <img src="../img/settings_tree.gif" border=0> </span>" nella zona desiderata.<br>
 	<b>2: </b>Apparirà una finestrella che mostra i colori che è possibile scegliere.<br>
 	<b>3: </b>Selezionare sul colore che si vuole per lo sfondo.<br>
 	<b>4: </b>Selezionare sul bottone <input type="button" value="Applica"> per confermare.<br>
 	<b>5: </b>Al termine, premere il bottone <input type="button" value="OK">.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come scegliere il colore del testo?</b>
</font>
<ul>       	
 	<b>1: </b>Selezionare o il link "<span style="background-color:yellow" > Coore del testo </span>" nella zona in alto oppure il link
	"<span style="background-color:yellow" > Voci del menu </span>" nell'area menu.<br>
 	<b>2: </b>Apparirà una finestrella che mostra i colori che è possibile scegliere.<br>
 	<b>3: </b>Selezionare sul colore che si vuole per il testo.<br>
 	<b>4: </b>Selezionare sul bottone <input type="button" value="Applica"> per confermare.<br>
 	<b>5: </b>Al termine, premere il bottone <input type="button" value="OK">.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come scegliere i colori dei link?</b>
</font>
<ul>       	
 	<b>5: </b>Selezionare il bottone <input type="button" value="Opzioni estese colore"> per passare alla selezione estesa dei colori.<br>
</ul>
<?php endif;?>

<?php if($src=="ext") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come scegliere il colore dei link attivi?</b>
</font>
<ul>       	
 	<b>1: </b>Selezionare o il link "<span style="background-color:yellow" > Link attivi </span>" nella zona in alto oppure il link
	"<span style="background-color:yellow" > Link attivi </span>" nell'area menu.<br>
 	<b>2: </b>Apparirà una finestrella che mostra i colori che è possibile scegliere.<br>
 	<b>3: </b>Selezionare sul colore che si vuole per il link attivo.<br>
 	<b>4: </b>Selezionare sul bottone <input type="button" value="Applica"> per confermare.<br>
 	<b>5: </b>Al termine, premere il bottone <input type="button" value="OK">.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come scegliere il colore dei link puntati dal mouse?</b>
</font>
<ul>       	
 	<b>1: </b>Selezionare o il link "<span style="background-color:yellow" > Link selezionati </span>" nella zona in alto oppure il link
	"<span style="background-color:yellow" > Link selezionati </span>" nell'area menu.<br>
 	<b>2: </b>Apparirà una finestrella che mostra i colori che è possibile scegliere.<br>
 	<b>3: </b>Selezionare sul colore che si vuole per i link selezionati.<br>
 	<b>4: </b>Selezionare sul bottone <input type="button" value="Applica"> per confermare.<br>
 	<b>5: </b>Al termine, premere il bottone <input type="button" value="OK">.<br>
</ul>
<?php endif;?>
</form>
