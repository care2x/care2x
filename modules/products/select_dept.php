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
$lang_tables=array('departments.php');
define('LANG_FILE','prompt.php');
$local_user='ck_prod_order_user';
require_once($root_path.'include/inc_front_chain_lang.php');


switch($_SESSION['sess_user_origin'])
{
	case 'pharma':
		$breakfile=$root_path.'modules/pharmacy/apotheke.php'.URL_APPEND;
		break;
		
	case 'meddepot':
		$breakfile=$root_path.'modules/med_depot/medlager.php'.URL_APPEND;
		break;
}


if(empty($pday)) $pday=date('j');
if(empty($pmonth)) $pmonth=date('n');
if(empty($pyear)) $pyear=date('Y');
$abtarr=array();
$abtname=array();
$datum=date('d.m.Y');

# Load the medical department list
require_once($root_path.'include/care_api_classes/class_department.php');
$dept_obj=new Department;

//begin:gjergji 
//if i'm the depot then i only take the pharmacy
//else, all the departments
if($cat=='medlager') 
		$dept=$dept_obj->getAllPharmacy();
elseif($cat=='pharma') 
		$dept=$dept_obj->getAllMedical();
//end:gjergji

if($cat=='medlager')
	$title=$LDSelectPharma;
elseif($cat=='pharma') 
	$title=$LDSelectDept;
# Set forward file
switch($target){
	case 'catalog': $fileforward=$root_path."modules/products/products-bestellkatalog-edit.php".URL_APPEND."&cat=$cat";
							break;
	default : $fileforward=$root_path."modules/products/products-bestellung.php".URL_APPEND."&cat=$cat";
}

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
if($cat=='medlager')
	$smarty->assign('LDPlsSelectDept',$LDPlsSelectFarma);
elseif($cat=='pharma') 
	$smarty->assign('LDPlsSelectDept',$LDPlsSelectDept);

 # Buffer department rows output
 ob_start();

$toggler=0;

while(list($x,$v)=each($dept)){
		
	$bold='';
	$boldx='';
	if($hilitedept==$v['nr']) 	{ echo '<tr bgcolor="yellow">'; $bold="<font color=\"red\" size=2><b>";$boldx="</b></font>"; } 
	else
		if ($toggler==0) 
			{ echo '<tr class="wardlistrow1">'; $toggler=1;}
				else { echo '<tr class="wardlistrow2">'; $toggler=0;}
	echo '<td>&nbsp;'.$bold;
	if(isset($$v['LD_var'])&&!empty($$v['LD_var'])) echo $$v['LD_var'];
		else echo $v['name_formal'];
	echo $boldx.'&nbsp;</td>';
	echo '<td >&nbsp; <a href="'.$fileforward.'&dept_nr='.$v['nr'].'">
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
