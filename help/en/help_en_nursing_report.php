<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<a name="howto">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b><?php if($x1=="docs") print "Physician orders"; else print "Nursing report"; ?></b></font>
<form action="#" >
<p><font size=2 face="verdana,arial" >

<?php if($src=="") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to enter a <?php if($x1=="docs") print "physician orders"; else print "nursing report"; ?>?</b></font>
<ul> 
	<b>Step 1: </b>Enter the date in the "<span style="background-color:yellow" > Date: <input type="text" name="d" size=10 maxlength=10 value="10.10.2002"> </span>" field in the "<?php if($x1=="docs") print "physician orders"; else print "Nursing report"; ?>" column.<br>
		<font color="#000099" size=1><b>Tips:</b>
		<ul type=disc>
		<li>To enter the current date, type "t" or "T" (meaning TODAY) in the date field. The current date will appear automatically in the date field.
		<li>Or click on the button <img <?php echo createComIcon('../','arrow-t.gif','0') ?>> below the field. The current date will appear automatically in the date field.
		<li>To enter yesterday's date, type "y" or "Y" (meaning YESTERDAY) in the date field. Yesterday's date will appear automatically in the date field.
		</font>
		</ul>
	<b>Step 2: </b>Enter the time in the "<span style="background-color:yellow" > Time: <input type="text" name="d" size=5 maxlength=5 value="10.35"> </span>" field in the "<?php if($x1=="docs") print "physician orders"; else print "Nursing report"; ?>" column.<br>
		<font color="#000099" size=1><b>Tip:</b>
		<ul type=disc>
		<li>To enter the current time, type "n" or "N" (meaning NOW) in the time field. The current time will appear automatically in the time field.
		<li>Or click on the button <img <?php echo createComIcon('../','arrow-t.gif','0') ?>> below the time field. The current time will appear automatically in the time field.
		</font>
		</ul>
	<b>Step 3: </b>Type the <?php if($x1=="docs") print "physician orders"; else print "nursing report"; ?> in the "<span style="background-color:yellow" > <?php if($x1=="docs") print "physician orders"; else print "Nursing report"; ?>: <input type="text" name="d" size=10 maxlength=10 value="test report"> </span>" field.<br>
		<font color="#000099" size=1><b>Tips:</b>
		<ul type=disc>
		<li>Click the checkbox "<span style="background-color:yellow" > <input type="checkbox" name="c" value="c"> <img <?php echo createComIcon('../','warn.gif','0') ?>>Place this symbol at the start. </span>", if you want that the symbol <img <?php echo createComIcon('../','warn.gif','0') ?>> appears at the start of the <?php if($x1=="docs") print "physician orders"; else print "nursing report"; ?>.
		<li>If you want to highlight part of the <?php if($x1=="docs") print "directive or"; ?> report, click the icon <img <?php echo createComIcon('../','hilite-s.gif','0') ?>> before typing the word or sentence. To end the
		highlight, click the icon <img <?php echo createComIcon('../','hilite-e.gif','0') ?>> after typing the last letter of the highlighted part.
		</font>
		</ul>
	<b>Step 4: </b>Enter your name initials in the "<span style="background-color:yellow" > Sign: <input type="text" name="d" size=3 maxlength=3 value="ela"> </span>" field.<br>
  		<b>Note: </b>If you want to cancel, click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.<br>
		<b>Step 5: </b>Click the button <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> to save the information.<br>
		<b>Step 6: </b>If you are finished, click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> to close the window and go back to the patient's data folder.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to enter <?php if($x1=="docs") print "an inquiry to the physician"; else print "an effectivity report"; ?>?</b></font>
