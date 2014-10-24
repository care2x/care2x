<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Recherchieren im Archiv</b></font>
<form action="#" >
<p><font size=2 face="verdana,arial" >

<?php if($src=="select") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Wie kann ich die Daten aktualisieren bzw. ändern?</b></font>
<ul> <b>Schritt : </b>Den <input type="button" value="Daten aktualisieren"> anklicken.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Wie kann ich eine neue Suche im Archiv starten?</b></font>
<ul> <b>Schritt : </b>Den <input type="button" value="Neue Suche im Archiv"> anklicken.<br>
</ul>
<?php elseif($src=="search") : ?>
<b>Achtung!</b>
<ul> Wenn die Suche ein einziges Ergebnis findet werden die Daten sofort gezeigt.<br>
		Wenn die Suche allerdings mehrere Ergebnisse liefert wird eine Liste gezeigt.<br>
		Um die Patientendaten zu sehen den nebenstehenden <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> , oder
		den Namen, oder den Familiennamen, oder das Aufnahmedatum anklicken.
</ul>
<b>Achtung!</b>
<ul> Falls Sie eine neue Recherche starten möchten, den <input type="button" value="Neue Suche im Archiv"> anklicken.
</ul>
<?php else : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Alle Aufnahmen heute anzeigen</b></font>
<ul> <b>Schritt 1: </b>Das heutige Datum in das Feld "Aufnahmedatum ab:" eingeben. <br>
		<ul><font size=1 color="#000099">
		<b>Tipp:</b> Geben Sie entweder "h" oder "H" in das Feld ein um das heutige Datum automatisch zeigen zu lassen.<br>
		</font>
		</ul><b>Schritt 2: </b>Lassen Sie das Feld "bis:" leer.<br>
		<b>Schritt 3: </b>Den <input type="button" value="SUCHEN">  anklicken um die Suche zu starten.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Alle Aufnahmen zwischen zwei Datum inklusiv zeigen.</b></font>
<ul> <b>Schritt 1: </b>Das Anfangsdatum in das Feld "Aufnahmedatum ab:" eingeben. <br>
		<ul><font size=1 color="#000099">
		<b>Tipp:</b> Geben Sie entweder "h" oder "H" in das Feld ein um das heutige Datum automatisch zeigen zu lassen.<br>
		<b>Tipp:</b> Geben Sie entweder "g" oder "G" in das Feld ein um das Datum  von gestern automatisch zeigen zu lassen.<br>
		</font>
		</ul><b>Schritt 2: </b>Das Enddatum in das Feld "bis:" eingeben. <br>
		<b>Schritt 3: </b>Den <input type="button" value="SUCHEN">  anklicken um die Suche zu starten.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Alle männliche Patienten zeigen </b></font>
<ul> <b>Schritt 1: </b>Den radio button  "Geschlecht <input type="radio" name="r" value="1">männlich" anklicken. <br>
		<b>Schritt 2: </b>Lassen Sie die andere Eingabefelder leer.<br>
		<b>Schritt 3: </b>Den <input type="button" value="SUCHEN">  anklicken um die Suche zu starten.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Alle weibliche Patienten zeigen </b></font>
<ul> <b>Schritt 1: </b>Den radio button  "<input type="radio" name="r" value="1">weiblich" anklicken. <br>
		<b>Schritt 2: </b>Lassen Sie die andere Eingabefelder leer.<br>
		<b>Schritt 3: </b>Den <input type="button" value="SUCHEN">  anklicken um die Suche zu starten.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Alle ambulante Patienten zeigen</b></font>
<ul> <b>Schritt 1: </b>Den radio button  "<input type="radio" name="r" value="1">Ambulant" anklicken. <br>
		<b>Schritt 2: </b>Lassen Sie die andere Eingabefelder leer.<br>
		<b>Schritt 3: </b>Den <input type="button" value="SUCHEN">  anklicken um die Suche zu starten.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Alle stationäre Patienten zeigen</b></font>
<ul> <b>Schritt 1: </b>Den radio button  "<input type="radio" name="r" value="1">Stationär" anklicken. <br>
		<b>Schritt 2: </b>Lassen Sie die andere Eingabefelder leer.<br>
		<b>Schritt 3: </b>Den <input type="button" value="SUCHEN">  anklicken um die Suche zu starten.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Alle selbtszahlende Patienten zeigen</b></font>
<ul> <b>Schritt 1: </b>Den radio button  "<input type="radio" name="r" value="1">Selbstzahler" anklicken. <br>
		<b>Schritt 2: </b>Lassen Sie die andere Eingabefelder leer.<br>
		<b>Schritt 3: </b>Den <input type="button" value="SUCHEN">  anklicken um die Suche zu starten.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Alle privat versicherte Patienten zeigen</b></font>
