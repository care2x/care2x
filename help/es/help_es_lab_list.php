<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<font face="Verdana, Arial" size=3 color="#0000cc"> <b><?php echo "Laboratorio - $x3" ?></b></font> 
<form action="#" >
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php if($src=="") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  �Cómo hago aparecer la tabla gráfica para los parámetros de pruebas?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé clic 
    en la casilla para poner los vistos 
    <input type="checkbox" name="s" value="s" checked>
    correspondiente al parámetro que desea seleccionar.<br>
    <b>Paso 2: </b>Si usted desea mostrar varios parámetros a la vez, dé clic 
    en sus casillas correspondientes.<br>
    <b>Paso 3: </b>Dé clic en el ícono <img src="../img/chart.gif" width=16 height=17 border=0> 
    para mostrar la tabla gráfica.<br>
    </font>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> Deseo seleccionar todos los parámetros. �Existe una 
  forma rápida de seleccionarlos todos a la vez?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Sí la hay!</b><br>
    <b>Paso 1: </b>Dé clic en el botón <img <?php echo createComIcon('../','dwnarrowgrnlrg.gif','0') ?> border=0> 
    para seleccionar todos los parámetros.<br>
    </font>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> �Cómo borro todos los parámetros seleccionados?</b> 
  </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé clic 
    en el botón <img <?php echo createComIcon('../','dwnarrowgrnlrg.gif','0') ?> border=0> 
    nuevamente para BORRAR todos los parámetros previamente seleccionados.<br>
    </font>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
  <?php endif;?>
  <?php if($src=="graph") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>�Cómo 
  retorno a los resultados de las pruebas sin las tablas gráficas? </b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota: </b>Si usted desea 
    regresar, dé clic en el botón <img <?php echo createLDImgSrc('../','back2.gif','0','absmiddle') ?>>.</font>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
  <?php endif;?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>�Cómo 
  cierro la ventana de laboratorio?<?php echo $x3 ?>? </b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota: </b>Si usted desea 
    cerrar, dé clic en el botón <img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle">.</font>
</ul>


</form>

