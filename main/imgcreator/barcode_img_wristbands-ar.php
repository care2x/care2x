<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/*
CARE 2X Integrated Information System beta 1.0.02 - 30.07.2002 for Hospitals and Health Care Organizations and Services
Copyright (C) 2002  Elpidio Latorilla & Intellin.org	
// Modified on ( 22/01/2004) By Walid Fathalla
GNU GPL. For details read file "copy_notice.txt".
*/

/*****************************************************
*  To align the entire image (4 images), 
* change only the $leftmargin and $topmargin variables
*****************************************************/
	
	$leftmargin=5;
	$topmargin=40;

//* Do not change anything below this line, unless you are sure of what you are doing */

//* The $yoffset variable determines the spacing between the wristbands */
	$yoffset=115;


if(!extension_loaded('gd')) dl('php_gd.dll');

define('LANG_FILE','aufnahme.php');
define('NO_CHAIN',1);
require_once($root_path.'include/inc_front_chain_lang.php');
header ('Content-type: image/png');

    if(!isset($db) || !$db) include_once($root_path.'include/inc_db_makelink.php');
    if($dblink_ok) {	
	    // get orig data
	    $dbtable='care_person';
	    //$sql="SELECT * FROM $dbtable WHERE patient_nr='$pn' ";
		
		$sql="SELECT c1.name_last, c1.name_first, c1.date_birth, c2.current_ward_nr, c2.current_dept_nr,
		           c2.insurance_firm_id, c2.insurance_2_firm_id, c2.encounter_class_nr, c2.encounter_nr
				   FROM care_encounter as c2 
				     LEFT JOIN care_person as c1 ON c1.pid=c2.pid 
				         WHERE c2.encounter_nr='$en'";
				 
	    if($ergebnis=$db->Execute($sql))
       	{
			if($ergebnis->RecordCount())
				{
					$result=$ergebnis->FetchRow();
				}
		}
		else {print "<p>$sql$LDDbNoRead"; exit;}
       
	   /* Load the date formatter */
	   include_once($root_path.'include/inc_date_format_functions.php');
       //$date_format=getDateFormat($link,$DBLink_OK);
	   
	   	/* Get the patient global configs */
		include_once($root_path.'include/care_api_classes/class_globalconfig.php');
        $glob_obj=new GlobalConfig($GLOBAL_CONFIG);
        $glob_obj->getConfig('patient_%');
	   
	   $result['date_birth']=@formatDate2Local($result['date_birth'],$date_format);
	}
	else { print "$LDDbNoLink<br>$sql<br>"; exit;}
	
	/* Create full admission number */
/*	switch ($result['encounter_class_nr'])
    {
    case '2' :     $full_en = $en+ $GLOBAL_CONFIG['patient_outpatient_nr_adder'];
						break;
	case '1' :     $full_en = $en + $GLOBAL_CONFIG['patient_inpatient_nr_adder'];
	default:       $full_en = $en + $GLOBAL_CONFIG['patient_inpatient_nr_adder'];
    }
*/
	$full_en=$en;
	
	/* Load the barcode image*/
    $bc = ImageCreateFrompng($root_path.'cache/barcodes/en_'.$full_en.'.png');
	
	/* Load the wristband images */
	$wb_lrg = ImageCreateFrompng('wristband_large.png');
	$wb_med = ImageCreateFrompng('wristband_medium.png');
	$wb_sml = ImageCreateFrompng('wristband_small.png');
	$wb_bby = ImageCreateFrompng('wristband_baby.png');
	
	/* Get the image sizes*/
	$size_lrg = GetImageSize('wristband_large.png');
	$size_med = GetImageSize('wristband_medium.png');
	$size_sml = GetImageSize('wristband_small.png');
	$size_bby = GetImageSize('wristband_baby.png');

    $w=1085;  // The width of the image = equal to the DIN-A4 paper
    $h=700; // The height of the image = egual to the  DIN-A4 paper
	
	/* Create the main image */
    $im=ImageCreate($w,$h);
	

    $white = ImageColorAllocate ($im, 255,255,255); //white bkgrnd
