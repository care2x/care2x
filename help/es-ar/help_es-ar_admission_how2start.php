<?php
$foreword='
<form action="#">

<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Cómo empezar ';

switch($x1)
{
 	case "entry": print $foreword.'la admisión de un paciente nuevo'; break;
	case "search": print $foreword.'la búsqueda de los datos de admisión de un paciente';break;
	case "archiv": print $foreword.'su investigación en los archivos';break;
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
<b><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Paso 1</font></b> 
<ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Dé clic en el botón 
  <img src="../gui/img/control/default/es/es<?php switch($x1)
																			{
																				case "entry": print '_ein-gray.gif'; break;
																				case "search": print '_such-gray.gif'; break;
																				case "archiv": print '_arch-gray.gif'; break;
																			}
?>" border="0">. </font> 
</ul>
<font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 2</b> 
<?php endif;?>
</font> 
<ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Si usted ya ingresó 
  su nombre y contraseña y tiene permiso para ver esta función, aparecerá el 
  <?php switch($x1)
	{
		case "entry": print 'formulario de admisión del paciente'; break;
		case "search": print 'campo de búsqueda'; break;
		case "archiv": print 'campo para buscar en el archivo'; break;
	}
?>
  en la ventana principal.<br>
  De otro modo, se le pedirá que escriba su nombre y contraseña. </font><font face="Verdana, Arial, Helvetica, sans-serif">
  <p><font size="2"> Ingréselos y dé clic en el botón <img <?php echo createLDImgSrc('../','continue.gif','0') ?>>.</font>
  <p><font size="2"> Si desea salir de esta ventana, dé clic en el botón <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>. 
    </font>
</font></ul>


</form>
<?php endif;?>
