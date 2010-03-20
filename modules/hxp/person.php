<?php
//error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
//error_reporting(E_ALL);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
//define('LANG_FILE','stdpass.php');
//define('NO_CHAIN',1);
//require_once($root_path.'include/inc_front_chain_lang.php');
include($root_path.'include/care_api_classes/class_person.php');
$person = & new Person();

require('./include/inc_access.php');

require_once('./class/xmlrpc/ixr_library.inc.php');

function Person($args){

	global $person,$error;
	if(checkAccess($args[0])){
		$buf= $person->getAllInfoArray($args[1]);
		if($buf){
			 return $buf;
		}else{
			$error['error']='_ERROR_SQL_RESULT';
			return $error;
		}
	}else{
		return $error;
	}

}
function PersonBasic($args){
	global $person,$error;
	if(checkAccess($args[0])){
		$buf= $person->BasicDataArray($args[1]);
		if($buf){
			 return $buf;
		}else{
			$error['error']='_ERROR_SQL_RESULT';
			return $error;
		}
	}else{
		return $error;
	}

}
function PersonExists($args){
	global $person,$error;
	if(checkAccess($args[0])){
		$buf= $person->PIDbyData($args[1]);
		if($buf){
			 return $buf;
		}else{
			$error['error']='_ERROR_SQL_RESULT';
			return $error;
		}
	}else{
		return $error;
	}

}
/**
* @private
*/
function _getPersonData($item,$hdr){
	global $person,$error;
	if(checkAccess($hdr[0])){
		$buf=$person->getValue($item,$hdr[1]);
		return $buf;
	}else{
		return $error['error'];
	}
}
function PersonNameFirst($args){
	return _getPersonData('name_first',$args);
}

function PersonNameFamily($args){
	return _getPersonData('name_last',$args);
}

function PersonNameMiddle($args){
	return _getPersonData('name_middle',$args);
}

function PersonNameMaiden($args){
	return _getPersonData('name_maiden',$args);
}

function PersonNameSecond($args){
	return _getPersonData('name_2',$args);
}

function PersonNameThird($args){
	return _getPersonData('name_3',$args);
}

function PersonNameOthers($args){
	return _getPersonData('name_others',$args);
}
function PersonBloodGroup($args){
	return _getPersonData('blood_group',$args);
}
function PersonSex($args){
	return _getPersonData('sex',$args);
}
function PersonBirthDate($args){
	return _getPersonData('date_birth',$args);
}
function PersonTitle($args){
	return _getPersonData('title',$args);
}
function PersonDiedDate($args){
	return _getPersonData('death_date',$args);
}
function PersonDiedENR($args){
	return _getPersonData('death_encounter_nr',$args);
}
function PersonDiedCause($args){
	return _getPersonData('death_cause',$args);
}
function PersonDiedCauseCode($args){
	return _getPersonData('death_cause_code',$args);
}
function PersonRegDate($args){
	return _getPersonData('date_reg',$args);
}
function PersonCitizenship($args){
	return _getPersonData('citizenship',$args);
}
function PersonCivilStatus($args){
	return _getPersonData('civil_status',$args);
}

function PersonAddrs($args){
	global $person,$error;

	if(checkAccess($args[0])){
		$item='addr_str, addr_str_nr, addr_citytown_nr, addr_zip';
		$buf=$person->getValueByList($item,$args[1]);
		if($buf){
			if($buf['addr_citytown_nr']) $buf['addr_citytown_name']=$person->CityTownName($buf['addr_citytown_nr']);
				else $buf['addr_citytown_name']='';
			return $buf;
		}else{
			$error['error']='_ERROR_SQL_RESULT';
			return $error;
		}
	}else{
		return $error;
	}
}

function PersonAddrsTxt($args){
	global $error;
	# Get the address data
	$buf=PersonAddrs($args);
	if($buf&&(!isset($buf['error'])||!$buf['error'])){
		# If city town name ok, get the city town name
		return $buf['addr_str']." ".$buf['addr_str_nr']."\n".$buf['addr_zip']." ".$buf['addr_citytown_name'];
	}else{
		return $error['error'];
	}
}

