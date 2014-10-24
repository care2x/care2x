<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
Medical Laboratory - 
<?php
if($src=="create")
{
	switch($x1)
	{
	case "": print "Start a new log document";
						break;
	case "fresh": print "Start a new log document";
						break;
	case "get": print  "";
						break;
	case "logmain": print "Edit a documented operation's log entries";
						break;
	default: print "Log a new operation";	
	}
}
if($src=="time")
{
	print "Documenting ";
	switch($x1)
	{
	case "entry_out": print "entry and exit times";
						break;
	case "cut_close": print "cut and suture times";
						break;
	case "wait_time": print "idle (waiting) times";
						break;
	case "bandage_time": print "plaster cast times";
						break;
	case "repos_time": print "reposition times";
	}
}
if($src=="person")
{
	print "Documenting ";
	switch($x1)
	{
	case "operator":$person="a surgeon"; 
						break;
	case "assist":$person="an assistant surgeon"; 
						break;
	case "scrub": $person="a scrub nurse";
						break;
	case "rotating":$person="a rotating nurse"; 
						break;
	case "ana": $person="an anesthesiologist";
	}
	print $person;
}
if($src=="search")
{
	print "Search a patient";	
/*	switch($x1)
	{
	case "search": print "Selecting a particular document";
						break;
	case "": 
						break;
	case "get": print  "Patient's operation's log document";
						break;
	case "fresh": print "Search for a operation's log document";
	}
*/}
if($src=="arch")
{
	print "Archive";	
	/*switch($x1)
	{
	case "dummy": print "Archive";
						break;
	case "": print "Archive";
						break;
	case "?": print "Archive";
						break;
	case "search": print  "List of archive search results";
						break;
	case "select": print "Patient's document";
	}*/
}
if($src=="input")
{
	print "Entering test results";	
	/*switch($x1)
	{
	case "dummy": print "Archive";
						break;
	case "": print "Archive";
						break;
	case "?": print "Archive";
						break;
	case "search": print  "List of archive search results";
						break;
	case "select": print "Patient's document";
	}*/
}
 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<?php if($src=="person") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to enter <?php echo $person ?> via quick select list?</b>
</font>
<ul>       	
 	<b>Note: </b>If <?php echo $person ?> was selected in a previous operation, his name will be listed in the quick select list.<p>
 	<b>Step 1: </b>Check first whether his function is correctly selected in the " OR Function " selection box. If not, select his correct OR function.<br>
 	<b>Step 2: </b>Click on <?php echo $person ?>'s family name, or given name, or the 
	<nobr>"<span style="background-color:yellow" > <img <?php echo createComIcon('../','uparrowgrnlrg.gif','0') ?>> Enter this person as <?php echo $person ?>... </span>"</nobr> link.
	The surgeon will be automatically added in the "current entries"  list.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
<?php echo ucfirst($person) ?> does not appear on the quick select list. How to enter <?php echo $person ?>?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Enter either a complete information of the first few letters of <?php echo $person ?>'s family name or given name in the field "<span style="background-color:yellow" > Search a new <?php echo substr($person,2) ?>... </span>".<br>
 	<b>Step 2: </b>Click the <input type="button" value="OK"> button to start searching for <?php echo $person ?>.<br>
 	<b>Step 3: </b>The search will list the results. Click the family name, or the given name, or the <nobr>"<span style="background-color:yellow" > <img <?php echo createComIcon('../','uparrowgrnlrg.gif','0') ?>> Enter this person as <?php echo $person ?>... </span>"</nobr> link corresponding to <?php echo $person ?> you want to document.
</ul>


<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b> How to delete <?php echo $person ?> from the list?</b></font> 
<ul>       	
 	<b>Step 1: </b>Click the icon <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> on the right of the person's name.<br>
 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b> I am finished. How to go back to the logbook?</b></font> 
<ul>       	
 	<b>Step 1: </b>Click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle"> that will appear after you have selected <?php echo $person ?>.<br>
 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Note:</b></font> 
<ul>       	
 If you decide to cancel click the button <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
</ul>
<?php endif;?>

<?php if($src=="time") : ?>
	<?php if($x1=="entry_out") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to document the entry and exit times?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Enter the entry time in the "<span style="background-color:yellow" > from: <input type="text" name="d" size=5 maxlength=5> </span>" field in the left column.<br>
 	<b>Step 2: </b>Enter the exit time in the "<span style="background-color:yellow" > to: <input type="text" name="d" size=5 maxlength=5> </span>" field in the right column.<p>
