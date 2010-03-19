<font face="Verdana, Arial" size=3 color="#0000cc"> <b><?php echo $x1 ?></b></font>
<ul>
  <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
    <?php

if($x2=='show'||$src=='sickness'){
	if($x3){
?>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<font color="#990000"><b>How to display the registration data?</b></font>
<ul>
<b>Step: </b> Click the  <img <?php echo createLDImgSrc('../','reg_data.gif','0') ?>> button.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<font color="#990000"><b>How to display the admission data?</b></font>
<ul>
<b>Step: </b> Click the  <img <?php echo createLDImgSrc('../','admission_data.gif','0') ?>> button.<p>
<b>Note: </b> This button appears only when the person is currently admitted either as inpatient or outpatient.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<font color="#990000"><b>How to display the report?</b></font>
<ul> 
<b>Step: </b> Click the  <img <?php echo createComIcon('../','info3.gif','0') ?>> button.<p>
<b>Note: </b> This button appears only when the report data is not fully shown on the preview list.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
<font color="#990000"><b>How to generate a PDF document of the report?</b></font>
<ul>
<b>Step: </b> Click the  <img <?php echo createComIcon('../','pdf_icon.gif','0') ?>> button.<p>
</ul>

<?php

	}else{

		if($src=='sickness'){	
?>
    <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>¿Como 
    cambiar el departamento?</b></font></font> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b><br>
    Paso 1: </b> Seleccione el departamento desde el selector " <img <?php echo createComIcon('../','bul_arrowgrnlrg.gif','0') ?>> 
    "Crear una forma". </font>
  <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 2: </b> 
    Haga click en "Ir". </font>
  <p> 
</ul>
<font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>¿Como salvar la confirmación?</b></font></font> 
<ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso: </b> Dé 
  clic al bot&oacute;n<img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> 
  . </font> 
  <p> 
</ul>
<font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>&iquest;Como imprimir la confirmac&iacute;on?</b></font></font> 
<ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso: </b> Dé 
  clic al bot&oacute;n <img <?php echo createLDImgSrc('../','printout.gif','0') ?>> 
  . </font> 
  <p> 
</ul>
<font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
<?php
		}elseif($src=='diagnostics'){
?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Aún 
no hay datos disponibles. Como agregar nuevos datos?</b></font></font> 
<ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota: </b> Nuevos 
  reportes diagnósticos o reportes solo pueden ser ingresados via el laboratorio 
  o modulo diagnostico apropiado. El modulo de Admision es de modo "solo lectura" 
  . </font> 
  <p> 
</ul>
<font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
<?php
		}elseif($src=='notes'){
?>
<img <?php echo createComIcon('../','frage.gif','0') ?>><font color="#990000"><b><font color="#990000"><b>Aún 
no hay datos disponibles. &iquest;Como agregar nuevos datos</b></font></b></font>? 
</font> 
<ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso: </b> Haga 
  clic en el enlace" <img <?php echo createComIcon('../','bul_arrowgrnlrg.gif','0') ?>> 
  <font color=#0000ff><b>Introduzca nuevo registro</b></font>". </font> 
  <p> 
</ul>
<font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>¿Como desplegar las opciones del menu?</b></font></font> 
<ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso: </b> Haga 
  clic en el enlace"<img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>> 
  <font color=#0000ff><b>Regresar a opciones</b></font>" </font> 
  <p> 
</ul>
<font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
<?php
		}else{
?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b><font color="#990000"><b>Aún 
no hay datos disponibles. &iquest;Como agregar nuevos datos?</b></font></b></font></font> 
<ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso: </b> Haga 
  clic en el enlace"<img <?php echo createComIcon('../','bul_arrowgrnlrg.gif','0') ?>> 
  <font color=#0000ff><b>Introduzca nuevo registro</b></font>" . </font> 
  <p> 
</ul>
<font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
<?php 
		}
	}
}else{
?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>¿Como 
crear el registro?</b></font></font> 
<ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso: </b> Escriba 
  la información y luego haga clic en el botón<img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> 
  . </font> 
</ul>
<font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>¿Como escribir la fecha?</b></font></font> 
<ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b> 
  Dé clic al icono <img <?php echo createComIcon('../','show-calendar.gif','0') ?>> 
  y aparecerá un mini-calendario. </font> 
  <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img src="../help/es/img/es_date_select.png"> 
    </font>
  <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 2: </b> 
    Dé clic a la fecha en el mini-calendario. </font>
  <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img src="../help/es/img/es_mini_calendar.png"> 
    </font>
  <p>&nbsp; 
<p> 
</ul>
<?php 
}
?>
