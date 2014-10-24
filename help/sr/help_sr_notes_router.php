<font face="Verdana, Arial" size=3 color="#0000cc">
<b><?php echo $x1 ?></b></font>

<p><font size=2 face="verdana,arial" >

<?php

if($x2=='show'||$src=='sickness'){
	if($x3){
	
?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>How to display the registration data?</b></font>
<ul> 
<b>Step: </b> Click the  <img <?php echo createLDImgSrc('../','reg_data.gif','0') ?>> button.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>How to display the admission data?</b></font>
<ul> 
<b>Step: </b> Click the  <img <?php echo createLDImgSrc('../','admission_data.gif','0') ?>> button.<p>
<b>Note: </b> This button appears only when the person is currently admitted either as inpatient or outpatient.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>How to display the report?</b></font>
<ul> 
<b>Step: </b> Click the  <img <?php echo createComIcon('../','info3.gif','0') ?>> button.<p>
<b>Note: </b> This button appears only when the report data is not fully shown on the preview list.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>How to generate a PDF document of the report?</b></font>
<ul> 
<b>Step: </b> Click the  <img <?php echo createComIcon('../','pdf_icon.gif','0') ?>> button.<p>
</ul>

<?php
	}else{

		if($src=='sickness'){	
?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>How to change the department?</b></font>
<ul> 
<b>Step 1: </b> Select the department from selector box labeled " <img <?php echo createComIcon('../','bul_arrowgrnlrg.gif','0') ?>> Create a form for".<p>
<b>Step 2: </b> Click "Go".<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>How to save the confirmation?</b></font>
<ul> 
<b>Step: </b> Click the <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> button.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>How to print the confirmation?</b></font>
<ul> 
<b>Step: </b> Click the <img <?php echo createLDImgSrc('../','printout.gif','0') ?>> button.<p>
</ul>

<?php
		}elseif($src=='diagnostics'){
?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>There are no data available yet. How to enter new data?</b></font>
<ul> 
<b>Note: </b> New diagnostics results or reports can only be entered via the appropriate laboratory or diagnostic modules. Admission module has "read-only" mode.<p>
</ul>
<?php
		}elseif($src=='notes'){
?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>There are no data available yet. How to enter new data?</b></font>
<ul> 
<b>Step: </b> Click " <img <?php echo createComIcon('../','bul_arrowgrnlrg.gif','0') ?>> <font color=#0000ff><b>Enter new record</b></font>" link.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>How to display the options menu back?</b></font>
<ul> 
<b>Step: </b> Click " <img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>> <font color=#0000ff><b>Back to options</b></font>" link.<p>
</ul>

<?php
		}else{
?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>There are no data available yet. How to enter new data?</b></font>
<ul> 
<b>Step: </b> Click " <img <?php echo createComIcon('../','bul_arrowgrnlrg.gif','0') ?>> <font color=#0000ff>Enter new record</font>" link.<p>
</ul>

<?php 
		}
	}
}else{
?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>How to create the record?</b></font>

<ul> 
<b>Step: </b> Enter the  information, then click <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>>  button.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>How to enter the date?</b></font>
<ul> 
<b>Step 1: </b> Click the <img <?php echo createComIcon('../','show-calendar.gif','0') ?>>  icon and a mini-calendar will pop-up.<p>
<img src="../help/en/img/en_date_select.png"><p>
<b>Step 2: </b> Click the date on the mini-calendar.<p>
<img src="../help/en/img/en_mini_calendar.png"><p>
<b>OR: </b> To enter the "today" date, type "t" or "T" in the date entry field. The today date will be inserted automatically in the local format.<p>
<b>OR: </b> To enter the "yesterday" date, type "y" or "Y" in the date entry field. The yesterday date will be inserted automatically in the local format.<p>

</ul>
<?php 
}
?>
