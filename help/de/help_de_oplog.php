<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
?>
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
OP Logbuch - 
<?php
if($src=="create")
{
	switch($x1)
	{
	case "": print "Eine neue OP dokumentieren";
						break;
	case "fresh": print "Eine neue OP dokumentieren";
						break;
	case "get": print  "";
						break;
	case "logmain": print "OP Dokument bearbeiten";
						break;
	default: print "Eine neue OP dokumentieren";	
	}
}
if($src=="time")
{
	print "Eingabe von ";
	switch($x1)
	{
	case "entry_out": print "Ein- bzw. Ausschleussezeiten";
						break;
	case "cut_close": print "Schnitt- bzw. Nahtzeiten";
						break;
	case "wait_time": print "Wartezeiten (Leerlaufzeiten)";
						break;
	case "bandage_time": print "Gipszeiten";
						break;
	case "repos_time": print "Repositionszeiten";
	}
}
if($src=="person")
{
	print "Eingabe von ";
	switch($x1)
	{
	case "operator":$person="Operateur"; 
						break;
	case "assist":$person="Assistent"; 
						break;
	case "scrub": $person="Instrumentierende";
						break;
	case "rotating":$person="Springer"; 
						break;
	case "ana": $person="Narkosearzt";
	}
	print $person;
}
if($src=="search")
{
	switch($x1)
	{
	case "search": print "Dokumentenauswahl";
						break;
	case "": print "Suchen nach einem OP Eintrag";
						break;
	case "get": print  "OP Eintrag";
						break;
	case "fresh": print "Suchen nach einem OP Eintrag";
	}
}
if($src=="arch")
{
	print "Archiv";	
}
 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<?php if($src=="person") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie wähle ich den <?php echo $person ?> aus der "Schnellauswahlliste" aus?</b>
</font>
<ul>       	
 	<b>Achtung! </b>Wenn der <?php echo $person ?> bei einer vergangenen OP ausgewählt wurde, wird sein Name in der Liste auftauchen.<p>
 	<b>Schritt 1: </b>Kontrolliere ob die Funktion dieser Person mit der Angabe im Auswahlfeld "<span style="background-color:yellow" >OP Funktion</span>" 
	übereinstimmt. Falls es nicht der Fall ist, wähle seine richtige Funktion aus.<br>
 	<b>Schritt 2: </b>Klickt den Namen, oder den Vornamen, oder die Option
	<nobr>"<span style="background-color:yellow" > <img <?php echo createComIcon('../','uparrowgrnlrg.gif','0') ?>>
	 Diese Person als <?php echo $person ?> eintragen... </span>"</nobr> an.
	Diese Person wird in die Liste "Aktuelle Angaben" sofort eingetragen.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Der <?php echo ucfirst($person) ?> ist nicht in der "Schnellauswahlliste". Wie trage ich den <?php echo $person ?> ein?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Gibt entweder den vollständigen Name des <?php echo $person ?> oder die erste Zeichen in das Feld "<span style="background-color:yellow" > Einen neuen <?php echo $person ?> suchen </span>" ein.<br>
 	<b>Schritt 2: </b>Klickt den <input type="button" value="OK"> Knopf an um die Suche zu starten.<br>
 	<b>Schritt 3: </b>Das Ergebnis wird aufgelistet. Clikt den Namen, oder Vornamen, oder die Option 
	<nobr>"<span style="background-color:yellow" > <img <?php echo createComIcon('../','uparrowgrnlrg.gif','0') ?>>
	 Diese Person als <?php echo $person ?> eintragen..</span>"</nobr> der Person an.
</ul>


<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b> Wie entferne ich den <?php echo $person ?> aus der Liste "Aktuelle Angaben"?</b></font> 
<ul>       	
 	<b>Schritt 1: </b>Klickt das Symbol <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> vor dem Namen.<br>
 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Ich bin fertig. Wie komme ich zum OP Logbuch zurück?</b></font> 
<ul>       	
 	<b>Schritt 1: </b>Klickt den <img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle"> Knopf an.<br>
 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Achtung!</b></font> 
<ul>       	
Wenn Sie abbrechen möchten klickt den <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> Knopf an.
</ul>
<?php endif;?>

