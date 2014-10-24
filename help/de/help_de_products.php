<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
?>
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
<?php
if($x2=="pharma") print "Apotheke - "; else print "Medicallager - ";
	switch($src)
	{
	case "head": if($x2=="pharma") print "Bestellung von Arzneimittel"; 
						else print "Bestellung von Produkten";
						break;
	case "catalog": print "Bestellkatalog";
						break;
	case "orderlist": print "Bestellkorb (Bestellungsliste";
						break;
	case "final": print "Endgultige Bestelliste";
						break;
	case "maincat": print "Bestellkatalog";
						break;
	case "arch": print "Bestellungsarchiv";
						break;
	case "archshow": print "Bestellungsarchiv";
						break;
	case "db": switch($x3)
					{
						case "input": print "Eingabe von neuen Produkten in die Datenbak";
						break;
					}
					break;
	case "how2":print "Wie bestelle ich ";
						  if($x2=="pharma") print "Arzneimittel"; else print "Produkte";
	}


 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<?php if($src=="maincat") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie stelle ich einen Artikel in den Bestellkatalog?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Suche zuerst den Artikel. 
	Gibt entweder eine vollständige Information oder die erste Zeichen von dem Markennamen des Artikels, oder seinem Generic, oder seiner Bestellnummer, usw. in das Feld
				<nobr><span style="background-color:yellow" >" Geben Sie einen Suchbegriff ein: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> ein.<br>
 	<b>Schritt 2: </b>Klickt den <input type="button" value="Artikel suchen"> Knopf an um den Artikel zu suchen.<br>
 	<b>Schritt 3: </b>Wenn die Suche einen Artikel findet der dem Suchbegriff exakt anspricht, werden alle Information über den Artikel gezeigt.<br>
 	<b>Schritt 4: </b>Klickt den <input type="button" value="Diesen Artikel in den Katalog stellen"> Knopf an um den Artikel in den Katalog zu stellen.<p>
 	<b>Achtung! </b>Wenn Sie den Artikel nicht möchten suchen Sie einfach weiter.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie suche ich weiter?</b>
</font>
<ul>       	
 	Folge die oben beschriebene Anweisungen um nach einem Artikel zu suchen.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Die Suche liefert mehrere Artikel die dem Suchbegriff annähernd ansprechen. Was soll ich tun?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Wenn mehrere Artikel gefunden werden, wird eine Liste gezeigt.<br>
 	<b>Schritt 2: </b>Klickt den <img <?php echo createComIcon('../','dwnarrowgrnlrg.gif','0') ?>> Knopf des Artikels. Der Artikel wird in den Katalog gestellt.<br>
 	<b>Schritt 3: </b>Wenn Sie vorher die Information über den Artikel sehen möchten, klickt entweder seinen Namen oder das Symbol <img <?php echo createComIcon('../','info3.gif','0') ?>> an.<br>
 	<b>Schritt 4: </b>Die komplette Information über den Artikel wird gezeigt.<br>
 	<b>Schritt 4: </b>Klickt den <input type="button" value="Diesen Artikel in den Katalog stellen"> Knopf an um den Artikel in den Katalog zu stellen.<p>
</ul>
	

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ich möchte mehr Information über den Artikel sehen. Was soll ich tun?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt das Symbol <img <?php echo createComIcon('../','info3.gif','0') ?>> an.<br>
 	<b>Schritt 2: </b>Die komplette Information über den Artikel wird gezeigt.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie entferne ich einen Artikel aus dem Katalog?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt den <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> Knopf des Artikels an.<br>
</ul>

<?php endif;?>

