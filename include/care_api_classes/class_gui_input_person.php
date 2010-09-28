<?php
/**
* @package care_api
*/


require_once($root_path.'include/care_api_classes/class_core.php');

/**
*  GUI input form for person registration methods.
*
* Dependencies:
* assumes the following files are in the given path
* /include/care_api_classes/class_person.php
* /include/care_api_classes/class_paginator.php
* /include/care_api_classes/class_globalconfig.php
* /include/core/inc_date_format_functions.php
*  Note this class should be instantiated only after a "$db" adodb  connector object  has been established by an adodb instance
* @author Elpidio Latorilla
* @version beta 2.0.1
* @copyright 2002,2003,2004,2005,2005 Elpidio Latorilla
* @KB by Kurt Brauchli
* @package care_api
*/

$thisfile = basename($_SERVER['PHP_SELF']);

class GuiInputPerson {

	# Language tables
	var $langfiles= array('emr.php', 'person.php', 'date_time.php', 'aufnahme.php');

	# Default path for fotos. Make sure that this directory exists!
	var $default_photo_path='uploads/photos/registration';

	# Filename of file running this gui
	var $thisfile = '';

	# PID number
	var $pid=0;

	# Toggler var
	var $toggle=0;

	# Color of error text
	var $error_fontcolor='#ff0000';

	# Text block above form
	var $pretext='';
	# Text block below the form
	var $posttext='';

	# filename for displaying the data after saving
	var $displayfile='';

	# smarty template
	var $smarty;

	# Flag for output or returning form data
	var $bReturnOnly = FALSE;

