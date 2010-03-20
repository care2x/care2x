<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.2 - 2006-07-10
* GNU General Public License
* Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','products.php');
define("NO_2LEVEL_CHK","1");
require_once($root_path.'include/inc_front_chain_lang.php');

# Set order catalog flag
$bcat=true;

# Load search routine
require($root_path.'include/inc_products_search_mod_datenbank.php');

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common',TRUE,FALSE);

# Title in the title bar
 $smarty->assign('sToolbarTitle',$title_art);

 # hide back button
 $smarty->assign('pbBack',FALSE);

 # href for the help button
 $smarty->assign('pbHelp',"javascript:gethelp()");

 # href for the close button
 $smarty->assign('breakfile','javascript:window.close()');

 # Window bar title
 $smarty->assign('sWindowTitle',$title_art);

 # Assign Body Onload javascript code
 $smarty->assign('sOnLoadJs','onLoad="if (window.focus) window.focus()"');

 # Load the search result in form
 require($root_path.'include/inc_products_search_result_mod.php');

 if($goback) $sTemp= "javascript:window.history.back()";
 	else $sTemp= "javascript:window.close()";

 $smarty->assign('sBreakButton','<a href="'.$sTemp.'"><img '.createLDImgSrc($root_path,'close2.gif','0').'"></a>');

 # Assign the form template to mainframe

 $smarty->assign('sMainBlockIncludeFile','products/form.tpl');

 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');
?>
