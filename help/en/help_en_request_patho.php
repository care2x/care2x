<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Request for pathological lab test</b></font>
<p>
<font size=2 face="verdana,arial" >

<?php
if(!$src){
?>
<a name="sday"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
The patient's label  is not attached. What should I do?</b></font>
<ul> 
	<b>Step 1: </b>Enter  either a full information or a few letters from a patient's information, like for example first name, or family name, 
		or the encounter number.
		<p>Example 1: enter "21000012" or "12".
		<br>Example 2: enter "Guerero" or "gue".
		<br>Example 3: enter "Alfredo" or "Alf".<p>
	<b>Step 2: </b>Click the <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> button to start searching. <p>
	<b>Step 3: </b> If the search finds a result, select the right person from the displayed list by clicking its 
	 <img <?php echo createLDImgSrc('../','ok_small.gif','0') ?>> button.
</ul>
<?php
}else{
?>

<a name="stime"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
What to fill  in the request form?</b></font>
<ul> 
	<b>The compulsory fields to fill in or check are:</b> 
<ul> 
	<li>Type of specimen
	<li>Description of specimen text box
	<li>Date of operation
	<li>Doctor or surgeon responsible for the request
</ul>
</ul>


<a name="send"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
How to send the test request?</b></font>
<ul> 
	<b>Step: </b>Click the <img <?php echo createLDImgSrc('../','abschic.gif','0') ?>> button.
</ul>
<?php
}
?>

