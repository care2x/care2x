<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
Farbenoptionen
<?php
	switch($src)
	{
	case "ext": print " - Erweitert";
						break;
	 }
?>
</b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<?php if($src=="") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie stelle ich die Hintergrundfarbe ein?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt die Option "<span style="background-color:yellow" > Hintergrundfarbe <img src="../img/settings_tree.gif" border=0> </span>" des gewählten Rahmens an.<br>
 	<b>Schritt 2: </b>Ein Fenster mit Farbpalette öffnet sich.<br>
 	<b>Schritt 3: </b>Klict die gewünschte Farbe für den Hintergrund an.<br>
 	<b>Schritt 4: </b>Klickt den <input type="button" value="Übernehmen"> Knopf an um die Farbe zu übernehmen.<br>
 	<b>Schritt 5: </b>Wenn Sie fertig sind klickt den <input type="button" value="OK"> Knopf an.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie stelle ich die Textfarbe ein?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt entweder die Option "<span style="background-color:yellow" > Textfarbe </span>" des oberen Rahmens oder die Option
	"<span style="background-color:yellow" > Menuauswahl </span>" des Menu Rahmens an.<br>
 	<b>Schritt 2: </b>Ein Fenster mit Farbpalette öffnet sich.<br>
 	<b>Schritt 3: </b>Klict die gewünschte Farbe für den Text an.<br>
 	<b>Schritt 4: </b>Klickt den <input type="button" value="Übernehmen"> Knopf an um die Farbe zu übernehmen.<br>
 	<b>Schritt 5: </b>Wenn Sie fertig sind klickt den <input type="button" value="OK"> Knopf an.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie stelle ich die Farben für "hover" und "link" ein?</b>
</font>
<ul>       	
 	<b>Schritt 5: </b>Klickt den <input type="button" value="Erweiterte Farbenoptionen"> Knopf an um den erweiterten Modus zu starten.<br>
</ul>
<?php endif; ?>

<?php if($src=="ext") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie stelle ich die Farbe für "active link" ein?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt entweder die Option "<span style="background-color:yellow" > Active link </span>" des Menu Rahmens oder die Option
	"<span style="background-color:yellow" > Hauptfensterrahmen active link </span>" des Hauptfensterrahmens an.<br>
 	<b>Schritt 2: </b>Ein Fenster mit Farbpalette öffnet sich.<br>
 	<b>Schritt 3: </b>Klict die gewünschte Farbe für den Text an.<br>
 	<b>Schritt 4: </b>Klickt den <input type="button" value="Übernehmen"> Knopf an um die Farbe zu übernehmen.<br>
 	<b>Schritt 5: </b>Wenn Sie fertig sind klickt den <input type="button" value="OK"> Knopf an.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie stelle ich die Farbe für "hover" ein?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt entweder die Option "<span style="background-color:yellow" > Hover link </span>" des Menu Rahmens oder die Option
	"<span style="background-color:yellow" > Hauptfensterrahmen hover link </span>" des Hauptfensterrahmens an.<br>
 	<b>Schritt 2: </b>Ein Fenster mit Farbpalette öffnet sich.<br>
 	<b>Schritt 3: </b>Klict die gewünschte Farbe für den Text an.<br>
 	<b>Schritt 4: </b>Klickt den <input type="button" value="Übernehmen"> Knopf an um die Farbe zu übernehmen.<br>
 	<b>Schritt 5: </b>Wenn Sie fertig sind klickt den <input type="button" value="OK"> Knopf an.<br>
</ul>

<?php endif;?>
	</form>

