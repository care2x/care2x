<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');

$lang_tables=array('products.php');
define('LANG_FILE','prompt.php');
$local_user='ck_supply_db_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');


if(empty($pday)) $pday=date('j');
if(empty($pmonth)) $pmonth=date('n');
if(empty($pyear)) $pyear=date('Y');
$abtarr=array();
$abtname=array();
$datum=date('d.m.Y');

# Load the supplier list
require_once($root_path.'include/care_api_classes/class_supplier.php');
$supplier_obj=new Supplier;

$dept=$supplier_obj->getAllSupplier();
$title=$LDSelectSupplier;

$fileforward=$root_path."modules/supplier/supply.php".URL_APPEND."&cat=$cat";


# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common');

# Title in toolbar
 $smarty->assign('sToolbarTitle',$title);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('dept_select.php')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',$title);

$smarty->assign('sMascotImg','<img '.createMascot($root_path,'mascot1_r.gif','0','bottom').' align="absmiddle">');
$smarty->assign('LDPlsSelectDept',$LDPlsSelectSupplier);

 # Buffer department rows output
 ob_start();

$toggler=0;

while(list($x,$v)=each($dept)){
		
	$bold='';
	$boldx='';
	if ($toggler==0) { 
			echo '<tr class="wardlistrow1">'; 
			$toggler=1;}
	else { 
			echo '<tr class="wardlistrow2">'; 
			$toggler=0;
	}
	echo '<td>&nbsp;'.$bold;
	echo $v['supplier'];
	echo $boldx.'&nbsp;</td>';
	echo '<td >&nbsp; <a href="'.$fileforward.'&supplier_nr='.$v['idcare_supplier'].'">
	<img '.createLDImgSrc($root_path,'ok_small.gif','0','absmiddle').' alt="'.$LDShowActualPlan.'" ></a> </td></tr>';
	echo "\n";

	}

$sTemp = ob_get_contents();
 ob_end_clean();

# Assign the dept rows  to the frame template

 $smarty->assign('sDeptRows',$sTemp);

$smarty->assign('sBackLink','<a href="'.$breakfile.'"><img '.createLDImgSrc($root_path,'close2.gif','0').' alt="'.$LDCloseAlt.'">');

 $smarty->assign('sMainBlockIncludeFile','or/select_dept.tpl');

 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');

?>
