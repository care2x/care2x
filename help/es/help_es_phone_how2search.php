<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<font face="Verdana, Arial" size=3 color="#0000cc"> <b>�Cómo buscar? 
<?php
switch($src)
{
 	case "search": print 'busco un número telefónico?'; break;
	case "dir": print 'abro todo el directorio?';break;
	case "newphone": print 'escribo nueva información telefónica?';break;
 }
 ?>
</b></font> 
<p><font size=2 face="verdana,arial" > 
<form action="#" >
  <?php if($src=="search") : ?>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1</b> </font><font face="Verdana, Arial, Helvetica, sans-serif">
  <ul>
    <font size="2"> Escriba en el campo "<span style="background-color:yellow" >Escriba 
    la palabra clave.</span>" ya sea información completa o unas pocas letras, 
    como por ejemplo un código de pabellón o departamento, nombre, o numero de 
    cuarto. <br>
    <font color="#000066">Ejemplo 1: escriba "m9a" o "M9A" o "M9". <br>
    Ejemplo 2: escriba "Guerrero" o "gue". <br>
    Ejemplo 3: escriba "Alfredo" o "Alf". <br>
    Ejemplo 4: escriba "op11" o "OP11" o "op". </font></font> 
  </ul>
  <font size="2"><b>Paso 2</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Dé clic en el 
    botón 
    <input type="button" value="BUSCAR">
    para empezar la búsqueda.</font> 
    <p> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 3</b> </font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Si la búsqueda 
    halla resultado(s), una lista se desplegará.</font> 
    <p> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  <?php if($src=="dir") : ?>
  <b>Paso 1</b> </font><font face="Verdana, Arial, Helvetica, sans-serif">
  <ul>
    <font size="2"> Dé clic en el botón <img src="../img/en/en_phonedir-gray.gif" border="0">. 
    </font>
  </ul>
  <font size="2">
  <?php endif;?>
  <?php if($src=="newphone") : ?>
  <b>Paso 1</b> 
  <ul>
    Dé clic en el botón <img src="../img/en/en_newdata-gray.gif" border="0">. 
  </ul>
  <b>Paso 2</b> 
  <ul>
    Si usted ingresó su nombre y contraseña y tiene permiso para esta función, 
    aparecerá el formulario de ingreso de la nueva información telefónica en la 
    ventana principal.<br>
    De otro modo, si usted no ha ingresado, se le pedirá que escriba su nombre 
    y contraseña. 
    <p> Escriba su nombre y contraseña y dé clic en el botón <img <?php echo createLDImgSrc('../','continue.gif','0') ?>>.
    <p> Si usted decide cerrar esta ventana, dé clic en el botón <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>. 
  </ul>
  </font></font><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  <b>Nota</b> </font><font face="Verdana, Arial, Helvetica, sans-serif">
  <ul>
    <font size="2"> Si usted decide cerrar la ventana de búsqueda, dé clic en 
    el botón <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>. </font> 
  </ul>


</font></form>