<?php if($src=="time") : ?>
	<?php if($x1=="entry_out") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie trage ich die Ein- bzw. Ausschleussezeiten ein?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Trage die Einschleussezeit in das Feld "<span style="background-color:yellow" > von: <input type="text" name="d" size=5 maxlength=5> </span>" auf der "Ein" Spalte.<br>
 	<b>Schritt 1: </b>Trage die Ausschleussezeit in das Feld "<span style="background-color:yellow" > bis: <input type="text" name="d" size=5 maxlength=5> </span>" auf der "Aus" Spalte.<br>
<ul>       	
 	<b>Tipp: </b>Gibt entweder ein "j" oder "J" (bedeutet JETZT) ein um die Aktuelle Uhrzeit einzutragen.
</ul><br>
 	<b>Achtung! </b>Sie können mehrere Zeitangaben eintragen bevor Sie die Daten speichern.<p>
</ul>

	<?php endif;?>
	<?php if($x1=="cut_close") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie trage ich die Schnitt- bzw. Nahtzeiten ein?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Trage die Schnittzeit in das Feld "<span style="background-color:yellow" > von: <input type="text" name="d" size=5 maxlength=5> </span>" auf der "Schnitt" Spalte.<br>
 	<b>Schritt 1: </b>Trage die Nahtzeit in das Feld "<span style="background-color:yellow" > bis: <input type="text" name="d" size=5 maxlength=5> </span>" auf der "Naht" Spalte.<br>
<ul>       	
 	<b>Tipp: </b>Gibt entweder ein "j" oder "J" (bedeutet JETZT) ein um die Aktuelle Uhrzeit einzutragen.
</ul><br>
 	<b>Achtung! </b>Sie können mehrere Zeitangaben eintragen bevor Sie die Daten speichern.<p>
</ul>

	<?php endif;?>
	<?php if($x1=="wait_time") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie trage ich die Wartezeiten (Leerlauf) ein?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Trage die Anfangszeit in das Feld "<span style="background-color:yellow" > von: <input type="text" name="d" size=5 maxlength=5> </span>" auf der "Anfang" Spalte.<br>
 	<b>Schritt 1: </b>Trage die Endezeit in das Feld "<span style="background-color:yellow" > bis: <input type="text" name="d" size=5 maxlength=5> </span>" auf der "Ende" Spalte.<br>
<ul>       	
 	<b>Tipp: </b>Gibt entweder ein "j" oder "J" (bedeutet JETZT) ein um die Aktuelle Uhrzeit einzutragen.
</ul><br>
 	<b>Schritt 3: </b>Wähle den Grund aus dem Auswahlfeld auf der "Grund" Spalte aus.<p>
 	<b>Achtung! </b>Sie können mehrere Zeitangaben eintragen und Gründen auswählen bevor Sie die Daten speichern.<p>
</ul>

	<?php endif;?>
	<?php if($x1=="bandage_time") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie trage ich die Gipszeiten ein?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Trage die Anfangszeit in das Feld "<span style="background-color:yellow" > von: <input type="text" name="d" size=5 maxlength=5> </span>" auf der "Anfang" Spalte.<br>
 	<b>Schritt 1: </b>Trage die Endzeit in das Feld "<span style="background-color:yellow" > bis: <input type="text" name="d" size=5 maxlength=5> </span>" auf der "Ende" Spalte.<br>
<ul>       	
 	<b>Tipp: </b>Gibt entweder ein "j" oder "J" (bedeutet JETZT) ein um die Aktuelle Uhrzeit einzutragen.
</ul><br>
 	<b>Achtung! </b>Sie können mehrere Zeitangaben eintragen bevor Sie die Daten speichern.<p>
</ul>

	<?php endif;?>
	<?php if($x1=="repos_time") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie trage ich die Repositionszeiten ein?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Trage die Anfangszeit in das Feld "<span style="background-color:yellow" > von: <input type="text" name="d" size=5 maxlength=5> </span>" auf der "Anfang" Spalte.<br>
 	<b>Schritt 1: </b>Trage die Endzeit in das Feld "<span style="background-color:yellow" > bis: <input type="text" name="d" size=5 maxlength=5> </span>" auf der "Ende" Spalte.<br>
<ul>       	
 	<b>Tipp: </b>Gibt entweder ein "j" oder "J" (bedeutet JETZT) ein um die Aktuelle Uhrzeit einzutragen.
</ul><br>
 	<b>Achtung! </b>Sie können mehrere Zeitangaben eintragen bevor Sie die Daten speichern.<p>
