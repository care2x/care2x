<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<a name="howto">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b><?php echo "$x3" ?></b></font>
<form action="#" >
<p><font size=2 face="verdana,arial" > 
  <?php if($src=="main") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  &iquest;Como...?</b></font> 
  <ul type="disc">
    <li><a href="#cbp">Ingresar la temperatura o presión arterial.</a> 
    <li><a href="#movedate">Mover o cambiar la fecha en la gráfica</a> 
    <li><a href="#diet">Indicar una dieta.</a> 
    <li><a href="#allergy">Ingresar información de alergias.</a> 
    <li><a href="#diag">Ingresar el Diagnóstico principal o terapia.</a> 
    <li><a href="#daydiag">Ingresar informes diarios de diagnostico o indicaciones 
      de tratamiento.</a> 
    <li><a href="#extra">Escribir notas, diagnósticos extra, etc.</a> 
    <li><a href="#pt">Escribir indicaciones diarias de terapia fisica, ejercicios 
      antitrombosis, etc.</a> 
    <li><a href="#coag">Preescribir anticoagulantes.</a> 
    <li><a href="#daycoag">Informar de la aplicación diaria de anticoagulantes.</a> 
    <li><a href="#lot">Escribir notas en implantes, Numeros de lote, num de cargo, 
      etc.</a> 
    <li><a href="#med">Indicar medicamentos y dosis.</a> 
    <li><a href="#daymed">Informar de la aplicación diaria de medicamentos y dosis.</a> 
    <li><a href="#iv">Hacer indicaciones de medicamentos intravenosos.</a> 
  </ul>
  <hr>
  <a name="cbp"><img <?php echo createComIcon('../','frage.gif','0') ?>> </a></font>
  <p><font size=2 face="verdana,arial" ><font color="990000"><strong><font face="Verdana, Arial, Helvetica, sans-serif">¿Como 
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
        <input type="text" name="t2" size=5 maxlength=5 value="12.35">
        &nbsp;&nbsp; 
        <input type="text" name="u" size=8 maxlength=8 value="37.3">
        </font> 
    </ul>
    <ul >
      <font color="#000099" size=2 face="Verdana, Arial, Helvetica, sans-serif"><b>Tip:</b> 
      Para ingresar la hora actual, escriba "n" o "N" (significa NOW) en el campo 
      Hora. Aparecerá automaticamente la hora exacta actual en ese campo.</font> 
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 2: </b>Si 
    usted tiene varios datos, escribalos todos antes de salvar.<br>
    <b>Paso 3: </b>Dé clic en el botón <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> 
    para salvar los nuevos datos.<br>
    <b>Paso 4: </b>Si desea corregir algun error, haga clic en el dato erróneo, 
    reemplácelo con el correcto y sálvelo de nuevo.<br>
    <b>Paso 5: </b>Si ha terminado, dé clic al botón <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> 
    para cerrar la ventana y volver a la gráfica.</font>
  </ul>
  <p><font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> 
    Volver al inicio...?"</a></font> </p>
  <p><a name="movedate"><img <?php echo createComIcon('../','frage.gif','0') ?>></a><font color="990000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>¿Como 
    cambiar la fecha de la gráfica?</strong></font> </p>
  <ul>
    <li><font color="#660000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Para 
      moverse a un dia anterior:</b></font><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>
      <b>Paso 1: </b>Haga clic en el ícono <img <?php echo createComIcon('../','l_arrowgrnsm.gif','0') ?>>a 
      la <span style="background-color:yellow" >izquierda</span> de la columna 
      de fecha de la gráfica. </font> 
      <p> 
    <li><font color="#660000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Para 
      moverse al día siguiente:</b></font><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>
      <b>Paso 1: </b>Haga clic en el ícono <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0') ?>> 
      a la <span style="background-color:yellow" >derecha</span> de la columna 
      de fecha de la gráfica. </font> 
      <p> 
    <li><font color="#660000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Para 
      ir directamente a la fecha de inicio de la gráfica:</b></font><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>
      <b>Paso 1: </b>Dé clic al <span style="background-color:yellow" >botón derecho 
      del ratón</span> en el &iacute;cono<img <?php echo createComIcon('../','l_arrowgrnsm.gif','0') ?>> 
      a la <span style="background-color:yellow" >izquierda</span> de la columna 
      de fecha de la gráfica.<br>
      <b>Paso 2: </b>Haga clic en 
      <input type="button" value="OK">
      cuando le pida su confirmaci&oacute;n.<br>
      <b>Paso 3: </b>Una pequeña ventana aparecerá mostrando los campos para la 
      fecha de inicio<br>
      <b>Paso 4: </b>Seleccione día, mes y año.<br>
      <b>Paso 5: </b>Dé clic en el botón 
      <input type="button" value="Ir">
      para hacer el cambio.<br>
      Se cerrará la ventanita y la gráfica ajustará el cambio de fecha. </font> 
      <p> 
    <li><font color="#660000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Para 
      ir directamente a la &uacute;ltima fecha de la gráfica:</b></font><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>
      <b>Paso 1: </b>Dé clic al <span style="background-color:yellow" >botón derecho 
      del ratón</span> en el &iacute;cono<img <?php echo createComIcon('../','l_arrowgrnsm.gif','0') ?>> 
      a la <span style="background-color:yellow" >derecha</span> de la columna 
      de fecha de la gráfica.<br>
      <b>Paso 2: </b>Haga clic en 
      <input name="button" type="button" value="OK">
      cuando le pida su confirmaci&oacute;n.<br>
      <b>Paso 3: </b>Una pequeña ventana aparecerá mostrando los campos para la 
      fecha final<br>
      <b>Paso 4: </b>Seleccione día, mes y año.<br>
      <b>Paso 5: </b>Dé clic en el botón 
      <input name="button" type="button" value="Ir">
      para hacer el cambio.<br>
      Se cerrará la ventanita y la gráfica ajustará el cambio de fecha<br>
      </font><font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> 
      Volver al inicio...?"</a></font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><a name="diet"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  </a><font color="990000"><strong>¿Como ingresar un plan de dieta? </strong></font></font> 
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
    para cerrar la ventana y volver a la gráfica.</font>
  </ul>
  <p><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> </font><font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> 
    Volver al inicio...?"</a></font> </p>
  <p><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><a name="allergy"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
    </a></font><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><font color="990000"><strong>¿Como 
    ingresar información de Alergias?</strong></font></font></p>
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al &iacute;cono <img <?php echo createComIcon('../','clip.gif','0') ?>> 
    (clip) en el enlace"<span style="background-color:yellow" > Alergia</span>".<br>
    <b>Paso 2: </b>Una ventana aparecerá mostrando los campos de la informaci&oacute;n 
    de alergia.<br>
    <b>Paso 3: </b>Escriba la Alergia en el campo<br>
    "<span style="background-color:yellow" > Incorpore la nueva informaci&oacute;n 
    aqu&iacute;: </span>"<br>
    <b>Nota: </b>Puede editar también la información en el campo "<span style="background-color:yellow" > 
    Entradas actuales: </span>" de ser necesario.<br>
    <b>Nota: </b>Si desea cancelar, dé clic al botón<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
    <b>Paso 4: </b>Dé clic en el botón <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> 
    para salvar la informaci&oacute;n.<br>
    <b>Paso 5: </b>Si desea corregir algun error, haga clic en el dato erróneo, 
    reemplácelo con el correcto y sálvelo de nuevo..<br>
    <b>Paso 6: </b>Si ha terminado, dé clic al botón <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> 
    para cerrar la ventana y volver a la gráfica.<br>
    </font><font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> 
    Volver al inicio...?"</a></font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><a name="diag"><img <?php echo createComIcon('../','frage.gif','0') ?>></a></font><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><font color="990000"><strong>¿Como 
  ingresar el diagnostico principal y/o terapia?</strong></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al &iacute;cono <img <?php echo createComIcon('../','clip.gif','0') ?>> 
    (clip) en el enlace"<span style="background-color:yellow" > Diagnostico/Terapia</span>".<br>
    <b>Paso 2: </b>Una ventana aparecerá mostrando los campos de la informaci&oacute;n 
    de diagnostico/terapia.<br>
    <b>Paso 3: </b>Escriba la información del diagnostico o terapia en el campo<br>
    "<span style="background-color:yellow" > Incorpore la nueva informaci&oacute;n 
    aqu&iacute;: </span>".<br>
    <b>Nota: </b>Puede editar también la información en el campo "<span style="background-color:yellow" > 
    Entradas actuales: </span>" de ser necesario.<br>
    <b>Nota: </b>Si desea cancelar, dé clic al botón<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
    <b>Paso 4: </b>Dé clic en el botón <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> 
    para salvar la informaci&oacute;n.<br>
    <b>Paso 5: </b>Si desea corregir algun error, haga clic en el dato erróneo, 
    reemplácelo con el correcto y sálvelo de nuevo.<br>
    <b>Paso 6: </b>Si ha terminado, dé clic al botón <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> 
    para cerrar la ventana y volver a la gráfica.<br>
    </font><font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> 
    Volver al inicio...?"</a></font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><a name="daydiag"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  </a></font><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><font color="990000"><strong>¿Como 
  ingresar la información diaria de diagnosticos o plan de terapia? </strong></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic sobre la columna vac&iacute;a del d&iacute;a deseado junto a diagnostico/terapia.<br>
    <b>Paso 2: </b>Aparecer&aacute; una ventana mostrando los campos de entrada 
    para la informaci&oacute;n de diagnostico/terapia.<br>
    <b>Paso 3: </b>Escriba la información del diagnostico o terapia en el campo<br>
    "<span style="background-color:yellow" > Incorpore la nueva informaci&oacute;n 
    aqu&iacute;: </span>".<br>
    <b>Nota: </b>Puede editar también la información en el campo "<span style="background-color:yellow" > 
    Entradas actuales: </span>" de ser necesario.<br>
    <b>Nota: </b>Si desea cancelar, dé clic al botón<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
    <b>Paso 4: </b>Dé clic en el botón <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> 
    para salvar la informaci&oacute;n.<br>
    <b>Paso 5: </b>Si desea corregir algun error, haga clic en el dato erróneo, 
    reemplácelo con el correcto y sálvelo de nuevo.<br>
    <b>Paso 6: </b>Si ha terminado, dé clic al botón <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> 
    para cerrar la ventana y volver a la gráfica. </font> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>
    </font><font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> 
    Volver al inicio...?"</a></font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><a name="extra"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  </a></font><font color="990000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>¿Como 
  escribir Notas o diagnosticos Extras?</strong></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b><b> 
    </b>Dé clic al &iacute;cono <img <?php echo createComIcon('../','clip.gif','0') ?>> 
    (clip) en el enlace "<span style="background-color:yellow" > Notas, diagnosticos 
    extra </span>".<br>
    <b>Paso 2: </b>Aparecer&aacute; una ventana mostrando los campos de entrada 
    para la informaci&oacute;n de notas y diagn&oacute;sticos extra<br>
    <b>Paso 3: </b>Escriba las notas o diagnosticos extra en el campo<br>
    "<span style="background-color:yellow" > Incorpore la nueva informaci&oacute;n 
    aqu&iacute;: </span>".<br>
    <b>Nota: </b>Puede editar también la información en el campo "<span style="background-color:yellow" > 
    Entradas actuales: </span>" de ser necesario.<br>
    <b>Nota: </b>Si desea cancelar, dé clic al botón<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
    <b>Paso 4: </b>Dé clic en el botón <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> 
    para salvar la informaci&oacute;n.<br>
    <b>Paso 5: </b>Si desea corregir algun error, haga clic en el dato erróneo, 
    reemplácelo con el correcto y sálvelo de nuevo.<br>
    <b>Paso 6: </b>Si ha terminado, dé clic al botón <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> 
    para cerrar la ventana y volver a la gráfica. </font> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>
    </font><font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> 
    Volver al inicio...?"</a></font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><a name="pt"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  </a></font><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><font color="990000"><strong>¿Como 
  ingresar la información </strong></font><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><font color="990000"><strong>diaria</strong></font></font><font color="990000"><strong> 
  de terapia fisica , ejercicios antitrombosis, etc.<b>?</b></strong></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al enlace "<span style="background-color:yellow" > Pt,Atg,etc: </span>" 
    correspondiente a la fecha elegida.<br>
    <b>Paso 2: </b>Aparecer&aacute; una ventana mostrando los campos de entrada 
    para la fecha elegida.<br>
    <b>Paso 3: </b>Escriba la información en el campo<br>
    "<span style="background-color:yellow" > Incorpore la nueva informaci&oacute;n 
    aqu&iacute;: </span>".<br>
    <b>Nota: </b>Puede editar también la información en el campo "<span style="background-color:yellow" > 
    Entradas actuales: </span>" de ser necesario.<br>
    <b>Nota: </b>Si desea cancelar, dé clic al botón<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
    <b>Paso 4: </b>Dé clic en el botón <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> 
    para salvar la informaci&oacute;n.<br>
    <b>Paso 5: </b>Si desea corregir algun error, haga clic en el dato erróneo, 
    reemplácelo con el correcto y sálvelo de nuevo.<br>
    <b>Paso 6: </b>Si ha terminado, dé clic al botón <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> 
    para cerrar la ventana y volver a la gráfica. <br>
    </font><font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> 
    Volver al inicio...?"</a></font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><a name="coag"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  </a></font><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><font color="990000"><strong>&iquest;Como 
  indicar Anticoagulantes?</strong></font></font> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al &iacute;cono <img <?php echo createComIcon('../','clip.gif','0') ?>> 
    (clip) en el enlace "<span style="background-color:yellow" > Anticoagulantes</span>".<br>
    <b>Paso 2: </b>Aparecer&aacute; una ventana mostrando los campos de entrada 
    para anticoagulantes.<br>
    <b>Paso 3: </b>Escriba la información del anticoagulante y dosis en el campo<br>
    "<span style="background-color:yellow" > Incorpore la nueva informaci&oacute;n 
    aqu&iacute;: </span>".<br>
    <b>Nota: </b>Puede editar también la información en el campo "<span style="background-color:yellow" > 
    Entradas actuales: </span>" de ser necesario.<br>
    <b>Nota: </b>Si desea cancelar, dé clic al botón<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
    <b>Paso 4: </b>Dé clic en el botón <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> 
    para salvar la informaci&oacute;n.<br>
    <b>Paso 5: </b>Si desea corregir algun error, haga clic en el dato erróneo, 
    reemplácelo con el correcto y sálvelo de nuevo.<br>
    <b>Paso 6: </b>Si ha terminado, dé clic al botón <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> 
    para cerrar la ventana y volver a la gráfica. <br>
    </font><font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> 
    Volver al inicio...?"</a></font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><a name="daycoag"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  </a></font><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><font color="990000"><strong>¿Como 
  ingresar la información de la aplicación de anticoagulantes diarios?</strong></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic sobre la columna vac&iacute;a del d&iacute;a deseado junto a <strong>anticoagulantes</strong> 
    <br>
    <b>Paso 2: </b>Aparecer&aacute; una ventana mostrando los campos de entrada 
    para la aplicaci&oacute;n diaria de anticoagulantes.<br>
    <b>Paso 3: </b>Escriba la información del anticoagulante y dosis en el campo<br>
    "<span style="background-color:yellow" > Incorpore la nueva informaci&oacute;n 
    aqu&iacute;: </span>".<br>
    <b>Nota: </b>Puede editar también la información en el campo "<span style="background-color:yellow" > 
    Entradas actuales: </span>" de ser necesario.<br>
    <b>Nota: </b>Si desea cancelar, dé clic al botón<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
    <b>Paso 4: </b>Dé clic en el botón <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> 
    para salvar la informaci&oacute;n.<br>
    <b>Paso 5: </b>Si desea corregir algun error, haga clic en el dato erróneo, 
    reemplácelo con el correcto y sálvelo de nuevo.<br>
    <b>Paso 6: </b>Si ha terminado, dé clic al botón <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> 
    para cerrar la ventana y volver a la gráfica. <br>
    </font><font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> 
    Volver al inicio...?"</a></font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><a name="lot"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  </a></font><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><font color="990000"><strong>&iquest;Como 
  ingresar notas en implantes, Número de lote,Número de cargo, etc?</strong></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al &iacute;cono <img <?php echo createComIcon('../','clip.gif','0') ?>> 
    (clip) en el enlace "<span style="background-color:yellow" > Notas</span>".<br>
    <b>Paso 2: </b>Aparecer&aacute; una ventana mostrando los campos de entrada 
    para notas auxiliares.<br>
    <b>Paso 3: </b>Escriba la información en el campo<br>
    "<span style="background-color:yellow" > Incorpore la nueva informaci&oacute;n 
    aqu&iacute;: </span>".<br>
    <b>Nota: </b>Puede editar también la información en el campo "<span style="background-color:yellow" > 
    Entradas actuales: </span>" de ser necesario.<br>
    <b>Nota: </b>Si desea cancelar, dé clic al botón<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
    <b>Paso 4: </b>Dé clic en el botón <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> 
    para salvar la informaci&oacute;n.<br>
    <b>Paso 5: </b>Si desea corregir algun error, haga clic en el dato erróneo, 
    reemplácelo con el correcto y sálvelo de nuevo.<br>
    <b>Paso 6: </b>Si ha terminado, dé clic al botón <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> 
    para cerrar la ventana y volver a la gráfica<br>
    </font><font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> 
    Volver al inicio...?"</a></font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><a name="med"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  </a></font><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><a name="med"><font color="990000"><strong>&iquest;</strong></font></a><strong><font color="990000">Como 
  ingresar indicaciones de medicamentos y dosis?</font></strong></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al enlace "<span style="background-color:yellow" > Medicamento</span>".<br>
    <b>Paso 2: </b>Aparecer&aacute; una ventana mostrando los campos de entrada 
    para medicamentos y dosis.<br>
    <b>Paso 3: </b>Escriba la dosis en la columna de enmedio.<br>
    <b>Paso 4: </b>Seleccione el código de color del medicamento de ser necesario.<br>
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
    <b>Paso 5: </b>Escriba su nombre en el campo "<span style="background-color:yellow" > 
    Enfermera: </span>" .<br>
    <b>Nota: </b>Si desea cancelar, dé clic al botón<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
    <b>Paso 6: </b>Dé clic en el botón <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> 
    para salvar la informaci&oacute;n.<br>
    <b>Paso 7:</b> Si desea corregir algun error, haga clic en el dato erróneo, 
    reemplácelo con el correcto y sálvelo de nuevo.<br>
    <b>Paso 8: </b>Si ha terminado, dé clic al botón <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> 
    para cerrar la ventana y volver a la gráfica.</font><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>
    </font><font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> 
    Volver al inicio...?"</a></font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><a name="iv"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  </a></font><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><a name="med"><font color="990000"><strong>&iquest;</strong></font></a><strong><font color="990000">Como 
  ingresar la indicaci&oacute;n diaria de medicamentos intravenosos, su aplicaci&oacute;n 
  y dosis<b>?</b></font></strong></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>CDé 
    clic sobre la columna vac&iacute;a del d&iacute;a deseado junto a "<span style="background-color:yellow" > 
    Intravenosos</span>".<br>
    <b>Paso 2: </b>Aparecer&aacute; una ventana mostrando los campos de entrada 
    para la informaci&oacute;n diaria de intravenosos.<br>
    <b>Paso 3: </b>Escriba la dosis, información del aplicador, o simbolos de 
    inicio/fin en el campo "<span style="background-color:yellow" > Incorpore 
    la nueva informaci&oacute;n aqu&iacute;: </span>"<br>
    <b>Nota: </b>Si desea cancelar, dé clic al botón<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.<br>
    <b>Paso 4: </b>Dé clic en el botón <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> 
    para salvar la informaci&oacute;n.<br>
    <b>Paso 5: </b>Si desea corregir algun error, haga clic en el dato erróneo, 
    reemplácelo con el correcto y sálvelo de nuevo.<br>
    <b>Paso 6: </b>Si ha terminado, dé clic al botón <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> 
    para cerrar la ventana y volver a la gráfica. <br>
    </font><font color="#000099" size=1><a href="#howto"><img <?php echo createComIcon('../','arrow-t.gif','0') ?>> 
    Volver al inicio...?"</a></font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php elseif(($src=="")&&($x1=="template")) : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  &iquest;Qu&eacute; hacer cu&aacute;ndo la lista de hoy no se ha creado?</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>D&eacute; 
    clic en el bot&oacute;n 
    <input type="button" value="Mostrar la ultima lista">
    para encontrar la &uacute;ltima lista grabada. <br>
    <b>Paso 2: </b>Cuando se encuentra una lista grabada dentro de los &uacute;ltimos 
    31 d&iacute;as, se desplegar&aacute;<br>
    <b>Paso 3: </b>D&eacute; clic en el bot&oacute;n 
    <input type="button" value="Copiar esta lista para hoy.">
    <br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> No quiero ver la última lista de ocupación. ¿Cómo 
  crear una nueva lista?</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>D&eacute; 
    clic en el bot&oacute;n que corresponde al n&uacute;mero del cuarto y cama. 
    <br>
    <b>Paso 2: </b>Aparecer&aacute; una ventana para buscar al paciente.<br>
    <b>Paso 3: </b>Primero encuentre al paciente escribiendo una palabra de b&uacute;squeda 
    en uno de los campos.<br>
    Si quiere encontrar al paciente...</font> 
    <ul type="disc">
      <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">por su n&uacute;mero 
        paciente, escriba el n&uacute;mero en el campo<br>
        "<span style="background-color:yellow" >No. Paciente:</span> 
        <input type="text" name="t" size=19 maxlength=10 value="22000109">
        ". </font> 
      <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">por su Apellido, 
        escriba las primeras letras en el campo<br>
        "<span style="background-color:yellow" >Apellido:</span> 
        <input type="text" name="t" size=19 maxlength=10 value="Sánchez">
        ". </font> 
      <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">por su nombre, 
        escriba su nombre o las primeras letras en el campo<br>
        "<span style="background-color:yellow" >Nombre:</span> 
        <input type="text" name="t" size=19 maxlength=10 value="Juan">
        ". </font> 
      <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">por su fecha 
        de nacimiento, escriba la fecha o los numeros en el campo.<br>
        "<span style="background-color:yellow" >Fecha de nacimiento:</span> 
        <input type="text" name="t" size=19 maxlength=10 value="10.10.1966">
        ". </font> 
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 4: </b>Dé 
    clic en el botón <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> 
    para buscar al paciente..<br>
    <b>Paso 5: </b>Si la b&uacute;squeda encuentra uno o varios pacientes, se 
    desplegar&aacute; una lista.<br>
    <b>Paso 6: </b>Para seleccionar al paciente correcto, pulse el bot&oacute;n 
    <img <?php echo createComIcon('../','post_discussion.gif','0') ?>> correspondiente.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php elseif(($src=="getlast")&&($x1=="last")) : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  ¿Cómo copiar la última lista grabada a la lista de ocupación de hoy?</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>D&eacute; 
    clic en el bot&oacute;n 
    <input name="button2" type="button" value="Copiar esta lista para hoy.">
    para copiar la &uacute;ltima lista grabada. </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> Se despleg&oacute; la &uacute;ltima lista de ocupaci&oacute;n 
  pero no quiero copiarla. &iquest;Como crear una nueva lista?</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>D&eacute; 
    clic en el bot&oacute;n 
    <input type="button" value="No copiar! Crear una nueva lista.">
    para crear una nueva lista.</font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php elseif($src=="assign") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  &iquest;C&oacute;mo asignarle una cama a un paciente?</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Primero 
    encuentre al paciente escribiendo una palabra de b&uacute;squeda en uno de 
    los campos.<br>
    Si quiere encontrar al paciente...</font> 
    <ul type="disc">
      <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">por su n&uacute;mero 
        paciente, escriba el n&uacute;mero en el campo<br>
        "<span style="background-color:yellow" >No. Paciente:</span> 
        <input type="text" name="t3" size=19 maxlength=10 value="22000109">
        ". </font> 
      <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">por su Apellido, 
        escriba las primeras letras en el campo<br>
        "<span style="background-color:yellow" >Apellido:</span> 
        <input type="text" name="t3" size=19 maxlength=10 value="Sánchez">
        ". </font> 
      <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">por su nombre, 
        escriba su nombre o las primeras letras en el campo<br>
        "<span style="background-color:yellow" >Nombre:</span> 
        <input type="text" name="t3" size=19 maxlength=10 value="Juan">
        ". </font> 
      <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">por su fecha 
        de nacimiento, escriba la fecha o los numeros en el campo.<br>
        "<span style="background-color:yellow" >Fecha de nacimiento:</span> 
        <input type="text" name="t3" size=19 maxlength=10 value="10.10.1966">
        ". </font> 
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 2: </b>Dé 
    clic en el botón <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> 
    para buscar al paciente..<br>
    <b>Paso 3: </b>Si la b&uacute;squeda encuentra uno o varios pacientes, se 
    desplegar&aacute; una lista.<br>
    <b>Paso 4: </b>Para seleccionar al paciente correcto, pulse el bot&oacute;n 
    <img <?php echo createComIcon('../','post_discussion.gif','0') ?>> correspondiente.</font><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> &iquest;Como bloquear una cama?</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>D&eacute; 
    clic en "<span style="background-color:yellow" > <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> 
    <font color="#0000ff">bloquear esta cama</font> </span>".<br>
    <b>Paso 2: </b>Elija OK cuando le pidan confirmaci&oacute;n.</font>
  </ul>
  <p><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota: </b>Si 
    desea cancelar, dé clic al botón <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.</ul></font></p>
  <p><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
    <?php elseif($src=="remarks") : ?>
    <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
    &iquest;C&oacute;mo escribir comentarios o notas de un paciente? </b></font></font> 
  </p>
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>D&eacute; 
    clic en el campo de texto.<br>
    <b>Paso 2: </b>Teclee sus comentarios o notas<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> &iquest;C&oacute;mo salvar los comentarios o notas?</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic en el botón 
    <input type="button" value="Salvar">
    .</font> 
    <p> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> Ya salv&eacute; los comentarios. &iquest;C&oacute;mo 
  cerrar la ventana?</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic en el botón <img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle"> 
    para cerrar la ventana.</font> 
    <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
      <?php elseif($src=="discharge") : ?>
      <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
      &iquest;C&oacute;mo dar de Alta a un paciente?</b></font></font> 
  </ul>
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Seleccione 
    el tipo de alta.<br>
    </font><font face="Verdana, Arial, Helvetica, sans-serif"> 
    <ul>
      <font size="2"><br>
      <input type="radio" name="relart" value="reg" checked>
      Alta Regular <br>
      <input type="radio" name="relart" value="self">
      El Paciente dej&oacute; el hospital por su propio decisi&oacute;n<br>
      <input type="radio" name="relart" value="emgcy">
      Alta de Emergencia<br>
      <br>
      </font> 
    </ul>
    <font size="2"><b>Paso 2: </b>Escriba notas adicionales sobre el alta en el 
    campo "<span style="background-color:yellow" > Notas: </span>"si es pertinente. 
    <br>
    <b>Paso 3: </b>Teclee su nombre en el campo "<span style="background-color:yellow" > 
    Enfermera: 
    <input type="text" name="a" size=20 maxlength=20>
    </span>" si este est&aacute; vac&iacute;o. <br>
    <b>Paso 4: </b>Marque el campo" <span style="background-color:yellow" > 
    <input type="checkbox" name="d" value="d">
    Si, estoy seguro de dar de alta al paciente. </span>". <br>
    <b>Paso 5: </b>Dé clic en el botón 
    <input type="button" value="Alta">
    para dar de alta al paciente.</font></font> 
    <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 6: 
      </b>Dé clic en el botón <img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle"> 
      para volver a la nueva lista de ocupaci&oacute;n.</font> 
    <p> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> Ya intent&eacute; pulsar el bot&oacute;n
  <input type="button" value="Alta">
  pero no responde. &iquest;Por qu&eacute;?</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota: </b>La 
    caja debe estar marcada como se ve esta: <br>
    " <span style="background-color:yellow" > 
    <input type="checkbox" name="d" value="d" checked>
    </span></font><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><span style="background-color:yellow" > 
    Si, estoy seguro de dar de alta al paciente. </span></font></font><font size="2" face="Verdana, Arial, Helvetica, sans-serif">". 
    </font> 
    <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: 
      </b>Dé clic a la caja si no est&aacute; marcada.</font> 
    <p> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota: </b>Si 
  desea cancelar, dé clic al botón<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.</ul> 
  <?php endif;?>
  </font> 
</form>

