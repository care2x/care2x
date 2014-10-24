<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Cómo investigar en el archivo</b></font>
<form action="#" >
<p><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php if($src=="select") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Deseo 
  actualizar los datos mostrados</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso : </b>Dé 
    clic en el botón 
    <input type="button" value="Actualizar">
    para empezar a editar los datos.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b>Deseo hacer una búsqueda nueva en los archivos</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso : </b>Dé 
    clic en el botón 
    <input type="button" value="Nueva búsqueda en el archivo">
    para empezar una nueva búsqueda.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php elseif($src=="search") : ?>
  <b>Nota</b> </font><font face="Verdana, Arial, Helvetica, sans-serif">
  <ul>
    <font size="2"> Si la búsqueda halla un solo resultado, la información completa 
    se mostrará inmediatamente.<br>
    Sin embargo, si la búsqueda encuentra varios resultados posibles, se mostrará 
    una lista.<br>
    Para ver la información del paciente que busca, dé clic ya sea en el botón 
    <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> correspondiente, 
    o el nombre, el apellido o la fecha de admisión. </font>
  </ul>
  <font size="2"><b>Nota</b> 
  <ul>
    Si usted desea iniciar una nueva búsqueda, dé clic en el botón 
    <input type="button" value="Nueva búsqueda en el archivo">
    . 
  </ul>
  <?php else : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Deseo 
  ver una lista con todos los pacientes admitidos el día de hoy</b></font></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Ingrese 
    la fecha de hoy en el campo "Fecha de admisión: desde:". <br>
    </font> 
    <ul>
      <font color="#000099" size=2 face="Verdana, Arial, Helvetica, sans-serif"> 
      <b>Tip:</b> Escriba "H" o "h" para que la máquina escriba automáticamente 
      el día de hoy.<br>
      </font> 
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 2: </b>Deje 
    el campo "hasta:" vacío.<br>
    <b>Paso 3: </b>Dé clic en el botón 
    <input type="button" value="BUSCAR">
    para empezar la búsqueda.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b>Deseo ver la lista de todos los pacientes ingresados 
  en un periodo de dos días</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Escriba 
    el primer día en el campo "Fecha de admisión: desde:". <br>
    </font> 
    <ul>
      <font color="#000099" size=2 face="Verdana, Arial, Helvetica, sans-serif"> 
      <b>Tip:</b> Escriba "H" o "h" para que la máquina use el día de hoy.<br>
      <b>Tip:</b> Escriba "A" o "a" para que la máquina use el día de ayer.<br>
      </font> 
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 2: </b>Escriba 
    el último día en el campo "hasta:".<br>
    <b>Paso 3: </b>Dé clic en el botón 
    <input type="button" value="Buscar">
    para empezar la búsqueda.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b>Deseo ver una lista de todos los pacientes MASCULINOS 
  ingresados. </b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic en la opción "Género 
    <input type="radio" name="r" value="1">
    masculino". <br>
    <b>Paso 2: </b>Deje todos los demás campos vacíos o sin llenar.<br>
    <b>Paso 3: </b>Dé clic en el botón 
    <input type="button" value="BUSCAR">
    para empezar la búsqueda.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b>Deseo ver la lista de todas las pacientes FEMENINAS 
  ingresadas </b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic en la opción "Género 
    <input type="radio" name="r" value="1">
    femenino". <br>
    <b>Paso 2: </b>Deje todos los demás campos vacíos o sin llenar.<br>
    <b>Paso 3: </b>Dé clic en el botón 
    <input type="button" value="BUSCAR">
    para empezar la búsqueda.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b>Deseo ver la lista de todos los pacientes ambulatorios 
  ingresados</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic en la opción " 
    <input type="radio" name="r" value="1">
    Ambulatorio". <br>
    <b>Paso 2: </b>Deje todos los demás campos vacíos o sin llenar.<br>
    <b>Paso 3: </b>Dé clic en el botón 
    <input type="button" value="BUSCAR">
    para empezar la búsqueda.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b>Deseo ver la lista de todos los pacientes con admisión 
  estacionaria</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic en la opción " 
    <input type="radio" name="r" value="1">
    estacionaria". <br>
    <b>Paso 2: </b>Deje todos los demás campos vacíos o sin llenar.<br>
    <b>Paso 3: </b>Dé clic en el botón 
    <input type="button" value="BUSCAR">
    para empezar la búsqueda.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b>Deseo ver la lista de todos los pacientes que pagarán 
  su cuenta sin seguros</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic en la opción " 
    <input type="radio" name="r" value="1">
    Paga el paciente". <br>
    <b>Paso 2: </b>Deje todos los demás campos vacíos o sin llenar.<br>
    <b>Paso 3: </b>Dé clic en el botón 
    <input type="button" value="BUSCAR">
    para empezar la búsqueda.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b>Deseo ver la lista de todos los pacientes con seguro 
  privado</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic en la opción " 
    <input type="radio" name="r" value="1">
    seguro Privado". <br>
    <b>Paso 2: </b>Deje todos los demás campos vacíos o sin llenar.<br>
    <b>Paso 3: </b>Dé clic en el botón 
    <input type="button" value="BUSCAR">
    para empezar la búsqueda.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b>Deseo ver la lista de todos los pacientes con seguro 
  general</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé 
    clic en la opción " 
    <input type="radio" name="r" value="1">
    Aseguradora". <br>
    <b>Paso 2: </b>Deje todos los demás campos vacíos o sin llenar.<br>
    <b>Paso 3: </b>Dé clic en el botón 
    <input type="button" value="BUSCAR">
    para empezar la búsqueda.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b>Deseo ver la lista de todos los pacientes con un cierto 
  tipo de seguro</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Escriba 
    la abreviatura de la aseguradora en el campo "Aseguradora". <br>
    <b>Paso 2: </b>Deje todos los demás campos vacíos o sin llenar.<br>
    <b>Paso 3: </b>Dé clic en el botón 
    <input type="button" value="BUSCAR">
    para empezar la búsqueda.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b>Deseo ver la lista de todos los pacientes con una cierta 
  palabra en particular</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Escriba 
    la palabra clave en el campo correspondiente. Puede ser una palabra completa 
    o una frase o unas pocas letras de una palabra. <br>
    </font> 
    <ul>
      <font color="#000099" size=2 face="Verdana, Arial, Helvetica, sans-serif" > 
      <b>Ejemplo:</b> Para hallar un diagnóstico, escríbalo en el campo "Diagnóstico".<br>
      <b>Ejemplo:</b> Para hallar una recomendación, escríbalo en el campo "Recomendado 
      por".<br>
      <b>Ejemplo:</b> Para una palabra clave terapéutica, escríbala en el campo 
      "Terapia recomendada".<br>
      <b>Ejemplo:</b> Para hallar un apunte especial escríbalo en el campo "Apuntes 
      especiales".<br>
      </font> 
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 2: </b>Deje 
    todos los demás campos vacíos o sin llenar.<br>
    <b>Paso 3: </b>Dé clic en el botón 
    <input type="button" value="BUSCAR">
    para empezar la búsqueda.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b>Estoy buscando un paciente y una palabra clave en particular</b></font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Ingrese 
    la palabra clave en el campo correspondiente. Puede ser una palabra completa 
    o una frase o unas pocas letras de una palabra. <br>
    </font> 
    <ul>
      <font color="#000099" size=2 face="Verdana, Arial, Helvetica, sans-serif" > 
      <b>Los siguientes campos pueden ser buscados con palabras completas o parciales:</b> 
      <br>
      Número de identificación del paciente <br>
      Apellido <br>
      Nombre <br>
      Fecha de nacimiento <br>
      Dirección </font> 
    </ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 2: </b>Deje 
    todos los demás campos vacíos o sin llenar.<br>
    <b>Paso 3: </b>Dé clic en el botón 
    <input type="button" value="BUSCAR">
    para empezar la búsqueda.<br>
    </font> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota</b> </font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Puede combinar 
    varias condiciones de búsqueda. Por ejemplo: Si usted desea una lista de todos 
    los pacientes MASCULINOS que fueron ingresados entre 10.12.1999 y 24.01.2001 
    inclusive:</font> 
    <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: 
      </b>Escriba "10.12.1999" en el campo "Fecha de admisión: desde:". <br>
      <b>Paso 2: </b>Escriba "24.01.2001 en el campo "hasta:".<br>
      <b>Paso 3: </b>Dé clic en la opción "Género 
      <input type="radio" name="r" value="1">
      masculino". <br>
      <b>Paso 4: </b>Dé clic en el botón 
      <input type="button" value="BUSCAR">
      para empezar la búsqueda.<br>
      </font>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota</b> </font><font face="Verdana, Arial, Helvetica, sans-serif">
  <ul>
    <font size="2"> Si la búsqueda halla un solo resultado, la información completa 
    se mostrará inmediatamente.<br>
    Sin embargo, si la búsqueda halla varios resultados, se mostrará una lista.<br>
    Para ver la información del paciente, dé clic ya sea en el botón <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> 
    correspondiente, o el nombre, o el apellido, o la fecha de admisión. </font>
  </ul>
  <font size="2">
  <?php endif;?>
  <b>Nota</b> </font>
  <ul>
    <font size="2"> Si desea cerrar esta ventana, dé clic en el botón 
    <input type="button" value="Cancelar">
    . </font> 
</ul>
</font></form>

