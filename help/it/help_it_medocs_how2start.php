<?php
$foreword='
<form action="#">

<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Come...';

switch($x1)
{
 	case "entry": print $foreword.'...creare un nuovo medoc'; break;
	case "search": print $foreword.'...cercare un medoc';break;
	case "archiv": print $foreword.'...fare una ricerca in archivio';break;
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
<b>1</b>
<ul> Selezionare il bottone <img src="../img/it/it<?php switch($x1)
																			{
																				case "entry": print '_newdata-gray.gif'; break;
																				case "search": print '_such-gray.gif'; break;
																				case "archiv": print '_arch-gray.gif'; break;
																			}
?>" border="0">.
		
</ul>
<b>2</b>
<?php endif;?>
<ul> Se si è fatto login precedentemente e si hanno i diritti di accesso sufficienti, nella
finestra principale apparirà
<?php switch($x1)
	{
		case "entry": print ' il modulo iniziale del documento'; break;
		case "search": print ' il campo di ricerca'; break;
		case "archiv": print 'i campi per la ricerca in archivio'; break;
	}
?>.<br>
		Se invece non si è ancora effettuato il login, verrà richiesto di inserire username e password. <p>
		Inserire username e password, poi selezionare il bottone <img <?php echo createLDImgSrc('../','continue.gif','0') ?>>.<p>
		Per annullare selezionare il bottone <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> border=0>.
</ul>
</form>
<?php endif;?>
