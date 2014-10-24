<?php
/**
* @package care_api
*/

/**
*/
require_once($root_path.'include/care_api_classes/class_core.php');

/**
*  Communication, Phone, beeper information methods.
*  Note this class should be instantiated only after a "$db" adodb  connector object  has been established by an adodb instance.
* @author Elpidio Latorilla
* @version beta 2.0.1
* @copyright 2002,2003,2004,2005,2005 Elpidio Latorilla
* @package care_api
*/
class Comm extends Core {
	/**
	* Table name for telephone and other contact information data
	* @var string
	*/
	var $tb_phone='care_phone';
	/**
	* Field names of care_phone table
	* @var array
	*/
	var $fld_phone=array('item_nr',
									'title',
									'name',
									'vorname',
									'pid',
									'personell_nr',
									'dept_nr',
									'beruf',
									'bereich1',
									'bereich2',
									'inphone1',
									'inphone2',
									'inphone3',
									'exphone1',
									'exphone2',
									'funk1',
									'funk2',
									'roomnr',
									'date',
									'time',
									'status',
									'history',
									'modify_id',
									'modify_time',
									'create_id',
									'create_time');
	/**
	* Constructor, sets default table to care_phone (phone directory)
	*/				
	function Comm(){
		$this->setTable($this->tb_phone);
		$this->setRefArray($this->fld_phone);
	}
	/**
	* Checks whether the department's phone info if exists.
	* The kind of returned inforamations is determined by the parameter $retinfo.
	* - If param $retinfo is TRUE (return phone info if dept info exists, else FALSE)
	* - If param $retinfo is FALSE (return TRUE if exists, else FALSE)
	* @access public
	* @param int Department number
	* @param boolen Determines the kind of returned information
	* @return mixed adodb record object or boolean
	*/
	function DeptInfoExists($dept_nr,$retinfo=FALSE){
		global $db;
		if($retinfo) $elems='*';
			else $elems='item_nr';
		$this->sql="SELECT $elems FROM $this->tb_phone WHERE dept_nr=$dept_nr";
        if($this->res['diex']=$db->Execute($this->sql)) {
            if($this->rec_count=$this->res['diex']->RecordCount()) {
				 if($retinfo) return $this->res['diex'];
					else return TRUE;
			} else { return FALSE; }
		} else { return FALSE; }
	}
	/**
	* Returns the department's phone information if exists.
	* @access public
	* @param int Department number
	* @return mixed adodb record object or boolean
	*/
	function DeptInfo($dept_nr){
		if($info=$this->DeptInfoExists($dept_nr,TRUE))	return $info->FetchRow();
			else return FALSE;
	}
    /**
    * Gets the phone, etc. data of the person based on the record's primary key.
    *
    * The returned array contains the indexes as defined for the array $fld_phone
    * @access public
    * @param int Primary key number
    * @param string Field names separated by comma. Default is '*''
    * @return array
    */
    function getData($nr=0,$fields='*'){
        global $db;
        if(empty($nr)) return FALSE;
        if(empty($fields)) $fields='*';
        $this->sql="SELECT $fields FROM $this->tb_phone WHERE item_nr=$nr";
        if($this->res['gdta']=$db->Execute($this->sql)) {
            if($this->rec_count=$this->res['gdta']->RecordCount()) {
                 return $this->res['gdta']->FetchRow();
            } else { return FALSE; }
        } else { return FALSE; }
    }
    /**
    * Deletes the phone, etc. data of the person based on the record's primary key.
    * @access public
    * @param int Primary key number
    * @return boolean
    */
    function deleteData($nr=0){
        //global $db;
        if(empty($nr)) return FALSE;
        $this->sql="DELETE FROM $this->tb_phone WHERE item_nr=$nr";
        if($this->Transact($this->sql)) {
            return TRUE;
        } else { return FALSE; }
    }
}
?>
