<?php
/**
* XML-RPC server for HXP. Version 0.1
* Licence LGPL
* Copyright 2004,2005 Elpidio Latorilla <elpidio@care2.net>
* This server works only with the Incutio IXR library to be found at
* http://scripts.incutio.com/xmlrpc/
*
* Usage:
* Create a subdirectory in your web server root and name it "hxp"
* Copy this file into this subdirectory.
*
* Other files that must be copied in the subdirectory:
*  ixr_library.inc.php
*  person.php
*  encounter.php
*  ward.php
*  department.php
*  room.php
*  system.php
*  emr.php
*  anon.php
*
*/
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
//error_reporting(E_ALL);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');

//include($root_path.'include/care_api_classes/class_core.php');
//$core = & new Core();
include($root_path.'include/care_api_classes/class_person.php');
$person = & new Person();
# Create the encounter object
include($root_path.'include/care_api_classes/class_encounter.php');
$enc = & new Encounter();

#Create the image object
include($root_path.'include/care_api_classes/class_image.php');
$img= & new Image();

require('./include/inc_access.php');

require_once('./class/xmlrpc/ixr_library.inc.php');


function Person($args){

	global $person,$error;
	if(checkAccess($args[0])){
		$buf= $person->getAllInfoArray($args[1]);
		if($buf){
			 return $buf;
		}else{
			return new IXR_Error(1006,'_ERROR_NORESULT');
		}
	}else{
		return new IXR_Error($error['code'],$error['msg']);
	}

}
function PersonBasic($args){
	global $person,$error;
	if(checkAccess($args[0])){
		$buf= $person->BasicDataArray($args[1]);
		if($buf){
			 return $buf;
		}else{
			return new IXR_Error(1006,'_ERROR_NORESULT');
		}
	}else{
		return new IXR_Error($error['code'],$error['msg']);
	}

}
function PersonInfostring($args){
	global $person,$error;
	if(checkAccess($args[0])){
		$buf= $person->BasicDataArray($args[1]);
		if($buf){
			$infostr=$buf['name_last'].', '.$buf['name_first'].' '.$buf['date_birth'];
			 return $infostr;
		}else{
			return new IXR_Error(1006,'_ERROR_NORESULT');
		}
	}else{
		return new IXR_Error($error['code'],$error['msg']);
	}

}
function PersonExists($args){
	global $person,$error;
	if(checkAccess($args[0])){
		$buf= $person->PIDbyData($args[1]);
		if($buf){
			 return $buf;
		}else{
			return new IXR_Error(1006,'_ERROR_NORESULT');
		}
	}else{
		return new IXR_Error($error['code'],$error['msg']);
	}
}

function PersonSave($args){
	global $person,$error;

	if(checkAccess($args[0])){
		# Validate at least name, first name, and DOB
		if(empty($args[1]['name_last'])||empty($args[1]['name_first'])||empty($args[1]['birth_date'])){
			return new IXR_Error(1006,'_ERROR_DATA_INCOMPLETE');
		}else{
			# Prepare internal info
			$args[1]['status']='normal';
			$args[1]['history']="Create ".date('Y-m-d H:i:s')." ".$args[0]['usr']."\n";
			$args[1]['create_id']=$args[0]['usr'];
			$args[1]['create_time']=date('YmdHis');
			# Point the db table to care_person
			//$care->setDataArray='care_person';
			# Save the data
			if($person->insertDataFromArray($args[1])){
				return TRUE;
			}else{
				return new IXR_Error(1006,'_ERROR_SQL_NOINSERT');
			}
		}
	}else{
		return new IXR_Error($error['code'],$error['msg']);
	}
}
function PersonUpdate($args){
	global $person,$error;

	if(checkAccess($args[0])){
		# Validate  the pid
		if(empty($args[1]['pid'])){
			return new IXR_Error(1006,'_ERROR_DATA_INCOMPLETE');
		}else{
			# Prepare internal info
			$args[1]['status']='normal';
			$args[1]['history']="Create ".date('Y-m-d H:i:s')." ".$args[0]['usr']."\n";
			$args[1]['create_id']=$args[0]['usr'];
			$args[1]['create_time']=date('YmdHis');
			# Set the where info
			$person->setWhere('pid='.$args[1]['pid']);
			$person->setDataArray($args[1]);
			# Update the data
			if($person->upateDataFromInternalArray($args[1]['pid'])){
				return TRUE;
			}else{
				return new IXR_Error(1006,'_ERROR_SQL_NOUPDATE');
			}
		}
	}else{
		return new IXR_Error($error['code'],$error['msg']);
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
		return new IXR_Error($error['code'],$error['msg']);
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
			return new IXR_Error(1006,'_ERROR_NORESULT');
		}
	}else{
		return new IXR_Error($error['code'],$error['msg']);
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
		return new IXR_Error($error['code'],$error['msg']);
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


function _setPersonRecStatus($args,$stat=''){
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
			return new IXR_Error(1006,'_ERROR_NORESULT');
		}
	}else{
		return new IXR_Error($error['code'],$error['msg']);
	}
}

