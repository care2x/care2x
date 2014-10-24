<?php
/**
* @package care_api
*/

/**
*/
require_once($root_path.'include/care_api_classes/class_core.php');
/**
*  Department methods.
*  Note this class should be instantiated only after a "$db" adodb  connector object  has been established by an adodb instance.
* @author Elpidio Latorilla
* @version beta 1.0.08
* @copyright 2002,2003,2004,2005,2005 Elpidio Latorilla
* @package care_api
*/
class Department extends Core {
	/**
	* Table name for department data
	* @var string
	*/
	var $tb='care_department';
	/**
	* Table name for department types data
	* @var string
	*/
	var $tb_types='care_type_department';
	/**
	* Table name for phone and contact data
	* @var string
	*/
	var $tb_cphone='care_phone';
	/**
	* Table name for rooms
	* @var string
	*/
	var $tb_room='care_room';
	/**
	* Holder for sql query results.
	* @var object adodb record object
	*/
	var $result;
	/**
	* Holder for preloaded dept data
	* @var object adodb record object
	*/
	var $preload_dept;
	/**
	* Preloaded flag
	* @var boolean
	*/
	var $is_preloaded=FALSE;
	/**
	* Holder for departments count
	* @var int
	*/
	var $dept_count;
	/**
	* Holder for current department number
	* @var int
	*/
	var $dept_nr;
	/**
	* Field names of care_department table
	* @var array
	*/
	var $tabfields=array('nr',
									'id',
									'type',
									'name_formal',
									'name_short',
									'name_alternate',
									'LD_var',
									'description',
									'admit_inpatient',
									'admit_outpatient',
									'has_oncall_doc',
									'has_oncall_nurse',
									'does_surgery',
									'this_institution',
									'is_sub_dept',
									'parent_dept_nr',
									'work_hours',
									'consult_hours',
									'is_inactive',
									'sort_order',
									'address',
									'sig_line',
									'sig_stamp',
									'logo_mime_type',
									'status',
									'history',
									'modify_id',
									'modify_time',
									'create_id',
									'create_time',
									'is_pharmacy',
									'pharma_dept_nr');
	/**
	* Constructor
	* @param int Department number
	*/
	function Department($nr=0){
		$this->setTable($this->tb);
		$this->setRefArray($this->tabfields);
		$this->dept_nr=$nr;
	}
	/**
	* Gets all data from the care_department table
	* @access private
	* @param string WHERE condition of the sql query
	* @param string Sort item
	* @param string  Determines the return type whether adodb object (_OBJECT) or assoc array (_ARRAY, '', empty) 
	* @return mixed boolean or adodb record object or assoc array, determined by param $ret_type
	*/
	function _getalldata($cond='1',$sort='',$ret_type=''){
	    global $db;
		if(empty($sort)) $sort='name_formal';
		$this->sql="SELECT *, LD_var AS \"LD_var\" FROM $this->tb WHERE $cond AND status NOT IN ($this->dead_stat) ORDER BY $sort";
	    if ($this->res['_gald']=$db->Execute($this->sql)) {
		    if ($this->dept_count=$this->res['_gald']->RecordCount()){
				$this->rec_count=$this->dept_count;
		        if($ret_type=='_OBJECT') return $this->res['_gald'];
					else return $this->res['_gald']->GetArray();
			}else{
				return FALSE;
			}
		}else{
		    return FALSE;
		}
	}
	/**
	* Gets all departments without condition
	* @access public
	* @param string  Sort condition which includes the field name and the sort direction e.g. "ORDER BY name_formal DESC"
	* @return mixed boolean or 2 dimensional array
	*/
	function getAllNoCondition($sort=''){
	    global $db;
		
		if(!empty($sort)) $sort=" ORDER BY $sort";
		$this->sql="SELECT *, LD_var AS \"LD_var\" FROM $this->tb $sort";
	    if ($this->result=$db->Execute($this->sql)) {
		    if ($this->dept_count=$this->result->RecordCount()) {
		        return $this->result->GetArray();
			}else{
				return FALSE;
			}
		}else{
		    return FALSE;
		}
	}
	/**
	* Gets all departments without condition. The result is assoc array sorted by departments formal name
	* @access public
	* @return mixed boolean or adodb record object or assoc array
	*/
	function getAll() {
		return $this->_getalldata('1');
	}
	/**
	* Gets all ACTIVE departments. The result is assoc array sorted by departments formal name
	* @access public
	* @return mixed boolean or adodb record object or assoc array
	*/
	function getAllActive($dept_nr) {
		return $this->_getalldata("is_inactive='0'");
	}
	/**
	* Gets all ACTIVE sub - departments. The result is assoc array sorted by departments formal name
	* @access public
	* @return mixed boolean or adodb record object or assoc array
	*/
	function getAllSubDepts($dept_nr) {
		return $this->_getalldata('is_inactive=\'0\' AND parent_dept_nr='.$dept_nr);
	}
	/**
	* Gets all ACTIVE departments. The result is adodb record object sorted by departments formal name
	* @access public
	* @return mixed boolean or adodb record object or assoc array
	*/
	function getAllActiveObject() {
		return $this->_getalldata("is_inactive='0'",'','_OBJECT');
	}
	/**
	* Gets all departments without condition
	* @access public
	* @param string Sort item e.g. "name_formal"
	* @return mixed boolean or adodb record object or assoc array
	*/
	function getAllSort($sort='') {
		return $this->_getalldata('1',$sort);
	}
	/**
	* Gets all ACTIVE departments. The result is assoc array sorted by param $sort
	* @access public
	* @return mixed boolean or adodb record object or assoc array
	*/
	function getAllActiveSort($sort='') {
		return $this->_getalldata("parent_dept_nr='0' AND is_inactive='0'",$sort);
	}
	/**
	* Gets all ACTIVE medical departments. The result is assoc array sorted by departments formal name
	* @access public
	* @return  mixed assoc array (sorted by param $sort) or boolean or adodb record object 
	*/
	function getAllMedical() {
		return $this->_getalldata("type=1 AND is_inactive='0' AND is_pharmacy=0");
	}
	/**
	* Gets all ACTIVE pharmacys. The result is assoc array sorted by departments formal name
	* @access public
	* @return  mixed assoc array (sorted by param $sort) or boolean or adodb record object 
	*/
	function getAllPharmacy() {
		return $this->_getalldata("type=2 AND is_inactive='0' AND is_pharmacy=1");
	}
	/**
	* Gets all information  of one pharmacy. The result is 2 dimensional associative array.
	* @access public
	* @param int Department number
	* @return mixed 1 dimensional associative array or boolean
	*/
	function getPharmaAllInfo($nr){
	    global $db;
		$this->sql="SELECT name_formal FROM $this->tb WHERE nr=$nr AND is_pharmacy=1";
	    if ($this->result=$db->Execute($this->sql)) {
		    if ($this->result->RecordCount()) {
		        return $this->result->FetchRow();
			} else {
				return FALSE;
			}
		} else {
		    return FALSE;
		}
	}	
	/**
	* Gets the id of the pharmacy on wich this department can order. The result is 2 dimensional associative array.
	* @access public
	* @param int Department number
	* @return mixed 1 dimensional associative array or boolean
	*/
	function getPharmaOfDept($nr){
	    global $db;
		$this->sql="SELECT pharma_dept_nr FROM $this->tb WHERE nr=$nr";
	    if ($this->result=$db->Execute($this->sql)) {
		    if ($this->result->RecordCount()) {
		        return $this->result->FetchRow();
			} else {
				return FALSE;
			}
		} else {
		    return FALSE;
		}
	}	
	/**
	* Gets all ACTIVE medical departments. The result is adodb record object sorted by departments formal name
	* Returns adodb record object sorted by departments formal name
	* @access public
	* @return mixed assoc array (sorted by department formal name) or boolean or adodb record object
	*/
	function getAllMedicalObject() {
		return $this->_getalldata("type=1 AND is_inactive='0'",'','_OBJECT');
	}
	/**
	* Gets all ACTIVE medical departments with doctors-on-call  or nurse-on-call assigned. The result is assoc array sorted by departments formal name
	* @access public
	* @return  mixed assoc array (sorted by department formal name) or boolean or adodb record object
	*/
	function getAllMedicalWithOnCall() {
		return $this->_getalldata("type=1 AND is_inactive='0' AND (has_oncall_doc=1 OR has_oncall_nurse=1)");
	}
	/**
	* Gets all ACTIVE NON-MEDICAL departments. The result is assoc array sorted by departments formal name
	* @access public
	* @return  mixed assoc array (sorted by department formal name) or boolean or adodb record object
	*/
	function getAllSupporting() {
		return $this->_getalldata("type=2 AND is_inactive='0'");
	}
	/**
	* Gets all ACTIVE NEWS departments. The result is assoc array sorted by departments formal name
	* @access public
	* @return  mixed assoc array (sorted by department formal name) or boolean or adodb record object
	*/
	function getAllNewsGroup() {
		return $this->_getalldata("type=3 AND is_inactive='0'");
	}
	/**
	* Gets all ACTIVE medical departments with doctors-on-call  assigned. The result is assoc array sorted by departments formal name
	* @access public
	* @return  assoc array sorted by departments formal name
	*/
	function getAllActiveWithDOC(){
		return $this->_getalldata("type=1 AND is_inactive='0' AND has_oncall_doc=1");
	}
	/**
	* Gets all ACTIVE medical departments with nurse-on-call  assigned. The result is assoc array sorted by departments formal name
	* @access public
	* @return  mixed assoc array (sorted by department formal name) or boolean or adodb record object
	*/
	function getAllActiveWithNOC(){
		return $this->_getalldata("type=1 AND is_inactive='0' AND has_oncall_nurse=1");
	}
	/**
	* Gets all ACTIVE medical departments that does surgery. The result is assoc array sorted by departments formal name
	* @access public
	* @return mixed assoc array (sorted by department formal name) or boolean or adodb record object
	*/
	function getAllActiveWithSurgery(){
		return $this->_getalldata("type=1 AND is_inactive='0' AND does_surgery=1");
	}
	
