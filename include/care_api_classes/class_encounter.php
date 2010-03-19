<?php
/**
* @package care_api
*/

/**
*/
require_once($root_path.'include/care_api_classes/class_notes.php');
/**
*  Patient encounter.
*  Note this class should be instantiated only after a "$db" adodb  connector object  has been established by an adodb instance.
* @author Elpidio Latorilla
* @version beta 2.0.1
* @copyright 2002,2003,2004,2005,2005 Elpidio Latorilla
* @package care_api
*/
class Encounter extends Notes {
	/**
	* Table name for encounter (admission) data
	* @var string
	*/
    var $tb_enc='care_encounter';
	/**
	* Table name for financial classes
	* @var string
	*/
	var $tb_fc='care_class_financial';
	/**
	* Table name for encounter's financial classes
	* @var string
	*/
	var $tb_enc_fc='care_encounter_financial_class';
	/**
	* Table name for encounter classes
	* @var string
	*/
	var $tb_ec='care_class_encounter';
	/**
	* Table name for insurance classes
	* @var string
	*/
	var $tb_ic='care_class_insurance';
	/**
	* Table name for person (registration) data
	* @var string
	*/
	var $tb_person='care_person';
	/**
	* Table name for city/town names
	* @var string
	*/
	var $tb_citytown='care_address_citytown';
	/**
	* Table name for encounter's location data
	* @var string
	*/
	var $tb_location='care_encounter_location';
	/**
	* Table name for discharge types
	* @var string
	*/
	var $tb_dis_type='care_type_discharge';
	/**
	* Table name for encounter's sick confirmations
	* @var string
	*/
	var $tb_sickconfirm='care_encounter_sickconfirm';
	/**
	* Table name for department general data
	* @var string
	*/
	var $tb_dept='care_department';
	/**
	* Table name for insurance firms' general data
	* @var string
	*/
	var $tb_insco='care_insurance_firm';
	/**
	* Table name for appointments data
	* @var string
	*/
	var $tb_appt='care_appointment';
	/**
	* Table name for encounter type
	* @var string
	*/
	var $tb_enc_type='care_type_encounter';	
	/**
	* Current encounter number
	* @var int
	*/
	var $enc_nr;
	/**
	* Name of user
	* @var string
	*/
	var $encoder;
	/**
	* Flag for ignoring certain events
	* @var boolean
	*/
	var $ignore_status=FALSE;
	/**
	* Flag for returning entire record or a part
	* @var boolean
	*/
	var $entire_record=FALSE;
	/**
	* Current encounter data in array
	* @var int
	*/
	var $encounter;
	/**
	* Status of preloaded encounter data
	* @var boolean
	*/
	var $is_loaded=FALSE;
	/**
	* Flag for returning single result or many
	* @var boolean
	*/
	var $single_result=FALSE;
	/**
	* Current record count
	* @var int
	*/
	var $record_count;
	/**
	* Current type number
	* @var int
	*/
	var $type_nr;
	/**
	* Current localization type number
	* @var int
	*/
	var $loc_nr;
	/**
	* Current group number
	* @var int
	*/
	var $group_nr;
	/**
	* Current date
	* @var string
	*/
	var $date;
	/**
	* Current time
	* @var string
	*/
	var $time;
	/**
	* Field names of care_encounter table
	* @var array
	*/
	var $tabfields=array('encounter_nr',
	                           'pid',
							   'encounter_date',
							   'encounter_class_nr',
							   'encounter_type',
							   'encounter_status',
							   'referrer_diagnosis',
							   'referrer_recom_therapy',
							   'referrer_dr',
							   'referrer_dept',
							   'referrer_institution',
							   'referrer_notes',
							   'admit_type',
							   'triage',
							   'financial_class',
							   'insurance_nr',
							   'insurance_class_nr',
							   'insurance_firm_id',
							   'insurance_2_nr',
							   'insurance_2_firm_id',
                               'current_ward_nr',
							   'current_room_nr',
							   'in_ward',
							   'current_dept_nr',
							   'current_firm_nr',
							   'current_att_dr',
							   'consulting_dr',
							   'extra_service',
							   'followup_date',
							   'followup_responsibility',
							   'post_encounter_notes',
							   'status',
							   'history',
							   'modify_id',
							   'modify_time',
							   'create_id',
							   'create_time');
	/**
	* Field names of care_encounter_sickconfirm table
	* @var array
	*/
	var $fld_sickconfirm=array(
								'nr',
								'encounter_nr',
	                           'date_confirm',
							   'date_start',
							   'date_end',
							   'date_create',
							   'diagnosis',
							   'dept_nr',
							   'insurance_co_nr',
							   'insurance_co_sub',
							   'status',
							   'history',
							   'modify_id',
							   'modify_time',
							   'create_id',
							   'create_time');
	/**
	* Constructor
	* @param int Encounter number
	*/			
	function Encounter($enc_nr='') {
	    $this->enc_nr=$enc_nr;
		$this->setTable($this->tb_enc);
		$this->setRefArray($this->tabfields);
	}
	/**
	* Sets internal encounter number buffer to current encounter number
	* @param int Encounter number
	*/			
	function setEncounterNr($enc_nr='') {
	    $this->enc_nr=$enc_nr;
	}
	/**
	* Sets internal encoder buffer to current encoder's name
	* @param string encoder's name
	*/			
	function setEncoder($encoder='') {
	    $this->encoder=$encode;
	}
	/**
	* Sets internal ignore status flag to current ignore status
	* @param boolean Ignore status
	*/			
	function setIgnoreStatus($bool=FALSE){
	    $this->ignore_status=$bool;
	}
	/**
	* Sets internal entire record flag to current record status
	* @param boolean Entire record status
	*/			
	function setGetEntireRecord($bool=FALSE){
	    $this->entire_record=$bool;
	}
	/**
	* Sets core's table name variable to a table name
	* @param string Table name
	*/			
	function setCoreTable($table){
	    $this->setTable($table);
	}
	/**
	* Sets internal single result flag to current single result status
	* @param boolean Single result status
	*/			
	function setSingleResult($bool=FALSE){
	    $this->single_result=$bool;
	}
	/**
	* Gets a new encounter number.
	*
	* A reference number must be passed as parameter. The returned number will the highest number above the reference number PLUS 1.
	* @param int Reference Encounter number
	* @param int Encounter class number (1=inpatient, 2=outpatient)
	* @return integer
	*/			
	function getNewEncounterNr($ref_nr,$enc_class_nr){
		global $db;
		$row=array();
		$this->sql="SELECT encounter_nr FROM $this->tb_enc WHERE encounter_nr>=$ref_nr AND encounter_class_nr=$enc_class_nr ORDER BY encounter_nr DESC";
		//$this->sql="SELECT encounter_nr FROM $this->tb_enc WHERE encounter_nr>=$ref_nr ORDER BY encounter_nr DESC";
		if($this->res['gnen']=$db->SelectLimit($this->sql,1)){
			if($this->res['gnen']->RecordCount()){
				$row=$this->res['gnen']->FetchRow();
				return $row['encounter_nr']+1;
			}else{/*echo $this->sql.'no xount';*/return $ref_nr;}
		}else{/*echo $this->sql.'no sql';*/return $ref_nr;}
	}
	/**
	* Resolves the encounter number internally.
	*
	* If there is no encounter number passed as parameter to a method, 
	* the method will use the buffered current encounter number,  else it returns FALSE.
	* @param int Encounter number
	* @return boolean
	*/			
	function internResolveEncounterNr($enc_nr='') {
	    if (empty($enc_nr)) {
		    if(empty($this->enc_nr)) {
			    return FALSE;
			} else { return true; }
		} else {
		     $this->enc_nr=$enc_nr;
			return true;
		}
	}
	/**
	* Gets the service class information of an encounter based on service type and encounter number.
	* @access private
	* @param int service class number
	* @param int Encounter number
	* @return mixed adodb record object or boolean
	*/			
    function getServiceClass($type,$enc_nr) {
        global $db;
	    
		if(empty($type)) return FALSE;
	    if(!$this->internResolveEncounterNr($enc_nr)) return FALSE;
		
		$this->sql="SELECT   enfc.class_nr       AS sc_".$type."_class_nr,  
			                          enfc.date_start  AS sc_".$type."_start,
									  enfc.date_end    AS sc_".$type."_end,
									  enfc.nr               AS sc_".$type."_nr,
									  fc.name             AS sc_".$type."_name,
									  fc.code              AS sc_".$type."_code,
									  fc.LD_var           AS \"sc_".$type."_LD_var\"
							FROM
							          $this->tb_fc AS fc,
									  $this->tb_enc_fc AS enfc
							WHERE
							          enfc.encounter_nr='$this->enc_nr' AND fc.type='$type' AND enfc.class_nr=fc.class_nr
							 ORDER BY enfc.date_create ";
							 
		if($this->single_result) $this->sql.=' LIMIT 1';				 
				     
		if($this->result=$db->Execute($this->sql)) {
		    if($this->result->RecordCount()) {
			    // echo $this->sql.'<p>';
				 return $this->result;
		     } else { return FALSE;}
		} else { return FALSE;}
    }
	/**
	* Gets the Nursing care service class information of an encounter based on encounter number.
	*
	* The returned adodb record object contains an array with the data having the following index keys:
	* - sc_care_class_nr = the financial class number of encounter
	* - sc_care_start = the start date
	* - sc_care_end = the end date
	* - sc_care_nr = the service record's primary key number
	* - sc_care_name = the service name
	* - sc_care_code = the service code
	* - sc_care_LD_var = the variable's name for language dependent name of the service
	*
	* @param int Encounter number
	* @return mixed adodb record object or boolean
	*/			
	function CareServiceClass($enc_nr='') {
	    return $this->getServiceClass('care',$enc_nr);
	}
	/**
	* Gets the room service class information of an encounter based on encounter number.
	*
	* The returned adodb record object contains an array with the data having the following index keys:
	* - sc_room_class_nr = the financial class number of encounter
	* - sc_room_start = the start date
	* - sc_room_end = the end date
	* - sc_room_nr = the service record's primary key number
	* - sc_room_name = the service name
	* - sc_room_code = the service code
	* - sc_room_LD_var = the variable's name for language dependent name of the service
	*
	* @param int Encounter number
	* @return mixed adodb record object or boolean
	*/			
	function RoomServiceClass($enc_nr='') {
	    return $this->getServiceClass('room',$enc_nr);
	}
	/**
	* Gets the attending physician service class information of an encounter based on encounter number.
	*
	* The returned adodb record object contains an array with the data having the following index keys:
	* - sc_att_dr_class_nr = the financial class number of encounter
	* - sc_att_dr_start = the start date
	* - sc_att_dr_end = the end date
	* - sc_att_dr_nr = the service record's primary key number
	* - sc_att_dr_name = the service name
	* - sc_att_dr_code = the service code
	* - sc_att_dr_LD_var = the variable's name for language dependent name of the service
	*
	* @param int Encounter number
	* @return mixed adodb record object or boolean
	*/			
	function AttDrServiceClass($enc_nr='') {
	    return $this->getServiceClass('att_dr',$enc_nr);
	}
	/**
	* Saves the service class information of an encounter based on service type and encounter number.
	* The service data must be packed in an associative array and passed by reference.
	* @access private
	* @param string service class 'care', 'room', 'att_dr'
	* @param array Service data for saving. Associative. By reference.
	* @param int Encounter number
	* @return boolean
	*/			
    function saveServiceClass($type, &$val_array,$enc_nr='')
    {
	    global $db;
    
	    if(empty($type)||empty($val_array)) return FALSE;
        if(!$this->internResolveEncounterNr($enc_nr)) return FALSE;
	
	    $this->sql="INSERT INTO $this->tb_enc_fc
	        (
	               encounter_nr,
				   class_nr,
				   date_start,
				   date_end,
				   date_create,
				   history,
				   modify_id,
				   modify_time,
				   create_id,
				   create_time
            )
			 VALUES
			 (
			    '$this->enc_nr',
				'".$val_array['sc_'.$type.'_class_nr']."',
				'".$val_array['sc_'.$type.'_start']."',
				'".$val_array['sc_'.$type.'_end']."',
				'".date('Y-m-d H:i:s')."',
				'Init.entry ".date('Y-m-d H:i:s')." = ".$val_array['encoder']."',
				'".$val_array['encoder']."',
				NULL,
				'".$val_array['encoder']."',
				NULL
			)";
        return $this->Transact();
    }	
	/**
	* Saves the nursing care service class information of an encounter based on service type and encounter number.
	*
	* The service data must be packed in an associative array and passed by reference.
	* The data must have the following index keys:
	* - sc_care_class_nr = the financial class number of encounter
	* - sc_care_start = the start date
	* - sc_care_end = the end date
	* - sc_care_encoder = the user name
	*
	* @access public
	* @param array Service data for saving. Associative. By reference.
	* @param int Encounter number
	* @return boolean
	*/			
	function saveCareServiceClass(&$val_array,$enc_nr) {
	    return $this->saveServiceClass('care',$val_array,$enc_nr);
	}
	/**
	* Saves the room service class information of an encounter based on service type and encounter number.
	*
	* The service data must be packed in an associative array and passed by reference.
	* The data must have the following index keys:
	* - sc_room_class_nr = the financial class number of encounter
	* - sc_room_start = the start date
	* - sc_room_end = the end date
	* - sc_room_encoder = the user name
	*
	* @access public
	* @param array Service data for saving. Associative. By reference.
	* @param int Encounter number
	* @return boolean
	*/			
	function saveRoomServiceClass(&$val_array,$enc_nr) {
	    return $this->saveServiceClass('room',$val_array,$enc_nr);
	}
	/**
	* Saves the attending service class information of an encounter based on service type and encounter number.
	*
	* The service data must be packed in an associative array and passed by reference.
	* The data must have the following index keys:
	* - sc_att_dr_class_nr = the financial class number of encounter
	* - sc_att_dr_start = the start date
	* - sc_att_dr_end = the end date
	* - sc_att_dr_encoder = the user name
	*
	* @access public
	* @param array Service data for saving. Associative. By reference.
	* @param int Encounter number
	* @return boolean
	*/			
	function saveAttDrServiceClass(&$val_array,$enc_nr) {
	    return $this->saveServiceClass('att_dr',$val_array,$enc_nr);
	}
	/**
	* Update the service class information of an encounter based on service type record's primary key number.
	* The service data must be packed in an associative array and passed by reference.
	* @access private
	* @param string service class 'care', 'room', 'att_dr'
	* @param array Service data for saving. Associative. By reference.
	* @return boolean
	*/
    function updateServiceClass($type, &$val_array)
    {
	    global $db;
	     
		if(empty($val_array['sc_'.$type.'_class_nr'])) return FALSE;
	    $this->sql="UPDATE $this->tb_enc_fc SET
				   class_nr = '".$val_array['sc_'.$type.'_class_nr']."',
				   date_start = '".$val_array['sc_'.$type.'_start']."',
				   date_end = '".$val_array['sc_'.$type.'_end']."',
				   history =".$this->ConcatHistory("Update ".date('Y-m-d H:i:s')." ".$val_array['encoder']."\n").",
				   modify_id = '".$val_array['encoder']."'
			WHERE nr = '".$val_array['sc_'.$type.'_nr']."'";
		return $this->Transact();
    }	
	/**
	* Updates the nursing care service class information of an encounter based on service type and record's primary key number.
	*
	* The service data must be packed in an associative array and passed by reference.
	* The data must have the following index keys:
	* - sc_care_nr = the record's primary key number
	* - sc_care_class_nr = the financial class number of encounter
	* - sc_care_start = the start date
	* - sc_care_end = the end date
	* - sc_care_encoder = the user name
	*
	* @access public
	* @param array Service data for saving. Associative. By reference.
	* @return boolean
	*/			
	function updateCareServiceClass(&$val_array) {
		if(empty($val_array['sc_care_nr'])) return $this->saveCareServiceClass($val_array);
	        else return $this->updateServiceClass('care',$val_array);
	}
	/**
	* Updates the room service class information of an encounter based on service type and record's primary key number.
	*
	* The service data must be packed in an associative array and passed by reference.
	* The data must have the following index keys:
	* - sc_room_nr = the record's primary key number
	* - sc_room_class_nr = the financial class number of encounter
	* - sc_room_start = the start date
	* - sc_room_end = the end date
	* - sc_room_encoder = the user name
	*
	* @access public
	* @param array Service data for saving. Associative. By reference.
	* @param int Record's primary key number. (reserved)
	* @return boolean
	*/			
	function updateRoomServiceClass(&$val_array,$nr) {
		if(empty($val_array['sc_room_nr'])) return $this->saveRoomServiceClass($val_array);
	        else return $this->updateServiceClass('room',$val_array);
	}
	/**
	* Updates the room service class information of an encounter based on service type and record's primary key number.
	*
	* The service data must be packed in an associative array and passed by reference.
	* The data must have the following index keys:
	* - sc_att_dr_nr = the record's primary key number
	* - sc_att_dr_class_nr = the financial class number of encounter
	* - sc_att_dr_start = the start date
	* - sc_att_dr_end = the end date
	* - sc_att_dr_encoder = the user name
	*
	* @access public
	* @param array Service data for saving. Associative. By reference.
	* @param int Record's primary key number. (reserved)
	* @return boolean
	*/			
	function updateAttDrServiceClass(&$val_array,$nr) {
		if(empty($val_array['sc_att_dr_nr'])) return $this->saveAttDrServiceClass($val_array);
	        else return $this->updateServiceClass('att_dr',$val_array);
	}
	/**
	* Gets all service classes of a given class.
	*
	* @access private
	* @param string service class 'care', 'room', 'att_dr'
	* @return mixed adodb record object or boolean
	*/			
    function getAllServiceClassesObject($type=''){
	    global $db;
		if(empty($type)) return FALSE;
		$this->sql="SELECT class_nr,class_id,code,name,LD_var AS \"LD_var\" FROM $this->tb_fc WHERE type='$type'";
		if($this->result=$db->Execute($this->sql)) {
		    if($this->result->RecordCount()) {
			    return $this->result;
		    } else { return FALSE;}
		} else { return FALSE;}
    }		
	/**
	* Gets all service classes of 'care' class.
	*
	* @access public
	* @return mixed adodb record object or boolean
	*/			
	function AllCareServiceClassesObject(){
	    return $this->getAllServiceClassesObject('care');
	}
	/**
	* Gets all service classes of 'room' class.
	*
	* @access public
	* @return mixed adodb record object or boolean
	*/			
	function AllRoomServiceClassesObject(){
	    return $this->getAllServiceClassesObject('room');
	}
	/**
	* Gets all service classes of 'att_dr' class.
	*
	* @access public
	* @return mixed adodb record object or boolean
	*/			
	function AllAttDrServiceClassesObject(){
	    return $this->getAllServiceClassesObject('att_dr');
	}
	/**
	* Gets all info of all encounter classes.
	* The returned adodb object contains rows of array.
	* Each array contains the data with the following index keys:
	* - class_nr = the class number, primary key (numeric)
	* - class_id = the class ID (alphanumeric)
	* - name = the name of class
	* - LD_var = the variable's name for language dependent name of class
	*
	* @access public
	* @return mixed adodb record object or boolean
	*/			
	function AllEncounterClassesObject(){
	    global $db;
	    //$db->debug=true;
		$this->sql="SELECT class_nr,class_id,name,LD_var AS \"LD_var\" FROM $this->tb_ec ";
		if($this->res['aec']=$db->Execute($this->sql)) {
		    if($this->res['aec']->RecordCount()) {
			    return $this->res['aec'];
		    } else { return FALSE;}
		} else { return FALSE;}
	}
	/**
	* Loads the encounter data including some data from the registration into an internal buffer array <var>$encounter</var>. 
	*
	* This method returns only TRUE (data loaded) or FALSE (data not loaded).
	* The load success status can also be tested later by using the internal <var>$is_loaded</var> flag.
	*
	* The individual data is to be fetched via the appropriate methods.
	*
	* - all keys as set in the <var>$tabfields</var> array
	* - <b>pid</b> = the PID number of the patient
	* - <b>title</b> = the patient title
	* - <b>name_last</b> = last or family name
	* - <b>name_first</b> = first or given name
	* - <b>date_birth</b> = date of birth in yyyy-mm-format
	* - <b>sex</b> = sex
	* - <b>addr_str</b> = street name
	* - <b>addr_str_nr</b> = street number (alphanumeric)
	* - <b>addr_zip</b> = zip code
	* - <b>blood_group</b> = blood group (A, B, AB, O)
	* - <b>photo_filename</b> = filename of the stored ID photo
	* - <b>citytown_name</b> = name of the city or town
	* - <b>death_date</b> = date of death (in case deceased)
	*
	*
	* The content of the internal buffer <var>$encounter</var> array can also be fetched by the method  <var>getLoadedEncounterData()</var>
	* @param int Encounter number
	* @return boolean
	*/
	function loadEncounterData($enc_nr=''){
	    global $db;
		if(!$this->internResolveEncounterNr($enc_nr)) return FALSE;
		$this->sql="SELECT e.*, p.pid, p.title,p.name_last, p.name_first, p.date_birth, p.sex,
									p.addr_str,p.addr_str_nr,p.addr_zip, p.blood_group,
									p.photo_filename, t.name AS citytown_name,p.death_date
							FROM $this->tb_enc AS e, 
									 $this->tb_person AS p
									 LEFT JOIN $this->tb_citytown AS t ON p.addr_citytown_nr=t.nr
							WHERE e.encounter_nr=$this->enc_nr
								AND e.pid=p.pid";
		//echo $sql;
		if($this->res['lend']=$db->Execute($this->sql)) {
		    if($this->record_count=$this->res['lend']->RecordCount()) {
				$this->rec_count=$this->record_count;
			    $this->encounter=$this->res['lend']->FetchRow();
				//$this->result=NULL;
			    $this->is_loaded=true;
				return true;
		    } else { return FALSE;}
		} else { return FALSE;}
	}
	/**
	* Returns last or family name.
	* Use only after the encounter data was successfully loaded by the <var>loadEncounterData()</var> method.
	* @return mixed string or boolean
	*/			
	function LastName($enr=0){
		if($this->is_loaded) {
			return $this->encounter['name_last'];
		}else{
			if($enr) return $this->getValue('name_last',$enr,TRUE);
				else return FALSE;
		}
	}
	/**
	* Returns first or given name.
	* Use only after the encounter data was successfully loaded by the <var>loadEncounterData()</var> method.
	* @return mixed string or boolean
	*/			
	function FirstName($enr=0){
		if($this->is_loaded) {
			return $this->encounter['name_first'];
		}else{
			if($enr) return $this->getValue('name_first',$enr,TRUE);
				else return FALSE;
		}
	}
	/**
	* Returns date of birth in yyyy-mm-format.
	* Use only after the encounter data was successfully loaded by the <var>loadEncounterData()</var> method.
	* @return mixed string or boolean
	*/			
	function BirthDate($enr=0){
		if($this->is_loaded) {
			return $this->encounter['date_birth'];
		}else{
			if($enr) return $this->getValue('date_birth',$enr,TRUE);
				else return FALSE;
		}
	}
	/**
	* Returns PID number.
	* Use only after the encounter data was successfully loaded by the <var>loadEncounterData()</var> method.
	* @return mixed integer or boolean
	*/
	function PID($enr=0){
		if($this->is_loaded) {
			return $this->encounter['pid'];
		}else{
			if($enr) return $this->getValue('pid',$enr,TRUE);
				else return FALSE;
		}
	}
	/**
	* Returns blood group
	* Use only after the encounter data was successfully loaded by the <var>loadEncounterData()</var> method.
	* @return mixed integer or boolean
	*/
	function BloodGroup($enr=0){
		if($this->is_loaded) {
			return $this->encounter['blood_group'];
		}else{
			if($enr) return $this->getValue('blood_group',$enr,TRUE);
				else return FALSE;
		}
	}
	/**
	* Returns date of admission.
	* Use only after the encounter data was successfully loaded by the <var>loadEncounterData()</var> method.
	* @return mixed string or boolean
	*/			
	function EncounterDate($enr=0){
		if($this->is_loaded) {
			return $this->encounter['encounter_date'];
		}else{
			if($enr) return $this->getValue('encounter_date',$enr);
				else return FALSE;
		}
	}
	/**
	* Returns encounter or admission class.
	*
	* For example:  1 = inpatient , 2 = outpatient.
	*
	* Use only after the encounter data was successfully loaded by the <var>loadEncounterData()</var> method.
	* @return mixed integer or boolean
	*/			
	function EncounterClass($enr=0){
		if($this->is_loaded) {
			return $this->encounter['encounter_class_nr'];
		}else{
			if($enr) return $this->getValue('encounter_class_nr',$enr);
				else return FALSE;
		}
	}
	/**
	* Returns financial class.
	*
	* For example: 1 = private , 2 = common , 3 = self pay.
	*
	* Use only after the encounter data was successfully loaded by the <var>loadEncounterData()</var> method.
	* @return mixed integer or boolean
	*/			
	function FinancialClass($enr=0){
		if($this->is_loaded) {
			return $this->encounter['financial_class'];
		}else{
			if($enr) return $this->getValue('financial_class',$enr);
				else return FALSE;
		}
	}
	/**
	* Alias of <var>FinancialClass()</var>
	*/			
	function BillingClass($enr=0){
		return $this->FinancialClass($enr);
	}
	/**
	* Returns referer's diagnosis text.
	* Use only after the encounter data was successfully loaded by the <var>loadEncounterData()</var> method.
	* @return mixed string or boolean
	*/			
	function RefererDiagnosis($enr=0){
		if($this->is_loaded) {
			return $this->encounter['referrer_diagnosis'];
		}else{
			if($enr) return $this->getValue('referrer_diagnosis',$enr);
				else return FALSE;
		}
	}
	/**
	* Returns referer's recommended therapy text.
	* Use only after the encounter data was successfully loaded by the <var>loadEncounterData()</var> method.
	* @return mixed string or boolean
	*/			
	function RefererRecomTherapy($enr=0){
		if($this->is_loaded) {
			return $this->encounter['referrer_recom_therapy'];
		}else{
			if($enr) return $this->getValue('referrer_recom_therapy',$enr);
				else return FALSE;
		}
	}
	/**
	* Returns referer's extra notes text.
	* Use only after the encounter data was successfully loaded by the <var>loadEncounterData()</var> method.
	* @return mixed string or boolean
	*/			
	function RefererNotes($enr=0){
		if($this->is_loaded) {
			return $this->encounter['referrer_notes'];
		}else{
			if($enr) return $this->getValue('referrer_notes',$enr);
				else return FALSE;
		}
	}
	/**
	* Returns referer's name.
	* Use only after the encounter data was successfully loaded by the <var>loadEncounterData()</var> method.
	* @return mixed string or boolean
	*/			
	function Referer($enr=0){
		if($this->is_loaded) {
			return $this->encounter['referrer_dr'];
		}else{
			if($enr) return $this->getValue('referrer_dr',$enr);
				else return FALSE;
		}
	}
	/**
	* Returns refererring department.
	* Use only after the encounter data was successfully loaded by the <var>loadEncounterData()</var> method.
	* @return mixed string or boolean
	*/			
	function RefererDept($enr=0){
		if($this->is_loaded) {
			return $this->encounter['referrer_dept'];
		}else{
			if($enr) return $this->getValue('referrer_dept',$enr);
				else return FALSE;
		}
	}
	/**
	* Returns referring institution.
	* Use only after the encounter data was successfully loaded by the <var>loadEncounterData()</var> method.
	* @return mixed string or boolean
	*/			
	function RefererInstitution($enr=0){
		if($this->is_loaded) {
			return $this->encounter['referrer_institution'];
		}else{
			if($enr) return $this->getValue('referrer_institution',$enr);
				else return FALSE;
		}
	}
	/**
	* Returns insurance number used in the encounter.
	* Use only after the encounter data was successfully loaded by the <var>loadEncounterData()</var> method.
	* @return mixed string or boolean
	*/			
	function InsuranceNr($enr=0){
		if($this->is_loaded) {
			return $this->encounter['insurance_nr'];
		}else{
			if($enr) return $this->getValue('insurance_nr',$enr);
				else return FALSE;
		}
	}
	/**
	* Returns insurance company's id used in the encounter.
	* Use only after the encounter data was successfully loaded by the <var>loadEncounterData()</var> method.
	* @return mixed string or boolean
	*/			
	function InsuranceFirmID($enr=0){
		if($this->is_loaded) {
			return $this->encounter['insurance_firm_id'];
		}else{
			if($enr) return $this->getValue('insurance_firm_id',$enr);
				else return FALSE;
		}
	}
	/**
	* Returns current ward number.
	* Use only after the encounter data was successfully loaded by the <var>loadEncounterData()</var> method.
	* @return mixed string or boolean
	*/			
	function CurrentWardNr($enr=0){
		if($this->is_loaded) {
			return $this->encounter['current_ward_nr'];
		}else{
			if($enr) return $this->getValue('current_ward_nr',$enr);
				else return FALSE;
		}
	}
	/**
	* Returns current room number.
	* Use only after the encounter data was successfully loaded by the <var>loadEncounterData()</var> method.
	* @return mixed string or boolean
	*/			
	function CurrentRoomNr($enr=0){
		if($this->is_loaded) {
			return $this->encounter['current_room_nr'];
		}else{
			if($enr) return $this->getValue('current_room_nr',$enr);
				else return FALSE;
		}
	}
	/**
	* Returns current department number.
	* Use only after the encounter data was successfully loaded by the <var>loadEncounterData()</var> method.
	* @return mixed string or boolean
	*/			
	function CurrentDeptNr($enr=0){
		if($this->is_loaded) {
			return $this->encounter['current_dept_nr'];
		}else{
			if($enr) return $this->getValue('current_dept_nr',$enr);
				else return FALSE;
		}
	}
	/**
	* Returns current firm number.
	* Use only after the encounter data was successfully loaded by the <var>loadEncounterData()</var> method.
	* @return mixed string or boolean
	*/			
	function CurrentFirmNr($enr=0){
		if($this->is_loaded) {
			return $this->encounter['current_firm_nr'];
		}else{
			if($enr) return $this->getValue('current_firm_nr',$enr);
				else return FALSE;
		}
	}
	/**
	* Returns current attending physician number.
	* Use only after the encounter data was successfully loaded by the <var>loadEncounterData()</var> method.
	* @return mixed string or boolean
	*/			
	function CurrentAttDrNr($enr=0){
		if($this->is_loaded) {
			return $this->encounter['current_att_dr_nr'];
		}else{
			if($enr) return $this->getValue('current_att_dr_nr',$enr);
				else return FALSE;
		}
	}
	/**
	* Returns status flag if patient is finally admitted in ward.
	* Use only after the encounter data was successfully loaded by the <var>loadEncounterData()</var> method.
	* @return boolean
	*/			
	function In_Ward($enr=0){
		if($this->is_loaded) {
			return $this->encounter['in_ward'];
		}else{
			if($enr) return $this->getValue('in_ward',$enr);
				else return FALSE;
		}
	}
	/**
	* Returns status flag if patient is finally admitted in department.
	* Use only after the encounter data was successfully loaded by the <var>loadEncounterData()</var> method.
	* @return boolean
	*/			
	function In_Dept($enr=0){
		if($this->is_loaded) {
			return $this->encounter['in_dept'];
		}else{
			if($enr) return $this->getValue('in_dept',$enr);
				else return FALSE;
		}
	}
	/**
	* Returns status flag if patient is finally discharged.
	* Use only after the encounter data was successfully loaded by the <var>loadEncounterData()</var> method.
	* @return boolean
	*/			
	function Is_Discharged($enr=0){
		if($this->is_loaded) {
			return $this->encounter['is_discharged'];
		}else{
			if($enr) return $this->getValue('is_discharged',$enr);
				else return FALSE;
		}
	}
	/**
	* Returns encounter status.
	*
	* Types of encounter status:
	* - <b>disallow_cancel</b>
	* - <b>cancelled</b>
	* - <b>valid</b>
	* - <var>empty char</var>
	*
	*
	* Use only after the encounter data was successfully loaded by the <var>loadEncounterData()</var> method.
	* @return mixed string or boolean
	*/			
	function EncounterStatus($enr=0){
		if($this->is_loaded) {
			return $this->encounter['encounter_status'];
		}else{
			if($enr) return $this->getValue('encounter_status',$enr);
				else return FALSE;
		}
	}
	/**
	* Returns encounter type. <b>Currently reserved.</b>
	*
	* Encounter types:
	* - <b>emergency</b>
	* - <b>normal</b>
	* - <b>walk-in</b>
	* - <b>home visit</b>
	*
	*
	* Use only after the encounter data was successfully loaded by the <var>loadEncounterData()</var> method.
	* @return mixed string or boolean
	*/			
	function EncounterType($enr=0){
		if($this->is_loaded) {
			return $this->encounter['encounter_type'];
		}else{
			if($enr) return $this->getValue('encounter_type',$enr);
				else return FALSE;
		}
	}
	/**
	* Returns consulting physician's name.
	* Use only after the encounter data was successfully loaded by the <var>loadEncounterData()</var> method.
	* @return mixed string or boolean
	*/			
	function ConsultingDr($enr=0){
		if($this->is_loaded) {
			return $this->encounter['consulting_dr'];
		}else{
			if($enr) return $this->getValue('consulting_dr',$enr);
				else return FALSE;
		}
	}
	/**
	* Returns follow-up date in yyyy-mm-dd format.
	* Use only after the encounter data was successfully loaded by the <var>loadEncounterData()</var> method.
	* @return mixed string or boolean
	*/			
	function FollowUpDate($enr=0){
		if($this->is_loaded) {
			return $this->encounter['followup_date'];
		}else{
			if($enr) return $this->getValue('followup_date',$enr);
				else return FALSE;
		}
	}
	/**
	* Returns the name of physician or service responsible for follow-up.
	* Use only after the encounter data was successfully loaded by the <var>loadEncounterData()</var> method.
	* @return mixed string or boolean
	*/			
	function FollowUpResponsibility($enr=0){
		if($this->is_loaded) {
			return $this->encounter['followup_responsibility'];
		}else{
			if($enr) return $this->getValue('followup_responsibility',$enr);
				else return FALSE;
		}
	}
	/**
	* Returns post encounter notes. Short notes after discharge, not to be used for discharge summary report.
	* Use only after the encounter data was successfully loaded by the <var>loadEncounterData()</var> method.
	* @return mixed string or boolean
	*/			
	function PostEncounterNotes($enr=0){
		if($this->is_loaded) {
			return $this->encounter['post_encounter_notes'];
		}else{
			if($enr) return $this->getValue('post_encounter_notes',$enr);
				else return FALSE;
		}
	}
	/**
	* Returns the record entry's status. This status is technical and has nothing to do with the encounter status.
	*
	* Status types:
	* - <var>empty char</var>
	* - <b>normal</b>
	* - <b>inactive</b>
	* - <b>void</b>
	* - <b>hidden</b>
	* - <b>deleted</b>
	*
	*
	* Use only after the encounter data was successfully loaded by the <var>loadEncounterData()</var> method.
	* @return mixed string or boolean
	*/			
	function RecordStatus($enr=0){
		if($this->is_loaded) {
			return $this->encounter['status'];
		}else{
			if($enr) return $this->getValue('status',$enr);
				else return FALSE;
		}
	}
	/**
	* Returns record entry's history. This is the techical history of the record entry, not of the admission.
	* Use only after the encounter data was successfully loaded by the <var>loadEncounterData()</var> method.
	* @return mixed string or boolean
	*/			
	function RecordHistory($enr=0){
		if($this->is_loaded) {
			return $this->encounter['history'];
		}else{
			if($enr) return $this->getValue('history',$enr);
				else return FALSE;
		}
	}
	/**
	* Returns record's modifier id or name. Technical.
	* Use only after the encounter data was successfully loaded by the <var>loadEncounterData()</var> method.
	* @return mixed string or boolean
	*/			
	function RecordModifierID($enr=0){
		if($this->is_loaded) {
			return $this->encounter['modify_id'];
		}else{
			if($enr) return $this->getValue('modify_id',$enr);
				else return FALSE;
		}
	}
	/**
	* Returns record's creator id or name. Technical.
	* Use only after the encounter data was successfully loaded by the <var>loadEncounterData()</var> method.
	* @return mixed string or boolean
	*/			
	function RecordCreatorID($enr=0){
		if($this->is_loaded) {
			return $this->encounter['create_id'];
		}else{
			if($enr) return $this->getValue('create_id',$enr);
				else return FALSE;
		}
	}
	/**
	* Returns filename of the person's picture id.
	* Use only after the encounter data was successfully loaded by the <var>loadEncounterData()</var> method.
	* @return mixed string or boolean
	*/			
	function PhotoFilename($enr=0){
		if($this->is_loaded) {
			return $this->encounter['photo_filename'];
		}else{
			if($enr) return $this->getValue('photo_filename',$enr,TRUE);
				else return FALSE;
		}
	}
	/**
	* Updates the encounter record with data from the internal buffer array.
	* @access public
	* @param int Encounter number
	* returns boolean
	*/
    function updateEncounterFromInternalArray($item_nr='') {
		if(empty($item_nr)) return FALSE;
		$this->where=" encounter_nr=$item_nr";
		return $this->updateDataFromInternalArray($item_nr);
	}
	/**
	* Checks if an encounter number is currently admitted (both inpatient & outpatient).
	* @access public
	* @param int Encounter number
	* @param string Type of param <var>$nr</var> (<b>_ENC</b> = encounter nr, <b>_PID</b> = pid nr) , defaults to _ENC = encounter nr.
	* @return mixed integer or boolean
	*/
	function isCurrentlyAdmitted($nr,$type='_ENC'){
	    global $db;
		if(!$nr) return FALSE;
		if($type=='_ENC') $cond='encounter_nr';
			elseif($type=='_PID') $cond='pid';
			 	else return FALSE;
		$this->sql="SELECT encounter_nr FROM $this->tb_enc 
						WHERE $cond='$nr' AND encounter_status <> 'cancelled' AND is_discharged=0 AND status NOT IN ($this->dead_stat)";
		if($buf=$db->Execute($this->sql)){
		    if($buf->RecordCount()) {
				$buf2=$buf->FetchRow();
				return $buf2['encounter_nr'];
			}else{return FALSE;}
		}else{return FALSE;}
	}
	/**
	* Checks if the person's  is currently admitted based on his PID number.
	* @access public
	* @param int PID number
	* @return mixed integer or boolean
	*/
	function isPIDCurrentlyAdmitted($nr){
	    return $this->isCurrentlyAdmitted($nr,'_PID');
	}
	/**
	* Checks if a given encounter number is currently admitted.
	* @access public
	* @param int Encounter number
	* @return mixed integer or boolean
	*/
	function isENCCurrentlyAdmitted($nr){
	    return $this->isCurrentlyAdmitted($nr,'_ENC');
	}
	/**
	* Adds a "View" note to the record's history data.
	* @access public
	* @param string Name of person viewing the data
	* @param int Encounter number
	* @return boolean
	*/
	function setHistorySeen($encoder='',$enc_nr=''){
	    global $db, $dbtype;
		if(empty($encoder)) return FALSE;
		if(!$this->internResolveEncounterNr($enc_nr)) return FALSE;
		/*
		if($dbtype=='mysql')
			$this->sql="UPDATE $this->tb_enc SET history= CONCAT(history,'\nView ".date('Y-m-d H:i:s')." = $encoder') WHERE encounter_nr=$this->enc_nr";
		else
			$this->sql="UPDATE $this->tb_enc SET history= (history || '\nView ".date('Y-m-d H:i:s')." = $encoder') WHERE encounter_nr=$this->enc_nr";
		*/
		$this->sql="UPDATE $this->tb_enc SET history= ".$this->ConcatHistory("\nView ".date('Y-m-d H:i:s')." = $encoder")." WHERE encounter_nr=$this->enc_nr";

        return $this->Transact($this->sql);
        /*
        if($db->Execute($this->sql)) {return true;}
		   else  {echo $this->sql;return FALSE;}
        */
	}
	/**
	* Gets the encounter class' information based on its class_nr key.
	*
	* The returned array contains data with following index keys:
	* - <b>class_id</b> = the class id (alphanumeric)
	* - <b>name</b> = the class name
	* - <b>LD_var</b> = the variable's name for the language dependent version of the class name
	*
	*
	* @access public
	* @param int Encounter number
	* @return mixed array or boolean
	*/
	function getEncounterClassInfo($class_nr){
	    global $db;
		$this->sql="SELECT class_id,name, LD_var AS \"LD_var\" FROM $this->tb_ec WHERE class_nr=$class_nr";
		if($this->result=$db->Execute($this->sql)){
		    if($this->result->RecordCount()) {
			    $this->row=$this->result->FetchRow();
				return $this->row;
			} else return FALSE;
		}else {
		    return FALSE;
		}
	}
	/**
	* Gets the encounter type 
	*
	* The returned array contains data with following index keys:
	* - <b>type_nr</b> = the class id (alphanumeric)
	* - <b>name</b> = the class name
	* - <b>LD_var</b> = the variable's name for the language dependent version of the class name
	*
	*
	* @access public
	* @return mixed array or boolean
	*/
	function getEncounterType(){
	    global $db;
		$this->sql="SELECT type_nr,type,name, LD_var AS \"LD_var\" FROM $this->tb_enc_type";
		if($this->result=$db->Execute($this->sql)){
		    if($this->result->RecordCount()) {
			    $this->row=$this->result;
				return $this->row;
			} else return FALSE;
		}else {
		    return FALSE;
		}
	}	
	/**
	* Gets the insurance class' information based on its class_nr key.
	*
	* The returned array contains data with following index keys:
	* - <b>class_id</b> = the class id (alphanumeric)
	* - <b>name</b> = the class name
	* - <b>LD_var</b> = the variable's name for the language dependent version of the class name
	*
	*
	* @access public
	* @param int Encounter number
	* @return mixed array or boolean
	*/
    function getInsuranceClassInfo($class_nr){
	    global $db;
		$this->sql="SELECT class_id,name, LD_var AS \"LD_var\" FROM $this->tb_ic WHERE class_nr=$class_nr";
		if($this->result=$db->Execute($this->sql)){
		    if($this->result->RecordCount()) {
			    $this->row=$this->result->FetchRow();
				return $this->row;
			} else return FALSE;
		}else {
		    return FALSE;
		}
	}
	/** 
	* Private search function, usually called by another method.
	*
	* The resulting count can be fetched with the <var>LastRecordCount()</var> method.
	*
	* The returned adodb object contains rows of arrays.
	* Each array contains "basic" admission data with following index keys:
	* - <b>encounter_nr</b> = encounter number
	* - <b>encounter_class_nr</b> = encounter class number: 1 = inpatient, 2 = outpatient
	* - <b>pid</b> = the patient's PID number
	* - <b>name_last</b> = last or family name
	* - <b>name_first</b> = first or given name
	* - <b>date_birth</b> = date of birth in yyyy-mm-dd format
	* - <b>addr_zip</b> = zip code
	* - <b>blood_group</b> = patient's blood group
	*
	*
	* @param string Search keyword
	* @param int Encounter class number. default = 0
	* @param string Optional addtion to WHERE clause like e.g. for sorting
	* @param boolean  Flag whether the select query is limited or not, default FALSE = unlimited
	* @param int Maximum number or rows returned in case of limited select, default = 30 rows
	* @param int Start index offset in case of limited select, default 0 = start
	* @return mixed adodb record object or boolean
	*/
	function _searchAdmissionBasicInfo($key,$enc_class=0,$add_opt='',$limit=FALSE,$len=30,$so=0){
		global $db,$sql_LIKE;
		

		//if(empty($key)) return FALSE;
		$this->sql="SELECT e.encounter_nr, e.encounter_class_nr, p.pid, p.name_last, p.name_first, p.date_birth, p.addr_zip, p.sex,p.blood_group
				FROM $this->tb_enc AS e LEFT JOIN $this->tb_person AS p ON e.pid=p.pid";

		if(is_numeric($key)){
			$key=(int)$key;
			$this->sql.=" WHERE e.encounter_nr = $key AND  e.is_discharged IN ('',0)".$add_opt;
		}elseif($key=='%'||$key=='*'){
			$this->sql.=" WHERE e.is_discharged IN ('',0) AND e.status NOT IN ($this->dead_stat) ".$add_opt;
		}else{
			$this->sql.=" WHERE (e.encounter_nr $sql_LIKE '$key%'
						OR p.pid $sql_LIKE '$key%'
						OR p.name_last $sql_LIKE '$key%'
						OR p.name_first $sql_LIKE '$key%'
						OR p.date_birth $sql_LIKE '$key%')";
			if($enc_class) $this->sql.="	AND e.encounter_class_nr=$enc_class";
			$this->sql.="  AND  e.is_discharged IN ('',0) AND e.status NOT IN ($this->dead_stat) ".$add_opt;
		}

