<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
//error_reporting(E_WARNING);
/**
* CARE2X Integrated Hospital Information System Deployment 2.2 - 2006-07-10
* GNU General Public License
* Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
//$db->debug=true;
/* We need to differentiate from where the user is coming: 
*  $user_origin != lab ;  from patient charts folder
*  $user_origin == lab ;  from the laboratory
*  $user_origin == amb ;  from the ambulatory clinics
*  and set the user cookie name and break or return filename
*/
switch($user_origin)
{
  case 'lab':

  $local_user='ck_lab_user';
  $breakfile=$root_path.'labor.php'.URL_APPEND;
  break;
  
  case 'amb':
  
  $local_user='ck_amb_user';
  $breakfile=$root_path.'dept.php?sid='.URL_APPEND;
  break;
  
  case 'patreg':
  
  $local_user='aufnahme_user';
  $breakfile='javascript:window.close()';
  break;

  default:
  
  $local_user='ck_pflege_user';
  $breakfile=$root_path."pflege-station-patientdaten.php".URL_APPEND."&edit=$edit&station=$station&pn=$pn";
}

/* Start initializations */
$lang_tables[] = 'departments.php';
if($subtarget=='chemlabor') define('LANG_FILE','konsil_chemlabor.php');
 else define('LANG_FILE','konsil.php');

require_once($root_path.'include/inc_front_chain_lang.php'); ///* invoke the script lock*/

 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme
 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('laboratory');


$thisfile='labor_test_request_printpop.php';

/* The main background color of the form */
if($target=='generic') {
    $bgc1='#bbdbc4';
} else {
    switch($subtarget) {
         case 'generic':
		 	$bgc1='#bbdbc4';
			break;
         case 'patho':
		 	$bgc1='#cde1ec';
			$formtitle = $LDPathology;
			break;
         case 'radio':
		 	$bgc1='#ffffff';
			$formtitle = $LDRadiology;
			break;
         case 'blood':
		 	$bgc1='#99ffcc';
			$formtitle= $LDBloodBank;
			break;
         case 'chemlabor':
         	$target_sub = 'chemlabor_sub';
		 	$bgc1='#fff3f3';
			$formtitle = $LDChemicalLaboratory;
			break;
         case 'baclabor':
         	$target_sub = 'baclabor_sub';
		 	$formtitle = $LDBacteriologicalLaboratory;
			$bgc1='#fff3f3';
            /* Load additional language table */
            if(file_exists($root_path.'language/'.$lang.'/lang_'.$lang.'_konsil_baclabor.php')) include_once($root_path.'language/'.$lang.'/lang_'.$lang.'_konsil_baclabor.php');
              else include_once($root_path.'language/'.LANG_DEFAULT.'/lang_'.LANG_DEFAULT.'_konsil_baclabor.php');
            break;
         default:  $bgc1='#ffffff';
			           break;
    }
}
//$abtname=get_meta_tags($root_path."global_conf/$lang/konsil_tag_dept.pid");
$edit_form=0; /* Set form to non-editable*/
$read_form=1; /* Set form to read */
$edit=0; /* Set script mode to no edit*/

//$formtitle=$abtname[$subtarget];
if ($target=='generic' || $target=='blood') {
    $db_request_table = $target;
	$sql_2="SELECT * FROM care_test_request_".$db_request_table." WHERE batch_nr='".$batch_nr."'";
	$formfile=$target;
} else {
    $sql_2  = "SELECT * FROM care_test_request_".$subtarget." ";
	$sql_2 .= "INNER JOIN care_test_request_".$target_sub." ON ";
	$sql_2 .= "( care_test_request_".$subtarget.".batch_nr = care_test_request_".$target_sub.".batch_nr) ";
	$sql_2 .= "WHERE care_test_request_".$target_sub.".batch_nr='".$batch_nr."'";
	//$sql_2="SELECT * FROM care_test_request_".$db_request_table." WHERE batch_nr='".$batch_nr."'";
	$formfile=$subtarget;
}

/* Check for the patietn number = $pn. If available get the patients data, */
if(isset($pn)&&$pn) {	
    include_once($root_path.'include/care_api_classes/class_encounter.php');
	$enc_obj=new Encounter;
	
	if($enc_obj->loadEncounterData($pn)){
		$edit=true;
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
		$_SESSION['sess_en']=$pn;	
		$_SESSION['sess_full_en']=$full_en;	
	}	
}

/* Here begins the real work */
/* Load date formatter */
     include_once($root_path.'include/inc_date_format_functions.php');
     
     /* Load editor functions */
     //include_once('../include/inc_editor_fx.php');
	   
	 if(!isset($mode))   $mode="";
  

				if($enc_obj->is_loaded) {
		                if($ergebnis=$db->Execute($sql_2)){
				            if($editable_rows=$ergebnis->RecordCount()){
					           while ( !$ergebnis->EOF ) {
								   if(isset($ergebnis->fields['paramater_name'])) {
	   						       		$stored_param[$ergebnis->fields['paramater_name']] = $ergebnis->fields['parameter_value'];
	                               }elseif(isset($ergebnis->fields['material'])) {
							   /* parse the material type */
	   						       		$stored_param[$ergebnis->fields['material']] = $ergebnis->fields['material'];
								   }elseif(isset($ergebnis->fields['test_type'])) {
							   /* parse the test type */
	   						       		$stored_param[$ergebnis->fields['test_type']] = $ergebnis->fields['test_type'];
								   }else{
								   		$stored_request=$ergebnis->FetchRow();
							   }
							   $read_form=1;
							   $printmode=1;
								   $ergebnis->MoveNext();
							}
			             }
			             } else {
						     echo "<p>$sql<p>$LDDbNoRead"; 
						  }					
				}

require_once($root_path.'include/care_api_classes/class_department.php');	
$dept_obj=new Department;
if($dept_obj->preloadDept($stored_request['testing_dept'])){
	$buffer=$dept_obj->LDvar();
	if(isset($$buffer)&&!empty($$buffer)) $formtitle=$$buffer;
		else $formtitle=$dept_obj->FormalName();
}		
?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE><?php echo "$LDDiagnosticTest $station" ?></TITLE>
<?php
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');

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

<?php if($target=='baclabor') 
{
?>
.lab {font-family: arial; font-size: 9; color:#ee6666;}
<?php 
}
else
{
?>
.lab {font-family: arial; font-size: 9; color:purple;}
<?php
}
?>

.lmargin {margin-left: 5;}
</style>

</HEAD> 

<BODY bgcolor="white" OnLoad="window.print();">


<?php

require_once($root_path.'include/inc_test_request_printout_fx.php');

if($show_print_button) echo '<a href="javascript:window.print()"><img '.createLDImgSrc($root_path,'printout.gif','0').'></a><p>';


/* Load the form for printing out */
if($subtarget=='chemlabor' || $subtarget=='baclabor'){

    echo '<img src="'.$root_path.'main/imgcreator/barcode_label_single_large.php?sid='.$sid.'&lang='.$lang.'&fen='.$full_en.'&en='.$pn.'&batch_nr='.$batch_nr.'&child_img=1&subtarget='.$subtarget.'" >';

} elseif($subtarget=='patho'){

	$smarty->assign('bgc1',$bgc1);
	$smarty->assign('printmode',TRUE);

	$read_form=TRUE;
	include($root_path.'include/inc_test_request_printout_'.$formfile.'.php');
	
	$smarty->display('forms/pathology.tpl');

}else{
    include($root_path.'include/inc_test_request_printout_'.$formfile.'.php');
}

?>
     	

</BODY>
</HTML>
