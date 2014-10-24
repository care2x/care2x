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
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>¿Como 
  actualizar o editar el documento mostrado?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al botón 
    <input name="button" type="button" value="Actualizar datos">
    para cambiar al modo de edición.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> ¿Cómo empezar un nuevo documento?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al botón 
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
  <img <?php echo createComIcon('../','frage.gif','0') ?>> </font></font><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><font color="#990000"><b>¿Como 
  actualizar o editar el documento mostrado?</b></font></font> 
  <ul>
    <p><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b><b>Paso 
      1: </b></b>Dé clic al botón "<span style="background-color:yellow" > 
      </span> 
      <input name="button2" type="button" value="Actualizar datos">
      para cambiar al modo de edición.<b><br>
      Paso 2:</b> Cuando el documentomostrado cambio al modo de edición, 
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
  ¿Como crear un nuevo documento?</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Primero 
    encuentre al paciente. Escriba en el campo de búsqueda 
    <input type="text" name="m2" size=20 maxlength=20></span>
    " el nombre completo o las primeras letras.<br>
    <b>Paso 2: </b>Dé clic en el botón <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> 
    para iniciar la búsqueda del paciente. </font> 
    <p> 
    <ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota: </b>Si 
      la búsqueda encuentra un resultado, la información básica 
      del paciente será puesta inmediatamente en los campos correspondientes. 
      </font> 
      <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota: 
        </b>Si la búsqueda encuentra varios resultados aparecerá un listado. 
        Dé clic en el nombre del paciente para seleccionarlo para documentación. 
        </font>
      <p> 
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 3: </b>Cuando 
    la información básica es desplegada, puede ingresar la información 
    adicional relevante a la operación en los campos correspondientes.<br>
    <b>Paso 4: </b>Para salvar el documento, dé clic al botón<img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> 
    .<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  <?php endif;?>
  <?php if($src=="search") : ?>
  <?php if(($x1=="dummy")||($x1=="")) : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>¿Como 
  buscar un documento de algún paciente en particular?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Escriba 
    ya sea la información completa o la primeras letras del nombre o apellido 
    del paciente o la fecha de nacimiento en el campo &quot;<span style="background-color:yellow" > 
    Palabra clave de búsqueda: 
    <input type="text" name="m3" size=20 maxlength=20>
    </span>". <br>
    <b>Paso 2: </b>Dé clic en el botón 
    <input name="button3" type="button" value="Buscar">
    para iniciar la búsqueda del documento del paciente. </font> 
    <p><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota: </b>Si 
      la búsqueda encontró un resultado la información básica del paciente 
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
    <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>¿Como 
    mostrar un documento en particular?</b> </font></font> </p>
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota: </b> 
    Dé clic en el nombre del paciente para desplegar este documento. </font> 
  </ul>
  <ul>
    <p> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b>¿Como continuar buscando?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Escriba 
    ya sea la información completa o la primeras letras del nombre o apellido 
    del paciente o la fecha de nacimiento en el campo &quot;<span style="background-color:yellow" > 
    Palabra clave de búsqueda: 
    <input type="text" name="m22" size=20 maxlength=20>
    </span>". <br>
    <b>Paso 2: </b>Dé clic en el botón 
    <input name="button4" type="button" value="Buscar">
    para iniciar la búsqueda del documento del paciente. </font> 
  </ul>
  <p> 
  <p><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> 
    <font color="#990000"><b> Nota:</b></font>Si usted decide cerrar dé clic al 
    botón<img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.</font></p>
  <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
    <?php endif;?>
    <?php if(($x1=="select")&&($x2==1)) : ?>
    <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>¿Como 
    actualizar o editar el documento mostrado?</b></font></font> </p>
  <ul>
    <p><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b><b>Paso 
      1: </b></b>Dé clic al botón "<span style="background-color:yellow" > 
      </span> 
      <input name="button22" type="button" value="Actualizar datos">
      para cambiar al modo de edición.</font></p>
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
  todos los documentos de quirófano de cierto </b></font></font><font color="#990000"><b> 
  fecha</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Escriba 
    la fecha de la cirugía en el campo "<span style="background-color:yellow" > 
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
  <font color="#990000"><b>Listar todos los documentos de quirófano de 
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
    los otros campos en blanco o vacíos.<br>
    <b>Paso 3: </b>Dé clic al botón <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> 
    para empezar la búsqueda.</font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Listar 
  todos los documentos de quirófano de cierto cirujano.</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Escriba 
    el nombre del cirujano en el campo "<span style="background-color:yellow" >Cirujano: 
    </span>". <br>
    <b>Paso 2: </b>Deje los otros campos en blanco o vacíos.<br>
    <b>Paso 3: </b>Dé clic al botón <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> 
    para empezar la búsqueda. </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b>Listar todos los documentos de quirófano de 
  pacientes ambulatorios </b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al botón "<span style="background-color:yellow" >Paciente ambulatorio 
    <input type="radio" name="r" value="1">
    </span>". <br>
    <b>Paso 2: </b>Deje los otros campos en blanco o vacíos.<br>
    <b>Paso 3: </b>Dé clic al botón <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> 
    para empezar la búsqueda. </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b>Listar todos los documentos de quirófano de 
  pacientes hospitalizados</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al botón "<span style="background-color:yellow" > 
    <input type="radio" name="r" value="1">
    Paciente hospitalizado</span>". <br>
    <b>Paso 2: </b>Deje los otros campos en blanco o vacíos.<br>
    <b>Paso 3: </b>Dé clic al botón <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> 
    para empezar la búsqueda.</font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Listar 
  todos los documentos de quirófano de pacientes asegurados</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al botón "<span style="background-color:yellow" > 
    <input type="radio" name="r" value="1">
    Seguro</span>". <br>
    <b>Paso 2: </b>Deje los otros campos en blanco o vacíos.<br>
    <b>Paso 3: </b>Dé clic al botón <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> 
    para empezar la búsqueda.</font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Listar 
  todos los documentos de quirófano de pacientes con seguro privado</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al botón "<span style="background-color:yellow" > 
    <input type="radio" name="r" value="1">
    Privado</span>". <br>
    <b>Paso 2: </b>Deje los otros campos en blanco o vacíos.<br>
    <b>Paso 3: </b>Dé clic al botón <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> 
    para empezar la búsqueda.</font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b>Listar todos los documentos de quirófano de 
  pacientes que pagan por cuenta propia</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al botón "<span style="background-color:yellow" > 
    <input type="radio" name="r" value="1">
    Paga por cuenta propia</span>". <br>
    <b>Paso 2: </b>Deje los otros campos en blanco o vacíos.<br>
    <b>Paso 3: </b>Dé clic al botón <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> 
    para empezar la búsqueda.</font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Listar 
  todos los documentos de quirófano con cierta palabra clave</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Escriba 
    la palabra clave en el campo correspondiente. Puede ser la palabra completa 
    o las primeras letras de una palabra. <br>
    </font> 
    <ul>
      <font color="#000099" size=2 face="Verdana, Arial, Helvetica, sans-serif" > 
      <b>Ejemplo:</b> Para una palabra de diagnostico escríbalo en el campo"Diagnostico" 
      .<br>
      <b>Ejemplo:</b> Para una palabra de localización escríbalo 
      en el campo"Localización".<br>
      <b>Ejemplo:</b> Para una palabra terapeutica escríbalo en el campo"Terapia".<br>
      <b>Ejemplo:</b> Para una palabra de nota especial escríbalo en el 
      campo"Nota especial".<br>
      </font> 
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 2: </b>Deje 
    los otros campos en blanco o vacíos.<br>
    <b>Paso 3: </b>Dé clic al botón <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> 
    para empezar la búsqueda.</font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>
  <img <?php echo createComIcon('../','frage.gif','0') ?>><font color="#990000"><b> 
  Listar todos los documentos de quirófano de cierta clasificación 
  de cirugía</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Escriba 
    la palabra clave en el campo correspondiente. Puede ser la palabra completa 
    o las primeras letras de una palabra. <br>
    </font> 
    <ul>
      <font color="#000099" size=2 face="Verdana, Arial, Helvetica, sans-serif" > 
      <b>Ejemplo:</b> Para una operación menor escriba el número 
      en el campo"<span style="background-color:yellow" > 
      <input type="text" name="m" size=4 maxlength=2>
      menor </span>" .<br>
      <b>Ejemplo:</b> Para una operación intermedia escriba el número 
      en el campo"<span style="background-color:yellow" > 
      <input type="text" name="m" size=4 maxlength=2>
      intermedia</span>" .<br>
      <b>Ejemplo:</b> Para una operación mayor escriba el número 
      en el campo"<span style="background-color:yellow" > 
      <input type="text" name="m" size=4 maxlength=2>
      mayor </span>".<br>
      </font> 
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 2: </b>Deje 
    los otros campos en blanco o vacíos.<br>
    <b>Paso 3: </b>Dé clic al botón <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> 
    para empezar la búsqueda.</font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>
  <img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>><b><b><font color="#990000">Nota:</font></b> 
  </b> </font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Usted puede combinar 
    varias condiciones de búsqueda. Por ejemplo: Si desea listar todos 
    los pacientes operados por el cirujano Morales y que tuvieron un tratamiento 
    que contiene la palabra que empieza con "lipo": </font> 
    <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: 
      </b>Escriba"Morales" en el campo"<span style="background-color:yellow" > 
      Cirujano: 
      <input type="text" name="s" size=15 maxlength=4 value="Morales">
      </span>".<br>
      <b>Paso 2: </b>Dé clic al botón "<span style="background-color:yellow" > 
      <input type="radio" name="r" value="1" checked>
      Internado</span>".<br>
      <b>Paso 3: </b>Escriba"lipo" en el campo"<span style="background-color:yellow" > 
      Terapia: 
      <input type="text" name="s" size=20 maxlength=4 value="lipo">
      </span>". <br>
      <b>Paso 4: </b>Dé clic al botón <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> 
      para empezar la búsqueda. </font> 
    <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota</b><br>
      Si la búsqueda encuentra un solo resultado, se desplegará 
      el documento completo inmediatamente.<br>
      De lo contrario, si la búsqueda encuentra varios resultados, se mostrará 
      una lista.</font></p>
    <p><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Para abrir 
      el documento para el paciente que está buscando haga clic en el botón<img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> 
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
    Dé clic en el nombre, fecha, numero, para mostrar el documento archivado.</font> 
  </ul>
  <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b>¿Como continuar buscando en los archivos?</b> 
  </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al botón "<span style="background-color:yellow" > </span> 
    <input name="button5" type="button" value="Busqueda de nuevo archivo">
    para regresar a los campos de búsqueda de archivo. </font> 
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
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>¿Como 
  actualizar o editar el documento mostrado?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al botón "<span style="background-color:yellow" > </span> 
    <input name="button6" type="button" value="Actualizar datos">
    para cambiar al modo de edición.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> ¿Como continuar buscando en los archivos?</b> 
  </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Metodo 1: </b>Dé 
    clic al botón "<span style="background-color:yellow" > </span> 
    <input name="button6" type="button" value="Busqueda de nuevo archivo">
    para regresar a los campos de búsqueda de archivo. </font> 
    <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>O Metodo 
      2: </b>Dé clic al botón <img <?php echo createLDImgSrc('../','arch-blu.gif','0','absmiddle') ?>> 
      para regresar a los campos de búsqueda de archivo.</font> 
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