<?php if($src=="how2") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie bestelle ich <?php if($x2=="pharma") print "Arzneimittel"; else print "Produkte aus dem Medicallager"; ?>?
</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt die Option "<span style="background-color:yellow" > <img <?php echo createComIcon('../','bestell.gif','0') ?>> <?php if($x2=="pharma") print "Apothekenbestellung"; else print "Bestellung"; ?> </span>" an um in den Bestellmodus zu gehen.<br>
 	<b>Schritt 2: </b>Wenn Sie sich vorher angemeldet haben werden die Bestellkorb und Bestellkatalog gezeigt. Ansonsten werden Sie nach Ihrem
	Benutzernamen und Passwort gefragt.<br>

 	<b>Schritt 3: </b>Falls erforderlich geben Sie Ihren Benutzernamen und Passwort ein. Klickt den <img <?php echo createLDImgSrc('../','continue.gif','0') ?>> Knopf an.<br>
 	<b>Schritt 4: </b>Sie können dann eine Bestellungsliste erstellen. Auf dem rechten Rahmen sehen Sie den Bestellkatalog von Ihrer Abteilung, oder Station, oder OP Saal, usw.<p>
 	<b>Schritt 5: </b>Wenn der Artikel den Sie bestellen möchten in der Katalogliste ist, klickt seinen <img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>> Knopf an um  in den Bestellkorb auf dem linken Rahmen <b>ein Stück</b> von dem Artikel zu stellen.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ich möchte aber mehr als ein Stück von dem Artikel in den Bestellkorb stellen. Wie geht das?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt den Checkbox <input type="checkbox" name="a" value="a" checked> des Artikels im Katalog an.<br>
 	<b>Schritt 2: </b>Gibt die Stückzahl in das Feld " Stück <input type="text" name="d" size=2 maxlength=2> " ein.<br>
 	<b>Schritt 3: </b>Klickt den <input type="button" value="In den Bestellkorb stellen"> Knopf an um den Artikel in den Bestellkorb zu stellen.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Der Artikel den ich brauche ist nicht im Katalog. Was soll ich tun?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Sie müssen den Artikel suchen. 
	Gibt entweder eine vollständige Information oder die erste Zeichen von dem Markennamen des Artikels, oder seinem Generic, oder seiner Bestellnummer, usw. in das Feld
				<nobr><span style="background-color:yellow" >" Suchbegriff für den Artikel: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> ein.<br>
 	<b>Schritt 2: </b>Klickt den <input type="button" value="Artikel suchen"> Knopf an um den Artikel zu suchen.<br>
 	<b>Schritt 3: </b>Wenn die Suche ein Artikel bzw. mehrere Artikel findet, wird eine Liste gezeigt.<br>
 	<b>Schritt 4: </b>Wenn Sie nur ein Stück von dem Artikel bestellen möchten, klickt den <img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>> Knopf an. 
	Der Artikel wird in den Bestellkorb gestellt. Gleichzeitig wird er auch in den Katalog gestellt.<br>
 	<b>Schritt 5: </b>Wenn Sie den Artikel nur in den Katalog stellen möchten, klickt den <img <?php echo createComIcon('../','dwnarrowgrnlrg.gif','0') ?>> Knopf an.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ich möchte mehr Information über den Artikel sehen. Was soll ich tun?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt entweder den Namen des Artikels oder das Symbol <img <?php echo createComIcon('../','info3.gif','0') ?>> an.<br>
 	<b>Schritt 2: </b>Ein Fenster mit der Information über den Artikel öffnet sich.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie entferne ich einen Artikel aus dem Katalog?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt den <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> Knopf des Artikels an.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Kann ich die Stückzahl des Artikels im Bestellkorb ändern?
</b>
</font>
<ul>       	
 	<b>Ja.</b> Überschreibe einfach die Eingabe mit der neuen Stückzahl.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Alle Artikel zum Bestellen sind jetzt im Bestellkorb. Was soll ich jetzt tun?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Sende die Bestellungsliste in  <?php if($x2=="pharma") print "die Apotheke"; else print "den Medicallager"; ?>. 
	<br>Klickt den <input type="button" value="Endgültige Bestellungsliste erstellen"> Knopf an um weiter zu gehen.<br>
 	<b>Schritt 2: </b>Die Bestellungsliste wird wieder gezeigt. Gibt Ihren Namen in das Feld <nobr>"<span style="background-color:yellow" > Erstellt von <input type="text" name="c" size=15 maxlength=10> </span>"</nobr> ein.<br>
 	<b>Schritt 3: </b>Wähle die Prioritätklasse der Bestellung zwischen "<span style="background-color:yellow" > Normal<input type="radio" name="x" value="s" checked> Eilig<input type="radio" name="x" > </span>" aus. Klickt den entsprechenden Knopf an.<br>
 	<b>Schritt 4: </b>Der Arzt muss seinen Namen in das Feld  <nobr>"<span style="background-color:yellow" > Bestätigt von <input type="text" name="c" size=15 maxlength=10> </span>"</nobr> eingeben.<br>
 	<b>Schritt 5: </b>Der Arzt muss sein Passwort in das Feld <nobr>"<span style="background-color:yellow" > Passwort: <input type="text" name="c" size=15 maxlength=10> </span>"</nobr> eingeben.<br>
 	<b>Schritt 6: </b>Klickt den <input type="button" value="Bestellungsliste an <?php if($x2=="pharma") print "die Apotheke"; else print "den Medicallager"; ?> senden"> Knopf an.<br>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Achtung!</b></font> 
