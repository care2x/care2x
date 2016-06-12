<?php
require('./roots.php');

require($root_path.'include/core/inc_environment_global.php');
error_reporting($ErrorLevel);
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2005 Robert Meggle based on the development of Elpidio Latorilla (2002,2003,2004,2005)
* elpidio@care2x.org, meggle@merotech.de
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables[]='pharmacy.php';
define('NO_2LEVEL_CHK',1);
require($root_path.'include/core/inc_front_chain_lang.php');


require ("gui/gui_pharmacy_tz_product_catalog.php");

?>