	/**
	* Constructor
	*/
	function GuiInputPerson($filename = ''){
		global $thisfile, $root_path;
		if(empty($filename)) $this->thisfile = $thisfile;
			else $this->thisfile = $filename;
	}
	/**
	* Sets the PID number
	*/
	function setPID($pid=0){
		if(!empty($pid)) $this->pid = $pid;
	}
	/**
	* Sets the PID number
	*/
	function setDisplayFile($fn=''){
		if(!empty($fn)) $this->displayfile = $fn;
	}
	/**
	* Create a row of input element in the form
	*/
	function createTR($error_handler, $input_name, $ld_text, $input_val, $colspan = 1, $input_size = 35,$red=FALSE){
		ob_start();
		    $this->smarty->assign('must','');
			if ($error_handler || $red) {
			    $sBuffer="<font color=\"$this->error_fontcolor\">* $ld_text</font>";
			    $this->smarty->assign('must',1);
			}
			else $sBuffer=$ld_text;
			//$this->smarty->assign('must',1);
			$this->smarty->assign('sItem',$sBuffer);
			$this->smarty->assign('sColSpan2',"colspan=$colspan");
			$this->smarty->assign('sInput','<input name="'.$input_name.'" type="text" size="'.$input_size.'" value="'.$input_val.'" >');
			$this->smarty->display('registration_admission/reg_row.tpl');
			$sBuffer = ob_get_contents();
		ob_end_clean();

		//$this->toggle=!$this->toggle;

		return $sBuffer;
	}
	/**
	* Displays the GUI input form
	*/
	function display(){
		global $db, $sid, $lang, $root_path, $pid, $insurance_show, $user_id, $mode, $dbtype, $breakfile, $cfg,
				$update, $photo_filename, $_POST,  $_FILES, $_SESSION;

		extract($_POST);

		# Load the language tables
		$lang_tables =$this->langfiles;
		include($root_path.'include/core/inc_load_lang_tables.php');

		# Load the other hospitals array
		include_once($root_path.'global_conf/other_hospitals.php');

		include_once($root_path.'include/core/inc_date_format_functions.php');
		include_once($root_path.'include/care_api_classes/class_insurance.php');
		include_once($root_path.'include/care_api_classes/class_person.php');

		//$db->debug=true;

		# Create the new person object
		$person_obj=& new Person($pid);

		# Create a new person insurance object
		$pinsure_obj=& new PersonInsurance($pid);

		if(!isset($insurance_show)) $insurance_show=TRUE;

		$newdata=1;

		$error=0;
		$dbtable='care_person';

		if(!isset($photo_filename)||empty($photo_filename)) $photo_filename='nopic';
		# Assume first that image is not uploaded
		$valid_image=FALSE;

		//* Get the global config for person's registration form*/
		include_once($root_path.'include/care_api_classes/class_globalconfig.php');
		$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
		$glob_obj->getConfig('person_%');

		//extract($GLOBAL_CONFIG);

		# Check whether config foto path exists, else use default path
		$photo_path = (is_dir($root_path.$GLOBAL_CONFIG['person_foto_path'])) ? $GLOBAL_CONFIG['person_foto_path'] : $this->default_photo_path;

		if (($mode=='save') || ($mode=='forcesave')) {

			# If saving is not forced, validate important elements
			if($mode!='forcesave') {
				# clean and check input data variables
				if (trim($encoder)=='') $encoder=$aufnahme_user;
				if (trim($name_last)=='') { $errornamelast=1; $error++;}
				if (trim($name_first)=='') { $errornamefirst=1; $error++; }
				if (trim($date_birth)=='') { $errordatebirth=1; $error++;}
				if (trim($addr_str)=='') { $errorstreet=1; $error++;}
				if (trim($addr_str_nr)=='') { $errorstreetnr=1; $error++;}
				if ($addr_citytown_nr&&(trim($addr_citytown_name)=='')) { $errortown=1; $error++;}
				if ($sex=='') { $errorsex=1; $error++;}
				if($insurance_show) {
					if(trim($insurance_nr) && (trim($insurance_firm_name)=='')) { $errorinsurancecoid=1; $error++;}
				}
			}


			# If the validation produced no error, save the data
			if(!$error) {
				# Save the old filename for testing
				$old_fn=$photo_filename;

				# Create image object
				include_once($root_path.'include/care_api_classes/class_image.php');
				$img_obj=& new Image;

				# Check the uploaded image file if exists and valid
				if($img_obj->isValidUploadedImage($_FILES['photo_filename'])){
					$valid_image=TRUE;
					# Get the file extension
					$picext=$img_obj->UploadedImageMimeType();
				}

				if(($update)) {

					//echo formatDate2STD($geburtsdatum,$date_format);
					$sql="UPDATE $dbtable SET
							 title='$title',
							 name_last='$name_last',
							 name_first='$name_first',
							 name_2='$name_2',
							 name_3='$name_3',
							 name_middle='$name_middle',
							 name_maiden='$name_maiden',
							 name_others='$name_others',
							 date_birth='".formatDate2STD($date_birth,$date_format)."',
							 blood_group='".trim($blood_group)."',
							 sex='$sex',
							 addr_str='$addr_str',
							 addr_str_nr='$addr_str_nr',
							 addr_zip='$addr_zip',
							 addr_citytown_nr='$addr_citytown_nr',
							 phone_1_nr='$phone_1_nr',
							 phone_2_nr='$phone_2_nr',
							 cellphone_1_nr='$cellphone_1_nr',
							 cellphone_2_nr='$cellphone_2_nr',
							 fax='$fax',
							 email='$email',
							 citizenship='$citizenship',
							 civil_status='$civil_status',
							 sss_nr='$sss_nr',
							 nat_id_nr='$nat_id_nr',
							 religion='$religion',
							 ethnic_orig='$ethnic_orig',
							 date_update='".date('Y-m-d H:i:s')."',";

					if ($valid_image){
						# Compose the new filename
						$photo_filename=$pid.'.'.$picext;
						# Save the file
						$img_obj->saveUploadedImage($_FILES['photo_filename'],$root_path.$photo_path.'/',$photo_filename);
				   		# add to the sql query
						$sql.=" photo_filename='$photo_filename',";
					}

					# complete the sql query
					$sql.=" history=".$person_obj->ConcatHistory("Update ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']." \n").", modify_id='".$_SESSION['sess_user_name']."' WHERE pid=$pid";

					//$db->debug=true;
					$db->BeginTrans();
					$ok=$db->Execute($sql);
					if($ok) {
						$db->CommitTrans();
						# Update the insurance data
						# Lets detect if the data is already existing
						if($insurance_show) {
							if($insurance_item_nr) {
								if(!empty($insurance_nr) && !empty($insurance_firm_name) && $insurance_firm_id) {

									$insure_data=array('insurance_nr'=>$insurance_nr,
											'firm_id'=>$insurance_firm_id,
											'class_nr'=>$insurance_class_nr,
											'history'=>"Update ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']." \n",
											'modify_id'=>$_SESSION['sess_user_name'],
											'modify_time'=>date('YmdHis')
											);

									$pinsure_obj->updateDataFromArray($insure_data,$insurance_item_nr);
								}
							} elseif ($insurance_nr && $insurance_firm_name  && $insurance_class_nr) {
								$insure_data=array('insurance_nr'=>$insurance_nr,
											'firm_id'=>$insurance_firm_id,
											'pid'=>$pid,
											'class_nr'=>$insurance_class_nr,
											'history'=>"Update ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']." \n",
											'create_id'=>$_SESSION['sess_user_name'],
											'create_time'=>date('YmdHis')
										);
								$pinsure_obj->insertDataFromArray($insure_data);
							}
						}
						$newdata=1;
						//$db->debug=1;
						// KB: save other_his_no
						if( isset($_POST['other_his_org']) && !empty($_POST['other_his_org'])){
							$person_obj->OtherHospNrSet($_POST['other_his_org'], $_POST['other_his_no'], $_SESSION['sess_user_name'] );
						}

						if(file_exists($this->displayfile)){
							header("Location: $this->displayfile".URL_REDIRECT_APPEND."&pid=$pid&from=$from&newdata=1&target=entry");
							exit;
						}else{
							echo "Error! Target display file not defined!!";
						}
					} else {
						$db->RollbackTrans();
					}
  				} else {
					$from='entry';
					$_POST['date_birth']=@formatDate2STD($date_birth,$date_format);
					$_POST['date_reg']=date('Y-m-d H:i:s');
					$_POST['blood_group']=trim($_POST['blood_group']);
					$_POST['status']='normal';
					$_POST['history']="Init.reg. ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."\n";
					//$_POST['modify_id']=$_SESSION['sess_user_name'];
					$_POST['create_id']=$_SESSION['sess_user_name'];
					$_POST['create_time']=date('YmdHis');

					# Prepare internal data to be stored together with the user input data
					if(!$person_obj->InitPIDExists($GLOBAL_CONFIG['person_id_nr_init'])){
						# If db is mysql, insert the initial pid value  from global config
						# else let the dbms make an initial value via the sequence generator e.g. postgres
						# However, the sequence generator must be configured during db creation to start at
						# the initial value set in the global config
						if($dbtype=='mysql'){
							$_POST['pid']=$GLOBAL_CONFIG['person_id_nr_init'];
						}
					}else{
						# Persons are existing. Check if duplicate might exist
						if(is_object($duperson=$person_obj->PIDbyData($_POST))){
							$error_person_exists=TRUE;
						}
					}
					//echo $person_obj->getLastQuery();

					if(!$error_person_exists||$mode=='forcesave'){
						if($person_obj->insertDataFromInternalArray()){

							# If data was newly inserted, get the insert id if mysql,
							# else get the pid number from the latest primary key

							if(!$update){
								$oid = ( (isset($pid) && ($pid > 0) ) ? $db->Insert_ID() : $_POST['pid'] );
								$pid=$person_obj->LastInsertPK('pid',$oid);
								//EL: set the new pid
								$person_obj->setPID($pid);
							}

							// KB: save other_his_no
							if( isset($_POST['other_his_org']) && !empty($_POST['other_his_org'])){
								$person_obj->OtherHospNrSet($_POST['other_his_org'], $_POST['other_his_no'], $_SESSION['sess_user_name'] );
							}

							# Save the valid uploaded photo
							if($valid_image){
								# Compose the new filename by joining the pid number and the file extension with "."
								$photo_filename=$pid.'.'.$picext;
								# Save the file
								if($img_obj->saveUploadedImage($_FILES['photo_filename'],$root_path.$photo_path.'/',$photo_filename)){
									# Update the filename to the databank
									$person_obj->setPhotoFilename($pid,$photo_filename);
								}
							}

							//echo $pid;
							# Update the insurance data
							# Lets detect if the data is already existing
							if($insurance_show) {
				  				if($insurance_item_nr) {
									if(!empty($insurance_nr) && !empty($insurance_firm_name) && $insurance_firm_id) {
										$insure_data=array('insurance_nr'=>$insurance_nr,
													'firm_id'=>$insurance_firm_id,
													'class_nr'=>$insurance_class_nr);
										$pinsure_obj->updateDataFromArray($insure_data,$insurance_item_nr);
									}
								} elseif ($insurance_nr && $insurance_firm_name  && $insurance_class_nr) {
									$insure_data=array('insurance_nr'=>$insurance_nr,
													'firm_id'=>$insurance_firm_id,
													'pid'=>$pid,
													'class_nr'=>$insurance_class_nr);
									$pinsure_obj->insertDataFromArray($insure_data);
								}
							}
							$newdata=1;
							if(file_exists($this->displayfile)){
								header("Location: $this->displayfile".URL_REDIRECT_APPEND."&pid=$pid&from=$from&newdata=1&target=entry");
								exit;
							}else{
								echo "Error! Target display file not defined!!";
							}
						}else {
							echo "<p>$db->ErrorMsg()<p>$LDDbNoSave";
						}
					}
				}
			} // end of if(!$error)
		}elseif(!empty($this->pid)){
			 # Get the person�s data
			if($data_obj=&$person_obj->getAllInfoObject()){

				$zeile=$data_obj->FetchRow();
				extract($zeile);

				# Get the related insurance data
				$p_insurance=&$pinsure_obj->getPersonInsuranceObject($pid);
				if($p_insurance==FALSE) {
					$insurance_show=TRUE;
				} else {
					if(!$p_insurance->RecordCount()) {
						$insurance_show=TRUE;
					} elseif ($p_insurance->RecordCount()==1){
						$buffer= $p_insurance->FetchRow();
						extract($buffer);
						$insurance_show=TRUE;
						$insurance_firm_name=$pinsure_obj->getFirmName($insurance_firm_id);
					} else {
						$insurance_show=FALSE;
					}
				}
			}
		} else {
			$date_reg=date('Y-m-d H:i:s');
		}
		# Get the insurance classes
		$insurance_classes=&$pinsure_obj->getInsuranceClassInfoObject('class_nr,name,LD_var AS "LD_var"');

		include_once($root_path.'include/core/inc_photo_filename_resolve.php');

		#
		#
		########  Here starts the GUI output #######################################################
		#
		#

		# Start Smarty templating here
		# Create smarty object without initiliazing the GUI (2nd param = FALSE)

		include_once($root_path.'gui/smarty_template/smarty_care.class.php');
		$this->smarty = new smarty_care('common',FALSE);

		$img_male=createComIcon($root_path,'spm.gif','0');
		$img_female=createComIcon($root_path,'spf.gif','0');

		if(!empty($this->pretext)) $this->smarty->assign('pretext',$this->pretext);

		# Collect extay javascript code
		$sTemp='';
		ob_start();
?>
		<script  language="javascript">

		function forceSave(){
			document.aufnahmeform.mode.value="forcesave";
			document.aufnahmeform.submit();
		}

		function showpic(d){
			if(d.value) document.images.headpic.src=d.value;
			if(d.value) document.images.headpic.src=d.value;
		}

		function popSearchWin(target,obj_val,obj_name){
			urlholder="./data_search.php<?php echo URL_REDIRECT_APPEND; ?>&target="+target+"&obj_val="+obj_val+"&obj_name="+obj_name;
			DSWIN<?php echo $sid ?>=window.open(urlholder,"wblabel<?php echo $sid ?>","menubar=no,width=400,height=550,resizable=yes,scrollbars=yes");
		}

		function chkform(d) {
			if(d.name_last.value==""){
				alert("<?php echo $LDPlsEnterLastName; ?>");
				d.name_last.focus();
				return false;
			}else if(d.name_first.value==""){
				alert("<?php echo $LDPlsEnterFirstName; ?>");
				d.name_first.focus();
				return false;
			}else if(d.date_birth.value==""){
				alert("<?php echo $LDPlsEnterDateBirth; ?>");
				d.date_birth.focus();
				return false;
			}else if(d.sex[0]&&d.sex[1]&&!d.sex[0].checked&&!d.sex[1].checked){
				alert("<?php echo $LDPlsSelectSex; ?>");
				return false;
			}else if(d.addr_str.value==""){
				alert("<?php echo $LDPlsEnterStreetName; ?>");
				d.addr_str.focus();
				return false;
			}else if(d.addr_zip.value==""){
				alert("<?php echo $LDPlsEnterZip; ?>");
				d.addr_zip.focus();
				return false;
			}else if(d.user_id.value==""){
				alert("<?php echo $LDPlsEnterFullName; ?>");
				d.user_id.focus();
				return false;
			}else{
				return true;
			}
		}

		function updateAddress( zipCode, addressNr ) {
			document.getElementById('addr_zip').value = zipCode;
			document.getElementById('addr_citytown_nr').value = addressNr;
		}

<?php
		require($root_path.'include/core/inc_checkdate_lang.php');
?>
		</script>
<?php
		//gjergji : new calendar
		require_once ('../../js/jscalendar/calendar.php');
		$calendar = new DHTML_Calendar('../../js/jscalendar/', $lang, 'calendar-system', true);
		$calendar->load_files();
		//end : gjergji
		$sTemp = ob_get_contents();
		ob_end_clean();

		$this->smarty->assign('sRegFormJavaScript',$sTemp);

		$this->smarty->assign('thisfile',$thisfile);

		if($error) {
			$this->smarty->assign('error',TRUE);
			$this->smarty->assign('sErrorImg','<img '.createMascot($root_path,'mascot1_r.gif','0','bottom').' align="absmiddle">');
			if ($error>1) $this->smarty->assign('sErrorText',$LDErrorS);
				else $this->smarty->assign('sErrorText',$LDError);

		}elseif($error_person_exists){
			$this->smarty->assign('errorDupPerson',TRUE);
			$this->smarty->assign('sErrorImg','<img '.createMascot($root_path,'mascot1_r.gif','0','bottom').' align="absmiddle">');
			$this->smarty->assign('LDPersonDuplicate',$LDPersonDuplicate);
			if($duperson->RecordCount()>1) $this->smarty->assign('sErrorText',"$LDSimilarData2 $LDPlsCheckFirst2");
				else $this->smarty->assign('sErrorText',"$LDSimilarData $LDPlsCheckFirst");

			$this->smarty->assign('sDupDataColNameRow',"<tr class=\"reg_div\">
					<td><FONT  SIZE=-1  FACE=\"Arial\" color=\"#000066\"><b>
						$LDRegistryNr</b></td>
					<td><FONT  SIZE=-1  FACE=\"Arial\" color=\"#000066\"><b>
						$LDLastName</b></td>
					<td><FONT  SIZE=-1  FACE=\"Arial\" color=\"#000066\"><b>
						$LDFirstName</b></td>
					<td><FONT  SIZE=-1  FACE=\"Arial\" color=\"#000066\"><b>
						$LDBday</b></td>
					<td><FONT  SIZE=-1  FACE=\"Arial\" color=\"#000066\"><b>
						$LDSex</b></td>
					<td><FONT  SIZE=-1  FACE=\"Arial\" color=\"#000066\"><b>
						$LDOptions</b></td>
					</tr>");

			# List and show the probable same person(s)

			$toggler=FALSE;
			$sTemp='';
			while($dup=$duperson->FetchRow()){
				if($toggler) $sRowClass='wardlistrow2';
					else $sRowClass='wardlistrow1';
				$toggler = !$toggler;
				$sTemp= $sTemp."\n".'
					<tr class="'.$sRowClass.'">
					<td>'.$dup['pid'].'</td>
					<td>'.$dup['name_last'].'</td>
					<td>'.$dup['name_first'].'</td>
					<td>'.formatDate2Local($dup['date_birth'],$date_format).'</td>
					<td>';
				switch($dup['sex']){
					case 'f': $sTemp = $sTemp.'<img '.$img_female.'>'; break;
					case 'm': $sTemp = $sTemp.'<img '.$img_male.'>'; break;
					default: $sTemp = $sTemp.'&nbsp;';
				}
				$sTemp = $sTemp.'
					</td>
					<td>:: <a href="person_reg_showdetail.php'.URL_APPEND.'&pid='.$dup['pid'].'&from=$from&newdata=1&target=entry" target="_blank">'.$LDShowDetails.'</a> ::
					<a href="patient_register.php'.URL_APPEND.'&pid='.$dup['pid'].'&update=1">'.$LDUpdate.'</a>
					</td>
					</tr>';
			}
			$this->smarty->assign('sDupDataRows',$sTemp);
		}

		if($pid) $this->smarty->assign('LDRegistryNr',$LDRegistryNr);
		$this->smarty->assign('pid',$pid);
		$this->smarty->assign('img_source',$img_source);
		$this->smarty->assign('LDPhoto',$LDPhoto);
		if(isset($photo_filename)) $pfile= $photo_filename;
			else $pfile='';
		$this->smarty->assign('sFileBrowserInput','<input name="photo_filename" type="file" size="15"   onChange="showpic(this)" value="'.$pfile.'">');

		# iRowSpanCount counts the rows on the left of the photo image. Begin with 5 because there are 5 static rows.
		$iRowSpanCount = 5;

		$this->smarty->assign('LDRegDate',$LDRegDate);
		$this->smarty->assign('sRegDate',formatDate2Local($date_reg,$date_format).'<input name="date_reg" type="hidden" value="'.$date_reg.'">');

		//$iRowSpanCount++;
		$this->smarty->assign('LDRegTime',$LDRegTime);
		$this->smarty->assign('sRegTime',convertTimeToLocal(formatDate2Local($date_reg,$date_format,0,1)));

		// Made hideable as suggested by Kurt brauchli
		if (!$GLOBAL_CONFIG['person_title_hide']){
			$this->smarty->assign('sPersonTitle',$this->createTR( $errortitle, 'title', $LDTitle, $title, '', 14 ));
			$iRowSpanCount++;
		}

		$this->smarty->assign('sNameLast',$this->createTR($errornamelast, 'name_last', $LDLastName,$name_last,'',35,TRUE));
		//$iRowSpanCount++;
		$this->smarty->assign('sNameFirst',$this->createTR($errornamefirst, 'name_first', $LDFirstName,$name_first,'',35,TRUE));
		//$iRowSpanCount++;

		if (!$GLOBAL_CONFIG['person_name_2_hide']){
			$this->smarty->assign('sName2',$this->createTR($errorname2, 'name_2', $LDName2,$name_2));
			$iRowSpanCount++;
		}

		if (!$GLOBAL_CONFIG['person_name_3_hide']){
			$this->smarty->assign('sName3',$this->createTR($errorname3, 'name_3', $LDName3,$name_3));
			$iRowSpanCount++;
		}

		if (!$GLOBAL_CONFIG['person_name_middle_hide']){
			$this->smarty->assign('sNameMiddle',$this->createTR($errornamemid, 'name_middle', $LDNameMid,$name_middle));
			$iRowSpanCount++;
		}

		if (!$GLOBAL_CONFIG['person_name_maiden_hide']){
			$this->smarty->assign('sNameMaiden',$this->createTR($errornamemaiden, 'name_maiden', $LDNameMaiden,$name_maiden));
			$iRowSpanCount++;
		}

		if (!$GLOBAL_CONFIG['person_name_others_hide']){
			$this->smarty->assign('sNameOthers',$this->createTR($errornameothers, 'name_others', $LDNameOthers,$name_others));
			$iRowSpanCount++;
		}

		# Set the rowspan value for the photo image <td>
		$this->smarty->assign('sPicTdRowSpan',"rowspan=$iRowSpanCount");

		if ($errordatebirth) $this->smarty->assign('LDBday',"<font color=red>* $LDBday</font>:");
		else $this->smarty->assign('LDBday',"<font color=red>*</font> $LDBday:");

		//gjergji : new calendar
		$this->smarty->assign('sBdayInput',$calendar->show_calendar($calendar,$date_format,'date_birth',$date_birth));
		//end gjergji

		if ($errorsex) $this->smarty->assign('LDSex', "<font color=#ff0000>* $LDSex</font>:");
		else $this->smarty->assign('LDSex', "<font color=#ff0000>*</font> $LDSex:");

		$sSexMBuffer='<input name="sex" type="radio" value="m"  ';
		if($sex=="m") $sSexMBuffer.=' checked>';
		else $sSexMBuffer.='>';
		$this->smarty->assign('sSexM',$sSexMBuffer);
		$this->smarty->assign('LDMale',$LDMale);

		$sSexFBuffer ='<input name="sex" type="radio" value="f"  ';
		if($sex=="f") $sSexFBuffer.='checked>';
		else $sSexFBuffer.='>';
		$this->smarty->assign('sSexF',$sSexFBuffer);
		$this->smarty->assign('LDFemale',$LDFemale);

		# But patch 2004-03-10
		# Clean blood group
		$blood_group = trim($blood_group);

		//  Made hideable as suggested by Kurt Brauchli
		if (!$GLOBAL_CONFIG['person_bloodgroup_hide'] ){
			$this->smarty->assign('LDBloodGroup',$LDBloodGroup);
			$sBGBuffer='
				<input name="blood_group" type="radio" value="A" ';
			if($blood_group=='A') $sBGBuffer.='checked';
			$sBGBuffer.='>';
			$this->smarty->assign('sBGAInput',$sBGBuffer);
			$this->smarty->assign('LDA',$LDA);

			$sBGBuffer='
				<input name="blood_group" type="radio" value="B" ';
			if($blood_group=='B') $sBGBuffer.='checked';
			$sBGBuffer.='>';
			$this->smarty->assign('sBGBInput',$sBGBuffer);
			$this->smarty->assign('LDB',$LDB);

			$sBGBuffer='
				<input name="blood_group" type="radio" value="AB" ';
			if($blood_group=='AB') $sBGBuffer.='checked';
			$sBGBuffer.='>';
			$this->smarty->assign('sBGABInput',$sBGBuffer);
			$this->smarty->assign('LDAB',$LDAB);

			$sBGBuffer='
				<input name="blood_group" type="radio" value="O" ';
			if($blood_group=='O') $sBGBuffer.='checked';
			$sBGBuffer.='>';
			$this->smarty->assign('sBGOInput',$sBGBuffer);
			$this->smarty->assign('LDO',$LDO);
		}
		// KB: make civil status hideable
		if (!$GLOBAL_CONFIG['person_civilstatus_hide']){
			$this->smarty->assign('LDCivilStatus',$LDCivilStatus);
			$sCSInput='<input name="civil_status" type="radio" ';

			$sCSBuffer = $sCSInput.'value="single" ';
			if($civil_status=="single") $sCSBuffer.='checked';
			$this->smarty->assign('sCSSingleInput',$sCSBuffer.'>');

			$sCSBuffer = $sCSInput.'value="married" ';
			if($civil_status=="married") $sCSBuffer.='checked';
			$this->smarty->assign('sCSMarriedInput',$sCSBuffer.'>');


			$sCSBuffer = $sCSInput.'value="divorced" ';
			if($civil_status=="divorced") $sCSBuffer.='checked';
			$this->smarty->assign('sCSDivorcedInput',$sCSBuffer.'>');


			$sCSBuffer = $sCSInput.'value="widowed" ';
			if($civil_status=="widowed") $sCSBuffer.='checked';
			$this->smarty->assign('sCSWidowedInput',$sCSBuffer.'>');

			$sCSBuffer = $sCSInput.'value="separated" ';
			if($civil_status=="separated") $sCSBuffer.='checked';
			$this->smarty->assign('sCSSeparatedInput',$sCSBuffer.'>');

			$this->smarty->assign('LDSingle',$LDSingle);
			$this->smarty->assign('LDMarried',$LDMarried);
			$this->smarty->assign('LDDivorced',$LDDivorced);
			$this->smarty->assign('LDWidowed',$LDWidowed);
			$this->smarty->assign('LDSeparated',$LDSeparated);
		}

		if ($erroraddress) $this->smarty->assign('LDAddress',"<font color=red>$LDAddress</font>:");
			else $this->smarty->assign('LDAddress',"$LDAddress:");

		if ($errorstreet) $this->smarty->assign('LDStreet',"<font color=red><font color=#ff0000>*</font> $LDStreet</font>:");
			else $this->smarty->assign('LDStreet',"<font color=#ff0000>*</font> $LDStreet:");

		$this->smarty->assign('sStreetInput','<input name="addr_str" type="text" size="35" value="'.$addr_str.'">');

		if ($errorstreetnr) $this->smarty->assign('LDStreetNr',"<font color=red> $LDStreetNr</font>:");
				else $this->smarty->assign('LDStreetNr'," $LDStreetNr:");

		$this->smarty->assign('sStreetNrInput','<input name="addr_str_nr" type="text" size="10" value="'.$addr_str_nr.'">');

		if ($errortown) $this->smarty->assign('LDStreet',"<font color=red>$LDTownCity</font>:");
		else $this->smarty->assign('LDTownCity',"$LDTownCity:");

		require_once($root_path.'include/care_api_classes/class_address.php');
		$sAddress = '<select name="addr_citytown_name"><option onClick="updateAddress(\'  \',\'--\')" value=""></option>';
		$address_obj=new Address;
		$address = $address_obj->getAllActiveCityTown();
		if(!empty($address)) {
			if($address->RecordCount()) {
				while($addr=$address->FetchRow()){
					if($addr_citytown_nr == $addr['nr'] ) $selected = ' selected '; else $selected = ' ';
				    $sAddress .= '<option onClick="updateAddress(\'' . $addr['zip_code'].'\',' . $addr['nr']. ')" value="' . $addr['name'] . '"' . $selected . ' >' . $addr['name'] . '</option>';
				}
				$sAddress .= '</select>';
				$this->smarty->assign('sTownCityInput',$sAddress);
			} else {
				$this->smarty->assign('sTownCityInput',$LDNoAddress);
			}
		} else {
			$this->smarty->assign('sTownCityInput',$LDNoAddress);
		}

		 if ($errorzip) $this->smarty->assign('LDZipCode',"<font color=red> $LDZipCode</font> :");
		 else  $this->smarty->assign('LDZipCode'," $LDZipCode :");
		 $this->smarty->assign('sZipCodeInput','<input id="addr_zip" name="addr_zip" type="text" size="10" value="'.$addr_zip.'">');


		// KB: make insurance completely hideable
		if (!$GLOBAL_CONFIG['person_insurance_hide']){
			if($insurance_show) {
				if (!$person_insurance_1_nr_hide) {

					$this->smarty->assign('bShowInsurance',TRUE);

					$this->smarty->assign('sInsuranceNr',$this->createTR($errorinsurancenr, 'insurance_nr', $LDInsuranceNr.' 1',$insurance_nr,2,35,true));

					if ($errorinsuranceclass) $this->smarty->assign('sErrorInsClass',"<font color=\"$error_fontcolor\">");

					if($insurance_classes!=false){
						$sInsClassBuffer='';
						while($result=$insurance_classes->FetchRow()) {

							$sInsClassBuffer.='<input class="reg_input_must" name="insurance_class_nr" type="radio"  value="'.$result['class_nr'].'" ';
							if($insurance_class_nr==$result['class_nr']) $sInsClassBuffer.='checked';
							$sInsClassBuffer.='>';

							$LD=$result['LD_var'];
							if(isset($$LD)&&!empty($$LD)) $sInsClassBuffer.=$$LD; else $sInsClassBuffer.=$result['name'];
							$sInsClassBuffer.='&nbsp;';
						}

						$this->smarty->append('sInsClasses',$sInsClassBuffer);

					} else {
						$this->smarty->assign('sInsClasses','Nuk jane konfiguruar klasat e sigurimit');
					}

					if ($errorinsurancecoid) $this->smarty->assign('LDInsuranceCo',"<font color=red>$LDInsuranceCo</font> :");
					else  $this->smarty->assign('LDInsuranceCo',"$LDInsuranceCo :");
					//gjergji mod per insurance
					$insurance_firm_name = $pinsure_obj->getFirmName($GLOBAL_CONFIG['person_insurace_firm_default_id']);
					$this->smarty->assign('sInsCoNameInput','<input name="insurance_firm_name" type="text" size="35" value="'.$insurance_firm_name.'">');
					$this->smarty->assign('sInsCoMiniCalendar',"<a href=\"javascript:popSearchWin('insurance','aufnahmeform.insurance_firm_id','aufnahmeform.insurance_firm_name')\"><img ".createComIcon($root_path,'b-write_addr.gif','0')."></a>");
				}
			} else {
				$this->smarty->assign('bNoInsurance',TRUE);
				$this->smarty->assign('LDSeveralInsurances','<a href="#">$LDSeveralInsurances <img '.createComIcon($root_path,'frage.gif','0').'></a>');
			}
		}
		if (!$GLOBAL_CONFIG['person_phone_1_nr_hide']){
			$this->smarty->assign('sPhone1',$this->createTR($errorphone1, 'phone_1_nr', $LDPhone.' 1',$phone_1_nr,2));
		}
		if (!$GLOBAL_CONFIG['person_phone_2_nr_hide']){
			$this->smarty->assign('sPhone2',$this->createTR($errorphone2, 'phone_2_nr', $LDPhone.' 2',$phone_2_nr,2));
		}
		if (!$GLOBAL_CONFIG['person_cellphone_1_nr_hide']){
			$this->smarty->assign('sCellPhone1',$this->createTR($errorcell1, 'cellphone_1_nr', $LDCellPhone.' 1',$cellphone_1_nr,2));
		}
		if (!$GLOBAL_CONFIG['person_cellphone_2_nr_hide']){
			$this->smarty->assign('sCellPhone2',$this->createTR($errorcell2, 'cellphone_2_nr', $LDCellPhone.' 2',$cellphone_2_nr,2));
		}
		if (!$GLOBAL_CONFIG['person_fax_hide']){
			$this->smarty->assign('sFax',$this->createTR($errorfax, 'fax', $LDFax,$fax,2));
		}
		if (!$GLOBAL_CONFIG['person_email_hide']){
			$this->smarty->assign('sEmail',$this->createTR($erroremail, 'email', $LDEmail,$email,2));
		}
		if (!$GLOBAL_CONFIG['person_citizenship_hide']){
			$this->smarty->assign('sCitizenship',$this->createTR($errorcitizen, 'citizenship', $LDCitizenship,$citizenship,2));
		}
		if (!$GLOBAL_CONFIG['person_sss_nr_hide']){
			$this->smarty->assign('sSSSNr',$this->createTR($errorsss, 'sss_nr', $LDSSSNr,$sss_nr,2));
		}
		if (!$GLOBAL_CONFIG['person_nat_id_nr_hide']){
			$this->smarty->assign('sNatIdNr',$this->createTR($errornatid, 'nat_id_nr', $LDNatIdNr,$nat_id_nr,2));
		}
		if (!$GLOBAL_CONFIG['person_religion_hide']){
			$this->smarty->assign('sReligion',$this->createTR($errorreligion, 'religion', $LDReligion,$religion,2));
		}
		if (!$GLOBAL_CONFIG['person_ethnic_orig_hide']){

			/** Add by Jean-Philippe LIOT 13/05/2004 **/
			$this->smarty->assign('LDEthnicOrig',$LDEthnicOrigin);
			$this->smarty->assign('sEthnicOrigInput','<input name="ethnic_orig_txt" type="text" size="35" value="'.$ethnic_orig_txt.'" >');
			$this->smarty->assign('sEthnicOrigMiniCalendar',"<a href=\"javascript:popSearchWin('ethnic_orig')\"><img ".createComIcon($root_path,'b-write_addr.gif','0')."></a>");
		}
		// KB: add a field for other HIS nr
		if (!$GLOBAL_CONFIG['person_other_his_nr_hide']){
			$this->smarty->assign('bShowOtherHospNr',TRUE);

			$this->smarty->assign('LDOtherHospitalNr',$LDOtherHospitalNr);

			$other_hosp_list = $person_obj->OtherHospNrList();
			$sOtherNrBuffer='';
			foreach( $other_hosp_list as $k=>$v ){
				$sOtherNrBuffer.="<b>".$kb_other_his_array[$k].":</b> ".$v."<br />\n";
			}

			$this->smarty->assign('sOtherNr',$sOtherNrBuffer);

			$sOtherNrBuffer='';
			$sOtherNrBuffer.="<SELECT name=\"other_his_org\">".
						"<OPTION value=\"\">--</OPTION>";
			foreach( $kb_other_his_array as $k=>$v ){
				$sOtherNrBuffer.="<OPTION value=\"$k\" $check>$v</OPTION>";
			}
			$sOtherNrBuffer.="</SELECT>\n".
					"&nbsp;&nbsp;".
					"$LDNr:<INPUT name=\"other_his_no\" size=20><br />\n";

			$sOtherNrBuffer.="($LDSelectOtherHospital - $LDNoNrNoDelete)".
						"<br />\n";
			$sOtherNrBuffer.="</TD></TR>\n\n";

			$this->smarty->assign('sOtherNrSelect',$sOtherNrBuffer);
		}

		$this->smarty->assign('LDRegBy',$LDRegBy);
		if(isset($user_id) && $user_id) $buffer=$user_id; else  $buffer = $_SESSION['sess_user_name'];
		$this->smarty->assign('sRegByInput','<input  name="user_id" type="text" value="'.$buffer.'"  size="35" readonly>');

		# Collect the hidden inputs

		ob_start();
?>
			<INPUT TYPE="hidden" name="MAX_FILE_SIZE" value="1000000">
			<input type="hidden" name="itemname" value="<?php echo $itemname; ?>">
			<input type="hidden" name="sid" value="<?php echo $sid; ?>">
			<input type="hidden" name="lang" value="<?php echo $lang; ?>">
			<input type="hidden" name="linecount" value="<?php echo $linecount; ?>">
			<input type="hidden" name="mode" value="save">
			<input type="hidden" name="addr_citytown_nr" id="addr_citytown_nr" value="<?php echo $addr_citytown_nr; ?>">
			<input type="hidden" name="insurance_item_nr" value="<?php echo $insurance_item_nr; ?>">
			<input type="hidden" name="insurance_firm_id" value="<?php echo $GLOBAL_CONFIG['person_insurace_firm_default_id']; ?>">
			<input type="hidden" name="insurance_show" value="<?php echo $insurance_show; ?>">
			<input type="hidden" name="ethnic_orig" value="<?php echo $ethnic_orig; ?>">
<?php
		if($update){
			$this->smarty->assign('sUpdateHiddenInputs','<input type="hidden" name="update" value=1><input type="hidden" name="pid" value="'.$pid.'">');
		}

		$sTemp= ob_get_contents();
		ob_end_clean();
		$this->smarty->assign('sHiddenInputs',$sTemp);

		$this->smarty->assign('pbSubmit','<input  type="image" '.createLDImgSrc($root_path,'savedisc.gif','0').'  alt="'.$LDSaveData.'" align="absmiddle">');
		$this->smarty->assign('pbReset','<a href="javascript:document.aufnahmeform.reset()"><img '.createLDImgSrc($root_path,'reset.gif','0').' alt="'.$LDResetData.'"   align="absmiddle"></a>');

		if($error||$error_person_exists) $this->smarty->assign('pbForceSave','<input  type="button" value="'.$LDForceSave.'" onClick="forceSave()">');

		if (!$newdata){
			ob_start();
?>
			<form action=<?php echo $thisfile; ?> method=post>
				<input type=hidden name=sid value=<?php echo $sid; ?>>
				<input type=hidden name=patnum value="">
				<input type=hidden name="lang" value="<?php echo $lang; ?>">
				<input type=hidden name="date_format" value="<?php echo $date_format; ?>">
				<input type=submit value="<?php echo $LDNewForm ?>" >
			</form>
<?php
			$sTemp= ob_get_contents();
			ob_end_clean();
			$this->smarty->assign('sNewDataForm',$sTemp);
		}

		# Set the form template as form
		$this->smarty->assign('bSetAsForm',TRUE);

		if($this->bReturnOnly){
			ob_start();
				$this->smarty->display('registration_admission/reg_form.tpl');
				$sTemp=ob_get_contents();
			ob_end_clean();
			return $sTemp;
		}else{
			# show Template
			$this->smarty->display('registration_admission/reg_form.tpl');
		}
	} // end of function

	function create(){
		$this->bReturnOnly = TRUE;
		return $this->display();
	}
} // end of class
?>
