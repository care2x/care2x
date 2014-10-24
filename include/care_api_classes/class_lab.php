<?php
/**
* @package care_api
*/
/**
*/
require_once($root_path.'include/care_api_classes/class_encounter.php');
/**
*  Laboratory methods.
*  Note this class should be instantiated only after a "$db" adodb  connector object  has been established by an adodb instance
* @author Elpidio Latorilla
* @version beta 2.0.1
* @copyright 2002,2003,2004,2005,2005 Elpidio Latorilla
* @package care_api
*/
class Lab extends Encounter {

	var $tb_req_chemlab='care_test_request_chemlabor';
	/**
	* Table name for test findings for chemical lab
	* @var string
	*/
	var $tb_find_chemlab='care_test_findings_chemlab';
	/**
	* Table name for test findings for chemical lab paramters
	* @var string
	*/
	var $tb_find_chemlab_sub='care_test_findings_chemlabor_sub';
	/**
	* Table name for test paramaters
	* @var string
	*/
	var $tb_test_param='care_test_param';
	/**
	* Table name for test groups
	* @var string
	*/
	var $tb_test_group='care_test_group';
	/**
	* Prepend characters for english
	* @var string
	*/
	var $en_prepend;
	/**
	* Test parameters
	* @var string
	*/
	var $tparams;
	/**
	* Test groups
	* @var string
	*/
	var $tgroups;
	/**
	* Field names for care_test_findings_chemlab table
	* @var array
	*/
	var $fld_find_chemlab=array(
				'batch_nr',
				'encounter_nr',
				'test_date',
				'test_time',
				'lab_notes',
				'job_id',
				'group_id',
				'serial_value',
				'validator',
				'validate_dt',
				'status',
				'history',
				'modify_id',
				'modify_time',
				'create_id',
				'create_time');
	/**
	* Field names for care_test_findings_chemlab_sub table
	* @var array
	*/
	var $fld_find_chemlab_sub=array(
				'batch_nr',
				'job_id',
				'encounter_nr',
				'paramater_name',
				'parameter_value',
				'test_date',
				'test_time',
				'history',
				'create_id',
				'create_time');
	/**
	* Field names for care_test_param table
	* @var array
	*/
	var $fld_test_param=array(
				'nr',
				'group_id',
				'name',
				'id',
				'msr_unit',
				'median',
				'hi_bound',
				'lo_bound',
				'hi_critical',
				'lo_critical',
				'hi_toxic',
				'lo_toxic',
				'median_f',
				'hi_bound_f',
				'lo_bound_f',
				'hi_critical_f',
				'lo_critical_f',
				'hi_toxic_f',
				'lo_toxic_f',
				'median_n',
				'hi_bound_n',
				'lo_bound_n',
				'hi_critical_n',
				'lo_critical_n',
				'hi_toxic_n',
				'lo_toxic_n',
				'median_y',
				'hi_bound_y',
				'lo_bound_y',
				'hi_critica$l_y',
				'lo_critical_y',
				'hi_toxic_y',
				'lo_toxic_y',
				'median_c',
				'hi_bound_c',
				'lo_bound_c',
				'hi_critica$l_c',
				'lo_critical_c',
				'hi_toxic_c',
				'lo_toxic_c',
				'method',
				'status',
				'history',
				'modify_id',
				'modify_time',
				'create_id',
				'create_time',
				'sort_nr');

	//var $debug = true;
	/**
	* Constructor
	* @param int Encounter number
	*/
	function Lab($enc_nr='', $subTable = false){
		if(!empty($enc_nr)) $this->enc_nr=$enc_nr;
		if($subTable == true) {
			$this->setTable($this->tb_find_chemlab_sub);
			$this->setRefArray($this->fld_find_chemlab_sub);
		} else {
			$this->setTable($this->tb_find_chemlab);
			$this->setRefArray($this->fld_find_chemlab);
		}
		//$this->en_prepend=date('Y')*1000000;
	}

