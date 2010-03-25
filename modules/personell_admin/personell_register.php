<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables[]='personell.php';
$lang_tables[]='prompt.php';
$lang_tables[]='products.php';
define('LANG_FILE','aufnahme.php');
$local_user='aufnahme_user';
require($root_path.'include/core/inc_front_chain_lang.php');

/* If patient nr is invallid jump to registration search module*/
/*if(!isset($pid) || !$pid)
{
	header('Location:patient_register_search.php'.URL_APPEND.'&origin=admit');
	exit;
}
*/
require_once($root_path.'include/core/inc_date_format_functions.php');
require_once($root_path.'include/care_api_classes/class_person.php');
require_once($root_path.'include/care_api_classes/class_insurance.php');
//require_once($root_path.'include/care_api_classes/class_core.php');
require_once($root_path.'include/care_api_classes/class_ward.php');
require_once($root_path.'include/care_api_classes/class_globalconfig.php');
require_once($root_path.'include/care_api_classes/class_personell.php');

//$db->debug=TRUE;

$thisfile=basename(__FILE__);
$returnfile=$breakfile;

$newdata=1;

# Default path for fotos. Make sure that this directory exists!
$default_photo_path=$root_path.'uploads/photos/registration';
$photo_filename='nopic';

if(!isset($pid)) $pid=0;
if(!isset($mode)) $mode='';
if(!isset($forcesave)) $forcesave=0;
if(!isset($update)) $update=0;

if(!isset($_SESSION['sess_pid'])) $_SESSION['sess_pid'] = "";
if(!isset($_SESSION['sess_full_pid'])) $_SESSION['sess_full_pid'] = "";
if(!isset($_SESSION['sess_en'])) $_SESSION['sess_en'] = "";
if(!isset($_SESSION['sess_full_en'])) $_SESSION['sess_full_en'] = "";
if(!isset($_SESSION['sess_pnr'])) $_SESSION['sess_pnr'] = "";
if(!isset($_SESSION['sess_full_pnr'])) $_SESSION['sess_full_pnr'] = "";

$patregtable='care_person';  // The table of the patient registration data

//$dbtable='care_encounter'; // The table of admission data

/* Create new person's insurance object */
$pinsure_obj=new PersonInsurance($pid);	 
/* Get the insurance classes */
$insurance_classes=&$pinsure_obj->getInsuranceClassInfoObject('class_nr,name,LD_var');

/* Create new person object */
$person_obj=new Person($pid);
/* Create personell object */
$personell_obj=new Personell();

