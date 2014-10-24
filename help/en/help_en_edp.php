<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
EDP - 
<?php
	if($x1=='edit') $x1='update';
	switch($src)
	{
	case "access": 
		switch($x1)
						{
							case "": print "Creating access right";
												break;
							case "save": print "New access right saved";
												break;
							case "list": print "Existing access rights";
												break;
							case "update": print "Editing an existing access right";
												break;
							case "lock":  if($x2=="0") print "Locking"; else print "Unlocking"; print  " an existing right";
												break;
							case "delete": print "Deleting an access right";
												break;
						}
						break;
	}


 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >

	

<?php if($src=="access") : ?>
	<?php if($x1=="") : ?>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to create access permissions for a hospital's employee ?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Find the employee first. Click the <input type="button" value="Find an employee"> button.<p>
 	<b>Step 2: </b>A search page will appear. Follow futher help instructions on how to search for the employee.<p>
</ul>

		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to create a new access right?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Enter the complete name of the person, or the department, or clinic, etc in the "<span style="background-color:yellow" > Name </span>" field.<br>
 	<b>Step 2: </b>Enter the username  in the "<span style="background-color:yellow" > User login name </span>" field.<p>
	<b>Note:</b> Space is not allowed for the username.<p>
 	<b>Step 3: </b>Enter the password for the username "<span style="background-color:yellow" > Password </span>" field.<p>
 	<b>Step 4: </b>Check the areas where the user is allowed to enter in the  permission "tree".<p>
</ul>

	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
I am finished entering all relevant information. How to save it?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click the <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> button.<br>
</ul>
	<?php endif; ?>	
	<?php if($x1=="save") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
The new access right is now saved. How to create another access right?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click the <input type="button" value="OK"> button.<br>
 	<b>Step 2: </b>The entry form will appear.<br>
 	<b>Step 3: </b>To see further instructions on creating an access right, click the "Help" button.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
I want to see the list of the existing access rights. How to do it?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click the button <input type="button" value="List actual access rights">.<br>
 	<b>Step 2: </b>The existing access rights will be listed<br>
</ul>
	
	<?php endif; ?>	
	<?php if($x1=="list") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
What do the buttons <img <?php echo createComIcon('../','padlock.gif','0','absmiddle') ?>> and <img <?php echo createComIcon('../','arrow-gr.gif','0','absmiddle') ?>> mean?</b>
</font>
<ul>       	
 	<img <?php echo createComIcon('../','padlock.gif','0','absmiddle') ?>> = The user's access right is locked or "freezed". He cannot enter the areas set as accessible.<br>
 	<img <?php echo createComIcon('../','arrow-gr.gif','0','absmiddle') ?>> = The user's access right is not locked . He can enter the areas set as accessible.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
What do the options "C","L", and "D", or "U" mean?</b>
</font>
<ul>       	
 	<b>C: </b> = Change or edit the user's access data.<br>
 	<b>L: </b> = Lock the user's access right.<br>
 	<b>D: </b> = Delete the user's access right.<br>
 	<b>U: </b> = Unlock the user's access right (if currently locked).<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to change or edit the user's access data?</b>
</font>
<ul>       	
 	Click the option "<span style="background-color:yellow" > C </span>" corresponding to the user.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to lock the user's access data?</b>
</font>
<ul>       	
 	Click the option "<span style="background-color:yellow" > L </span>" corresponding to the user.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to unlock the user's access data? (if currently locked)</b>
</font>
<ul>       	
 	Click the option "<span style="background-color:yellow" > U </span>" corresponding to the user.<br>
</ul>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to delete an access right?</b>
</font>
<ul>       	
 	Click the option "<span style="background-color:yellow" > D </span>" corresponding to the user.<br>
</ul>

	<?php endif; ?>	
	
	<?php if($x1=="update") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to edit an access right?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Edit the information.<br>
 	<b>Step 2: </b>Click the <img <?php echo createLDImgSrc('../','savedisc.gif','0','absmiddle') ?>> button .<br>
</ul>
	<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b>
Note:</b>
</font>
<ul>       	
 	If you decide not to edit click the <img <?php echo createLDImgSrc('../','cancel.gif','0','absmiddle') ?>>  button.<br>
</ul>
	
	<?php endif; ?>		
	<?php if($x1=="delete") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to delete an access right?</b>
</font>
<ul>       	
 	<b>Step 1: </b>If you are sure you want to delete the access right,<br>
	 click the button <input type="button" value="Yes, I am dead sure. Delete access right.">.<br>
</ul>
	<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b>
Note:</b>
</font>
<ul>       	
 	If you decide not to delete click the button <input type="button" value="No. Go back.">.<br>
</ul>
	
	<?php endif; ?>		
	
	<?php if($x1=="lock") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to <?php if($x2=="0") print "lock"; else print "unlock"; ?> an access right?</b>
</font>
<ul>       	
 	<b>Step 1: </b>If you are sure you want to <?php if($x2=="0") print "lock"; else print "unlock"; ?> the access right,<br>
	 click the button <input type="button" value="Yes, I'm sure.">.<br>
</ul>
	<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b>
Note:</b>
</font>
<ul>       	
 	If you decide not to <?php if($x2=="0") print "lock"; else print "unlock"; ?> click the button <input type="button" value="No. Go back.">.<br>
</ul>
	
	<?php endif; ?>		
<?php endif;; ?>	

	</form>

