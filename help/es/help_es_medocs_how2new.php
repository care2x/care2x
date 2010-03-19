<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<font face="Verdana, Arial" size=3 color="#0000cc"> <b>�Cómo documentar un paciente 
en medocs?</b></font> 
<form action="#" >
  <?php if($src=="?") : ?>
  <b><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Paso 1</font></b> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Halle los datos básicos 
    del paciente.<br>
    Escriba en el campo "Documentar este paciente:" cualquiera de los siguientes 
    datos:<br>
    </font>
    <Ul type="disc">
      <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">número del paciente 
        o<br>
        </font>
      <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">apellido o<br>
        </font>
      <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">nombre del paciente<br>
        <font color="#000099"> <b>Tip:</b> Si su sistema está equipado 
        con un escáner de códigos de barras, dé clic en el campo "Documentar este 
        paciente:" para enfocarlo y escanear el código de barras en la tarjeta 
        del paciente con el escáner. Sáltese el paso 2. </font></font> 
    </ul>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 2</b> 
  </font><font face="Verdana, Arial, Helvetica, sans-serif"><ul><font size="2">
    Dé clic en el botón 
    <input type="button" value="Buscar">
    para iniciar la búsqueda. 
  </font></ul>
  <font size="2"><b>Alternativa al paso 2</b> </font></font>
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Usted puede hacer cualquiera 
    de lo siguiente:<br>
    </font>
    <Ul type="disc">
      <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">escribir el apellido 
        del paciente en el campo "Apellido:" <br>
        </font>
      <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">o escribir el nombre 
        del paciente en el campo "Nombre:" <br>
        </font>
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif">luego dé clic en la tecla 
    "Enter" del teclado. </font>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 3</b> 
  </font><font face="Verdana, Arial, Helvetica, sans-serif"><ul><font size="2">
    Si la búsqueda halla un solo resultado, aparecerá un nuevo formulario con 
    los datos básicos del paciente. Por el contrario, si la búsqueda halla varios 
    resultados, aparecerá una lista con los resultados. 
    <?php endif;?>
    <?php if(($src=="?")||($x1>1)) : ?>
    <br>
    Para documentar un paciente de la lista, dé clic ya sea en el botón <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> 
    correspondiente a él, o el apellido, nombre o el número de identificación 
    del paciente, o la fecha de admisión. 
  </font></ul>
  <font size="2"><?php endif;?>
  <?php if($src=="?") : ?>
  <b>Paso 4</b> 
  <?php endif;?>
  <?php if(($src!="?")&&($x1==1)) : ?>
  <b>Paso 1</b> 
  <?php endif;?>
  <?php if(($x1=="1")||($src=="?")) : ?>
  </font></font>
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Una vez abierto el formulario 
    con los datos del paciente, usted puede: </font>
    <Ul type="disc">
      <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">escribir información 
        adicional en el asegurador o seguro en el campo "Información adicional",<br>
        </font>
      <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">dé clic en "<span style="background-color:yellow" >
        <input type="radio" name="n" value="a">
        Sí</span>" en los botones de "Consejo médico" si el paciente recibió el 
        consejo médico obligatorio,<br>
        </font>
      <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">dé clic en "<span style="background-color:yellow" >
        <input type="radio" name="n" value="a">
        No</span>" en los botones de "Consejo médico" si el paciente no recibió 
        el consejo médico obligatorio,<br>
        </font>
      <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">escriba el reporte 
        diagnóstico en el campo "Diagnóstico:" ,<br>
        </font>
      <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">escriba el reporte 
        terapéutico en el campo "Terapia:" ,<br>
        </font>
      <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">de ser necesario, 
        cambie la fecha en el campo "Documentado el día:" ,<br>
        </font>
      <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">de ser necesario, 
        cambie el nombre en el campo "Documentado por:" ,<br>
        </font>
      <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">de ser necesario, 
        escriba un número clave en el campo "número clave:" ,<br>
        </font>
    </ul>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota</b> 
  </font><font face="Verdana, Arial, Helvetica, sans-serif"><ul><font size="2">
    Si usted decide borrar lo que haya escrito, dé clic en el botón 
    <input type="button" value="Reiniciar">
    . 
  </font></ul>
  <font size="2"><b>Paso 
  <?php if($src!="?") print "2"; else print "5"; ?>
  </b> 
  <ul>
    Dé clic en el botón 
    <input type="button" value="Guardar">
    para guardar el documento. 
  </ul>
  <?php endif;?>
  <b>Nota</b> </font></font>
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Si usted decide cerrar 
    el documento sin guardar los cambios, dé clic en el botón <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>. 
    </font> 
  </ul>


</form>

