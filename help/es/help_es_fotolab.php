<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<font face="Verdana, Arial" size=3 color="#0000cc"> <b> <font size="2" face="Verdana, Arial, Helvetica, sans-serif">Fotolab 
- 
<?php
	switch($src)
	{
	case "init": print "Initializing";
												break;
	case "input": print "Selecting photos for storage";
												break;
	case "maindata": print "Patient's data";
												break;
	case "save": print "Photos stored";
												break;

	}


 ?>
</font></b></font>
<form action="#" >
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
  <?php if($src=="input") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  Los campos fueron desplegados. �Que sigue?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic en el botón 
    <input type="button" value="Explorar...">
    Para encontrar el archivo de la fotografíaque quiere almacenar.<br>
    <b>Paso 2: </b>Aparecerá una ventana "Seleccionar archivo". Seleccione el 
    archivo que desea y haga clic en "Abrir"<br>
    <b>Paso 3: </b>Si el archivo que seleccionó es un formato válido, una vista 
    previa aparecerá en el marco superior derecho. De lo contrario, repita el 
    paso 1 y 2.<br>
    <b>Paso 4: </b>Escriba la fecha cuando fue tomada la foto en el campo "<span style="background-color:yellow" > 
    Fecha de toma</span>". </font> 
    <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img src="../img/warn.gif" border=0> 
      <b>Advertencia! </b>Esta fecha podría ser sobreescrita cuando usted selecciona 
      la funcion de fecha en los datos del paciente en el marco inferior derecho. 
      Tip: Si desea que conservarlo deje la fecha en blanco por el momento, despues 
      podra ingresar la fecha. </font> 
    <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 5: 
      </b>Escriba el numero de foto en el campo "<span style="background-color:yellow" > 
      Numero </span>". </font> 
    <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img src="../img/warn.gif" border=0> 
      <b>Advertencia! </b>Si desea que esta foto sea la foto principal del paciente, 
      escriba "principal" en lugar de un número. La foto principal aparecerá en 
      el folder de datos del paciente y los demás documentos. </font> 
    <p> <font color="#990000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>�Que 
      sigue?</strong></font> 
    <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 6: 
      </b>Encuentre los datos del paciente. Escriba el Número de identificación 
      del paciente en el campo "<span style="background-color:yellow" > Numero 
      de Paciente </span>".<br>
      <b>Paso 7: </b>Dé clic en el botón 
      <input type="button" value="Buscar">
      para encontrar al paciente.<br>
      <b>Paso 8: </b>Cuando encuentre al paciente, sus datos basicos aparecerán 
      en los campos correspondientes.<br>
      <b>Paso 9: </b>Si todas o la mayoría de las fotos fueron tomadas en la misma 
      fecha, escriba la fecha en el campo<nobr>"<span style="background-color:yellow" > 
      Fecha de toma </span>"</nobr>.<br>
      <b>Paso 10: </b>Dé clic en el botón <img src="../img/preset-add.gif" border=0 align="absmiddle"> 
      para ingresar esta fecha para todas las fotos. Esta fecha aparecerá para 
      todas las fotos en los campos"Fecha de toma" al lado izquierdo. </font> 
    <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img src="../img/warn.gif" border=0><b> 
      Advertencia! </b>Si una o más fotos pudieran tener fecha diferente, escribala 
      en el campo "Fecha de toma" de la foto correspondiente. Solo podra hacerlo 
      después de terminar el paso 10. </font> 
    <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 11: 
      </b>Dé clic en el botón 
      <input type="button" value="Salvar">
      para almacenar las fotos en la base de datos.<br>
      </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> �Como previsualizar la foto?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé clic 
    al botón <img src="../img/lilcamera.gif" border=0> correspondiente 
    a la foto.<br>
    </font>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> No puedo encontrar al paciente a través de su número 
  de paciente. �Puedo simplemente ingresar los datos y salvar las fotos? </b> 
  </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>No. </b>En esta versión 
    del programa no puede salvar fotos de un paciente cuando no tiene un numero 
    de paciente válido.<br>
    </font>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
  <?php endif;?>
  <?php if($src=="maindata") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  �Como encontrar los datos del paciente?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Escriba 
    el número de paciente en el campo"<span style="background-color:yellow" > 
    Número de paciente</span>".<br>
    <b>Paso 2: </b>Dé clic en el botón 
    <input type="button" value="Buscar">
    para encontrar al paciente.<br>
    <b>Paso 3: </b>Cuando sea encontrado el paciente, aparecerán sus datos básicos 
    en los campos correspondientes.<br>
    <b>Paso 4: </b>Si todas o la mayoría de las fotos fueron tomadas en la misma 
    fecha, escriba la fecha en el campo<nobr>"<span style="background-color:yellow" > 
    Fecha de toma</span>"</nobr>.<br>
    <b>Paso 5: </b>Dé clic en el botón <img src="../img/preset-add.gif" border=0 align="absmiddle"> 
    para ingresar esta fecha para todas las fotos. Esta fecha aparecerá para todas 
    las fotos en los campos"Fecha de toma" al lado izquierdo. </font> 
    <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img src="../img/warn.gif" border=0><strong>Advertencia!</strong> </b> 
      Si una o más fotos pudieran tener fecha diferente, escribala en el campo 
      "Fecha de toma" de la foto correspondiente. Solo podra hacerlo después 
      de terminar el paso 5. </font> 
    <p> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> No puedo encontrar al paciente a través de su número 
  de paciente. �Puedo simplemente ingresar los datos y salvar las fotos? </b> 
  </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>No. </b>En esta versión 
    del programa no puede salvar fotos de un paciente cuando no tiene un numero 
    de paciente válido.<br>
    </font>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
  <?php endif;?>
  <?php if($src=="save") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  �Como archivar fotos adicionales del mismo paciente?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Escriba 
    el numero de fotos adicionales que desea guardar en el campo <nobr>"Fotos 
    adicionales 
    <input type="text" name="g" size=3 maxlength=2>
    de el <span style="background-color:yellow" > mismo paciente. </span>"</nobr>.<br>
    <b>Paso 2: </b>Dé clic en el botón 
    <input type="button" value="Ir">
    .<br>
    </font>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> �Como almacenar fotos de otro paciente?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Escriba 
    el número de fotos que desee guardar en el campo<nobr>" 
    <input type="text" name="g" size=3 maxlength=2>
    fotos de <span style="background-color:yellow" > otro paciente. </span>"</nobr>.<br>
    <b>Paso 2: </b>Dé clic en el botón 
    <input type="button" value="Ir">
    .<br>
    </font>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
  <?php endif;?>
  <?php if($src=="init") : ?>
  <?php if($x1=="") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  �Como almacenar fotos en la base de datos?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Primero 
    inicialice. Escriba el numero de fotos que quiera guardar en el banco de datos.<br>
    <b>Paso 2: </b>Dé clic en el botón 
    <input type="button" value="OK Continúe...">
    .<br>
    <b>Paso 3: </b>Aparecerán los campos de fotos. Dé clic en el botón "ayuda" 
    para instrucciones adicionales.<br>
    </font>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
  <?php endif;?>
  <?php if($x1=="save") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  El nuevo derecho de acceso se salvó. �Como crear otro derecho de accesot?</b> 
  </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé clic 
    al botón 
    <input type="button" value="OK">
    .<br>
    <b>Paso 2: </b>Aparecerá la forma.<br>
    <b>Paso 3: </b>Para instrucciones adicionales para crear derechos de acceso, 
    haga clic en el botón "Ayuda".<br>
    </font>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> �Como puedo ver la lista de todos los derechos de 
  acceso?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic en el botón 
    <input type="button" value="Lista actual de derechos de acceso">
    .<br>
    <b>Paso 2: </b>Se mostrará la lista actual de derechos de acceso<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
  <?php endif;?>
  <?php if($x1=="list") : ?>
  </font><font face="Verdana, Arial, Helvetica, sans-serif">
  <p><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
    <font color="#990000"><b> Los botones <img <?php echo createComIcon('../','padlock.gif','0','absmiddle') ?>> 
    y<img <?php echo createComIcon('../','arrow-gr.gif','0','absmiddle') ?>> ¿que 
    significan y que hacen?</b> </font></font> <br>
    <font size="2"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','padlock.gif','0','absmiddle') ?>> 
    = Los derechos de acceso para este usuario están bloqueados o congelados. 
    No puede tener acceso a las areas a las que tenía acceso.<br>
    <img <?php echo createComIcon('../','arrow-gr.gif','0','absmiddle') ?>> = 
    El acceso de este usuario está libre. Podrá entrar a las areas permitidas 
    previamente para él.</font></p>
  </font> 
  <ul>
    <p><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>
      </font> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
      <font color="#990000"><b> Las opciones"C","L", and "D", or "U" </b></font></font><font color="#990000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>¿que 
      significan y que hacen?</b></font><font color="#990000"><b></b></font> 
    <ul>
      <p><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>C: </b> 
        = Cambiar o editar los datos de acceso del usuario.<br>
        <b>L: </b> = Cierra los derechos de acceso del usuario.<br>
        <b>D: </b> = Borra el acceso a ese usuario.<br>
        <b>U: </b> = Libera los derechos de acceso de un usuario (Actualmente 
        cerrados).</font></p>
      <p><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>
        </font> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>><font color="#990000"><b>�Como 
        cambiar o editar los datos de acceso del usuario?</b> </font></font> </p>
      <ul>
        <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Dé clic a 
        la opcion "<span style="background-color:yellow" > C </span>" correspondiente 
        al usuario.<br>
        </font> 
      </ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
      <font color="#990000"><b> �Como cerrar los derechos de acceso del usuario?</b> 
      </font></font> 
      <ul>
        <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Dé clic a 
        la opcion "<span style="background-color:yellow" > L</span>" correspondiente 
        al usuario.<br>
        <br>
        </font> 
      </ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
      <font color="#990000"><b> �Como Liberar los derechos de acceso de un usuario 
      (Actualmente cerrados)</b>? </font></font> 
      <ul>
        <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Dé clic a 
        la opcion "<span style="background-color:yellow" > U</span>" correspondiente 
        al usuario.<br>
        </font> 
      </ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
      <font color="#990000"><b> �Como borrar el acceso a ese usuario?</b> </font></font> 
      <ul>
        <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Dé clic a 
        la opcion "<span style="background-color:yellow" > D</span>" correspondiente 
        al usuario.<br>
        </font> 
      </ul>
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
    <?php endif;?>
    <?php if($x1=="update") : ?>
    <img <?php echo createComIcon('../','frage.gif','0') ?>> 
    <font color="#990000"><b> ¿Como editar algun derecho de acceso?</b> 
    </font></font> 
    <ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Edite 
      la información.<br>
      <b>Paso 2: </b>Dé clic en el botón 
      <input type="button" value="Salvar">
      .<br>
      </font> 
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> 
    <font color="#990000"><b> Nota:</b> </font></font> 
    <ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Si decide no 
      editar dé clic al botón 
      <input type="button" value="Cancelar">
      .<br>
      <br>
      </font> 
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  <?php if($x1=="lock") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  �Como borrar los derechos de acceso?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Si 
    usted esta seguro de borrarlo ,<br>
    dé clic al botón 
    <input type="button" value="Si, Estoy bien seguro. Borrar este derecho de acceso.">
    .<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> 
  <font color="#990000"><b> Nota:</b> </font></font> </font>
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
    Si decide no borrar dé clic al botón 
    <input type="button" value="Cancelar">
    .</font><br>
	</ul>
	<?php endif;?>		
<?php endif;?>	

	</form>

