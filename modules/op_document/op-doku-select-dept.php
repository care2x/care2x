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
$lang_tables[]='departments.php';
$lang_tables[]='or.php';
define('LANG_FILE','doctors.php');
$local_user='ck_opdoku_user';
require_once($root_path.'include/inc_front_chain_lang.php');

//$db->debug=1;

/*
switch($retpath)
{
	case "docs": $breakfile='doctors.php'.URL_APPEND; break;
	case "op": $breakfile='op-doku.php'.URL_APPEND; break;
}
*/
if (!empty($_SESSION['sess_path_referer'])){
	$breakfile=$_SESSION['sess_path_referer'];
} else {
	/* default startpage */
	$breakfile = 'doctors.php';
}
$breakfile=$root_path.$breakfile.URL_APPEND;

$pday=date(j);
$pmonth=date(n);
$pyear=date(Y);
$abtarr=array();
$abtname=array();
$datum=date("d.m.Y");

switch($target){
	case 'entry': $title=$LDOrDocument;
					  $fileforward='op-doku-start.php'.URL_APPEND.'&retpath='.$retpath;
					  break;
	case 'archiv': $title="$LDOrDocument :: $LDArchive";
					$fileforward='op-doku-archiv.php'.URL_APPEND.'&retpath='.$retpath;
					break;
	case 'search': $title="$LDOrDocument :: $LDSearch";
					$fileforward='op-doku-search.php'.URL_APPEND.'&retpath='.$retpath;
					break;
}

/* Load the department list with oncall doctors */
require_once($root_path.'include/care_api_classes/class_department.php');
$dept_obj=new Department;
$dept_DOC=$dept_obj->getAllActiveWithDOC();

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

 # Collect extra javascript

 ob_start();
?>

<script language="javascript">
<!-- 
  var urlholder;
function popinfo(l,d)
{
	urlholder="doctors-dienstplan-popinfo.php<?php echo URL_REDIRECT_APPEND ?>&nr="+l+"&dept_nr="+d+"&user=<?php echo $aufnahme_user.'"' ?>;
	
	infowin=window.open(urlholder,"dienstinfo","width=400,height=300,menubar=no,resizable=yes,scrollbars=yes");

}

-->
</script>

<?php 

 $sTemp=ob_get_contents();
 ob_end_clean();
 $smarty->append('JavaScript',$sTemp);

$smarty->assign('sMascotImg','<img '.createMascot($root_path,'mascot1_r.gif','0','bottom').' align="absmiddle">');
$smarty->assign('LDPlsSelectDept',$LDPlsSelectDept);

 # Buffer department rows output
 ob_start();

$toggler=0;
while(list($x,$v)=each($dept_DOC)){
	$bold='';
	$boldx='';
	if($hilitedept==$v['nr']){
		echo '<tr bgcolor="yellow">'; $bold="<font color=\"red\" size=2><b>";$boldx="</b></font>";
	} 
	else
		if ($toggler==0) 
			{ echo '<tr class="wardlistrow1">'; $toggler=1;}
				else { echo '<tr class="wardlistrow2">'; $toggler=0;}
	echo '<td ><font face="verdana,arial" size="2" >&nbsp;'.$bold;
	if(isset($$v['LD_var']) && !empty($$v['LD_var'] )) echo  $$v['LD_var'];
		else echo $v['name_formal'];
	echo $boldx.'&nbsp;</td>';
	echo '<td >&nbsp; <a href="'.$fileforward.'&dept_nr='.$v['nr'].'&target='.$target.'">
	<img '.createLDImgSrc($root_path,'ok_small.gif','0','absmiddle').' alt="'.$LDShowActualPlan.'" ></a> </td></tr>';
	echo "\n";

}

$sTemp = ob_get_contents();
 ob_end_clean();

# Assign the submenu to the mainframe center block

 $smarty->assign('sDeptRows',$sTemp);

$smarty->assign('sBackLink','<a href="'.$breakfile.'"><img '.createLDImgSrc($root_path,'close2.gif','0').' alt="'.$LDCloseAlt.'">');

 $smarty->assign('sMainBlockIncludeFile','or/select_dept.tpl');

 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');

?>