<ul>       	
Wenn Sie die Bestellungsliste nicht senden möchten klicken Sie die Option "<span style="background-color:yellow" > << Zurück und noch mal bearbeiten </span>" an.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ich möchte die Bestellung beenden. Wie geht das?</b>
</font>
<ul>     
 	<b>Schritt 1: </b>Klickt die Option "<span style="background-color:yellow" > <img <?php echo createComIcon('../','arrow-blu.gif','0') ?>> Bestellung beenden und verlassen</span>" an um in <?php if($x2=="pharma") print "die Apotheke"; else print "den Medicallager"; ?> zurück zu gehen.<br>
</ul>	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie erstelle ich eine neue Bestellungsliste?</b>
</font>
<ul>     
 	<b>Schritt 1: </b>Klickt die Option "<span style="background-color:yellow" > <img <?php echo createComIcon('../','arrow-blu.gif','0') ?>> Eine neue Bestellungsliste erstellen bzw. einen leeren Bestellkorb erzeugen </span>" an.<br>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Achtung!</b></font> 
<ul>       	
 Sie bekommen weitere Hilfsanweisungen durch Anklicken des Symbols <img <?php echo createComIcon('../','frage.gif','0') ?>> innerhalb des Bestellkorbes bzw. Katalogs .
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Achtung!</b></font> 
<ul>       	
Wenn Sie abbrechen möchten klickt den <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> Knopf an.
</ul>
<?php endif;?>


<?php if($src=="head") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie bestelle ich <?php if($x2=="pharma") print "Arzneimittel"; else print "Produkte aus dem Medicallager"; ?>?
</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Erstelle zuerst die Bestellungsliste. Auf dem rechten Rahmen sehen Sie den Bestellkatalog von Ihrer Abteilung, oder Station, oder OP Saal, usw.<p>
 	<b>Schritt 2: </b>Wenn der Artikel den Sie bestellen möchten in der Katalogliste ist, klickt seinen <img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>> Knopf an um  in den Bestellkorb auf dem linken Rahmen <b>ein Stück</b> von dem Artikel zu stellen.<p>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Achtung!</b></font> 
<ul>       	
 Sie bekommen weitere Hilfsanweisungen durch Anklicken des Symbols <img <?php echo createComIcon('../','frage.gif','0') ?>> innerhalb des Bestellkorbes bzw. Katalogs .
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Achtung!</b></font> 
<ul>       	
Wenn Sie abbrechen möchten klickt den <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> Knopf an.
</ul>
<?php endif;?>

