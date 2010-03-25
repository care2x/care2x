<?php
/**
* @package care_api
*/

/**
*/
require_once($root_path.'include/care_api_classes/class_core.php');

/**
*  Immunization methods. 
*  Note this class should be instantiated only after a "$db" adodb  connector object  has been established by an adodb instance
* @author Elpidio Latorilla
* @version beta 2.0.1
* @copyright 2002,2003,2004,2005,2005 Elpidio Latorilla
* @package care_api
*/
class Immunization extends Core {
	/**
	* Database table for encounter's immunization data
	* @var string
	*/
	var $tb='care_encounter_immunization'; // table name
	/**
	* Database table for immunization type data
	* @var string
	*/
	var $tb_type='care_type_immunization'; // table name
	/**
	* Database table for appication types
	* @var string
	*/
	var $tb_types='care_type_application';
	/**
	* Preloaded data flag
	* @var adodb record object
	*/
	var $result;
	/**
	* Preloaded department data
	* @var adodb record object
	*/
	var $preload_dept;
	/**
	* Preloaded data flag
	* @var boolean
	*/
	var $is_preloaded=false;
	/**
	* Number or departments
	* @var int
	*/
	var $dept_count;
	/**
	* Fieldnames of care_address_citytown table. Primary key is "nr".
	* @var array
	*/
	var $tabfields=array('nr',
						'encounter_nr',
						'date',
						'type',
						'medicine',
						'dosage',
						'application_type_nr',
						'application_by',
						'titer',
						'refresh_date',
						'notes',
						'status',
						'history',
						'modify_id',
						'modify_time',
						'create_id',
						'create_time');
	/**
	* Fieldnames of care_type_immunization table. Primary key is "nr".
	* @var array
	*/
	var $tabfields_type=array('nr',
						'type',
						'name',
						'LD_var',
						'period',
						'tolerance',
						'dosage',
						'medicine',
						'titer',
						'note',
						'application',
						'status',
						'history',
						'modify_id',
						'modify_time',
						'create_id',
						'create_time');
	/**
	* Constructor
	*/			
	function Immunization(){
		$this->setTable($this->tb);
		$this->setRefArray($this->tabfields);
	}
	/**
	* Constructor
	*/			
	function ImmunizationType(){
		$this->setTable($this->tb_type);
		$this->setRefArray($this->tabfields_type);
	}

