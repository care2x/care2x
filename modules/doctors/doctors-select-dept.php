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
$lang_tables[]='departments.php';
define('LANG_FILE','doctors.php');
if($_SESSION['sess_user_origin']=='personell_admin'){
	$local_user='aufnahme_user';
	$breakfile=$root_path.'modules/personell_admin/personell_register_show.php'.URL_APPEND.'&target=personell_reg&personell_nr='.$nr;
}else{
	$local_user='ck_doctors_dienstplan_user';
	if (!empty($_SESSION['sess_path_referer'])){
		$breakfile=$root_path.$_SESSION['sess_path_referer'].URL_APPEND;
	} else {
		/* default startpage */
		$breakfile = $root_path.'doctors.php'.URL_APPEND;
	}
}
require_once($root_path.'include/inc_front_chain_lang.php');

/*
switch($retpath)
{
	case "docs": $breakfile='doctors.php'.URL_APPEND; break;
	case "op": $breakfile='op-doku.php'.URL_APPEND; break;
}
*/

$pday=date(j);
$pmonth=date(n);
$pyear=date(Y);
$abtarr=array();
$abtname=array();
$datum=date("d.m.Y");

if(!$hilitedept&&$dept_nr) $hilitedept=$dept_nr;

# Load the department list with oncall doctors
require_once($root_path.'include/care_api_classes/class_department.php');
$dept_obj=new Department;
$dept_DOC=$dept_obj->getAllActiveWithDOC();

switch($target){
	case 'plist': $title=$LDCreateDoctorsList;
					  $fileforward='doctors-dienst-personalliste.php'.URL_APPEND.'&retpath='.$retpath;
					  break;
	default: $title=$LDMakeDutyPlan;
					  $fileforward='doctors-dienstplan-planen.php'.URL_APPEND.'&retpath='.$retpath;
					  break;
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

 # href for return  button
 $smarty->assign('pbBack',$breakfile);

 # href for close button
 $smarty->assign('breakfile',$breakfile);
 
 # Window bar title
 $smarty->assign('sWindowTitle',$title);

$smarty->assign('sMascotImg','<img '.createMascot($root_path,'mascot1_r.gif','0','bottom').' align="absmiddle">');
$smarty->assign('LDPlsSelectDept',$LDPlsSelectDept);

 # Buffer department rows output
 ob_start();

$toggler=0;

while(list($x,$v)=each($dept_DOC)){
		
	$bold='';
	$boldx='';
	if($hilitedept==$v['nr']) 	{ echo '<tr bgcolor="yellow">'; $bold="<font color=\"red\" size=2><b>";$boldx="</b></font>"; } 
	else
		if ($toggler==0) 
			{ echo '<tr class="wardlistrow1">'; $toggler=1;}
				else { echo '<tr class="wardlistrow2">'; $toggler=0;}
	echo '<td ><font face="verdana,arial" size="2" >&nbsp;'.$bold;
	$buff=$v['LD_var'];
	if(isset($$buff)&&!empty($$buff)) echo $$buff;
		else echo $v['name_formal'];
	echo $boldx.'&nbsp;</td>';
	echo '<td >&nbsp; <a href="'.$fileforward.'&dept_nr='.$v['nr'].'&nr='.$nr.'">
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