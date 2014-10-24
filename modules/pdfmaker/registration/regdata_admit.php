<?php
error_reporting ( E_COMPILE_ERROR | E_ERROR | E_CORE_ERROR ) ;

$report_textsize = 10 ;
$report_titlesize = 10 ;
$report_auxtitlesize = 10 ;
$report_authorsize = 10 ;

require ('./roots.php') ;
require ($root_path . 'include/core/inc_environment_global.php') ;
/**
 * CARE 2X Integrated Hospital Information System version deployment 1.1 (mysql) 2004-01-11
 * GNU General Public License
 * Copyright 2002,2003,2004,2005 Elpidio Latorilla
 * , elpidio@care2x.org
 *
 * See the file "copy_notice.txt" for the licence notice
 */
//$lang_tables[]='startframe.php';

$lang_tables [] = 'person.php' ;
define ( 'LANG_FILE', 'aufnahme.php' ) ;
//define('NO_2LEVEL_CHK',1);//define('NO_CHAIN',TRUE);$local_user = 'aufnahme_user' ;
require_once ($root_path . 'include/core/inc_front_chain_lang.php') ;
require_once ($root_path . 'include/core/inc_date_format_functions.php') ;
require_once ($root_path . 'include/care_api_classes/class_person.php') ;
require_once ($root_path . 'include/care_api_classes/class_insurance.php') ;

$insurance_obj = new PersonInsurance ( ) ;
$person_obj = & new Person ( $pid ) ;
// Get the person´s dataif ($person_obj->preloadPersonInfo ( $pid )) {
	$person = $person_obj->person ;
	// copy to encounter variable 	$encounter = & $person ;	

	$p_insurance = &$insurance_obj->getPersonInsuranceObject ( $pid ) ;
	
	if ($p_insurance == false) {
		$insurance_show = true ;
	} else {
		if (! $p_insurance->RecordCount ()) {
			$insurance_show = true ;
		} elseif ($p_insurance->RecordCount () == 1) {
			$buffer = $p_insurance->FetchRow () ;
			extract ( $buffer ) ;			$insurance_show = true ;
			# Get insurace firm name			$insurance_firm_name = $insurance_obj->getFirmName ( $insurance_firm_id ) ;
		
		} else {
			$insurance_show = false ;
		}
	}
}

$insurance_class = $insurance_obj->getInsuranceClassInfo ( $insurance_class_nr ) ;
# Resolve the insurance class nameif (isset ( $$insurance_class [ 'LD_var' ] ) && ! empty ( $$insurance_class [ 'LD_var' ] ))
	$insclass = $$insurance_class [ 'LD_var' ] ; else
	$insclass = $insurance_class [ 'name' ] ;
	
# Get the global config for person's registration form*/require_once ($root_path . 'include/care_api_classes/class_globalconfig.php') ;
$GLOBAL_CONFIG = array ( ) ;
$glob_obj = new GlobalConfig ( $GLOBAL_CONFIG ) ;
$glob_obj->getConfig ( 'person_%' ) ;

require_once ($root_path . 'include/care_api_classes/class_insurance.php') ;
$insurance_obj = new Insurance ( ) ;

$classpath = $root_path . 'classes/phppdf/' ;
$fontpath = $classpath . 'fonts/' ;
# Load and create pdf objectinclude ($classpath . 'class.ezpdf.php') ;
$pdf = & new Cezpdf ( array ( 0 , 0 , 227 , 550 ) ) ;

$logo = $root_path . 'gui/img/logos/care_logo_print.png' ;
$pidbarcode = $root_path . 'cache/barcodes/pn_' . $encounter [ 'pid' ] . '.png' ;
$encbarcode = $root_path . 'cache/barcodes/en_' . $enc . '.png' ;
if (empty ( $encounter [ 'photo_filename' ] )) {
	$idpic = $root_path . 'uploads/photos/registration/_nothing_' ;
} else {
	$idpic = $root_path . 'uploads/photos/registration/' . $encounter [ 'photo_filename' ] ;
}

# Load the page header #1

