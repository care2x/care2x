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

if(!extension_loaded('gd')) dl('php_gd.dll');
$lang_tables[]='aufnahme.php';
define('LANG_FILE','konsil.php');
define('NO_CHAIN',1);
require_once($root_path.'include/inc_front_chain_lang.php');
header ('Content-type: image/png');

/*
if(file_exists("../cache/barcodes/pn_".$pn."_bclabel_".$lang.".png"))
{
    $im = ImageCreateFrompng("../cache/barcodes/pn_".$pn."_bclabel_".$lang.".png");
    Imagepng($im);
}
else
{
*/

		include_once($root_path.'include/care_api_classes/class_ward.php');
		$obj=new Ward;
		if($obj->loadEncounterData($en)){
			$result=&$obj->encounter;
		}
		
		# Create insurance object
		include_once($root_path.'include/care_api_classes/class_insurance.php');
		$ins_obj=new Insurance;
		
		$fen=$en;
	    /*// get orig data
	    $dbtable="care_admission_patient";
	    $sql="SELECT * FROM $dbtable WHERE patnum='$pn' ";
	    if($ergebnis=$db->Execute($sql))
       	{
			if($rows=$ergebnis->RecordCount())
				{
					$result=$ergebnis->FetchRow();
					if($edit&&$result['discharge_date']) $edit=0;
				}
		}
		else {print "<p>$sql$LDDbNoRead"; exit;}*/
       
	   include_once($root_path.'include/inc_date_format_functions.php');
	  
	  # Get location data
	$location=&$obj->EncounterLocationsInfo($en);
		 
	   # Localize date data   
	   $result['date_birth']=@formatDate2Local($result['date_birth'],$date_format);
	   $result['pdate']=@formatDate2Local($result['encounter_date'],$date_format);
		# Decode admission class
		switch($result['encounter_class_nr']){
			case 1: $admit_type=$LDStationary; break;
			case 2: $admit_type=$LDAmbulant; break;
			default : $admit_type='';
		}
		
	   if($child_img)
	   {
	   
	       if($subtarget=='chemlabor' || $subtarget=='baclabor')
	       {
	           $sql="SELECT * FROM care_test_request_".$subtarget." WHERE batch_nr='".$batch_nr."'";
	   		            if($ergebnis=$db->Execute($sql))
       		            {
				            if($editable_rows=$ergebnis->RecordCount())
					        {
							
     					       $stored_request=$ergebnis->FetchRow();
							   
							   
							    if(isset($stored_request['parameters']))
							   {
							      //echo $stored_request['parameters'];
   						          parse_str($stored_request['parameters'],$stored_param);
                               }
							   
							   // parse the material type 
							   if(isset($stored_request['material']))
							   {
   						          parse_str($stored_request['material'],$stored_material);
							   }
							   // parse the test type 
							   if(isset($stored_request['test_type']))
							   {
   						          parse_str($stored_request['test_type'],$stored_test_type);
							   }
							}
			             }
	       }	   

	       if($subtarget=='baclabor')
	       {
	           $sql="SELECT * FROM care_test_findings_baclabor WHERE batch_nr='".$batch_nr."'";
	   		            if($ergebnis=$db->Execute($sql))
       		            {
				            if($editable_rows=$ergebnis->RecordCount())
					        {
							
     					       $stored_findings=$ergebnis->FetchRow();
							   
							       parse_str($stored_findings['type_general'],$parsed_type);
							       parse_str($stored_findings['resist_anaerob'],$parsed_resist_anaerob);
							       parse_str($stored_findings['resist_aerob'],$parsed_resist_aerob);
							       parse_str($stored_findings['findings'],$parsed_findings);
							}
			             }
	   
	       }
	    } // end of if($child_img)

		
    $addr=explode("\r\n",$result['address']);

    if($lang=="de") $result['sex']=strtr($result['sex'],"mfMF","mwMW");
    
	/* Load the barcode img if it exists */
    if(file_exists($root_path.'cache/barcodes/pn_'.$fen.'.png'))
	{
	   $bc = ImageCreateFrompng($root_path.'cache/barcodes/pn_'.$fen.'.png');
	}elseif(file_exists($root_path.'cache/barcodes/en_'.$fen.'.png')){
	   $bc = ImageCreateFrompng($root_path.'cache/barcodes/en_'.$fen.'.png');
	}	 
	 /* Dimensions of the patient's label */
	 $label_w=282; 
	 $label_h=178;
	 
    // -- create label 
    $label=ImageCreate($label_w,$label_h);
    $ewhite = ImageColorAllocate ($label, 255,255,255); //white bkgrnd
    $elightgreen= ImageColorAllocate ($label, 205, 225, 236);
    $eblue=ImageColorAllocate($label, 0, 127, 255);
    $eblack = ImageColorAllocate ($label, 0, 0, 0);
	$egray= ImageColorAllocate($label,127,127,127);
	//ImageFillToBorder($label,2,2,$egray,$ewhite);
	ImageRectangle($label,0,0,281,177,$egray);
	
	# Write the data on the label
	# Location info, admission class, blood group
	$locstr=strtoupper($location['dept_id']).' '.strtoupper($location['ward_id']).' '.$location['roomprefix'];
	if($location['room_nr'])  $locstr.='-'.$location['room_nr'];
	if($location['bed_nr']) $locstr.=' '.strtoupper(chr($location['bed_nr']+96));
	$locstr.=' '.$admit_type.' '.$LDInsShortID[$result['insurance_class_nr']];
	
	# path of ttf is ok
	include_once($root_path.'include/inc_ttf_check_ar.php');
    include_once($root_path.'include/inc_ttf_ar2uni.php');//To actvate function of show arabic
	
	    $tmargin=2;
		$lmargin=6;
		
    	#  Full encounter nr
    	ImageTTFText($label,12,0,$lmargin,$tmargin+14,$eblack,$arial,$fen);
		# Encounter admission date
    	ImageTTFText($label,11,0,$lmargin,$tmargin+30,$eblack,$arial,$result['pdate']);
		# Family name, first name
    	ImageTTFText($label,16,0,$lmargin,$tmargin+56,$eblack,$arial,ar2uni($result['name_last']).', '.ar2uni($result['name_first']));
		# Date of birth
    	ImageTTFText($label,11,0,$lmargin,$tmargin+74,$eblack,$arial,$result['date_birth']);
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
		
	
	
	// place the barcode img
    if($bc) ImageCopy($label,$bc,110,4,9,9,170,37);

	if(!$child_img)
	{
    	Imagepng($label);
	
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
    ImageDestroy($label);
	}
	else
	{
	  if(file_exists($root_path.'main/imgcreator/gd_test_request_'.$subtarget.'.php'))   include_once($root_path.'main/imgcreator/gd_test_request_'.$subtarget.'.php');
	  else Imagepng($label);
	/*   Imagepng($label);*/
	  
	}
/*
}
*/
 ?>
