<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
?>
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
OP Dokumentation - 
<?php
if($src=="create")
{
	switch($x1)
	{
	case "": print "Ein neues Dokument anlegen";
						break;
	case "dummy": print "Ein neues Dokument anlegen";
						break;
	case "saveok": print  "Das Dokument ist gespeichert";
						break;
	case "update": print "Dokument aktualisieren";
						break;
	case "search": print "Suchen nach einem Patient";
						break;
	default : print "Suchen nach einem Patient";
					$x1='';
	}
}
if($src=="search")
{
	switch($x1)
	{
	case "dummy": print "Suchen nach einem Dokument";
						break;

	case "match": print  "Suchergebnis";
						break;
	case "select": print "Dokument eines Patienten";
						break;
	default : print "Suchen nach einem Dokument";
	}
}
if($src=="arch")
{
	switch($x1)
	{
	case "dummy": print "Archiv";
						break;
	case "": print "Archiv";
						break;
	case "?": print "Archiv";
						break;
	case "search": print  "Suchergebnis vom Archiv";
						break;
	case "select": print "Dokument eines Patienten";
	}
}
 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<?php if($src=="create") : ?>


<?php if($x1=="saveok") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie bearbeite bzw. aktualisiere ich das Dokument?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt den <input type="button" value="Aktualisieren bzw. ändern"> Knopf an um in den Bearbeitungsmodus zu gehen.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie erstelle ich ein neues Dokument?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt den <input type="button" value="Neues OP Dokument starten"> Knopf an um ein neues Eingabeformular anzulegen.<br>
	</ul>
<b>Achtung!</b>
<ul>  Wenn Sie abbrechen möchten klickt den <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> Knopf an.
</ul>

<?php endif;?>

<?php if($x1=="update") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie bearbeite bzw. aktualisiere ich das Dokument?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Wenn das Dokument im Bearbeitungsmodus ist können Sie die Daten ändern, ergänzen, löschen, oder neu eingeben.<br> 
 	<b>Schritt 2: </b>Um das Dokument zu speichern, klickt den <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> Knopf an .<br>  
	</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Achtung!</b></font> 
<ul>       	
 Wenn Sie abbrechen möchten klickt den <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> Knopf an.
</ul>
<?php endif;?>
<?php if(($x1=="dummy")||($x1=="")|| ($x1=='search')) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie erstelle ich ein neues Dokument?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Suche zuerst den Patient. Gibt in das Feld <nobr>"<span style="background-color:yellow" > Matchcode Name <input type="text" name="m" size=20 maxlength=20> </span>"</nobr> 
	entweder eine vollständige Information oder die erste Zeichen von dem Namen oder Vornamen vom Patient ein.<br>
 	<b>Schritt 2: </b>Klickt den <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> Knopf an um die Suche nach dem Patient zu starten.<p> 
<ul>       	
 	<b>Achtung! </b>Wenn die Suche ein Ergebnis liefert werden die Grunddaten vom Patient sofort in die entsprechende Felder eingeblendet.<p> 
 	<b>Achtung! </b>Wenn die Suche mehrere Ergebnisse liefert wird eine Liste gezeigt. Clickt den Namen vom Patient an um ihn auszuwählen.<p> 
	</ul>
 	<b>Schritt 3: </b>Wenn die Grunddaten vom Patient gezeigt ist können Sie weitere op relevante Information in die entsprechende Eingabefelder
	eingeben.<br> 
 	<b>Schritt 4: </b>Um das Dokument zu speichern, klickt den <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> Knopf an .<br> 
	</ul>
	<?php endif;?>
<?php endif;?>



<?php if($src=="search") : ?>
	<?php if(($x1=="dummy")||($x1=="")) : ?>


<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie finde ich ein Dokument von einem Patient?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Gibt in das Feld "<span style="background-color:yellow" > Suchbegriff: z.B. Name oder Vorname <input type="text" name="m" size=20 maxlength=20> </span>" 
	entweder eine vollständige Information oder die erste Zeichen von dem Namen oder Vornamen vom Patient ein.<br>
 	<b>Schritt 2: </b>Klickt den <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> Knopf an um die Suche nach dem Patient zu starten.<p> 
