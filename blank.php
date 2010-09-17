<?php
//error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
if(!isset($lang)||!$lang)
{
	if(!$_SESSION['sess_lang']) include('chklang.php');
}

if(file_exists('language/'.$lang.'/lang_'.$lang.'_indexframe.php')) include('language/'.$lang.'/lang_'.$lang.'_indexframe.php');
    else include('language/en/lang_en_indexframe.php')


?>
<?php html_rtl($lang) ?>
<?php 

include_once('include/inc_charset_fx.php');

echo setCharSet(); 

?>
<head>
<!-- <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1/28596">
 -->
 <title>Init Page</title>
</head>
<body>
<font color="990000">
<b><?php echo $LDPlsWaitInit ?></b>
</font>
</body>
</html>
