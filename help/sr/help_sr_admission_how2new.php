<?php
if($x1=1){
?>
<form>
<font size=2 face="verdana,arial" >
<a name="sel"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
A similar person already exists in the registration what should I do?</b></font>
<ul> 
	<b>Step :</b> Click the "Show details" option of the listed person to see the details.
</ul>

<a name="sel"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
This is really the same person. What should I do?</b></font>
<ul> 
	<b>Step 1:</b> Decide to update the listed person's registration data.<br>
	<b>Step 2:</b> Click the "Update" option of the listed person.<br>
	<b>Step 3:</b> Update and save the data.<br>

</ul>

<a name="sel"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
This is NOT the same person. What should I do?</b></font>
<ul> 
	<b>Step 1:</b> Decide to save the new person's data as new registration.<br>
	<b>Step 2:</b> Scroll down to the bottom of the registration page.<br>
	<b>Step 3:</b> Click the <input type="button" value="Save anyway"> button.<br>

</ul>
</form>
<?php
}
?>

<font face="Verdana, Arial" size=3 color="#0000cc">
<b>How to admit a patient</b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<b>Step 1</b>

<ul> 
<font color=#ff0000>Verify first if the patient's basic data already exists</font>.<p>
		 Enter  either a full information or a few letters from a patient's information, like for example first name, or family name, 
		or the PID (person identifier).
		<p>Example 1: enter "21000012" or "12".
		<br>Example 2: enter "Guerero" or "gue".
		<br>Example 3: enter "Alfredo" or "Alf".
		
</ul>

<b>Step 2</b>
<ul> Click the <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> button to start searching. Your search will be directed to the
person search module.
</ul>

<b>Step 3</b>
<ul> If the search does not find any result, you need to register the person first. Follow the instructions for registering the person.
</ul>
<b>Step 4</b>
<ul> If the search finds a result, select the right person from the displayed list by clicking the  <img <?php echo createLDImgSrc('../','ok_small.gif','0') ?>> button beside it.
</ul>
<b>Step 5</b>
<ul> Once the admission form is displayed, enter all relevant admission data.
		
</ul>
<b>Step 6</b>
<ul> 
	 Click the <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> button to
		save the admission information.<p>
	
</ul>


<b>Note</b>

<ul> If an information is missing, the entries will be redisplayed and a message will appear prompting you to
		enter the information in the field or fields marked red. Afterwards, click the button <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> to
		save the complete information.<p>
</ul>
<b>Note</b>
<ul> If you want to save an incomplete information click the button <input type="button" value="Save anyway">.
</ul>
<b>Note</b>
<ul> If you decide to cancel admission click the button <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
		
</ul>


</form>

