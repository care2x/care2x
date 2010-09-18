<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.2 - 2006-07-10
* GNU General Public License
* Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables=array('departments.php');
define('LANG_FILE','konsil.php');
$local_user='ck_lab_user';

require_once($root_path.'include/core/inc_front_chain_lang.php');
require_once($root_path.'global_conf/inc_global_address.php');
require_once ('includes/inc_diagnostics_report_fx.php');

$breakfile=$root_path.'modules/radiology/radiolog.php'.URL_APPEND;
$returnfile='labor_test_request_admin_'.$subtarget.'.php'.URL_APPEND.'&target='.$target.'&subtarget='.$subtarget.'&user_origin='.$user_origin;
$thisfile='labor_test_findings_'.$subtarget.'.php';

$bgc1='#ffffff';

$edit=1; /* Assume to edit first */

$formtitle=$LDRadiology;
$dept_nr=19; // 19 = department nr. of radiology
$db_request_table=$subtarget;

//$db->debug=1;

require_once($root_path.'include/care_api_classes/class_encounter.php');
$enc_obj=new Encounter;

/* Here begins the real work */

   require_once($root_path.'include/core/inc_date_format_functions.php');
   

     /* Check for the patient number = $pn. If available get the patients data, otherwise set edit to 0 */
     if(isset($pn)&&$pn)
	 {		

	    if( $enc_obj->loadEncounterData($pn)) {
		
			include_once($root_path.'include/care_api_classes/class_globalconfig.php');
			$GLOBAL_CONFIG=array();
			$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
			$glob_obj->getConfig('patient_%');	
			switch ($enc_obj->EncounterClass())
			{
		    	case '1': $full_en = ($pn + $GLOBAL_CONFIG['patient_inpatient_nr_adder']);
		                   break;
				case '2': $full_en = ($pn + $GLOBAL_CONFIG['patient_outpatient_nr_adder']);
							break;
				default: $full_en = ($pn + $GLOBAL_CONFIG['patient_inpatient_nr_adder']);
			}						

			$result=&$enc_obj->encounter;
		}
	   else 
	   {
	      $edit=0;
		  $mode='';
		  $pn='';
	   }		
     }
	 

	   
	 if(!isset($mode) && $batch_nr && $pn)   $mode='edit';
		
		  switch($mode)
		  {
				     case 'save':
							
                                 $sql="INSERT INTO care_test_findings_".$db_request_table." 
								          (
										   batch_nr, encounter_nr, dept_nr, 
										   findings, diagnosis,
										   doctor_id, findings_date, findings_time, 
										   status, 
										   history,
										  create_id,
										  create_time
										  )
										   VALUES
										   (
										   '".$batch_nr."','".$pn."','".$dept_nr."', 
										   '".addslashes(htmlspecialchars($findings))."','".addslashes(htmlspecialchars($diagnosis))."',
										   '".htmlspecialchars($doctor_id)."', '".formatDate2Std($findings_date,$date_format)."', '".date('H:i:s')."',
										   'initial',  
										   'Create: ".date('Y-m-d H:i:s')." = ".$_SESSION['sess_user_name']."\n',
										  '".$_SESSION['sess_user_name']."',
										  '".date('YmdHis')."'
										   )";


							      if($ergebnis=$enc_obj->Transact($sql))
       							  {
								     signalNewDiagnosticsReportEvent($findings_date);
									 //echo $sql;
									 header("location:$thisfile?sid=$sid&lang=$lang&edit=$edit&saved=insert&mode=edit&pn=$pn&station=$station&user_origin=$user_origin&status=$status&target=$target&subtarget=$subtarget&noresize=$noresize&batch_nr=$batch_nr&entry_date=$entry_date");
									 exit;
								  }
								  else 
								  {
								     echo "<p>$sql<p>$LDDbNoSave"; 
									 $mode='';
								  }
								
								break; // end of case 'save'
								
		     case 'update':
			 
							      $sql="UPDATE care_test_findings_".$db_request_table."  SET 
										   findings='".addslashes(htmlspecialchars($findings))."', 
										   diagnosis='".addslashes(htmlspecialchars($diagnosis))."',
										   doctor_id='".htmlspecialchars($doctor_id)."', 
										   findings_date='".formatDate2Std($findings_date,$date_format)."',
										   findings_time='".date('H:i:s')."', 
										   history=".$enc_obj->ConcatHistory("Update: ".date('Y-m-d H:i:s')." = ".$_SESSION['sess_user_name']."\n").",
										   modify_id = '".$_SESSION['sess_user_name']."',
										   modify_time='".date('YmdHis')."'
										   WHERE batch_nr = '".$batch_nr."'";

							      if($ergebnis=$enc_obj->Transact($sql))
       							  {
								     signalNewDiagnosticsReportEvent($findings_date);
									 //echo $sql;
									 header("location:$thisfile?sid=$sid&lang=$lang&edit=$edit&saved=insert&mode=edit&pn=$pn&station=$station&user_origin=$user_origin&status=$status&target=$target&subtarget=$subtarget&noresize=$noresize&batch_nr=$batch_nr&entry_date=$entry_date");
									 exit;
								  }
								  else
								   {
								      echo "<p>$sql<p>$LDDbNoSave"; 
								      $mode='';
								   }
								
								break; // end of case 'save'
								
		     case 'done':
			 
							      $sql="UPDATE care_test_findings_".$db_request_table." SET 
										   status='done',
										   history=".$enc_obj->ConcatHistory("Done: ".date('Y-m-d H:i:s')." = ".$_SESSION['sess_user_name']."\n").",
										   modify_id = '".$_SESSION['sess_user_name']."',
										   modify_time='".date('YmdHis')."'
										   WHERE batch_nr = '".$batch_nr."'";
										  							
							      if($ergebnis=$enc_obj->Transact($sql))
       							  {
									//echo $sql;
							          $sql="UPDATE care_test_request_".$db_request_table." SET 
										   status='done',
										   history=".$enc_obj->ConcatHistory("Done: ".date('Y-m-d H:i:s')." = ".$_SESSION['sess_user_name']."\n").",
										   modify_id = '".$_SESSION['sess_user_name']."',
										   modify_time='".date('YmdHis')."'
										   WHERE batch_nr = '".$batch_nr."'";

							          if($ergebnis=$enc_obj->Transact($sql))
       							      {
								  		// Load the visual signalling functions
										include_once($root_path.'include/core/inc_visual_signalling_fx.php');
										// Set the visual signal 
										setEventSignalColor($pn,SIGNAL_COLOR_DIAGNOSTICS_REPORT);									
									     header("location:$thisfile?sid=$sid&lang=$lang&edit=$edit&saved=insert&mode=edit&pn=$pn&station=$station&user_origin=$user_origin&status=$status&target=$target&subtarget=$subtarget&noresize=$noresize&batch_nr=$batch_nr&entry_date=$entry_date");
									     exit;
								       }
								       else
								       {
								          echo "<p>$sql<p>$LDDbNoSave"; 
								          $mode='save';
								        }								 
									}
								  else
								   {
								      echo "<p>$sql<p>$LDDbNoSave"; 
								      $mode='save';
								   }
								
								break; // end of case 'save'
								
								
	        /* If mode is edit, get the stored test findings 
			*/
			case 'edit':

			           $sql="SELECT * FROM care_test_findings_".$db_request_table." WHERE batch_nr='$batch_nr'";
		                if($ergebnis=$db->Execute($sql))
       		            {
				            if($editable_rows=$ergebnis->RecordCount())
					        {
     					       $stored_findings=$ergebnis->FetchRow();
							   if($stored_findings['status']=='done') $edit=0; /* Inhibit editing of the findings */
							   $edit_form=1;
					         }
							 else
							 {
							    $mode='save';
						     }
			             }
						 else
						 {
						    $mode='save';
						  }
						 
						 break; ///* End of case 'edit': */
						 
			 default:	$mode='';
			 
		  }// end of switch($mode)

