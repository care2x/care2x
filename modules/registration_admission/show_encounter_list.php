<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System beta 2.0.1 - 2004-07-04
* GNU General Public License
* Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
$thisfile=basename(__FILE__);

if(!isset($mode)) $mode='show';

require('./include/init_show.php');

# Get all encounter records  of this person
$list_obj=&$person_obj->EncounterList($pid);
$rows=$person_obj->LastRecordCount();
//echo $obj->getLastQuery();

# Create encounter object
require_once($root_path.'include/care_api_classes/class_encounter.php');
$enc_obj=new Encounter();

# Get all encounter classes & load in array
if($eclass_obj=$enc_obj->AllEncounterClassesObject()){
	while($ec_row=$eclass_obj->FetchRow()) $enc_class[$ec_row['class_nr']]=$ec_row;
}

$subtitle=$LDListEncounters;
$_SESSION['sess_file_return']=$thisfile;

$buffer=str_replace('~tag~',$title.' '.$name_last,$LDNoRecordFor);
$norecordyet=str_replace('~obj~',strtolower($subtitle),$buffer); 

/* Load GUI page */
require('./gui_bridge/default/gui_show.php');
?>
