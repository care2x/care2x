<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System beta 2.0.1 - 2004-07-04
* GNU General Public License
* Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
$thisfile=basename(__FILE__);

# Create measurement object
require_once($root_path.'include/care_api_classes/class_medocs.php');
$obj=new Medocs;

if(!isset($mode)) $mode='show';

require('./include/init_show.php');

if($parent_admit){
	# Get the medocs records data of this encounter
	$med_obj=&$obj->encMedocsList($_SESSION['sess_en']);
}else{
	# Get all medocs records  of this person
	$med_obj=&$obj->pidMedocsList($_SESSION['sess_pid']);
}
$rows=$obj->LastRecordCount();

$subtitle=$LDMedocs;
$_SESSION['sess_file_return']=$thisfile;

$buffer=str_replace('~tag~',$title.' '.$name_last,$LDNoRecordFor);
$norecordyet=str_replace('~obj~',strtolower($subtitle),$buffer); 

/* Load GUI page */
require('./gui_bridge/default/gui_show.php');
?>
