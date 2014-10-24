<?php
//error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
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
$lang_tables[]='departments.php';
define('LANG_FILE','tech.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/core/inc_front_chain_lang.php');

$thisfile=basename(__FILE__);
$breakfile='technik.php'.URL_APPEND;
$returnfile=$_SESSION['sess_file_return'].URL_APPEND;
$_SESSION['sess_file_return']=basename(__FILE__);

if(!isset($mode)) $mode='';

//$db->debug=1;

if(!isset($inquirer)||empty($inquirer))
{
	if(isset($_GET['inquirer'])&&!empty($_GET['inquirer'])) 
	{
	    $inquirer=$_GET['inquirer'];
    }
	elseif(isset($_POST['inquirer'])&&!empty($_POST['inquirer'])) 
	{
	    $inquirer=$_POST['inquirer'];
    }
/*	else
	{
	     $inquirer=$_SESSION['sess_user_name'];
	}
*/}

$dbtable='care_tech_questions';

    /* Load the date formatter */
    include_once($root_path.'include/core/inc_date_format_functions.php');
    

    if($mode=='save') {
						$sql="INSERT INTO ".$dbtable." 
						(	dept,
							query,
							inquirer,
							tphone,
							tdate,
							ttime,
							tid,
							answered,
							status,
							history,
							create_id,
							create_time
							 )
						VALUES 
						(
							'$dept',
							'".htmlspecialchars($_POST['query'])."',
							'$inquirer',
							'".$_POST['tphone']."', 
							'".$_POST['tdate']."', 
							'".$_POST['ttime']."', 
							'".date('YmdHis')."',
							'0',
							'pending',
							'Create ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."\n',
							'".$_SESSION['sess_user_name']."',
							'".date('YmdHis')."'
							)";
        $db->BeginTrans();
        $ok=$db->Execute($sql);
        if($ok && $db->CommitTrans()) {
			$inquirer=strtr($inquirer,' ','+');
			header("Location: technik-questions.php".URL_REDIRECT_APPEND."&dept=$dept&inquirer=$inquirer");
			exit;
		}else {
			$db->RollbackTrans();
			echo "<p>".$sql."$LDDbNoSave<br>"; };
    	}

    if($mode=='read') {
/*        $sql="SELECT tdate,ttime,inquirer,query,answered,reply,ansby,astamp FROM $dbtable
							 WHERE inquirer='$inquirer'
							 		AND dept='".$_GET['dept']."'
									AND tdate='".$_GET['tdate']."'
									AND ttime='".$_GET['ttime']."'
									AND tid='".$_GET['tid']."'
									LIMIT 0,10"; 
*/        $sql="SELECT tdate,ttime,inquirer,query,answered,reply,ansby,astamp FROM $dbtable
							 WHERE batch_nr='".$_GET['batch_nr']."'";
        if($result=$db->SelectLimit($sql,10)) {
            $inhalt=$result->FetchRow();		
        } else {echo "<p>$sql $LDDbNoSave<br>"; };
    }
			
    $sql="SELECT batch_nr,dept,tdate,ttime,inquirer,tid,query,answered FROM $dbtable WHERE inquirer='$inquirer'  ORDER BY tid DESC";
    if($ergebnis=$db->SelectLimit($sql,6)) {
        $rows = $ergebnis->RecordCount();
    } else {echo '<p>'.$sql.$LDDbNoRead.'<br>'; };

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
 $smarty->assign('pbHelp',"javascript:gethelp('tech.php','queries')");

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
	if(d.query.value=="") 
		{	alert("<?php echo $LDAlertQuestion ?>");
			d.query.focus();
			return false;
		}
	if(d.inquirer.value=="") 
		{	alert("<?php echo $LDAlertName ?>");
			d.inquirer.focus();
			return false;
		}
	if(d.dept.value=="") 
		{	alert("<?php echo $LDAlertDeptOnly ?>");
			d.dept.focus();
			return false;
		}
	return true;
}

// -->
</script> 

