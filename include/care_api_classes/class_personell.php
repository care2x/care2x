<?php
/**
* @package care_api
*/
/**
*/
require_once($root_path.'include/care_api_classes/class_core.php');
/**
*  Personnel methods. 
*  Note this class should be instantiated only after a "$db" adodb  connector object  has been established by an adodb instance
* @author Elpidio Latorilla
* @version beta 2.0.1
* @copyright 2002,2003,2004,2005,2005 Elpidio Latorilla
* @package care_api
*/
class Personell extends Core {
	/**#@+
	* @access private
	*/
	/**
	* Table name for personnel data
	* @var string
	*/
	var $tb='care_personell';
	/**
	* Table name for personnel assignments
	* @var string
	*/
	var $tb_assign='care_personell_assignment';
	/**
	* Table name for person registration data.
	* @var string
	*/
	var $tb_person='care_person';
	/**
	* Table name for on-call duty plans
	* @var string
	*/
	var $tb_dpoc='care_dutyplan_oncall';
	/**
	* Table name for phone and contact information
	* @var string
	*/
	var $tb_cphone='care_phone';
	/**
	* Table name for city-town names
	* @var string
	*/
	var $tb_citytown='care_address_citytown';
	/**#@-*/
	/**
	* SQL query result buffer
	* @var adodb record object
	*/
	var $result;
	/**
	* Loaded data flag
	* @var boolean
	*/
	var $is_loaded='FALSE';
	/**
	* Resulting row buffer
	* @var array
	*/
	var $row;
	/**
	* Depatments data buffer
	* @var adodb record object
	*/
	var $depts;
	/**
	* Resulting rows count buffer
	* @var int
	*/
	var $record_count;
	/**
	* Personnel data buffer
	* @var adodb record object
	*/
	var $personell_data;
	/**
	* Field names of care_dutyplan_oncall
	* @var array
	*/
	var $dpoc_fields=array('nr',
									'dept_nr',
									'role_nr',
									'year',
									'month',
									'duty_1_txt',
									'duty_2_txt',
									'duty_1_pnr',
									'duty_2_pnr',
									'status',
									'history',
									'modify_id',
									'modify_time',
									'create_id',
									'create_time');
	/**
	* Field names of care_personell_assignment
	* @var array
	*/
	var $assign_fields=array('nr',
									'personell_nr',
									'role_nr',
									'location_type_nr',
									'location_nr',
									'date_start',
									'date_end',
									'is_temporary',
									'list_frequency',
									'status',
									'history',
									'modify_id',
									'modify_time',
									'create_id',
									'create_time');
	/**
	* Field names of care_personell
	* @var array
	*/
	var $personell_fields=array('nr',
									'short_id',
									'pid',
									'job_type_nr',
									'job_function_title',
									'date_join',
									'date_exit',
									'contract_class',
									'contract_start',
									'contract_end',
									'pay_class',
									'pay_class_sub',
									'local_premium_id',
									'tax_account_nr',
									'ir_code',
									'nr_workday',
									'nr_weekhour',
									'nr_vacation_day',
									'multiple_employer',
									'nr_dependent',
									'status',
									'history',
									'modify_id',
									'modify_time',
									'create_id',
									'create_time');
	/**
	* Constructor
	*/
	function Personell(){
		$this->setTable($this->tb);
		$this->setRefArray($this->personell_fields);
	}
	/**
	* Sets the core object to point to the care_dutyplan_oncall table and field names.
	* @access public
	*/
	function useDutyplanTable(){
		$this->setTable($this->tb_dpoc);
		$this->setRefArray($this->dpoc_fields);
	}
	/**
	* Sets the core object to point to the care_personell_assignment table and field names.
	* @access public
	*/
	function useAssignmentTable(){
		$this->setTable($this->tb_assign);
		$this->setRefArray($this->assign_fields);
	}
	/**
	* Sets the core object to point to the care_personell table and field names.
	* @access public
	*/
	function usePersonellTable(){
		$this->setTable($this->tb);
		$this->setRefArray($this->personell_fields);
	}
	/**
	* Checks if the personnel (employee) number exists in the database.
	* @access public
	* @param int Personnel number
	* @return boolean
	*/
	function InitPersonellNrExists($init_nr){
		global $db;
		$this->sql="SELECT nr FROM $this->tb WHERE nr=$init_nr";
		if($this->result=$db->Execute($this->sql)){
			if($this->result->RecordCount()){
				return TRUE;
			} else { return FALSE; }
		} else { return FALSE; }
	}	
	/**#@+
	*
	* The returned adodb record object contains rows of arrays.
	* Each array contains the personnel data with the following index keys:
	* - nr = record's primary key number
	* - personell_nr = personnel or employee number
	* - job_function_title = job function title or name
	* - name_last = employee's last or family name
	* - name_first = employee's first or given name
	* - date_birth = date of birth
	* - sex = sex
	* @return mixed adodb record object or boolean
	*/
	/**
	* Returns information of all nurses of a department.
	*
	* @access public
	* @param int Department number
	*/
	function getDoctorsOfDept($dept_nr=0){
		if(!$dept_nr) return FALSE;
			else return $this->_getAllPersonell(1,17,$dept_nr); // 1= dept (location), 17 = doctor (role)
	}
	/**
	* Returns information of all nurses of a department.
	*
	* @access public
	* @param int Department number
	*/
	function getNursesOfDept($dept_nr=0){
		if(!$dept_nr) return FALSE;
		else return $this->_getAllPersonell(1,16,$dept_nr); // 1= dept (location); 16 = nurse (role)
	}
	/**
	* Returns  information of all personnel (employee) based on location type, role number and department number keys
	*
	* @access private
	* @param int Location type number
	* @param int Role number
	* @param int Department number
	*/
	function _getAllPersonell($loc_type_nr,$role_nr=0,$dept_nr){
	    global $db, $dbf_nodate;
		$row=array();
		
		$sql="SELECT a.nr, a.personell_nr, ps.job_function_title, p.name_last, p.name_first, p.date_birth, p.sex
				FROM 	$this->tb_assign AS a,
							$this->tb AS ps,
							$this->tb_person AS p			
				WHERE a.role_nr=$role_nr 
					AND a.location_type_nr=$loc_type_nr 
					AND a.location_nr=$dept_nr
					AND (a.date_end='$dbf_nodate' OR a.date_end>='".date('Y-m-d')."')
					AND a.status NOT IN ($this->dead_stat)
					AND a.personell_nr=ps.nr
					AND ps.pid=p.pid 
				ORDER BY a.list_frequency DESC";
				
		
	    if ($this->result=$db->Execute($sql)) {
		    if ($this->record_count=$this->result->RecordCount()) {
		    	return $this->result;
			} else {
				return FALSE;
			}
		}
		else {
		    return FALSE;
		}
	}
	/**#@-*/
	
