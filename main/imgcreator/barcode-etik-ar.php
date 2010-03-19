<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/*
CARE 2X Integrated Information System beta 1.0.09 - 2003-10-13 for Hospitals and Health Care Organizations and Services
Copyright (C) 2002  Elpidio Latorilla & Intellin.org	
// Modified on ( 22/01/2004) By Walid Fathalla
GNU GPL. For details read file "copy_notice.txt".
*/

# Define to true if you want to draw a border around the labels
define('DRAW_BORDER',TRUE);

if(!extension_loaded('gd')) dl('php_gd.dll');

define('LANG_FILE','aufnahme.php');
define('NO_CHAIN',1);
require_once($root_path.'include/inc_front_chain_lang.php');
header ('Content-type: image/png');

# Check the encounter number
if((!isset($en)||!$en)&&$_SESSION['sess_en']) $en=$_SESSION['sess_en'];

/*
if(file_exists("../cache/barcodes/pn_".$pn."_bclabel_".$lang.".png"))
{
    $im = ImageCreateFrompng("../cache/barcodes/pn_".$pn."_bclabel_".$lang.".png");
    Imagepng($im);
}
else
{
*/
    if(!isset($db) || !$db) include_once($root_path.'include/inc_db_makelink.php');
    if($dblink_ok) {
	    // get orig data
	    //$dbtable='care_patient_encounter';
		$sql="SELECT c1.name_last, c1.name_first, c1.date_birth, c1.sex, c1.civil_status, c1.phone_1_nr,
		          c1.religion, c1.addr_str, c1.addr_str_nr, c1.addr_zip, c1.addr_citytown_nr, c1.contact_person, c1.blood_group,  
				  c2.*, ad.name
				 FROM care_encounter as c2 
				     LEFT JOIN care_person as c1 ON c1.pid=c2.pid 
					 LEFT JOIN care_address_citytown AS ad ON c1.addr_citytown_nr=ad.nr
				         WHERE c2.encounter_nr='$en'";
						 
	    if($ergebnis=$db->Execute($sql))
       	{
			if($ergebnis->RecordCount())
				{
					$result=$ergebnis->FetchRow();
				}
		}
		// else {print "<p>$sql$LDDbNoRead"; exit;} /* Remove comment for debugging*/
       
	   include_once($root_path.'include/inc_date_format_functions.php');
       //$date_format=getDateFormat($link,$DBLink_OK);

	   	/* Get the patient global configs */
		include_once($root_path.'include/care_api_classes/class_globalconfig.php');
        $glob_obj=new GlobalConfig($GLOBAL_CONFIG);
        $glob_obj->getConfig('patient_%');
		
		# Create insurance object
		include_once($root_path.'include/care_api_classes/class_insurance.php');
		$ins_obj=new Insurance;
		
		include_once($root_path.'include/care_api_classes/class_ward.php');
		$obj=new Ward;
		# Get location data
		$location=&$obj->EncounterLocationsInfo($en);
		# Location info, admission class, blood group
		$locstr=strtoupper($location['dept_id']).' '.strtoupper($location['ward_id']).' '.$location['roomprefix'];
		if($location['room_nr'])  $locstr.='-'.$location['room_nr'];
		if($location['bed_nr']) $locstr.=' '.strtoupper(chr($location['bed_nr']+96));
		$locstr.=' '.$admit_type.' '.$LDInsShortID[$result['insurance_class_nr']];
	   
	//   $result['date_birth']=formatDate2Local($result['date_birth'],$date_format);
	}
	else 
		{ print "$LDDbNoLink<br>$sql<br>"; }
		
		
		
	switch ($result['encounter_class_nr'])
	{
	    case '1':    $full_en= $en + $GLOBAL_CONFIG['patient_inpatient_nr_adder'];
		                      $result['encounter_class']=$LDStationary;
		                      break;
	    case '2':   $full_en= $en + $GLOBAL_CONFIG['patient_outpatient_nr_adder'];
		                      $result['encounter_class']=$LDAmbulant;
	    default:    $full_en= $en + $GLOBAL_CONFIG['patient_inpatient_nr_adder'];
		                      $result['encounter_class']=$LDStationary;
		}
			
    $bc = ImageCreateFrompng($root_path.'cache/barcodes/en_'.$full_en.'.png');

    $w=745;  // The width of the image = equal to the width of DIN-A4 paper
    $h=1080; // The height of the image = egual to the height of DIN-A4 paper
	
    $im=ImageCreate($w,$h);

    $white = ImageColorAllocate ($im, 255,255,255); //white bkgrnd
    $background= ImageColorAllocate ($im, 205, 225, 236);
    $blue=ImageColorAllocate($im, 0, 127, 255);
    $black = ImageColorAllocate ($im, 0, 0, 0);
  
    // draw black lines
    ImageLine($im,0,25,569,25,$black);
    ImageLine($im,0,220,569,220,$black);
    ImageLine($im,0,334,569,334,$black);
    for($n=0,$j=95;$n<3;$n++,$j+=95) ImageLine($im,$j,0,$j,25,$black);
    for($n=0,$j=114;$n<4;$n++,$j+=114) ImageLine($im,$j,334,$j,359,$black);
    ImageLine($im,285,26,285,220,$black);
    ImageLine($im,285,50,569,50,$black);
    ImageLine($im,285,75,569,75,$black);
    for($n=0,$j=380;$n<2;$n++,$j+=95) ImageLine($im,$j,0,$j,50,$black);
	
	
	# path of ttf is ok
	include_once($root_path.'include/inc_ttf_check_ar.php');
    include_once($root_path.'include/inc_ttf_ar2uni.php');//To actvate function of show arabic

	
	# Draw the main information - the largest label
    // write item labels
    
	ImageTTFText($im,9,0,5,11,$black,$arial,':'.ar2uni("$LDCaseNr"));
    ImageTTFText($im,10,0,5,24,$black,$arial,$full_en);
    ImageTTFText($im,9,0,100,11,$black,$arial,':'.ar2uni("$LDAdmitDate"));
    ImageTTFText($im,10,0,105,24,$black,$arial,formatDate2Local($result['encounter_date'],$date_format));
    ImageTTFText($im,9,0,195,11,$black,$arial,':'.ar2uni("$LDAdmitTime"));
    ImageTTFText($im,10,0,205,24,$black,$arial,formatDate2Local($result['encounter_date'],$date_format,1,1));
    ImageTTFText($im,9,0,290,11,$black,$arial,':'.ar2uni("$LDDept"));
    ImageTTFText($im,10,0,295,24,$black,$arial,ar2uni($result['current_dept']));
	ImageTTFText($im,9,0,385,11,$black,$arial,':'.ar2uni("$LDRoomNr"));
    ImageTTFText($im,10,0,390,24,$black,$arial,$result['current_room']);
	ImageTTFText($im,9,0,480,11,$black,$arial,':'.ar2uni("$LDAdmitType"));
    ImageTTFText($im,10,0,485,24,$black,$arial,ar2uni($result['encounter_type']));
    ImageTTFText($im,9,0,290,36,$black,$arial,':'.ar2uni("$LDBday"));
    ImageTTFText($im,10,0,290,49,$black,$arial,formatDate2Local($result['date_birth'],$date_format));
    ImageTTFText($im,9,0,385,36,$black,$arial,':'.ar2uni("$LDSex"));
    ImageTTFText($im,10,0,425,49,$black,$arial,strtoupper($result['sex']));
    ImageTTFText($im,9,0,480,36,$black,$arial,':'.ar2uni("$LDCivilStat"));
    ImageTTFText($im,10,0,485,49,$black,$arial,$result['civil_status']);
	ImageTTFText($im,9,0,290,61,$black,$arial,':'.ar2uni("$LDPhone"));
    ImageTTFText($im,10,0,350,75,$black,$arial,$result['phone_1_nr']);
	ImageTTFText($im,9,0,290,88,$black,$arial,':'.ar2uni("$LDInsurance"));
    ImageTTFText($im,10,0,300,110,$black,$arial,$result['insurance_co_id']);
	ImageTTFText($im,9,0,290,205,$black,$arial,':'.ar2uni("$LDInsuranceNr"));
    ImageTTFText($im,10,0,360,205,$black,$arial,$result['insurance_nr']);

	// name & address
   	ImageTTFText($im,9,0,5,50,$black,$arial,':'.ar2uni("$LDNameAddr"));
    
	// place the barcode 
    ImageCopy($im,$bc,110,28,9,9,170,37);
   	ImageTTFText($im,12,0,10,80,$black,$arial,ar2uni($result['name_last']).', '.ar2uni($result['name_first']));
	
    //for($a=0,$l=90;$a<sizeof($addr);$a++,$l+=15) ImageString($im,3,10,$l,$addr[$a],$black);
   	ImageTTFText($im,12,0,10,100,$black,$arial,ucfirst(ar2uni($result['addr_str'])).' '.$result['addr_str_nr']);
   	ImageTTFText($im,12,0,10,115,$black,$arial,ucfirst(ar2uni($result['addr_zip'])).' '.ar2uni($result['name']));

	 /* Bill payer information
	 *  Note: the address format is german
     */
     ImageTTFText($im,9,0,5,155,$black,$arial,':'.ar2uni("$LDBillInfo"));
	 if ($result['payer_other']=='')
	 {
     	 ImageTTFText($im,12,0,10,170,$black,$arial,ar2uni($result['name_last']).', '.ar2uni($result['name_first']));
   	     ImageTTFText($im,12,0,10,185,$black,$arial,ucfirst(ar2uni($result['addr_str'])).' '.$result['addr_str_nr']);
    	 ImageTTFText($im,12,0,10,200,$black,$arial,ucfirst(ar2uni($result['addr_zip'])).' '.ar2uni($result['name']));
	}
	else
	{
	    $addr_buffer=nl2br($result['payer_other']);
		$addr_buffer=explode('<br>',$addr_buffer);
		for($i=0,$n=160;$i<sizeof($addr_buffer);$i++,$n+=15)
		{
            ImageString($im,3,10,$n,trim($addr_buffer[$i]),$black);// must modifaid
		}
			
	}
    
	// diagnosis, therapie, 
    ImageTTFText($im,12,0,10,235,$black,$arial,ar2uni($result['referrer_diagnosis']).' :'.ar2uni("$LDDiagnosis"));
    ImageTTFText($im,12,0,10,250,$black,$arial,ar2uni($result['referrer']).' :'.ar2uni("$LDRecBy"));
    ImageTTFText($im,12,0,10,265,$black,$arial,ar2uni($result['referrer_recom_therapy']).' :'.ar2uni("$LDTherapy"));
    ImageTTFText($im,12,0,10,280,$black,$arial,ar2uni($result['referrer_notes']).' :'.ar2uni("$LDSpecials"));
    ImageTTFText($im,12,0,10,295,$black,$arial,ar2uni($result['referrer_diagnosis']).' :'.ar2uni("$LDAdmitDiagnosis"));
    ImageTTFText($im,12,0,10,310,$black,$arial,ar2uni($result['info2']).' :'.ar2uni("$LDInfo2"));

	// Contact person
	if($result['contact_person']!='')//must modifaid
	{
	    //$addr_buffer=nl2br($result['contact_person']);
		$addr_buffer=str_replace("\r",', ',$result['contact_person']);
		$addr_buffer=str_replace("\n",'',$addr_buffer);
        ImageString($im,4,90,305,$addr_buffer,$black);
	}
	
    // -- print date, religion, 
    ImageTTFText($im,9,0,5,345,$black,$arial,':'.ar2uni("$LDPrintDate"));
    ImageTTFText($im,10,0,5,358,$black,$arial,formatDate2Local(date('Y-m-d'),$date_format));
    ImageTTFText($im,9,119,345,$black,$arial,':'.ar2uni("$LDReligion"));
    ImageTTFText($im,10,0,119,358,$black,$arial,ar2uni($result['religion']));
    ImageTTFText($im,9,0,238,345,$black,$arial,':'.ar2uni("$LDTherapyType"));
    ImageTTFText($im,10,0,238,358,$black,$arial,ar2uni($result['therapy_type']));
    ImageTTFText($im,9,0,352,345,$black,$arial,':'.ar2uni("$LDTherapyOpt"));
    ImageTTFText($im,10,0,352,358,$black,$arial,ar2uni($result['therapy_option']));
	ImageTTFText($im,9,0,466,345,$black,$arial,':'.ar2uni("$LDServiceType"));
    ImageTTFText($im,10,0,466,358,$black,$arial,ar2uni($result['service_type']));

	
	# Create the medium large labels
	
    // -- create label 
    $label=ImageCreate(282,178);
    $ewhite = ImageColorAllocate ($label, 255,255,255); //white bkgrnd
    $elightgreen= ImageColorAllocate ($im, 205, 225, 236);
    $eblue=ImageColorAllocate($im, 0, 127, 255);
    $eblack = ImageColorAllocate ($label, 0, 0, 0);
	// place the barcode
    ImageCopy($label,$bc,101,4,9,9,170,37);


		$tmargin=2;
		$lmargin=6;
		
  		#  Full encounter nr
    	ImageTTFText($label,12,0,$lmargin,$tmargin+14,$eblack,$arial,$full_en);
		# Encounter admission date
    	ImageTTFText($label,11,0,$lmargin,$tmargin+30,$eblack,$arial,formatDate2Local($result['encounter_date'],$date_format));
		# Family name, first name
    	ImageTTFText($label,16,0,$lmargin,$tmargin+56,$eblack,$arial,ar2uni($result['name_last']).', '.ar2uni($result['name_first']));
		# Date of birth
    	ImageTTFText($label,11,0,$lmargin,$tmargin+74,$eblack,$arial,formatDate2Local($result['date_birth'],$date_format));
		# Address street nr, street name
    	ImageTTFText($label,11,0,$lmargin,$tmargin+93,$eblack,$arial,ucfirst(ar2uni($result['addr_str'])).' '.$result['addr_str_nr']);
		# Address, zip, city/town name
    	ImageTTFText($label,11,0,$lmargin,$tmargin+108,$eblack,$arial,ucfirst(ar2uni($result['addr_zip'])).' '.ar2uni($result['name']));
		# Sex
    	ImageTTFText($label,14,0,$lmargin,$tmargin+130,$eblack,$arial,strtoupper($result['sex']));
		# Family name, repeat print
    	ImageTTFText($label,14,0,$lmargin+30,$tmargin+130,$eblack,$arial,ar2uni($result['name_last']));
		# Insurance co name
    	ImageTTFText($label,14,0,$lmargin,$tmargin+150,$eblack,$arial,$ins_obj->getFirmName($result['insurance_firm_id']));
		# Location
    	ImageTTFText($label,9,0,$lmargin,$tmargin+170,$eblack,$arial,ar2uni($locstr));
		#Blood group
		if(stristr('AB',$result['blood_group'])){
    		ImageTTFText($label,24,0,$lmargin+240,$tmargin+127,$eblack,$arial,$result['blood_group']);
		}else{
    		ImageTTFText($label,24,0,$lmargin+245,$tmargin+127,$eblack,$arial,$result['blood_group']);
		}
	
    # -- create smaller label
    $label2=ImageCreate(173,133);
    $e2white = ImageColorAllocate ($label2, 255,255,255); //white bkgrnd
    $black = ImageColorAllocate ($label2, 0, 0, 0);
	# -- place barcode
    ImageCopy($label2,$bc,2,0,9,7,170,37);

    	ImageTTFText($label2,9,0,10,45,$black,$arial,$full_en);
    	ImageTTFText($label2,9,0,105,45,$black,$arial,formatDate2Local($result['encounter_date'],$date_format));
    	ImageTTFText($label2,11,0,10,60,$black,$arial,ar2uni($result['name_last']).',');
    	ImageTTFText($label2,11,0,10,75,$black,$arial,ar2uni($result['name_first']));
    	ImageTTFText($label2,11,0,10,95,$black,$arial,strtoupper($result['sex']));
    	ImageTTFText($label2,10,0,50,95,$black,$arial,formatDate2Local($result['date_birth'],$date_format));
    	ImageTTFText($label2,10,0,10,109,$black,$arial,$ins_obj->getFirmName($result['insurance_firm_id']));
    	ImageTTFText($label2,9,0,10,124,$black,$arial,ar2uni($locstr));
	
    # ----- create smaller label without barcode
    $label3=ImageCreate(173,133);
    $e3white = ImageColorAllocate ($label3, 255,255,255); # white bkgrnd
    $black = ImageColorAllocate ($label3, 0, 0, 0);
	$addr1=ar2uni($result['addr_str']).' '.$result['addr_str_nr'];
	$addr2= ar2uni($result['addr_zip']).' - '.ar2uni($result['name']);
	
    	ImageTTFText($label3,10,0,10,11,$black,$arial,$full_en);
    	ImageTTFText($label3,9,0,110,11,$black,$arial,formatDate2Local($result['encounter_date'],$date_format));
    	ImageTTFText($label3,12,0,10,34,$black,$arial,ar2uni($result['name_last']).'');
    	ImageTTFText($label3,12,0,10,49,$black,$arial,ar2uni($result['name_first']));
    	ImageTTFText($label3,10,0,10,64,$black,$arial,formatDate2Local($result['date_birth'],$date_format));
    	ImageTTFText($label3,10,0,10,84,$black,$arial,$addr1);
    	ImageTTFText($label3,10,0,10,99,$black,$arial,$addr2);
	
    //-------------- place 6 labels
    for($i=0,$wi=359;$i<4;$i++,$wi+=179)
    {
        ImageCopy($im,$label,1,$wi,0,0,282,178);
        ImageCopy($im,$label,285,$wi,0,0,282,178);
        if(defined('DRAW_BORDER')&&DRAW_BORDER) ImageLine($im,0,$wi,569,$wi,$blue);
    }

    // ---  place the smaller labels
    for($i=0,$j=1;$i<1080;$i+=135,$j++)
    {
        if($j>4) ImageCopy($im,$label2,570,$i+5,0,0,173,133);
	        else ImageCopy($im,$label3,570,$i+5,0,0,173,133);
        if(defined('DRAW_BORDER')&&DRAW_BORDER) ImageLine($im,569,$i,$w-1,$i,$blue);
    }
	
	if(defined('DRAW_BORDER')&&DRAW_BORDER){
    	ImageLine($im,0,0,$w-1,0,$blue);
    	ImageLine($im,0,0,0,$h-1,$blue);
    	ImageLine($im,0,$h-1,$w-1,$h-1,$blue);
    	ImageLine($im,$w-1,0,$w-1,$h-1,$blue);
    	ImageLine($im,569,0,569,$h-1,$blue);
    	ImageLine($im,284,359,284,$h-1,$blue);
	}
	
    Imagepng ($im);
	
	// *******************************************************************
    // * comment the following one line if you want to deactivate caching of 
	// * the barcode label image
	// *******************************************************************
/*    
	// START
    Imagepng ($im,"../cache/barcodes/pn_".$pn."_bclabel_".$lang.".png");
	// END
*/	
	// Do not edit the following lines
    ImageDestroy ($label);
    ImageDestroy ($label2);
    ImageDestroy ($label3);
/*
}
*/
ImageDestroy ($im);
?>
