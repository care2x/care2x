<?php
/**
* @package care_api
*/
/**
*/
require_once($root_path.'include/care_api_classes/class_notes.php');
/**
*  Medocs methods. Medocs = Textual documentation for diagnosis and therapy procedures as opposite of the DRG (code based documentation).
*  Note this class should be instantiated only after a "$db" adodb  connector object  has been established by an adodb instance
* @author Elpidio Latorilla
* @version beta 2.0.1
* @copyright 2002,2003,2004,2005,2005 Elpidio Latorilla
* @package care_api
*/
class Medocs extends Notes {
	/**
	* Table name for feeding types
	* @var string
	*/
	var $tb_medocs='care_type_feeding';
	/**
	* Table name for person registration data
	* @var string
	*/
	var $tb_person='care_person';
	
	/**
	* Constructor
	* @param int Encounter number
	*/
	function Medocs($nr=0){
		if($nr) $this->enc_nr=$nr;
		$this->coretable=$this->tb_medocs;
	}
	/** 
	* Gets all medocs documents based on the given key number.
	*
	* The type of key number is determined by the content of the $nr_type parameter.
	*
	* The returned adodb record object contains rows of arrays.
	* Each array contains the encounter data with the following index keys:
	* - nr = record's primary key number
	* - encounter_nr = encounter number
	* - date= date of documentation
	* - time = time of documentation
	* - notes = the document text
	* - is_discharged = discharge status of encounter
	*
	* @access private
	* @param int Key number
	* @param string  Type of  key number. '_ENC' = encounter nr, '_REG' = pid nr.
	* @return mixed adodb record object or boolean
	*/
	function _getMedocsList($nr,$nr_type='_ENC'){
		global $db;
		# type nr 12 = diagnosis text notes
		if($nr_type=='_ENC'){
			$this->sql="SELECT n.nr,n.encounter_nr,n.date,n.time,n.notes,e.is_discharged  FROM   $this->tb_notes, $this->tb_enc AS e
				WHERE n.encounter_nr=".$nr." AND n.encounter_nr=e.encounter_nr AND n.type_nr=12 AND n.status NOT IN ($this->dead_stat)
				ORDER BY n.date DESC";
		}elseif($nr_type='_REG'){
			$this->sql="SELECT  n.nr,n.encounter_nr,n.date,n.time,n.notes,e.is_discharged  FROM $this->tb_person AS p, $this->tb_notes AS n, $this->tb_enc AS e
				WHERE p.pid=".$nr." AND e.pid=p.pid AND e.encounter_nr=n.encounter_nr AND n.type_nr=12 AND n.status NOT IN ($this->dead_stat)
				ORDER BY n.date DESC";
		}
		//echo $this->sql;
        if($this->res['_gmed']=$db->Execute($this->sql)) {
            if($this->rec_count=$this->res['_gmed']->RecordCount()) {
				 return $this->res['_gmed'];	 
			} else { return false; }
		} else { return false; }
	}
	/** 
	* Gets all medocs records of an encounter number.
	*
	* For detailed structure of returned data, see the <var> _getMedocsList()</var> method.
	* @access public
	* @param int Encounter number
	* @return mixed adodb record object or boolean
	*/
	function encMedocsList($nr){
		return $this->_getMedocsList($nr,'_ENC');
	}
	/** 
	* Gets all medocs records of a pid number.
	*
	* For detailed structure of returned data, see the <var> _getMedocsList()</var> method.
	* @access public
	* @param int PID number
	* @return mixed adodb record object or boolean
	*/
	function pidMedocsList($nr){
		return $this->_getMedocsList($nr,'_REG');
	}

	/** 
	* Gets medocs document based on a field "nr" key
	*
	* The returned  array has the following keys:
	* diagnosis = Diagnosis text
	* short_notes = Short diagnosis notes
	* aux_notes = Auxilliary notes
	* date = Date of creation
	* time = Time of creation
	* personell_nr = Personnel number who created the document
	* personell_name = Personnel name
	* therapy = Therapy text
	* @access public
	* @param int document number
	* @return mixed array or boolean
	*/
	function getMedocsDocument($nr){
		global $db;
		if(empty($nr)) return FALSE;
		$this->sql="SELECT nd.notes AS diagnosis,
						nd.short_notes, 
						nd.aux_notes, 
						nd.date,
						nd.time,
						nd.personell_nr,
						nd.personell_name,
						nt.notes AS therapy
		FROM $this->tb_notes AS nd LEFT JOIN $this->tb_notes AS nt ON nd.nr=nt.ref_notes_nr
		WHERE   nd.nr=$nr";
		
        if($this->res['gmd']=$db->Execute($this->sql)) {
            if($this->rec_count=$this->res['gmd']->RecordCount()) {
				 return $this->res['gmd']->FetchRow(); 
			} else { return false; }
		} else { return false; }
	}
	
}
?>
