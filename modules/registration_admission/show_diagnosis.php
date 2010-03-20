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
	/* empty temp */
}

if($lang=='de') $icdlang=$lang;
	else $icdlang='en';
	
$lang_tables=array('drg.php');
require('./include/init_show.php');

$m_sql="SELECT d.*, c.description, pr.description AS parent_desc,
			cat.LD_var AS cat_LD_var, 
			cat.LD_var_short_code AS cat_LD_var_short_code, 
			cat.short_code AS cat_short_code, 
			cat.name AS cat_name,
			loc.LD_var AS loc_LD_var, 
			loc.LD_var_short_code AS loc_LD_var_short_code, 
			loc.short_code AS loc_short_code,
			loc.name AS loc_name
		FROM   ( care_person AS p , care_encounter AS e, care_encounter_diagnosis AS d, care_icd10_$icdlang AS c )
			LEFT JOIN care_icd10_$icdlang AS pr ON d.code_parent=pr.diagnosis_code
			LEFT JOIN care_category_diagnosis AS cat ON d.category_nr=cat.nr
			LEFT JOIN care_type_localization AS loc ON d.localization=loc.nr";

if($parent_admit){

	$sql=$m_sql." WHERE p.pid='".$_SESSION['sess_pid']."' 
		 	AND p.pid=e.pid 
		 	AND e.encounter_nr='".$_SESSION['sess_en']."'
			AND e.encounter_nr=d.encounter_nr
		 	AND d.code=c.diagnosis_code
		 ORDER BY d.modify_time DESC";
}else{
	$sql=$m_sql." WHERE  p.pid='".$_SESSION['sess_pid']."' 
		 	AND p.pid=e.pid 
			AND e.encounter_nr=d.encounter_nr 
			AND d.code=c.diagnosis_code
		 ORDER BY d.modify_time DESC";
}

if($result=$db->Execute($sql)){
	$rows=$result->RecordCount();
}else{
	echo $sql;
}

$subtitle=$LDDiagnoses;
$_SESSION['sess_file_return']=$thisfile;

$buffer=str_replace('~tag~',$title.' '.$name_last,$LDNoRecordFor);
$norecordyet=str_replace('~obj~',strtolower($subtitle),$buffer); 

/* Load GUI page */
require('./gui_bridge/default/gui_show.php');
?>
