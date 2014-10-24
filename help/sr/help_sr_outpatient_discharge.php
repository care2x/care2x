<font face="Verdana, Arial" size=3 color="#0000cc">
<b><?php echo "$x3 - $x2" ?></b></font>

<p><font size=2 face="verdana,arial" >
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to discharge a patient?</b></font>
<ul> 
<b>Step 1: </b>Make sure the correct discharge date and time are entered.<br>
<b>Step 2: </b>Select the discharge type  by clicking its corresponding radio button<br>
	<p>
		<b>Step 3: </b>Type additional notice or notes about the discharge in the "<span style="background-color:yellow" > Notice: </span>" field if available. <br>
		<b>Step 4: </b>Type your name in the "<span style="background-color:yellow" > Nurse: <input type="text" name="a" size=20 maxlength=20></span>" field if it is empty. <br>
		<b>Step 5: </b>Check the " <span style="background-color:yellow" ><input type="checkbox" name="d" value="d"> Yes, I'm sure. discharge the patient. </span>" field. <br>
		<b>Step 6: </b>Click the button <input type="button" value="discharge"> to discharge the patient.<p>
		<b>Step 7: </b>Click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle"> to go back to the ward's new occupancy list.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
I tried clicking the <input type="button" value="discharge"> button, but there is no response. Why?</b></font>
<ul> <b>Note: </b>The following checkbox field must be checked and look like this: <br>
 " <span style="background-color:yellow" ><input type="checkbox" name="d" value="d" checked> Yes, I'm sure. discharge the patient. </span>". <p>
		<b>Step 1: </b>Click the checkbox if it is not checked.<p>
</ul>
  <b>Note: </b>If you want to cancel, click the button <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.</ul>
