<?php
/**
* @package care_api
*/

/**
*/
require_once($root_path.'include/care_api_classes/class_core.php');
/**
*  Image methods. 
*  Note this class should be instantiated only after a "$db" adodb  connector object  has been established by an adodb instance
* @author Elpidio Latorilla
* @version beta 2.0.1
* @copyright 2002,2003,2004,2005,2005 Elpidio Latorilla
* @package care_api
*/
class Image extends Core{
	/**
	* Table name for encounter's image data
	* @var string
	*/
	var $tb_image='care_encounter_image';
	/**
	* Table name for diagnostics images data
	* @var string
	*/
	var $tb_img_diag='care_img_diagnostic'; 
	/**
	* Default filter string for allowed file extensions
	* @var string
	*/
	var $mimefilter='jpg,jpeg,gif,png,bmp';
	/**
	* Holder for the uploaded file' extension/mime type
	* @var string
	*/
	var $ul_img_ext='';
	/**
	* Default root path for stored images
	* @var string
	*/
	var $def_root_path='fotos/encounter/';
	/**
	* Table name for person's registration data
	* @var string
	*/
	var $tb_person='care_person';
	/**
	* Field names of care_encounter_image table
	* @var array
	*/
	var $fld_image=array('nr',
									'encounter_nr',
									'shot_date',
									'shot_nr',
									'mime_type',
									'upload_date',
									'notes',
									'status',
									'history',
									'modify_id',
									'modify_time',
									'create_id',
									'create_time');
	/**
	* Field names of care_img_diagnostic table
	* @var array
	*/
	var $fld_img_diag=array('nr',
									'pid',
									'encounter_nr',
									'doc_ref_ids',
									'img_type',
									'max_nr',
									'upload_date',
									'cancel_date',
									'cancel_by',
									'notes',
									'status',
									'history',
									'modify_id',
									'modify_time',
									'create_id',
									'create_time');
										
