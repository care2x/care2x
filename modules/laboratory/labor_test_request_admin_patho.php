<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System version deployment 1.1 (mysql) 2004-01-11
* GNU General Public License
* Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
* , elpidio@care2x.org
*
* See the file "copy_notice.txt" for the licence notice
*/

/* Start initializations */
$lang_tables[] = 'departments.php';
define('LANG_FILE','konsil.php');

/* We need to differentiate from where the user is coming: 
*  $user_origin != lab ;  from patient charts folder
*  $user_origin == lab ;  from the laboratory
*  and set the user cookie name and break or return filename
*/
if($user_origin=='lab'){
	$local_user='ck_lab_user';
	$breakfile="labor.php?sid=".$sid."&lang=".$lang; 
}elseif($user_origin=='amb'){
	$local_user='ck_lab_user';
	$breakfile=$root_path.'modules/ambulatory/ambulatory.php'.URL_APPEND;
}else{
	$local_user='ck_pflege_user';
	$breakfile="pflege-station-patientdaten.php?sid=$sid&lang=$lang&edit=$edit&station=$station&pn=$pn";
}

require_once($root_path.'include/core/inc_front_chain_lang.php'); # call the script lock

 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme
 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('laboratory');

$thisfile=basename(__FILE__);

$bgc1='#cde1ec'; /* The main background color of the form */

$edit_form=0; /* Set form to non-editable*/
$read_form=1; /* Set form to read */
$edit=0; /* Set script mode to no edit*/

$formtitle=$LDPathology;

$db_request_table=$subtarget;

/* Here begins the real work */
/* Establish db connection */
if(!isset($db)||!$db) include($root_path.'include/core/inc_db_makelink.php');
if($dblink_ok) {	

     require_once($root_path.'include/core/inc_date_format_functions.php');
      
	 if(!isset($mode))   $mode='';
		
		  switch($mode) {
		     case 'update':
							      $sql="UPDATE care_test_request_".$db_request_table." SET 
                                          entry_date='".formatDate2Std($entry_date,$date_format)."',
										  journal_nr='".$journal_nr."',
										  blocks_nr='".$blocks_nr."',
										  deep_cuts='".$deep_cuts."',
										  special_dye='".$special_dye."',
										  immune_histochem='".$immune_histochem."',
										  hormone_receptors='".$hormone_receptors."',
										  specials='".$specials."',
										  modify_id = '".$_COOKIE[$local_user.$sid]."'
										   WHERE batch_nr = '".$batch_nr."'";
							      if($ergebnis=$db->Execute($sql))
       							  {
									//echo $sql;
									
									 header("location:".$thisfile.URL_REDIRECT_APPEND."&edit=$edit&saved=update&pn=$pn&station=$station&user_origin=$user_origin&status=$status&target=$target&subtarget=$subtarget&batch_nr=$batch_nr&noresize=$noresize");
									 exit;
								  }
								  else
								   {
								      echo "<p>$sql<p>$LDDbNoSave"; 
								      $mode="";
								   }
								break; // end of case 'save'
			
			 default: $mode="";
						   
		  }// end of switch($mode)
  
          if(!$mode) /* Get the pending test requests */
		  {
		                $sql="SELECT batch_nr,encounter_nr,send_date,dept_nr FROM care_test_request_".$subtarget." 
						         WHERE (status='pending' OR status='') ORDER BY  send_date DESC";
		                if($requests=$db->Execute($sql))
       		            {
						
				            $batchrows=$requests->RecordCount();
	                        if($batchrows && (!isset($batch_nr) || !$batch_nr)) 
					        {
						       $test_request=$requests->FetchRow();
							   
                               /* Check for the patietn number = $pn. If available get the patients data */
		                       $pn=$test_request['encounter_nr'];
						       $batch_nr=$test_request['batch_nr'];
							}
			             }
			               else {echo "<p>$sql<p>$LDDbNoRead"; exit;}
						 $mode='update';   
		   }	
		       
	   
     /* Check for the patietn number = $pn. If available get the patients data */
     if($batchrows && $pn)
	 {		
		include_once($root_path.'include/care_api_classes/class_encounter.php');
		$enc_obj=new Encounter;
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

			$sql="SELECT * FROM care_test_request_".$subtarget." WHERE batch_nr='".$batch_nr."'";
			if($ergebnis=$db->Execute($sql)){
				if($editable_rows=$ergebnis->RecordCount()){
					$stored_request=$ergebnis->FetchRow();
					$edit_form=1;
				}
            }else{
				echo "<p>$sql<p>$LDDbNoRead"; 
			}	
		}					   
	}
}else{
	echo "$LDDbNoLink<br>$sql<br>"; 
}

# Prepare title
$sTitle = $LDPendingTestRequest;
if($batchrows) $sTitle = $sTitle." (".$batch_nr.")";

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common');

# Title in toolbar
 $smarty->assign('sToolbarTitle',$sTitle);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('pending_patho.php')");

 # hide return  button
 $smarty->assign('pbBack',FALSE);

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',$sTitle);

 # collect extra javascript code
 ob_start();
?>

<style type="text/css">
div.fva2_ml10 {
	font-family: verdana, arial;
	font-size: 12;
	margin-left: 10;
}

div.fa2_ml10 {
	font-family: arial;
	font-size: 12;
	margin-left: 10;
}

div.fva2_ml3 {
	font-family: verdana;
	font-size: 12;
	margin-left: 3;
}

div.fa2_ml3 {
	font-family: arial;
	font-size: 12;
	margin-left: 3;
}

.fva2_ml10 {
	font-family: verdana, arial;
	font-size: 12;
	margin-left: 10;
	color: #000099;
}

