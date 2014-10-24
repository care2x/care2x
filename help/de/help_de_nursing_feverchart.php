<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
?>
<a name="howto">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Kurve</b></font>
<form action="#" >
<p><font size=2 face="verdana,arial" >

<?php if($src=="main") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie kann ich...?</b></font>
<ul type="disc"> 
		<li><a href="#cbp">Temperatur und Blutdruck eingeben?</a>
		<li><a href="#movedate">das Datum der Kurve ändern bzw. verschieben?</a>
		<li><a href="#diet">einen Kostplan eingeben?</a>
		<li><a href="#allergy">eine Information über Allergie eingeben?</a>
		<li><a href="#diag">die Hauptdiagnose bzw. Therapie eingeben?</a>
		<li><a href="#daydiag">Information über tägliche Diagnose oder Therapieplan eingeben?</a>
		<li><a href="#extra">Besonderheiten, oder Nebendiagnose eingeben?</a>
		<li><a href="#pt">tägliche Information über KG, ATG, usw. eingeben?</a>
		<li><a href="#coag">Antikoagulant(ien) eingeben?</a>
		<li><a href="#daycoag">tägliche Information über die Antikoagulant(ien) eingeben?</a>
		<li><a href="#lot">Angaben eingeben?</a>
		<li><a href="#med">Medikamente und deren Dosierung eingeben?</a>
		<li><a href="#daymed">tägliche Information über Medikamente und deren Dosierung eingeben?</a>
		<li><a href="#iv">tägliche Information über i.v. Medikamente und deren Dosierung eingeben?</a>
</ul>		
<hr>
<a name="cbp"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Wie kann ich Temperatur und Blutdruck eingeben?</b></font>
<ul> <b>Schritt 1: </b>Klickt auf den Kurvenbereich des gewählten Datums.<br>
		<b>Schritt 2: </b>Ein kleines Fenster mit Eingabefelder öffnet sich.<br>
		<b>Schritt 3: </b>Geben Sie die Temperatur- und Blutdruckdaten ein.<br>
		<ul type="disc">
		<li>Geben Sie die Uhrzeit und Temperatur auf der rechten "<font color="#0000ff">Temperatur</font>" Spalte ein.<br>
		Beispiel: <input type="text" name="t" size=5 maxlength=5 value="12.35">&nbsp;&nbsp;<input type="text" name="u" size=8 maxlength=8 value="37.3">
		<li>Geben Sie die Uhrzeit und Blutdruck auf der linken"<font color="#cc0000">Blutdruck</font>" Spalte ein.<br>
		Beispiel: <input type="text" name="v" size=5 maxlength=5 value="10.05">&nbsp;&nbsp;<input type="text" name="w" size=8 maxlength=8 value="128/85">
		</ul>		
		<ul >
		<font color="#000099" size=1><b>Tipp:</b>Um die aktuelle Zeit einzugeben, tippt "j" oder "J" (bedeutet JETZT) in das Uhrzeit Feld ein. Die aktuelle Zeit zeigt sich automatisch.</font>
		</ul>
		<b>Schritt 4: </b>Wenn es mehrere Daten gibt, gibt sie alle ein.<br>
		<b>Schritt 5: </b>Klickt den <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> Knopf um die neue Daten zu speichern.<br>
		<b>Schritt 6: </b>Wenn Sie einen Fehler korrigieren möchten klickt die fehlerhafte Daten an, gibt das richtige ein und speichere erneut ab.<br>
		<b>Schritt 5: </b>Wenn Sie fertig sind klickt den <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> Knopf an um das Fenster zu schliessen und in die Kurve zurück zu gehen.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Zurück zu "Wie kann ich...?"</a></font>
