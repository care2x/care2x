<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<a name="howto">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b><?php echo "$x3" ?></b></font>
<form action="#" >
<p><font size=2 face="verdana,arial" >

<?php if($src=="main") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to...?</b></font>
<ul type="disc"> 
		<li><a href="#cbp">enter temperature or blood pressure.</a>
		<li><a href="#movedate">move or change the chart's date.</a>
		<li><a href="#diet">enter a diet plan.</a>
		<li><a href="#allergy">enter allergy information.</a>
		<li><a href="#diag">enter main diagnosis or therapy.</a>
		<li><a href="#daydiag">enter information on daily diagnosis or therapy plan.</a>
		<li><a href="#extra">enter notes, extra diagnoses, etc.</a>
		<li><a href="#pt">enter information on daily physical therapy (Pt), anti-thrombosis gymnastik (ATg), etc.</a>
		<li><a href="#coag">enter anticoagulants.</a>
		<li><a href="#daycoag">enter information on daily anticoagulant application.</a>
		<li><a href="#lot">enter notes on implants, LOT nr, charge nr, etc.</a>
		<li><a href="#med">enter medication and dosage plan.</a>
		<li><a href="#daymed">enter information on daily medication application and dosage.</a>
		<li><a href="#iv">enter information on daily intravenous medication plan and dosage.</a>
</ul>		
<hr>
<a name="cbp"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
How to enter a temperature or blood pressure?</b></font>
<ul> <b>Step 1: </b>Click on the chart area corresponding to the chosen date.<br>
		<b>Step 2: </b>A pop-up window for entering the temperature and/or blood pressure data will appear.<br>
		<b>Step 3: </b>Enter the data and the time.<br>
		<ul type="disc">
		<li>Enter the time and temperature on the right "<font color="#0000ff">Temperature</font>" column.<br>
		Example: <input type="text" name="t" size=5 maxlength=5 value="12.35">&nbsp;&nbsp;<input type="text" name="u" size=8 maxlength=8 value="37.3">
		<li>Enter the time and blood pressure on the left "<font color="#cc0000">Blood pressure</font>" column.<br>
		Example: <input type="text" name="v" size=5 maxlength=5 value="10.05">&nbsp;&nbsp;<input type="text" name="w" size=8 maxlength=8 value="128/85">
		</ul>		
		<ul >
		<font color="#000099" size=1><b>Tip:</b> To enter the current time, type "n" or "N" (meaning NOW) in the time field. The exact current
		time will appear automatically in that field.</font>
		</ul>
		<b>Step 4: </b>If you have several data, enter all of them before you save.<br>
		<b>Step 5: </b>Click the button <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> to save the newly entered data.<br>
		<b>Step 6: </b>If you want to correct any errors, click on the erroneous data and replace it with the correct one.<br>
		<b>Step 5: </b>If you are finished, click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> to close the window and go back to the chart.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Back to "How to...?"</a></font>
</ul>
<a name="movedate"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
How to move or change the chart's date?</b></font>
<ul> 
	<li><font color="#660000"><b>To move the date one day backward:</b></font><br>
	<b>Step 1: </b>Click on the <img <?php echo createComIcon('../','l_arrowgrnsm.gif','0') ?>> icon on the <span style="background-color:yellow" >leftmost</span> date column of the chart.<p>
	<li><font color="#660000"><b>To move the date one day forward:</b></font><br>
	<b>Step 1: </b>Click on the <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0') ?>> icon on the <span style="background-color:yellow" >rightmost</span> date column of the chart.
                                                                     <p>
	<li><font color="#660000"><b>To directly set the chart's starting date:</b></font><br>
	<b>Step 1: </b>Click the <span style="background-color:yellow" >right mouse button</span> on the <img <?php echo createComIcon('../','l_arrowgrnsm.gif','0') ?>> icon on the <span style="background-color:yellow" >leftmost</span> date column of the chart.<br>
	<b>Step 2: </b>Click <input type="button" value="OK"> when asked for confirmation.<br>
	<b>Step 3: </b>A small pop-up window will appear showing the selection fields for the starting date.<br>
	<b>Step 4: </b>Select the day, month, and year.<br>
	<b>Step 5: </b>Click the button <input type="button" value="GO"> to enable the change.<br>
	The small window will automatically close and the chart will adjust to the date's change.<p>
	
	<li><font color="#660000"><b>To directly set the chart's end date:</b></font><br>
	<b>Step 1: </b>Click the <span style="background-color:yellow" >right mouse button</span> on the <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0') ?>> icon on the <span style="background-color:yellow" >rightmost</span> date column of the chart.<br>
	<b>Step 2: </b>Click <input type="button" value="OK"> when asked for confirmation.<br>
	<b>Step 3: </b>A small pop-up window will appear showing the selection fields for the end date.<br>
	<b>Step 4: </b>Select the day, month, and year.<br>
	<b>Step 5: </b>Click the button <input type="button" value="GO"> to enable the change.<br>
	The small window will automatically close and the chart will adjust to the date's change.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Back to "How to...?"</a></font>
