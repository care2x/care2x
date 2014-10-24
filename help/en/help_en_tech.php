<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title></title>

</head>
<body>
<form >
<font face="Verdana, Arial" size=2>
<font  size=3 color="#0000cc">
<b>

<?php
print "Technical support - ";	
switch($src)
	{
		case "request": print "Request for repair service";
							break;
		case "report": print "Report done repair service";
							break;
		case "queries": print "Send inquiry or question";
							break;
		case "arch": print "Research in the archives";
							break;
		case "showarch": print "Report";
							break;
	}
?>
</b>
</font>
<p>

<?php if($src=="request") : ?>
<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to send a request for repair service?</b></font>
<ul> <b>Step 1: </b>Enter the localization of the damage in the 
<nobr>"<span style="background-color:yellow" > Localization of the damage <input type="text" name="d" size=20 maxlength=10> </span>"</nobr> field.<p>
<b>Step 2: </b>Enter your name in the <nobr>"<span style="background-color:yellow" > Requested by: <input type="text" name="d" size=20 maxlength=10> </span>"</nobr> field.<br>
 <b>Step 3: </b>Enter your personnel number in the <nobr>"<span style="background-color:yellow" > Personnel nr.: <input type="text" name="d" size=20 maxlength=5> </span>"</nobr> field.<br>
 <b>Step 4: </b>Enter your telephone number in the <nobr>"<span style="background-color:yellow" > Telephone nr. <input type="text" name="d" size=20 maxlength=5> </span>"</nobr> field in case the technical support department has inquiries regarding your request.<p>
 <b>Step 5: </b>Type the description of the damage in the <nobr>"<span style="background-color:yellow" > Please describe the nature of the damage: <input type="text" name="d" size=20 maxlength=5> </span>"</nobr> field.<br>
 <b>Step 6: </b>Click the <img <?php echo createLDImgSrc('../','abschic.gif','0') ?>> button to send your request. <br>
</ul>
<b>Note</b>
<ul> If you decide to close the request form click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.
</ul>
<?php endif;?>
<?php if($src=="report") : ?>
<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to report a done repair service?</b></font>
<ul> <b>Step 1: </b>Enter the localization of the damage in the 
<nobr>"<span style="background-color:yellow" > Localization of the damage <input type="text" name="d" size=20 maxlength=10> </span>"</nobr> field.<p>
<b>Step 2: </b>Enter the job id number in the <nobr>"<span style="background-color:yellow" > Job ID nr.: <input type="text" name="d" size=20 maxlength=10> </span>"</nobr> field.<br>
<b>Step 3: </b>Enter your name in the <nobr>"<span style="background-color:yellow" > Technician: <input type="text" name="d" size=20 maxlength=10> </span>"</nobr> field.<br>
 <b>Step 4: </b>Enter your personnel number in the <nobr>"<span style="background-color:yellow" > Personnel nr.: <input type="text" name="d" size=20 maxlength=5> </span>"</nobr> field.<br>
 <b>Step 5: </b>Type the description of the repair job you have done in the <nobr>"<span style="background-color:yellow" > Please describe the repair job you have done: <input type="text" name="d" size=20 maxlength=5> </span>"</nobr> field.<br>
 <b>Step 6: </b>Click the <input type="button" value="Send report"> button to send your report. <br>
</ul>
<b>Note</b>
<ul> If you decide to close the request form click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.
</ul>
<?php endif;?>
<?php if($src=="queries") : ?>
<p>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to send an inquiry or question to the technical support department?</b></font>
<ul> <b>Step 1: </b>Type your inquiry or question in the <nobr>"<span style="background-color:yellow" > Please type your question: <input type="text" name="d" size=20 maxlength=5> </span>"</nobr> field.<br>
<b>Step 2: </b>Enter your name in the <nobr>"<span style="background-color:yellow" > Name: <input type="text" name="d" size=20 maxlength=10> </span>"</nobr> field.<br>
 <b>Step 3: </b>Enter your department in the <nobr>"<span style="background-color:yellow" > Department: <input type="text" name="d" size=20 maxlength=5> </span>"</nobr> field.<br>
 <b>Step 4: </b>Click the <input type="button" value="Send inquiry"> button to send your inquiry. <br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to see my previous inquries and the technical department's replies to them?</b></font>
