<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
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
	//$db->debug=true;
	
	$_POST['create_id']=$_SESSION['sess_user_name'];
	
	include('./include/save_immunization.inc.php');
}

require('./include/init_show.php');
if(isset($current_encounter) && $current_encounter) { 
	$parent_admit=true; 
	$is_discharged=false;
	$_SESSION['sess_en'] = $current_encounter;
}
if($mode=='show'){
	$sql="SELECT i.*, t.LD_var AS \"app_LD_var\", t.name AS app_type_name FROM care_encounter AS e, care_person AS p, care_encounter_immunization AS i, care_type_application AS t
		WHERE p.pid=".$_SESSION['sess_pid']." AND p.pid=e.pid AND e.encounter_nr=i.encounter_nr  AND i.application_type_nr=t.nr
		ORDER BY i.modify_time DESC";
		
	if($result=$db->Execute($sql)){
		$rows=$result->RecordCount();
	}else{
		echo $sql;
	}
}

$subtitle=$LDImmunization;
$_SESSION['sess_file_return']=$thisfile;

$buffer=str_replace('~tag~',$title.' '.$name_last,$LDNoRecordFor);
$norecordyet=str_replace('~obj~',strtolower($subtitle),$buffer); 

/* Load GUI page */
require('./gui_bridge/default/gui_show.php');
?>
