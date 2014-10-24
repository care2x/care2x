<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b><?php echo "Laboratory - $x3" ?></b></font>
<form action="#" >
<p><font size=2 face="verdana,arial" >

<?php if($src=="") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to display the graphical chart for test parameters?</b>
</font>
<ul>      
 	<b>Step 1: </b>Click on the checkbox <input type="checkbox" name="s" value="s" checked> corresponding to the chosen parameter to select it.<br>
		<b>Step 2: </b>If you want to display several parameters at once, click on their corresponding checkboxes.<br>
		<b>Step 3: </b>Click on the <img <?php echo createComIcon('../','chart.gif','0') ?>>  icon to display the graphical chart.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
I want to select all parameters. Is there a fast way to select them all at once?</b>
</font>
<ul>      
		<b>Yes there is!</b><br>
		<b>Step 1: </b>Click on the button <img <?php echo createComIcon('../','dwnarrowgrnlrg.gif','0') ?> border=0> to select all parameters.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to deselect all parameters?</b>
</font>
<ul>      
		<b>Step 1: </b>Click on the button <img <?php echo createComIcon('../','dwnarrowgrnlrg.gif','0') ?> border=0> once again to DESELECT all parameters.<br>
</ul>
<?php endif; ?>
<?php if($src=="graph") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>How to go back to the test results w/o graphic charts? </b></font>
<ul> <b>Note: </b>If you want to go back, click the button <img <?php echo createLDImgSrc('../','back2.gif','0','absmiddle') ?>>.</ul>
<?php endif; ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>How to close the laboratory <?php echo $x3 ?>? </b></font>
<ul> <b>Note: </b>If you want to close, click the button <img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle">.</ul>


</form>

