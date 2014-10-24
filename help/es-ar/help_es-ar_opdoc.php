<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
Documentación - Quirofano
<?php
if($src=="create")
{
	switch($x1)
	{
	case "dummy": print "Crear un nuevo documento";
						break;
	case "saveok": print  " - El documento está salvado";
						break;
	case "update": print "Actualizar el presente documento";
						break;
	}
}
if($src=="search")
{
	switch($x1)
	{
	case "dummy": print "Buscar un documento";
						break;
	case "": print "Buscar un documento";
						break;
	case "match": print  "Lista de resultados de búsqueda";
						break;
	case "select": print "Documento del paciente";
	}
}
if($src=="arch")
{
	switch($x1)
	{
	case "dummy": print "Archivo";
						break;
	case "": print "Archivo";
						break;
	case "?": print "Archivo";
						break;
	case "search": print  "Lista de resultados de búsqueda en archivo";
						break;
	case "select": print "Documento del Paciente";
	}
}
 ?></b></font>
<p><font size=2 face="verdana,arial" >
<form action="#" >
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php if($src=="create") : ?>
  <?php if($x1=="saveok") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>&iquest;Como 
  actualizar o editar el documento mostrado?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al bot&oacute;n 
    <input name="button" type="button" value="Actualizar datos">
    para cambiar al modo de edici&oacute;n.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> &iquest;Cómo empezar un nuevo documento?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al bot&oacute;n 
    <input type="button" value="Iniciar un nuevo documento">
    .<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota</b> </font><font face="Verdana, Arial, Helvetica, sans-serif">
  <ul>
    <font size="2"> Si usted decide cerrar dé clic al botón<img <?php echo createLDImgSrc('../','close2.gif','0') ?>>. 
    </font>
  </ul>
  <font size="2">
  <?php endif;?>
  <?php if($x1=="update") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> </font></font><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><font color="#990000"><b>&iquest;Como 
  actualizar o editar el documento mostrado?</b></font></font> 
  <ul>
    <p><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b><b>Paso 
      1: </b></b>Dé clic al bot&oacute;n "<span style="background-color:yellow" > 
      </span> 
      <input name="button2" type="button" value="Actualizar datos">
      para cambiar al modo de edici&oacute;n.<b><br>
      Paso 2:</b> Cuando el documentomostrado cambio al modo de edici&oacute;n, 
      puede editar los datos.<br>
      <b>Paso 3: </b>Para salvar el documento, dé clic al botón<img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> 
      .<br>
      </font></p>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> 
  <font color="#990000"><b> Nota:</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Si usted decide 
    cerrar dé clic al botón<img <?php echo createLDImgSrc('../','close2.gif','0') ?>>. 
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  <?php if($x1=="dummy") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  &iquest;Como crear un nuevo documento?</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Primero 
    encuentre al paciente. Escriba en el campo de b&uacute;squeda 
    <input type="text" name="m2" size=20 maxlength=20></span>
    " el nombre completo o las primeras letras.<br>
    <b>Paso 2: </b>Dé clic en el botón <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> 
    para iniciar la b&uacute;squeda del paciente. </font> 
    <p> 
    <ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota: </b>Si 
      la b&uacute;squeda encuentra un resultado, la informaci&oacute;n b&aacute;sica 
      del paciente ser&aacute; puesta inmediatamente en los campos correspondientes. 
      </font> 
      <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota: 
        </b>Si la b&uacute;squeda encuentra varios resultados aparecerá un listado. 
        D&eacute; clic en el nombre del paciente para seleccionarlo para documentaci&oacute;n. 
        </font>
      <p> 
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 3: </b>Cuando 
    la informaci&oacute;n b&aacute;sica es desplegada, puede ingresar la informaci&oacute;n 
    adicional relevante a la operaci&oacute;n en los campos correspondientes.<br>
    <b>Paso 4: </b>Para salvar el documento, dé clic al botón<img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> 
    .<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  <?php endif;?>
  <?php if($src=="search") : ?>
  <?php if(($x1=="dummy")||($x1=="")) : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>&iquest;Como 
  buscar un documento de alg&uacute;n paciente en particular?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Escriba 
    ya sea la información completa o la primeras letras del nombre o apellido 
    del paciente o la fecha de nacimiento en el campo &quot;<span style="background-color:yellow" > 
    Palabra clave de b&uacute;squeda: 
    <input type="text" name="m3" size=20 maxlength=20>
    </span>". <br>
    <b>Paso 2: </b>Dé clic en el botón 
    <input name="button3" type="button" value="Buscar">
    para iniciar la b&uacute;squeda del documento del paciente. </font> 
    <p><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota: </b>Si 
      la búsqueda encontró un resultado la información b&aacute;sica del paciente 
      será agregada inmediatamente en los campos correspondientes.. </font>
    <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota: </b>Si 
      la búsqueda encuentra varios resultados, aparecerá un listado. Haga clic 
      en el nombre o apellido para agregarlo al documento. </font>
  </ul>
  <ul>
    <ul>
      <p> 
    </ul>
  </ul>
  <p><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> 
    <font color="#990000"><b> Nota:</b></font>Si usted decide cerrar dé clic al 
    botón<img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.</font></p>
  <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
    <?php endif;?>
    <?php if(($x1=="match")&&($x2>0)) : ?>
    <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>&iquest;Como 
    mostrar un documento en particular?</b> </font></font> </p>
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota: </b> 
    D&eacute; clic en el nombre del paciente para desplegar este documento. </font> 
  </ul>
  <ul>
    <p> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b>&iquest;Como continuar buscando?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Escriba 
    ya sea la información completa o la primeras letras del nombre o apellido 
    del paciente o la fecha de nacimiento en el campo &quot;<span style="background-color:yellow" > 
    Palabra clave de b&uacute;squeda: 
    <input type="text" name="m22" size=20 maxlength=20>
    </span>". <br>
    <b>Paso 2: </b>Dé clic en el botón 
    <input name="button4" type="button" value="Buscar">
    para iniciar la b&uacute;squeda del documento del paciente. </font> 
  </ul>
  <p> 
  <p><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> 
    <font color="#990000"><b> Nota:</b></font>Si usted decide cerrar dé clic al 
    botón<img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.</font></p>
  <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
    <?php endif;?>
    <?php if(($x1=="select")&&($x2==1)) : ?>
    <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>&iquest;Como 
    actualizar o editar el documento mostrado?</b></font></font> </p>
  <ul>
    <p><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b><b>Paso 
      1: </b></b>Dé clic al bot&oacute;n "<span style="background-color:yellow" > 
      </span> 
      <input name="button22" type="button" value="Actualizar datos">
      para cambiar al modo de edici&oacute;n.</font></p>
  </ul>
  <ul>
    <p> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> 
  <font color="#990000"><b> Nota:</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Si usted decide 
    cerrar dé clic al botón<img <?php echo createLDImgSrc('../','close2.gif','0') ?>>. 
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  <?php endif;?>
  <?php if($src=="arch") : ?>
  <?php if(($x1=="dummy")||($x1=="?")||($x1=="")) : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><font color="#990000"><b>Listar 
  todos los documentos de quir&oacute;fano de cierto </b></font></font><font color="#990000"><b> 
  fecha</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Escriba 
    la fecha de la cirug&iacute;a en el campo "<span style="background-color:yellow" > 
    Fecha de la cirugía: </span>". <br>
    </font> 
    <ul>
      <font color="#000099" size=2 face="Verdana, Arial, Helvetica, sans-serif"> 
      <!-- <b>Tip:</b> Enter "T" o "t" to automatically produce today's date.<br>
		<b>Tip:</b> Enter "Y" o "y" to automatically produce yesterday's date.<br> -->
      </font> 
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 2: </b>Deje 
    los demás campos en blanco o vacíos.<br>
    <b>Paso 3: </b>Dé clic en el botón <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> 
    para iniciar la búsqueda.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b>Listar todos los documentos de quir&oacute;fano de 
  cierto paciente</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Escriba 
    la palabra clave en el campo correspondiente. Puede ser la palabra completa 
    o las primeras letras de los datos personales del paciente. <br>
    </font> 
    <ul>
      <font color="#000099" size=2 face="Verdana, Arial, Helvetica, sans-serif" > 
      <b>Los siguientes campos pueden ser completados con una palabra clave:</b> 
      <br>
      </font><font size=2 face="Verdana, Arial, Helvetica, sans-serif" >No. de 
      Paciente. <br>
      Apellido<br>
      Nombre<br>
      Fecha de nacimiento</font> 
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 2: </b>Deje 
    los otros campos en blanco o vac&iacute;os.<br>
    <b>Paso 3: </b>Dé clic al bot&oacute;n <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> 
    para empezar la búsqueda.</font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Listar 
  todos los documentos de quir&oacute;fano de cierto cirujano.</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Escriba 
    el nombre del cirujano en el campo "<span style="background-color:yellow" >Cirujano: 
    </span>". <br>
    <b>Paso 2: </b>Deje los otros campos en blanco o vac&iacute;os.<br>
    <b>Paso 3: </b>Dé clic al bot&oacute;n <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> 
    para empezar la búsqueda. </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b>Listar todos los documentos de quir&oacute;fano de 
  pacientes ambulatorios </b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al bot&oacute;n "<span style="background-color:yellow" >Paciente ambulatorio 
    <input type="radio" name="r" value="1">
    </span>". <br>
    <b>Paso 2: </b>Deje los otros campos en blanco o vac&iacute;os.<br>
    <b>Paso 3: </b>Dé clic al bot&oacute;n <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> 
    para empezar la búsqueda. </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b>Listar todos los documentos de quir&oacute;fano de 
  pacientes hospitalizados</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al bot&oacute;n "<span style="background-color:yellow" > 
    <input type="radio" name="r" value="1">
    Paciente hospitalizado</span>". <br>
    <b>Paso 2: </b>Deje los otros campos en blanco o vac&iacute;os.<br>
    <b>Paso 3: </b>Dé clic al bot&oacute;n <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> 
    para empezar la búsqueda.</font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Listar 
  todos los documentos de quir&oacute;fano de pacientes asegurados</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al bot&oacute;n "<span style="background-color:yellow" > 
    <input type="radio" name="r" value="1">
    Seguro</span>". <br>
    <b>Paso 2: </b>Deje los otros campos en blanco o vac&iacute;os.<br>
    <b>Paso 3: </b>Dé clic al bot&oacute;n <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> 
    para empezar la búsqueda.</font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Listar 
  todos los documentos de quir&oacute;fano de pacientes con seguro privado</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al bot&oacute;n "<span style="background-color:yellow" > 
    <input type="radio" name="r" value="1">
    Privado</span>". <br>
    <b>Paso 2: </b>Deje los otros campos en blanco o vac&iacute;os.<br>
    <b>Paso 3: </b>Dé clic al bot&oacute;n <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> 
    para empezar la búsqueda.</font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b>Listar todos los documentos de quir&oacute;fano de 
  pacientes que pagan por cuenta propia</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al bot&oacute;n "<span style="background-color:yellow" > 
    <input type="radio" name="r" value="1">
    Paga por cuenta propia</span>". <br>
    <b>Paso 2: </b>Deje los otros campos en blanco o vac&iacute;os.<br>
    <b>Paso 3: </b>Dé clic al bot&oacute;n <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> 
    para empezar la búsqueda.</font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Listar 
  todos los documentos de quir&oacute;fano con cierta palabra clave</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Escriba 
    la palabra clave en el campo correspondiente. Puede ser la palabra completa 
    o las primeras letras de una palabra. <br>
    </font> 
    <ul>
      <font color="#000099" size=2 face="Verdana, Arial, Helvetica, sans-serif" > 
      <b>Ejemplo:</b> Para una palabra de diagnostico escr&iacute;balo en el campo"Diagnostico" 
      .<br>
      <b>Ejemplo:</b> Para una palabra de localizaci&oacute;n escr&iacute;balo 
      en el campo"Localizaci&oacute;n".<br>
      <b>Ejemplo:</b> Para una palabra terapeutica escr&iacute;balo en el campo"Terapia".<br>
      <b>Ejemplo:</b> Para una palabra de nota especial escr&iacute;balo en el 
      campo"Nota especial".<br>
      </font> 
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 2: </b>Deje 
    los otros campos en blanco o vac&iacute;os.<br>
    <b>Paso 3: </b>Dé clic al bot&oacute;n <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> 
    para empezar la búsqueda.</font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>
  <img <?php echo createComIcon('../','frage.gif','0') ?>><font color="#990000"><b> 
  Listar todos los documentos de quir&oacute;fano de cierta clasificaci&oacute;n 
  de cirug&iacute;a</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Escriba 
    la palabra clave en el campo correspondiente. Puede ser la palabra completa 
    o las primeras letras de una palabra. <br>
    </font> 
    <ul>
      <font color="#000099" size=2 face="Verdana, Arial, Helvetica, sans-serif" > 
      <b>Ejemplo:</b> Para una operaci&oacute;n menor escriba el n&uacute;mero 
      en el campo"<span style="background-color:yellow" > 
      <input type="text" name="m" size=4 maxlength=2>
      menor </span>" .<br>
      <b>Ejemplo:</b> Para una operaci&oacute;n intermedia escriba el n&uacute;mero 
      en el campo"<span style="background-color:yellow" > 
      <input type="text" name="m" size=4 maxlength=2>
      intermedia</span>" .<br>
      <b>Ejemplo:</b> Para una operaci&oacute;n mayor escriba el n&uacute;mero 
      en el campo"<span style="background-color:yellow" > 
      <input type="text" name="m" size=4 maxlength=2>
      mayor </span>".<br>
      </font> 
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 2: </b>Deje 
    los otros campos en blanco o vac&iacute;os.<br>
    <b>Paso 3: </b>Dé clic al bot&oacute;n <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> 
    para empezar la búsqueda.</font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>
  <img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>><b><b><font color="#990000">Nota:</font></b> 
  </b> </font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Usted puede combinar 
    varias condiciones de b&uacute;squeda. Por ejemplo: Si desea listar todos 
    los pacientes operados por el cirujano Morales y que tuvieron un tratamiento 
    que contiene la palabra que empieza con "lipo": </font> 
    <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: 
      </b>Escriba"Morales" en el campo"<span style="background-color:yellow" > 
      Cirujano: 
      <input type="text" name="s" size=15 maxlength=4 value="Morales">
      </span>".<br>
      <b>Paso 2: </b>Dé clic al bot&oacute;n "<span style="background-color:yellow" > 
      <input type="radio" name="r" value="1" checked>
      Internado</span>".<br>
      <b>Paso 3: </b>Escriba"lipo" en el campo"<span style="background-color:yellow" > 
      Terapia: 
      <input type="text" name="s" size=20 maxlength=4 value="lipo">
      </span>". <br>
      <b>Paso 4: </b>Dé clic al bot&oacute;n <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> 
      para empezar la búsqueda. </font> 
    <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota</b><br>
      Si la b&uacute;squeda encuentra un solo resultado, se desplegar&aacute; 
      el documento completo inmediatamente.<br>
      De lo contrario, si la b&uacute;squeda encuentra varios resultados, se mostrar&aacute; 
      una lista.</font></p>
    <p><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Para abrir 
      el documento para el paciente que est&aacute; buscando haga clic en el bot&oacute;n<img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> 
      junto al nombre, fecha o numero.<nobr></nobr></font></p>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> 
  <font color="#990000"><b> Nota:</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Si usted decide 
    cerrar dé clic al botón<img <?php echo createLDImgSrc('../','close2.gif','0') ?>>. 
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  <?php if(($x1=="search")&&($x2>0)) : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Como 
  seleccionar para ser desplegado un documento en particular archivado ?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota: </b> 
    D&eacute; clic en el nombre, fecha, numero, para mostrar el documento archivado.</font> 
  </ul>
  <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b>&iquest;Como continuar buscando en los archivos?</b> 
  </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al bot&oacute;n "<span style="background-color:yellow" > </span> 
    <input name="button5" type="button" value="Busqueda de nuevo archivo">
    para regresar a los campos de b&uacute;squeda de archivo. </font> 
  </ul>
  <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> 
  <font color="#990000"><b> Nota:</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Si usted decide 
    cerrar dé clic al botón<img <?php echo createLDImgSrc('../','close2.gif','0') ?>>. 
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  <?php if(($x1=="select")&&($x2==1)) : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>&iquest;Como 
  actualizar o editar el documento mostrado?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al bot&oacute;n "<span style="background-color:yellow" > </span> 
    <input name="button6" type="button" value="Actualizar datos">
    para cambiar al modo de edici&oacute;n.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> &iquest;Como continuar buscando en los archivos?</b> 
  </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Metodo 1: </b>Dé 
    clic al bot&oacute;n "<span style="background-color:yellow" > </span> 
    <input name="button6" type="button" value="Busqueda de nuevo archivo">
    para regresar a los campos de b&uacute;squeda de archivo. </font> 
    <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>O Metodo 
      2: </b>Dé clic al bot&oacute;n <img <?php echo createLDImgSrc('../','arch-blu.gif','0','absmiddle') ?>> 
      para regresar a los campos de b&uacute;squeda de archivo.</font> 
  </ul>
  <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> 
  <font color="#990000"><b> Nota:</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Si usted decide 
    cerrar dé clic al botón<img <?php echo createLDImgSrc('../','close2.gif','0') ?>>. 
    </font> 
  </ul>

<?php endif;?>
<?php endif;?>

</form>

