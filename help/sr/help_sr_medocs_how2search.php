<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>How to search a medocs document</b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<?php if(($src=="?")||($x1=="0")) : ?>
<b>Step 1</b>

<ul> Enter  in the "<span style="background-color:yellow" >Medocs document of:</span>" field either a full information or a few letters from a patient's information, like for example patient's number, or name, or Given name.
		<p>Example 1: enter "21000012" or "12".
		<br>Example 2: enter "Guerero" or "gue".
		<br>Example 3: enter "Alfredo" or "Alf".
		
</ul>
<b>Step 2</b>
<ul> Click the button <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  to start the search.<p>
</ul>
<b>Step 3</b>
<ul> If the search finds a single result the complete medocs document will be displayed.
		If however, the search finds several results, a list will be displayed.<p>
		To see the medocs document of the patient you are looking for, click the button <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> corresponding to it, or
		the Family name, or the document number, or time.
</ul>
<?php endif;?>
<?php if($x1>1) : ?>
		To see the medocs document of the patient you are looking for, click the button <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> corresponding to it, or
		the Family name, or the document number, or time.<p>
<?php endif;?>
<?php if(($src!="?")&&($x1=="1")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>I want to update the document</b></font>
<ul> If you want to update the displayed document, click the button <input type="button" value="Update data">.
</ul>
<?php endif;?>
<b>Note</b>
<ul> If you decide to cancel search click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.
</ul>


</form>