function PersonRecHide($args){
	return _setPersonRecStatus($args,'hidden');
}
function PersonRecLock($args){
	return _setPersonRecStatus($args,'locked');
}
function PersonRecDelete($args){
	return _setPersonRecStatus($args,'deleted');
}
function PersonRecNormal($args){
	return _setPersonRecStatus($args,'normal');
}
function PersonRecInvalidate($args){
	return _setPersonRecStatus($args,'invalid');
}
function PersonRecEmpty($args){
	return _setPersonRecStatus($args);
}

function PersonList($args){
	global $person, $error;
	
	if(checkAccess($args)){
		# Set field names of items to fetch
		$items='pid, name_last, name_first, date_birth,  addr_zip, sex,  death_date, status';

		if($buf=$person->getAllItemsObject($items)){
			return $buf->GetArray();
		}else{
			return new IXR_Error(1006,'_ERROR_NORESULT');
		}
	}else{
		return new IXR_Error($error['code'],$error['msg']);
	}
}

function PersonEnc($args){
	global $person, $error;
	if(checkAccess($args[0])){
		$buf=$person->EncounterList($args[1]);
		if($buf){
			return $buf->GetArray();
		}else{
			return new IXR_Error(1006,'_ERROR_NORESULT');
		}
	}else{
		return new IXR_Error($error['code'],$error['msg']);
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
			return new IXR_Error(1006,'_ERROR_NORESULT');
		}
	}else{
		return new IXR_Error($error['code'],$error['msg']);
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
			return new IXR_Error(1006,'_ERROR_NORESULT');
		}
	}else{
		return new IXR_Error($error['code'],$error['msg']);
	}
}
function PersonEncCurrNr($args){
	global $person,$error;
	if(checkAccess($args[0])){
		$buf=$person->CurrentEncounter($args[1]);
		if($buf){
			return $buf;
		}else{
			return new IXR_Error(1006,'_ERROR_NORESULT');
		}
	}else{
		return new IXR_Error($error['code'],$error['msg']);
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
			//return true;
		}else{
			return new IXR_Error(1006,'_ERROR_NORESULT');
		}
	}else{
		return new IXR_Error($error['code'],$error['msg']);
	}

}

function PersonPhotoIDURL($args){
	global $error,$root_path, $person,$db, $httprotocol,$fotoserver_ip;

	if(checkAccess($args[0])){

		include($root_path.'global_conf/inc_remoteservers_conf.php');

		# Prepare the url path for the image
		$d = $fotoserver_http."uploads/registration/";

		$sql="SELECT photo_filename FROM $person->coretable WHERE pid=".$args[1];

		if($f=$db->Execute($sql)){
			if($f->RecordCount()){
				$buf=$f->FetchRow();
				if(empty($buf['photo_filename'])||!file_exists($root_path.'uploads/photos/registration/'.$buf['photo_filename'])){
					return new IXR_Error(1107,'_ERROR_FILE_NOEXISTS');
				}else{
					return $d.$buf['photo_filename'];
				}
			}else{
				return new IXR_Error(1005,'_ERROR_NORESULT');
			}
		}else{
			return new IXR_Error(1006,'_ERROR_SQL_QUERY');
		}
	}else{
		return new IXR_Error($error['code'],$error['msg']);
	}
}

function PersonImageAdd($args){
	return PersonPhotoIDSave($args);
}


