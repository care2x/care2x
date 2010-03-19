<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
?>
<font face="Verdana, Arial" size=3 color="#0000cc">
<b><?php echo "$x3 - $x2" ?></b></font>
<form action="#" >
<p><font size=2 face="verdana,arial" >

<?php if((($src=="")&&($x1=="ja"))||(($src=="fresh")&&($x1=="template"))) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie gebe ich einem Patient ein Bett?</b></font>
<ul> <b>Schritt 1: </b>Den <img <?php echo createComIcon('../','plus2.gif','0') ?>> Knopf der Zimmernummer und Bett anklicken.
                                                                     <br>
		<b>Schritt 2: </b>Ein kleines Fenster zum Suchen von Patienten öffnet sich.<br>
		<b>Schritt 3: </b>Suche zuerst den Patient. Geben Sie die Information in das entsprechende Eingabefeld ein wie folgt:<br>
		Wenn Sie den patient suchen...<ul type="disc">
		<li>nach seiner Fallnummer, gibt die Fallnummer in das Feld <br>"<span style="background-color:yellow" >Fallnummer:</span><input type="text" name="t" size=19 maxlength=10 value="22000109">" ein.
		<li>nach seinem Namen, gibt den Namen in das Feld <br>"<span style="background-color:yellow" >Name:</span><input type="text" name="t" size=19 maxlength=10 value="Schmitt">" ein.
		<li>nach seinem Vornamen, gibt den Vornamen in das Feld <br>"<span style="background-color:yellow" >Vorname:</span><input type="text" name="t" size=19 maxlength=10 value="Peter">" ein.
		<li>nach seinem Geburtsdatum, gibt das Geburtsdtum in das Feld <br>"<span style="background-color:yellow" >Geburtsdatum:</span><input type="text" name="t" size=19 maxlength=10 value="10.10.1966">" ein.
		</ul>
		<b>Schritt 4: </b>Den <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> Knopf anklicken.<br>
		<b>Schritt 5: </b>Wenn die Suche ein Ergebnis bzw. mehrere Ergebnisse liefert wird eine Liste gezeigt.<br>
		<b>Schritt 6: </b>Um den richtigen Patient auszuwählen klickt den nebensteheden &nbsp;<button><img <?php echo createComIcon('../','post_discussion.gif','0') ?>></button> Knopf an.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie kann ich einen Patient entlassen?</b></font>
<ul> <b>Schritt 1: </b>Klickt den <img <?php echo createComIcon('../','bestell.gif','0') ?>> Knopf des Patienten.
                                                                     <br>
		<b>Schritt 2: </b>Das Entlassungsformular wird eingeblendet.<br>
		<b>Schritt 3: </b>Wenn Sie sicher den Patient entlassen wollen, <br>klickt den Checkbox
		"<input type="checkbox" name="g" ><span style="background-color:yellow" > Ja, ich bin sicher. Ich möchte den Patient entlassen.</span>" an um ihn zu aktivieren.<br>
       	<b>Schritt 4: </b>Klickt den <input type="button" value="Entlassen"> Knopf an um den Patient zu entlassen.<p>
       	<b>Achtung! </b>Wenn Sie abbrechen möchten klickt den <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> Knopf an und der Patient wird nicht entlassen.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie sperre ich ein Bett?</b></font>
<ul> <b>Schritt 1: </b>Klickt den <img <?php echo createComIcon('../','plus2.gif','0') ?>> Knopf des zu sperrenden Bettes.
                                                                     <br>
		<b>Schritt 2: </b>Ein kleines Fenster zum Suchen von Patienten öffnet sich. Sie wollen aber nicht suchen sonder ein Bett sperren.<br>
		<b>Schritt 3: </b>Klickt den "<span style="background-color:yellow" > <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> <font color="#0000ff">Dieses Bett sperren</font> </span>" an.<br>
		<b>Schritt 4: </b>Klickt den&nbsp;<button>OK</button> an wenn Sie nach einer Bestätigung gefragt werden.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie kann ich einen Patient aus der Belegungsliste entfernen?</b></font>
