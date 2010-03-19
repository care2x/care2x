<?php
//error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
error_reporting(0);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/*
CARE2X Integrated Information System  for Hospitals and Health Care Organizations and Services
Copyright (C) 2002,2003,2004,2005  Elpidio Latorilla & Intellin.org	

GNU GPL. For details read file "copy_notice.txt".
*/
if(!extension_loaded('gd')) dl('php_gd.dll');

require($root_path.'classes/thumbnail/thumbnail.class.php');
$myThumb = new Thumbnail; // Start using a class
$myThumb->setMaxSize($mx,$my); // Specify maximum size (width, height)
$myThumb->setImgSource($root_path.$imgfile); // Specify original image filename
$myThumb->Create(''); // Specify destination image filename or leave empty to output directly
?>