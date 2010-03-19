<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/*
CARE2X Integrated Information System Deployment 2.2 - 2006-07-10 for Hospitals and Health Care Organizations and Services
Copyright (C) 2002 - 2006  Elpidio Latorilla & Intellin.org	

GNU GPL. For details read file "copy_notice.txt".
*/
# Version History:  
#        modified on ( 22/01/2004) By Walid Fathalla 
#                                        
# Bug Report and Suggestion to:     
#        Walid Fathalla                    
#        fathalla_w@hotmail.com     

if(!extension_loaded('gd')) dl('php_gd.dll');

header ('Content-type: image/png');

define('LANG_FILE','konsil.php');
define('NO_CHAIN',1);
require($root_path.'include/inc_front_chain_lang.php');

$im =@ ImageCreateFromPNG($root_path.'gui/img/common/default/blood_wardfill.png');

$black = ImageColorAllocate ($im, 0, 0, 0);

if($form_bottom) $str_print=$LDFillByLab;
 else $str_print=$LDFillByWard;
 
require_once($root_path.'include/inc_ttf_check.php');

if($ttf_render){
//ImageColorTransparent($im,$green);
// *******************************************************************
// * the following code is for ttf fonts use only for php machines with ttf support
// *******************************************************************
/*
/* -------------- START ----------------------------------------------*/
	if($lang=='ar' || $lang=='fa'){// Modified on ( 22/01/2004) By Walid Fathalla
    	include_once($root_path.'include/inc_ttf_ar2uni.php');//To actvate function of show arabic
		ImageTTFText($im,14,90,16,390,$black,$arial,ar2uni($str_print));
	}else if($lang=='tr'){
    	include_once($root_path.'include/inc_ttf_tr2uni.php');//To actvate function of show arabic
		ImageTTFText($im,14,90,16,390,$black,$arial,tr2uni($str_print));
	}else{
		ImageTTFText($im,14,90,16,390,$black,$arial,$str_print);
	}

/* -------------- END -------------------------------------------------*/


// ******************************************************************
// * the following code is the default - uses system fonts
// ******************************************************************
}else{
/* -------------- START  ----------------------*/

ImageStringUp($im,5,2,390,$str_print,$black);


/* -------------- END --------------------------*/
}
Imagepng ($im);
ImageDestroy ($im);
 ?>
