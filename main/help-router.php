<?php 
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
 // globalize POST, GET, & COOKIE  vars
require('./roots.php');
require_once($root_path.'include/inc_environment_global.php');
require_once($root_path.'include/inc_charset_fx.php') // load the charset functions
?>
<?php html_rtl($lang); ?>
<head>
<?php echo setCharSet(); ?>
<title>?</title>

</head>

<?php if($lang=='ar'||$lang=='fa'){
?>
<frameset cols="*,20%">
  <frame name="HELPINFOFRAME" src="help-info.php?helpidx=<?php echo "$helpidx&src=$src&x1=$x1&x2=$x2&x3=$x3&lang=$lang" ?>">
  <frame name="HELPINDEXFRAME" src="help-index.php?helpidx=<?php echo "$helpidx&src=$src&x1=$x1&x2=$x2&x3=$x3&lang=$lang" ?>">
<noframes>
<body>
</body>
</noframes>
</frameset>

<?php
}else{
?>
<frameset cols="20%,*">
  <frame name="HELPINDEXFRAME" src="help-index.php?helpidx=<?php echo "$helpidx&src=$src&x1=$x1&x2=$x2&x3=$x3&lang=$lang" ?>">
  <frame name="HELPINFOFRAME" src="help-info.php?helpidx=<?php echo "$helpidx&src=$src&x1=$x1&x2=$x2&x3=$x3&lang=$lang" ?>">
<noframes>
<body>
</body>
</noframes>
</frameset>

<?php
}
?>

</html>