<ul> <b>Step 1: </b>You have to log in first. Type your name in the <nobr>"<span style="background-color:yellow" > from: <input type="text" name="d" size=20 maxlength=5> </span>"</nobr> field on the upper right corner.<br>
 <b>Step 2: </b>Click the <input type="button" value="Log in">. <br>
 <b>Step 3: </b>If you have sent inquiries previously, they will be listed in short form.  <br>
 <b>Step 4: </b>If your inquiry is answered by the technical department, the symbol <img src="../img/warn.gif" border=0 width=16 height=16 align="absmiddle"> will
 appear at the end. <br>
 <b>Step 5: </b>To read your inquiry and the technical department's reply to it, click on it. <br>
</ul>
<b>Note</b>
<ul> If you decide to close the inquriy form click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.
</ul>
<?php endif;?>
<?php if($src=="arch") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to read technical reports?</b></font>
<ul> 
		<b>Note: </b>Technical reports which have not been read or printed yet are listed immediately.<p>
<b>Step 1: </b>Click on the button <img <?php echo createComIcon('../','uparrowgrnlrg.gif','0') ?>>  of the report that you wish to open. <br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to search for particular technical reports?</b></font>
<ul> <b>Step 1: </b>Enter either a complete information or the first few letters in the corresponding fields as explained in the following.<br>
	<ul type=disc> 
	<li>If you want to find reports written by a particular technician, enter the technician's name in the "<span style="background-color:yellow" > Technician: <input type="text" name="t" size=11 maxlength=4 value="Name"> </span>" field.<br>
	<li>If you want to find reports of jobs done in a particular department, enter the department's name in the "<span style="background-color:yellow" > Department: <input type="text" name="t" size=11 maxlength=4 value="Name"> </span>" field.<br>
	<li>If you want to find reports written on a particular date, enter the date in the "<span style="background-color:yellow" > Date from: <input type="text" name="t" size=11 maxlength=4 value="Name"> </span>" field.<br>
	<li>If you want to find all reports within a time period, enter the start date in the "<span style="background-color:yellow" > Date from: <input type="text" name="t" size=11 maxlength=4 value="Name"> </span>" field and
	enter the end date in the "<span style="background-color:yellow" > to: <input type="text" name="t" size=11 maxlength=4 value="Name"> </span>" field.<br>
	</ul>
 <b>Step 2: </b>Click the <input type="button" value="Search"> button to start searching. <br>
<b>Step 3: </b>The results will be listed. Click on the icon <img <?php echo createComIcon('../','uparrowgrnlrg.gif','0') ?>>  of the report that you wish to open. <br>
	<b>Note: </b>Technical reports which are marked with <img <?php echo createComIcon('../','check-r.gif','0') ?>> have been read or printed already.<p>

</ul>
</font>
<?php endif;?>
<?php if($src=="showarch") : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b>
Marking the report as read.</b></font>
<ul> <b>Step 1: </b>Click the button <input type="button" value="Mark as 'Read'">.<p>
	<b>Note: </b>When the report has been marked as read, it will not be listed immediately at every start of archive search. They can only be found again
	through the usual archive search methods.<p>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b>
Printing the report.</b></font>
<ul> <b>Step 1: </b>Click the button <input type="button" value="Print">.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to go back to the start of archive search?</b></font>
<ul> <b>Step 1: </b>Click the button <input type="button" value="<< Go back">.<p>
</ul>
<?php endif;?>
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
 <b>Step 1: </b>Click the <input type="button" value="Save"> button to save the document. <br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>How to print out the document list?</b></font>
<ul> <b>Step 1: </b>Click the <input type="button" value="Print"> button and the print window will pop up.<br>
	<b>Step 2: </b>Follow the instructions in the print window.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>I have saved the document and wish to close it, what should I do? </b></font>
<ul> <b>Step 1: </b>If you are finished, click the <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> button. <br>
</ul>
<?php endif;?>

</form>
</body>
</html>
