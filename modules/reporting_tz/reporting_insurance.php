<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');

#Load and create paginator object
require_once($root_path.'include/care_api_classes/class_tz_selianreporting.php');

$rep_obj = new selianreport();
while (list($i,$v) = each ($rep_obj->GetPIDOfLaspedContract(30))) {
  echo $v;
}
?>
