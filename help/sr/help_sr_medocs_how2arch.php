<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>How to research in the medocs archives</b></font>
<form action="#" >
<p><font size=2 face="verdana,arial" >

<?php if($src=="select") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>I want to update the displayed medocs document</b></font>
<ul> <b>Step : </b>Click the button <input type="button" value="Update data"> to start editing the document.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>I want to start a new research in the archives</b></font>
<ul> <b>Step : </b>Click the button <input type="button" value="New research in archive"> to start a new research.<br>
</ul>
<?php elseif(($src=="search")&&($x1)) : ?>
<b>Note</b>
<ul><?php if($x1==1) : ?> If the search finds a single result, the complete document will be displayed immediately.<br>
		However, if the search finds several results, a list will be displayed.<br>
		<?php endif;?>
		To see the information for the patient you are looking for, click either the button <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> corresponding to it, or
		the name, or the Family name or the admission date.
</ul>
<b>Note</b>
<ul> If you want to start a new research  click the button <input type="button" value="New research in archive">.
</ul>
<?php else : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>I want to list all medocs documents of a certain department</b></font>
<ul> <b>Step 1: </b>Enter the department's code in the field "Department:". <br>
		<b>Step 2: </b>Leave all other fields blank or empty.<br>
		<b>Step 3: </b>Click the button <input type="button" value="Search">  to start the search.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>I am searching for a certain medocs document of a certain patient</b></font>
<ul> <b>Step 1: </b>Enter the keyword in the corresponding field. It can be a full word or phrase or a few letters of a word from the patient's personal data. <br>
		<ul><font size=1 color="#000099" >
		<b>Following fields can be filled with a keyword:</b>
		<br> Patient's number
		<br> Family name
		<br> Given name
		<br> Birthdate
		<br> Address
		</font>
		</ul><b>Step 2: </b>Leave all other fields blank or empty.<br>
		<b>Step 3: </b>Click the button <input type="button" value="Search">  to start the search.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>I want to list all medocs documents with a certain insurance organization</b></font>
<ul> <b>Step 1: </b>Enter the insurance organization's acronym in the field "Insurance:". <br>
		<b>Step 2: </b>Leave all other fields blank or empty.<br>
		<b>Step 3: </b>Click the button <input type="button" value="Search">  to start the search.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>I want to list all medocs documents with a certain additional insurance info</b></font>
<ul> <b>Step 1: </b>Enter the keyword in the field "Extra information:". <br>
		<b>Step 2: </b>Leave all other fields blank or empty.<br>
		<b>Step 3: </b>Click the button <input type="button" value="Search">  to start the search.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>I want to list all medocs documents of MALE patients </b></font>
<ul> <b>Step 1: </b>Click the radio button "<span style="background-color:yellow" >Sex <input type="radio" name="r" value="1">male</span>". <br>
		<b>Step 2: </b>Leave all other fields blank or empty.<br>
		<b>Step 3: </b>Click the button <input type="button" value="Search">  to start the search.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>I want to list all medocs documents of FEMALE patients </b></font>
<ul> <b>Step 1: </b>Click the radio button "<span style="background-color:yellow" ><input type="radio" name="r" value="1">female</span>". <br>
		<b>Step 2: </b>Leave all other fields blank or empty.<br>
		<b>Step 3: </b>Click the button <input type="button" value="Search">  to start the search.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>I want to list all medocs documents of   patients who have received the obligatory medical advice</b></font>
<ul> <b>Step 1: </b>Click the radio button "<span style="background-color:yellow" >Medical advice: <input type="radio" name="r" value="1">Yes</span>". <br>
		<b>Step 2: </b>Leave all other fields blank or empty.<br>
		<b>Step 3: </b>Click the button <input type="button" value="Search">  to start the search.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>I want to list all medocs documents of   patients who have NOT received the obligatory medical advice</b></font>
<ul> <b>Step 1: </b>Click the radio button "<span style="background-color:yellow" ><input type="radio" name="r" value="1">No</span>". <br>
		<b>Step 2: </b>Leave all other fields blank or empty.<br>
		<b>Step 3: </b>Click the button <input type="button" value="Search">  to start the search.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>I want to list all medocs documents with a certain keyword</b></font>
<ul> <b>Step 1: </b>Enter the keyword in the corresponding field. It can be a full word or phrase or a few letters of a word. <br>
		<ul><font size=1 color="#000099" >
		<b>Example:</b> For diagnostic keyword enter it in the "Diagnosis" field.<br>
		<b>Example:</b> For therapeutic keyword enter it in the "Suggested therapy" field.<br>
		</font>
		</ul><b>Step 2: </b>Leave all other fields blank or empty.<br>
		<b>Step 3: </b>Click the button <input type="button" value="Search">  to start the search.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>I want to list all medocs documents written on a given date</b></font>
<ul> <b>Step 1: </b>Enter the document date in the field "Documented on:". <br>
		<ul><font size=1 color="#000099">
		<b>Tip:</b> Enter "T" or "t" to automatically produce today's date.<br>
		<b>Tip:</b> Enter "Y" or "y" to automatically produce yesterday's date.<br>
		</font>
		</ul><b>Step 2: </b>Leave all other fields blank or empty.<br>
		<b>Step 3: </b>Click the button <input type="button" value="Search">  to start the search.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>I want to list all medocs documents written by a certain person</b></font>
<ul> <b>Step 1: </b>Enter the full or the first few letters of the person's name  in the field "Documented by:". <br>
		<b>Step 2: </b>Leave all other fields blank or empty.<br>
		<b>Step 3: </b>Click the button <input type="button" value="Search">  to start the search.<br>
</ul>
<b>Note</b>
<ul> You can combine several search conditions. For example: If you want to list all MALE patients who were operated in the
		plastic surgery, who have received the obligatory medical advice, and who have the therapy containing a word which starts with "lipo":<p>
		<b>Step 1: </b>Enter "plop" in the field "Department:". <br>
		<b>Step 2: </b>Click the radio button "<span style="background-color:yellow" >Sex<input type="radio" name="r" value="1">male</span>".<br>
		<b>Step 3: </b>Click the radio button "<span style="background-color:yellow" >Medical advice:<input type="radio" name="r" value="1">Yes</span>".<br>
		<b>Step 4: </b>Enter "lipo" in the field "Therapy:". <br>
		<b>Step 5: </b>Click the button <input type="button" value="Search">  to start the search.<br>
</ul>
<b>Note</b>
<ul> If the search finds a single result, the complete document will be displayed immediately.<br>
		However, if the search finds several results, a list will be displayed.<br>
		To open the document for the patient you are looking for, click either the button <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> corresponding to it, or
		the name, or the Family name or the admission date.
</ul>

<?php endif;?>
<b>Note</b>
<ul> If you decide to cancel research  click the button <input type="button" value="Close">.
</ul>
</form>