	/**#@+
	*
	* If the on-call duty plan exists, its record primary key number will be returned, else FALSE
	* @return mixed adodb record object or boolean
	*/
	/**
	* Checks if the on-call duty plan of a given role number, department number, year and month exists in the databank.
	* @access private
	* @param int Role number
	* @param int Department number
	* @param int Year
	* @param int Month
	*/
	function _OCDutyplanExists($role_nr,$dept_nr=0,$year=0,$month=0){
		global $db;
		if(!$role_nr||!$dept_nr||!$year||!$month){
			return FALSE;
		}else{
	    	if ($this->row= $this->_getOCDutyPlan($role_nr,$dept_nr,$year,$month,'nr')) {
				return $this->row['nr'];
			}else {
				return FALSE;
			}
		}
	}
	/**
	* Checks if the  doctors' on-call duty plan of a given department number, year and month exists in the databank.
	*
	* If the on-call duty plan exists, its record primary key number will be returned, else FALSE
	* @access public
	* @param int Department number
	* @param int Year
	* @param int Month
	*/
	function DOCDutyplanExists($dept_nr,$year,$month){
		return $this->_OCDutyplanExists(15,$dept_nr,$year,$month); // 15 = doctor_on_call (role)
	}
	/**
	* Checks if the  nurses' on-call duty plan of a given department number, year and month exists in the databank.
	*
	* If the on-call duty plan exists, its record primary key number will be returned, else FALSE
	* @access public
	* @param int Department number
	* @param int Year
	* @param int Month
	*/
	function NOCDutyplanExists($dept_nr,$year,$month){
		return $this->_OCDutyplanExists(14,$dept_nr,$year,$month); // 14 = nurse_on_call (role)
	}
	/**#@-*/
	
