<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc"> <b> Administración del Pabellón
<?php
switch($src)
{
	case "main": print "";
						break;
	case "new": print  " - Crear un nuevo pabellón";
						break;
	case "arch": print "Estación de enfermería - Archivo";
}
 ?>
</b></font> 
<form action="#" >
  <font face="Verdana, Arial" size=3 color="#0000cc"><b>
  <?php if($src=="main") : ?>
  </b></font><font color="990000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Crear 
  un pabellón o sala </strong> </font><font face="Verdana, Arial, Helvetica, sans-serif"> 
  <ul>
    <font size="2"> Para crear un nuevo pabellón, dé clic en esta opción </font>
  </ul>
  <font size="2"></ul> <strong>Datos del perfil del pabellón </strong> 
  <ul>
    Esta opción mostrará el perfil del pabellón y otros datos relevantes. 
  </ul>
  <b>Bloquear una cama</b> 
  <ul>
    Si usted desea bloquear una cama o varias camas a la vez, dé clic a esta opción. 
    El pabellón solicitado se mostrará o, de no estar disponible, se mostrará 
    el pabellón predeterminado. Para bloquear una cama, necesitará una contraseña 
    válida con permiso para llevar a cabo esta función. 
  </ul>
  <b>Derechos de acceso</b> 
  <ul>
    Esta opción le permite crear, editar, bloquear o borrar los derchos de acceso 
    para un pabellón en particular. Todos los derechos de acceso serán permitidos 
    solamente ese pabellón en particular. 
  </ul>
  <?php endif;?>
  <?php if($x2=="quick") : ?>
  <?php if($x1) : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  Cómo mostrar la lista de ocupación de camas en el pabellón?</b> </font></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé clic 
    en el nombre o identificación del pabellón en la columna izquierda.<br>
    <b>Nota: </b>La lista de ocupación de camas se mostrará como de "solamente 
    lectura". No pude cambiar o editar ningún dato del paciente.<br>
    </font>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> Cómo mostrar la lista de ocupación de camas en el 
  pabellón para editar o actualizar datos?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic en el ícono <img <?php echo createComIcon('../','statbel2.gif','0') ?>> 
    correspondiente al pabellón seleccionado.<br>
    <b>Paso 2: </b>Si usted ya ingresó su nombre y contraseña y tiene derechos 
    de acceso para esa funci&oacute;n, se desplegar&aacute; la lista de ocupaci&oacute;n. 
    De lo contrario, le requerir&aacute; nombre y contrase&ntilde;a.<br>
    <b>Paso 3: </b>Escriba su nombre y contrase&ntilde;a.<br>
    <b>Paso 4: </b>Dé clic en el botón 
    <input type="button" value="Continuar...">
    .<br>
    <b>Paso 5: </b>Si tiene derechos de acceso para esa funci&oacute;n, se desplegar&aacute; 
    la lista de ocupaci&oacute;n<br>
    <b>Nota: </b>La lista de ocupaci&oacute;n ser&aacute; desplegada para ser 
    &quot;editada&quot;. Adem&aacute;s de las opciones para editar o actualizarlos 
    datos del paciente. Tambi&eacute;n se puede abrir la carpeta de datos del 
    paciente para editarla.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php else : ?>
  <img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> 
  No hay lista de ocupaci&oacute;n disponible todav&iacute;a!</b> </font></font> 
  <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
    <font color="#990000"><b> &iquest;Como mostrar vistas r&aacute;pidas de ocupaci&oacute;n 
    usando el archivo?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Haga 
    clic en el enlace "<span style="background-color:yellow" > Clic aqu&iacute; 
    para ir al archivo<img <?php echo createComIcon('../','bul_arrowgrnlrg.gif','0') ?>> 
    </span>".<br>
    <b>Paso 2: </b>Aparecer&aacute; un calendario.<br>
    <b>Paso 3: </b>Haga clic en una fecha para la vista r&aacute;pida de ese d&iacute;a.<br>
    </font> 
  </ul>
  <p><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
    <?php endif;?>
    <b>Nota </b>Si usted decide cerrar la vista r&aacute;pida dé clic al botón</font><font size="2"><img <?php echo createLDImgSrc('../','close2.gif','0') ?>></font></p>
  <p><font size="2">. </font> <font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"> 
    <?php endif;?>
    <?php if($src=="new") : ?>
    <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
    &iquest;Como crear una nueva sala?</b> </font></font></font> </p>
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Escriba 
    la ID o nombre de la sala en el campo "<span style="background-color:yellow" > 
    Sala: </span>".<br>
    <b>Paso 2: </b>Seleccione el departmento o clinica donde se ubica la sala 
    en el campo "<span style="background-color:yellow" >Departmento: </span>".<br>
    <b>Paso 3: </b>Escriba la descripci&oacute;n y otra informaci&oacute;n en 
    el campo "<span style="background-color:yellow" >Descripci&oacute;n: </span>".<br>
    <b>Paso 4: </b>Escriba el primer n&uacute;mero de cuarto en la sala en el 
    campo "<span style="background-color:yellow" > N&uacute;mero del primer cuarto: 
    </span>".<br>
    <b>Paso 5: </b>Escriba el &uacute;ltimo n&uacute;mero de cuarto en la sala 
    en el campo "<span style="background-color:yellow" > &Uacute;ltimo n&uacute;mero 
    de cuarto: </span>".<br>
    <b>Paso 6: </b>Escriba el prefijo del cuarto en el campo "<span style="background-color:yellow" > 
    Prefijo del cuarto: </span>".<br>
    <b>Paso 7: </b>Escriba el nombre de la jefa de enfermeras en el campo "<span style="background-color:yellow" > 
    Jefa de enfermeras:</span>".<br>
    <b>Paso 8: </b>Escriba el nombre de la asistente de la jefa de enfermeras 
    en el campo "<span style="background-color:yellow" > Asistente de la Jefa 
    de enfermeras: </span>".<br>
    <b>Paso 9: </b>Escriba los nombres de las enfermeras del cuarto en el campo 
    "<span style="background-color:yellow" > Enfermeras: </span>".<br>
    <b>Paso 10: </b>Dé clic al bot&oacute;n 
    <input type="button" value="Crear la sala">
    para crear la sala.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota</b> 
  </font><font face="Verdana, Arial, Helvetica, sans-serif"><ul><font size="2">
    Si usted decide cerrar esta ventana dé clic al botón<img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>. 
  </font></ul>
  <font size="2"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  &iquest;Puedo agrupar los n&uacute;meros de cama en un cuarto?</b> </font></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>No. </b>En 
    esta versi&oacute;n del programa, el numero fijo de camas es 2 y no puede 
    cambiarlo.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><font color="#990000"><b>&iquest;Puedo 
  agrupar </b></font></font></font><font color="#990000"><b>el prefijo (o id) 
  para una cama?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>No. </b>En 
    esta versi&oacute;n del programa, el prefijo (del id) <font color="#000000">para 
    una cama</font> esta fijado a &quot;a&quot; o &quot;b&quot; . Y no puedes 
    cambiarlo.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota</b> 
  </font><font face="Verdana, Arial, Helvetica, sans-serif"><ul><font size="2">
    Si usted decide cerrar esta ventana dé clic al botón<img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>. 
  </font></ul>
  <font size="2"> 
  <?php endif;?>
  <?php if($src=="show") : ?>
  <?php if($x1=="1") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  &iquest;Como salvar el perfil del cuarto?</b> </font></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al bot&oacute;n 
    <input type="button" value="Salvar">
    .<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota</b> </font><font face="Verdana, Arial, Helvetica, sans-serif">
  <ul>
    <font size="2"> Si usted decide cerrar esta ventana dé clic al botón<img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>. 
    </font>
  </ul>
  <font size="2"> 
  <?php else : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  &iquest;Como editar el </b></font><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><font color="#990000"><b>perfil 
  del cuarto?</b> </font></font></font> <font color="#990000"> </font></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al bot&oacute;n 
    <input type="button" value="Editar perfil del cuarto">
    .<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota</b> </font><font face="Verdana, Arial, Helvetica, sans-serif">
  <ul>
    <font size="2"> Si usted decide cerrar esta ventana dé clic al botón<img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>. 
    </font>
  </ul>
  <font size="2"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  Deseo editar un perfil de estaci&oacute;n diferente al desplegado </b></font><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><font color="#990000"><b>actualmente</b></font></font></font><font color="#990000"><b>. 
  &iquest; Que debo hacer?</b> </font></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1:</b> 
    Dé clic al enlace "<span style="background-color:yellow" > <img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>> 
    Otras salas</span>" para listar las salas disponibles.<br>
    <b>Paso 2:</b> Una vez que se muestren las salas, d&eacute; clic en la sala 
    que quiere editar. </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota</b> 
  </font><font face="Verdana, Arial, Helvetica, sans-serif"><ul><font size="2">
    Si usted decide cerrar esta ventana dé clic al botón<img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>. 
  </font></ul>
  <font size="2"> 
  <?php endif;?>
  <?php endif;?>
  <?php if($src=="") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  &iquest;Como seleccionar una sala para editar su perfil?</b> </font></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic a la sala que desea editar en la list.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota</b> 
  </font><font face="Verdana, Arial, Helvetica, sans-serif"><ul><font size="2">
    Si usted decide cerrar esta ventana dé clic al botón<img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>. 
  </font></ul>
  <font size="2"><?php endif;?>
  </font></font> 
</form>

