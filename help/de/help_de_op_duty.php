<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
?>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>?</title>

</head>
<body>
<form >
<font face="Verdana, Arial" size=2>
<font  size=3 color="#0000cc">
<b>

<?php
	switch($src)
	{
		case "show": print "Dienstplan";
							break;
		case "quick": print "Dienstplan - Schnellsicht";
							break;
		case "plan": print "Dienstplan erstellen";
							break;
		case "personlist": print "Personalliste erstellen";
							break;
		case "dutydoc": print "Dokumentation der Arbeitsleistung im Dienst";
							break;
	}
?>
</b>
</font>
<p>

<?php if($src=="quick") : ?>
<p>
<font color="#990000" face="Verdana, Arial">Was kann ich hier sehen?</font></b><p>
<font face="Verdana, Arial" size=2>
<img <?php echo createComIcon('../','update.gif','0','absmiddle') ?>><b> Sie können zusätzliche Information (falls vorhanden) über die diensthabende Schwester/Pfleger lesen.</b>
<ul>Um zusätzliche Information zu sehen , die <span style="background-color:yellow" >Name des Diensthabenden</span> anklicken. Ein kleines Fenster mit der relevanten Information wird sich öffnen .</ul><p>
<img <?php echo createComIcon('../','update.gif','0','absmiddle') ?>><b> Sie können den Dienstplan für einen ganzen Monat sehen.</b>
<ul>Um den Dienstplan eines ganzen Monats zu sehen, den entsprechenden Knopf &nbsp;<button><img <?php echo createComIcon('../','new_address.gif','0','absmiddle') ?>> <font size=1>Zeigen</font></button> anklicken.<br>
			Der Dienstplan wird eingeblendet.</ul><p>
<font face="Verdana, Arial" size=3 color="#990000">
<p><b>Was will die Schnellsicht mir sagen?</b></font></b><p>
<font face="Verdana, Arial" size=2>
</b><li><b>OP Abteilung</b> :<ul>Die Liste von Abteilungen die diensthabende Pflegekräfte haben</ul><p>
<li><b>Arzt 1</b> :<ul>Der Bereitschaftsdienst.</ul><p>
<li><b>Funk/Telefon</b> :<ul>Funk und Telefonnummer des Bereitschaftsdienstes.</ul>
<li><b>Arzt 2</b> :<ul>Der Rufdienst.</ul><p>
<li><b>Funk/Telefon</b> :<ul>Funk und Telefonnummer des Rufdienstes.</ul><p>
<li><b>Dienstplan</b> :<ul> Verbindung zum Monatsdienstplan einer Abteilung. Diesen Knopf&nbsp;<button><img <?php echo createComIcon('../','new_address.gif','0','absmiddle') ?>> <font size=1>Zeigen</font></button>
			 anklicken wenn Sie den Dienstplan aktualisieren bzw. erstellen oder ändern möchten.</ul>


<?php endif;?>
<?php if($src=="show") : ?>
<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Ich möchte einen neuen Dienstplan für diesen Monat erstellen.</b></font>
<ul> <b>Schritt 1: </b>Den <img <?php echo createLDImgSrc('../','newplan.gif','0') ?> > anklicken.<br>
</ul>
<ul><b>Schritt 2:</b>
Wenn Sie sich vorher angemeldet haben und ein Zugangsrecht in dieser Funktion haben wird das Eingabeformular eingeblendet.<p>
		Ansonsten werden Sie nach Ihrem Benutzernamen und Passwort gefragt.<p>
		Geben Sie Ihren Benutzernamen und Passwort ein und klicken Sie den <img <?php echo createLDImgSrc('../','continue.gif','0') ?>> an.<br>
		Falls Sie abbrechen möchten den <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> anklicken.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Ich möchte einen neuen Dienstplan für einen anderen Monat erstellen.</b></font>
<ul> <b>Schritt 1: </b>Clicken Sie den "Monat" so oft an bis den gewünschten Monat angezeigt wird. <br>
								Klicken Sie den "Monat" auf der rechten Seite an um den nächsten Monat zu zeigen.<br>
								Klicken Sie den "Monat" auf der linken Seite an um den vorherigen Monat zu zeigen.<br>
		<b>Schritt 2: </b>Folgen Sie den Anweisungen wie man einen neuen Dienstplan erstellt.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Ich möchte die Schnellsicht nochmal sehen.</b></font>
