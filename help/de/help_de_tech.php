<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
?>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title></title>

</head>
<body>
<form >
<font face="Verdana, Arial" size=2>
<font  size=3 color="#0000cc">
<b>

<?php
print "Technische Unterstützung - ";	
switch($src)
	{
		case "request": print "Reparatur anfordern";
							break;
		case "report": print "Reparatur melden";
							break;
		case "queries": print "Fragen an die Technik senden";
							break;
		case "arch": print "Archiv";
							break;
		case "showarch": print "Bericht";
							break;
	}
?>
</b>
</font>
<p>

<?php if($src=="request") : ?>
<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie kann ich eine Reparaturanforderung erstellen?</b></font>
<ul> <b>Schritt 1: </b>Gibt die Lokalisation des Schaden in das Feld
<nobr>"<span style="background-color:yellow" > Lokalisation des Schaden <input type="text" name="d" size=20 maxlength=10> </span>"</nobr> ein.<p>
<b>Schritt 2: </b>Gibt Ihren Namen in das Feld <nobr>"<span style="background-color:yellow" > Angefordert von: <input type="text" name="d" size=20 maxlength=10> </span>"</nobr> ein.<br>
 <b>Schritt 3: </b>Gibt Ihre Personalnummer in das Feld <nobr>"<span style="background-color:yellow" > Personal Nr.: <input type="text" name="d" size=20 maxlength=5> </span>"</nobr> ein.<br>
 <b>Schritt 4: </b>Gibt Ihre Telefonnummer in das Feld <nobr>"<span style="background-color:yellow" > Telefon Nrr. <input type="text" name="d" size=20 maxlength=5> </span>"</nobr> ein.<p>
 <b>Schritt 5: </b>Beschreiben Sie den Schaden in das Feld <nobr>"<span style="background-color:yellow" > Beschreiben Sie hier bitte die Art und Umfang der Schaden: <input type="text" name="d" size=20 maxlength=5> </span>"</nobr> ein.<br>
     <b>Schritt 6: </b>Klickt den <input type="button" value="Anforderung senden"> Knopf um die Anforderung zu senden. <br>
</ul>
<b>Achtung!</b>
<ul>Wenn Sie abbrechen möchten klickt den <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> Knopf an.
</ul>
<?php endif;?>
<?php if($src=="report") : ?>
<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie berichte ich eine erledigte Reparaturarbeit?</b></font>
<ul> <b>Schritt 1: </b>Gibt die Lokalisation des Schaden in das Feld
<nobr>"<span style="background-color:yellow" > Lokalisation des Schaden <input type="text" name="d" size=20 maxlength=10> </span>"</nobr> ein.<p>
<b>Schritt 2: </b>Gibt die Auftragskennnummer in das Feld <nobr>"<span style="background-color:yellow" > Auftragskennnummer: <input type="text" name="d" size=20 maxlength=10> </span>"</nobr> field.<br>
<b>Schritt 3: </b>Gibt Ihren Namen in das Feld <nobr>"<span style="background-color:yellow" > Techniker: <input type="text" name="d" size=20 maxlength=10> </span>"</nobr> ein.<br>
 <b>Schritt 4: </b>Gibt Ihre Personalnummer in das Feld <nobr>"<span style="background-color:yellow" > Personal Nr.: <input type="text" name="d" size=20 maxlength=5> </span>"</nobr> ein.<br>
 <b>Schritt 5: </b>Beschreiben Sie die Reparaturarbeit in das Feld <nobr>"<span style="background-color:yellow" > Beschreiben Sie hier bitte die Art und Umfang der Reparatur, die Sie gemacht haben: <input type="text" name="d" size=20 maxlength=5> </span>"</nobr> ein.<br>
     <b>Schritt 6: </b>Klickt den <input type="button" value="Meldung senden"> Knopf um den Bericht zu senden. <br>
</ul>
<b>Achtung!</b>
<ul>Wenn Sie abbrechen möchten klickt den <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> Knopf an.
</ul>
<?php endif;?>
<?php if($src=="queries") : ?>
<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie sende ich eine Anfrage an die Technik?</b></font>
<ul> <b>Schritt 1: </b>Tippt Ihre Anfrage in das Feld <nobr>"<span style="background-color:yellow" > Bitte geben Sie Ihre Frage hier ein: <input type="text" name="d" size=20 maxlength=5> </span>"</nobr> ein.<br>
<b>Schritt 2: </b>Gibt Ihren Namen in das Feld <nobr>"<span style="background-color:yellow" > Name: <input type="text" name="d" size=20 maxlength=10> </span>"</nobr> ein.<br>
<b>Schritt 3: </b>Gibt die Abteilung in das Feld <nobr>"<span style="background-color:yellow" > Abteilung: <input type="text" name="d" size=20 maxlength=10> </span>"</nobr> ein.<br>
     <b>Schritt 4: </b>Klickt den <input type="button" value="Frage senden"> Knopf um die Anfrage zu senden. <br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie kann ich meine letzte Anfragen sehen und die Antwort von der Technik?</b></font>