/*    $background= ImageColorAllocate ($im, 205, 225, 236);
    $blue=ImageColorAllocate($im, 0, 127, 255);
*/  
    $black = ImageColorAllocate ($im, 0, 0, 0);
	
	# path of ttf 
	include_once($root_path.'include/inc_ttf_check_ar.php');
	include_once($root_path.'include/inc_ttf_ar2uni.php');//To actvate function of show arabic
	
	# Write the print instructions
	$lmargin=10; # Left margin
	$tmargin=2;  # Top margin
	
    	ImageTTFText($im,12,0,$lmargin+850,$tmargin+10,$black,$arial,ar2uni($LDPrintPortraitFormat));
    	ImageTTFText($im,12,0,$lmargin+920,$tmargin+25,$black,$arial,ar2uni($LDClickImgToPrint));
	
	
	# Create the name label
	$namelabel=ImageCreate(145,40);
	
    $nm_white = ImageColorAllocate ($namelabel, 255,255,255); //white bkgrnd
    $nm_black= ImageColorAllocate ($namelabel, 0, 0, 0);
	
	
	$lmargin=1; # Left margin
	$tmargin=11;  # Top margin
	
	$dataline1=ar2uni($result['name_last']).', '.ar2uni($result['name_first']);
	$dataline2=$result['date_birth'];
	$dataline3='1234567890'.$result['current_ward'].' '.$result['current_dept'].' '.$result['insurance_co_id'].' '.$result['insurance_2_co_id'];
	//$ttf_ok=0;
	
	
    	ImageTTFText($namelabel,11,0,$lmargin,$tmargin,$nm_black,$arial,$dataline1);
    	ImageTTFText($namelabel,10,0,$lmargin,$tmargin+13,$nm_black,$arial,$dataline2);
    	ImageTTFText($namelabel,10,0,$lmargin,$tmargin+26,$nm_black,$arial,$dataline3);
	
    //-------------- place the wristbands
	    $topm=$topmargin;
        ImageCopy($im,$wb_lrg,$leftmargin,$topm,0,0,$size_lrg[0],$size_lrg[1]);
		$topm+=$yoffset;
		ImageCopy($im,$wb_med,$leftmargin,$topm,0,0,$size_med[0],$size_med[1]);
		$topm+=$yoffset;
        ImageCopy($im,$wb_sml,$leftmargin,$topm,0,0,$size_sml[0],$size_sml[1]);
		$topm+=$yoffset;
        ImageCopy($im,$wb_bby,$leftmargin,$topm,0,0,$size_bby[0],$size_bby[1]);

    //* Place the barcodes */
	$topm=$topmargin+15;
	$topm2=$topmargin+60;

    ImageCopy($im,$bc,$leftmargin+220,$topm,9,9,170,37);
    ImageCopy($im,$bc,$leftmargin+480,$topm2,9,9,170,37);
	# Print admit nr vertically
    	ImageTTFText($im,10,0,$leftmargin+230,$topm-1,$black,$arial,$full_en);
    	ImageTTFText($im,10,0,$leftmargin+490,$topm2-3,$black,$arial,$full_en);
    	ImageTTFText($im,11,90,$leftmargin+435,$topm+77,$black,$arial,$full_en);

	$topm+=$yoffset;
	$topm2+=$yoffset;
    ImageCopy($im,$bc,$leftmargin+200,$topm,9,9,170,37);
    ImageCopy($im,$bc,$leftmargin+430,$topm2,9,9,170,37);

	# Print admit nr vertically

    	ImageTTFText($im,10,0,$leftmargin+210,$topm-1,$black,$arial,$full_en);
    	ImageTTFText($im,10,0,$leftmargin+440,$topm2-3,$black,$arial,$full_en);
    	ImageTTFText($im,11,90,$leftmargin+395,$topm+77,$black,$arial,$full_en);

	$topm+=$yoffset;
	$topm2+=$yoffset;
    ImageCopy($im,$bc,$leftmargin+160,$topm,9,9,170,37);
    ImageCopy($im,$bc,$leftmargin+340,$topm2,9,9,170,37);

	# Print admit nr vertically

    	ImageTTFText($im,10,0,$leftmargin+180,$topm-1,$black,$arial,$full_en);
    	ImageTTFText($im,10,0,$leftmargin+360,$topm2-3,$black,$arial,$full_en);
    	ImageTTFText($im,11,90,$leftmargin+340,$topm+77,$black,$arial,$full_en);

	$topm+=$yoffset;
    ImageCopy($im,$bc,$leftmargin+200,$topm,9,9,170,37);

	# Print admit nr vertically

    	ImageTTFText($im,10,0,$leftmargin+210,$topm-1,$black,$arial,$full_en);
    	ImageTTFText($im,11,90,$leftmargin+385,$topm+77,$black,$arial,$full_en);

    //* Place the name labels*/
	
	$topm=$topmargin+53;
	$topm2=$topmargin+5;
	
    ImageCopy($im,$namelabel,$leftmargin+225,$topm,0,0,144,39);
    ImageCopy($im,$namelabel,$leftmargin+485,$topm2,0,0,144,39);

	$topm+=$yoffset;
	$topm2+=$yoffset;
    ImageCopy($im,$namelabel,$leftmargin+205,$topm,0,0,144,39);
    ImageCopy($im,$namelabel,$leftmargin+435,$topm2,0,0,144,39);

	$topm+=$yoffset;
	$topm2+=$yoffset;
    ImageCopy($im,$namelabel,$leftmargin+175,$topm,0,0,144,39);
    ImageCopy($im,$namelabel,$leftmargin+355,$topm2,0,0,144,39);

	$topm+=$yoffset;
    ImageCopy($im,$namelabel,$leftmargin+210,$topm,0,0,144,39);
	
	/* Create the final image */
    Imagepng ($im);
	

	// Do not edit the following lines
    ImageDestroy ($wb_lrg);
    ImageDestroy ($wb_med);
    ImageDestroy ($wb_sml);
    ImageDestroy ($wb_bby);

    ImageDestroy ($im);
?>
