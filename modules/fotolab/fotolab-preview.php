<?php 
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');

/*require($root_path.'include/inc_environment_global.php');

define('PREVIEW_SIZE',400); // define here the width of the preview image
$lang_tables=array('images.php');
define('LANG_FILE','nursing.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');
*/
?>
<?php html_rtl($lang); ?>
<head>
<?php
/*require_once($root_path.'include/inc_charset_fx.php');
echo setCharSet();*/
?>
</head>
<body>
 <img src="../../gui/img/common/default/pixel.gif"   border=0 name="previewpic" title="previewpic"> 
</body>
</html>