<?php if($src=="catalog") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie stelle ich einen Artikel in den Bestellkatalog?</b>
</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Wenn der Artikel den Sie bestellen möchten in der Katalogliste ist, klickt seinen <img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>> Knopf an um  in den Bestellkorb auf dem linken Rahmen <b>ein Stück</b> von dem Artikel zu stellen.<p>
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ich möchte aber mehr als ein Stück von dem Artikel in den Bestellkorb stellen. Wie geht das?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt den Checkbox <input type="checkbox" name="a" value="a" checked> des Artikels im Katalog an.<br>
 	<b>Schritt 2: </b>Gibt die Stückzahl in das Feld " Stück <input type="text" name="d" size=2 maxlength=2> " ein.<br>
 	<b>Schritt 3: </b>Klickt den <input type="button" value="In den Bestellkorb stellen"> Knopf an um den Artikel in den Bestellkorb zu stellen.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Der Artikel den ich brauche ist nicht im Katalog. Was soll ich tun?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Sie müssen den Artikel suchen. 
	Gibt entweder eine vollständige Information oder die erste Zeichen von dem Markennamen des Artikels, oder seinem Generic, oder seiner Bestellnummer, usw. in das Feld
				<nobr><span style="background-color:yellow" >" Suchbegriff für den Artikel: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> ein.<br>
 	<b>Schritt 2: </b>Klickt den <input type="button" value="Artikel suchen"> Knopf an um den Artikel zu suchen.<br>
 	<b>Schritt 3: </b>Wenn die Suche ein Artikel bzw. mehrere Artikel findet, wird eine Liste gezeigt.<br>
 	<b>Schritt 4: </b>Wenn Sie nur ein Stück von dem Artikel bestellen möchten, klickt den <img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>> Knopf an. 
	Der Artikel wird in den Bestellkorb gestellt. Gleichzeitig wird er auch in den Katalog gestellt.<br>
 	<b>Schritt 5: </b>Wenn Sie den Artikel nur in den Katalog stellen möchten, klickt den <img <?php echo createComIcon('../','dwnarrowgrnlrg.gif','0') ?>> Knopf an.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ich möchte mehr Information über den Artikel sehen. Was soll ich tun?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt entweder den Namen des Artikels oder das Symbol <img <?php echo createComIcon('../','info3.gif','0') ?>> an.<br>
 	<b>Schritt 2: </b>Ein Fenster mit der Information über den Artikel öffnet sich.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie entferne ich einen Artikel aus dem Katalog?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt den <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> Knopf des Artikels an.<br>
</ul>

<?php endif;?>

<?php if($src=="orderlist") : ?>
	<?php if($x1=="0") : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Achtung!</b></font> 
<ul>       	
Der Bestellkorb ist momentan leer.<p>
 Um eine Bestellungsliste zu erstellen, wähle ein Artikel aus dem Katalog auf dem rechten Rahmen aus.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie stelle ich einen Artikel in den Bestellkatalog?</b>
</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Wenn der Artikel den Sie bestellen möchten in der Katalogliste ist, klickt seinen <img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>> Knopf an um  in den Bestellkorb auf dem linken Rahmen <b>ein Stück</b> von dem Artikel zu stellen.<p>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Achtung!</b></font> 
<ul>       	
 Um weitere Hilfe wie man einen Artikel sucht, auswählt, bestellt, usw. zu bekommen, klickt das Symbol <img <?php echo createComIcon('../','frage.gif','0') ?>> im Katalog an.<p>
</ul>

	<?php else : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Kann ich die Stückzahl des Artikels im Bestellkorb ändern?
</b>
</font>
<ul>       	
 	<b>Ja.</b> Überschreibe einfach die Eingabe mit der neuen Stückzahl.
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ich möchte mehr Information über den Artikel sehen. Was soll ich tun?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt entweder den Namen des Artikels oder das Symbol <img <?php echo createComIcon('../','info3.gif','0') ?>> an.<br>
 	<b>Schritt 2: </b>Ein Fenster mit der Information über den Artikel öffnet sich.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie entferne ich einen Artikel aus dem Katalog?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt den <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> Knopf des Artikels an.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Alle Artikel zum Bestellen sind jetzt im Bestellkorb. Was soll ich jetzt tun?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Sende die Bestellungsliste in  <?php if($x2=="pharma") print "die Apotheke"; else print "den Medicallager"; ?>. 
	<br>Klickt den <input type="button" value="Endgültige Bestellungsliste erstellen"> Knopf an um weiter zu gehen.<br>
 	<b>Schritt 2: </b>Die Bestellungsliste wird wieder gezeigt. Gibt Ihren Namen in das Feld <nobr>"<span style="background-color:yellow" > Erstellt von <input type="text" name="c" size=15 maxlength=10> </span>"</nobr> ein.<br>
 	<b>Schritt 3: </b>Wähle die Prioritätklasse der Bestellung zwischen "<span style="background-color:yellow" > Normal<input type="radio" name="x" value="s" checked> Eilig<input type="radio" name="x" > </span>" aus. Klickt den entsprechenden Knopf an.<br>
 	<b>Schritt 4: </b>Der Arzt muss seinen Namen in das Feld  <nobr>"<span style="background-color:yellow" > Bestätigt von <input type="text" name="c" size=15 maxlength=10> </span>"</nobr> eingeben.<br>
 	<b>Schritt 5: </b>Der Arzt muss sein Passwort in das Feld <nobr>"<span style="background-color:yellow" > Passwort: <input type="text" name="c" size=15 maxlength=10> </span>"</nobr> eingeben.<br>
 	<b>Schritt 6: </b>Klickt den <input type="button" value="Bestellungsliste an <?php if($x2=="pharma") print "die Apotheke"; else print "den Medicallager"; ?> senden"> Knopf an.<br>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Achtung!</b></font> 
