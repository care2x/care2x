<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
Radiologie - DICOM-Bilder uploaden

 </b>
 </font>
<p><font size=2 face="verana,arial" >
<form action="#" >

<?php
if(!$src){
?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie kann ich DICOM-Bilder uploaden?</b>
</font>

	<ul>
 	<b>Schritt 1: </b>Wenn die zu den Bildern gehörende Patienten-Aufnahmenummer bekannt ist, geben Sie sie im Feld
	"<font color=#0000ff>Zugehörige Aufnahmenummer</font>" ein.<p>
 	<b>Schritt 2: </b>Wenn die Nummern oder ID's von verbundenen Dokumenten bekannt sind, dann geben Sie diese im Feld
	"<font color=#0000ff>IDs verbundener Dokumente</font>" ein. Trennen Sie die einzelnen IDs mit Kommas voneinander ab.<p>
 	<b>Schritt 3: </b>Geben Sie eine kurze Beschreibung des Bildes / der Bilder im Feld
	"<font color=#0000ff>Anmerkungen</font>" ein.<p>
 	<b>Schritt 4: </b>Klicken Sie auf den <input type="button" value="Browse">-Button
	um das Datei-Auswahlfenster zu öffnen.<p>
 	<b>Schritt 5: </b>Wählen Sie die entsprechenden Bilder aus.<p>
 	<b>Schritt 6: </b>Wenn Sie alle Bilddateien ausgewählt haben, starten Sie durch Klick auf den
	<img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>>-Button den Datei-Upload.<p>
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie ändere ich die Anzahl der up-zu-loadenden Bilder?</b>
</font>

	<ul>
 	<b>Anmerkung: </b>Ändern Sie die Anzahl der Bilder unbedingt <b>bevor</b> Sie Daten eingeben bzw. bevor Sie
	die Bilddateien auswählen.<p>
 	<b>Schritt 1: </b>Tragen Sie die Anzahl der Bilder im Feld "Ich muss <input type="text" name="d" size=3 maxlength=1 value=4> uploaden" ein.<p>
 	<b>Schritt 2: </b>Klicken Sie auf "Los".<p>
</ul>
<?php
}else{
?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie kann ich nach einem erfolgreichen Upload die Integrität der hochgeladenen Bilder überprüfen?</b>
</font>
	<ul>
 	<b>Schritt: </b>Klicken Sie auf das Symbol <img <?php echo createComIcon('../','torso.gif','0') ?>>
	der "<b>Bild-Gruppen-Nummer</b>", um die Bilder im aktuellen Frame anzuzeigen (vom Viewer abhängig).<p>
	<img src="../help/en/img/en_dicom_group_in.png" border=0 width=318 height=132><p>
  	<b>ODER: </b>Klicken Sie auf das Symbol <img <?php echo createComIcon('../','torso_win.gif','0') ?>>
	der "<b>Bild-Gruppen-#</b>", um die Bilder in einem extra Fenster anzeigen zu lassen.<p>
	<img src="../help/en/img/en_dicom_group_ex.png" border=0 width=318 height=132>

</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie kann ich nach einem erfolgreichen Upload die Integrität jedes einzelnen upgeloadeten Bildes überprüfen?</b>
</font>
	<ul>
 	<b>Schritt: </b>Klicken Sie auf das Symbol <img <?php echo createComIcon('../','torso.gif','0') ?>>
	in der Liste, um ein einzelnes Bild im aktuellen Frame (Rahmen) anzuzeigen (Viewer spezifisch).<p>
	<img src="../help/en/img/en_dicom_single_in.png" border=0 width=410 height=101><p>
  	<b>ODER: </b>Klicken Sie auf das Symbol <img <?php echo createComIcon('../','torso_win.gif','0') ?>>
	der Liste, um ein einzelnes Bild in einem neuen Fenster anzuzeigen.<p>
	<img src="../help/en/img/en_dicom_single_ex.png" border=0 width=410 height=101>

</ul>

<?php
}
?>

</form>