	/**#@+
	*
	* The returned items are based on the field names passed as string to the method.
	* To see the allowed field names to be passed, see the <var>$fld_dpoc</var> array.
	* @return mixed adodb record object or boolean
	*/
	/**
	* Gets the on-call duty plan of a given role number, department number, year and month.
	*
	* @access private
	* @param int Role number
	* @param int Department number
	* @param int Year
	* @param int Month
	* @param string Field names of items to be fetched
	*/
	function _getOCDutyplan($role_nr,$dept_nr=0,$year=0,$month=0,$elems='*'){
		global $db;
		
		if(!$role_nr||!$dept_nr||!$year||!$month){
			return FALSE;
		}else{
			$this->sql="SELECT $elems FROM $this->tb_dpoc WHERE role_nr=$role_nr AND dept_nr=$dept_nr AND year=$year AND month  IN ('$month','".(int)$month."',".(int)$month.")" ;
	    	if ($this->res['_godp']=$db->Execute($this->sql)) {
		    	if ($this->rec_count=$this->res['_godp']->RecordCount()) {
					return $this->res['_godp']->FetchRow();
				}else{return FALSE;}
			}else{return FALSE;}
		}
	}
	/**
	* Gets the  doctors' on-call duty plan of a  department number, year and month.
	*
	* @access public
	* @param int Department number
	* @param int Year
	* @param int Month
	* @param string Field names of items to be fetched
	*/
	function getDOCDutyplan($dept_nr,$year,$month,$elems='*'){
		return $this->_getOCDutyplan(15,$dept_nr,$year,$month,$elems);
	}
	/**
	* Gets the  Nurses' on-call duty plan of a  department number, year and month.
	*
	* @access public
	* @param int Department number
	* @param int Year
	* @param int Month
	* @param string Field names of items to be fetched
	*/
	function getNOCDutyplan($dept_nr,$year,$month,$elems='*'){
		return $this->_getOCDutyplan(14,$dept_nr,$year,$month,$elems);
	}
	/**#@-*/
	
