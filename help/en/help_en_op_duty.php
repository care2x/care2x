<html>

<head>
<title></title>

</head>
<body>
<form >
<font face="Verdana, Arial" size=2>
<font  size=3 color="#0000cc">
<b>

<?php
	switch($src)
	{
		case "show": print "Nurses on duty - Dutyplan";
							break;
		case "quick": print "Nurses on duty - Quickview";
							break;
		case "plan": print "Nurses on duty - Create dutyplan";
							break;
		case "personlist": print "Create personnel list";
							break;
		case "dutydoc": print "Nurses on duty - Documenting work done on on-call-duty hours";
							break;
	}
?>
</b>
</font>
<p>

<?php if($src=="quick") : ?>
<p><font color="#990000" face="Verdana, Arial">What can I do here?</font></b><p>
<font face="Verdana, Arial" size=2>
<img <?php echo createComIcon('../','update.gif','0','absmiddle') ?>><b> Get additional information (if available) on the nurses on duty.</b>
<ul>To see the additional information, <span style="background-color:yellow" >click on the name</span> of the
person on the list. A small pop-up window will appear showing relevant information.</ul><p>
<img <?php echo createComIcon('../','update.gif','0','absmiddle') ?>><b> See the duty plan for the whole month.</b>
<ul>To display the duty plan for the whole month, click on the corresponding icon &nbsp;<button><img <?php echo createComIcon('../','new_address.gif','0','absmiddle') ?>> <font size=1>Show</font></button>.<br>
			The duty plan will be displayed.</ul><p>
<font face="Verdana, Arial" size=3 color="#990000">
<p><b>What does the quickview display want to show?</b></font></b><p>
<font face="Verdana, Arial" size=2>
</b><li><b>OR Department</b> :<ul>The list of existing departments which have physicians/surgeons on standby and/or oncall duty.</ul><p>
<li><b>Standby </b> :<ul>The nurse on standby duty.</ul><p>
<li><b>Beeper/Phone</b> :<ul>Beeper and phone information of the nurse on standby duty.</ul>
<li><b>On-call </b> :<ul>The nurse on on-call duty.</ul><p>
<li><b>Beeper/Phone</b> :<ul>Beeper and phone information of the on-call duty.</ul><p>
<li><b>Duty plan</b> :<ul>Clickable icon. Link to the department's duty plan for the whole month. Click the icon&nbsp;<button><img <?php echo createComIcon('../','new_address.gif','0','absmiddle') ?>> <font size=1>Show</font></button>
			if you want to open the duty plan for the whole month and evetually create or edit the duty plan.</ul>

<?php endif; ?>
<?php if($src=="show") : ?>
<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>I want to create a new duty plan for the displayed month</b></font>
<ul> <b>Step 1: </b>Click the  <img <?php echo createLDImgSrc('../','newplan.gif','0') ?>> button.<br>
</ul>
<ul><b>Step 2:</b>
 If you have logged in before and you have an access right for this function, the 
		edit mode for editing a duty plan  will appear on the main frame.<br>
		Otherwise, if you are not logged in, you will be required to enter your username and password. <p>
		Enter your username and password and click the button <img <?php echo createLDImgSrc('../','continue.gif','0') ?>>.<p>
		If you decide to cancel click the button <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.

</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>I want to create a plan for a certain month but the plan being displayed is for a different month.</b></font>
<ul> <b>Step 1: </b>Click repeatedly on the clickable "Month" link until the month you wish is reached. <br>
								Click on the right clickable "month" link to advance the month.<br>
								Click on the left clickable "month" link to go back to earlier month.<br>
		<b>Step 2: </b>Follow the earlier instructions on creating a new duty plan.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>I want to go back to the quick view </b></font>
<ul> <b>Step 1: </b>Click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?> >.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>I want to see the phone & beeper numbers of the nurses on duty </b></font>
<ul> <b>Step 1: </b><span style="background-color:yellow" >Click on the person's name</span>.  A small pop-up window will appear showing relevant information.<br>
</ul>


<b>Note</b>
<ul> If you decide to close the duty plan  click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.
</ul>
<?php endif; ?>
<?php if($src=="plan") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
I want to schedule a nurse for duty using the nurses' list</b></font>
<ul> <b>Step 1: </b>Click on the button &nbsp;<button><img <?php echo createComIcon('../','patdata.gif','0') ?>></button> of the selected day to open the nurses' list. <br>
			A small pop-up window will appear showing the list of nurses.<br>
			<ul type=disc>
			<li>Click the icon on the left "Standby" column to schedule a standby duty.<br>
			<li>Click the icon on the right "On-call" column to schedule an on-call duty.
			</ul>
		<b>Step 2: </b><span style="background-color:yellow" >Click the name of nurse</span> to copy it to the duty plan.<br>
		<b>Step 3: </b>If you have clicked the wrong name, just repeat step 2 and hit the right name.<br>
		<b>Step 4: </b>If you are finished, click the <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> button on the nurses' list window.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