if($pid||$personell_nr){
	
	# Get the patient global configs
        $glob_obj=new GlobalConfig($GLOBAL_CONFIG);
        $glob_obj->getConfig('personell_%');
        $glob_obj->getConfig('person_foto_path'); 

        # Check whether config path exists, else use default path			
        $photo_path = (is_dir($root_path.$GLOBAL_CONFIG['person_foto_path'])) ? $GLOBAL_CONFIG['person_foto_path'] : $default_photo_path;

        if ($pid){
		  # Check whether the person is currently admitted. If yes jump to display admission data
		if($mode!='save' && $personell_nr=$personell_obj->Exists($pid)){
			header('Location:personell_register_show.php'.URL_REDIRECT_APPEND.'&personell_nr='.$personell_nr.'&origin=admit&sem=isadmitted&target=personell_reg');
			exit;
		}
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
				//while(list($x,$v)=each($buffer)) {$$x=$v; }
				$insurance_show=TRUE;
				$insurance_firm_name=$pinsure_obj->getFirmName($insurance_firm_id);
			} else { $insurance_show=FALSE;}
		}

		if (($mode=='save')){
			$error=FALSE;
			# Check some values
			if(empty($_POST['job_function_title'])
				|| empty($_POST['date_join'])
				|| empty($_POST['contract_start']))
			{
				$error=TRUE;
			}
			# Get default user if needed
			if(empty($_POST['encoder'])) $encoder=$_SESSION['sess_user_name'];
			# Start save routine if no error
			if(!$error) {
				if($update || $personell_nr){
					//echo formatDate2STD($geburtsdatum,$date_format);
					$itemno=$itemname;
					if($_POST['date_join']) $_POST['date_join']=@formatDate2STD($_POST['date_join'],$date_format);
					if($_POST['date_exit']) $_POST['date_exit']=@formatDate2STD($_POST['date_exit'],$date_format);
						else $_POST['date_exit']= DBF_NODATE;
					if($_POST['contract_start']) $_POST['contract_start']=@formatDate2STD($_POST['contract_start'],$date_format);
					if($_POST['contract_end']) $_POST['contract_end']=@formatDate2STD($_POST['contract_end'],$date_format);
						else $_POST['contract_end']= DBF_NODATE;
					$_POST['modify_id']=$encoder;
					$_POST['modify_time']=date('YmdHis');
					$_POST['history']= $personell_obj->ConcatHistory("Update: ".date('Y-m-d H:i:s')." = ".$encoder."\n");
					
					# Disable the pid variable
					if(isset($_POST['pid'])) unset($_POST['pid']);

					$personell_obj->setDataArray($_POST);

					if($personell_obj->updateDataFromInternalArray($personell_nr)){
						header("Location: personell_register_show.php".URL_REDIRECT_APPEND."&personell_nr=$personell_nr&origin=admit&target=personell_reg&newdata=$newdata");
						exit;
					}else{
						$error=TRUE;
					}
				}else{
					$newdata=1;
					if(!$personell_obj->InitPersonellNrExists($GLOBAL_CONFIG['personell_nr_init'])) $_POST['nr']=$GLOBAL_CONFIG['personell_nr_init'];

					if($_POST['date_join']) $_POST['date_join']=@formatDate2STD($_POST['date_join'],$date_format);
					if($_POST['date_exit']) $_POST['date_exit']=@formatDate2STD($_POST['date_exit'],$date_format);
					if($_POST['contract_start']) $_POST['contract_start']=@formatDate2STD($_POST['contract_start'],$date_format);
					if($_POST['contract_end']) $_POST['contract_end']=@formatDate2STD($_POST['contract_end'],$date_format);
					
					$_POST['create_id']=$encoder;
					$_POST['create_time']=date('YmdHis');
					$_POST['history']="Create: ".date('Y-m-d H:i:s')." = ".$encoder."\n";

					$personell_obj->setDataArray($_POST);

					if($personell_obj->insertDataFromInternalArray()){
						# Get the PID
						$oid = $db->Insert_ID();
						$personell_nr = $personell_obj->LastInsertPK('nr',$oid);
				            
						header("Location: personell_register_show.php".URL_REDIRECT_APPEND."&personell_nr=$personell_nr&origin=admit&target=personell_reg&newdata=$newdata");
						exit;
					}else{
						$error=TRUE;
					}
				} // end of if(update) else()
			} // end of if($error)
		
			if($error){
				header("Location: $thisfile".URL_REDIRECT_APPEND."&personell_nr=$personell_nr&error=1");
				exit;
			}
		} // end of if($mode)
		else{
			$person_obj->setPID($pid);
			if($data=&$person_obj->BasicDataArray($pid)){
				//while(list($x,$v)=each($data))	$$x=$v;
				extract($data);
			}
			# Get the citytown name
			$addr_citytown_name=$person_obj->CityTownName($addr_citytown_nr);
		}
        } elseif($personell_nr) {
		# Load personnel data
		$personell_obj->loadPersonellData($personell_nr);
		if($personell_obj->is_loaded) {
			$zeile=&$personell_obj->personell_data;
			extract($zeile);
			# Get insurance firm name
			$insurance_firm_name=$pinsure_obj->getFirmName($insurance_firm_id);
			$full_pnr=$personell_nr;
		}
	}
}
    
# Load the wards info
$ward_obj=new Ward;
$items='nr,name';
$ward_info=&$ward_obj->getAllWardsItemsObject($items);

if($update) $breakfile='personell_register_show.php'.URL_APPEND.'&personell_nr='.$personell_nr;
	elseif($_COOKIE['ck_login_logged'.$sid]) $breakfile=$root_path.'main/spediens.php'.URL_APPEND;
		else $breakfile='personell_admin_pass.php'.URL_APPEND.'&target='.$target;

# Prepare the photo filename
require_once($root_path.'include/core/inc_photo_filename_resolve.php');

require('./gui_bridge/default/gui_'.$thisfile);
?>