<ul>       	
 	<b>Tip: </b>Enter either "n" or "N" (meaning Now) in the entry field to automatically enter the current time.
</ul><br>
 	<b>Note: </b>You can enter several entry and exit times all at once before you save the information.<p>
</ul>

	<?php endif;?>
	<?php if($x1=="cut_close") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to document cut and suture times?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Enter the cut time in the "<span style="background-color:yellow" > from: <input type="text" name="d" size=5 maxlength=5> </span>" field in the left column.<br>
 	<b>Step 2: </b>Enter the suture time in the "<span style="background-color:yellow" > to: <input type="text" name="d" size=5 maxlength=5> </span>" field in the right column.<p>
<ul>       	
 	<b>Tip: </b>Enter either "n" or "N" (meaning Now) in the entry field to automatically enter the current time.
</ul><br>
 	<b>Note: </b>You can enter several cut and suture times all at once before you save the information.<p>
</ul>

	<?php endif;?>
	<?php if($x1=="wait_time") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to document idle (waiting) times?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Enter the start time in the "<span style="background-color:yellow" > from: <input type="text" name="d" size=5 maxlength=5> </span>" field in the first column.<br>
 	<b>Step 2: </b>Enter the end time in the "<span style="background-color:yellow" > to: <input type="text" name="d" size=5 maxlength=5> </span>" field in the second column.<p>
<ul>       	
 	<b>Tip: </b>Enter either "n" or "N" (meaning Now) in the entry field to automatically enter the current time.
</ul><br>
 	<b>Step 3: </b>Select the reason from the selection box on the  third (Reason) column.<p>
 	<b>Note: </b>You can enter several start, end times, and reasons all at once before you save the information.<p>
</ul>

	<?php endif;?>
	<?php if($x1=="bandage_time") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to document plaster cast times?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Enter the start time in the "<span style="background-color:yellow" > from: <input type="text" name="d" size=5 maxlength=5> </span>" field in the left column.<br>
 	<b>Step 2: </b>Enter the end time in the "<span style="background-color:yellow" > to: <input type="text" name="d" size=5 maxlength=5> </span>" field in the right column.<p>
<ul>       	
 	<b>Tip: </b>Enter either "n" or "N" (meaning Now) in the entry field to automatically enter the current time.
</ul><br>
 	<b>Note: </b>You can enter several start and end times all at once before you save the information.<p>
</ul>

	<?php endif;?>
	<?php if($x1=="repos_time") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to document reposition times?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Enter the start time in the "<span style="background-color:yellow" > from: <input type="text" name="d" size=5 maxlength=5> </span>" field in the left column.<br>
 	<b>Step 2: </b>Enter the end time in the "<span style="background-color:yellow" > to: <input type="text" name="d" size=5 maxlength=5> </span>" field in the right column.<p>
<ul>       	
 	<b>Tip: </b>Enter either "n" or "N" (meaning Now) in the entry field to automatically enter the current time.
</ul><br>
 	<b>Note: </b>You can enter several start and end times all at once before you save the information.<p>
</ul>

	<?php endif;?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to save the information?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click the button <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> to save the information<br>
 	<b>Step 2: </b>If you are finished, click the <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> button to close the window and go back to the log book.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b> I want to delete the entries but clicking the "Reset data" button doesn't seem to work. What should I do?</b></font> 
<ul>       	
 	<b>Note: </b>Clicking the  "Reset data" button will only erase the entries which are not yet saved. If you want to delete entries
	which were saved previously, follow these instructions:<p>
 	<b>Step 1: </b>Click the entry field of the time that you want to delete.<br>
 	<b>Step 2: </b>Delete the time manually using "Del" or "Backspace" keys of the keyboard.<br>
 	<b>Step 3: </b>Click the button <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> to save the changes.<br>
 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Note:</b></font> 
<ul>       	
 If you decide to cancel click the button <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
</ul>
<?php endif;?>


<?php if($src=="create") : ?>
	<?php if($x1=="logmain") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to edit an operation's log entry?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click the button <img src="../img/update3.gif" width=15 height=14 border=0> corresponding to the patient's log entry.<br>
 	<b>Step 2: </b>The patient's log entries will be copied to the editor frame. You can now edit the entries following the instructions for documenting
		an operation.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to open the patient's data folder?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click the button <img <?php echo createComIcon('../','info3.gif','0') ?>> on the left of the patient's number.<br>
 	<b>Step 2: </b>The patient's data folder will pop up.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to change to other department and/or operating room?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Select the department from the selection box 
				<select name="dept" size=1>
				<?php
