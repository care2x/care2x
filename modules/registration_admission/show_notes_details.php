<?php 
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
define('LANG_FILE','');
//define('LANG_FILE','aufnahme.php');
$local_user='aufnahme_user';
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_date_format_functions.php');
# Create the notes object
require_once($root_path.'include/care_api_classes/class_notes.php');
$obj=new Notes;
# Load the notes
if($n_obj=&$obj->getEncounterNotes($nr)) $notes=$n_obj->FetchRow();

# Prepare variables for template
$bd=@formatDate2Local($bd,$date_format);
$TP_CHARSET=setCharSet();
$TP_DATE=@formatDate2Local($notes['date'],$date_format);
$TP_TIME=@convertTimeToLocal($notes['time']);
$TP_DOC=$notes['personell_name'];
$TP_USR=$notes['modify_id']; 
$TP_NOTES=nl2br($notes['notes']);
$TP_CLOSE='<a href="javascript:window.close()"><img '.createLDImgSrc($root_path,'close2.gif','0').'></a>';

# Load the template
$tp_notes=$TP_obj->load('registration_admission/tp_show_notes_details.htm');
eval("echo $tp_notes;");
?>
