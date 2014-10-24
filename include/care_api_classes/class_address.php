<?php
/**
* @package care_api
*/

/**
*/
require_once($root_path.'include/care_api_classes/class_core.php');

/**
*  Address methods.
*  Note this class should be instantiated only after a "$db" adodb  connector object  has been established by an adodb instance.
* @author Elpidio Latorilla
* @version beta 2.0.1
* @copyright 2002,2003,2004,2005,2005 Elpidio Latorilla
* @package care_api
*/
class Address extends Core {
	/**
	* Database table for the citytown address data.
	* @var string
	*/
	var $tb_citytown='care_address_citytown';
	/**
	* Fieldnames of care_address_citytown table. Primary key is "nr".
	* @var array
	*/
	var $fld_citytown=array(
							'nr',
							'unece_modifier',
							'unece_locode',
							'name',
							'zip_code',
							'iso_country_id',
							'unece_locode_type',
							'unece_coordinates',
							'info_url',
							'use_frequency',
							'status',
							'history',
							'modify_id',
							'modify_time',
							'create_id',
							'create_time');
									
	/**
	* Constructor
	* @param int Primary key of address record.
	*/
	function Address($nr){
		$this->coretable=$this->tb_citytown;
		$this->ref_array=$this->fld_citytown;
	}
	/**
	* Sets the core table to the table name and field names of care_address_citytown 
	* @access private
	*/
	function _useCityTown(){
		$this->coretable=$this->tb_citytown;
		$this->ref_array=$this->fld_citytown;
	}
	/**
	* Gets all active city town addresses. Returns ADODB record object or boolean.
	* The returned adodb object contains rows of array with index keys 
	* corresponding to $fld_citytown.
	* @access public
	* @return mixed
	*/
	function getAllActiveCityTown(){
		/**
		* @global ADODB-db-link
		*/
	    global $db;
		$this->sql="SELECT * FROM $this->tb_citytown WHERE status NOT IN ('inactive','hidden','deleted','void')";
	    if ($this->res['gaact']=$db->Execute($this->sql)) {
		    if ($this->rec_count=$this->res['gaact']->RecordCount()) {
		        return $this->res['gaact'];
			}else{return FALSE;}
		}else{return FALSE;}
	}
	/**
	* Same as getAllActiveCityTown but uses the limit feature of adodb to limit the number or rows actually returned.
	* Returns ADODB record object or boolean.
	* @param int  Length of data, or number of rows to be returned, default 30 rows
	* @param int Start index offset, default 0 = start index
	* @param string Sort item, default = 'name'
	* @param string Sort direction, default = 'ASC'
	* @return mixed
	*/
	function getLimitActiveCityTown($len=30,$so=0,$oitem='name',$odir='ASC'){
		/**
		* @global ADODB-db-link
		*/
	    global $db;
		$this->sql="SELECT * FROM $this->tb_citytown WHERE status NOT IN ('inactive','hidden','deleted','void') ORDER BY $oitem $odir";
	    if ($this->res['glact']=$db->SelectLimit($this->sql,$len,$so)) {
		    if ($this->rec_count=$this->res['glact']->RecordCount()) {
		        return $this->res['glact'];
			}else{return FALSE;}
		}else{return FALSE;}
	}
	/**
	* Counts all active city town addresses. Rreturns the count, else return zero.
	* @return int 
	*/
	function countAllActiveCityTown(){
		/**
		* @global ADODB-db-link
		*/
	    global $db;
		$this->sql="SELECT nr FROM $this->tb_citytown WHERE status NOT IN ($this->dead_stat)";
	    if ($this->res['caact']=$db->Execute($this->sql)) {
		    return $this->res['caact']->RecordCount();
		}else{return 0;}
	}
	/**
	* Checks if city or town exists based on name and ISO country code keys.
	* @param string Name of the city or town
	* @param string Country ISO code
	* @return boolean
	*/
	function CityTownExists($name='',$country='') {

		/**
		* @global ADODB-db-link
		*/
	    global $db, $sql_LIKE;
	    if(empty($name)) return FALSE;
		$this->sql="SELECT nr FROM $this->tb_citytown WHERE name $sql_LIKE '$name' AND iso_country_id $sql_LIKE '$country'";
	    if($buf=$db->Execute($this->sql)) {
	        if($buf->RecordCount()) {
			    return TRUE;
		    } else { return FALSE; }
	   } else { return FALSE; }
   }
	/**
	* Gets all record information of a city or town based on the record "nr" key. 
	* Returns an ADODB record object or boolean.
	* @param int Record nr (citytown nr) key
	* @return object
	*/
	function getCityTownInfo($nr='') {
		/**
		* @global ADODB-db-link
		*/
	    global $db;
	    //$db->debug=true;
	    if(empty($nr)) return FALSE;
		$this->sql="SELECT * FROM $this->tb_citytown WHERE nr=$nr";
	    if($this->res['gcti']=$db->Execute($this->sql)) {
	        if($this->res['gcti']->RecordCount()) {
			    return $this->res['gcti'];
		    } else { return FALSE; }
	   } else { return FALSE; }
   }
	/**
	* Insert new city/town info in the database table. The data is contained in associative array and passed by reference.
	* The array keys must correspond to the field names contained in $fld_citytown.
	* @param array Data to save. By reference.
	* @return boolean
	*/
	function saveCityTownInfoFromArray(&$data){
		global $_SESSION;
		$this->_useCityTown();
		$this->data_array=$data;
		$this->data_array['status']='normal';
		$this->data_array['history']="Create: ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."\n";
		$this->data_array['modify_id']=$_SESSION['sess_user_name'];
		$this->data_array['create_id']=$_SESSION['sess_user_name'];
		$this->data_array['create_time']='NULL';
		return $this->insertDataFromInternalArray();
	}
	/**
	* Updates the city/town's data. The data is contained in associative array and passed by reference.
	* The array keys must correspond to the field names contained in $fld_citytown. 
	* Only the keys of data to be updated must be present in the passed array.
	* @param int City/town's record nr (primary key)
	* @param array Data passed as reference
	* @return boolean
	*/
	function updateCityTownInfoFromArray($nr,&$data){
		global $_SESSION;
		$this->_useCityTown();
		$this->data_array=$data;
		// remove probable existing array data to avoid replacing the stored data
		if(isset($this->data_array['nr'])) unset($this->data_array['nr']);
		if(isset($this->data_array['create_id'])) unset($this->data_array['create_id']);
		// clear the where condition
		$this->where='';
		$this->data_array['history']=$this->ConcatHistory("Update: ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."\n");
		$this->data_array['modify_id']=$_SESSION['sess_user_name'];
		return $this->updateDataFromInternalArray($nr);
	}
	/**
	* Searches for the active city or town based on a string keyword.
	* Returns an ADODB record object of search results or boolean.
	* @param string Search keyword
	* @return mixed
	*/
   	function searchActiveCityTown($key){
		global $db, $sql_LIKE;
		if(empty($key)) return FALSE;
		$select="SELECT *  FROM $this->tb_citytown ";
		$append=" AND status NOT IN ('inactive','deleted','closed','hidden','void')";
		$this->sql="$select WHERE ( name $sql_LIKE '$key%' OR unece_locode $sql_LIKE '$key%' ) $append";
		if($this->result=$db->Execute($this->sql)){
			if($this->result->RecordCount()){
				return $this->result;
		    }else{	
				$this->sql="$select WHERE ( name $sql_LIKE '%$key' OR unece_locode $sql_LIKE '%$key' ) $append";
				if($this->result=$db->Execute($this->sql)){
					if($this->result->RecordCount()){
						return $this->result;
					}else{
						$this->sql="$select WHERE ( name $sql_LIKE '%$key%' OR unece_locode $sql_LIKE '%$key%' ) $append";
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
	* Limited return search for the active city or town. 
	* Returns an ADODB record object of search results or boolean.
	* @param string Search keyword
	* @param int Maximum number of rows returned, default=30
	* @param int Start index offset, defaut = 0 (start)
	* @param string  Sort order item, default= name
	* @param string  Sort direction, default = ASC
	* @return mixed
	*/
   	function searchLimitActiveCityTown($key,$len=30,$so=0,$oitem='name',$odir='ASC'){
		/**
		* @global ADODB-db-link
		*/
		global $db, $sql_LIKE;
        //$db->debug=true;
		if(empty($key)) return FALSE;
		$select="SELECT *  FROM $this->tb_citytown ";
		$append=" AND status NOT IN ($this->dead_stat) ORDER BY $oitem $odir";
		$this->sql="$select WHERE ( name $sql_LIKE '$key%' OR unece_locode $sql_LIKE '$key%' ) $append";
		if($this->res['slact']=$db->SelectLimit($this->sql,$len,$so)){
			if($this->rec_count=$this->res['slact']->RecordCount()){
				return $this->res['slact'];
		    }else{
				$this->sql="$select WHERE ( name $sql_LIKE '%$key' OR unece_locode $len '%$key' ) $append";
				if($this->res['slact']=$db->SelectLimit($this->sql,$len,$so)){
					if($this->rec_count=$this->res['slact']->RecordCount()){
						return $this->res['slact'];
					}else{
						$this->sql="$select WHERE ( name $sql_LIKE '%$key%' OR unece_locode $sql_LIKE '%$key%' ) $append";
						if($this->res['slact']=$db->SelectLimit($this->sql,$len,$so)){
							if($this->rec_count=$this->res['slact']->RecordCount()){
								return $this->res['slact'];
							}else{return FALSE;}
						}else{return FALSE;}
					}
				}else{return FALSE;}
			}
	   } else { return FALSE; }
   	}
	/**
	* Searches for the active city or town but returns only the total count of the resulting rows.
	* Returns the count value, else returns zero.
	* @param string Search keyword
	* @return int
	*/
   	function searchCountActiveCityTown($key){
		/**
		* @global ADODB-db-link
		*/
		global $db, $sql_LIKE;
		if(empty($key)) return FALSE;
		$select="SELECT nr FROM $this->tb_citytown ";
		$append=" AND status NOT IN ($this->dead_stat)";
		$this->sql="$select WHERE ( name $sql_LIKE '$key%' OR unece_locode $sql_LIKE '$key%' ) $append";
		if($this->res['scact']=$db->Execute($this->sql)){
			if($this->rec_count=$this->res['scact']->RecordCount()){
				return $this->rec_count;
			}else{	
				$this->sql="$select WHERE ( name $sql_LIKE '%$key' OR unece_locode $sql_LIKE '%$key' ) $append";
				if($this->res['scact']=$db->Execute($this->sql)){
					if($this->rec_count=$this->res['scact']->RecordCount()){
						return $this->rec_count;
					}else{
						$this->sql="$select WHERE ( name $sql_LIKE '%$key%' OR unece_locode $sql_LIKE '%$key%' ) $append";
						if($this->res['scact']=$db->Execute($this->sql)){
							if($this->rec_count=$this->res['scact']->RecordCount()){
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
