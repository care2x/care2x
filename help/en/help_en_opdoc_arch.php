<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
OR Documentation - 
<?php
if($src=="arch")
{
	switch($x1)
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
	}
}
 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >

<?php if($src=="arch") : ?>
	<?php if(($x1=="dummy")||($x1=="?")||($x1=="")||!$x2) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>I want to list all  documents  of operations done on a certain date</b></font>
<ul> <b>Step 1: </b>Enter the operation's date in the field "<span style="background-color:yellow" > Operation date: </span>". <br>
		<ul><font size=1 color="#000099">
		<!-- <b>Tip:</b> Enter "T" or "t" to automatically produce today's date.<br>
		<b>Tip:</b> Enter "Y" or "y" to automatically produce yesterday's date.<br> -->
		</font>
		</ul><b>Step 2: </b>Leave all other fields blank or empty.<br>
		<b>Step 3: </b>Click the button <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  to start the search.<br>
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>I want to list all OR documents of a certain patient</b></font>
<ul> <b>Step 1: </b>Enter the keyword in the corresponding field. It can be a full word or phrase or a few letters of a word from the patient's personal data. <br>
		<ul><font size=1 color="#000099" >
		<b>Following fields can be filled with a keyword:</b>
		<br> Patient nr.
		<br> Family name
		<br> Given name
		<br> Birthdate
		</font>
		</ul><b>Step 2: </b>Leave all other fields blank or empty.<br>
		<b>Step 3: </b>Click the button <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  to start the search.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>I want to list all OR documents done by a certain surgeon.</b></font>
<ul> <b>Step 1: </b>Enter the surgeon's name in the field "<span style="background-color:yellow" > Surgeon: </span>". <br>
		<b>Step 2: </b>Leave all other fields blank or empty.<br>
		<b>Step 3: </b>Click the button <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  to start the search.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>I want to list all OR documents of outpatients </b></font>
<ul> <b>Step 1: </b>Click the radio button "<span style="background-color:yellow" >Outpatient <input type="radio" name="r" value="1"></span>". <br>
		<b>Step 2: </b>Leave all other fields blank or empty.<br>
		<b>Step 3: </b>Click the button <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  to start the search.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>I want to list all OR documents of inpatients </b></font>
<ul> <b>Step 1: </b>Click the radio button "<span style="background-color:yellow" ><input type="radio" name="r" value="1">Inpatient</span>". <br>
		<b>Step 2: </b>Leave all other fields blank or empty.<br>
		<b>Step 3: </b>Click the button <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  to start the search.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>I want to list all OR documents of generally insured patients </b></font>
<ul> <b>Step 1: </b>Click the radio button "<span style="background-color:yellow" ><input type="radio" name="r" value="1">Insurance</span>". <br>
		<b>Step 2: </b>Leave all other fields blank or empty.<br>
		<b>Step 3: </b>Click the button <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  to start the search.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>I want to list all OR documents of privately insured patients </b></font>
<ul> <b>Step 1: </b>Click the radio button "<span style="background-color:yellow" ><input type="radio" name="r" value="1">Private</span>". <br>
		<b>Step 2: </b>Leave all other fields blank or empty.<br>
		<b>Step 3: </b>Click the button <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  to start the search.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>I want to list all OR documents of self-paying patients </b></font>
<ul> <b>Step 1: </b>Click the radio button "<span style="background-color:yellow" ><input type="radio" name="r" value="1">Self pay</span>". <br>
		<b>Step 2: </b>Leave all other fields blank or empty.<br>
		<b>Step 3: </b>Click the button <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  to start the search.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>I want to list all OR documents with a certain keyword</b></font>
