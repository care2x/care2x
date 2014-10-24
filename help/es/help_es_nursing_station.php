<font face="Verdana, Arial" size=3 color="#0000cc"> <b><?php echo "$x3 - $x2" ?></b></font>
<form action="#" >
  <p><font size=2 face="verdana,arial" >
  <?php if((($src=="")&&($x1=="ja"))||(($src=="fresh")&&($x1=="template"))) : ?>
  
 <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
How to admit a patient from the waiting list?</b></font>
<ul> <b>Step 1: </b>Click the patient's name on the waiting list.<p>
<img src="../help/es/img/es_ambulatory_waitlist.png" border=0 >
                                                                     <p>
		<b>Step 2: </b>A pop-up window showing the ward's occupancy will appear.<br>
		<b>Step 3: </b>Click the <img <?php echo createLDImgSrc('../','assign_here.gif','0') ?>> button  of the bed to be assigned to the patient.<br>
</ul>

  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
  ¿Como asignar una cama a un paciente?</b></font></font> 
<ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic en el botón <img <?php echo createComIcon('../','plus2.gif','0') ?>> 
    correspondiente al número de cuarto y cama. <br>
    <b>Paso 2: </b>Aparecerá una ventana para buscar al paciente.<br>
    <b>Paso 3: </b>Primero encuentre al paciente escribiendo una palabra clave 
    en uno o varios de los campos.<br>
    Si quiere encontrar al paciente...</font> 
    <ul type="disc">
      <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">por su número 
        paciente, escriba el número en el campo<br>
        "<span style="background-color:yellow" >No. Paciente:</span> 
        <input type="text" name="t2" size=19 maxlength=10 value="22000109">
        ". </font> 
      <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">por su Apellido, 
        escriba las primeras letras en el campo<br>
        "<span style="background-color:yellow" >Apellido:</span> 
        <input type="text" name="t2" size=19 maxlength=10 value="Sánchez">
        ". </font> 
      <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">por su nombre, 
        escriba su nombre o las primeras letras en el campo<br>
        "<span style="background-color:yellow" >Nombre:</span> 
        <input type="text" name="t2" size=19 maxlength=10 value="Juan">
        ". </font> 
      <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">por su fecha 
        de nacimiento, escriba la fecha o los numeros en el campo.<br>
        "<span style="background-color:yellow" >Fecha de nacimiento:</span> 
        <input type="text" name="t2" size=19 maxlength=10 value="10.10.1966">
        ". </font> 
    </ul>
    <p><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 4: 
      </b>Dé clic en el botón <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> 
      para buscar al paciente..<br>
      <b>Paso 5: </b>Si la búsqueda encuentra uno o varios pacientes, se 
      desplegará una lista.<br>
      <b>Paso 6: </b>Para seleccionar al paciente correcto, pulse el botón 
      <img <?php echo createComIcon('../','post_discussion.gif','0') ?>> correspondiente.</font> 
    </p>
  </ul>

  <font face="Verdana, Arial" size=2>
<a name="open"></a>
<b>
  <p><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000">How to open the patient's charts?</font></b><p>
<font face="Verdana, Arial" size=2>
<ul>
<b>Step:</b> Click the colored bars to open the charts folder...<p>
<img src="../help/es/img/es_ambulatory_sbars.png" border=0 ><p>
<b>OR:</b> Click the <img <?php echo createComIcon($root_path,'open.gif','0'); ?>> icon to open the charts folder...<p>
<img src="../help/es/img/es_admission_folder.png" border=0>
</ul>
<a name="adata"></a>
<font face="Verdana, Arial" size=2>
<b>
<p><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000">How to display the admission data of a patient?</font></b><p>
<font face="Verdana, Arial" size=2>
<ul>
<b>Step:</b> Click the <img <?php echo createComIcon($root_path,'pdata.gif','0'); ?>> icon to display the admission data...<p>
<img src="../help/es/img/es_admission_listlink.png" border=0 ><p>
<b>OR:</b> Click the patient's family name to display the admission data.<p>
<img src="../help/es/img/es_ambulatory_name.png" border=0 >
</ul>

