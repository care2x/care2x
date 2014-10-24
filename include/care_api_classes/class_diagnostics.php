<?php
/**
* @package care_api
*/

/**
*/
require_once($root_path.'include/care_api_classes/class_core.php');
/**
*  Diagnostics.
*  Note this class should be instantiated only after a "$db" adodb  connector object  has been established by an adodb instance.
* @author Elpidio Latorilla
* @version beta 2.0.1
* @copyright 2002,2003,2004,2005,2005 Elpidio Latorilla
* @package care_api
*/
class Diagnostics extends Core {
	/**
	* Table name for chemical lab test request
	* @var string
	*/
    var $tb_req_chem='care_test_request_chemlabor';
	/**
	* Table name for chemical lab test request lab parameters
	* @var string
	*/
    var $tb_req_chem_sub='care_test_request_chemlabor_sub';
	/**
	* Table name for bacteriology lab test request
	* @var string
	*/
    var $tb_req_bac='care_test_request_baclabor';
	/**
	* Table name for bacteriology lab test findings
	* @var string
	*/
    var $tb_find_bac_sub='care_test_findings_baclabor_sub';
	/**
	* Table name for bacteriology lab test findings
	* @var string
	*/
    var $tb_find_bac='care_test_findings_baclabor';
	/**
	* Table name for bacteriology lab test request
	* @var string
	*/
    var $tb_req_bac_sub='care_test_request_baclabor_sub';
	/**
	* Table name for blood bank request
	* @var string
	*/
    var $tb_req_blood='care_test_request_blood';
	/**
	* Table name for generic request form
	* @var string
	*/
    var $tb_req_generic='care_test_request_generic';
	/**
	* Table name for pathology lab test request
	* @var string
	*/
    var $tb_req_patho='care_test_request_patho';
	/**
	* Table name for radiology test request
	* @var string
	*/
    var $tb_req_radio='care_test_request_radio';
	/**
	* Holder for sql query results.
	* @var object adodb record object
	*/
	var $result;
	/**
	* Field names of care_test_request_chemlabor
	* @var array
	*/
	var $chemlabor=array('batch_nr',
							'encounter_nr',
							'room_nr',
							'dept_nr',
							'parameters',
							'doctor_sign',
							'highrisk',
							'notes',
							'send_date',
							'sample_time',
							'sample_weekday',
							'status',
							'urgent',
							'history',
							'modify_id',
							'modify_time',
							'create_id',
							'create_time');
	/**
	* Field names of care_test_request_chemlabor_sub
	* @var array
	*/
	var $chemlabor_sub=array('batch_nr',
							'encounter_nr',
							'paramater_name',
							'parameter_value');
	
	/**
	* Field names of care_test_request_baclabor
	* @var array
	*/
	var $baclabor=array('batch_nr',
							'encounter_nr',
							'dept_nr',
							'material',
							'test_type',
							'material_note',
							'diagnosis_note',
							'immune_supp',
							'send_date',
							'sample_date',
							'status',
							'history',
							'create_id',
							'create_time');	
	/**
	* Field names of care_test_request_baclabor_sub
	* @var array
	*/
	var $baclabor_sub=array('batch_nr',
							'encounter_nr',
							'test_type',
							'test_type_value',
							'material',
							'material_value');
	/**
	* Field names of care_test_findings_baclabor
	* @var array
	*/
	var $baclaborFindings=array('batch_nr',
							'encounter_nr',
							'room_nr',
							'dept_nr',
							'notes',
							'findings_init',
							'findings_current',
							'findings_final',
							'entry_nr',
							'rec_date',
							'doctor_id',
							'status',
							'history',
							'modify_id',
							'modify_time',
							'create_id',
							'create_time');
	/**
	* Field names of care_test_findings_baclabor_sub
	* @var array
	*/
	var $baclaborFindings_sub=array('batch_nr',
							'encounter_nr',
							'type_general',
							'resist_anaerob',
							'resist_aerob',
							'findings',
							'findings_date',
							'findings_time',
							'status',
							'history',
							'modify_id',
							'modify_time',
							'create_id',
							'create_time');
	/**
	* Sets the core to point to the care_test_request_chemlabor table
	* @access public
	*/
	function useChemLabRequestTable(){
		$this->setTable($this->tb_req_chem);
		$this->setRefArray($this->chemlabor);
	}
	
	/**
	* Sets the core to point to the care_test_request_chemlabor_sub table
	* @access public
	*/
	function useChemLabRequestSubTable(){
		$this->setTable($this->tb_req_chem_sub);
		$this->setRefArray($this->chemlabor_sub);
	}
	/**
	* Sets the core to point to the care_test_request_baclabor table
	* @access public
	*/
	function useBacLabRequestTable(){
		$this->setTable($this->tb_req_bac);
		$this->setRefArray($this->baclabor);
	}
	
	/**
	* Sets the core to point to the care_test_request_baclabor_sub table
	* @access public
	*/
	function useBacLabRequestSubTable(){
		$this->setTable($this->tb_req_bac_sub);
		$this->setRefArray($this->baclabor_sub);
	}
	/**
	* Sets the core to point to the care_test_findings_baclabor table
	* @access public
	*/
	function useBacLabFindingsTable(){
		$this->setTable($this->tb_find_bac);
		$this->setRefArray($this->baclaborFindings);
	}
	
	/**
	* Sets the core to point to the care_test_findings_baclabor_sub table
	* @access public
	*/
	function useBacLabFindingsSubTable(){
		$this->setTable($this->tb_find_bac_sub);
		$this->setRefArray($this->baclaborFindings_sub);
	}
	
	/**
	* Sets the core to point to the a care_test_request_????? table.
	* The ????? is replaced with string passed as parameter.
	* @access public
	* @param string The string to append to "care_test_request_" to create a complete table name.
	*/
	function useRequestTable($index){
		$this->setTable('care_test_request_'.$index);
		$this->setRefArray($this->$index);
	}
	/**
	* Sets the "where" variable of the core class.
	* The passed condition will be used in the WHERE part of the sql query.
	* @access public
	* @param string The string to append to "care_test_request_" to create a complete table name.
	*/
	function setWhereCond($cond){
		$this->where=$cond;
	}
}