</ul>
<a name="movedate"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Wie kann ich das Datum der Kurve ändern bzw. verschieben?</b></font>
<ul> 
	<li><font color="#660000"><b>Um das Datum um ein Tag zurück zu schieben:</b></font><br>
	<b>Schritt 1: </b>Klickt das <img <?php echo createComIcon('../','l_arrowgrnsm.gif','0') ?>> Symbol auf der <span style="background-color:yellow" >linken</span> Datum Spalte der Kurve.<p>
	<li><font color="#660000"><b>Um das Datum um ein Tag vorwärts zu schieben:</b></font><br>
	<b>Schritt 1: </b>Klickt das <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0') ?>> Symbol auf der <span style="background-color:yellow" >rechten</span> Datum Spalte der Kurve.
                                                                     <p>
	<li><font color="#660000"><b>Um das Anfangsdatum der Kurve direkt zu setzen:</b></font><br>
	<b>Schritt 1: </b>Klickt die <span style="background-color:yellow" >rechte Maustaste</span> auf das <img <?php echo createComIcon('../','l_arrowgrnsm.gif','0') ?>> Symbol auf der <span style="background-color:yellow" >linken</span> Datum Spalte der Kurve.<br>
	<b>Schritt 2: </b>Klickt den <input type="button" value="OK"> wenn Sie nach Bestätigung gefragt werden.<br>
	<b>Schritt 3: </b>Ein kleines Fenster mit Auswahlfelder für das Datum öffnet sich.<br>
	<b>Schritt 4: </b>Wählen Sie den Tag, Monat, und Jahr aus.<br>
	<b>Schritt 5: </b>Klickt den <input type="button" value="GO"> Knopf an um das Datum zu setzen.<br>
	Das kleine Fenster schliesst sich und die Kurve stellt sich auf das neue Anfangsdatum ein.<p>
	
	<li><font color="#660000"><b>Um das Enddatum der Kurve direkt zu setzen:</b></font><br>
	<b>Schritt 1: </b>Klickt die <span style="background-color:yellow" >rechte Maustaste</span> auf das <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0') ?>> Symbol auf der <span style="background-color:yellow" >rechten</span> Datum Spalte der Kurve.<br>
	<b>Schritt 2: </b>Klickt den <input type="button" value="OK"> wenn Sie nach Bestätigung gefragt werden.<br>
	<b>Schritt 3: </b>Ein kleines Fenster mit Auswahlfelder für das Datum öffnet sich.<br>
	<b>Schritt 4: </b>Wählen Sie den Tag, Monat, und Jahr aus.<br>
	<b>Schritt 5: </b>Klickt den <input type="button" value="GO"> Knopf an um das Datum zu setzen.<br>
	Das kleine Fenster schliesst sich und die Kurve stellt sich auf das neue Enddatum ein.<p>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Zurück zu "Wie kann ich...?"</a></font>
</ul>
<a name="diet"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Wie kann ich einen Kostplan eingeben?</b></font>
<ul> <b>Schritt 1: </b>Klickt den "<span style="background-color:yellow" > Kost </span>" des gewählten Datums.<br>
		<b>Schritt 2: </b>Ein kleines Fenster mit Eingabefelder für die Kostplanung öffnet sich.<br>
		<b>Schritt 3: </b>Gibt den Kostplan ein.<br>
		<b>Schritt 4: </b>Klickt den <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> Knopf an um den Kostplan zu speichern.<br>
  		<b>Achtung! </b>Wenn Sie abbrechen möchten klickt den<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> Knopf an.<br>
		<b>Schritt 5: </b>Wenn Sie einen Fehler korrigieren möchten klicken Sie die fehlerhafte Daten an, gibt das richtige ein und speichere erneut ab.<br>
		<b>Schritt 6: </b>Wenn Sie fertig sind klickt den <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> Knopf an um das Fenster zu schliessen und in die Kurve zurück zu gehen.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Zurück zu "Wie kann ich...?"</a></font>
</ul>
<a name="allergy"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Wie kann ich Information über Allergie eingeben?</b></font>
<ul> 
	<b>Schritt 1: </b>Klickt das Symbol <img <?php echo createComIcon('../','clip.gif','0') ?>> (clip) nach der "<span style="background-color:yellow" > Allergie <img <?php echo createComIcon('../','clip.gif','0') ?>> </span>" an.<br>
	<b>Schritt 2: </b>Ein kleines Fenster mit Eingabefelder für die Allergie öffnet sich.<br>
	<b>Schritt 3: </b>Gibt die Allergie oder CAVE Information in das Feld <br> "<span style="background-color:yellow" > Ihre neue Eintragung bitte hier unten eingeben: </span>" ein.<br>
  		<b>Achtung! </b>Sie können auch falls erforderlich die aktuelle Information im Feld <br>in the "<span style="background-color:yellow" > Aktuelle Eintragung(en): </span>" bearbeiten.<br>
  		<b>Achtung! </b>Wenn Sie abbrechen möchten klickt den<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> Knopf an.<br>
		<b>Schritt 4: </b>Klickt den <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> Knopf an um die Information zu speichern.<br>
		<b>Schritt 5: </b>Wenn Sie einen Fehler korrigieren möchten klicken Sie die fehlerhafte Daten an, gibt das richtige ein und speichere erneut ab.<br>
		<b>Schritt 6: </b>Wenn Sie fertig sind klickt den <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> Knopf an um das Fenster zu schliessen und in die Kurve zurück zu gehen.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Zurück zu "Wie kann ich...?"</a></font>