<ul> <b>Schritt 1: </b>Den <img <?php echo createLDImgSrc('../','close2.gif','0') ?> > anklicken.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Ich möchte die Funk bzw. Telefonnummer des Diensthabenden sehen. </b></font>
<ul> <b>Schritt 1: </b><span style="background-color:yellow" >Klicken Sie den Namen an.</span>  Ein kleines Fenster mit der relevanten Information wird sich öffnen.<br>
</ul>


<b>Achtung!</b>
<ul> Falls Sie den Dienstplan schliessen möchten den <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> anklicken.
</ul>
<?php endif;?>
<?php if($src=="plan") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ich möchte eine Schwester bzw. einen Pfleger einplanen anhand der Personalliste. Wie geht das?</b></font>
<ul> <b>Schritt 1: </b>Den  &nbsp;<button><img <?php echo createComIcon('../','patdata.gif','0') ?>></button> Knopf des entsprechenden Tages anklicken um die Personalliste zu öffnen. <br>
			Ein kleines Fenster mit der Personalliste wird sich öffnen .<br>
			<ul type=disc>
			<li>Um eine Schwester bzw. einen Pfleger in Anwesenheitsdienst einzuplanen klicken Sie den Knopf auf der linken Spalte an.<br>
			<li>Um eine Schwester bzw. einen Pfleger in Rufdienst einzuplanen klicken Sie den Knopf auf der rechten Spalte an.<br>
			</ul>
		<b>Schritt 2: </b><span style="background-color:yellow" >Den Namen der Schwester/Pfleger</span> in der Personalliste anklicken um ihn in den Dienstplan zu übertragen.<br>
		<b>Schritt 3: </b>Falls Sie den falschen Namen angeklickt haben wiederholen Sie den Schritt 2.<br>
		<b>Schritt 4: </b>Wenn Sie fertig sind den <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> Knopf in der Personalliste anklicken.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ich möchte eine Schwester bzw. einen Pfleger manuell einplanen. Wie geht das?</b></font>
<ul> <b>Schritt 1: </b>Das Eingabefeld  "<input type="text" name="t" size=11 maxlength=4 >" des entsprechenden Tages anklicken.<br>
		<b>Schritt 2: </b>Tippen Sie den Namen manuell ein. <br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ich möchte eine Schwester bzw. einen Pfleger aus dem Dienstplan entfernen. Wie geht das?</b></font>
<ul> <b>Schritt 1: </b>Das Eingabefeld  "<input type="text" name="t" size=11 maxlength=4 >" des entsprechenden Namen anklicken.<br>
		<b>Schritt 2: </b>Entfernen Sie manuell den Namen. Benutzen Sie dafür die Tasten "Ent" oder "Rücktaste" der Tastatur.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Wie kann ich den plan speichern?</b></font>
<ul> <b>Schritt 1: </b>Den <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> Knopf anklicken.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Ich habe den Plan gespeichert und ich möchte jetzt beenden. Was soll ich tun? </b></font>
<ul> <b>Schritt 1: </b>Wenn Sie fertig sind den <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> Knopf anklicken. <br>
</ul>

</font>
<?php endif;?>
<?php if($src=="personlist") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Die angezeigte Abteilung is falsch. Wie kann ich die richtige Abteilung zeigen lassen.</b></font>
<ul> <b>Schritt 1: </b>Wählen Sie die richtige Abteilung aus dem Feld <nobr>"<span style="background-color:yellow" >Abteilung wechseln: </span><select name="s">
                                                                     	<option value="Beispiel Abteilung 1" selected> Beispiel Abteilung 1</option>
                                                                     	<option value="Beispiel Abteilung 2"> Beispiel Abteilung 2</option>
                                                                     	<option value="Beispiel Abteilung 3"> Beispiel Abteilung 3</option>
                                                                     	<option value="Beispiel Abteilung 4"> Beispiel Abteilung 4</option>
                                                                     </select>"</nobr> aus.
                                                                     <br>
		<b>Schritt 2: </b>Den <input type="button" value="Wechseln"> Knopf anklicken um die richtige Abteilung zeigen zu lassen.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ich möchte einen Namen aus der Liste entfernen. Wie geht das?</b></font>
