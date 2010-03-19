<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
?>
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Suchen nach einem Medocs Dokument</b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<?php if(($src=="?")||($x1=="0")) : ?>
<b>Schritt 1</b>

<ul>Geben Sie in das Feld "<span style="background-color:yellow" >Medocs Dokument von:</span>" entweder eine vollständige Information oder die erste Zeichen von der Fallnummer, oder dem Namen, oder Vornamen vom Patienten 
 ein.
		<p>Beispiel 1: "21000012" oder "12".
		<br>Beispiel 2: "Guerero" oder "gue".
		<br>Beispiel 3: "Alfredo" oder "Alf".
		
</ul>
<b>Schritt 2</b>
<ul> Den <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> anklicken.<p>
</ul>
<b>Schritt 3</b>

<ul> Wenn die Suche ein einziges Ergebnis findet werden die Daten sofort gezeigt.<p>
		Wenn die Suche allerdings mehrere Ergebnisse liefert wird eine Liste gezeigt.<br>
		Um das Dokument eines Patienten zu sehen, den nebenstehenden <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> , oder
		den Namen, oder die Dokumentnummer, oder die Zeit anklicken.
</ul>
<?php endif;?>
<?php if($x1>1) : ?>
		Um das Dokument eines Patienten zu sehen, den nebenstehenden <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> , oder
		den Namen, oder die Dokumentnummer, oder die Zeit.
<?php endif;?>
<?php if(($src!="?")&&($x1=="1")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Wie kann ich das Dokument aktualisieren bzw. ändern?</b></font>
<ul> Den <input type="button" value="Daten aktualisieren"> anklicken.
</ul>
<?php endif;?><p>
<b>Achtung!</b>
<ul> Falls Sie abbrechen möchten den <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> anklicken.
</ul>


</form>