function PersonPhotoIDSave($args){
	global $root_path, $img, $error, $person, $httprotocol, $main_domain;
	
	$type='registration';
	$picdir= $args[1];

	if(checkAccess($args[0])){
		include($root_path.'global_conf/inc_remoteservers_conf.php');

		$d=$root_path."fotos/$type/";

		# Try to get the extension
		if(empty($args[2]['ext'])){
			if(!empty($args[2]['mime_type'])){
				if(stristr($args[2]['mime_type'],'gif')){
					$picext='gif';
				}elseif(stristr($args[2]['mime_type'],'jpg')){
					$picext='jpg';
				}elseif(stristr($args[2]['mime_type'],'jpeg')){
					$picext='jpeg';
				}elseif(stristr($args[2]['mime_type'],'png')){
					$picext='png';
				}
			}
		}else{
			$picext = $args[2]['ext'];
		}
		if(!empty($picext)&&(stristr($picext,'gif')||stristr($picext,'jpg')||stristr($picext,'png')||stristr($picext,'jpeg'))){

			$data['photo_filename']="$picdir.$picext";
			$data['history']=$person->ConcatHistory("PhotoID uploaded via HXP: ".date('Y-m-d H:i:s')." ".$args[0]['usr']."\n");
			$data['modify_id']=$args[0]['usr'];
			$data['modify_time']=date('YmdHis');

			$person->setDataArray($data);
			$person->setWhereCondition("pid=".$picdir);

			if($person->updateDataFromInternalArray($picdir)){
				# Create the filename
				$picfilename = $data['photo_filename'];

				$newfilepath="$d/$picfilename";

				if($fp=fopen($newfilepath,'wb')){
					fwrite($fp,base64_decode($args[2]['img']));
					fclose($fp);
					return "$fotoserver_http$type/$picfilename";
				}else{

					# Delete the table record
					$img->Transact("DELETE FROM care_encounter_image WHERE nr=$picnr");
					return $d;
					return new IXR_Error(1100,'_ERROR_FILE_NOCREATE');
				}
			}else{
				return new IXR_Error(1108,'_ERROR_SQL_NOSAVE');
			}
		}else{
			return new IXR_Error(1105,'_ERROR_FILE_INVALID');
		}
	}else{
		return new IXR_Error($error['code'],$error['msg']);
	}
}
//################ Encounter Calls #######################


function Enc($args){
	global $enc,$error;
	if(checkAccess($args[0])){
		$enc->loadEncounterData($args[1]);
		#return $enc->loadEncounterData($args[1]);
		if ($enc->is_loaded){
			return $enc->encounter;
		}else{
			return new IXR_Error(1006,'_ERROR_NORESULT');
		}
	}else{
		return new IXR_Error($error['code'],$error['msg']);
	}
}

function EncInfostring($args){
	global $enc,$error;
	if(checkAccess($args[0])){
		$enc->loadEncounterData($args[1]);
		#return $enc->loadEncounterData($args[1]);
		if ($enc->is_loaded){
			$infostr =$enc->encounter['name_last'].', '.$enc->encounter['name_first'].' '.$enc->encounter['date_birth'].' PID: '.$enc->encounter['pid'];
			return $infostr;
		}else{
			return new IXR_Error(1006,'_ERROR_NORESULT');
		}
	}else{
		return new IXR_Error($error['code'],$error['msg']);
	}
}

function _enclist($args,$method){
	global $enc,$error;
	if(checkAccess($args)){
		$buf=$enc->$method('%');
		if ($buf){
			return $buf->GetArray();
		}else{
			return new IXR_Error(1006,'_ERROR_NORESULT');
		}
	}else{
		return new IXR_Error($error['code'],$error['msg']);
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
			return new IXR_Error(1006,'_ERROR_NORESULT');
		}
	}else{
		return new IXR_Error($error['code'],$error['msg']);
	}
}

