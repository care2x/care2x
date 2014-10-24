<?php
/**
* @package care_api
*/

/**
*/
require_once($root_path.'include/care_api_classes/class_encounter.php');
/**
* DRG = Diagnosis related groups.
* Methods for Diagnosis and Procedure codes (ICD and OPS)
* Note this class should be instantiated only after a "$db" adodb  connector object
* has been established by an adodb instance
* @author Elpidio Latorilla
* @version beta 2.0.1
* @copyright 2002,2003,2004,2005,2005 Elpidio Latorilla
* @package care_api
*/
class DRG extends Encounter{
	/**
	* Table name for diagnosis data
	* @var string
	*/
	var $tb_diagnosis='care_encounter_diagnosis';
	/**
	* Table name for procedure data
	* @var string
	*/
	var $tb_procedure='care_encounter_procedure';
	/**
	* Table name for local diagnosis code data
	* @var string
	*/
	var $tb_localcode='care_diagnosis_localcode';
	/**
	* Table name for internal grouping code
	* @var string
	*/
	var $tb_intern='care_drg_ops_intern';
	/**
	* Table name for drg codes quicklist
	* @var string
	*/
	var $tb_qlist='care_drg_quicklist';
	/**
	* Table name for drg related codes
	* @var string
	*/
	var $tb_related='care_drg_related_codes';		
	/**
	* Table name for diagnosis categories
	* @var string
	*/
	var $tb_cat_diag='care_category_diagnosis';
	/**
	* Table name for procedure categories
	* @var string
	*/
	var $tb_cat_proc='care_category_procedure';
	/**
	* Table name for localization types
	* @var string
	*/
	var $tb_type_loc='care_type_localization';
	/**
	* Table name for internal drg code  of an encounter
	* @var string
	*/
	var $tb_enc_drg='care_encounter_drg_intern';
	/**
	* Table name for internal drg codes
	* @var string
	*/
	var $tb_drg='care_drg_intern';
	/**
	* Current department number
	* @var int
	*/
	var $dept_nr;
	/**
	* Maximum rows returned by sql search
	* @var int
	*/
	var $sel_limit=50;
	/**
	* Field names of care_encounter_diagnosis table
	* @var array
	*/
	var $fld_diagnosis=array(
			'diagnosis_nr',
			'encounter_nr',
			'op_nr',
			'date',
			'code',
			'code_parent',
			'group_nr',
			'code_version',
			'localcode',
			'category_nr',
			'type',
			'localization',
			'diagnosing_clinician',
			'diagnosing_dept_nr',
			'status',
			'history',
			'modify_id',
			'modify_time',
			'create_id',
			'create_time');
	/**
	* Field names of care_encounter_procedure table
	* @var array
	*/
	var $fld_procedure=array(
			'procedure_nr',
			'encounter_nr',
			'op_nr',
			'date',
			'code',
			'code_parent',
			'group_nr',
			'code_version',
			'localcode',
			'category_nr',
			'localization',
			'responsible_clinician',
			'responsible_dept_nr',
			'status',
			'history',
			'modify_id',
			'modify_time',
			'create_id',
			'create_time');
	/**
	* Field names of care_encounter_drg_intern table
	* @var array
	*/
	var $fld_enc_drg=array(
			'nr',
			'encounter_nr',
			'date',
			'group_nr',
			'clinician',
			'dept_nr',
			'status',
			'history',
			'modify_id',
			'modify_time',
			'create_id',
			'create_time');
	/**
	* Field names of care_drg_intern table
	* @var array
	*/
	var $fld_drg=array(
			'nr',
			'code',
			'description',
			'synonyms',
			'notes',
			'std_code',
			'sub_level',
			'parent_code',
			'status',
			'history',
			'modify_id',
			'modify_time',
			'create_id',
			'create_time');
	/**
	* Field names of care_drg_quicklist table
	* @var array
	*/
	var $fld_qlist=array(
				'nr',
				'code',
				'code_parent',
				'dept_nr',
				'qlist_type',
				'rank',
				'status',
				'history',
				'modify_id',
				'modify_time',
				'create_id',
				'create_time');
	/**
	* ICD version
	* @var string
	*/
	var $icd_version='10'; // default ICD version nr.
	/**
	* OPS version
	* @var string
	*/
	var $ops_version='301'; // default OPS/ICPM version nr.
	/**
	* Holder for diagnosis codes table name
	* @var string
	*/
	var $tb_diag_codes;
	/**
	* Holder for procedure codes table name
	* @var string
	*/
	var $tb_proc_codes;
	/**
	* Default ICD table name. The default table must be existing in your database!
	* @var string
	*/
	var $tb_icd_default='care_icd10_sq';
	/**
	* Default OPS table name. The default table must be existing in your database!
	* @var string
	*/
	var $tb_icpm_default='care_ops301_sq';
	/**
	* Language codes that have corresponding ICD tables
	* @var string
	*/
	var $tb_lang_icd='en,de,pt-br,es,bs,bg,tr,sq';
	/**
	* Language codes that have corresponding OPS/ICPM tables
	* @var string
	*/
	var $tb_lang_icpm='en,de,es,it,sq';
	/**
	* Constructor.
	*
	* @param int Encounter number
	* @param int Department number
	*/
	function DRG($enc_nr=0,$dept_nr=0){
		global $lang;
		$this->enc_nr=$enc_nr;
		$this->dept_nr=$dept_nr;
		$this->coretable=$this->tb_diagnosis;
		$this->ref_array=$this->fld_diagnosis;
		
		# convert the dashes to underscores in the language code
		$intlang=strtr($lang,'-','_');
		
		# Check if language has a corresponding table. if not use default table
		if(stristr($this->tb_lang_icd,$lang)){
			$this->tb_diag_codes='care_icd'.$this->icd_version.'_'.$intlang; # construct the code source table e.g. "care_icd10_en"
		}else{
			$this->tb_diag_codes=$this->tb_icd_default;
		}

		if(stristr($this->tb_lang_icpm,$lang)){
			$this->tb_proc_codes='care_ops'.$this->ops_version.'_'.$intlang; # construct the code source table e.g. "care_ops301_en"
		}else{
			$this->tb_proc_codes=$this->tb_icpm_default;
		}
		//$this->tb_proc_codes='care_ops'.$this->ops_version.'_'.$lang; // construct the procedure source table e.g. "care_ops302_en"
		//$this->tb_proc_codes='care_ops'.$this->ops_version.'_de'; # construct the procedure source table "care_ops302_de" because it is the only available
	}
	/**
	* Sets the core object to point to the encounter's diagnosis (care_encounter_diagnosis) table and fields
	* @access public
	*/
	function useDiagnosis(){
		$this->coretable=$this->tb_diagnosis;
		$this->ref_array=$this->fld_diagnosis;
	}
	/**
	* Sets the core object to point to the encounter's procedure (care_encounter_procedure) table and fields
	* @access public
	*/
	function useProcedure(){
		$this->coretable=$this->tb_procedure;
		$this->ref_array=$this->fld_procedure;
	}
	/**
	* Sets the core object to point to the local encounter DRG groups (care_encounter_drg_intern) table and fields
	* @access public
	*/
	function useInternalDRG(){
		$this->coretable=$this->tb_enc_drg;
		$this->ref_array=$this->fld_enc_drg;
	}
	/**
	* Sets the core object to point to the internal DRG groups (care_drg_intern) table and fields
	* @access public
	*/
	function useInternalDRGCodes(){
		$this->coretable=$this->tb_drg;
		$this->ref_array=$this->fld_drg;
	}
	/**
	* Sets the core object to point to the quick list (care_drg_quicklist) table and fields
	* @access public
	*/
	function useQuicklistCodes(){
		$this->coretable=$this->tb_qlist;
		$this->ref_array=$this->fld_qlist;
	}
	/**
	* Returns the ICD code version (Diagnosis codes)
	* @access public
	* @return string
	*/
	function ICDVersion(){
		return $this->icd_version;
	}
	/**
	* Returns the OPS code version (Procedure codes)
	* @access public
	* @return string
	*/
	function OPSVersion(){
		return $this->ops_version;
	}
	/**
	* Gets the diagnosis codes of an encounter
	* @param int Internal DRG Code group number
	* @param int Encounter number
	* return mixed ADODB record object or boolean
	*/
	function DiagnosisCodes($grp_nr=0,$enc_nr=0){
	    global $db;
		if(!$this->internResolveEncounterNr($enc_nr)) return FALSE;
		/*
		$this->sql="SELECT d.*,c.description , m.description AS parent_desc,
								cat.LD_var AS \"cat_LD_var\", cat.LD_var_short_code AS \"cat_LD_var_short_code\", cat.short_code AS cat_short_code, cat.name AS cat_name,
								loc.LD_var AS \"loc_LD_var\", loc.LD_var_short_code AS \"loc_LD_var_short_code\", loc.short_code AS loc_short_code,loc.name AS loc_name

							FROM 	$this->tb_diagnosis AS d
									LEFT JOIN $this->tb_diag_codes AS c ON d.code=c.diagnosis_code
									 LEFT JOIN $this->tb_diag_codes AS m ON d.code_parent=m.diagnosis_code AND d.code_parent NOT IN ('',' ')
									 LEFT JOIN $this->tb_cat_diag AS cat ON d.category_nr=cat.nr
									 LEFT JOIN $this->tb_type_loc AS loc ON d.localization=loc.nr
									 WHERE d.encounter_nr='$this->enc_nr'
									 	AND d.group_nr='$grp_nr'
									 	AND d.status NOT IN ($this->dead_stat)
										ORDER BY d.category_nr,d.date";
			*/
			$this->sql="SELECT d.*,c.description , m.description AS parent_desc
							FROM  $this->tb_diagnosis AS d
									LEFT JOIN $this->tb_diag_codes AS c ON d.code=c.diagnosis_code
									 LEFT JOIN $this->tb_diag_codes AS m ON d.code_parent=m.diagnosis_code AND d.code_parent NOT IN ('',' ')
									 WHERE d.encounter_nr='$this->enc_nr'
									 	AND d.group_nr='$grp_nr'
									 	AND d.status NOT IN ($this->dead_stat)
										ORDER BY d.category_nr,d.date";

		//echo $this->sql;
		if($this->result=$db->Execute($this->sql)) {
		    if($this->result->RecordCount()) {
				return $this->result;
		    } else { return FALSE;}
		} else { return FALSE;}
	}
	/**
	* Gets the procedure codes of an encounter
	* @param int Internal DRG Code group number
	* @param int Encounter number
	* return mixed ADODB record object or boolean
	*/
	function ProcedureCodes($grp_nr=0,$enc_nr=0){
	    global $db;

		if(!$this->internResolveEncounterNr($enc_nr)) return FALSE;
		$this->sql="SELECT p.*, c.description, m.description AS parent_desc
							FROM
										$this->tb_proc_codes AS c,
										$this->tb_procedure AS p
									 LEFT JOIN $this->tb_proc_codes AS m ON p.code_parent=m.code
									 WHERE p.encounter_nr='$this->enc_nr' 
									 	AND p.group_nr='$grp_nr'
									 	AND p.status NOT IN ($this->dead_stat)
										AND  p.code=c.code ORDER BY p.category_nr, p.date";
		//echo $sql;
		if($this->result=$db->Execute($this->sql)) {
		    if($this->result->RecordCount()) {
				return $this->result;
		    } else { return FALSE;}
		} else { return FALSE;}
	}
	/**
	* Gets the internal DRG groups of an encounter
	* @param int Encounter number
	* return mixed ADODB record object or boolean
	*/
	function InternDRGGroups($enc_nr){
	    global $db;
		if(!$this->internResolveEncounterNr($enc_nr)) return FALSE;
		$this->sql="SELECT e.*, d.code,d.description,d.notes
							FROM  $this->tb_enc_drg AS e, $this->tb_drg AS d
									 WHERE e.encounter_nr=$this->enc_nr 
									 	AND e.status NOT IN ($this->dead_stat)
										AND  e.group_nr=d.nr ORDER BY e.date";
		//echo $this->sql;
		if($this->result=$db->Execute($this->sql)) {
		    if($this->result->RecordCount()) {
				return $this->result;
		    } else { return FALSE;}
		} else { return FALSE;}
	}
	/**
	* "Deletes" a diagnosis code record entry.
	* The entry is  not actually deleted from the table but its status is set to "deleted".
	* @param int Diagnosis code record entry number 
	* @return boolean
	*/
	function deleteDiagnosis($diag_nr=0){
	    global $db, $_SESSION;
		if(!$diag_nr) return FALSE;
		$this->sql="UPDATE $this->tb_diagnosis
						SET status='deleted',history=".$this->ConcatHistory("Delete ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."\n").",
						modify_id='".$_SESSION['sess_user_name']."'			
						 WHERE diagnosis_nr=$diag_nr";
		//echo $sql;
		return $this->Transact($this->sql);
	}
	/**
	* "Deletes" a procedure code record entry.
	* The entry is  not actually deleted from the table but its status is set to "deleted".
	* @param int Procedure code record entry number 
	* @return boolean
	*/
	function deleteProcedure($proc_nr=0){
	    global $db, $_SESSION;
		if(!$proc_nr) return FALSE;
		$this->sql="UPDATE $this->tb_procedure 
						SET status='deleted',
						history=".$this->ConcatHistory("Delete ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."\n").",
						modify_id='".$_SESSION['sess_user_name']."'
						 WHERE procedure_nr=$proc_nr";
		//echo $sql;
		return $this->Transact($this->sql);
	}
	/**
	* "Deletes" a internal DRG group number record entry.
	* The entry is  not actually deleted from the table but its status is set to "deleted".
	* @param int Internal DRG group record entry number 
	* @return boolean
	*/
	function deleteEncounterDRGGroup($drg_nr=0){
	    global $db, $_SESSION;
		if(!$drg_nr) return FALSE;
		$this->sql="UPDATE $this->tb_enc_drg 
						SET status='deleted',
						history=".$this->ConcatHistory("Delete ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."\n").",
						modify_id='".$_SESSION['sess_user_name']."'			
						 WHERE nr=$drg_nr";
		//echo $sql;
		return $this->Transact($this->sql);
	}
	/**
	* Sets the category number of the diagnosis code entry.
	* @access public
	* @param int Encounter number
	* @param int Diagnosis code record number
	* @param int Category number
	* return boolean
	*/
	function setDiagnosisCategory($enc_nr,$diag_nr=0,$cat_nr=0){
	    global $db, $_SESSION;
		if(!$diag_nr||!$cat_nr) return FALSE;
		// If the new category is most responsible  (1), change the possible current most responsible diagnosis to associated (2)
		if($cat_nr==1){
			$this->sql="UPDATE $this->tb_diagnosis 
							SET category_nr='2',
							history=".$this->ConcatHistory("Reset main category ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."\n")."
							 WHERE encounter_nr=$enc_nr AND category_nr='1'";
			$this->Transact($this->sql);
		}
		$this->sql="UPDATE $this->tb_diagnosis 
						SET category_nr='$cat_nr',
						history=".$this->ConcatHistory("Set category ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."\n").",
						modify_id='".$_SESSION['sess_user_name']."'
						 WHERE diagnosis_nr=$diag_nr";
		//echo $sql;
		return $this->Transact($this->sql);
	}
	/**
	* Sets the localization number of the diagnosis entry.
	* @access public
	* @param int Diagnosis code record number
	* @param int Localization number
	* return boolean
	*/
	function setDiagnosisLocalization($diag_nr=0,$loc=''){
	    global $db, $_SESSION;
		if(!$diag_nr||empty($loc)) return FALSE;
		$this->sql="UPDATE $this->tb_diagnosis 
						SET localization='$loc',
						history=".$this->ConcatHistory("Set localization ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."\n").",
						modify_id='".$_SESSION['sess_user_name']."'
						WHERE diagnosis_nr=$diag_nr";
		//echo $sql;
		return $this->Transact($this->sql);
	}
	/**
	* Sets the category number of the procedure code entry.
	* @access public
	* @param int Encounter number
	* @param int Procedure code record number
	* @param int Category number
	* return boolean
	*/
	function setProcedureCategory($enc_nr,$proc_nr=0,$cat_nr=0){
	    global $db, $_SESSION;
		if(!$proc_nr||!$cat_nr) return FALSE;
		// If the new category is most responsible  (1), change the possible current most responsible diagnosis to associated (2)
		if($cat_nr==1){
			$this->sql="UPDATE $this->tb_procedure 
							SET category_nr='2',history=".$this->ConcatHistory("Reset main category ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."\n")."
							 WHERE encounter_nr=$enc_nr AND category_nr='1'";
			$this->Transact($this->sql);
		}
		$this->sql="UPDATE $this->tb_procedure 
						SET category_nr='$cat_nr',
						history=".$this->ConcatHistory("Set category ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."\n").",
						modify_id='".$_SESSION['sess_user_name']."'			
						 WHERE procedure_nr=$proc_nr";
		//echo $sql;
		return $this->Transact($this->sql);
	}
	/**
	* Sets the localization number of the procedure entry.
	* @access public
	* @param int Procedure code record number
	* @param int Localization number
	* return boolean
	*/
	function setProcedureLocalization($proc_nr=0,$loc=''){
	    global $db, $_SESSION;
		if(!$proc_nr||empty($loc)) return FALSE;
		$this->sql="UPDATE $this->tb_procedure 
						SET localization='$loc',
						history=".$this->ConcatHistory("Set localization ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."\n").",
						modify_id='".$_SESSION['sess_user_name']."'			
						WHERE procedure_nr=$proc_nr";
		//echo $sql;
		return $this->Transact($this->sql);
	}
	/**
	* Gets the diagnosis categories.
	* @return mixed ADODB record object or boolean
	*/
	function DiagnosisCategories(){
	    global $db;
		$this->sql="SELECT *, LD_var AS \"LD_var\" FROM $this->tb_cat_diag WHERE status NOT IN ($this->dead_stat)";
		if($this->result=$db->Execute($this->sql)) {
		    if($this->result->RecordCount()) {
				return $this->result;
		    } else { return FALSE;}
		} else { return FALSE;}
	}
	/**
	* Gets the procedure categories.
	* @return mixed ADODB record object or boolean
	*/
	function ProcedureCategories(){
	    global $db;
		$this->sql="SELECT *, LD_var AS \"LD_var\" FROM $this->tb_cat_proc WHERE status NOT IN ($this->dead_stat)";
		if($this->result=$db->Execute($this->sql)) {
		    if($this->result->RecordCount()) {
				return $this->result;
		    } else { return FALSE;}
		} else { return FALSE;}
	}
	/**
	* Gets the localization types.
	* @return mixed ADODB record object or boolean
	*/
	function LocalizationTypes(){
	    global $db;
		$this->sql="SELECT *, LD_var AS \"LD_var\" FROM $this->tb_type_loc WHERE status NOT IN ($this->dead_stat)";
		if($this->result=$db->Execute($this->sql)) {
		    if($this->result->RecordCount()) {
				return $this->result;
		    } else { return FALSE;}
		} else { return FALSE;}
	}
	/**
	* Checks if non-grouped diagnosis entries for an encounter  exist
	* @param int Encounter number
	* @return boolean
	*/
	function nongroupedDiagnosisExists($enc_nr){
	    global $db;
		if(!$this->internResolveEncounterNr($enc_nr)) return FALSE;
		$this->sql="SELECT diagnosis_nr FROM $this->tb_diagnosis WHERE encounter_nr=$this->enc_nr AND group_nr=0 AND status NOT IN ($this->dead_stat)";
		if($this->result=$db->Execute($this->sql)) {
		    if($this->result->RecordCount()) {
				return TRUE;
		    } else {return FALSE;}
		} else {return FALSE;}
	}
	/**
	* Checks if non-grouped procedure entries for an encounter  exist
	* @param int Encounter number
	* @return boolean
	*/
	function nongroupedProcedureExists($enc_nr){
	    global $db;
		if(!$this->internResolveEncounterNr($enc_nr)) return FALSE;
		$this->sql="SELECT procedure_nr FROM $this->tb_procedure WHERE encounter_nr=$this->enc_nr AND group_nr IN ('',0)  AND status NOT IN ($this->dead_stat)";
		if($this->result=$db->Execute($this->sql)) {
		    if($this->result->RecordCount()) {
				return TRUE;
		    } else { return FALSE;}
		} else { return FALSE;}
	}
	/**
	* Searches and returns a local  DRG group code.
	* @param string Search key
	* @param string Sort item. Defaults to "description" in ascending order.
	* @return mixed ADODB record object or boolean
	*/
	function searchGroup($key,$order='description'){
	    global $db, $sql_LIKE;
		if(strlen($key)<3) $this->sql="SELECT nr,code,description FROM $this->tb_drg WHERE code $sql_LIKE '$key%' OR description $sql_LIKE '$key%'";
			else $this->sql="SELECT nr,code,description FROM $this->tb_drg WHERE code $sql_LIKE '%$key%' OR description $sql_LIKE '%$key%'";
		$this->sql.=" ORDER BY $order";
		if($this->result=$db->Execute($this->sql)) {
		    if($this->result->RecordCount()) {
				return $this->result;
		    }else{
				$this->sql="SELECT nr,code,description FROM $this->tb_drg WHERE synonyms $sql_LIKE '%$key%' ORDER BY $order";
				if($this->result=$db->Execute($this->sql)) {
		    		if($this->result->RecordCount()) {
						return $this->result;
					}else{return FALSE;}
				}else{return FALSE;}
			}
		}else{return FALSE;}
	}
	/**
	* Checks if the local  DRG group for the encounter exists
	* @param int Group number to be checked
	* @param int Encounter number
	* @return boolean
	*/
	function EncounterDRGGroupExists($grp_nr,$enc_nr=0){
		global $db;
		if(!$this->internResolveEncounterNr($enc_nr)) return FALSE;
		$this->sql="SELECT nr FROM $this->tb_enc_drg WHERE encounter_nr=$this->enc_nr AND group_nr=$grp_nr AND status NOT IN ($this->dead_stat)";
		if($this->result=$db->Execute($this->sql)) {
		    if($this->result->RecordCount()){
				return TRUE;
		    }else{return FALSE;}
		}else{return FALSE;}
	}
	/**
	* Sets the group number of all non-grouped diagnosis and procedure entries of an encounter.
	* @param int Group number
	* @param int Encounter number
	* @return boolean
	*/
	function groupNonGroupedItems($grp_nr,$enc_nr){
	    global  $_SESSION;
		if(!$this->internResolveEncounterNr($enc_nr)||!$grp_nr) return FALSE;
		$buf;
		
		$this->sql="UPDATE $this->tb_diagnosis 
						SET group_nr='$grp_nr',
						history=".$this->ConcatHistory("Set group ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."\n").",
						modify_id='".$_SESSION['sess_user_name']."',
						modify_time='".date('YmdHis')."'
						WHERE encounter_nr=$this->enc_nr AND  group_nr IN ('',0) AND status NOT IN ($this->dead_stat)";
		
		$buf=$this->Transact($this->sql);
		
		$this->sql="UPDATE $this->tb_procedure 
						SET group_nr='$grp_nr',
						history=".$this->ConcatHistory("Set group ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."\n").",
						modify_id='".$_SESSION['sess_user_name']."',
						modify_time='".date('YmdHis')."'
						WHERE encounter_nr=$this->enc_nr AND group_nr IN ('',0) AND status NOT IN ($this->dead_stat)";
		 return ($buf | $this->Transact($this->sql));
	}
	/**
	* Resets the group number of diagnosis code entries of an encounter to 0 (no group)
	* @param int Current group number
	* @param int Encounter number
	* @return boolean
	*/
	function ungroupDiagnoses($grp_nr,$enc_nr){
	    global  $_SESSION;
		if(!$this->internResolveEncounterNr($enc_nr)||!$grp_nr) return FALSE;
		$this->sql="UPDATE $this->tb_diagnosis 
						SET group_nr=0,
						history=".$this->ConcatHistory("Ungroup ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."\n").",
						modify_id='".$_SESSION['sess_user_name']."',
						modify_time='".date('YmdHis')."'
						WHERE encounter_nr=$this->enc_nr AND group_nr=$grp_nr AND status NOT IN ($this->dead_stat)";
		return $this->Transact($this->sql);
	}
	/**
	* Resets the group number of procedure code entries of an encounter to 0 (no group)
	* @param int Current group number
	* @param int Encounter number
	* @return boolean
	*/
	function ungroupProcedures($grp_nr,$enc_nr){
	    global $_SESSION;
		if(!$this->internResolveEncounterNr($enc_nr)||!$grp_nr) return FALSE;
		$this->sql="UPDATE $this->tb_procedure 
						SET group_nr=0,
						history=".$this->ConcatHistory("Ungroup ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."\n").",
						modify_id='".$_SESSION['sess_user_name']."',
						modify_time='".date('YmdHis')."'
						WHERE encounter_nr=$this->enc_nr AND group_nr=$grp_nr AND status NOT IN ($this->dead_stat)";
		return $this->Transact($this->sql);
	}
	/**
	* Resolves the department number to be used for the internal routines.
	* @param int Department number
	* @return boolean
	*/
	function internResolveDeptNr($dept_nr='') {
	    if (empty($dept_nr)) {
		    if(empty($this->dept_nr)) {
			    return FALSE;
			} else { return TRUE; }
		} else {
		     $this->dept_nr=$dept_nr;
			return TRUE;
		}
	}
	/**
	* Returns the quicklist code items of a department.
	* The record count is stored in the rec_count variable and can be fetched via the LastRecordCount().
	* @param string Quicklist items type (drg_intern, diagnosis, procedure)
	* @param int Department number
	* @return mixed ADODB record object or boolean
	*/
	function DeptQuicklist($type='',$dept_nr=0){
		global $db;
		//if(!$this->internResolveDeptNr($dept_nr)||empty($type)) return FALSE;
		$this->dept_nr=1;
		switch($type){
			case 'drg_intern':
			{
				$cond="q.code AS nr,d.code AS code, d.description FROM $this->tb_qlist AS q  LEFT JOIN $this->tb_drg AS d ON q.code=d.nr";
				break;
			}
			case 'diagnosis':
			{
				$cond="q.code,q.code_parent ,d.diagnosis_code AS nr, d.description, p.description AS parent_desc FROM $this->tb_qlist AS q  
								LEFT JOIN $this->tb_diag_codes AS d ON q.code=d.diagnosis_code
								LEFT JOIN $this->tb_diag_codes AS p ON q.code_parent=p.diagnosis_code";
				break;
			}
			case 'procedure':
			{
				$cond="q.code,q.code_parent ,d.code AS nr, d.description, p.description AS parent_desc FROM $this->tb_qlist AS q  
								LEFT JOIN $this->tb_proc_codes AS d ON q.code=d.code
								LEFT JOIN $this->tb_proc_codes AS p ON q.code_parent=p.code";
				break;
			}
			//default: return FALSE;
		}
		$this->sql="SELECT $cond WHERE q.dept_nr=$this->dept_nr AND q.qlist_type='$type' ORDER BY q.rank DESC";
		if($this->result=$db->SelectLimit($this->sql,$this->sel_limit)) {
		    if($this->rec_count=$this->result->RecordCount()){
				return $this->result;
		    }else{return FALSE;}
		}else{return FALSE;}
	}
	/**
	* Checks if the code exists in the quicklist.
	* @param string Code id or number
	* @return mixed integer or boolean
	*/
	function QuickCodeExists($code=0){
		global $db;
		if(!$code) return FALSE;
		$this->sql="SELECT nr FROM $this->tb_qlist WHERE code='$code'";
		if($this->result=$db->Execute($this->sql)) {
		    if($this->rec_count=$this->result->RecordCount()){
				$row=$this->result->FetchRow();
				return $row['nr'];
		    }else{return FALSE;}
		}else{return FALSE;}
	}
	/**
	* Increases the ranking of the code in the quicklist by given $step value.
	* @param mixed Code number (int) or id (string)
	* @param int  Increase step (defaults to 1)
	* @return boolean
	*/
	function upRankQuickCode($code=0,$step=1){
		if(!$code) return FALSE;
		$this->sql="UPDATE $this->tb_qlist SET rank=(rank+$step) WHERE code='$code'";
		return $this->Transact();
	}
	/**
	* Adds a new code entry in the quicklist.
	* The code to be added is contained in an associative array together with relevant information.
	* The data are packed in the array with the following index keys:
	* - code = the code to be added
	* - code_parent = the parent code in case the actual code is a subcode
	* - qlist_type = type of quick list 
	*
	* @param array Data in associative array
	* @return boolean
	*/
	function addQuickCode(&$data){
		global $_SESSION;
		if(!is_array($data)) return FALSE;
		if($this->QuickCodeExists($data['code'])){
			return $this->upRankQuickCode($data['code']);
		}else{
			$this->sql="INSERT INTO $this->tb_qlist (code,code_parent,dept_nr,qlist_type,rank,history,create_id,create_time)
			VALUES ('".$data['code']."','".$data['code_parent']."','1','".$data['qlist_type']."','1','Create ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."','".$_SESSION['sess_user_name']."','".date('YmdHis')."')";
			return $this->Transact();
		}
	}
	/**
	* Checks if a drg related code exists in the table.
	* If the code exist, its primary record key will be returned, else FALSE will be returned.
	* @param int Drg group number
	* @param string Related code
	* @param string Type of the related code (diagnosis, procedure)
	* @return mixed integer or boolean
	*/
	function DRGRelatedCodeExists($group_nr=0,$relcode=0,$code_type=0){
		global $db;
		if(!($relcode&&$group_nr&&$code_type)) return FALSE;
		$this->sql="SELECT nr FROM $this->tb_related WHERE group_nr=$group_nr AND code='$relcode' AND code_type='$code_type'";
		if($this->result=$db->Execute($this->sql)) {
		    if($this->rec_count=$this->result->RecordCount()){
				$row=$this->result->FetchRow();
				return $row['nr'];
		    }else{return FALSE;}
		}else{return FALSE;}
	}
	/**
	* Increases the ranking of a drg  related code by $step value.
	* @param int Drg group number
	* @param string Related code
	* @param string Type of the related code (diagnosis, procedure)
	* @param int  Increase step (defaults to 1)
	* @return boolean
	*/
	function upRankDRGRelatedCode($group_nr=0,$relcode=0,$code_type=0,$step=1){
		if(!($relcode&&$group_nr&&$code_type)) return FALSE;
		$this->sql="UPDATE $this->tb_related SET rank=(rank+$step) WHERE group_nr=$group_nr AND code='$relcode' AND code_type='$code_type'";
		return $this->Transact();
	}
	/**
	* Adds a new related code entry in the care_drg_related_codes table.
	* The data are packed in the array with the following index keys:
	* - group_nr = the group number
	* - code = the code to be added
	* - code_parent = the parent code in case the actual code is a subcode
	* - qlist_type = type of quick list 
	*
	* @param array Data to be stored in the table. By reference.
	* @return boolean
	*/
	function addDRGRelatedCode(&$data){
		global $_SESSION;
		if(!is_array($data)) return FALSE;
		if($this->DRGRelatedCodeExists($data['group_nr'],$data['code'],$data['code_type'])){
			return $this->upRankDRGRelatedCode($data['group_nr'],$data['code'],$data['code_type']);
		}else{
			$this->sql="INSERT INTO $this->tb_related (group_nr,code,code_parent,code_type,rank,history,create_id,create_time)
									VALUES ('".$data['group_nr']."','".$data['code']."','".$data['code_parent']."','".$data['code_type']."','1','Create ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."','".$_SESSION['sess_user_name']."','".date('YmdHis')."')";
			return $this->Transact();
		}
	}
	/**
	* Gets the diagnosis codes related to the internal drg group number
	* @access public
	* @param int Number of the internal drg group
	* @return mixed adodb record object or boolean
	*/
	function RelatedDiagnoses($group_nr=0){
		global $db;
		if(!$group_nr) return FALSE;
		$this->sql="SELECT c.nr,c.code, c.code_parent,d.description, p.description AS parent_desc
							FROM  $this->tb_related AS c
									LEFT JOIN $this->tb_diag_codes AS d ON c.code=d.diagnosis_code
									LEFT JOIN $this->tb_diag_codes AS p ON c.code_parent=p.diagnosis_code
							 WHERE c.group_nr='$group_nr' 
									AND c.code_type='diagnosis'
									AND c.status NOT IN ($this->dead_stat)
							ORDER BY c.rank DESC";
		if($this->result=$db->SelectLimit($this->sql,$this->sel_limit)) {
		    if($this->rec_count=$this->result->RecordCount()){
				return $this->result;
		    }else{return FALSE;}
		}else{return FALSE;}
	}
	/**
	* Gets the procedure codes related to the internal drg group number.
	* @access public
	* @param int Number of the internal drg group
	* @return mixed adodb record object or boolean
	*/
	function RelatedProcedures($group_nr=0){
		global $db;
		if(!$group_nr) return FALSE;
		$this->sql="SELECT c.nr,c.code, c.code_parent,d.description, p.description AS parent_desc
							FROM  $this->tb_related AS c
									LEFT JOIN $this->tb_proc_codes AS d ON c.code=d.code
									LEFT JOIN $this->tb_proc_codes AS p ON c.code_parent=p.code
							 WHERE c.group_nr='$group_nr' 
									AND c.code_type='procedure'
									AND c.status NOT IN ($this->dead_stat)
							ORDER BY c.rank DESC";
		if($this->result=$db->SelectLimit($this->sql,$this->sel_limit)) {
		    if($this->rec_count=$this->result->RecordCount()){
				return $this->result;
		    }else{return FALSE;}
		}else{return FALSE;}
	}
	/**
	* Gets the diagnosis codes for an encounter's operative intervention.
	* @param int Operation number
	* @param int Encounter number
	* @return mixed adodb record object or boolean
	*/
	function OPDiagnosisCodes($op_nr=0,$enc_nr=0){
	    global $db;
		//if(!$this->internResolveEncounterNr($enc_nr)||!$op_nr) return FALSE;
		if(!$this->internResolveEncounterNr($enc_nr)) return FALSE;
		$this->sql="SELECT d.*,c.description , m.description AS parent_desc,
								cat.LD_var AS cat_LD_var, cat.LD_var_short_code AS cat_LD_var_short_code, cat.short_code AS cat_short_code, cat.name AS cat_name,
								loc.LD_var AS loc_LD_var, loc.LD_var_short_code AS loc_LD_var_short_code, loc.short_code AS loc_short_code,loc.name AS loc_name
							FROM 	$this->tb_diagnosis AS d
									LEFT JOIN $this->tb_diag_codes AS c ON d.code=c.diagnosis_code
									 LEFT JOIN $this->tb_diag_codes AS m ON d.code_parent=m.diagnosis_code AND d.code_parent NOT IN ('',' ',0)
									 LEFT JOIN $this->tb_cat_diag AS cat ON d.category_nr=cat.nr
									 LEFT JOIN $this->tb_type_loc AS loc ON d.localization=loc.nr
									 WHERE d.encounter_nr='$this->enc_nr' 
									 	AND d.op_nr='$op_nr'
									 	AND d.status NOT IN ($this->dead_stat)
										ORDER BY d.category_nr,d.date";
		//echo $this->sql;
		if($this->result=$db->Execute($this->sql)) {
		    if($this->result->RecordCount()) {
				return $this->result;
		    } else { return FALSE;}
		} else { return FALSE;}
	}
	/**
	* Gets the procedure codes for an encounter's operative intervention.
	* @param int Operation number
	* @param int Encounter number
	* @return mixed adodb record object or boolean
	*/
	function OPProcedureCodes($op_nr=0,$enc_nr=0){
	    global $db;

		//if(!$this->internResolveEncounterNr($enc_nr)||!$op_nr) return FALSE;
		if(!$this->internResolveEncounterNr($enc_nr)) return FALSE;
		$this->sql="SELECT p.*, c.description, m.description AS parent_desc,
								cat.LD_var AS cat_LD_var, cat.LD_var_short_code AS cat_LD_var_short_code, cat.short_code AS cat_short_code, cat.name AS cat_name,
								loc.LD_var AS loc_LD_var, loc.LD_var_short_code AS loc_LD_var_short_code, loc.short_code AS loc_short_code,loc.name AS loc_name	
							FROM
									 	$this->tb_proc_codes AS c,
										$this->tb_procedure AS p
									 LEFT JOIN $this->tb_proc_codes AS m ON p.code_parent=m.code
									 LEFT JOIN $this->tb_cat_proc AS cat ON p.category_nr=cat.nr
									 LEFT JOIN $this->tb_type_loc AS loc ON p.localization=loc.nr
							 WHERE p.encounter_nr=$this->enc_nr
									 	AND p.op_nr=$op_nr
									 	AND p.status NOT IN ($this->dead_stat)
										AND  p.code=c.code ORDER BY p.category_nr,p.date";
		//echo $sql;
		if($this->result=$db->Execute($this->sql)) {
		    if($this->result->RecordCount()) {
				return $this->result;
		    } else { return FALSE;}
		} else { return FALSE;}
	}
	/** 
	* Gets all DRG entries based on the given number
	* @access private
	* @param int Select number
	* @param int Type of  select number (_ENC = encounter nr, _REG = pid nr.)
	* @return mixed adodb record object or boolean
	*/
	function _getDRGList($nr,$nr_type='_ENC'){
		global $db;
		# Set field name for main selection
		if($nr_type=='_ENC'){
			$disc='encounter_nr';
		}elseif($nr_type='_REG'){
			$disc='pid';
		}else{
			$this->error_msg='Type of nr. invalid or empty';
			return FALSE;
		}
		
		$this->sql="SELECT e.encounter_nr,e.encounter_date,e.is_discharged  
						FROM   $this->tb_enc AS e
						LEFT JOIN $this->tb_enc_drg AS i ON  i.encounter_nr=e.encounter_nr AND i.status  NOT  IN ($this->dead_stat)
						LEFT JOIN $this->tb_diagnosis AS d ON d.encounter_nr=e.encounter_nr AND d.status NOT IN ($this->dead_stat)
						LEFT JOIN $this->tb_procedure AS p ON p.encounter_nr=e.encounter_nr AND p.status NOT IN ($this->dead_stat)
						WHERE e.$disc=$nr
							AND e.status NOT IN ($this->dead_stat)
						GROUP BY e.encounter_nr,e.encounter_date, e.is_discharged
						ORDER BY e.encounter_date DESC";
		//echo $this->sql;
        if($this->res['_gmed']=$db->Execute($this->sql)) {
            if($this->rec_count=$this->res['_gmed']->RecordCount()) {
				 return $this->res['_gmed'];	 
			} else { return FALSE; }
		} else { return FALSE; }
	}
	/** 
	* Gets all DRG records of an encounter based on the encounter number.
	* @access public
	* @param int Encounter number
	* @return mixed adodb record object or boolean
	*/
	function encDRGList($nr){
		return $this->_getDRGList($nr,'_ENC');
	}
	/** 
	* Gets all DRG records of a person based on his PID number.
	* @access public
	* @param int  PID number
	* @return mixed adodb record object or boolean
	*/
	function pidDRGList($nr){
		return $this->_getDRGList($nr,'_REG');
	}
	
}
