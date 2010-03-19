<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Laboratory test request</b></font>
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

<a name="sel"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
How to select a test parameter?</b></font>
<ul> 
	<b>Step: </b>Click the small pink rectangle beside the parameter to "blacken" it.<p>
	<img src="../help/en/img/en_request_chemlab.png" border=0 width=352 height=125>
</ul>

<a name="usel"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
How to unselect a test parameter?</b></font>
<ul> 
	<b>Step: </b>Click again the small "blackened" rectangle beside the parameter to "unblacken" it.<br>
</ul>

<a name="sday"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
How to set the sampling day?</b></font>
<ul> 
	<b>Step: </b>Click the small pink rectangle below the day to "blacken" it.<p>
<img src="../help/en/img/en_request_chemlab_sday.png" border=0 width=325 height=120>
</ul>

<a name="stime"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
How to set the sampling time?</b></font>
<ul> 
	<b>Step: </b>Click the small pink rectangle below the time in hours and minutes to "blacken" it.<p>
<img src="../help/en/img/en_request_chemlab_stime.png" border=0 width=325 height=120>
</ul>
<a name="send"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
How to send the test request?</b></font>
<ul> 
	<b>Step: </b>Click the <img <?php echo createLDImgSrc('../','abschic.gif','0') ?>> button.
</ul>

<?php
}
?>
