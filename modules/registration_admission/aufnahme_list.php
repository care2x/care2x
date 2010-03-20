<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
 * CARE2X Integrated Hospital Information System beta 2.0.1 - 2004-07-04
 * GNU General Public License
 * Copyright 2002,2003,2004,2005 Elpidio Latorilla
 * elpidio@care2x.org,
 *
 * See the file "copy_notice.txt" for the licence notice
 */

# Default value for the maximum nr of rows per block displayed, define this to the value you wish
# In normal cases this value is derived from the db table "care_config_global" using the "pagin_insurance_list_max_block_rows" element.
define('MAX_BLOCK_ROWS',30); 
define('AUTOSHOW_ONERESULT',1); # Defining to 1 will automatically show the admission data if the search result is one, otherwise the single result will be listed

function Cond($item,$k){
	global $where,$tab,$_POST, $sql_LIKE;
	if(empty($_POST[$item])) return false;
	else{
		if($item == 'current_ward_nr') {
			$buf=" $tab.$item $sql_LIKE '".$_POST[$item]."'";
			if(!empty($where)) $where.=' AND '.$buf;
			else $where=$buf;			
		} else {
			$buf=" $tab.$item $sql_LIKE '".$_POST[$item]."%'";
			if(!empty($where)) $where.=' AND '.$buf;
			else $where=$buf;
		}
	}
}
	
function fCond($item,$k){
	global $orwhere,$tab,$_POST, $sql_LIKE;
	if(empty($_POST[$item])) return false;
	else{
		$buf=" f.class_nr $sql_LIKE '".$_POST[$item]."%'";
		if(!empty($orwhere)) $orwhere.=' OR '.$buf;
		 else $orwhere=$buf;
	}
}


