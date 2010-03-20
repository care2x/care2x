<?php
//error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'/include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables[]='departments.php';
define('LANG_FILE','tech.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');

# Resolve department
require_once($root_path.'include/inc_resolve_dept.php');
# Resolve ward
require_once($root_path.'include/inc_resolve_ward.php');
	
$breakfile='technik.php'.URL_APPEND;
$returnfile=$_SESSION['sess_file_return'].URL_APPEND;
$_SESSION['sess_file_return']=basename(__FILE__);

//$db->debug=1;

if(!isset($_COOKIE['ck_login_username'.$sid])) $_COOKIE['ck_login_username'.$sid]='';

if(!isset($dept)) $dept='';

if(isset($job)&&!empty($job)) {

    $dbtable='care_tech_repair_job';

        $sql="INSERT INTO ".$dbtable." 
						(	dept,
							job,
							reporter,
							id,
							tphone,
							tdate,
							ttime,
							tid,
							done,
							d_idx,
							status,
							history,
							create_id,
							create_time
							 )
						VALUES 
						(
							'".htmlspecialchars($dept)."',
							'".htmlspecialchars($job)."',
							'".htmlspecialchars($reporter)."',
							'".htmlspecialchars($id)."', 
							'".htmlspecialchars($tphone)."',
							'$tdate', 
							'$ttime', 
							'".date('YmdHis')."',
							'0',
							'".date('Ymd')."',
							'pending',
							'Create ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."\n',
							'".$_SESSION['sess_user_name']."',
							'".date('YmdHis')."'
							)";
							
        $db->BeginTrans();
        $ok=$db->Execute($sql);
        if($ok && $db->CommitTrans()) {
            header("Location: technik-reparatur-empfang.php".URL_REDIRECT_APPEND."&repair=ask&dept=$dept&reporter=$reporter&tdate=$tdate&ttime=$ttime"); exit;
        } else {
            $db->RollbackTrans();
            echo "<p>".$sql."$LDDbNoSave<br>"; 
        };
}

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common');

# Toolbar title

 $smarty->assign('sToolbarTitle',$LDTechSupport);

 # href for the return button
 $smarty->assign('pbBack',$returnfile);

# href for the  button
 $smarty->assign('pbHelp',"javascript:gethelp('tech.php','request')");

 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('title',$LDTechSupport);

 # Collect extra javascrit code

 ob_start();

?>

 <script language="javascript" >
<!--
function checkform(d)
{
	if(d.dept.selectedIndex==-1) 
		{	alert("<?php echo $LDAlertDept ?>");
		    d.dept.focus();
			return false;
		}
	if(d.reporter.value=="") 
		{	alert("<?php echo $LDAlertName ?>");
		    d.reporter.focus();
			return false;
		}
	if(d.id.value=="") 
		{	alert("<?php echo $LDAlertPNr ?>");
		    d.id.focus();
			return false;
		}
	if(d.job.value=="") 
		{	alert("<?php echo $LDPlsDescribe ?>");
		    d.job.focus();
			return false;
		}
	return true;
}
// -->
</script> 

<?php 
	
$sTemp = ob_get_contents();
ob_end_clean();

$smarty->append('JavaScript',$sTemp);

$smarty->assign('sButton','<img '.createComIcon($root_path,'varrow.gif','0').'>');

$smarty->assign('sFormTag','<form  action="technik-reparatur-anfordern.php" method="post" onSubmit="return checkform(this)">');

$smarty->assign('LDReRepairTxt',$LDReRepairTxt);

$smarty->assign('LDRepairArea',$LDRepairArea);
$smarty->assign('sArea',strtoupper($ward_id)." - ".$cfg['thispc_room_nr']." - ".$dept_name);
$smarty->assign('LDReporter',$LDReporter);
$smarty->assign('sUserName',$_SESSION['sess_user_name']);
$smarty->assign('LDPersonnelNr',$LDPersonnelNr);
$smarty->assign('LDPhoneNr',$LDPhoneNr);
$smarty->assign('sThisPhoneNr',$cfg['thispc_phone']);
$smarty->assign('LDPlsDescribe',$LDPlsDescribe);

$smarty->assign('sHiddenInputs','<input type="hidden" name="tdate" value="'.date('Y-m-d').'" >
<input type="hidden" name="ttime" value= "'.date('H:i:s').'">
<input type="hidden" name="sid" value= "'.$sid.'">
<input type="hidden" name="lang" value= "'.$lang.'">');


$smarty->assign('pbSubmit','<input type="image"  '.createLDImgSrc($root_path,'abschic.gif','0','middle').'>');
$smarty->assign('pbCancel','<a href="'.$breakfile.'" ><img '.createLDImgSrc($root_path,'cancel.gif','0','middle').' title="'.$LDCancel.'" align="middle"></a>');

$smarty->assign('sReportLink','<a href="technik-reparatur-melden.php'.URL_APPEND.'">'.$LDRepairReportTxt.'</a>');
$smarty->assign('sQuestionLink','<a href="technik-questions.php'.URL_APPEND.'">'.$LDQuestionsTxt.'</a>');

$smarty->assign('sMainBlockIncludeFile','tech/repair_request.tpl');

 /**
 * show Template
 */

 $smarty->display('common/mainframe.tpl');
 // $smarty->display('debug.tpl');
 ?>