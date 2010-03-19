<?php
/**
* This script is included by the barcode_img_wristband.php for non-arabic languages
*/
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
	
	# Check if ttf is ok
	include_once($root_path.'include/inc_ttf_check.php');
	
	# Write the print instructions
	$lmargin=10; # Left margin
	$tmargin=2;  # Top margin
	
	if($ttf_ok){
    	ImageTTFText($im,12,0,$lmargin,$tmargin+10,$black,$arial,$LDPrintPortraitFormat);
    	ImageTTFText($im,12,0,$lmargin,$tmargin+25,$black,$arial,$LDClickImgToPrint);
	}else{
		ImageString($im,2,10,2,$LDPrintPortraitFormat,$black);
    	ImageString($im,2,10,15,$LDClickImgToPrint,$black);
	}
	
	
	# Create the name label
	$namelabel=ImageCreate(145,40);
	
    $nm_white = ImageColorAllocate ($namelabel, 255,255,255); //white bkgrnd
    $nm_black= ImageColorAllocate ($namelabel, 0, 0, 0);
	
	
	$lmargin=1; # Left margin
	$tmargin=11;  # Top margin
	
	$dataline1=$result['name_last'].', '.utf8_encode($result['name_first']);
	$dataline2=$result['date_birth'];
	$dataline3=$result['current_ward'].' '.$result['current_dept'].' '.$result['insurance_co_id'].' '.$result['insurance_2_co_id'];
	//$ttf_ok=0;
	
	
	if($ttf_ok){
    	ImageTTFText($namelabel,11,0,$lmargin,$tmargin,$nm_black,$arial,$dataline1);
    	ImageTTFText($namelabel,10,0,$lmargin,$tmargin+13,$nm_black,$arial,$dataline2);
    	ImageTTFText($namelabel,10,0,$lmargin,$tmargin+26,$nm_black,$arial,$dataline3);
	}else{
		ImageString($namelabel,2,1,2,$dataline1,$nm_black);
    	ImageString($namelabel,2,1,15,$dataline2,$nm_black);
    	ImageString($namelabel,2,1,28,$dataline3,$nm_black);
	}
	
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
	if($ttf_ok){
    	ImageTTFText($im,10,0,$leftmargin+230,$topm-1,$black,$arial,$full_en);
    	ImageTTFText($im,10,0,$leftmargin+490,$topm2-3,$black,$arial,$full_en);
    	ImageTTFText($im,11,90,$leftmargin+435,$topm+77,$black,$arial,$full_en);
	}else{
		ImageString($im,2,$leftmargin+225,$topm-13,$full_en,$black);
		ImageString($im,2,$leftmargin+485,$topm2-13,$full_en,$black);
		ImageStringUp($im,5,$leftmargin+420,$topm+78,$full_en,$black);
	}
	$topm+=$yoffset;
	$topm2+=$yoffset;
    ImageCopy($im,$bc,$leftmargin+200,$topm,9,9,170,37);
    ImageCopy($im,$bc,$leftmargin+430,$topm2,9,9,170,37);
	# Print admit nr vertically
	if($ttf_ok){
    	ImageTTFText($im,10,0,$leftmargin+210,$topm-1,$black,$arial,$full_en);
    	ImageTTFText($im,10,0,$leftmargin+440,$topm2-3,$black,$arial,$full_en);
    	ImageTTFText($im,11,90,$leftmargin+395,$topm+77,$black,$arial,$full_en);
	}else{
		ImageString($im,2,$leftmargin+205,$topm-13,$full_en,$black);
		ImageString($im,2,$leftmargin+435,$topm2-13,$full_en,$black);
		ImageStringUp($im,5,$leftmargin+380,$topm+78,$full_en,$black);
	}
	$topm+=$yoffset;
	$topm2+=$yoffset;
    ImageCopy($im,$bc,$leftmargin+160,$topm,9,9,170,37);
    ImageCopy($im,$bc,$leftmargin+340,$topm2,9,9,170,37);
	# Print admit nr vertically
	if($ttf_ok){
    	ImageTTFText($im,10,0,$leftmargin+180,$topm-1,$black,$arial,$full_en);
    	ImageTTFText($im,10,0,$leftmargin+360,$topm2-3,$black,$arial,$full_en);
    	ImageTTFText($im,11,90,$leftmargin+340,$topm+77,$black,$arial,$full_en);
	}else{
		ImageString($im,2,$leftmargin+175,$topm-13,$full_en,$black);
		ImageString($im,2,$leftmargin+355,$topm2-13,$full_en,$black);
		ImageStringUp($im,5,$leftmargin+325,$topm+78,$full_en,$black);
	}
	$topm+=$yoffset;
    ImageCopy($im,$bc,$leftmargin+200,$topm,9,9,170,37);
	# Print admit nr vertically
	if($ttf_ok){
    	ImageTTFText($im,10,0,$leftmargin+210,$topm-1,$black,$arial,$full_en);
    	ImageTTFText($im,11,90,$leftmargin+385,$topm+77,$black,$arial,$full_en);
	}else{
		ImageString($im,2,$leftmargin+215,$topm-13,$full_en,$black);
		ImageStringUp($im,5,$leftmargin+370,$topm+78,$full_en,$black);
	}
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
