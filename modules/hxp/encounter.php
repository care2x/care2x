<?php
//error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
//error_reporting(E_ALL);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');

//define('LANG_FILE','stdpass.php');
//define('NO_CHAIN',1);
//require_once($root_path.'include/inc_front_chain_lang.php');
# Create the encounter object
include($root_path.'include/care_api_classes/class_encounter.php');
$enc = & new Encounter();
# Load the authentication functions
require('./include/inc_access.php');

require_once('./class/xmlrpc/ixr_library.inc.php');

function Enc($args){
	global $enc,$error;
	if(checkAccess($args[0])){
		$enc->loadEncounterData($args[1]);
		#return $enc->loadEncounterData($args[1]);
		if ($enc->is_loaded){
			return $enc->encounter;
		}else{
			$error['error']='_ERROR_SQL_RESULT';
			return $error;
		}
	}else{
		return $error;
	}
}

function _enclist($args,$method){
	global $enc,$error;
	if(checkAccess($args)){
		$buf=$enc->$method('%');
		if ($buf){
			return $buf->GetArray();
		}else{
			$error['error']='_ERROR_SQL_RESULT';
			return $error;
		}
	}else{
		return $error;
	}
}

function EncList($args){
	return _enclist($args,'searchEncounterBasicInfo');
}

function EncOutpatientList($args){
	return _enclist($args,'searchOutpatientBasicInfo');
}

function EncInpatientList($args){
	return _enclist($args,'searchInpatientBasicInfo');
}

function EncSearch($args){
	global $enc,$error;
	if(checkAccess($args[0])){
		$buf=$enc->searchEncounterBasicInfo($args[1]);
		if ($buf){
			return $buf->GetArray();
		}else{
			$error['error']='_ERROR_SQL_RESULT';
			return $error;
		}
	}else{
		return $error;
	}
}

function EncExists($args){
	global $enc,$error;
	if(checkAccess($args[0])){
		$buf=$enc->EncounterExists($args[1]);
		if ($buf){
			return $buf;
		}else{
			return '_ERROR_NORESULT';
		}
	}else{
		return $error['error'];
	}
}

function EncPID($args){
	return EncExists($args);
}

function _encvalue($args,$method){
	global $enc,$error;
	if(checkAccess($args[0])){
		$buf=$enc->$method($args[1]);
		if ($buf){
			return $buf;
		}else{
			return '_ERROR_SQL_RESULT';
		}
	}else{
		return $error['error'];
	}
}
function EncAdmitDate($args){
	return _encvalue($args,'EncounterDate');
}
function EncAdmitType($args){
	return _encvalue($args,'EncounterType');
}

/**
* @private
*/
function _getValue($args,$item){
	global $enc,$error;
	if(checkAccess($args[0])){
		return $enc->getValue($item,$args[1]);
	}else{
		return $error['error'];
	}
}

function EncDischargeDate($args){
	return 1;
}
function EncDischargeTime($args){
	return 1;
}
function EncDischargeType($args){
	return 1;
}
function EncIsDischarge($args){
	return 1;
}
function EncPayType($args){
	return _getvalue($args,'financial_class');
}

function EncDeptCurrentNr($args){
	return _encvalue($args,'CurrentDeptNr');
}

function EncDeptIsIn($args){
	return _encvalue($args,'In_Dept');
}
function EncWardCurrentNr($args){
	return _encvalue($args,'CurrentWardNr');
}
function EncWardIsIn($args){
	return _encvalue($args,'In_Ward');
}
function EncFirmCurrentNr($args){
	return _encvalue($args,'CurrentFirmNr');
}
function EncAttdDr($args){
	return _encvalue($args,'CurrentAttDrNr');
}
function EncConsultingDr($args){
	return _encvalue($args,'ConsultingDr');
}
function EncStatus($args){
	return _encvalue($args,'EncounterStatus');
}
function EncReferer($args){
	return _encvalue($args,'Referer');
}
function EncRefererDept($args){
	return _encvalue($args,'RefererDept');
}
function EncRefererInst($args){
	return _encvalue($args,'RefererInstitution');
}
function EncRefererNotes($args){
	return _encvalue($args,'RefererNotes');
}
function EncRefererDiagnosis($args){
	return _encvalue($args,'RefererDiagnosis');
}
function EncRecomTherapy($args){
	return _encvalue($args,'RefererRecomTherapy');
}
function EncPostEncNotes($args){
	return _encvalue($args,'PostEncounterNotes');
}
function EncFollowUpResp($args){
	return _encvalue($args,'FollowUpResponsibility');
}
function EncFollowUpDate($args){
	return _encvalue($args,'FollowUpDate');
}
function EncExtraService($args){
	return 1;
}
function EncRecStatus($args){
	return _encvalue($args,'RecordStatus');
}
function EncRecHistory($args){
	return _encvalue($args,'RecordHistory');
}

