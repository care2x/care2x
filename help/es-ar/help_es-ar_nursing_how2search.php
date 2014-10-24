<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
<?php
switch($x2)
{
	case "search": print "¿Cómo "; 
 						if($x1) print 'muestro la ocupación del pabellón en donde se halló la palabra clave?';
						else  print 'busco un paciente?';
						break;
	case "quick": print  "Enfermería - Vista rápida de la ocupación del pabellón para el día de hoy";
						break;
	case "arch": print "Estaciones de enfermería - Archivo";
}
 ?></b></font>
<p><font size=2 face="verdana,arial" >
<form action="#" >
  <?php if($x2=="search") : ?>
  <?php if(!$x1) : ?>
  <b><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Paso 1</font></b> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Escriba en el campo "<span style="background-color:yellow" >Por 
    favor, escriba una palabra clave.</span>" ya sea la información completa o 
    las primeras letras, como por ejemplo un nombre, un apellido o ambos. </font>
    <ul type=disc>
      <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Ejemplo 
        1: escriba "Guerrero" o "gue". </font>
      <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Ejemplo 2: escriba 
        "Alfredo" o "Alf". </font>
      <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Ejemplo 
        3: escriba "Guerrero, Alf". </font>
    </ul>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 2</b> </font>
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Dé clic en el botón 
    <input type="button" value="Buscar">
    para empezar la búsqueda.</font>
    <p> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 3</b> </font>
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Si la búsqueda halla un 
    resultado, se mostrará la lista con la ocupación de pabellones.</font>
    <p> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 4</b> </font>
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Si la búsqueda halla varios 
    resultados, aparecerá una lista con todos los resultados.</font>
    <p> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota</b> 
  </font><font face="Verdana, Arial, Helvetica, sans-serif"><ul><font size="2">
    Si usted decide cerrar la ventana de búsqueda, dé clic en el botón <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>. 
  </font></ul>
  <font size="2"><?php endif;?>
  <b>Paso 
  <?php if($x1) print "1"; else print "5"; ?>
  </b>
  <ul>
    Dé clic en el botón <img <?php echo createComIcon('../','bul_arrowblusm.gif','0') ?>>, 
    o la fecha, o el pabellón para mostrar la lista de ocupación del pabellón. 
    <p><b>Nota:</b> La palabra clave de búsqueda aparecerá resaltada entre el 
      texto. <br>
      <b>Nota:</b> La lista no puede ser editada en "modalidad solamente de lectura". 
      Si usted intenta abrir la carpeta que tiene los datos del paciente, mediante 
      un clic en el nombre, se le solicitará que escriba su nombre y contraseña. 
  </ul>
  <?php endif;?>
  <?php if($x2=="quick") : ?>
  <?php if($x1) : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  ¿Qué se hace para ver la lista de ocupación del pabellón?</b> </font></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé clic 
    en la identificación del pabellón o el nombre en la columna izquierda.<br>
    <b>Nota: </b>La lista de ocupación que se mostrará se muestra de "modalidad 
    solamente lectura". No puede editar o cambiar ningún dato del paciente.<br>
    </font>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> ¿Qué se hace para ver la lista de ocupación del pabellón 
  para hacer cambios o actualizar los datos?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé clic 
    en el ícono <img <?php echo createComIcon('../','statbel2.gif','0') ?>> correspondiente 
    al pabellón seleccionado.<br>
    <b>Paso 2: </b>Si usted ingresó su nombre y contraseña y tiene derechos de 
    acceso para la función, la lista de ocupación se mostrará inmediatamente.<br>
    De otro modo, se le pedirá que ingrese el nombre y contraseña.<br>
    <b>Paso 3: </b>De ser necesario, escriba su nombre y contraseña.<br>
    <b>Paso 4: </b>Dé clic en el botón 
    <input type="button" value="Continúe...">
    .<br>
    <b>Paso 5: </b>Si usted tiene un derecho de acceso para la función, aparecerá 
    la lista de ocupación.<br>
    <b>Nota: </b>La lista de ocupación que será mostrada puede ser "editada". 
    Aparecerán las opciones para cambiar o actualizar los datos del paciente. 
    Usted también puede abrir la carpeta de datos del paciente para hacer cambios 
    adicionales.<br>
    </font>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
  <?php else : ?>
  <img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> 
  ¡No existe un listado de ocupación disponible al momento!</b> </font></font>
  <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
    <font color="#990000"><b> ¿Cómo solicito vistas rápidas de ocupación previa 
    usando el archivo?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé clic 
    en "<span style="background-color:yellow" > Dé clic aquí para ir al archivo 
    <img <?php echo createComIcon('../','bul_arrowgrnlrg.gif','0') ?>> </span>".<br>
    <b>Paso 2: </b>Aparecerá un calendario.<br>
    <b>Paso 3: </b>Dé clic en una fecha en el calendario para mostrar una vista 
    rápida de ocupación para ese día.<br>
    </font>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
  <?php endif;?>
  <b>Nota</b> 
  </font><font face="Verdana, Arial, Helvetica, sans-serif"><ul><font size="2">
    Si usted decide cerrar la ventana de vista rápida, dé clic al botón <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>. 
  </font></ul>
  <font size="2"><?php endif;?>
  <?php if($x2=="arch") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  ¿Cómo solicito vistas rápidas de ocupación previa usando el archivo?</b> </font></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé clic 
    en una fecha en el calendario para mostrar la vista rápida de ocupación para 
    ese día.<br>
    </font>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> ¿Cómo cambio el mes en el calendario?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Para mostrar 
    el mes siguiente, dé clic en el nombre del mes en la esquina superior DERECHA 
    del calendario. Dé clic tantas veces sea necesario hasta que se presente el 
    mes buscado.</font>
    <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 2: </b>Para 
      mostrar el mes anterior, dé clic en el nombre del mes en la esquina superior 
      IZQUIERDA del calendario. Dé clic tantas veces sea necesario hasta que se 
      presente el mes buscado.<br>
      </font>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
  <?php endif;?>
  </font> 
</form>

