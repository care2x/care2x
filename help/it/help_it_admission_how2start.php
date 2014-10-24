<?php
$foreword='
<form action="#">

<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Come iniziare ';

switch($x1)
{
 	case "entry": print $foreword.'l\'accettazione di un nuovo paziente'; break;
	case "search": print $foreword.'la ricerca dei dati di accettazione di un paziente';break;
	case "archiv": print $foreword.'una ricerca negli archivi';break;
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
<ul> Click the button <img src="../img/it/it<?php switch($x1)
																			{
																				case "entry": print '_ein-gray.gif'; break;
																				case "search": print '_such-gray.gif'; break;
																				case "archiv": print '_arch-gray.gif'; break;
																			}
?>" border="0">.
		
</ul>
<b>Step 2</b>
<?php endif;?>
<ul> Se si è fatto il login ed i diritti di accesso sono sufficienti, le funzioni 
<?php switch($x1)
	{
		case "entry": print 'Modulo di accettazione '; break;
		case "search": print 'Ricerca '; break;
		case "archiv": print 'Ricerca in archivio '; break;
	}
?>  appariranno nella finestra principale.<br>
		Altrimenti, se non si è fatto il login, il sistema chiederà username e password. <p>
		Inserire i dati richiesti e selezionare il bottone <img <?php echo createLDImgSrc('../','continue.gif','0') ?>>.<p>
		Per annullare, selezionare il bottone <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> border=0>.
</ul>
</form>
<?php endif;?>
