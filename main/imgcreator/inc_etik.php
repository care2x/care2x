<?php
/**
* This script is included by the barcode-etik.php for non arabic languages
*/

		# Location info, admission class, blood group
		$locstr=strtoupper($location['dept_id']).' '.strtoupper($location['ward_id']).' '.$location['roomprefix'];
		if($location['room_nr'])  $locstr.='-'.$location['room_nr'];
		if($location['bed_nr']) $locstr.=' '.strtoupper(chr($location['bed_nr']+96));
		$locstr.=' '.$admit_type.' ';
		$locstr.=$LDInsShortID[$result['insurance_class_nr']];
		
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
	

	
	# Draw the main information - the largest label
    // write item labels
	if($ttf_render){
	
	ImageTTFText($im,9,0,5,11,$black,$arial,"$LDCaseNr:");
    ImageTTFText($im,10,0,5,24,$black,$arial,$full_en);
    ImageTTFText($im,9,0,100,11,$black,$arial,':'."$LDAdmitDate:");
    ImageTTFText($im,10,0,105,24,$black,$arial,formatDate2Local($result['encounter_date'],$date_format));
    ImageTTFText($im,9,0,195,11,$black,$arial,"$LDAdmitTime:");
    ImageTTFText($im,10,0,205,24,$black,$arial,formatDate2Local($result['encounter_date'],$date_format,1,1));
    ImageTTFText($im,9,0,290,11,$black,$arial,"$LDDept:");
    ImageTTFText($im,10,0,295,24,$black,$arial,$result['current_dept']);
	ImageTTFText($im,9,0,385,11,$black,$arial,"$LDRoomNr:");
    ImageTTFText($im,10,0,390,24,$black,$arial,$result['current_room']);
	ImageTTFText($im,9,0,480,11,$black,$arial,"$LDAdmitType:");
    ImageTTFText($im,10,0,485,24,$black,$arial,$result['encounter_type']);
    ImageTTFText($im,9,0,290,36,$black,$arial,"$LDBday:");
    ImageTTFText($im,10,0,290,49,$black,$arial,formatDate2Local($result['date_birth'],$date_format));
    ImageTTFText($im,9,0,385,36,$black,$arial,"$LDSex:");
    ImageTTFText($im,10,0,425,49,$black,$arial,strtoupper($result['sex']));
    ImageTTFText($im,9,0,480,36,$black,$arial,"$LDCivilStat:");
    ImageTTFText($im,10,0,485,49,$black,$arial,$result['civil_status']);
	ImageTTFText($im,9,0,290,61,$black,$arial,"$LDPhone:");
    ImageTTFText($im,10,0,350,75,$black,$arial,$result['phone_1_nr']);
	ImageTTFText($im,9,0,290,88,$black,$arial,"$LDInsurance:");
    ImageTTFText($im,10,0,300,110,$black,$arial,$result['insurance_co_id']);
	ImageTTFText($im,9,0,290,205,$black,$arial,"$LDInsuranceNr:");
    ImageTTFText($im,10,0,360,205,$black,$arial,$result['insurance_nr']);

	// name & address
   	ImageTTFText($im,9,0,5,50,$black,$arial,"$LDNameAddr:");
   	ImageTTFText($im,12,0,10,80,$black,$arial,$result['name_last'].', '.$result['name_first']);
   	ImageTTFText($im,12,0,10,100,$black,$arial,ucfirst($result['addr_str']).' '.$result['addr_str_nr']);
   	ImageTTFText($im,12,0,10,115,$black,$arial,ucfirst($result['addr_zip']).' '.$result['name']);

	// diagnosis, therapie, 
    ImageTTFText($im,12,0,10,235,$black,$arial,"$LDDiagnosis: ".$result['referrer_diagnosis']);
    ImageTTFText($im,12,0,10,250,$black,$arial,"$LDRecBy: ".$result['referrer']);
    ImageTTFText($im,12,0,10,265,$black,$arial,"$LDTherapy: ".$result['referrer_recom_therapy']);
    ImageTTFText($im,12,0,10,280,$black,$arial,"$LDSpecials: ".$result['referrer_notes']);
    ImageTTFText($im,12,0,10,295,$black,$arial,"$LDAdmitDiagnosis :".$result['referrer_diagnosis']);
    ImageTTFText($im,12,0,10,310,$black,$arial,"$LDInfo2: ".$result['info2']);
	    // -- print date, religion, 
   ImageTTFText($im,9,0,5,345,$black,$arial,"$LDPrintDate: ");
    ImageTTFText($im,10,0,5,358,$black,$arial,formatDate2Local(date('Y-m-d'),$date_format));
    ImageTTFText($im,9,119,345,$black,$arial,"$LDReligion: ");
    ImageTTFText($im,10,0,119,358,$black,$arial,$result['religion']);
    ImageTTFText($im,9,0,238,345,$black,$arial,"$LDTherapyType: ");
    ImageTTFText($im,10,0,238,358,$black,$arial,$result['therapy_type']);
    ImageTTFText($im,9,0,352,345,$black,$arial,"$LDTherapyOpt: ");
    ImageTTFText($im,10,0,352,358,$black,$arial,$result['therapy_option']);
	ImageTTFText($im,9,0,466,345,$black,$arial,"$LDServiceType: ");
    ImageTTFText($im,10,0,466,358,$black,$arial,$result['service_type']);
	 # Bill payer information
	 #  Note: the address format is german
     #
     ImageTTFText($im,9,0,5,155,$black,$arial,"$LDBillInfo: ");	
	}else{
	
    ImageString($im,1,5,1,"$LDCaseNr:",$black);
    ImageString($im,4,5,9,$full_en,$black);
    ImageString($im,1,100,1,"$LDAdmitDate:",$black);
    ImageString($im,4,105,9,formatDate2Local($result['encounter_date'],$date_format),$black);
    ImageString($im,1,195,1,"$LDAdmitTime:",$black);
    ImageString($im,4,205,9,formatDate2Local($result['encounter_date'],$date_format,1,1),$black);
    ImageString($im,1,290,1,"$LDDept:",$black);
    ImageString($im,4,295,9,$result['current_dept'],$black);
    ImageString($im,1,385,1,"$LDRoomNr:",$black);
    ImageString($im,4,390,9,$result['current_room'],$black);
    ImageString($im,1,480,1,"$LDAdmitType:",$black);
    ImageString($im,4,485,9,$result['encounter_type'],$black);
    ImageString($im,1,290,26,"$LDBday:",$black);
    ImageString($im,4,290,34,formatDate2Local($result['date_birth'],$date_format),$black);
    ImageString($im,1,385,26,"$LDSex:",$black);
    ImageString($im,4,425,34,strtoupper($result['sex']),$black);
    ImageString($im,1,480,26,"$LDCivilStat:",$black);
    ImageString($im,4,485,34,$result['civil_status'],$black);
    ImageString($im,1,290,51,"$LDPhone:",$black);
    ImageString($im,4,350,60,$result['phone_1_nr'],$black);
    ImageString($im,1,290,78,"$LDInsurance:",$black);
    ImageString($im,4,300,95,$result['insurance_co_id'],$black);
    ImageString($im,1,290,195,"$LDInsuranceNr:",$black);
    ImageString($im,4,360,195,$result['insurance_nr'],$black);
    // name & address
    ImageString($im,1,5,40,"$LDNameAddr:",$black);
    ImageString($im,3,10,70,$result['name_last'].', '.$result['name_first'],$black);	
	
    //for($a=0,$l=90;$a<sizeof($addr);$a++,$l+=15) ImageString($im,3,10,$l,$addr[$a],$black);
     ImageString($im,3,10,90,$result['addr_str'].' '.$result['addr_str_nr'],$black);
     ImageString($im,3,10,105,$result['addr_zip'].' '.$result['name'],$black);

	
    // diagnosis, therapie, 
    ImageString($im,3,10,225,$LDDiagnosis.': '.$result['referrer_diagnosis'],$black);
    ImageString($im,3,10,240,$LDRecBy.': '.$result['referrer'],$black);
    ImageString($im,3,10,255,$LDTherapy.': '.$result['referrer_recom_therapy'],$black);
    ImageString($im,3,10,270,$LDSpecials.': '.$result['referrer_notes'],$black);
    ImageString($im,3,10,285,$LDAdmitDiagnosis.': '.$result['referrer_diagnosis'],$black);
    ImageString($im,3,10,300,$LDInfo2.': '.$result[info2],$black);

		
    // -- print date, religion, 
    ImageString($im,1,5,336,"$LDPrintDate:",$black);
    ImageString($im,4,5,343,formatDate2Local(date('Y-m-d'),$date_format),$black);
    ImageString($im,1,119,336,"$LDReligion:",$black);
    ImageString($im,4,119,343,$result['religion'],$black);
    ImageString($im,1,238,336,"$LDTherapyType:",$black);
    ImageString($im,4,238,343,$result[therapy_type],$black);
    ImageString($im,1,352,336,"$LDTherapyOpt:",$black);
    ImageString($im,4,352,343,$result[therapy_option],$black);
    ImageString($im,1,466,336,"$LDServiceType:",$black);
    ImageString($im,4,466,343,$result['service_type'],$black);
	 # Bill payer information
	 #  Note: the address format is german
     #
     ImageString($im,1,5,145,"$LDBillInfo:",$black);	
	 }
	
	// place the barcode
    ImageCopy($im,$bc,110,28,9,9,170,37);



	 
	 if ($result['payer_other']=='')
	 {
	 	if($ttf_render){
     	 	ImageTTFText($im,12,0,10,170,$black,$arial,$result['name_last'].', '.$result['name_first']);
   	     	ImageTTFText($im,12,0,10,185,$black,$arial,ucfirst($result['addr_str']).' '.$result['addr_str_nr']);
    	 	ImageTTFText($im,12,0,10,200,$black,$arial,ucfirst($result['addr_zip']).' '.$result['name']);
	 }else{
         	ImageString($im,3,10,160,$result['name_last'].', '.$result['name_first'],$black);
         	ImageString($im,3,10,175,$result['addr_str'].' '.$result['addr_str_nr'],$black);
         	ImageString($im,3,10,190,$result['addr_zip'].' '.$result['name'],$black);
		}
	}
	else
	{
	    $addr_buffer=nl2br($result['payer_other']);
		$addr_buffer=explode('<br>',$addr_buffer);
		for($i=0,$n=160;$i<sizeof($addr_buffer);$i++,$n+=15)
		{
			if($ttf_render){
			}else{
            	ImageString($im,3,10,$n,trim($addr_buffer[$i]),$black);
			}
		}
			
	}

	
	// Contact person
	if($result['contact_person']!='')
	{
	    //$addr_buffer=nl2br($result['contact_person']);
		$addr_buffer=str_replace("\r",', ',$result['contact_person']);
		$addr_buffer=str_replace("\n",'',$addr_buffer);
        ImageString($im,4,90,305,$addr_buffer,$black);
	}

	
	# Create the medium large labels
	
    // -- create label 
    $label=ImageCreate(282,178);
    $ewhite = ImageColorAllocate ($label, 255,255,255); //white bkgrnd
    $elightgreen= ImageColorAllocate ($im, 205, 225, 236);
    $eblue=ImageColorAllocate($im, 0, 127, 255);
    $eblack = ImageColorAllocate ($label, 0, 0, 0);
	// place the barcode
    ImageCopy($label,$bc,101,4,9,9,170,37);



	if($ttf_ok){
		
		$tmargin=2;
		$lmargin=6;
		
  		#  Full encounter nr
    	ImageTTFText($label,12,0,$lmargin,$tmargin+14,$eblack,$arial,$full_en);
		# Encounter admission date
    	ImageTTFText($label,11,0,$lmargin,$tmargin+30,$eblack,$arial,formatDate2Local($result['encounter_date'],$date_format));
		# Family name, first name
    	ImageTTFText($label,16,0,$lmargin,$tmargin+56,$eblack,$arial,$result['name_last'].', '.$result['name_first']);
		# Date of birth
    	ImageTTFText($label,11,0,$lmargin,$tmargin+74,$eblack,$arial,formatDate2Local($result['date_birth'],$date_format));
		# Address street nr, street name
    	ImageTTFText($label,11,0,$lmargin,$tmargin+93,$eblack,$arial,ucfirst($result['addr_str'].' '.$result['addr_str_nr']));
		# Address, zip, city/town name
    	ImageTTFText($label,11,0,$lmargin,$tmargin+108,$eblack,$arial,ucfirst($result['addr_zip']).' '.$result['name']);
		# Sex
    	ImageTTFText($label,14,0,$lmargin,$tmargin+130,$eblack,$arial,strtoupper($result['sex']));
		# Family name, repeat print
    	ImageTTFText($label,14,0,$lmargin+30,$tmargin+130,$eblack,$arial,$result['name_last']);
		# Insurance co name
    	ImageTTFText($label,14,0,$lmargin,$tmargin+150,$eblack,$arial,$ins_obj->getFirmName($result['insurance_firm_id']));
		# Location
    	ImageTTFText($label,9,0,$lmargin,$tmargin+170,$eblack,$arial,$locstr);
		#Blood group
		if(stristr('AB',$result['blood_group'])){
    		ImageTTFText($label,24,0,$lmargin+240,$tmargin+127,$eblack,$arial,$result['blood_group']);
		}else{
    		ImageTTFText($label,24,0,$lmargin+245,$tmargin+127,$eblack,$arial,$result['blood_group']);
		}
	}else{ # Use system fonts
	   
		# encounter number
    	ImageString($label,4,2,2,$full_en,$black);
		# encounter date
   	 	ImageString($label,2,2,18,formatDate2Local($result['encounter_date'],$date_format),$black); 
    	ImageString($label,5,10,40,$result['name_last'].', '.$result['name_first'],$black);
    	ImageString($label,3,10,55,formatDate2Local($result['date_birth'],$date_format),$black);
     	ImageString($label,4,10,75,$result['addr_str'].' '.$result['addr_str_nr'],$black);
     	ImageString($label,4,10,90,$result['addr_zip'].' '.$result['name'],$black);
	
    	ImageString($label,5,10,125,strtoupper($result['sex']),$black);
    	ImageString($label,5,30,125,$result['name_last'],$black);
    	ImageString($label,4,10,140,$ins_obj->getFirmName($result['insurance_firm_id']),$black);
    	ImageString($label,3,10,160,$locstr,$black);
		#Blood group
		if(stristr('AB',$result['blood_group'])){
    		ImageString($label,5,257,125,$result['blood_group'],$black);
		}else{
    		ImageString($label,5,265,125,$result['blood_group'],$black);
		}
	
	}

	
    # -- create smaller label
    $label2=ImageCreate(173,133);
    $e2white = ImageColorAllocate ($label2, 255,255,255); //white bkgrnd
    $black = ImageColorAllocate ($label2, 0, 0, 0);
	# -- place barcode
    ImageCopy($label2,$bc,2,0,9,7,170,37);

	if($ttf_ok){
   	ImageTTFText($label2,9,0,10,45,$black,$arial,$full_en);
    	ImageTTFText($label2,9,0,105,45,$black,$arial,formatDate2Local($result['encounter_date'],$date_format));
    	ImageTTFText($label2,11,0,10,60,$black,$arial,$result['name_last'].',');
    	ImageTTFText($label2,11,0,10,75,$black,$arial,$result['name_first']);
    	ImageTTFText($label2,11,0,10,95,$black,$arial,strtoupper($result['sex']));
    	ImageTTFText($label2,10,0,50,95,$black,$arial,formatDate2Local($result['date_birth'],$date_format));
    	ImageTTFText($label2,10,0,10,109,$black,$arial,$ins_obj->getFirmName($result['insurance_firm_id']));
    	ImageTTFText($label2,9,0,10,124,$black,$arial,$locstr);
    }else{
		ImageString($label2,2,10,34,$full_en,$black);
    	ImageString($label2,2,110,34,formatDate2Local($result['encounter_date'],$date_format),$black);
    	ImageString($label2,4,10,50,$result['name_last'].',',$black);
    	ImageString($label2,4,10,65,$result['name_first'],$black);
    	ImageString($label2,4,10,85,strtoupper($result['sex']),$black);
    	ImageString($label2,3,50,85,formatDate2Local($result['date_birth'],$date_format),$black);
    	ImageString($label2,3,10,100,$result['insurance_co_id'],$black);
    	ImageString($label2,2,10,115,$locstr,$black);
    }
	
	
    # ----- create smaller label without barcode
    $label3=ImageCreate(173,133);
    $e3white = ImageColorAllocate ($label3, 255,255,255); # white bkgrnd
    $black = ImageColorAllocate ($label3, 0, 0, 0);
	$addr1=$result['addr_str'].' '.$result['addr_str_nr'];
	$addr2= $result['addr_zip'].' - '.$result['name'];
	
	if($ttf_ok){
    	ImageTTFText($label3,12,0,10,11,$black,$arial,$full_en);
    	ImageTTFText($label3,9,0,110,11,$black,$arial,formatDate2Local($result['encounter_date'],$date_format));
    	ImageTTFText($label3,12,0,10,34,$black,$arial,$result['name_last'].',');
    	ImageTTFText($label3,12,0,10,49,$black,$arial,$result['name_first']);
    	ImageTTFText($label3,10,0,10,64,$black,$arial,formatDate2Local($result['date_birth'],$date_format));
    	ImageTTFText($label3,10,0,10,84,$black,$arial,$addr1);
    	ImageTTFText($label3,10,0,10,99,$black,$arial,$addr2);
	}else{
	
    	ImageString($label3,4,10,2,$full_en,$black);
    	ImageString($label3,2,110,2,formatDate2Local($result['encounter_date'],$date_format),$black);
    	ImageString($label3,4,10,25,$result['name_last'].',',$black);
    	ImageString($label3,4,10,40,$result['name_first'],$black);
    	ImageString($label3,2,10,55,formatDate2Local($result['date_birth'],$date_format),$black);
     	ImageString($label3,2,10,75,$addr1,$black);
     	ImageString($label3,2,10,90,$addr2,$black);
	} 
	
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
/*    ImageDestroy ($label);
    ImageDestroy ($label2);
    ImageDestroy ($label3);*/
/*
}
*/
ImageDestroy ($im);
?>