function PersonAddrsStr($args){
	return _getPersonData('addr_str',$args);
}
function PersonAddrsStrNr($args){
	return _getPersonData('addr_str_nr',$args);
}
function PersonAddrsCTown($args){
	return 1;
}
function PersonAddrsZip($args){
	return _getPersonData('addr_zip',$args);
}
function PersonAddrsValid($args){
	return _getPersonData('addr_is_valid',$args);
}
function PersonPhone1($args){
	return _getPersonData('phone_1_nr',$args);
}
function PersonPhoneACode1($args){
	return _getPersonData('phone_1_code',$args);
}
function PersonPhone2($args){
	return _getPersonData('phone_2_nr',$args);
}
function PersonPhoneACode2($args){
	return _getPersonData('phone_2_code',$args);
}
function PersonCellPhone1($args){
	return _getPersonData('cellphone_1_nr',$args);
}
function PersonCellPhone2($args){
	return _getPersonData('cellphone_2_nr',$args);
}
function PersonFaxNr($args){
	return _getPersonData('fax',$args);
}
function PersonMotherPID($args){
	return _getPersonData('mother_pid',$args);
}
function PersonFatherPID($args){
	return _getPersonData('father_pid',$args);
}
function PersonRecStatus($args){
	return _getPersonData('status',$args);
}
function PersonRecHistory($args){
	return _getPersonData('history',$args);
}
function PersonContact($args){
	return _getPersonData('contact_person',$args);
}
function PersonContactPID($args){
	return _getPersonData('contact_pid',$args);
}
function PersonContactRelation($args){
	return _getPersonData('date_update',$args);
}
function PersonUpdateDate($args){
	return _getPersonData('date_update',$args);
}
function PersonSSNr($args){
	return _getPersonData('sss_nr',$args);
}
function PersonNatIDNr($args){
	return _getPersonData('nat_id_nr',$args);
}
function PersonOrgID($args){
	return _getPersonData('org_id',$args);
}
function PersonReligion($args){
	return _getPersonData('religion',$args);
}
function PersonPhoto($args){
	return _getPersonData('photo',$args);
}
function PersonPhotoFilename($args){
	return _getPersonData('photo_filename',$args);
}
function PersonEthnicOrig($args){
	return _getPersonData('ethnic_orig',$args);
}

function PersonInsClassNr($args){
	return _getPersonData('insurance_class_nr',$args);
}
function PersonInsNr1($args){
	return _getPersonData('insurance_nr',$args);
}
function PersonInsCoID1($args){
	return _getPersonData('insurance_firm_id',$args);
}
function PersonInsNr2($args){
	return _getPersonData('insurance_2_nr',$args);
}
function PersonInsCoID2($args){
	return _getPersonData('insurance_2_firm_id',$args);
}

function PersonAdd($args){
	return 1;
}


function PersonUpdate($args){
	return 1;
}

/**
* @private
*/
function _setRecordStatus($args,$stat=''){
	global $enc,$error;
	if(checkAccess($args[0])){
		$person->setWhereCondition('encounter_nr='.$args[1]);
		$data['status']=$stat;
		$data['modify_time']=date('YmdHis');
		$date['modify_id']=$args[0]['usr'];
		$person->setDataArray($data);
		if ($person->updateDataFromInternalArray($args[1])){
			return TRUE;
		}else{
			$error['error']='_ERROR_SQL_RESULT';
			return $error;
		}
	}else{
		return $error;
	}
}

function PersonRecHide($args){
	return _setRecordStatus($args,'hidden');
}
function PersonRecLock($args){
	return _setRecordStatus($args,'locked');
}
function PersonRecDelete($args){
	return _setRecordStatus($args,'deleted');
}
function PersonRecNormal($args){
	return _setRecordStatus($args,'normal');
}
function PersonRecInvalidate($args){
	return _setRecordStatus($args,'invalid');
}
function PersonRecEmpty($args){
	return _setRecordStatus($args);
}

function PersonList($args){
	return 1;
}

function PersonEnc($args){
	global $person, $error;
	if(checkAccess($args[0])){
		$buf=$person->EncounterList($args[1]);
		if($buf){
			return $buf->GetArray();
		}else{
			$error['error']='_ERROR_SQL_RESULT';
			return $error;
		}
	}else{
		return $error;
	}
}

function PersonEncSearch($args){
	return 1;
}

function PersonSearch($args){
	global $person,$error;
	if(checkAccess($args[0])){

		$buf=$person->Persons($args[1]);
		if($buf){
			return $buf->GetArray();
		}else{
			$error['error']='_ERROR_SQL_RESULT';
			return $error;
		}
	}else{
		return $error;
	}
}
function PersonSearchSelect($args){
	global $person,$error;
	if(checkAccess($args[0])){
		if(!isset($args[2])) $args[2]=100;
		if(!isset($args[3])) $args[3]=0;
		if(!isset($args[4])) $args[4]='';
		if(!isset($args[5])) $args[5]='';
		if(!isset($args[6])) $args[6]=FALSE;
		$buf=$person->SearchSelect($args[1],$args[2],$args[3],$args[4],$args[5],$args[6]);
		if($buf){
			return $buf->GetArray();
		}else{
			$error['error']='_ERROR_SQL_RESULT';
			return $error;
		}
	}else{
		return $error;
	}
}
function PersonEncCurrNr($args){
	global $person,$error;
	if(checkAccess($args[0])){
		$buf=$person->CurrentEncounter($args[1]);
		if($buf){
			return $buf;
		}else{
			return '_ERROR_RESULT';
		}
	}else{
		return $error['error'];
	}
}