$diff = array ( 199 => 'Ccedilla' , 208 => 'Gbreve' , 221 => 'Idotaccent' , 214 => 'Odieresis' , 222 => 'Scedilla' , 220 => 'Udieresis' , 231 => 'ccedilla' , 240 => 'gbreve' , 253 => 'dotlessi' , 246 => 'odieresis' , 254 => 'scedilla' , 252 => 'udieresis' , 226 => 'acircumflex' ) ;
$pdf->selectFont ( $fontpath . 'Helvetica.afm', array ( 'encoding' => 'WinAnsiEncoding' , 'differences' => $diff ) ) ;# Get the main informationsif (! isset ( $GLOBAL_CONFIG ))
	$GLOBAL_CONFIG = array ( ) ;
include_once ($root_path . 'include/care_api_classes/class_globalconfig.php') ;
$glob = & new GlobalConfig ( $GLOBAL_CONFIG ) ;
# Get all config items starting with "main_"$glob->getConfig ( 'main_%' ) ;
$y = $pdf->ezText ( "\n", 30 ) ;
$addr [] = array ( $GLOBAL_CONFIG [ 'main_info_address' ] .  "\n" ) ;
$pdf->ezTable ( $addr, '', '', array ( 'xPos' => 180 , 'xOrientation' => 'left' , 'showLines' => 0 , 'showHeadings' => 0 , 'shaded' => 0 , 'fontsize' => 6  ) ) ;

# Load the patient data plate #1$pataddress = $encounter [ 'addr_str' ] . " " . $encounter [ 'addr_str_nr' ] . "\n" . $encounter [ 'addr_zip' ] . " " . $person_obj->CityTownName ( $encounter [ 'addr_citytown_nr' ] ) ;
$pdf->setLineStyle(5,'','',array(5));
$pdf->Line(0,230,240,230);
$pdf->Line(0,315,240,315);
$pdf->Line(0,406,240,406);
//pat data
$pdf->ezText($LDLastName . " : " . $encounter [ 'name_last' ],10);
$pdf->ezText($LDFirstName . " : " . $encounter [ 'name_first' ],10);
$pdf->ezText($LDBday . " : " . formatDate2Local ( $encounter [ 'date_birth' ], $date_format ),10);
$pdf->ezText("PID : " . $encounter [ 'pid' ],10);
$pdf->ezText($LDAddress . " : ",10);
$pdf->ezText($encounter [ 'addr_str' ] . " " . $encounter [ 'addr_str_nr' ] . "\n" . $encounter [ 'addr_zip' ] . " " . $person_obj->CityTownName ( $encounter [ 'addr_citytown_nr' ] ) ,10);
# Add the PID barcodeif (file_exists ( $pidbarcode )) {
	$imgsize = GetImageSize ( $pidbarcode ) ;
	$pdf->addPngFromFile ( $pidbarcode, 0, 60, 200, 60 ) ;
	$pdf->addPngFromFile ( $pidbarcode, 0, 450, 200, 60 ) ;
}
$pdf->ezText ( "\n", 6 ) ;
//pat data
$pdf->ezText($LDRegDate . " :",10);
$pdf->ezText(formatDate2Local ( $person [ 'date_reg' ], $date_format ) ,10);
$pdf->ezText($LDRegTime . " :",10);
$pdf->ezText(formatDate2Local ( $person [ 'date_reg' ], $date_format, TRUE, TRUE )  ,10);

$pdf->ezText($LDSex . " : " . $person [ 'sex' ],10);

$pdf->ezText($LDBloodGroup . " : " . $person [ 'blood_group' ],10);

$pdf->ezText("\n",10);
$pdf->ezText($LDInsuranceNr . " :",10);
$pdf->ezText($insurance_nr ,10);
$pdf->ezText($LDInsuranceClass . " :",10);
$pdf->ezText($insclass ,10);
$pdf->ezText($LDInsuranceCo . " :",10);
$pdf->ezText($insurance_firm_name ,10);

$pdf->ezText($LDAdmitBy . " :",10);
$pdf->ezText($person [ 'create_id' ],10);

$pdf->ezStream () ;

?>
