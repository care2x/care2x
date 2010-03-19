<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc"> <b> Bit&aacute;cora de Quir&oacute;fano 
- 
<?php
if($src=="create")
{
	switch($x1)
	{
	case "": print "Iniciar un nuevo documento de registro";
						break;
	case "fresh": print "Iniciar un nuevo documento de registro";
						break;
	case "get": print  "";
						break;
	case "logmain": print "Editar un registro de un documento de cirugía";
						break;
	default: print "Registrar una nueva operación";	
	}
}
if($src=="time")
{
	print "Documentando ";
	switch($x1)
	{
	case "entry_out": print "horas de entrada y salida";
						break;
	case "cut_close": print "Tiempo de corte y sutura";
						break;
	case "wait_time": print "Tiempos de espera";
						break;
	case "bandage_time": print "Tiempo de vendaje";
						break;
	case "repos_time": print "Tiempo de reposición";
	}
}
if($src=="person")
{
	print "Documentando ";
	switch($x1)
	{
	case "operator":$person="un cirujano"; 
						break;
	case "assist":$person="un Asistente del cirujano"; 
						break;
	case "scrub": $person="una enfermera instrumentadora";
						break;
	case "rotating":$person="una Enfermera rotante"; 
						break;
	case "ana": $person="un Anestesiólogo";
	}
	print $person;
}
if($src=="search")
{
	switch($x1)
	{
	case "search": print "Seleccionando un documento en particular ";
						break;
	case "": print "Buscar un documento de registro de cirugía";
						break;
	case "get": print  "Documento de registro del Paciente de cirugía ";
						break;
	case "fresh": print "Buscar un documento de registro de cirugía";
	}
}
if($src=="arch")
{
	print "Archivo";	
	/*switch($x1)
	{
	case "dummy": print "Archive";
						break;
	case "": print "Archivo";
						break;
	case "?": print "Archivo";
						break;
	case "search": print  "Lista de archivos resultantes de la busqueda";
						break;
	case "select": print "Documento del paciente";
	}*/
}
 ?>