</ul>
<a name="diet"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
How to enter a diet plan?</b></font>
<ul> <b>Step 1: </b>Click on the "<span style="background-color:yellow" > Diet plan </span>" corresponding to the chosen date.<br>
		<b>Step 2: </b>A pop-up window for entering or editing the diet plan will appear.<br>
		<b>Step 3: </b>Enter the diet plan.<br>
		<b>Step 4: </b>Click the button <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> to save the newly entered diet plan.<br>
  		<b>Note: </b>If you want to cancel, click the button <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>Step 5: </b>If you want to correct any errors, click on the erroneous data and replace it with the correct one.<br>
		<b>Step 6: </b>If you are finished, click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> to close the window and go back to the chart.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Back to "How to...?"</a></font>
</ul>
<a name="allergy"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
How to enter allergy information?</b></font>
<ul> 
	<b>Step 1: </b>Click the <img <?php echo createComIcon('../','clip.gif','0') ?>> (clip) icon on the "<span style="background-color:yellow" > Allergy <img <?php echo createComIcon('../','clip.gif','0') ?>> </span>".<br>
	<b>Step 2: </b>A pop-up window will appear showing the entry field for allergy information.<br>
	<b>Step 3: </b>Type the allergy or CAVE information in the<br> "<span style="background-color:yellow" > Please enter new information here: </span>" field.<br>
  		<b>Note: </b>You can also edit the current entries <br>in the "<span style="background-color:yellow" > Current entries: </span>" field if necessary.<br>
  		<b>Note: </b>If you want to cancel, click the button <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>Step 4: </b>Click the button <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> to save the information.<br>
		<b>Step 5: </b>If you want to correct any errors, click on the erroneous data and replace it with the correct one and save again.<br>
		<b>Step 6: </b>If you are finished, click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> to close the window and go back to the chart.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Back to "How to...?"</a></font>
</ul>

<a name="diag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
How to enter main diagnosis and/or therapy?</b></font>
<ul> 
	<b>Step 1: </b>Click the <img <?php echo createComIcon('../','clip.gif','0') ?>> (clip) icon on the "<span style="background-color:yellow" > Diagnosis/Therapy <img <?php echo createComIcon('../','clip.gif','0') ?>> </span>".<br>
	<b>Step 2: </b>A pop-up window will appear showing the entry field for diagnosis/therapy information.<br>
	<b>Step 3: </b>Type the diagnosis or therapy information in the<br> "<span style="background-color:yellow" > Please enter new information here: </span>" field.<br>
  		<b>Note: </b>You can also edit the current entries <br>in the "<span style="background-color:yellow" > Current entries: </span>" field if necessary.<br>
  		<b>Note: </b>If you want to cancel, click the button <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>Step 4: </b>Click the button <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> to save the information.<br>
		<b>Step 5: </b>If you want to correct any errors, click on the erroneous data and replace it with the correct one and save again.<br>
		<b>Step 6: </b>If you are finished, click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> to close the window and go back to the chart.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Back to "How to...?"</a></font>
