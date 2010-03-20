<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
//error_reporting(E_ALL);
/**
* CARE2X Integrated Hospital Information System version deployment 1.1 (mysql) 2004-01-11
* GNU General Public License
* Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
* , elpidio@care2x.org
*
* See the file "copy_notice.txt" for the licence notice
*/
///$db->debug=true;
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
	$breakfile=$root_path."modules/laboratory/labor.php".URL_APPEND;
}elseif($user_origin=='amb'){
	$local_user='ck_lab_user';
	$breakfile=$root_path.'modules/ambulatory/ambulatory.php'.URL_APPEND;
}else{
	$local_user='ck_pflege_user';
	$breakfile=$root_path."modules/nursing/nursing-station-patientdaten.php".URL_APPEND."&edit=$edit&station=$station&pn=$pn";
}
///* invoke the script lock*/
require_once($root_path.'include/inc_front_chain_lang.php'); 
///* load variable elements */
require_once($root_path.'include/inc_test_request_vars_baclabor.php');

/* Load additional languge table */
if(file_exists($root_path.'language/'.$lang.'/lang_'.$lang.'_konsil_baclabor.php')) 
	include_once($root_path.'language/'.$lang.'/lang_'.$lang.'_konsil_baclabor.php');
else 
	include_once($root_path.'language/'.LANG_DEFAULT.'/lang_'.LANG_DEFAULT.'_konsil_baclabor.php');


$thisfile="labor_test_request_admin_baclabor.php";

$bgc1='#fff3f3'; /* The main background color of the form */

$edit_form=0; /* Set form to non-editable*/
$read_form=1; /* Set form to read */
$edit=0; /* Set script mode to no edit*/

$formtitle=$LDBacteriologicalLaboratory;

$db_request_table=$subtarget;
$subtarget_sub=$subtarget . '_sub';
/* Here begins the real work */

/* Get the pending test requests */
if(!isset($mode) || empty($mode)) {
		
	$sql="SELECT batch_nr,encounter_nr,send_date,dept_nr FROM care_test_request_".$db_request_table."
				WHERE status='pending' ORDER BY  send_date DESC";
	if($requests=$db->Execute($sql)){
		/* If request is available, load the date format functions */
		require_once($root_path.'include/inc_date_format_functions.php');
		$batchrows=$requests->RecordCount();
		if($batchrows && (!isset($batch_nr) || !$batch_nr)) {
			$test_request=$requests->FetchRow();
			/* Check for the patietn number = $pn. If available get the patients data */
			$pn=$test_request['encounter_nr'];
			$batch_nr=$test_request['batch_nr'];
		}
	}else{
		echo "<p>$sql<p>$LDDbNoRead";
		exit;
	}
	$mode="show";
}else{
	$mode='';
}

