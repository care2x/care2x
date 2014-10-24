<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
Ward management 
<?php
switch($src)
{
	case "main": print "";
						break;
	case "new": print  " - Create a new ward";
						break;
	case "arch": print "Nursing wards - Archive";
}
 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<?php if($src=="main") : ?>

<b>Create</b>

<ul>To create a new ward, click this option. 
	</ul>	
</ul>
<b>Ward's profile data</b>
<ul>This option will show the ward's profile and other relevant data.
</ul>
<b>Lock a bed</b>
<ul>If you want to lock a bed or several beds at once, click this option. The logged ward will be displayed or if not available the
default ward will displayed. Locking a bed requires a valid password with access right for this function.
</ul>
<b>Access rights</b>
<ul> In this option you can create, edit, lock, or delete access rights for a particular ward. All the access rights created will have an 
access only in that particular ward.
</ul>
<?php endif;?>
<?php if($x2=="quick") : ?>
	<?php if($x1) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to show the ward's occupancy list?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click the ward's id or name on the left column.<br>
	<b>Note: </b>The occupancy list that will be displayed is "read only". You cannot edit or change any patients' data.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to show  the ward's occupancy list for editing or updating data?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click the icon <img <?php echo createComIcon('../','statbel2.gif','0') ?>> corresponding to the chosen ward.<br>
 	<b>Step 2: </b>If you have logged in before and you have access right for the function, the occupancy list will be displayed immediately.<br>
		Otherwise,  you will be asked to enter your username and password.<br>
 	<b>Step 3: </b>If asked, enter your username and password.<br>
 	<b>Step 4: </b>Click the button <input type="button" value="Continue...">.<br>
 	<b>Step 5: </b>If you have an access right for the function, the occupancy list will be displayed.<br>
	<b>Note: </b>The occupancy list that will be displayed can be "edited". Options for editing or updataing patients' data will be displayed.
		You can also open the patients' data folder for further editing.<br>
	</ul>
	<?php else : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b>
There is no available occupancy list at the moment!</b>
</font><p>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to display previous occupancy quickviews using the archive?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click "<span style="background-color:yellow" > Click this to go to archive <img <?php echo createComIcon('../','bul_arrowgrnlrg.gif','0') ?>> </span>".<br>
 	<b>Step 2: </b>A guide calendar will appear.<br>
 	<b>Step 3: </b>Click on a date in the calendar to display the occupancy quickview for that day.<br>
	</ul>
	
	<?php endif;?>
<b>Note</b>
<ul> If you decide to close the quickview click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.
</ul><?php endif;?>

<?php if($src=="new") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to create a new ward?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Enter the ward ID or name in the "<span style="background-color:yellow" > Ward: </span>" field.<br>
 	<b>Step 2: </b>Select the department or clinic to where the ward belongs in the "<span style="background-color:yellow" > Department: </span>" selection field.<br>
 	<b>Step 3: </b>Write the ward's description and other information in the  "<span style="background-color:yellow" > Description: </span>" field.<br>
 	<b>Step 4: </b>Enter the first room's number in the ward in the "<span style="background-color:yellow" > Room number of the first room: </span>" field.<br>
 	<b>Step 5: </b>Enter the last room's number in the ward in the "<span style="background-color:yellow" > Room number of the last room: </span>" field.<br>
 	<b>Step 6: </b>Enter the prefix for the room in the "<span style="background-color:yellow" > Room prefix: </span>" field.<br>
 	<b>Step 7: </b>Enter the head nurse's name in the "<span style="background-color:yellow" > Head nurse: </span>" field.<br>
 	<b>Step 8: </b>Enter the assistant head nurse's name in the "<span style="background-color:yellow" > Assistant head nurse: </span>" field.<br>
 	<b>Step 9: </b>Type the names of the ward's nurses in the "<span style="background-color:yellow" > Nurses: </span>" text entry field.<br>
 	<b>Step 10: </b>Click the <input type="button" value="Create the ward"> button to create the ward.<br>
	</ul>
<b>Note</b>
<ul> If you decide to cancel click the button <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Can I set the numbers of beds in a room?</b>
</font>
<ul>       	
 	<b>No. </b>In this current program version the number or beds in a room is fixed to 2. You cannot change it.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Can I set the prefix (or id) for a bed?</b>
</font>
<ul>       	
 	<b>No. </b>In this current program version the prefix (of id) for a bed is fixed to either a or b . You cannot change it.<br>
	</ul>
<b>Note</b>
<ul> If you decide to cancel click the button <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
</ul>
<?php endif;?>
	
<?php if($src=="show") : ?>
	<?php if($x1=="1") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to save the ward's profile?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click the <input type="button" value="Save"> button.<br>
	</ul>
<b>Note</b>
<ul> If you decide to cancel click the button <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
</ul>

	<?php else : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to edit the ward's profile?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click the <input type="button" value="Edit ward's profile"> button.<br>
	</ul>
<b>Note</b>
<ul> If you decide to cancel click the button <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
I want to edit a station's profile other than the one currently displayed. What should I do?</b>
</font>
<ul>       	
 	<b>Step 1:</b> Click the "<span style="background-color:yellow" > <img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>> Other wards </span>" link to list the available wards.<br>
 	<b>Step 2:</b> Once the wards are listed, click the ward you wish to edit.
	</ul>
<b>Note</b>
<ul> If you decide to cancel click the button <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
</ul>

<?php endif;?>
<?php endif;?>


<?php if($src=="") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to select a ward for editing its profile?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click the ward on the list that you wish to edit.<br>
	</ul>
<b>Note</b>
<ul> If you decide to cancel click the button <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
</ul>

<?php endif;?>


</form>