<style type="text/css" name="s2">
td.vn { font-family:verdana,arial; color:#000088; font-size:10;background-color:#dedede}
</style>

<?php 

$sTemp = ob_get_contents();
ob_end_clean();

$smarty->append('JavaScript',$sTemp);

if (($mode=='read')){

	$smarty->assign('bShowInquiry',TRUE);

	$smarty->assign('sInquirerData',"$LDInquiry $LDFrom ".$inhalt['inquirer']." $LDOn ".@formatDate2Local($inhalt['tdate'],$date_format)." $LDAt ".convertTimeToLocal($inhalt['ttime'])." $LDOClock:");
	$smarty->assign('sInquiry','" '.nl2br($inhalt['query']).' "');

	if(isset($inhalt['answered']) && $inhalt['answered']){
		$smarty->assign('bShowAnswer',TRUE);

		$smarty->assign('sReplyData',"$LDReply $LDFrom ".$inhalt['ansby']." $LDOn ".@formatDate2Local($inhalt['astamp'],$date_format,1)." $LDOClock:");
		$smarty->assign('sReply','" '.nl2br($inhalt['reply']).' "');

		}
}

# Inquiries list minibox

$smarty->assign('LDLastQuestions',str_replace('~tagword~',$rows,$LDLastQuestions));

$sTemp = '';

if($rows){
	while ($content=$ergebnis->FetchRow()){
		//echo "&nbsp;<b>".formatDate2Local($content['tdate'],$date_format).":</b> <a href=\"$thisfile".URL_APPEND."&mode=read&dept=".$content['dept']."&tdate=".$content['tdate']."&ttime=".$content['ttime']."&inquirer=".$content['inquirer']."&tid=".$content['tid']."\">".substr($content[query],0,40)."...";
		$sTemp = $sTemp."&nbsp;<b>".@formatDate2Local($content['tdate'],$date_format).":</b> <a href=\"$thisfile".URL_APPEND."&mode=read&batch_nr=".$content['batch_nr']."&dept_nr=".$dept_nr."&inquirer=".strtr($inquirer,' ','+')."\">".substr($content[query],0,40)."...";
		if(isset($content['answered'])&&!empty($content['answered'])) $sTemp = $sTemp.'<img '.createComIcon($root_path,'warn.gif','0').'>';
		$sTemp = $sTemp.'</a><p>';
	}
}

$smarty->assign('sInquiryList',$sTemp);
$smarty->assign('LDFrom',$LDFrom);
$smarty->assign('sListboxHiddenInputs','
		<input type="hidden" name="sid" value="'.$sid.'">
		<input type="text" name="inquirer" size=19 maxlength=40 value="'.$inquirer.'">
		<input type="hidden" name="lang" value= "'.$lang.'">');

$smarty->assign('sListboxSubmit','<input type="submit" value="'.$LDLogIn.'">');

$smarty->assign('sButton','<img '.createComIcon($root_path,'varrow.gif','0').'>');

$smarty->assign('sFormTag','<form ENCTYPE="multipart/form-data" action="technik-questions.php" method="post" onSubmit="return checkform(this)">');

$smarty->assign('LDQuestions',$LDQuestions);

$smarty->assign('LDEnterQuestion',$LDEnterQuestion);

$smarty->assign('LDPlsNoRequest','<a href="technik-reparatur-anfordern.php'.URL_APPEND.'">'.$LDPlsNoRequest.'</a>');

$smarty->assign('LDName',$LDName);
$smarty->assign('LDDept',$LDDept);

if($inquirer) $smarty->assign('sInquirer',$inquirer);
	elseif(isset($_SESSION['sess_user_name'])) $smarty->assign('sInquirer',$_SESSION['sess_user_name']);

$smarty->assign('dept_name',$dept_name);

$smarty->assign('sHiddenInputs','<input type="hidden" name="tdate" value="'.date('Y-m-d').'" >
		<input type="hidden" name="ttime" value= "'.date('H:i:s').'">
		<input type="hidden" name="sid" value= "'.$sid.'">
		<input type="hidden" name="lang" value= "'.$lang.'">
		<input type="hidden" name="mode" value="save">');

$smarty->assign('pbSubmit','<input type="image"  '.createLDImgSrc($root_path,'abschic.gif','0','middle').'>');
$smarty->assign('pbCancel','<a href="'.$breakfile.'" ><img '.createLDImgSrc($root_path,'cancel.gif','0','middle').' title="'.$LDCancel.'" align="middle"></a>');

$smarty->assign('sReportLink','<a href="technik-reparatur-melden.php'.URL_APPEND.'">'.$LDRepairReportTxt.'</a>');
$smarty->assign('sRepairLink','<a href="technik-reparatur-anfordern.php'.URL_APPEND.'">'.$LDReRepairTxt.'</a>');

$smarty->assign('sMainBlockIncludeFile','tech/send_inquiry.tpl');

 /**
 * show Template
 */

 $smarty->display('common/mainframe.tpl');
 // $smarty->display('debug.tpl');
 ?>