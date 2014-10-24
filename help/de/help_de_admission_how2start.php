<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);

$foreword='
<form action="#">

<font face="Verdana, Arial" size=3 color="#0000cc">
<b> ';

switch($x1)
{
 	case "entry": echo $foreword.'Aufnehmen von neuen Patienten'; break;
	case "search": echo $foreword.'Suchen von Patientendaten';break;
	case "archiv": echo $foreword.'Recherchieren im Archiv';break;
 }
?>

<?php if(!$x1) : ?>
		<?php require("help_de_main.php"); ?>
<?php else : ?>
</b></font>
<p>
<font face="Verdana, Arial" size=2>

<?php if($src!=$x1) : ?>
<b>Schritt 1</b>
<ul> Den  <img <?php switch($x1)
																			{
																				case "entry": echo  createLDImgSrc('../','ein-gray.gif'); break;
																				case "search": echo createLDImgSrc('../','such-gray.gif'); break;
																				case "archiv": echo createLDImgSrc('../','arch-gray.gif'); break;
																			}
?>> anklicken.
		
</ul>
<b>Schritt 2</b>
<?php endif; ?>
<ul> Wenn sie sich vorher angemeldet haben und ein Zugangsrecht in dieser Funktion haben, wird 
<?php switch($x1)
	{
		case "entry": echo 'das Formular zur Aufnahme von Patienten'; break;
		case "search": echo 'die Suchfelder '; break;
		case "archiv": echo 'die Suchfelder vom Archiv'; break;
	}
?>  eingeblendet.<br>
		Ansonsten werden Sie nach Ihrem Benutzernamen und Passwort gefragt.<p>
		Geben Sie Ihren Benutzernamen und Passwort ein und klicken Sie den <img <?php echo createLDImgSrc('../','continue.gif','0') ?>> an.<br>
		Falls Sie abbrechen möchten, klicken Sie den <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> an.
		
</ul>


</form>
<?php endif;?>