<ul> <b>Step 1: </b>Enter the keyword in the corresponding field. It can be a full word or phrase or  the first few letters of a word. <br>
		<ul><font size=2 color="#000099" >
		<b>Example:</b> For diagnostic keyword enter it in the "Diagnosis" field.<br>
		<b>Example:</b> For localization keyword enter it in the "Localization" field.<br>
		<b>Example:</b> For therapeutic keyword enter it in the "Therapy" field.<br>
		<b>Example:</b> For special notice keyword enter it in the "Special notice" field.<br>
		</font>
		</ul><b>Step 2: </b>Leave all other fields blank or empty.<br>
		<b>Step 3: </b>Click the button <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  to start the search.<br>
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>I want to list all documents with a certain classification of operation</b></font>
<ul> <b>Step 1: </b>Enter the keyword in the corresponding field. It can be a full word or phrase or  the first few letters of a word. <br>
		<ul><font size=2 color="#000099" >
		<b>Example:</b> For minor operation enter the number in the "<span style="background-color:yellow" > <input type="text" name="m" size=4 maxlength=2> minor </span>" field.<br>
		<b>Example:</b> For middle operation enter the number in the "<span style="background-color:yellow" > <input type="text" name="m" size=4 maxlength=2> middle </span>" field.<br>
		<b>Example:</b> For mafor operation enter the number in the "<span style="background-color:yellow" > <input type="text" name="m" size=4 maxlength=2> major </span>" field.<br>
		</font>
		</ul><b>Step 2: </b>Leave all other fields blank or empty.<br>
		<b>Step 3: </b>Click the button <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  to start the search.<br>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>><b><font color="#990000"> Note:</font></b>
<ul> You can combine several search conditions. For example: If you want to list all inpatients who were operated by the surgeon "Smith" 
		and who have the therapy containing a word which starts with "lipo":<p>
		<b>Step 1: </b>Enter "Smitn" in the field "<span style="background-color:yellow" > Surgeon: <input type="text" name="s" size=15 maxlength=4 value="Smith"> </span>".<br>
		<b>Step 2: </b>Click the radio button "<span style="background-color:yellow" > <input type="radio" name="r" value="1" checked>Inpatient </span>".<br>
		<b>Step 3: </b>Enter "lipo" in the field "<span style="background-color:yellow" > Therapy: <input type="text" name="s" size=20 maxlength=4 value="lipo"> </span>". <br>
		<b>Step 4: </b>Click the button <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  to start the search.<p>

<b>Note</b><br>
If the search finds a single result, the complete document will be displayed immediately.<br>
		However, if the search finds several results, a list will be displayed.<p>
		To open the document for the patient you are looking for, click either the button <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> corresponding to it, or
		the given name, or the family name, or the or date, or the op number <nobr>(op nr)</nobr>.
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Note:</b></font> 
<ul>       	
 If you decide to close click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.
</ul>
	<?php endif; ?>
<?php if(($x1=="search"||$x1='paginate')&&($x2>0)) : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to select a particular archived document for display?</b>
</font>
<ul>       	
 	<b>Note: </b> Click  the patient's family name,  or given name, or the op date, or the op number to display the archived document.<p> 
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to sort the list?</b>
</font>
<ul>       	
 	<b>Note: </b> Click on the column's title where you want the list to be sorted.<p> 
	For example: If you want to sort the list by the operation date, click the "OP date" title. <br>Next click will reverse the sort order:<p>
	<blockquote>
	<img src='../help/en/img/en_or_search_sort.png'>
	</blockquote>
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to continue searching in the archives?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click the button <input type="button" value="New archive research"> to go back to archive's search entry fields.<p> 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Note:</b></font> 
<ul>       	
 If you decide to close click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.
</ul>
	<?php endif; ?>
<?php if(($x1=="select"||$x1='paginate')&&($x2==1)) : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to update or edit the displayed archived document?</b>
</font>
<ul>       	
 	<b>Step 1: </b>Click the <input type="button" value="Update data"> button to switch to editing mode.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to continue searching in the archives?</b>
</font>
<ul>       	
 	<b>Method 1: </b>Click the button <input type="button" value="New archive research"> to go back to archive's search entry fields.<p> 
 	<b>OR Method 2: </b>Click the <img <?php echo createLDImgSrc('../','arch-blu.gif','0','absmiddle') ?>> button to go back to archive's search entry fields.<p> 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Note:</b></font> 
<ul>       	
 If you decide to close click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.
</ul>

<?php endif; ?>
<?php endif; ?>

</form>