	/**
	* Constructor
	*/
	function Image(){
		$this->coretable=$this->tb_image;
		$this->ref_array=$this->fld_image;
	}
	/**
	*  Checks if the image notes record exists in the table.
	*
	* The data is passed via an associative array containing the following index keys:
	* - encounter_nr = encounter number
	* - shot_date = date when image was taken
	* - shot_nr = number of the image
	*
	*  Returns true if  record is availabe (note it returns true even if the notes fields is empty)
	* @param array Data
	* @return mixed integer or boolean
	*/
	function ImageNotesExists(&$data){
		global $db;
		$row=array();
		$this->sql="SELECT nr FROM $this->tb_image WHERE encounter_nr=".$data['encounter_nr']." AND shot_date='".$data['shot_date']."' AND shot_nr=".$data['shot_nr'];
		if($this->result=$db->Execute($this->sql)) {
		    if($this->result->RecordCount()) {
				$row=$this->result->FetchRow();
				return $row['nr'];
		    } else { return false;}
		} else { return false;}
	}
	/**
	*  Checks if the image notes record exists in the table.
	*
	* @param array Data for updating
	* @return boolean
	*/
	function updateImageNotes(&$data){
	    global $db;
		if(empty($data['notes'])){
			return false;
		}else{
			$this->data_array=$data;
			$nr=$this->data_array['nr'];
			unset($this->data_array['nr']);
			#$this->data_array['notes']="CONCAT(notes,'[[".date('Y-m-d')."]]\n [[".$this->data_array['modify_id']."]]\n ".$this->data_array['notes']."\n')";
			$this->data_array['notes']=$this->ConcatNotes("[[".date('Y-m-d')."]]\n [[".$this->data_array['modify_id']."]]\n ".$this->data_array['notes']."\n");
			return $this->updateDataFromInternalArray($nr);
		}
	}
	/**
	* Gets the image' s data from the database table.
	*
	* The query data is passed via an associative array containing the following index keys:
	* - encounter_nr = encounter number
	* - shot_date = date when image was taken
	* - shot_nr = number of the image
	*
	* The returned adodb record object contains a row of array.
	* The array contains the data with the index keys as set in the <var>$fld_image</var> array.
	* @param array Data used for query constraint. By reference.
	* @return mixed adodb record object or boolean
	*/
	function getImageData(&$data){
		global $db;
		if(is_array($data)){
			$this->sql="SELECT * FROM $this->tb_image WHERE encounter_nr=".$data['encounter_nr']." AND shot_date='".$data['shot_date']."' AND shot_nr=".$data['shot_nr'];
		}else{
			$this->sql="SELECT * FROM $this->tb_image WHERE nr=$data";
		}
		if($this->result=$db->Execute($this->sql)) {
		    if($this->result->RecordCount()) {
				return $this->result;
		    } else { return false;}
		} else { return false;}
	}
	/**
	* Gets the last shot number of an image data by encounter number and shot date.
	*
	* The query data is passed via an associative array containing the following index keys:
	* - encounter_nr = encounter number
	* - shot_date = date when image was taken
	* - shot_nr = number of the image
	*
	* @param array Data used for query constraint. By reference.
	* @return mixed adodb record object or boolean
	*/
	function getLastShotNr(&$data){
		global $db;
		$this->sql="SELECT shot_nr FROM $this->tb_image WHERE encounter_nr=".$data['encounter_nr']." AND shot_date='".$data['shot_date']."' ORDER BY shot_nr DESC";
		if($this->result=$db->SelectLimit($this->sql,1)) {
		    if($this->result->RecordCount()) {
				$row=$this->result->FetchRow();
				return $row['shot_nr'];
		    } else { return false;}
		} else { return false;}
	}
	/**
	* Saves all data pertinent to the image.
	* 
	* If successful, the last insert ID will be returned.
	* @access public
	* @param array Data to be saved.
	* @return mixed integer or boolean
	*/
	function saveImageData(&$data){
	    global $db;
		$nr=0;
		if(empty($data['encounter_nr'])){
			return FALSE;
		}else{
			if($nr=$this->getLastShotNr($data)){
				$data['shot_nr']=$nr+1;
			}else{
				$data['shot_nr']=1;
			}
			$this->data_array=$data;
			if($this->insertDataFromInternalArray()){
				return $db->Insert_ID();
			}else{
				return FALSE;
			}
		}
	}
	/**
	* Gets all data from the care_encounter_image table which are pertinent to the encounter.
	* @access public
	* @param int Encounter number
	* @param string Shot date of the image
	* @return mixed ADODB record object or boolean
	*/
	function getAllImageData($enc_nr,$shot_date=0){
		global $db;
		if($shot_date){
			$this->sql="SELECT * FROM $this->tb_image WHERE encounter_nr=$enc_nr AND shot_date='$shot_date' ORDER BY shot_date DESC";
		}else{
			$this->sql="SELECT * FROM $this->tb_image WHERE encounter_nr=$enc_nr ORDER BY shot_date DESC";
		}
		if($this->result=$db->Execute($this->sql)) {
		    if($this->result->RecordCount()) {
				return $this->result;
		    }else{ return false;}
		}else{ return false;}
	}
	/**
	* Checks whether the uploaded image file is valid or not.
	*
	* File's extension/mime type will be extracted and saved in the internal <var>$ul_img_ext</var> buffer.
	* @access public
	* @param array  Image pointer, (pass by reference) usually $_FILES
	* @param string  Optional filter string for mime types. If empty, default filter string <var>$mimefilter</var> will be used
	* @return boolean
	*/
	function isValidUploadedImage(&$img,$mfilter=''){
		if(empty($mfilter)) $mfilter=$this->mimefilter;
		if(is_uploaded_file($img['tmp_name']) && $img['size']){
			$this->ul_img_ext=substr($img['name'],strrpos($img['name'],'.')+1);
			if(stristr($mfilter,$this->ul_img_ext)){
				return true;
		    }else{ return false;}
		}else{ return false;}
	}
	/**
	* Returns the extension/mime type of the uploaded image file that was checked by the isValidUploadedImage() method.
	*
	* @access public
	* @return string
	*/
	function UploadedImageMimeType(){
		return $this->ul_img_ext;
	}
	/**
	* Saves the uploaded image with the given filename into a given path.
	*
	* @access public
	* @param array  Image file in array (pass by reference) (usually $_FILES)
	* @param string Complete path for the stored image. If empty, the default <var>$def_root_path</var> will be used.
	* @param string Filename of the stored image. If empty, the original file name will be used.
	*/
	function saveUploadedImage(&$img,$fpath='',$fname=''){
		if(empty($fpath)) $fpath=$this->def_root_path;
		if(empty($fname)) return copy($img['tmp_name'],$fpath.$img['name']);
	 		else return copy($img['tmp_name'],$fpath.$fname);
	}
	/**
	* Gets a list of dicom images.
	*
	* The returned adodb record object contains rows of arrays.
	* Each array contains the data with the following index keys:
	* - nr = primary key number of the image record entry
	* - encounter_nr = encounter number of the dicom image (if available)
	* - upload_date = date of image upload
	* - max_nr = number of images within the image group
	* - note_len = the length of notes (if available)
	* - pid = the patient's PID number
	* - name_last = patient's last or family name
	* - name_first = patient's first or given name
	* - date_birth = date of birth
	*
	* @param string  Search keyword. If empty all dicom images will be returned as list.
	* @access public
	* @return mixed adodb record object or boolean
	*/
	function DicomImages($key=''){
		global $db, $sql_LIKE;
		$this->sql="SELECT i.nr, i.encounter_nr, i.upload_date, i.max_nr, LENGTH(i.notes) AS note_len,
						p.pid, p.name_last, p.name_first, p.date_birth
				FROM $this->tb_img_diag AS i, $this->tb_person AS p";
		if(!empty($key)){
			if(is_numeric($key)){
				$key=(int)$key;
				$this->sql.=" WHERE (i.encounter_nr = $key OR i.pid = $key)";
			}else{
				$this->sql.=" WHERE (i.encounter_nr $sql_LIKE '$key%' 
						OR i.pid $sql_LIKE '$key%'
						OR p.name_last $sql_LIKE '$key%'
						OR p.name_first $sql_LIKE '$key%' )";
			}
			$this->sql.=' AND';
		}else{
			$this->sql.=' WHERE';
		}
		$this->sql.="  i.pid=p.pid AND i.img_type='dicom' AND i.status NOT IN ('cancelled',$this->dead_stat) 
					ORDER BY p.name_last, p.name_first, i.pid";
		//echo $this->sql;
	    if ($this->res['pdi']=$db->Execute($this->sql)) {
		   	if ($this->rec_count=$this->res['pdi']->RecordCount()) {
				return $this->res['pdi'];
			}else{return false;}
		}else{return false;}
	}	
	/**
	* Gets a dicom image based on its primary key number.
	*
	* The returned  array contains the data with the index keys as set in the <var>$fld_img_diag</var> array.
	* @param int Record number.
	* @access public
	* @return mixed array or boolean
	*/
	function getDicomImage($nr=''){
		global $db;
		$this->sql="SELECT * FROM $this->tb_img_diag WHERE nr=$nr";
		//echo $this->sql;
	    if ($this->res['gdi']=$db->Execute($this->sql)) {
		   	if ($this->rec_count=$this->res['gdi']->RecordCount()){
				return $this->res['gdi']->FetchRow();
			}else{return false;}
		}else{return false;}
	}	
	/**
	* Sets the core table and fields to care_img_diagnostic table.
	*/
	function useImgDiagnostic(){
		$this->coretable=$this->tb_img_diag;
		$this->ref_array=$this->fld_img_diag;
	}
	/**
	* Saves all data to care_img_diagnostic table.
	*
	* If successful, the last insert ID will be returned, else FALSE.
	* @access public
	* @param array Image data for saving.
	* @return mixed string or boolean
	*/
	function saveImgDiagnosticData(&$data){
	    global $db;
		# set core to care_img_diagnostic
		$this->useImgDiagnostic();
		$this->data_array=$data;
		if($this->insertDataFromInternalArray()){
			return $db->Insert_ID();
		}else{return false;}
	}
	/**
	* Deletes an image record based on its "nr" value.
	* @access private
	* @param int Primary key number of image record.
	* @return boolean
	*/
	function __delete($nr){
		if(!$nr) return false;
		$this->sql="DELETE FROM $this->coretable WHERE nr=$nr";
		return $this->Transact();
	}
	/**
	* Sets the value of max_nr of care_img_diagnostic table.
	* @access public
	* @param int Primary key number of image record.
	* @param int Maximum number
	* @return boolean
	*/
	function setImgMaxNr($nr=0,$count){
	    global $db;
		if(!$nr) return false;
		$this->sql="UPDATE $this->tb_img_diag SET max_nr=$count WHERE nr=$nr";
		return $this->Transact();
	}
	/**
	* Returns the notes of an image.
	*
	* @access public
	* @param int Primary key number of image record.
	* @return mixed string or boolean
	*/
	function ImgNotes($nr=0){
	    global $db;
		if(!$nr) return false;
		$this->sql="SELECT notes FROM $this->tb_img_diag WHERE nr=$nr";
		if($buff=$db->Execute($this->sql)) {
		    if($this->rec_count=$buff->RecordCount()) {
				$row=$buff->FetchRow();
				return $row['notes'];
		    } else { return false;}
		} else { return false;}
	}
	
	/*
	* Returns the GD version
	*/
	function gd_version() {
		//  By Justin Greer ... source http://de.php.net/manual/en/function.imagecreatetruecolor.php
		static $gd_version_number = null;
		if ($gd_version_number === null) {
		// Use output buffering to get results from phpinfo()
 		// without disturbing the page we're in.  Output
		// buffering is "stackable" so we don't even have to
		// worry about previous or encompassing buffering.
			ob_start();
			phpinfo(8);
			$module_info = ob_get_contents();
			ob_end_clean();
			if (preg_match("/\bgd\s+version\b[^\d\n\r]+?([\d\.]+)/i", $module_info, $matches)) {
				$gd_version_number = $matches[1];
			} else {
				$gd_version_number = 0;
			}
   		}
   		return $gd_version_number;
	}
}
?>
