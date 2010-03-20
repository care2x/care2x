<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/

$lang_tables[]='actions.php';
$lang_tables[]='prompt.php';
$lang_tables[]='aufnahme.php';
define('LANG_FILE','radio.php');
# Resolve the local user based on the origin of the script
require_once('include/inc_local_user.php');
//define('NO_2LEVEL_CHK',1);
$local_user='ck_radio_user';
require_once($root_path.'include/inc_front_chain_lang.php');

# Set break file
require('include/inc_breakfile.php');

$thisfile=basename(__FILE__);

$_SESSION['sess_file_return']=$thisfile;

if(empty($target)) $target='search';

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('nursing');

# Title in toolbar
 $smarty->assign('sToolbarTitle',"$LDUploadDicom :: $LDSearch ");

  # hide back button
 $smarty->assign('pbBack',FALSE);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('patient_search.php')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',"$LDUploadDicom :: $LDSearch ");

# Body onLoad javascript code

$smarty->assign('sOnLoadJs','onLoad="document.searchform.searchkey.select()";');

# Start creating the search module
require_once($root_path.'include/care_api_classes/class_gui_search_person.php');

$psearch = & new GuiSearchPerson;

$psearch->setTargetFile('upload.php');

$psearch->setCancelFile($breakfile);

$psearch->setPrompt($LDPlsFindPersonFirst);

# Set to TRUE if you want to auto display a single result
//$psearch->auto_show_byalphanumeric =TRUE;
# Set to TRUE if you want to auto display a single result based on a numeric keyword
# usually in the case of barcode scanner data
$psearch->auto_show_bynumeric = TRUE;

$psearch->pretext='<ul>';

ob_start();

$psearch->display();

?>

</ul>
<p>

<?php

$sTemp = ob_get_contents();
ob_end_clean();

# Assign to page template object
$smarty->assign('sMainFrameBlockData',$sTemp);

 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');

 ?>
