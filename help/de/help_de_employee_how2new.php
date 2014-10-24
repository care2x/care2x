<font face="Verdana, Arial" size=3 color="#0000cc"><b>Personalverwaltung</b></font><p>
<?php
if(!$src&&!$x1){
?>
<font size=2 face="verdana,arial" >
<b>Wie kann ich einen neuen Mitarbeiter anlegen?</b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<b>Schritt 1</b>

<ul>
<font color=#ff0000>Sehen Sie erst nach, ob bereits Personen-Stammdaten zu diesem Mitarbeiter existieren.</font>.<p>
	Machen Sie dazu entweder eine genaue Angabe oder geben Sie die ersten paar Buchstaben eines Feldes ein wie z.B.
	Vor- oder Nachname, oder auch die PID (Personen-Identifikationsnummer).
		<p>Beispiel 1: Geben Sie "21000012" oder "12" ein.
		<br>Beispiel 2: Geben Sie "Recklinghausen" oder "rec" ein.
		<br>Beispiel 3: Geben Sie "Alfredo" oder "Alf" ein.

</ul>

<b>Schritt 2</b>
<ul> Klicken Sie auf den <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>-Button um die Suche zu starten.
</ul>

<b>Schritt 3</b>
<ul>Wenn die Suche ohne Ergebnis ist, müssen Sie erst die Person anlegen (registrieren). Klicken Sie auf den
    <img <?php echo createLDImgSrc('../','register_gray.gif','0') ?>>-Button und folgen Sie der Anleitung
	zur Regitstrierung der Person.
</ul>
<b>Schritt 4</b>
<ul>Wenn die Suche erfolgreich ist, wählen Sie die richtige Person aus der angezeigten Liste  durch Klick auf
den <img <?php echo createLDImgSrc('../','ok_small.gif','0') ?>>-Button daneben.
</ul>
<b>Schritt 5</b>
<ul>Wenn das Mitarbeiter-Formular angzeigt wird, geben Sie alle relevanten Daten zum Mitarbeiter an.<p>
		<img <?php echo createComIcon('../','warn.gif','0') ?>> Achtung: Wenn die Person zum aktuellen Zeitpunkt
		als Mitarbeiter/in beschäftigt wird, werden ihre Mitarbeiterdaten angezeigt.
</ul>
<b>Schritt 6</b>
<ul>
	 Klicken Sie auf den <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>>-Button um die eingegebenen
	 Informationen zu speichern.<p>
</ul>

<b>Anmerkung</b>

<ul>Fehlen notwendige Angaben, wird Ihnen das Formular erneut zur Bearbeitung vorgelegt mit einem Hinweis, das oder die
rot markierte/n Feld/er vollständig auszufüllen. Klicken Sie danach auf den Knopf <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>>
zum Abspeichern der eingegebenen Informationen.<p>
</ul>

<b>Anmerkung</b>
<ul>Wenn Sie die Verarbeitung abbrechen möchten, klicken Sie auf den Button <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.

</ul>
</form>
<?php
}else{
?>

<font size=2 face="verdana,arial" >
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<?php
	if($src){
?>
<font color="#990000"><b>Wie ändere ich die Daten eines Mitarbeiters?</b></font>
<ul>
	<b>Schritt 1:</b> Geben Sie einfach die neuen Daten in die entsprechenden Felder ein.<p>
	<b>Schritt 2:</b> Klicken Sie auf den <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>>-Button, um die
	geänderten Informationen zu speichern.<p>
	<img <?php echo createComIcon('../','warn.gif','0') ?>> Anmerkung: Wenn Sie die Änderung abbrechen möchten,
	klicken Sie auf den <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>-Button.
</ul>
<?php
	}else{
?>
<font color="#990000"><b>Wie kann ich aus einer Person einen Mitarbeiter machen?</b></font>
<ul>
	<b>Schritt 1:</b> Füllen Sie einfach die entsprechenden Felder aus.<p>
	<b>Schritt 2:</b> Klicken Sie auf den <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>>-Button zum Speichern
	der Mitarbeiter-Daten.<p>
	<img <?php echo createComIcon('../','warn.gif','0') ?>> Anmerkung: Wenn Sie die Bearbeitung abbrechen möchten,
	klicken Sie auf den <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>-Button.
</ul>
<?php
	}
}
?>
