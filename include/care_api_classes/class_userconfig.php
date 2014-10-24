<?php
/**
* @package care_api
*/
/**
*  User configuration methods. 
*  Note this class should be instantiated only after a "$db" adodb  connector object  has been established by an adodb instance
* @author Elpidio Latorilla
* @version beta 2.0.1
* @copyright 2002,2003,2004,2005,2005 Elpidio Latorilla
* @package care_api
*/
class UserConfig {
	/**#@+
	* @access private
	*/
	/**
	* Table name for user configurations
	* @var string
	*/
	var $tb='care_config_user'; // table name
	/**
	* SQL query result buffer
	* @var adodb record object
	*/
	var $result;
	/**
	* Resulting row buffer
	* @var array
	*/
	var $row;
	/**
	* Universal buffer
	* @var mixed
	*/
	var $buffer;
	/**
	* Universal flag
	* @var boolean
	*/
	var $bool=FALSE;
	/**
	* Preloaded data flag
	* @var boolean
	*/
	var $is_preloaded=FALSE;
	/**
	* SQL query
	* @var string
	*/
	var $sql;
	/**
	* Event flag
	* @var boolean
	*/
	var $ok;
	/**#@-*/
	
	/**
	* Does SQL transaction. Uses the adodb transaction routine.
	* @access private
	* @param string 
	* @return boolean
	*/
	function Transact($sql=''){
	    global $db;
		if(!empty($sql)) $this->sql=$sql;
        $db->BeginTrans();
        $this->ok=$db->Execute($this->sql);
        if($this->ok){
            $db->CommitTrans();
			return TRUE;
        }else{
	        $db->RollbackTrans();
			return FALSE;
	    }
    }	
	/**
	* Loads the default configuration data.
	*
	* The loaded data is stored in the internal <var>$buffer</var> buffer array and the <var>$is_preloaded</var> flag is set.
	* @deprec Use the public<var> getDefault()</var> method instead.
	* @access private
	* @return boolean
	*/
	function _getDefault(){
	    return $this->getConfig();
	}
	/**
	* Loads the default configuration data.
	*
	* The loaded data is stored in the internal <var>$buffer</var> buffer array and the <var>$is_preloaded</var> flag is set.
	* @access public
	* @return boolean
	*/
	function getDefault(){
	    return $this->getConfig();
	}
	/**
	* Loads  the user's configuration data based on its user configuration id key.
	*
	* The loaded data is stored in the internal <var>$buffer</var> buffer array and the <var>$is_preloaded</var> flag is set.
	* @access public
	* @param string User configuration id
	* @return boolean
	*/
	function getConfig($user_id='default'){
	    global $db;
	
		if(empty($user_id)) return $this->_getDefault();
		
	    if ($this->result=$db->Execute("SELECT serial_config_data FROM $this->tb WHERE user_id='$user_id'")) {
		    if ($this->result->RecordCount()) {
		        $this->row=$this->result->FetchRow();
			    $this->buffer=unserialize($this->row['serial_config_data']);
			   	$this->is_preloaded=TRUE;
			   	return TRUE;
			}else{
				return $this->getConfig(); # Returns default config
			}
		}else{
		    return FALSE;
		}
	}
	/**
	* Checks if  the user's configuration data exists in the database based on its user configuration id key.
	* @access public
	* @param string User configuration id
	* @return boolean
	*/
	function exists($user_id='') {
	    global $db;
	
		if(empty($user_id)) return FALSE;
		
	    if ($this->result=$db->Execute("SELECT user_id FROM $this->tb WHERE user_id='$user_id'")) {
		    if ($this->result->RecordCount()) {
				return TRUE;
			}else{ return FALSE;}
		}else{ return FALSE; }
	}
	/**
	* Saves  the user's configuration data.
	*
	* The configuration data is serialized first before being passed to the method.
	* @access public
	* @param string User configuration id
	* @param string Serialized data
	* @return boolean
	*/
	function saveConfig($user_id='default',&$data) {
		global $db;
	    
		if(empty($data)) return FALSE;

		$this->buffer=serialize($data);
		if($this->exists($user_id)){
			$this->sql="UPDATE $this->tb SET serial_config_data='$this->buffer', modify_id='system',modify_time='".date('YmdHis')."' WHERE user_id='$user_id'";
		}else{
			$this->sql="INSERT INTO $this->tb (user_id,serial_config_data,create_time) VALUES ('$user_id','$this->buffer','".date('YmdHis')."')";
		}
		return $this->Transact();
	}
	/**
	* Replaces (updates)  a configuration item.
	*
	* @access public
	* @param string User configuration id
	* @param string Name of item to be replaced.
	* @param string New value
	* @return boolean
	*/
	function replaceItem($user_id='default',$type='',$value='') {
	    global $db;
	    
		if(empty($type)||empty($value)) return FALSE;
		
		$this->buffer=$this->getConfig($user_id);
		
		if($this->buffer!=FALSE)  {
		    $this->buffer[$type]=$value;
			if($this->saveConfig($user_id,$this->buffer)) return TRUE;
			   else return FALSE;
		}else{
		    return FALSE;
		}	         
	}
	/**
	* Checks if the configuration data is successfully preloaded.
	* @access public
	* @return boolean
	*/
	function isPreLoaded(){
		return $this->is_preloaded;
	}
	/**
	* Returns the preloaded configuration data.
	* @access public
	* @return array
	*/
	function getConfigData(){
		return $this->buffer;
	}
}
?>
