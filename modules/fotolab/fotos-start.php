<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','lab.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');
?>
<?php html_rtl($lang); ?>

<head>
<?php echo setCharSet(); ?>
<title><?php echo $LDPhotos ?></title>

</head>
<?php
if($lang=='ar'||$lang=='fa'){
?>
<frameset cols="*,30%">
  <frame name="FOTOS_PREVIEW" src="fotos-preview.php?sid=<?php echo "$sid&lang=$lang" ?>">
  <frame name="FOTOS_INDEX" src="fotos-index.php?sid=<?php echo "$sid&lang=$lang&edit=$edit&pn=$pn&station=$station&fileroot=$fileroot" ?>" >
<noframes>
<body>
</body>
</noframes>
</frameset>
<?php
}else{
?>
<frameset cols="30%,*">
  <frame name="FOTOS_INDEX" src="fotos-index.php?sid=<?php echo "$sid&lang=$lang&edit=$edit&pn=$pn&station=$station&fileroot=$fileroot" ?>" >
  <frame name="FOTOS_PREVIEW" src="fotos-preview.php?sid=<?php echo "$sid&lang=$lang" ?>">
<noframes>
<body>
</body>
</noframes>
</frameset>
<?php
}
?>

</html>
