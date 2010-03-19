<?php
/**
* @package care_api
*/
/**
*/
require_once($root_path.'include/care_api_classes/class_core.php');
/**
*  Measurement methods. 
*  Note this class should be instantiated only after a "$db" adodb  connector object  has been established by an adodb instance
* @author Elpidio Latorilla
* @version beta 2.0.1
* @copyright 2002,2003,2004,2005,2005 Elpidio Latorilla
* @package care_api
*/
class Measurement extends Core {
	/**
	* Table name measurement data
	* @var string
	*/
	var $tb='care_encounter_measurement'; // table name
	/**
	* Table name measurement types
	* @var string
	*/
	var $tb_msr_types='care_type_measurement';
	/**
	* Table name for units of measurement
	* @var string
	*/
	var $tb_units='care_unit_measurement';
	/**
	* Table name for types of measurement unit
	* @var string
	*/
	var $tb_unit_types='care_type_unit_measurement';
	/**
	* SQL query result buffer
	* @var adodb record object
	*/
	var $result;
	/**
	* Department's preloaded data
	* @var adodb record object 
	*/
	var $preload_dept;
	/**
	* Preloaded department flag
	* @var boolean
	*/
	var $is_preloaded=false;
	/**
	* Number of departments
	* @var int
	*/
	var $dept_count;
	/**
	* Field names of care_encounter_measurement table
	* @var string
	*/
	var $tabfields=array('nr',
									'msr_date',
									'msr_time',
									'encounter_nr',
									'msr_type_nr',
									'value',
									'unit_nr',
									'unit_type_nr',
									'notes',
									'measured_by',
									'status',
									'history',
									'modify_id',
									'modify_time',
									'create_id',
									'create_time');
	/**
	* Constructor
	*/
	function Measurement(){
		$this->setTable($this->tb);
		$this->setRefArray($this->tabfields);
	}
	/**
	* Gets all measurement types.
	*
	* The returned 2 dimensional array contains the data with the following index keys:
	* - nr = primary key number
	* - type = type of measurement
	* - name = default name of measurement
	* - LD_var = variable's name for the foreign language version of the type's name
	*
	* Example:
	* <code>
	* $types=$obj->getAllMsrTypes();
	* while(list($x,$v)=each($types)){
	*    while(list($z,$y)=each($y)){
	*        echo $y['name']; # prints the name
	*    }
	* }
	* </code>
	* @access public
	* @return mixed 2 dimensional array or boolean
	*/
	function getAllMsrTypes(){
	    global $db;
	
	    if ($this->result=$db->Execute("SELECT nr,type,name,LD_var AS \"LD_var\" FROM $this->tb_msr_types")) {
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
	* Gets measurement units based on a condition. 
	*
	* The returned 2 dimensional array contains the data with the following index keys:
	* - nr = primary key number
	* - unit_type_nr = type number of unit
	* - id = unit id
	* - name = default name unit
	* - LD_var = variable's name for the foreign language version of the unit's name
	*
	* @access private
	* @param string Select WHERE condition. Default to "1" = select all.
	* @param boolean Flag for the return type. FALSE (default) = 2 dimensional array, TRUE = adodb record object.
	* @return mixed 2 dimensional array or boolean
	*/
	function _getUnits($cond='',$ret_obj=FALSE){
	    global $db;
		$this->sql="SELECT nr,unit_type_nr,id,name,LD_var AS \"LD_var\"  FROM $this->tb_units";
		if(!empty($cond)) $this->sql.=" WHERE $cond";
	    if ($this->res['_gunits']=$db->Execute($this->sql)) {
		    if ($this->rec_count=$this->res['_gunits']->RecordCount()) {
				if($ret_obj) return $this->res['_gunits'];
		        	else return $this->res['_gunits']->GetArray();
			}else{return false;}
		}else{return false;}
	}	
	/**
	* Gets all measurement units without conditions.
	* 
	* For detailed structure of returned data, see the <var>_getUnits()</var> method.
	* @access public
	* @return mixed 2 dimensional array or boolean
	*/
	function getUnits(){
	    return $this->_getUnits();
	}	
/*		function getmetricUnits(){
	    return $this->_getUnits("system='metric'");
	}	
	function getenglishUnits(){
	    return $this->_getUnits("system='english'");
	}	
	
function increaseUnitHit($nr,$count='1'){
	    global $db;
		if(empty($nr)) return false;
	    if ($this->result=$db->Execute("UPDATE $this->tb_units SET use_frequency=(use_frequency+$count) WHERE nr=$nr")) {
		    if ($db->Affected_Rows()) {
		        return true;
			} else {
				return false;
			}
		}
		else {
		    return false;
		}
	}	
	*/
	/**
	* Returns all volume units in metric system.
	* 
	* For detailed structure of returned data, see the <var>_getUnits()</var> method.
	* @access public
	* @return mixed 2 dimensional array or boolean
	*/
	function VolumeUnits(){
		return $this->_getUnits('unit_type_nr=1'); # Unit type nr 1 = volume unit
	}
	/**
	* Returns all weight units in metric system.
	* 
	* For detailed structure of returned data, see the <var>_getUnits()</var> method.
	* @access public
	* @return mixed 2 dimensional array or boolean
	*/
	function WeightUnits(){
		return $this->_getUnits('unit_type_nr=2'); # Unit type nr 2 = weight unit
	}
	/**
	* Returns all length/height units in metric system.
	* 
	* For detailed structure of returned data, see the <var>_getUnits()</var> method.
	* @access public
	* @return mixed 2 dimensional array or boolean
	*/
	function LengthUnits(){
		return $this->_getUnits('unit_type_nr=3'); # Unit type nr 2 = length/height unit 
	}
}
?>
