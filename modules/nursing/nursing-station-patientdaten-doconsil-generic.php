<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System version deployment 1.1 (mysql) 2004-01-11
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* , elpidio@care2x.org
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables[]='departments.php';
define('LANG_FILE','konsil.php');

/**
*  We need to differentiate from where the user is coming: 
*  $user_origin != lab ;  from patient charts folder
*  $user_origin == lab ;  from the laboratory
*  and set the user cookie name and break or return filename
*/
if($user_origin=='lab')
{
  $local_user='ck_lab_user';
  $breakfile='labor.php'.URL_APPEND;
}
else
{
  $local_user='ck_pflege_user';
  $breakfile="nursing-station-patientdaten.php".URL_APPEND."&edit=$edit&station=$station&pn=$pn";
}

require_once($root_path.'include/core/inc_front_chain_lang.php');

$thisfile=basename(__FILE__);

$bgc1='#bbdbc4'; // <= Set the background color of the form here
$abtname=get_meta_tags($root_path."global_conf/$lang/konsil_tag_dept.pid");

$target='generic';

//$db->debug=1;

$db_request_table=$target;

$formtitle=$abtname[$konsil];
/*
*  The following are  batch nr inits for each type of test request
*   chemlabor = 10000000; 
*   patho = 20000000; 
*   baclabor = 30000000; 
*   blood = 40000000; 
*   generic = 50000000; 
*/
define('_BATCH_NR_INIT_',50000000);  // define the initial batch nr for generic forms

/* Create department object and load all medical depts */
require_once($root_path.'include/care_api_classes/class_department.php');
$dept_obj= new Department;
$medical_depts=$dept_obj->getAllActiveSort( 'name_formal' );

