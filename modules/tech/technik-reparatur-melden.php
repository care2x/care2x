<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'/include/core/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','tech.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/core/inc_front_chain_lang.php');

$breakfile='technik.php'.URL_APPEND;
$returnfile=$_SESSION['sess_file_return'].URL_APPEND;
$_SESSION['sess_file_return']=basename(__FILE__);

//$db->debug=1;

if(isset($job)&&!empty($job)){
	$dbtable='care_tech_repair_done';

    if(!isset($db) || !$db) include_once($root_path.'include/core/inc_db_makelink.php');
    if($dblink_ok) {
			
        $sql="INSERT INTO ".$dbtable." 
						(	dept,
							job,
							job_id,
							reporter,
							id,
							tdate,
							ttime,
							tid,
							seen,
							d_idx,
							status,
							history,
							create_id,
							create_time
							 )
						VALUES
						(
							'".htmlspecialchars($_POST['dept'])."',
							'".htmlspecialchars($_POST['job'])."',
							'".htmlspecialchars($_POST['job_id'])."',
							'".htmlspecialchars($_POST['reporter'])."',
							'".htmlspecialchars($_POST['id'])."', 
							'".$_POST['tdate']."', 
							'".$_POST['ttime']."',
							'".date('YmdHis')."',
							0,
							'".date('Ymd')."',
							'pending',
							'Create ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."\n',
							'".$_SESSION['sess_user_name']."',
							'".date('YmdHis')."'
							)";
        $db->BeginTrans();
        $ok=$db->Execute($sql);
        if($ok && $db->CommitTrans()) {
		    header("Location: technik-reparatur-empfang.php".URL_REDIRECT_APPEND."&dept=".$_POST['dept']."&reporter=".$_POST['reporter']."&tdate=".$_POST['tdate']."&ttime=".$_POST['ttime']);
		    exit;
         } else {
			$db->RollbackTrans();
		 	echo '<p>'.$sql.$LDDbNoSave.'<br>';
		}
	} else { echo "$LDDbNoLink<br>"; }
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
 $smarty->assign('pbHelp',"javascript:gethelp('tech.php','report')");

 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('title',$LDTechSupport);

 # Collect extra javascrit code

 ob_start();
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE> OP </TITLE>

 <script language="javascript" >
<!-- 

function checkform(d)
{
	if(d.dept.selectedIndex==-1) 
		{	alert("<?php echo $LDAlertDept ?>");
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

$smarty->assign('sFormTag','<form  action="technik-reparatur-melden.php" method="post" onSubmit="return checkform(this)">');
$smarty->assign('LDRepairReport',$LDRepairReport);
$smarty->assign('LDPlsDoneOnly',$LDPlsDoneOnly);
$smarty->assign('LDRepairArea',$LDRepairArea);
$smarty->assign('LDTechnician',$LDTechnician);
$smarty->assign('LDPersonnelNr',$LDPersonnelNr);
$smarty->assign('LDPlsTypeReport',$LDPlsTypeReport);
$smarty->assign('LDJobIdNr',$LDJobIdNr);

$smarty->assign('sHiddenInputs','<input type="hidden" name="tdate" value="'.date('Y-m-d').'" >
	<input type="hidden" name="ttime" value= "'.date('H:i:s').'">
	<input type="hidden" name="sid" value= "'.$sid.'">
	<input type="hidden" name="lang" value= "'.$lang.'">');


$smarty->assign('pbSubmit','<input type="image"  '.createLDImgSrc($root_path,'abschic.gif','0','middle').'>');
$smarty->assign('pbCancel','<a href="'.$breakfile.'" ><img '.createLDImgSrc($root_path,'cancel.gif','0','middle').' title="'.$LDCancel.'" align="middle"></a>');

$smarty->assign('sRepairLink','<a href="technik-reparatur-anfordern.php'.URL_APPEND.'">'.$LDReRepairTxt.'</a>');
$smarty->assign('sQuestionLink','<a href="technik-questions.php'.URL_APPEND.'">'.$LDQuestionsTxt.'</a>');

$smarty->assign('sMainBlockIncludeFile','tech/repair_report.tpl');

 /**
 * show Template
 */

 $smarty->display('common/mainframe.tpl');
 // $smarty->display('debug.tpl');
 ?>