	/**
	* Gets all department types information. The result is assoc array unsorted.
	* @access public
	* @return  mixed 2 dimensional array unsorted or boolean
	*/
	function getTypes(){
	    global $db;
	
	    if ($this->result=$db->Execute("SELECT nr,type,name,LD_var AS \"LD_var\", description FROM $this->tb_types")) {
		    if ($this->result->RecordCount()) {
		        return $this->result->GetArray();
			} else {
				return FALSE;
			}
		}
		else {
		    return FALSE;
		}
	}
	/**
	* Gets a department type information. The result is 2 dimensional associative array.
	* @access public
	* @return mixed 1 dimensional assoc array or boolean
	*/
	function getTypeInfo($type_nr){
	    global $db;
	
	    if ($this->result=$db->Execute("SELECT type,name,LD_var AS \"LD_var\", description FROM $this->tb_types WHERE nr=$type_nr")) {
		    if ($this->result->RecordCount()) {
		        return $this->result->FetchRow();
			} else {
				return FALSE;
			}
		} else {
		    return FALSE;
		}
	}
	/**
	* Gets all information  of one department. The result is 2 dimensional associative array.
	* @access public
	* @param int Department number
	* @return mixed 1 dimensional associative array or boolean
	*/
	function getDeptAllInfo($nr){
	    global $db;
		$this->sql="SELECT *, LD_var AS \"LD_var\" FROM $this->tb WHERE nr=$nr";
	    if ($this->result=$db->Execute($this->sql)) {
		    if ($this->result->RecordCount()) {
		        return $this->result->FetchRow();
			} else {
				return FALSE;
			}
		} else {
		    return FALSE;
		}
	}
	/**
	* Preloads all information  of one department into the objects internal buffer $preload_dept and sets the internal flag $is_preloaded.
	* The information is returned individually through the appropriate methods
	* @access public
	* @param int Department number
	* @return  boolean
	*/
	function preloadDept($nr=0){
	    global $db;
		if(!$nr) return FALSE;
		$this->sql="SELECT *, LD_var AS \"LD_var\" FROM $this->tb WHERE nr=$nr";
	    if ($this->result=$db->Execute($this->sql)) {
		    if ($this->dept_count=$this->result->RecordCount()) {
		        $this->preload_dept=$this->result->FetchRow();
				$this->is_preloaded=TRUE;
				return TRUE;
			} else {
				return FALSE;
			}
		} else {
		    return FALSE;
		}
	}
	/**
	* Empties the internal buffer $preload_dept and resets the internal flag $is_preloaded
	* @access public
	* @return  boolean
	*/
	function unloadDept(){
		if($this->is_preloaded){
			$this->preload_dept=NULL;
			$this->is_preloaded=FALSE;
		}
		return TRUE;
	}
	/**
	* Returns the department number. Use preferably after the department was successfully preloaded by the preloadDept() method.
	* @return mixed integer or boolean
	*/
	function Nr(){
		if(!$this->is_preloaded) return FALSE;
		return $this->preload_dept['nr'];
	}
	/**
	* Returns the department ID. Use preferably after the department was successfully preloaded by the preloadDept() method.
	* @return mixed string or boolean
	*/
	function ID(){
		if(!$this->is_preloaded) return FALSE;
		return $this->preload_dept['id'];
	}
	/**
	* Returns the department type. Use preferably after the department was successfully preloaded by the preloadDept() method.
	* @return mixed integer or boolean
	*/
	function Type(){
		if(!$this->is_preloaded) return FALSE;
		return $this->preload_dept['type'];
	}
	/**
	* Returns the department formal name. Use preferably after the department was successfully preloaded by the preloadDept() method.
	* @return mixed string or boolean
	*/
	function FormalName($nr=0){
		if($this->is_preloaded){
			return $this->preload_dept['name_formal'];
		}elseif($nr){
			$this->dept_nr=$nr;
			return $this->_getItem('name_formal');
		}else{
			return FALSE;
		}
	}
	/**
	* Returns the department short name. Use preferably after the department was successfully preloaded by the preloadDept() method.
	* @return mixed string or boolean
	*/
	function ShortName(){
		if(!$this->is_preloaded) return FALSE;
		return $this->preload_dept['name_short'];
	}
	/**
	* Returns the department address. Use preferably after the department was successfully preloaded by the preloadDept() method.
	* @return string
	*/
	function Address($nr=0){
		if(!$this->is_preloaded){
			if($nr) $this->dept_nr=$nr;
			return $this->_getItem('address');
		}
		return $this->preload_dept['address'];
	}
	/**
	* Returns the department signature stamp. Use preferably after the department was successfully preloaded by the preloadDept() method.
	* @return string
	*/
	function SignatureStamp($nr=0){
		if(!$this->is_preloaded){
			if($nr) $this->dept_nr=$nr;
			return $this->_getItem('sig_stamp');
		}
		return $this->preload_dept['sig_stamp'];
	}
	/**
	* Returns the department's language dependent variable name. Use preferably after the department was successfully preloaded by the preloadDept() method.
	* @return string
	*/
	function LDvar($nr=0){
		if(!$this->is_preloaded){
			if($nr) $this->dept_nr=$nr;
			return $this->_getItem('LD_var AS "LD_var"','LD_var');
		}
		return $this->preload_dept['LD_var'];
	}
	/** 
	* Gets the item information of a department from the care_department table.
	* Use only if the department number was previously set with the constructor or with the setDeptNr() method.
	* @access private
	* @param string Item or field name for extracting including name aliasing  with AS
	* @param string actual return name of the item (optional: used if the first param has an aliasing)
	* @return mixed 1 dimensional array or FALSE
	*/
	function _getItem($item='', $retname=''){
	    global $db;
		$row='';
		if(empty($item)) return FALSE;
	    if ($this->result=$db->Execute("SELECT $item FROM $this->tb WHERE nr=$this->dept_nr")) {
		    if ($this->result->RecordCount()) {
		        $row=$this->result->FetchRow();
				if(!empty($retname)) return $row[$retname];
					else return $row[$item];
			} else {
				return FALSE;
			}
		}
		else {
		    return FALSE;
		}
	}
	/** 
	* Gets the contact (phone, beeper, etc) of a department from the care_department table.
	* @access public
	* @param int Department number
	* @return array Associative array
	*/
	function getPhoneInfo($nr){
		global $db;
		$sql="SELECT * FROM $this->tb_cphone WHERE dept_nr=$nr";
				 
	    if ($this->res['gpi']=$db->Execute($sql)) {
		   	if ($this->record_count=$this->res['gpi']->RecordCount()) {
				return $this->res['gpi']->FetchRow();
			} else {
				return FALSE;
			}
		}else {
			return FALSE;
		}
	}
	/**
	* Sets the department number used by the object on run time
	* @param int Department number
	*/
	function setDeptNr($nr){
		$this->dept_nr=$nr;
	}
	/**
	* Gets all active OR Room numbers
	* return mixed adodb record object or boolean FALSE
	*/
	function getAllActiveORNrs(){
		global $db;
		$this->sql="SELECT nr, room_nr,info FROM $this->tb_room 
						WHERE type_nr=2 
							AND is_temp_closed IN ('',0)
							AND status NOT IN ('closed',$this->dead_stat)
						ORDER BY room_nr";
	    if ($this->res['gaaon']=$db->Execute($this->sql)) {
		   	if ($this->res['gaaon']->RecordCount()) {
				return $this->res['gaaon'];
			}else{return FALSE;}
		}else{return FALSE;}
	}
	/**
	* Checks if department does surgery
	* @access public
	* @param int Department number
	* @return boolean
	*/
	function isSurgery($dept_nr=0){
		global $db;
		if(!$dept_nr) return FALSE;
		$this->sql="SELECT nr FROM care_department WHERE nr=$dept_nr AND does_surgery=1";
		if($this->result=$db->Execute($this->sql)){
			if($this->result->RecordCount()){
				return TRUE;
			}else{return FALSE;}
		}else{return FALSE;}
	}
	/**
	* Checks if room number is an operating room (OR)
	* @access public
	* @param int Room number
	* @return boolean
	*/
	function isOR($room_nr=0){
		global $db;
		if(!$room_nr) return FALSE;
		$this->sql="SELECT nr FROM care_room WHERE room_nr=$room_nr AND type_nr=2"; // 2=  op room type
		if($this->result=$db->Execute($this->sql)){
			if($this->result->RecordCount()){
				return TRUE;
			}else{return FALSE;}
		}else{return FALSE;}
		
	}
}
?>