	/**
	* Sets the core table name and field names to the care_test_param table.
	* @access public
	*/
	function useTestParams(){
		$this->ref_array=$this->fld_test_param;
		$this->coretable=$this->tb_test_param;
	}
	/**
	* Searches for existing laboratory reports for an encounter.
	* @access public
	* @param int Encounter number
	* @return mixed adodb record object or boolean
	*/
	function createResultsList($enc_nr){
	    global $db;

		$this->sql="SELECT job_id,test_date,test_time,group_id FROM $this->tb_find_chemlab WHERE encounter_nr='$enc_nr' AND status<>'hidden' ORDER BY batch_nr DESC";

		if($this->result=$db->Execute($this->sql)){
		    if($this->rec_count=$this->result->RecordCount()) {
				return $this->result;
			} else {return FALSE;}
		}else {return FALSE;}
	}
	/**
	* Gets the batch number of a given encounter number and  job id.
	* @access public
	* @param int Encounter number
	* @param int Job (test request) id
	* @param int Test group id
	* @return mixed integer or boolean
	*/
	function BatchNr($enc_nr,$job_id,$grp_id){
	    global $db;
		$this->sql="SELECT batch_nr FROM $this->tb_find_chemlab WHERE encounter_nr='$enc_nr' AND job_id='$job_id' AND group_id='$grp_id'";
		if($this->result=$db->Execute($this->sql)){
		    if($this->rec_count=$this->result->RecordCount()) {
				$row=$this->result->FetchRow();
				return $row['batch_nr'];
			} else {return FALSE;}
		}else {return FALSE;}
	}
	/**
	* Checks if the job id is existing.
	* @param int Encounter number
	* @param int Job (test request) id
	* @param int Test group id
	* @return boolean
	*/
	function JobIDExists($enc_nr,$job_id,$grp_id){
		if($this->BatchNr($enc_nr,$job_id,$grp_id)){
			return TRUE;
		} else {return FALSE;}
	}
	/**
	* Hides the test result if it exists.
	* @param int Encounter number
	* @param int Job (test request) id
	* @return boolean
	*/
	function hideResultIfExists($enc_nr,$job_id){
		global $_SESSION;
		$this->sql="UPDATE $this->tb_find_chemlab_sub SET status='hidden',history=".$this->ConcatHistory("Hide ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."\n")."
								WHERE encounter_nr='$enc_nr' AND job_id='$job_id' AND status NOT IN ($this->dead_stat)";
		return $this->Transact();
	}
	/**
	* Gets the test result data basing on the batch number key.
	*
	* The returned adodb record object contains row of array.
	* The array contains the test result data with index keys as outlined in the <var>$fld_find_chemlab</var> array.
	* @access public
	* @param int Batch number
	* @return mixed adodb record object or boolean
	*/
	function getBatchResult($bn){
		global $db;
		$this->sql  = "SELECT * FROM $this->tb_find_chemlab INNER JOIN $this->tb_find_chemlab_sub ";
		$this->sql .= "ON ($this->tb_find_chemlab.job_id = $this->tb_find_chemlab_sub.job_id) ";
		$this->sql .= "WHERE $this->tb_find_chemlab.batch_nr=$bn";
		if($this->result=$db->Execute($this->sql)){
		    if($this->rec_count=$this->result->RecordCount()) {
				return $this->result;
			} else {return FALSE;}
		}else {return FALSE;}
	}
	/**
	* Gets the test result data basing on encounter number, job id, and test group id keys.
	*
	* The returned adodb record object contains row of array.
	* The array contains the test result data with index keys as outlined in the <var>$fld_find_chemlab</var> array.
	* @access public
	* @param int Job (test request) id
	* @param int Test group id
	* @param int Encounter number
	* @return mixed adodb record object or boolean
	*/
	function getResult($job_id,$grp_id,$enc_nr=''){
		global $db;
		if(!$this->internResolveEncounterNr($enc_nr)) return FALSE;
		$this->sql  = "SELECT * FROM $this->tb_find_chemlab INNER JOIN $this->tb_find_chemlab_sub ";
		$this->sql .= "ON ($this->tb_find_chemlab.job_id = $this->tb_find_chemlab_sub.job_id) ";
		$this->sql .= "WHERE $this->tb_find_chemlab.encounter_nr='$this->enc_nr' AND $this->tb_find_chemlab.job_id='$job_id' AND $this->tb_find_chemlab.group_id='$grp_id' AND $this->tb_find_chemlab.status<>'hidden'";
		if($this->result=$db->Execute($this->sql)){
		    if($this->rec_count=$this->result->RecordCount()) {
				return $this->result;
			} else {return FALSE;}
		}else {return FALSE;}
	}
	/**
	* Gets all test result records for an encounter.
	*
	* The returned adodb record object contains row of array.
	* The array contains the test result data with index keys as outlined in the <var>$fld_find_chemlab</var> array.
	* @access public
	* @param int Encounter number
	* @return mixed adodb record object or boolean
	*/
	function getAllResults($enc_nr=''){
		global $db;
		if(!$this->internResolveEncounterNr($enc_nr)) return FALSE;
		$this->sql  = "SELECT * FROM $this->tb_find_chemlab INNER JOIN $this->tb_find_chemlab_sub ";
		$this->sql .= "ON ($this->tb_find_chemlab.job_id = $this->tb_find_chemlab_sub.job_id) ";
		$this->sql .= "WHERE $this->tb_find_chemlab.encounter_nr='$this->enc_nr' AND $this->tb_find_chemlab.status NOT IN ($this->dead_stat) ORDER BY $this->tb_find_chemlab_sub.test_date";
		if($this->result=$db->Execute($this->sql)){
		    if($this->rec_count=$this->result->RecordCount()) {
				return $this->result;
			} else {return FALSE;}
		}else {return FALSE;}
	}


	/**
	* Returns all test parameters belonging to a test group.
	*
	* The returned adodb record object contains rows of arrays.
	* Each array contains the test result data with index keys as outlined in the <var>$fld_test_param</var> array.
	* @access public
	* @param int Test group id
	* @return mixed adodb record object or boolean
	*/
	function TestParams($group_id=''){
		global $db;
		if(empty($group_id)) $cond='';
			else $cond="group_id='$group_id' AND";
		$this->sql="SELECT * FROM $this->tb_test_param WHERE $cond status NOT IN ($this->dead_stat) ORDER BY name";
		if($this->tparams=$db->Execute($this->sql)){
		    if($this->rec_count=$this->tparams->RecordCount()) {
				return $this->tparams;
			} else {return FALSE;}
		}else {return FALSE;}
	}

	/**
	* Returns all test parameters belonging to a test group.
	* used in the param administration module
	*
	* The returned adodb record object contains rows of arrays.
	* Each array contains the test result data with index keys as outlined in the <var>$fld_test_param</var> array.
	* @access public
	* @param int Test group id
	* @return mixed adodb record object or boolean
	*/
	function TestParamsAdmin($group_id=''){
		global $db;
		if(empty($group_id)) $cond='';
			else $cond="group_id='$group_id'";
		$this->sql="SELECT * FROM $this->tb_test_param WHERE $cond ORDER BY name";
		if($this->tparams=$db->Execute($this->sql)){
		    if($this->rec_count=$this->tparams->RecordCount()) {
				return $this->tparams;
			} else {return FALSE;}
		}else {return FALSE;}
	}

	/**
	 * returns the tests of the selected patient
	 *
	 * @param int the $id of the batch request
	 * @return array the parmas array
	 */
	function GetTestsToDo($id=''){
		global $db;
		if(empty($id)) $cond='';
			else $cond="batch_nr='$id'";
			$sub = "_sub";
		$this->sql  = "SELECT paramater_name, parameter_value FROM $this->tb_req_chemlab$sub  WHERE $cond";
		if($this->tparams=$db->Execute($this->sql)){
		    if($this->rec_count=$this->tparams->RecordCount()) {
				return $this->tparams;
			} else {return FALSE;}
		}else {return FALSE;}
	}

	/**
	 * returns the stauts of a test urgent / not urgent
	 *
	 * @param int the $id of the encounter
	 * @return mixed int or boolean
	 */
	function GetTestUrgent($id=''){
		global $db;
		if(empty($id)) $cond='';
			else $cond="batch_nr='$id'";
		$this->sql="SELECT urgent FROM $this->tb_req_chemlab WHERE $cond";
		if($this->tparams=$db->Execute($this->sql)){
		    if($this->rec_count=$this->tparams->RecordCount()) {
				return $this->tparams;
			} else {return FALSE;}
		}else {return FALSE;}
	}
	/**
	 * returns parameter details for a given id
	 *
	 * @param varchar the nr of the test $id
	 * @return array containing the selecteg group info or nothing
	 */
	function TestParamsDetails($id=''){
		global $db;
		if(empty($id)) $cond='';
			else $cond="WHERE id='$id'";
		$this->sql="SELECT * FROM $this->tb_test_param $cond";
		if($this->tparamsdetails=$db->Execute($this->sql)){
		    if($this->rec_count=$this->tparamsdetails->RecordCount()) {
				return $this->tparamsdetails->FetchRow();
			} else {return FALSE;}
		}else {return FALSE;}
	}
	/**
	 * returns group details for a given id
	 *
	 * @param varchar the id of the test $id
	 * @return array containing the selecteg group info or nothing
	 */
	function TestParamsGroupsDetails($id=''){
		global $db;
		if(empty($id)) $cond='';
			else $cond="AND p.id='$id'";
		$this->sql="SELECT p.*, g.is_enabled FROM $this->tb_test_param p, $this->tb_test_group g WHERE
		p.id = g.id	$cond";
		if($this->tparamsdetails=$db->Execute($this->sql)){
		    if($this->rec_count=$this->tparamsdetails->RecordCount()) {
				return $this->tparamsdetails->FetchRow();
			} else {return FALSE;}
		}else {return FALSE;}
	}
	/**
	 * returns parameter details for a given nr
	 *
	 * @param varchar the nr of the test $nr
	 * @return array containing the selecteg group info or nothing
	 */
	function TestParamsDetailsByNr($nr=''){
		global $db;
		if(empty($nr)) $cond='';
			else $cond="WHERE nr='$nr'";
			//echo "SELECT * FROM $this->tb_test_param $cond";
		$this->sql="SELECT * FROM $this->tb_test_param $cond";
		if($this->tparamsdetails=$db->Execute($this->sql)){
		    if($this->rec_count=$this->tparamsdetails->RecordCount()) {
				return $this->tparamsdetails->FetchRow();
			} else {return FALSE;}
		}else {return FALSE;}
	}

	/**
	* Returns all test groups.
	* gjergji : changed it to get groups from params table
	* @access public
	* @return mixed adodb record object or boolean
	*/
	function TestGroups($nr=''){
		global $db;
		$cond = 'WHERE group_id = \'-1\' ';
		if(empty($nr)) $cond .='';
			else $cond .="AND nr='$nr'";
		$this->sql="SELECT * FROM $this->tb_test_param $cond ORDER BY sort_nr";
		if($this->tgroups=$db->Execute($this->sql)){
		    if($this->rec_count=$this->tgroups->RecordCount()) {
				return $this->tgroups;
			} else {return FALSE;}
		}else {return FALSE;}
	}

	/**
	* Returns all test groups not in dead state.
	* gjergji : changed it to get groups from params table
	* @access public
	* @return mixed adodb record object or boolean
	*/
	function TestActiveGroups(){
		global $db;
		$this->sql="SELECT * FROM $this->tb_test_param WHERE group_id = '-1' AND status NOT IN ($this->dead_stat) ORDER BY sort_nr";
		if($this->tgroups=$db->Execute($this->sql)){
		    if($this->rec_count=$this->tgroups->RecordCount()) {
				return $this->tgroups;
			} else {return FALSE;}
		}else {return FALSE;}
	}
	/**
	* Check if at least one laboratory result exists for the encounter.
	* @access public
	* @param int Encounter number
	* @return boolean
	*/
	function ResultExists($enc_nr=''){
		global $db;
		$buf;
		if(!$this->internResolveEncounterNr($enc_nr)) return FALSE;
		$this->sql="SELECT nr FROM $this->tb_find_chemlab WHERE encounter_nr='$this->enc_nr' AND status NOT IN ($this->dead_stat)";
		if($buf=$db->Execute($this->sql)){
		    if($this->rec_count=$buf->RecordCount()) {
				return TRUE;
			} else {return FALSE;}
		}else {return FALSE;}
	}
	/**
	* Gets all information of a test parameter.
	*
	* The param $nr takes precedence. If it is not empty it will be used to find the test parameter.
	* If the $id is needed, set $nr to empty character.
	*
	* The returned adodb record object contains rows of arrays.
	* Each array contain the test data with index keys as outlined in the <var>$fld_test_param</var> array.
	* @access public
	* @param int Key number
	* @param string Key id
	* @return mixed adodb record object or boolean
	*/
	function getTestParam($nr=0,$id=''){
		global $db;
		if($nr){
			$cond="nr='$nr'";
		}elseif(!empty($id)){
			$cond="id='$id'";
		}else{
			return FALSE;
		}
		$this->sql="SELECT * FROM $this->tb_test_param WHERE $cond";
		if($this->buffer=$db->Execute($this->sql)){
		    if($this->buffer->RecordCount()) {
				return $this->buffer;
			} else {return FALSE;}
		}else {return FALSE;}
	}
	/**
	* Searches for encounters with existing laboratory results.
	*
	* The returned adodb record object contains rows of arrays.
	* Each array contains the encounter data with the following index keys:
	* - encounter_nr = encounter number
	* - encounter_class_nr = encounter class number e.g. 1 = inpatient, 2 = outpatient
	* - pid = pid number
	* - name_last = person's last or family name
	* - name_first = person's first or given name
	* - date_birth = date of birth
	* - sex = sex
	* @access public
	* @param string Search keyword
	* @param string Optional query append e.g sort directive
	* @param boolean Flags if search return is limited or not. Defaults to FALSE = unlimited return.
	* @param int Maximum number or rows returned in case of limited return search. Defaults to 30 rows.
	* @param int Start index of rows to be returned. Defaults to 0 = begin of rows block.
	* @return mixed adodb record object or boolean
	*/
	function searchEncounterLabResults($key='',$add_opt='',$limit=FALSE,$len=30,$so=0){
		global $db, $sql_LIKE;
		if(empty($key)) return FALSE;
		$this->sql="SELECT f.encounter_nr, e.encounter_class_nr, p.pid, p.name_last, p.name_first, p.date_birth, p.sex
				FROM $this->tb_find_chemlab AS f
				LEFT JOIN $this->tb_enc AS e ON e.encounter_nr = f.encounter_nr
				LEFT JOIN $this->tb_person AS p ON p.pid = e.pid";
		if(is_numeric($key)){
			$key=(int)$key;
			$this->sql.=" WHERE e.encounter_nr = $key";
		}else{
			$this->sql.=" WHERE e.encounter_nr = f.encounter_nr
						AND f.status NOT IN ($this->dead_stat)
						AND
						(e.encounter_nr $sql_LIKE '$key%'
						OR p.pid $sql_LIKE '$key%'
						OR p.name_last $sql_LIKE '$key%'
						OR p.name_first $sql_LIKE '$key%'
						OR p.date_birth $sql_LIKE '$key%') ";
			if($enc_class) $sql.="	AND e.encounter_class_nr=$enc_class";
		}
		# Append the common condition
		$this->sql.=" GROUP BY f.encounter_nr, e.encounter_class_nr, p.pid, p.name_last, p.name_first, p.date_birth, p.sex  $add_opt";
		//echo $this->sql;
		if($limit){
	    	$this->res['selr']=$db->SelectLimit($this->sql,$len,$so);
		}else{
	    	$this->res['selr']=$db->Execute($this->sql);
		}
	    if ($this->res['selr']) {
		   	if ($this->record_count=$this->res['selr']->RecordCount()) {
				# Workaround
				$this->rec_count=$this->record_count;
				return $this->res['selr'];
			}else{return FALSE;}
		}else{return FALSE;}
	}
	/**
	* Searches for encounters with existing lab results.
	*
	* Similar to <var>searchEncounterLabResults()</var> but returns a limited number of rows.
	* For details of the returned data structure see the <var>searchEncounterLabResults()</var> method.
	* @access public
	* @param string Search keyword
	* @param int Maximum number or rows returned in case of limited return search. Defaults to 30 rows.
	* @param int Start index of rows to be returned. Defaults to 0 = begin of rows block.
	* @param string Field name for sorting. Defaults to empty = unsorted result.
	* @param string Sort direction. Defaults to ascending order.
	* @return mixed adodb record object or boolean
	*/
	function searchLimitEncounterLabResults($key,$len,$so,$sortitem='',$order='ASC'){
		if(!empty($sortitem)){
			$option=" ORDER BY $sortitem $order";
		}else{
			$option='';
		}
		return $this->searchEncounterLabResults($key,$option,TRUE,$len,$so);
	}
	/**
	* Gets the latest modify_time information of an encounter's laboratory result.
	* @access public
	* @param int Encounter number
	* @return mixed integer or boolean
	*/
	function getLastModifyTime($enc_nr=0){
		global $db;
		$buf;
		$row;
		if(!$this->internResolveEncounterNr($enc_nr)) return FALSE;
		$this->sql="SELECT modify_time FROM $this->tb_find_chemlab WHERE encounter_nr='$this->enc_nr' AND status NOT IN ($this->dead_stat) ORDER BY modify_time DESC";
		if($buf=$db->SelectLimit($this->sql,1)){
		    if($buf->RecordCount()) {
				$row=$buf->FetchRow();
				return $row['modify_time'];
			} else {return FALSE;}
		}else {return FALSE;}
	}
	/**
	 * moves up a test group, updating it's current sort_nr
	 *
	 * @param int current sort_nr $nr
	 * @param int the new sort nr $sortnr
	 * @return mixed interger or boolean
	 */
	function moveUp($nr,$sortnr) {
		global $db;
		$this->sql = "UPDATE $this->tb_test_param SET sort_nr = '$sortnr' WHERE nr = '$nr'";
		return  $this->Transact();
	}

	/**
	 * moves down a test group, updating it's current sort_nr
	 *
	 * @param int current sort_nr $nr
	 * @param int the new sort nr $sortnr
	 * @return mixed interger or boolean
	 */
	function moveDown($nr,$sortnr) {
		global $db;
		$this->sql = "UPDATE $this->tb_test_param SET sort_nr = '$sortnr' WHERE nr = '$nr'";
		return  $this->Transact();
	}
	/**
	* Returns the group name for the give group id.
	* gjergji : changed it to get groups from params table
	* @access public
	* @param varchar the id of the group
	* @return array with the group name
	*/
	function getGroupName( $id ){
		global $db;
		$this->sql="SELECT name FROM $this->tb_test_param WHERE group_id = '-1' AND status NOT IN ($this->dead_stat) AND id = '$id'";
		if($this->tgroups=$db->Execute($this->sql)){
		    if($this->rec_count=$this->tgroups->RecordCount()) {
				return $this->tgroups;
			} else {return FALSE;}
		}else {return FALSE;}
	}
}
?>
