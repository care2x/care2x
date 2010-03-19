<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);

$foreword='
<form action="#">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>¿Cómo empiezo ';

switch($x1)
{
 	case "entry": print $foreword.'un nuevo documento medocs'; break;
	case "search": print $foreword.'una búsqueda en un documento medocs';break;
	case "archiv": print $foreword.'una investigación en los archivos medocs';break;
 }
?>

<?php if(!$x1) : ?>
		<?php require("help_en_main.php"); ?>
<?php else : ?>
</b></font>
 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><font face="Verdana, Arial" size=2> 
<?php if($src!=$x1) : ?>
<b>Paso 1</b> </font><font face="Verdana, Arial, Helvetica, sans-serif">
<ul>
  <font size="2"> Dé clic en el botón <img src="../img/en/en<?php switch($x1)
																			{
																				case "entry": print '_newdata-gray.gif'; break;
																				case "search": print '_such-gray.gif'; break;
																				case "archiv": print '_arch-gray.gif'; break;
																			}
?>" border="0">. </font>
</ul>
<font size="2"><b>Paso 2</b> 
<?php endif;?>
<ul>
  Si usted ha ingresado su nombre y contraseña previamente y tiene permiso para 
  ver esta función, aparecerá el 
  <?php switch($x1)
	{
		case "entry": print 'formulario inicial del documento '; break;
		case "search": print 'campo de búsqueda '; break;
		case "archiv": print 'campo de búsqueda en el archivo '; break;
	}
?>
  en la ventana principal.<br>
  De otro modo, se le pedirá que escriba su nombre y contraseña. 
  <p> Escriba su nombre y contraseña y dé clic en el botón <img <?php echo createLDImgSrc('../','continue.gif','0') ?>>.
  <p> Si usted decide cancelar, dé clic en el botón <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>. 
</ul></form>
<?php endif;?>
</font></font>