</ul>
<a name="daydiag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
How to enter information on daily diagnosis or therapy plan?</b></font>
<ul> 
	<b>Step 1: </b>Click either the empty column or the existing daily diagnosis/therapy corresponding to the chosen date.<br>
	<b>Step 2: </b>A pop-up window will appear showing the entry field for diagnosis/therapy information for the chosen date.<br>
	<b>Step 3: </b>Type the diagnosis or therapy information in the<br> "<span style="background-color:yellow" > Please enter new information here: </span>" field.<br>
  		<b>Note: </b>You can also edit the current entries <br>in the "<span style="background-color:yellow" > Current entries: </span>" field if necessary.<br>
  		<b>Note: </b>If you want to cancel, click the button <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>Step 4: </b>Click the button <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> to save the information.<br>
		<b>Step 5: </b>If you want to correct any errors, click on the erroneous data and replace it with the correct one and save again.<br>
		<b>Step 6: </b>If you are finished, click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> to close the window and go back to the chart.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Back to "How to...?"</a></font>
</ul>
<a name="extra"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
How to enter notes, extra diagnoses?</b></font>
<ul> 
	<b>Step 1: </b>Click the <img <?php echo createComIcon('../','clip.gif','0') ?>> (clip) icon on the "<span style="background-color:yellow" > Notes, extra diagnoses <img <?php echo createComIcon('../','clip.gif','0') ?>> </span>".<br>
	<b>Step 2: </b>A pop-up window will appear showing the entry field for notes and extra diagnoses.<br>
	<b>Step 3: </b>Type the notes or extra diagnoses in the<br> "<span style="background-color:yellow" > Please enter new information here: </span>" field.<br>
  		<b>Note: </b>You can also edit the current entries <br>in the "<span style="background-color:yellow" > Current entries: </span>" field if necessary.<br>
  		<b>Note: </b>If you want to cancel, click the button <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>Step 4: </b>Click the button <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> to save the information.<br>
		<b>Step 5: </b>If you want to correct any errors, click on the erroneous data and replace it with the correct one and save again.<br>
		<b>Step 6: </b>If you are finished, click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> to close the window and go back to the chart.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Back to "How to...?"</a></font>
</ul>
<a name="pt"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
How to enter  information on daily physical therapy (PT), anti-thrombosis gymnastic (Atg), etc.?</b></font>
<ul> 
	<b>Step 1: </b>Click the "<span style="background-color:yellow" > Pt,Atg,etc: </span>" corresponding to the chosen date.<br>
	<b>Step 2: </b>A pop-up window will appear showing the entry field for the chosen date.<br>
	<b>Step 3: </b>Type the information in the<br> "<span style="background-color:yellow" > Please enter new information here: </span>" field.<br>
  		<b>Note: </b>You can also edit the current entries <br>in the "<span style="background-color:yellow" > Current entries: </span>" field if necessary.<br>
  		<b>Note: </b>If you want to cancel, click the button <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>Step 4: </b>Click the button <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> to save the information.<br>
		<b>Step 5: </b>If you want to correct any errors, click on the erroneous data and replace it with the correct one and save again.<br>
		<b>Step 6: </b>If you are finished, click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> to close the window and go back to the chart.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Back to "How to...?"</a></font>
</ul>
<a name="coag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
How to enter anticoagulants?</b></font>
<ul> 
	<b>Step 1: </b>Click the <img <?php echo createComIcon('../','clip.gif','0') ?>> (clip) icon on the "<span style="background-color:yellow" > Anticoagulants <img <?php echo createComIcon('../','clip.gif','0') ?>> </span>".<br>
	<b>Step 2: </b>A pop-up window will appear showing the entry field for anticoagulants.<br>
	<b>Step 3: </b>Type the information on the anticoagulants and or dosage in the<br> "<span style="background-color:yellow" > Please enter new information here: </span>" field.<br>
  		<b>Note: </b>You can also edit the current entries <br>in the "<span style="background-color:yellow" > Current entries: </span>" field if necessary.<br>
  		<b>Note: </b>If you want to cancel, click the button <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>Step 4: </b>Click the button <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> to save the information.<br>
		<b>Step 5: </b>If you want to correct any errors, click on the erroneous data and replace it with the correct one and save again.<br>
		<b>Step 6: </b>If you are finished, click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> to close the window and go back to the chart.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Back to "How to...?"</a></font>
