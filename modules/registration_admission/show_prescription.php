<?php
//error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
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

///$db->debug=1;

$thisfile=basename(__FILE__);
if(!isset($mode)){
	$mode='show';
} elseif($mode=='create'||$mode=='update') {
	include_once($root_path.'include/care_api_classes/class_prescription.php');
	if(!isset($obj)) $obj=new Prescription;
	include_once($root_path.'include/inc_date_format_functions.php');
	
	if($_POST['prescribe_date']) $_POST['prescribe_date']=@formatDate2STD($_POST['prescribe_date'],$date_format);
	else $_POST['prescribe_date']=date('Y-m-d');

	$_POST['create_id']=$_SESSION['sess_user_name'];

	//$db->debug=true;
	# Check the important items
	//gjergji : new prescription..
	//used save_prescription instead of save_admission
	if($article&&$dosage&&$application_type_nr&&$prescriber){
		include('./include/save_prescription.inc.php');
		//include('./include/save_admission_data.inc.php');
	}
	//end : gjergji
}

require('./include/init_show.php');
//gjergji : new prescription management
if($parent_admit){
	$sql="SELECT prs.*, pr.*,
			e.encounter_class_nr 
		  FROM care_encounter AS e, 
		  	   care_person AS p, 
		  	   care_encounter_prescription AS pr, 
		  	   care_encounter_prescription_sub prs
		WHERE p.pid=".$_SESSION['sess_pid']." 
			AND p.pid=e.pid 
			AND e.encounter_nr=".$_SESSION['sess_en']." 
			AND e.encounter_nr=pr.encounter_nr 
			AND pr.nr = prs.prescription_nr
		ORDER BY pr.modify_time DESC";
}else{
	$sql="SELECT prs.*, pr.*, e.encounter_class_nr FROM care_encounter AS e, care_person AS p, care_encounter_prescription AS pr, 
		  	   care_encounter_prescription_sub prs
		WHERE p.pid=".$_SESSION['sess_pid']." AND p.pid=e.pid AND e.encounter_nr=pr.encounter_nr AND pr.nr = prs.prescription_nr
		ORDER BY pr.modify_time DESC";
}
//end : gjergji		
		
if($result=$db->Execute($sql)){
	$rows=$result->RecordCount();
}else{
echo $sql;
}

$subtitle=$LDPrescriptions;
$notestype='prescription';

$_SESSION['sess_file_return']=$thisfile;

$buffer=str_replace('~tag~',$title.' '.$name_last,$LDNoRecordFor);
$norecordyet=str_replace('~obj~',strtolower($subtitle),$buffer); 


/* Load GUI page */
require('./gui_bridge/default/gui_show.php');
?>