	/**
	* Gets all immunization data based on passed condition.
	*
	* The returned  array contains the data with the index keys as set in the <var>$tabfields</var> array.
	* @param string Query constraint
	* @param string Item for sorting basis
	* @return mixed 2 dimensional array or boolean
	*/			
	function _getalldata($cond='1',$sort=''){
	    global $db;
		
		if(!empty($sort)) $sort=" ORDER BY $sort";
	    if ($this->result=$db->Execute("SELECT * FROM $this->tb WHERE $cond AND status NOT IN ($this->dead_stat) $sort")) {
		    if ($this->dept_count=$this->result->RecordCount()) {
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
	* Gets all immunization data without any condition.
	*
	* The returned  array contains the data with the index keys as set in the <var>$tabfields</var> array.
	* @param string Query constraint
	* @param string Item for sorting basis
	* @return mixed 2 dimensional array or boolean
	*/			
	function getAllNoCondition($sort=''){
	    global $db;
		
		if(!empty($sort)) $sort=" ORDER BY $sort";
	    if ($this->result=$db->Execute("SELECT * FROM $this->tb  $sort")) {
		    if ($this->dept_count=$this->result->RecordCount()) {
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
	* Gets all immunization data without any condition. Unsorted.
	*
	* The returned  array contains the data with the index keys as set in the <var>$tabfields</var> array.
	* @return mixed 2 dimensional array or boolean
	*/			
	function getAll() {
		return $this->_getalldata('1');
	}
	/**
	* Gets all immunization data without any condition. Sorted.
	*
	* The returned  array contains the data with the index keys as set in the <var>$tabfields</var> array.
	* @param string Item for sorting basis
	* @return mixed 2 dimensional array or boolean
	*/			
	function getAllSort($sort='') {
		return $this->_getalldata('1',$sort);
	}
	/**
	* Gets only ACTIVE immunization data. Sorted.
	*
	* The returned  array contains the data with the index keys as set in the <var>$tabfields</var> array.
	* @param string Item for sorting basis
	* @return mixed 2 dimensional array or boolean
	*/			
	function getAllActiveSort($sort='') {
		return $this->_getalldata("is_inactive=0",$sort);
	}
	/**
	* Gets all application types.
	*
	* The returned  2 dimensional array contains the data with the following index keys:
	* - nr = primary key number
	* - group_nr = group number
	* - type = application type
	* - name = default application type's name
	* - LD_var = the variable's name for foreign language version of the type's name
	* - description = description of the application type
	*
	* @param string Item for sorting basis
	* @return mixed 2 dimensional array or boolean
	*/			
	function getAppTypes(){
	    global $db;
	
	    if ($this->result=$db->Execute("SELECT nr,group_nr,type,name,LD_var AS \"LD_var\",description FROM $this->tb_types")) {
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
	* Gets application type information based on its type number.
	*
	* The returned  array contains the data with the following index keys:
	* - type = application type
	* - group_nr = group number
	* - name = default application type's name
	* - LD_var = the variable's name for foreign language version of the type's name
	* - description = description of the application type
	*
	* @param int Application type number
	* @return mixed or boolean
	*/			
	function getTypeInfo($type_nr){
	    global $db;
	
	    if ($this->result=$db->Execute("SELECT type,group_nr,name,LD_var AS \"LD_var\",description FROM $this->tb_types WHERE nr=$type_nr")) {
		    if ($this->result->RecordCount()) {
		        return $this->result->FetchRow();
			} else {
				return false;
			}
		}
		else {
		    return false;
		}
	}
	
	/**
	* Inserts new insurance company's complete information in the database.
	*
	* The data must be passed by reference with an associative  array.
	* The data must have the index keys as outlined in the <var>$fld_insurance</var> array.
	*
	* @access public
	* @param array Insurance company data
	* @return boolean
	*/
	function saveImmuInfoFromArray(&$data){
		global $_SESSION;
		$this->ImmunizationType();;
		$this->data_array=$data;
		$this->data_array['history']="Create: ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."\n";
		//$this->data_array['modify_id']=$_SESSION['sess_user_name'];
		$this->data_array['create_id']=$_SESSION['sess_user_name'];
		$this->data_array['create_time']=date('YmdHis');
		return $this->insertDataFromInternalArray();	
	
	}
	/**
	* Checks if the insurance company exists in the database based on its firm id.
	*
	* @access public
	* @param string Firm id
	* @return boolean
	*/
	function ImmuExists($name='') {
	    global $db;
	    if($name == '') return false;
	    if($this->result=$db->Execute("SELECT name FROM $this->tb_type WHERE name='$name'")) {
	        if($this->result->RecordCount()) {
			    return TRUE;
		    } else { return FALSE; }
	   } else { return FALSE; }
   }

	/**
	* Gets the immunization type complete information.
	*
	* The returned adodb record object contains  a row of array.
	* Each array contains the company's data with index keys as outlined in the <var>$tabfields_type</var> array.
	*
	* @access public
	* @param string Firm id
	* @return mixed adodb record object or boolean
	*/
   function getImmuTypeInfo($immu_id) {
       global $db;
	   if($immu_id=='') return FALSE;
	   $this->sql="SELECT * FROM $this->tb_type WHERE nr='$immu_id'";
	    if($this->result=$db->Execute($this->sql)) {
	        if($this->result->RecordCount()) {
		        return $this->result;
		    } else { return FALSE; }
	   } else { return FALSE; }
	} 

	/**
	* Updates an insurance company's information in the database.
	*
	* The new data must be passed by reference with an associative  array.
	* The data must have the index keys as outlined in the <var>$fld_insurance</var> array.
	*
	* @access public
	* @param int Firm id
	* @param array Insurance company data
	* @return boolean
	*/
	function updateImmuInfoFromArray($nr,&$data){
		global $_SESSION;
		$this->ImmunizationType();;
		$this->data_array=$data;
		# remove probable existing array data to avoid replacing the stored data
		if(isset($this->data_array['nr'])) unset($this->data_array['nr']);
		if(isset($this->data_array['create_id'])) unset($this->data_array['create_id']);
		# Set the where condition
		$this->where="nr='$nr'";
		$this->data_array['history']=$this->ConcatHistory("Update: ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."\n");
		$this->data_array['modify_id']=$_SESSION['sess_user_name'];
		$this->data_array['modify_time']=date('YmdHis');
		##### param FALSE disables strict numeric id behaviour of the method
		return $this->updateDataFromInternalArray($nr,FALSE);
	}	

	/**
	* Similar to <var>getImmuTypeInfo()</var>  but returns limited rows.
	*
	* The returned adodb record object contains  a row of array.
	* Each array contains the company's data with index keys as outlined in the <var>$$tabfields_type</var> array.
	*
	* @access public
	* @param int Maximum number of rows returned
	* @param int Index of first row to be returned
	* @param string Sort field name. Defaults to "name".
	* @param string Sort direction. Defaults to "ASC" = ascending.
	* @return mixed adodb record object or boolean
	*/
	function getLimitActiveImmuInfo($len=30,$so=0,$sortby='name',$sortdir='ASC'){
		global $db;
		$this->sql="SELECT * FROM $this->tb_type WHERE status NOT IN ($this->dead_stat) ORDER BY $sortby $sortdir";
	    if($this->res['glafi']=$db->SelectLimit($this->sql,$len,$so)) {
	        if($this->rec_count=$this->res['glafi']->RecordCount()) {
		        return $this->res['glafi'];
		    } else { return FALSE; }
	   } else { return FALSE; }
   	}
	/**
	* Counts all active immunization types.
	* @access public
	* @return integer
	*/
	function countAllActiveImmu(){
		global $db;
		$this->sql="SELECT nr FROM $this->tb_type WHERE status NOT IN ($this->dead_stat)";
	    if($buffer=$db->Execute($this->sql)) {
	    	return $buffer->RecordCount();
	   } else { return 0; }
   	}
	/**
	* Searches for immunization types but returns limited number of rows.
	*.
	* @access public
	* @param string Search keyword
	* @param int Maximum number of rows returned, default = 30 rows
	* @param int Start index offset, default 0 = start
	* @param string Field name to sort, default = "name"
	* @param string Sorting direction, default = ASC
	* @return mixed adodb record object or boolean
	*/
   	function searchLimitActiveImmu($key,$len=30,$so=0,$oitem='name',$odir='ASC'){
		global $db, $sql_LIKE;
		if(empty($key)) return FALSE;
		$sortby=" ORDER BY $oitem $odir";
		$select="SELECT nr,name,period,tolerance,medicine,titer,note,dosage  FROM $this->tb_type ";
		$append=" AND status NOT IN ($this->dead_stat) $sortby";
		$this->sql="$select WHERE ( nr $sql_LIKE '$key%' OR name $sql_LIKE '$key%' OR medicine $sql_LIKE '$key%' ) $append";
		if($this->res['saf']=$db->SelectLimit($this->sql,$len,$so)){
			if($this->rec_count=$this->res['saf']->RecordCount()){
				return $this->res['saf'];
		    }else{	
				$this->sql="$select WHERE ( nr $sql_LIKE '%$key' OR name $sql_LIKE '%$key' OR medicine $sql_LIKE '%$key' ) $append";
				if($this->res['saf']=$db->SelectLimit($this->sql,$len,$so)){
					if($this->rec_count=$this->res['saf']->RecordCount()){
						return $this->res['saf'];
					}else{
						$this->sql="$select WHERE ( nr $sql_LIKE '%$key%' OR name $sql_LIKE '%$key%' OR medicine $sql_LIKE '%$key%' ) $append";
						if($this->res['saf']=$db->SelectLimit($this->sql,$len,$so)){
							if($this->rec_count=$this->res['saf']->RecordCount()){
								return $this->res['saf'];
							}else{return FALSE;}
						}else{return FALSE;}
					}
				}else{return FALSE;}
			}
	   } else { return FALSE; }
   	}

	/**
	* Searches similar to searchActiveImmu() but returns the resulting number of rows.
	* 
	* Unsuccessful search returns zero value (0).
	* @param string Search keyword
	* @return integer
	*/
   	function searchCountActiveImmu($key){
		global $db, $sql_LIKE;
		if(empty($key)) return FALSE;
		$select="SELECT nr FROM $this->tb_type ";
		$append=" AND status NOT IN ($this->dead_stat)";
		$this->sql="$select WHERE ( nr $sql_LIKE '$key%' OR name $sql_LIKE '$key%' OR medicine $sql_LIKE '$key%' ) $append";
		if($this->res['scaf']=$db->Execute($this->sql)){
			if($this->rec_count=$this->res['scaf']->RecordCount()){
				return $this->rec_count;
			}else{	
				$this->sql="$select WHERE ( nr $sql_LIKE '%$key' OR name $sql_LIKE '%$key' OR medicine $sql_LIKE '%$key' ) $append";
				if($this->res['scaf']=$db->Execute($this->sql)){
					if($this->rec_count=$this->res['scaf']->RecordCount()){
						return $this->rec_count;
					}else{
						$this->sql="$select WHERE ( nr $sql_LIKE '%$key%' OR name $sql_LIKE '%$key%' OR medicine $sql_LIKE '%$key%' ) $append";
						if($this->res['scaf']=$db->Execute($this->sql)){
							if($this->rec_count=$this->res['scaf']->RecordCount()){
								return $this->rec_count;
							}else{return 0;}
						}else{return 0;}
					}
				}else{return 0;}
			}
		}else{return 0;}
   	}   	
   	
}	
?>
