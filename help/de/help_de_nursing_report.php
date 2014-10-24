<a name="howto">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b><?php if($x1=="docs") print "Äztliche Anordnung"; else print "Pflegebericht"; ?></b></font>
<form action="#" >
<p><font size=2 face="verdana,arial" >

<?php if($src=="") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie schreibe ich  <?php if($x1=="docs") print "eine ärztliche Anordnung"; else print "einen Pflegebericht"; ?>?</b></font>
<ul> 
	<b>Schritt 1: </b>Gibt das Datum in das Feld "<span style="background-color:yellow" > Datum: <input type="text" name="d" size=10 maxlength=10 value="10.10.2002"> </span>" in der "<?php if($x1=="docs") print "Ärztlichen Anordnung"; else print "Pflegebericht"; ?>" Spalte ein.<br>
		<font color="#000099" size=1><b>Tipps:</b>
		<ul type=disc>
		<li>Um das heutige Datum einzugeben, tippt "h" oder "H" (bedeutet HEUTE) in das Datum Feld ein. Das heutige Datum zeigt sich automatisch.
		<li>oder klickt den <img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Knopf unter dem Eingabefeld an. Das heutige Datum zeigt sich automatisch.
		<li>Um das Datum von gestern einzugeben, tippt "g" oder "G" (bedeutet GESTERN) in das Datum Feld ein. Das Datum von gestern zeigt sich automatisch.
		</font>
		</ul>
	<b>Schritt 2: </b>Gibt die Zeit in das Feld  "<span style="background-color:yellow" > Uhrzeit: <input type="text" name="d" size=5 maxlength=5 value="10.35"> </span>"  in der "<?php if($x1=="docs") print "Ärztlichen Anordnung"; else print "Pflegebericht"; ?>" Spalte ein.<br>
		<font color="#000099" size=1><b>Tipp:</b>
		<ul type=disc>
		<li>Um die aktuelle Zeit einzugeben, tippt "j" oder "J" (bedeutet JETZT) in das Zeit Feld ein. Die aktuelle Zeit zeigt sich automatisch.
		<li>oder klickt den <img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Knopf unter dem Eingabefeld an.  Die aktuelle Zeit zeigt sich automatisch.
		</font>
		</ul>
	<b>Schritt 3: </b>Schreiben sie <?php if($x1=="docs") print "die ärztlichen Anordnung"; else print "den Pflegebericht"; ?> in das Feld "<span style="background-color:yellow" > <?php if($x1=="docs") print "Ärztlichen Anordnung"; else print "Pflegebericht"; ?>: <input type="text" name="d" size=10 maxlength=10 value="test"> </span>".<br>
		<font color="#000099" size=1><b>Tips:</b>
		<ul type=disc>
		<li>Klicken Sie den Checkbox "<span style="background-color:yellow" > <input type="checkbox" name="c" value="c"> <img <?php echo createComIcon('../','warn.gif','0') ?>>Dieses Symbol vorm Bericht einfügen. </span>" an, wenn Sie möchten das das Symbol <img <?php echo createComIcon('../','warn.gif','0') ?>> vor <?php if($x1=="docs") print "der ärztlichen Anordung"; else print "dem Pflegebericht"; ?> steht.
		<li>Wenn Sie ein Teil  <?php if($x1=="docs") print "der Anordung"; else print "vom Bericht"; ?>  hervorheben möchten, klickt das Symbol <img <?php echo createComIcon('../','hilite-s.gif','0') ?>> an bevor Sie das Wort oder den Satz schreiben. Um die
		Hervorhebung zu beenden, klickt das Symbol <img <?php echo createComIcon('../','hilite-e.gif','0') ?>> an nachdem Sie das letzte Zeichen des hervorgehobenen Teils schrieben.
		</font>
		</ul>
	<b>Schritt 4: </b>Gibt Ihr Handzeichen (Abkürzung) in das Feld "<span style="background-color:yellow" > Hz: <input type="text" name="d" size=3 maxlength=3 value="ela"> </span>" ein.<br>
  		<b>Achtung! </b> Falls Sie abbrechen möchten den <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> anklicken.<br>
		<b>Schritt 5: </b>Klickt den <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> Knopf an um die Information zu speichern.<br>
		<b>Schritt 6: </b>Wenn Sie fertig sind klickt den <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> Knopf an um das Fenster zu schliessen und die Patientenmappe zu zeigen.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie schreibe ich <?php if($x1=="docs") print "eine Frage an den Arzt"; else print " einen Bericht über die Effektivität der Pflegeplanung"; ?>?</b></font>
