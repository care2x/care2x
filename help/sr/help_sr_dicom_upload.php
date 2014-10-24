<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
Radiology - Upload Dicom images

 </b>
 </font>
<p><font size=2 face="verana,arial" >
<form action="#" >

<?php
if(!$src){
?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to upload dicom images?</b>
</font>
	
	<ul>       	
 	<b>Step 1: </b>If the encounter number related to the images is available, enter it in the "<font color=#0000ff>Related encounter nr.'s</font>" field.<p>
 	<b>Step 2: </b>If numbers or id's of related documents are available, enter them in the "<font color=#0000ff>Related documents' ID's</font>" field. Separate the id's with commas.<p> 
 	<b>Step 3: </b>Type a short description of the image(s) in the "<font color=#0000ff>Notes</font>" field.<p> 
 	<b>Step 4: </b>Click the <input type="button" value="Browse"> button to open the file selector window.<p> 
 	<b>Step 5: </b>Select the image file.<p> 
 	<b>Step 6: </b>When all image files are selected, click the <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> button to start uploading.<p> 
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to change the number of images to upload?</b>
</font>
	
	<ul>       	
 	<b>Note: </b>Change the number only before you enter any data or before you start selecting the image files.<p> 
 	<b>Step 1: </b>Enter the number in the "I need to upload <input type="text" name="d" size=3 maxlength=1 value=4>" field.<p>
 	<b>Step 2: </b>Click "Go".<p> 
</ul>
<?php
}else{
?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
After a successful upload, how can I check the integrity of the uploaded images?</b>
</font>
	<ul>       	
 	<b>Step: </b>Click the <img <?php echo createComIcon('../','torso.gif','0') ?>> icon of the "<b>Image Group #</b>" to display the images in the current frame (viewer specific).<p>
	<img src="../help/en/img/en_dicom_group_in.png" border=0 width=318 height=132><p> 
  	<b>Or: </b>Click the <img <?php echo createComIcon('../','torso_win.gif','0') ?>> icon of the "<b>Image Group #</b>" to display the images in an extra window.<p>
	<img src="../help/en/img/en_dicom_group_ex.png" border=0 width=318 height=132> 
	 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
After a successful upload, how can I check the integrity of each uploaded image?</b>
</font>
	<ul>       	
 	<b>Step: </b>Click the <img <?php echo createComIcon('../','torso.gif','0') ?>> icon in the list to display a single image in the current frame (viewer specific).<p>
	<img src="../help/en/img/en_dicom_single_in.png" border=0 width=410 height=101><p> 
  	<b>Or: </b>Click the <img <?php echo createComIcon('../','torso_win.gif','0') ?>> icon in the list to display a single image in an extra window.<p>
	<img src="../help/en/img/en_dicom_single_ex.png" border=0 width=410 height=101>
	 
</ul>

<?php
}
?>

</form>

