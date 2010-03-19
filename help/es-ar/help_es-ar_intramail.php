<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
Email de la Intranet   
<?php
	switch($src)
	{
	case "pass": switch($x1)
						{
							case "": print "Log in";
												break;
							case "1": print "Registering a new user";
												break;
						}
						break;
	case "mail": switch($x1)
						{
							case "compose": print "Compose a new mail";
												break;
							case "listmail": print "Mail listing";
												break;
							case "sendmail": print "Mail sent";
												break;
						}
						break;
	case "read": print "Reading mail";
						break;
	case "address": print "Address book";
						break;

	}


 ?></b></font>
<p><font size=2 face="verdana,arial" >
<form action="#" >
  <?php if($src=="pass") : ?>
  <?php if($x1=="") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif">&iquest;Como accesar 
  el email de la intranet?</font></b> </font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Escriba 
    la direccion del email de la intranet (sin la parte @xxxxxx )en el campo <nobr>"<span style="background-color:yellow" > 
    Su email: </span>"</nobr>.<br>
    <b>Paso 2: </b>Seleccione la parte del dominio en el campo <nobr>"<span style="background-color:yellow" > 
    @ 
    <select name="d">
      <option value="Test Domain 1"> Test Domain 1</option>
      <option value="Test Domain 2"> Test Domain 2</option>
    </select>
    </span>"</nobr>.<br>
    <b>Paso 3: </b>Escriba su contrase&ntilde;aen el campo <nobr>"<span style="background-color:yellow" > 
    Contrase&ntilde;a: </span>"</nobr>..<br>
    <b>Paso 4: </b>Dé clic al bot&oacute;n 
    <input name="button" type="button" value="Accesar">
    para lograrlo.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> Aún no tengo email. ¿como lo obtengo?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al enlace "<span style="background-color:yellow" > El nuevo usuario puede 
    registrarse aqu&iacute;. <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0') ?>> 
    </span>" para abrir la forma de registro.<br>
    <b>Paso 2: </b>Para instrucciones adicionales, dé clic en el botón "Ayuda" 
    una vez que la forma se despleg&oacute;.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  <?php if($x1=="1") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  &iquest;Como registrarse?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Escriba 
    nombre y apellidos en el campo"<span style="background-color:yellow" > Nombre: 
    </span>".<br>
    <b>Paso 2: </b>Escriba el nombre de email que desee en el campo"<span style="background-color:yellow" > 
    Escoja una dirección de email: </span>". </font> 
    <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 3: 
      </b>Seleccione el dominio en el campo <nobr>"<span style="background-color:yellow" > 
      @ 
      <select name="d">
        <option value="Test Domain 1"> Test Domain 1</option>
        <option value="Test Domain 2"> Test Domain 2</option>
      </select>
      </span>"</nobr>.<br>
      <b>Paso 4: </b>Escriba el alias de su elección en el campo "<span style="background-color:yellow" > 
      Alias: </span>"<b>.</b> </font>
    <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 5: 
      </b>Escriba la contrase&ntilde;a de su elección en el campo"<span style="background-color:yellow" > 
      Escoja la contrase&ntilde;a: </span>" .<br>
      <b>Paso 6: </b>reescriba la contrase&ntilde;a en el campo "<span style="background-color:yellow" > 
      Reintroduzca la contrase&ntilde;a: </span>".<br>
      <b>Paso 3: </b>Dé clic al bot&oacute;n 
      <input type="button" value="Registrar">
      para registrarse.<br>
      </font>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  <?php endif;?>
  <?php if($src=="mail") : ?>
  <?php if($x1=="listmail") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  &iquest;Como abrir un correo?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic en cualquer parte del mail, remitente, receptor, asunto o fecha, o los 
    iconos <img src="../img/c-mail.gif" border=0 align="absmiddle"> o <img src="../img/o-mail.gif" border=0 align="absmiddle">.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> &iquest;Que significan los iconos <img src="../img/c-mail.gif" border=0 align="absmiddle"> 
  y <img src="../img/o-mail.gif" border=0 align="absmiddle"> ?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img src="../img/c-mail.gif" border=0 align="absmiddle"> 
    = Correo no leido. <br>
    <img src="../img/o-mail.gif" border=0 align="absmiddle"> = Correo le&iacute;do 
    o abierto. <br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> ¿Como borrar un correo?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Check 
    the mail's 
    <input type="checkbox" name="a" value="s" checked>
    checkbox to select it.<br>
    <b>Paso 2: </b>Dé clic al 
    <input type="button" value="Delete">
    button.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> ¿Como pasar de un folder a otro?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Solo 
    haga clic en el nombre del folder.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> ¿Como escribir un nuevo email?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al enlace"<span style="background-color:yellow" > Nuevo E-mail </span>".<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  <?php if($x1=="compose") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  ¿Como escribir un nuevo email?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Escriba 
    la direccion de email del receptor en el campo "<span style="background-color:yellow" > 
    Recipiente: </span>".<br>
    <b>Paso 2: </b>Si desea enviar este mismo correo a alguien mas escriba su 
    direcci&oacute;n en el campo "<span style="background-color:yellow" > (CC) 
    </span>" .<br>
    <b>Paso 3: </b>Si desea enviar este mismo correo a alguien mas (sin mostrar 
    su dirección) escriba su direcci&oacute;n en el campo "<span style="background-color:yellow" >(BCC) 
    </span>".<br>
    <b>Paso 4: </b>Escriba el asunto del mensaje en el campo "<span style="background-color:yellow" > 
    Asunto: </span>".<br>
    <b>Paso 5: </b>Ahora escriba su mensaje en el campo destinado para ello.<br>
    <b>Paso 6: </b>Dé clic al botón 
    <input type="button" value="Enviar">
    para enviar el correo.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> Si quiero guardar el correo como borrador ¿Como lo 
  hago??</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Escriba 
    su mensaje en el campo.<br>
    <b>Paso 2: </b>Después de escribir su mensaje, dé clic en el botón 
    <input type="button" value="Salvar como borrador">
    .<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> ¿Como usar direcciones de email directamende de mi 
  libreta de direcciones?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al bot&oacute;n 
    <input type="button" value="Mostrar todos">
    abajo de "Direccion Rápida"".<br>
    <b>Paso 2: </b>Aparecerá una ventana mostrando tu libreta de direcciones.<br>
    <b>Paso 3: </b>Seleccione la opción correspondiente al campo donde será copiada 
    </font> 
    <p> 
    <ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Click "Para 
      <input type="radio" name="t" value="a">
      " para copiarla al campo "Recipiente".<br>
      Click "CC 
      <input type="radio" name="t" value="a">
      " para copiarla al campo "CC".<br>
      Click "BCC 
      <input type="radio" name="t" value="a">
      " para copiarla al campo "BCC". </font> 
      <p> 
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> 
    <b>Nota:</b> si quiere reajustar la selección de clic al icono<img src="../img/redpfeil.gif" border=0>.<br>
    <img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <b>Nota:</b> 
    Puede seleccionar varias direcciones a la vez. </font> 
    <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 4: 
      </b>Dé clic al bot&oacute;n 
      <input type="button" value="Insertar">
      para copiar las direcciones seleccionadas al email.<br>
      <b>Paso 5: </b>Dé clic al bot&oacute;n"<span style="background-color:yellow" > 
      <img src="../img/l_arrowGrnSm.gif" border=0> Cerrar </span>" para cerrar 
      la ventana.<br>
      </font>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> ¿Para que sirve dirección rápida?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota: </b>Si 
    usted tiene direcciones guardadas en el cache "Dirección rápida", las primeras 
    5 serán listadas. </font> 
    <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: 
      </b>Primero haga clic en el campo donde quiere poner la direccion ("Recipiente" 
      o "CC" o "BCC").<br>
      <b>Paso 2: </b>Dé clic en la dirección deseada de la lista "Dirección rápida". 
      Esta dirección será copiada en el campo donde hizo clic previamente.<br>
      </font>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  <?php if(($x1=="sendmail")&&($x3=="1")) : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  ¿Como escribir un nuevo email?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al enlace "<span style="background-color:yellow" > New Email </span>".<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  <?php endif;?>
  <?php if($src=="read") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  ¿Como imprimo el correo?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al enlace "<span style="background-color:yellow" > Version impresa <img src="../img/bul_arrowGrnSm.gif" border=0></span>".<br>
    <b>Paso 2: </b>Aparecerá una versión formateada para imprimir.<br>
    <b>Paso 3: </b>Dé clic a la opción "<span style="background-color:yellow" > 
    < Imprimir > </span>" para imprimirlo.<br>
    <b>Paso 4: </b>Aparecerá el menu de impresoras de Windows. Dé clic en el botón 
    "OK".<br>
    <b>Paso 5: </b>Para cerrar la ventana de impresión, de clic en la opción "<span style="background-color:yellow" > 
    < Cerrar > </span>".<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> ¿Como responder un correo?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al 
    <input type="button" value="Reenviar">
    .<br>
    <b>Paso 2: </b>Edite las direcciones de email de ser necesario.<br>
    <b>Paso 3: </b>Dé clic al botón 
    <input type="button" value="Enviar">
    para finalmente reenviar el email. </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> ¿Como reenviar el correo?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al botón 
    <input type="button" value="Reenviar">
    .<br>
    <b>Paso 2: </b>Escriba la direccion del receptor.<br>
    <b>Paso 3: </b>Dé clic al bot&oacute;n 
    <input type="button" value="Enviar">
    para finalmente enviar el email. </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> ¿Como borrar el email?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al boton 
    <input type="button" value="Borrar">
    .<br>
    <b>Paso 2: </b>Se le preguntará si realmente desea borrar el email.<br>
    <b>Paso 3: </b>Dé clic al bot&oacute;n 
    <input type="button" value="OK">
    para finalmente borrar el email. </font> 
    <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota:</b> 
      Los correos que son borrados de la "bandeja de entrada" son temporalmente 
      almacenados en la papelera de reciclaje. </font>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  <?php if($src=="address") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  ¿Como agregar una dirección de correo a la Libreta de direcciones?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al botón 
    <input type="button" value="Agregar nueva dirección">
    .<br>
    <b>Paso 2: </b>aparecerá una forma, Escriba el nombre en el campo "<span style="background-color:yellow" > 
    Nombre: </span>".<br>
    <b>Paso 3: </b>Escriba el alias en el campo "<span style="background-color:yellow" > 
    Alias: </span>".<br>
    <b>Paso 4: </b>Escriba la direccion de email en el campo "<span style="background-color:yellow" > 
    Email: </span>".<br>
    <b>Paso 5: </b>Seleccione el dominio en el campo <nobr>"<span style="background-color:yellow" > 
    @ 
    <select name="d">
      <option value="Test Domain 1"> Test Domain 1</option>
      <option value="Test Domain 2"> Test Domain 2</option>
    </select>
    </span>"</nobr>.<br>
    <b>Paso 6: </b>Dé clic al botón 
    <input type="button" value="Salvar">
    .<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> ¿Como borrar una dirección de la libreta de direcciones?</b> 
  </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Seleccione 
    <input type="checkbox" name="d" value="s" checked>
    la direccion que desee eliminar.<br>
    <b>Paso 2: </b>Dé clic al botón 
    <input type="button" value="Borrar">
    .<br>
    <b>Paso 3: </b>Te preguntará si realmente quiere borrar el email.<br>
    <b>Paso 4: </b>Dé clic al botón 
    <input type="button" value="OK">
    para eliminar finalmente la dirección.</font> 
    <p> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  <img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> 
  Nota:</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Los emails de 
    Intranet y las direcciones SOLAMENTE funcionan en la intranet y no pueden 
    usarse para la Internet.<br>
    </font><font face="Verdana, Arial, Helvetica, sans-serif"> </font> 
  </ul>
	</form>