function PersonAppt($args){
	return 1;
}
function PersonApptList($args){
	global $error,$root_path;
	include($root_path.'include/care_api_classes/class_appointment.php');
	$appt=& new Appointment();
	if(checkAccess($args[0])){
		$buf=$appt->getPersonsAppointmentsObj($args[1]);
		if($buf){
			return $buf->GetArray();
		}else{
			return '_ERROR_RESULT';
		}
	}else{
		return $error;
	}
}
/* Create the server and map the XML-RPC method names to the relevant functions */

$server = new IXR_Server(array(
    'Person'=>'Person',
    'Person.Basic'=>'PersonBasic',
    'Person.Exists'=>'PersonExists',    
    'Person.List'=>'PersonList',
    'Person.Encounter'=>'PersonEnc',
    'Person.Encounter.Search'=>'PersonEncSearch',
    'Person.Search'=>'PersonSearch',
    'Person.Search.Select'=>'PersonSearchSelect',
    'Person.Name.First'=>'PersonNameFirst',
    'Person.Name.Family'=>'PersonNameFamily',
    'Person.Name.Middle'=>'PersonNameMiddle',
    'Person.Name.Maiden'=>'PersonNameMaiden',
    'Person.Name.Second'=>'PersonNameSecond',
    'Person.Name.Third'=>'PersonNameThird',
    'Person.Name.Others'=>'PersonNameOthers',
    'Person.Birth.Date'=>'PersonBirthDate',
    'Person.Birth.Details'=>'PersonBirthDetails',
    'Person.Died.Date'=>'PersonDiedDate',
    'Person.Registry.Date'=>'PersonRegDate',
    'Person.Appointment'=>'PersonAppt',
    'Person.Appointment.List'=>'PersonApptList',
    'Person.Address'=>'PersonAddrs',
    'Person.Address.FullText'=>'PersonAddrsTxt',
    'Person.Address.Street'=>'PersonAddrsStr',
    'Person.Address.Street.Nr'=>'PersonAddrsStrNr',
    'Person.Address.CityTown'=>'PersonAddrsCTown',
    'Person.Address.Zip'=>'PersonAddrsZip',
    'Person.Address.Email'=>'PersonAddrEmail',
    'Person.Phone.1'=>'PersonPhone1',
    'Person.Phone.1.Area.Code'=>'PersonPhoneACode1',
    'Person.Phone.2'=>'PersonPhone2',
    'Person.Phone.2.Area.Code'=>'PersonPhoneACode2',
    'Person.Phone.Cell.1'=>'PersonCellPhone1',
    'Person.Phone.Cell.2'=>'PersonCellPhone2',
    'Person.Fax.Nr'=>'PersonFaxNr',
    'Person.Blood.Group'=>'PersonBloodGroup',
    'Person.Mother.PID'=>'PersonAddr',
    'Person.Father.PID'=>'PersonAddr',
    'Person.Contact'=>'PersonContact',
    'Person.Contact.PID'=>'PersonContactPID',
    'Person.Contact.Relation'=>'PersonContactRelation',
    'Person.Org.ID'=>'PersonOrgID',
    'Person.SS.Nr'=>'PersonContactRelation',
    'Person.National.ID.Nr'=>'PersonContactRelation',
    'Person.Photo'=>'PersonPhoto',
    'Person.Photo.Filename'=>'PersonPhotoFilename',
    'Person.Religion'=>'PersonReligion',
    'Person.Ethnic.Origin'=>'PersonEthnicOrig',
    'Person.Insurance.1.Nr'=>'PersonInsNr1',
    'Person.Insurance.1.Co.ID'=>'PersonInsCoID1',
    'Person.Insurance.2.Nr'=>'PersonInsNr2',
    'Person.Insurance.2.Co.ID'=>'PersonInsCoID2',
    'Person.Add'=>'PersonAdd',
    'Person.Update'=>'PersonUpdate',
    'Person.Record.Update.Date'=>'PersonRecUpdateDate',
    'Person.Record.Status'=>'PersonRecStatus',
    'Person.Record.Status.Hide'=>'PersonRecHide',
    'Person.Record.Status.Lock'=>'PersonRecLock',
    'Person.Record.Status.Delete'=>'PersonRecDelete',
    'Person.Record.Status.Normalize'=>'PersonRecNormalize',
    'Person.Record.Status.Invalidate'=>'PersonRecInvalidate',
    'Person.Record.History'=>'PersonRecHistory',
    'Person.Encounter.Current.Nr'=>'PersonEncCurrNr'
));

?>