</ul>
<a name="daycoag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
How to enter information on daily anticoagulant application?</b></font>
<ul> 
	<b>Step 1: </b>Click either the empty column or the existing anticoagulant information corresponding to the chosen date.<br>
	<b>Step 2: </b>A pop-up window will appear showing the entry field for daily anticoagulant application for the chosen date.<br>
	<b>Step 3: </b>Type either the dosage, or applicator information in the<br> "<span style="background-color:yellow" > Enter the new information here or edit the current entries: </span>" field.<br>
  		<b>Note: </b>If you want to cancel, click the button <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>Step 4: </b>Click the button <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> to save the information.<br>
		<b>Step 5: </b>If you want to correct any errors, click on the erroneous data and replace it with the correct one and save again.<br>
		<b>Step 6: </b>If you are finished, click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> to close the window and go back to the chart.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Back to "How to...?"</a></font>
</ul>
<a name="lot"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
How to enter notes on implants, LOT nr, charge nr, etc?</b></font>
<ul> 
	<b>Step 1: </b>Click the <img <?php echo createComIcon('../','clip.gif','0') ?>> (clip) icon on the "<span style="background-color:yellow" > Notes <img <?php echo createComIcon('../','clip.gif','0') ?>> </span>".<br>
	<b>Step 2: </b>A pop-up window will appear showing the entry field for auxiliary notes.<br>
	<b>Step 3: </b>Type the information on the LOT, charge nr, implants in the<br> "<span style="background-color:yellow" > Please enter new information here: </span>" field.<br>
  		<b>Note: </b>You can also edit the current entries <br>in the "<span style="background-color:yellow" > Current entries: </span>" field if necessary.<br>
  		<b>Note: </b>If you want to cancel, click the button <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>Step 4: </b>Click the button <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> to save the information.<br>
		<b>Step 5: </b>If you want to correct any errors, click on the erroneous data and replace it with the correct one and save again.<br>
		<b>Step 6: </b>If you are finished, click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> to close the window and go back to the chart.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Back to "How to...?"</a></font>
</ul>
<a name="med"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
How to enter  medication and dosage plan?</b></font>
<ul> 
	<b>Step 1: </b>Click the "<span style="background-color:yellow" > Medication </span>".<br>
	<b>Step 2: </b>A pop-up window will appear showing the entry fields for medication and dosage plan.<br>
	<b>Step 3: </b>Type the medication on the left column.<br> 
	<b>Step 4: </b>Type the dosage plan on the middle column.<br> 
	<b>Step 5: </b>Click the radiobutton of the color coding for the medication if necessary.<br> 
	<ul type=disc>
		<li>White for normal or default.
		<li><span style="background-color:#00ff00" >Green</span> for antibiotics and their derivatives.
		<li><span style="background-color:yellow" >Yellow</span> for dialytic medicines.
		<li><span style="background-color:#0099ff" >Blue</span> for hemolytic (coagulant or anticoagulant) medicines.
		<li><span style="background-color:#ff0000" >Red</span> for intravenous applied medicines.
	</ul>
  	<b>Note: </b>You can also edit the current entries <br>if necessary.<br>
	<b>Step 6: </b>Enter your name in the "<span style="background-color:yellow" > Nurse: </span>" field.<br> 
  		<b>Note: </b>If you want to cancel, click the button <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>Step 7: </b>Click the button <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> to save the medication plan.<br>
		<b>Step 8: </b>If you want to correct any errors, click on the erroneous data and replace it with the correct one and save again.<br>
		<b>Step 9: </b>If you are finished, click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> to close the window and go back to the chart.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Back to "How to...?"</a></font>
