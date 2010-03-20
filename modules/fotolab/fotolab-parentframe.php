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
define('LANG_FILE','specials.php');
$local_user='ck_fotolab_user';
require_once($root_path.'include/inc_front_chain_lang.php');
?>
<?php html_rtl($lang); ?>
<head>
<?php echo setCharSet(); ?>
<title></title>

</head>

<?php
if($lang=='ar'||$lang=='fa'){
?>
<frameset cols="*,49%">
   <frame name="PREVIEWFRAME" src="fotolab-preview.php?sid=<?php echo "$sid&lang=$lang" ?>">
  <frame name="SELECTFRAME" src="upload_search_patient.php?sid=<?php echo "$sid&lang=$lang" ?>">
<noframes>
<body>
</body>
</noframes>
</frameset>
<?php
}else{
?>
<frameset cols="49%,*">
  <frame name="SELECTFRAME" src="upload_search_patient.php?sid=<?php echo "$sid&lang=$lang" ?>">
   <frame name="PREVIEWFRAME" src="fotolab-preview.php?sid=<?php echo "$sid&lang=$lang" ?>">
<noframes>
<body>
</body>
</noframes>
</frameset>
<?php
}
?>
</html>