<ul>       	
 	<b>Achtung! </b>Wenn die Suche ein Ergebnis liefert werden die Grunddaten vom Patient sofort in die entsprechende Felder eingeblendet.<p> 
 	<b>Achtung! </b>Wenn die Suche mehrere Ergebnisse liefert wird eine Liste gezeigt. Clickt den Namen vom Patient, oder das OP Datum, oder die OP Nummer an um ihn auszuwählen.<p> 
	</ul>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Achtung!</b></font> 
<ul>       	
 Wenn Sie abbrechen möchten klickt den <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> Knopf an.
</ul>
	<?php endif;?>
<?php if(($x1=="match")&&($x2>0)) : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie wähle ich ein bestimmtes Dokument zum lesen aus?</b>
</font>
<ul>       	
 	<b>Achtung! </b> Clickt den Namen vom Patient, oder das OP Datum, oder die OP Nummer an um ihn auszuwählen.<p> 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie suche ich weiter?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Gibt in das Feld "<span style="background-color:yellow" > Suchbegriff: z.B. Name oder Vorname <input type="text" name="m" size=20 maxlength=20> </span>" 
	entweder eine vollständige Information oder die erste Zeichen von dem Namen oder Vornamen vom Patient ein.<br>
 	<b>Schritt 2: </b>Klickt den <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> Knopf an um die Suche nach dem Patient zu starten.<p> 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Achtung!</b></font> 
<ul>       	
 Wenn Sie abbrechen möchten klickt den <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> Knopf an.
</ul>
	<?php endif;?>
<?php if(($x1=="select")&&($x2==1)) : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie bearbeite bzw. aktualisiere ich das Dokument?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt den <input type="button" value="Aktualisieren bzw. ändern"> Knopf an um in den Bearbeitungsmodus zu gehen.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie suche ich weiter?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Gibt in das Feld "<span style="background-color:yellow" > Suchbegriff: z.B. Name oder Vorname <input type="text" name="m" size=20 maxlength=20> </span>" 
	entweder eine vollständige Information oder die erste Zeichen von dem Namen oder Vornamen vom Patient ein.<br>
 	<b>Schritt 2: </b>Klickt den <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> Knopf an um die Suche nach dem Patient zu starten.<p> 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Achtung!</b></font> 
<ul>       	
 Wenn Sie abbrechen möchten klickt den <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> Knopf an.
</ul>

<?php endif;?>
<?php endif;?>