if($edit) $returnfile.='&batch_nr='.$batch_nr.'&pn='.$pn.'&tracker='.$tracker; 

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('nursing');

# Title in toolbar
 $smarty->assign('sToolbarTitle',$LDDiagnosticTest." (".$batch_nr.")");

  # hide back button
 $smarty->assign('pbBack',$returnfile);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('pending_radio_findings.php')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',$LDDiagnosticTest." (".$batch_nr.")");

$smarty->assign('sOnLoadJs','onLoad="if (window.focus) window.focus();"');

 # Collect extra javascript code

 ob_start();
?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE><?php echo "$LDDiagnosticTest $station" ?></TITLE>
<?php
require($root_path.'include/core/inc_js_gethelp.php');
require($root_path.'include/core/inc_css_a_hilitebu.php');

?>
<style type="text/css">
div.fva2_ml10 {font-family: verdana,arial; font-size: 12; margin-left: 10;}
div.fa2_ml10 {font-family: arial; font-size: 12; margin-left: 10;}
div.fva2_ml3 {font-family: verdana; font-size: 12; margin-left: 3; }
div.fa2_ml3 {font-family: arial; font-size: 12; margin-left: 3; }
.fva2_ml10 {font-family: verdana,arial; font-size: 12; margin-left: 10; color:#000099;}
.fva2b_ml10 {font-family: verdana,arial; font-size: 12; margin-left: 10; color:#000000;}
.fva0_ml10 {font-family: verdana,arial; font-size: 10; margin-left: 10; color:#000099;}
.fvag_ml10 {font-family: verdana,arial; font-size: 10; margin-left: 10; color:#969696;}
</style>

<script language="javascript">
<!-- 

<?php
/**
*  Output the following function only when in edit mode 
*/
if ($edit)
{
?>

function chkForm(d){

  if(d.findings.value=="" && d.diagnosis.value=="") return false;
   else if(d.findings_date.value=="" || d.findings_date.value==" ")
	{
		alert("<?php echo $LDPlsEnterDate ?>");
		d.findings_date.focus();
		return false;
	}
	else if(d.doctor_id.value=="" || d.doctor_id.value==" ")
	{
		alert("<?php echo $LDPlsEnterDoctorName ?>");
		d.doctor_id.focus();
		return false;
	}
	else 
	{
	   return true;
	}
}

<?php
}
?>

function printOut()
{
	urlholder="labor_test_findings_printpop.php?sid=<?php echo $sid ?>&lang=<?php echo $lang ?>&user_origin=<?php echo $user_origin ?>&subtarget=<?php echo $subtarget ?>&batch_nr=<?php echo $batch_nr ?>&pn=<?php echo $pn ?>&entry_date=<?php echo $entry_date ?>";
	findings_printout<?php echo $sid ?>=window.open(urlholder,"findings_printout<?php echo $sid ?>","width=800,height=600,menubar=no,resizable=yes,scrollbars=yes");
    findings_printout<?php echo $sid ?>.print();
}

<?php require($root_path.'include/core/inc_checkdate_lang.php'); ?>
//-->
</script>
<?php

$sTemp = ob_get_contents();

ob_end_clean();

$smarty->append('JavaScript',$sTemp);

ob_start();

?>

 <ul>

<?php if ($edit)
{
?>
<form name="form_test_request" method="post" action="<?php echo $thisfile ?>" onSubmit="return chkForm(this)">
<?php
}

require_once($root_path.'includes/inc_test_findings_form_'.$subtarget.'.php');

echo '&nbsp;<br>';
if ($edit)
{
   echo'
         <input type="image" '.createLDImgSrc($root_path,'savedisc.gif','0').'>';

}

?>
  
<a href="javascript:printOut()"><img <?php echo createLDImgSrc($root_path,'printout.gif','0') ?>></a>
<?php
if (isset($stored_findings['status']) && $stored_findings['status']!='done' )
{
  echo'
         <a href="'. $thisfile.'?sid='.$sid.'&lang='.$lang.'&edit='.$edit.'&mode=done&target='.$target.'&subtarget='.$subtarget.'&batch_nr='.$batch_nr.'&pn='.$pn.'&user_origin='.$user_origin.'&entry_date='.$entry_date.'"><img '.createLDImgSrc($root_path,'done.gif','0').' alt="'.$LDDone.'"></a>';
}
?>

<?php
if ($edit)
{
require($root_path.'modules/laboratory/includes/inc_test_request_hiddenvars.php');

?>
<input type="hidden" name="entry_date" value="<?php echo $entry_date ?>">

</form>
<?php
}
?>

</ul>

<?php

$sTemp = ob_get_contents();
ob_end_clean();

# Assign to page template object
$smarty->assign('sMainFrameBlockData',$sTemp);

 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');

 ?>
