<?php
/**
* @package care_api
*/
/**
*/
require_once($root_path.'include/care_api_classes/class_core.php');

/**
*  Notes methods.
*  Note: this class should be instantiated only after a "$db" adodb  connector object  has been established by an adodb instance.
* @author Daniele Palmas, Guido Porruvecchio
* @version beta 2.0.1
* @copyright 2002,2003,2004,2005,2005,2006 Elpidio Latorilla
* @package care_api
*/
class YellowPaper extends Core {
	/**
	* Database table for the encounter notes data.
	* @var string
	* @access private
	*/
	var $tb_notes='care_encounter_yellow_paper';
	/**
	* Database table for the encounter data.
	* @var string
	* @access private
	*/
	var $tb_enc='care_encounter';
	/**
	* Holder for sql query results.
	* @var object adodb record object
	* @access private
	*/
	var $result;
	/**
	* Holder for preloaded department data.
	* @var object adodb record object
	* @access private
	*/
	var $preload_dept;
	/**
	* Preloaded flag
	* @var boolean
	* @access private
	*/
	var $is_preloaded=false;
	/**
	* Field names of care_encounter_notes table
	* @var array
	* @access private
	*/
	var $fld_notes=array('nr',
									'encounter_nr',
									'personell_nr',
									'personell_name',
									'location_id',
									'history',
									'modify_id',
									'modify_time',
									'create_id',
									'create_time',
									'sunto_anamnestico',
									'stato_presente',
									'altezza',
									'peso',
									'norm',
									'dati_urine',
									'dati_sangue',
									'dati_altro',
									'diagnosi',
									'terapia',
									'malattie_ereditarie',
									'padre',
									'madre',
									'fratelli',
									'coniuge',
									'figli',
									'paesi_esteri',
									'abitazione',
									'lavoro_pregresso',
									'lavoro_presente',
									'lavoro_attuale',
									'ambiente_lavoro',
									'gas_lavoro',
									'tossiche_lavoro',
									'conviventi',
									'prematuro',
									'eutocico',
									'fisiologici_normali',
									'fisiologici_tardivi',
									'mestruazione',
									'gravidanze',
									'militare',
									'alcolici',
									'caffe',
									'fumo',
									'droghe',
									'sete',
									'alvo',
									'diuresi',
									'anamnesi_remota',
									'anamnesi_prossima');
	/**
	* Constructor
	*/			
	function YellowPaper(){
		$this->setTable($this->tb_notes);
		$this->setRefArray($this->fld_notes);
	}
	/**
	* Checks if a certain notes record of a certain type exists in the database.
	* @access private
	* @param int Encounter number
	* @param int Notes type number
	* @return boolean
	*/			
	function _Exists($enr,$type_nr){
		if($this->_RecordExists("encounter_nr=$enr")){
			return true;
		}else{return false;}
	}
	/**
	* Gets all types of notes record. Sorted result.
	* @access public
	* @param string Sort item
	* @return mixed 2 dimensional array or boolean
			
	function getAllTypesSort($sort=''){
	    global $db;
	
		if(empty($sort)) $sort=" ORDER BY nr";
			else $sort=" ORDER BY $sort";
	    if ($this->result=$db->Execute("SELECT nr,type,name,LD_var AS \"LD_var\" FROM $this->tb_types  $sort")) {
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
	*/
	/**
	* Gets all types of notes record. Unsorted result.
	* @access public
	* @param string Sort item
	* @return mixed 2 dimensional array or boolean
				
	function getAllTypes(){
		return $this->getAllTypesSort();
	}
	*/
	/**
	* Gets notes type information based on the type number (nr key).
	*
	* The returned array has 4 elements:
	* - nr  = The type number (integer).
	* - type  = The optional type id (alphanumeric).
	* - name = The name of the notes type.
	* - LD_var  = The name of the language dependent variable containing the foreign name of the notes type.
	*
	* @access public
	* @return mixed 1 dimensional array or boolean			
	function getType($nr=1){
	    global $db;

	    if ($this->res['gt']=$db->Execute("SELECT nr,type,name,LD_var AS \"LD_var\" FROM $this->tb_types WHERE nr=$nr")) {
		    if ($this->res['gt']->RecordCount()) {
		        return $this->res['gt']->FetchRow();
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
	* Gets a notes record data based on a passed condition.
	* @access private
	* @param string Condition for the WHERE sql part. Query constraint.
	* @param string Sort directive in complete syntax e.g. "ORDER BY date DESC"
	* @return mixed adodb record object or boolean
	*/			
	function _getNotes($cond,$order='ORDER BY create_time DESC'){
	    global $db;
		$this->sql="SELECT * FROM $this->tb_notes WHERE $cond $order";
		//echo $this->sql;
	    if ($this->result=$db->Execute($this->sql)) {
		    if ($this->result->RecordCount()) {
		        //return true;
		        return $this->result;
			}else{return false;}
		}else{return false;}
	}
	/**
	* Save a notes data of a given type number.
	*
	* The data to be saved comes from an internal buffer array that is populated by other methods.
	* @access private
	* @param string Type number of the notes data to be saved.
	* @return boolean
	*/
	function _insertNotesFromInternalArray($type_nr=''){
		global $_SESSION;
		//if(empty($this->data_array['date'])) $this->data_array['date']=date('Y-m-d');
		//if(empty($this->data_array['time'])) $this->data_array['time']=date('H:i:s');
		//$this->data_array['type_nr']=$type_nr;
		//$this->data_array['modify_id']=$_SESSION['sess_user_name'];
		$this->data_array['create_id']=$_SESSION['sess_user_name'];
		$this->data_array['create_time']=date('YmdHis');
		$this->data_array['history']="Create: ".date('Y-m-d H-i-s')." ".$_SESSION['sess_user_name']."\n\r";	
        	return $this->insertDataFromInternalArray();
	}
	/**
	* Updates a notes data record based on the primary record key "nr".
	*
	* The data to be saved comes from an internal buffer array that is populated by other methods.
	* @access private
	* @param int Record number of the notes record to be updated.
	* @return boolean
	*/			
	function _updateNotesFromInternalArray($nr){
		global $_SESSION;
		$this->data_array['modify_id']=$_SESSION['sess_user_name'];
		$this->data_array['modify_time']=date('YmdHis');
		$this->data_array['history']=$this->ConcatHistory("Update: ".date('Y-m-d H-i-s')." ".$_SESSION['sess_user_name']."\n\r");
		return $this->updateDataFromInternalArray($nr);
		/*
		if($this->updateDataFromInternalArray($nr)){
			return true;
		}else{ return false; }
		*/
	}
	/**
	* Gets the date range of a certain notes type that fits to a given condition.
	*
	* The resulting adodb record object is stored in the internal buffer $result.
	* @access private
	* @param int Encounter number
	* @param int Notes type number
	* @param string Condition string. Query constraint.
	* @return boolean			
	function _getNotesDateRange($enr='',$type_nr=0,$cond=''){
		global $db;
		if(empty($enr)){
			return false;
		}else{
			if(empty($cond) && $type_nr){
				$cond="encounter_nr=$enr AND type_nr=$type_nr";
			}
			$this->sql="SELECT MIN(date) AS fe_date, MAX(date) AS le_date FROM $this->tb_notes WHERE $cond";
			if($this->result=$db->Execute($this->sql)){
				if($this->result->RecordCount()){
					return true;
				}else{return false;}
			}else{return false;}
		}
	}
	*/
	/**
	*Gets all notes of a given record number.
	* @access public
	* @param int Record number
	* @return mixed adodb record object or boolean
	*/
	function getEncounterNotes($nr){
		return $this->_getNotes("nr=$nr AND status NOT IN ($this->dead_stat)",'');
	}
	