<?php if($src=="arch") : ?>
	<?php if(($x1=="dummy")||($x1=="?")||($x1=="")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Wie kann ich alle OP Dokumente von einem OP Datum auflisten lassen?</b></font>
<ul> <b>Schritt 1: </b>Gibt das OP Datum in das Feld "<span style="background-color:yellow" > OP Datum: </span>" ein. <br>
		<ul><font size=1 color="#000099">
		<!-- <b>Tip:</b> Enter "T" or "t" to automatically produce today's date.<br>
		<b>Tip:</b> Enter "Y" or "y" to automatically produce yesterday's date.<br> -->
		</font>
		</ul><b>Schritt 2: </b>Lassen Sie die andere Eingabefelder leer.<br>
		<b>Schritt 3: </b>Klickt den <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  Knopf an um die Suche zu starten.<br>
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>>
 <font color="#990000"><b>Wie kann ich alle OP Dokumente von einem Patient auflisten?</b></font>
<ul> <b>Schritt 1: </b>Gibt das Suchwort in das entsprechende Eingabefeld ein. Es kann ein kompletter Satz oder die erste Zeichen sein.<br>
		<ul><font size=1 color="#000099" >
		<b>Folgende Eingabefelder kann mit einem Suchwort ausgefüllt werden:</b>
		<br> Fallnummer.
		<br> Name
		<br> Vorname
		<br> Geburtsdatum
		</font>
		</ul><b>Schritt 2: </b>Lassen Sie die andere Eingabefelder leer.<br>
		<b>Schritt 3: </b>Klickt den <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  Knopf an um die Suche zu starten.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Wie kann ich alle OP Dokumente auflisten die von einem Operateur erstellt wurden?</b></font>
<ul> <b>Schritt 1: </b>Gibt den Namen des Operateurs in das Feld "<span style="background-color:yellow" > Operateur: </span>" ein. <br>
		<b>Schritt 2: </b>Lassen Sie die andere Eingabefelder leer.<br>
		<b>Schritt 3: </b>Klickt den <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  Knopf an um die Suche zu starten.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Wie kann ich alle OP Dokumente von ambulanten Patienten auflisten?</b></font>
<ul> <b>Schritt 1: </b>Klickt den Radiobutton "<span style="background-color:yellow" >Ambulant <input type="radio" name="r" value="1"></span>" ein. <br>
		<b>Schritt 2: </b>Lassen Sie die andere Eingabefelder leer.<br>
		<b>Schritt 3: </b>Klickt den <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  Knopf an um die Suche zu starten.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Wie kann ich alle OP Dokumente von stationären Patienten auflisten?</b></font>
<ul> <b>Schritt 1: </b>Klickt den Radiobutton "<span style="background-color:yellow" >Stationär <input type="radio" name="r" value="1"></span>" ein. <br>
		<b>Schritt 2: </b>Lassen Sie die andere Eingabefelder leer.<br>
		<b>Schritt 3: </b>Klickt den <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  Knopf an um die Suche zu starten.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Wie kann ich alle OP Dokumente von allgemein versicherten Patienten auflisten?</b></font>
<ul> <b>Schritt 1: </b>Klickt den Radiobutton "<span style="background-color:yellow" >Kasse <input type="radio" name="r" value="1"></span>" ein. <br>
		<b>Schritt 2: </b>Lassen Sie die andere Eingabefelder leer.<br>
		<b>Schritt 3: </b>Klickt den <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  Knopf an um die Suche zu starten.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<font color="#990000"><b>Wie kann ich alle OP Dokumente von privat versicherten Patienten auflisten?</b></font>
<ul> <b>Schritt 1: </b>Klickt den Radiobutton "<span style="background-color:yellow" >Privat <input type="radio" name="r" value="1"></span>" ein. <br>
		<b>Schritt 2: </b>Lassen Sie die andere Eingabefelder leer.<br>
		<b>Schritt 3: </b>Klickt den <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  Knopf an um die Suche zu starten.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<font color="#990000"><b>Wie kann ich alle OP Dokumente von selbstzahlenden Patienten auflisten?</b></font>
<ul> <b>Schritt 1: </b>Klickt den Radiobutton "<span style="background-color:yellow" >X <input type="radio" name="r" value="1"></span>" ein. <br>
		<b>Schritt 2: </b>Lassen Sie die andere Eingabefelder leer.<br>
		<b>Schritt 3: </b>Klickt den <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  Knopf an um die Suche zu starten.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
 <font color="#990000"><b>Wie kann ich alle OP Dokumente auflisten die ein bestimmtes Wort beinhalten?</b></font>
<ul> <b>Schritt 1: </b>Gibt das Wort in das entsprechende Eingabefeld ein. Es kann ein komplettes Wort oder dessen erste Zeichen sein.<br>
		<ul><font size=2 color="#000099" >
		<b>Beispiel:</b> Gibt ein diagnostischen Begriff in das Feld "Diagnose" ein.<br>
		<b>Beispiel:</b> Gibt ein Lokalisationsbegriff in das Feld  "Localisation" ein.<br>
		<b>Beispiel:</b> Gibt ein therapeutischen Begriff in das Feld  "Therapie" ein.<br>
		<b>Beispiel:</b> Gibt ein Sonderbegriff in das Feld  "Besonderheiten" ein.<br>
		</font>
		</ul><b>Schritt 2: </b>Lassen Sie die andere Eingabefelder leer.<br>
		<b>Schritt 3: </b>Klickt den <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  Knopf an um die Suche zu starten.<br>
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Wie kann ich alle OP Dokumente mit bestimmter Klassifikation auflisten?</b></font>
<ul> <b>Schritt 1: </b>Gibt die Klassifikationsnummer in das entsprechende Eingabefeld ein. <br>
		<ul><font size=2 color="#000099" >
		<b>Beispiel:</b> Für kleine OP's,  gibt die nummer in das Feld "<span style="background-color:yellow" > <input type="text" name="m" size=4 maxlength=2> klein </span>" ein.<br>
		<b>Beispiel:</b> Für mittlere OP's,  gibt die nummer in das Feld  "<span style="background-color:yellow" > <input type="text" name="m" size=4 maxlength=2> mittel </span>" ein.<br>
		<b>Beispiel:</b> Für große OP's,  gibt die nummer in das Feld  "<span style="background-color:yellow" > <input type="text" name="m" size=4 maxlength=2> große Eingriff </span>" ein.<br>
		</font>
		</ul><b>Schritt 2: </b>Lassen Sie die andere Eingabefelder leer.<br>
		<b>Schritt 3: </b>Klickt den <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  Knopf an um die Suche zu starten.<br>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>><b><font color="#990000"> Achtung!</font></b>
<ul> Sie können mehrere Suchwörter und Bedingungen kombinieren. Zum Beispiel:
Wenn Sie alle stationäre Patienten auflisten möchten die von "Dr. Schmidt" operiert wurden und deren
 Therapie mit "lipo" beginnt .<p>
		<b>Schritt 1: </b>Gibt 'Schmidt' in das Feld "<span style="background-color:yellow" > Operateur: <input type="text" name="s" size=15 maxlength=4 value="Schmidt"> </span>" ein.<br>
		<b>Schritt 2: </b>Klickt den Radiobutton "<span style="background-color:yellow" > <input type="radio" name="r" value="1" checked>Stationär </span>" an.<br>
		<b>Schritt 3: </b>Gibt 'lipo' in das Feld "<span style="background-color:yellow" > Therapie: <input type="text" name="s" size=20 maxlength=4 value="lipo"> </span>" ein. <br>
		<b>Schritt 4: </b>Klickt den <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  Knopf an um die Suche zu starten.<p>

<b>Achtung!</b><br>
Wenn die Suche ein einziges Ergebnis findet werden die Daten sofort gezeigt.<br>
		Wenn die Suche allerdings mehrere Ergebnisse liefert wird eine Liste gezeigt.<p>
		Um das Dokument zu öffnen klickt den nebenstehenden <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> Knopf, oder
		den Namen, oder den Vornamen, oder das OP Datum, oder die OP Nummer an.</nobr>.
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Achtung!</b></font> 
<ul>       	
 Wenn Sie abbrechen möchten klickt den <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> Knopf an.
</ul>
	<?php endif;?>
<?php if(($x1=="search")&&($x2>0)) : ?>

	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie wähle ich ein bestimmtes Dokument zum lesen aus?</b>
</font>
<ul>       	
 	<b>Achtung! </b> Clickt den Namen vom Patient, oder das OP Datum, oder die OP Nummer an um ihn auszuwählen.<p> 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie suche ich weiter?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt den <input type="button" value="Neue Suche im Archiv"> Knopf an um in die Eingabefelder des Archivs zurück zu gehen.<p> 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Achtung!</b></font> 
<ul>       	
 Wenn Sie abbrechen möchten klickt den <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> Knopf an.
</ul>
	<?php endif;?>
<?php if(($x1=="select")&&($x2==1)) : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie bearbeite bzw. aktualisiere ich das Dokument?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt den <input type="button" value="Aktualisieren bzw. ändern"> Knopf an um in den Bearbeitungsmodus zu gehen.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie suche ich weiter?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt den <input type="button" value="Neue Suche im Archiv"> Knopf an um in die Eingabefelder des Archivs zurück zu gehen.<p> 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Achtung!</b></font> 
<ul>       	
 Wenn Sie abbrechen möchten klickt den <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> Knopf an.
</ul>

<?php endif;?>
<?php endif;?>

</form>

