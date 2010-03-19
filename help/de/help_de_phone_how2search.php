<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Wie
<?php
switch($x1)
{
 	case "search": print 'suche ich nach einer Telefonnummer?'; break;
	case "dir": print 'öffne ich das Telefonverzeichnis?';break;
	case "newphone": print 'trage ich eine neue Telefonnumer ein?';break;
 }
 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<?php if($x1=="search") { ?>
	<?php if($src=="newphone") { ?>
	<b>Schritt 1</b>
	<ul> Klicken Sie auf <img <?php echo createLDImgSrc('../','such-gray.gif','0') ?>>.
	</ul>
	<?php } ?>
<b>Schritt <?php if($src=="newphone") print "2"; else print "1"; ?></b>

<ul> Geben Sie in das Suchfeld "<span style="background-color:yellow" >Ihr Suchbegriff</span>"
entweder eine vollständige Information oder die ersten paar Buchstaben/Zeichen ein, wie zum Beispiel
die Stations- / Abteilungsnummer, einen Vor-/ Nachnaman, eine Raumnummer ein.
		<br>Beispiel 1: Geben Sie  "m9a" oder "M9A" oder "M9" ein.
		<br>Beispiel 2: Geben Sie  "Guerero" oder "gue" ein.
		<br>Beispiel 3: Geben Sie  "Alfredo" oder "Alf" ein.
		<br>Beispiel 4: Geben Sie  "op11" oder "OP11" oder "op" ein.

</ul>
<b>Schritt <?php if($src=="newphone") print "3"; else print "2"; ?></b>
<ul> Zum Starten der Suche klicken Sie auf <input type="button" value="SEARCH">.<p>
</ul>
<b>Schritt <?php if($src=="newphone") print "4"; else print "3"; ?></b>
<ul> Wenn die Suche erfolgreich ist, wird Ihnen eine Liste der Ergebnisse angezeigt.<p>
</ul>
<?php } ?>

<?php if($x1=="dir") { ?>
<b>Schritt 1</b>
<ul> Klicken Sie auf <img <?php echo createLDImgSrc('../','phonedir-gray.gif','0') ?>>.
</ul>
<?php
}

 if($x1=="newphone") {
	 if($src=="search") {
?>
<b>Schritt 1</b>
<ul> Klicken Sie auf <img <?php echo createLDImgSrc('../','newdata-gray.gif','0') ?>>.
</ul>
<b>Schritt 2</b>
<ul> Wenn Sie eingeloggt und für diese Funktion zugriffsberechtigt sind, wird Ihnen das Eintragsformular für
neue Telefon-Informationen angezeigt.<br>
	Ansonsten, wenn Sie nicht eingeloggt sind, erscheint eine Eingabeaufforderung für Ihren Benutzernamen und
	Ihr Passwort.<p>
	<?php } ?>
		Geben Sie Benutzernamen und Passwort ein und klicken Sie auf <img <?php echo createLDImgSrc('../','continue.gif','0') ?>>.<p>

</ul>
<?php } ?>

<b>Anmerkung</b>
<ul> Zum Abbrechen
<?php
switch($x1)
{
 	case "search": print ' der Suche klicken Sie auf <img '.createLDImgSrc('../','cancel.gif','0').'>.'; break;
	case "dir": print ' des Verzeichnisses klicken Sie auf <input type="button" value="Cancel">.';break;
	case "newphone": print ' klicken Sie auf <img '.createLDImgSrc('../','cancel.gif','0').'>.';break;
 }
 ?>
</ul>

</form>