define('LANG_FILE','aufnahme.php');
$local_user='aufnahme_user';
require($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_date_format_functions.php');

//$db->debug=1;

// Initialize page's control variables
if($mode=='paginate'){
	$searchkey=$_SESSION['sess_searchkey'];
}else{
	# Reset paginator variables
	$pgx=0;
	$totalcount=0;
	$odir='';
	$oitem='';
}
#Load and create paginator object
require_once($root_path.'include/care_api_classes/class_paginator.php');
$pagen=& new Paginator($pgx,$thisfile,$_SESSION['sess_searchkey'],$root_path);

$GLOBAL_CONFIG=array();
require_once($root_path.'include/care_api_classes/class_globalconfig.php');
$glob_obj=new GlobalConfig($GLOBAL_CONFIG);	
# Get the max nr of rows from global config
$glob_obj->getConfig('pagin_person_search_max_block_rows');
if(empty($GLOBAL_CONFIG['pagin_person_search_max_block_rows'])) $pagen->setMaxCount(MAX_BLOCK_ROWS); # Last resort, use the default defined at the start of this page
	else $pagen->setMaxCount($GLOBAL_CONFIG['pagin_person_search_max_block_rows']);

if (isset($mode) && ($mode=='search'||$mode=='paginate')){


	if(empty($oitem)) $oitem='name_last';			
	if(empty($odir)) $odir='ASC'; # default, ascending alphabetic
	# Set the sort parameters
	$pagen->setSortItem($oitem);
	$pagen->setSortDirection($odir);

	if($mode=='paginate'){
		$sql=$_SESSION['sess_searchkey'];
		$where='?'; # Dummy char to force the sql query to be executed
	}else{


		$select="SELECT p.name_last,p.name_first,p.date_birth,p.addr_zip, p.sex,e.encounter_nr,e.encounter_class_nr,e.is_discharged,e.encounter_date FROM ";

		$where=''; 		# ANDed where condition
		$orwhere='';	# ORed where condition
		$datecond='';	# date condition
	 
		# Walk the arrays in the function to preprocess the search condition data
		$parray=array('name_last','name_first','sex');
		$tab='p';
		array_walk($parray,'Cond');
		$earray=array('encounter_nr','encounter_class_nr','current_ward_nr','referrer_diagnosis','referrer_dr','referrer_recom_therapy','referrer_notes','insurance_class_nr');
		$tab='e';
		array_walk($earray,'Cond');
		$farray=array('sc_care_class_nr','sc_room_class_nr','sc_att_dr_class_nr');
		array_walk($farray,'fCond');
	
		# Process the dates
		 if(isset($date_start)&&!empty($date_start)) $date_start=@formatDate2STD($date_start,$date_format);
		 if(isset($date_end)&&!empty($date_end)) $date_end=@formatDate2STD($date_end,$date_format);
	 	if(isset($date_birth)&&!empty($date_birth)) $date_birth=@formatDate2STD($date_birth,$date_format);
	
		if($date_start){
			if($date_end){
				$datecond="(e.encounter_date $sql_LIKE '$date_start%' OR e.encounter_date>'$date_start') AND (e.encounter_date<'$date_end' OR e.encounter_date $sql_LIKE '$date_end%')";
			}else{
				$datecond="e.encounter_date $sql_LIKE '$date_start%'";
			}
		}elseif($date_end){
			$datecond="(e.encounter_date< '$date_end' OR e.encounter_date $sql_LIKE '$date_end%')";
		}

		if($date_birth){
			$datecond="(p.date_birth $sql_LIKE '$date_birth%')";
		}
	
		if(!empty($datecond)){
			if(empty($where)) $where=$datecond;
			    else $where.=' AND '.$datecond;
		}
			
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
			if($date_start||$date_end||$encounter_nr||$encounter_class_nr||$current_ward_nr||$referrer_diagnosis||$referrer_dr||$referrer_recom_therapy||$referrer_notes||$insurance_class_nr){
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
	
		//gjergji - hide patient info of other departements
		if(isset($_SESSION['department_nr']) && $_SESSION['department_nr'] != '0' ) {
			$cond.=" AND ( ";
			while (list($key, $val) = each($_SESSION['department_nr'])) {
				$tmp .= "e.current_dept_nr = " . $val . " OR ";

			}
			$cond .= substr($tmp,0,-4) ;
			$cond .= " ) "	;
		}
		$where .= $cond;
		//end : gjergji

		$sql="$select$from WHERE $where AND e.encounter_status <> 'cancelled' AND e.status NOT IN ('void','inactive','hidden','deleted') ORDER by ";
		$_SESSION['sess_searchkey']=$sql;
	
	}

	if(!empty($where)) {
		# Filter the encounter nr:
		if($oitem=='encounter_nr'||$oitem=='encounter_date') $tab='e';
			else $tab='p';
		//echo "$sql $tab.$oitem $odir";
		if($ergebnis=$db->SelectLimit("$sql $tab.$oitem $odir",$pagen->MaxCount(),$pagen->BlockStartIndex())){
  			$rows=$ergebnis->RecordCount();			
			
			if(AUTOSHOW_ONERESULT){					
	        	if($rows==1){
		      		# If result is single item, display the data immediately 
				   	$result=$ergebnis->FetchRow();
				   	header("Location:aufnahme_daten_zeigen.php".URL_REDIRECT_APPEND."&target=archiv&origin=archiv&encounter_nr=".$result['encounter_nr']);
				   	exit;
	        	}
			}
			
			$pagen->setTotalBlockCount($rows);
					
					# If more than one count all available
					if(isset($totalcount)&&$totalcount){
						$pagen->setTotalDataCount($totalcount);
					}else{
						# Count total available data
						$sql="$sql $tab.$oitem $odir";
						
						if($result=$db->Execute($sql)){
							$totalcount=$result->RecordCount();
						}
						$pagen->setTotalDataCount($totalcount);
					}
					# Set the sort parameters
					$pagen->setSortItem($oitem);
					$pagen->setSortDirection($odir);

			
		}else{
			echo "$LDDbNoRead<p>$sql $tab.$oitem $odir";
			$rows=0;
		}
	}
}
require_once($root_path.'include/care_api_classes/class_globalconfig.php');

$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
$glob_obj->getConfig('patient%');
$glob_obj->getConfig('person%');

$thisfile=basename(__FILE__);
$breakfile='patient.php'.URL_APPEND;
$newdata=1;
$target='archiv';


if(!isset($rows)||!$rows) {

	include($root_path.'include/care_api_classes/class_encounter.php');
	include($root_path.'include/care_api_classes/class_ward.php');
	include_once($root_path.'include/care_api_classes/class_insurance.php');

	# Create encounter object
	$encounter_obj=new Encounter();
	# Load the wards info 
	$ward_obj=new Ward;
	$items='nr,name';
	$ward_info=&$ward_obj->getAllWardsItemsObject($items);
	# Get all encounter classes
	$encounter_classes=$encounter_obj->AllEncounterClassesObject();
	# Get the insurance classes */
	# Create new person�s insurance object */
	$insurance_obj=new Insurance;	 
	$insurance_classes=&$insurance_obj->getInsuranceClassInfoObject('class_nr,LD_var,name');

	if(!$GLOBAL_CONFIG['patient_service_care_hide']){
		# Get the care service classes
		$care_service=$encounter_obj->AllCareServiceClassesObject();
	}
	if(!$GLOBAL_CONFIG['patient_service_room_hide']){
		# Get the room service classes 
		$room_service=$encounter_obj->AllRoomServiceClassesObject();
	}
	if(!$GLOBAL_CONFIG['patient_service_att_dr_hide']){
		# Get the attending doctor service classes 
		$att_dr_service=$encounter_obj->AllAttDrServiceClassesObject();
	}
}
# Load GUI page
require('./gui_bridge/default/gui_aufnahme_list.php');
?>