		if($limit){
	    	$this->res['sabi']=$db->SelectLimit($this->sql,$len,$so);
		}else{
	    	$this->res['sabi']=$db->Execute($this->sql);
		}
	    if ($this->res['sabi']){
		   	if ($this->record_count=$this->res['sabi']->RecordCount()) {
				$this->rec_count=$this->record_count; # workaround
				return $this->res['sabi'];
			} else{return FALSE;}
		}else{return FALSE;}
	}	
	/**
	* Searches and returns inpatient admissions based on a supplied keyword.
	*
	* See <var>_searchAdmissionBasicInfo()</var> for details of the resulting data structure.
	*
	* Example usage:
	* <code>
	* $kw="Magellan";
	* if($result=$obj->searchInpatientBasicInfo($kw)){
	*    echo $obj->LastRecordCount();  # Prints the number of resulting rows
	*    while($admission=$result->FetchRow()){
	*        echo $admission['name_last'];  # Prints the patient's name
	*      ......
	*    }
	* }
	* </code>
	*
	*
	* @access public
	* @param str Search keyword
	* @return mixed adodb object or boolean
	*/
	function searchInpatientBasicInfo($key){
		return $this->_searchAdmissionBasicInfo($key,1); // 1 = inpatient (encounter class)
	}
	/**
	* Searches and returns inpatient admissions based on a supplied keyword.
	*
	* See <var>_searchAdmissionBasicInfo()</var> for details of the resulting data structure.
	*
	* Example usage:
	* <code>
	* $kw="Jennifer";
	* if($result=$obj->searchOutpatientBasicInfo($kw)){
	*    echo $obj->LastRecordCount();  # Prints the number of resulting rows
	*    while($admission=$result->FetchRow()){
	*        echo $admission['name_last'];  # Prints the patient's name
	*      ......
	*    }
	* }
	* </code>
	*
	*
	* @access public
	* @param str Search keyword
	* @return mixed adodb object or boolean
	*/
	function searchOutpatientBasicInfo($key){
		return $this->_searchAdmissionBasicInfo($key,2); // 2 = outpatient (encounter class)
	}
	/**
	* Search returning the basic admission information as outlined at <var>_searchAdmissionBasicInfo()</var>.
	*
	* This method gives the possibility to sort the results based on an item and sorting direction.
	* @access public
	* @param string Search keyword
	* @param string Item as sort basis
	* @param string Sorting direction. ASC = ascending, DESC  = descending, empty = ascending
	* @return mixed adodb record object or boolean
	*/
	function searchEncounterBasicInfo($key,$sortitem='',$order=''){
		if(!empty($sortitem)){
			$option=' ORDER BY ';
			switch($sortitem){
				case 'LASTNAME': $option.=' p.name_last '; break;
				case 'FIRSTNAME': $option.=' p.name_first '; break;
				case 'ENCNR': $option.=' e.encounter_nr '; break;
				case 'BDAY': $option.=' p.date_birth '; break;
				default: $option.='';
			}
			$option.=$order;
		}
		return $this->_searchAdmissionBasicInfo($key,0,$option); // 0 = all kinds of admission
	}
	/**
	* Limited results search returning basic information as outlined at <var>_searchAdmissionBasicInfo()</var>.
	*
	* This method gives the possibility to sort the results based on an item and sorting direction.
	* @access public
	* @param string Search keyword
	* @param int Maximum number of rows returned
	* @param int Start index of rows returned
	* @param string Item as sort basis
	* @param string Sorting direction. ASC = ascending, DESC  = descending, empty = ascending
	* @return mixed adodb record object or boolean
	*/
	function searchLimitEncounterBasicInfo($key,$len,$so,$sortitem='',$order='ASC'){
		if(!empty($sortitem)){
			$option=" ORDER BY $sortitem $order";
		}
		return $this->_searchAdmissionBasicInfo($key,0,$option,TRUE,$len,$so); // 0 = all kinds of admission
	}
	/**
	* Search for inpatients who are not yet finally admittd in ward, returning basic information as outlined at <var>_searchAdmissionBasicInfo()</var>.
	*
	* The resulting data is usually listed on the "waiting list" modules.
	* @access public
	* @param string Search keyword
	* @return mixed adodb record object or boolean
	*/
	function searchInpatientNotInWardBasicInfo($key){
		return $this->_searchAdmissionBasicInfo($key,1,'AND NOT in_ward'); // 1 = outpatient (encounter class)
	}
	/**
	* Checks if the encounter exists in the database based on the encounter number key.
	*
	* If the encounter exists, its PID number will be returned, else FALSE will be returned.
	* @access public
	* @param int Encounter number
	* @return mixed integer or boolean
	*/
	function EncounterExists($enc_nr){
	    global $db;
		$this->sql="SELECT pid FROM $this->tb_enc WHERE encounter_nr='$enc_nr'";
		if($this->result=$db->Execute($this->sql)){
		    if($this->result->RecordCount()) {
			    $this->row=$this->result->FetchRow();
				return $this->row['pid'];
			} else return FALSE;
		}else {
		    return FALSE;
		}
	}
	/**
	* Checks if the encounter is in a location based on the  location's type number.
	*
	* If the encounter is in the said location, its record primary key number will be returned, else FALSE.
	* This method uses the internaly buffered encounter number. The number must be set first before using
	* this method either  with <var>setEncounterNr()</var> or by directly assigning to the <var>$enc_nr</var> variable .
	* @access private
	* @param int Encounter number
	* @return mixed integer or boolean
	*/
	function _InLocation($type_nr){
		global $db;
		if($this->result=$db->Execute("SELECT nr FROM $this->tb_location WHERE encounter_nr=$this->enc_nr AND type_nr=$type_nr AND location_nr=$this->loc_nr AND date_to='0000-00-00'")){
			if($this->result->RecordCount()){
				return $this->result['nr'];
			}else{return FALSE;}
		}else{return FALSE;}
	}
	/**
	* Checks if the encounter is finally admitted in a ward.
	*
	* If the encounter is in the said ward location, its record primary key number will be returned, else FALSE.
	* @access private
	* @param int Encounter number
	* @param int Ward number
	* @return mixed integer or boolean
	*/
	function InWard($enr,$loc_nr){
		$this->enc_nr=$enr;
		$this->loc_nr=$loc_nr;
		return $this->_InLocation(2);
	}
	/**
	* Checks if the encounter has been finally assigned a room.
	*
	* If the room location is finally assigned, its record primary key number will be returned, else FALSE.
	* @access private
	* @param int Encounter number
	* @param int Room number
	* @return mixed integer or boolean
	*/
	function InRoom($enr,$loc_nr){
		$this->enc_nr=$enr;
		$this->loc_nr=$loc_nr;
		return $this->_InLocation(4);
	}
	/**
	* Checks if the encounter has been finally assigned a bed.
	*
	* If the bed location is finally assigned, its record primary key number will be returned, else FALSE.
	* @access private
	* @param int Encounter number
	* @param int Bed number
	* @return mixed integer or boolean
	*/
	function InBed($enr,$loc_nr){
		$this->enc_nr=$enr;
		$this->loc_nr=$loc_nr;
		return $this->_InLocation(5);
	}
	/**
	* Checks if the encounter (outpatient) is finally admitted to a department (or clinic).
	*
	* If finally admitted to department location, its record primary key number will be returned, else FALSE.
	* @access private
	* @param int Encounter number
	* @param int Department number
	* @return mixed integer or boolean
	*/
	function InDept($enr,$loc_nr){
		$this->enc_nr=$enr;
		$this->loc_nr=$loc_nr;
		return $this->_InLocation(1);
	}
	/**
	* Saves the encounter location with a given location type, location group and location number.
	*
	* @access private
	* @param int Encounter number
	* @param int Location type number
	* @param int Location number
	* @param int Location group number
	* @param string  Date
	* @param string Time
	* @return boolean
	*/
	function _setLocation($enr=0,$type_nr=0,$loc_nr=0,$group_nr,$date='',$time=''){
		global $_SESSION, $db;
		//$db->debug=1;
		//if(!($enr&&$type_nr&&$loc_nr)) return FALSE;
		if(empty($date)) $date=date('Y-m-d');
		if(empty($time)) $time=date('H:i:s');
		$user=$_SESSION['sess_user_name'];
		$history="Create: ".date('Y-m-d H:i:s')." ".$user."\n";
		$this->sql="INSERT INTO $this->tb_location (encounter_nr,type_nr,location_nr,group_nr,date_from,time_from,history,create_id,create_time)
						VALUES 
						('$enr','$type_nr','$loc_nr','$group_nr','$date','$time','$history','$user','".date('YmdHis')."')";
		//echo $this->sql;
		//if($this->Transact($this->sql))	return true; else	echo $this->sql;
		return $this->Transact($this->sql);
	}
	/**
	* Saves the encounter's ward location. 
	* If the save routine is successful, the "currently in ward" flag of the encounter record will also be set internally.
	* @access public
	* @param int Encounter number
	* @param int Ward number
	* @param int Department number
	* @param string  Date
	* @param string Time
	* @return boolean
	*/
	function assignInWard($enr,$loc_nr,$group_nr,$date,$time){
		if($this->_setLocation($enr,2,$loc_nr,$group_nr,$date,$time)){ # loc. type 2 = ward
			return $this->setCurrentWardInWard($enr,$loc_nr);
		}
	}
	/**
	* Saves the encounter's room location. 
	* @access public
	* @param int Encounter number
	* @param int Room number
	* @param int Ward number
	* @param string  Date
	* @param string Time
	* @return boolean
	*/
	function assignInRoom($enr,$loc_nr,$group_nr,$date,$time){
		return $this->_setLocation($enr,4,$loc_nr,$group_nr,$date,$time); # loc. type 4 = room
	}
	/**
	* Saves the encounter's room location. 
	* @access public
	* @param int Encounter number
	* @param int Bed number
	* @param int Room number
	* @param string  Date
	* @param string Time
	* @return boolean
	*/
	function assignInBed($enr,$loc_nr,$group_nr,$date,$time){
		return $this->_setLocation($enr,5,$loc_nr,$group_nr,$date,$time); # loc. type 5 = bed
	}
	/**
	* Saves the encounter's room location. 
	* If the save routine is successful, the "currently in department" flag of the encounter record will also be set internally.
	* @access public
	* @param int Encounter number
	* @param int Department number
	* @param int Department number
	* @param string  Date
	* @param string Time
	* @return boolean
	*/
	function assignInDept($enr,$loc_nr,$group_nr,$date,$time){
		if($this->_setLocation($enr,1,$loc_nr,$group_nr,$date,$time)){ # loc. type 1 = department
			return $this->setCurrentDeptInDept($enr,$loc_nr);
		}
	}
	/**
	* Admits a patient in ward with  a ward number, room number and bed number.
	* If the save routine is successful, the "currently in ward" flag of the encounter record will also be set internally.
	* @access public
	* @param int Encounter number
	* @param int Ward number
	* @param int Room number
	* @param int Bed number
	* @return boolean
	*/
	function AdmitInWard($enr,$ward_nr,$room_nr,$bed_nr){
		global $db;
		
		$date=date('Y-m-d');
		$time=date('H:i:s');
		if($this->InWard($enr,$ward_nr)){
			$ok=true;
		}else{
			if($this->assignInWard($enr,$ward_nr,$ward_nr,$date,$time)){
				$ok=true;
			}else{$ok=FALSE;}
		}
		if($this->InRoom($enr,$room_nr)){
			$ok=true;
		}else{
			if($this->assignInRoom($enr,$room_nr,$ward_nr,$date,$time)){
				$ok=true;
			}else{$ok=FALSE;}
		}
		if($ok&&!$this->InBed($enr,$bed_nr)){
			if($this->assignInBed($enr,$bed_nr,$ward_nr,$date,$time)){
				return true;
			}else{return FALSE;}
		}else{
			return FALSE;
		}
	}
	/**
	* Updates location assignment items. Generic method for setting location assigment information.
	* @access private
	* @param int Encounter nr
	* @param string Data for updating, formatted in sql syntax
	* @param string Modification action for appeding to the record's history, defaults to "modified"
	* @return boolean
	*/
	function _setCurrentAssignment($enr,$data='',$act='Modified'){
		global $_SESSION, $dbtype;
		if(!$enr||empty($data)) return FALSE;
		/*
		if($dbtype=='mysql'){
			$data.=",history=CONCAT(history,'\n$act ".date('Y-m- H:i:s')." ".$_SESSION['sess_user_name']."'), ";
		}else{
			$data.=",history=(history || '\n$act ".date('Y-m- H:i:s')." ".$_SESSION['sess_user_name']."'), ";
		}
		*/
		$data.=",history=".$this->ConcatHistory("\n$act ".date('Y-m- H:i:s')." ".$_SESSION['sess_user_name']).", ";
		$data.="	modify_id='".$_SESSION['sess_user_name']."',
				modify_time='".date('YmdHis')."'";
		$this->sql="UPDATE $this->tb_enc SET $data WHERE encounter_nr=$enr";
		return $this->Transact($this->sql);
	}
	/**
	* Sets encounter's current ward number.
	* @access public
	* @param int Encounter nr
	* @param int New ward number
	* @return boolean
	*/
	function setCurrentWard($enr,$assign_nr){
		return $this->_setCurrentAssignment($enr,"current_ward_nr=$assign_nr",'Set ward');
	}
	/**
	* Sets encounter's current ward number and set the "currently in ward" status of the encounter.
	* @access public
	* @param int Encounter nr
	* @param int New ward number
	* @return boolean
	*/
	function setCurrentWardInWard($enr,$assign_nr){
		return $this->_setCurrentAssignment($enr,"encounter_status='disallow_cancel',current_ward_nr=$assign_nr,in_ward",'Set ward + in ward');
	}
	/**
	* Sets encounter's current room number.
	* @access public
	* @param int Encounter nr
	* @param int New room number
	* @return boolean
	*/
	function setCurrentRoom($enr,$assign_nr){
		return $this->_setCurrentAssignment($enr,"current_room_nr=$assign_nr",'Set room');
	}
	/**
	* Sets encounter's current department number.
	* @access public
	* @param int Encounter nr
	* @param int New department number
	* @return boolean
	*/
	function setCurrentDept($enr,$assign_nr){
		return $this->_setCurrentAssignment($enr,"current_dept_nr=$assign_nr",'Set dept');
	}
	/**
	* Sets encounter's current department number and sets the "currently in department" status of the encounter..
	* @access public
	* @param int Encounter nr
	* @param int New department number
	* @return boolean
	*/
	function setCurrentDeptInDept($enr,$assign_nr){
		return $this->_setCurrentAssignment($enr,"encounter_status='disallow_cancel',current_dept_nr=$assign_nr,in_dept=1",'Set dept + in dept');
	}
	/**
	* Sets encounter's current firm number.
	* @access public
	* @param int Encounter nr
	* @param int New firm number
	* @return boolean
	*/
	function setCurrentFirm($enr,$assign_nr){
		return $this->_setCurrentAssignment($enr,"current_firm_nr=$assign_nr",'Set firm');
	}
	/**
	* Sets encounter's current attending physician number.
	* @access public
	* @param int Encounter nr
	* @param int Attending physician number
	* @return boolean
	*/
	function setCurrentAttdDr($enr,$assign_nr){
		return $this->_setCurrentAssignment($enr,"current_att_dr_nr=$assign_nr",'Set attd dr.');
	}
	/**
	* Resets encounter's current ward number to 0.
	* @access public
	* @param int Encounter nr
	* @return boolean
	*/
	function resetCurrentWard($enr){
		return $this->_setCurrentAssignment($enr,"current_ward_nr=0,in_ward=0",'Reset current ward');
	}
	/**
	* Resets encounter's current department number to 0.
	* @access public
	* @param int Encounter nr
	* @return boolean
	*/
	function resetCurrentDept($enr){
		return $this->_setCurrentAssignment($enr,"current_dept_nr=0,in_dept=0",'Reset current dept');
	}
	/**
	* Sets encounter's current "ward" status to "In ward". Sets the encounter to "disallow cancel".
	* @access public
	* @param int Encounter nr
	* @return boolean
	*/
	function setInWard($enr){
		return $this->_setCurrentAssignment($enr,"current_status='disallow_cancel',in_ward=1",'Set in ward');
	}
	/**
	* Resets encounter's current "ward" status to "not in ward".
	* @access public
	* @param int Encounter nr
	* @return boolean
	*/
	function setNotInWard($enr){
		return $this->_setCurrentAssignment($enr,'in_ward=0','Set not in ward');
	}
	/**
	* Sets encounter's current "department" status to "In department". Sets the encounter to "disallow cancel".
	* @access public
	* @param int Encounter nr
	* @return boolean
	*/
	function setInDept($enr){
		return $this->_setCurrentAssignment($enr,"current_status='disallow_cancel',in_dept=1",'Set in dept');
	}
	/**
	* Resets encounter's current "department" status to "not in department".
	* @access public
	* @param int Encounter nr
	* @return boolean
	*/
	function setNotInDept($enr){
		return $this->_setCurrentAssignment($enr,'in_dept=0','Set not in dept');
	}
	/**
	* Sets encounter's two status to "In ward" and "disallow cancel". Sets the current ward number and current room number.
	* @access public
	* @param int Encounter nr
	* @param int Ward nr
	* @param int Room nr
	* @param int Bed nr (reserved)
	* @return boolean
	*/
	function setAdmittedInWard($enr,$ward_nr,$room_nr,$bed_nr){
		return $this->_setCurrentAssignment($enr,"encounter_status='disallow_cancel',current_ward_nr=$ward_nr,current_room_nr=$room_nr,in_ward=1",'Admitted in ward');
	}
	/**
	* Resets encounter's current locations to 0.
	* Resetted locations are:
	* - current ward number
	* - current room number
	* - current departement number
	* - current firm number
	* - in ward flag
	* @access public
	* @param int Encounter nr
	* @return boolean
	*/
	function ResetAllCurrentPlaces($enr){
		return $this->_setCurrentAssignment($enr,'current_ward_nr=0,current_room_nr=0,current_dept_nr=0,current_firm_nr=0,in_ward=0','Reset all locations');
	}
	
	/**
	* Cancels an encounter, but only when its encounter_status is set to '' (emtpy) or 'allow_cancel'.
	* Sets the encounter_status= 'cancelled', status='void', is_discharged=1 and stores history and modify infos
	* @access public
	* @param int Encounter number
	* @param string Optional name of person responsible for cancellation
	* @return boolean
	*/
	function Cancel($enc_nr=0,$by){
		global $_SESSION;
		if(!$this->internResolveEncounterNr($enc_nr)) return FALSE;
		if(empty($by)) $by=$_SESSION['sess_user_name'];
		$this->sql="UPDATE $this->tb_enc SET encounter_status='cancelled',status='void',is_discharged=1,
						history=".$this->ConcatHistory("Cancelled ".date('Y-m- H:i:s')." by $by, logged-user ".$_SESSION['sess_user_name']."\n").",
						modify_id='".$_SESSION['sess_user_name']."',
						modify_time='".date('YmdHis')."' 
						WHERE encounter_nr=$this->enc_nr AND encounter_status IN ('','0','allow_cancel')";
		return $this->Transact($this->sql);
	}
	/**
	* Replaces the current ward number and resets the in_ward flag to 0: status is "not in ward".
	* @access public
	* @param int Encounter number
	* @param int New ward number
	* @return boolean
	*/
	function ReplaceWard($enr,$ward_nr){
		return $this->_setCurrentAssignment($enr,"current_ward_nr=$ward_nr,in_ward=0",'Replaced ward');
	}
	/**
	* Sets the discharge status that the encounter/admission is fully discharged.
	* Sets the is_discharged field of care_encounter table and resets the current department,ward,room fields.
	* @access public
	* @param int Encounter number
	* @param string Date of discharge
	* @param string Time of discharge
	* @return boolean
	*/
	function setIsDischarged($enr,$date,$time){
		//$this->sql="UPDATE $this->tb_enc SET is_discharged=1, discharge_date='$date',discharge_time='$time', current_ward_nr=0,current_room_nr=0,current_dept_nr=0,current_firm_nr=0,in_ward=0 WHERE encounter_nr=$enr AND NOT is_discharged";
		$this->sql="UPDATE $this->tb_enc SET is_discharged=1, discharge_date='$date',discharge_time='$time', in_ward=0,in_dept=0 WHERE encounter_nr=$enr AND is_discharged IN ('',0)";
		//if($this->Transact($this->sql)) return true; else echo $this->sql;
		return $this->Transact($this->sql);
	}
	/**
	* Gets the discharge types.
	* The resulting adodb record object contains rows of arrays.
	* Each array contains the discharge type information with the following index keys:
	* - nr = The primary key number
	* - name = the name of discharge type
	* - LD_var = the variable name for the foreign language version of the discharge name
	*
	* @return mixed adodb record object or boolean
	*/
	function getDischargeTypesData(){
		global $db;
		//$db->debug=1;
		$this->sql="SELECT nr,name,LD_var AS \"LD_var\" FROM $this->tb_dis_type ORDER BY nr";
		if($this->result=$db->Execute($this->sql)){
			if($this->result->RecordCount()){
				return $this->result;
			}else{return FALSE;}
		}else{return FALSE;}
	}		
	/**
	* Discharge an encounter.
	* Avoid using this function directly. Use the appropriate methods
	* @access private
	* @param int Encounter number
	* @param int Location type number (ward number or department number)
	* @param int Discharge type number
	* @param string Date of discharge
	* @param string Time of discharge
	* @return boolean
	*/
	function _discharge($enr,$loc_types,$d_type_nr,$date='',$time=''){
		global $_SESSION, $dbf_nodate, $dbtype;
		if(empty($date)) $date=date('Y-m-d');
		if(empty($time)) $time=date('H:i:s');
		$this->sql="UPDATE $this->tb_location
							SET	discharge_type_nr=$d_type_nr,
									date_to='$date',
									time_to='$time',
									status='discharged',";
        /*
        if($dbtype=='mysql'){
			$this->sql.=" history=CONCAT(history,'\nUpdate (discharged): ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."'),";
		}else{
			$this->sql.=" history= history || '\nUpdate (discharged): ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."' ,";
		}
        */
            $this->sql.= "history =".$this->ConcatHistory("Update (discharged): ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."\n").",";
            $this->sql.=" modify_id='".$_SESSION['sess_user_name']."'
							WHERE encounter_nr=$enr AND type_nr IN ($loc_types) AND date_to ='$dbf_nodate'";
		if($this->Transact($this->sql)){
           return true;
        }else{
              //echo $this->sql;
              return FALSE;
         }
		//return $this->Transact($this->sql);
	}
	/**
	* Complete discharge of patient from the hospital or clinic.
	* @access public
	* @param int Encounter number
	* @param int Discharge type number
	* @param string Date of discharge
	* @param string Time of discharge
	* @return boolean
	*/
	function Discharge($enr,$d_type_nr,$date='',$time=''){
		if($this->_discharge($enr,"'1','2','3','4','5','6'",$d_type_nr,$date,$time)){
			if($this->setIsDischarged($enr,$date,$time)){
				return true;
			}else{return FALSE;}
		}else{return FALSE;}
	}
	/**
	* Complete discharge of patient from the department, but patient remains admitted.
	* @access public
	* @param int Encounter number
	* @param int Discharge type number
	* @param string Date of discharge
	* @param string Time of discharge
	* @param boolean Reset encounter flag (reserved)
	* @return boolean
	*/
	function DischargeFromDept($enr,$d_type_nr,$date='',$time='',$rst_enc=1){
		if($this->_discharge($enr,"'1','2','3','4','5','6'",$d_type_nr,$date,$time)){
			return $this->resetCurrentDept($enr);
		}
	}
	/**
	* Complete discharge of patient from the ward but patient remains admitted.
	* @access public
	* @param int Encounter number
	* @param int Discharge type number
	* @param string Date of discharge
	* @param string Time of discharge
	* @return boolean
	*/
	function DischargeFromWard($enr,$d_type_nr,$date='',$time=''){
		if($this->_discharge($enr,"'2','4','5','6'",$d_type_nr,$date,$time)){
			return true;
		}else{return FALSE;}
	}
	/**
	* Complete discharge of patient from the room but patient remains in ward.
	* @access public
	* @param int Encounter number
	* @param int Discharge type number
	* @param string Date of discharge
	* @param string Time of discharge
	* @return boolean
	*/
	function DischargeFromRoom($enr,$d_type_nr,$date='',$time=''){
		if($this->_discharge($enr,"'4','5','6'",$d_type_nr,$date,$time)){
			return true;
		}else{return FALSE;}
	}
	/**
	* Complete discharge of patient from the bed but patient remains in room.
	* @access public
	* @param int Encounter number
	* @param int Discharge type number
	* @param string Date of discharge
	* @param string Time of discharge
	* @return boolean
	*/
	function DischargeFromBed($enr,$d_type_nr,$date='',$time=''){
		if($this->_discharge($enr,"'5'",$d_type_nr,$date,$time)){
			return true;
		}else{return FALSE;}
	}
	/**
	* Saves discharge notes of an encounter.
	* The data must be contained in an associative array and passed to the function by reference.
	* @param array Data to be saved
	* @return boolean
	*/
	function saveDischargeNotesFromArray(&$data_array){
		$this->setTable($this->tb_notes);
		$this->data_array=$data_array;
		$this->setRefArray($this->fld_notes);
		if($this->_insertNotesFromInternalArray(3)){ // 3 = discharge summary note type
			return true;
		}else{
			return FALSE;
		}
	}
	/**
	* Returns the contents of the internal encounter data buffer <var>$encounter</var>
	*
	* @return mixed adodb record object or boolean
	*/
	function getLoadedEncounterData(){
		if($this->is_loaded){
			return $this->encounter;
		}else{return FALSE;}
	}	
	/**
	* Gets an adodb object containing the "very basic" encounter's first name, family name, birth date and sex.
	* @param int Encounter number
	* @return mixed adodb record object or boolean
	*/
	function getBasic4Data($enc_nr){
	    global $db;
		if(!$this->internResolveEncounterNr($enc_nr)) return FALSE;
		$this->sql="SELECT p.name_last, p.name_first, p.date_birth, p.sex
							FROM $this->tb_enc AS e, 
									 $this->tb_person AS p 
							WHERE e.encounter_nr=$this->enc_nr
								AND e.pid=p.pid";
		//echo $sql;
		if($this->result=$db->Execute($this->sql)) {
		    if($this->result->RecordCount()) {
				return $this->result;
		    } else { return FALSE;}
		} else { return FALSE;}
	}
	/**
	* Points  the core to the care_encounter_sickconfirm table and fields
	* @access public
	*/
	function useSicknessConfirm(){
		$this->coretable=$this->tb_sickconfirm;
		$this->ref_array=$this->fld_sickconfirm;
	}	
	/**
	* Gets a stored sickness confirmation of an encounter.
	*
	* The returned adodb object contains rows of arrays.
	* Each array contains sickness data with following index keys:
	* - all keys as stored in the <var>$fld_sickconfirm</var> array
	* - <b>sig_stamp</b> = Signature stamp of the department
	* - <b>logo_mime_type</b> = Mime type (or extension) of the department's logo image
	*
	*
	* @access public
	* @param int Primary key number of the record
	* @return mixed adodb record object or boolean
	*/
	function getSicknessConfirm($nr=0){
	    global $db;
		if(!$nr) return FALSE;
		$this->sql="SELECT s.*,d.sig_stamp,d.logo_mime_type 
							FROM $this->tb_sickconfirm AS s 
							LEFT JOIN $this->tb_dept AS d ON s.dept_nr=d.nr
							WHERE s.nr=$nr";
		//echo $sql;
		if($this->result=$db->Execute($this->sql)) {
		    if($this->rec_count=$this->result->RecordCount()) {
				return $this->result;
		    } else { return FALSE;}
		} else { return FALSE;}
	}
	/**
	* Gets all stored sickness confirmations of an encounter based on its department and encounter numbers.
	* @access public
	* @param int Department number , if department number is zero, all available sickness records will be fetched
	* @param int Encounter number
	* @return mixed adodb record object or boolean
	*/
	function allSicknessConfirm($dept_nr=0,$enc_nr=0){
	    global $db;
		//if(!$this->internResolveEncounterNr($enc_nr)) return FALSE;
		$this->sql="SELECT s.*,d.LD_var,d.name_formal,d.sig_stamp,d.logo_mime_type
						FROM $this->tb_sickconfirm AS s
							LEFT JOIN $this->tb_dept AS d ON s.dept_nr=d.nr
						WHERE s.encounter_nr=$this->enc_nr AND s.status NOT IN ($this->dead_stat)";
		if($dept_nr) $this->sql=$this->sql." AND s.dept_nr=$dept_nr";
		$this->sql.=' ORDER BY s.date_confirm DESC';
		
		//echo $this->sql;
		if($this->result=$db->Execute($this->sql)) {
		    if($this->rec_count=$this->result->RecordCount()) {
				return $this->result;
		    } else { return FALSE;}
		} else { return FALSE;}
	}
	/**
	* Saves a sickness confirmation of an encounter.
	* @access public
	* @param array Sickness confirmation data. By reference.
	* @return boolean
	*/
	function saveSicknessConfirm(&$data){
		if(!is_array($data)) return FALSE;
		$this->useSicknessConfirm();
		$data['date_create']=date('Y-m-d H:i:s');
		$this->data_array=$data;
		return $this->insertDataFromInternalArray();
	}
	/**
	* Returns the insurance relevant data of an encounter.
	*
	* The returned adodb object contains rows of arrays.
	* Each array contains data with following index keys:
	* - <b>insurance_nr</b> = the insurance number
	* - <b>name</b> = insurance company's name
	* - <b>sub_area</b> = insurance company's sub area
	*
	* @access public
	* @param  int Encounter number
	* @return mixed adodb record object or boolean
	*/
	function EncounterInsuranceData($enc_nr=0){
	    global $db;
		if(!$this->internResolveEncounterNr($enc_nr)) return FALSE;
		$this->sql="SELECT e.insurance_nr, i.name, i.sub_area FROM $this->tb_enc  AS e
							LEFT JOIN $this->tb_insco AS i ON e.insurance_firm_id=i.firm_id
						WHERE e.encounter_nr=$this->enc_nr AND e.status NOT IN ($this->dead_stat)";	
		//echo $sql;
		if($this->result=$db->Execute($this->sql)) {
		    if($this->rec_count=$this->result->RecordCount()) {
				return $this->result;
		    } else { return FALSE;}
		} else { return FALSE;}
	}
	 /**
	 * Marks an appointment's status as "done" and links the encounter number resulting from the appointment.
	 * @access public
	 * @param int Appointment record number
	 * @param int Final type of encounter (1= inpatient, 2= outpatient)
	 * @param int Encounter number that resulted from the appointment
	 * @return boolean
	 */
	function markAppointmentDone($appt_nr=0,$class_nr=0,$enc_nr=0){
	    global $_SESSION;
		if(!$appt_nr||!$this->internResolveEncounterNr($enc_nr)) return FALSE;
		$this->sql="UPDATE $this->tb_appt SET  appt_status='done',encounter_nr=$this->enc_nr,encounter_class_nr=$class_nr,
							history=".$this->ConcatHistory("Done ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."\n").",
							modify_id='".$_SESSION['sess_user_name']."',
							modify_time='".date('YmdHis')."'
							WHERE nr=$appt_nr";
		return $this->Transact();
	}
	/**
	* Gets  basic information of all outpatients.
	*
	* The returned adodb object contains rows of arrays.
	* Each array contains data with following index keys:
	* - <b>encounter_nr</b> = the encounter number
	* - <b>pid</b> = PID number
	* - <b>insurance_class_nr</b> = insurance class number
	* - <b>title</b> = person's title
	* - <b>name_last</b> = person's last or family name
	* - <b>name_first</b> = person's first or given name
	* - <b>date_birth</b> = date of birth
	* - <b>sex</b> = sex
	* - <b>photo_filename</b> = filename of the stored picture ID
	* - <b>time</b> = appointment's scheduled time
	* - <b>urgency</b> = appointment's urgency level
	* - <b>LD_var</b> = variable's name for the foreign language version of insurance class name
	* - <b>insurance_name</b> = default insurance class name
	* - <b>notes</b> = clinic's notes primary key number
	*
	*
	* @access public
	* @param int Department number, if empty all departments will be searched
	* @return mixed adodb record object or boolean
	*/
	function OutPatientsBasic($dept_nr=0){
		global $db;
		//$db->debug=1;
		if($dept_nr) $cond="e.current_dept_nr=$dept_nr AND";
			else $cond='';
			//$cond='';
		$this->sql="SELECT e.encounter_nr,e.pid,e.insurance_class_nr,p.title,p.name_last,p.name_first,p.date_birth,p.sex, p.photo_filename,
									a.date, a.time,a.urgency, i.LD_var AS \"LD_var\",i.name AS insurance_name,
									n.nr AS notes
							FROM $this->tb_enc AS e  
									LEFT JOIN $this->tb_person AS p ON e.pid=p.pid
									LEFT JOIN $this->tb_appt AS a ON e.encounter_nr=a.encounter_nr
									LEFT JOIN $this->tb_ic AS i ON e.insurance_class_nr=i.class_nr
									LEFT JOIN $this->tb_notes as n ON (e.encounter_nr=n.encounter_nr AND n.type_nr=6)
							WHERE $cond e.encounter_class_nr=2 AND
									e.is_discharged=0  AND
									e.in_dept<>0 AND e.status NOT IN ($this->dead_stat)
							ORDER BY e.encounter_nr";
							/*							GROUP BY e.encounter_nr,e.pid,e.insurance_class_nr,p.title,p.name_last,p.name_first,p.date_birth,p.sex,
							p.photo_filename,a.date, a.time,a.urgency,i.LD_var,i.name, n.nr*/
							
        if($this->res['opb']=$db->Execute($this->sql)) {
            if($this->rec_count=$this->res['opb']->RecordCount()) {
				 return $this->res['opb'];	 
			} else { return FALSE; }
		} else { return FALSE; }	
	}
	/**
	* createWaitingOutpatientList() creates a list of outpatients waiting to be admitted in the clinic
	*
	* The returned adodb object contains rows of arrays.
	* Each array contains data with following index keys:
	* - <b>encounter_nr</b> = the encounter number
	* - <b>encounter_class_nr</b> = the encounter class number (1 = inpatient, 2 = outpatient)
	* - <b>current_dept_nr</b> = the current department number
	* - <b>pid</b> = PID number
	* - <b>name_last</b> = person's last or family name
	* - <b>name_first</b> = person's first or given name
	* - <b>date_birth</b> = date of birth
	* - <b>sex</b> = sex
	* - <b>dept_nr</b> = current department number
	* - <b>name_short</b> = short department name
	* - <b>LD_var</b> = variable's name for the foreign language version of department name
	*
	*
	* @access public
	* @param int Department number, if empty all departments will be searched
	* @return mixed adodb record object or boolean
	*/
	function createWaitingOutpatientList($dept_nr=0){
		global $db;
		//$db->debug=1;
		if($dept_nr) $cond="AND current_dept_nr='$dept_nr'";
			else $cond='';
		$this->sql="SELECT e.encounter_nr, e.encounter_class_nr, e.current_dept_nr,
									p.pid, p.name_last, p.name_first, p.date_birth, p.sex, 
									d.nr AS dept_nr, d.name_short, d.LD_var AS \"dept_LDvar\"
				FROM $this->tb_enc AS e
					LEFT JOIN $this->tb_person AS p ON e.pid=p.pid
					LEFT JOIN $this->tb_dept AS d ON e.current_dept_nr=d.nr
				WHERE e.encounter_class_nr='2' AND e.is_discharged=0 $cond
							AND  e.in_dept=0 AND e.encounter_status <> 'cancelled'
							AND e.status NOT IN ($this->dead_stat)
				ORDER BY p.name_last";
		//echo $sql;
	    if ($this->res['cwol']=$db->Execute($this->sql)){
		   	if ($this->rec_count=$this->res['cwol']->RecordCount()){
				return $this->res['cwol'];
			}else{return FALSE;}
		}else{return FALSE;}
	}
	/**
	* Returns the status information  and current locations of an encounter.
	*
	* The returned adodb object contains rows of arrays.
	* Each array contains data with following index keys:
	* - <b>encounter_status</b> =  encounter status
	* - <b>current_room_nr</b> =  current room number
	* - <b>current_ward_nr</b> =  current ward number
	* - <b>current_dept_nr</b> =  current department number
	* - <b>in_dept</b> = "in department" status
	* - <b>in_ward</b> = "in ward" status
	* - <b>is_discharged</b> = discharge status
	* - <b>status</b> = record's technical status
	*
	*
	* @access public
	* @param int Encounter number
	* @return mixed  adodb record object or boolean
	*/
	function AllStatus($enc_nr=0){
	    global $db;
		if(!$this->internResolveEncounterNr($enc_nr)) return FALSE;
		$this->sql="SELECT encounter_status,current_ward_nr,current_room_nr,in_ward,current_dept_nr,in_dept,is_discharged,status
						FROM $this->tb_enc	WHERE encounter_nr=$this->enc_nr AND status NOT IN ($this->dead_stat)";	
		//echo $sql;
		if($this->res['ast']=$db->Execute($this->sql)) {
		    if($this->rec_count=$this->res['ast']->RecordCount()) {
				return $this->res['ast'];
		    } else { return FALSE;}
		} else { return FALSE;}
	}
	/**
	* Gets a particular encounter item based on its encounter number key.
	*
	* For details on field names of items that can be fetched, see the <var>$tab_fields</var> array.
	* @access private
	* @param string Field name of the item to be fetched
	* @param int encounter number
	* @return mixed string, integer, or boolean
	*/
	function getValue($item,$enr='',$person=FALSE) {
	    global $db;

	    if($this->is_loaded) {
		    if(isset($this->encounter[$item])) return $this->encounter[$item];
		        else  return false;
		} else {
			if($this->internResolveEncounterNr($enr)){
				if($person){
					$this->sql="SELECT p.$item FROM $tb_enc AS e, $tb_person AS p WHERE e.encounter_nr=$this->enc_nr AND e.pid=p.pid";
				}else{
					$this->sql="SELECT $item FROM $tb_enc WHERE encounter_nr=$this->enc_nr";
				}
			//return $this->sql;
		 		if($result=$db->Execute($this->sql)) {
					if($result->RecordCount()) {
						$row=$this->result->FetchRow();
						return $row[$item];
					} else { return false; }
				} else { return false; }
			}else{ return false; }
		}
	}
}
?>
