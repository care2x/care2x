<?php
/**
* @package care_api
*/

/**
*/
require_once($root_path.'include/care_api_classes/class_encounter.php');
/**
*  Ward methods.
*  Note this class should be instantiated only after a "$db" adodb  connector object  has been established by an adodb instance.
* @author Elpidio Latorilla
* @version beta 2.0.1
* @copyright 2002,2003,2004,2005,2005 Elpidio Latorilla
* @package care_api
*/
class Ward extends Encounter {
	/**#@+
	* @access private
	*/
	/**
	* Table name for ward data
	* @var string
	*/
    var $tb_ward='care_ward';
	/**
	* Table name for department data
	* @var string
	*/
	var $tb_dept='care_department';
	/**
	* Table name for room data
	* @var string
	*/
	var $tb_room='care_room';
	/**
	* Table name for encounter notes
	* @var string
	*/
	var $tb_notes='care_encounter_notes';
	/**
	* Ward number buffer
	* @var int
	*/
	var $ward_nr;
	/**
	* Department number buffer
	* @var int
	*/
	var $dept_nr;
	/**
	* Buffer for technical information
	* @var mixed
	*/
	var $techinfo;
	/**
	* Field names of care_ward table
	* @var array
	*/
	var $fld_ward=array('nr',
									'ward_id',
									'name',
									'is_temp_closed',
									'date_create',
									'date_close',
									'description',
									'info',
									'dept_nr',
									'room_nr_start',
									'room_nr_end',
									'roomprefix',
									'status',
									'history',
									'modify_id',
									'modify_time',
									'create_id',
									'create_time');
	/**
	*  Field names of table care_room
	* @var array
	*/
	var $fld_room=array('nr',
									'type_nr',
									'date_create',
									'date_close',
									'is_temp_closed',
									'room_nr',
									'ward_nr',
									'dept_nr',
									'nr_of_beds',
									'info',
									'status',
									'history',
									'modify_id',
									'modify_time',
									'create_id',
									'create_time');
	/**#@-*/
	