/* Here begins the real work */
/* Load the date format functions and get the local format */
	require_once($root_path.'include/core/inc_date_format_functions.php');
     /* Check for the patient number = $pn. If available get the patients data, otherwise set edit to 0 */
	if(isset($pn)&&$pn){		
		include_once($root_path.'include/care_api_classes/class_encounter.php');
		$enc_obj=new Encounter;
	    if( $enc_obj->loadEncounterData($pn)) {
		
/*			include_once($root_path.'include/care_api_classes/class_globalconfig.php');
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
*/			$full_en=$pn;
			$result=&$enc_obj->encounter;
		}
	   else 
	   {
	      $edit=0;
		  $mode="";
		  $pn="";
	   }		
	}
	   
	if(!isset($mode))   $mode='';
		
	switch($mode)
	{
	     case 'save':	$sql="INSERT INTO care_test_request_".$db_request_table." 
										 (
										 batch_nr, encounter_nr, testing_dept, visit, 
										 order_patient, diagnosis_quiry, send_date, 
										 send_doctor, status, 
										 history,
										 create_id,
										  create_time
										 ) 
										 VALUES 
										 (
										 '".$batch_nr."','".$pn."','".$dept_nr."','".$visit."',
										 '".$order_patient."','".addslashes($diagnosis_quiry)."','".formatDate2STD($send_date,$date_format)."',
										 '".addslashes($send_doctor)."', 'pending',
										 'Create: ".date('Y-m-d H:i:s')." = ".$_SESSION['sess_user_name']."\n',
										 '".$_SESSION['sess_user_name']."','".date('YmdHis')."'
										 )";

								if($ergebnis=$dept_obj->Transact($sql))
       							  {
								  	// Load the visual signalling functions
									include_once($root_path.'include/core/inc_visual_signalling_fx.php');
									// Set the visual signal 
									setEventSignalColor($pn,SIGNAL_COLOR_DIAGNOSTICS_REQUEST);
									//echo $sql;
									 header("location:".$root_path."modules/laboratory/labor_test_request_aftersave.php?sid=".$sid."&lang=".$lang."&edit=".$edit."&saved=insert&pn=".$pn."&station=".$station."&user_origin=".$user_origin."&status=".$status."&target=".$target."&dept_nr=".$dept_nr."&noresize=".$noresize."&batch_nr=".$batch_nr);
									 exit;
								  }
								  else 
								  {
								     echo "<p>$sql<p>$LDDbNoSave"; 
									 $mode="";
								  }
								
								break; // end of case 'save'
								
			case 'update':
			 
							      $sql="UPDATE care_test_request_".$db_request_table." SET 
											testing_dept = '".$dept_nr."', 
											visit = '".$visit."', 
											order_patient = '".$order_patient."', 
											diagnosis_quiry = '".$diagnosis_quiry."', 
											send_date = '".formatDate2STD($send_date,$date_format)."', 
											send_doctor = '".$send_doctor."', 
											status = '".$status."', 
										    history=".$dept_obj->ConcatHistory("Update: ".date('Y-m-d H:i:s')." = ".$_SESSION['sess_user_name']."\n").",
										    modify_id = '".$_SESSION['sess_user_name']."',
											modify_time='".date('YmdHis')."'
											WHERE batch_nr = '".$batch_nr."' ";						 

									  							
							      if($ergebnis=$dept_obj->Transact($sql))
       							  {
								  	// Load the visual signalling functions
									include_once($root_path.'include/core/inc_visual_signalling_fx.php');
									// Set the visual signal 
									setEventSignalColor($pn,SIGNAL_COLOR_DIAGNOSTICS_REQUEST);									
									//echo $sql;
									 header("location:".$root_path."modules/laboratory/labor_test_request_aftersave.php?sid=".$sid."&lang=".$lang."&edit=".$edit."&saved=update&pn=".$pn."&station=".$station."&user_origin=".$user_origin."&status=".$status."&target=".$target."&dept_nr=".$dept_nr."&batch_nr=".$batch_nr."&noresize=".$noresize);
									 exit;
								  }
								  else
								   {
								      echo "<p>$sql<p>$LDDbNoSave"; 
								      $mode="";
								   }
								
								break; // end of case 'save'
	        /* If mode is edit, get the stored test request when its status is either "pending" or "draft"
			*  otherwise it is not editable anymore which happens when the lab has already processed the request,
			*  or when it is discarded, hidden, locked, or otherwise. 
			*/
			case 'edit':
			
		                $sql="SELECT * FROM care_test_request_".$db_request_table." WHERE batch_nr='".$batch_nr."' AND (status='pending' OR status='draft')";
		                if($ergebnis=$db->Execute($sql)){
				            if($editable_rows=$ergebnis->RecordCount()){
     					       $stored_request=$ergebnis->FetchRow();
							   $edit_form=1;
					         }
			             }
						 break; ///* End of case 'edit': */
			 default: $mode='';
						   
	}// end of switch($mode)
	
	/* Get a new batch number */
	if(!$mode){
		$sql="SELECT batch_nr FROM care_test_request_".$db_request_table." ORDER BY batch_nr DESC";
		if($ergebnis=$db->SelectLimit($sql,1)){
			if($batchrows=$ergebnis->RecordCount()){
				$bnr=$ergebnis->FetchRow();
				$batch_nr=$bnr['batch_nr'];
				if(!$batch_nr) $batch_nr=_BATCH_NR_INIT_; else $batch_nr++;
			}else{
				$batch_nr=_BATCH_NR_INIT_;
			}
		}else{
			echo "<p>$sql<p>$LDDbNoRead";
			exit;
		}
		$mode="save";   
	}

# Start the smarty templating
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme
 # param 2 = initialize gui
 # param 3 = display copyright footer
 # param 4 = load standard javascripts

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('nursing');

 if(!isset($edit) || empty($edit)) $smarty->assign('edit',FALSE);

 $smarty->assign('bgc1',$bgc1);

# Added for the common header top block

 $smarty->assign('sToolbarTitle',$LDDiagnosticTest);

 # Prepare start new form button and href
 if($user_origin=='lab' && $edit){
	$smarty->assign('pbAux1',$thisfile.URL_APPEND."&station=$station&user_origin=$user_origin&status=$status&target=$target&noresize=$noresize");
	$smarty->assign('gifAux1',createLDImgSrc($root_path,'newpat2.gif','0') );
 }

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('request_generic.php')");

 # hide return button
 $smarty->assign('pbBack',FALSE);

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',$LDDiagnosticTest);

 # Prepare Body onLoad javascript code
$sTemp = 'onLoad="if (window.focus) window.focus();';
if($pn=="") $sTemp = $sTemp .'document.searchform.searchkey.focus();';

$smarty->assign('sOnLoadJs',$sTemp .'"');

 /**
 * collect JavaScript for Smarty
 */
 ob_start();
?>

<style type="text/css">

