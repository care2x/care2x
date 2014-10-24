<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b><?php echo "Datos del paciente - $x3" ?></b></font>
<form action="#" >
<p><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
  <?php if($src=="") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>¿Qué 
  significan estas <img <?php echo createComIcon('../','colorcodebar3.gif','0') ?> > 
  barras de colores? </b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota: </b>Cada una de 
    estas barras de color, cuando se dejan "levantadas", representan cambios a 
    un documento en particular, una instrucción, un cambio, una consulta, etc.<br>
    El significado de un color puede establecerse para cada pabellón. <br>
    La serie de barras de color rosa a la derecha representan el tiempo aproximado 
    en que una instrucción se deberá llevar a cabo.<br>
    Por ejemplo: la sexta barra de color rosa significa la "6ta hora" o "6 en 
    punto de la mañana", la barra 22 significa las "22 horas" o las "10 en punto 
    de la noche". </font>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> ¿Qué son los siguientes botones?</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
    <input type="button" value="Tabla gráfica de fiebre">
    </font>
    <ul>
      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Esto abrirá la tabla 
      gráfica con la temperatura diaria del paciente. Usted puede escribir, editar 
      o eliminar los datos de fiebre y tensión arterial en la tabla.<br>
      Otros datos que se pueden editar son: </font>
      <ul type="disc">
        <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Alergias<br>
          </font>
        <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Plan de dieta alimentaria 
          diaria<br>
          </font>
        <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Diagnóstico principal 
          y terapia<br>
          </font>
        <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Diagnóstico diario 
          y terapia<br>
          </font>
        <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Apuntes, diagnósticos 
          adicionales<br>
          </font>
        <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Terapia física 
          (PT), Atg (Gimnasia anti-trombosis), etc.<br>
          </font>
        <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Anticoagulantes<br>
          </font>
        <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Documentación diaria 
          para los anticoagulantes<br>
          </font>
        <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Medicación intravenosa 
          y cambio de vendajes<br>
          </font>
        <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Documentación diaria 
          para la medicación intravenosa<br>
          </font>
        <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Apuntes<br>
          </font>
        <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Listado de medicación 
          (listado)<br>
          </font>
        <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Documentación diaria 
          para la medicación y dosis<br>
          </font>
      </ul>
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
    <input type="button" value="Reporte de enfermería">
    </font><font face="Verdana, Arial, Helvetica, sans-serif"><ul><font size="2">
      Esto abrirá el formulario de reporte de enfermería. Usted puede documentar 
      su actividad de enfermería, su efectividad, observaciones, consultas, o 
      recomendaciones, etc. 
    </font></ul>
    <font size="2"><input type="button" value="Directivas del médico">
    <ul>
      El médico a cargo ingresará aquí sus instrucciones, medicación, dosis, respuestas 
      a las consultas de la enfermera o instrucciones para cambios, etc. 
    </ul>
    <input type="button" value="Reportes diagnósticos">
    <ul>
      Esto almacena los reportes diagnósticos provenientes de las diferentes áreas 
      clínicas o departamentos diagnósticos. 
    </ul>
    <input type="button" value="Datos fuente">
    <ul>
      Esto almacena los datos fuente de los pacientes e información personal tales 
      como nombre, apellido, etc. Esta también es la documentación inicial de 
      la anamnesis o antecedentes clínicos del paciente, que sirve como fundamento 
      para el plan individual de enfermería. 
    </ul>
    <input type="button" value="Plan de enfermería">
    <ul>
      Este es el plan individual de enfermería. Usted puede crear, editar o borrar 
      el plan. 
    </ul>
    <input type="button" value="Reportes de laboratorio">
    <ul>
      Esto almacena tanto los reportes de laboratorio clínico y de patología. 
    </ul>
    <input type="button" value="Fotos">
    <ul>
      Esto abre el catálogo de fotografías del paciente. 
    </ul>
    </font></font>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> ¿Cuál es la función de esta casilla de selección </b>	
  <select name="d">
    <option value="">Seleccione el pedido para prueba diagnóstica</option>
  </select>
  ? </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota: </b>Esto seleccionará 
    el formulario de pedidos para una prueba diagnóstica en particular.<br>
    <b>Paso 1: </b>Dé clic en 
    <select name="d">
      <option value="">Seleccione el pedido para prueba diagnóstica</option>
    </select>
    <br>
    <b>Paso 2: </b>Dé clic en la clínica, departamento o prueba diagnóstica escogida.<br>
    <b>Paso 3: </b>El formulario de pedidos se abrirá automáticamente.<br>
    </font>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
  <?php endif;?>
  <?php if($src=="labor") : ?>
  <img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b>No 
  existe un reporte de laboratorio disponible al momento. </b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Dé clic en el botón 
    <input type="button" value="OK">
    para volver a la carpeta de datos del paciente.</font>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
  <?php else  : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>¿Cómo 
  cierro la carpeta de datos del paciente? </b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota: </b>Si usted desea 
    cerrar esta ventana, dé clic en el botón <img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle">.</font>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
  <?php endif;?>
  </font> 
</form>