	/**
	* Constructor 
	* @param int Ward number
	*/
	function Ward($ward_nr=0) {
	    $this->ward_nr=$ward_nr;
		$this->Encounter();
	}	
	/**
	* Sets the department number buffer.
	* 
	* @access public
	*/
	function setDeptNr($dept_nr) {
	    $this->dept_nr=$dept_nr;
	}
	/**
	* Sets core object to point to the care_ward table
	* 
	* @access private
	*/
	function _useWard(){
		$this->ref_array=&$this->fld_ward;
		$this->coretable=$this->tb_ward;
	}
	/**
	* Returns items of all wards.
	* 
	* @access public
	* @param string Field names of items to be fetched
	* @return mixed adodb record object or boolean
	* @author Gjergj Sheldija
	*/
	function getAllWardsItemsObject(&$items, $dept_nr='0') {
	    global $db;
	    $this->sql="SELECT $items  FROM $this->tb_ward WHERE status NOT IN ($this->dead_stat)";
	    //gjergji - show only info on my departement
		if(isset($dept_nr) && !empty($dept_nr) ) {
			$this->sql.=" AND ( ";
			while (list($key, $val) = each($dept_nr)) {
				$tmp .= "dept_nr = " . $val . " OR ";
			}
			$this->sql .= substr($tmp,0,-4) ;
			$this->sql .= " ) "	;
	    }
        //echo $this->sql;
        if($this->res['gawio']=$db->Execute($this->sql)) {
            if($this->rec_count=$this->res['gawio']->RecordCount()) {
				 return $this->res['gawio'];	 
			} else { return false; }
		} else { return false; }
	}
	/**
	* Returns all wards data.
	* 
	* The returned adodb record object contains rows of arrays.
	* Each array contains the  data with the following index keys:
	* - all ward index keys as outlined in the <var>$fld_ward</var> variable
	* - dept_name = Department default name
	*
	* @access public
	* @return mixed adodb record object or boolean
	*/
	function getAllWardsDataObject() {
	    global $db;
	    $this->sql="SELECT w.*,d.name_formal AS dept_name  FROM $this->tb_ward AS w LEFT JOIN $this->tb_dept AS d ON w.dept_nr=d.nr
				 WHERE w.status NOT IN ('closed','deleted','hidden','inactive','void')";
        //echo $this->sql;
        if($this->result=$db->Execute($this->sql)) {
            if($this->result->RecordCount()) {
				 return $this->result;	 
			} else { return false; }
		} else { return false; }
	}
	/**
	* Returns items of all wards.
	* 
	* Similar to getAllWardsItemsObject() but returns a 2 dimensional array.  
	* 
	* @access public
	* @param string Field names of items to be fetched
	* @return mixed array or boolean
	*/
	function getAllWardsItemsArray(&$items) {
	    global $db;
	    $this->sql="SELECT $items  FROM $this->tb_ward WHERE  status NOT IN ('hidden','deleted','closed','inactive')";
        if($this->result=$db->Execute($this->sql)) {
            if($this->result->RecordCount()) {
				 return $this->result->GetArray(); 
			} else { return false; }
		} else { return false; }	
	}
	/**
	* Returns all wards data.
	* 
	* Similar to getAllWardsDataObject() but returns a 2 dimensional array.  
	* Data returned have index keys as outlined in the <var>$fld_ward</var> array.
	* 
	* @access public
	* @return mixed array or boolean
	*/	
	function getAllWardsDataArray() {
	    global $db;
	    $this->sql="SELECT *  FROM $this->tb_ward WHERE 1";
        //echo $this->sql;
        if($this->result=$db->Execute($this->sql)) {
            if($this->result->RecordCount()) {
				 while($this->buffer_array=$this->result->FetchRow());
				 return $this->buffer_array; 
			} else { return false; }
		} else { return false; }
    }
	/**
	* Returns ward name based on its record number.
	* @access public
	* @param int Record number
	* @return mixed string or boolean
	*/	
	function WardName($nr){
	    global $db;
		if(empty($nr)) return false;
        if($this->result=$db->Execute("SELECT name FROM $this->tb_ward WHERE nr=$nr")) {
            if($this->result->RecordCount()){
				 $this->row=$this->result->FetchRow();
				 return $this->row['name'];	 
			} else { return false; }
		} else { return false; }
	}
	/**
	* Returns ward information.
	* 
	* The returned  array contains the  data with the following index keys:
	* - all ward index keys as outlined in the <var>$fld_ward</var> variable
	* - dept_name = Department default name
	*
	* @access public
	* @param int Ward number
	* @return mixed array or boolean
	*/
	function getWardInfo($ward_nr){
		global $db;
		$this->sql="SELECT w.*,d.name_formal AS dept_name FROM $this->tb_ward AS w LEFT JOIN $this->tb_dept AS d ON w.dept_nr=d.nr
					WHERE w.nr=$ward_nr AND w.status NOT IN ('closed',$this->dead_stat)";
        if($this->res['gwi']=$db->Execute($this->sql)) {
            if($this->rec_count=$this->res['gwi']->RecordCount()) {
				 return $this->res['gwi']->FetchRow();	 
			} else { return false; }
		} else { return false; }
	}	
	/**
	* Returns room information.
	* 
	* The returned adodb record object contains a row of array.
	* This array contains the  data with index keys as outlined in the <var>$fld_room</var> variable
	*
	* @access public
	* @param int Ward number
	* @param int Starting room number
	* @param int Ending room number
	* @return mixed adodb record object or boolean
	*/
	function getRoomInfo($ward_nr,$s_nr,$e_nr){
		global $db;
		$this->sql="SELECT * FROM $this->tb_room WHERE type_nr=1 AND ward_nr=$ward_nr AND room_nr  >= '$s_nr' AND room_nr <= '$e_nr' AND  status NOT IN ($this->dead_stat) ORDER BY room_nr";
		if($this->result=$db->Execute($this->sql)) {
            if($this->rec_count=$this->result->RecordCount()) {
				 return $this->result;	 
			} else {return false; }
		} else {return false; }
	}	
	/**
	* Returns ward occupants (inpatients) information.
	* 
	* The object is stored in the internal buffer <var>$result</var>.
	* This adodb record object contains rows of arrays.
	* Each array contains the  data with the following index keys:
	* - room_nr = room number
	* - room_loc_nr = primary key number of room location
	* - bed_nr = bed number
	* - encounter_nr = encounter number
	* - bed_loc_nr = primary key number of bed location
	* - name_last = person's last or family name
	* - name_first = person's first or given name
	* - date_birth = date of birth
	* - bed_nr = bed number
	* - title = person's title
	* - sex = person's sex
	* - photo_filename = filename of stored picture id
	* - insurance_class_nr = insurance class nr
	* - insurance_name = insurance class default name
	* - insurance_LDvar = variable's name for the foreign language version of the insurance class name
	* - ward_notes = ward notes record number
	*
	* @access private
	* @param int Ward number
	* @param string Date of occupancy
	* @return boolean
	*/
	function _getWardOccupants($ward_nr,$date){
		global $db, $dbf_nodate;
		
		if($date==date('Y-m-d')) $pstat='discharged';
			else $pstat='dummy';
			
		$this->sql="SELECT r.location_nr AS room_nr,
									r.nr AS room_loc_nr,
									b.location_nr AS bed_nr, 
									b.encounter_nr,
									b.nr AS bed_loc_nr,
									p.pid,
									p.name_last,
									p.name_first,
									p.date_birth,
									p.title,
									p.sex,
									p.photo_filename,
									e.insurance_class_nr,
									i.name AS insurance_name,
									i.LD_var AS \"insurance_LDvar\",
									n.nr AS ward_notes
							FROM $this->tb_location AS r 
									LEFT JOIN $this->tb_location AS b  ON 	(r.encounter_nr=b.encounter_nr
																								AND r.group_nr=b.group_nr 
																								AND	b.type_nr=5 
																								AND b.status NOT IN ('$pstat','closed',$this->dead_stat)
																								AND b.date_from<='$date'
										 														AND ('$date'<=b.date_to OR b.date_to ='$dbf_nodate')
																								)	
									LEFT JOIN $this->tb_enc AS e ON b.encounter_nr=e.encounter_nr
									LEFT JOIN $this->tb_person AS p ON e.pid=p.pid
									LEFT JOIN $this->tb_ic AS i ON e.insurance_class_nr=i.class_nr
									LEFT JOIN $this->tb_notes AS n ON b.encounter_nr=n.encounter_nr AND n.type_nr=6
							WHERE  r.group_nr=$ward_nr 
											AND	r.type_nr=4 
											AND r.status NOT IN ('$pstat','closed',$this->dead_stat)
										 	AND ('$date'<=r.date_to OR r.date_to ='$dbf_nodate')
							/*GROUP BY r.location_nr*/
							ORDER BY r.location_nr,b.location_nr";
		if($this->result=$db->Execute($this->sql)){
			if($this->rec_count=$this->result->RecordCount()){
				//echo $this->result->RecordCount();
				//echo $this->sql.'  count';
				return true;
			}else{
				//echo $this->sql.'no count';
				return false;
			}
		}else{echo $this->sql.'no sql';return false;}
	}
	/**
	* Returns ward occupants (inpatients) information on a given date.
	* 
	* For detailed structure of the returned data, see the <var>_getWardOccupants()</var> method.
	* @access public
	* @param int Ward number
	* @param string Date of occupancy
	* @return mixed adodb record object or boolean
	*/
	function getDayWardOccupants($ward_nr,$date=''){
		if(empty($date)) $date=date('Y-m-d');
		if($this->_getWardOccupants($ward_nr,$date)){
			return $this->result;
		}else{return false;}
	}
	/**
	* Reserved method name.
	*/
	function exitBed($loc_nr){
	}
	/**
	* Reserved method name.
	*/
	function exitRoom($loc_nr){
	}
	/**
	* Reserved method name.
	*/
	function exitWard($loc_nr){
	}
	/**
	* Closes a bed.
	* 
	* @access public
	* @param int Ward number
	* @param int Room number
	* @param int Bed number
	* @return boolean
	*/
	function closeBed($ward_nr,$room_nr,$bed_nr){
		$this->sql="UPDATE $this->tb_room SET closed_beds=".$this->ConcatFieldString("closed_beds","$bed_nr/")." WHERE type_nr=1 AND room_nr=$room_nr AND ward_nr=$ward_nr";
		//if( $this->Transact($this->sql)) return true; else echo $this->sql;
		return $this->Transact($this->sql);
	}
	/**
	* Opens a bed.
	* 
	* @access public
	* @param int Ward number
	* @param int Room number
	* @param int Bed number
	* @return boolean
	*/
	function openBed($ward_nr,$room_nr,$bed_nr){
		global $dbtype;
		switch ($dbtype){
			case 'mysql': $this->sql="UPDATE $this->tb_room SET closed_beds=".$this->ReplaceFieldString("closed_beds","$bed_nr/","")." WHERE type_nr=1 AND room_nr=$room_nr AND ward_nr=$ward_nr";
				break;
			case 'postgres':
			case 'postgres7':
				$room_obj=$this->getRoomInfo($ward_nr,$room_nr,$room_nr);
				$room_info=$room_obj->FetchRow();
				$closedbeds=str_replace("$bed_nr/","",$room_info['closed_beds']);
				$this->sql="UPDATE $this->tb_room SET closed_beds='$closedbeds' WHERE type_nr=1 AND room_nr=$room_nr AND ward_nr=$ward_nr";
				break;
		}
		//if( $this->Transact($this->sql)) return true; else echo $this->sql;
		return $this->Transact($this->sql);
	}
	/**
	* Saves ward new ward information.
	*
	* Data passed by reference with associative array and have index keys as outlined in the <var>$fld_ward</var> array.
	* @access public
	* @param array Data to save.
	* @return boolean
	*/
	function saveWard(&$data){
		global $_SESSION;
		$this->_useWard();
		$this->data_array=$data;
		$this->data_array['date_create']=date('Y-m-d');
		$this->data_array['history']="Create: ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."\n";
		//$this->data_array['modify_id']=$_SESSION['sess_user_name'];
		$this->data_array['create_id']=$_SESSION['sess_user_name'];
		$this->data_array['create_time']=date('YmdHis');
		return $this->insertDataFromInternalArray();
	}
	/**
	* Updates a ward information.
	*
	* Data passed by reference with associative array and have index keys as outlined in the <var>$fld_ward</var> array.
	* Only the field  to be updated must be present in the array as index key to avoid replacing the wrong data.
	* @access public
	* @param int Primary key number of the ward record to be updated.
	* @param array Data to save.
	* @return boolean
	*/
	function updateWard($nr,&$data){
		global $_SESSION;
		$this->_useWard();
		$this->data_array=$data;
		// remove probable existing array data to avoid replacing the stored data
		if(isset($this->data_array['date_create'])) unset($this->data_array['date_create']);
		if(isset($this->data_array['create_id'])) unset($this->data_array['create_id']);
		// clear the where condition
		$this->where='';
		$this->data_array['history']="CONCAT(history,'Update: ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."\n')";
		$this->data_array['modify_id']=$_SESSION['sess_user_name'];
		return $this->updateDataFromInternalArray($nr);
	}
	/**
	* IDExists() checks if the ward id is existing.
	* @access public
	* @param int Ward id
	* @return boolean
	*/
	function IDExists($id){
		global $db;
		$this->sql="SELECT ward_id FROM $this->tb_ward WHERE ward_id='$id' AND status NOT IN ('closed','inactive','void','deleted','hidden')";
		if($this->result=$db->Execute($this->sql)){
			if($this->result->RecordCount()){
				return true;
			}else{return false;}
		}else{return false;}
	}
	/** 
	* Checks if there is at least one patient admitted in the ward.
	* @access public
	* @param int Ward id
	* @return boolean
	*/
	function hasPatient($nr){
		global $db;
		$this->sql="SELECT nr FROM $this->tb_location 
						WHERE type_nr=4 
							AND group_nr=$nr 
							AND date_from NOT  IN  ('0000-00-00','') 
							AND date_to  IN  ('0000-00-00','') 
							AND status NOT IN ('closed','inactive','void','hidden','deleted')";
		if($this->result=$db->Execute($this->sql)){
			if($this->result->RecordCount()){
				return true;
			}else{return false;}
		}else{return false;}
	}
	/**
	* Sets the ward to "temporary closed" status.
	*
	* Toggles the is_temp_closed field of the care_ward table
	* @access private
	* @param int Primary record key number
	* @param int Flag to set. Default to 1.
	* @return boolean
	*/
	function _setIsTemporaryClosed($nr,$flag=1){
		global $_SESSION;
		$this->_useWard();
		// clear the where condition
		$this->where='';
		$data['is_temp_closed']=$flag;
		if($flag){
			$action='Closed temporary';
		}else{
			$action='Reopened';
		} 
		$data['history']="CONCAT(history,'$action: ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."\n')";
		$data['modify_id']=$_SESSION['sess_user_name'];
		$this->data_array=$data;		
		return $this->updateDataFromInternalArray($nr);
	}
	/**
	* Closes a ward temporarily.
	* @access public
	* @param int Primary record key number
	* @return boolean
	*/
	function closeWardTemporary($nr){
			return $this->_setIsTemporaryClosed($nr,1);
	}
	/**
	* Reopens a ward that was previously closed temporarily.
	* @access public
	* @param int Primary record key number
	* @return boolean
	*/
	function reOpenWard($nr){
			return $this->_setIsTemporaryClosed($nr,0);
	}
	/**
	* Closes a ward irreversibly.
	* @access public
	* @param int Primary record key number
	* @return boolean
	*/
	function closeWardNonReversible($nr){
		global $_SESSION;
		$this->_useWard();
		// clear the where condition
		$this->where='';
		$data['date_close']=date('Y-m-d');
		$data['status']='inactive';
		$data['history']="CONCAT(history,'Closed nonreversible: ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."\n')";
		$data['modify_id']=$_SESSION['sess_user_name'];
		$this->data_array=$data;
		return $this->updateDataFromInternalArray($nr);
	}
	/**
	* Returns information of all ACTIVE wards.
	*
	* 
	* The returned adodb record object contains rows of arrays.
	* Each array contains the  data with the following index keys:
	* - all ward index keys as outlined in the <var>$fld_ward</var> variable
	* - dept_name = Department default name
	*
	* @access public
	* @param int Primary record key number
	* @return mixed adodb record object or boolean
	*/
	function getAllActiveWards() {
	    global $db;
	    $this->sql="SELECT w.*,d.name_formal AS dept_name
						FROM $this->tb_ward AS w 
							LEFT JOIN $this->tb_dept AS d ON w.dept_nr=d.nr
				 		WHERE w.status NOT IN ('closed','inactive','void','hidden','deleted')";
        //echo $this->sql;
        if($this->result=$db->Execute($this->sql)) {
            if($this->result->RecordCount()) {
				 return $this->result;	 
			} else { return false; }
		} else { return false; }
	}
	/**
	* Returns total number of created rooms.
	*
	* The returned adodb record object contains rows of arrays.
	* Each array contains the  data with the following index keys:
	* - room_nr = room number
	* - nr_rooms  = total number of rooms
	* - nr = the primary record key
	*
	* @access public
	* @param int Primary record key number
	* @return boolean
	*/
	function countCreatedRooms(){
	    global $db, $dbf_nodate;
		$this->sql="SELECT COUNT(r.room_nr) AS nr_rooms,w.nr  FROM $this->tb_room AS r, $this->tb_ward AS w
							WHERE w.nr=r.ward_nr AND r.date_close='$dbf_nodate' AND r.status NOT IN ('closed','inactive','void','hidden','deleted')
							 GROUP BY w.nr";
        if($result=$db->Execute($this->sql)) {
            if($result->RecordCount()) {
	    			 return $result;
			} else { return false; }
		} else { return false; }
	}
	/**
	* Returns rooms data of a ward
	*
	* The returned adodb record object contains rows of arrays.
	* Each array contains the  data with the following index keys:
	* - room_nr = room number
	* - nr_rooms  = total number of rooms
	* - nr = the primary record key
	*
	* @access public
	* @param int Primary record key number
	* @return boolean
	*/
	function getRoomsData($ward_nr=0){
	    global $db;
	    if(!$ward_nr) return FALSE;
		$this->sql="SELECT *  FROM $this->tb_room WHERE ward_nr='$ward_nr' AND status NOT IN ('closed','inactive','void','hidden','deleted')
							 ORDER BY room_nr";
        if($this->result=$db->Execute($this->sql)) {
            if($this->result->RecordCount()) {
				 return $this->result;
			} else { return false; }
		} else { return false; }
	}
	/**
	* Saves new ward's room  information.
	*
	* Data passed by reference with associative array and have index keys as outlined in the <var>$fld_room</var> array.
	* @access public
	* @param array Data to save.
	* @return boolean
	*/
	function saveWardRoomInfoFromArray(&$data){
		$this->coretable=$this->tb_room;
		$this->ref_array=$this->fld_room;
		$this->data_array=$data;
		$this->data_array['type_nr']=1; // 1 = ward room type nr
		return $this->insertDataFromInternalArray();
	}
	/**
	* Checks if a room number of a given ward number exists.
	*
	* @access public
	* @param int Room number
	* @param int Ward number
	* @return boolean
	*/
	function RoomExists($room_nr=0,$ward_nr=0){
	    global $db, $dbf_nodate;
		if(!$room_nr) return false;
		if($ward_nr) $this->ward_nr=$ward_nr;
			elseif(!$this->ward_nr) return false;
		$this->sql="SELECT room_nr FROM $this->tb_room 
							WHERE ward_nr=$this->ward_nr 
								AND room_nr=$room_nr 
								AND date_close = '$dbf_nodate'
								AND status NOT IN ($this->dead_stat)";
        if($this->result=$db->Execute($this->sql)) {
            if($this->result->RecordCount()) {
				 return true;
			} else { return false; }
		} else { return false; }
	}
	/**
	* Gets one/all active (not closed) room(s) information.
	* 
	* The resulting adodb object is stored in the internal buffer <var>$result</var>.
	*
	* param room_nr = the room number. If supplied, the open room's info will be returned, else all open rooms info will be returned.
	*
	* param ward_nr = the ward number (optional). Used if supplied, else the ward number set by the constructor will used.
	*
	* return true = if room(s) found.  The result is stored in the internal result variable and returned by a public function.
	*
	* return false = if ward_nr is 0 AND internal ward_nr is 0
	*
	* return false = if no open room(s) found
	* @access private
	* @param int Room number
	* @param int Ward number
	* @return boolean
	*/
	function _getActiveRoomInfo($room_nr=0,$ward_nr=0){
	    global $db,$dbf_nodate;
	    //$db->debug=1;
		if($ward_nr) $this->ward_nr=$ward_nr;
			elseif(!$this->ward_nr) return false;
		$this->sql="SELECT * FROM $this->tb_room 
							WHERE ward_nr=$this->ward_nr";
							
		if($room_nr) $this->sql.=" AND room_nr=$room_nr";

		$this->sql.="  AND date_close = '$dbf_nodate' AND status NOT IN ($this->dead_stat)";
							
        if($this->result=$db->Execute($this->sql)) {
            if($this->result->RecordCount()) {
				 return true;
			} else { return false; }
		} else { return false; }
	}
	/** 
	* Gets all active rooms information.
	* 
	* The returned adodb record object contains rows of arrays.
	* Each array contains the  data with index keys as outlined in the <var>$fld_room</var> variable
	*
	* @access public
	* @param int Ward number
	* @return mixed adodb record object or boolean
	*/
	function getAllActiveRoomsInfo($ward_nr=0){
        if($this->_getActiveRoomInfo(0,$ward_nr)) {
			return $this->result;
		} else { return false; }
	}
	/** 
	* Gets one active room information.
	* 
	* The returned adodb record object contains a row of array.
	* This array contains the  data with index keys as outlined in the <var>$fld_room</var> variable
	*
	* @access public
	* @param int Room number
	* @param int Ward number
	* @return mixed adodb record object or boolean
	*/
	function getActiveRoomInfo($room_nr=0,$ward_nr=0){
		if(!$room_nr) return false;
        if($this->_getActiveRoomInfo($room_nr,$ward_nr)) {
			return $this->result;
		} else { return false; }
	}
	/**
	* Counts and returns the number of  beds available to the ward.
	* @access public
	* @param int Ward number
	* @return mixed integer or boolean
	*/
	function countBeds($ward_nr){
	    global $db;
		$this->sql="SELECT SUM(nr_of_beds) AS nr FROM $this->tb_room WHERE ward_nr=$ward_nr AND 
		is_temp_closed IN ('',0) AND status NOT IN ($this->dead_stat)";
        if($buf=$db->Execute($this->sql)) {
            if($buf->RecordCount()) {
				$row=$buf->FetchRow();
				 return $row['nr'];
			} else { return false; }
		} else { return false; }
	}
	/**
	* Creates and returns a list of patients waiting to be assigned a room or bed.
	*
	* The returned adodb record object contains rows of arrays.
	* Each array contains the  data with the following index keys:
	* - encounter_nr = encounter number
	* - encounter_class_nr  = encounter class number
	* - current_ward_nr = current ward number
	* - pid = PID number
	* - name_last  = Patient's last name
	* - name_first  = Patient's first name
	* - date_birth = date of birth
	* - sex = sex
	* - ward_id = ward id
	*
	* @access public
	* @param int Ward number
	* @return mixed adodb record object or boolean
	*/
	function createWaitingInpatientList($ward_nr=0){
		global $db;
		if($ward_nr) $cond="AND current_ward_nr='$ward_nr'";
			else $cond='';
		//if(empty($key)) return false;
		$this->sql="SELECT e.encounter_nr, e.encounter_class_nr, e.current_ward_nr, p.pid, p.name_last, p.name_first, p.date_birth, p.sex,w.ward_id
				FROM $this->tb_enc AS e 
					LEFT JOIN $this->tb_person AS p ON e.pid=p.pid
					LEFT JOIN $this->tb_ward AS w ON e.current_ward_nr=w.nr
				WHERE e.encounter_class_nr='1' AND  e.is_discharged IN ('',0) $cond AND  in_ward IN ('',0)";
		//echo $sql;
	    if ($this->res['_cwil']=$db->Execute($this->sql)){
		   	if ($this->rec_count=$this->res['_cwil']->RecordCount()){
				return $this->res['_cwil'];
			}else{return false;}
		}else{return false;}
	}
	/**
	* Returns current location information of an encounter.
	*
	* The returned adodb record object contains rows of arrays.
	* Each array contains the  data with the following index keys:
	* - ward_id = ward id
	* - ward_name = ward name
	* - roomprefix = room prefix
	* - dept_id  = department id
	* - dept_name = department default name
	* - room_nr = room number
	* - bed_nr = bed number
	*
	* @access public
	* @param int Encounter number
	* @return mixed adodb record object or boolean
	*/
	function EncounterLocationsInfo($enc_nr){
		global $db;

		$this->sql="SELECT w.ward_id,w.name AS ward_name, w.roomprefix,
							d.id AS dept_id,d.name_formal AS dept_name,
							r.location_nr AS room_nr, b.location_nr AS bed_nr
				FROM $this->tb_enc AS e 
					LEFT JOIN $this->tb_ward AS w ON e.encounter_class_nr=1 AND e.current_ward_nr=w.nr
					LEFT JOIN $this->tb_dept AS d ON (e.encounter_class_nr=1 AND e.current_ward_nr=w.nr AND w.dept_nr = d.nr)
																	OR	(e.encounter_class_nr=2 AND e.current_dept_nr=d.nr)
					LEFT JOIN $this->tb_location AS r ON r.encounter_nr=$enc_nr AND r.group_nr=w.nr AND r.type_nr=4 AND r.status<>'discharged'
					LEFT JOIN $this->tb_location AS b ON b.encounter_nr=$enc_nr AND  b.group_nr=w.nr AND b.type_nr=5 AND b.status<>'discharged'
					WHERE e.encounter_nr=$enc_nr AND e.status NOT IN ($this->dead_stat)";
		//echo $sql;
	    if ($this->res['eli']=$db->Execute($this->sql)){
		   	if ($this->rec_count=$this->res['eli']->RecordCount()){
				return $this->res['eli']->FetchRow();
			}else{return false;}
		}else{return false;}
	}
}
