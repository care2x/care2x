<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.2 - 2006-07-10
* GNU General Public License
* Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
* , elpidio@care2x.org
*
* See the file "copy_notice.txt" for the licence notice
*/
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'global_conf/inc_remoteservers_conf.php');
require_once($root_path.'include/inc_date_format_functions.php');
require_once($root_path.'include/care_api_classes/class_person.php');
$person=& new Person($pid);
$person->preloadPersonInfo();
?>
<?php html_rtl($lang); ?>
<head>
<title><?php echo $person->LastName().', '.$person->FirstName().' ['.formatDate2Local($person->Birthdate(),$date_format).']';  ?></title>
<?php echo setCharSet(); ?>

</head>
<body onLoad="if (window.focus) window.focus()">
<font size=2 face="verdana,arial"><?php echo $person->LastName().', '.$person->FirstName().' ['.formatDate2Local($person->Birthdate(),$date_format).']';  ?><br>
<!-- <img src="<?php echo "$httprotocol://$main_domain" ?>/fotos/registration/<?php echo $person->PhotoFilename();  ?>"> -->
<?php
if($person->PhotoFilename()&&file_exists($root_path.'fotos/registration/'.$person->PhotoFilename())){
?>
<img src="<?php echo $root_path ?>fotos/registration/<?php echo $person->PhotoFilename(); ?>">
<?php
}
?>
</body>
</html>
