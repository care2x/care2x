<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
Fotolabor - 
<?php
	switch($src)
	{
	case "init": print "Initialisieren";
												break;
	case "input": print "Auswahl von Fotos zum speichern";
												break;
	case "maindata": print "Patientendaten";
												break;
	case "save": print "Fotos sind gespeichert";
												break;

	}


 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<?php if($src=="input") : ?>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Die Eingabefelder sind jetzt eingeblendet. Was mache ich jetzt?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt den <input type="button" value="Durchsuchen..."> Knopf an um das Foto zu suchen.<br>
 	<b>Schritt 2: </b>Ein "Datei auswählen" Fenster öffnet sich. Wähle die gewünschte Bilddatei aus und klicke "Öffnen" an.<br>
 	<b>Schritt 3: </b>Wenn die Bilddatei ein gultiges Format hat wird eine Vorschau des Bildes auf dem Vorschaurahmen eingeblendet. Falls nicht, wiederhole die Schritte 1 und 2.<br>
 	<b>Schritt 4: </b>Gibt das Aufnahmedatum des Fotos in das Feld "<span style="background-color:yellow" > Aufnahmedatum </span>" ein.<p>
 	<img src="../img/warn.gif" border=0> <b>Achtung: </b>Dieses Datum könnte eventuell mit dem Datum das Sie in die Eingabefelder am Patientendaten eingeben überschrieben werden. <p>
	Tipp: Wenn Sie möchten das dieses Datum anders ist als das Aufnahmedatum der meisten Bilder, lassen Sie dieses Feld vorerst mal leer. Sie können nachträglich das Datum eingeben.<p>
 	<b>Schritt 5: </b>Gibt die Aufnahmenummer in das Feld "<span style="background-color:yellow" > Nummer </span>" ein.<p>
 	<img src="../img/warn.gif" border=0> <b>Achtung: </b>Wenn dieses Foto das Hauptfoto vom Patienten ist, geben Sie "main" in das Feld ein. Das "Hauptfoto" wird immer automatisch
	auf der Patientenmappe und anderen Dokumenten angezeigt.<p>
 	<font color="#990000">Was mache ich als nächstes?</font><p>
	<b>Schritt 6: </b>Suche die Patientendaten. Gibt die Fallnummer in das Feld "<span style="background-color:yellow" > Fallnummer </span>" ein.<br>
 	<b>Schritt 7: </b>Klickt den <input type="button" value="Suchen"> Knopf an um den Patient zu suchen.<br>
 	<b>Schritt 8: </b>Wenn die Suche den Patient findet werden die Patientendaten in die entsprechende Eingabefelder eingegeben.<br>
 	<b>Schritt 9: </b>Wenn alle oder die meiste Bilder am selben Datum aufgenommen wurden gibt dieses Datum in das Feld <nobr>"<span style="background-color:yellow" > Aufnahmedatum </span>"</nobr> ein.<br>
 	<b>Schritt 10: </b>Klickt den <img src="../img/preset-add.gif" border=0 align="absmiddle"> Knopf an um dieses Datum für alle Bilder zu übernehmen. Dieses
	Datum wird automatisch in allen "Aufnahmedatum" Felder von den Bildern eingeblendet.<p>
 	<img src="../img/warn.gif" border=0><b> Note: </b>Wenn ein oder einige Bildern ein anderes Aufnahmedatum haben soll, gibt dieses Datum in das entsprechende Eingabefeld ein. 
	Dies ist nur sinnvoll wenn Sie den Schritt 10 schon gemacht haben.<p>
 	<b>Schritt 11: </b>Klickt den <input type="button" value="Speichern"> Knopf an um die Bilder in die Datenbank zu speichern.<br>
</ul>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie sehe die Vorschau eines Bildes?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt den <img src="../img/lilcamera.gif" border=0> Knopf des Bildes an.<br>
</ul>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ich kann den Patient nicht finden. Kann ich einfach seine Daten in die Eingabefelder manuell eingeben?</b>
</font>
<ul>       	
 	<b>Nein. </b>Mit dieser Version des Programs können Sie die Fotos eines Patienten ohne Fallnummer nicht speichern.<br>
</ul>
<?php endif; ?>	

<?php if($src=="maindata") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie finde ich die Patientendaten?</b>
</font>
<ul>	
	<b>Schritt 1: </b>Gibt die Fallnummer in das Feld "<span style="background-color:yellow" > Fallnummer </span>" ein.<br>
 	<b>Schritt 2: </b>Klickt den <input type="button" value="Suchen"> Knopf an um den Patient zu suchen.<br>
 	<b>Schritt 3: </b>Wenn die Suche den Patient findet werden die Patientendaten in die entsprechende Eingabefelder eingegeben.<br>
 	<b>Schritt 4: </b>Wenn alle oder die meiste Bilder am selben Datum aufgenommen wurden gibt dieses Datum in das Feld <nobr>"<span style="background-color:yellow" > Aufnahmedatum </span>"</nobr> ein.<br>
 	<b>Schritt 5: </b>Klickt den <img src="../img/preset-add.gif" border=0 align="absmiddle"> Knopf an um dieses Datum für alle Bilder zu übernehmen. Dieses
	Datum wird automatisch in allen "Aufnahmedatum" Felder von den Bildern eingeblendet.<p>
 	<img src="../img/warn.gif" border=0><b> Note: </b>Wenn ein oder einige Bildern ein anderes Aufnahmedatum haben soll, gibt dieses Datum in das entsprechende Eingabefeld ein. 
	Dies ist nur sinnvoll wenn Sie den Schritt 5 schon gemacht haben.<p>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ich kann den Patient nicht finden. Kann ich einfach seine Daten in die Eingabefelder manuell eingeben?</b>
</font>
<ul>       	
 	<b>Nein. </b>Mit dieser Version des Programs können Sie die Fotos eines Patienten ohne Fallnummer nicht speichern.<br>
</ul>

	<?php endif; ?>	
<?php if($src=="save") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie kann ich weitere Fotos von dem selben Patient speichern?</b>
</font>
<ul>	
	<b>Schritt 1: </b>Gibt die Stückzahl  in das Feld <nobr>"<span style="background-color:yellow" > Weitere <input type="text" name="g" size=3 maxlength=2> Bilder  von demselben Patient. </span>"</nobr> ein.<br>
 	<b>Schritt 2: </b>Klickt den <input type="button" value="GO"> Knopf an.<br>
</ul>

	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie kann ich Fotos von einem anderen Patient speichern?</b>
</font>
<ul>	
	<b>Schritt 1: </b>Gibt die Stückzahl  in das Feld <nobr>"<span style="background-color:yellow" >  <input type="text" name="g" size=3 maxlength=2> Bilder vom anderen Patient. </span>"</nobr> ein.<br>
 	<b>Schritt 2: </b>Klickt den <input type="button" value="GO"> Knopf an.<br>
</ul>

	<?php endif; ?>	
	
<?php if($src=="init") : ?>
	<?php if($x1=="") : ?>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie speichere ich Fotos in die Datenbank?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Gibt die Anzahl der Fotos ein die Sie in die Datenbank speichern.<br>
 	<b>Schritt 2: </b>Klickt den <input type="button" value="OK Weiter..."> Knopf an.<br>
 	<b>Schritt 3: </b>Die Eingabefelder für die Fotos werden eingeblendet. Klick die "Hilfe" Knopf um weitere Hilfsanweisung zu lesen.<br>
</ul>
	<?php endif; ?>	
	
<?php endif;?>	

	</form>

