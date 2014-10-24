<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
?>
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
Medizinisches Labor - 
<?php

if($src=="search")
{
	print "Suchen nach einem Patient";	
/*	switch($x1)
	{
	case "search": print "Selecting a particular document";
						break;
	case "": 
						break;
	case "get": print  "Patient's operation's log document";
						break;
	case "fresh": print "Search for a operation's log document";
	}
*/}

if($src=="input")
{
	print "Eingabe von neuen Labortestwerte";	
	/*switch($x1)
	{
	case "dummy": print "Archive";
						break;
	case "": print "Archive";
						break;
	case "?": print "Archive";
						break;
	case "search": print  "List of archive search results";
						break;
	case "select": print "Patient's document";
	}*/
}
 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >



<?php if($src=="search") : ?>
<?php if(($x2!="")&&($x2!="0")) : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie wähle ich einen Patient aus dessen Labortestwerte ich <?php if($x1=="edit") print "bearbeiten"; else print "sehen"; ?> möchte?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt den &nbsp;<button><img <?php echo createComIcon('../','update2.gif','0') ?>> <font size=1>Laborbefund</font></button> Knopf des Patienten den Sie <?php if($x1=="edit") print "bearbeiten"; else print "sehen"; ?> möchten.<p> 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie suche ich weiter?</b>
</font>
	<?php endif;?>
	<?php if(($x2=="")||($x2=="0")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie finde ich einen Patient?</b>
</font>
	<?php endif;?>
	
	<ul>       	
 	<b>Schritt 1: </b>Gibt entweder eine vollständige Information oder deren ersten Zeichen von dem Namen vom Patient, oder Vorname, oder 
	Geburtsdatum in das Feld"<span style="background-color:yellow" > Stichwort eingeben. <input type="text" name="m" size=20 maxlength=20> </span>" ein. <br>
 	<b>Schritt 2: </b>Klickt den <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> Knopf an um die Suchen nach dem Patient zu starten.<p> 
<ul>       	
 	<b>Achtung! </b>Wenn die Suche ein Ergebnis bzw. mehrere Ergebnisse liefert, wird eine Liste gezeigt.<p>
	</ul>
	<?php if(($x2=="")||($x2=="0")) : ?>
 	<b>Schritt 3: </b>Klickt den &nbsp;<button><img <?php echo createComIcon('../','update2.gif','0') ?>> <font size=1>Laborbefund</font></button> Knopf des Patienten den Sie <?php if($x1=="edit") print "bearbeiten"; else print "sehen"; ?> möchten.<p> 
	<?php endif;?>
</ul>

<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Achtung!</b></font> 
<ul>       	
Wenn Sie abbrechen möchten klickt den <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> Knopf an.
</ul>
<?php endif;?>


<?php if($src=="input") : ?>
	<?php if($x1=="main") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie gebe ich Labortestwerte ein?</b>
</font>
<ul>       	
		<?php if($x2=="") 
			print '
 			<b>Schritt 1: </b>Gibt die Auftragsnummer in das Feld "<span style="background-color:yellow" > Auftragsnummer: </span>" ein.<br>	
 			<b>Schritt 2: </b>Gibt falls erforderlich das Untersuchungsdatum in das Feld "<span style="background-color:yellow" > Untersuchungsdatum </span>" ein.<br>	';
	
		?>

	
 	<b>Schritt	<?php if($x2=="") 
			print "3"; else print "1";
		?>:</b> Gibt die Testwerte in die entsprechende Eingbefelder ein.<br>	
 	<b>Schritt <?php if($x2=="") 
			print "4"; else print "2";
		?>: </b>Klickt den <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> Knopf an um die Werte zu speichern.<p> 
 	<b>Achtung! </b>Wenn Sie die Werte gespeichert haben und die Eingabe beenden möchten,<br> klickt den <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> Knopf an.<br> 
</ul>
	<?php endif;?>
<?php if($x1=="few") : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ich muss nur ein Paar Werte eingeben. Wie soll ich das tun?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Gibt einfach die vorhandene Werte in die entsprechende Eingabefelder ein.<br> 
 	<b>Schritt 2: </b>Klickt den <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> Knopf an um die Werte zu speichern.<p> 
 	<b>Achtung! </b>Wenn Sie die Werte gespeichert haben und die Eingabe beenden möchten,<br> klickt den <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> Knopf an.<br> 
</ul>
	<?php endif;?>
	<?php if($x1=="param") : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Der Parameter den ich brauche ist nicht angezeigt! Wie kann ich die richtige Parametergruppe zeigen lassen?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Wähle die richtige Parametergruppe aus dem Auswahlfeld <nobr>"<span style="background-color:yellow" > Parametergruppe <select name="s">
     <option value="Sample parameter"> Beispiel Parameter</option> </select> </span>"</nobr> aus.<p> 
 	<b>Schritt 2: </b>Klickt den <img <?php echo createLDImgSrc('../','auswahl2.gif','0') ?>> Knopf an um die richtige Parametergruppe zu zeigen.<p> 
</ul>
	<?php endif;?>
	<?php if($x1=="save") : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie soll ich die Werte speichern?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt den <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> Knopf an um die Werte zu speichern.<p> 
 	<b>Achtung! </b>Wenn Sie die Werte gespeichert haben und die Eingabe beenden möchten,<br> klickt den <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> Knopf an.<br> 
</ul>
	<?php endif;?>
	<?php if($x1=="correct") : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ich habe einen falschen Wert eingegeben. Wie korrigiere ich das?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Löschen Sie einfach den falschen Wert und gibt den richtigen ein.<br> 
 	<b>Schritt 2: </b>Klickt den <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> Knopf an um die Werte zu speichern.<p> 
 	<b>Achtung! </b>Wenn Sie die Werte gespeichert haben und die Eingabe beenden möchten,<br> klickt den <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> Knopf an.<br> 
</ul>
	<?php endif;?>
	<?php if($x1=="note") : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ich muss einen Vermerk anstatt einen Wert eingeben. Wie geht das?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Tippen Sie einfach den Vermerk in das Eingabefeld ein.<br> 
 	<b>Schritt 2: </b>Klickt den <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> Knopf an um die Information zu speichern.<p> 
 	<b>Achtung! </b>Wenn Sie die Werte gespeichert haben und die Eingabe beenden möchten,<br> klickt den <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> Knopf an.<br> 
</ul>
	<?php endif;?>
	<?php if($x1=="done") : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ich bin fertig. Was nun?</b>
</font>
<ul>       	
 	<b>Schritt 2: </b>Klickt den <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> Knopf an um die Werte zu speichern.<p> 
 	<b>Achtung! </b>Klickt den <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> Knopf an.<br> 
</ul>
	<?php endif;?>
	

<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Achtung!</b></font> 
<ul>       	
Wenn Sie abbrechen möchten klickt den <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> Knopf an.
</ul>
<?php endif;?>
</form>

