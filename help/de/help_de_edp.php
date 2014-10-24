<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
?>
</b><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
EDV - 
<?php
	switch($src)
	{
	case "access": switch($x1)
						{
							case "": print "Erschaffung einer Zugangsberechtigung";
												break;
							case "save": print "Zugangsberechtigung gespeichert";
												break;
							case "list": print "Aktuelle Zugangsberechtigungen";
												break;
							case "update": print "Zugangsberechtigung bearbeiten";
												break;
							case "lock":  if($x2=="0") print "Sperre einer Zugangsberechtigung"; else print "Aufhebung einer Sperre"; 
												break;
							case "delete": print "Entfernen einer Zugangsberechtigung";
												break;
						}
						break;
	}


 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >

	

<?php if($src=="access") : ?>
	<?php if($x1=="") : ?>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie erschaffe ich eine neue Zugangsberechtigung?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Geben Sie den Namen der Person, oder der Abteilung, oder der Klinik, usw. in das Feld "<span style="background-color:yellow" > Name </span>" ein.<br>
 	<b>Schritt 2: </b>Geben Sie den Benutzerkennung bzw. Benutzername in das Feld "<span style="background-color:yellow" > Benutzerkennung </span>" ein.<p>
	<b>Achtung!</b> Leerzeichen is nicht erlaubt für Benutzerkennung.<p>
 	<b>Schritt 3: </b>Geben Sie das Passwort in das Feld "<span style="background-color:yellow" > Passwort </span>" ein.<br>
 	<b>Schritt 4: </b>Wähle die Bereiche aus den Auswahlfeldern   "<span style="background-color:yellow" > Bereich # </span>" aus wo der 
	Benutzer eine Zugangsberechtigung haben soll.<p>
	<b>Achtung!</b> Ein Benutzer kann maximal 10 Bereiche haben.<p>
</ul>

	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ich bin fertig. Wie kann ich die Daten speichern?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt den  <input type="button" value="Speichern"> Knopf an.<br>
</ul>
	<?php endif; ?>	
	<?php if($x1=="save") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Die Zugangsberechtigung is jetzt gespeichert. Wie erschaffe ich eine neue?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt den <input type="button" value="OK"> Knopf an.<br>
 	<b>Schritt 2: </b>Ein neues Eingabeformular wird gezeigt.<br>
 	<b>Schritt 3: </b>Klickt den "Hilfe" Knopf an um weitere Hilfsanweisung zu lesen.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie kann ich alle Zugangsberechtigungen aufgelistet sehen?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt den <input type="button" value="Aktuelle Zugangsberechtigungen auflisten"> Knopf an.<br>
 	<b>Schritt 2: </b>Alle Zugangsberechtigungen werden gezeigt.<br>
</ul>
	
	<?php endif; ?>	
	<?php if($x1=="list") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Was bedeuten die beiden Knöpfe <img <?php echo createComIcon('../','padlock.gif','0','absmiddle') ?>> und <img <?php echo createComIcon('../','arrow-gr.gif','0','absmiddle') ?>> ?</b>
</font>
<ul>       	
 	<img <?php echo createComIcon('../','padlock.gif','0','absmiddle') ?>> = Die Zugangsberechtigung ist gesperrt. Der Benutzer hat kein Zugang zu den Bereichen.<br>
 	<img <?php echo createComIcon('../','arrow-gr.gif','0','absmiddle') ?>> = Die Zugangsberechtigung ist freigegeben. Der Benutzer hat Zugang zu den Bereichen.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Was bedeuten die Optionen "A", "S", "L", und "F" ?</b>
</font>
<ul>       	
 	<b>Ä: </b> = Ändern oder Bearbeiten.<br>
 	<b>S: </b> = Sperren.<br>
 	<b>L: </b> = Löschen.<br>
 	<b>F: </b> = Freigabe oder Sperre aufheben.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie kann ich die Zugangsberechtigung ändern bzw. bearbeiten?</b>
</font>
<ul>       	
 	Klickt die Option "<span style="background-color:yellow" > Ä </span>" an.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie kann ich die Zugangsberechtigung sperren?</b>
</font>
<ul>       	
 	Klickt die Option "<span style="background-color:yellow" > S </span>" an.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie kann ich die Sperre aufheben?</b>
</font>
<ul>       	
 	Klickt die Option "<span style="background-color:yellow" > F </span>" an.<br>
</ul>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie kann ich die Zugangsberechtigung löschen?</b>
</font>
<ul>       	
 	Klickt die Option "<span style="background-color:yellow" > L </span>" an.<br>
</ul>

	<?php endif; ?>	
	
	<?php if($x1=="update") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie kann ich eine Zugangsberechtigung ändern?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Bearbeiten Sie die Information.<br>
 	<b>Schritt 2: </b>Anschliessend klicken Sie den <input type="button" value="Speichern"> Knopf an.<br>
</ul>
	<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b>
Achtung!</b>
</font>
<ul>       	
 	Wenn Sie nicht bearbeiten möchten klicken Sie den <input type="button" value="Abbrechen"> Knopf an.<br>
</ul>
	
	<?php endif; ?>		
	<?php if($x1=="delete") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie lösche ich eine Zugangsberechtigung?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Wenn Sie sicher sind die Zugangsberechtigung zu löschen,<br>
	 klicken Sie den <input type="button" value="Ja, ich bin sicher. Berechtigung löschen."> Knopf an.<br>
</ul>
	<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b>
Achtung!</b>
</font>
<ul>       	
 	Wenn Sie nicht löschen möchten klicken Sie den <input type="button" value="Nein. Zurück."> Knopf an.<br>
</ul>
	
	<?php endif; ?>		
	
	<?php if($x1=="lock") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie kann ich eine  <?php if($x2=="0") print "Zugangsberechtigung sperren"; else print "Sperre aufheben"; ?>?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Wenn Sie sicher sind die <?php if($x2=="0") print "Zugangsberechtigung zu sperren"; else print "Sperre aufzuheben"; ?>,<br>
	 klicken Sie den <input type="button" value="Ja, ich bin sicher."> Knopf an.<br>
</ul>
	<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b>
Achtung!</b>
</font>
<ul>       	
 	Wenn Sie <?php if($x2=="0") print "nicht sperren"; else print "die Sperre nicht aufheben"; ?> möchten
	 klicken Sie den  <input type="button" value="Nein. Zurück."> Knopf an.<br>
</ul>
	
	<?php endif; ?>		
<?php endif;?>	

	</form>