<a name="transfer"></a>
<font face="Verdana, Arial" size=2>
<b>
<p><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000">How to transfer a patient?</font></b><p>
<font face="Verdana, Arial" size=2>
<ul>
<b>Step:</b> Click the <img <?php echo createComIcon($root_path,'xchange.gif','0'); ?>> icon to open the transfer window.<p>
<img src="../help/es/img/es_admission_transfer.png" border=0>
</ul>


  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> �Como dar de ALTA un paciente desde la sala?</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic al botón</font> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','bestell.gif','0') ?>> 
    correspondiente al paciente. <br>
	<img src="../help/es/img/es_admission_discharge.png" border=0><p>
    <b>Paso 2: </b>Aparecerá la forma de alta del paciente..<br>
    <b>Paso 3: </b>Si está seguro de dar de alta al paciente, Marque el 
    campo "<span style="background-color:yellow" > 
    <input type="checkbox" name="d2" value="d">
    Si, estoy seguro de dar de alta el paciente. </span>" para activarlo.<br>
    <b>Paso 4: </b>Dé clic en el botón 
    <input name="button" type="button" value="Alta">
    para dar de alta al paciente.</font> 
    <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota: </b>Si 
      desea cancelar, dé clic al botón <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> 
      y el paciente no será dado de alta.<br>
      </font>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b>¿Como bloquear una cama?</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic en el botón <img <?php echo createComIcon('../','plus2.gif','0') ?>> 
    correspondiente al número de cuarto y cama. <br>
    <b>Paso 2: </b>Aparecerá una ventana para buscar al paciente.<br>
    <b>Paso 3: </b>Dé clic en "<span style="background-color:yellow" > 
    <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> <font color="#0000ff">bloquear 
    esta cama</font> </span>".<br>
    <b>Paso 4: </b>Elija OK cuando le pidan confirmación.</font> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>
    <b>Nota: </b>Si desea cancelar, dé clic al botón <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.</font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> Quiero borrar a un paciente de la lista</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota: </b>No 
    se puede simplemente borrar a un paciente de la lista. Para eliminar al paciente, 
    debes darlo de alta regularmente. Para hacerlo, siga las instrucciones de 
    como dar de alta un paciente.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b>¿Que significan estas barras de colores?<img <?php echo createComIcon('../','s_colorbar.gif','0') ?>> 
  </b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota: </b>Cada 
    una de esas barras cuando "se ven" señalan la disponibilidad de una 
    información en particular, una instrucción, a change, o una 
    cuestión, etc.<br>
    El significado de color puede definirse para cada sala. </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b>¿Que significa este icono <img <?php echo createComIcon('../','patdata.gif','0') ?>> 
  ? </b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota: </b>Este 
    es el botón de la carpeta de datos del paciente. Al pulsarlo despliega 
    la carpeta de datos del paciente. Hace aparecer una ventana mostrando la información 
    básica del paciente.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b>¿Que significa este icono <img <?php echo createComIcon('../','bubble2.gif','0') ?>> 
  ? </b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota: </b>Este 
    es el botón de Leer/Escribir Notas. Al pulsarlo hace aparecer una ventana 
    para leer y escribir noticias del paciente. <br>
    El ícono plano <img <?php echo createComIcon('../','bubble2.gif','0') ?>> 
    significa que no hay notas o comentarios actuales acerca del paciente. Para 
    escribir una nota o comentario haga clic en éste icono. El ícono 
    <img <?php echo createComIcon('../','bubble3.gif','0') ?>> significa que hay 
    notas o comentarios almacenados acerca del paciente. Para leerlos haga clic 
    en éste ícono. </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b>¿Que significa este icono <img <?php echo createComIcon('../','bestell.gif','0') ?>> 
  ? </b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota: </b>Este 
    es el botón de Alta para el paciente. Para dar de alta al paciente, 
    haga clic en éste y aparecerá la forma de alta del paciente<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php elseif(($src=="")&&($x1=="template")) : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  ¿Qué debería hacer cuando <span style="background-color:yellow" >no 
  ha sido creada la lista de hoy</span>?</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic en el botón 
    <input name="button2" type="button" value="Mostrar la ultima lista">
    para encontrar la última lista grabada. <br>
    <b>Paso 2: </b>Cuando se encuentra una lista grabada dentro de los últimos 
    31 días, se desplegará<br>
    <b>Paso 3: </b>Dé clic en el botón 
    <input name="button2" type="button" value="Copiar esta lista para hoy.">
    <br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b>No quiero ver la última lista de ocupación. �Cómo crear 
  una nueva lista?</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic en el botón que corresponde al número del cuarto y cama. 
    <br>
    <b>Paso 2: </b>Aparecerá una ventana para buscar al paciente.<br>
    <b>Paso 3: </b>Primero encuentre al paciente escribiendo una palabra de búsqueda 
    en uno de los campos.<br>
    Si quiere encontrar al paciente...</font> 
    <ul type="disc">
      <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">por su número 
        paciente, escriba el número en el campo<br>
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
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 4: </b>Dé 
    clic en el botón <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> 
    para buscar al paciente..<br>
    <b>Paso 5: </b>Si la búsqueda encuentra uno o varios pacientes, se 
    desplegará una lista.<br>
    <b>Paso 6: </b>Para seleccionar al paciente correcto, pulse el botón 
    <img <?php echo createComIcon('../','post_discussion.gif','0') ?>> correspondiente.</font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <button><img <?php echo createComIcon('../','post_discussion.gif','0') ?>></button>
  corresponding to it.<br>
  <?php elseif(($src=="getlast")&&($x1=="last")) : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>�Cómo 
  copiar la última lista grabada a la lista de ocupación de hoy?</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic en el botón 
    <input name="button22" type="button" value="Copiar esta lista para hoy.">
    para copiar la última lista grabada. </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b>Se desplegó la última lista de ocupación 
  pero no quiero copiarla. ¿Como crear una nueva lista?</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic en el botón 
    <input name="button3" type="button" value="No copiar! Crear una nueva lista.">
    para crear una nueva lista.</font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php elseif($src=="assign") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>¿Cómo 
  asignarle una cama a un paciente?</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Primero 
    encuentre al paciente escribiendo una palabra de búsqueda en uno de 
    los campos.<br>
    Si quiere encontrar al paciente...</font> 
    <ul type="disc">
      <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">por su número 
        paciente, escriba el número en el campo<br>
        "<span style="background-color:yellow" >No. Paciente:</span> 
        <input type="text" name="t32" size=19 maxlength=10 value="22000109">
        ". </font> 
      <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">por su Apellido, 
        escriba las primeras letras en el campo<br>
        "<span style="background-color:yellow" >Apellido:</span> 
        <input type="text" name="t32" size=19 maxlength=10 value="Sánchez">
        ". </font> 
      <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">por su nombre, 
        escriba su nombre o las primeras letras en el campo<br>
        "<span style="background-color:yellow" >Nombre:</span> 
        <input type="text" name="t32" size=19 maxlength=10 value="Juan">
        ". </font> 
      <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">por su fecha 
        de nacimiento, escriba la fecha o los numeros en el campo.<br>
        "<span style="background-color:yellow" >Fecha de nacimiento:</span> 
        <input type="text" name="t32" size=19 maxlength=10 value="10.10.1966">
        ". </font> 
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 2: </b>Dé 
    clic en el botón <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> 
    para buscar al paciente..<br>
    <b>Paso 3: </b>Si la búsqueda encuentra uno o varios pacientes, se 
    desplegará una lista.<br>
    <b>Paso 4: </b>Para seleccionar al paciente correcto, pulse el botón 
    <img <?php echo createComIcon('../','post_discussion.gif','0') ?>> correspondiente.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b>¿Como bloquear una cama?</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic en "<span style="background-color:yellow" > <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> 
    <font color="#0000ff">bloquear esta cama</font> </span>".<br>
    <b>Paso 2: </b>Elija OK cuando le pidan confirmación.</font> 
  </ul>
  <p><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota: </b>Si 
    desea cancelar, dé clic al botón <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.</font></p>
  <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
    <?php elseif($src=="remarks") : ?>
    <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>¿Cómo 
    escribir comentarios o notas de un paciente? </b></font></font> </p>
  <ul>
    <p><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: 
      </b>Dé clic en el campo de texto.<br>
      <b>Paso 2: </b>Teclee sus comentarios o notas</font></p>
    <p><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
      <font color="#990000"><b>Ya terminé de escribir ¿Cómo 
      salvar los comentarios o notas?</b></font></font> </p>
    <ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
      clic en el botón 
      <input name="button4" type="button" value="Salvar">
      .</font> 
    </ul>
  </ul>
  <ul>
    <p> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b>Ya salvé los comentarios. ¿Cómo 
  cerrar la ventana?</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic en el botón <img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle"> 
    para cerrar la ventana.</font> 
  </ul>
  <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php elseif($src=="discharge") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>¿Cómo 
  dar de Alta a un paciente?</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Seleccione 
    el tipo de alta.<br>
    </font> 
    <ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>
      <input type="radio" name="relart" value="reg" checked>
      Alta Regular <br>
      <input type="radio" name="relart" value="self">
      El Paciente dejó el hospital por su propio decisión<br>
      <input type="radio" name="relart" value="emgcy">
      Alta de Emergencia<br>
      <br>
      </font> 
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 2: </b>Escriba 
    notas adicionales sobre el alta en el campo "<span style="background-color:yellow" > 
    Notas: </span>"si es pertinente. <br>
    <b>Paso 3: </b>Teclee su nombre en el campo "<span style="background-color:yellow" > 
    Enfermera: 
    <input type="text" name="a" size=20 maxlength=20>
    </span>" si este está vacío. <br>
    <b>Paso 4: </b>Marque el campo" <span style="background-color:yellow" > 
    <input type="checkbox" name="d3" value="d">
    Si, estoy seguro de dar de alta al paciente. </span>". <br>
    <b>Paso 5: </b>Dé clic en el botón 
    <input name="button5" type="button" value="Alta">
    para dar de alta al paciente.</font> 
    <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 6: 
      </b>Dé clic en el botón <img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle"> 
      para volver a la nueva lista de ocupación.</font> 
  </ul>
  <ul>
    <p> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b>Ya intenté pulsar el botón 
  <input name="button6" type="button" value="Alta">
  pero no responde. ¿Por qué?</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota: </b>La 
    caja debe estar marcada como se ve esta: <br>
    " <span style="background-color:yellow" > 
    <input type="checkbox" name="d" value="d" checked>
    Si, estoy seguro de dar de alta al paciente. </span>". </font> 
    <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: 
      </b>Dé clic a la caja si no está marcada.</font> 
  </ul>
  <ul>
    <p> 
  </ul>
  <p><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota: </b>Si 
    desea cancelar, dé clic al botón<img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">.</ul></font></p>
  <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
    <?php endif;?>
    </font></p>
  <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
    <?php if(($src!="assign")&&($src!="remarks")&&($src!="discharge")) : ?>
    <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Que 
    significa esto "<span style="background-color:yellow" > <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> 
    <font color="#0000ff">Bloqueada</font> </span>"? </b></font></font> </p>
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota: </b>Significa 
    que la cama está asignada y no puede ser bloqueada para otro paciente. 
    Para desbloquearla, Dé clic en el botón "<font color="#990000"><b><span style="background-color:yellow" ><font color="#0000ff">Bloqueada</font></span></b></font>" 
    y elija OK cuando le pidan confirmar.<br>
    <b>Nota: </b>Dependiendo de la versión del programa o la configuración, 
    para desbloquear una cama requiere contraseña. </font> 
</ul>

<?php endif;?>
<a name="pic"></a>
<font face="Verdana, Arial" size=2>
<b>
<p><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000">How to show the patient's id photo?</font></b><p>
<font face="Verdana, Arial" size=2>
<ul>
<b>Step:</b> Click the <img <?php echo createComIcon($root_path,'spf.gif','0'); ?>> or  <img <?php echo createComIcon($root_path,'spm.gif','0'); ?>> icon.<p>
<img src="../help/es/img/es_ambulatory_sex.png" border=0 >
</ul>
</form>

