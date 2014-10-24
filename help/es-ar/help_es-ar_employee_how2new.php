<font face="Verdana, Arial" size=3 color="#0000cc"><b>Administración de personal</b></font><p>
<?php 
if(!$src&&!$x1){
?>
<font size=2 face="verdana,arial" >
<b>Como contratar a una persona</b></font>
<p><font size=2 face="verdana,arial" > <strong><font color="#000066" face="Verdana, Arial, Helvetica, sans-serif">Como 
contratar a una persona </font></strong> 
<form action="#" >
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1</b> </font> 
  <ul>
    <font color=#ff0000 size="2" face="Verdana, Arial, Helvetica, sans-serif">Verifique 
    primero si ya existe la persona</font><font size="2" face="Verdana, Arial, Helvetica, sans-serif">. 
    </font><font face="Verdana, Arial, Helvetica, sans-serif">
    <p><font size="2"> Escriba ya sea la información completa o las primeras letras 
      de la informaci&oacute;n personal, como por ejemplo el apellido, nombre, 
      o el n&uacute;mero PID (person identifier). </font> 
<p><font color="#000066" size="2">Ejemplo 1: escriba "21000012" o "12". <br>
      Ejemplo 2: escriba "Guerero" o "gue". <br>
      Ejemplo 3: escriba "Alfredo" o "Alf". </font></font> 
</ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 2: </b>Dé 
  clic al bot&oacute;n <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> 
  para iniciar la b&uacute;squeda. </font> 
  <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 3: </b> 
    Si la b&uacute;squeda no encontr&oacute; resultados, haga clic en este bot&oacute;n 
    </font> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createLDImgSrc('../','register_gray.gif','0') ?>> 
    y siga las instrucciones para registrarla. </font><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>
    </font><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>
    <b><br>
    Paso 4</b>: Si la b&uacute;squeda encontr&oacute; resultados, seleccione la 
    persona correcta de la lista haciendo clic en este bot&oacute;n <img <?php echo createLDImgSrc('../','ok_small.gif','0') ?>></font> 
  <p><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 6</b>: 
    </font> <font size="2" face="Verdana, Arial, Helvetica, sans-serif">Una vez 
    desplegada la forma escriba los datos relevantes al empleado.</font> 
  <ul>
    <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','warn.gif','0') ?>> 
      Nota: Si la persona est&aacute; actualmente empleada sus datos seran mostrados. 
      </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 7:</b></font><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Dé 
  clic al bot&oacute;n <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> 
  para salvar la informaci&oacute;n. </font> 
  <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota</b> </font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Si falta alg&uacute;n 
    dato, aparecer&aacute; un mensaje requiriendo la informaci&oacute;n, ingrese 
    la informaci&oacute;n en los campos marcados con rojo. Despu&eacute;s, dé 
    clic al botón <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> 
    para salvar la informaci&oacute;n completa. </font> 
    <p> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota</b> </font><font face="Verdana, Arial, Helvetica, sans-serif">
  <ul>
    <font size="2"> Si usted decide cerrar esta ventana dé clic al botón <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>. 
    </font>
  </ul>
  </font> 
</form>
<font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
<?php
}else{
?><font size=2 face="verdana,arial" >
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<?php
	if($src){
?>
<font color="#990000"><b>Como actualizar los datos del empleado?</b></font></font> 
<ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1:</b> Solo 
  ingrese los nuevos datos en los campos apropiados. </font> 
  <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 2:</b> 
    Dé clic al bot&oacute;n <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> 
    para salvar los datos actualizados del empleado. </font>
  <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','warn.gif','0') ?>> 
    Nota: Si quiere cancelar la actualizaci&oacute;n, haga clic en el bot&oacute;n 
    <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>. </font> 
</ul>
<font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
<?php
	}else{
?>
<font color="#990000"><b>Como contratar a una persona?</b></font></font> 
<ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1:</b> Solo 
  ingrese los nuevos datos en los campos apropiados. </font> 
  <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 2:</b> 
    Dé clic al bot&oacute;n <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> 
    para salvar los datos actualizados del empleado. </font>
  <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','warn.gif','0') ?>> 
    Nota: Si quiere cancelar la actualizaci&oacute;n, haga clic en el bot&oacute;n 
    <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>. </font> 
</ul>
<?php
	}
}
?>