<ul> <b>Achtung! </b>Sie können einen Patient NICHT einfach aus der Liste entfernen. Um ihn zu entfernen müssen Sie ihn entlassen. Um ihn zu entlassen folgen Sie
die Anweisung (wie oben beschrieben) wie man einen Patient entlässt.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Was bedeuten diese  <img <?php echo createComIcon('../','s_colorbar.gif','0') ?>> Farbbalken? </b></font>
<ul> <b>Achtung! </b>
Jede Farbe in dieser Farbbalken (wenn gesetzt) signalisiert das Vorhandensein einer Information, Anweisung, Änderung, oder Frage, usw.
<br>
			Die Bedeutung von jeder Farbe kann für jede Station eingestellt werden.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
 <font color="#990000"><b>Was bedeutet dieses Symbol <img <?php echo createComIcon('../','patdata.gif','0') ?>> ? </b></font>
<ul> <b>Achtung! </b>Dies ist die Patientenmappe. Um die Patientenmappe zu öffnen klicken Sie dieses Symbol an. 
			Ein kleines Fenster öffnet sich. Das Fenster zeigt die Basisdaten des Patienten, sein Foto (wenn vorhanden), und andere Optionen.
			<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Was bedeutet dieses Symbol <img <?php echo createComIcon('../','bubble2.gif','0') ?>> ? </b></font>
<ul> <b>Achtung! </b>Dies ist das Vermerk. Wenn es angeklickt wird öffnet sich ein kleines Fenster mit einem Eingabefeld für Vermerke oder Notizen über den Patient.<br>
			Das normal Symbol <img <?php echo createComIcon('../','bubble2.gif','0') ?>> bedeutet daß es noch kein Vermerk beinhaltet. Um ein Vermerk zu schreiben klickt dieses Symbol an.<br>
			Das andere Symbol <img <?php echo createComIcon('../','bubble3.gif','0') ?>> bedeutet daß es Vermerk beinhaltet. Um den Vermerk zu lesen bzw. zu ergänzen klickt dieses Symbol an.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
 <font color="#990000"><b>Was bedeutet dieses Symbol <img <?php echo createComIcon('../','bestell.gif','0') ?>> ? </b></font>
<ul> <b>Achtung! </b>Dies ist die Entlassung. Um einen Patient zu entlassen klickt dieses Symbol an.<br>
</ul>
<?php elseif(($src=="")&&($x1=="template")) : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Was soll ich tun wenn <span style="background-color:yellow" >Die Belegung für heute ist noch nicht erstellt</span> angezeigt ist?</b></font>
<ul> <b>Schritt 1: </b>Klickt den <input type="button" value="Die letzte Belegungsliste zeigen"> Knopf an.
                                                                     <br>
		<b>Schritt 2: </b>Wenn eine Belegungsliste von innerhalb der letzten 32 Tagen gefunden wird, wird diese Liste eingeblendet.<br>
		<b>Schritt 3: </b>Klickt den <input type="button" value="Diese Belegungsliste auf heute übernehmen."> Knopf an.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ich möchte die letzte Belegungsliste nicht sehen. Wie erstelle ich eine neue Liste?</b></font>
