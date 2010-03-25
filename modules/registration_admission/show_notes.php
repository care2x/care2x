<?php
//error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
///$db->debug = true;
$thisfile=basename(__FILE__);

if(!isset($type_nr)||!$type_nr) $type_nr=1; //* 1 = history physical notes

require_once($root_path.'include/care_api_classes/class_notes.php');
$obj=new Notes;
$types=$obj->getAllTypesSort('name');
$this_type=$obj->getType($type_nr);

if(!isset($mode)){
	$mode='show';
} elseif($mode=='create'||$mode=='update') {
	include_once($root_path.'include/core/inc_date_format_functions.php');
	# Set the date, default is today
	if(empty($_POST['date'])) $_POST['date']=date('Y-m-d');
		else $_POST['date']=@formatDate2STD($_POST['date'],$date_format);
	$_POST['time']=date('H:i:s');
	include('./include/save_admission_data.inc.php');
}
# Load the emr language table
$lang_tables=array('emr.php');
require('./include/init_show.php');

$page_title.=" :: $LDNotes $LDAndSym $LDReports";

if($parent_admit){
	$sql="SELECT n.nr,n.notes,n.short_notes, n.encounter_nr,n.date,n.personell_nr,n.personell_name,e.encounter_class_nr
		FROM care_encounter AS e, 
			care_person AS p, 
			care_encounter_notes AS n 
		WHERE p.pid=".$_SESSION['sess_pid']." 		
			AND p.pid=e.pid 
			AND e.encounter_nr=".$_SESSION['sess_en']." 
			AND e.encounter_nr=n.encounter_nr 
			AND n.type_nr=".$type_nr."
		ORDER BY n.date DESC";
}else{
	$sql="SELECT n.nr,n.notes,n.short_notes, n.encounter_nr,n.date,n.personell_nr,n.personell_name,e.encounter_class_nr
		FROM care_encounter AS e, 
			care_person AS p, 
			care_encounter_notes AS n
		WHERE	p.pid=".$_SESSION['sess_pid']." 
			AND	p.pid=e.pid 
			AND e.encounter_nr=n.encounter_nr 
			AND n.type_nr=".$type_nr."
		ORDER BY n.date DESC";
}

		
if($result=$db->Execute($sql)){
	$rows=$result->RecordCount();
}else{
	echo $sql;
}

if(isset($$this_type['LD_var'])&&!empty($$this_type['LD_var'])) {
	$subtitle=$$this_type['LD_var'];
}else{
	$subtitle=$this_type['name'];
}

# Tag for help file
$notestype='notes';

$buffer=str_replace('~tag~',$title.' '.$name_last,$LDNoRecordFor);
$norecordyet=str_replace('~obj~',strtolower($subtitle),$buffer); 

/* Hide tabs */
$notabs=true;

/* Load GUI page */
require('./gui_bridge/default/gui_show_notes.php');
?>
