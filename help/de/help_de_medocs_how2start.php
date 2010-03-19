<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<form action="#">

<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
<?php
switch($x1)
{
 	case "entry": print 'Ein neues Medocs Dokument erstellen'; break;
	case "search": print 'Suchen nach einem Medocs Dokument';break;
	case "archiv": print 'Recherche im Medocs Archiv';break;
 }
?>

<?php if(!$x1) : ?>
		<?php require("help_de_main.php"); ?>
<?php else : ?>
</b></font>
 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<p>
<font face="Verdana, Arial" size=2>

<?php if($src!=$x1) : ?>
<b>Schritt 1</b>
<ul> Den <img 
<?php 
switch($x1)
   {
     case "entry": echo  createLDImgSrc('../','newdata-gray.gif'); break;
	 case "search": echo createLDImgSrc('../','such-gray.gif'); break;
	 case "archiv": echo createLDImgSrc('../','arch-gray.gif'); break;
  }
?>> anklicken.
		
</ul>
<b>Schritt 2</b>
<?php endif; ?>
<ul> Wenn Sie sich vorher angemeldet haben und ein Zugangsrecht in dieser Funktion haben wird
<?php switch($x1)
	{
		case "entry": print 'das Formular zur Eingabe'; break;
		case "search": print 'die Eingabefelder zum Suchen '; break;
		case "archiv": print 'die Engabefelder zum Archiv'; break;
	}
?>  eingeblendet.<p>
		Ansonsten werden Sie nach Ihrem Benutzernamen und Passwort gefragt.<p>
		Geben Sie Ihren Benutzernamen und Passwort ein und klicken Sie den <img <?php echo createLDImgSrc('../','continue.gif','0') ?>> an.<br>
		Falls Sie abbrechen möchten, klicken Sie den <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> an.
		
</ul>


</form>
<?php endif;?>