</ul>

<a name="diag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Wie kann ich die Hauptdiagnose bzw. Therapie eingeben?</b></font>
<ul> 
	<b>Schritt 1: </b>Klickt das Symbol <img <?php echo createComIcon('../','clip.gif','0') ?>> (clip) nach der "<span style="background-color:yellow" > Diagnose/Therapie <img <?php echo createComIcon('../','clip.gif','0') ?>> </span>" an.<br>
	<b>Schritt 2: </b>Ein kleines Fenster mit Eingabefelder für die Diagnose/Therapie öffnet sich.<br>
	<b>Schritt 3: </b>Gibt die Diagnose oder Therapie in das Feld<br> "<span style="background-color:yellow" > Ihre neue Eintragung bitte hier unten eingeben: </span>" ein.<br>
  		<b>Achtung! </b>Sie können auch falls erforderlich die aktuelle Information im Feld  "<span style="background-color:yellow" > Aktuelle Eintragung(en): </span>" bearbeiten.<br>
  		<b>Achtung! </b>Wenn Sie abbrechen möchten klickt den<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> Knopf an.<br>
		<b>Schritt 4: </b>Klickt den <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> Knopf an um die Information zu speichern.<br>
		<b>Schritt 5: </b>Wenn Sie einen Fehler korrigieren möchten klicken Sie die fehlerhafte Daten an, gibt das richtige ein und speichere erneut ab.<br>
		<b>Schritt 6: </b>Wenn Sie fertig sind klickt den <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> Knopf an um das Fenster zu schliessen und in die Kurve zurück zu gehen.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Zurück zu "Wie kann ich...?"</a></font>
</ul>
<a name="daydiag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Wie kann ich tägliche Information über Diagnose oder Therapieplan eingeben?</b></font>
<ul> 
	<b>Schritt 1: </b>Klickt entweder eine leere Spalte oder die existierende Diagnose oder Therapieplan des gewählten Datums an.<br>
	<b>Schritt 2: </b>Ein kleines Fenster mit Eingabefelder für die Diagnose/Therapie des Datums öffnet sich.<br>
	<b>Schritt 3: </b>Gibt die Diagnose oder Therapieplan in das Feld<br> "<span style="background-color:yellow" > Ihre neue Eintragung bitte hier unten eingeben: </span>" ein.<br>
  		<b>Achtung! </b>Sie können auch falls erforderlich die aktuelle Information im Feld  "<span style="background-color:yellow" > Aktuelle Eintragung(en): </span>" bearbeiten.<br>
  		<b>Achtung! </b>Wenn Sie abbrechen möchten klickt den<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> Knopf an.<br>
		<b>Schritt 4: </b>Klickt den <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> Knopf an um die Information zu speichern.<br>
		<b>Schritt 5: </b>Wenn Sie einen Fehler korrigieren möchten klicken Sie die fehlerhafte Daten an, gibt das richtige ein und speichere erneut ab.<br>
		<b>Schritt 6: </b>Wenn Sie fertig sind klickt den <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> Knopf an um das Fenster zu schliessen und in die Kurve zurück zu gehen.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Zurück zu "Wie kann ich...?"</a></font>
