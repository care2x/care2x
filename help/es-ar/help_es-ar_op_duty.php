<html>

<head>
<title></title>

</head>
<body>
<form >
  <font  size=3 color="#0000cc"> <b> 
  <?php
	switch($src)
	{
		case "show": print "Enfermeras de guardia - Plan de actividades";
							break;
		case "quick": print "Enfermeras de guardia - Vista rápida";
							break;
		case "plan": print "Enfermeras de guardia - Crear Plan de actividades";
							break;
		case "personlist": print "Crear lista de personal ";
							break;
		case "dutydoc": print "Enfermeras de guardia - Documentando trabajo realizado en su horario";
							break;
	}
?>
  </b> </font> 
  <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
    <?php if($src=="quick") : ?>
    </font>
  <p><font color="#990000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>¿Que 
    puedo hacer aquí?</strong></font><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong></b></strong> 
    </font>
  <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','update.gif','0','absmiddle') ?>><b> 
    Obtener informaci&oacute;n adicional (si est&aacute; disponible) de enfermeras 
    en servicio.</b> </font>
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Para ver la información 
    adicional, <span style="background-color:yellow" >haga clic en el nombre</span> 
    de la persona en la lista. Aparecerá una ventana mostrando la información 
    relevante. </font> 
  </ul>
  <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','update.gif','0','absmiddle') ?>><b> 
    Ver el plan de actividades para el mes completo.</b> </font>
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Para ver el plan 
    de actividades para el mes completo, de clic en el icono<img <?php echo createComIcon('../','new_address.gif','0','absmiddle') ?>> 
    Mostrar correspondiente.<br>
    El plan de actividades ser&aacute; desplegado. </font> 
  </ul>
  <p> 
  <p><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>¿Que me mostrará 
    la vista rápida?</b></font><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> </b> 
  </font> 
  <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Departmentos</b>:</font> 
    <ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> La lista de 
      los departamentos que tienen m&eacute;dicos/cirujanos en standby y/o de 
      llamada. </font> 
    </ul>
    <p> 
  <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Standby </b> 
    : </font><font face="Verdana, Arial, Helvetica, sans-serif">
    <ul>
      <font size="2"> La enfermera en espera de actividades. </font>
    </ul>
    </font> 
    <p> 
  <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Beeper/Tel&eacute;fono</b> 
    : </font><font face="Verdana, Arial, Helvetica, sans-serif"> 