$Or2Dept=get_meta_tags("../global_conf/resolve_or2ordept.pid");
					$opabt=get_meta_tags("../global_conf/$lang/op_tag_dept.pid");

					while(list($x,$v)=each($opabt))
					{
						if($x=="anaesth") continue;
						print'
					<option value="'.$x.'"';
						if ($dept==$x) print " selected";
						print '> '.$v.'</option>';
					}
				?>
					
				</select>.
<br>
 	<b>Step 2: </b>Select the operating room from the selection box <select name="saal" size=1 >
				<?php
while(list($x,$v)=each($Or2Dept))
					{
						print'
					<option value="'.$x.'"';
						if ($saal==$x) print " selected";
						print '> '.$x.'</option>';
					}
				?>
				</select>.
<br>
 	<b>Step 3: </b>Click the button <input type="button" value="Change"> to change to the other department and/or operating room.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to display the log entries of a certain day other than the one currently displayed?</b>
</font>
<ul>       	
 	<b>Step 1: </b>To display the log entries of previous day(days), click on the "<span style="background-color:yellow" > Previous day </span>" link on the upper left corner of the table.<br>
	Click as many times as needed until the log entries of the desired day is displayed.<br>
 	<b>Step 2: </b>To display the log entries of the following day(days), click on the "<span style="background-color:yellow" > Next day </span>" link on the upper right corner of the table.<br>
	Click as many times as needed until the log entries of the desired day is displayed.<br>
</ul>

<hr>

	<?php endif;?>
	
	<?php if($x2=="material") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to document a material used for the operation?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Type the material's article number in the "<span style="background-color:yellow" > Article nr.: </span>" field.<p>
	<b>Alternative ways: </b>
	<ul type=disc>  	
	<li>Enter a complete information or the first few letters of the material's name, product description, generic, license number, or order number in the "<span style="background-color:yellow" > Article nr.: </span>" field.
	<li>Scan the article's barcode with the barcode scanner.
	</ul><br> 
 	<b>Step 2: </b>Click the <input type="button" value="OK"> button or hit the "enter" button on the keyboard to search for the product.<p> 
<ul>       	
 	<b>Note: </b>If the search finds one result, the material's information will be added immediately in the document.<p> 
 	<b>Note: </b>If the search finds several  results,  a list will be displayed. Click on the button <img <?php echo createComIcon('../','bul_arrowgrnlrg.gif','0') ?>> or the article's number, or the article's name to add it to the document.<p> 
	</ul>
 	<b>Step 3: </b>If the article is added to the document, you can change the entry in the "<span style="background-color:yellow" > no.Pcs.</span>" field if necessary.<p> 
<ul>       	
 	<b>Note: </b>Once you change the entry in the "no.Pcs." field, the buttons "Save" and "Reset data" will appear.<p> 
	</ul>
 	<b>Step 4: </b>If you have changed the entry in the "no.Pcs." field, click the button <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> to save the changes.<p> 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to remove an article from the list?</b>
</font>
<ul> 
 	<b>Step 1: </b>Click the icon <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> corresponding to the article.<br> 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
The article is not found. How to manually (forcibly) enter an article's info?</b>
</font>
<ul> 
 	<b>Step 1: </b>Click the "<span style="background-color:yellow" > <img <?php echo createComIcon('../','accessrights.gif','0') ?>> To enter the article manually, click here. </span>" link.<br> 
 	<b>Step 2: </b>Manually enter the article's information in the corresponding fields.<p> 
 	<b>Step 3: </b>Click the button <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> to add the article's information in the document<p> 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Note:</b></font> 
<ul>       	
 If you decide to cancel click the button <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to display the main logbook back again?</b>
</font>
<ul> 
 	<b>Step 1: </b>Click the "<span style="background-color:yellow" > <img <?php echo createComIcon('../','manfldr.gif','0') ?>> Show logbook. </span>" link.<br> 