</ul>
<a name="extra"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Wie kann ich Besonderheiten oder Nebendiagnose eingeben?</b></font>
<ul> 
	<b>Schritt 1: </b>Klickt das Symbol <img <?php echo createComIcon('../','clip.gif','0') ?>> (clip) nach der "<span style="background-color:yellow" > Besonderheiten/Nebendiagnose <img <?php echo createComIcon('../','clip.gif','0') ?>> </span>" an.<br>
	<b>Schritt 2: </b>Ein kleines Fenster mit Eingabefelder für die Besonderheiten oder Nebendiagnose öffnet sich.<br>
	<b>Schritt 3: </b>Gibt die Besonderheiten oder Nebendiagnose in das Feld<br> "<span style="background-color:yellow" > Ihre neue Eintragung bitte hier unten eingeben: </span>" ein.<br>
  		<b>Achtung! </b>Sie können auch falls erforderlich die aktuelle Information im Feld "<span style="background-color:yellow" > Aktuelle Eintragung(en): </span>" bearbeiten.<br>
  		<b>Achtung! </b>Wenn Sie abbrechen möchten klickt den<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> Knopf an.<br>
		<b>Schritt 4: </b>Klickt den <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> Knopf an um die Information zu speichern.<br>
		<b>Schritt 5: </b>Wenn Sie einen Fehler korrigieren möchten klickt die fehlerhafte Daten an, gibt das richtige ein und speichere erneut ab.<br>
		<b>Schritt 6: </b>Wenn Sie fertig sind klickt den <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> Knopf an um das Fenster zu schliessen und in die Kurve zurück zu gehen.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Zurück zu "Wie kann ich...?"</a></font>
</ul>
<a name="pt"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Wie kann ich tägliche Information über PT, ATG, usw eingeben?</b></font>
<ul> 
	<b>Schritt 1: </b>Klickt die "<span style="background-color:yellow" > PT,ATG,usw: </span>" des gewählten Datums an.<br>
	<b>Schritt 2: </b>Ein kleines Fenster mit Eingabefelder für die PT,ATG,usw des Datums öffnet sich.<br>
	<b>Schritt 3: </b>Gibt die Information in das Feld<br> "<span style="background-color:yellow" > Ihre neue Eintragung bitte hier unten eingeben: </span>" ein.<br>
  		<b>Achtung! </b>Sie können auch falls erforderlich die aktuelle Information im Feld "<span style="background-color:yellow" > Aktuelle Eintragung(en): </span>" bearbeiten.<br>
  		<b>Achtung! </b>Wenn Sie abbrechen möchten klickt den<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> Knopf an.<br>
		<b>Schritt 4: </b>Klickt den <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> Knopf an um die Information zu speichern.<br>
		<b>Schritt 5: </b>Wenn Sie einen Fehler korrigieren möchten klicken Sie die fehlerhafte Daten an, gibt das richtige ein und speichere erneut ab.<br>
		<b>Schritt 6: </b>Wenn Sie fertig sind klickt den <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> Knopf an um das Fenster zu schliessen und in die Kurve zurück zu gehen.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Zurück zu "Wie kann ich...?"</a></font>
</ul>
<a name="coag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Wie kann ich Antikoagulant(ien) eingeben?</b></font>
<ul> 
	<b>Schritt 1: </b>Klickt das Symbol <img <?php echo createComIcon('../','clip.gif','0') ?>> (clip) nach der "<span style="background-color:yellow" > Antikoagulant(ien) <img <?php echo createComIcon('../','clip.gif','0') ?>> </span>" an.<br>
	<b>Schritt 2: </b>Ein kleines Fenster mit Eingabefelder für Antikoagulant(ien) öffnet sich.<br>
	<b>Schritt 3: </b>Gibt die Information über das Antikoagulant und dessen Dosierung in das Feld<br> "<span style="background-color:yellow" > Ihre neue Eintragung bitte hier unten eingeben: </span>" ein.<br>
  		<b>Achtung! </b>Sie können auch falls erforderlich die aktuelle Information im Feld "<span style="background-color:yellow" > Aktuelle Eintragung(en): </span>" bearbeiten.<br>
  		<b>Achtung! </b>Wenn Sie abbrechen möchten klickt den<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> Knopf an.<br>
		<b>Schritt 4: </b>Klickt den <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> Knopf an um die Information zu speichern.<br>
		<b>Schritt 5: </b>Wenn Sie einen Fehler korrigieren möchten klicken Sie die fehlerhafte Daten an, gibt das richtige ein und speichere erneut ab.<br>
		<b>Schritt 6: </b>Wenn Sie fertig sind klickt den <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> Knopf an um das Fenster zu schliessen und in die Kurve zurück zu gehen.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Zurück zu "Wie kann ich...?"</a></font>
