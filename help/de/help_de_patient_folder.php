<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b><?php echo "Patientendaten - $x3" ?></b></font>
<form action="#" >
<p><font size=2 face="verdana,arial" >

<?php if($src=="") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Was bedeuten diese Farbbalken?
     </b> <img <?php echo createComIcon('../','colorcodebar3.gif','0') ?> ></font>
<ul> <b>Anmerkung: </b>Jeder dieser Farbbalken signalisiert (sofern auf "sichtbar" gesetzt) die Verfügbarkeit einer
bestimmten Information, einer Anweisung, einer Änderung oder einer Anfrage etc.<br>
	Die Zuordnung der Farben kann für jede Station getrennt festgelegt werden.<br>
	Die rosa Balken rechts sollen den ungefähren Zeitpunk der Fälligkeit anzeigen.<br>
	So bedeutet der sechste rosa Balken "6. Stunde" oder "6 Uhr morgens" und der 22. Balken bedeutet entsprechend
         "22 Uhr".
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wozu dienen die folgenden Knöpfe?</b></font>
<ul> <input type="button" value="Fieberkurve">
	<ul>
	Damit wird die Temperaturkurve des Patienten geöffnet. Sie können Temperatur- oder Blutdruckwerte eintragen,
         ändern oder löschen.<br>
	Weitere editierbare Felder sind:
	<ul type="disc">
	<li>Allergie<br>
	<li>Täglicher Diätplan<br>
	<li>Hauptdiagnose / Therapie<br>
	<li>Tägliche Diagnose / Therapie<br>
	<li>Anmerkungen, extra Diagnosenbr>
	<li>PT (Physikalische Therapie), ATG (Anti-Thrombose-Gymnastik), etc.<br>
	<li>Antikoagulantien<br>
	<li>Tägliche Dokumentation zu den Antikoagulantien<br>
	<li>Intravenöse Medikation & Druckverbände<br>
	<li>Tägliche Dokumentation zur intravenösen Medikation<br>
	<li>Anmerkungen<br>
	<li>Medikation (Liste)<br>
	<li>Tägliche Dokumentation zur Medikation und Dosierung<br>
	</ul>
	</ul>
<input type="button" value="Pflegebericht">
	<ul>
	Hiermit wird der Pflegebericht geöffnet Sie können Ihre Pflegeaktivitäten dokumentieren, deren Effektivität,
         Beobachtungen, Anfragen, Empfehlungen usw.
	</ul>
	<input type="button" value="Ärztliche Anweisungen">
	<ul>
	Der verantwortliche Arzt gibt hier seine Anweisungen, die Medikation, Dosierung, Antworten auf Fragen der
         Pflegepersonals, oder Änderungen ein.
	</ul>
	<input type="button" value="Diagnostische Berichte">
	<ul>
	Hier wird die Diagnostik bzw. die Befunde aus anderen Klinken und Abteilungen aufbewahrt.
	</ul>
<!-- 	<input type="button" value="Root data">
	<ul>
	This stores the patients root data and personal information like name, given name, etc. This is also the initial documentation of the
	patient's anamnesis or medical history that serves as foundation for the individual nursing plan.
	</ul>
	<input type="button" value="Nursing Plan">
	<ul>
	This is the individual nursing plan. You can create, edit, or delete the plan.
	</ul>
 -->
 <input type="button" value="DRG">
	<ul>
	Hiermit wird das DRG-Fenster geöffnet.
	</ul>
 <input type="button" value="Labor">
	<ul>
	Hier sind Labor- und Pathologie-Befunde gespeichert.
	</ul>
 <input type="button" value="Photos">
	<ul>
	Damit wird das Bild-Archiv des Patienten geöffnet.
	</ul>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wozu dient diese Auswahlbox: </b>	<select name="d"><option value="">Anforderung für diagnostischen Test auswählen</option></select>?
</font>
<ul><b>Anmerkung: </b>Hiermit wird das entsprechende Anforderungsformular für einen diagnostischen Test
	ausgewählt.<br>
<b>Schritt 1: </b>Klicken Sie auf <select name="d"><option value="">Anforderung für diagnostischen Test auswählen</option></select><br>
<b>Schritt 2: </b>Klicken Sie auf die Klinik/Abteilung oder den Test.<br>
<b>Schritt 3: </b>Das Anforderungsformular wird automatisch geöffnet.<br>
</ul>
<?php endif;?>

<?php if($src=="labor") : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b>Derzeit sind keine Laborbefunde verfügbar. </b></font>
<ul> Klicken Sie auf den Knopf <input type="button" value="OK"> um zu den Stammdaten des Patienten zurückzukeheren.</ul>
<?php else  : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Wie schließe ich die Ansicht mit den Patientendaten? </b></font>
<ul> <b>Anmerkung: </b>Wenn Sie diese Ansicht schließen möchten, klicken Sie auf <img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle">.</ul>

<?php endif;?>

</form>
