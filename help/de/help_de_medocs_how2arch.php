<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
?>
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Recherchieren im Medocs Archiv</b></font>
<form action="#" >
<p><font size=2 face="verdana,arial" >

<?php if($src=="select") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Wie kann ich die Daten aktualisieren bzw. ändern?</b></font>
<ul> <b>Schritt : </b>Den <input type="button" value="Daten aktualisieren"> anklicken.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Wie kann ich eine neue Suche im Archiv starten?</b></font>
<ul> <b>Schritt : </b>Den <input type="button" value="Neue Suche im Archiv"> anklicken.<br>
</ul>
<?php elseif(($src=="search")&&($x1)) : ?>
<b>Achtung!</b>
<ul><?php if($x1==1) : ?> Wenn die Suche ein einziges Ergebnis findet werden die Daten sofort gezeigt.<br>
		Wenn die Suche allerdings mehrere Ergebnisse liefert wird eine Liste gezeigt.<br>
		<?php endif;?>
		Um das Dokument zu sehen den nebenstehenden <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> , oder
		den Namen, oder den Vornamen, oder die Dokumentnummer oder das Bearbeitungsdatum anklicken.
</ul>
<b>Achtung!</b>
<ul>Falls Sie eine neue Recherche starten möchten den <input type="button" value="Neue Suche im Archiv"> anklicken.
</ul>
<?php else : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Alle Medocs Dokumente einer Abteilung zeigen</b></font>
<ul> <b>Schritt 1: </b>Geben Sie den Abteilungsnamen oder deren Abkürzung in das Feld "Abteilung" ein. <br>
		<b>Schritt 2: </b>Lassen Sie die andere Eingabefelder leer.<br>
		<b>Schritt 3: </b>Den <input type="button" value="SUCHEN">  anklicken um die Suche zu starten.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Dokument nach bestimmten Patientendaten suchen </b></font>
<ul> <b>Schritt 1: </b>Geben Sie das Suchwort in das Feld ein. Das Suchwort könnte ein vollständiges Wort oder dessen erste Buchstaben sein. <br>
		<ul><font size=1 color="#000099" >
		<b>Die folgende Eingabefelder könnte mit Suchwörtern ausgefüllt werden:</b>
		<br> Fallnummer (oder Patientennummer)
		<br> Name
		<br> Vorname
		<br> Geburtsdatum
		</font>
		</ul><b>Schritt 2: </b>Lassen Sie die andere Eingabefelder leer.<br>
		<b>Schritt 3: </b>Den <input type="button" value="SUCHEN">  anklicken um die Suche zu starten.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Alle Dokumente von Patienten mit bestimmter Krankenkasse zeigen</b></font>
<ul> <b>Schritt 1: </b>Geben Sie die Krankenkasse oder deren Abkürzung in das Feld "Krankenkasse" ein. <br>
		<b>Schritt 2: </b>Lassen Sie die andere Eingabefelder leer.<br>
		<b>Schritt 3: </b>Den <input type="button" value="SUCHEN">  anklicken um die Suche zu starten.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Alle Dokumente von Patienten mit bestimmten weiteren Angaben über die Krankenkasse zeigen</b></font>
<ul> <b>Schritt 1: </b>Geben Sie die Angaben in das Feld "weitere Angaben:" ein. <br>
		<b>Schritt 2: </b>Lassen Sie die andere Eingabefelder leer.<br>
		<b>Schritt 3: </b>Den <input type="button" value="SUCHEN">  anklicken um die Suche zu starten.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Alle Dokumente aller männlichen Patienten zeigen </b></font>
<ul> <b>Schritt 1: </b>Den radio button  "Geschlecht <input type="radio" name="r" value="1">männlich" anklicken. <br>
		<b>Schritt 2: </b>Lassen Sie die andere Eingabefelder leer.<br>
		<b>Schritt 3: </b>Den <input type="button" value="SUCHEN">  anklicken um die Suche zu starten.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Alle Dokumente aller  weiblichen Patienten zeigen </b></font>
<ul> <b>Schritt 1: </b>Den radio button  "<input type="radio" name="r" value="1">weiblich" anklicken. <br>
		<b>Schritt 2: </b>Lassen Sie die andere Eingabefelder leer.<br>
		<b>Schritt 3: </b>Den <input type="button" value="SUCHEN">  anklicken um die Suche zu starten.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Alle Dokumente aller Patienten mit Aufklärung zeigen </b></font>
