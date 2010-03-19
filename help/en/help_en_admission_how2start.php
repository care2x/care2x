<?php
$foreword='
<form action="#">

<font face="Verdana, Arial" size=3 color="#0000cc">
<b>How to start ';

switch($x1)
{
 	case "entry": print $foreword.'a new patient\'s admission'; break;
	case "search": print $foreword.'search for a patient\'s admission data';break;
	case "archiv": print $foreword.'researching in the archives';break;
 }
?>

<?php if(!$x1) : ?>
		<?php require("help_en_main.php"); ?>
<?php else : ?>
</b></font>
 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<p>
<font face="Verdana, Arial" size=2>

<?php if($src!=$x1) : ?>
<b>Step 1</b>
<ul> Click the <img src="../gui/img/control/default/en/en<?php switch($x1)
																			{
																				case "entry": print '_admit-gray.gif'; break;
																				case "search": print '_such-gray.gif'; break;
																				case "archiv": print '_arch-gray.gif'; break;
																			}
?>" border="0"> button.
		
</ul>
<b>Step 2</b>
<?php endif; ?>
<ul> If you have logged in before and you have an access right for this function, the 
<?php switch($x1)
	{
		case "entry": print 'patient\'s	admission form'; break;
		case "search": print 'search field '; break;
		case "archiv": print 'archive\'s search field'; break;
	}
?>  will appear on the main frame.<br>
		Otherwise, if you are not logged in, you will be required to enter your username and password. <p>
		Enter your username and password and click the button <img <?php echo createLDImgSrc('../','continue.gif','0') ?>>.<p>
		If you decide to cancel click the button <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
		
</ul>


</form>
<?php endif; ?>
