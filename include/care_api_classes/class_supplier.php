<?php
/**
* @package care_api
*/
/**
*/
require_once($root_path.'include/care_api_classes/class_core.php');
/**
*  Supplier methods. 
*
* Note this class should be instantiated only after a "$db" adodb  connector object  has been established by an adodb instance
* @author Gjergj Sheldija
* @version beta 1.0.1
* @copyright 2006 Gjergj Sheldija
* @package care_api
*/
class Supplier extends Core {
	/**#@+
	* @access private
	* @var string
	*/
	/**
	* Table name for medical depot main products
	*/
	var $tb_mmain='care_supplier';
	var $tb='care_supplier';
	var $supplier_count;
	/**#@-*/
	
	/**
	* Field names of care_pharma_products_main or care_med_products_main tables
	* @var array
	*/
	var $fld_furnmain=array('idcare_supplier',
										'supplier',
										'address',
										'telephone',
										'fax',
										'postal_code',
										'representative');

	/**
	* Constructor
	*/				
	function Supplier(){
	}
	/**
	* Sets the core object to point  to either care_pharma_products_main or care_med_products_main table and field names.
	*
	* The table is determined by the parameter content. 
	* @access public
	* @param string Determines the final table name 
	* @return boolean.
	*/
	function useSupplier($type){
		$this->coretable=$this->tb_mmain;
		$this->ref_array=$this->fld_furnmain;
	}
	/**
	* Gets all data from the care_supplier table
	* @access private
	* @param string WHERE condition of the sql query
	* @param string Sort item
	* @param string  Determines the return type whether adodb object (_OBJECT) or assoc array (_ARRAY, '', empty) 
	* @return mixed boolean or adodb record object or assoc array, determined by param $ret_type
	*/
	function _getalldata($cond='1',$sort='',$ret_type=''){
	    global $db;
		if(empty($sort)) $sort='supplier';
		$this->sql="SELECT * FROM $this->tb WHERE $cond ORDER BY $sort";
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
	* Gets all funitoret without condition. The result is assoc array sorted by departments formal name
	* @access public
	* @return mixed boolean or adodb record object or assoc array
	*/
	function getAllSupplier() {
		return $this->_getalldata('1');
	}	
	/**
	* Saves (inserts)  an item in the order catalog.
	*
	* The data must be passed by reference with associative array.
	* Data must have the index keys as outlined in the <var>$fld_ocat</var> array.
	* @access public
	* @param array Data to save
	* @param string Determines the final table name 
	* @return boolean
	*/
	function SaveSupplierItem(&$data,$type){
		if(empty($type)) return false;
		$this->useSupplier($type);
		$this->data_array=&$data;
		return $this->insertDataFromInternalArray();
	}
	/**
	* Checks if the supplier exists based on its primary key number.
	* @access public
	* @param int Item number
	* @param string Determines the final table name 
	* @return boolean
	*/
	function SupplierExists($nr=0,$type=''){
		global $db;
		if(empty($type)||!$nr) return false;
		$this->useSupplier($type);
		$this->sql="SELECT supplier FROM $this->coretable WHERE supplier='$nr'";

        if($buf=$db->Execute($this->sql)) {
            if($buf->RecordCount()) {
				return true;
			} else { return false; }
		} else { return false; }
	}

	/**
	* Returns the supplier name based on it's primary key
	* @access public
	* @param int Item number
	* @param string Determines the final table name 
	* @return boolean
	*/
	function FormalName($nr=0){
		global $db;
		if ($this->result=$db->Execute("SELECT supplier FROM care_supplier WHERE idcare_supplier='$nr'")) {
		    if ($this->result->RecordCount()) {
		    	$row=$this->result->FetchRow();
			    return $row['supplier'];
			} else {
				return FALSE;
			}
		}
		else {
		    return FALSE;
		}
	}
	
	/**
	* Returns the data of the selected supplier based on it's primary key
	* @access public
	* @param int Item number
	* @param string Determines the final table name 
	* @return boolean
	*/
	function ReturnSupplierData($nr=0){
		global $db;
		if ($this->result=$db->Execute("SELECT * FROM care_supplier WHERE idcare_supplier='$nr'")) {
		    if ($this->result->RecordCount()) {
		    	$row=$this->result->FetchRow();
			    return $row;
			} else {
				return FALSE;
			}
		}
		else {
		    return FALSE;
		}
	}	
}
?>
