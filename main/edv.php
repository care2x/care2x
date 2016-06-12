<?php
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
error_reporting($ErrorLevel);

require_once($root_path.'include/core/inc_environment_global.php');
header('Location:'.$root_path.'modules/system_admin/edv.php?sid='.$sid.'&lang='.$lang);
exit;
?>
