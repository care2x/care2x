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
define('LANG_FILE','indexframe.php');
define(NO_CHAIN,1);

# Set here the window title
$wintitle='Menu - SIIS';

require_once($root_path.'include/core/inc_front_chain_lang.php');

/**
* We check again the language variable lang. If table file not available use default (lang = "en")
*/

if(!isset($lang)||empty($lang))  include($root_path.'chklang.php');

/* Load the language table */
if(file_exists($root_path.'language/'.$lang.'/lang_'.$lang.'_indexframe.php')){
	include($root_path.'language/'.$lang.'/lang_'.$lang.'_indexframe.php');
}else{
	include($root_path.'language/en/lang_en_indexframe.php');
	$lang='en'; // last desperate effort to set the language 
}

// echo $_COOKIE['ck_config']; // for debugging only

if(($mask==2)&&!$nonewmask){
	header ("location: indexframe2.php?sid=$sid&lang=$lang&boot=$boot&cookie=$cookie");
	exit;
}

# Get the global config for language usage
require_once($root_path.'include/care_api_classes/class_globalconfig.php');
$GLOBALCONFIG=array();
$gc=new GlobalConfig($GLOBALCONFIG);
$gc->getConfig('language_%');

# Prepare additional data for the gui template
$charset=setCharSet();

# Load dept & ward classes
require_once($root_path.'include/care_api_classes/class_department.php');
require_once($root_path.'include/care_api_classes/class_ward.php');
$dept=new Department();
$ward=new Ward();

require('./gui_bridge/gui_indexframe.php');
?>