</ul>

	<?php endif;?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie speichere ich die Zeitangaben?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt den <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> Knopf an.<br>
 	<b>Schritt 2: </b>Wenn Sie fertig sind klickt den <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> Knopf an um das Fenster zu schliessen und in das OP Logbuch zurück zu gehen.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000">
<b> Ich möchte die Angaben entfernen aber der Knopf "Eingabe verwerfen" scheint nicht zu funktionieren. Was soll ich tun?</b></font> 
<ul>       	
 	<b>Achtung! </b>Der Knopf "Eingabe verwerfen" löscht nur die Eingaben die noch nicht gespeichert sind. Wenn Sie die gespeicherte
	Angaben löschen möchten folgen Sie diese Anweisung:<p>
 	<b>Schritt 1: </b>Klicken Sie das Feld der Zeitangabe an die Sie löschen möchten.<br>
 	<b>Schritt 2: </b>Entfernen Sie manuell die Zeitangabe. Benutzen Sie dafür die "Entf" und "Rücktaste" der Tastatur.<br>
 	<b>Schritt 3: </b>Anschliessend klicken Sie den <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> Knopf an um die Änderung zu speichern.<br>
 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Achtung!</b></font> 
<ul>       	
Wenn Sie abbrechen möchten klicken Sie den <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> Knopf an.
</ul>
<?php endif;?>


<?php if($src=="create") : ?>
	<?php if($x1=="logmain") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie bearbeiten ich ein OP Dokument?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klicken Sie den <img <?php echo createComIcon('../','dwnarrowgrnlrg.gif','0') ?>> Knopf der OP Eintragung an.<br>
 	<b>Schritt 2: </b>Die Patientendaten und OP Einträge werden in den Bearbeitungsrahmen übertragen. Sie können jetzt das OP Dokument bearbeiten. Folgen Sie die
	Anweisungen wie man ein OP dokumentiert.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie öffne ich die Patientenmappe?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klicken Sie den <img <?php echo createComIcon('../','info3.gif','0') ?>> Knopf vor der Fallnummer an.<br>
 	<b>Schritt 2: </b>Die Patientenmappe öffnet sich<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie kann ich in anderen OP Saal bzw. andere OP Abteilung wechseln?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Wähle die OP Abteilung aus dem Auswahlfeld 
				<select name="dept" size=1>
				<?php
$Or2Dept=get_meta_tags("../global_conf/resolve_or2ordept.pid");
					$opabt=get_meta_tags("../global_conf/$lang/op_tag_dept.pid");

					while(list($x,$v)=each($opabt))
					{
						if($x=="anaesth") continue;
						print'
					<option value="'.$x.'"';
						if ($dept==$x) print " selected";
						print '> '.$v.'</option>';
					}
				?>
					
				</select> aus.
<br>
 	<b>Schritt 2: </b>Wähle den OP Saal aus dem Auswahlfeld 
			<select name="saal" size=1 >
				<?php
while(list($x,$v)=each($Or2Dept))
					{
						print'
					<option value="'.$x.'"';
						if ($saal==$x) print " selected";
						print '> '.$x.'</option>';
					}
				?>
				</select> aus.
<br>
 	<b>Schritt 3: </b>Klickt den <input type="button" value="Wechseln"> Knopf an.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie kann ich die OP Dokumente von anderen Tagen zeigen lassen?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Um die OP Dokumente des vergangenen Tages zu zeigen, klickt die Option "<span style="background-color:yellow" > Vortag </span>" auf der oberen linken Ecke der Tabelle an.<br>
	Clicken Sie diese Option so oft wie nötig an bis der gewünschte Tag gezeigt wird.<br>
 	<b>Schritt 1: </b>Um die OP Dokumente des nächten Tages zu zeigen, klickt die Option "<span style="background-color:yellow" > Folgenden Tag </span>" auf der oberen rechten Ecke der Tabelle an.<br>
	Clicken Sie diese Option so oft wie nötig an bis der gewünschte Tag gezeigt wird.<br>
</ul>

<hr>

	<?php endif;?>
	
	<?php if($x2=="material") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie kann ich ein OP Material dokumentieren?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Gibt die Artikelnummer (oder Bestellnummer) des Materials in das Feld "<span style="background-color:yellow" > Artikelnummer: </span>" ein.<p>
	<b>Alternativ Methoden: </b>
	<ul type=disc>  	
	<li>Gibt entweder eine vollstängige Information oder die erste Zeichen von dem Namen, oder der Produktbeschreibung, oder vom Generic, oder von der Zulassungsnummer,
		oder von der Handelsnummer, usw. in das Eingabefeld ein.
	<li>Lesen Sie mit einem Scanner den Strichcode des Materials ein.
	</ul><br> 
 	<b>Schritt 2: </b>Klickt den <input type="button" value="OK"> Knopf an oder drucken Sie die "Enter" Taste der Tastatur um das Material zu suchen.<p> 
