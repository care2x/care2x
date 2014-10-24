<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<font face="Verdana, Arial" size=3 color="#0000cc"> <b> <font size="2" face="Verdana, Arial, Helvetica, sans-serif">Opciones 
de color 
<?php
	switch($src)
	{
	case "ext": print " - Extendido";
						break;
	 }
?>
</font></b></font> 
<form action="#" >
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php if($src=="") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  ¿Cómo seleccionar el color del fondo?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé clic 
    al enlace "<span style="background-color:yellow" > color de fondo <img src="../img/settings_tree.gif" border=0> 
    </span>" en el marco que desee cambiar.<br>
    <b>Paso 2: </b>Aparecera una ventana con una paleta de colores<br>
    <b>Paso 3: </b>Dé clic al color que desee como fondo.<br>
    <b>Paso 4: </b>Dé clic al botón 
    <input type="button" value="Aplicar">
    para fijar el color color.<br>
    <b>Paso 5: </b>Para terminar haga clic en el botón 
    <input type="button" value="OK">
    .<br>
    </font>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> ¿Como seleccionar el color del texto?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé clic 
    al enlace "<span style="background-color:yellow" > color de Texto</span>" 
    en el marco de arriba del enlace "<span style="background-color:yellow" > 
    Menu items </span>" en el marco de menu.<br>
    <b>Paso 2: </b>Aparecera una ventana con una paleta de colores.<br>
    <b>Paso 3: </b>Dé clic al color que desee para el texto.<br>
    <b>Paso 4: </b>Dé clic al botón 
    <input name="button" type="button" value="Aplicar">
    para fijar el color.<br>
    <b>Paso 5: </b>Para terminar haga clic en el botón 
    <input name="button2" type="button" value="OK">
    .<br>
    </font>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> Como seleccionar los colores de enlaces y mouse overs?</b> 
  </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 5: </b>Dé clic 
    al botón 
    <input type="button" value="Mas opciones de color">
    .<br>
    </font>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
  <?php endif;?>
  <?php if($src=="ext") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  Como seleccionar el color de enlace activo?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé clic 
    al enlace "<span style="background-color:yellow" > active link </span>" en 
    el marco que desee cambiar.<br>
    <b>Paso 2: </b>Aparecera una ventana con una paleta de colores.<br>
    <b>Paso 3: </b>Dé clic al color que desee para el enlace activo.<br>
    <b>Paso 4: </b>Dé clic al botón 
    <input name="button3" type="button" value="Aplicar">
    para fijar el color.<br>
    <b>Paso 5: </b>Para terminar haga clic en el botón 
    <input name="button22" type="button" value="OK">
    .<br>
    </font>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> Como seleccionar el color del enlace para el mouseover?</b> 
  </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé clic 
    al enlace "<span style="background-color:yellow" > hover link </span>" en 
    el marco que desee cambiar.<br>
    <b>Paso 2: </b>Aparecera una ventana con una paleta de colores.<br>
    <b>Paso 3: </b>Dé clic al color que desee para el enlace hover link.<br>
    <b>Paso 4: </b>Dé clic al botón 
    <input name="button32" type="button" value="Aplicar">
    para fijar el color.<br>
    <b>Paso 5: </b>Para terminar haga clic en el botón 
    <input name="button222" type="button" value="OK">
    .<br>
    </font>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
  <?php endif;?>
  </font> 
</form>