div.fva2_ml10 {font-family: verdana,arial; font-size: 12; margin-left: 10;}
div.fa2_ml10 {font-family: arial; font-size: 12; margin-left: 10;}
div.fva2_ml3 {font-family: verdana; font-size: 12; margin-left: 3; }
div.fa2_ml3 {font-family: arial; font-size: 12; margin-left: 3; }
.fva2_ml10 {font-family: verdana,arial; font-size: 12; margin-left: 10; color:#000000;}
.fva2b_ml10 {font-family: verdana,arial; font-size: 12; margin-left: 10; color:#000000;}
.fva0_ml10 {font-family: verdana,arial; font-size: 10; margin-left: 10; color:#000000;}
</style>

<script language="javascript">
<!-- 
function chkForm(d){

   if(d.dept_nr.value=='')
	{
		alert("<?php echo $LDPlsSelectDept ?>");
		d.testing_dept.focus();
		return false;
	}
	else  if((d.diagnosis_quiry.value=='')||(d.diagnosis_quiry.value==' '))
	{
		alert("<?php echo $LDPlsEnterDiagnosisQuiry ?>");
		d.diagnosis_quiry.focus();
		return false;
	}
	else if((d.send_doctor.value=='')||(d.send_doctor.value==' '))
	{
		alert("<?php echo $LDPlsEnterDoctorName ?>");
		d.send_doctor.focus();
		return false;
	}
	else if((d.send_date.value=='')||(d.send_date.value==' '))
	{
		alert("<?php echo $LDPlsEnterDate ?>");
		d.send_date.focus();
		return false;
	}
	else return true;
}

function sendLater()
{
   document.form_test_request.status.value="draft";
   if(chkForm(document.form_test_request)) document.form_test_request.submit(); 
}

function printOut()
{
	urlholder="labor_test_request_printpop.php?sid=<?php echo $sid ?>&lang=<?php echo $lang ?>&user_origin=<?php echo $user_origin ?>&target=<?php echo $target ?>&subtarget=<?php echo $stored_request['testing_dept'] ?>&batch_nr=<?php echo $batch_nr ?>&pn=<?php echo $pn; ?>";
	testprintout<?php echo $sid ?>=window.open(urlholder,"testprintout<?php echo $sid ?>","width=800,height=600,menubar=no,resizable=yes,scrollbars=yes");
    testprintout<?php echo $sid ?>.print();
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

# Show actual form

if(!$noresize){

?>

<script>	
      window.moveTo(0,0);
	 window.resizeTo(1000,740);
</script>

<?php 
}
?>

 <ul>

<?php

if($edit){

?>
<form name="form_test_request" method="post" action="<?php echo $thisfile ?>" onSubmit="return chkForm(this)">
<?php

/* If in edit mode display the control buttons */

# Set the table width
$controls_table_width=700;

require($root_path.'modules/laboratory/includes/inc_test_request_controls.php');

}
elseif(!$read_form && !$no_proc_assist)
{

/* Else if not in edit mode and no patient nr. available, show the search prompt */

?>
<table border=0>
  <tr>
    <td><img <?php echo createMascot($root_path,'mascot1_r.gif','0','bottom') ?> align="absmiddle"></td>
    <td><font color="#000099" SIZE=3  FACE="verdana,Arial"> <b><?php echo $LDPlsSelectPatientFirst ?></b></font></td>
    <td valign="bottom"><img <?php echo createComIcon($root_path,'angle_down_r.gif','0','',TRUE); ?>></td>
  </tr>
</table>
<?php
}
?>
		<table   cellpadding=0 cellspacing=0 border="0" width=700>
		<tr  valign="top">
		<td bgcolor="<?php echo $bgc1 ?>"  class=fva2_ml10><div   class=fva2_ml10>
       <b> <?php echo $LDRequestTo ?></b> <br>
      <select name="dept_nr" size=1>
       <option value=""><?php echo $LDPlsSelectDeptShort ?></option>
<?php


			while(list($x,$v)=each($medical_depts)){
				$subDepts = $dept_obj->getAllSubDepts($v['nr']);
				echo'<option value="'.$v['nr'].'"';
				if($v['nr']==$dept_nr) echo ' selected>';
					else echo '>';
				$buffer=$v['LD_var'];
				if(isset($$buffer)&&!empty($$buffer)) echo $$buffer;
					else echo $v['name_formal'];
				echo '</option>';
			    //added subdepts
				if($subDepts) {
			    		while (list($y,$sDept) = each($subDepts)) {
            				echo'<option value="'.$sDept['nr'].'"';
            				if($sDept['nr']==$dept_nr) echo ' selected>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<sup>L</sup>&nbsp;';
            					else echo '>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<sup>L</sup>&nbsp;';
            				$buffer=$sDept['LD_var'];
            				if(isset($$buffer)&&!empty($$buffer)) echo $$buffer;
            					else echo $sDept['name_formal'];
            				echo '</option>';
			    		}
			    }					
			}

/*		 while(list($x,$v)=each($abtname))
		 {
		    echo '
			<option value="'.$x.'" ';
			
			if(($edit_form || $read_form)&&($x==$stored_request['testing_dept']))
			{
			    echo 'selected';
			}
			elseif($x==$konsil)
			{
			    echo 'selected';
			}
			
			echo '> '.$v.'</option>';
		 }*/
?>        
   </select>
<?php echo $LDDepartment ?>
   <p>
	<input type="checkbox" name="visit" value="1" <?php if(($edit_form || $read_form)&& $stored_request['visit']) echo "checked" ?>> <?php echo $LDVisitRequested ?><p>
	<input type="checkbox" name="order_patient" value="1" <?php if(($edit_form || $read_form)&& $stored_request['order_patient']) echo "checked" ?>> <?php echo $LDPatCanBeOrdered ?><p>
<?php
	  echo '<font size=1 color="#000099" face="verdana,arial">'.$batch_nr.'</font>&nbsp;<br>';
          echo "<img src='".$root_path."classes/barcode/image.php?code=$batch_nr&style=68&type=I25&width=145&height=40&xres=2&font=5' border=0>";
?>		

</td>
         <td  bgcolor="<?php echo $bgc1 ?>"  align="right"><div class=fva2b_ml10>
<?php

        if($edit){
		   echo '<img src="'.$root_path.'main/imgcreator/barcode_label_single_large.php'.URL_REDIRECT_APPEND.'&fen='.$full_en.'&en='.$pn.'" width=282 height=178>';
		}elseif($pn==''){
		    $searchmask_bgcolor='#ffffff';
            include($root_path.'modules/laboratory/includes/inc_test_request_searchmask.php');
        }
		?>
		</div></td>
	</tr>
	
	<tr bgcolor="<?php echo $bgc1 ?>">
		<td colspan=2><div class=fva2_ml10><?php echo $LDDiagnosesInquiries ?><br>
		<textarea name="diagnosis_quiry" cols=80 rows=10 wrap="physical"><?php if($edit_form || $read_form) echo stripslashes($stored_request['diagnosis_quiry']) ?></textarea>
				</td>
		</tr>	

	<tr bgcolor="<?php echo $bgc1 ?>">
		<td ><div class=fva2_ml10><font color="#000099">
		 <?php echo $LDDate . ":";
				//gjergji : new calendar
				require_once ('../../js/jscalendar/calendar.php');
				$calendar = new DHTML_Calendar('../../js/jscalendar/', $lang, 'calendar-system', true);
				$calendar->load_files();
	  			echo $calendar->show_calendar($calendar,$date_format,'send_date',$stored_request['send_date']);
				//end : gjergji  
 			?>
  </div></td>
			<td align="right"><div class=fva2_ml10><font color="#000099">
		<?php echo $LDDoctor ?>
		<input type="text" name="send_doctor" size=40 maxlength=40 value="<?php if($edit_form || $read_form) echo stripslashes($stored_request['send_doctor']) ?>">&nbsp;&nbsp;&nbsp;&nbsp;
  </div></td>
</tr>

	<tr bgcolor="<?php echo $bgc1 ?>">
		<td colspan=2><div class=fva2_ml10>&nbsp;<br><font color="#969696"><?php echo $LDDeptReport ?><br>
		<img src="../../gui/img/common/default/gray_pixel.gif" height=75 width=<?php echo $controls_table_width-25; ?>></div><br>
				</td>
		</tr>	
		</table>
<p>
<?php
if($edit){
	/* If in edit mode display the control buttons */
	include($root_path.'modules/laboratory/includes/inc_test_request_controls.php');
	include($root_path.'modules/laboratory/includes/inc_test_request_hiddenvars.php');
?>

</form>
<?php
}
?>

</ul>

<?php

$sTemp = ob_get_contents();
 ob_end_clean();

# Assign the page output to main frame template

 $smarty->assign('sMainFrameBlockData',$sTemp);

 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');

?>
