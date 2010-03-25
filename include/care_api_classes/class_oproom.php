<?php
/**
* @package care_api
*/
/**
*/
# Define to TRUE if you want to show the ward id with full name  on the selection box
define('SHOW_COMBINE_WARDIDNAME',1);
# Define to TRUE if you want to show the full name of  wards on the selection box
define('SHOW_FULL_WARDNAME',FALSE);
/**
*/
require_once($root_path.'include/care_api_classes/class_core.php');
/**
*  Operating Room methods.
*
*  OR = Operating room
*  OP = Operation, operating
*
*  Note: this class should be instantiated only after a "$db" adodb  connector object  has been established by an adodb instance.
* @author Elpidio Latorilla
* @version beta 2.0.1
* @copyright 2002,2003,2004,2005,2005 Elpidio Latorilla
* @package care_api
*/
class OPRoom extends Core {
	/**
	* Database table room data
	* @var string
	* @access private
	*/
	var $tb_room='care_room'; # table name
	/**
	* Database table for department data
	* @var string
	* @access private
	*/
	var $tb_dept='care_department';
	/**
	* Database table for ward data
	* @var string
	* @access private
	*/
	var $tb_ward='care_ward';
	/**
	* Room number buffer
	* @var int
	* @access private
	*/
	var $room_nr=0; # current room nr. 
	/**
	* OP room type number buffer
	* @var int
	* @access private
	*/
	var $OR_typenr=2; # the type number of OR room. Do not change this if you do not know why. 
	/**
	* Flag for preloaded OR data
	* @var boolean
	* @access private
	*/
	var $is_allpreloaded=FALSE; # Will be true if all OR are preloaded
	/**
	* Buffer for preloaded OP rooms data
	* @var adodb record object
	* @access private
	*/
	var $allpreloaded_OR; # Internal buffer for preloaded OR info
	/**
	* Field names of the care_room table
	* @var array
	* @access private
	*/
	var $fld_room=array('nr',
									'type_nr',
									'date_create',
									'date_close',
									'is_temp_closed',
									'room_nr',
									'ward_nr',
									'dept_nr',
									'nr_of_beds',
									'closed_beds',
									'info',
									'status',
									'history',
									'modify_id',
									'modify_time',
									'create_id',
									'create_time');
	/**
	* Constructor
	* @param int OP room number
	*/	
	function OPRoom($rm_nr=0){
		$this->room_nr=$rm_nr;
		$this->coretable=$this->tb_room;
		$this->ref_array=$this->fld_room;
	}
	/**
	* Checks if an OP room number exists.
	* @param int OP room number
	* @return boolean
	*/
	function ORNrExists($rm_nr){
		return $this->_RecordExists("type_nr=2 AND room_nr=$rm_nr");
		/*
		if($this->_RecordExists("type_nr=2 AND room_nr=$rm_nr")){
			return true;
		}else{return false;}
		*/
	}
	/**
	* Returns OP room information.
	*
	* The returned adodb record object contains rows of arrays.
	* Each array contains  data with the following index keys:
	* - all room index keys as outlined in the <var>$fld_room</var> array
	* - ward_id = ward id to which the room belongs
	* - wardname = Ward name
	* - deptname = Department name
	* - deptshort = Department's short name
	* - LD_var = variable's name for foreign language version of department's name
	*
	* @access public
	* @param int OP room number
	* @param boolean Flags if the first parameter is room number or record number. Defaults to FALSE = room number.
	* @return mixed adodb record object or boolean
	*/ 
	function ORInfo($nr=0,$rec_key=FALSE){
	    global $db;
		
		if(!$nr){
			if($this->room_nr) $nr=$this->room_nr;
				else return FALSE;
		}
		
		//$this->sql="SELECT * FROM $this->tb_room WHERE room_nr='$rm_nr'";
		$this->sql="SELECT o.*, w.ward_id, w.name AS wardname, d.name_formal AS deptname, d.name_short AS deptshort, d.LD_var AS \"LD_var\"
						 FROM $this->tb_room AS o
						 			LEFT JOIN $this->tb_ward AS w ON o.ward_nr=w.nr
									LEFT JOIN $this->tb_dept AS d ON o.dept_nr=d.nr";
		if($rec_key) $this->sql.=" WHERE o.nr=$nr AND o.type_nr=$this->OR_typenr";
			else $this->sql.=" WHERE o.room_nr=$nr AND o.type_nr=$this->OR_typenr";
		//echo $this->sql;
	    if ($this->res['oi']=$db->Execute($this->sql)) {
		    if ($this->res['oi']->RecordCount()) {
		        return $this->res['oi'];
			}else{return false;}
		}else{return false;}
	}
	/**
	* Returns OP room information based on the record's primary number key.
	*
	* For detailed structure of the returned data, see the <var>ORInfo()</var> method.
	*
	* @access public
	* @param int Record primary number key
	* @return mixed adodb record object or boolean
	*/ 
	function ORRecordInfo($nr=0){
	    global $db;
		
		if(!$nr) return FALSE;
		 	else return $this->ORInfo($nr,TRUE);
	}
	/**
	* Returns all OP room information.
	*
	* For detailed structure of the returned data, see the <var>ORInfo()</var> method.
	*
	* @param string Field name to sort. Default = room_nr
	* @param string Addition query constraint string
	* @return mixed adodb record object or boolean
	*/ 
	function AllORInfo($sort='',$cond=''){
	    global $db;
	
		if(empty($sort)) $sort=" ORDER BY room_nr";
			else $sort=" ORDER BY $sort";
		
		if(empty($cond)) $cond='';
		
		$this->sql="SELECT o.*, w.ward_id, w.name AS wardname, d.name_formal AS deptname, d.name_short AS deptshort, d.LD_var AS \"LD_var\"
						 FROM $this->tb_room AS o
						 			LEFT JOIN $this->tb_ward AS w ON o.ward_nr=w.nr
									LEFT JOIN $this->tb_dept AS d ON o.dept_nr=d.nr
						WHERE o.type_nr=$this->OR_typenr";
		
		if(!empty($cond)) $this->sql.=" AND $cond";

		$this->sql.=" $sort";

		if ($this->res['aaoi']=$db->Execute($this->sql)) {
		    if ($this->rec_count=$this->res['aaoi']->RecordCount()) {
		        return $this->res['aaoi'];
			}else{return false;}
		}else{return false;}
	}
	/**
	* Preloads all OP room in the internal buffer. Sorted in descending order by room_nr field name.
	* @access public
	* @return boolean
	*/
	function preloadAllORInfo(){
		if($this->allpreloaded_OR=$this->AllORInfo('room_nr DESC')){
			$this->is_allpreloaded=TRUE;
			return TRUE;
		}else{
			return FALSE;
		}
	}
	/**
	* Returns all active OP room  information.
	* @access public
	* @param string Field name to sort. default = room_nr
	* @return mixed adodb record object or boolean
	*/ 
	function AllActiveORInfo($sort=''){
		return $this->AllORInfo($sort,"o.is_temp_closed IN ('',0) AND o.status NOT IN('inactive','hidden')");
	}
	/**
	* Returns the type number of OP room.
	* @access public
	* @return integer
	*/
	function ORTypeNr(){ 
		return $this->OR_typenr;
	}
	/**
	* Returns the last OP room number. Based on the highest OP room number.
	* @access public
	* @return integer
	*/
	function LastORNr(){
		global $db;
		$row;
		if($this->is_allpreloaded){
			$row=$this->allpreloaded_OR->FetchRow();
			# Reset the pointer
			$this->allpreloaded_OR->MoveFirst();
			return $row['room_nr'];
		}else{
			$this->sql="SELECT MAX(room_nr) AS max_nr FROM $this->tb_room WHERE type_nr=$this->OR_typenr";
			if ($this->result=$db->Execute($this->sql)) {
		   		if ($this->rec_count=$this->result->RecordCount()) {
		        	$row=$this->result->FetchRow();
					return $row['max_nr'];
				}else{return false;}
			}else{return false;}
		}
	}
	/**
	* Generates and returns a new OR number. Based on the highest OP room number plus 1.
	* @access public
	* @return integer
	*/
	function NewORNr(){
		return $this->LastORNr()+1;
	}
	/**
	* Returns a line of text of all room numbers separated by comma.
	*
	* Used for validation purposes by searching a users input against this text.
	* @access public
	* @return string
	*/
	function CombinedORNrs(){
		if(!$this->is_allpreloaded) $this->preloadAllORInfo();
		$buffer=array();
		if($this->is_allpreloaded){
			while($row=$this->allpreloaded_OR->FetchRow()){
				$buffer[]=$row['room_nr'];
			}
			# Reset the pointer
			$this->allpreloaded_OR->MoveFirst();
			return implode(',',$buffer);
		}else{
			return '';
		}
	}
}
?>
