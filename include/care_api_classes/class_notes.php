<?php
/**
* @package care_api
*/
/**
*/
require_once($root_path.'include/care_api_classes/class_core.php');

/**
*  Notes methods.
*  Note: this class should be instantiated only after a "$db" adodb  connector object  has been established by an adodb instance.
* @author Elpidio Latorilla
* @version beta 2.0.1
* @copyright 2002,2003,2004,2005,2005 Elpidio Latorilla
* @package care_api
*/
class Notes extends Core {
	/**
	* Database table for the encounter notes data.
	* @var string
	* @access private
	*/
	var $tb_notes='care_encounter_notes';
	/**
	* Database table for the notes types.
	* @var string
	* @access private
	*/
	var $tb_types='care_type_notes';
	/**
	* Database table for the encounter data.
	* @var string
	* @access private
	*/
	var $tb_enc='care_encounter';
	/**
	* Holder for sql query results.
	* @var object adodb record object
	* @access private
	*/
	var $result;
	/**
	* Holder for preloaded department data.
	* @var object adodb record object
	* @access private
	*/
	var $preload_dept;
	/**
	* Preloaded flag
	* @var boolean
	* @access private
	*/
	var $is_preloaded=false;
	/**
	* Field names of care_encounter_notes table
	* @var array
	* @access private
	*/
	var $fld_notes=array('nr',
									'encounter_nr',
									'type_nr',
									'notes',
									'short_notes',
									'aux_notes',
									'ref_notes_nr',
									'personell_nr',
									'personell_name',
									'send_to_pid',
									'send_to_name',
									'date',
									'time',
									'location_type',
									'location_type_nr',
									'location_nr',
									'location_id',
									'ack_short_id',
									'date_ack',
									'date_checked',
									'date_printed',
									'send_by_mail',
									'send_by_email',
									'send_by_fax',
									'status',
									'history',
									'modify_id',
									'modify_time',
									'create_id',
									'create_time');
	/**
	* Constructor
	*/			
	function Notes(){
		$this->setTable($this->tb_notes);
		$this->setRefArray($this->fld_notes);
	}
	/**
	* Checks if a certain notes record of a certain type exists in the database.
	* @access private
	* @param int Encounter number
	* @param int Notes type number
	* @return boolean
	*/			
	function _Exists($enr,$type_nr){
		if($this->_RecordExists("type_nr=$type_nr AND encounter_nr=$enr")){
			return true;
		}else{return false;}
	}
	/**
	* Gets all types of notes record. Sorted result.
	* @access public
	* @param string Sort item
	* @return mixed 2 dimensional array or boolean
	*/			
	function getAllTypesSort($sort=''){
	    global $db;
	
		if(empty($sort)) $sort=" ORDER BY nr";
			else $sort=" ORDER BY $sort";
	    if ($this->result=$db->Execute("SELECT nr,type,name,LD_var AS \"LD_var\" FROM $this->tb_types WHERE status NOT IN ($this->dead_stat) $sort")) {
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
	* Gets all types of notes record. Unsorted result.
	* @access public
	* @param string Sort item
	* @return mixed 2 dimensional array or boolean
	*/			
	function getAllTypes(){
		return $this->getAllTypesSort();
	}
	/**
	* Gets notes type information based on the type number (nr key).
	*
	* The returned array has 4 elements:
	* - nr  = The type number (integer).
	* - type  = The optional type id (alphanumeric).
	* - name = The name of the notes type.
	* - LD_var  = The name of the language dependent variable containing the foreign name of the notes type.
	*
	* @access public
	* @return mixed 1 dimensional array or boolean
	*/			
	function getType($nr=1){
	    global $db;

	    if ($this->res['gt']=$db->Execute("SELECT nr,type,name,LD_var AS \"LD_var\" FROM $this->tb_types WHERE nr=$nr")) {
		    if ($this->res['gt']->RecordCount()) {
		        return $this->res['gt']->FetchRow();
			} else {
				return false;
			}
		}
		else {
		    return false;
		}
	}
	/**
	* Gets a notes record data based on a passed condition.
	* @access private
	* @param string Condition for the WHERE sql part. Query constraint.
	* @param string Sort directive in complete syntax e.g. "ORDER BY date DESC"
	* @return mixed adodb record object or boolean
	*/			
	function _getNotes($cond,$order='ORDER BY date,time DESC'){
	    global $db;
		$this->sql="SELECT * FROM $this->tb_notes WHERE $cond $order";
		///echo $this->sql;
	    if ($this->result=$db->Execute($this->sql)) {
		    if ($this->result->RecordCount()) {
		        //return true;
		        return $this->result;
			}else{return false;}
		}else{return false;}
	}
	/**
	* Save a notes data of a given type number.
	*
	* The data to be saved comes from an internal buffer array that is populated by other methods.
	* @access private
	* @param string Type number of the notes data to be saved.
	* @return boolean
	*/
	function _insertNotesFromInternalArray($type_nr=''){
		global $_SESSION;
		if(empty($type_nr)) return false;
		if(empty($this->data_array['date'])) $this->data_array['date']=date('Y-m-d');
		if(empty($this->data_array['time'])) $this->data_array['time']=date('H:i:s');
		$this->data_array['type_nr']=$type_nr;
		//$this->data_array['modify_id']=$_SESSION['sess_user_name'];
		$this->data_array['create_id']=$_SESSION['sess_user_name'];
		$this->data_array['create_time']=date('YmdHis');
		$this->data_array['history']="Create: ".date('Y-m-d H-i-s')." ".$_SESSION['sess_user_name']."\n\r";	
        	return $this->insertDataFromInternalArray();
	}
	/**
	* Updates a notes data record based on the primary record key "nr".
	*
	* The data to be saved comes from an internal buffer array that is populated by other methods.
	* @access private
	* @param int Record number of the notes record to be updated.
	* @return boolean
	*/			
	function _updateNotesFromInternalArray($nr){
		global $_SESSION;
		$this->data_array['modify_id']=$_SESSION['sess_user_name'];
		$this->data_array['modify_time']=date('YmdHis');
		$this->data_array['history']=$this->ConcatHistory("Update: ".date('Y-m-d H-i-s')." ".$_SESSION['sess_user_name']."\n\r");
		return $this->updateDataFromInternalArray($nr);
		/*
		if($this->updateDataFromInternalArray($nr)){
			return true;
		}else{ return false; }
		*/
	}
	/**
	* Gets the date range of a certain notes type that fits to a given condition.
	*
	* The resulting adodb record object is stored in the internal buffer $result.
	* @access private
	* @param int Encounter number
	* @param int Notes type number
	* @param string Condition string. Query constraint.
	* @return boolean
	*/			
	function _getNotesDateRange($enr='',$type_nr=0,$cond=''){
		global $db;
		if(empty($enr)){
			return false;
		}else{
			if(empty($cond) && $type_nr){
				$cond="encounter_nr=$enr AND type_nr=$type_nr";
			}
			$this->sql="SELECT MIN(date) AS fe_date, MAX(date) AS le_date FROM $this->tb_notes WHERE $cond";
			if($this->result=$db->Execute($this->sql)){
				if($this->result->RecordCount()){
					return true;
				}else{return false;}
			}else{return false;}
		}
	}
	/**
	*Gets all notes of a given record number.
	* @access public
	* @param int Record number
	* @return mixed adodb record object or boolean
	*/
	function getEncounterNotes($nr){
		return $this->_getNotes("nr=$nr AND status NOT IN ($this->dead_stat)",'');
	}
}
?>
