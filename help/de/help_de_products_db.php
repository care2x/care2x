<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
<?php
if($x2=="pharma") print "Apotheke - "; else print "Medicallager - ";
	switch($src)
	{
	case "input": if($x1=="update") print "Aktualisieren von Produktinformation";
                         else print "Eingabe von neuen Produkten in die Datenbank";
					break;
	case "search": print "Suchen nach einem Produkt";
					break;
	case "mng": print "Verwaltung von Produkten in der Datenbank";
					break;
	case "delete": print "Entfernen von Produkten aus der Datenbank";
					break;
	case "report": print "Bericht";
					break;
	}


 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >

	

<?php if($src=="input") : ?>
	<?php if($x1=="") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie gebe ich ein neues Produkt in die Datenbank ein?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Gibt zuerst alle vorhandene Information über das Produkt in die entsprechende Eingabefelder ein.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie wähle ich ein Bild für das Produkt aus?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt den <input type="button" value="Durchsuchen..."> Knopf am Feld "<span style="background-color:yellow" > Bilddatei </span>" an.<br>
 	<b>Schritt 2: </b>Ein kleines Fenster zum auswählen von Dateien öffnet sich. Wähle die gewünschte Bilddatei aus und klickt "OK" an.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ich habe alle Information eingegeben. Wie kann ich sie speichern?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt den <input type="button" value="Speichern"> Knopf an.<br>
</ul>
	<?php endif;?>	
	<?php if($x1=="save") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie gebe ich ein neues Produkt in die Datenbank ein?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt den <input type="button" value="Neue Eingabe"> Knopf an.<br>
 	<b>Schritt 2: </b>Das Eingabeformular wird eingeblendet.<br>
 	<b>Schritt e: </b>Gibt  alle vorhandene Information über das Produkt in die entsprechende Eingabefelder ein.<br>
 	<b>Schritt 4: </b>Klickt den <input type="button" value="Speichern"> Knopf an.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie kann ich die Information des Produkts bearbeiten bzw. aktualisieren?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt den <input type="button" value="Ändern bzw. aktualisieren"> Knopf an.<br>
 	<b>Schritt 2: </b>Die Information über das Produkt wird automatisch in Eingabefelder eingegeben.<br>
 	<b>Schritt 3: </b>Sie können jetzt die Information ändern, ergänzen, löschen, usw.<br>
 	<b>Schritt 4: </b>Klickt den <input type="button" value="Speichern"> Knopf an um die aktuelle Änderung zu speichern.<br>
</ul>
	
	<?php endif;?>	
	<?php if($x1=="update") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie kann ich die Information des Produkts bearbeiten bzw. aktualisieren?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Falls nötig löschen Sie zuerst die alte Information aus dem betroffenen Feld.<p>
 	<b>Schritt 2: </b>Geben Sie die aktuelle Information in das entsprechende Feld ein.<p>
 	<b>Schritt 3: </b>Klickt den <input type="button" value="Speichern"> Knopf an um die aktuelle Änderung zu speichern.<br>
</ul>
	<?php endif;?>	
<?php endif;?>	

<?php if($src=="search") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie finde ich ein Produkt?</b>
</font>
<ul>       	
 
 	<b>Schritt 1: </b>	Gibt entweder eine vollständige Information oder die erste Zeichen von dem Markennamen des Artikels, oder seinem Generic, oder seiner Bestellnummer, usw. in das Feld
				<nobr><span style="background-color:yellow" >" Suchbegriff für den Artikel: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> ein.<br>
 	<b>Schritt 2: </b>Klickt den <input type="button" value="Suchen"> Knopf an um den Artikel zu suchen.<br>
 	<b>Schritt 3: </b>Wenn die Suche einen Artikel findet der dem Suchbegriff exakt anspricht, werden alle Information über den Artikel gezeigt.<br>
 	<b>Schritt 4: </b>Wenn mehrere Artikel gefunden werden, wird eine Liste gezeigt.<br>
</ul>
	<?php if($x1!="multiple") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Mehrere Artikel sind aufgelistet. Wie kann ich die komplette Information eines Artikels sehen?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt entweder den Namen des Artikels oder das Symbol <img <?php echo createComIcon('../','info3.gif','0') ?>> an.<br>
</ul>
	<?php endif;?>
	<?php if($x1=="multiple") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ich möchte die leztet Liste der Artikel noch mal sehen. Was soll ich tun?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt den <input type="button" value="Zurück"> Knopf an.<br>
</ul>
	<?php endif;?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Achtung!</b></font> 
<ul>       	
Wenn Sie abbrechen möchten klickt den <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> Knopf an.
</ul>

<?php endif;?>

