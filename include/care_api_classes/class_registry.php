<?php
/**
* @package care_api
*/
/**
* Registry methods. 
*  Note this class should be instantiated only after a "$db" adodb  connector object  has been established by an adodb instance
* @author Elpidio Latorilla
* @version beta 2.0.1
* @copyright 2002,2003,2004,2005,2005 Elpidio Latorilla
* @package care_api
*/
class Registry {
	/**#@+
	* @access private
	*/
	/**
	* Table name for registry data
	* @var string
	*/
	var $tb='care_registry'; // table name
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
	* Record ID buffer
	* @var string
	*/
	var $id;
	/**#@-*/
	
	/**
	* Sets the id number.
	* @param int Record id
	* @return boolean
	*/
	function setID($id='') {
	
	    global $db;
		
	    if(empty($id)) {
		    return false;
		} else {
	        $this->id=$id;
		    return true;
		}
	}	
	/**
	* Gets the registry item.
	* @param string Field name of item to be fetched
	* @return mixed string or boolean
	*/
	function get($type='') {
    
	    global $db;
		
		if(empty($type)) {
		    return false; 
	    } else {
	
	        if ($this->result=$db->Execute("SELECT $type FROM $this->tb WHERE registry_id='$this->id'")) {
		        if ($this->result->RecordCount()) {
		            $this->row=$this->result->FetchRow();
			        return $this->row[$type];
			    } else {
			        return false;
			    }
		    } else {
		        return false;
		    }
	   }	
   }
}
?>
