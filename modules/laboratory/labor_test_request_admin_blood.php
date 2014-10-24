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
$lang_tables=array('departments.php');
define('LANG_FILE','konsil.php');

/* We need to differentiate from where the user is coming: 
*  $user_origin != lab ;  from patient charts folder
*  $user_origin == lab ;  from the laboratory
*  and set the user cookie name and break or return filename
*/
if($user_origin=='lab')
{
  $local_user='ck_lab_user';
  $breakfile=$root_path."modules/laboratory/labor.php".URL_APPEND;
}elseif($user_origin=='amb'){
	$local_user='ck_lab_user';
	$breakfile=$root_path.'modules/ambulatory/ambulatory.php'.URL_APPEND;
}else{
  $local_user='ck_pflege_user';
  $breakfile=$root_path."modules/nursing/nursing-station-patientdaten.php".URL_APPEND."&edit=$edit&station=$station&pn=$pn";
}

require_once($root_path.'include/core/inc_front_chain_lang.php'); ///* invoke the script lock*/
require_once ('includes/inc_diagnostics_report_fx.php');

$thisfile=basename(__FILE__);

$bgc1='#99ffcc'; /* The main background color of the form */
$edit_form=0; /* Set form to non-editable*/
$read_form=1; /* Set form to read */
$edit=0; /* Set script mode to no edit*/

$formtitle=$LDBloodBank;
$dept_nr=43; // 43 = department nr. of blood bank

$db_request_table='blood';
$target='blood';
///$db->debug=1;

require_once($root_path.'include/care_api_classes/class_encounter.php');
$enc_obj=new Encounter;

/* Here begins the real work */
 