/* Check for the patient number = $pn. If available get the patient's data */
if($batchrows && $pn){
		
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

		$sql  = "SELECT * FROM care_test_request_".$subtarget." ";
		$sql .= "INNER JOIN care_test_request_".$subtarget_sub." ON ";
		$sql .= "( care_test_request_".$subtarget.".batch_nr = care_test_request_".$subtarget_sub.".batch_nr) ";
		$sql .= "WHERE care_test_request_".$subtarget.".batch_nr='".$batch_nr."'";
	    
		if($ergebnis=$db->Execute($sql)){
			if($editable_rows=$ergebnis->RecordCount()){
				while ( !$ergebnis->EOF ) {
					$stored_material[$ergebnis->fields['material']] = $ergebnis->fields['material'];
					$stored_test_type[$ergebnis->fields['test_type']] = $ergebnis->fields['test_type'];
					$stored_request=$ergebnis->GetRowAssoc($toUpper=false);
					$ergebnis->MoveNext();
				}

				$edit_form=1;
			}
		}else{
			echo "<p>$sql<p>$LDDbNoRead";
		}
	}

    $sql  = "SELECT * FROM care_test_findings_".$db_request_table." ";
	$sql .= "INNER JOIN care_test_findings_".$db_request_table_sub." ON ";
	$sql .= "( care_test_findings_".$db_request_table.".batch_nr = care_test_findings_".$db_request_table_sub.".batch_nr) ";
	$sql .= "WHERE care_test_findings_".$db_request_table.".batch_nr='".$batch_nr."' ";
		
	if($ergebnis=$db->Execute($sql)){
		if($editable_rows=$ergebnis->RecordCount()){
			while ( !$ergebnis->EOF ) {
					$parsed_type[$ergebnis->fields['type_general']] = $ergebnis->fields['type_general'];
					$parsed_resist_anaerob[$ergebnis->fields['resist_anaerob']] = $ergebnis->fields['resist_anaerob'];
					$parsed_resist_aerob[$ergebnis->fields['resist_aerob']] = $ergebnis->fields['resist_aerob'];
					$parsed_findings[$ergebnis->fields['findings']] = $ergebnis->fields['findings'];
					$stored_findings=$ergebnis->GetRowAssoc($toUpper=false);
					$ergebnis->MoveNext();
			}

			if($stored_findings['status']=='done') $edit_findings=0; /* Inhibit editing of the findings */

			$mode='update';
			$edit_form=1;
		}
	}
}else{
	$mode='';
	$pn='';
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
 $smarty->assign('pbHelp',"javascript:gethelp('pending_baclabor.php')");

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
.lab {font-family:ms ui gothic; font-size: 9; color:#ee6666;}
.lmargin {margin-left: 5;}
</style>

<script language="javascript">
<!-- 

<?php
if($edit)
{
?>

function chkForm(d)
{ 
   return true 
}

function loadM(fn)
{
	mBlank=new Image();
	mBlank.src="../img/pink_border.gif";
	mFilled=new Image();
	mFilled.src="../img/filled_pink_block.gif";
	
	form_name=fn;
}

function setM(m)
{
    eval("marker=document.images."+m);
	eval("element=document."+form_name+"."+m);
	
    if(marker.src!=mFilled.src)
	{
	   marker.src=mFilled.src;
	   element.value='1';
	  // alert(element.name+element.value);
	}
	 else 
	 {
	    marker.src=mBlank.src;
		element.value='0';
	  // alert(element.name+element.value);
	 }
}


function setThis(prep,elem,begin,end,step)
{
  for(i=begin;i<end;i=i+step)
  {
     x=prep + i;
     if(elem!=i)
     {
       eval("marker=document.images."+x);
	   if(marker.src==mFilled.src)  setM(x);
     }
  }
  setM(prep+elem);
}

function sendLater()
{
   document.form_test_request.status.value="draft";
   if(chkForm(document.form_test_request)) document.form_test_request.submit(); 
}

<?php
}
?>

function printOut()
{
	urlholder="labor_test_findings_printpop.php?sid=<?php echo $sid ?>&lang=<?php echo $lang ?>&user_origin=<?php echo $user_origin ?>&subtarget=baclabor&batch_nr=<?php echo $batch_nr ?>&pn=<?php echo $pn ?>";
	testprintout<?php echo $sid ?>=window.open(urlholder,"testprintout<?php echo $sid ?>","width=800,height=600,menubar=no,resizable=yes,scrollbars=yes");
    //testprintout<?php echo $sid ?>.print();
}


<?php require($root_path.'include/inc_checkdate_lang.php'); ?>
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

<!-- Table for the list index and the form -->

<table border=0>
	<tr valign="top">
		<!--  Left frame containing the list of requests -->
		<td>

<?php
/* The following routine creates the list of pending requests */
require($root_path.'include/inc_test_request_lister_fx.php');

?>
		</td>

		<!--  Right frame containing the form -->
		
		<td>
        
		<!--<form name="form_test_request" method="post" action="<?php echo $thisfile ?>" onSubmit="return chkForm(this)">  -->

		<!--<input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0','absmiddle') ?> title="<?php // echo $LDSaveEntry ?>">-->
		<a href="javascript:printOut()"><img <?php echo createLDImgSrc($root_path,'printout.gif','0','absmiddle') ?> alt="<?php echo $LDPrintOut ?>"></a>
        <a href="<?php echo 'labor_test_findings_'.$subtarget.'.php?sid='.$sid.'&lang='.$lang.'&batch_nr='.$batch_nr.'&pn='.$pn.'&entry_date='.$stored_request['entry_date'].'&target='.$target.'&subtarget='.$subtarget.'&user_origin='.$user_origin.'&tracker='.$tracker; ?>"><img <?php echo createLDImgSrc($root_path,'enter_result.gif','0','absmiddle') ?> alt="<?php echo $LDEnterResult ?>"></a>

<?php

require($root_path.'include/inc_test_findings_form_baclabor.php');

?>
		<!--</form>-->
		</td>
	</tr>
</table>

<?php
}
else
{
?>
<img <?php echo createMascot($root_path,'mascot1_r.gif','0','absmiddle') ?>><font size=3 face="verdana,arial" color="#990000"><b><?php echo $LDNoPendingRequest ?></b></font>
<p>
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'back2.gif','0') ?>></a>
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