</ul>
<a name="daymed"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
How to enter information on daily medication application and dosage?</b></font>
<ul> 
	<b>Step 1: </b>Click either an empty medication column or the existing information corresponding to the chosen date.<br>
	<b>Step 2: </b>A pop-up window will appear showing the medication and dosage plan with entry fields for the day's information.<br>
	<b>Step 3: </b>Click the entry field corresponding to the chosen medication.<br>
	<b>Step 4: </b>Type either the dosage, applicator information, or start/end symbols in the field.<br>
  		<b>Note: </b>If you want to cancel, click the button <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>Step 5: </b>If you have several entries, enter all of them before saving.<br>
		<b>Step 6: </b>Click the button <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> to save the information.<br>
		<b>Step 7: </b>If you want to correct any errors, click on the erroneous data and replace it with the correct one and save again.<br>
		<b>Step 8: </b>If you are finished, click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> to close the window and go back to the chart.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Back to "How to...?"</a></font>
</ul>
<a name="iv"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
How to enter information on daily intravenous medication application and dosage?</b></font>
<ul> 
	<b>Step 1: </b>Click either an empty column or the existing information next to <br>"<span style="background-color:yellow" > Intravenous>> </span>" corresponding to the chosen date.<br>
	<b>Step 2: </b>A pop-up window will appear showing the entry field for the day's intravenous medication information.<br>
	<b>Step 3: </b>Type either the dosage, applicator information, or start/end symbols in the "<span style="background-color:yellow" > Enter the new information here or edit the current entries: </span>" field.<br>
  		<b>Note: </b>If you want to cancel, click the button <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
		<b>Step 4: </b>Click the button <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> to save the information.<br>
		<b>Step 5: </b>If you want to correct any errors, click on the erroneous data and replace it with the correct one and save again.<br>
		<b>Step 6: </b>If you are finished, click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> to close the window and go back to the chart.<br>
		<font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> Back to "How to...?"</a></font>
</ul>
<?php elseif(($src=="")&&($x1=="template")) : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
What should I do when <span style="background-color:yellow" >today's list is not yet created</span>?</b></font>
<ul> <b>Step 1: </b>Click on the button <input type="button" value="Show last occupancy list"> to find the last recorded list.
                                                                     <br>
		<b>Step 2: </b>When a recorded list is found within the last 31 days, it will be displayed.<br>
		<b>Step 3: </b>Click on the button <input type="button" value="Copy this list for today anyway."><br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
I don't want to see the last occupancy list. How to create a new list?</b></font>
<ul> <b>Step 1: </b>Click on the <img <?php echo createComIcon('../','plus2.gif','0') ?>> button corresponding to the room number and bed.
                                                                     <br>
		<b>Step 2: </b>A pop-up window for searching the patient will appear.<br>
		<b>Step 3: </b>Find first the patient by entering a search keyword into one of several entry fields.<br>
		If you  want to find the patient...<ul type="disc">
		<li>by its patient number, enter the number into the <br>"<span style="background-color:yellow" >Patient nr.:</span><input type="text" name="t" size=19 maxlength=10 value="22000109">" field.
		<li>by its Family name, enter its Family name or the first few letters into the <br>"<span style="background-color:yellow" >Family name:</span><input type="text" name="t" size=19 maxlength=10 value="Schmitt">" field.
		<li>by its Given name, enter its Given name or the first few letters into the <br>"<span style="background-color:yellow" >Given name:</span><input type="text" name="t" size=19 maxlength=10 value="Peter">" field.
		<li>by its birthdate, enter its birthdate or the first few numbers into the <br>"<span style="background-color:yellow" >Birthdate:</span><input type="text" name="t" size=19 maxlength=10 value="10.10.1966">" field.
		</ul>
		<b>Step 4: </b>Click the button <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> to start searching for the patient.<br>
		<b>Step 5: </b>If the search finds the patient or several patients, a list of patients will be displayed.<br>
		<b>Step 6: </b>To select the right patient, click on the button&nbsp;<button><img <?php echo createComIcon('../','post_discussion.gif','0') ?>></button> corresponding to it.<br>