/* Load date formatter */
    include_once($root_path.'include/core/inc_date_format_functions.php');
    
	
	/* Load editor functions */
	   
	 if(!isset($mode))   $mode='';
		
		  switch($mode)
		  {
		     case 'update':
							      $sql="UPDATE care_test_request_blood SET 
                                   status = 'received', blood_pb = '".htmlspecialchars($blood_pb)."', blood_rb = '".htmlspecialchars($blood_rb)."', blood_llrb = '".htmlspecialchars($blood_llrb)."', 
								   blood_wrb = '".htmlspecialchars($blood_wrb)."',blood_prp = '".htmlspecialchars($blood_prp)."', blood_tc = '".htmlspecialchars($blood_tc)."', 
								   blood_ffp = '".htmlspecialchars($blood_ffp)."', b_group_count = '".$b_group_count."', 
								   b_group_price = '".$b_group_price."', a_subgroup_count = '".$a_subgroup_count."', a_subgroup_price = '".$a_subgroup_price."', 
								   extra_factors_count = '".$extra_factors_count."', extra_factors_price = '".$extra_factors_price."', coombs_count = '".$coombs_count."', 
								   coombs_price = '".$coombs_price."', ab_test_count = '".$ab_test_count."', ab_test_price = '".$ab_test_price."', 
								   crosstest_count = '".$crosstest_count."', crosstest_price = '".$crosstest_price."', ab_diff_count = '".$ab_diff_count."', 
								   ab_diff_price = '".$ab_diff_price."', x_test_1_code = '".$x_test_1_code."', x_test_1_name = '".htmlspecialchars($x_test_1_name)."', 
								   x_test_1_count = '".$x_test_1_count."', x_test_1_price = '".$x_test_1_price."', x_test_2_code = '".$x_test_2_code."', 
								   x_test_2_name = '".htmlspecialchars($x_test_2_name)."', x_test_2_count = '".$x_test_2_count."', x_test_2_price = '".$x_test_2_price."', 
								   x_test_3_code = '".$x_test_3_code."', x_test_3_name = '".htmlspecialchars($x_test_3_name)."', x_test_3_count = '".$x_test_3_count."', 
								   x_test_3_price = '".$x_test_3_price."', lab_stamp = '".$lab_stamp."', release_via = '".htmlspecialchars($release_via)."', 
								   receipt_ack = '".htmlspecialchars($receipt_ack)."', mainlog_nr = '".htmlspecialchars($mainlog_nr)."', lab_nr = '".htmlspecialchars($lab_nr)."'";
							
							$lab_date=formatDate2STD($lab_date,$date_format);
							if(!empty($lab_date)){
								$sql.=", lab_date = '".$lab_date."'";
							}
							$mainlog_date=formatDate2STD($mainlog_date,$date_format);
							if(!empty($mainlog_date)){
								$sql.=", mainlog_date = '".$mainlog_date."'";
							}
								   $sql.= ",  mainlog_sign = '".htmlspecialchars($mainlog_sign)."', lab_sign = '".htmlspecialchars($lab_sign)."',
								   history = ".$enc_obj->ConcatHistory("Ack: ".date('Y-m-d H:i:s')." = ".$_SESSION['sess_user_name']."\n").",
								   modify_id = '".$_SESSION['sess_user_name']."',
									modify_time='".date('YmdHis')."'
								  WHERE batch_nr = '".$batch_nr."'";
								  
							      if($ergebnis=$enc_obj->Transact($sql)){
									//echo $sql;
								     signalNewDiagnosticsReportEvent('','labor_test_request_printpop.php');
									 header("location:".$thisfile."?sid=$sid&lang=$lang&edit=$edit&saved=update&pn=$pn&station=$station&user_origin=$user_origin&status=$status&target=$target&subtarget=$subtarget&batch_nr=$batch_nr&noresize=$noresize");
									 exit;
								  }else{
								      echo "<p>$sql<p>$LDDbNoSave"; 
								      $mode="";
								   }
								break; // end of case 'save'
								
		     					case 'done':
							      $sql="UPDATE care_test_request_blood SET 
								  status = 'done',
								  history = ".$enc_obj->ConcatHistory("Done ".date('Y-m-d H:i:s')." = ".$_SESSION['sess_user_name']."\n").",
								   modify_id = '".$_SESSION['sess_user_name']."',
									modify_time='".date('YmdHis')."'
								  WHERE batch_nr = '".$batch_nr."'";
								  
							      if($ergebnis=$enc_obj->Transact($sql)){
									//echo $sql;
								  	// Load the visual signalling functions
									include_once($root_path.'include/core/inc_visual_signalling_fx.php');
									// Set the visual signal 
									setEventSignalColor($pn,SIGNAL_COLOR_BLOOD_REQUEST);
									//echo "blood";									
									 header("location:".$thisfile."?sid=$sid&lang=$lang&edit=$edit&saved=update&pn=$pn&station=$station&user_origin=$user_origin&status=$status&target=$target&subtarget=$subtarget&noresize=$noresize");
									 exit;
								  }else{
								      echo "<p>$sql<p>$LDDbNoSave"; 
								      $mode='';
								   }
								break; // end of case 'save'		  
		  }// end of switch($mode)
  
          if(!$mode) /* Get the pending test requests */
		  {
		                $sql="SELECT batch_nr,encounter_nr,send_date,dept_nr FROM care_test_request_blood 
						         WHERE status='pending' OR status='received' ORDER BY  send_date DESC";
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

			if( $enc_obj->is_loaded){

	            $sql="SELECT * FROM care_test_request_blood WHERE batch_nr='".$batch_nr."'";
					
	            if($ergebnis=$db->Execute($sql)){
					if($editable_rows=$ergebnis->RecordCount()){
						$stored_request=$ergebnis->FetchRow();
						$edit_form=1;
					}
				}else{
					echo "<p>$sql<p>$LDDbNoRead"; 
				}					
			}
		}else{
			$mode='';
			$pn='';
		}
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
 $smarty->assign('pbHelp',"javascript:gethelp('pending_blood.php')");

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
   return true
}

