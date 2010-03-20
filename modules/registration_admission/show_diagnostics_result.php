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
$thisfile=basename(__FILE__);
if(!isset($mode)){
	$mode='show';
} elseif($mode=='create'||$mode=='update') {

}
$lang_tables=array('departments.php');
require('./include/init_show.php');

if($parent_admit){
$sql="SELECT dr.*, e.encounter_class_nr FROM care_encounter AS e, care_person AS p, care_encounter_diagnostics_report AS dr 
		WHERE p.pid=".$_SESSION['sess_pid']." 
			AND p.pid=e.pid 
			AND e.encounter_nr=".$_SESSION['sess_en']." 
			AND e.encounter_nr=dr.encounter_nr 
		ORDER BY dr.create_time DESC";
}else{
$sql="SELECT dr.*, e.encounter_class_nr FROM care_encounter AS e, care_person AS p, care_encounter_diagnostics_report AS dr 
		WHERE p.pid=".$_SESSION['sess_pid']." AND p.pid=e.pid AND e.encounter_nr=dr.encounter_nr 
		ORDER BY dr.create_time DESC";
}

		
if($result=$db->Execute($sql)){
	$rows=$result->RecordCount();
	include_once($root_path.'include/care_api_classes/class_department.php');
	$dept_obj=new Department();
	$depts_array=&$dept_obj->getAll();
}else{
	echo $sql;
}

$subtitle=$LDDiagXResults;
$notestype='diagnostics';

$_SESSION['sess_file_return']=$thisfile;

$buffer=str_replace('~tag~',$title.' '.$name_last,$LDNoRecordFor);
$norecordyet=str_replace('~obj~',strtolower($subtitle),$buffer); 

/* Load GUI page */
require('./gui_bridge/default/gui_show.php');
?>
