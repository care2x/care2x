<?php 
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/*
CARE2X Integrated Information System Deployment 2.2 - 2006-07-10 for Hospitals and Health Care Organizations and Services
Copyright (C) 2002,2003,2004,2005,2006  Elpidio Latorilla & Intellin.org	

GNU GPL. For details read file "copy_notice.txt".
*/
define('LANG_FILE','aufnahme.php');
define('NO_CHAIN',1);
require($root_path.'include/inc_front_chain_lang.php');

if(!extension_loaded('gd')) dl('php_gd.dll');
/**
* We will check again if gd is loaded, if yes create the image
*/
if(extension_loaded('gd')) 
{
header ('Content-type: image/png');
//header ('Content-type: image/jpeg');
//header ('Content-type: image/gif');
//$person=str_replace('+',' ',$person);
$im = ImageCreateFrompng($root_path.'gui/img/common/'.$theme_com_icon.'/cat-com5.png');
/*
$im=ImageCreate(200,100);
$background_color = ImageColorAllocate ($im, 255,102,102);
$text_color = ImageColorAllocate ($im, 0, 170, 255);
$background= ImageColorAllocate ($im, 205, 225, 236);
 $white = ImageColorAllocate ($im, 255, 255, 255);
*/
$blue=ImageColorAllocate($im, 0, 127, 255);
$black = ImageColorAllocate ($im, 0, 0, 0);
$time=date(G);
if(($time>=0)&&($time<10)) $greet=$LDGoodMorning;
	else if(($time>9)&&($time<13)) $greet=$LDGoodDay; 
	else if(($time>12)&&($time<18)) $greet=$LDGoodAfternoon; 
		else $greet=$LDGoodEvening;
			
// *******************************************************************
// * the following code is for ttf fonts use only for php machines with ttf support
// * uncomment the following lines to use ttf font and comment the default line
// *******************************************************************

/* ------------- Start ----------------------------------------------------*/
/*ImageTTFText($im,14,0,9,25,$black,"verdanab.ttf","hello");
ImageTTFText ($im, 14, 0, 15, 76, $black, "verdana.ttf",$person);
imagecolortransparent($im,$blue);
*/
/* ------------- End ------------------------------------------------------*/

// ******************************************************************
// * the following code is the default - uses system fonts
// * comment the following lines if you use the ttf font line above
// ******************************************************************
/* --------------- Start -----------------------------*/
ImageString($im,5,9,20,$greet,$black);
if(strlen($person)>18) $fs=3; else $fs=5;
ImageString($im,$fs,12,63,$person,$black);
/* ---------------- End ------------------------------*/
Imagepng ($im);
//Imagegif ($im);
//Imagejpeg ($im);
ImageDestroy ($im);
}
?>
