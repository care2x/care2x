<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<font color="#0000cc"> <b> 
<?php if($x1=="docs") print "Doctor's directives"; else print "Nursing report"; ?>
</b></font> 
<form action="#" >
  <p><font size=2 face="Verdana, Arial, Helvetica, sans-serif" > 
  <?php if($src=="") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  �Como ingresar una 
  <?php if($x1=="docs") print "doctor's directive"; else print "nursing report"; ?>
  ?</b></font> </font>
  <p><font size=2 face="verdana,arial" ><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 
    1: </b>Escriba la fecha en el campo "<span style="background-color:yellow" > 
    Fecha: 
    <input type="text" name="d" size=10 maxlength=10 value="10.10.2002">
    </span>" en la columna" 
    <?php if($x1=="docs") print "Doctor's directives"; else print "Nursing report"; ?>
    ".<br>
    </font> </font></p>
  <font color="#000099" size=2 face="Verdana, Arial, Helvetica, sans-serif"><b> 
  Tip:</b> Para ingresar la fecha actual, escriba "n" o "N" (significa NOW) en 
  el campo Fecha. Aparecerá automaticamente la fecha actual en ese campo.</font><font size=2 face="Verdana, Arial, Helvetica, sans-serif" > 
  </font><font size="2"> 
  <ul>
    <blockquote>
      <p><font size="2" face="Verdana, Arial, Helvetica, sans-serif">O dé 
        clic en el botón <img <?php echo createComIcon('../','arrow-t.gif','0') ?>> 
        junto al campo. Aparecerá automaticamente la fecha actual en ese campo 
        </font> </p>
      <p><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Para ingresar 
        la fecha de ayer, escriba en el campo de fecha "y" o "Y" (Significa Yesterday). 
        La fecha de ayer aparecerá automáticamente. <br>
        </font> </p>
    </blockquote>
  </ul>
  </font>
  <p><font size="2"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 
    2: </b>escriba la hora en el campo "<span style="background-color:yellow" > 
    Hora: 
    <input type="text" name="d" size=5 maxlength=5 value="10.35">
    </span>" en la columna" 
    <?php if($x1=="docs") print "Doctor's directives"; else print "Nursing report"; ?>
    ".<br>
    Tip: Para ingresar la hora actual, escriba &quot;n&quot; o &quot;N&quot; (significa 
    NOW) en el campo Hora. Aparecerá automaticamente la hora actual en 
    ese campo. </font> </font></p>
  <font size="2">
  <ul>
    <blockquote>
      <p><font size="2" face="Verdana, Arial, Helvetica, sans-serif">O dé 
        clic en el botón <img <?php echo createComIcon('../','arrow-t.gif','0') ?>> 
        junto al campo. Aparecerá automaticamente la fecha actual en ese campo. 
        <br>
        </font> </p>
    </blockquote>
  </ul>
  </font>
  <p><font size="2"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 
    3: </b>Escriba la 
    <?php if($x1=="docs") print "doctor's directive"; else print "nursing report"; ?>
    en el campo"<span style="background-color:yellow" > 
    <?php if($x1=="docs") print "Doctor's directives"; else print "Nursing report"; ?>
    : 
    <input type="text" name="d" size=10 maxlength=10 value="reporte de examen">
    </span>" .<br>
    <font color="#000099"> <b>Tips:</b> </font></font> </font></p>
  <font size="2">
  <ul>
    <blockquote>
      <p><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Seleccione 
        "<span style="background-color:yellow" > 
        <input type="checkbox" name="c" value="c">
        <img <?php echo createComIcon('../','warn.gif','0') ?>>Ubicar el simbolo 
        al principio. </span>", si desea que el simbolo <img <?php echo createComIcon('../','warn.gif','0') ?>> 
        aparezca al principio de 
        <?php if($x1=="docs") print "doctor's directive"; else print "nursing report"; ?>
        . </font> </p>
      <p><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Si desea 
        resaltar alguna parte del reporte 
        <?php if($x1=="docs") print "directive or"; ?>
        dé clic en el icono<img <?php echo createComIcon('../','hilite-s.gif','0') ?>> 
        antes de escribir la frase. para finalizar lo resaltado dé clic en el 
        icono <img <?php echo createComIcon('../','hilite-e.gif','0') ?>> despues 
        de escribir la última letra de lo subrayado. </font> </p>
    </blockquote>
  </ul>
  </font>
  <p><font size="2"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 
    4: </b>Escriba sus Iniciales en el campo "<span style="background-color:yellow" > 
    Firma: 
    <input type="text" name="d" size=3 maxlength=3 value="ela">
    </span>".<br>
    <b>Nota: </b>Si desea cancelar dé clic al botón<img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.<br>
    <b>Paso 5: </b>Dé clic en el botón <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> 
    para salvar la información.<br>
    <b>Paso 6: </b>Si ya terminó, dé clic al botón<img <?php echo createLDImgSrc('../','close2.gif','0') ?>> 
    para cerrar la ventana y regresar al folder de cartas del paciente..<br>
    </font> </font></p>
  <font size="2"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"> <strong>Como ingresar 
  <?php if($x1=="docs") print "an inquiry to the physician"; else print "an effectivity report"; ?>
  ?</strong></font></font> </font>
  <p><font size="2"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Paso 
    1: </strong> </font> </font></p>
  <font size="2"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Escriba 
  la fecha en el campo "<span style="background-color:yellow" > Fecha: 
  <input type="text" name="d2" size=10 maxlength=10 value="10.10.2002">
  </span>" en la columna"</font> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php if($x1=="docs") print "Inquiries to the physician"; else print "Effectivity report"; ?>
  ".<br>
  <br>
  <font color="#000099"> <font color="#000099"><font color="#000000">Tip: Para 
  ingresar la fecha actual, escriba "t" o "T" (significa Today) en el campo Fecha. 
  Aparecerá automaticamente la fecha actual en ese campo.</font></font><font color="#000000"> 
  </font> </font></font></font>
  <p><font size="2"><font color="#000099" size=1><font color="#000000" size="2" face="Verdana, Arial, Helvetica, sans-serif">O 
    dé clic en el botón <img <?php echo createComIcon('../','arrow-t.gif','0') ?>> 
    junto al campo. Aparecerá automaticamente la fecha actual en ese campo </font> 
    </font></font></p>
  <p><font size="2"><font color="#000099" size=1><font color="#000000" size="2" face="Verdana, Arial, Helvetica, sans-serif">Para 
    ingresar la fecha de ayer, escriba en el campo de fecha "y" o "Y" (Significa 
    Yesterday). La fecha de ayer aparecerá automáticamente. </font> </font></font></p>
  <p><font size="2"><font color="#000099" size=1></font></font></p>
  <p><font size="2"><font color="#000099" size=1><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Paso 
    2:</strong> Escriba la 
    <?php if($x1=="docs") print "inquiry"; else print "effectivity report"; ?>
    en el campo"<span style="background-color:yellow" > 
    <?php if($x1=="docs") print "Inquiries to the physician"; else print "Effectivity report"; ?>
    : 
    <input type="text" name="d" size=10 maxlength=10 value="reporte de">
    </span>".<br>
    <b>Tips:</b></font> </font></font></p>
  <ul type=disc>
    <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Seleccione 
      "<span style="background-color:yellow" > 
      <input type="checkbox" name="c2" value="c">
      <img <?php echo createComIcon('../','warn.gif','0') ?>>Ubicar el simbolo 
      al principio. </span>", si desea que el simbolo <img <?php echo createComIcon('../','warn.gif','0') ?>> 
      aparezca al principio de 
      <?php if($x1=="docs") print "inquiry"; else print "effectivity report"; ?>
      . </font> 
    <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Si desea resaltar 
      alguna parte del reporte 
      <?php if($x1=="docs") print "directive or"; ?>
      dé clic en el icono<img <?php echo createComIcon('../','hilite-s.gif','0') ?>> 
      antes de escribir la frase. para finalizar lo resaltado dé clic en el icono 
      <img <?php echo createComIcon('../','hilite-e.gif','0') ?>> despues de escribir 
      la última letra de lo subrayado. </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 3: </b>Escriba 
  sus Iniciales en el campo "<span style="background-color:yellow" > Firma: 
  <input type="text" name="d3" size=3 maxlength=3 value="ela">
  </span>".<br>
  <b>Nota: </b>Si desea cancelar dé clic al botón<img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.<br>
  <b>Paso 4: </b>Dé clic en el botón <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> 
  para salvar la información.<br>
  <b>Paso 5: </b>Si ya terminó, dé clic al botón<img <?php echo createLDImgSrc('../','close2.gif','0') ?>> 
  para cerrar la ventana y regresar al folder de cartas del paciente..<br>
  <br></ul>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> NOTA: </font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Usted puede ingresar 
    ambos 
    <?php if($x1=="docs") print "doctor's directive and inquiries to the physician"; else print "nursing and effectivity report"; ?>
    a la vez. </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b> 
  <?php endif;?>
  <?php if($src=="diagnosis") : ?>
  <a name="extra"></a><a name="extra"></a></b><a name="extra"></a><a name="extra"></a><a name="extra"></a><a name="extra"></a><a name="extra"></a></font><font face="Verdana, Arial, Helvetica, sans-serif"><a name="extra"><a name="diag"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  </font></a></a><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b> 
  ¿Como mostrar un reporte diagnóstico?</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota: </b>Si 
    un reporte diagnóstico está disponible, se mostrará una nota corta de su fecha 
    de creación, diagnóstico clínico o departamento que lo creó.</font> 
    <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota: </b>Será 
      desplegado inmediatamente el primer reporte en la lista.</font> 
    <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: 
      </b>Haga clica en la nota del reporte diagnostico para desplegarlo.<br>
      </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  <?php if($src=="kg_atg_etc") : ?>
  <a name="pt"><img <?php echo createComIcon('../','frage.gif','0') ?>> </a></font><font color="990000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>�Como 
  ingresar la información </strong></font><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><font color="990000"><strong>diaria</strong></font></font><font color="990000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
  de terapia fisica , ejercicios antitrombosis, etc.</strong></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Escriba 
    la información en el campo<br>
    "<span style="background-color:yellow" > Incorpore la nueva información 
    aquí: </span>".<br>
    <b>Nota: </b>Puede editar también la información en el campo "<span style="background-color:yellow" > 
    Entradas actuales: </span>" de ser necesario.<br>
    <b>Nota: </b>Si desea cancelar, dé clic al botón<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
    <b>Paso 2: </b>Dé clic en el botón <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> 
    para salvar la información.<br>
    <b>Paso 3: </b>Si desea corregir algun error, haga clic en el dato erróneo, 
    reemplácelo con el correcto y sálvelo de nuevo.<br>
    <b>Paso 4: </b>Si ha terminado, dé clic al botón <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> 
    para cerrar la ventana y volver a la gráfica. </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  <?php if($src=="fotos") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="990000"><strong>�Como 
  previsualizar una foto? </strong></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Haga 
    clic en la imagen del lado izquierdo. Aparecerá la imagen grande a la derecha 
    incluyendo la fecha de toma y numero de foto.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  <?php if($src=="anticoag_dailydose") : ?>
  <a name="daycoag"><img <?php echo createComIcon('../','frage.gif','0') ?>> </a><font color="990000"><strong>�Como 
  ingresar la información de la aplicación de anticoagulantes diarios?</strong></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Escriba 
    la dosis o la información del aplicador en el campo<br>
    "<span style="background-color:yellow" > Incorpore la nueva información 
    aquí: </span>".<br>
    <b>Nota: </b>Si desea cancelar, dé clic al botón<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
    <b>Paso 2: </b>Dé clic en el botón <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> 
    para salvar la información.<br>
    <b>Paso 3: </b>Si desea corregir algun error, haga clic en el dato erróneo, 
    reemplácelo con el correcto y sálvelo de nuevo.<br>
    <b>Paso 4: </b>Si ha terminado, dé clic al botón <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> 
    para cerrar la ventana y volver a la gráfica.</font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>
  </font> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  <?php if($src=="lot_mat_etc") : ?>
  <a name="lot"><img <?php echo createComIcon('../','frage.gif','0') ?>> </a><font color="990000"><strong>¿Como 
  ingresar notas en implantes, Número de lote,Número de cargo, etc?</strong></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Escriba 
    la información en el campo<br>
    "<span style="background-color:yellow" > Incorpore la nueva información 
    aquí: </span>".<br>
    <b>Nota: </b>Puede editar también la información en el campo "<span style="background-color:yellow" > 
    Entradas actuales: </span>" de ser necesario.<br>
    <b>Nota: </b>Si desea cancelar, dé clic al botón<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
    <b>Paso 2: </b>Dé clic en el botón <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> 
    para salvar la información.<br>
    <b>Paso 3: </b>Si desea corregir algun error, haga clic en el dato erróneo, 
    reemplácelo con el correcto y sálvelo de nuevo.<br>
    <b>Paso 4: </b>Si ha terminado, dé clic al botón <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> 
    para cerrar la ventana y volver a la gráfica.</font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>
  </font> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  <?php if($src=="medication") : ?>
  <a name="med"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b><font color="990000"><strong>¿</strong></font></a><strong><font color="990000">Como 
  ingresar indicaciones de medicamentos y dosis?</font></strong></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Escriba 
    el medicamento en la columna izquierda.<br>
    <b>Paso 2: </b>escriba la dosis en la columna de enmedio.<br>
    <b>Paso 3: </b>Seleccione el código de color del medicamento de ser necesario.<br>
    </font> 
    <ul type=disc>
      <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Blanco para 
        normales. </font> 
      <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><span style="background-color:#00ff00" >Green</span> 
        para antibioticos o similares. </font> 
      <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><span style="background-color:yellow" >Yellow</span> 
        para medicamentos dialiticos. </font> 
      <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><span style="background-color:#0099ff" >Blue</span> 
        para medicamentos hemoliticos(anticoagulantes o coagulantes). </font> 
      <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><span style="background-color:#ff0000" >Red</span> 
        para medicamentos intravenosos. </font> 
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota: </b>Puede 
    editar también la información de ser necesario.<br>
    <b>Paso 4: </b>Escriba su nombre en el campo "<span style="background-color:yellow" > 
    Enfermera: </span>" .<br>
    <b>Nota: </b>Si desea cancelar, dé clic al botón<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
    <b>Paso 5: </b>Dé clic en el botón <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> 
    para salvar la información.<br>
    <b>Paso 6:</b> Si desea corregir algun error, haga clic en el dato erróneo, 
    reemplácelo con el correcto y sálvelo de nuevo.<br>
    <b>Paso 7: </b>Si ha terminado, dé clic al botón <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> 
    para cerrar la ventana y volver a la gráfica.</font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>
  </font> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  <?php if($src=="medication_dailydose") : ?>
  <?php if($x2) : ?>
  <a name="daymed"><img <?php echo createComIcon('../','frage.gif','0') ?>> </a><a name="med"><font color="990000"><strong>¿</strong></font></a><strong><font color="990000">Como 
  ingresar la indicación diaria de medicamentos y dosis?</font></strong> 
  </font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al campo correspondiente al medicamento elegido.<br>
    <b>Paso 2: </b>Escriba la dosis, información del aplicador, o los simbolos 
    de inicio/fin en el campo.<br>
    <b>Nota: </b>Si desea cancelar, dé clic al botón<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
    <b>Paso 3: </b>Si tiene varios ingresos, escríbalos todos antes de salvar.<br>
    <b>Paso 4: </b>Dé clic en el botón <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> 
    para salvar la información.<br>
    <b>Paso 5: </b>Si desea corregir algun error, haga clic en el dato erróneo, 
    reemplácelo con el correcto y sálvelo de nuevo.<br>
    <b>Paso 6: </b>Si ha terminado, dé clic al botón <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> 
    para cerrar la ventana y volver a la gráfica.</font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php else : ?>
  <a name="daymed"><img <?php echo createComIcon('../','frage.gif','0') ?>> </a><font color="990000"><strong>Dice, 
  " No hay medicamentos indicados". �Que hago?</strong></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic en el botón <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> 
    para cerrar la ventana y volver a la gráfica .<br>
    <b>Paso 2: </b>Dé clic al enlace "<span style="background-color:yellow" > 
    Medicamento</span>".<br>
    <b>Paso 3: </b>Aparecerá una ventana mostrando los campos de entrada para 
    la indicación de medicamento y dosis.<br>
    <b>Paso 4: </b>Escriba el medicamento en la columna izquierda.<br>
    <b>Paso 5: </b>escriba la dosis en la columna central.<br>
    <b>Paso 6: </b>elija el codigo de color del medicamento de ser necesario.<br>
    </font> 
    <ul type=disc>
      <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Blanco para 
        normales. </font> 
      <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><span style="background-color:#00ff00" >Green</span> 
        para antibioticos o similares. </font> 
      <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><span style="background-color:yellow" >Yellow</span> 
        para medicamentos dialiticos. </font> 
      <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><span style="background-color:#0099ff" >Blue</span> 
        para medicamentos hemoliticos(anticoagulantes o coagulantes). </font> 
      <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><span style="background-color:#ff0000" >Red</span> 
        para medicamentos intravenosos. </font> 
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota: </b>De 
    ser necesario puede corregir lo ingresado.<br>
    <b>Paso 7: </b>Escriba su nombre en el campo "<span style="background-color:yellow" > 
    Enfermera: </span>" .<br>
    <b>Nota: </b>Si desea cancelar, dé clic al botón<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
    <b>Paso 8: </b>Dé clic en el botón <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> 
    para salvar la información.<br>
    <b>Paso 9: </b>Si desea corregir algun error, haga clic en el dato erróneo, 
    reemplácelo con el correcto y sálvelo de nuevo.<br>
    <b>Paso 10: </b>Si ha terminado, dé clic al botón <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> 
    para cerrar la ventana y volver a la gráfica.</font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>
  </font> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  <?php endif;?>
  <?php if($src=="iv_needle") : ?>
  <a name="iv"><img <?php echo createComIcon('../','frage.gif','0') ?>> </a><a name="med"><font color="990000"><strong>¿</strong></font></a><strong><font color="990000">Como 
  ingresar la indicación diaria de medicamentos intravenosos, su aplicación 
  y dosis<b>?</b></font></strong></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Escriba 
    la dosis, información del aplicador, o simbolos de inicio/fin en el campo 
    "<span style="background-color:yellow" > Incorpore la nueva información 
    aquí: </span>"<br>
    <b>Nota: </b>Si desea cancelar, dé clic al botón<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
    <b>Paso 2: </b>Dé clic en el botón <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> 
    para salvar la información.<br>
    <b>Paso 3: </b>Si desea corregir algun error, haga clic en el dato erróneo, 
    reemplácelo con el correcto y sálvelo de nuevo.<br>
    <b>Paso 4: </b>Si ha terminado, dé clic al botón <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> 
    para cerrar la ventana y volver a la gráfica. </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  </font> 
</form>

