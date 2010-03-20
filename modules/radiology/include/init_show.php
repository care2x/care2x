<?php
define('LANG_FILE','aufnahme.php');
# Resolve the local user based on the origin of the script
if($_SESSION['sess_user_origin']=='admission') {
	$breakfile=$root_path.'modules/registration_admission/aufnahme_daten_zeigen.php'.URL_APPEND.'&encounter_nr='.$_SESSION['sess_en'];
	$local_user='aufnahme_user';
}elseif($_SESSION['sess_user_origin']=='registration'){
	$breakfile=$root_path.'modules/registration_admission/patient_register_show.php'.URL_APPEND.'&pid='.$_SESSION['sess_pid'];
	$local_user='aufnahme_user';
}else{
	$breakfile='radio_pass.php';
	$local_user='ck_radio_user';
}

require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_date_format_functions.php');
require_once($root_path.'include/care_api_classes/class_person.php');

$admissionfile='aufnahme_start.php'.URL_APPEND;

if((!isset($pid)||!$pid)&&$_SESSION['sess_pid']) $pid=$_SESSION['sess_pid'];
	elseif($pid) $_SESSION['sess_pid']=$pid;

//$_SESSION['sess_path_referer']=$top_dir.$thisfile;
//$HTPP_SESSION_VARS['sess_pid']=$pid;

/* Default path for fotos. Make sure that this directory exists! */
$default_photo_path=$root_path.'fotos/registration';
$photo_filename='nopic';

if(!isset($user_id) || !$user_id)
{
    $user_id=$local_user.$sid;
    $user_id=$$user_id;
}
 
if(isset($pid) && ($pid!='')) {
	$person_obj=new Person($pid);
		

	if($data_obj=&$person_obj->getAllInfoObject()){
		$zeile=$data_obj->FetchRow();
	 
		//while(list($x,$v)=each($zeile))	$$x=$v;       
		extract($zeile);
			
	}
}

require_once($root_path.'include/care_api_classes/class_globalconfig.php');
$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
$glob_obj->getConfig('person_%');
$glob_obj->getConfig('patient_%');
		
/* Check whether config foto path exists, else use default path */			
$photo_path = (is_dir($root_path.$GLOBAL_CONFIG['person_foto_path'])) ? $GLOBAL_CONFIG['person_foto_path'] : $default_photo_path;
require_once($root_path.'include/inc_photo_filename_resolve.php');

?>