	/**
	* Gets the personnel information based on its personnel number key.
	*
	* The returned  array contains the personnel data with the following index keys:
	* - all index keys as outlined in the <var>$personell_fields</var> array
	* - all index keys as outlined in the <var>Person::$elems_array</var> array
	* - funk1 = first pager number
	* - inphone1 = first internal phone number
	* - inphone2 = second internal phone number
	* - inphone3 = third internal phone number
	* @access public
	* @param int Personnel number
	* @return mixed adodb record object or boolean
	*/
	function getPersonellInfo($nr){
		global $db;
		$sql="SELECT ps.*,p.*,
							c.funk1,
							c.funk2,
							c.inphone1,
							c.inphone2,
							c.inphone3 
				FROM $this->tb AS ps, 
						$this->tb_person AS p LEFT JOIN
						$this->tb_cphone AS c ON c.personell_nr=$nr
				WHERE ps.nr='$nr'
				 AND ps.pid=p.pid";
				 
	    if ($this->result=$db->Execute($sql)) {
		   	if ($this->record_count=$this->result->RecordCount()) {
				return $this->result->FetchRow();
			} else {
				return FALSE;
			}
		}else {
			return FALSE;
		}
	}
	/**
	* Gets a list of departments with on-call duty plan of a given role number, year and month.
	*
	* The returned array contains the department numbers with availabe on-call plan.
	* @access private
	* @param int Role number
	* @param int Year
	* @param int Month
	* @return mixed array  or boolean
	*/
	function _getOCQuicklist($role_nr,$year=0,$month=0){
		global $db;
		$x='';
		$v='';
		$d=$this->depts;
		$row;
		$buffer=array();
		if(!$role_nr||!$year||!$month){
			return FALSE;
		}else{
			list($x,$v)=each($d);
			$dept_list=$v['nr'];
			while(list($x,$v)=each($d)){
				$dept_list.=','.$v['nr'];
			}

			$sql="SELECT dept_nr FROM $this->tb_dpoc WHERE role_nr=$role_nr AND dept_nr IN ($dept_list) AND year='$year' AND month='$month'";
			
	    	if ($this->result=$db->Execute($sql)) {
		    	if ($this->record_count=$this->result->RecordCount()) {
					$row=$this->result->GetArray();
					while(list($x,$v)=each($row)) {
						$buffer[]=$v['dept_nr']; 
					}
					return $buffer;
				} else {
					return FALSE;
				}
			}else {
		   	 return FALSE;
			}
		}
	}
	/**
	* Gets a list of departments with doctors' on-call duty plan of a given  year and month.
	*
	* An array to hold the department numbers must be passed as reference.
	* @access public
	* @param array Department numbers. Associative, reference.
	* @param int Year
	* @param int Month
	* @return mixed array  or boolean
	*/
	function getDOCQuicklist(&$depts,$year,$month){
		$this->depts=$depts;
		return $this->_getOCQuicklist(15,$year,$month);
	}
	/**
	* Gets a list of departments with Nurses' on-call duty plan of a given  year and month.
	*
	* An array to hold the department numbers must be passed as reference.
	* @access public
	* @param array Department numbers. Associative, reference.
	* @param int Year
	* @param int Month
	* @return mixed array  or boolean
	*/
	function getNOCQuicklist(&$depts,$year,$month){
		$this->depts=$depts;
		return $this->_getOCQuicklist(14,$year,$month);
	}	
	/**
	* Searches and returns basic personnel information.
	*
	* The returned adodb record object contains rows of arrays.
	* Each array contains the personnel data with the following index keys:
	* - nr = record's primary key number
	* - job_function_title = job function title or name
	* - name_last = employee's last or family name
	* - name_first = employee's first or given name
	* - date_birth = date of birth
	* - sex = sex
	* @param string Search key words
	* @param string Field name to sort, default = 'name_last'
	* @param string Sort direction, default = ASC
	* @param boolean Flags whether the return is limited or not, default FALSE
	* @param int Maximum number of rows returned, default 30 rows
	* @param int Index of the first returned row default 0 = start
	* @return mixed adodb record object  or boolean
	*/
	function searchPersonellBasicInfo($key,$oitem='name_last',$odir='ASC',$limit=FALSE,$len=30,$so=0){
		global $db, $sql_LIKE;
		if(empty($key)) return FALSE;
		$this->sql="SELECT ps.nr, ps.job_function_title, p.pid, p.name_last, p.name_first, p.date_birth, p.sex
				FROM $this->tb AS ps, $this->tb_person AS p";
		if(is_numeric($key)){
			$key=(int)$key;
			$this->sql.=" WHERE ps.nr = $key AND ps.pid=p.pid";
		}else{
			$this->sql.=" WHERE (ps.nr $sql_LIKE '$key%'
						OR ps.job_function_title $sql_LIKE '$key%'
						Or p.pid $sql_LIKE '$key%'
						OR p.name_last $sql_LIKE '$key%'
						OR p.name_first $sql_LIKE '$key%'
						OR p.date_birth $sql_LIKE '$key%')
						AND p.pid=ps.pid";
		}
		if(!empty($oitem)){
			if($oitem=='nr'||$oitem=='job_function_title') $this->sql.=" ORDER BY ps.$oitem $odir";
				else  $this->sql.=" ORDER BY p.$oitem $odir";
		}
		if($limit){
			$this->res['spbi']=$db->SelectLimit($this->sql,$len,$so);
		}else{
			$this->res['spbi']=$db->Execute($this->sql);
		}
	    if ($this->res['spbi']) {
		   	if ($this->record_count=$this->res['spbi']->RecordCount()) {
				$this->rec_count=$this->record_count; # Work around
				return $this->res['spbi'];
			}else{return FALSE;}
		}else{return FALSE;}
	}		
	/**
	* Search similar to searchPersonellBasicInfo but returns a limited number of rows.
	*
	* For detailed structure of returned data, see <var>searchPersonellBasicInfo()</var> method.
	* @access public
	* @param string Search key word
	* @param int Maximum number of rows returned, default 30 rows
	* @param int Index of the first returned row, default 0 = start
	* @param string Field name to sort, default = 'name_last'
	* @param string Sort direction, default = ASC
	* @return mixed adodb record object  or boolean
	*/
	function searchLimitPersonellBasicInfo($key,$len,$so,$oitem,$odir){
		return $this->searchPersonellBasicInfo($key,$oitem,$odir,TRUE,$len,$so);
	}
	/**
	* Checks if the PID number (the person) exists as employee in the database.
	*
	* If person exists as employee, its record primary number key will be returned, else FALSE.
	* @access public
	* @param int PID number
	* @return mixed integer  or boolean
	*/
	function Exists($pid=0){
		global $db;
		if(!$pid){
			return FALSE;
		}else{
			$sql="SELECT nr FROM $this->tb WHERE pid=$pid";
			if ($this->result=$db->Execute($sql)) {
		    		if ($this->result->RecordCount()) {
					$this->row=$this->result->FetchRow();
		    			return $this->row['nr'];
				} else {
					return FALSE;
				}
			}else {
		   		return FALSE;
			}
		}
	}
	/**
	* Loads the personnel data in the internal buffer <var>$personell_data</var>. based on its personnel number key.
	*
	* The data is stored in the internal buffer array <var> $personell_data</var> .
	* This method returns only TRUE or FALSE. The load success status is also stored in the <var>$is_loaded</var> variable.
	* @access public
	* @param int Personnel number
	* @return boolean
	*/
	function loadPersonellData($nr=0){
	    global $db;
		
		if(!$nr) return FALSE;

		$this->sql="SELECT ps.*, p.title, p.name_last, p.name_first, p.date_birth, p.sex,
							p.addr_str,p.addr_str_nr,p.addr_zip, 
							p.photo_filename,
							c.item_nr AS phone_pk,
							c.beruf,
							c.bereich1,
							c.bereich2,
							c.exphone1,
							c.exphone2,
							c.funk1,
							c.funk2,
							c.inphone1,
							c.inphone2,
							c.inphone3,
							c.roomnr,
							t.name AS citytown_name 
				FROM $this->tb AS ps, 
						$this->tb_person AS p 
						LEFT JOIN $this->tb_cphone AS c ON c.personell_nr=$nr
						LEFT JOIN $this->tb_citytown AS t ON p.addr_citytown_nr=t.nr
				WHERE ps.nr=$nr AND ps.pid=p.pid";
		if($this->result=$db->Execute($this->sql)) {
		    if($this->record_count=$this->result->RecordCount()) {
			    $this->personell_data=$this->result->FetchRow();
				$this->result=NULL;
			    $this->is_loaded=TRUE;
			    $this->is_preloaded=TRUE;
				//echo $this->sql; 
				return TRUE;
		    } else {
				//echo $this->sql;
				return FALSE;
			}
		} else {return FALSE;}
	}
	/**#@+
	*
	* Use this methode only after the personnell data was successfully loaded with the <var>loadPersonellData()</var> method.
	* @access public
	* @return string
	*/
	/**
	* Returns the title
	*/
	function Title(){
	    //if(!$this->is_loaded) return FALSE;
		return $this->personell_data['title'];
	}
	/**
	* Returns the employee's last/family name
	*/
	function LastName(){
	    //if(!$this->is_loaded) return FALSE;
		return $this->personell_data['name_last'];
	}
	/**
	* Returns the employee's first/given name
	*/
	function FirstName(){
	    //if(!$this->is_loaded) return FALSE;
		return $this->personell_data['name_first'];
	}
	/**
	* Returns date of birth
	*/
	function BirthDate(){
	    //if(!$this->is_loaded) return FALSE;
		return $this->personell_data['date_birth'];
	}
	/**
	* Returns profession info
	*/
	function Profession(){
	    //if(!$this->is_loaded) return FALSE;
		return $this->personell_data['beruf'];
	}
	/**
	* Returns room nr.
	*/
	function RoomNr(){
	    //if(!$this->is_loaded) return FALSE;
		return $this->personell_data['beruf'];
	}
	/**
	* Returns the primary key of the phone record
	*/
	function PhoneKey(){
	    //if(!$this->is_loaded) return FALSE;
		return $this->personell_data['phone_pk'];
	}
	/**
	* Returns first internal phone number
	*/
	function InPhone1(){
	    //if(!$this->is_loaded) return FALSE;
		return $this->personell_data['inphone1'];
	}
	/**
	* Returns second internal phone number
	*/
	function InPhone2(){
	    //if(!$this->is_loaded) return FALSE;
		return $this->personell_data['inphone2'];
	}
	/**
	* Returns third internal phone number
	*/
	function InPhone3(){
	    //if(!$this->is_loaded) return FALSE;
		return $this->personell_data['inphone3'];
	}
	/**
	* Returns first external phone number
	*/
	function ExPhone1(){
	    //if(!$this->is_loaded) return FALSE;
		return $this->personell_data['exphone1'];
	}
	/**
	* Returns second external phone number
	*/
	function ExPhone2(){
	    //if(!$this->is_loaded) return FALSE;
		return $this->personell_data['exphone2'];
	}
	/**
	* Returns third external phone number
	*/
	function ExPhone3(){
	    //if(!$this->is_loaded) return FALSE;
		return $this->personell_data['exphone3'];
	}
	/**
	* Returns first dept
	*/
	function Dept1(){
	    //if(!$this->is_loaded) return FALSE;
		return $this->personell_data['bereich1'];
	}
	/**
	* Returns second dept
	*/
	function Dept2(){
	    //if(!$this->is_loaded) return FALSE;
		return $this->personell_data['bereich2'];
	}
	/**
	* Returns first pager number
	*/
	function Beeper1(){
	    //if(!$this->is_loaded) return FALSE;
		return $this->personell_data['funk1'];
	}
	/**
	* Returns second pager number
	*/
	function Beeper2(){
	    //if(!$this->is_loaded) return FALSE;
		return $this->personell_data['funk2'];
	}
	/**
	* Returns full address in german format
	*/
	function formattedAddress_DE(){
	    //if(!$this->is_loaded) return FALSE;
		return $this->personell_data['addr_str'].' '.$this->personell_data['addr_str_nr'].'<br>'.$this->personell_data['addr_str_zip'].' '.$this->personell_data['citytown_name'];
	}
	/**#@-*/
	/**
	* Returns person's PID number.
	*
	* Use this methode only after the personnell data was successfully loaded with the <var>loadPersonellData()</var> method.
	* @access public
	* @return string
	*/
	function PID(){
	    //if(!$this->is_loaded) return FALSE;
		return $this->personell_data['pid'];
	}	
}
?>