</b></font> 
<form action="#" >
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php if($src=="person") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  &iquest;Como ingresar una <?php echo $person ?> por la via vista r&aacute;pida?</b> 
  </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota: </b>Si 
    <?php echo $person ?> fue seleccionado en una operaci&oacute;n previa, su 
    nombre est&aacute; listado en la lista de vista r&aacute;pida. </font> 
    <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: 
      </b>Verifique primero si aparece en la lista de vista r&aacute;pida en &quot;Quir&oacute;fano&quot;. 
      Si no, seleccione su funci&oacute;n correcta de Quir&oacute;fano.<br>
      <b>Paso 2: </b>Haga clic en el apellido o nombre de <?php echo $person ?>, 
      o en el enlace <nobr>"<span style="background-color:yellow" > <img <?php echo createComIcon('../','uparrowgrnlrg.gif','0') ?>> 
      Ingresar esta persona como<?php echo $person ?>... </span>"</nobr>. El cirujano 
      será automáticamente agregado a la lista actual. </font>
    <p> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> <?php echo ucfirst($person) ?> No aparece en la lista 
  de vista rápida, ¿Como agregar <?php echo $person ?>?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Escriba 
    ya sea la información completa o las primeras letras del apellido,o nombbre 
    de <?php echo $person ?> en el campo"<span style="background-color:yellow" > 
    Buscar una nueva <?php echo substr($person,2) ?>... </span>".<br>
    <b>Paso 2: </b>Dé clic al bot&oacute;n 
    <input type="button" value="OK">
    para buscar a <?php echo $person ?>.<br>
    <b>Paso 3: </b>El resultado será una lista. Dé clic al nombre o apellido, 
    o al enlace <nobr>"<span style="background-color:yellow" > <img <?php echo createComIcon('../','uparrowgrnlrg.gif','0') ?>> 
    Agregar como<?php echo $person ?>... </span>"</nobr> correspondiente a la<?php echo $person ?> 
    que desea. </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> ¿Como borrar a<?php echo $person ?> de la lista?</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al icono <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> 
    a la derecha del nombre.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> Ya terminé. ¿Como regreso a la bitácora?</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic en el botón <img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle"> 
    Que aparecerá despues de haber seleccionado <?php echo $person ?>.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> 
  <font color="#990000"><b> Nota:</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Si usted decide 
    cerrar esta ventana dé clic al botón<img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>. 
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  <?php if($src=="time") : ?>
  <?php if($x1=="entry_out") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  ¿Como ducumentar la hora de entrada y salida a Quirófano?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Escriba 
    la hora de entrada a quir&oacute;fano en el campo "<span style="background-color:yellow" > 
    de: 
    <input type="text" name="d" size=5 maxlength=5>
    </span>" en la columna izquierda.<br>
    <b>Paso 2: </b>Escriba la hora de salida de quir&oacute;fano en el campo"<span style="background-color:yellow" > 
    para: 
    <input type="text" name="d" size=5 maxlength=5>
    </span>" en la columna derecha. </font> 
    <p> 
    <ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Tip: </b>Escriba 
      "n" o "N" (significa Now) en el campo para que aparezca autom&aacute;ticamente 
      la hora actual. </font> 
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>
    <b>Nota: </b>Usted puede ingresar varias horas de entrada y salida antes de 
    salvar la información. </font> 
    <p> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  <?php if($x1=="cut_close") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  ¿Como documentar la hora de corte y sutura?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Escriba 
    la hora de corte en el campo "<span style="background-color:yellow" > de: 
    <input type="text" name="d2" size=5 maxlength=5>
    </span>" en la columna izquierda.<br>
    <b>Paso 2: </b>Escriba la hora de sutura en el campo "<span style="background-color:yellow" > 
    para: 
    <input type="text" name="d3" size=5 maxlength=5>
    </span>" en la columna derecha. </font> 
    <p> 
    <ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Tip: </b>Escriba 
      "n" o "N" (significa Now) en el campo para que aparezca autom&aacute;ticamente 
      la hora actual. </font> 
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>
    <b>Nota: </b>Usted puede ingresar varias horas de corte y sutura antes de 
    salvar la información. </font> 
    <ul>
      <p> 
    </ul>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  <?php if($x1=="wait_time") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  ¿Como documentar tiempos de espera (tiempo muerto)?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Escriba 
    la hora de inicio en el campo "<span style="background-color:yellow" > de: 
    <input type="text" name="d22" size=5 maxlength=5>
    </span>" en la primera columna.<br>
    <b>Paso 2: </b>Escriba la hora de t&eacute;rmino en el campo"<span style="background-color:yellow" >par</span><span style="background-color:yellow" >a: 
    <input type="text" name="d32" size=5 maxlength=5>
    </span>" en la segunda columna. </font> 
    <p> 
    <ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Tip: </b>Escriba 
      "n" o "N" (significa Now) en el campo para que aparezca autom&aacute;ticamente 
      la hora actual. <br>
      <b>Paso 3: </b>Selecciona la razón en la tercera columna. column. </font> 
      <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota: 
        </b>Usted puede ingresar varias horas antes de salvar la información. 
        </font> 
      <p> 
    </ul>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  <?php if($x1=="bandage_time") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  ¿Como documentar tiempos de vendaje?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Escriba 
    la hora de inicio en el campo "<span style="background-color:yellow" > de: 
    <input type="text" name="d222" size=5 maxlength=5>
    </span>" en la columna izquierda.<br>
    <b>Paso 2: </b>Escriba la hora de t&eacute;rmino en el campo"<span style="background-color:yellow" >par</span><span style="background-color:yellow" >a: 
    <input type="text" name="d322" size=5 maxlength=5>
    </span>" en la columna derecha. </font> 
    <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Tip: </b>Escriba 
      "n" o "N" (significa Now) en el campo para que aparezca autom&aacute;ticamente 
      la hora actual. <br>
      <b>Nota: </b>Usted puede ingresar varias horas antes de salvar la información. 
      </font> 
    <p> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  <?php if($x1=="repos_time") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  ¿Como documentar tiempos de reposici&oacute;n?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Escriba 
    la hora de inicio en el campo "<span style="background-color:yellow" > de: 
    <input type="text" name="d2222" size=5 maxlength=5>
    </span>" en la columna izquierda.<br>
    <b>Paso 2: </b>Escriba la hora de t&eacute;rmino en el campo"<span style="background-color:yellow" >par</span><span style="background-color:yellow" >a: 
    <input type="text" name="d3222" size=5 maxlength=5>
    </span>" en la columna derecha. </font> 
    <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Tip: </b>Escriba 
      "n" o "N" (significa Now) en el campo para que aparezca autom&aacute;ticamente 
      la hora actual. <br>
      <b>Nota: </b>Usted puede ingresar varias horas antes de salvar la información. 
      </font> 
    <p> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  &iquest;Como salvar la informaci&oacute;n?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic en el botón <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> 
    para salvar la informaci&oacute;n<br>
    <b>Paso 2: </b>Si ya termin&oacute;, d&eacute; clic en el bot&oacute;n<img <?php echo createLDImgSrc('../','close2.gif','0') ?>> 
    para cerrar la ventana y regeresar a bit&aacute;cora.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> Quiero borrar las entradas haciendo clic en el botón 
  "Borrar datos" pero no trabaja. ¿Que debería hacer?</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota: </b>Haciendo 
    clic en el bot&oacute;n &quot;Borrar datos&quot; solo borrar&aacute; los datos 
    que no han sido salvados. Si desea borrar las entradas previamente salvadas, 
    siga estas instrucciones: </font> 
    <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: 
      </b>Dé clic al campo de entrada de la hora que desee borrar.<br>
      <b>Paso 2: </b>Borre la hora manualmente usando las teclas "Borrar" "Del" 
      o &quot;Retroceso&quot; "Backspace" de su teclado.<br>
      <b>Paso 3: </b>Dé clic en el botón <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> 
      para salvar los cambios.<br>
      </font>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> 
  <font color="#990000"><b> Nota:</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Si usted decide 
    cerrar esta ventana dé clic al botón<img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>. 
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  <?php if($src=="create") : ?>
  <?php if($x1=="logmain") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  ¿Como editar una entrada de registro de operación?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic en el botón <img src="../img/update3.gif" width=15 height=14 border=0> 
    correspondiente a la entrada de registro del paciente.<br>
    <b>Paso 2: </b>La entrada de registro del paciente será copiada al marco de 
    edición. Ahora podrá editarla siguiendo las instrucciones para documentar 
    una operación. <br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> ¿Como abrir el folder de datos del paciente?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic en el botón <img <?php echo createComIcon('../','info3.gif','0') ?>> 
    a la izquierda del n&uacute;mero de identificaci&oacute;n del paciente.<br>
    <b>Paso 2: </b>Y emerger&aacute; el folder de datos del paciente.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> ¿Como hacer un cambio a otro departamento o quirófano?</b> 
  </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Seleccione 
    el departmento en la caja 
    <select name="dept" size=1>
      <?php
