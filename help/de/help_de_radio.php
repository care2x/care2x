<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
?>
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
Radiologie - 
<?php

if($src=="search")
{
	print "Suchen nach einem Patient";	
/*	switch($x1)
	{
	case "search": print "Selecting a particular document";
						break;
	case "": 
						break;
	case "get": print  "Patient's operation's log document";
						break;
	case "fresh": print "Search for a operation's log document";
	}
*/}

 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >


<?php if($src=="search") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie finde ich einen Patient?</b>
</font>
	
	<ul>       	
 	<b>Schritt 1: </b>Gibt entweder eine vollständige Information oder die erste Zeichen von der Fallnummer vom Patient, von seinem Namen, oder von seinem Vornamen, oder
	von seinem Geburtstdatum in das entsprechende Eingabefeld ein. <br>
 	<b>Schritt 2: </b>Klickt den <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> Knopf an um die Suche zu starten.<p> 
<ul>       	
 	<b>Achtung! </b>Wenn die Suche ein Ergebnis bzw. mehrere Ergebnisse liefert wird eine Liste gezeigt. <p>
	</ul>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie kann ich die Vorschau des Röntgenbildes und den Befund zeigen lassen?</b>
</font>
	
	<ul>       	
 	<b>Schritt 1: </b>Klick den "<span style="background-color:yellow" > <font color="#0000cc">Vorschau/Befund</font> <input type="radio" name="d" value="a"> </span>" Radiobutton an.<br>
	Die Vorschau des Röntgenbildes wird in den unteren linken Rahmen eingeblendet.<br> 
	Der Befund wird in den unteren rechten Rahmen gezeigt.<br> 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie kann ich das Röntgenbild in voller Große zeigen lassen?</b>
</font>
	<ul>       	
 	<b>Schritt 1: </b>Klickt das Symbol  <img <?php echo createComIcon('../','torso.gif','0') ?>> an.<br>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Achtung!</b></font> 
<ul>       	
 Wenn Sie abbrechen möchten klickt den <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> Knopf an.
</ul>
<?php endif;?>

</form>

