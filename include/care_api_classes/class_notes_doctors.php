<?php
/**
*  API class for Doctor's Notes and Documentation
*  Core 
*   |_ Notes
*         |_ DoctorsNotes
*  Note this class should be instantiated only after a "$db" adodb  connector object
* has been established by an adodb instance
* Notes types:
* 19 = doctor's directive
* 18 = inquiry to doctor
* @package care_api
*/
/**
*/
require_once($root_path.'include/care_api_classes/class_core.php');
require_once($root_path.'include/care_api_classes/class_notes.php');
/**
*  Doctor's notes.
*  Note this class should be instantiated only after a "$db" adodb  connector object  has been established by an adodb instance.
* @author Elpidio Latorilla
* @version beta 2.0.1
* @copyright 2002,2003,2004,2005,2005 Elpidio Latorilla
* @package care_api
*/
class DoctorsNotes extends Notes {
	/**
	* Constructor
	*/
	function DoctorsNotes(){
		$this->Notes();
	}
	/**
	* Checks if a physician order for an encounter exists.
	* @access public
	* @param Encounter number
	* @return boolean
	*/
	function DirectiveExists($enr){
		if($this->_RecordExists("type_nr=19 AND encounter_nr=$enr")){
			return true;
		}else{return false;}
	}
	/**
	* Checks if an inquiry to doctor for an encounter exists.
	* @access public
	* @param Encounter number
	* @return boolean
	*/
	function InquiryExists($enr){
		if($this->_RecordExists("type_nr=18 AND encounter_nr=$enr")){
			return true;
		}else{return false;}
	}	
	/**
	* Gets the physician order for an encounter.
	* @access public
	* @param Encounter number
	* @return mixed adodb record object or boolean
	*/
	function getDirectives($enr){
		if($this->_getNotes(" type_nr=19 AND encounter_nr=$enr","ORDER BY date,time")){
			return $this->result;
		}else{
			return false;
		}
	}
	/**
	* Gets the inquiries to physician for an encounter.
	* @access public
	* @param Encounter number
	* @return mixed adodb record object or boolean
	*/
	function getInquiries($enr){
		if($this->_getNotes(" type_nr=18 AND encounter_nr=$enr","ORDER BY date,time")){
			return $this->result;
		}else{
			return false;
		}
	}
	/**
	* Gets the combined physician order and inquiries to physician for an encounter.
	*
	* The returned adodb record object contains rows of arrays.
	* Each array contains the  data with the following index keys:
	* - all notes index keys as outlined in the <var>$fld_notes</var> array.
	* - eff_nr = primary record number of the effectivity report type of notes
	* - eff_notes = effectivity report
	* - eff_aux = auxillary effectivity report
	* - eff_date = date of  effectivity report
	* - eff_time = time effectivity report
	* - eff_personell_name = author of effectivity report
	*
	* @access public
	* @param Encounter number
	* @return mixed adodb record object or boolean
	*/
	function getDirectivesAndInquiries($enr){
		global $db;
		$this->sql="SELECT n.*,
						e.nr AS eff_nr,
						e.notes AS eff_notes,
						e.aux_notes AS eff_aux_notes,
						e.date AS eff_date,
						e.time AS eff_time,
						e.personell_name AS eff_personell_name
					FROM $this->tb_notes AS n LEFT JOIN $this->tb_notes AS e ON n.nr=e.ref_notes_nr AND e.encounter_nr=$enr
					WHERE (n.type_nr=19 AND n.encounter_nr=$enr)
						OR (n.type_nr=18 AND n.encounter_nr=$enr)
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
	* Saves new physician order.
	*
	* Data passed by reference with associative array and have index keys as outlined in the <var>Notes::$fld_notes</var> array.
	* @access public
	* @param array Data to save.
	* @return boolean
	*/
	function saveDirective(&$data){
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
		return $this->_insertNotesFromInternalArray(19);
	}
	/**
	* Saves new inquiry to physician.
	*
	* Data passed by reference with associative array and have index keys as follows:
	* - pn = encounter number
	* - berichtput2 = inquiry to physician text
	* - dateput = date of submitting inquiry
	* - timeput = time of submitting inquiry
	* - author2 = name of inquiry submitter
	* - warn2 = auxillary notes
	* - ref_notes_nr = a reference number to another note within the save table
	* 
	* @access public
	* @param array Data to save.
	* @return boolean
	*/
	function saveInquiry(&$data){
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
		return $this->_insertNotesFromInternalArray(18);
	}
	/**
	* Gets the date range of a physician order for an encounter.
	*
	* @access public
	* @param int Encounter number
	* @return mixed array or boolean
	*/
	function getDoctorsDirectivesDateRange($enr){
		if($this->_getNotesDateRange($enr,0,"encounter_nr=$enr AND (type_nr=19 OR type_nr=18)")){
			return $this->result->FetchRow();
		}else{return false;}
	}
}
?>