function printOut(){
	urlholder="labor_test_request_printpop.php?sid=<?php echo $sid ?>&lang=<?php echo $lang ?>&user_origin=<?php echo $user_origin ?>&target=<?php echo $target ?>&subtarget=<?php echo $subtarget ?>&batch_nr=<?php echo $batch_nr ?>&pn=<?php echo $pn ?>";
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

# If pending request available, show list and actual form

if($batchrows){

?>

<table border=0>
  <tr valign="top">
  
<!-- left frame for the request list -->
    <td>
<?php 

/* The following routine creates the list of pending requests */
require('includes/inc_test_request_lister_fx.php');

?></td>

<!-- right frame for the form  -->
    <td>
	
<form name="form_test_request" method="post" action="<?php echo $thisfile ?>" onSubmit="return chkForm(this)">
<a href="javascript:document.form_test_request.submit()"><img <?php echo createLDImgSrc($root_path,'savedisc.gif','0') ?> alt="<?php echo $LDSaveEntry ?>"></a>
<a href="javascript:printOut()"><img <?php echo createLDImgSrc($root_path,'printout.gif','0') ?> alt="<?php echo $LDPrintOut ?>"></a>
<?php
if ($stored_request['release_via']!='' && $stored_request['mainlog_sign']!='' && $stored_request['status']!='done')
{
?>
<a href="<?php echo $thisfile."?sid=".$sid."&lang=".$lang."&edit=".$edit."&mode=done&target=".$target."&subtarget=".$subtarget."&batch_nr=".$batch_nr."&pn=".$pn."&user_origin=".$user_origin."&noresize=".$noresize; ?>"><img <?php echo createLDImgSrc($root_path,'done.gif','0') ?> alt="<?php echo $LDDone ?>"></a>
<?php
}
?>
		<table   cellpadding=0 cellspacing=0 border=0 width=745>
		
	<!-- First row -->	
        <tr bgcolor="<?php echo $bgc1 ?>" valign="top">
		<!-- <td rowspan=3><img src="../img/de/de_blood_wardfill.gif" border=0 width=27 height=492 align="absmiddle"></td> -->
        <td rowspan=3><img src="<?php echo $root_path; ?>main/imgcreator/blood_lab_leftbar.php?sid=<?php echo $sid ?>&lang=<?php echo $lang ?>" border=0 width=27 height=492 align="absmiddle"></td>
		<td width=50% bgcolor="<?php echo $bgc1 ?>"  class=fva2_ml10><div   class=fva2_ml10><?php echo $LDToBloodBank."</b></font><br>".$LDTelephone ?><br>
<?php
	  echo '<font size=1 color="#000099" face="verdana,arial">'.$batch_nr.'</font>&nbsp;<br>';
          echo "<img src='".$root_path."classes/barcode/image.php?code=$batch_nr&style=68&type=I25&width=145&height=40&xres=2&font=5' border=0>";
?>
      </td>
		<td class=fva2_ml10><div   class=fva2_ml10><font size=3 color="#0000ff"><b><?php echo $LDRequestOf.$formtitle ?></b></font>
		<br>
		<?php 
		 
		 echo $LDWithMatchTest." ".$LDByBloodBank;
		 echo '<br>'.$LDYes.'&nbsp;';
		 
         printRadioButton('match_sample',1);
		 
		 echo '&nbsp;'.$LDNo.'&nbsp;';
		
         printRadioButton('match_sample',0);
		
        ?>
	  </td>
    </tr>
  
		
		<tr  valign="top" bgcolor="<?php echo $bgc1 ?>" >
        <td valign="bottom" align="right">
		
		<!-- Block for bloodgroup, Rh-factor, Kell  -->
		<table border=0 cellspacing=0 cellpadding=2 bgcolor="#000000" width=100%>
        <tr>
          <td>
		     <table border=0 bgcolor="<?php echo $bgc1 ?>" cellpadding=4 width=100%>
             <tr  class=fva2_ml10>
              <td><?php echo $LDBloodGroup ?><br>
			  <font  size=2 color="#ff0000"><b><?php  if($stored_request['blood_group']) echo $stored_request['blood_group']; ?></b></font></td>
			   <td><?php echo $LDRhFactor ?><br>
			   <font  size=2 color="#ff0000"><b><?php  if($stored_request['rh_factor']) echo $stored_request['rh_factor']; ?></b></font></td>
			   <td><?php echo $LDKell ?><br>
			   <font  size=2 color="#ff0000"><b><?php  if($stored_request['kell']) echo $stored_request['kell']; ?></b></font></td>
              </tr>
              <tr class=fva0_ml10>
              <td colspan=3><?php echo $LDDateProtNumber ?><br>
			  <font  size=2 color="#0000ff"><?php  if($stored_request['date_protoc_nr']) echo $stored_request['date_protoc_nr']; ?></font></td>
            </tr>
            </table>
	      </td>
        </tr>
        </table>
  
		
		</td>
         <td  bgcolor="<?php echo $bgc1 ?>" valign="top"><div class=fva2b_ml10>
<?php

if($edit  || $read_form){
	echo '<img src="'.$root_path.'main/imgcreator/barcode_label_single_large.php?sid='.$sid.'&lang='.$lang.'&fen='.$full_en.'&en='.$pn.'" width=282 height=178>';
}

		?>
    </div></td>
	</tr>
	
	<!-- Second row -->
		<tr  valign="top" bgcolor="<?php echo $bgc1 ?>" >
        <td>
		
		<!-- Block Specimen  -->
		<table border=0 cellspacing=0 cellpadding=1 bgcolor="#000000" width=100% height=100%>
        <tr>
          <td>
		     <table border=0 cellpadding=1 cellspacing=1 width=100% height=100%>
             <tr  class=fva2_ml10 bgcolor="<?php echo $bgc1 ?>" >
              <td><b>&nbsp;<?php echo $LDBloodSpecimen ?></b></td>
			   <td><?php echo $LDCount ?></td>
              </tr>
             <tr  class=fva2_ml10 bgcolor="<?php echo $bgc1 ?>" >
              <td>&nbsp;<?php echo $LDPureBlood ?></td>
			   <td><font  size=2 color="#0000ff"><?php  if($stored_request['pure_blood']) echo $stored_request['pure_blood']; ?></td>
              </tr>
             <tr  class=fva2_ml10 bgcolor="<?php echo $bgc1 ?>" >
              <td>&nbsp;<?php echo $LDRedBloodCon ?></td>
			   <td><font  size=2 color="#0000ff"><?php  if($stored_request['red_blood']) echo $stored_request['red_blood']; ?></font></td>
              </tr>
             <tr  class=fva2_ml10 bgcolor="<?php echo $bgc1 ?>" >
              <td>&nbsp;<?php echo $LDLeukoLessRedBlood ?></td>
			   <td><font  size=2 color="#0000ff"><?php  if($stored_request['leukoless_blood']) echo $stored_request['leukoless_blood']; ?></font></td>
              </tr>
             <tr  class=fva2_ml10 bgcolor="<?php echo $bgc1 ?>" >
              <td>&nbsp;<?php echo $LDWashedRedBlood ?></td>
			   <td><font  size=2 color="#0000ff"><?php  if($stored_request['washed_blood']) echo $stored_request['washed_blood']; ?></font></td>
             <tr  class=fva2_ml10 bgcolor="<?php echo $bgc1 ?>" >
              <td>&nbsp;<?php echo $LDPRP ?></td>
			   <td><font  size=2 color="#0000ff"><?php  if($stored_request['prp_blood']) echo $stored_request['prp_blood']; ?></font></td>
              </tr>
             <tr  class=fva2_ml10 bgcolor="<?php echo $bgc1 ?>" >
              <td>&nbsp;<?php echo $LDThromboCon ?></td>
			   <td><font  size=2 color="#0000ff"><?php  if($stored_request['thrombo_con']) echo $stored_request['thrombo_con']; ?></font></td>
              </tr>
             <tr  class=fva2_ml10 bgcolor="<?php echo $bgc1 ?>" >
              <td>&nbsp;<?php echo $LDFFP ?></td>
			   <td ><font  size=2 color="#0000ff"><?php  if($stored_request['ffp_plasma']) echo $stored_request['ffp_plasma']; ?></font></td>
              </tr>
             <tr bgcolor="<?php echo $bgc1 ?>" >
              <td colspan=2  class=fva2_ml10 >&nbsp;</td>
              </tr>
             <tr  class=fva2_ml10 bgcolor="<?php echo $bgc1 ?>" >
              <td>&nbsp;<?php echo $LDTransfusionDevice ?></td>
			   <td><font  size=2 color="#0000ff"><?php  if($stored_request['transfusion_dev']) echo $stored_request['transfusion_dev']; ?></font></td>
              </tr>
            </table>
	      </td>
        </tr>
        </table>
  
		
		</td>
         <td  bgcolor="<?php echo $bgc1 ?>" >
		 
		 <!--  Block for diagnosis, doctors, -->
		 <table border=0 cellspacing cellpadding=0>
     <tr>
       <td colspan=2 bgcolor="#000000"><img src="../../gui/img/common/default/pixel.gif" border=0 width=1 height=2 align="absmiddle"></td>
     </tr>
     <tr>
       <td><div class=fva2b_ml10><font size=1><?php echo $LDTransfusionDate ?></font></div></td>
       <td><font face="arial" size=2 color="#0000ff"><?php  if($stored_request['transfusion_date'] && $stored_request['transfusion_date']!=DBF_NODATE) echo formatDate2Local($stored_request['transfusion_date'],$date_format); ?></font></td>
     </tr>
     <tr>
       <td colspan=2><div class=fva2b_ml10><b><?php echo $LDDiagnosis ?></b><br><img src="../../gui/img/common/default/pixel.gif" border=0 width=10 height=30 align="left">
	   <font face="arial" size=2 color="#0000ff"><?php  if($stored_request['diagnosis']) echo stripslashes($stored_request['diagnosis']); ?></font></div></td>
     </tr>
     <tr>
       <td colspan=2> <div class=fva2b_ml10><font size=1><?php echo $LDNotesRequests ?></font><br><img src="../../gui/img/common/default/pixel.gif" border=0 width=10 height=30 align="left">
	   <font face="arial" size=2 color="#0000ff"><?php  if($stored_request['notes']) echo stripslashes($stored_request['notes']); ?></font></div></td>
       <td></td>
     </tr>
     <tr>
       <td align="right"><div class=fva2b_ml10><font size=1><?php echo $LDDate ?>:&nbsp;</font></div></td>
       <td><font face="arial" size=2 color="#0000ff"><?php   echo formatDate2Local($stored_request['send_date'],$date_format);  ?></font></td>
     </tr>
     <tr>
       <td align="right"><div class=fva2b_ml10><font size=1><?php echo $LDDoctor ?>:&nbsp;</font></div></td>
       <td><font face="arial" size=2 color="#0000ff"><?php  if($stored_request['doctor']) echo $stored_request['doctor']; ?></font></td>
     </tr>
     <tr>
       <td align="right"><div class=fva2b_ml10><font size=1><?php echo $LDTelephone ?>:&nbsp;</font></div></td>
       <td><font face="arial" size=2 color="#0000ff"><?php  if($stored_request['phone_nr']) echo $stored_request['phone_nr']; ?></font></td>
     </tr>
     <tr>
       <td colspan=2><div class=fva2b_ml10><font size=1 face="arial"><?php echo $LDDoctorNotice ?></font></div></td>
     </tr>
   </table>
    </td>
	</tr>
	
	<tr>
        <td bgcolor="#000000" colspan=3><img src="../gui/img/common/default/pixel_blk.gif" border=0 width=745 height=3 align="absmiddle"><br>
    </td>
	</tr>

	<tr bgcolor="<?php echo $bgc1 ?>">
        <td bgcolor="#000000" valign="top" colspan=3>
	
	<!--  Table container for the lower part of the form  -->
	
	      <table border=0 cellspacing=1 width=100% height=100% align="left" cellpadding=0>
         <tr bgcolor="<?php echo $bgc1 ?>">
        <td  bgcolor="<?php echo $bgc1 ?>" rowspan=20 width=27>
		<img src="<?php echo $root_path; ?>main/imgcreator/blood_lab_leftbar.php?sid=<?php echo $sid ?>&lang=<?php echo $lang ?>&form_bottom=1" border=0 width=27 height=492><br></td>
           <td width=100 align="center"><font size=2 face="arial"><?php echo $LDPB ?><br><?php echo $LD350 ?></font></td>
           <td  colspan=7>&nbsp;<input type="text" name="blood_pb" size=90 maxlength=90 <?php  if($stored_request['blood_pb']) echo 'value="'.$stored_request['blood_pb'].'"'; ?>></td>
         </tr>
         <tr bgcolor="<?php echo $bgc1 ?>">
           <td width=100 align="center"><font size=2 face="arial"><?php echo $LDRB ?></font></td>
           <td  colspan=7>&nbsp;<input type="text" name="blood_rb" size=90 maxlength=90 <?php  if($stored_request['blood_rb']) echo 'value="'.$stored_request['blood_rb'].'"'; ?>></td>
         </tr>
         <tr bgcolor="<?php echo $bgc1 ?>">
           <td width=100 align="center"><font size=2 face="arial"><?php echo $LDLLRB ?></font></td>
           <td  colspan=7>&nbsp;<input type="text" name="blood_llrb" size=90 maxlength=90 <?php  if($stored_request['blood_llrb']) echo 'value="'.$stored_request['blood_llrb'].'"'; ?>></td>
        </tr>
         <tr bgcolor="<?php echo $bgc1 ?>">
           <td width=100 align="center"><font size=2 face="arial"><?php echo $LDWRB ?></font></td>
           <td  colspan=7>&nbsp;<input type="text" name="blood_wrb" size=90 maxlength=90 <?php  if($stored_request['blood_wrb']) echo 'value="'.$stored_request['blood_wrb'].'"'; ?>></td>
         </tr>
         <tr bgcolor="<?php echo $bgc1 ?>">
           <td width=100 align="center"><font size=2 face="arial"><?php echo $LDPRP_Initial ?></font></td>
           <td  colspan=7>&nbsp;<input type="text" name="blood_prp" size=90 maxlength=90 <?php  if($stored_request['blood_prp']) echo 'value="'.$stored_request['blood_prp'].'"'; ?>></td>
         </tr>
         <tr bgcolor="<?php echo $bgc1 ?>">
           <td width=100 align="center"><font size=2 face="arial"><?php echo $LDTC ?></font></td>
           <td  colspan=7>&nbsp;<input type="text" name="blood_tc" size=90 maxlength=90 <?php  if($stored_request['blood_tc']) echo 'value="'.$stored_request['blood_tc'].'"'; ?>></td>
         </tr>
         <tr bgcolor="<?php echo $bgc1 ?>">
           <td width=100 align="center"><font size=2 face="arial"><?php echo $LDFFP_Initial ?></font></td>
           <td  colspan=7>&nbsp;<input type="text" name="blood_ffp" size=90 maxlength=90 <?php  if($stored_request['blood_ffp']) echo 'value="'.$stored_request['blood_ffp'].'"'; ?>></td>
         </tr>
         <tr bgcolor="<?php echo $bgc1 ?>" valign="top">
           <td colspan=4>&nbsp;<font size=2 face="verdana,arial"><b><?php echo $LDLabServices ?></b></font></td>
           <td colspan=4 rowspan=4 width=50%>&nbsp;<font size=1 face="arial"><?php echo $LDLabTimeStamp ?></font><br>
		   &nbsp;<font size=2 face="verdana,arial"><?php 
		   if($stored_request['lab_stamp'] && $stored_request['lab_stamp']!=DBF_NODATETIME) echo formatDate2Local($stored_request['lab_stamp'],$date_format).' '.convertTimeToLocal(formatDate2Local($stored_request['lab_stamp'],$date_format,0,1));
		     else echo formatDate2Local(date('Y-m-d H:i:s'),$date_format).' '.convertTimeToLocal(formatDate2Local(date('Y-m-d H:i:s'),$date_format,0,1)); 
			 ?></font>

			 <input type="hidden" name="lab_stamp" value="<?php 
		   if($stored_request['lab_stamp'] && $stored_request['lab_stamp']!=DBF_NODATETIME) echo $stored_request['lab_stamp'];
		     else echo date('Y-m-d H:i:s'); 
			 ?>">
    
		   </td>

         </tr>
         <tr bgcolor="<?php echo $bgc1 ?>">
           <td>&nbsp;<font size=1 face="arial"><nobr><?php echo $LDServiceCode ?></nobr></font></td>
           <td width=30%>&nbsp;</td>
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDCount ?></font></td>
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDPrice ?></font></td>

         </tr>
         <tr bgcolor="<?php echo $bgc1 ?>" >
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDBloodGroupCode ?></td>
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDBloodGroup ?></td>
           <td><input type="text" name="b_group_count" size=5 maxlength=5 <?php  if($stored_request['b_group_count']) echo 'value="'.$stored_request['b_group_count'].'"'; ?>></td>
           <td><input type="text" name="b_group_price" size=7 maxlength=7 <?php  echo 'value="'.$stored_request['b_group_price'].'"'; ?>></td>

         </tr>
         <tr bgcolor="<?php echo $bgc1 ?>">
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDA_SubgroupCode ?></td>
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDA_Subgroup ?></td>
           <td><input type="text" name="a_subgroup_count" size=5 maxlength=5 <?php  if($stored_request['a_subgroup_count']) echo 'value="'.$stored_request['a_subgroup_count'].'"'; ?>></td>
           <td><input type="text" name="a_subgroup_price" size=7 maxlength=7 <?php  echo 'value="'.$stored_request['a_subgroup_price'].'"'; ?>></td>
         </tr>
         <tr bgcolor="<?php echo $bgc1 ?>" valign="top">
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDExtraBGFactorsCode ?></td>
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDExtraBGFactors ?></td>
           <td><input type="text" name="extra_factors_count" size=5 maxlength=5 <?php  if($stored_request['extra_factors_count']) echo 'value="'.$stored_request['extra_factors_count'].'"'; ?>></td>
           <td><input type="text" name="extra_factors_price" size=7 maxlength=7 <?php  echo 'value="'.$stored_request['extra_factors_price'].'"'; ?>></td>
           <td colspan=2 rowspan=4>&nbsp;<font size=1 face="arial"><?php echo $LDReleaseVia ?><br>
		   &nbsp;<input type="text" name="release_via" size=17 maxlength=20 <?php  if($stored_request['release_via']) echo 'value="'.$stored_request['release_via'].'"'; ?>></td>
           <td colspan=2 rowspan=4>&nbsp;<font size=1 face="arial"><?php echo $LDReceiptAck ?><br>
		   &nbsp;<input type="text" name="receipt_ack" size=17 maxlength=20 <?php  if($stored_request['receipt_ack']) echo 'value="'.$stored_request['receipt_ack'].'"'; ?>></td>
         </tr>
         <tr bgcolor="<?php echo $bgc1 ?>">
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDCoombsTestCode ?></td>
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDCoombsTest ?></td>
           <td><input type="text" name="coombs_count" size=5 maxlength=5 <?php  if($stored_request['coombs_count']) echo 'value="'.$stored_request['coombs_count'].'"'; ?>></td>
           <td><input type="text" name="coombs_price" size=7 maxlength=7 <?php  echo 'value="'.$stored_request['coombs_price'].'"'; ?>></td>
         </tr>
         <tr bgcolor="<?php echo $bgc1 ?>">
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDAntibodyTestCode ?></td>
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDAntibodyTest ?></td>
           <td><input type="text" name="ab_test_count" size=5 maxlength=5 <?php  if($stored_request['ab_test_count']) echo 'value="'.$stored_request['ab_test_count'].'"'; ?>></td>
           <td><input type="text" name="ab_test_price" size=7 maxlength=7 <?php  echo 'value="'.$stored_request['ab_test_price'].'"'; ?>></td>
         </tr>
         <tr bgcolor="<?php echo $bgc1 ?>">
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDCrossTestCode ?></td>
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDCrossTest ?></td>
           <td><input type="text" name="crosstest_count" size=5 maxlength=5 <?php  if($stored_request['crosstest_count']) echo 'value="'.$stored_request['crosstest_count'].'"'; ?>></td>
           <td><input type="text" name="crosstest_price" size=7 maxlength=7 <?php  echo 'value="'.$stored_request['crosstest_price'].'"'; ?>></td>
         </tr>
         <tr bgcolor="<?php echo $bgc1 ?>">
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDAntibodyDiffCode ?></td>
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDAntibodyDiff ?></td>
           <td><input type="text" name="ab_diff_count" size=5 maxlength=5 <?php  if($stored_request['ab_diff_count']) echo 'value="'.$stored_request['ab_diff_count'].'"'; ?>></td>
           <td><input type="text" name="ab_diff_price" size=7 maxlength=7 <?php echo 'value="'.$stored_request['ab_diff_price'].'"'; ?>></td>
           <td colspan=2>&nbsp;<font size=1 face="arial"><?php echo $LDSignature ?></td>
           <td colspan=2>&nbsp;<font size=1 face="arial"><?php echo $LDSignature ?></td>
         </tr>
         <tr bgcolor="<?php echo $bgc1 ?>">
           <td><input type="text" name="x_test_1_code" size=4 maxlength=4 <?php  if($stored_request['x_test_1_code']) echo 'value="'.$stored_request['x_test_1_code'].'"'; ?>></td>
           <td><input type="text" name="x_test_1_name" size=20 maxlength=25 <?php  if($stored_request['x_test_1_name']) echo 'value="'.$stored_request['x_test_1_name'].'"'; ?>></td>
           <td><input type="text" name="x_test_1_count" size=5 maxlength=5 <?php  if($stored_request['x_test_1_count']) echo 'value="'.$stored_request['x_test_1_count'].'"'; ?>></td>
           <td><input type="text" name="x_test_1_price" size=7 maxlength=7 <?php  echo 'value="'.$stored_request['x_test_1_price'].'"'; ?>></td>
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDLabLogBook ?></td>
           <td><input type="text" name="mainlog_nr" size=8 maxlength=8 <?php  if($stored_request['mainlog_nr']) echo 'value="'.$stored_request['mainlog_nr'].'"'; ?>></td>
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDLabNumber ?></td>
           <td><input type="text" name="lab_nr" size=8 maxlength=8 <?php  if($stored_request['lab_nr']) echo 'value="'.$stored_request['lab_nr'].'"'; ?>></td>
         </tr>
         <tr bgcolor="<?php echo $bgc1 ?>">
           <td><input type="text" name="x_test_2_code" size=4 maxlength=4 <?php  if($stored_request['x_test_2_code']) echo 'value="'.$stored_request['x_test_2_code'].'"'; ?>></td>
           <td><input type="text" name="x_test_2_name" size=20 maxlength=25 <?php  if($stored_request['x_test_2_name']) echo 'value="'.$stored_request['x_test_2_name'].'"'; ?>></td>
           <td><input type="text" name="x_test_2_count" size=5 maxlength=5 <?php  if($stored_request['x_test_2_count']) echo 'value="'.$stored_request['x_test_2_count'].'"'; ?>></td>
           <td><input type="text" name="x_test_2_price" size=7 maxlength=7 <?php  echo 'value="'.$stored_request['x_test_2_price'].'"'; ?>></td>
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDBookedOn ?></td>
           <td>
			<?php
					//gjergji : new calendar
					require_once ('../../js/jscalendar/calendar.php');
					$calendar = new DHTML_Calendar('../../js/jscalendar/', $lang, 'calendar-system', true);
					$calendar->load_files();
					echo $calendar->show_calendar($calendar,$date_format,'mainlog_date',$stored_request['mainlog_date']);
					//end gjergji
			?>
		   </td>
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDDate ?></td>
           <td>
			<?php
					//gjergji : new calendar
					echo $calendar->show_calendar($calendar,$date_format,'lab_date',$stored_request['lab_date']); //#147
					//end gjergji
			?>
		   </td>		   
         </tr>
         <tr bgcolor="<?php echo $bgc1 ?>">
           <td><input type="text" name="x_test_3_code" size=4 maxlength=4 <?php  if($stored_request['x_test_3_code']) echo 'value="'.$stored_request['x_test_3_code'].'"'; ?>></td>
           <td><input type="text" name="x_test_3_name" size=20 maxlength=25 <?php  if($stored_request['x_test_3_name']) echo 'value="'.$stored_request['x_test_3_name'].'"'; ?>></td>
           <td><input type="text" name="x_test_3_count" size=5 maxlength=5 <?php  if($stored_request['x_test_3_count']) echo 'value="'.$stored_request['x_test_3_count'].'"'; ?>></td>
           <td><input type="text" name="x_test_3_price" size=7 maxlength=7 <?php  echo 'value="'.$stored_request['x_test_3_price'].'"'; ?>></td>
           <td colspan=2>&nbsp;<input type="text" name="mainlog_sign" size=17 maxlength=20 <?php  if($stored_request['mainlog_sign']) echo 'value="'.$stored_request['mainlog_sign'].'"'; ?>></td>
           <td colspan=2>&nbsp;<input type="text" name="lab_sign" size=17 maxlength=20 <?php  if($stored_request['lab_sign']) echo 'value="'.$stored_request['lab_sign'].'"'; ?>></td>
         </tr>
         <tr bgcolor="<?php echo $bgc1 ?>">
             <td colspan=3>&nbsp;<font size=1 face="arial"><?php echo $LDTotalAmount ?></td>
           <td><input type="text" name="total_amount" size=7 maxlength=20 <?php   
		   echo 'value="'.($stored_request['b_group_price']+$stored_request['a_subgroup_price']+$stored_request['extra_factors_price']+$stored_request['coombs_price']+$stored_request['ab_test_price']+$stored_request['crosstest_price']+$stored_request['ab_diff_price']+$stored_request['x_test_1_price']+$stored_request['x_test_2_price']+$stored_request['x_test_3_price']).'"'; ?>></td>
           <td colspan=2>&nbsp;<font size=1 face="arial"><?php echo $LDSignature ?></td>
           <td colspan=2>&nbsp;<font size=1 face="arial"><?php echo $LDSignature ?></td>
         </tr>

       </table>
       
	
		</td>
  </tr>

		</table>	
<a href="javascript:document.form_test_request.submit()"><img <?php echo createLDImgSrc($root_path,'savedisc.gif','0') ?> alt="<?php echo $LDSaveEntry ?>"></a>
<a href="javascript:printOut()"><img <?php echo createLDImgSrc($root_path,'printout.gif','0') ?> alt="<?php echo $LDPrintOut ?>"></a>
<?php
if ($stored_request['release_via']!='' && $stored_request['mainlog_sign']!='' && $stored_request['status']!='done')
{
?>
<a href="<?php echo $thisfile."?sid=".$sid."&lang=".$lang."&edit=".$edit."&mode=done&target=".$target."&subtarget=".$subtarget."&batch_nr=".$batch_nr."&pn=".$pn."&user_origin=".$user_origin."&noresize=".$noresize; ?>"><img <?php echo createLDImgSrc($root_path,'done.gif','0') ?> alt="<?php echo $LDDone ?>"></a>
<?php
}
	

require($root_path."modules/laboratory/includes/inc_test_request_hiddenvars.php");

?>	
</form>		
	
</td>
</tr>
</table>

<a name="bottom"></a>

<?php
}
else
{
?>

<img <?php echo createMascot($root_path,'mascot1_r.gif','0','absmiddle') ?>><font class="prompt"><b><?php echo $LDNoPendingRequest ?></b></font>
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
