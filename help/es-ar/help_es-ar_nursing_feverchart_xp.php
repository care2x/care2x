<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<a name="howto"> <font face="Verdana, Arial" size=3 color="#0000cc"> <b><?php echo "$x3" ?></b></font> 
<form action="#" >
  <p><font size=2 face="verdana,arial" > 
    <?php if($src=="bp_temp") : ?>
    <a name="cbp"><img <?php echo createComIcon('../','frage.gif','0') ?>></a><font color="990000"><strong><font face="Verdana, Arial, Helvetica, sans-serif">¿Como 
    ingresar la temperatura o presión arterial?</font></strong></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Escriba 
    fecha y hora.<br>
    </font> 
    <ul type="disc">
      <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Escriba 
        la hora y presión arterial en la columna izquierda "<font color="#cc0000">Presi&oacute;n 
        Arterial </font>".<br>
        Ejemplo: 
        <input type="text" name="v" size=5 maxlength=5 value="10.05">
        &nbsp;&nbsp; 
        <input type="text" name="w" size=8 maxlength=8 value="128/85">
        </font> 
      <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Escriba 
        la hora y temperatura en la columna derecha"<font color="#0000ff">Temperatura</font>".<br>
        Ejemplo: 
        <input type="text" name="t" size=5 maxlength=5 value="12.35">
        &nbsp;&nbsp; 
        <input type="text" name="u" size=8 maxlength=8 value="37.3">
        </font> 
    </ul>
  </ul>
  <blockquote>
    <p><font size=2 face="Verdana, Arial, Helvetica, sans-serif"><b>Tip:</b> Para 
      ingresar la hora actual, escriba "n" o "N" (significa NOW) en el campo Hora. 
      Aparecerá automaticamente la hora exacta actual en ese campo.</font> </p>
  </blockquote>
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 2: </b>Si 
    usted tiene varios datos, escribalos todos antes de salvar.<br>
    <b>Paso 3: </b>Dé clic en el botón <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> 
    para salvar los nuevos datos.<br>
    <b>Paso 4: </b>Si desea corregir algun error, haga clic en el dato erróneo, 
    reemplácelo con el correcto y sálvelo de nuevo.<br>
    <b>Paso 5: </b>Si ha terminado, dé clic al botón <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> 
    para cerrar la ventana y volver a la gráfica.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  <?php if($src=="diet") : ?>
  <a name="diet"><img <?php echo createComIcon('../','frage.gif','0') ?>> </a><font color="990000"><strong>¿Como 
  ingresar un plan de dieta? </strong></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Escriba 
    el plan de dieta en el campo <br>
    "<span style="background-color:yellow" > Incorpore la nueva información o 
    edite Aquí </span>".<br>
    <b>Paso 2: </b>Dé clic en el botón <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> 
    para salvar la informaci&oacute;n<br>
    <b>Nota: </b>Si desea cancelar, dé clic al botón<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
    <b>Paso 3: </b>Si quiere corregir errores, haga clic en el dato erróneo, reemplácelo 
    con el correcto y sálvelo de nuevo.<br>
    <b>Paso 4:</b> Si ha terminado, dé clic al botón <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> 
    para cerrar la ventana y volver a la gráfica.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  <?php if($src=="allergy") : ?>
  <a name="allergy"><img <?php echo createComIcon('../','frage.gif','0') ?>></a><font color="990000"><strong>¿Como 
  ingresar información de Alergias?</b></strong></font></font> <strong></strong> </font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Escriba 
    la Alergia en el campo<br>
    "<span style="background-color:yellow" > Incorpore la nueva informaci&oacute;n 
    aqu&iacute;: </span>".<br>
    <b>Nota: </b>Puede editar también la información en el campo "<span style="background-color:yellow" > 
    Entradas actuales: </span>" de ser necesario.<br>
    <b>Nota: </b>Si desea cancelar, dé clic al botón<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
    <b>Paso 2: </b>Dé clic en el botón <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> 
    para salvar la informaci&oacute;n.<br>
    <b>Paso 3: </b>Si desea corregir algun error, haga clic en el dato erróneo, 
    reemplácelo con el correcto y sálvelo de nuevo..<br>
    <b>Paso 4: </b>Si ha terminado, dé clic al botón <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> 
    para cerrar la ventana y volver a la gráfica.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  <?php if($src=="diag_ther") : ?>
  <a name="diag"><img <?php echo createComIcon('../','frage.gif','0') ?>></a><font color="990000"><strong>¿Como 
  ingresar el diagnostico principal y/o terapia?</strong></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Escriba 
    la información del diagnostico o terapia en el campo<br>
    "<span style="background-color:yellow" > Incorpore la nueva informaci&oacute;n 
    aqu&iacute;: </span>".<br>
    <b>Nota: </b>Puede editar también la información en el campo "<span style="background-color:yellow" > 
    Entradas actuales: </span>" de ser necesario.<br>
    <b>Nota: </b>Si desea cancelar, dé clic al botón<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
    <b>Paso 2: </b>Dé clic en el botón <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> 
    para salvar la informaci&oacute;n.<br>
    <b>Paso 3: </b>Si desea corregir algun error, haga clic en el dato erróneo, 
    reemplácelo con el correcto y sálvelo de nuevo.<br>
    <b>Paso 4: </b>Si ha terminado, dé clic al botón <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> 
    para cerrar la ventana y volver a la gráfica.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  <?php if($src=="diag_ther_dailyreport") : ?>
  <a name="daydiag"><img <?php echo createComIcon('../','frage.gif','0') ?>></a><font color="990000"><strong>¿Como 
  ingresar la información diaria de diagnosticos o plan de terapia? </strong></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1:</b>Escriba 
    la información del diagnostico o terapia en el campo<br>
    "<span style="background-color:yellow" > Incorpore la nueva informaci&oacute;n 
    aqu&iacute;: </span>".<br>
    <b>Nota: </b>Puede editar también la información en el campo "<span style="background-color:yellow" > 
    Entradas actuales: </span>" de ser necesario.<br>
    <b>Nota: </b>Si desea cancelar, dé clic al botón<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
    <b>Paso 2: </b>Dé clic en el botón <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> 
    para salvar la informaci&oacute;n.<br>
    <b>Paso 3: </b>Si desea corregir algun error, haga clic en el dato erróneo, 
    reemplácelo con el correcto y sálvelo de nuevo.<br>
    <b>Paso 4: </b>Si ha terminado, dé clic al botón <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> 
    para cerrar la ventana y volver a la gráfica. </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  <?php if($src=="xdiag_specials") : ?>
  <a name="extra"></a></font><font face="Verdana, Arial, Helvetica, sans-serif"><a name="extra"><a name="diag"><font size="2"><img <?php echo createComIcon('../','frage.gif','0') ?>></font></a></a></font><font color="990000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>¿Como 
  escribir Notas o diagnosticos Extras?</strong></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Escriba 
    las notas o diagnosticos extra en el campo<br>
    "<span style="background-color:yellow" > Incorpore la nueva informaci&oacute;n 
    aqu&iacute;: </span>".<br>
    <b>Nota: </b>Puede editar también la información en el campo "<span style="background-color:yellow" > 
    Entradas actuales: </span>" de ser necesario.<br>
    <b>Nota: </b>Si desea cancelar, dé clic al botón<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
    <b>Paso 2: </b>Dé clic en el botón <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> 
    para salvar la informaci&oacute;n.<br>
    <b>Paso 3: </b>Si desea corregir algun error, haga clic en el dato erróneo, 
    reemplácelo con el correcto y sálvelo de nuevo.<br>
    <b>Paso 4: </b>Si ha terminado, dé clic al botón <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> 
    para cerrar la ventana y volver a la gráfica. </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  <?php if($src=="kg_atg_etc") : ?>
  <a name="pt"><img <?php echo createComIcon('../','frage.gif','0') ?>></a><font color="990000"><strong>¿Como 
  ingresar la información </strong></font><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><font color="990000"><strong>diaria</strong></font></font><font color="990000"><strong> 
  de terapia fisica , ejercicios antitrombosis, etc.<b>?</b></strong></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Escriba 
    la información en el campo<br>
    "<span style="background-color:yellow" > Incorpore la nueva informaci&oacute;n 
    aqu&iacute;: </span>".<br>
    <b>Nota: </b>Puede editar también la información en el campo "<span style="background-color:yellow" > 
    Entradas actuales: </span>" de ser necesario.<br>
    <b>Nota: </b>Si desea cancelar, dé clic al botón<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
    <b>Paso 2: </b>Dé clic en el botón <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> 
    para salvar la informaci&oacute;n.<br>
    <b>Paso 3: </b>Si desea corregir algun error, haga clic en el dato erróneo, 
    reemplácelo con el correcto y sálvelo de nuevo.<br>
    <b>Paso 4: </b>Si ha terminado, dé clic al botón <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> 
    para cerrar la ventana y volver a la gráfica. </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  <?php if($src=="anticoag") : ?>
  <a name="coag"><img <?php echo createComIcon('../','frage.gif','0') ?>></a><font color="990000"><strong>&iquest;Como 
  indicar Anticoagulantes?</b></strong></font></font> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"></font> </font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>escriba 
    la información del anticoagulante y dosis en el campo<br>
    "<span style="background-color:yellow" > Incorpore la nueva informaci&oacute;n 
    aqu&iacute;: </span>".<br>
    <b>Nota: </b>Puede editar también la información en el campo "<span style="background-color:yellow" > 
    Entradas actuales: </span>" de ser necesario.<br>
    <b>Nota: </b>Si desea cancelar, dé clic al botón<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
    <b>Paso 2: </b>Dé clic en el botón <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> 
    para salvar la informaci&oacute;n.<br>
    <b>Paso 3: </b>Si desea corregir algun error, haga clic en el dato erróneo, 
    reemplácelo con el correcto y sálvelo de nuevo.<br>
    <b>Paso 4: </b>Si ha terminado, dé clic al botón <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> 
    para cerrar la ventana y volver a la gráfica. </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  <?php if($src=="anticoag_dailydose") : ?>
  <a name="daycoag"><img <?php echo createComIcon('../','frage.gif','0') ?>></a><font color="990000"><strong>¿Como 
  ingresar la información de la aplicación de anticoagulantes diarios?</strong></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Escriba 
    la dosis o la información del aplicador en el campo<br>
    "<span style="background-color:yellow" > Incorpore la nueva informaci&oacute;n 
    aqu&iacute;: </span>".<br>
    <b>Nota: </b>Si desea cancelar, dé clic al botón<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
    <b>Paso 2: </b>Dé clic en el botón <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> 
    para salvar la informaci&oacute;n.<br>
    <b>Paso 3: </b>Si desea corregir algun error, haga clic en el dato erróneo, 
    reemplácelo con el correcto y sálvelo de nuevo.<br>
    <b>Paso 4: </b>Si ha terminado, dé clic al botón <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> 
    para cerrar la ventana y volver a la gráfica. </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  <?php if($src=="lot_mat_etc") : ?>
  <a name="lot"><img <?php echo createComIcon('../','frage.gif','0') ?>></a><font color="990000"><strong>&iquest;Como 
  ingresar notas en implantes, Número de lote,Número de cargo, etc?</strong></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Escriba 
    la información en el campo<br>
    "<span style="background-color:yellow" > Incorpore la nueva informaci&oacute;n 
    aqu&iacute;: </span>".<br>
    <b>Nota: </b>Puede editar también la información en el campo "<span style="background-color:yellow" > 
    Entradas actuales: </span>" de ser necesario.<br>
    <b>Nota: </b>Si desea cancelar, dé clic al botón<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
    <b>Paso 2: </b>Dé clic en el botón <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> 
    para salvar la informaci&oacute;n.<br>
    <b>Paso 3: </b>Si desea corregir algun error, haga clic en el dato erróneo, 
    reemplácelo con el correcto y sálvelo de nuevo.<br>
    <b>Paso 4: </b>Si ha terminado, dé clic al botón <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> 
    para cerrar la ventana y volver a la gráfica.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  <?php if($src=="medication") : ?>
  <a name="med"><img <?php echo createComIcon('../','frage.gif','0') ?>><font color="990000"><strong>&iquest;</strong></font></a><strong><font color="990000">Como 
  ingresar indicaciones de medicamentos y dosis?</b></font></strong></font> </font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Escriba 
    el medicamento en la columna izquierda.<br>
    <b>Paso 2: </b>Escriba la dosis en la columna de enmedio.<br>
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
    para salvar la informaci&oacute;n.<br>
    <b>Paso 6:</b> Si desea corregir algun error, haga clic en el dato erróneo, 
    reemplácelo con el correcto y sálvelo de nuevo.<br>
    <b>Paso 7: </b>Si ha terminado, dé clic al botón <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> 
    para cerrar la ventana y volver a la gráfica.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  <?php if($src=="medication_dailydose") : ?>
  <?php if($x2) : ?>
  <a name="daymed"><img <?php echo createComIcon('../','frage.gif','0') ?>></a><a name="med"><font color="990000"><strong>&iquest;</strong></font></a><strong><font color="990000">Como 
  ingresar la indicaci&oacute;n diaria de medicamentos y dosis?</font></strong> 
  </font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al campo correspondiente al medicamento elegido.<br>
    <b>Paso 2: </b>Escriba la dosis, información del aplicador, o los simbolos 
    de inicio/fin en el campo.<br>
    <b>Nota: </b>Si desea cancelar, dé clic al botón<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
    <b>Paso 3: </b>Si tiene varios ingresos, escríbalos todos antes de salvar.<br>
    <b>Paso 4: </b>Dé clic en el botón <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> 
    para salvar la informaci&oacute;n.<br>
    <b>Paso 5: </b>Si desea corregir algun error, haga clic en el dato erróneo, 
    reemplácelo con el correcto y sálvelo de nuevo.<br>
    <b>Paso 6: </b>Si ha terminado, dé clic al botón <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> 
    para cerrar la ventana y volver a la gráfica.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php else : ?>
  <a name="daymed"><img <?php echo createComIcon('../','frage.gif','0') ?>></a><font color="990000"><strong>Dice, 
  " No hay medicamentos indicados". ¿Que hago?</b></strong></font></font> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"></font> </font> 
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
    para salvar la informaci&oacute;n.<br>
    <b>Paso 9: </b>Si desea corregir algun error, haga clic en el dato erróneo, 
    reemplácelo con el correcto y sálvelo de nuevo.<br>
    <b>Paso 10: </b>Si ha terminado, dé clic al botón <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> 
    para cerrar la ventana y volver a la gráfica.</font><br>
  </ul>
  <?php endif;?>
  <?php endif;?>
  <?php if($src=="iv_needle") : ?>
  <a name="iv"><img <?php echo createComIcon('../','frage.gif','0') ?>> </a><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><a name="med"><font color="990000"><strong>&iquest;</strong></font></a><strong><font color="990000">Como 
  ingresar la indicaci&oacute;n diaria de medicamentos intravenosos, su aplicaci&oacute;n 
  y dosis<b>?</b></font></strong></font> 
  <ul>
    <b>P<font size="2" face="Verdana, Arial, Helvetica, sans-serif">aso 1: </font></b><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Escriba 
    la dosis, información del aplicador, o simbolos de inicio/fin en el campo 
    "<span style="background-color:yellow" > Incorpore la nueva informaci&oacute;n 
    aqu&iacute;: </span>"<br>
    <b>Nota: </b>Si desea cancelar, dé clic al botón<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
    <b>Paso 2: </b>Dé clic en el botón <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> 
    para salvar la informaci&oacute;n.<br>
    <b>Paso 3: </b>Si desea corregir algun error, haga clic en el dato erróneo, 
    reemplácelo con el correcto y sálvelo de nuevo.<br>
    <b>Paso 4: </b>Si ha terminado, dé clic al botón <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> 
    para cerrar la ventana y volver a la gráfica. </font> 
  </ul>
  <?php endif;?>
</form>

