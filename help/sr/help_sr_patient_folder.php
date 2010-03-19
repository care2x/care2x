<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b><?php echo "Patient's Data - $x3" ?></b></font>
<form action="#" >
<p><font size=2 face="verdana,arial" >

<?php if($src=="") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>What do these  color bars mean? </b> <img <?php echo createComIcon('../','colorcodebar3.gif','0') ?> ></font>
<ul> <b>Note: </b>Each of these color bars when "set visible" signalize the availability of a particular information, an instruction, a change, or a query, etc.<br>
			The meaning of a color can be set for every ward. <br>
			The series of pink color bars on the right represents the approximate time when an instruction is to be carried out.<br>
			For example: the sixth pink color bar means "6th Hour" or "6 o'clock AM", the 22nd color bar means "22nd Hour" or "10 o'clock PM".
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
What are these following buttons?</b></font>
<ul> <input type="button" value="Fever chart">
	<ul>
		This will open the patient's daily fever chart. You can enter, edit, or delete fever and BP data in the chart.<br>
		Additional editable data fields are:
	<ul type="disc">
	<li>Allergy<br>
	<li>Daily diet plan<br>
	<li>Main diagnosis/therapy<br>
	<li>daily diagnosis/therapy<br>
	<li>Notes, extra diagnoses<br>
	<li>Pt (Physical therapy), Atg (anti-thrombosis gymnastics), etc.<br>
	<li>Anticoagulants<br>
	<li>Daily documentation for anticoagulants<br>
	<li>Intravenous medication & Bandage dressing<br>
	<li>Daily documentation for intravenous medication<br>
	<li>Notes<br>
	<li>Medication (list)<br>
	<li>Daily documentation for medication and dosage<br>
	</ul>		
	</ul>
<input type="button" value="Nursing report">
	<ul>
		This will open the nursing report form. You can document your nursing activity, its effectivity, observations, queries, or recommendations, etc.
	</ul>
	<input type="button" value="Physician orders">
	<ul>
	The doctor in charge will enter here his instructions, medication, dosage, answers to nurses' queries, or instructions for changes, etc.
	</ul>	
	<input type="button" value="Diagnostic reports">
	<ul>
	This stores the diagnostic reports coming from different diagnostic clinics or departments.
	</ul>	
<!-- 	<input type="button" value="Root data">
	<ul>
	This stores the patients root data and personal information like name, given name, etc. This is also the initial documentation of the
	patient's anamnesis or medical history that serves as foundation for the individual nursing plan.
	</ul>	
	<input type="button" value="Nursing Plan">
	<ul>
	This is the individual nursing plan. You can create, edit, or delete the plan.
	</ul>	
 -->	
 <input type="button" value="DRG">
	<ul>
	This opens the DRG composite window.
	</ul>	
 <input type="button" value="Lab Reports">
	<ul>
	This stores both the medical and pathological laboratory reports.
	</ul>	
	<input type="button" value="Photos">
	<ul>
	This will open the photo catalog of the patient.
	</ul>	
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
What is the function of this selection box </b>	<select name="d"><option value="">Select diagnostic test request</option></select>?
</font>
<ul>       	<b>Note: </b>This will select the request form for a particular diagnostic test.<br>
 	<b>Step 1: </b>Click on the <select name="d"><option value="">Select diagnostic test request</option></select>
                                                                     <br>
		<b>Step 2: </b>Click on the chosen clinic, department, or diagnostic test.<br>
		<b>Step 3: </b>The request form will be automatically opened.<br>
</ul>
<?php endif;?>

<?php if($src=="labor") : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b>There is no laboratory report available at the moment. </b></font>
<ul> Click the button <input type="button" value="OK"> to go back to the patient's data folder.</ul>
<?php else  : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>How to close the patient's data folder? </b></font>
<ul> <b>Note: </b>If you want to close, click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle">.</ul>

<?php endif;?>

</form>

