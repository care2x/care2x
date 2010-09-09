<?php

/**
* Correcciones: Dr. med. Daniel Hinostroza C.
*/

error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
require_once($root_path.'include/inc_img_fx.php');
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
 <TITLE>Advertencia de acceso no autorizado</TITLE>
</HEAD>

<BODY bgcolor="#ffffff">

<table width=100% border=1>
<tr>
<td bgcolor="navy">
<FONT  COLOR="white"  SIZE=+3  FACE="Arial"><STRONG>&nbsp;No est� autorizado para acceder a esta p�gina</STRONG></FONT>
</td>
</tr>
<tr>
<td ><p><br>


<center>
<FONT    SIZE=3 color=red  FACE="Arial">
<b>No tiene permisos de acceso a esta p�gina!</b></font><p>
<FORM >
<INPUT type="button"  value=" OK "  onClick="<?php if ($mode=="close") print 'window.close()'; else print 'history.back()'; ?>"></FORM>
<p>
</font>
</center>
<p>
<ul>
<font size=3 face="verdana,arial">
Probables causas del problema:
</FONT><p>
<font size=2 face="verdana,arial">
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Puede ser que haya utilizado la funci�n atr�s o adelante  de su navegador.  Evite usar estos botones.<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Puede que haya rechazado una cookie.  El programa depende de cookies para funcionar correctamente.  Acepte las cookies.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Su navegador no pudo aceptar las cookies.  Por favor configure su navegador para que acepte las cookies autom�ticamente.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Su navegador no pudo hacer funcionar Javascript o el Javascript no pudo ser interpretado. Habilite Javascript en las opciones de su navegador.  
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
En raras ocasiones puede haber un error en la transferencia de datos.  Para corregirlo pulse el bot�n de "recarga" de su navegador.
<p>
</FONT>
<p>
</ul>
</td>
</tr>
</table>        
<p>

<?php
require($root_path.'include/inc_load_copyrite.php'); 
?>
</FONT>


</BODY>
</HTML>
