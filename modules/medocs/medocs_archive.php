<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/

define('AUTOSHOW_ONERESULT',0);

function Cond($item,$k){
	global $where,$tab,$_POST;
	if(empty($_POST[$item])) return false;
	else{
		$buf=" $tab.$item LIKE \"".$_POST[$item]."%\"";
		if(!empty($where)) $where.=' AND '.$buf;
		 else $where=$buf;
	}
}
	
function fCond($item,$k){
	global $orwhere,$tab,$_POST;
	if(empty($_POST[$item])) return false;
	else{
		$buf=" f.class_nr LIKE \"".$_POST[$item]."%\"";
		if(!empty($orwhere)) $orwhere.=' OR '.$buf;
		 else $orwhere=$buf;
	}
}


define('LANG_FILE','aufnahme.php');
$local_user='medocs_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');
require_once($root_path.'include/core/inc_config_color.php');
require_once($root_path.'include/core/inc_date_format_functions.php');




if (isset($mode) && ($mode=='search'))
{
    if(!isset($db) || !$db) include_once($root_path.'include/core/inc_db_makelink.php');
    if($dblink_ok) {
	
	$select="SELECT p.name_last,p.name_first,p.date_birth,e.encounter_nr,e.encounter_class_nr,e.is_discharged,e.encounter_date FROM ";

	 $where='';
	 $orwhere='';

	$parray=array('name_last','name_first','date_birth','sex');
	$tab='p';
	array_walk($parray,'Cond');
	$earray=array('encounter_nr','encounter_class_nr','current_ward_nr','referrer_diagnosis','referrer_dr','referrer_recom_therapy','referrer_notes','insurance_class_nr');
	$tab='e';
	array_walk($earray,'Cond');
	$farray=array('sc_care_class_nr','sc_room_class_nr','sc_att_dr_class_nr');
	array_walk($farray,'fCond');
	
	if(!empty($orwhere)) {
		if(empty($where)) $where='('.$orwhere.')';
		    else $where.=' AND ('.$orwhere.') ';
	}
	
	
	
	if($name_last||$name_first||$date_birth||$sex){
		if($encounter_nr||$encounter_class_nr||$current_ward_nr||$referrer_diagnosis||$referrer_dr||$referrer_recom_therapy||$referrer_notes||$insurance_class_nr){
			if($sc_care_class_nr||$sc_room_class_nr||$sc_att_dr_class_nr){
	        	$from=" care_person AS p, care_encounter AS e, care_encounter_financial_class AS f ";
				$where.=" AND e.encounter_nr=f.encounter_nr AND e.pid=p.pid ";
			}else{
				$from=" care_person AS p, care_encounter AS e";
				$where.=" AND p.pid=e.pid";
			}
		}else{
			$from=" care_person AS p, care_encounter AS e";
			$where.=" AND p.pid=e.pid";
		}
				
	}else{
		if($encounter_nr||$encounter_class_nr||$current_ward_nr||$referrer_diagnosis||$referrer_dr||$referrer_recom_therapy||$referrer_notes||$insurance_class_nr){
			if($sc_care_class_nr||$sc_room_class_nr||$sc_att_dr_class_nr){
				$from=" care_person AS p, care_encounter AS e, care_encounter_financial_class AS f";
				$where.=" AND p.pid=e.pid AND e.encounter_nr=f.encounter_nr";
			}else{
				$from="  care_person AS p, care_encounter AS e";
				$where.=" AND p.pid=e.pid";
			}
		}else{
			if($sc_care_class_nr||$sc_room_class_nr||$sc_att_dr_class_nr){
				$from="  care_person AS p, care_encounter AS e, care_encounter_financial_class as f";
				$where.=" AND p.pid=e.pid AND f.encounter_nr=e.encounter_nr";
			}
		}
	}
	
	if(!empty($where)) {

		$sql=$select.$from.' WHERE '.$where.' ORDER by e.create_time DESC';
		if($ergebnis=$db->Execute($sql)) {			
  			$rows=$ergebnis->RecordCount();			
			
			if(AUTOSHOW_ONERESULT){					
	        	if($rows==1){
		      	 //// If result is single item, display the data immediately 
			   	$result=$ergebnis->FetchRow();
			   	header("Location:aufnahme_daten_zeigen.php".URL_REDIRECT_APPEND."&target=archiv&origin=archiv&encounter_nr=".$result['encounter_nr']);
			   	exit;
	        	}
			}
		}else { echo $sql; $rows=0;}
	}
					
  }
  else 
  { echo "$LDDbNoLink<br>"; }

}
require_once($root_path.'include/care_api_classes/class_globalconfig.php');

$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
$glob_obj->getConfig('patient%');
$glob_obj->getConfig('person%');

$thisfile=basename(__FILE__);
$breakfile='patient.php';
$newdata=1;
$target='archiv';

if(!AUTOSHOW_ONERESULT) {

	include($root_path.'include/care_api_classes/class_encounter.php');
	include($root_path.'include/care_api_classes/class_ward.php');
	include($root_path.'include/care_api_classes/class_insurance.php');

	/* Create encounter object */
	$encounter_obj=new Encounter();
	/* Load the wards info */
	$ward_obj=new Ward;
	$items='nr,name';
	$ward_info=&$ward_obj->getAllWardsItemsObject($items);
	/* Create new person's insurance object */
	$insurance_obj=new Insurance;	 
	/* Get the insurance classes */
	$insurance_classes=&$insurance_obj->getInsuranceClassInfoObject($root_path.'include/care_api_classes/class_nr,name,LD_var');
		/* Get all encounter classes */
	$encounter_classes=$encounter_obj->AllEncounterClassesObject();

	if(!$GLOBAL_CONFIG['patient_service_care_hide']){
		/* Get the care service classes*/
		$care_service=$encounter_obj->AllCareServiceClassesObject();
	}
	if(!$GLOBAL_CONFIG['patient_service_room_hide']){
		/* Get the room service classes */
		$room_service=$encounter_obj->AllRoomServiceClassesObject();
	}
	if(!$GLOBAL_CONFIG['patient_service_att_dr_hide']){
		/* Get the attending doctor service classes */
		$att_dr_service=$encounter_obj->AllAttDrServiceClassesObject();
	}			
}


/* Load GUI page */
require('./gui_bridge/default/gui_medocs_archive.php');

?>
