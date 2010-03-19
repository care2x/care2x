<font face="Verdana, Arial" size=3 color="#0000cc"><b>Personnel management</b></font><p>
<?php 
if(!$src&&!$x1){
?>
<font size=2 face="verdana,arial" >
<b>How to employ  a person</b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<b>Step 1</b>

<ul> 
<font color=#ff0000>Verify first if the person's basic data already exists</font>.<p>
		 Enter  either a full information or a few letters from a patient's information, like for example first name, or family name, 
		or the PID (person identifier).
		<p>Example 1: enter "21000012" or "12".
		<br>Example 2: enter "Guerero" or "gue".
		<br>Example 3: enter "Alfredo" or "Alf".
		
</ul>

<b>Step 2</b>
<ul> Click the <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> button to start searching. 
</ul>

<b>Step 3</b>
<ul> If the search does not find any result, you need to register the person first. Click the  <img <?php echo createLDImgSrc('../','register_gray.gif','0') ?>>  button and follow the instructions for registering the person.
</ul>
<b>Step 4</b>
<ul> If the search finds a result, select the right person from the displayed list by clicking the  <img <?php echo createLDImgSrc('../','ok_small.gif','0') ?>> button beside it.
</ul>
<b>Step 5</b>
<ul> Once the employment form is displayed, enter all relevant employment data.<p>
		<img <?php echo createComIcon('../','warn.gif','0') ?>> Note: If the person is currently employed, his employment data will be displayed.
</ul>
<b>Step 6</b>
<ul> 
	 Click the <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> button to
		save the employment information.<p>
	
</ul>


<b>Note</b>

<ul> If an information is missing, the entries will be redisplayed and a message will appear prompting you to
		enter the information in the field or fields marked red. Afterwards, click the button <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> to
		save the complete information.<p>
</ul>

<b>Note</b>
<ul> If you decide to cancel admission click the button <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
		
</ul>
</form>
<?php
}else{
?>

<font size=2 face="verdana,arial" >
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<?php
	if($src){
?>
<font color="#990000"><b>How to update the employment data?</b></font>
<ul> 
	<b>Step 1:</b> Just enter the new data in the appropriate fields .<p>
	<b>Step 2:</b> Click the <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> button to save the updated employment data.<p>
	<img <?php echo createComIcon('../','warn.gif','0') ?>> Note: If you want to cancel the update, click the <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> button.
</ul>
<?php
	}else{
?>
<font color="#990000"><b>How to employ the person?</b></font>
<ul> 
	<b>Step 1:</b> Just enter the employment data in the appropriate fields .<p>
	<b>Step 2:</b> Click the <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> button to save the employment data.<p>
	<img <?php echo createComIcon('../','warn.gif','0') ?>> Note: If you want to cancel, click the <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> button.
</ul>
<?php
	}
}
?>