<ul> <b>Schritt 1: </b>Den <img <?php echo createComIcon('../','plus2.gif','0') ?>> Knopf des Bettes anklicken.
                                                                     <br>
		<b>Schritt 2: </b>Ein kleines Fenster zum Suchen von Patienten öffnet sich.<br>
		<b>Schritt 3: </b>Suche zuerst den Patient. Geben Sie die Information in das entsprechende Eingabefeld ein wie folgt:<br>
		Wenn Sie den patient suchen...<ul type="disc">
		<li>nach seiner Fallnummer, gibt die Fallnummer in das Feld <br>"<span style="background-color:yellow" >Fallnummer:</span><input type="text" name="t" size=19 maxlength=10 value="22000109">" ein.
		<li>nach seinem Namen, gibt den Namen in das Feld <br>"<span style="background-color:yellow" >Name:</span><input type="text" name="t" size=19 maxlength=10 value="Schmitt">" ein.
		<li>nach seinem Vornamen, gibt den Vornamen in das Feld <br>"<span style="background-color:yellow" >Vorname:</span><input type="text" name="t" size=19 maxlength=10 value="Peter">" ein.
		<li>nach seinem Geburtsdatum, gibt das Geburtsdtum in das Feld <br>"<span style="background-color:yellow" >Geburtsdatum:</span><input type="text" name="t" size=19 maxlength=10 value="10.10.1966">" ein.
		</ul>
		<b>Schritt 4: </b>Den <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> Knopf anklicken.<br>
		<b>Schritt 5: </b>Wenn die Suche ein Ergebnis bzw. mehrere Ergebnisse liefert wird eine Liste gezeigt.<br>
		<b>Schritt 6: </b>Um den richtigen Patient auszuwählen klickt den nebensteheden &nbsp;<button><img <?php echo createComIcon('../','post_discussion.gif','0') ?>></button> Knopf an.<br>
