<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>How to research in the archives</b></font>
<form action="#" >
<p><font size=2 face="verdana,arial" >

<?php if($src=="select") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>I want to update the displayed data</b></font>
<ul> <b>Step : </b>Click the button <input type="button" value="Update data"> to start editing the data.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>I want to start a new search in the archives</b></font>
<ul> <b>Step : </b>Click the button <input type="button" value="New research in archive"> to start a new search.<br>
</ul>
<?php elseif($src=="search") : ?>
<b>Note</b>
<ul> If the search finds a single result, the complete information will be displayed immediately.<br>
		However, if the search finds several results, a list will be displayed.<br>
		To see the information for the patient you are looking for, click either the button <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> corresponding to it, or
		the name, or the Family name or the admission date.
</ul>
<b>Note</b>
<ul> If you want to start a new research  click the button <input type="button" value="New research in archive">.
</ul>
<?php else : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>I want to list all admitted patients today</b></font>
<ul> <b>Step 1: </b>Enter today's date in the field "Admission date: from:". <br>
		<ul><font size=1 color="#000099">
		<b>Tip:</b> Enter "T" or "t" to automatically produce today's date.<br>
		</font>
		</ul><b>Step 2: </b>Leave the field "to:" empty.<br>
		<b>Step 3: </b>Click the button <input type="button" value="SEARCH">  to start the search.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>I want to list all admitted patients between two dates inclusive</b></font>
<ul> <b>Step 1: </b>Enter the starting date in the field "Admission date: from:". <br>
		<ul><font size=1 color="#000099">
		<b>Tip:</b> Enter "T" or "t" to automatically produce today's date.<br>
		<b>Tip:</b> Enter "Y" or "y" to automatically produce yesterday's date.<br>
		</font>
		</ul><b>Step 2: </b>Enter the end date in the field "to:".<br>
		<b>Step 3: </b>Click the button <input type="button" value="SEARCH">  to start the search.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>I want to list all MALE admitted patients </b></font>
<ul> <b>Step 1: </b>Click the radio button "Sex <input type="radio" name="r" value="1">male". <br>
		<b>Step 2: </b>Leave all other fields blank or empty.<br>
		<b>Step 3: </b>Click the button <input type="button" value="SEARCH">  to start the search.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>I want to list all FEMALE admitted patients </b></font>
<ul> <b>Step 1: </b>Click the radio button "<input type="radio" name="r" value="1">female". <br>
		<b>Step 2: </b>Leave all other fields blank or empty.<br>
		<b>Step 3: </b>Click the button <input type="button" value="SEARCH">  to start the search.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>I want to list all ambulant admitted patients </b></font>
<ul> <b>Step 1: </b>Click the radio button "<input type="radio" name="r" value="1">Ambulant". <br>
		<b>Step 2: </b>Leave all other fields blank or empty.<br>
		<b>Step 3: </b>Click the button <input type="button" value="SEARCH">  to start the search.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>I want to list all stationary admitted patients</b></font>
<ul> <b>Step 1: </b>Click the radio button "<input type="radio" name="r" value="1">Stationary". <br>
		<b>Step 2: </b>Leave all other fields blank or empty.<br>
		<b>Step 3: </b>Click the button <input type="button" value="SEARCH">  to start the search.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>I want to list all self paying patients </b></font>
<ul> <b>Step 1: </b>Click the radio button "<input type="radio" name="r" value="1">Self pay". <br>
		<b>Step 2: </b>Leave all other fields blank or empty.<br>
		<b>Step 3: </b>Click the button <input type="button" value="SEARCH">  to start the search.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>I want to list all privately insured patients </b></font>
<ul> <b>Step 1: </b>Click the radio button "<input type="radio" name="r" value="1">Private". <br>
		<b>Step 2: </b>Leave all other fields blank or empty.<br>
		<b>Step 3: </b>Click the button <input type="button" value="SEARCH">  to start the search.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>I want to list all generally insured patients </b></font>
<ul> <b>Step 1: </b>Click the radio button "<input type="radio" name="r" value="1">Insurance". <br>
		<b>Step 2: </b>Leave all other fields blank or empty.<br>
		<b>Step 3: </b>Click the button <input type="button" value="SEARCH">  to start the search.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>I want to list all patients insured by a given insurance organization</b></font>
<ul> <b>Step 1: </b>Enter the insurance organizations' acronym in the field "Insurance". <br>
		<b>Step 2: </b>Leave all other fields blank or empty.<br>
		<b>Step 3: </b>Click the button <input type="button" value="SEARCH">  to start the search.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>I want to list all patients with a certain keyword</b></font>
<ul> <b>Step 1: </b>Enter the keyword in the corresponding field. It can be a full word or phrase or a few letters of a word. <br>
		<ul><font size=1 color="#000099" >
		<b>Example:</b> For diagnostic keyword enter it in the "Diagnosis" field.<br>
		<b>Example:</b> For recommender keyword enter it in the "Recommended by" field.<br>
		<b>Example:</b> For therapeutic keyword enter it in the "Suggested therapy" field.<br>
		<b>Example:</b> For special notes keyword enter it in the "Special notes" field.<br>
		</font>
		</ul><b>Step 2: </b>Leave all other fields blank or empty.<br>
		<b>Step 3: </b>Click the button <input type="button" value="SEARCH">  to start the search.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>I am searching for a certain patient with a certain keyword</b></font>
<ul> <b>Step 1: </b>Enter the keyword in the corresponding field. It can be a full word or phrase or a few letters of a word. <br>
		<ul><font size=1 color="#000099" >
		<b>Following fields can be filled with a keyword:</b>
		<br> Patient's number
		<br> Family name
		<br> Given name
		<br> Birthdate
		<br> Address
		</font>
		</ul><b>Step 2: </b>Leave all other fields blank or empty.<br>
		<b>Step 3: </b>Click the button <input type="button" value="SEARCH">  to start the search.<br>
</ul>
<b>Note</b>
<ul> You can combine several search conditions. For example: If you want to list all MALE patients who were
		admitted between 10.12.1999 and 24.01.2001 inclusive:<p>
		<b>Step 1: </b>Enter "10.12.1999" in the field "Admission date: from:". <br>
		<b>Step 2: </b>Enter "24.01.2001 in the field "to:".<br>
		<b>Step 3: </b>Click the radio button "Sex <input type="radio" name="r" value="1">male". <br>
		<b>Step 4: </b>Click the button <input type="button" value="SEARCH">  to start the search.<br>
</ul>
<b>Note</b>
<ul> If the search finds a single result, the complete information will be displayed immediately.<br>
		However, if the search finds several results, a list will be displayed.<br>
		To see the information for the patient you are looking for, click either the button <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> corresponding to it, or
		the name, or the Family name or the admission date.
</ul>

<?php endif;?>
<b>Note</b>
<ul> If you decide to cancel research  click the button <input type="button" value="Cancel">.
</ul>
</form>