<ul>
      <font size="2"> Informaci&oacute;n de Beeper y tel&eacute;fono de la enfermera 
      en espera de actividades. </font>
    </ul>
    </font>
  <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>De llamada</b> 
    : </font><font face="Verdana, Arial, Helvetica, sans-serif">
    <ul>
      <font size="2"> La enfermera de guardia. </font>
    </ul>
    </font> 
    <p> 
  <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Beeper/Tel&eacute;fono</b> 
    : </font><font face="Verdana, Arial, Helvetica, sans-serif"> 
    <ul>
      <font size="2"> Informaci&oacute;n de Beeper y tel&eacute;fono de la enfermera 
      de guardia. </font> 
    </ul>
    </font> 
    <p> 
  <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Plan de actividades</b> 
    : </font> 
    <ul>
      <p><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Para ver 
        el plan de actividades para el mes completo, de clic en el icono<img <?php echo createComIcon('../','new_address.gif','0','absmiddle') ?>> 
        Mostrar correspondiente.<br>
        Para ver el plan de actividades ser&aacute; desplegado y podr&aacute; 
        eventualmente crearlo o editarlo. </font></p>
      <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
        <?php endif;?>
        <?php if($src=="show") : ?>
        </font></p>
    </ul>
    <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
      <font color="#990000"><b>Quiero crear un nuevo plan de actividades para 
      el mes mostrado</b></font></font> 
    <ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
      clic en el botón <img <?php echo createLDImgSrc('../','newplan.gif','0') ?> >. 
      </font> 
    </ul>
    <ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 2:</b> 
      Si usted ya ingresó su nombre y contraseña y tiene autorización para acceder 
      a esta función, aparecer&aacute; el plan de actividades en modo de edici&oacute;n 
      para editarlo.<br>
      De otro modo, si usted no ha ingresado mediante nombre y contraseña, se 
      le pedirá que haga el ingreso de su nombre y contraseña. </font><font face="Verdana, Arial, Helvetica, sans-serif"> 
      <p><font size="2"> Escriba su nombre y contraseña y dé clic al botón<img <?php echo createLDImgSrc('../','continue.gif','0') ?>>. 
        </font> 
      <p><font size="2"> Si usted decide cerrar esta ventana dé clic al botón<img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>. 
        </font></font> 
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
    <font color="#990000"><b>Quiero crear un plan para cierto mes pero el plan 
    mostrado es para un mes diferente.</b></font></font> 
    <ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Haga 
      clic repetidamente en el enlace "Mes" hasta que sea mostrado el plan del 
      mes en cuesti&oacute;n. <br>
      Haga clic en el enlace derecho "mes" para avanzar el mes.<br>
      Haga clic en el enlace izquierdo "mes" para retroceder el mes.<br>
      <b>Paso 2: </b>Siga las instrucciones anteriores para crear un nuevo plan 
      de actividades.<br>
      </font> 
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
    <font color="#990000"><b>Quiero regresar a Vista R&aacute;pida</b></font></font> 
    <ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
      clic en el botón <img <?php echo createLDImgSrc('../','close2.gif','0') ?> >.<br>
      </font> 
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
    <font color="#990000"><b>Quiero ver los n&uacute;meros de tel&eacute;fono 
    y beeper de las enfermeras activas</b></font></font> 
    <ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b><span style="background-color:yellow" >Haga 
      clic en el nombre de la persona</span>. Aparecerá una ventanita mostrando 
      la información relevante. <br>
      </font> 
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota</b> </font><font face="Verdana, Arial, Helvetica, sans-serif"> 
    <ul>
      <font size="2"> Si usted decide cerrar el plan actividades dé clic al botón<img <?php echo createLDImgSrc('../','close2.gif','0') ?>>. 
      </font> 
    </ul>
    <font size="2"> 
    <?php endif;?>
    <?php if($src=="plan") : ?>
    <img <?php echo createComIcon('../','frage.gif','0') ?>> 
    <font color="#990000"><b> Quiero calendarizar una enfermera en actividad usando 
    la lista de enfermeras</b></font></font></font> 
    <ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>D&eacute; 
      clic en el but&oacute;n &nbsp;<img <?php echo createComIcon('../','patdata.gif','0') ?>> 
      del d&iacute;a seleccionado para abrir la lista de enfermeras. <br>
      Aparecerá una ventanita mostrando la lista de enfermeras.<br>
      </font> 
      <ul type=disc>
        <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Dé clic 
          al icono a la izquierda de la columna "Standby" para programar una actividad 
          en standby.<br>
          </font> 
        <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Dé clic 
          al icono a la derecha de la columna"Llamada" para programar una actividad 
          de llamada. </font> 
      </ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 2: </b><span style="background-color:yellow" >Dé 
      clic al nombre de la enfermera</span> para copiarlo al plan de actividades.<br>
      <b>Paso 3: </b>Si di&oacute; clic en el nombre equivocado, solo repita el 
      paso 2 y pulse el nombre correcto.<br>
      <b>Paso 4: </b>Si ya termin&oacute;, de clic en el bot&oacute;n <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> 
      en la lista de enfermeras de la ventana.<br>
      </font> 
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
    <font color="#990000"><b> Quiero agregar manualmente el nombre de la enfermera 
    en el plan de actividades</b></font></font> 
    <ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>D&eacute; 
      clic en el campo de texto " 
      <input type="text" name="t" size=11 maxlength=4 >
      "de el d&iacute;a elegido.<br>
      <b>Paso 2: </b>Escriba el nombre de la enfermera.<br>
      </font> 
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
    <font color="#990000"><b> Quiero borrar un nombre del plan de actividades</b></font></font> 
    <ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>D&eacute; 
      clic en el campo de texto " 
      <input type="text" name="t" size=11 maxlength=4 value="Nombre">
      " de la persona a ser borrada..<br>
      <b>Paso 2: </b>Borre el nombre usando las teclas Retroceso (backspace) o 
      borrar (delete) de su teclado.<br>
      </font> 
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
    <font color="#990000"><b>Quiero salvar el plan de actividades</b></font></font> 
    <ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>D&eacute; 
      clic al bot&oacute;n <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> 
      </font> 
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
    <font color="#990000"><b>Ya salv&eacute; el plan y deseo terminar la planeaci&oacute;n. 
    &iquest;Que hacer? </b></font></font> 
    <ul>
      <p><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: 
        </b>Si ya termin&oacute;, D&eacute; clic al bot&oacute;n <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> 
        . </font></p>
      <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
        <?php endif;?>
        <?php if($src=="personlist") : ?>
        <img <?php echo createComIcon('../','frage.gif','0') ?>> 
        <font color="#990000"><b> El departamento mostrado est&aacute; equivocado. 
        Quiero cambiar al departmento correcto.</b></font></font> </p>
      <ul>
        <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: 
        </b>Seleccione el departmento en el campo <nobr>"<span style="background-color:yellow" >Cambiar 
        departamento: </span> 
        <select name="s">
          <option value="Sample department 1" selected> departmento 1</option>
          <option value="Sample department 2"> Sample department 2</option>
          <option value="Sample department 3"> Sample department 3</option>
          <option value="Sample department 4"> Sample department 4</option>
        </select>
        "</nobr>. <br>
        <b>Paso 2: </b>Dé clic en el botón 
        <input name="button" type="button" value="Cambio">
        para cambiar el departamento seleccionado. </font> 
      </ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
      <font color="#990000"><b> Quiero borrar un nombre de la lista</b></font></font> 
      <ul>
        <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: 
        </b>D&eacute; clic en el campo de texto " 
        <input type="text" name="t2" size=11 maxlength=4 value="Nombre">
        " de la persona a ser borrada..<br>
        <b>Paso 2: </b>Borre el nombre usando las teclas Retroceso (backspace) 
        o borrar (delete) de su teclado.<br>
        </font> 
      </ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
      <font color="#990000"><b>Quiero salvar la lista de personal</b></font></font> 
      <ul>
        <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: 
        </b>D&eacute; clic al bot&oacute;n <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>>.<br>
        </font> 
      </ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
      <font color="#990000"><b>Ya salv&eacute; la lista y quiero cerrarla &iquest;Que 
      hacer?</b></font></font> 
      <ul>
        <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: 
        </b>D&eacute; clic al bot&oacute;n <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> 
        . </font> 
      </ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
      <?php endif;?>
      <?php if($src=="dutydoc") : ?>
      <img <?php echo createComIcon('../','frage.gif','0') ?>> 
      <font color="#990000"><b> Como documentar un trabajo realizado durante horas 
      de actividades?</b></font></font> 
      <ul>
        <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: 
        </b>Escriba la fecha en el campo &quot;Fecha 
        <input type="text" name="d" size=10 maxlength=10>
        ".<br>
        <b>Paso 2: </b>Escriba el nombre de la enfermera en actividad en el campo 
        <nobr>"<span style="background-color:yellow" > Nombre 
        <input type="text" name="d" size=20 maxlength=10>
        </span>"</nobr>.<br>
        <b>Paso 3: </b>Escriba la hora de inicio en el campo "<span style="background-color:yellow" > 
        desde 
        <input type="text" name="d" size=5 maxlength=5>
        </span>".<br>
        <b>Paso 4: </b>Escriba la hora de t&eacute;rmino en el campo"<span style="background-color:yellow" > 
        hasta 
        <input type="text" name="d" size=5 maxlength=5>
        </span>". </font> 
        <p> 
        <ul>
          <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Tip: 
          </b>Escriba "n" o "N" (significa NOW) para agregar autom&aacute;ticamente 
          la fecha actual. </font> 
          <p> 
        </ul>
        <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 5: 
        </b>Escriba el numero de quir&oacute;fano en el campo "<span style="background-color:yellow" > 
        Quir&oacute;fano 
        <input type="text" name="d" size=5 maxlength=5>
        </span>" .<br>
        <b>Paso 6: </b>Escriba el diagnostico, terapia, u operaci&oacute;nen el 
        campo <nobr>"<span style="background-color:yellow" > Diagn&oacute;stico/Terapia 
        <input type="text" name="d" size=5 maxlength=5>
        </span>"</nobr>.<br>
        <b>Paso 7: </b>Escriba el nombre de la enfermera en standby en el campo<nobr>"<span style="background-color:yellow" > 
        En espera: 
        <input type="text" name="d" size=5 maxlength=5>
        </span>"</nobr> .<br>
        <b>Paso 8: </b>Escriba el nombre de la enfermera de llamada en el campo<nobr>"<span style="background-color:yellow" > 
        deguardia: 
        <input type="text" name="d" size=5 maxlength=5>
        </span>"</nobr> de ser necesario.<br>
        <b>Paso 1: </b>Dé clic al bot&oacute;n 
        <input type="button" value="Salvar">
        para salvar el documento. <br>
        </font> 
      </ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
      <font color="#990000"><b>&iquest;Como imprimir la lista de documentos?</b></font></font> 
      <ul>
        <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: 
        </b>Dé clic al bot&oacute;n 
        <input type="button" value="Imprimir">
        y aparecer&aacute; la ventana de impresi&oacute;n.<br>
        <b>Paso 2: </b>Siga las instrucciones de impresi&oacute;n.<br>
        </font> 
      </ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
      <font color="#990000"><b>Ya salv&eacute; el documento y quiero cerrarlo 
      &iquest;Que hacer?</b></font></font> 
      <ul>
        <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: 
        </b>D&eacute; clic al bot&oacute;n <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> 
        . </font> 
      </ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>
      <?php endif;?>
      </font> 
    </ul>
</form>
</body>
</html>