</ul>
<a name="daycoag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Wie kann ich tägliche Information über Antikoagulant(ien) und deren Verabreichung eingeben?</b></font>
<ul> 
	<b>Schritt 1: </b>Klickt entweder eine leere Spalte oder die existierende Information über Antikoagulant(ien) des gewählten Datums an.<br>
	<b>Schritt 2: </b>Ein kleines Fenster mit Eingabefelder für Antikoagulant(ien) des gewählten Datums öffnet sich.<br>
	<b>Schritt 3: </b>Gibt die Information über das Antikoagulant und dessen Verabreichung in das Feld<br> "<span style="background-color:yellow" >Bitte hier eintragen bzw. die aktuelle Information verändern: </span>" ein.<br>
		<b>Schritt 4: </b>Klickt den <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> Knopf an um die Information zu speichern.<br>
		<b>Schritt 5: </b>Wenn Sie einen Fehler korrigieren möchten klicken Sie die fehlerhafte Daten an, gibt das richtige ein und speichere erneut ab.<br>
		<b>Schritt 6: </b>Wenn Sie fertig sind klickt den <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> Knopf an um das Fenster zu schliessen und in die Kurve zurück zu gehen.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Zurück zu "Wie kann ich...?"</a></font>
</ul>
<a name="lot"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Wie kann ich Angaben eingeben?</b></font>
<ul> 
	<b>Schritt 1: </b>Klickt das Symbol <img <?php echo createComIcon('../','clip.gif','0') ?>> (clip) nach der "<span style="background-color:yellow" > Angaben <img <?php echo createComIcon('../','clip.gif','0') ?>> </span>" an.<br>
	<b>Schritt 2: </b>Ein kleines Fenster mit Eingabefelder für Angaben öffnet sich.<br>
	<b>Schritt 3: </b>Gibt die Angaben (LOT, Chargen Nr., Implantat, usw.) in das Feld<br> "<span style="background-color:yellow" > Ihre neue Eintragung bitte hier unten eingeben: </span>" ein.<br>
  		<b>Achtung! </b>Sie können auch falls erforderlich die aktuelle Information im Feld "<span style="background-color:yellow" > Aktuelle Eintragung(en): </span>" bearbeiten.<br>
  		<b>Achtung! </b>Wenn Sie abbrechen möchten klickt den<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> Knopf an.<br>
		<b>Schritt 4: </b>Klickt den <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> Knopf an um die Information zu speichern.<br>
		<b>Schritt 5: </b>Wenn Sie einen Fehler korrigieren möchten klicken Sie die fehlerhafte Daten an, gibt das richtige ein und speichere erneut ab.<br>
		<b>Schritt 6: </b>Wenn Sie fertig sind klickt den <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> Knopf an um das Fenster zu schliessen und in die Kurve zurück zu gehen.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Zurück zu "Wie kann ich...?"</a></font>