<ul>       	
 	<b>Achtung! </b>Wenn die Suche das Material findet wird es sofort in das Dokument übernommen. Eine Materialliste wird gezeigt.<p> 
 	<b>Achtung! </b>Wenn die Suche mehrere Produkte findet wird eine Liste gezeigt. Klickt den <img <?php echo createComIcon('../','bul_arrowgrnlrg.gif','0') ?>> 
	Knopf oder die Artikelnummer oder den Namen des Artikels an um ihn auszuwählen.<p> 
	</ul>
 	<b>Schritt 3: </b>Wenn der Produktartikel in der Materialliste eingetragen ist können Sie die Stückzahl im Feld "<span style="background-color:yellow" > Anzahl</span>" ändern (falls erforderlich).<p> 
<ul>       	
 	<b>Achtung! </b>Wenn Sie die Angabe im Feld "Anzahl" geändert haben zeigen sich die beiden Knöpfe "Speichern" und "Eingabe verwerfen"  an.<p> 
	</ul>
 	<b>Schritt 4: </b>Clickt den <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> Knopf an wenn Sie die Änderung speichern möchten.<p> 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie entferne ich ein Artikel aus der Materialliste?</b>
</font>
<ul> 
 	<b>Schritt 1: </b>Klicken Sie das Symbol <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> nach dem Artikel an.<br> 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Das Material wurde nicht gefunden. Kann ich ein Material manuell eintragen?</b>
</font>
<ul> Ja<br>
 	<b>Schritt 1: </b>Clickt die Option "<span style="background-color:yellow" > <img <?php echo createComIcon('../','accessrights.gif','0') ?>> Artikel manuell eingeben. Click hier. </span>" an.<br> 
 	<b>Schritt 2: </b>Tragen Sie manuell die Information über das Material in die entsprechende Eingabefelder ein.<p> 
 	<b>Schritt 3: </b>Anschliessend klicken Sie den <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> Knopf an um das Material zu speichern.<p> 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Achtung!</b></font> 
<ul>       	
Wenn Sie abbrechen möchten klicken Sie den <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> Knopf an.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie lasse ich das OP Logbuch zeigen?</b>
</font>
<ul> 
 	<b>Schritt 1: </b>Klickt die Option "<span style="background-color:yellow" > <img <?php echo createComIcon('../','manfldr.gif','0') ?>> Logbuch einblenden. </span>" an.<br> 