<ul> <b>Schritt 1: </b>Den radio button  "Aufklärung <input type="radio" name="r" value="1">Ja" anklicken. <br>
		<b>Schritt 2: </b>Lassen Sie die andere Eingabefelder leer.<br>
		<b>Schritt 3: </b>Den <input type="button" value="SUCHEN">  anklicken um die Suche zu starten.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Alle Dokumente aller  Patienten OHNE Aufklärung zeigen </b></font>
<ul> <b>Schritt 1: </b>Den radio button  "<input type="radio" name="r" value="1">Nein" anklicken. <br>
		<b>Schritt 2: </b>Lassen Sie die andere Eingabefelder leer.<br>
		<b>Schritt 3: </b>Den <input type="button" value="SUCHEN">  anklicken um die Suche zu starten.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Patienten nach bestimmten Worten suchen</b></font>
<ul> <b>Schritt 1: </b>Geben Sie das Suchwort in das Feld ein. Das Suchwort könnte ein vollständiges Wort oder dessen erste Buchstaben sein. <br>
		<ul><font size=1 color="#000099" >
		<b>Beispiel:</b> Um nach Überweisungsdiagnose zu suchen geben Sie das Suchwort in das Feld "Überweisungsdiagnose" ein.<br>
		<b>Beispiel:</b>  Um nach Therapie zu suchen geben Sie das Suchwort in das Feld "Therapie" ein.<br>
		</font>
		</ul><b>Schritt 2: </b>Lassen Sie die andere Eingabefelder leer.<br>
		<b>Schritt 3: </b>Den <input type="button" value="SUCHEN">  anklicken um die Suche zu starten.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Alle Dokumente von einem bestimmten Datum zeigen.</b></font>
<ul> <b>Schritt 1: </b>Das Datum in das Feld "Bearbeitet am:" eingeben. <br>
		<ul><font size=1 color="#000099">
		<b>Tipp:</b> Geben Sie entweder "h" oder "H" in das Feld ein um das heutige Datum automatisch zeigen zu lassen.<br>
		<b>Tipp:</b> Geben Sie entweder "g" oder "G" in das Feld ein um das Datum  von gestern automatisch zeigen zu lassen.<br>
		</font>
		</ul><b>Schritt 2: </b>Lassen Sie die andere Eingabefelder leer.<br>
		<b>Schritt 3: </b>Den <input type="button" value="SUCHEN">  anklicken um die Suche zu starten.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Alle von einer bestimmten Person erstellte Dokumente zeigen.</b></font>
<ul> <b>Schritt 1: </b>Geben Sie den Namen oder dessen ersten Zeichen in das Feld "Bearbeitet von:" ein. <br>
		<b>Schritt 2: </b>Lassen Sie die andere Eingabefelder leer.<br>
		<b>Schritt 3: </b>Den <input type="button" value="SUCHEN">  anklicken um die Suche zu starten.<br>
</ul>

<b>Achtung!</b>
<ul> Sie können mehrere Suchwörter bzw. Bedingungen kombinieren. Zum Beispiel: Wenn Sie alle männliche Patienten  suchen die in der plastischen Chirurgie operiert wurden,
die Aufklärung erhalten haben, und deren Therapie ein Wort haben das mit "lipo" beginnt :<p>
		<b>Schritt 1: </b>Das Wort "plop" in das Feld   "Abteilung:" eingeben. <br>
		<b>Schritt 2: </b>Das radio button "<span style="background-color:yellow" >Geschlecht<input type="radio" name="r" value="1">männlich</span>" anklicken.<br>
		<b>Schritt 3: </b>Das radio button "<span style="background-color:yellow" >Aufklärung:<input type="radio" name="r" value="1">Ja</span>" anklicken.<br>
		<b>Schritt 4: </b>Das Wort  "lipo" in das Feld "Therapie:" eingeben. <br>
		<b>Schritt 5: </b>Den <input type="button" value="SUCHEN">  anklicken um die Suche zu starten.<br>
</ul>

<b>Achtung!</b>
<ul> Wenn die Suche ein einziges Ergebnis findet werden die Daten sofort gezeigt.<br>
		Wenn die Suche allerdings mehrere Ergebnisse liefert wird eine Liste gezeigt.<br>
		Um die Patientendaten zu sehen, das nebenstehende Symbol <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> , oder
		den Namen, oder den Vornamen, oder die Dokumentnummer, oder das Bearbeitungsdatum anklicken.
</ul>

<?php endif;?>
<b>Achtung!</b>
<ul> Falls Sie die Recherche abbrechen möchten, den  <img <?php echo createLDImgSrc('../','close2.gif','0') ?> > anklicken.
</ul>
</form>

