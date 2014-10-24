<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
<?php
if($x2=="pharma") print "Farmacia - "; else print "Insumos médicos - ";
	switch($src)
	{
	case "head": if($x2=="pharma") print "Ordering pharmaceutical products"; 
						else print "Ordering products";
						break;
	case "catalog": print "Catálogo de pedidos";
						break;
	case "orderlist": print "Canasta de pedidos ( order list )";
						break;
	case "final": print "Listado final de pedidos";
						break;
	case "maincat": print "Catálogo de pedidos";
						break;
	case "arch": print "Archivo de pedidos";
						break;
	case "archshow": print "Archivo de pedidos";
						break;
	case "db": switch($x3)
					{
						case "input": print "Ingreso de un producto nuevo a la base de datos";
						break;
					}
					break;
	case "how2":print "Cómo hacer pedidos de ";
						  if($x2=="pharma") print "productos farmacéuticos"; else print "productos";
	}


 ?></b></font>
<p><font size=2 face="verdana,arial" >
<form action="#" >
  <?php if($src=="maincat") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif">Cómo añadir un pedido 
  al catálogo de pedidos?</font></b> </font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Primero 
    debe hallar el artículo. Escriba ya sea la información completa o las primeras 
    letras del artículo o marca, o nombre generico, o código, etc. en el <nobr><span style="background-color:yellow" >" 
    campo de la caja de búsqueda: 
    <input type="text" name="s" size=10 maxlength=10>
    "</span></nobr>.<br>
    <b>Paso 2: </b>Dé clic en el botón 
    <input type="button" value="Buscar artículo">
    para encontrar el artículo.<br>
    <b>Paso 3: </b>Si la búsqueda encontró el artículo exacto a su palabra de 
    búsqueda, será desplegada la información a detalle.<br>
    <b>Paso 4: </b>Dé clic en el botón 
    <input type="button" value="Poner en el catálogo">
    para agregar el artículo al catálogo.</font> 
    <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota: </b>Si 
      no quiere poner este artículo en el catálogo solo continue buscando otro 
      artículo.<br>
      </font>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> Cómo continuar la búsqueda?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Siga las instrucciones 
    de arriba para hallar el artículo.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> La búsqueda halló varios artículos que se aproximan 
  a mi palabra de búsqueda. Qué debo hacer?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Si 
    la búsqueda halló al artículo o información del artículo que se aproxima a 
    las palabras que usó en su búsqueda, aparecerá una lista.<br>
    <b>Paso 2: </b>Dé clic en el botón <img <?php echo createComIcon('../','dwnarrowgrnlrg.gif','0') ?>>. 
    El artículo se añadirá a lista del catálogo.<br>
    <b>Paso 3: </b>Si quiere ver primero la información completa delartículo, 
    haga clic en el nombre<img <?php echo createComIcon('../','info3.gif','0') ?>>.<br>
    <b>Paso 4: </b>Se desplegará la información completa del artculo.<br>
    <b>Paso 5: </b>Dé clic en el botón 
    <input type="button" value="Poner en el catálogo">
    .</font> 
    <p> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> Quiero ver más información sobre ese artículo. ¿Qué 
  debo hacer?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>dé 
    clic, ya sea al botón <img <?php echo createComIcon('../','info3.gif','0') ?>> 
    o al nombre del artículo.<br>
    <b>Paso 2: </b>Se desplegará la información completa del artculo.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> ¿Cómo elimino un artículo de la lista del catálogo?</b> 
  </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic en el botón <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> 
    del artículo.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  <?php if($src=="how2") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  Como hago un pedido de 
  <?php if($x2=="pharma") print "productos farmacéuticos"; else print "productos de los insumos médicos"; ?>
  ? </b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic en la opción del menú "<span style="background-color:yellow" > <img <?php echo createComIcon('../','bestell.gif','0') ?>> 
    Pedidos </span>" para pasar a la ventana de pedidos.<br>
    <b>Paso 2: </b>Si usted ya ha ingresado con su nombre y contraseña, verá la 
    canasta de pedidos y el catálogo de pedidos. Sin embargo, si no ha ingresado 
    con su nombre y contraseña antes, deberá ingresar estos datos. <br>
    <b>Paso 3: </b>Despues de ingresar su nombre y contraseña. Dé clic en el botón 
    <img <?php echo createLDImgSrc('../','continue.gif','0') ?>>.<br>
    <b>Paso 4: </b>Crea una lista de pedido. A la derecha podrá ver el catálogo 
    por departamento, pabellón, o sala.</font> 
    <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 5: 
      </b>Si el artículo que necesitas está en la lista, haga clic en el botón 
      <img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>> 
      para poner <b>una pieza</b> del artículo en la canasta (lista de pedido) 
      a la izquierda.</font> 
    <p> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> Deseo colocar más de una unidad del producto en la 
  canasta. Cómo lo hago?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al botón 
    <input type="checkbox" name="a" value="a" checked>
    correspondiente al artículo seleccionado.<br>
    <b>Paso 2: </b>Escriba el numero de piezas en. 
    <input type="text" name="d" size=2 maxlength=2>
    " el campo correspondiente al artículo.<br>
    <b>Paso 3: </b>Dé clic en el botón 
    <input type="button" value="Poner en la canasta">
    el artículo en la canasta (lista de pedido).<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> El artículo que necesito no está en la lista. ¿Que 
  hago?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Debes 
    encontrar el artículo. Escriba ya sea la información completa o las primeras 
    letras de la marca, o nombre genérico, código, etc. en el <nobr><span style="background-color:yellow" >" 
    campo de búsqueda: 
    <input type="text" name="s" size=10 maxlength=10>
    "</span></nobr> .<br>
    <b>Paso 2: </b>Dé clic en el botón 
    <input type="button" value="Encontrar artículo">
    para encontrar el árticulo.<br>
    <b>Paso 3: </b>Si se encuentra el artículo que se aproxime a la palabra clave, 
    aparecerá un listado.<br>
    <b>Paso 4: </b>Si quiere poner un artículo en la canasta de compras, dé clic 
    al botón<img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>>. 
    El artículo sera puesto en la lista del pedido y a la vez será incluido al 
    catálogo.<br>
    <b>Paso 5: </b>Si solo quiere agregar el artículo al Catálogo, dé clic al 
    botón<img <?php echo createComIcon('../','dwnarrowgrnlrg.gif','0') ?>>.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> ¿Como puedo ver más información del artículo?</b> 
  </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>dé 
    clic, ya sea al botón <img <?php echo createComIcon('../','info3.gif','0') ?>> 
    o al nombre del artículo.<br>
    <b>Paso 2: </b>Una ventana le mostrará la información del artículo.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> ¿Como remuevo un artículo del catálogo?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic en el botón <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> 
    del artículol.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> ¿Puedo cambiar la cantidad en la canasta de compras? 
  </b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Si.</b> Solo 
    reemplace el numero de piezas con el deseado después finalice la lista de 
    pedido. </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> Ya están en la canasta todos los artículos que necesito. 
  ¿Cual es el siguiente paso?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Puede 
    proceder enviando el pedido a 
    <?php if($x2=="pharma") print "pharmacy"; else print "medical depot"; ?>
    . <br>
    Dé clic en el botón 
    <input type="button" value="Finalizar lista de pedido">
    Para iniciar el proceso.<br>
    <b>Paso 2: </b>El pedido será desplegado de nuevo. Escriba su nombre en <nobr>"<span style="background-color:yellow" > 
    en el campo Creado por 
    <input type="text" name="c" size=15 maxlength=10>
    </span>"</nobr>.<br>
    <b>Paso 3: </b>Seleccione el estatus de prioridad del pedido entre "<span style="background-color:yellow" > 
    Normal 
    <input type="radio" name="x" value="s" checked>
    Urgente 
    <input type="radio" name="x" >
    </span>". Seleccione el botón apropiado.<br>
    <b>Paso 4: </b>El validador (médico or cirujano) debe escribir su nombre en 
    el <nobr>"<span style="background-color:yellow" > campo Validado por 
    <input type="text" name="c" size=15 maxlength=10>
    </span>"</nobr>.<br>
    <b>Paso 5: </b>El validador (médico or cirujano) debe escribir su <nobr>"<span style="background-color:yellow" > 
    Contraseña: 
    <input type="text" name="c" size=15 maxlength=10>
    </span>"</nobr>.<br>
    <b>Paso 6: </b>Dé clic en el botón 
    <input type="button" value="Enviar esta lista de pedido a<?php if($x2=="pharma") print "Farmacia"; else print "Insumos medicos"; ?>">
    para enviar el pedido.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> 
  <font color="#990000"><b> Nota:</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Si usted decide 
    cerrar esta ventana, dé clic al enlace "<span style="background-color:yellow" > 
    Regresar y editar lista</span>" regresar a la lista de pedido. </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> Quiero hacer el pedido ahora. ¿Que hago?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al enlace "<span style="background-color:yellow" > <img <?php echo createComIcon('../','arrow-blu.gif','0') ?>> 
    finalizar pedido </span>" para regresar 
    <?php if($x2=="pharma") print "pharmacy"; else print "medical depot"; ?>
    'al submenú.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> ¿Que hacer para crear otro pedido?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al enlace "<span style="background-color:yellow" > <img <?php echo createComIcon('../','arrow-blu.gif','0') ?>> 
    Crear una nueva lista de pedido </span>" para empezar con una canasta vacía.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> 
  <font color="#990000"><b> Nota:</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Usted puede detallar 
    las instrucciones en el pedido o el catálogo pulsando el botón <img <?php echo createComIcon('../','frage.gif','0') ?>> 
    dentro de la ventana. </font> 
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
  <?php if($src=="head") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  Como pedir 
  <?php if($x2=="pharma") print "pharmaceutical products"; 
						else print "products from the medical depot"; ?>
  ? </b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Crear 
    primero una lista de pedido. En el lado derecho usted verá el catálogo para 
    su departamento, pabellón, o sala.</font> 
    <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 2: 
      </b>Si el artículo que necesita está en la lista del catálogo, pulse el 
      botón <img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>> para 
      poner <b>la cantidad</b> de artículos en la (lista del pedido) a la izquierda.</font>
    <p> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> 
  <font color="#990000"><b> Nota:</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Usted puede detallar 
    las instrucciones en el pedido o el catálogo pulsando el botón <img <?php echo createComIcon('../','frage.gif','0') ?>> 
    dentro de la ventana. </font> 
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
  <?php if($src=="catalog") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  ¿Cómo poner un artículo en la canasta (lista de pedido)? </b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Si 
    el artículo que necesita está en la lista del catálogo, pulse el botón <img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>> 
    para poner <b>la cantidad</b> de artículos en la (lista del pedido) a la izquierda.</font> 
    <p> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> ¿Como poner mas de un artículo en la canasta de comprass?</b> 
  </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al selector 
    <input type="checkbox" name="a" value="a" checked>
    correspondiente al artículo en cuestion.<br>
    <b>Paso 2: </b>Escriba el numero de piezas en el campo. 
    <input type="text" name="d" size=2 maxlength=2>
    " orrespondiente al artículo .<br>
    <b>Paso 3: </b>Dé clic en el botón 
    <input type="button" value="Poner en la canasta">
    para poner el artículo en la canasta de compras.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> El artículo que necesito no está en la lista. ¿Que 
  hago?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Primero 
    debe encontrar el artículo. Escriba ya sea la información completa o las primeras 
    letras de la marca, o nombre genérico, código, etc. en el <nobr><span style="background-color:yellow" >" 
    campo de búsqueda: 
    <input type="text" name="s" size=10 maxlength=10>
    "</span></nobr> <br>
    <b>Paso 2: </b>Dé clic en el botón 
    <input type="button" value="Encontrar artículo">
    para encontrar el art&iacute;culo.<br>
    <b>Paso 3: </b>se encuentra el artículo que se aproxime a la palabra clave, 
    aparecerá un listado.<br>
    <b>Paso 4: </b>Si quiere poner un artículo en la canasta de compras, dé clic 
    al botón<img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>>. 
    El artículo sera puesto en la lista del pedido y a la vez será incluido al 
    catálogo.<br>
    <b>Paso 5: </b>Si solo quiere agregar el artículo al Catálogo, dé clic al 
    botón<img <?php echo createComIcon('../','dwnarrowgrnlrg.gif','0') ?>>.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> ¿Como puedo ver más información del artículo?</b> 
  </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>dé 
    clic, ya sea al botón <img <?php echo createComIcon('../','info3.gif','0') ?>> 
    o al nombre del artículo.<br>
    <b>Paso 2: </b>Aparecerá una ventana que le mostrará la información del artículo.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> ¿Como remuevo o borro un artículo del catálogo?</b> 
  </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic en el botón <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> 
    del art&iacute;culo.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  <?php if($src=="orderlist") : ?>
  <?php if($x1=="0") : ?>
  <img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> 
  Nota:</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Si la canasta 
    esta vacia. </font><font face="Verdana, Arial, Helvetica, sans-serif"> 
    <p><font size="2"> para crear un pedido, selecccione el artículo que necesita 
      del catálogo a la derecha y agr&eacute;guelo a la canasta de compras. </font></font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> ¿Cómo poner un artículo en la canasta (lista de pedido)? 
  </b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Si 
    el artículo que necesita está en la lista del catálogo, pulse el botón <img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>> 
    para poner la cantidad</b> de artículos en la (lista del pedido) a la izquierda.</font> 
    <p> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> 
  <font color="#990000"><b> Nota:</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Para mayores 
    instrucciones para buscar, seleccionar, y poner artículos del catálogo a la 
    canasta, haga clic en el botón <img <?php echo createComIcon('../','frage.gif','0') ?>> 
    dentro del catálogo a la derecha.</font> 
    <p> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php else : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  ¿Puedo cambiar la cantidad en la canasta de compras? </b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Yes.</b> Solo 
    reemplace el numero de piezas con el deseado después finalice la lista de 
    pedido. </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> ¿Como puedo ver más información del artículo?</b> 
  </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic, ya sea al botón <img <?php echo createComIcon('../','info3.gif','0') ?>> 
    del artículo.<br>
    <b>Paso 2: </b>Aparecerá una ventana que le mostrará la información del artículo.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> ¿Como remuevo un artículo de la canasta de compras?</b> 
  </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic en el botón <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> 
    del artículo.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> Ya están en la canasta todos los artículos que necesito. 
  ¿Cual es el siguiente paso?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Puede 
    proceder enviando el pedido a la Farmacia <br>
    Dé clic en el botón 
    <input name="button" type="button" value="Finalizar lista de pedido">
    para iniciar el proceso.<br>
    <b>Paso 2: </b>El pedido será desplegado de nuevo. Escriba su nombre en el 
    campo <nobr>"<span style="background-color:yellow" > Creado por 
    <input type="text" name="c" size=15 maxlength=10>
    </span>"</nobr> .<br>
    <b>Paso 3: </b>Seleccione el estatus de prioridad del pedido entre "<span style="background-color:yellow" > 
    Normal 
    <input type="radio" name="x" value="s" checked>
    Urgente 
    <input type="radio" name="x" >
    </span>". Seleccionando el botón apropiado<br>
    <b>Paso 4: </b>El validador (médico or cirujano) debe escribir su nombre en 
    el <nobr>"<span style="background-color:yellow" > campo Validado por 
    <input type="text" name="c" size=15 maxlength=10>
    </span>"</nobr> <br>
    <b>Paso 5: </b>El validador (médico or cirujano) debe escribir su <nobr>"<span style="background-color:yellow" > 
    Contrase&ntilde;a: 
    <input type="text" name="c" size=15 maxlength=10>
    </span>"</nobr> <br>
    <b>Paso 6: </b>Dé clic en el botón 
    <input name="button2" type="button" value="Enviar esta lista de pedido a la Farmacia">
    para enviar el pedido.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> 
  <font color="#990000"><b> Nota:</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Si usted decide 
    cerrar esta ventana, dé click al enlace "<span style="background-color:yellow" >Regresar 
    y editar la lista</span>" regresar a la lista de pedido. </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  <?php endif;?>
  <?php if($src=="final") : ?>
  <?php if($x1=="1") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  Quiero hacer el pedido ahora. ¿Que hago?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al enlace "<span style="background-color:yellow" > <img <?php echo createComIcon('../','arrow-blu.gif','0') ?>> 
    finalizar pedido </span>" para regresar al submenu.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> ¿Que hacer para crear otro pedido?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al enlace "<span style="background-color:yellow" > <img <?php echo createComIcon('../','arrow-blu.gif','0') ?>> 
    Crear una nueva lista de pedido </span>" para empezar con una canasta vacía.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php else : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> ¿Como finalizo el pedido?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Puede 
    proceder enviando el pedido a la Farmacia <br>
    Dé clic en el botón 
    <input name="button3" type="button" value="Finalizar lista de pedido">
    para iniciar el proceso.<br>
    <b>Paso 2: </b>El pedido será desplegado de nuevo. Escriba su nombre en el 
    campo <nobr>"<span style="background-color:yellow" > Creado por 
    <input type="text" name="c" size=15 maxlength=10>
    </span>"</nobr> .<br>
    <b>Paso 3: </b>Seleccione el estatus de prioridad del pedido entre "<span style="background-color:yellow" > 
    Normal 
    <input type="radio" name="x" value="s" checked>
    Urgente 
    <input type="radio" name="x" >
    </span>". Seleccionando el botón apropiado.<br>
    <b>Paso 4: </b>El validador (médico or cirujano) debe escribir su nombre en 
    el <nobr>"<span style="background-color:yellow" > campo Validado por 
    <input type="text" name="c" size=15 maxlength=10>
    </span>"</nobr> <br>
    <b>Paso 5: </b>El validador (médico or cirujano) debe escribir su <nobr>"<span style="background-color:yellow" >Contrase&ntilde;a</span><span style="background-color:yellow" >: 
    <input type="text" name="c" size=15 maxlength=10>
    </span>"</nobr> <br>
    <b>Paso 6: </b>Dé clic en el botón 
    <input type="button" value="Enviar esta lista de pedido a la Farmacia">
    para enviar el pedido.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> 
  <font color="#990000"><b> Nota:</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Si usted decide 
    cerrar dé clic al botón"<span style="background-color:yellow" > Regresar y 
    editar la lista</span>" para regresar al pedido. </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  <?php endif;?>
  <!-- ++++++++++++++++++++++++++++++++++ archive +++++++++++++++++++++++++++++++++++++++++++ -->
  <?php if($src=="arch") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Quiero 
  ver el archivo de pedidos.</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b> 
    Escriba ya sea la información completa o las primeras letras del departmento, 
    o id, fecha del pedido, prioridad("urgente") en el <nobr><span style="background-color:yellow" >" 
    campo de búsqueda: 
    <input type="text" name="s" size=10 maxlength=10>
    "</span></nobr> <br>
    <b>Paso 2: </b>Seleccione las siguientes categorias de búsqueda </font> 
    <ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
      <input type="checkbox" name="d" checked>
      Fecha<br>
      <input type="checkbox" name="d" checked>
      Departmento<br>
      <input type="checkbox" name="d" checked>
      Prioridad<br>
      Por defecto, las 3 categorias apareceran seleccionadas y la búsqueda se 
      har&aacute; en las 3 categorias. Asi que si quiere excluir alguna categoria 
      desmárquela. </font> 
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 3: </b>Dé 
    clic en el botón 
    <input type="button" value="Buscar">
    para encontrar el artículo.<br>
    <b>Paso 4: </b>Si la búsqueda encuentra el o los pedidos aproxuimados a la 
    búsqueda, aparecerá un listado.<br>
    <b>Paso 5: </b>Dé clic al botón del pedido que le interese ver <img <?php echo createComIcon('../','uparrowgrnlrg.gif','0') ?>>. 
    y se mostraran los detalles<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b>Fueron listados varios pedidos. ¿Como veo alguno en 
  particular?</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al botón del pedido<img <?php echo createComIcon('../','uparrowgrnlrg.gif','0') ?>>. 
    y se mostraran los detalles<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> 
  <font color="#990000"><b> Nota:</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Si usted decide 
    terminar la búsqueda y cerrar, dé clic al botón<img <?php echo createLDImgSrc('../','close2.gif','0') ?>>. 
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  <?php if($src=="archshow") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  Quiero ver más información sobre algun artículo en ese pedido. ¿Qué debo hacer?</b> 
  </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al botón <img <?php echo createComIcon('../','info3.gif','0') ?>> del 
    artículo<br>
    <b>Paso 2: </b>Y se desplegará una ventana mostrando la información<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> ¿Que hago para ver de nuevo la lista de pedidos archivados?</b> 
  </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al botón 
    <input type="button" value="Regresar">
    .<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b>¿Como buscar de nuevo en el archivo de pedidos?</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b> 
    Escriba ya sea la información completa o las primeras letras del departamento, 
    o id, fecha del pedido, prioridad ("urgente") en el <nobr><span style="background-color:yellow" >" 
    campo de búsqueda: 
    <input type="text" name="s" size=10 maxlength=10>
    "</span></nobr> <br>
    <b>Paso 2: </b>Seleccione las siguientes categorias de búsqueda </font> 
    <ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
      <input type="checkbox" name="d" checked>
      Fecha<br>
      <input type="checkbox" name="d" checked>
      Departmento<br>
      <input type="checkbox" name="d" checked>
      Prioridad<br>
      Por defecto, las 3 categorias apareceran seleccionadas y la búsqueda se 
      harça en las 3 categorias. Asi que si quiere excluir alguna categoria desm&aacute;rquela. 
      </font> 
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 3: </b>Dé 
    clic en el botón 
    <input type="button" value="Buscar">
    para encontrar el artículo.<br>
    <b>Paso 4: </b>Si la búsqueda encuentra el o los pedidos aproximados a la 
    búsqueda, aparecerá un listado.<br>
    <b>Paso 5: </b>Dé clic al botón del pedido que le interese ver <img <?php echo createComIcon('../','uparrowgrnlrg.gif','0') ?>>. 
    y se mostraran los detalles<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  <?php if($src=="db") : ?>
  <?php if($x1=="") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  ¿Cómo ingreso un producto nuevo en la base de datos?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Primero 
    escriba toda la información correspondiente al producto en sus campos correspondientes.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> ¿Como selecciono la fotografia del producto?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic en el botón 
    <input type="button" value="Explorar...">
    en el "<span style="background-color:yellow" > campo de archivo de fotografias 
    </span>" .<br>
    <b>Paso 2: </b>Aparecera una pequeña ventana para seleccionar el archivo. 
    Selecciona la fotografia que guste y da clic a "OK".<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> Ya ingrese toda la información, ¿como la guardo?</b> 
  </font></font> 
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
    clic al botón 
    <input type="button" value="Nuevo producto">
    .<br>
    <b>Paso 2: </b>Aparecera una forma.<br>
    <b>Paso 3: </b>Escriba toda la información relevante sobre el producto.<br>
    <b>Paso 4: </b>Dé clic en el botón 
    <input type="button" value="Salvar">
    para salvar la información<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> Como editar la información del producto ?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic en el botón 
    <input type="button" value="Actualizar o editar">
    .<br>
    <b>Paso 2: </b>Se desplegará una forma conteniendo la información actual del 
    producto.<br>
    <b>Paso 3: </b>Edite la información.<br>
    <b>Paso 4: </b>Dé clic en el botón 
    <input type="button" value="Salvar">
    para guardar la nueva información<br>
    </font><font face="Verdana, Arial, Helvetica, sans-serif"> </font> 
  </ul>
	
	<?php endif;?>	
<?php endif;?>	
</form>