	function saveDailyWardNotes(&$data){
		$buf;	
		if(empty($data)){
			return false;
		}else{
			$this->data_array=$data;
			$this->data_array['encounter_nr']=$data['pn'];
			$this->data_array['location_id']=$data['station'];
			$this->data_array['personell_name']=$data['personell_name'];
			$this->data_array['sunto_anamnestico']=$data['sunto_anamnestico'];
			$this->data_array['stato_presente']=$data['stato_presente'];
			$this->data_array['altezza']=$data['altezza'];
			$this->data_array['peso']=$data['peso'];
			$this->data_array['norm']=$data['norm'];
			$this->data_array['dati_urine']=$data['dati_urine'];
			$this->data_array['dati_sangue']=$data['dati_sangue'];
			$this->data_array['dati_altro']=$data['dati_altro'];
			$this->data_array['diagnosi']=$data['diagnosi'];
			$this->data_array['terapia']=$data['terapia'];
			$this->data_array['malattie_ereditarie']=$data['malattie_ereditarie'];
			$this->data_array['padre']=$data['padre'];
			$this->data_array['madre']=$data['madre'];
			$this->data_array['fratelli']=$data['fratelli'];
			$this->data_array['coniuge']=$data['coniuge'];
			$this->data_array['figli']=$data['figli'];
			$this->data_array['paesi_esteri']=$data['paesi_esteri'];
			$this->data_array['abitazione']=$data['abitazione'];
			$this->data_array['lavoro_pregresso']=$data['lavoro_pregresso'];
			$this->data_array['lavoro_presente']=$data['lavoro_presente'];
			$this->data_array['lavoro_attuale']=$data['lavoro_attuale'];
			$this->data_array['ambiente_lavoro']=$data['ambiente_lavoro'];
			$this->data_array['gas_lavoro']=$data['gas_lavoro'];
			$this->data_array['tossiche_lavoro']=$data['tossiche_lavoro'];
			$this->data_array['conviventi']=$data['conviventi'];
			$this->data_array['prematuro']=$data['prematuro'];
			$this->data_array['eutocico']=$data['eutocico'];
			$this->data_array['fisiologici_normali']=$data['fisiologici_normali'];
			$this->data_array['fisiologici_tardivi']=$data['fisiologici_tardivi'];
			$this->data_array['mestruazione']=$data['mestruazione'];
			$this->data_array['gravidanze']=$data['gravidanze'];
			$this->data_array['militare']=$data['militare'];
			$this->data_array['alcolici']=$data['alcolici'];
			$this->data_array['caffe']=$data['caffe'];
			$this->data_array['fumo']=$data['fumo'];
			$this->data_array['droghe']=$data['droghe'];
			$this->data_array['sete']=$data['sete'];
			$this->data_array['alvo']=$data['alvo'];
			$this->data_array['diuresi']=$data['diuresi'];
			$this->data_array['anamnesi_remota']=$data['anamnesi_remota'];
			$this->data_array['anamnesi_prossima']=$data['anamnesi_prossima'];
			return $this->_insertNotesFromInternalArray('');
		}
	}
	
