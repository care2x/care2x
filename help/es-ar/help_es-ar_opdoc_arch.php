<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
Documentos de Quirófano 
<?php
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
  <?php if($src=="arch") : ?>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php if(($x1=="dummy")||($x1=="?")||($x1=="")||!$x2) : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Listar 
  todos los documentos de operaciones realizadas en cierta fecha.</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Ingrese 
    la fecha de la operaci&oacute;n en el campo"<span style="background-color:yellow" > 
    Fecha de la cirugía: </span>". <br>
    </font> 
    <ul>
      <font color="#000099" size=2 face="Verdana, Arial, Helvetica, sans-serif"> 
      <!-- <b>Tip:</b> Escribe "T" o "t" para ingresar automáticamente la fecha de hoy.<br>
		<b>Tip:</b> Escribe "Y" o "y" para ingresar automáticamente la fecha de ayer.<br> -->
      </font> 
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 2: </b>Deje 
    los otros campos en blanco o vac&iacute;os.<br>
    <b>Paso 3: </b>Dé clic al bot&oacute;n <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> 
    para empezar la búsqueda.<br>
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
      Fecha de nacimiento</font> <br>
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 2: </b>Deje 
    los otros campos en blanco o vac&iacute;os.<br>
    <b>Paso 3: </b>Dé clic al bot&oacute;n <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> 
    para empezar la búsqueda.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b>Listar todos los documentos de quir&oacute;fano de 
  cierto cirujano.</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Escriba 
    el nombre del cirujano en el campo "<span style="background-color:yellow" >Cirujano: 
    </span>". <br>
    <b>Paso 2: </b>Deje los otros campos en blanco o vac&iacute;os.<br>
    <b>Paso 3: </b>Dé clic al bot&oacute;n <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> 
    para empezar la búsqueda. </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b>Listar todos los documentos de quir&oacute;fano de 
  pacientes </b></font></font><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><font color="#990000"><b>ambulatorios 
  </b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al bot&oacute;n "<span style="background-color:yellow" >Paciente ambulatorio 
    <input type="radio" name="r" value="1">
    </span>". <br>
    <b>Paso 2: </b>Deje los otros campos en blanco o vac&iacute;os.<br>
    <b>Paso 3: </b>Dé clic al bot&oacute;n <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> 
    para empezar la búsqueda. </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b>Listar todos los documentos de quir&oacute;fano de 
  pacientes </b></font><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><font color="#990000"><b>hospitalizados</b></font></font> 
  </font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al bot&oacute;n "<span style="background-color:yellow" > </span><span style="background-color:yellow" >
    <input type="radio" name="r" value="1">
    Paciente hospitalizado</span>".<br>
    <b>Paso 2: </b>Deje los otros campos en blanco o vac&iacute;os.<br>
    <b>Paso 3: </b>Dé clic al bot&oacute;n <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> 
    para empezar la búsqueda.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b>Listar todos los documentos de quir&oacute;fano de 
  pacientes asegurados</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al bot&oacute;n "<span style="background-color:yellow" > </span><span style="background-color:yellow" >
    <input type="radio" name="r" value="1">
    Seguro</span>".<br>
    <b>Paso 2: </b>Deje los otros campos en blanco o vac&iacute;os.<br>
    <b>Paso 3: </b>Dé clic al bot&oacute;n <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> 
    para empezar la búsqueda.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b>Listar todos los documentos de quir&oacute;fano de 
  pacientes con seguro privado</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al bot&oacute;n "<span style="background-color:yellow" > 
    <input type="radio" name="r" value="1">
    Privado</span>". <br>
    <b>Paso 2: </b>Deje los otros campos en blanco o vac&iacute;os.<br>
    <b>Paso 3: </b>Dé clic al bot&oacute;n <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> 
    para empezar la búsqueda.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b>Listar todos los documentos de quir&oacute;fano de 
  </b></font></font><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><font color="#990000"><b>pacientes 
  que pagan por cuenta propia</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al bot&oacute;n "<span style="background-color:yellow" > </span><span style="background-color:yellow" >
    <input type="radio" name="r" value="1">
    Paga por cuenta propia</span>". <br>
    <b>Paso 2: </b>Deje los otros campos en blanco o vac&iacute;os.<br>
    <b>Paso 3: </b>Dé clic al bot&oacute;n <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> 
    para empezar la búsqueda.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b>Listar todos los documentos de quir&oacute;fano con 
  cierta palabra clave</b></font></font> 
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
    para empezar la búsqueda.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b>Listar todos los documentos de quir&oacute;fano de 
  cierta clasificaci&oacute;n de cirug&iacute;a</b></font></font> 
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
    para empezar la búsqueda.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>><b><font color="#990000"> 
  Nota:</font></b> </font> 
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
      Horpitalizado</span>".<br>
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
    cerrar dé clic al botón <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>. 
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  <?php if(($x1=="search"||$x1='paginate')&&($x2>0)) : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  Como seleccionar para ser desplegado un documento </b></font><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><font color="#990000"><b>en 
  particular</b></font></font><font color="#990000"><b> archivado ?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota: </b> 
    D&eacute; clic en el nombre, fecha, numero, para mostrar el documento archivado. 
    </font> 
    <p> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> &iquest;Como ordenar la lista?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota: </b> 
    D&eacute; clic en el t&iacute;tulo de la columna con la cual desea ordenar 
    la lista. </font><font face="Verdana, Arial, Helvetica, sans-serif">
    <p><font size="2"> Por ejemplo: Si desea ordenarla por fecha de operaci&oacute;n, 
      d&eacute; clic en el t&iacute;tulo Operaci&oacute;n. <br>
      Un pr&oacute;ximo clic invertir&aacute; el orden: </font></font> 
    <p> 
    <blockquote> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img src='../help/es/img/es_or_search_sort.png'> 
      </font></blockquote>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> &iquest;Como continuar buscando en los archivos?</b> 
  </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al bot&oacute;n "<span style="background-color:yellow" > </span> 
    <input type="button" value="Busqueda de nuevo archivo">
    para regresar a los campos de b&uacute;squeda de archivo. </font> 
    <p> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> 
  <font color="#990000"><b> Nota:</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Si usted decide 
    cerrar dé clic al botón <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>. 
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  <?php if(($x1=="select"||$x1='paginate')&&($x2==1)) : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  &iquest;Como actualizar o editar el documento mostrado?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al bot&oacute;n "<span style="background-color:yellow" > </span> 
    <input type="button" value="Actualizar datos">
    para cambiar al modo de edici&oacute;n.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> &iquest;Como continuar buscando en los archivos?</b> 
  </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Metodo 1: </b>Dé 
    clic al bot&oacute;n "<span style="background-color:yellow" > </span> 
    <input name="button" type="button" value="Busqueda de nuevo archivo">
    para regresar a los campos de b&uacute;squeda de archivo. </font> 
    <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>O Metodo 
      2: </b>Dé clic al bot&oacute;n <img <?php echo createLDImgSrc('../','arch-blu.gif','0','absmiddle') ?>> 
      para regresar a los campos de b&uacute;squeda de archivo.</font>
    <p> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> 
  <font color="#990000"><b> Nota:</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Si usted decide 
    cerrar dé clic al botón <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>. 
    </font> 
  </ul>

<?php endif;?>
<?php endif;?>

</form>

