<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
/*
* We do not need the entire environment here so we just load the variable globalizer routine
*/
require($root_path.'include/core/inc_vars_resolve.php');

define('PIE_CHART_BASE_COLOR','greenyellow'); 	// define the base color of the pie chart
define('PIE_CHART_DIAMETER',25); 						// define the diameter of the pie chart

if(!extension_loaded('gd')) dl('php_gd.dll');

/* Load the pie chart generator */
require($root_path.'classes/pie_chart/piechart.class.php');

$chart=new piechart(
					PIE_CHART_DIAMETER,
					array('',''),
					array($qouta,$used),
					array(PIE_CHART_BASE_COLOR,$uc)
					);
header ('Content-type: image/png');
$chart->draw();
?>