	function updateDailyWardNotes(&$data){
		$buf;	
		if(empty($data)){
			return false;
		}else{
			$this->data_array=$data;
			$this->data_array['encounter_nr']=$data['pn'];
			$this->data_array['location_id']=$data['station'];
			$this->data_array['personell_name']=$data['personell_name'];
			$this->data_array['sunto_anamnestico']=$data['sunto_anamnestico'];
			$this->data_array['stato_presente']=$data['stato_presente'];
			$this->data_array['altezza']=$data['altezza'];
			$this->data_array['peso']=$data['peso'];
			$this->data_array['norm']=$data['norm'];
			$this->data_array['dati_urine']=$data['dati_urine'];
			$this->data_array['dati_sangue']=$data['dati_sangue'];
			$this->data_array['dati_altro']=$data['dati_altro'];
			$this->data_array['diagnosi']=$data['diagnosi'];
			$this->data_array['terapia']=$data['terapia'];
			$this->data_array['malattie_ereditarie']=$data['malattie_ereditarie'];
			$this->data_array['padre']=$data['padre'];
			$this->data_array['madre']=$data['madre'];
			$this->data_array['fratelli']=$data['fratelli'];
			$this->data_array['coniuge']=$data['coniuge'];
			$this->data_array['figli']=$data['figli'];
			$this->data_array['paesi_esteri']=$data['paesi_esteri'];
			$this->data_array['abitazione']=$data['abitazione'];
			$this->data_array['lavoro_pregresso']=$data['lavoro_pregresso'];
			$this->data_array['lavoro_presente']=$data['lavoro_presente'];
			$this->data_array['lavoro_attuale']=$data['lavoro_attuale'];
			$this->data_array['ambiente_lavoro']=$data['ambiente_lavoro'];
			$this->data_array['gas_lavoro']=$data['gas_lavoro'];
			$this->data_array['tossiche_lavoro']=$data['tossiche_lavoro'];
			$this->data_array['conviventi']=$data['conviventi'];
			$this->data_array['prematuro']=$data['prematuro'];
			$this->data_array['eutocico']=$data['eutocico'];
			$this->data_array['fisiologici_normali']=$data['fisiologici_normali'];
			$this->data_array['fisiologici_tardivi']=$data['fisiologici_tardivi'];
			$this->data_array['mestruazione']=$data['mestruazione'];
			$this->data_array['gravidanze']=$data['gravidanze'];
			$this->data_array['militare']=$data['militare'];
			$this->data_array['alcolici']=$data['alcolici'];
			$this->data_array['caffe']=$data['caffe'];
			$this->data_array['fumo']=$data['fumo'];
			$this->data_array['droghe']=$data['droghe'];
			$this->data_array['sete']=$data['sete'];
			$this->data_array['alvo']=$data['alvo'];
			$this->data_array['diuresi']=$data['diuresi'];
			$this->data_array['anamnesi_remota']=$data['anamnesi_remota'];
			$this->data_array['anamnesi_prossima']=$data['anamnesi_prossima'];
			return $this->_updateNotesFromInternalArray($data['nr']);
		}
	}
	
	function getDailyWardNotes($enr){
		if($this->_getNotes("encounter_nr=$enr","")){
			return $this->result;
		}else{
			return false;
		}
	}
}
?>