$Or2Dept=get_meta_tags("../global_conf/resolve_or2ordept.pid");
					$opabt=get_meta_tags("../global_conf/$lang/op_tag_dept.pid");

					while(list($x,$v)=each($opabt))
					{
						if($x=="anaesth") continue;
						print'
					<option value="'.$x.'"';
						if ($dept==$x) print " selected";
						print '> '.$v.'</option>';
					}
				?>
    </select>
    . <br>
    <b>Paso 2: </b>Seleccione el quir&oacute;fano en la caja 
    <select name="saal" size=1 >
      <?php
while(list($x,$v)=each($Or2Dept))
					{
						print'
					<option value="'.$x.'"';
						if ($saal==$x) print " selected";
						print '> '.$x.'</option>';
					}
				?>
    </select>
    . <br>
    <b>Paso 3: </b>Dé clic en el botón 
    <input type="button" value="Cambiar">
    para cambiar a otro departamento y/o quirófano.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> Como desplegar las entradas de registro de cierto 
  dia diferente del actualmente mostrado?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Para 
    mostrar los registros de días previos, haga clic en el enlace "<span style="background-color:yellow" > 
    D&iacute;a Anterior</span>" en la esquina superior izquierda de la tabla.<br>
    Haga clic las veces que sea necesario hasta que se muestre el día deseado. 
    <br>
    <b>Paso 2: </b>Para mostrar los registros de días siguientes, haga clic en 
    el enlace ""<span style="background-color:yellow" > Dia Siguiente</span>" 
    en la esquina superior derecha de la tabla.<br>
    Haga clic las veces que sea necesario hasta que se muestre el día deseado. 
    <br>
    </font> 
  </ul>
  <hr>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  <?php if($x2=="material") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  &iquest;Como documentar el material usado para la operaci&oacute;n?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Escriba 
    el número de artículo en el campo "<span style="background-color:yellow" > 
    Num. Articulo: </span>". </font> 
    <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Alternativas: 
      </b> </font>
    <ul type=disc>
      <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Escriba 
        el nombre o las primeras letras del material, descripción,nombre genérico, 
        o número de orden en el campo "<span style="background-color:yellow" >Num. 
        Articulo: </span>". </font>
      <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Escanee 
        el código de barras del artículo. </font>
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>
    <b>Paso 2: </b>Dé clic al bot&oacute;n 
    <input type="button" value="OK">
    o pulse la tecla "enter"de su teclado para buscar el producto. </font> 
    <ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota: </b>Si 
      la búsqueda encontró algún resultado la información del material será agregada 
      inmediatamente al documento.<br>
      <b>Nota: </b>Si la búsqueda encuentra varios resultados, aparecerá un listado. 
      Haga clic en el bot&oacute;n <img <?php echo createComIcon('../','bul_arrowgrnlrg.gif','0') ?>> 
      o el nombre o n&uacute;mero de art&iacute;culo par agregarlo al documento. 
      </font> 
      <p> 
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 3: </b>Si 
    el artículo es agregado al documento, puede cambiar la cantidad en el campo 
    "<span style="background-color:yellow" > no.Pcs.</span>" de ser necesario. 
    </font> 
    <p> 
    <ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota: </b>Una 
      vez que haya cambiado el número de piezas, aparecerán los botones "Salvar" 
      y "Restablecer". </font> 
      <p> 
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 4: </b>Si 
    ha cambiado la cantidad en el campo"no.Pcs.", dé clic al botón<img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> 
    para salvar los cambios. </font> 
    <p> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> &iquest;Como quitar un artículo de la lista?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al icono <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> 
    correspondiente al art&iacute;culo.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> No se encontr&oacute; el art&iacute;culo. &iquest;Como 
  forzar manualmente el ingreso de un art&iacute;culo?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al enlace"<span style="background-color:yellow" > <img <?php echo createComIcon('../','accessrights.gif','0') ?>> 
    De clic aquí para ingresar manualmente un artículo.</span>"<br>
    <b>Paso 2: </b>Ingrese manualmente la información del artículo en los campos 
    correspondientes. </font> 
    <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 3: 
      </b>Dé clic en el botón <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> 
      para agregar la informaci&oacute;n al documento. </font>
    <p> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> 
  <font color="#990000"><b> Nota:</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Si usted decide 
    cerrar esta ventana dé clic al botón<img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>. 
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> ¿Como desplegar la bitácora principal de nuevo?</b> 
  </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al enlace "<span style="background-color:yellow" > <img <?php echo createComIcon('../','manfldr.gif','0') ?>> 
    Mostrar la bit&aacute;cora. </span>".<br>
    </font> 
  </ul>
  <hr>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  <?php if(($x1=="")||($x1=="fresh")) : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  &iquest;Cómo empezar un documento de registro para una operaci&oacute;n?</b> 
  </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Primero 
    encuentre al paciente. Escriba el Número de identificación del paciente en 
    el campo"<span style="background-color:yellow" > No. Paciente: </span>" . 
    </font> 
    <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Alternativas: 
      </b> </font>
    <ul type=disc>
      <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Escriba 
        el nombre o las primeras letras del nombre o apellido en el campo "<span style="background-color:yellow" > 
        Nombre</span>". </font>
      <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Escriba 
        la fecha completa o las primeros digitos de la fecha de nacimiento del 
        paciente en el campo"<span style="background-color:yellow" > Fecha de 
        nacimiento</span>". </font>
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 2: </b>Dé 
    clic al bot&oacute;n 
    <input type="button" value="Buscar">
    para iniciar la b&uacute;squeda del paciente. </font> 
    <p> 
    <ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota: </b>Si 
      la búsqueda encontró un resultado la información b&aacute;sica del paciente 
      será agregada inmediatamente en los campos correspondientes.. </font> 
      <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota: 
        </b>Si la búsqueda encuentra varios resultados, aparecerá un listado. 
        Haga clic en el nombre o apellido para agregarlo al documento. </font>
      <p> 
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 3: </b>Dé 
    clic al bot&oacute;n <img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>> 
    de nuevo para mayores instrucciones. </font> 
    <p> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php else : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> ¿Como ingresar el diagnostico para la cirug&iacute;a?</b> 
  </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Escriba 
    el diagnostico en el campo "<span style="background-color:yellow" > Diagn&oacute;stico: 
    </span>".<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> &iquest;Como ingresar la informaci&oacute;n del cirujano?</b> 
  </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al enlace "<span style="background-color:yellow" > Cirujano</span>".<br>
    <b>Paso 2: </b>Aparecer&aacute; una ventana para agregar la información. <br>
    <b>Paso 3: </b>Siga las instrucciones de la ventana o haga clic en el botón 
    &quot;Ayuda&quot; para instrucciones extra.. <br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  </font><font color="#990000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>&iquest;Como 
  ingresar la informaci&oacute;n del asistente del cirujano?</b></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al enlace "<span style="background-color:yellow" > Asistente</span>".<br>
    <b>Paso 2: </b>Aparecer&aacute; una ventana para agregar la información. <br>
    <b>Paso 3: </b>Siga las instrucciones de la ventana o haga clic en el botón 
    &quot;Ayuda&quot; para instrucciones extra.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> &iquest;Como ingresar la informaci&oacute;n de la 
  enfermera instrumentista?</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al enlace "<span style="background-color:yellow" > Enfermera instrumentadora</span>".<br>
    <b>Paso 2: </b>Aparecer&aacute; una ventana para agregar la información. <br>
    <b>Paso 3: </b>Siga las instrucciones de la ventana o haga clic en el botón 
    &quot;Ayuda&quot; para instrucciones extra.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> &iquest;Como ingresar la informaci&oacute;n de la 
  enfermera rotatoria?</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al enlace "<span style="background-color:yellow" > Enfermera rotatoria</span>".<br>
    <b>Paso 2: </b>Aparecer&aacute; una ventana para agregar la información. <br>
    <b>Paso 3: </b>Siga las instrucciones de la ventana o haga clic en el botón 
    &quot;Ayuda&quot; para instrucciones extra.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> &iquest;Como ingresar el tipo de anestesia usada para 
  la operaci&oacute;n?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Seleccione 
    el tipo de anestesia desde la caja "<span style="background-color:yellow" > 
    Anestesia 
    <select name="a">
      <option > ITA</option>
      <option > Plexus</option>
      <option > ITA-Jet</option>
      <option > ITA-Mask</option>
      <option > LA</option>
      <option > DS</option>
      <option > AS</option>
    </select>
    </span>"<b>.</b> </font> 
    <p> 
    <ul type=disc>
      <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>AIT: 
        </b>Anestesia Intra-traqueal </font>
      <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>NIT:</strong> 
        Narc&oacute;tico intratraqueal</font>
      <li><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">AL: 
        </font></strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Anestesia 
        local (inyectado localmente o aplicado)</font>
      <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>DS: 
        </strong>Daemmerschlaf (sedaci&oacute;n analg&eacute;sica)</font>
      <li><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">SA:</font></strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
        Sedaci&oacute;n analg&eacute;sica</font>
      <li><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Plexo:</font></strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
        Anestesia en los nervios del plexo<br>
        </font> 
    </ul>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> &iquest;Como ingresar la informaci&oacute;n del Anestesi&oacute;logo?</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al enlace "<span style="background-color:yellow" > Anestesi&oacute;logo</span>".<br>
    <b>Paso 2: </b>Aparecer&aacute; una ventana para agregar la información. <br>
    <b>Paso 3: </b>Siga las instrucciones de la ventana o haga clic en el botón 
    &quot;Ayuda&quot; para instrucciones extra.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> &iquest;Como anotar la hora de ingreso, corte, sutura, 
  y salida directamente en los campos correspondientes?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Hora de ingreso: 
    </b>Escriba la hora en el campo"<span style="background-color:yellow" > Ingreso: 
    <input type="text" name="t" size=5 maxlength=5>
    </span>".<br>
    <b>Hora de corte: </b>Escriba la hora en el campo"<span style="background-color:yellow" > 
    Corte: 
    <input type="text" name="t" size=5 maxlength=5>
    </span>" .<br>
    <b>Hora de sutura: </b>Escriba la hora en el campo "<span style="background-color:yellow" > 
    Sutura: 
    <input type="text" name="t" size=5 maxlength=5>
    </span>" .<br>
    <b>Hora de salida: </b>Escriba la hora en el campo "<span style="background-color:yellow" > 
    Salida: 
    <input type="text" name="t" size=5 maxlength=5>
    </span>" .<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> &iquest;Como ingresar la hora en varias secciones 
  a la vez?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b> 
    </font> 
    <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Hora de 
      Entrada/Salida: </b> Dé clic al enlace "<span style="background-color:yellow" > 
      Ingreso/salida <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> 
      </span>" situada en la esquina inferior izquierda. </font> 
    <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Hora de 
      Corte/Sutura:</b> Dé clic al enlace ""<span style="background-color:yellow" > 
      Corte/Sutura <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> 
      </span>" situada en la esquina inferior izquierda. </font> 
    <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Tiempo 
      de espera: </b> Dé clic al enlace ""<span style="background-color:yellow" > 
      tiempo de espera<img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> 
      </span>" situada en la esquina inferior izquierda. </font> 
    <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Tiempo 
      de Enyesamiento/Vendajes:</b> Dé clic al enlace "<span style="background-color:yellow" > 
      Vendajes <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> 
      </span>" situada en la esquina inferior izquierda. </font> 
    <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Tiempo 
      de Reposici&oacute;n: </b> Dé clic al enlace ""<span style="background-color:yellow" > 
      Reposici&oacute;n <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> 
      </span>" situada en la esquina inferior izquierda. </font> 
    <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 2: 
      </b>Aparecer&aacute; una ventana para agregar la información. <br>
      <b>Paso 3: </b>Siga las instrucciones de la ventana o haga clic en el botón 
      &quot;Ayuda&quot; para instrucciones extra.<br>
      <br>
      </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"></ul> <img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> ¿Como ingresar la informaci&oacute;n en la tabla gr&aacute;fica?</b> 
  </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Mueva 
    el puntero del mouse a la hora elejida en la escala de tiempo correspondiente 
    a la secci&oacute;n (ej. sutura)<br>
    <b>Paso 2: </b>Haga clic en la escala de tiempo correspondiente a la hora 
    elegida. </font> 
    <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota:</b> 
      La primera entrada será la hora de inicio, la segunda será la hora de terminar, 
      la tercera será la segunda hora de inicio, etc.. </font>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> ¿Como ingresar la información de terapia o cirugía?</b> 
  </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Escriba 
    la terapia u operación en el campo "<span style="background-color:yellow" > 
    Terapia/Operaci&oacute;n: </span>" .<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> ¿Como ingresar resultados, observaciones y notas extra?</b> 
  </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Escriba 
    en el campo "<span style="background-color:yellow" > Resultados: </span>".<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> &iquest;Como salvar el registro del documento?</b> 
  </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic en el botón <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>><br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> &iquest;Cómo empezar un nuevo registro de documento?</b> 
  </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic en el botón <img <?php echo createLDImgSrc('../','newpat2.gif','0') ?>><br>
    <b>Paso 2: </b>Dé clic de nuevo en el botón <img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>> 
    para m&aacute;s instrucciones.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota</b> </font><font face="Verdana, Arial, Helvetica, sans-serif">
  <ul>
    <font size="2"> Si usted decide cerrar dé clic al botón <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>. 
    </font> 
  </ul>
  <font size="2">
  <?php endif;?>
  <?php endif;?>
  <?php if($src=="search") : ?>
  <?php if(($x1=="fresh")||($x1=="")) : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  &iquest;Como buscar un documento de alg&uacute;n paciente en particular?</b> 
  </font></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Escriba 
    ya sea la información completa o la primeras letras del nombre o apellido 
    del paciente o la fecha de nacimiento en el campo &quot;<span style="background-color:yellow" > 
    Palabra clave: 
    <input type="text" name="m" size=20 maxlength=20>
    </span>". <br>
    <b>Paso 2: </b>Dé clic en el botón 
    <input type="button" value="Buscar">
    para iniciar la b&uacute;squeda del documento del paciente. </font><font face="Verdana, Arial, Helvetica, sans-serif">
    <p><font size="2"><b>Nota: </b>Si la búsqueda encontró un resultado la información 
      b&aacute;sica del paciente será agregada inmediatamente en los campos correspondientes.. 
      </font></font> 
    <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota: </b>Si 
      la búsqueda encuentra varios resultados, aparecerá un listado. Haga clic 
      en el nombre o apellido para agregarlo al documento. </font>
    <p> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  <?php if(($x1=="search")&&($x3!="1")) : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  &iquest;Como mostrar un documento en particular?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota: </b> 
    D&eacute; clic en el nombre del paciente para desplegar este documento. </font> 
    <p> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  <?php if(($x1=="get")||($x3=="1")) : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  &iquest;Como actualizar o editar el documento que est&aacute; viendo?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al bot&oacute;n <img src="../img/update3.gif" border=0> situado junto 
    a la fecha de operaci&oacute;n en la columna de la izquierda para cambiar 
    al modo de edici&oacute;n.<br>
    <b>Paso 2: </b>Ya en modo de edici&oacute;n, d&eacute; clic al bot&oacute;n 
    de &quot;Ayuda&quot; para m&aacute;s instrucciones. </font> 
    <p> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> &iquest;Como abrir la carpeta de datos del paciente?</b> 
  </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al bot&oacute;n <img src="../img/info2.gif" border=0> a la izquierda 
    del n&uacute;mero de paciente.<br>
    <b>Paso 2: </b>Se abrir&aacute; la carpeta de datos del paciente. Dé clic 
    al bot&oacute;n de &quot;Ayuda&quot; para m&aacute;s instrucciones. </font> 
    <p> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  &iquest;Como continuar buscando?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Escriba 
    ya sea la información completa o la primeras letras del nombre o apellido 
    del paciente o la fecha de nacimiento en el campo &quot;<span style="background-color:yellow" > 
    Palabra clave: 
    <input type="text" name="m2" size=20 maxlength=20>
    </span>". <br>
    <b>Paso 2: </b>Dé clic en el botón 
    <input name="button" type="button" value="Buscar">
    para iniciar la b&uacute;squeda del documento del paciente. </font> 
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
  <?php if($src=="arch") : ?>
  <?php if($x2=="1") : ?>
  <img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> 
  Nota: Ultimas entradas de registro</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Cada vez que 
    entra al archivo, Se despliegan autom&aacute;ticamente las ultimas operaciones 
    registradas. </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  <?php if(($x3=="")&&($x1!="0")) : ?>
  <img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> 
  No hay operaciones para este dia.</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Dé clic al bot&oacute;n 
    "Opciones" para abrir la caja de opciones.<br>
    Dé clic al bot&oacute;n "Buscar" para cambiar a modo de b&uacute;squeda. </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  </font> 
  <p><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
    <font color="#990000"><b>Quiero ver entradas de registro archivadas otro d&iacute;a.</b></font></font> 
  </p>
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Para mostrar 
    d&iacute;as previos: </b>Haga clic en el enlace "<span style="background-color:yellow" > 
    D&iacute;a Anterior</span>" en la esquina superior izquierda de la tabla.<br>
    Haga clic las veces que sea necesario hasta que se muestre el día deseado. 
    </font> 
    <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Para mostrar 
      d&iacute;as siguientes: </b>Haga clic en el enlace "<span style="background-color:yellow" > 
      Dia Siguiente</span>" en la esquina superior derecha de la tabla.<br>
      Haga clic las veces que sea necesario hasta que se muestre el día deseado. 
      <br>
      </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b>Quiero ver entradas de registro archivadas de otro 
  departamento o quir&oacute;fano.</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Seleccione 
    el departamento en la caja <nobr>"<span style="background-color:yellow" > 
    Cambiar el departamento 
    <select name="o">
      <option > Departamento 1</option>
      <option > Departamento 2</option>
    </select>
    </span>".</nobr> <br>
    Se ajustar&aacute; autom&aacute;ticamente.<br>
    <b>Paso 2: </b>O seleccione el quir&oacute;fano en la caja<nobr>"<span style="background-color:yellow" > 
    <select name="o">
      <option > Quirófano 1</option>
      <option > Quirófano 2</option>
    </select>
    </span>".</nobr> <br>
    Se ajustar&aacute; autom&aacute;ticamente.<br>
    <b>Paso 3: </b>Dé clic en el botón 
    <input type="button" value="Cambiar">
    para cambiar a un nuevo quir&oacute;fano o departamento.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php if(($x3!="")) : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  &iquest;Como actualizar o editar el documento que est&aacute; viendo?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al bot&oacute;n <img src="../img/update3.gif" border=0> situado junto 
    a la fecha de operaci&oacute;n en la columna de la izquierda para cambiar 
    al modo de edici&oacute;n.<br>
    <b>Paso 2: </b>Ya en modo de edici&oacute;n, d&eacute; clic al bot&oacute;n 
    de &quot;Ayuda&quot; para m&aacute;s instrucciones. </font> 
  </ul>
  <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
    <font color="#990000"><b> &iquest;Como abrir la carpeta de datos del paciente?</b> 
    </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al bot&oacute;n <img src="../img/info2.gif" border=0> a la izquierda 
    del n&uacute;mero de paciente.<br>
    <b>Paso 2: </b>Se abrir&aacute; la carpeta de datos del paciente. Dé clic 
    al bot&oacute;n de &quot;Ayuda&quot; para m&aacute;s instrucciones. </font> 
  </ul>
  <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
    <?php endif;?>
    <img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> 
    Nota:</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Si usted decide 
    cerrar esta ventana dé clic al botón <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>. 
    </font> 
  </ul>


	<?php endif;?>


</form>

