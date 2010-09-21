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
class Target extends Core {
	/**
	* Database table for the encounter notes data.
	* @var string
	* @access private
	*/
	var $tb_notes='care_target_test';
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
									'costitution_type',
									'condizioni_generali',
									'stato_nutrizione',
									'decubito',
									'psiche',
									'cute',
									'descrizione_mucose',
									'annessi_cutanei',
									'edemi',
									'sottocutaneo_descrizione',
									'temperatura',
									'polso_battiti',
									'polso',
									'pressione_max',
									'pressione_min',
									'linfoghiandolare_descrizione',
									'capo_descrizione',
									'globi_oculari',
									'sclere_descrizione',
									'pupille',
									'riflesso_corneale',
									'orecchie',
									'naso',
									'cavo_orofaringeo',
									'lingua',
									'dentatura',
									'tonsille',
									'collo_forma',
									'mobilita',
									'atteggiamento',
									'giugulari_turgide',
									'tiroide_normale',
									'collo_descrizione',
									'mammelle',
									'torace_forma',
									'reperti_torace',
									'ispezione_respiratoria',
									'palpazione_respiratoria',
									'percussione_respiratoria',
									'ascoltazione_respiratoria',
									'reperti_respiratoria',
									'fegato_descrizione',
									'epatomegalia',
									'murphy',
									'colecisti_palpabile',
									'reperti_fegato',
									'milza_descrizione',
									'reperti_milza',
									'urogenitale_descrizione',
									'esplorazione_vaginale',
									'reperti_genitale',
									'osteoarticolare_descrizione',
									'muscolare_descrizione',
									'reperti_muscolare',
									'nervoso_descrizione',
									'nervi_cranici',
									'riflessi_superficiali',
									'reperti_nervoso',
									'ispezione_cuore',
									'palpazione_cuore',
									'percussione_cuore',
									'ascoltazione_cuore',
									'reperti_cuore',
									'vasi_periferici_descrizione',
									'arterie',
									'vene',
									'reperti_vasi',
									'addome_descrizione',
									'addome_ispezione',
									'addome_palpazione',
									'addome_percussione',
									'addome_ascoltazione',
									'rettale',
									'reperti_addome');
	/**
	* Constructor
	*/			
	function Target(){
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
			$this->data_array['costitution_type']=$data['costitution_type'];
			$this->data_array['condizioni_generali']=$data['condizioni_generali'];
			$this->data_array['stato_nutrizione']=$data['stato_nutrizione'];
			$this->data_array['decubito']=$data['decubito'];
			$this->data_array['psiche']=$data['psiche'];
			$this->data_array['cute']=$data['cute'];
			$this->data_array['descrizione_mucose']=$data['descrizione_mucose'];
			$this->data_array['annessi_cutanei']=$data['annessi_cutanei'];
			$this->data_array['edemi']=$data['edemi'];
			$this->data_array['sottocutaneo_descrizione']=$data['sottocutaneo_descrizione'];
			$this->data_array['temperatura']=$data['temperatura'];
			$this->data_array['polso_battiti']=$data['polso_battiti'];
			$this->data_array['polso']=$data['polso'];
			$this->data_array['pressione_max']=$data['pressione_min'];
			$this->data_array['linfoghiandolare_descrizione']=$data['linfoghiandolare_descrizione'];
			$this->data_array['capo_descrizione']=$data['capo_descrizione'];
			$this->data_array['globi_oculari']=$data['globi_oculari'];
			$this->data_array['sclere_descrizione']=$data['sclere_descrizione'];
			$this->data_array['pupille']=$data['pupille'];
			$this->data_array['riflesso_corneale']=$data['riflesso_corneale'];
			$this->data_array['orecchie']=$data['orecchie'];
			$this->data_array['naso']=$data['naso'];
			$this->data_array['cavo_orofaringeo']=$data['cavo_orofaringeo'];
			$this->data_array['lingua']=$data['lingua'];
			$this->data_array['dentatura']=$data['dentatura'];
			$this->data_array['tonsille']=$data['tonsille'];
			$this->data_array['collo_forma']=$data['collo_forma'];
			$this->data_array['mobilita']=$data['mobilita'];
			$this->data_array['atteggiamento']=$data['atteggiamento'];
			$this->data_array['giugulari_turgide']=$data['giugulari_turgide'];
			$this->data_array['tiroide_normale']=$data['tiroide_normale'];
			$this->data_array['collo_descrizione']=$data['collo_descrizione'];
			$this->data_array['torace_forma']=$data['torace_forma'];
			$this->data_array['mammelle']=$data['mammelle'];
			$this->data_array['reperti_torace']=$data['reperti_torace'];
			$this->data_array['ispezione_respiratoria']=$data['ispezione_respiratoria'];
			$this->data_array['palpazione_respiratoria']=$data['palpazione_respiratoria'];
			$this->data_array['percussione_respiratoria']=$data['percussione_respiratoria'];
			$this->data_array['ascoltazione_respiratoria']=$data['ascoltazione_respiratoria'];
			$this->data_array['reperti_respiratoria']=$data['reperti_respiratoria'];
			$this->data_array['fegato_descrizione']=$data['fegato_descrizione'];
			$this->data_array['epatomegalia']=$data['epatomegalia'];
			$this->data_array['murphy']=$data['murphy'];
			$this->data_array['colecisti_palpabile']=$data['colecisti_palpabile'];
			$this->data_array['reperti_fegato']=$data['reperti_fegato'];
			$this->data_array['milza_descrizione']=$data['milza_descrizione'];
			$this->data_array['reperti_milza']=$data['reperti_milza'];
			$this->data_array['urogenitale_descrizione']=$data['urogenitale_descrizione'];
			$this->data_array['esplorazione_vaginale']=$data['esplorazione_vaginale'];
			$this->data_array['reperti_genitale']=$data['reperti_genitale'];
			$this->data_array['osteoarticolare_descrizione']=$data['osteoarticolare_descrizione'];
			$this->data_array['muscolare_descrizione']=$data['muscolare_descrizione'];
			$this->data_array['reperti_muscolare']=$data['reperti_muscolare'];
			$this->data_array['nervoso_descrizione']=$data['nervoso_descrizione'];
			$this->data_array['nervi_cranici']=$data['nervi_cranici'];
			$this->data_array['riflessi_superficiali']=$data['riflessi_superficiali'];
			$this->data_array['reperti_nervoso']=$data['reperti_nervoso'];
			$this->data_array['ispezione_cuore']=$data['ispezione_cuore'];
			$this->data_array['palpazione_cuore']=$data['palpazione_cuore'];
			$this->data_array['percussione_cuore']=$data['percussione_cuore'];
			$this->data_array['ascoltazione_cuore']=$data['ascoltazione_cuore'];
			$this->data_array['reperti_cuore']=$data['reperti_cuore'];
			$this->data_array['vasi_periferici_descrizione']=$data['vasi_periferici_descrizione'];
			$this->data_array['arterie']=$data['arterie'];
			$this->data_array['vene']=$data['vene'];
			$this->data_array['reperti_vasi']=$data['reperti_vasi'];
			$this->data_array['addome_descrizione']=$data['addome_descrizione'];
			$this->data_array['addome_ispezione']=$data['addome_ispezione'];
			$this->data_array['addome_palpazione']=$data['addome_palpazione'];
			$this->data_array['addome_percussione']=$data['addome_percussione'];
			$this->data_array['addome_ascoltazione']=$data['addome_ascoltazione'];
			$this->data_array['rettale']=$data['rettale'];
			$this->data_array['reperti_addome']=$data['reperti_addome'];
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
			
			$this->data_array['costitution_type']=$data['costitution_type'];
			$this->data_array['condizioni_generali']=$data['condizioni_generali'];
			$this->data_array['stato_nutrizione']=$data['stato_nutrizione'];
			$this->data_array['decubito']=$data['decubito'];
			$this->data_array['psiche']=$data['psiche'];
			$this->data_array['cute']=$data['cute'];
			$this->data_array['descrizione_mucose']=$data['descrizione_mucose'];
			$this->data_array['annessi_cutanei']=$data['annessi_cutanei'];
			$this->data_array['edemi']=$data['edemi'];
			$this->data_array['sottocutaneo_descrizione']=$data['sottocutaneo_descrizione'];
			$this->data_array['temperatura']=$data['temperatura'];
			$this->data_array['polso_battiti']=$data['polso_battiti'];
			$this->data_array['polso']=$data['polso'];
			$this->data_array['pressione_max']=$data['pressione_min'];
			$this->data_array['linfoghiandolare_descrizione']=$data['linfoghiandolare_descrizione'];
			$this->data_array['capo_descrizione']=$data['capo_descrizione'];
			$this->data_array['globi_oculari']=$data['globi_oculari'];
			$this->data_array['sclere_descrizione']=$data['sclere_descrizione'];
			$this->data_array['pupille']=$data['pupille'];
			$this->data_array['riflesso_corneale']=$data['riflesso_corneale'];
			$this->data_array['orecchie']=$data['orecchie'];
			$this->data_array['naso']=$data['naso'];
			$this->data_array['cavo_orofaringeo']=$data['cavo_orofaringeo'];
			$this->data_array['lingua']=$data['lingua'];
			$this->data_array['dentatura']=$data['dentatura'];
			$this->data_array['tonsille']=$data['tonsille'];
			$this->data_array['collo_forma']=$data['collo_forma'];
			$this->data_array['mobilita']=$data['mobilita'];
			$this->data_array['atteggiamento']=$data['atteggiamento'];
			$this->data_array['giugulari_turgide']=$data['giugulari_turgide'];
			$this->data_array['tiroide_normale']=$data['tiroide_normale'];
			$this->data_array['collo_descrizione']=$data['collo_descrizione'];
			$this->data_array['torace_forma']=$data['torace_forma'];
			$this->data_array['mammelle']=$data['mammelle'];
			$this->data_array['reperti_torace']=$data['reperti_torace'];
			$this->data_array['ispezione_respiratoria']=$data['ispezione_respiratoria'];
			$this->data_array['palpazione_respiratoria']=$data['palpazione_respiratoria'];
			$this->data_array['percussione_respiratoria']=$data['percussione_respiratoria'];
			$this->data_array['ascoltazione_respiratoria']=$data['ascoltazione_respiratoria'];
			$this->data_array['reperti_respiratoria']=$data['reperti_respiratoria'];
			$this->data_array['fegato_descrizione']=$data['fegato_descrizione'];
			$this->data_array['epatomegalia']=$data['epatomegalia'];
			$this->data_array['murphy']=$data['murphy'];
			$this->data_array['colecisti_palpabile']=$data['colecisti_palpabile'];
			$this->data_array['reperti_fegato']=$data['reperti_fegato'];
			$this->data_array['milza_descrizione']=$data['milza_descrizione'];
			$this->data_array['reperti_milza']=$data['reperti_milza'];
			$this->data_array['urogenitale_descrizione']=$data['urogenitale_descrizione'];
			$this->data_array['esplorazione_vaginale']=$data['esplorazione_vaginale'];
			$this->data_array['reperti_genitale']=$data['reperti_genitale'];
			$this->data_array['osteoarticolare_descrizione']=$data['osteoarticolare_descrizione'];
			$this->data_array['muscolare_descrizione']=$data['muscolare_descrizione'];
			$this->data_array['reperti_muscolare']=$data['reperti_muscolare'];
			$this->data_array['nervoso_descrizione']=$data['nervoso_descrizione'];
			$this->data_array['nervi_cranici']=$data['nervi_cranici'];
			$this->data_array['riflessi_superficiali']=$data['riflessi_superficiali'];
			$this->data_array['reperti_nervoso']=$data['reperti_nervoso'];
			$this->data_array['ispezione_cuore']=$data['ispezione_cuore'];
			$this->data_array['palpazione_cuore']=$data['palpazione_cuore'];
			$this->data_array['percussione_cuore']=$data['percussione_cuore'];
			$this->data_array['ascoltazione_cuore']=$data['ascoltazione_cuore'];
			$this->data_array['reperti_cuore']=$data['reperti_cuore'];
			$this->data_array['vasi_periferici_descrizione']=$data['vasi_periferici_descrizione'];
			$this->data_array['arterie']=$data['arterie'];
			$this->data_array['vene']=$data['vene'];
			$this->data_array['reperti_vasi']=$data['reperti_vasi'];
			$this->data_array['addome_descrizione']=$data['addome_descrizione'];
			$this->data_array['addome_ispezione']=$data['addome_ispezione'];
			$this->data_array['addome_palpazione']=$data['addome_palpazione'];
			$this->data_array['addome_percussione']=$data['addome_percussione'];
			$this->data_array['addome_ascoltazione']=$data['addome_ascoltazione'];
			$this->data_array['rettale']=$data['rettale'];
			$this->data_array['reperti_addome']=$data['reperti_addome'];
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