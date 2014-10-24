<?php
error_reporting ( E_COMPILE_ERROR | E_ERROR | E_CORE_ERROR );
require ('./roots.php');
require ($root_path . 'include/core/inc_environment_global.php');
/**
 * CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
 * GNU General Public License
 * Copyright 2002,2003,2004,2005 Elpidio Latorilla
 * elpidio@care2x.org,
 *
 * See the file "copy_notice.txt" for the licence notice
 */
$lang_tables [] = 'prompt.php';
define ( 'LANG_FILE', 'products.php' );
$local_user = 'ck_prod_order_user';
require_once ($root_path . 'include/core/inc_front_chain_lang.php');
include($root_path.'include/core/inc_passcheck.php');
if (isset ( $_SESSION ['department_nr'] ) && $_SESSION ['department_nr'] != '') {
	$dept_nr = $_SESSION ['department_nr'] [0];

}else{
    echo '<FONT SIZE="+4" color="navy">' . $LDNoDepartmentAssociation . '</font>';
    exit ();
}


//$db->debug=1;


/**
 * LOAD Smarty
 */

// Note: it is advisable to load this after the inc_front_chain_lang.php so
// that the smarty script can use the user configured template theme

require_once ($root_path . 'gui/smarty_template/smarty_care.class.php');
$smarty = new smarty_care ( 'common', TRUE, FALSE, FALSE );

// Window bar title
$smarty->assign ( 'sWindowTitle', '' );

// Assign frameset source file

$smarty->assign ( 'sHeaderSource', "src=\"products-bestell-hf.php?sid=$sid&lang=$lang&cat=$cat&userck=$userck\"" );
$smarty->assign ( 'sBasketSource', "src=\"products-bestellkorb.php?sid=$sid&lang=$lang&dept_nr=$dept_nr&order_nr=$order_nr&itwassent=$itwassent&cat=$cat&userck=$userck\"" );
$smarty->assign ( 'sCatalogSource', "src=\"products-bestellkatalog.php?sid=$sid&lang=$lang&dept_nr=$dept_nr&order_nr=$order_nr&cat=$cat&userck=$userck\"" );

$smarty->assign ( 'sBaseFramesetTemplate','products/ordering_frameset.tpl' );

$smarty->display ( 'common/baseframe.tpl' );
?>