/**
* @private
*/
function _setRecordStatus($args,$stat=''){
	global $enc,$error;
	if(checkAccess($args[0])){
		$enc->setWhereCondition('encounter_nr='.$args[1]);
		$data['status']=$stat;
		$data['modify_time']=date('YmdHis');
		$date['modify_id']=$args[0]['usr'];
		$enc->setDataArray($data);
		if ($enc->updateDataFromInternalArray($args[1])){
			return TRUE;
		}else{
			$error['error']='_ERROR_SQL_RESULT';
			return $error;
		}
	}else{
		return $error;
	}
}

function EncRecHide($args){
	return _setRecordStatus($args,'hidden');
}
function EncRecLock($args){
	return _setRecordStatus($args,'locked');
}
function EncRecDelete($args){
	return _setRecordStatus($args,'deleted');
}
function EncRecNormal($args){
	return _setRecordStatus($args,'normal');
}
function EncRecInvalidate($args){
	return _setRecordStatus($args,'invalid');
}
function EncRecEmpty($args){
	return _setRecordStatus($args);
}


/* Create the server and map the XML-RPC method names to the relevant functions */

$server = new IXR_Server(array(
    'Encounter'=>'Enc',
    'Encounter.List'=>'EncList',
    'Encounter.Outpatient.List'=>'EncOutpatientList',
    'Encounter.Inpatient.List'=>'EncInpatientList',
    'Encounter.Exists'=>'EncExists',
    'Encounter.Search'=>'EncSearch',
    'Encounter.Status'=>'EncStatus',
    'Encounter.PID'=>'EncPID',
    'Encounter.Admission.Date'=>'EncAdmitDate',
    'Encounter.Admission.Type'=>'EncAdmitType',
    'Encounter.Discharge.Time'=>'EncDischargeTime',
    'Encounter.Discharge.Is'=>'EncIsDischarge',
    'Encounter.Discharge.Type'=>'EncDischargeType',
    'Encounter.Discharge.Type'=>'EncDischargeType',
    'Encounter.Payment.Type'=>'EncPayType',
    'Encounter.Dept.Current.Nr'=>'EncDeptCurrentNr',
    'Encounter.Firm.Current.Nr'=>'EncFirmCurrentNr',
    'Encounter.Doctor.Attending'=>'EncAttdDr',
    'Encounter.Doctor.Consulting'=>'EncConsultingDr',
    'Encounter.Referer'=>'EncReferer',
    'Encounter.Referer.Diagnosis'=>'EncRefererDiagnosis',
    'Encounter.Referer.Therapy.Recommend'=>'EncRecomTherapy',
    'Encounter.Referer.Notes'=>'EncRefererNotes',
    'Encounter.Referer.Dept'=>'EncRefererDept',
    'Encounter.Referer.Institution'=>'EncRefererInst',
    'Encounter.Dept.Is.In'=>'EncDeptIsIn',
    'Encounter.Ward.Current.Nr'=>'EncWardCurrentNr',
    'Encounter.Ward.Is.In'=>'EncWardIsIn',
    'Encounter.Followup.Date'=>'EncFollowUpDate',
    'Encounter.Followup.Responsibility'=>'EncFollowUpResp',
    'Encounter.Post.Notes'=>'EncPostNotes',
    'Encounter.Service.Extra'=>'EncExtraService',
    'Encounter.Record.Status'=>'EncRecStatus',
    'Encounter.Record.Status.Hide'=>'EncRecHide',
    'Encounter.Record.Status.Lock'=>'EncRecLock',
    'Encounter.Record.Status.Delete'=>'EncRecDelete',
    'Encounter.Record.Status.Normalize'=>'EncRecNormalize',
    'Encounter.Record.Status.Invalidate'=>'EncRecInvalidate',
    'Encounter.Record.History'=>'EncRecHistory',
    'Encounter.Pregnancy'=>'EncWardIsIn',
    'Encounter.Followup.Responsible'=>'EncFollowUpResp'
));

?>