</ul>
<?php elseif(($src=="getlast")&&($x1=="last")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to copy the displayed last recorded list for today's occupancy list?</b></font>
<ul> <b>Step 1: </b>Click on the button <input type="button" value="Copy this list for today anyway."> to copy the last recorded list.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
The last occupancy list is being displayed but I don't want to copy it. How to start a new list? </b></font>
<ul> <b>Step 1: </b>Click on the button <input type="button" value="Do not copy this! Create a new list."> to start creating a new list.
</ul>
<?php elseif($src=="assign") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to assign a bed to a patient?</b></font>
<ul> <b>Step 1: </b>Find first the patient by entering a search keyword into one of several entry fields.<br>
		If you  want to find the patient...<ul type="disc">
		<li>by its patient number, enter the number into the <br>"<span style="background-color:yellow" >Patient nr.:</span><input type="text" name="t" size=19 maxlength=10 value="22000109">" field.
		<li>by its Family name, enter its Family name or the first few letters into the <br>"<span style="background-color:yellow" >Family name:</span><input type="text" name="t" size=19 maxlength=10 value="Schmitt">" field.
		<li>by its Given name, enter its Given name or the first few letters into the <br>"<span style="background-color:yellow" >Given name:</span><input type="text" name="t" size=19 maxlength=10 value="Peter">" field.
		<li>by its birthdate, enter its birthdate or the first few numbers into the <br>"<span style="background-color:yellow" >Birthdate:</span><input type="text" name="t" size=19 maxlength=10 value="10.10.1966">" field.
		</ul>
		<b>Step 2: </b>Click the button <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> to start searching for the patient.<br>
		<b>Step 3: </b>If the search finds the patient or several patients, a list of patients will be displayed.<br>
		<b>Step 4: </b>To select the right patient, click on the button&nbsp;<button><img <?php echo createComIcon('../','post_discussion.gif','0') ?>></button> corresponding to it.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to lock a bed?</b></font>
<ul> <b>Step 1: </b>Click on the "<span style="background-color:yellow" > <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> <font color="#0000ff">Lock this bed</font> </span>".<br>
		<b>Step 2: </b>Choose&nbsp;<button>OK</button> when asked for confirmation.<p>
</ul>
  <b>Note: </b>If you want to cancel, click the button <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.</ul>
  
<?php elseif($src=="remarks") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to write remarks or notes about the patient?</b></font>
<ul> <b>Step 1: </b>Click on the text entry field.<br>
		<b>Step 2: </b>Type your remarks or notes<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
I am finished writing. How to save the remarks or notes?</b></font>
<ul> 	<b>Step 1: </b>Click the button <input type="button" value="Save"> to save.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
I have saved the remarks. How to close the window?</b></font>
<ul> 	<b>Step 1: </b>Click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle"> to close the window.<p>
</ul>
<?php elseif($src=="discharge") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to discharge a patient?</b></font>
<ul> <b>Step 1: </b>Select the type of dischargeal by clicking on its corresponding button<br>
	<ul><br>
		<input type="radio" name="relart" value="reg" checked> Regular dischargeal<br>
                 	<input type="radio" name="relart" value="self"> Patient left the hospital on his own will<br>
                 	<input type="radio" name="relart" value="emgcy"> Emergency dischargeal<br>  <br>
	</ul>
		<b>Step 2: </b>Type additional notice or notes about the dischargeal in the "<span style="background-color:yellow" > Notice: </span>" field if available. <br>
		<b>Step 3: </b>Type your name in the "<span style="background-color:yellow" > Nurse: <input type="text" name="a" size=20 maxlength=20></span>" field if it is empty. <br>
		<b>Step 4: </b>Check the " <span style="background-color:yellow" ><input type="checkbox" name="d" value="d"> Yes, I'm sure. discharge the patient. </span>" field. <br>
		<b>Step 5: </b>Click the button <input type="button" value="discharge"> to discharge the patient.<p>
		<b>Step 6: </b>Click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle"> to go back to the ward's new occupancy list.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
I tried clicking the <input type="button" value="discharge"> button, but there is no response. Why?</b></font>
<ul> <b>Note: </b>The following checkbox field must be checked and look like this: <br>
 " <span style="background-color:yellow" ><input type="checkbox" name="d" value="d" checked> Yes, I'm sure. discharge the patient. </span>". <p>
		<b>Step 1: </b>Click the checkbox if it is not checked.<p>
</ul>
  <b>Note: </b>If you want to cancel, click the button <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.</ul>

<?php endif;?>

</form>

