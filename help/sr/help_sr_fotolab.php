<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
Photolab - 
<?php
	switch($src)
	{
	case "init": print "Initializing";
												break;
	case "input": print "Selecting photos for uploading";
												break;
	case "maindata": print "Patient's data";
												break;
	case "save": print "Photos stored";
												break;

	}


 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<?php if($src=="input") : ?>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
The entry fields are displayed. How to select the image files?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click the button <input type="button" value="Browse..."> to find the file of the photo you want to store.<br>
 	<b>Step 2: </b>A "Select file" window will pop up. Select the file you want and click "Open".<br>
 	<b>Step 3: </b>If the file you selected is a valid graphic file format, a preview of the photo will appear on the upper right frame (MSIE browser only). Otherwise, repeat step 1 and 2.<br>
 	<b>Step 4: </b>Enter the date when this photo was taken in the "<span style="background-color:yellow" > Shotdate </span>" field.<p>
 	

	<b>Step 5: </b>Enter the photo number in the "<span style="background-color:yellow" > Number </span>" field.<p>
	
 	
</ul>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to preview the photo?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click the photo's corresponding <img <?php echo createComIcon('../','lilcamera.gif','0') ?>> button.<br>
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to change the number of images for uploading?</b>
</font>
<ul>       	
 	<b>Step 1:</b> Enter the number in the "I want to upload <input type="text" name="v" size=4 maxlength=4> image(s) " field.<p>
 	<b>Step 2:</b> Click "Go"<p>
</ul>

<?php endif;?>	

<?php if($src=="maindata") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to find the patient's data?</b>
</font>
<ul>	
	<b>Step 1: </b>Enter the patient's patient or case number  in the "<span style="background-color:yellow" > Patient number </span>" field.<br>
 	<b>Step 2: </b>Click the button <input type="button" value="Search"> to find the patient.<br>
 	<b>Step 3: </b>When the patient is found, his basic data will appear in the corresponding fields.<br>
 	<b>Step 4: </b>If all or most of the photos are taken on the same date, enter the date in the <nobr>"<span style="background-color:yellow" > Shotdate </span>"</nobr> field.<br>
 	<b>Step 5: </b>Click the button <img <?php echo createComIcon('../','preset-add.gif','0') ?>> to set this date for all the photos. This date will
	automatically appear in the "Shotdate" fields on the left frame.<p>
 	<img <?php echo createComIcon('../','warn.gif','0') ?>><b> Note! </b>If one or some photos must have a different date, enter the unique date into the photo's corresponding "Shotdate" field. You can only do this after you are finished with step 5.<p>
</ul>
	
	<?php endif;?>	
<?php if($src=="save") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
I want to store additional photos from the same patient. How to do it?</b>
</font>
<ul>	
	<b>Step 1: </b>Enter the number of photos you want to store in the <nobr>"Additional <input type="text" name="g" size=3 maxlength=2> photos of the <span style="background-color:yellow" > same patient. </span>"</nobr> field.<br>
 	<b>Step 2: </b>Click the button <input type="button" value="Go">.<br>
</ul>

	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
I want to store photos from another patient. How to do it?</b>
</font>
<ul>	
	<b>Step 1: </b>Enter the number of photos you want to store in the <nobr>" <input type="text" name="g" size=3 maxlength=2> photos of <span style="background-color:yellow" > another patient. </span>"</nobr> field.<br>
 	<b>Step 2: </b>Click the button <input type="button" value="Go">.<br>
</ul>

	<?php endif;?>	
	


	</form>

