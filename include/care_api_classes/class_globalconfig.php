<?php
/**
* @package care_api
*/
/**
*/
require_once($root_path.'include/care_api_classes/class_core.php');

/**
*  Global configuration methods.
*  Note this class should be instantiated only after a "$db" adodb  connector object  has been established by an adodb instance
* @author Elpidio Latorilla
* @version beta 2.0.1
* @copyright 2002,2003,2004,2005,2005 Elpidio Latorilla
* @package care_api
*/
class GlobalConfig  extends Core{
	/**
	* Table name for encounter (admission) data
	* @var string
	*/
	var $tb='care_config_global'; // the table's name
	/**
	* SQL query result
	*
	* @var object adodb record object
	*/
	var $result;
	/**
	* Current number or rows
	* @var omt
	*/
	var $row;
	/**
	* Configuration
	* @var string
	*/
	var $config;
	/**
	* Status variable
	* @var string
	*/
	var $condition;
	/**
	* Buffer flag
	* @var boolean
	*/
	var $ok;
	/**
	* Constructor
	* @param array Configuration handler. By reference.
	*/
	function GlobalConfig(&$handler) {
	    $this->config=&$handler;
	}
	/**
	* Gets (a) global configuration value(s) of (a) configuration item(s).
	*
	* The item to be fetched is passed as parameter. This could contain the % wild card where in such case all
	* values of the configuration items that fit the type will be fetched and stored in the array.
	* The array must be passed by reference to the class's constructor.	
	* @access public
	* @param string Configuration item to be fetched. 
	* @return mixed string or boolean
	*/
	function getConfig($type='') {
	    global $db, $sql_LIKE;
		
	    if(empty($type)||!$type) {
		    $this->condition='1';
		} else {
		    $this->condition="type $sql_LIKE '$type'";
		}
		if($this->result=$db->Execute("SELECT type,value FROM $this->tb WHERE $this->condition")) {
            if ($this->result->RecordCount()) {
                while($this->row=$this->result->FetchRow()) {
                    $this->config[$this->row['type']]=$this->row['value'];
				}
				return true;
			} else {
			    return false;
			}
		} else {
		    return false;
		}
	}
	/**
	* Saves a global configuration value to its configuration item.
	* @access public
	* @param string Configuration item
	* @param mixed Configuration value
	* @return boolean
	*/
	function saveConfigItem($type='',$value='') {
		global $db;
		//$db->debug=1;
		if(empty($type)) return false;
		
		$buf=$this->getConfigValue($type);

		if($buf!='_config_no_exists'){
		
			# Update if values differ
			if($buf!=$value){
				$this->sql="UPDATE $this->tb SET type='$type',value='$value' WHERE type='$type'";
				$db->BeginTrans();
				$this->ok=$db->Execute($this->sql);
				if($this->ok&&$db->Affected_Rows()) {
					$db->CommitTrans();
					return true;
				} else {
					$db->RollbackTrans();
					return false;
				}
			}else{
				return FALSE;
			}
		}else{
			$this->sql="INSERT INTO $this->tb (type,value,status,history,modify_id,modify_time,create_id,create_time)
							VALUES ('$type','$value','','Created ".date('Y-m-d H:i:s')."','','0','System','".date('YmdHis')."')";
			return $this->Transact();
		}
	}
	/**
	* Saves configuration values stored in an associative array.
	*
	* The array's index key is the configuration item while its value is the configuration value.
	*
	* If param $numeric is true, value will be checked if numeric or not (no = default value stored, yes= value stored)
	* If param $numeric is false, value will be considered as is.
	* @param array Configuration values
	* @param string Filter string used for indentifying the array's index intended for storing
	* @param boolean Flag if value is numeric or not
	* @param int  Default value used if param $numeric is TRUE and value is not numeric
	* @param boolean Flag to add slashes. If TRUE, slashes will be added to the value
	* @return boolean
	*/
	function saveConfigArray(&$data_array,$filter='',$numeric=FALSE,$def_value='',$addslash=FALSE) {

		if(!is_array($data_array)||empty($filter)) return FALSE;
		
		while(list($x,$v)=each($data_array)){
			# If index name fits in filter save the value
			if(stristr($x,$filter)){
				if($numeric&&(empty($v)||!is_numeric($v))){
					$this->saveConfigItem($x,$def_value);
				}else{
					if($addslash) $this->saveConfigItem($x,addslashes($v));
						else $this->saveConfigItem($x,$v);
				}
			}
		}
		return TRUE;
	}
	/**
	* Gets a global config value of a config item supplied as parameter.
	*
	* The configuration item CANNOT contain a wildcard. This method returns the value of only one single configuration item.	
	* @param string Configuration item to be fetched. 
	* @return string
	*/
	function getConfigValue($type='') {
	    global $db;
		
	    if(empty($type)||!$type) {
		    return '';
		}else{ 
			if($this->result=$db->Execute("SELECT value FROM $this->tb WHERE type = '$type'")) {
            	if ($this->result->RecordCount()) {
					$this->row=$this->result->FetchRow();
               		return $this->row['value'];
				}else{return '_config_no_exists';}
			}else{return '_config_no_exists';}
		}
	}
	
}
?>