<ul> <b>Schritt 1: </b>Das Eingabefeld "<input type="text" name="t" size=11 maxlength=4 value="Name">" des Namens anklicken.<br>
		<b>Schritt 2: </b>Entfernen Sie manuell den Namen. Benutzen Sie dafür die Tasten "Entf" oder "Rücktaste" der Tastatur.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Wie kann ich die Liste speichern</b></font>
<ul> <b>Schritt 1: </b>Den <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> Knopf anklicken.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Ich habe die Liste gespeichert und möchte jetzt beenden. Was soll ich tun? </b></font>
<ul> <b>Schritt 1: </b>Wenn Sie fertig sind den <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> Knopf anklicken. <br>
</ul>

<?php endif;?>
<?php if($src=="dutydoc") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie dokumentiere ich die Arbeitsleistung im Dienst?</b></font>
<ul> <b>Schritt 1: </b>Gibt das Datum in das Feld " Datum <input type="text" name="d" size=10 maxlength=10> " ein.<p>
	<ul>
		<b>Tipp:</b> Geben Sie entweder "h" oder "H" (bedeutet HEUTE) in das Feld ein um das heutige Datum automatisch zeigen zu lassen.<br>
		<b>Tipp:</b> Geben Sie entweder "g" oder "G" (bedeutet GESTERN) in das Feld ein um das Datum  von gestern automatisch zeigen zu lassen.<br>
		</ul>
		<b>Schritt 2: </b>Gibt den Namen des Diensthabenden in das Feld <nobr>"<span style="background-color:yellow" >Name, Vorname <input type="text" name="d" size=20 maxlength=10> </span>"</nobr> ein.<br>
 <b>Schritt 3: </b>Gibt die Uhrzeit des Arbeitsbeginns in das Feld "<span style="background-color:yellow" > Von <input type="text" name="d" size=5 maxlength=5> </span>" ein.<br>
 <b>Schritt 4: </b>Gibt die Uhrzeit des Arbeitsende in das Feld "<span style="background-color:yellow" > Bis <input type="text" name="d" size=5 maxlength=5> </span>" ein.<p>
	<ul> 
	<b>Tip: </b>Geben Sie entweder "j" oder "J" (bedeutet JETZT) in das Feld ein um die aktuelle Zeit automatisch zeigen zu lassen.<p>
		</ul>
 <b>Schritt 5: </b>Gibt den OP Saal in das Feld "<span style="background-color:yellow" > OP Saal <input type="text" name="d" size=5 maxlength=5> </span>" ein.<br>
 <b>Schritt 6: </b>Gibt die Diagnose, Therapie, oder OP Art in das Feld  <nobr>"<span style="background-color:yellow" > Diagnose & Therapie <input type="text" name="d" size=5 maxlength=5> </span>"</nobr> ein.<br>
 <b>Schritt 7: </b>Gibt den Namen des Anwesenheitsdienstes in das Feld <nobr>"<span style="background-color:yellow" > Anwesenheit: <input type="text" name="d" size=5 maxlength=5> </span>"</nobr> ein.<br>
 <b>Schritt 8: </b>Gibt den Namen des Rufdienstes in das Feld <nobr>"<span style="background-color:yellow" > Rufdienst: <input type="text" name="d" size=5 maxlength=5> </span>"</nobr> ein.<br>
 <b>Schritt 1: </b>Den <input type="button" value="Speichern"> Knopf anklicken um das Dokument zu speichern.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Wie drucke ich das Dokument aus?</b></font>
<ul> <b>Schritt 1: </b>Klickt den <input type="button" value="Drucken"> Knopf an und ein Fenster öffnet sich.<br>
	<b>Schritt 2: </b>Folgen Sie die Anweisung im Fenster.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Ich habe das Dokument gespeichert. Was mache ich jetzt? </b></font>
<ul> <b>Schritt 1: </b>Wenn Sie fertig sind klickt den <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> Knopf an. <br>
</ul>
<?php endif;?>

</form>
</body>
</html>