<ul> 
	<b>Schritt 1: </b>Gibt das Datum in das Feld "<span style="background-color:yellow" > Datum: <input type="text" name="d" size=10 maxlength=10 value="10.10.2002"> </span>" in der "<?php if($x1=="docs") print "Fragen an den Arzt"; else print "Bericht über die Effektivität der Pflegeplanung"; ?>" Spalte ein.<br>
		<font color="#000099" size=1><b>Tipps:</b>
		<ul type=disc>
		<li>Um das heutige Datum einzugeben, tippt "h" oder "H" (bedeutet HEUTE) in das Datum Feld ein. Das heutige Datum zeigt sich automatisch.
		<li>oder klickt den <img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Knopf unter dem Eingabefeld an. Das heutige Datum zeigt sich automatisch.
		<li>Um das Datum von gestern einzugeben, tippt "g" oder "G" (bedeutet GESTERN) in das Datum Feld ein. Das Datum von gestern zeigt sich automatisch.
		</font>
		</ul>
	<b>Schritt 2: </b>Schreiben sie <?php if($x1=="docs") print "die Frage"; else print "den Bericht"; ?> in das Feld "<span style="background-color:yellow" > <?php if($x1=="docs") print "Fragen an den Arzt"; else print "Bericht über die Effektivität der Pflegeplanung"; ?>: <input type="text" name="d" size=10 maxlength=10 value="test"> </span>".<br>
		<font color="#000099" size=1><b>Tips:</b>
		<ul type=disc>
		<li>Klicken Sie den Checkbox "<span style="background-color:yellow" > <input type="checkbox" name="c" value="c"> <img <?php echo createComIcon('../','warn.gif','0') ?>>Dieses Symbol vorm Bericht einfügen. </span>" an, wenn Sie möchten das das Symbol <img <?php echo createComIcon('../','warn.gif','0') ?>> vor <?php if($x1=="docs") print "der Frage"; else print "dem Bericht"; ?> steht.
		<li>Wenn Sie ein Teil  <?php if($x1=="docs") print "von der Frage"; else print "von dem Bericht"; ?>  hervorheben möchten, klickt das Symbol <img <?php echo createComIcon('../','hilite-s.gif','0') ?>> an bevor Sie das Wort oder den Satz schreiben. Um die
		Hervorhebung zu beenden, klickt das Symbol <img <?php echo createComIcon('../','hilite-e.gif','0') ?>> an nachdem Sie das letzte Zeichen des hervorgehobenen Teils schrieben.
		</font>
		</ul>
	<b>Schritt 3: </b>Gibt Ihr Handzeichen (Abkürzung) in das Feld "<span style="background-color:yellow" > Hz: <input type="text" name="d" size=3 maxlength=3 value="ela"> </span>" ein.<br>
  		<b>Achtung! </b> Falls Sie abbrechen möchten den <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> anklicken.<br>
		<b>Schritt 4: </b>Klickt den <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> Knopf an um die Information zu speichern.<br>
		<b>Schritt 5: </b>Wenn Sie fertig sind klickt den <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> Knopf an um das Fenster zu schliessen und die Patientenmappe zu zeigen.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Achtung!</b></font>
<ul> 
	Sie können auch beide <?php if($x1=="docs") print "ärztliche Anordnung und Fragen and den Arzt"; else print "Pflegebericht und Bericht über die Effektivität der Pflegeplanung"; ?> gleichzeitig schreiben.</ul>

<?php endif;?>

<?php if($src=="fotos") : ?>
<a name="coag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Wie kann ich die Vorschau zeigen lassen?</b></font>
<ul> 
	<b>Step 1: </b>Klicken Sie das Kleinbild auf dem linken Rahmen. Das Vollbild wird auf dem rechten Rahmen gezeigt.<br>
</ul>
<?php endif;?>
</form>