.fva2b_ml10 {
	font-family: verdana, arial;
	font-size: 12;
	margin-left: 10;
	color: #000000;
}

.fva0_ml10 {
	font-family: verdana, arial;
	font-size: 10;
	margin-left: 10;
	color: #000099;
}

.fvag_ml10 {
	font-family: verdana, arial;
	font-size: 10;
	margin-left: 10;
	color: #969696;
}

.lab {
	font-family: arial;
	font-size: 9;
	color: purple;
}

.lmargin {
	margin-left: 5;
}
</style>

<script language="javascript">
<!-- 

function chkForm(d)
{ 
/*  if(d.journal_nr.value=="" && d.blocks_nr.value=="" && d.deep_cuts.value=="" && d.special_dye.value=="" && d.immune_histochem.value=="" && d.hormone_receptors.value=="" && d.specials.value=="" ) return false;
*/
    if(d.journal_nr.value=="") return false;
    else return true;
}


function printOut()
{
	urlholder="<?php echo $root_path ?>modules/laboratory/labor_test_request_printpop.php?sid=<?php echo $sid ?>&lang=<?php echo $lang ?>&user_origin=<?php echo $user_origin ?>&subtarget=<?php echo $subtarget ?>&batch_nr=<?php echo $batch_nr ?>&pn=<?php echo $pn ?>";
	testprintout<?php echo $sid ?>=window.open(urlholder,"testprintout<?php echo $sid ?>","width=800,height=600,menubar=no,resizable=yes,scrollbars=yes");
    //testprintout<?php echo $sid ?>.print();
}

<?php require($root_path.'include/core/inc_checkdate_lang.php'); ?>
//-->
</script>
<?php

$sTemp = ob_get_contents();
ob_end_clean();

$smarty->append('JavaScript',$sTemp);

# Buffer page output

ob_start();

if($batchrows){

?>

<table border=0>
	<tr valign="top">
		<!-- left frame for the requests list -->
		<td>

<?php 

/* The following routine creates the list of pending requests */
require('includes/inc_test_request_lister_fx.php');

?>
		</td>

		<!--  right frame for the request form -->

		<td>

		<form name="form_test_request" method="post"
			action="<?php echo $thisfile ?>" onSubmit="return chkForm(this)"><!--         Control buttons save, print         -->
		<input type="image"
			<?php echo createLDImgSrc($root_path,'savedisc.gif','0','absmiddle') ?>
			title="<?php echo $LDSaveEntry ?>"> <a href="javascript:printOut()"><img
			<?php echo createLDImgSrc($root_path,'printout.gif','0','absmiddle') ?>
			alt="<?php echo $LDPrintOut ?>"></a> <!--   Control button enter findings   -->
<?php
if($stored_request['entry_date'] && $stored_request['entry_date'] != DBF_NODATE)	
{
?>	
		
        <a
			href="<?php echo 'labor_test_findings_'.$subtarget.'.php?sid='.$sid.'&lang='.$lang.'&batch_nr='.$batch_nr.'&pn='.$pn.'&entry_date='.$stored_request['entry_date'].'&target='.$target.'&subtarget='.$subtarget.'&user_origin='.$user_origin.'&tracker='.$tracker; ?>"><img
			<?php echo createLDImgSrc($root_path,'enter_result.gif','0','absmiddle') ?>
			alt="<?php echo $LDEnterResult ?>"></a>
<?php
}

	$smarty->assign('bgc1',$bgc1);
	$smarty->assign('printmode',FALSE);
	$smarty->assign('edit',FALSE);
	$smarty->assign('read_form',TRUE);

	$read_form=TRUE;
	//$edit = FALSE;

	include('includes/inc_test_request_printout_patho.php');

	$smarty->display('forms/pathology.tpl');

	require($root_path.'modules/laboratory/includes/inc_test_request_hiddenvars.php');

?>	<br>
		<input type="image"
			<?php echo createLDImgSrc($root_path,'savedisc.gif','0','absmiddle') ?>
			title="<?php echo $LDSaveEntry ?>"> <a href="javascript:printOut()"><img
			<?php echo createLDImgSrc($root_path,'printout.gif','0','absmiddle') ?>
			alt="<?php echo $LDPrintOut ?>"></a>
<?php
if($stored_request['entry_date'] && $stored_request['entry_date'] != DBF_NODATE)
{
?>	
		
        <a
			href="<?php echo 'labor_test_findings_'.$subtarget.'.php?sid='.$sid.'&lang='.$lang.'&batch_nr='.$batch_nr.'&pn='.$pn.'&entry_date='.$stored_request['entry_date'].'&target='.$target.'&subtarget='.$subtarget.'&user_origin='.$user_origin.'&tracker='.$tracker; ?>"><img
			<?php echo createLDImgSrc($root_path,'enter_result.gif','0','absmiddle') ?>
			alt="<?php echo $LDEnterResult ?>"></a>
<?php
}
?>
			</form>
		</td>
	</tr>
</table>

<?php
}
else
{
?>
<img <?php echo createMascot($root_path,'mascot1_r.gif','0','bottom') ?>
	align="absmiddle">
<font size=3 face="verdana,arial" color="#990000"><b><?php echo $LDNoPendingRequest ?></b></font>
<p><a href="<?php echo $breakfile ?>"><img
	<?php echo createLDImgSrc($root_path,'back2.gif','0') ?>></a>
<?php
}

$sTemp = ob_get_contents();
 ob_end_clean();

# Assign the page output to main frame template

 $smarty->assign('sMainFrameBlockData',$sTemp);

 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');

?>