</ul>
<hr>
	<?php endif;?>

	<?php if(($x1=="")||($x1=="fresh")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie erstelle ich eine neue OP Dokumentation?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Suche zuerst den Patient. Gibt die Fallnummer in das Feld "<span style="background-color:yellow" > Fallnummer: </span>" ein.<p>
	<b>Alternative Methoden: </b>
	<ul type=disc>  	
	<li>Gibt entweder den vollständigen Namen oder Vornamen oder die erste Zeichen in das Feld  "<span style="background-color:yellow" >Name, Vorname </span>" ein.
	<li>Gibt entweder das Geburtsdatum oder die erste Ziffer in das Feld "<span style="background-color:yellow" > Geburtsdatum </span>" ein.
	</ul><p>
 	<b>Schritt 2: </b>Klickt den <input type="button" value="Patient suchen"> Knopf an um den Patient zu suchen.<p> 
<ul>       	
 	<b>Achtung! </b>Wenn die Suche den Patient findet werden seine Grunddaten sofort in den Eingabemodus übernommen.<p> 
 	<b>Achtung! </b>Wenn die Suche mehrere Patienten findet wird eine Liste gezeigt. Klickt den Namen des Patienten um ihn auszuwählen.<p> 
	</ul>
 	<b>Schritt 3: </b>Klickt den <img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>> Knopf nochmal an um weitere Hilfsanweisung zu lesen.<p> 

</ul>

	<?php else : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie trage ich eine Diagnose ein?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Schreibe die Diagnose in das Feld "<span style="background-color:yellow" > Diagnose: </span>" direkt ein.<br>
 	<b>Schritt 2: </b>Klickt den <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> Knopf an.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie trage ich einen Operateur ein?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt die Option "<span style="background-color:yellow" > Operateur </span>" an.<br>
 	<b>Schritt 2: </b>Ein Fenster mit Eingabefelder öffnet sich.<br>
 	<b>Schritt 3: </b>Folgen Sie die Anweisungen in diesem Fenster oder clicken Sie den "Hilfe" Knopf an.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie trage ich einen Assistent ein?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt die Option "<span style="background-color:yellow" > Assistent </span>" an.<br>
 	<b>Schritt 2: </b>Ein Fenster mit Eingabefelder öffnet sich.<br>
 	<b>Schritt 3: </b>Folgen Sie die Anweisungen in diesem Fenster oder clicken Sie den "Hilfe" Knopf an.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie trage ich einen Instrumentierenden ein?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt die Option "<span style="background-color:yellow" > Instrumentierer </span>" an.<br>
 	<b>Schritt 2: </b>Ein Fenster mit Eingabefelder öffnet sich.<br>
 	<b>Schritt 3: </b>Folgen Sie die Anweisungen in diesem Fenster oder clicken Sie den "Hilfe" Knopf an.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie trage ich einen Springer ein?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt die Option "<span style="background-color:yellow" > Springer </span>" an.<br>
 	<b>Schritt 2: </b>Ein Fenster mit Eingabefelder öffnet sich.<br>
 	<b>Schritt 3: </b>Folgen Sie die Anweisungen in diesem Fenster oder clicken Sie den "Hilfe" Knopf an.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie trage ich die Narkoseart ein?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Wähle die Narkoseart aus dem Auswahlfeld "<span style="background-color:yellow" > Narkose <select name="a">
                                                                     	<option > ITN</option>
                                                                     	<option > Plexus</option>
                                                                     	<option > ITN-Jet</option>
                                                                     	<option > ITN-Maske</option>
                                                                     	<option > LA</option>
                                                                     	<option > DS</option>
                                                                     	<option > AS</option>
                                                                     </select> </span>" aus.<p>
	<ul type=disc>       	
 	<li><b>ITN: </b>Intratracheale Narkose<br>
 	<li><b>LA: </b>Lokale Anästhesie<br>
 	<li><b>AS: </b>Analgo-Sedierung<br>
 	<li><b>DS: </b>Gleicht dem AS<br>
 	<li><b>Plexus: </b>Lokale Anästhesie des Nervus Plexus<br>
	</ul>
 	<b>Schritt 2: </b>Klickt den <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> Knopf an.<br>

	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie trage ich einen Narkosearzt ein?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt die Option "<span style="background-color:yellow" > Narkosearzt </span>" an.<br>
 	<b>Schritt 2: </b>Ein Fenster mit Eingabefelder öffnet sich.<br>
 	<b>Schritt 3: </b>Folgen Sie die Anweisungen in diesem Fenster oder clicken Sie den "Hilfe" Knopf an.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie trage ich Ein- bzw. Ausschleussezeiten, oder Schnitt- bzw. Nahtzeiten direkt ein?</b>
</font>
<ul>       	
 	<b>Einschleussezeit: </b>Trage die Zeit in das Feld "<span style="background-color:yellow" > Einschleußen:<input type="text" name="t" size=5 maxlength=5> </span>" ein.<br>
 	<b>Ausschleussezeit: </b>Trage die Zeit in das Feld "<span style="background-color:yellow" > Ausschleußen: <input type="text" name="t" size=5 maxlength=5> </span>" ein.<br>
 	<b>Schnittzeit: </b>Trage die Zeit in das Feld "<span style="background-color:yellow" > Schnitt: <input type="text" name="t" size=5 maxlength=5> </span>" ein.<br>
 	<b>Nahtzeit: </b>Trage die Zeit in das Feld "<span style="background-color:yellow" > Naht: <input type="text" name="t" size=5 maxlength=5> </span>" ein.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie trage ich gleichzeitig mehrere Zeitangaben ein?</b>
</font>
<ul> <b>Schritt 1: </b><p>    	
 	<b>Ein-/Ausschleußezeiten: </b>
 	Klickt die Option "<span style="background-color:yellow" > Ein/Aus <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>" auf der unteren linken Ecke.<p>
 	<b>Schnitt-/Nahtzeiten: </b>
 	Klickt die Option "<span style="background-color:yellow" > Schnitt/Nahtt <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>" auf der unteren linken Ecke.<p>
 	<b>Wartezeiten: </b>
 	Klickt die Option "<span style="background-color:yellow" > Wartezeit <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>" auf der unteren linken Ecke.<p>
 	<b>Gipszeiten </b>
 	Klickt die Option "<span style="background-color:yellow" > Gipsen <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>" auf der unteren linken Ecke.<p>
 	<b>Repositionszeiten: </b>
 	Klickt die Option "<span style="background-color:yellow" > Reposition <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>" auf der unteren linken Ecke.<p>
 	<b>Schritt 2: </b>Ein Fenster mit Eingebefeldern öffnet sich. <br>
 	<b>Schritt 3: </b>Folgen Sie die Anweisungen in diesem Fenster oder clicken Sie den "Hilfe" Knopf an.<br>
	</ul>

	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie trage ich die Zeit in den graphischen Zeitskala?</b>
</font>
<ul> <b>Schritt 1: </b>Bringe die Maus auf die Uhrzeit  auf dem Zeitskala.<br>
 	<b>Schritt 2: </b>Wenn die Maus auf die richtige Uhrzeit zeigt drucken Sie die linke Maustaste.<p>
<b>Achtung!</b> Der erste Klick wird die Anfangszeit sein, der zweite Klick die Endzeit, der dritte Klick die zweite Anfangszeit, und so weiter und so forth.
	</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie gebe ich die Therapie bzw. Eingriff ein?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Schreibe die Therapie bzw. Eingriff direkt in das Feld "<span style="background-color:yellow" > Therapie/Eingriff: </span>" ein.<br>
 	<b>Schritt 2: </b>Klickt den <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> Knopf an.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie gebe ich die Ergebnisse, Beobachtungen, zusätzliche Angaben ein?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Schreibe sie direkt in das Feld "<span style="background-color:yellow" > Ausgang: </span>" ein.<br>
 	<b>Schritt 2: </b>Klickt den <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> Knopf an.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie speichere ich das Dokument?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt den <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> Knopf an.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie starte ich ein neues Dokument für eine neue OP?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt den <img <?php echo createLDImgSrc('../','newpat2.gif','0') ?>> Knopf an.<br>
 	<b>Schritt 2: </b>Klick nochmal den <img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>> Knopf an um weitere Hilfsanweisungen zu lesen.<br>
	</ul>
	
<b>Achtung!</b>
<ul> Wenn Sie schliessen möchten klickt den <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> Knopf an.
</ul>
	<?php endif;?>

<?php endif;?>



<?php if($src=="search") : ?>
	<?php if(($x1=="fresh")||($x1=="")) : ?>


<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie finde ich ein OP Dokument von einem Patient?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>
	Gibt entweder eine vollständige Information oder die erste Zeichen von dem Namen, oder vom Namen, oder vom Geburtsdatum des Patienten in das Feld
	"<span style="background-color:yellow" > Stichwort: <input type="text" name="m" size=20 maxlength=20> </span>" ein. <br>
 	<b>Schritt 2: </b>Klickt den <input type="button" value="Suchen"> Knopf an.<p> 
<ul>       	
 	<b>Achtung! </b>Wenn die Suche einen exakten Vergleich findet, werden alle Dokumente von dem Patient augelistet.<p> 
 	<b>Achtung! </b>Wenn die Suche nur Annäherung findet wird eine Liste gezeigt. Klicken Sie den Eintrag in der Liste um dessen
	OP Dokument zu sehen.<p> 
	</ul>
</ul>
	<?php endif;?>
<?php if(($x1=="search")&&($x3!="1")) : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie wähle ich ein Dokument zum sehen aus?</b>
</font>
<ul>       	
 	<b>Achtung! </b> Klickt den Namen von dem Patient an.<p> 
</ul>

	<?php endif;?>
<?php if(($x1=="get")||($x3=="1")) : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie bearbeite ich ein Dokument das gerade angezeigt wird?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt den  <img <?php echo createComIcon('../','bul_arrowgrnlrg.gif','0') ?>> Knopf der OP Eintragung an.<br>
 	<b>Schritt 2: </b>Wenn der Bearbeitungsmodus aktiv ist können Sie die OP Angaben bearbeiten.<p> 
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie öffne ich die Patientenmappe?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klicken Sie den <img <?php echo createComIcon('../','info3.gif','0') ?>> Knopf vor der Fallnummer an.<br>
 	<b>Schritt 2: </b>Die Patientenmappe öffnet sich<br>
</ul>
<?php endif;?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie suche ich weiter?</b>
</font>
<ul>       	
	Gibt entweder eine vollständige Information oder die erste Zeichen von dem Namen, oder vom Namen, oder vom Geburtsdatum des Patienten in das Feld
	"<span style="background-color:yellow" > Stichwort: <input type="text" name="m" size=20 maxlength=20> </span>" ein. <br>
 	<b>Schritt 2: </b>Klickt den <input type="button" value="Suchen"> Knopf an.<p> 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Achtung!</b></font> 
<ul>       	
<ul> Wenn Sie schliessen möchten klickt den <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> Knopf an.
</ul>
<?php endif;?>

<?php if($src=="arch") : ?>
	<?php if($x2=="1") : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Achtung! Die letzte Eintragung im OP Logbuch.</b></font> 
<ul>  Jedes mal wenn Sie ins Archiv gehen, werden die letzte Eintragungen sofort angezeigt.
</ul>
	<?php endif;?>
	<?php if(($x3=="")&&($x1!="0")) : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Keine OP an diesem Tag.</b></font> 
<ul>       	
Klicken Sie die "Optionen" an um das Optionfenster zu öffnen.<br>
Klicken Sie die "Suchen" an um in den Suchmodus zu gehen.</ul>
	
	<?php endif;?>
	



<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Wie finde ich die OP Dokumente von einem anderen Datum im Archiv?.</b></font>
<ul>
 <b>Um den Vortag zu zeigen: </b>Klickt die Option "<span style="background-color:yellow" > << Vortag </span>" auf der oberen linken Spalte an. 
				Klick diese Option so oft wie nötig an bis der gewünschte Tag angezeigt ist.<p>
 <b>Um den nächsten Tag zu zeigen: </b>Klickt die Option "<span style="background-color:yellow" > Folgenden Tag >> </span>" auf der oberen rechten Spalte an. 
				Klick diese Option so oft wie nötig an bis der gewünschte Tag angezeigt ist.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Wie finde ich die OP Dokumente von einem anderen OP Saal bzw. Abteilung im Archiv?</b></font>
<ul> <b>Schritt 1: </b>Wähle die OP Abteilung aus dem Auswahlfeld <nobr>"<span style="background-color:yellow" > OP Abteilung bzw. Saal wechseln <select name="o">
                                                                                                                                         	<option > Beispiel Abteilung 1</option>
                                                                                                                                         	<option > Beispiel Abteilung 2</option>
                                                                                                                                         </select>
                                                                                                                                          </span>" aus.</nobr> 
	<br>Der standard OP Saal wird sich automatisch einstellen.<br>																																		  
	<b>Schritt 2: </b>Oder wähle den OP Saal aus dem Auswahlfeld<nobr>"<span style="background-color:yellow" > <select name="o">
                                                                                                                                         	<option > Beispiel OP 1</option>
                                                                                                                                         	<option > Beispiel OP 2</option>
                                                                                                                                         </select>
                                                                                                                                          </span>".</nobr> 
	<br> Die OP Abteilung zu der der Saal gehört stellt sich automatisch ein.<br>																																		  																																		  
		<b>Schritt 3: </b>Klickt den <input type="button" value="Wechseln">  Knopf an um in die andere Abteilung bzw. OP Saal zu wechseln.<br>
</ul>
<?php if(($x3!="")) : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie bearbeite ich ein Dokument das gerade angezeigt wird?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt den  <img <?php echo createComIcon('../','bul_arrowgrnlrg.gif','0') ?>> Knopf der OP Eintragung an.<br>
 	<b>Schritt 2: </b>Wenn der Bearbeitungsmodus aktiv ist können Sie die OP Angaben bearbeiten.<p> 
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie öffne ich die Patientenmappe?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klicken Sie den <img <?php echo createComIcon('../','info3.gif','0') ?>> Knopf vor der Fallnummer an.<br>
 	<b>Schritt 2: </b>Die Patientenmappe öffnet sich<br>
	</ul>
	<?php endif;?>
	
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Achtung!</b></font> 
<ul>       	
Wenn Sie abbrechen möchten klickt den <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> Knopf an.
</ul>


	<?php endif;?>


</form>