function EncExists($args){
	global $enc,$error;
	if(checkAccess($args[0])){
		$buf=$enc->EncounterExists($args[1]);
		if ($buf){
			return $buf;
		}else{
			return new IXR_Error(1006,'_ERROR_NORESULT');
		}
	}else{
		return new IXR_Error($error['code'],$error['msg']);
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
			return new IXR_Error(1006,'_ERROR_NORESULT');
		}
	}else{
		return new IXR_Error($error['code'],$error['msg']);
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
		return new IXR_Error($error['code'],$error['msg']);
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
			return new IXR_Error(1006,'_ERROR_NORESULT');
		}
	}else{
		return new IXR_Error($error['code'],$error['msg']);
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

######### EMR (Electronic Medical Calls #######

function EMRImageAdd($args){
	return _ImageAdd($args,'encounter');
}

/*
* Private image adder
*/
function _ImageAdd($args,$type){
	global $root_path, $img, $error, $person,$httprotocol,$main_domain;

	$picdir= $args[1];
	
	$type='encounter';

	if(checkAccess($args[0])){
		include($root_path.'global_conf/inc_remoteservers_conf.php');

		$d=$root_path."fotos/$type/$picdir";

		# Try to get the extension
		if(empty($args[2]['ext'])){
			if(!empty($args[2]['mime_type'])){
				if(stristr($args[2]['mime_type'],'gif')){
					$picext='gif';
				}elseif(stristr($args[2]['mime_type'],'jpg')){
					$picext='jpg';
				}elseif(stristr($args[2]['mime_type'],'jpeg')){
					$picext='jpeg';
				}elseif(stristr($args[2]['mime_type'],'png')){
					$picext='png';
				}
			}
		}else{
			$picext = $args[2]['ext'];
		}
		if(!empty($picext)&&(stristr($picext,'gif')||stristr($picext,'jpg')||stristr($picext,'png')||stristr($picext,'jpeg'))){

			# Prepare the data for saving to the db
			$data=array('encounter_nr'=>$args[1],
					'upload_date'=>date('Y-m-d'),
					'notes'=>$args[2]['notes']."\n ".date('Y-m-d H:i:s')." by ".$args[0]['usr']." via HXP\n",
					'history'=>"HXP upload ".date('Y-m-d H:i:s')." ".$args[0]['usr']."\n",
					'modify_time'=>0,
					'create_id'=>$args[0]['usr'],
					'create_time'=>date('YmdHis'),
					'shot_date' => $args[2]['shot_date'],
					'shot_nr' => 1,
					'mime_type' => $picext);

			if($pknr = $img->saveImageData($data)){
				# Find the last inserted primary key based on the db type
				$picnr = $img->LastInsertPK('nr',$pknr);
				$picfilename = $picnr.'.'.$picext;
				
				if(!is_dir($d)){
					// if $d directory not exist create it with CHMOD 777
					mkdir($d,0777);
					// Copy the trap files to this new directory
					copy($root_path."fotos/$type/donotremove/index.htm",$d.'/index.htm');
					copy($root_path."fotos/$type/donotremove/index.php",$d.'/index.php');
				}
				// Store to the newly created directory

				$newfilepath="$d/$picfilename";

				if($fp=fopen($newfilepath,'wb')){
					fwrite($fp,base64_decode($args[2]['img']));
					fclose($fp);
					return "$fotoserver_http$type/$picdir/$picfilename";
				}else{

					# Delete the table record
					$img->Transact("DELETE FROM care_encounter_image WHERE nr=$picnr");
					return new IXR_Error(1100,'_ERROR_FILE_NOCREATE');
				}
			}else{
				return new IXR_Error(1108,'_ERROR_SQL_NOSAVE');
			}
		}else{
			return new IXR_Error(1105,'_ERROR_FILE_INVALID');
		}
	}else{
		return new IXR_Error($error['code'],$error['msg']);
	}
}

function EMRImageURLList($args){
	global $root_path, $db, $error, $img;

	if(checkAccess($args[0])){
		include($root_path.'global_conf/inc_remoteservers_conf.php');

		# Prepare the main path for the image

		$picdir= $args[1];

		$d = $fotoserver_localpath.$picdir;
		$sql="SELECT nr,mime_type FROM $img->coretable WHERE encounter_nr=".$args[1];
		
		if($buff=$db->Execute($sql)) {
			if($rec_count=$buff->RecordCount()) {
				while($row=$buff->FetchRow()){
					$data[]="http://$main_domain/$d/".$row['nr'].'.'.$row['mime_type'];
				}
				return $data;
			} else { return new IXR_Error(1301,'_ERROR_SQL_NORESULT');}
		} else { return new IXR_Error(1300,'_ERROR_SQL_QUERY');}

	}else{
		return new IXR_Error($error['code'],$error['msg']);
	}
}

######### System Calls ############

function SysAdvServerExists(){
	return FALSE;
}
function SysHdrKeyslang(){
	return FALSE;
}
function SysHdrKeyssid(){
	return FALSE;
}
function SysHdrKeysversion(){
	return '0.1';
}
/* Create the server and map the XML-RPC method names to the relevant functions */

$server = new IXR_Server(array(
    'Person'=>'Person',
    'Person.Basic'=>'PersonBasic',
	'Person.Infostring'=>'PersonInfostring',
    'Person.Exists'=>'PersonExists',
    'Person.Save'=>'PersonSave',
    'Person.Update'=>'PersonUpdate',
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
    'Person.Encounter.Current.Nr'=>'PersonEncCurrNr',
    'Person.PhotoID.URL'=>'PersonPhotoIDURL',
    'Person.PhotoID.Save'=>'PersonPhotoIDSave',
    'Person.Image.Add'=>'PersonImageAdd',
 'Encounter'=>'Enc',
	'Encounter.Infostring'=>'EncInfostring',
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
    'Encounter.Followup.Responsible'=>'EncFollowUpResp',
    'EMR.Image.Add'=>'EMRImageAdd',
    'EMR.Image.URL.List'=>'EMRImageURLList',
    'EMR.Image.URL'=>'EMRImageURL',
    'EMR.Image'=>'EMRImage',
    'system.Server.Advanced.Exists'=>'SysAdvServerExists',
    'system.Header.Keys.lang'=>'SysHdrKeysLang',
    'system.Header.Keys.sid'=>'SysHdrKeyssid',
    'system.Header.Keys.version'=>'SysHdrKeysversion'
 ));
