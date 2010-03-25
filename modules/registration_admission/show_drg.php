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

# Create DRG object
require_once($root_path.'include/care_api_classes/class_drg.php');
$obj=new DRG;

//$db->debug=1;

if(!isset($mode)) $mode='show';

require('./include/init_show.php');

if($parent_admit){
	# Get the DRG records data of this encounter
	$drg_obj=&$obj->encDRGList($_SESSION['sess_en']);
}else{
	# Get all DRG records  of this person
	$drg_obj=&$obj->pidDRGList($_SESSION['sess_pid']);
}
$rows=$obj->LastRecordCount();
//echo $obj->getLastQuery();

$subtitle=$LDDRG;
$_SESSION['sess_file_return']=$thisfile;

$buffer=str_replace('~tag~',$title.' '.$name_last,$LDNoRecordFor);
$norecordyet=str_replace('~obj~',strtolower($subtitle),$buffer); 

/* Load GUI page */
require('./gui_bridge/default/gui_show.php');
?>
