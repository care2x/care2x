<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
Radiología Rayos X - 
<?php

if($src=="search")
{
	print "Buscar un paciente";	
}

 ?>
 </b>
 </font>
<p><font size=2 face="verdana,arial" >
<form action="#" >
  <?php if($src=="search") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><b> 
  Cómo buscar un paciente?</b> </font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Ingrese 
    la palabra completa o las primeras letras del apellido del paciente o el número 
    del paciente, o el nombre del paciente en el campo. <br>
    <b>Paso 2: </b>Dé clic en el botón <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> 
    para que el computador inicie la búsqueda del paciente.</font> 
    <p> 
    <ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota: </b>Si 
      la búsqueda entrega un resultado, se mostrará una lista.</font>
    </ul>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> Cómo puedo previsualizar una radiografía del paciente 
  y su diagnóstico?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic en el hipervínculo o en el botón "<span style="background-color:yellow" > 
    <font color="#0000cc">Previsualizar/Diagnóstico</font> 
    <input type="radio" name="d" value="a">
    </span>".<br>
    Aparecerá una miniatura de la radiografía en el marco inferior izquierda.<br>
    El diagnóstico aparecerá en el marco inferior derecho.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> Cómo puedo ver toda la radiografía del paciente?</b> 
  </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic en el botón <img <?php echo createComIcon('../','torso.gif','0') ?>> 
    del paciente respectivo para pasar a la modalidad de pantalla completa.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> 
  <font color="#990000"><b> Nota:</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Si desea pasar 
    a la ventana anterior, dé clic en el botón <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>. 
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  </font> 
</form>

