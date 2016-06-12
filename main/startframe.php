<?php
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
error_reporting($ErrorLevel);
//$_SESSION['sess_path_referer']=str_replace($doc_root.'/','',__FILE__);
//echo __FILE__;
header("Location:".$root_path."modules/news/start_page.php?sid=$sid&lang=$lang");
exit;
?>
