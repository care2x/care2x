<?php
error_reporting($ErrorLevel);

include "piechart.class.php";
$chart1=new piechart(
					50,
					array('Used beds','Maximum beds'),
					array(50,50),
					array('yellow','wheat',)
					);
header ('Content-type: image/jpeg');

$chart1->draw();
/*$chart1->out('test1.jpg',0);
$chart1->out('test2.jpg',100);
*/?>