<ul> <b>Schritt 1: </b>Melden Sie sich zuerst an. Gibt Ihren Namen in das Feld <nobr>"<span style="background-color:yellow" > von: <input type="text" name="d" size=20 maxlength=5> </span>"</nobr> in der oberen rechten Ecken ein.<br>
 <b>Schritt 2: </b>Klickt den <input type="button" value="Anmelden"> Knopf an. <br>
 <b>Schritt 3: </b>Wenn Sie vorher Anfragen gesendet haben werden sie in Kurzform aufgelistet.  <br>
 <b>Schritt 4: </b>Wenn die Technik Ihre Anfrage beantwortet hat zeigt sich das Symbol <img src="../img/warn.gif" border=0 width=16 height=16 align="absmiddle"> nach der Frage. <br>
 <b>Schritt 5: </b>Klickt die Frage in der Liste um die Antwort zu lesen. <br>
</ul>
<b>Achtung!</b>
<ul>Wenn Sie abbrechen möchten klickt den <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> Knopf an.
</ul>
<?php endif;?>
<?php if($src=="arch") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie kann ich technische Berichte öffnen zum lesen?</b></font>
<ul> 
		<b>Achtung! </b>Technische Berichte die noch nicht gelesen bzw. nicht gedruckt wurden werden sofort aufgelistet.<p>
<b>Schritt 1: </b>Klickt den  <img src="../img/upArrowGrnLrg.gif" border=0 width=16 height=16 align="absmiddle"> Knopf des Berichts den Sie lesen möchten. <br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie finde ich einen bestimmten Bericht?</b></font>
<ul> <b>Schritt 1: </b>Gibt entweder eine vollständige Information oder deren erste Zeichen in das entsprechende Feld ein.<br>
	<ul type=disc> 
	Wenn Sie einen Bericht suchen ...
	<li>der ein bestimmter Techniker schrieb: gibt den Namen des Technikers in das Feld "<span style="background-color:yellow" > Techniker: <input type="text" name="t" size=11 maxlength=4 value="Name"> </span>" ein.<br>
	<li>der in einer bestimmten Abteilung erledigt wurde: gibt den Namen der Abteilung in das Feld "<span style="background-color:yellow" > Abteilung: <input type="text" name="t" size=11 maxlength=4 value="Name"> </span>" ein.<br>
	<li>der an einem bestimmten Datum geschrieben wurde: gibt das Datum in das Feld "<span style="background-color:yellow" > Datum von: <input type="text" name="t" size=11 maxlength=4 value="Name"> </span>" ein.<br>
	<li>der innerhalb einer Zeitspanne geschrieben wurde: gibt das Anfangsdatum in das Feld "<span style="background-color:yellow" > Datum von: <input type="text" name="t" size=11 maxlength=4 value="Name"> </span>" ein und
		gibt das Enddatum in das Feld  "<span style="background-color:yellow" > bis: <input type="text" name="t" size=11 maxlength=4 value="Name"> </span>" ein.<br>
	</ul>
 <b>Schritt 2: </b>Klickt den <input type="button" value="Suchen"> Knopf an um die Suche zu starten. <br>
<b>Schritt 3: </b>Die Ergebnisse werden aufgelistet. Klickt das Symbol <img src="../img/upArrowGrnLrg.gif" border=0 width=16 height=16 align="absmiddle">  des Berichtes an den Sie öffnen möchten. <br>
	<b>Achtung! </b>Technische Berichte die mit einem <img src="../img/check-r.gif" border=0  align="absmiddle"> gekennzeichnet sind, wurden schon gelesen bzw. gedruckt.<p>

</ul>
</font>
<?php endif;?>
<?php if($src=="showarch") : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b>
Ein Bericht als "gesehen" markieren.</b></font>
<ul> <b>Schritt 1: </b>Klickt den  <input type="button" value="Als [gesehen] markieren"> Knopf an.<p>
	<b>Achtung! </b>Wenn ein Bericht als "gelesen" markiert ist, wird er am Anfang nicht sofort aufgelistet. Man kann ihn trotzdem suchen.<p>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b>
Den Bericht ausdrucken.</b></font>
<ul> <b>Schritt 1: </b>Klickt den  <input type="button" value="Ausdrucken"> Knopf an.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie komme ich zum Suchen im Archiv zurück?</b></font>
<ul> <b>Schritt 1: </b>Klickt den  <input type="button" value="<< Zurück"> Knopf an.<p>
</ul>
<?php endif;?>

</form>
</body>
</html>
