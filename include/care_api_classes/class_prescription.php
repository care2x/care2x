<?php
/**
* @package care_api
*/
/** */
require_once($root_path.'include/care_api_classes/class_core.php');
/**
*  Prescription methods. 
*
* Note this class should be instantiated only after a "$db" adodb  connector object  has been established by an adodb instance
* @author Elpidio Latorilla
* @version beta 2.0.1
* @copyright 2002,2003,2004,2005,2005 Elpidio Latorilla
* @package care_api
*/
class Prescription extends Core {
	/**#@+
	* @access private
	* @var string
	*/
	/**
	* Table name for prescription data
	*/
	var $tb='care_encounter_prescription';
	/**
	* Table name for prescription_sub data
	*/
	var $tb_sub='care_encounter_prescription_sub';
	/**
	* Table name for application types
	*/
	var $tb_app_types='care_type_application';
	/**
	* Table name for prescription types
	*/
	var $tb_pres_types='care_type_prescription';
	/**#@-*/
	
	/**#@+
	* @access private
	*/
	/**
	* SQL query result buffer
	* @var adodb record object
	*/
	var $result;
	/**
	* Preloaded department data
	* @var adodb record object
	*/
	var $preload_dept;
	/**
	* Preloaded data flag
	* @var boolean
	*/
	var $is_preloaded=false;
	/**
	* Number of departments
	* @var int
	*/
	var $dept_count;
	/**
	* Field names of care_encounter_prescription table
	* @var int
	*/
	var $tabfields=array('nr',
						'encounter_nr',
						'prescribe_date',
						'prescriber',
						'notes',						
						'status',
						'history',
						'modify_id',
						'modify_time',
						'create_id',
						'create_time');
	/**
	* Field names of care_encounter_prescription table
	* @var int
	*/
	var $tabfields_sub=array('nr', 
							'prescription_nr',
							'prescription_type_nr',
							'bestellnum',
							'article',
							'drug_class',
							'dosage',
							'admin_time',
							'quantity',
							'application_type_nr',
							'sub_speed',
							'notes_sub',
							'color_marker',
							'is_stopped',
							'stop_date',
							'status',
							'companion');						
	/**#@-*/
						
	/**
	* Constructor
	*/
	function Prescription(){
		$this->setTable($this->tb);
		$this->setRefArray($this->tabfields);
	}
	
	/**
	* Sets the core object to point  to either care_encounter_prescription or care_encounter_prescription_sub and field names.
	*
	* The table is determined by the parameter content. 
	* @access public
	* @param string Determines the final table name 
	* @return boolean.
	*/
	function usePrescription($type){
		if($type=='prescription'){
			$this->setTable($this->tb);
			$this->setRefArray($this->tabfields);
		}elseif($type=='prescription_sub'){
			$this->setTable($this->tb_sub);
			$this->setRefArray($this->tabfields_sub);
		}else{return false;}
	}
		
	/**
	* Gets all prescription types returned in a 2 dimensional array.
	*
	* The resulting data have the following index keys:
	* - nr = the primary key number
	* - type = prescription type
	* - name = type default name
	* - LD_var = variable's name for the foreign laguange version of type's name
	*
	* @access public
	* @return mixed array or boolean
	*/
	function getPrescriptionTypes(){
	    global $db;
	
	    if ($this->result=$db->Execute("SELECT nr,type,name,LD_var AS \"LD_var\" FROM $this->tb_pres_types")) {
		    if ($this->result->RecordCount()) {
		        return $this->result->GetArray();
			} else {
				return false;
			}
		}
		else {
		    return false;
		}
	}
	/**
	* Gets all application types returned in a 2 dimensional array.
	*
	* The resulting data have the following index keys:
	* - nr = the primary key number
	* - group_nr = the group number
	* - type = application type
	* - name = application's default name
	* - LD_var = variable's name for the foreign laguange version of application's name
	* - description =  description
	*
	* @access public
	* @return mixed array or boolean
	*/
	function getAppTypes(){
	    global $db;
	
	    if ($this->result=$db->Execute("SELECT nr,group_nr,type,name,LD_var AS \"LD_var\" ,description FROM $this->tb_app_types")) {
		    if ($this->result->RecordCount()) {
		        return $this->result->GetArray();
			} else {
				return false;
			}
		}
		else {
		    return false;
		}
	}
	/**
	* Gets the information of an application type based on its type number key.
	*
	* The resulting data have the following index keys:
	* - type = application type
	* - group_nr = the group number
	* - name = application's default name
	* - LD_var = variable's name for the foreign laguange version of application's name
	* - description =  description
	*
	* @access public
	* @param int Type number
	* @return mixed array or boolean
	*/
	function getAppTypeInfo($type_nr){
	    global $db;
	
	    if ($this->result=$db->Execute("SELECT type,group_nr,name,LD_var AS \"LD_var\" ,description FROM $this->tb_app_types WHERE nr=$type_nr")) {
		    if ($this->result->RecordCount()) {
		        return $this->result->FetchRow();
			} else {
				return false;
			}
		}
		else {
		    return false;
		}
	}
	/**
	* Gets the information of a prescription type based on its type number key.
	*
	* The resulting data have the following index keys:
	* - type = application type
	* - name = application's default name
	* - LD_var = variable's name for the foreign laguange version of application's name
	* - description =  description
	*
	* @access public
	* @param int Type number
	* @return mixed array or boolean
	*/
	function getPrescriptionTypeInfo($type_nr){
	    global $db;
	
	    if ($this->result=$db->Execute("SELECT type,name,LD_var  AS \"LD_var\",description FROM $this->tb_pres_types WHERE nr=$type_nr")) {
		    if ($this->result->RecordCount()) {
		        return $this->result->FetchRow();
			} else {
				return false;
			}
		}
		else {
		    return false;
		}
	}
	/**
	* Gets all current prescription data based on the primary key.
	* Gjergj Sheldija
	* changed by gjergj sheldija
	* to work with the new way of managing prescriptions
	* @param int Encounter number
	* @return mixed adodb record object or boolean
	*/
	function getAllPrescriptionById($nr){
		global $db;
		$this->sql="SELECT $this->tb_sub.* 
			FROM $this->tb_sub 
			WHERE $this->tb_sub.prescription_nr=$nr 
				AND $this->tb_sub.is_stopped IN ('',0) ORDER BY $this->tb_sub.prescription_nr";
		if($this->result=$db->Execute($this->sql)){
			return $this->result;
		}else{
			return false;
		}
	}
	/**
	 * Updates the status of a prescription, based on the encounter nr
	 * Gjergj Sheldija
	 * @param int prescription number
	 * @param string new status
	 * @return boolean
	 */
	function setPrescriptionStatus($prescriptionNr,$status) {
	    global $db;
		if(!$prescriptionNr) return FALSE;
		//prescription
		$this->sql="UPDATE $this->tb 
						SET status='$status'
						WHERE nr=$prescriptionNr";
		//echo $this->sql;
		$this->Transact($this->sql);
		//prescriprion_sub
		$this->sql="UPDATE $this->tb_sub 
						SET status='$status'
						WHERE prescription_nr=$prescriptionNr";
		return $this->Transact($this->sql);	
		//echo $this->sql;
	}
	
}
?>