<?php if($src=="mng") : ?>
	<?php if(($x3=="1")&&($x1!="multiple")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie bearbeite ich die Information eines Produkts?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Bearbeite die Information.<br>
 	<b>Schritt 2: </b>Klickt den <input type="button" value="Speichern"> Knopf an um die aktuelle Änderung zu speichern.<br>
</ul>
	<?php endif;?>

	<?php if($x1=="multiple") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie kann ich die Information des Produkts der gerade gezeigt wird bearbeiten bzw. aktualisieren?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt den <input type="button" value="Ändern bzw. aktualisieren"> Knopf an.<br>
 	<b>Schritt 2: </b>Die Information über das Produkt wird automatisch in Eingabefelder eingegeben.<br>
 	<b>Schritt 3: </b>Sie können jetzt die Information ändern, ergänzen, löschen, usw.<br>
 	<b>Schritt 4: </b>Klickt den <input type="button" value="Speichern"> Knopf an um die aktuelle Änderung zu speichern.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie entferne ich das Produkt der gerade gezeigt wird aus der Datenbank?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt den <input type="button" value="Aus der Datenbank entfernen bzw. löschen"> Knopf an.<br>
 	<b>Schritt 2: </b>Sie werden nach einer Bestätigung gefragt.<br>
 	<b>Schritt 3: </b>Wenn Sie sicher sind das Produkt zu löschen, klickt den<input type="button" value="Ja, ich bin sicher. Daten löschen."> Knopf an.<p>
 	<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Achtung!</b></font> Das Entfernen von Produkten lässt sich nicht rückgängig machen.<br>
</ul>	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ich möchte das Produkt NICHT aus der Datenbank entfernen. Was soll ich jetzt tun?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt die Option "<span style="background-color:yellow" > << Nein, zurück </span>" an.<br>
</ul>	
<?php endif;?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie verwalte ich ein Produkt in der Datenbank?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Suche zuerst den Artikel. 
	Gibt entweder eine vollständige Information oder die erste Zeichen von dem Markennamen des Artikels, oder seinem Generic, oder seiner Bestellnummer, usw. in das Feld
				<nobr><span style="background-color:yellow" >" Geben Sie einen Suchbegriff ein: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> ein.<br>
 	<b>Schritt 2: </b>Klickt den <input type="button" value="Artikel suchen"> Knopf an um den Artikel zu suchen.<br>
 	<b>Schritt 3: </b>Wenn die Suche einen Artikel findet der dem Suchbegriff exakt anspricht, werden alle Information über den Artikel gezeigt.<br>
 	<b>Schritt 4: </b>Wenn mehrere Artikel gefunden werden, wird eine Liste gezeigt.<br>
</ul>
	<?php if(($x1!="multiple")&&($x3=="")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Mehrere Artikel sind aufgelistet. Wie kann ich die komplette Information eines Artikels sehen?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt entweder den Namen des Artikels oder das Symbol <img <?php echo createComIcon('../','info3.gif','0') ?>> an.<br>
</ul>
	<?php endif;?>
	<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Achtung!</b></font> 
<ul>       	
Wenn Sie abbrechen möchten klickt den <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> Knopf an.
</ul>
<?php endif;?>



<?php if($src=="delete") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie entferne ich das Produkt der gerade gezeigt wird aus der Datenbank?</b>
</font>
<ul>       	
 	<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Achtung!</b></font> Das Entfernen von Produkten lässt sich nicht rückgängig machen.<p>
  	<b>Schritt 1: </b>Wenn Sie sicher sind das Produkt zu löschen, klickt den<input type="button" value="Ja, ich bin sicher. Daten löschen."> Knopf an.<p>

</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ich möchte das Produkt NICHT aus der Datenbank entfernen. Was soll ich jetzt tun?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt die Option "<span style="background-color:yellow" > << Nein, zurück </span>" an.<br>
</ul>	
<ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Achtung!</b><br></font> 
       	
Wenn Sie abbrechen möchten klickt den <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> Knopf an.
</ul>

<?php endif;?>	

<?php if($src=="report") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie schreibe ich einen Bericht?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Schreibe den Bericht  in das Feld
				<nobr><span style="background-color:yellow" >" Bericht: <input type="text" name="s" size=10 maxlength=10> "</span></nobr>.<br>
 	<b>Schritt 2: </b>Gibt Ihren Namen  in das Feld
				<nobr><span style="background-color:yellow" >" Verfasser: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> ein.<br>
 	<b>Schritt 3: </b>Gibt Ihre Personalnummer in das Feld
				<nobr><span style="background-color:yellow" >" Personalnummer: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> ein.<br>
 	<b>Schritt 4: </b>Klickt den <input type="button" value="Senden"> Knopf an um den Bericht zu senden.<br>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Achtung!</b><br></font> 
       	
Wenn Sie abbrechen bzw. beenden möchten klickt den <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> Knopf an.
</ul>
<?php endif;?>	
</form>

