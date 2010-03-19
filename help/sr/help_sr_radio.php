<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
Radiology Xray - 
<?php

if($src=="search")
{
	print "Search a patient";	
}

 ?>
 </b>
 </font>
<p><font size=2 face="verana,arial" >
<form action="#" >

<?php if($src=="search") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to search for a  patient?</b>
</font>
	
	<ul>       	
 	<b>Step 1: </b>Enter either a complete information or the first few digits of the patient's number, or family name, 
	or given name in the corresponding field. <br>
 	<b>Step 2: </b>Click the button <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> to start searching for the patient.<p> 
<ul>       	
 	<b>Note: </b>If the search delivers a result,  a list will be displayed. <p>
	</ul>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to preview a patient's xray film and its diagnos?</b>
</font>
	
	<ul>       	
 	<b>Step 1: </b>Click the link or radio button "<span style="background-color:yellow" > <font color="#0000cc">Preview/Diagnosis</font> <input type="radio" name="d" value="a"> </span>".<br>
	The xray film's thumbnail will appear on the lower left frame.<br> 
	The xray film's diagnosis will appear on the lower right frame.<br> 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to display patient's xray film in full view?</b>
</font>
	<ul>       	
 	<b>Step 1: </b>Click the  <img <?php echo createComIcon('../','torso.gif','0') ?>> button corresponding to the patient to switch over to full screen mode.<br>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Note:</b></font> 
<ul>       	
 If you decide to close click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.
</ul>
<?php endif;?>


</form>