I want to manually enter the nurse's name on the duty plan</b></font>
<ul> <b>Step 1: </b>Click on the text input field "<input type="text" name="t" size=11 maxlength=4 >" of the selected day.<br>
		<b>Step 2: </b>Type manually the name of the nurse<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
I want to delete a name on the duty plan</b></font>
<ul> <b>Step 1: </b>Click on the text input field "<input type="text" name="t" size=11 maxlength=4 value="Name">" of the name to be deleted.<br>
		<b>Step 2: </b>Delete the name manually using keyboard's backspace or delete keys.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>I want to save the duty plan</b></font>
<ul> <b>Step 1: </b>click the <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> button.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>I have saved the plan and wish to end the planning, what should I do? </b></font>
<ul> <b>Step 1: </b>If you are finished, click the <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> button. <br>
</ul>
</font>
<?php endif; ?>
<?php if($src=="personlist") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
The displayed department is wrong. I want to change to the right department.</b></font>
<ul> <b>Step 1: </b>Select the department on the <nobr>"<span style="background-color:yellow" >Change department or OP room: </span><select name="s">
                                                                     	<option value="Sample department 1" selected> Sample department 1</option>
                                                                     	<option value="Sample department 2"> Sample department 2</option>
                                                                     	<option value="Sample department 3"> Sample department 3</option>
                                                                     	<option value="Sample department 4"> Sample department 4</option>
                                                                     </select>"</nobr> field.
                                                                     <br>
		<b>Step 2: </b>Click the button <input type="button" value="Change"> to change to the selected department.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
I want to delete a name on the list</b></font>
<ul> <b>Step 1: </b>Click on the text input field "<input type="text" name="t" size=11 maxlength=4 value="Name">" of the name to be deleted.<br>
		<b>Step 2: </b>Delete the name manually using keyboard's backspace or delete keys.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>I want to save the personal list</b></font>
<ul> <b>Step 1: </b>click the <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> button.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>I have saved the list and wish to close it, what should I do? </b></font>
<ul> <b>Step 1: </b>If you are finished, click the <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> button. <br>
</ul>
<?php endif; ?>
<?php if($src=="dutydoc") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to document a work done during duty hours?</b></font>
<ul> <b>Step 1: </b>Enter the date in the " Date <input type="text" name="d" size=10 maxlength=10> " field.<p>
	<ul> <b>Tip: </b>Enter either "t" or "T" (meaning TODAY) to automatically enter today's date.<br>
		<b>Tip: </b>Enter either "y" or "Y" (meaning YESTERDAY) to automatically enter yesterday's date.<p>
		</ul>
		<b>Step 2: </b>Enter the name of the nurse on duty in the <nobr>"<span style="background-color:yellow" > Family name, given name <input type="text" name="d" size=20 maxlength=10> </span>"</nobr> field.<br>
 <b>Step 3: </b>Enter the work's start time in the "<span style="background-color:yellow" > from <input type="text" name="d" size=5 maxlength=5> </span>" field.<br>
 <b>Step 4: </b>Enter the work's end time in the "<span style="background-color:yellow" > to <input type="text" name="d" size=5 maxlength=5> </span>" field.<p>
	<ul> <b>Tip: </b>Enter either "n" or "N" (meaning NOW) to automatically enter the current time.<p>
		</ul>
 <b>Step 5: </b>Enter the OR number in the "<span style="background-color:yellow" > OP Room <input type="text" name="d" size=5 maxlength=5> </span>" field.<br>
 <b>Step 6: </b>Enter the diagnosis, therapy, or operation in the <nobr>"<span style="background-color:yellow" > Diagnosis/Therapy <input type="text" name="d" size=5 maxlength=5> </span>"</nobr> field.<br>
 <b>Step 7: </b>Enter the standby nurse's name in the <nobr>"<span style="background-color:yellow" > Standby: <input type="text" name="d" size=5 maxlength=5> </span>"</nobr> field.<br>
 <b>Step 8: </b>Enter the on-call nurse's name in the <nobr>"<span style="background-color:yellow" > On call: <input type="text" name="d" size=5 maxlength=5> </span>"</nobr> field if necessary.<br>
 <b>Step 1: </b>Click the <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> button to save the document. <br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>How to print out the document list?</b></font>
<ul> <b>Step 1: </b>Click the <img <?php echo createLDImgSrc('../','printout.gif','0') ?>>  button and the print window will pop up.<br>
	<b>Step 2: </b>Follow the instructions in the print window.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>I have saved the document and wish to close it, what should I do? </b></font>
<ul> <b>Step 1: </b>If you are finished, click the <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> button. <br>
</ul>
<?php endif; ?>

</form>
</body>
</html>
