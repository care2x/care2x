<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<font face="Verdana, Arial" size=3 color="#0000cc"> <b> 
<?php
if($x2=="pharma") print "Farmacia - "; else print "Insumos médicos - ";
	switch($src)
	{
	case "input": if($x1=="update") print "Editando la información de un producto";
                          else print "Ingresando un producto nuevo en la base de datos";
					break;
	case "search": print "Buscar un producto";
					break;
	case "mng": print "Administrar productos en la base de datos";
					break;
	case "delete": print "Retirando un producto de la base de datos";
					break;
	}


 ?>
</b></font> 
<form action="#" >
  <?php if($src=="input") : ?>
  <?php if($x1=="") : ?>
  <ul>
    <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif">Cómo ingresar 
    un producto nuevo en el catálogo de pedidos?</font></b> </font> 
    <ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Ingrese 
      toda la información acerca del producto en el campo respectivo.<br>
      </font> 
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
    <font color="#990000"><b> Deseo seleccionar una fotografía del producto. Cómo 
    lo hago?</b> </font></font> 
    <ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
      clic en el botón 
      <input type="button" value="Seleccionar...">
      en el campo "<span style="background-color:yellow" > archivo de imágenes</span>".<br>
      <b>Paso 2: </b>Una pequeña ventana aparecerá para seleccionar el archivo. 
      Seleccione el archivo de imágenes de su elección y luego dé clic en "OK".<br>
      </font> 
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
    <font color="#990000"><b> Terminé de ingresar toda la información del producto. 
    Cómo lo guardo?</b> </font></font> 
    <ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
      clic en el botón 
      <input type="button" value="Salvar">
      .<br>
      </font> 
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
    <?php endif;?>
    <?php if($x1=="save") : ?>
    <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
    Cómo ingreso un producto nuevo en la base de datos?</b> </font></font> 
    <ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
      clic en el botón 
      <input type="button" value="Producto nuevo">
      .<br>
      <b>Paso 2: </b>Aparecerá el formulario de pedidos.<br>
      <b>Paso 3: </b>Escriba la información disponible acerca del producto nuevo.<br>
      <b>Paso 4: </b>Dé clic en el botón 
      <input type="button" value="Guardar">
      para guardar la información.<br>
      </font> 
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
    <font color="#990000"><b> Deseo hacer cambios al producto que al momento estoy 
    viendo. �Cómo lo hago?</b> </font></font> 
    <ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b> 
      dé clic al botón 
      <input type="button" value="Actualizar o editar">
      .<br>
      <b>Paso 2: </b>La información de producto ingresará automáticamente al formulario 
      de edición.<br>
      <b>Paso 3: </b>Edite la información.<br>
      <b>Paso 4: </b> dé clic al botón 
      <input type="button" value="Guardar">
      para guardar la información.<br>
      </font> 
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
    <?php endif;?>
    <?php if($x1=="update") : ?>
    <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
    Deseo hacer cambios al producto que al momento estoy viendo. Cómo lo hago?</b> 
    </font></font> 
    <ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>De 
      ser necesario, primero deberá borrar los datos que ya están ingresados.</font> 
      <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 
        2: </b>Escriba la nueva información en el campo apropiado.</font> 
      <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 
        3: </b>Dé clic en el botón 
        <input type="button" value="Guardar">
        para guardar la información nueva.<br>
        </font> 
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
    <?php endif;?>
    <?php endif;?>
    <?php if($src=="search") : ?>
    <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
    Cómo busco un producto?</b> </font></font> 
    <ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Escriba 
      la palabra completa o las primeras letras de la marca del artículo, o el 
      nombre genérico, o el número de pedido, etc. en el campo <nobr><span style="background-color:yellow" >" 
      Busque la palabra...: 
      <input type="text" name="s" size=10 maxlength=10>
      "</span></nobr>.<br>
      <b>Paso 2: </b> dé clic al botón 
      <input type="button" value="Buscar">
      para hallar el artículo.<br>
      <b>Paso 3: </b>Si la búsqueda halla el artículo que concuerda de manera 
      exacta con la palabra de búsqueda, aparecerá información detallada acerca 
      del artículo.<br>
      <b>Paso 4: </b>Si la búsqueda halla varios artículos que se parecen a la 
      palabra que busca, aparecerá una lista con los artículos posibles.<br>
      </font> 
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
    <?php if($x1!="multiple") : ?>
    <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
    Hay una lista con muchos artículos. Cómo veo la información de un artículo 
    en particular?</b> </font></font> 
    <ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
      clic en el botón <img <?php echo createComIcon('../','info3.gif','0') ?>> 
      o en el nombre del artículo.<br>
      </font> 
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
    <?php endif;?>
    <?php if($x1=="multiple") : ?>
    <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
    Deseo ver la lista previa de artículos hallados. Qué debo hacer?</b> </font></font> 
    <ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
      clic en el botón 
      <input type="button" value="Ir atrás">
      .<br>
      </font> 
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
    <?php endif;?>
    <img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> 
    Nota:</b></font></font> 
    <ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Si usted ya 
      no desea ver esa información, dé clic en <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>. 
      </font> 
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
    <?php endif;?>
    <?php if($src=="mng") : ?>
    <?php if(($x3=="1")) : ?>
    <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
    Cómo hacer cambios a la información del producto?</b> </font></font> 
    <ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Cambie 
      la información acerca del producto nuevo.<br>
      <b>Paso 2: </b>Dé clic en el botón 
      <input type="button" value="Guardar">
      para guardar la información nueva.<br>
      </font> 
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
    <?php endif;?>
    <?php if($x1=="multiple") : ?>
    <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
    Cómo hago cambios al producto que estoy viendo en este momento?</b> </font></font> 
    <ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
      clic en el botón 
      <input type="button" value="Actualizar o editar">
      .<br>
      <b>Paso 2: </b>La información del producto aparecerá en el formulario para 
      que le pueda hacer los cambios.<br>
      <b>Paso 3: </b>Edite la información.<br>
      <b>Paso 4: </b>Dé clic en el botón 
      <input type="button" value="Guardar">
      para guardar la información nueva.<br>
      </font> 
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
    <font color="#990000"><b> Cómo elimino totalmente el producto que estoy viendo?</b> 
    </font></font> 
    <ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
      clic en el botón 
      <input type="button" value="Eliminar de la base de datos">
      .<br>
      <b>Paso 2: </b>Se le preguntará si realmente desea eliminar la información 
      de la base de datos<br>
      <b>Paso 3: </b>Si usted realmente desea eliminar la información del producto, 
      dé clic en el botón 
      <input type="button" value="Sí, estoy absolutamente seguro. Elimine el producto.">
      </font> 
      <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> 
        <font color="#990000"><b> Nota:</b></font> Este paso no se puede deshacer 
        una vez que eliminó los datos.<br>
        </font> 
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
    <font color="#990000"><b> No deseo eliminar el producto. Qué debo hacer?</b> 
    </font></font> 
    <ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
      clic en "<span style="background-color:yellow" > No, no deseo eliminar este 
      producto. Lléveme a la ventana anterior </span>".<br>
      </font> 
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
    <?php endif;?>
    <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
    Cómo administrar un producto en la base de datos?</b> </font></font> 
    <ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Primero 
      encuentre el producto. Escriba ya sea la información completa escriba las 
      primeras letras de la marca, nombre genérico, código, etc. en el <nobr><span style="background-color:yellow" >" 
      campo de Búsqueda: 
      <input type="text" name="s" size=10 maxlength=10>
      "</span></nobr>.<br>
      <b>Paso 2: </b>Dé clic en el botón 
      <input type="button" value="Buscar">
      para encontrar el artículo.<br>
      <b>Paso 3: </b>Si se encuentra un artículo coincidente con la palabra de 
      búsqueda, aparecerá la información detallada del producto en cuestión.<br>
      <b>Paso 4: </b>Si se encuentran varios artículos aproximados con la palabra 
      de búsqueda, aparecerá una list de los artículos coincidentes.<br>
      </font> 
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
    <?php if(($x1!="multiple")&&($x3=="")) : ?>
    <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
    Me apareció una lista de artículos. �Como ver la información de un artículo 
    en particular?</b> </font></font> 
    <ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>dé 
      clic, ya sea al botón <img <?php echo createComIcon('../','info3.gif','0') ?>> 
      o al nombre del artículo.<br>
      </font> 
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
    <?php endif;?>
    <img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> 
    Nota:</b></font></font> 
    <ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Si usted decide 
      cerrar esta ventana dé clic al botón<img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>. 
      </font> 
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
    <?php endif;?>
    <?php if($src=="delete") : ?>
    <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
    �Como remover un artículo de la lista?</b> </font></font> 
    <ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> 
      <font color="#990000"><b> Nota:</b></font> La remoción de un producto es 
      irreversible.</font> 
      <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 
        1: </b>Si está seguro de querer borrarlo, dé clic al botón 
        <input type="button" value="Sí estoy seguro. Borra los datos">
        .<br>
        </font> 
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
    <font color="#990000"><b> �Y si no quiero borrarlo?</b> </font></font> 
    <ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
      clic al enlace "<span style="background-color:yellow" > No borrar </span>".<br>
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
    <?php if($src=="report") : ?>
    <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
    �Como escribo un reporte?</b> </font></font> 
    <ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Escriba 
      su reporte en el campo <nobr><span style="background-color:yellow" >"Reporte: 
      <input type="text" name="s" size=10 maxlength=10>
      "</span></nobr>.<br>
      <b>Paso 2: </b>Escriba su nombre en el campo <nobr><span style="background-color:yellow" >"Reportó: 
      <input type="text" name="s" size=10 maxlength=10>
      "</span></nobr>.<br>
      <b>Paso 3: </b>Escriba su numero personal en el campo <nobr><span style="background-color:yellow" >" 
      No. Personal: 
      <input type="text" name="s" size=10 maxlength=10>
      "</span></nobr>.<br>
      <b>Paso 4: </b>Dé clic en el botón 
      <input type="button" value="Enviar">
      para enviar el reporte.<br>
      </font> 
    </ul>
    <img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> 
    <font color="#990000"><b> <font size="2" face="Verdana, Arial, Helvetica, sans-serif">Nota:</font></b> 
    </font><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Si usted decide 
    cerrar esta ventana dé clic al botón</font><img <?php echo createLDImgSrc('../','close2.gif','0') ?>>. 
  </ul> 
  <?php endif;?>
  </font> 
</form>

