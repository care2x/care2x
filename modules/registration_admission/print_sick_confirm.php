<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System beta 2.0.1 - 2004-07-04
* GNU General Public License
* Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/

$logo_ht_limit=50; # Maximum deparment logo's height in pixels

$lang_tables=array('departments.php','legal.php','prompt.php');

define('LANG_FILE','aufnahme.php');
$local_user='aufnahme_user';
require_once($root_path.'include/inc_front_chain_lang.php');
# Load the template class
require_once($root_path.'include/care_api_classes/class_template.php');
# Create the template object
$TP_obj=new Template($root_path);

$thisfile=basename(__FILE__);

# Check if the print style is set, if not, display the style selector page and exit.
if(!isset($sickform_style)){

	$TP_img_1='<img '.createLDImgSrc($root_path,'sickform.gif','0').'>';
	$TP_img_2='<img '.createLDImgSrc($root_path,'sickform_alltext.gif','0').'>';
	$TP_img_3='<img '.createLDImgSrc($root_path,'sickform_plain.gif','0').'>';
	$TP_img_4='<img '.createLDImgSrc($root_path,'sickform_data.gif','0').'>';
	
	$url_prepend=$thisfile.URL_APPEND."&dept_nr=$dept_nr&get_nr=$get_nr&sickform_style=";
	
	$TP_href_1=$url_prepend;
	$TP_href_2=$url_prepend.'_alltext';
	$TP_href_3=$url_prepend.'_plain';
	$TP_href_4=$url_prepend.'_data';
	
	$TP_selector=&$TP_obj->load('registration_admission/tp_sick_confirm_selectstyle.htm');
	eval("echo $TP_selector;");
	exit;
}

//require_once($root_path.'include/inc_config_color.php');
require_once($root_path.'include/inc_date_format_functions.php');
require_once($root_path.'include/inc_editor_fx.php');
require_once($root_path.'include/care_api_classes/class_person.php');

# Load the encounter class
require_once($root_path.'include/care_api_classes/class_encounter.php');
$enc_obj=new Encounter($_SESSION['sess_full_en']);

if(!isset($mode)||empty($mode)){
	
	$sickconfirm_obj=&$enc_obj->allSicknessConfirm();
	if($rows=$enc_obj->LastRecordCount()){
		$mode='show';
		# If $get_nr is non-empty, get the  single record 
		if(isset($get_nr)&&$get_nr){
			if(!$single_obj=&$enc_obj->getSicknessConfirm($get_nr)) $get_nr=0;
		}else{
			$get_nr=0;
		}
	}else{
		$mode='';
	}
	
}

# Get the insurance data of the encounter
if($insure_obj=$enc_obj->EncounterInsuranceData()){
	$insurance=$insure_obj->FetchRow();
}else{
	$insurance=false;
}




if((!isset($pid)||!$pid)&&$_SESSION['sess_pid']) $pid=$_SESSION['sess_pid'];
	elseif((isset($pid)&&$pid)&&!$_SESSION['sess_pid']) $_SESSION['sess_pid']=$pid;


if(!isset($user_id) || !$user_id)
{
    $user_id=$local_user.$sid;
    $user_id=$$user_id;
}
 
if(isset($pid) && ($pid!='')) {
	$person_obj=new Person($pid);
	if($data_obj=&$person_obj->getAllInfoObject()){
		$zeile=$data_obj->FetchRow();
		//while(list($x,$v)=each($zeile))	$$x=$v;
		extract($zeile);       
	}
}

require_once($root_path.'include/care_api_classes/class_globalconfig.php');
$glob_obj=new GlobalConfig($GLOBAL_CONFIG);



$subtitle=$LDSickReport;

$buffer=str_replace('~tag~',$title.' '.$name_last,$LDNoRecordFor);
$norecordyet=str_replace('~obj~',strtolower($subtitle),$buffer); 
$_SESSION['sess_file_return']=$thisfile;

/* Load all  medical depts info */
require_once($root_path.'include/care_api_classes/class_department.php');
$dept_obj=new Department;
$dept_med=$dept_obj->getAllMedical();

if(isset($deptnr)&&!empty($deptnr)) $encounter['current_dept_nr']=$deptnr;
$dept_address=$dept_obj->Address($encounter['current_dept_nr']);
$dept_sigstamp=$dept_obj->SignatureStamp($encounter['current_dept_nr']);

/* Load GUI page */
require('./gui_bridge/default/gui_print_sick_confirm.php');
?>
