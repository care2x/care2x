<?php
/**
* API class for Nursing Notes and Documentation.
*  Core 
*   |_ Notes
*         |_ NursingNotes
* @package care_api
*/

/**
*/
require_once($root_path.'include/care_api_classes/class_core.php');
require_once($root_path.'include/care_api_classes/class_notes.php');

/**
*  Nursing Notes and Documentation methods.
*  Note this class should be instantiated only after a "$db" adodb  connector object  has been established by an adodb instance.
* @author Elpidio Latorilla
* @version beta 2.0.1
* @copyright 2002,2003,2004,2005,2005 Elpidio Latorilla
* @package care_api
*/
class NursingNotes extends Notes {
	/**
	* Constructor
	*/			
	function NursingNotes(){
		$this->Notes();
	}
	/**
	* Checks if nursing report record exists in the database.
	* @param int Encounter number
	* @return boolean
	*/			
	function Exists($enr){
		if($this->_RecordExists("type_nr=15 AND encounter_nr=$enr")){
			return true;
		}else{return false;}
	}
	/**
	* Checks if nursing effectivity report record exists in the database.
	* @param int Encounter number
	* @return boolean
	*/			
	function EffectivityExists($enr){
		if($this->_RecordExists("type_nr=17 AND encounter_nr=$enr")){
			return true;
		}else{return false;}
	}	
	/**
	* Checks if daily ward notes record exists in the database.
	* @param int Encounter number
	* @return mixed integer = record number if exists, FALSE=boolean if not exists
	*/			
	function DailyWardNotesExists($enr){
		$buf;
		if($this->_RecordExists("type_nr=6 AND encounter_nr=$enr")){
			$buf=$this->result->FetchRow();
			return $buf['nr'];
		}else{return false;}
	}
	/**
	* Gets a nursing report based on the encounter_nr key.
	* @param int Encounter number
	* @return mixed adodby record object if exists, FALSE=boolean if not exists
	*/			
	function getNursingReport($enr){
		if($this->_getNotes(" type_nr=15 AND encounter_nr=$enr","ORDER BY date,time")){
			return $this->result;
		}else{
			return false;
		}
	}
	/**
	* Gets a nursing effectivity report based on the encounter_nr key.
	* @param int Encounter number
	* @return mixed adodby record object if exists, FALSE=boolean if not exists
	*/			
	function getEffectivityReport($enr){
		if($this->_getNotes(" type_nr=17 AND encounter_nr=$enr","ORDER BY date,time")){
			return $this->result;
		}else{
			return false;
		}
	}
	/**
	* Gets both nursing report and effectivity report based on the encounter_nr key.
	* @param int Encounter number
	* @return mixed adodby record object if exists, FALSE=boolean if not exists
	*/			
	function getNursingAndEffectivityReport($enr){
		global $db;
		$this->sql="SELECT n.*,
						e.nr AS eff_nr,
						e.notes AS eff_notes,
						e.aux_notes AS eff_aux_notes,
						e.date AS eff_date,
						e.time AS eff_time,
						e.personell_name AS eff_personell_name
					FROM $this->tb_notes AS n LEFT JOIN $this->tb_notes AS e ON n.nr=e.ref_notes_nr AND e.encounter_nr=$enr
					WHERE (n.type_nr=15 AND n.encounter_nr=$enr)
						OR (n.type_nr=17 AND n.encounter_nr=$enr)
					ORDER BY date,time";
		if($this->result=$db->Execute($this->sql)){
			if($this->result->RecordCount()){
				return $this->result;
			}else{return false;}
		}else{ 
			return false;
		}
	}
	/**
	* Saves a nursing report.
	*
	* The data must be contained in an associative array and passed by reference.
	* @param array Nursing data in associative array. Reference pass.
	* @return boolean
	*/			
	function saveNursingReport(&$data){
		if(empty($data)){
			return false;
		}else{
			$this->data_array['encounter_nr']=$data['pn'];
			$this->data_array['notes']=$data['berichtput'];
			$this->data_array['date']=$data['dateput'];
			$this->data_array['time']=$data['timeput'];
			$this->data_array['personell_name']=$data['author'];
			$this->data_array['aux_notes']=$data['warn'];
		}
		return $this->_insertNotesFromInternalArray(15);
	}
	/**
	* Saves a nursing effectivity report.
	*
	* The data must be contained in an associative array and passed by reference.
	* @param array Nursing effectivity data in associative array. Reference pass.
	* @return boolean
	*/			
	function saveEffectivityReport(&$data){
		if(empty($data)){
			return false;
		}else{
			$this->data_array['encounter_nr']=$data['pn'];
			$this->data_array['notes']=$data['berichtput2'];
			$this->data_array['date']=$data['dateput2'];
			$this->data_array['time']=$data['timeput'];
			$this->data_array['personell_name']=$data['author2'];
			$this->data_array['aux_notes']=$data['warn2'];
			$this->data_array['ref_notes_nr']=$data['ref_notes_nr'];
		}
		return $this->_insertNotesFromInternalArray(17);
	}
	/**
	* Gets the date range of a nursing report.
	* @param int Encounter number
	* @return mixed 1 dimensional array or boolean
	*/			
	function getNursingReportDateRange($enr){
		if($this->_getNotesDateRange($enr,0,"encounter_nr=$enr AND (type_nr=15 OR type_nr=17)")){
			return $this->result->FetchRow();
		}else{return false;}
	}
	/**
	* Gets all daily notes data of an encounter number.
	* @param int Encounter number
	* @return mixed adodb record object or boolean
	*/			
	function getDailyWardNotes($enr){
		if($this->_getNotes("type_nr=6 AND encounter_nr=$enr","ORDER BY date,time")){
			return $this->result;
		}else{
			return false;
		}
	}
	/**
	* Saves a ward notes of a day.
	* @param string Ward notes. Reference pass.
	* @return boolean
	*/			
	function saveDailyWardNotes(&$data){
		$buf;	
		if(empty($data)){
			return false;
		}else{
			$this->data_array=$data;
			$this->data_array['encounter_nr']=$data['pn'];
			$this->data_array['location_nr']=$data['dept_nr'];
			$this->data_array['location_id']=$data['station'];
			$this->data_array['date']=date('Y-m-d');
			$this->data_array['time']=date('H:i:s');
			return $this->_insertNotesFromInternalArray(6);
		}
	}
}
?>