<ul> <b>Schritt 1: </b>Den radio button  "<input type="radio" name="r" value="1">Privat" anklicken. <br>
		<b>Schritt 2: </b>Lassen Sie die andere Eingabefelder leer.<br>
		<b>Schritt 3: </b>Den <input type="button" value="SUCHEN">  anklicken um die Suche zu starten.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Alle allgemein versicherte Patienten zeigen</b></font>
<ul> <b>Schritt 1: </b>Den radio button  "<input type="radio" name="r" value="1">Krankenkasse" anklicken. <br>
		<b>Schritt 2: </b>Lassen Sie die andere Eingabefelder leer.<br>
		<b>Schritt 3: </b>Den <input type="button" value="SUCHEN">  anklicken um die Suche zu starten.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Patienten mit bestimmter Krankenkasse anzeigen</b></font>
<ul> <b>Schritt 1: </b>Geben Sie die Krankenkasse oder deren Abkürzung in das Feld "Krankenkasse" ein. <br>
		<b>Schritt 2: </b>Lassen Sie die andere Eingabefelder leer.<br>
		<b>Schritt 3: </b>Den <input type="button" value="SUCHEN">  anklicken um die Suche zu starten.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Patienten nach bestimmten Worten suchen</b></font>
<ul> <b>Schritt 1: </b>Geben Sie das Suchwort in das Feld ein. Das Suchwort könnte ein vollständiges Wort oder dessen erste Buchstaben sein. <br>
		<ul><font size=1 color="#000099" >
		<b>Beispiel:</b> Um nach Diagnose zu suchen geben Sie das Suchwort in das Feld "Diagnose" ein.<br>
		<b>Beispiel:</b> Um nach Überweiser zu suchen geben Sie das Suchwort in das Feld "Uberwiesen von" ein.<br>
		<b>Beispiel:</b>  Um nach Therapie zu suchen geben Sie das Suchwort in das Feld "Therapie" ein.<br>
		<b>Beispiel:</b>  Um nach Besonderheiten zu suchen geben Sie das Suchwort in das Feld "Besonderheiten" ein.<br>
		</font>
		</ul><b>Schritt 2: </b>Lassen Sie die andere Eingabefelder leer.<br>
		<b>Schritt 3: </b>Den <input type="button" value="SUCHEN">  anklicken um die Suche zu starten.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Patient nach bestimmten Patientendaten suchen </b></font>
<ul> <b>Schritt 1: </b>Geben Sie das Suchwort in das Feld ein. Das Suchwort könnte ein vollständiges Wort oder dessen erste Buchstaben sein. <br>
		<ul><font size=1 color="#000099" >
		<b>Die folgende Eingabefelder könnte mit Suchwörtern ausgefüllt werden:</b>
		<br> Fallnummer (oder Patientennummer)
		<br> Name
		<br> Vorname
		<br> Geburtsdatum
		<br> Adresse
		</font>
		</ul><b>Schritt 2: </b>Lassen Sie die andere Eingabefelder leer.<br>
		<b>Schritt 3: </b>Den <input type="button" value="SUCHEN">  anklicken um die Suche zu starten.<br>
</ul>
<b>Achtung!</b>
<ul> Sie können mehrere Suchwörter bzw. Bedingungen kombinieren. Zum Beispiel: Wenn Sie alle männliche Patienten  suchen die zwischen 10.12.1999 und
24.01.2001 aufgenommen worden sind:<p>
		<b>Schritt 1: </b>Das Datum  "10.12.1999" in das Feld "Aufnahmedatum ab:" eingeben. <br>
		<b>Schritt 2: </b>Das Datum  "24.01.2001" in das Feld "bis:" eingeben. <br>
		<b>Schritt 3: </b>Den radio button  "Geschlecht <input type="radio" name="r" value="1">männlich" anklicken. <br>
		<b>Schritt 4: </b>Den <input type="button" value="SUCHEN">  anklicken um die Suche zu starten.<br>
</ul>
<b>Achtung!</b>
<ul> Wenn die Suche ein einziges Ergebnis findet werden die Daten sofort gezeigt.<br>
		Wenn die Suche allerdings mehrere Ergebnisse liefert wird eine Liste gezeigt.<br>
		Um die Patientendaten zu sehen, das nebenstehende Symbol <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> , oder
		den Namen, oder den Familiennamen, oder das Aufnahmedatum anklicken.
</ul>

<?php endif;?>
<b>Achtung!</b>
<ul> Falls Sie die Recherche abbrechen möchten, den <input type="button" value="Abbrechen"> anklicken.
</ul>
</form>