</ul>
<hr>
	<?php endif;?>

	<?php if(($x1=="")||($x1=="fresh")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to start a log document for an operation?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Find the patient first. Type the patient's number in the "<span style="background-color:yellow" > Patient nr.: </span>" field.<p>
	<b>Alternative ways: </b>
	<ul type=disc>  	
	<li>Enter a complete information or the first few letters of the patient's family name or given name in the "<span style="background-color:yellow" > Family name, Given name </span>" field.
	<li>Enter a complete date or the first few digits of the patient's birthdate in the "<span style="background-color:yellow" > Birthdate </span>" field.
	</ul>
 	<b>Step 2: </b>Click the <input type="button" value="Search patient"> button  to start searching for the patient.<p> 
<ul>       	
 	<b>Note: </b>If the search finds one result, the patient's basic data will be entered immediately in their corresponding fields.<p> 
 	<b>Note: </b>If the search finds several  results,  a list will be displayed. Click on the patient's family name, or given name to select it for documentation.<p> 
	</ul>
 	<b>Step 3: </b>Click the <img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>> button again for further instructions.<p> 

</ul>

	<?php else : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to enter the diagnosis for the operation?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Type the diagnosis in the "<span style="background-color:yellow" > Diagnosis: </span>" field.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to enter the surgeon's info?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click the "<span style="background-color:yellow" > Surgeon </span>" link.<br>
 	<b>Step 2: </b>A pop-up window for entering surgeons' information will appear. <br>
 	<b>Step 3: </b>Follow the instructions in the window or click the "Help" button within the window for further help instructions. <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to enter the assistant surgeon's info?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click the "<span style="background-color:yellow" > Assistant </span>" link.<br>
 	<b>Step 2: </b>A pop-up window for entering assistant surgeons' information will appear. <br>
 	<b>Step 3: </b>Follow the instructions in the window or click the "Help" button within the window for further help instructions. <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to enter the scrub nurses' info?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click the "<span style="background-color:yellow" > Scrub nurse </span>" link.<br>
 	<b>Step 2: </b>A pop-up window for entering the scrub nurses' information will appear. <br>
 	<b>Step 3: </b>Follow the instructions in the window or click the "Help" button within the window for further help instructions. <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to enter the rotating nurses' info?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click the "<span style="background-color:yellow" > Rotating nurse </span>" link.<br>
 	<b>Step 2: </b>A pop-up window for entering rotating nurses' information will appear. <br>
 	<b>Step 3: </b>Follow the instructions in the window or click the "Help" button within the window for further help instructions. <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to enter the type of anesthesia used for the operation?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Select the type of anesthesia from the "<span style="background-color:yellow" > Anesthesia <select name="a">
                                                                     	<option > ITA</option>
                                                                     	<option > Plexus</option>
                                                                     	<option > ITA-Jet</option>
                                                                     	<option > ITA-Mask</option>
                                                                     	<option > LA</option>
                                                                     	<option > DS</option>
                                                                     	<option > AS</option>
                                                                     </select> </span>" field.<p>
	<ul type=disc>       	
 	<li><b>ITA: </b>Intra-tracheal anesthesia<br>
 	<li><b>LA: </b>Local anesthesia<br>
 	<li><b>AS: </b>Analgesic-sedation<br>
 	<li><b>DS: </b>Equivalent to AS<br>
 	<li><b>Plexus: </b>Nervus plexus local anesthesia<br>
	</ul>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to enter the anesthesiologist's info?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click the "<span style="background-color:yellow" > Anesthesiologist </span>" link.<br>
 	<b>Step 2: </b>A pop-up window for entering anesthesiologist's information will appear. <br>
 	<b>Step 3: </b>Follow the instructions in the window or click the "Help" button within the window for further help instructions. <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to enter the entry, cut, suture, and exit times directly in their corresponding fields?</b>
</font>
<ul>       	
 	<b>Entry time: </b>Enter the time in the "<span style="background-color:yellow" > Entry:<input type="text" name="t" size=5 maxlength=5> </span>" field.<br>
 	<b>Cut time: </b>Enter the time in the "<span style="background-color:yellow" > Cut: <input type="text" name="t" size=5 maxlength=5> </span>" field.<br>
 	<b>Suture time: </b>Enter the time in the "<span style="background-color:yellow" > Suture: <input type="text" name="t" size=5 maxlength=5> </span>" field.<br>
 	<b>Exit time: </b>Enter the time in the "<span style="background-color:yellow" > Exit: <input type="text" name="t" size=5 maxlength=5> </span>" field.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to enter several time information all at once?</b>
</font>
<ul> <b>Step 1: </b><p>    	
 	<b>Entry/Exit time: </b>
 	Click the "<span style="background-color:yellow" > Entry/Exit <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>" link situated on the lower left corner.<p>
 	<b>Cut/Suture time:</b>
 	Click the "<span style="background-color:yellow" > Cut/Suture <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>" link situated on the lower left corner.<p>
 	<b>Idle time: </b>
 	Click the "<span style="background-color:yellow" > Idle time <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>" link situated on the lower left corner.<p>
 	<b>Plaster/Cast time:</b>
 	Click the "<span style="background-color:yellow" > Plaster/Cast <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>" link situated on the lower left corner.<p>
 	<b>Reposition time: </b>
 	Click the "<span style="background-color:yellow" > Reposition <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>" link situated on the lower left corner.<p>
 	<b>Step 2: </b>A pop-up window for entering time information will appear. <br>
 	<b>Step 3: </b>Follow the instructions in the window or click the "Help" button within the window for further help instructions. <br>
	</ul>

	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to enter time information in the graphical time chart?</b>
</font>
<ul> <b>Step 1: </b>Move the mouse pointer into the chosen time in the time scale corresponding to the time information (eg. Plaster/Cast).<br>
 	<b>Step 2: </b>Click into the time scale corresponding to the chosen time.<p>
<b>Note:</b> The first entry will be the start time, the second entry will be the end time, the third entry will be the second start time, etc.
	</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to enter the therapy or operation information?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Type the therapy or operation  in the "<span style="background-color:yellow" > Therapy/Operation: </span>" field.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to enter results, observation, extra notices?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Type it  in the "<span style="background-color:yellow" > Results: </span>" field.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to save the log document?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click the button <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>><br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to start a new log document?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click the button <img <?php echo createLDImgSrc('../','newpat2.gif','0') ?>><br>
 	<b>Step 2: </b>Click the button <img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>> again for further help instructions.<br>
	</ul>
	
<b>Note</b>
<ul> If you decide to close click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.
</ul>
	<?php endif;?>

<?php endif;?>



<?php if($src=="search") : ?>
<?php if(($x2!="")&&($x2!="0")) : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to select a particular patient whose lab report I want to <?php if($x1=="edit") print "edit"; else print "see"; ?>?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click the button&nbsp;<button><img <?php echo createComIcon('../','update2.gif','0') ?>> <font size=1>Lab report</font></button> corresponding to the patient whose lab report you want to  <?php if($x1=="edit") print "edit"; else print "see"; ?>.<p> 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to continue searching?</b>
</font>
	<?php endif;?>
	<?php if(($x2=="")||($x2=="0")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to search for a  patient?</b>
</font>
	<?php endif;?>
	
	<ul>       	
 	<b>Step 1: </b>Enter either a complete information or the first few letters of the patient's family name, 
	or given name, or birthdate in the "<span style="background-color:yellow" > Enter a search keyword. <input type="text" name="m" size=20 maxlength=20> </span>" field. <br>
 	<b>Step 2: </b>Click the button <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> to start searching for the patient.<p> 
<ul>       	
 	<b>Note: </b>If the search delivers a result,  a list will be displayed. <p>
	</ul>
	<?php if(($x2=="")||($x2=="0")) : ?>
 	<b>Step 3: </b>Click the button&nbsp;<button><img <?php echo createComIcon('../','update2.gif','0') ?>> <font size=1>Lab report</font></button> corresponding to the patient whose lab report you want to  <?php if($x1=="edit") print "edit"; else print "see"; ?>.<p> 
	<?php endif;?>
</ul>

<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Note:</b></font> 
<ul>       	
 If you decide to cancel click the button <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
</ul>
<?php endif;?>

<?php if($src=="arch") : ?>
	<?php if($x2=="1") : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Note: Latest log entry (entries)</b></font> 
<ul>  Every time you switch over to the archive, the last logged operations will be displayed immediately.
</ul>
	<?php endif;?>
	<?php if(($x3=="")&&($x1!="0")) : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> No operation done on this day.</b></font> 
<ul>       	
Click the "Options" to open the option box.<br>
Click the "Search" to switch over to search mode.</ul>
	
	<?php endif;?>
	



<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>I want to see the archived log entries of another day.</b></font>
<ul> <b>To display previous day: </b>Click on the "<span style="background-color:yellow" > Previous day </span>" link on the upper left column. 
				Click this link as many times as needed until the desired day is displayed.<p>
 <b>To display next day: </b>Click on the "<span style="background-color:yellow" > Next day </span>" link on the upper right column. 
				Click this link as many times as needed until the desired day is displayed.<br>		
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>I want to see the archived log entries of another operating room or department.</b></font>
<ul> <b>Step 1: </b>Select the department in the selection box <nobr>"<span style="background-color:yellow" > Change the department or OP room <select name="o">
                                                                                                                                         	<option > Sample department 1</option>
                                                                                                                                         	<option > Sample department 2</option>
                                                                                                                                         </select>
                                                                                                                                          </span>".</nobr> <br>The default operating room will
		automatically adjust.<br>																																		  
	<b>Step 2: </b>Or select the operating room in the selection box <nobr>"<span style="background-color:yellow" > <select name="o">
                                                                                                                                         	<option > Sample OR 1</option>
                                                                                                                                         	<option > Sample OR 2</option>
                                                                                                                                         </select>
                                                                                                                                          </span>".</nobr> <br> The corresponding
		department will automatically adjust.<br>																																		  																																		  
		<b>Step 3: </b>Click the button <input type="button" value="Change">  to switch to the new department or operating room.<br>
</ul>
<?php if(($x3!="")) : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to update or edit a displayed log document?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click the <img src="../img/update3.gif" border=0> button situated below the operation's date on the leftmost column to switch to editing mode.<br>
 	<b>Step 2: </b>Once in the editing mode, click the "Help" button if you need further instructions in editing the document.<p> 
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to open the patient's data folder?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click the <img src="../img/info2.gif" border=0> button on the left of the patient number.<br>
 	<b>Step 2: </b>The patient's data folder will pop up. Click the "Help" button in the window if you need further instructions.<p> 
	</ul>
	<?php endif;?>
	
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Note:</b></font> 
<ul>       	
 If you decide to cancel click the button <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
</ul>


	<?php endif;?>

<?php if($src=="input") : ?>
	<?php if($x1=="main") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to enter test results values?</b>
</font>
<ul>       	
		<?php if($x2=="") 
			print '
 			<b>Step 1: </b>Enter the batch number in the "<span style="background-color:yellow" > Batch nr.: </span>" field.<br>	
 			<b>Step 2: </b>Enter the examination date in the "<span style="background-color:yellow" > Examination date </span>" field if necessary.<br>	';
	
		?>

	
 	<b>Step	<?php if($x2=="") 
			print "3"; else print "1";
		?>:</b> Enter the values into their corresponding parameter fields.<br>	
 	<b>Step <?php if($x2=="") 
			print "4"; else print "2";
		?>: </b> Click the button <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> to save the values.<p> 
 	<b>Note: </b>After you have saved the values and you want to close,<br> click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.<br> 
</ul>
	<?php endif;?>
<?php if($x1=="few") : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
I need to enter only a few values! How to do it?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Just enter the available values into their corresponding parameter fields.<br> 
 	<b>Step 2: </b>Click the button <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> to save the parameter values.<p> 
 	<b>Note: </b>If you are finished entering all parameter values and you want to close click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.<br> 
</ul>
	<?php endif;?>
	<?php if($x1=="param") : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
The parameter I need is not displayed! How to switch to the right parameter group?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Select the right parameter group from the <nobr>"<span style="background-color:yellow" > Select parameter group <select name="s">
     <option value="Sample parameter"> Sample parameter</option> </select> </span>"</nobr> selection box.<p> 
 	<b>Step 2: </b>Click the button <img <?php echo createLDImgSrc('../','auswahl2.gif','0') ?>> to switch over to the selected parameter group.<p> 
</ul>
	<?php endif;?>
	<?php if($x1=="save") : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How should I save the values?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click the button <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> to save the parameter values.<p> 
 	<b>Note: </b>After you have saved the values and you want to close,<br> click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.<br> 
</ul>
	<?php endif;?>
	<?php if($x1=="correct") : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
I have saved a wrong value. How can I correct that?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Just enter the correct value into the corresponding parameter field.<br> 
 	<b>Step 2: </b>Click the button <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> to save the correct value.<p> 
 	<b>Note: </b>After you have saved the values and you want to close,<br> click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.<br> 
</ul>
	<?php endif;?>
	<?php if($x1=="note") : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
I need to enter a note instead of a value. How to do that?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Just type the note into the corresponding parameter field.<br> 
 	<b>Step 2: </b>Click the button <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> to save the note.<p> 
 	<b>Note: </b>After you have saved and you want to close,<br> click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.<br> 
</ul>
	<?php endif;?>
	<?php if($x1=="done") : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
I'm done. What now?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click the button <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> to save all values.<p> 
 	<b>Note: </b>Click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.<br> 
</ul>
	<?php endif;?>
	

<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Note:</b></font> 
<ul>       	
 If you decide to cancel click the button <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
</ul>
<?php endif;?>
</form>

