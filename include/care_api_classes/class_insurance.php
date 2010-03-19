<?php
/**
* @package care_api
*/
/**
*/
require_once($root_path.'include/care_api_classes/class_core.php');
/**
*  Insurance methods. 
*  Note this class should be instantiated only after a "$db" adodb  connector object  has been established by an adodb instance
* @author Elpidio Latorilla
* @version beta 2.0.1
* @copyright 2002,2003,2004,2005,2005 Elpidio Latorilla
* @package care_api
*/
class Insurance extends Core {
	/**
	* Table name insurance classes
	* @var string
	*/
	var $tb_class='care_class_insurance'; # insurance classes table name
	/**
	* Table name for insurance companies' data
	* @var string
	*/
	var $tb_insurance='care_insurance_firm'; # insurance companies
	/**
	* Buffer for sql query results
	* @var mixed adodb record object or boolean
	*/
	var $result;
	/**
	* Buffer for row returned by adodb's FetchRow() method
	* @var array
	*/
	var $row;
	/**
	* Insurance company's id
	* @var string
	*/
	var $firm_id;
	/**
	* Universal buffer
	* @var mixed
	*/
	var $buffer;
	/**
	* Sql query string
	* @var string
	*/
	var $sql;
	/**
	* Universal event flag
	* @var boolean
	*/
	var $ok;
	/**
	* Field names of care_insurance_firm table
	* @var array
	*/
	var $fld_insurance=array(
			'firm_id',
			'name',
			'iso_country_id',
			'sub_area',
			'type_nr',
			'addr',
			'addr_mail',
			'addr_billing',
			'addr_email',
			'phone_main',
			'phone_aux',
			'fax_main',
			'fax_aux',
			'contact_person',
			'contact_phone',
			'contact_fax',
			'contact_email',
			'use_frequency',
			'status',
			'history',
			'modify_id',
			'modify_time',
			'create_id',
			'create_time');
	/**
	* Constructor
	* @param string Insurance company id
	*/
	function Insurance($firm_id='') {
	    $this->firm_id=$firm_id;
		$this->coretable=$this->tb_insurance;
		$this->ref_array=$this->fld_insurance;
	}
	/**
	* Sets the internal firm id buffer to the insurance company's id.
	* @access public
	* @param string Insurance company id
	*/
	function setFirmID($firm_id='') {
	    $this->firm_id=$firm_id;
	}
	/**
	* Resolves the insurance company's id.
	* @access private
	* @param string Insurance company id
	* @return boolean
	*/
	function _internResolveFirmID($firm_id='') {
	    if (empty($firm_id)) {
		    if(empty($this->firm_id)) {
			    return FALSE;
			} else { return TRUE; }
		} else {
		     $this->firm_id=$firm_id;
			return TRUE;
		}
	}
	/**
	* Sets the core to point to the insurance table's name and field names.
	* @access public
	*/
	function _useInsurance(){
		$this->coretable=$this->tb_insurance;
		$this->ref_array=$this->fld_insurance;
	}
	/**
	* Gets the information of all insurance classes. Returns adodb record object.
	*
	* @access public
	* @param string Field names of values to be fetched
	* @return mixed adodb record object or boolean
	*/
    function getInsuranceClassInfoObject($items='class_nr,class_id,name,LD_var AS "LD_var", description,status,history') {
    
	    global $db;
	
        if ($this->res['gicio']=$db->Execute("SELECT $items  FROM $this->tb_class WHERE status='active'")) {
            if ($this->res['gicio']->RecordCount()) {
                return $this->res['gicio'];
            } else {return FALSE;}
				} else {return FALSE; }
    }
	/**
	* Gets the information of all insurance classes. Returns 2 dimensional array.
	*
	* @access public
	* @param string Field names of values to be fetched
	* @return mixed adodb record object or boolean
	*/
    function getInsuranceClassInfoArray($items='class_nr,class_id,name,LD_var AS "LD_var", description,status,history') {
    
	    global $db;
	
        if ($this->result=$db->Execute("SELECT $items  FROM $this->tb_class")) {
            if ($this->result->RecordCount()) {
		return $this->result->GetArray();
		 //$this->row=NULL;
		//while($this->row[]=$this->result->FetchRow());
		//		return $this->row;
            } else {return FALSE;}
		} else { return FALSE; }
    }
	/**
	* Checks if the insurance company exists in the database based on its firm id.
	*
	* @access public
	* @param string Firm id
	* @return boolean
	*/
	function Firm_exists($firm_id='') {
	    global $db;
	    if(!$this->_internResolveFirmID($firm_id)) return FALSE;
	    if($this->result=$db->Execute("SELECT firm_id FROM $this->tb_insurance WHERE firm_id='$this->firm_id'")) {
	        if($this->result->RecordCount()) {
			    return TRUE;
		    } else { return FALSE; }
	   } else { return FALSE; }
   }
   /**
   * Alias of Firm_exists()
   */
	function FirmIDExists($firm_id) {
	    return $this->Firm_exists($firm_id);
   }
	/**
	* Gets the usage frequency of an insurance company based on its firm id key.
	*
	* @access public
	* @param string Firm id
	* @return mixed integer or boolean
	*/
    function getUseFrequency($firm_id='') {
	
        global $db;
	   
	    if(!$this->_internResolveFirmID($firm_id)) return FALSE;
	    if($this->result=$db->Execute("SELECT use_frequency FROM $this->tb_insurance WHERE firm_id=$this->firm_id")) {
	        if($this->result->RecordCount()) {
		        $this->row=$this->result->FetchRow();
			    return $this->row['use_frequency'];
		    } else { return FALSE; }
	   } else { return FALSE; }
    }
	/**
	* Increases usage frequency of an insurance company.
	*
	* @access public
	* @param string Firm id
	* @param int Increase step
	* @return boolean
	*/
	function updateUseFrequency($firm_id='',$step=1) {

		if(!$this->_internResolveFirmID($firm_id)) return FALSE;
		# Get last usage frequency value
		//$this->buffer=getUseFrequency($this->firm_id);
		//$this->sql="UPDATE $this->tb_insurance SET use_frequency=".($this->buffer+$step)." WHERE firm_id=$this->firm_id";
		$this->sql="UPDATE $this->tb_insurance SET use_frequency=(use_frequency + 1) WHERE firm_id=$this->firm_id";
		if($this->result=$this->Transact($this->sql)) {
			if($this->result->Affected_Rows()) {
				return TRUE;
			} else { return FALSE; }
		} else { return FALSE; }
   }
	/**
	* Gets the insurance company's name.
	* @access public
	* @param string Firm id
	* @return mixed string or boolean
	*/
   function getFirmName($firm_id) {
       global $db;
	   if(!$this->_internResolveFirmID($firm_id)) return FALSE;
	   
	   $this->sql="SELECT name FROM $this->tb_insurance WHERE firm_id='$this->firm_id'";
	    if($this->result=$db->Execute($this->sql)) {
	        if($this->result->RecordCount()) {
		        $this->row=$this->result->FetchRow();
			    return $this->row['name'];
		    } else { return FALSE; }
	   } else { return FALSE; }
   }
	/**
	* Gets the insurance company's complete information.
	*
	* The returned adodb record object contains  a row of array.
	* Each array contains the company's data with index keys as outlined in the <var>$fld_insurance</var> array.
	*
	* @access public
	* @param string Firm id
	* @return mixed adodb record object or boolean
	*/
   function getFirmInfo($firm_id) {
       global $db;
	   if(!$this->_internResolveFirmID($firm_id)) return FALSE;
	   $this->sql="SELECT * FROM $this->tb_insurance WHERE firm_id='$this->firm_id'";
	    if($this->result=$db->Execute($this->sql)) {
	        if($this->result->RecordCount()) {
		        return $this->result;
		    } else { return FALSE; }
	   } else { return FALSE; }
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
	function saveFirmInfoFromArray(&$data){
		global $_SESSION;
		$this->_useInsurance();
		$this->data_array=$data;
		$this->data_array['history']="Create: ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."\n";
		//$this->data_array['modify_id']=$_SESSION['sess_user_name'];
		$this->data_array['create_id']=$_SESSION['sess_user_name'];
		$this->data_array['create_time']=date('YmdHis');
		return $this->insertDataFromInternalArray();
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
	function updateFirmInfoFromArray($nr,&$data){
		global $_SESSION;
		$this->_useInsurance();
		$this->data_array=$data;
		# remove probable existing array data to avoid replacing the stored data
		if(isset($this->data_array['firm_id'])) unset($this->data_array['firm_id']);
		if(isset($this->data_array['create_id'])) unset($this->data_array['create_id']);
		# Set the where condition
		$this->where="firm_id='$nr'";
		$this->data_array['history']=$this->ConcatHistory("Update: ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."\n");
		$this->data_array['modify_id']=$_SESSION['sess_user_name'];
		$this->data_array['modify_time']=date('YmdHis');
		##### param FALSE disables strict numeric id behaviour of the method
		return $this->updateDataFromInternalArray($nr,FALSE);
	}
	/**
	* Gets all active insurance firms' information.
	*
	* The returned adodb record object contains  a row of array.
	* Each array contains the company's data with index keys as outlined in the <var>$fld_insurance</var> array.
	*
	* @access public
	* @param string Sort directive. Defaults to "name".
	* @return mixed adodb record object or boolean
	*/
	function getAllActiveFirmsInfo($sortby='name'){
		global $db;
		if($sortby=='use_frequency') $sortby.=' DESC';
		$this->sql="SELECT * FROM $this->tb_insurance WHERE status NOT IN ($this->dead_stat) ORDER BY $sortby";
	    if($this->result=$db->Execute($this->sql)) {
	        if($this->result->RecordCount()) {
		        return $this->result;
		    } else { return FALSE; }
	   } else { return FALSE; }
   	}
	/**
	* Similar to <var>getAllActiveFirmsInfo()</var>  but returns limited rows.
	*
	* The returned adodb record object contains  a row of array.
	* Each array contains the company's data with index keys as outlined in the <var>$fld_insurance</var> array.
	*
	* @access public
	* @param int Maximum number of rows returned
	* @param int Index of first row to be returned
	* @param string Sort field name. Defaults to "name".
	* @param string Sort direction. Defaults to "ASC" = ascending.
	* @return mixed adodb record object or boolean
	*/
	function getLimitActiveFirmsInfo($len=30,$so=0,$sortby='name',$sortdir='ASC'){
		global $db;
		$this->sql="SELECT * FROM $this->tb_insurance WHERE status NOT IN ($this->dead_stat) ORDER BY $sortby $sortdir";
	    if($this->res['glafi']=$db->SelectLimit($this->sql,$len,$so)) {
	        if($this->rec_count=$this->res['glafi']->RecordCount()) {
		        return $this->res['glafi'];
		    } else { return FALSE; }
	   } else { return FALSE; }
   	}
	/**
	* Counts all active insurance firms.
	* @access public
	* @return integer
	*/
	function countAllActiveFirms(){
		global $db;
		$this->sql="SELECT firm_id FROM $this->tb_insurance WHERE status NOT IN ($this->dead_stat)";
	    if($buffer=$db->Execute($this->sql)) {
	    	return $buffer->RecordCount();
	   } else { return 0; }
   	}
	/**
	* Searches for all active firms based on the supplied search key.
	*
	* The returned adodb record object contains rows of arrays.
	* Each array contains the insurance firm data with the following index keys:
	* - firm_id = firm id
	* - name = insurance firm name
	* - phone_main = main phone number
	* - fax_main = main fax number
	* - addr_email = main email address
	*
	* @access public
	* @param string Search keyword
	* @return mixed adodb record object or boolean
	*/
   	function searchActiveFirm($key){
		global $db, $sql_LIKE;
		if(empty($key)) return FALSE;
		if(is_numeric($key)) $sortby=" ORDER BY firm_id";
			else $sortby=" ORDER BY name";
		$select="SELECT firm_id,name,phone_main,fax_main,addr_email  FROM $this->tb_insurance ";
		$append=" AND status NOT IN ($this->dead_stat) $sortby";
		$this->sql="$select WHERE ( firm_id $sql_LIKE '$key%' OR name $sql_LIKE '$key%' OR addr_email $sql_LIKE '$key%' ) $append";
		if($this->result=$db->Execute($this->sql)){
			if($this->result->RecordCount()){
				return $this->result;
		    }else{	
				$this->sql="$select WHERE ( firm_id $sql_LIKE '%$key' OR name $sql_LIKE '%$key' OR addr_email $sql_LIKE '%$key' ) $append";
				if($this->result=$db->Execute($this->sql)){
					if($this->result->RecordCount()){
						return $this->result;
					}else{
						$this->sql="$select WHERE ( firm_id $sql_LIKE '%$key%' OR name $sql_LIKE '%$key%' OR addr_email $sql_LIKE '%$key%' ) $append";
						if($this->result=$db->Execute($this->sql)){
							if($this->result->RecordCount()){
								return $this->result;
							}else{return FALSE;}
						}else{return FALSE;}
					}
				}else{return FALSE;}
			}
	   } else { return FALSE; }
   	}
	/**
	* Searches similar to <var>searchActiveFirm()</var> but returns limited number of rows.
	*
	* For detailed structure of the returned data, see <var>searchActiveFirm()</var> method.
	* @access public
	* @param string Search keyword
	* @param int Maximum number of rows returned, default = 30 rows
	* @param int Start index offset, default 0 = start
	* @param string Field name to sort, default = "name"
	* @param string Sorting direction, default = ASC
	* @return mixed adodb record object or boolean
	*/
   	function searchLimitActiveFirm($key,$len=30,$so=0,$oitem='name',$odir='ASC'){
		global $db, $sql_LIKE;
		if(empty($key)) return FALSE;
		$sortby=" ORDER BY $oitem $odir";
		$select="SELECT firm_id,name,phone_main,fax_main,addr_email  FROM $this->tb_insurance ";
		$append=" AND status NOT IN ($this->dead_stat) $sortby";
		$this->sql="$select WHERE ( firm_id $sql_LIKE '$key%' OR name $sql_LIKE '$key%' OR addr_email $sql_LIKE '$key%' ) $append";
		if($this->res['saf']=$db->SelectLimit($this->sql,$len,$so)){
			if($this->rec_count=$this->res['saf']->RecordCount()){
				return $this->res['saf'];
		    }else{	
				$this->sql="$select WHERE ( firm_id $sql_LIKE '%$key' OR name $sql_LIKE '%$key' OR addr_email $sql_LIKE '%$key' ) $append";
				if($this->res['saf']=$db->SelectLimit($this->sql,$len,$so)){
					if($this->rec_count=$this->res['saf']->RecordCount()){
						return $this->res['saf'];
					}else{
						$this->sql="$select WHERE ( firm_id $sql_LIKE '%$key%' OR name $sql_LIKE '%$key%' OR addr_email $sql_LIKE '%$key%' ) $append";
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
	* Searches similar to searchActiveFirm() but returns the resulting number of rows.
	* 
	* Unsuccessful search returns zero value (0).
	* @param string Search keyword
	* @return integer
	*/
   	function searchCountActiveFirm($key){
		global $db, $sql_LIKE;
		if(empty($key)) return FALSE;
		$select="SELECT firm_id FROM $this->tb_insurance ";
		$append=" AND status NOT IN ($this->dead_stat)";
		$this->sql="$select WHERE ( firm_id $sql_LIKE '$key%' OR name $sql_LIKE '$key%' OR addr_email $sql_LIKE '$key%' ) $append";
		if($this->res['scaf']=$db->Execute($this->sql)){
			if($this->rec_count=$this->res['scaf']->RecordCount()){
				return $this->rec_count;
			}else{	
				$this->sql="$select WHERE ( firm_id $sql_LIKE '%$key' OR name $sql_LIKE '%$key' OR addr_email $sql_LIKE '%$key' ) $append";
				if($this->res['scaf']=$db->Execute($this->sql)){
					if($this->rec_count=$this->res['scaf']->RecordCount()){
						return $this->rec_count;
					}else{
						$this->sql="$select WHERE ( firm_id $sql_LIKE '%$key%' OR name $sql_LIKE '%$key%' OR addr_email $sql_LIKE '%$key%' ) $append";
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

// ********** class PersonInsurance 

/**
*  Personinsurance methods. 
*  Note this class should be instantiated only after a "$db" adodb  connector object  has been established by an adodb instance
* @author Elpidio Latorilla
* @version beta 2.0.1
* @copyright 2002,2003,2004,2005,2005 Elpidio Latorilla
* @package care_api
*/
class PersonInsurance extends Insurance {
	/**
	* Table name for  person's insurance data
	* @var string
	*/			
    var $tb_person_insurance='care_person_insurance';
	/**
	* PID number
	* @var int
	*/			
	var $pid;
	/**
	* Constructor
	* @param int PID number
	*/			
	function PersonInsurance ($pid=0) {
	    $this->pid=$pid;
	}
	/**
	* Sets the internal PID number buffer
	* @param int PID number
	*/			
	function setPID($pid) {
	    $this->pid=$pid;
	}
	/**
	* Resolves the PID number to be used.
	* @param int PID number
	*/			
	function internResolvePID($pid) {
	    if (empty($pid)) {
		    if(empty($this->pid)) {
			    return FALSE;
			} else { return TRUE; }
		} else {
		     $this->pid=$pid;
			return TRUE;
		}
	}
	/**
	* Updates a database table record with data from an array.
	*
	* @param array Data to save. By reference.
	* @param mixed interger or string
	* @return boolean
	*/			
    function updateDataFromArray(&$array,$item_nr='') {
		$x='';
		$v='';
		$sql='';
		if(!is_array($array)||empty($item_nr)||!is_numeric($item_nr)) return FALSE;
		while(list($x,$v)=each($array)) {
		    $sql.="$x='$v',";
		}
		$sql=substr_replace($sql,'',(strlen($sql))-1);
        $this->sql="UPDATE $this->tb_person_insurance SET $sql WHERE item_nr=$item_nr";				
		return $this->Transact();
	}
	/**
	*  Inserts data from an array into a database table.
	*
	* @param array Data to save. By reference.
	* @param mixed interger or string
	* @return boolean
	*/			
    function insertDataFromArray(&$array) {
		$x='';
		$v='';
		$index='';
		$values='';
		if(!is_array($array)) return FALSE;
		while(list($x,$v)=each($array)) {
		    $index.="$x,";
		    $values.="'$v',";
		}
		    $index=substr_replace($index,'',(strlen($index))-1);
		    $values=substr_replace($values,'',(strlen($values))-1);

        	$this->sql="INSERT INTO $this->tb_person_insurance ($index) VALUES ($values)";
		return $this->Transact();
	}
	/**
	* Gets person's insurance data based on his PID number.
	*
	* The returned adodb record object contains rows of arrays.
	* Each array contains the  data with the following index keys:
	* - insurance_item_nr = insurance record primar key number
	* - insurance_type = insurance type
	* - insurance_nr = insurance number
	* - insurance_firm_id = firm id
	* - insurance_class_nr = insurance class number
	*
	* @access public
	* @param int PID number
	* @return mixed adodb record object or boolean
	*/
	function getPersonInsuranceObject($pid='') {
	    global $db;

		if(!$this->internResolvePID($pid)) return FALSE;
		
        $this->sql="SELECT 
		                           item_nr AS insurance_item_nr,
								   type AS insurance_type,
			                       insurance_nr,
								   firm_id AS insurance_firm_id, 
								   class_nr AS insurance_class_nr 
								   FROM $this->tb_person_insurance 
						  WHERE 
						          pid='$this->pid' AND (is_void=0 OR is_void='') 
						  ORDER BY 
						          modify_time DESC";
			    
        if($this->result=$db->Execute($this->sql)) {
            if($this->result->RecordCount()) {
                return $this->result;
            } else { return FALSE;}
        } else { return FALSE; }
    }
	/**
	* Gets insurance class's information based on the class number.
	*
	* The returned  array contains the  data with the following index keys:
	* - class_id = class id
	* - name = class name
	*
	* @access public
	* @param int Class number
	* @return mixed array or boolean
	*/
    function getInsuranceClassInfo($class_nr) {
        global $db;
		
        if($this->result=$db->Execute("SELECT class_nr,class_id,name,LD_var AS  \"LD_var\", description,status,history FROM $this->tb_class WHERE class_nr=$class_nr")) {
            if($this->result->RecordCount()) {
				 $this->row= $this->result->FetchRow();
				 return $this->row;	 
			} else { return FALSE; }
		} else { return FALSE; }
	}

}
?>