<ul>       	
Wenn Sie die Bestellungsliste nicht senden möchten klicken Sie die Option "<span style="background-color:yellow" > << Zurück und noch mal bearbeiten </span>" an.
</ul>
	<?php endif;?>

<?php endif;?>


<?php if($src=="final") : ?>
	<?php if($x1=="1") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ich möchte die Bestellung beenden. Wie geht das?</b>
</font>
<ul>     
 	<b>Schritt 1: </b>Klickt die Option "<span style="background-color:yellow" > <img <?php echo createComIcon('../','arrow-blu.gif','0') ?>> Bestellung beenden und verlassen</span>" an um in <?php if($x2=="pharma") print "die Apotheke"; else print "den Medicallager"; ?> zurück zu gehen.<br>
</ul>	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie erstelle ich eine neue Bestellungsliste?</b>
</font>
<ul>     
 	<b>Schritt 1: </b>Klickt die Option "<span style="background-color:yellow" > <img <?php echo createComIcon('../','arrow-blu.gif','0') ?>> Eine neue Bestellungsliste erstellen bzw. einen leeren Bestellkorb erzeugen </span>" an.<br>
</ul>
	<?php else : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie sende ich die endgültige Bestellungsliste?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Gibt Ihren Namen in das Feld <nobr>"<span style="background-color:yellow" > Erstellt von <input type="text" name="c" size=15 maxlength=10> </span>"</nobr> ein.<br>
 	<b>Schritt 2: </b>Wähle die Prioritätklasse der Bestellung zwischen "<span style="background-color:yellow" > Normal<input type="radio" name="x" value="s" checked> Eilig<input type="radio" name="x" > </span>" aus. Klickt den entsprechenden Knopf an.<br>
 	<b>Schritt 3: </b>Der Arzt muss seinen Namen in das Feld  <nobr>"<span style="background-color:yellow" > Bestätigt von <input type="text" name="c" size=15 maxlength=10> </span>"</nobr> eingeben.<br>
 	<b>Schritt 4: </b>Der Arzt muss sein Passwort in das Feld <nobr>"<span style="background-color:yellow" > Passwort: <input type="text" name="c" size=15 maxlength=10> </span>"</nobr> eingeben.<br>
 	<b>Schritt 5: </b>Klickt den <input type="button" value="Bestellungsliste an <?php if($x2=="pharma") print "die Apotheke"; else print "den Medicallager"; ?> senden"> Knopf an.<br>

</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Achtung!</b></font> 
<ul>       	
Wenn Sie die Bestellungsliste nicht senden möchten klicken Sie die Option "<span style="background-color:yellow" > << Zurück und noch mal bearbeiten </span>" an.
</ul>
	<?php endif;?>

<?php endif;?>
<!-- ++++++++++++++++++++++++++++++++++ archive +++++++++++++++++++++++++++++++++++++++++++ -->
<?php if($src=="arch") : ?>


<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Ich möchte die Bestellungsliste im Archiv sehen. Wie geht das?</b></font>
<ul>  	<b>Schritt 1: </b>
Gibt entweder eine vollständige Information oder die erste Zeichen von Namen der Abteilung, oder dem Bestellungsdatum, oder die Prioritätsklasse ("eilig") in das Feld
				<nobr><span style="background-color:yellow" >" Suchbegriff für die Bestellungsliste: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> ein.<br>
 	<b>Schritt 2: </b>Aktiviere bzw deaktiviere die folgende Checkboxen:
<ul> 	
  	<input type="checkbox" name="d" checked> Datum<br>
	<input type="checkbox" name="d" checked> Abteilung<br>
  	<input type="checkbox" name="d" checked> Priotität<br>
	Im Normalfall sind alle drei Checkboxes aktiviert und die Suche sucht in allen drei Kategorien.