</ul>
<?php elseif(($src=="getlast")&&($x1=="last")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie übernehme ich die letzte Belegungsliste für die heutige Belegung?</b></font>
<ul> <b>Schritt 1: </b>Klickt den <input type="button" value="Diese Belegungsliste auf heute übernehmen."> Knopf an um die letzte Belegungsliste zu übernehmen.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Die letzte Belegungsliste ist angezeigt aber ich möchte sie nicht übernehmen. Wie kann ich eine neue Liste erstellen? </b></font>
<ul> <b>Schritt 1: </b>Klickt den <input type="button" value="Nicht übernehmen!  Eine neue Belegungsliste erstellen."> Knopf an um eine neue Liste zu erstellen.
</ul>
<?php elseif($src=="assign") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie gebe ich einem Patient ein Bett?</b></font>
<ul>
		<b>Schritt 1: </b>Suche zuerst den Patient. Geben Sie die Information in das entsprechende Eingabefeld ein wie folgt:<br>
		Wenn Sie den patient suchen...<ul type="disc">
		<li>nach seiner Fallnummer, gibt die Fallnummer in das Feld <br>"<span style="background-color:yellow" >Fallnummer:</span><input type="text" name="t" size=19 maxlength=10 value="22000109">" ein.
		<li>nach seinem Namen, gibt den Namen in das Feld <br>"<span style="background-color:yellow" >Name:</span><input type="text" name="t" size=19 maxlength=10 value="Schmitt">" ein.
		<li>nach seinem Vornamen, gibt den Vornamen in das Feld <br>"<span style="background-color:yellow" >Vorname:</span><input type="text" name="t" size=19 maxlength=10 value="Peter">" ein.
		<li>nach seinem Geburtsdatum, gibt das Geburtsdtum in das Feld <br>"<span style="background-color:yellow" >Geburtsdatum:</span><input type="text" name="t" size=19 maxlength=10 value="10.10.1966">" ein.
		</ul>
		<b>Schritt 2: </b>Den <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> Knopf anklicken.<br>
		<b>Schritt 3: </b>Wenn die Suche ein Ergebnis bzw. mehrere Ergebnisse liefert wird eine Liste gezeigt.<br>
		<b>Schritt 4: </b>Um den richtigen Patient auszuwählen klickt den nebensteheden &nbsp;<button><img <?php echo createComIcon('../','post_discussion.gif','0') ?>></button> Knopf an.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie sperre ich ein Bett??</b></font>
<ul>
		<b>Schritt 1: </b>Klickt den "<span style="background-color:yellow" > <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> <font color="#0000ff">Dieses Bett sperren</font> </span>" an.<br>
		<b>Schritt 2: </b>Klickt den&nbsp;<button>OK</button> an wenn Sie nach einer Bestätigung gefragt werden.<br>
</ul>
  <b>Achtung! </b> Falls Sie abbrechen möchten den <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> anklicken.</ul>
  
<?php elseif($src=="remarks") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie schreibe ich Vermerke bzw Notizen über den Patient?</b></font>
<ul> <b>Schritt 1: </b>Klickt das Eingabefeld an.<br>
		<b>Schritt 2: </b>Tipp den Vermerk ein.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ich bin fertig. Wie kann ich den Vermerk speichern?</b></font>
<ul> 	<b>Schritt 1: </b>Den <input type="button" value="Speichern"> Knopf anklicken.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ich habe den Vermerk gespeichert. Wie kann ich das jetzt beenden?</b></font>
<ul> 	<b>Schritt 1: </b>Den <img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle"> Knopf anklicken.<p>
</ul>
<?php elseif($src=="discharge") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie kann ich einen Patient entlassen?</b></font>
<ul> <b>Schritt 1: </b>Wählen Sie die Art der Entlassung. Klickt die entsprechende Auswahl an.<br>
	<ul><br>
		<input type="radio" name="relart" value="reg" checked> Regulär entlassen<br>
                 	<input type="radio" name="relart" value="self"> Patient auf Eigenverantwortung das KH verlassen<br>
                 	<input type="radio" name="relart" value="emgcy"> Notentlassung<br>  <br>
	</ul>
		<b>Schritt 2: </b>Tippen Sie (falls erforderlich) weitere Angaben über die Entlassung in das Feld "<span style="background-color:yellow" > Vermerk: </span>". <br>
		<b>Schritt 3: </b>Geben Sie Ihren Namen in das Feld "<span style="background-color:yellow" > Schwester/Pfleger: <input type="text" name="a" size=20 maxlength=20></span>" ein (falls leer). <br>
		<b>Schritt 4: </b>Klickt den " <span style="background-color:yellow" ><input type="checkbox" name="d" value="d"> Ja, ich bin sicher. Ich möchte den Patient entlassen. </span>" an. <br>
		<b>Schritt 5: </b>Klickt den <input type="button" value="Entlassen"> Knopf um den Patient zu entlassen.<p>
		<b>Schritt 6: </b>Klickt den <img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle"> Knopf um in die Belegungsliste zurück zu gehen.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ich habe versucht ohne Ergebnis den <input type="button" value="Entlassen"> Knopf anzuklicken. Was ist los?</b></font>
<ul> <b>Achtung! </b>Der folgende Checkbox muss angeklickt werden und muss aussehen wie folgendes: <br>
 " <span style="background-color:yellow" ><input type="checkbox" name="d" value="d" checked> Ja, ich bin sicher. Ich möchte den Patient entlassen. </span>". <p>
		<b>Schritt 1: </b>Klickt den Checkbox an falls er noch nicht aktiviert ist.<p>
</ul>
  <b>Achtung! </b> Falls Sie abbrechen möchten den <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> anklicken.</ul>

<?php endif;?>
<?php if(($src!="assign")&&($src!="remarks")&&($src!="discharge")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Was bedeutet dies "<span style="background-color:yellow" > <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> <font color="#0000ff">Gesperrt</font> </span>" ? </b></font>
<ul> <b>Achtung! </b>Dies bedeutet "Dieses Bett ist gesperrt". Um die Sperre aufzuheben klickt den "<span style="background-color:yellow" ><font color="#0000ff">Gesperrt</font></span>" an und klickt den&nbsp;<button>OK</button>
			wenn Sie nach einer Bestätigung gefragt werden.<p>
 <b>Achtung! </b>Abhängig von der Version des Programms, eine Bettsperre aufzuheben könnte die Angabe eines Passworts erfordern.</ul>

<?php endif;?>

</form>

