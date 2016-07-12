<?php
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
error_reporting($ErrorLevel);
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
require_once($root_path.'include/core/inc_front_chain_lang.php');

$breakfile='edv-system-admi-welcome.php'.URL_APPEND;
if(isset($from) and $from=='add') $returnfile='edv_system_format_currency_add.php'.URL_APPEND.'&from=set';
  else $returnfile=$breakfile;
$thisfile='edv_system_format_currency_set.php';
$editfile='edv_system_format_currency_add.php'.URL_REDIRECT_APPEND.'&mode=edit&from=set&item_no=';

include_once($root_path.'include/care_api_classes/class_globalconfig.php');
$GLOBAL_CONFIG=array();
$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
$glob_obj->getConfig('kwamoja%');

# Load the db routine

require($root_path.'modules/cafeteria/includes/inc_currency_set.php');

# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('system_admin');
 require_once($root_path.'include/core/inc_default_smarty_values.php');

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
 $smarty->assign('sTitleImage','<img '.createComIcon($root_path,'currency.png','0').'>');

 if($rows) {
 	$smarty->append('JavaScript','<script language="javascript" src="'.$root_path.'js/check_currency_same_item.js"></script>');
}

# Buffer page output

ob_start();

#  Define to create the edit links on the table and create the GUI body
define('SET_EDIT',1);

$bottomlink='edv_system_format_currency_add.php'.URL_APPEND.'&from=set';
$bottomlink_txt=$LDClk2AddCurrency;

require($root_path.'modules/cafeteria/includes/inc_currency_set_gui.php');

$sTemp = ob_get_contents();
ob_end_clean();

# Assign page output to the mainframe template

$smarty->assign('sMainFrameBlockData',$sTemp);
 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');

?>