</ul> 	
<b>Schritt 3: </b>Klickt den <input type="button" value="Suchen"> Knopf an um die Bestellungsliste zu suchen.<br>
 	<b>Schritt 4: </b>Wenn die Suche Ergebnisse findet wird eine Liste gezeigt.<br>
 	<b>Schritt 5: </b>Klickt den <img <?php echo createComIcon('../','uparrowgrnlrg.gif','0') ?>> Knopf einer Bestellungsliste an. Die Details werden gezeigt.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Mehrere Bestellungslisten sind aufgelistet. Wie öffne ich eine Bestellungsliste?</b></font>
<ul>  	
 	<b>Schritt 1: </b>Klickt den <img <?php echo createComIcon('../','uparrowgrnlrg.gif','0') ?>> Knopf einer Bestellungsliste an. Die Details werden gezeigt.<br>
</ul>

<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Achtung!</b></font> 
<ul>       	
 Wenn Sie die Suche beenden möchten klickt den <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> Knopf an.
</ul>


	<?php endif;?>
	
<?php if($src=="archshow") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ich möchte mehr Information über den Artikel sehen. Was soll ich tun?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt das Symbol <img <?php echo createComIcon('../','info3.gif','0') ?>> an.<br>
 	<b>Schritt 2: </b>Ein Fenster mit der Information über den Artikel öffnet sich.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ich möchte die Liste wieder sehen. Was soll ich tun?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt den <input type="button" value="<< Zurück"> Knopf an.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Ich möchte eine neue Suchen nach Bestellungslisten starten. Was soll ich tun?</b></font>
<ul>  
	<b>Schritt 1: </b>Gibt entweder eine vollständige Information oder die erste Zeichen von Namen der Abteilung, oder dem Bestellungsdatum, oder die Prioritätsklasse ("eilig") in das Feld
				<nobr><span style="background-color:yellow" >" Suchbegriff für die Bestellungsliste: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> ein.<br>
 	<b>Schritt 2: </b>Aktiviere bzw deaktiviere die folgende Checkboxen:
<ul> 	
  	<input type="checkbox" name="d" checked> Datum<br>
	<input type="checkbox" name="d" checked> Abteilung<br>
  	<input type="checkbox" name="d" checked> Priotität<br>
	Im Normalfall sind alle drei Checkboxes aktiviert und die Suche sucht in allen drei Kategorien.
</ul> 	
<b>Schritt 3: </b>Klickt den <input type="button" value="Suchen"> Knopf an um die Bestellungsliste zu suchen.<br>
 	<b>Schritt 4: </b>Wenn die Suche Ergebnisse findet wird eine Liste gezeigt.<br>
 	<b>Schritt 5: </b>Klickt den <img <?php echo createComIcon('../','uparrowgrnlrg.gif','0') ?>> Knopf einer Bestellungsliste an. Die Details werden gezeigt.<br>
</ul>
	<?php endif;?>	
	

<?php if($src=="db") : ?>
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
 	<b>Schritt 2: </b>Einf kleines Fenster zum auswählen von Dateien öffnet sich. Wähle die gewünschte Bilddatei aus und klickt "OK" an.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
I am finished entering all available product information. How to save it?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Click the button <input type="button" value="Save">.<br>
</ul>
	<?php endif;?>	
	<?php if($x1=="save") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to enter a new product into the databank?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Click the <input type="button" value="New product"> button.<br>
 	<b>Schritt 2: </b>The entry form will appear.<br>
 	<b>Schritt 3: </b>Enter the available information about the new product.<br>
 	<b>Schritt 4: </b>Click the button <input type="button" value="Save"> to save the information.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
I want to edit the product that is currently displayed How to do it?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Click the button <input type="button" value="Updte or edit">.<br>
 	<b>Schritt 2: </b>The product information will be automatically entered into the editing form.<br>
 	<b>Schritt 3: </b>Edit the information.<br>
 	<b>Schritt 4: </b>Click the button <input type="button" value="Save"> to save the new information.<br>
</ul>
	
	<?php endif;?>	
<?php endif;?>	
</form>

