<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
?>
<!-- Runs ImageJ as an Apple -->

<html>
<head>
<title>Modifica</title>
</head>
<body>

<h2>Edita immagine</h2>

<applet codebase="."
	code="ij.ImageJApplet.class" archive="ij.jar"
	width=750 height=550
	security=all-permissions>
<param name=url value=<?php echo "$httprotocol://$main_domain/fotos/encounter/$pn/$img"; ?>>
</applet>

<p>
<a href="javascript:window.history.back()">Indietro</a>
</p>
</body>
</html>