</ul>
<a name="med"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Wie kann ich Medikamente und deren Dosierungsplan eingeben?</b></font>
<ul> 
	<b>Schritt 1: </b>Klickt die "<span style="background-color:yellow" > Medikamente </span>" an.<br>
	<b>Schritt 2: </b>Ein kleines Fenster mit Eingabefelder für Medikamente und deren Dosierungsplan öffnet sich.<br>
	<b>Schritt 3: </b>Gibt die Medikamente auf die linke Spalte ein.<br> 
	<b>Schritt 4: </b>Tippt den Dosierungsplan auf die mittlere Spalte ein.<br> 
	<b>Schritt 5: </b>Klickt den radiobutton für die entsprechende Farbkodierung des Medikaments an.<br> 
	<ul type=disc>
		<li>Weiss für normal oder standard.
		<li><span style="background-color:#00ff00" >Grün</span> für Antibiotika und deren Derivativen.
		<li><span style="background-color:yellow" >Gelb</span> für Wasserabschwemmende Medikamente.
		<li><span style="background-color:#0099ff" >Blau</span> für hämolytische Medikamente.
		<li><span style="background-color:#ff0000" >Rot</span> für i.v. verabreichte Medikamente.
	</ul>
  	<b>Achtung! </b>Sie können auch falls erforderlich die aktuelle Information bearbeiten.<br>
	<b>Schritt 6: </b>Geben Sie Ihren Namen in das Feld "<span style="background-color:yellow" > Schwester/Pfleger: </span>" ein.<br> 
  		<b>Achtung! </b>Wenn Sie abbrechen möchten klickt den<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> Knopf an.<br>
		<b>Schritt 7: </b>Klickt den <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> Knopf an um den Medikationsplan zu speichern.<br>
		<b>Schritt 8: </b>Wenn Sie einen Fehler korrigieren möchten klicken Sie die fehlerhafte Daten an, gibt das richtige ein und speichere erneut ab.<br>
		<b>Schritt 9: </b>Wenn Sie fertig sind klickt den <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> Knopf an um das Fenster zu schliessen und in die Kurve zurück zu gehen.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Zurück zu "Wie kann ich...?"</a></font>
</ul>
<a name="daymed"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Wie kann ich tägliche Information über Medikamente und deren Verabreichung bzw. Dosierung eingeben?</b></font>
<ul> 
	<b>Schritt 1: </b>Klickt entweder eine leere Spalte von Medikamente oder die existierende Eingabe  des gewählten Datums an.<br>
	<b>Schritt 2: </b>Ein kleines Fenster mit Eingabefelder für Medikamente und deren Verabreichung des Datums öffnet sich.<br>
	<b>Schritt 3: </b>Klickt das Eingabefeld des gewählten Medikaments.<br>
	<b>Schritt 4: </b>Geben Sie entweder die Verabreichung, Dosierung, Name des Verabreichers, oder Symbole für Beginn oder Ende der Verabreichung ein.<br>
  		<b>Achtung! </b>Wenn Sie abbrechen möchten klickt den<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> Knopf an.<br>
		<b>Schritt 5: </b>Wenn Sie mehrere Eintragungen haben, tragen Sie sie alle ein.<br>
		<b>Schritt 6: </b>Klickt den <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> Knopf an um die Information zu speichern.<br>
		<b>Schritt 7: </b>Wenn Sie einen Fehler korrigieren möchten klickt die fehlerhafte Daten an, gibt das richtige ein und speichere erneut ab.<br>
		<b>Schritt 8: </b>Wenn Sie fertig sind klickt den <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> Knopf an um das Fenster zu schliessen und in die Kurve zurück zu gehen.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Zurück zu "Wie kann ich...?"</a></font>
</ul>
<a name="iv"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Wie kann ich tägliche Information über i.v. Medikamente und deren Dosierung bzw. Verabreichung eingeben?</b></font>
<ul> 
	<b>Schritt 1: </b>Klickt  in der "<span style="background-color:yellow" > i.v.Zugang>> </span>" Reihe entweder eine leere Spalte oder die existierende Information des gewählten Datums.<br>
	<b>Schritt 2: </b>Ein kleines Fenster mit Eingabefelder für i.v. Medikamente und deren Verabreichung des Datums öffnet sich.<br>
	<b>Schritt 3: </b>Geben Sie entweder die Verabreichung, Dosierung, Name des Verabreichers, oder Symbole für Beginn oder Ende der Verabreichung  in das Feld "<span style="background-color:yellow" > Bitte hier eintragen bzw. die aktuelle Information verändern: </span>" ein.<br>
  		<b>Achtung! </b>Wenn Sie abbrechen möchten klickt den<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> Knopf an.<br>
		<b>Schritt 4: </b>Klickt den <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> Knopf an um die Information zu speichern.<br>
		<b>Schritt 5: </b>Wenn Sie einen Fehler korrigieren möchten klicken Sie die fehlerhafte Daten an, gibt das richtige ein und speichere erneut ab.<br>
		<b>Schritt 6: </b>Wenn Sie fertig sind klickt den <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> Knopf an um das Fenster zu schliessen und in die Kurve zurück zu gehen.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Zurück zu "Wie kann ich...?"</a></font>
</ul>


<?php endif;?>

</form>

