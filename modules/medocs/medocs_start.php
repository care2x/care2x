<?php
//error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
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


define('LANG_FILE','aufnahme.php');
# Resolve the local user based on the origin of the script
require_once('include/inc_local_user.php');
require($root_path.'include/core/inc_front_chain_lang.php');

/* If patient nr is invallid jump to registration search module*/
/*if(!isset($pid) || !$pid)
{
	header('Location:patient_register_search.php'.URL_APPEND.'&origin=admit');
	exit;
}
*/
require_once($root_path.'include/core/inc_date_format_functions.php');

$thisfile=basename(__FILE__);

if(isset($origin) && $origin=='patreg_reg') $returnfile='patient_register_show.php'.URL_APPEND.'&pid='.$pid;

# Set break file
require('include/inc_breakfile.php');

if(!isset($_SESSION['sess_pid'])) $_SESSION['sess_pid'] = "";
if(!isset($_SESSION['sess_full_pid'])) $_SESSION['sess_full_pid'] = "";
if(!isset($_SESSION['sess_en'])) $_SESSION['sess_en'] = "";
if(!isset($_SESSION['sess_full_en'])) $_SESSION['sess_full_en'] = "";

$headframe_title=$LDMedocs;
require('./gui_bridge/default/gui_medocs_start.php');
?>
