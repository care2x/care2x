<?php
/**
* @package care_api
*/

/**
*/
require_once($root_path.'include/care_api_classes/class_drg.php');
/**
*  Quicklist for DRG codes.
*  Note this class should be instantiated only after a "$db" adodb  connector object  has been established by an adodb instance.
* @author Elpidio Latorilla
* @version beta 2.0.1
* @copyright 2002,2003,2004,2005,2005 Elpidio Latorilla
* @package care_api
*/
class Quicklist extends DRG{
	/**
	* Table name for drg quicklist data
	* @var string
	*/
	var $tb_qlist='care_drg_quicklist';
	/**
	* Current department number
	* @var int
	*/
	var $dept_nr;
	/**
	* Field names of care_drg_quicklist table
	* @var array
	*/
	var $fld_qlist=array(
				'nr',
				'code',
				'dept_nr',
				'type',
				'rank',
				'status',
				'history',
				'modify_id',
				'modify_time',
				'create_id',
				'create_time');
	/**
	* Constructor
	* @param int Encounter number
	* @param int Department number
	*/			
	function Quicklist($enc_nr,$dept_nr){
		$this->enc_nr=$enc_nr;
		$this->dept_nr=$dept_nr;
		$this->DRG($enc_nr);
	}
	/**
	* Resolves the encounter number.
	* @param int Encounter number
	* @return mixed integer or boolean
	*/
	function internResolveDeptNr($dept_nr='') {
	    if (empty($dept_nr)) {
		    if(empty($this->dept_nr)) {
			    return false;
			} else { return true; }
		} else {
		     $this->dept_nr=$dept_nr;
			return true;
		}
	}
	/**
	* Returns the quicklist code items of a department.
	* @param string Quicklist items type (drg_intern, diagnosis, procedure)
	* @param int Department number
	* @return mixed adodb record object or boolean
	*/
	function DeptQuicklist($type='',$dept_nr=0){
		global $db;
		//if(!$this->internResolveDeptNr($dept_nr)||empty($type)) return false;
		$this->dept_nr=1;
		switch($type){
			case 'drg_intern':
			{
				$cond=", d.nr, d.description FROM $this->tb_qlist AS q  LEFT JOIN $this->tb_drg AS d ON q.code=d.code";
				break;
			}
			case 'diagnosis':
			{
				$cond=", d.diagnosis_code AS nr, d.description, p.description AS parent_desc FROM $this->tb_qlist AS q  
								LEFT JOIN $this->tb_diag_codes AS d ON q.code=d.diagnosis_code
								LEFT JOIN $this->tb_diag_codes AS p ON q.code_parent=p.diagnosis_code";
				break;
			}
			case 'procedure':
			{
				$cond=", d.code AS nr, d.description, p.description AS parent_desc FROM $this->tb_qlist AS q  
								LEFT JOIN $this->tb_proc_codes AS d ON q.code=d.code
								LEFT JOIN $this->tb_proc_codes AS p ON q.code_parent=p.code";
				break;
			}
			//default: return false;
		}
		$this->sql="SELECT q.code,q.code_parent $cond WHERE q.dept_nr=$this->dept_nr AND q.qlist_type='$type' ORDER BY q.rank DESC";
		if($this->result=$db->Execute($this->sql)) {
		    if($this->result->RecordCount()){
				return $this->result;
		    }else{return false;}
		}else{return false;}
	}
	/**
	* Checks if the code exists in the quicklist.
	*
	* If the code exists, its primary record number will be returned, else FALSE will be returned.
	* @param string Code to check
	* @return mixed integer or boolean
	*/
	function QuickCodeExists($code=0){
		if(!$code) return false;
		$this->sql="SELECT nr FROM $this->tb_qlist WHERE code='$code'";
		if($this->result=$db->Execute($this->sql)) {
		    if($this->result->RecordCount()){
				$row=$this->result->FetchRow();
				return $row['nr'];
		    }else{return false;}
		}else{return false;}
	}
	/**
	* Increases the ranking of the code in the quicklist by $step value.
	* @param string Code
	* @param int  Increase step (defaults to 1)
	* @return boolean
	*/
	function upRank($code=0,$step=1){
		if(!$code) return false;
		$this->sql="UPDATE $this->tb_qlist SET rank=(rank+$step) WHERE code=$code";
		return $this->Transact($this->sql);
	}
}
