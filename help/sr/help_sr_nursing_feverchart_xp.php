<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<a name="howto">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b><?php echo "$x3" ?></b></font>
<form action="#" >
<p><font size=2 face="verdana,arial" >

<?php if($src=="bp_temp") : ?>
<a name="cbp"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
How to enter a temperature or blood pressure?</b></font>
<ul> <b>Step 1: </b>Enter the time and data.<br>
		<ul type="disc">
		<li>Enter the time and blood pressure on the left "<font color="#cc0000">Blood pressure</font>" column.<br>
		Example: <input type="text" name="v" size=5 maxlength=5 value="10.05">&nbsp;&nbsp;<input type="text" name="w" size=8 maxlength=8 value="128/85">
		<li>Enter the time and temperature on the right "<font color="#0000ff">Temperature</font>" column.<br>
		Example: <input type="text" name="t" size=5 maxlength=5 value="12.35">&nbsp;&nbsp;<input type="text" name="u" size=8 maxlength=8 value="37.3">
		</ul>		
		<ul >
		<font color="#000099" size=1><b>Tip:</b> To enter the current time, type "n" or "N" (meaning NOW) in the time field. The exact current
		time will appear automatically in that field.</font>
		</ul>
		<b>Step 2: </b>If you have several data, enter all of them before you save.<br>
		<b>Step 3: </b>Click the button <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> to save the newly entered data.<br>
		<b>Step 4: </b>If you want to correct any errors, click on the erroneous data, replace it with the correct one and save again.<br>
		<b>Step 5: </b>If you are finished, click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> to close the window and go back to the chart.<br>
		
</ul>
<?php endif;?>
<?php if($src=="diet") : ?>

<a name="diet"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
How to enter a diet plan?</b></font>
<ul> <b>Step 1: </b>Enter the diet plan in the<br> "<span style="background-color:yellow" > Enter the new information here or edit the current entries </span>" field.<br>
		<b>Step 2: </b>Click the button <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> to save the new diet plan.<br>
  		<b>Note: </b>If you want to cancel, click the button <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>Step 3: </b>If you want to correct any errors, click on the erroneous data, replace it with the correct one and save again.<br>
		<b>Step 4: </b>If you are finished, click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> to close the window and go back to the chart.<br>
		
</ul>
<?php endif;?>
<?php if($src=="allergy") : ?>
<a name="allergy"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
How to enter allergy information?</b></font>
<ul> 
	<b>Step 1: </b>Type the allergy or CAVE information in the<br> "<span style="background-color:yellow" > Please enter new information here: </span>" field.<br>
  		<b>Note: </b>You can also edit the current entries in the "<span style="background-color:yellow" > Current entries: </span>" field if necessary.<br>
  		<b>Note: </b>If you want to cancel, click the button <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>Step 2: </b>Click the button <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> to save the information.<br>
		<b>Step 3: </b>If you want to correct any errors, click on the erroneous data and replace it with the correct one and save again.<br>
		<b>Step 4: </b>If you are finished, click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> to close the window and go back to the chart.<br>
		
</ul>
<?php endif;?>
<?php if($src=="diag_ther") : ?>
<a name="diag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
How to enter main diagnosis and/or therapy?</b></font>
<ul> 
	<b>Step 1: </b>Type the diagnosis or therapy information in the<br> "<span style="background-color:yellow" > Please enter new information here: </span>" field.<br>
  		<b>Note: </b>You can also edit the current entries in the "<span style="background-color:yellow" > Current entries: </span>" field if necessary.<br>
  		<b>Note: </b>If you want to cancel, click the button <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>Step 2: </b>Click the button <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> to save the information.<br>
		<b>Step 3: </b>If you want to correct any errors, click on the erroneous data and replace it with the correct one and save again.<br>
		<b>Step 4: </b>If you are finished, click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> to close the window and go back to the chart.<br>
		
</ul>
<?php endif;?>
<?php if($src=="diag_ther_dailyreport") : ?>
<a name="daydiag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
How to enter information on daily diagnosis or therapy plan?</b></font>
<ul> 
	<b>Step 1: </b>Type the diagnosis or therapy information in the<br> "<span style="background-color:yellow" > Please enter new information here: </span>" field.<br>
  		<b>Note: </b>You can also edit the current entries in the "<span style="background-color:yellow" > Current entries: </span>" field if necessary.<br>
  		<b>Note: </b>If you want to cancel, click the button <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>Step 2: </b>Click the button <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> to save the information.<br>
		<b>Step 3: </b>If you want to correct any errors, click on the erroneous data and replace it with the correct one and save again.<br>
		<b>Step 4: </b>If you are finished, click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> to close the window and go back to the chart.<br>
		
</ul>
<?php endif;?>
<?php if($src=="xdiag_specials") : ?>
<a name="extra"><a name="diag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a></a>
How to enter notes, extra diagnoses?</b></font>
<ul> 
	<b>Step 1: </b>Type the notes or extra diagnoses in the<br> "<span style="background-color:yellow" > Please enter new information here: </span>" field.<br>
  		<b>Note: </b>You can also edit the current entries in the "<span style="background-color:yellow" > Current entries: </span>" field if necessary.<br>
  		<b>Note: </b>If you want to cancel, click the button <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>Step 2: </b>Click the button <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> to save the information.<br>
		<b>Step 3: </b>If you want to correct any errors, click on the erroneous data and replace it with the correct one and save again.<br>
		<b>Step 4: </b>If you are finished, click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> to close the window and go back to the chart.<br>
		
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
<?php if($src=="anticoag") : ?>
<a name="coag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
How to enter anticoagulants?</b></font>
<ul> 
	<b>Step 1: </b>Type the information on the anticoagulants and or dosage in the<br> "<span style="background-color:yellow" > Please enter new information here: </span>" field.<br>
  		<b>Note: </b>You can also edit the current entries in the "<span style="background-color:yellow" > Current entries: </span>" field if necessary.<br>
  		<b>Note: </b>If you want to cancel, click the button <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>Step 2: </b>Click the button <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> to save the information.<br>
		<b>Step 3: </b>If you want to correct any errors, click on the erroneous data and replace it with the correct one and save again.<br>
		<b>Step 4: </b>If you are finished, click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> to close the window and go back to the chart.<br>
		
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