<ul> 
	<b>Step 1: </b>Enter the date in the "<span style="background-color:yellow" > Date: <input type="text" name="d" size=10 maxlength=10 value="10.10.2002"> </span>" field in the "<?php if($x1=="docs") print "Inquiries to the physician"; else print "Effectivity report"; ?>" column.<br>
		<font color="#000099" size=1><b>Tips:</b>
		<ul type=disc>
		<li>To enter the current date, type "t" or "T" (meaning TODAY) in the date field. The current date will appear automatically in the date field.
		<li>Or click on the button <img <?php echo createComIcon('../','arrow-t.gif','0') ?>> below the field. The current date will appear automatically in the date field.
		<li>To enter yesterday's date, type "y" or "Y" (meaning YESTERDAY) in the date field. Yesterday's date will appear automatically in the date field.
		</font>
		</ul>
	<b>Step 2: </b>Type the <?php if($x1=="docs") print "inquiry"; else print "effectivity report"; ?> in the "<span style="background-color:yellow" > <?php if($x1=="docs") print "Inquiries to the physician"; else print "Effectivity report"; ?>: <input type="text" name="d" size=10 maxlength=10 value="test report"> </span>" field.<br>
		<font color="#000099" size=1><b>Tips:</b>
		<ul type=disc>
		<li>Click the checkbox "<span style="background-color:yellow" > <input type="checkbox" name="c" value="c"> <img <?php echo createComIcon('../','warn.gif','0') ?>>Place this symbol at the start. </span>", if you want that the symbol <img <?php echo createComIcon('../','warn.gif','0') ?>> appears at the start of the <?php if($x1=="docs") print "inquiry"; else print "effectivity report"; ?>.
		<li>If you want to highlight part of the <?php if($x1=="docs") print "directive or"; ?> report, click the icon <img <?php echo createComIcon('../','hilite-s.gif','0') ?>> before typing the word or sentence. To end the
		highlight, click the icon <img <?php echo createComIcon('../','hilite-e.gif','0') ?>> after typing the last letter of the highlighted part.
		</font>
		</ul>
	<b>Step 3: </b>Enter your name initials in the "<span style="background-color:yellow" > Sign: <input type="text" name="d" size=3 maxlength=3 value="ela"> </span>" field.<br>
  		<b>Note: </b>If you want to cancel, click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.<br>
		<b>Step 4: </b>Click the button <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> to save the information.<br>
		<b>Step 5: </b>If you are finished, click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> to close the window and go back to the patient's data folder.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
NOTE:</b></font>
<ul> 
	You can also enter both the <?php if($x1=="docs") print "physician orders and inquiries to the physician"; else print "nursing and effectivity report"; ?> at the same time.</ul>

<?php endif;?>
<?php if($src=="diagnosis") : ?>
<a name="extra"><a name="diag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a></a>
How to display a diagnostic report?</b></font>
<ul> 
  		<b>Note: </b>If a diagnostic report is available, a short note of its creation date and the diagnostic clinic or department that created it will be displayed on the left column.<p>
  		<b>Note: </b>The first report on the list will be displayed immediately.<p>
	<b>Step 1: </b>Click on the short note of the diagnostic report you wish to display.<br>	
</ul>
<?php endif;?>
<?php if($src=="kg_atg_etc") : ?>
<a name="pt"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
How to enter  information on daily physical therapy (PT), anti-thrombosis gymnastic (Atg), etc.?</b></font>
<ul> 
	<b>Step 1: </b>Type the information in the<br> "<span style="background-color:yellow" > Please enter new information here: </span>" field.<br>
  		<b>Note: </b>You can also edit the current entries in the "<span style="background-color:yellow" > Current entries: </span>" field if necessary.<br>
  		<b>Note: </b>If you want to cancel, click the button <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>Step 2: </b>Click the button <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> to save the information.<br>
		<b>Step 3: </b>If you want to correct any errors, click on the erroneous data and replace it with the correct one and save again.<br>
		<b>Step 4: </b>If you are finished, click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> to close the window and go back to the chart.<br>
		
</ul>
<?php endif;?>
<?php if($src=="fotos") : ?>
<a name="coag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
How to preview a photo?</b></font>
<ul> 
	<b>Step 1: </b>Click on a thumbnail on the left frame. The full size image will be displayed on the right frame including the shot date and shot number.<br>
</ul>
<?php endif;?>
<?php if($src=="anticoag_dailydose") : ?>
<a name="daycoag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
How to enter information on daily anticoagulant application?</b></font>
<ul> 
	<b>Step 1: </b>Type either the dosage, or applicator information in the<br> "<span style="background-color:yellow" > Enter the new information here or edit the current entries: </span>" field.<br>
  		<b>Note: </b>If you want to cancel, click the button <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>Step 2: </b>Click the button <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> to save the information.<br>
		<b>Step 3: </b>If you want to correct any errors, click on the erroneous data and replace it with the correct one and save again.<br>
		<b>Step 4: </b>If you are finished, click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> to close the window and go back to the chart.<br>
		
</ul>
<?php endif;?>
<?php if($src=="lot_mat_etc") : ?>
<a name="lot"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
How to enter notes on implants, LOT nr, charge nr, etc?</b></font>
<ul> 
	<b>Step 1: </b>Type the information on the LOT, charge nr, implants in the<br> "<span style="background-color:yellow" > Please enter new information here: </span>" field.<br>
  		<b>Note: </b>You can also edit the current entries in the "<span style="background-color:yellow" > Current entries: </span>" field if necessary.<br>
  		<b>Note: </b>If you want to cancel, click the button <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>Step 2: </b>Click the button <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> to save the information.<br>
		<b>Step 3: </b>If you want to correct any errors, click on the erroneous data and replace it with the correct one and save again.<br>
		<b>Step 4: </b>If you are finished, click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> to close the window and go back to the chart.<br>
		
