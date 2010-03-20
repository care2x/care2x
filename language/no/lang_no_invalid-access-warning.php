<?php

error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);

require_once('../../include/inc_vars_resolve.php');

require_once('../../include/inc_img_fx.php');

?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">

<?php html_rtl($lang); ?>

<HEAD>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

 <TITLE>Advarsel om ulovlig tilgang</TITLE>

</HEAD>



<BODY bgcolor="#ffffff">



<table width=100% border=1>

<tr>

<td bgcolor="navy">

<FONT  COLOR="white"  SIZE=+3  FACE="Arial"><STRONG>&nbsp;Unauthorized Page Access</STRONG></FONT>

</td>

</tr>

<tr>

<td ><p><br>





<center>

<FONT    SIZE=3 color=red  FACE="Arial">

<b>Du har ikke rettigheter til å åpne dette dokumentet!</b></font><p>

<FORM >

<INPUT type="button"  value=" OK "  onClick="<?php if ($mode=="close") print 'window.close()'; else print 'history.back()'; ?>"></FORM>

<p>

</font>

</center>

<p>

<ul>

<font size=3 face="verdana,arial">

Sannsynlig årsak til dette problemet:

</FONT><p>

<font size=2 face="verdana,arial">

<img <?php echo createComIcon('../../','achtung.gif') ?>>

Du kan ha brukt "Back" or "Forward" funksjonen på nettleseren. Unngå å bruk disse knappene.<br>

<img <?php echo createComIcon('../../','achtung.gif') ?>>

Du kan ha avslått en "cookie". Dette programmet er avhengig av cookies for å fungere skikkelig. Aksepter cookies.

<br>

<img <?php echo createComIcon('../../','achtung.gif') ?>>

Det kan hende din nettleser ikke aksepterer cookies. Konfigurer nettleseren slik at cookies automatisk blir akseptert.

<br>

<img <?php echo createComIcon('../../','achtung.gif') ?>>

Det kan hende din nettleser ikke kan kjøre javascript eller javascript kan være slått av. Gjør slik at javascript kan bli kjørt i din nettleser.

<br>

<img <?php echo createComIcon('../../','achtung.gif') ?>>

I noen sjeldne tilfeller kan det hende at det har skjedd en feil i overføringen av data. For å løse denne situasjonen klikk på knappen "reload" i din nettleser.

<p>

</FONT>

<p>

</ul>

</td>

</tr>

</table>        

<p>



<?php

$root_path='../../';

require('en_copyrite.php'); 

?>

</FONT>





</BODY>

</HTML>
