<font face="Verdana, Arial" size=3 color="#0000cc">
<b>How to 
<?php
switch($x1)
{
 	case "search": print 'search for a phone number'; break;
	case "dir": print 'open the entire phone directory';break;
	case "newphone": print 'enter new phone information';break;
 }
 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<?php if($x1=="search") { ?>
	<?php if($src=="newphone") { ?>
	<b>Step 1</b>
	<ul> Click the button <img <?php echo createLDImgSrc('../','such-gray.gif','0') ?>>.
	</ul>
	<?php } ?>
<b>Step <?php if($src=="newphone") print "2"; else print "1"; ?></b>

<ul> Enter  in the "<span style="background-color:yellow" >Enter search keyword.</span>" field either a full information or a few letters, like for example the ward's or department's code, a name, or Given name,
		or a room number.
		<br>Example 1: enter "m9a" or "M9A" or "M9".
		<br>Example 2: enter "Guerero" or "gue".
		<br>Example 3: enter "Alfredo" or "Alf".
		<br>Example 4: enter "op11" or "OP11" or "op".
		
</ul>
<b>Step <?php if($src=="newphone") print "3"; else print "2"; ?></b>
<ul> Click the button <input type="button" value="SEARCH"> to start the search.<p>
</ul>
<b>Step <?php if($src=="newphone") print "4"; else print "3"; ?></b>
<ul> If the search finds result(s), a list will be displayed.<p>
</ul>
<?php } ?>

<?php if($x1=="dir") { ?>
<b>Step 1</b>
<ul> Click the button <img <?php echo createLDImgSrc('../','phonedir-gray.gif','0') ?>>.
</ul>
<?php 
} 

 if($x1=="newphone") { 
	 if($src=="search") { 
?>
<b>Step 1</b>
<ul> Click the button <img <?php echo createLDImgSrc('../','newdata-gray.gif','0') ?>>.
</ul>
<b>Step 2</b>
<ul> If you have logged in before and you have an access right for this function, the 
		entry form for new phone information  will appear on the main frame.<br>
		Otherwise, if you are not logged in, you will be required to enter your username and password. <p>
	<?php } ?>
		Enter your username and password and click the button <img <?php echo createLDImgSrc('../','continue.gif','0') ?>>.<p>
		
</ul>
<?php } ?>

<b>Note</b>
<ul> If you decide to cancel 
<?php
switch($x1)
{
 	case "search": print 'search click the button <img '.createLDImgSrc('../','cancel.gif','0').'>.'; break;
	case "dir": print ' the directory click the button <input type="button" value="Cancel">.';break;
	case "newphone": print ' click the button <img '.createLDImgSrc('../','cancel.gif','0').'>.';break;
 }
 ?>
</ul>

</form>

