<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>How to document a patient in medocs</b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<?php if($src=="?") : ?>
<b>Step 1</b>

<ul> Find the patient's basic data.<br>
		Enter in the "Document the following patient:" field any of the following information:<br>
		<Ul type="disc">
			<li>patient's number or<br>
			<li>patient's Family name or<br>
			<li>patient's Given name <br>
		<font size=1 color="#000099" face="verdana,arial">
		<b>Tip:</b> If your system is equipped with a barcode scanner, click on the "Document the following patient:" field to focus it
		and scan the barcode on the patient's card with the scanner. Skip step 2.
		</font>
		</ul>
		
</ul>
<b>Step 2</b>

<ul> Click the button <input type="button" value="Search"> to start searching.
		
</ul>
<b>Alternative to step 2</b>
<ul> You can do any of the following:<br>
		<Ul type="disc">		
		<li>enter the patient's Family name  in the "Lastname:" field <br>
		<li>OR enter the patient's Given name  in the "Firstname:" field <br>
		</ul>
		 then click the "Enter" key on the keyboard.
		
</ul>
<b>Step 3</b>
<ul> If the search finds a single result, a new document form with the patient's basic data will be displayed.
		If however, the search finds several results, a list will be displayed.
<?php endif;?>

<?php if(($src=="?")||($x1>1)) : ?>

 <br>To document a patient on the list,
		click either the button <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> corresponding to it, or
		the Family name, or the Given name, or the patient's number, or the admission date.
</ul>
<?php endif;?>

<?php if($src=="?") : ?>
<b>Step 4</b>
<?php endif;?>

<?php if(($src!="?")&&($x1==1)) : ?>
<b>Step 1</b>
<?php endif;?>
<?php if(($x1=="1")||($src=="?")) : ?>
<ul> Once a new document form with patient's data is displayed, you can do the following: 
		<Ul type="disc">		
    	<li>enter additional information on the insurer or insurance in the "Extra information:" field,<br>
		<li>click "<span style="background-color:yellow" ><input type="radio" name="n" value="a">Yes</span>" on the  "Medical advice" buttons if the patient has received the obligatory medical advice,<br>
		<li>click "<span style="background-color:yellow" ><input type="radio" name="n" value="a">No</span>" on the  "Medical advice" buttons if the patient has not received the obligatory medical advice,<br>
		<li>enter diagnostic report in the "Diagnosis:" field,<br>
		<li>enter therapy report "Therapy:" field,<br>
		<li>if necessary, change the date in the "Documented on:" field,<br>
		<li>if necessary, change the name in the "Documented by:" field,<br>
		<li>if necessary, enter a key number in the "Key number:" field,<br>
		</ul>
</ul>
<b>Note</b>
<ul> If you decide to erase your entries click the button <input type="button" value="Reset">.
</ul>

<b>Step <?php if($src!="?") print "2"; else print "5"; ?></b>
<ul> Click the button <input type="button" value="Save"> to save the document.
</ul>
<?php endif;?>
<b>Note</b>
<ul> If you decide to cancel the document click the button <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
		
</ul>


</form>

