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
define('LANG_FILE','edp.php');
$local_user='ck_edv_user';
require_once($root_path.'include/inc_front_chain_lang.php');

$breakfile='edv-system-admi-welcome.php'.URL_APPEND;
if($from=='add') $returnfile='edv_system_format_currency_add.php'.URL_APPEND.'&from=set';
  else $returnfile=$breakfile;
$thisfile='edv_system_format_currency_set.php';
$editfile='edv_system_format_currency_add.php'.URL_REDIRECT_APPEND.'&mode=edit&from=set&item_no=';

# Load the db routine

require($root_path.'include/inc_currency_set.php');

# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('system_admin');

# Title in toolbar
 $smarty->assign('sToolbarTitle',$LDCurrencyAdmin);

# href for return button
 $smarty->assign('pbBack',$returnfile);
 
 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('currency_set.php')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',$LDCurrencyAdmin);

 if($rows) {
 	$smarty->append('JavaScript','<script language="javascript" src="'.$root_path.'js/check_currency_same_item.js"></script>');
}

# Buffer page output

ob_start();

#  Define to create the edit links on the table and create the GUI body
define('SET_EDIT',1); 

$bottomlink='edv_system_format_currency_add.php'.URL_APPEND.'&from=set';
$bottomlink_txt=$LDClk2AddCurrency;

require($root_path.'include/inc_currency_set_gui.php');

$sTemp = ob_get_contents();
ob_end_clean();

# Assign page output to the mainframe template

$smarty->assign('sMainFrameBlockData',$sTemp);
 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');

?>
