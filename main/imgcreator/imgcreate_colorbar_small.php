<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/*
CARE2X Integrated Information System Deployment 2.2 - 2004-10-02 for Hospitals and Health Care Organizations and Services
Copyright (C) 2002,2003,2004,2005,2006  Elpidio Latorilla & Intellin.org	

GNU GPL. For details read file "copy_notice.txt".
*/

if(!extension_loaded('gd')) dl('php_gd.dll');
define('LANG_FILE','konsil.php');
define('NO_CHAIN',1);
require($root_path.'include/inc_front_chain_lang.php');
header ('Content-type: image/png');

	    // get event signals
	    $dbtable='care_encounter_event_signaller';
		
	    $sql="SELECT yellow, black, blue_pale, brown, pink,
		                    yellow_pale, red, green_pale, violet,
							blue, biege, orange 
					FROM $dbtable WHERE encounter_nr='$pn'";
							
	    if($ergebnis = @$db->Execute($sql))
       	{
			if($rows = @$ergebnis->RecordCount())
			{
				$result=$ergebnis->FetchRow();
			}
		}
		
		if (!isset($result['yellow'])) 	$result=array('yellow'=>0,'black'=>0,'blue_pale'=>0,'brown'=>0,'pink'=>0,'yellow_pale'=>0,'red'=>0,'green_pale'=>0,'violet'=>0,'blue'=>0,'biege'=>0,'orange'=>0);


	 /* Dimensions of the small colorbar signaller*/
	 $label_w=60; 
	 $label_h=18;
	 $bot=$label_h-1;
	 $ltop=$label_h-3;
    // -- create label 
    $label=ImageCreate($label_w,$label_h);
    $white = ImageColorAllocate ($label, 255,255,255); //white bkgrnd
	
	
	
    $yellow= ImageColorAllocate ($label, 255, 255, 0);
    $black = ImageColorAllocate ($label, 0, 0, 0);
    $blue_pale= ImageColorAllocate ($label, 0, 255, 255);
    $brown= ImageColorAllocate ($label, 104, 17, 10);
    $pink=ImageColorAllocate($label, 243, 165, 208);
    $yellow_pale= ImageColorAllocate ($label, 234, 248, 104);
	$red= ImageColorAllocate($label,255,0,0);
	$green_pale= ImageColorAllocate($label,0,250,162);
	$violet= ImageColorAllocate($label,166,0,215);
	$blue= ImageColorAllocate($label,0,0,255);
	$biege= ImageColorAllocate($label,244,231,210);
	$orange= ImageColorAllocate($label,255,195,17);
	//ImageFillToBorder($label,2,2,$egray,$ewhite);
	
	ImageFilledRectangle($label,0,0,119,14,$white);
	ImageColorTransparent($label, $white); // set background as transparent
	
    
	/* Draw the color bars */
	if ($result['yellow'] == 2) ImageFilledRectangle($label,0,0,4,$bot,$yellow); else ImageFilledRectangle($label,0,$ltop,4,$bot,$yellow);
	if ($result['black'] == 2) ImageFilledRectangle($label,5,0,9,$bot,$black); else ImageFilledRectangle($label,5,$ltop,9,$bot,$black);
	if ($result['blue_pale'] == 2) ImageFilledRectangle($label,10,0,14,$bot,$blue_pale); else ImageFilledRectangle($label,10,$ltop,14,$bot,$blue_pale);
	if ($result['brown'] == 2) ImageFilledRectangle($label,15,0,19,$bot,$brown); else ImageFilledRectangle($label,15,$ltop,19,$bot,$brown);
	if ( $result['pink'] == 2) ImageFilledRectangle($label,20,0,24,$bot,$pink); else ImageFilledRectangle($label,20,$ltop,24,$bot,$pink);
	if ($result['yellow_pale'] == 2) ImageFilledRectangle($label,25,0,29,$bot,$yellow_pale); else ImageFilledRectangle($label,25,$ltop,29,$bot,$yellow_pale);
	if ( $result['red'] == 2) ImageFilledRectangle($label,30,0,34,$bot,$red); else ImageFilledRectangle($label,30,$ltop,34,$bot,$red);
	if ( $result['green_pale'] == 2) ImageFilledRectangle($label,35,0,39,$bot,$green_pale); else ImageFilledRectangle($label,35,$ltop,39,$bot,$green_pale);
	if ( $result['violet'] == 2) ImageFilledRectangle($label,40,0,44,$bot,$violet); else ImageFilledRectangle($label,40,$ltop,44,$bot,$violet);
	if ($result['blue'] == 2) ImageFilledRectangle($label,45,0,49,$bot,$blue); else ImageFilledRectangle($label,45,$ltop,49,$bot,$blue);
	if ($result['biege'] == 2) ImageFilledRectangle($label,50,0,54,$bot,$biege); else ImageFilledRectangle($label,50,$ltop,54,$bot,$biege);
	if ($result['orange'] == 2) ImageFilledRectangle($label,55,0,59,$bot,$orange); else ImageFilledRectangle($label,55,$ltop,59,$bot,$orange);

	/* Draw the black horizontal bottom line */
    ImageLine($label,0,$bot,59,$bot,$black);	
	
    Imagepng($label);
	
    ImageDestroy($label);

?>
