<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
Stationsverwaltung 
<?php
switch($src)
{
	case "main": print "";
						break;
	case "new": print  " - Eine neue Station anlegen";
						break;
	case "": print  " - Stationsprofil";
						break;
	case "show": print  " - Stationsprofil";
						break;
}
 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<?php if($src=="main") : ?>

<b>Erschaffen</b>

<ul>Um eine neue Station zu erschaffen klicken Sie diese Option an. 
	</ul>	
</ul>
<b>Stationsprofil</b>
<ul>Diese Option zeigt die Stationsprofil and andere relevante Information.
</ul>
<b>Bett sperren</b>
<ul>Um ein Bett bzw. mehrere Betten zu sperren klicken Sie diese Option an. Die angemeldete Station wird gezeigt. Wenn keine Station
angemeldet ist wird die standard Station gezeigt. Sperren von Betten erfordert ein gultiges Passwort und ein Zugangsrecht für diese Funktion.
</ul>
<b>Zugangsberechtigungen</b>
<ul> Mit dieser Option können Sie Zugangsberechtigungen für eine bestimmte Station erstellen, sperren, ändern, löschen, oder freigeben. Die erstellte
Zugangsberechtigung sind  nur innerhalb der Station berechtigt.
</ul>
<?php endif;?>

<?php if($src=="new") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie kann ich eine neue Station anlegen?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Geben Sie den Namen der Station oder deren Abkürzung in das Feld "<span style="background-color:yellow" > Station: </span>" ein.<br>
 	<b>Schritt 2: </b>Wahlen Sie die Abteilung wo die Station angehört aus dem Feld "<span style="background-color:yellow" > Abteilung: </span>" aus.<br>
 	<b>Schritt 3: </b>Schreiben Sie die Beschreibun von der Station und andere relevante Information in das Feld  "<span style="background-color:yellow" > Beschreibung: </span>" ein.<br>
 	<b>Schritt 4: </b>Geben Sie die nummer des ersten Zimmers in das Feld "<span style="background-color:yellow" > Nummer des ersten Zimmers: </span>" ein.<br>
 	<b>Schritt 5: </b>Geben Sie die nummer des letzten Zimmers in das Feld "<span style="background-color:yellow" > Nummer des letzten Zimmers: </span>" ein.<br>
 	<b>Schritt 6: </b>Geben Sie das Vorzeichen der Zimmernummer Feld "<span style="background-color:yellow" > Vorzeichen der Zimmernummer: </span>" ein.<br>
 	<b>Schritt 7: </b>Klickt den <input type="button" value="Station erschaffen"> Knopf an um die Station anzulegen.<br>
	</ul>
<b>Achtung!</b>
<ul>  Falls Sie abbrechen möchten den <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> anklicken.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Kann ich die Anzahl der Betten in einem Zimmer einstellen?</b>
</font>
<ul>
 	<b>Ja. </b>Aber Sie werden die Gelegenheit haben die Bettenanzahl einzugeben erst wenn Sie die Station angelegt haben.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Kann ich die Bettenmarkierung einstellen?</b>
</font>
<ul>       	
 	<b>Nein. </b>In dieser Version des Programms, die Bettenmarkierung  ist auf A, B, C, usw. eingestellt. Sie können sie nicht ändern.<br>
	</ul>
<b>Achtung!</b>
<ul>Falls Sie abbrechen möchten den <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> anklicken.
</ul>
<?php endif;?>
	
<?php if($src=="show") : ?>
	<?php if($x1=="1") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie kann ich das Stationsprofil speichern?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt den <input type="button" value="Speichern"> Knopf an.<br>
	</ul>
<b>Achtung!</b>
<ul> Falls Sie abbrechen möchten den <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> anklicken.
</ul>

	<?php else : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie bearbeite ich das Stationsprofil?</b>
</font><p>
<b>Achtung!</b> Sie können ein Stationsprofil nicht nachträglich bearbeiten. Wenn Sie eine neue Stationsprofil
anlegen müssen, müssen sie die alte Station unwideruflich schliessen. Folgen Sie:
<ul>
	<b>Schritt 1: </b>Vergewissern Sie sich dass die Station leer ist (die Patienten sind entweder alle entlassen oder
	verlegt worden).<p>
 	<b>Schritt 2: </b>Klickt den <input type="button" value="Station unwideruflich schliessen"> Knopf an.<p>
	<b>Schritt 3: </b>Legen Sie eine neue Station an. Wählen Sie die Option "Neue Station anlegen" am Stationsverwaltungsmodul.<p>
	</ul>
<b>Achtung!</b>
<ul>  Falls Sie abbrechen möchten den <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> anklicken.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wozu schliesst man eine Station vorübergehend?</b>
</font><p>

<ul>
	<b>Antwort: </b>Eine Station wird vorübergehend geschlossen wenn keine Patienten aufgenommen werden kann aus bestimmten Gründen wie
	z.B. Renovierung, Reparaturarbeiten, Dekontamination, Desinfektion, usw.

	</ul>
<?php endif;?>
<?php endif;?>


<?php if($src=="") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie wähle ich eine Station zum Anzeigen aus?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klicken Sie die Station in der Liste an dessen Profil Sie anzeigen möchten.<br>
	</ul>
<b>Achtung!</b>
<ul> Wenn Sie abbrechen wollen, click den <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> an.
</ul>

<?php endif;?>


</form>