</ul>
<?php endif;?>
<?php if($src=="medication") : ?>
<a name="med"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
How to enter  medication and dosage plan?</b></font>
<ul> 
	<b>Step 1: </b>Type the medication on the left column.<br> 
	<b>Step 2: </b>Type the dosage plan on the middle column.<br> 
	<b>Step 3: </b>Click the radiobutton of the color coding for the medication if necessary.<br> 
	<ul type=disc>
		<li>White for normal or default.
		<li><span style="background-color:#00ff00" >Green</span> for antibiotics and their derivatives.
		<li><span style="background-color:yellow" >Yellow</span> for dialytic medicines.
		<li><span style="background-color:#0099ff" >Blue</span> for hemolytic (coagulant or anticoagulant) medicines.
		<li><span style="background-color:#ff0000" >Red</span> for intravenous applied medicines.
	</ul>
  	<b>Note: </b>You can also edit the current entries if necessary.<br>
	<b>Step 4: </b>Enter your name in the "<span style="background-color:yellow" > Nurse: </span>" field.<br> 
  		<b>Note: </b>If you want to cancel, click the button <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>Step 5: </b>Click the button <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> to save the medication plan.<br>
		<b>Step 6: </b>If you want to correct any errors, click on the erroneous data and replace it with the correct one and save again.<br>
		<b>Step 7: </b>If you are finished, click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> to close the window and go back to the chart.<br>
		
</ul>
<?php endif;?>
<?php if($src=="medication_dailydose") : ?>
	<?php if($x2) : ?>

<a name="daymed"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
How to enter information on daily medication application and dosage?</b></font>
<ul> 
	<b>Step 1: </b>Click the entry field corresponding to the chosen medication.<br>
	<b>Step 2: </b>Type either the dosage, applicator information, or start/end symbols in the field.<br>
  		<b>Note: </b>If you want to cancel, click the button <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>Step 3: </b>If you have several entries, enter all of them before saving.<br>
		<b>Step 4: </b>Click the button <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> to save the information.<br>
		<b>Step 5: </b>If you want to correct any errors, click on the erroneous data and replace it with the correct one and save again.<br>
		<b>Step 6: </b>If you are finished, click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> to close the window and go back to the chart.<br>
		
</ul>
	<?php else : ?>
<a name="daymed"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
It says "There is no medication yet". What should I do?</b></font>
<ul> 
		<b>Step 1: </b>Click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> to close the pop-up window and go back to the chart.<br>
	<b>Step 2: </b>Click the "<span style="background-color:yellow" > Medication </span>".<br>
	<b>Step 3: </b>A pop-up window will appear showing the entry fields for medication and dosage plan.<br>
	<b>Step 4: </b>Type the medication on the left column.<br> 
	<b>Step 5: </b>Type the dosage plan on the middle column.<br> 
	<b>Step 6: </b>Click the radiobutton of the color coding for the medication if necessary.<br> 
	<ul type=disc>
		<li>White for normal or default.
		<li><span style="background-color:#00ff00" >Green</span> for antibiotics and their derivatives.
		<li><span style="background-color:yellow" >Yellow</span> for dialytic medicines.
		<li><span style="background-color:#0099ff" >Blue</span> for hemolytic (coagulant or anticoagulant) medicines.
		<li><span style="background-color:#ff0000" >Red</span> for intravenous applied medicines.
	</ul>
  	<b>Note: </b>You can also edit the current entries <br>if necessary.<br>
	<b>Step 7: </b>Enter your name in the "<span style="background-color:yellow" > Nurse: </span>" field.<br> 
  		<b>Note: </b>If you want to cancel, click the button <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>Step 8: </b>Click the button <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> to save the medication plan.<br>
		<b>Step 9: </b>If you want to correct any errors, click on the erroneous data and replace it with the correct one and save again.<br>
		<b>Step 10: </b>If you are finished, click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> to close the window and go back to the chart.<br>
</ul>
	<?php endif;?>
<?php endif;?>
<?php if($src=="iv_needle") : ?>
<a name="iv"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
How to enter information on daily intravenous medication application and dosage?</b></font>
<ul> 
	<b>Step 1: </b>Type either the dosage, applicator information, or start/end symbols in the "<span style="background-color:yellow" > Enter the new information here or edit the current entries: </span>" field.<br>
  		<b>Note: </b>If you want to cancel, click the button <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>Step 2: </b>Click the button <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> to save the information.<br>
		<b>Step 3: </b>If you want to correct any errors, click on the erroneous data and replace it with the correct one and save again.<br>
		<b>Step 4: </b>If you are finished, click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> to close the window and go back to the chart.<br>
		
</ul>

<?php endif;?>

</form>

