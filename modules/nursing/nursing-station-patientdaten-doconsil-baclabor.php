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
function prepareTestParameters($param_type){
    global $_POST;
	
	$paramlist="";
							   
	while(list($x,$v)=each($_POST))	{
		if(substr_count($x,$param_type) && ($_POST[$x]==1))		{
			if($paramlist=="") $paramlist=$x."=1";
				else $paramlist.="&".$x."=1";
		}
	}
    reset($_POST);		
	return $paramlist;
}

								
function prepareSampleDate()
{
    global $_POST;
	
								
								/* Prepare the weekday */
								for($i=0;$i<7;$i++)
								{
								   $tday="day_".$i;
								   if($_POST[$tday])
								   {
									  $sday=$i;
									  break;
									}
								}
								/* Prepare the month */
								for($i=1;$i<13;$i++)
								{
								   $tmon="month_".$i;
								   if($_POST[$tmon])
								   {
									  $smon=$i;
									  break;
									}
								}
								
								/* Finalize sampling date in DATE format */
								return date('Y')."-".$smon."-".$sday;
}

$lang_tables[] = 'departments.php';
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
}
else
{
  $local_user='ck_pflege_user';
  $breakfile=$root_path."modules/nursing/nursing-station-patientdaten.php".URL_APPEND."&edit=$edit&station=$station&pn=$pn";
}
require_once($root_path.'include/core/inc_front_chain_lang.php');

///$db->debug=1;

$thisfile=basename(__FILE__);

$bgc1='#fff3f3'; 

$db_request_table='baclabor';
$db_request_table_sub='baclabor_sub';

$formtitle=$LDBacteriologicalLaboratory;

require_once($root_path.'include/care_api_classes/class_encounter.php');
$enc_obj=new Encounter;

define('_BATCH_NR_INIT_',30000000);
/*
*  The following are  batch nr inits for each type of test request
*   chemlabor = 10000000; patho = 20000000; baclabor = 30000000; blood = 40000000; generic = 50000000;
*/
						
/* Here begins the real work */
     /* Check for the patietn number = $pn. If available get the patients data, otherwise set edit to 0 */
     if(isset($pn) && $pn) {
	    if( $enc_obj->loadEncounterData($pn)) {
			$full_en=$pn;				
			if($enc_obj->is_loaded){
				$result=&$enc_obj->encounter;
			}
			include_once($root_path.'include/care_api_classes/class_diagnostics.php');
			$bac_obj=new Diagnostics;
			$bac_obj->useBacLabRequestTable();
			$bac_obj_sub = new Diagnostics;
			$bac_obj_sub->useBacLabRequestSubTable();			
		}else{
	      $edit=0;
		  $mode="";
		  $pn="";
	   }		
     }
	   
	 if(!isset($mode))   $mode="";
		  switch($mode)
		  {
				     case 'save':
							  
							  $material_type_list = &prepareTestParameters('_mx_');  /* _mx_ = test material */
							  $test_type_list = &prepareTestParameters('_tx_');          /* _tx_ = test type */
							  
							  if($material_type_list || $test_type_list) {
									$data['batch_nr'] = $batch_nr;
									$data['encounter_nr'] = $pn;
									$data['dept_nr'] = $dept_nr;
									$data['material_note'] = htmlspecialchars($material_note);
									$data['diagnosis_note'] = htmlspecialchars($diagnosis_note);
									$data['immune_supp'] = htmlspecialchars($immune_supp);
									$data['send_date'] = date('Y-m-d');
									$data['sample_date'] = date('Y-m-d');
									$data['status'] = $status;
									$data['history'] = 'Create: '.date('Y-m-d H:i:s').' = '.$_SESSION['sess_user_name'].'\n';
									$data['create_id'] = $_SESSION['sess_user_name'];
									$data['create_time'] = date('YmdHis');
							  		$bac_obj->setDataArray($data);
								    if($bac_obj->insertDataFromInternalArray()){
								    	
								    	//sub values management
								    	//$diag_obj->useChemLabRequestSubTable();
								    	$singleParamTest = explode("&",$test_type_list);
								    	foreach( $singleParamTest as $key => $value) {
								    		$tmpTest = explode("=",$value);
								    		$parsedParamListTest['batch_nr']=$batch_nr;
								    		$parsedParamListTest['encounter_nr']=$pn;
								    		$parsedParamListTest['test_type']=$tmpTest[0];
								    		$parsedParamListTest['test_type_value']=$tmpTest[1];
								    		$parsedParamListTest['material'] = '0';
								    		$parsedParamListTest['material_value'] = '0';
									    	$bac_obj_sub->setDataArray($parsedParamListTest);
									    	$bac_obj_sub->insertDataFromInternalArray();
								    	}
								    	
								    	$singleParamMaterial = explode("&",$material_type_list);
								    	foreach( $singleParamMaterial as $key => $value) {
								    		$tmpMaterial = explode("=",$value);
								    		$parsedParamListMaterial['batch_nr']=$batch_nr;
								    		$parsedParamListMaterial['encounter_nr']=$pn;
								    		$parsedParamListMaterial['material']=$tmpMaterial[0];
								    		$parsedParamListMaterial['material_value']=$tmpMaterial[1];
								    		$parsedParamListMaterial['test_type']='0';
								    		$parsedParamListMaterial['test_type_value']='0';								    		
									    	$bac_obj_sub->setDataArray($parsedParamListMaterial);
									    	$bac_obj_sub->insertDataFromInternalArray();
								    	}
										//echo $sql;
									  	// Load the visual signalling functions
										include_once($root_path.'include/core/inc_visual_signalling_fx.php');
										// Set the visual signal 
										setEventSignalColor($pn,SIGNAL_COLOR_DIAGNOSTICS_REQUEST);									
										
										 header("location:".$root_path."modules/laboratory/labor_test_request_aftersave.php?sid=$sid&lang=$lang&edit=$edit&saved=insert&pn=$pn&station=$station&user_origin=$user_origin&status=$status&target=$target&noresize=$noresize&batch_nr=$batch_nr");
										 exit;
									  } else {
									     echo "<p>$sql<p>$LDDbNoSave"; 
										 $mode="";
									  }
		                        } //end of prepareTestElements()
								
								break; // end of case 'save'
		     case 'update':
							
							  $material_type_list = &prepareTestParameters('_mx_');  /* _mx_ = test material */
							  $test_type_list = &prepareTestParameters('_tx_');          /* _tx_ = test type */
							  
							  if($material_type_list || $test_type_list) {
							  	$data['dept_nr']=$dept_nr;
							  	$data['material_note']=htmlspecialchars($material_note);
							  	$data['diagnosis_note']=htmlspecialchars($diagnosis_note);
							  	$data['immune_supp']=$immune_supp;
							  	$data['status']=$status;
							  	$data['history']=$enc_obj->ConcatHistory("Update: ".date('Y-m-d H:i:s')." = ".$_SESSION['sess_user_name']."\n");
							  	$data['modify_id']=$_COOKIE[$local_user.$sid];
							  	$data['modify_time']=date('YmdHis');
								$bac_obj->setDataArray($data);
								$bac_obj->setWhereCond(" batch_nr=$batch_nr");
							    
								if($ergebnis=$bac_obj->updateDataFromInternalArray($batch_nr)) {
							      	//sub values management
							    	//$diag_obj->useChemLabRequestSubTable();
							    	//first i delete the old request values
							    	//then i insert the new ones.
							    	$bac_obj_sub->deleteOldValues($batch_nr,$pn);
									$singleParamTest = explode("&",$test_type_list);
							    	foreach( $singleParamTest as $key => $value) {
							    		$tmpTest = explode("=",$value);
							    		$parsedParamListTest['batch_nr']=$batch_nr;
							    		$parsedParamListTest['encounter_nr']=$pn;
							    		$parsedParamListTest['test_type']=$tmpTest[0];
							    		$parsedParamListTest['test_type_value']=$tmpTest[1];
							    		$parsedParamListTest['material'] = '0';
							    		$parsedParamListTest['material_value'] = '0';
								    	$bac_obj_sub->setDataArray($parsedParamListTest);
								    	$bac_obj_sub->insertDataFromInternalArray();
							    	}
							    	
							    	$singleParamMaterial = explode("&",$material_type_list);
							    	foreach( $singleParamMaterial as $key => $value) {
							    		$tmpMaterial = explode("=",$value);
							    		$parsedParamListMaterial['batch_nr']=$batch_nr;
							    		$parsedParamListMaterial['encounter_nr']=$pn;
							    		$parsedParamListMaterial['material']=$tmpMaterial[0];
							    		$parsedParamListMaterial['material_value']=$tmpMaterial[1];
							    		$parsedParamListMaterial['test_type']='0';
							    		$parsedParamListMaterial['test_type_value']='0';								    		
								    	$bac_obj_sub->setDataArray($parsedParamListMaterial);
								    	$bac_obj_sub->insertDataFromInternalArray();
							    	}
								  	// Load the visual signalling functions
									include_once($root_path.'include/core/inc_visual_signalling_fx.php');
									// Set the visual signal 
									setEventSignalColor($pn,SIGNAL_COLOR_DIAGNOSTICS_REQUEST);									
									
									 header("location:".$root_path."modules/laboratory/labor_test_request_aftersave.php?sid=$sid&lang=$lang&edit=$edit&saved=update&pn=$pn&station=$station&user_origin=$user_origin&status=$status&target=$target&batch_nr=$batch_nr&noresize=$noresize");
									 exit;
								} else {
								      echo "<p>$sql<p>$LDDbNoSave"; 
								      $mode="";
								   }
								  
		                        } //end of prepareTestElements()
								
								break; // end of case 'save'
								
								
	        /* If mode is edit, get the stored test request when its status is either "pending" or "draft"
			*  otherwise it is not editable anymore which happens when the lab has already processed the request,
			*  or when it is discarded, hidden, locked, or otherwise. 
			*
			*  If the "material" element is not empty, parse it to the $stored_material variable
			*  If the "test_type" element is not empty, parse it to the $stored_test_type variable
			*/
			case 'edit':
		                //$sql="SELECT * FROM care_test_request_".$db_request_table." WHERE batch_nr='".$batch_nr."' AND (status='pending' OR status='draft')";
				    $sql  = "SELECT * FROM care_test_request_".$db_request_table." ";
					$sql .= "INNER JOIN care_test_request_".$db_request_table_sub." ON ";
					$sql .= "( care_test_request_".$db_request_table.".batch_nr = care_test_request_".$db_request_table_sub.".batch_nr) ";
					$sql .= "WHERE care_test_request_".$db_request_table.".batch_nr='".$batch_nr."' ";
					$sql .= "AND (status='pending' OR status='draft')";		                
		                if($ergebnis=$db->Execute($sql)) {
		                	if($editable_rows=$ergebnis->RecordCount()) {
							    while ( !$ergebnis->EOF ) {
									$stored_param[$ergebnis->fields['material']] = $ergebnis->fields['material'];
									$stored_param[$ergebnis->fields['test_type']] = $ergebnis->fields['test_type'];
									$stored_request=$ergebnis->GetRowAssoc($toUpper=false);
									$ergebnis->MoveNext();
								}				            	
							    $edit_form=1;
					         }		                	
			             }
						 
						 break; ///* End of case 'edit': */
			
			 default: $mode="";
						   
		  }// end of switch($mode)
  
          if(!$mode) /* Get a new batch number */ {
		                $sql="SELECT batch_nr FROM care_test_request_".$db_request_table." ORDER BY batch_nr DESC";
		                if($ergebnis=$db->SelectLimit($sql,1)) {
				            if($batchrows=$ergebnis->RecordCount()) {
						       $bnr=$ergebnis->FetchRow();
							   $batch_nr=$bnr['batch_nr'];
							   if(!$batch_nr) $batch_nr=_BATCH_NR_INIT_; else $batch_nr++;
					         } else {
					            $batch_nr=_BATCH_NR_INIT_;
					          }
			             }
			               else {echo "<p>$sql<p>$LDDbNoRead"; exit;}
						 $mode="save";   
		   }

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common');

# Title in toolbar
 $smarty->assign('sToolbarTitle', "$LDDiagnosticTest :: $formtitle");

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('request_baclabor.php')");

 # hide return  button
 $smarty->assign('pbBack',FALSE);

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle', "$LDDiagnosticTest :: $formtitle");

 # Prepare new form start button
 if($user_origin=='lab' && $pn){
 	$smarty->assign('gifAux1',createLDImgSrc($root_path,'newpat2.gif','0'));
	$smarty->assign('pbAux1',$thisfile.URL_APPEND."&station=$station&user_origin=$user_origin&status=$status&target=baclabor&subtarget=baclabor&noresize=$noresize");
}

# Prepare Body onLoad javascript code
$sTemp = 'onLoad="if (window.focus) window.focus(); loadM(\'form_test_request\');';
if($pn=="") $sTemp = $sTemp .'document.searchform.searchkey.focus();';

$smarty->assign('sOnLoadJs',$sTemp .'"');

 # collect extra javascript code
 ob_start();
?>

<style type="text/css">

.fva0_ml10 {font-family: verdana,arial; font-size: 10; margin-left: 10; color:#000000;}
.lab {font-family: arial; font-size: 9; color:purple;}

</style>

<script language="javascript">
<!-- 

function chkForm(d)
{ 
   return true 
}

function loadM(fn)
{
	mBlank=new Image();
	mBlank.src="b.gif";
	mFilled=new Image();
	mFilled.src="f.gif";
	
	form_name=fn;
}

function setM(m)
{
    eval("marker=document.images."+m);
	eval("element=document."+form_name+"."+m);
	
    if(marker.src!=mFilled.src)
	{
	   marker.src=mFilled.src;
	   element.value=1;
	   //alert(element.name+element.value);
	}
	 else 
	 {
	    marker.src=mBlank.src;
		element.value=0;
	   //alert(element.name+element.value);
	 }
}

function sendLater()
{
   document.form_test_request.status.value="draft";
   if(chkForm(document.form_test_request)) document.form_test_request.submit(); 
}

function printOut()
{
	urlholder="<?php echo $root_path; ?>modules/laboratory/labor_test_request_printpop.php?sid=<?php echo $sid ?>&lang=<?php echo $lang ?>&user_origin=<?php echo $user_origin ?>&subtarget=<?php echo $target ?>&batch_nr=<?php echo $batch_nr ?>&pn=<?php echo $pn ?>";
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

	$controls_table_width=745;

	require($root_path."modules/laboratory/includes/inc_test_request_controls.php");

}elseif(!$read_form && !$no_proc_assist){

?>

<table border=0>
  <tr>
    <td><img <?php echo createMascot($root_path,'mascot1_r.gif','0','absmiddle') ?>></td>
    <td><font color="#000099" SIZE=3  FACE="verdana,Arial"> <b><?php echo $LDPlsSelectPatientFirst ?></b></font></td>
    <td valign="bottom"><img <?php echo createComIcon($root_path,'angle_down_r.gif','0') ?>></td>
  </tr>
</table>
<?php
}
?>

<!--  Here starts the table of the form  -->
  <table   cellpadding=0 cellspacing=0 border=0 width=745>
		

    <tr >
      <td colspan=4 bgcolor="#ffe3e3"  align="center"><font size=3 color="#cc0000" face="verdana,arial"><b> <?php echo $LDCentralLab." - ".$formtitle ?></b></td>
    </tr>

  <tr bgcolor="#ee6666">
    <td><font size=1 color="#ffffff" face="arial"><b><?php echo strtoupper($LDMaterial); ?></b></td>
    <td><font size=1 color="#ffffff" face="arial"><b><?php echo strtoupper($LDRequestedTest); ?></b></td>
    <td align="center"><font size=1 color="#ffffff" face="verdana,arial"><b><?php echo strtoupper($LDLabel); ?></b></td>
    <td bgcolor="<?php echo $bgc1 ?>"></td>
  </tr>

		<tr  valign="top">

      <td bgcolor="<?php echo $bgc1 ?>"><font size=1 color="#990000" face="arial">
	  <table border=0 cellpadding=0 cellspacing=0 class="lab">
    
  
<?php
  while(list($x,$v)=each($LDBacLabMaterialType))
	{
	   list($x2,$v2)=each($LDBacLabMaterialType); 
	   echo '
	   <tr>
	   <td><font size=1 color="#990000" face="arial">'.$v.'&nbsp;</td>
	   <td><font size=1 color="#990000" face="arial">'.$v2.'&nbsp;</td>
	   </tr>
	   <tr>
	   <td>';
	   
	   if($edit) echo '<a href="javascript:setM(\''.$x.'\')">';
	   
	   $inp_v='0';
	   if($edit_form || $read_form )
	   {
	      if($stored_param[$x])
		  {
		     echo '<img src="f.gif" ';
			 $inp_v='1';
		  }
		  else
		  {
		    echo '<img src="b.gif" ';
		  }
	   }
	   else
	   {
	     echo '<img src="b.gif" ';
	   }
	   
	   echo 'border=0 width=18 height=6 align="absmiddle" id="'.$x.'">';
	   
	   if($edit) echo '</a><input type="hidden" name="'.$x.'" value="'.$inp_v.'">';
	   echo '</td>
	   <td>';
	   if($edit) echo '<a href="javascript:setM(\''.$x2.'\')">';
	   	   
	   $inp_v='0';
	   if($edit_form || $read_form )
	   {
	      if($stored_param[$x2])
		  {
		     echo '<img src="f.gif" ';
			 $inp_v='1';
		  }
		  else
		  {
		    echo '<img src="b.gif" ';
		  }
	   }
	   else
	   {
	     echo '<img src="b.gif" ';
	   }
	   
	   echo 'border=0 width=18 height=6 align="absmiddle" id="'.$x2.'">';

	   if($edit) echo '</a><input type="hidden" name="'.$x2.'" value="'.$inp_v.'">';
	   echo '</td>
	   </tr>';
	 }

?>		
   </table>

</td>
      <td bgcolor="<?php echo $bgc1 ?>"><font size=1 color="#990000" face="arial">
	  <table border=0 cellpadding=0 cellspacing=0 class="lab">
  
<?php
  while(list($x3,$v3)=each($LDBacLabTestType))
	{
	   list($x4,$v4)=each($LDBacLabTestType);
	   echo '
	   <tr>
	   <td><font size=1 color="#990000" face="arial">'.$v3.'&nbsp;</td>
	   <td><font size=1 color="#990000" face="arial">'.$v4.'&nbsp;</td>
	   </tr>
	   <tr>
	   <td>';
	   if($edit) echo '<a href="javascript:setM(\''.$x3.'\')">';
	   
	   $inp_v='0';
	   if($edit_form || $read_form )
	   {
	      if($stored_param[$x3])
		  {
		     echo '<img src="f.gif" ';
			 $inp_v='1';
		  }
		  else
		  {
		    echo '<img src="b.gif" ';
		  }
	   }
	   else
	   {
	     echo '<img src="b.gif" ';
	   }
	   
	   echo 'border=0 width=18 height=6 align="absmiddle" id="'.$x3.'">';
	   
	   if($edit) echo '</a><input type="hidden" name="'.$x3.'" value="'.$inp_v.'">';
	   echo '</td>
	   <td>';
	   if($edit) echo '<a href="javascript:setM(\''.$x4.'\')">';
	   
	   $inp_v='0';
	   if($edit_form || $read_form )
	   {
	      if($stored_param[$x4])
		  {
		     echo '<img src="f.gif" ';
			 $inp_v='1';
		  }
		  else
		  {
		    echo '<img src="b.gif" ';
		  }
	   }
	   else
	   {
	     echo '<img src="b.gif" ';
	   }
	   
	   echo 'border=0 width=18 height=6 align="absmiddle" id="'.$x4.'">';
	   if($edit) echo '</a><input type="hidden" name="'.$x4.'" value="'.$inp_v.'">';
	   echo '</td>
	   </tr>';
	 }

?>		
   </table>

</td>


         <td  bgcolor="<?php echo $bgc1 ?>"  align="right">
		 <table border=0 cellpadding=10 bgcolor="#ee6666">
     <tr>
       <td>
   
<?php
                 /* The patient label */
 if($edit)
        {
		   echo '<img src="'.$root_path.'main/imgcreator/barcode_label_single_large.php?sid='.$sid.'&lang='.$lang.'&fen='.$full_en.'&en='.$pn.'" width=282 height=178>';
		}
        elseif($pn=="")
		{
		    $searchmask_bgcolor="#ffffff";
            include($root_path.'modules/laboratory/includes/inc_test_request_searchmask.php');
        }
?>
</td>
     </tr>
   </table>
    </td>

<!-- The right block for the case nr code and sampling date code -->
<td align="right" bgcolor="<?php echo $bgc1 ?>">

   <table border=0 cellspacing=0 cellpadding=0>
<?php
for($n=0;$n<8;$n++)
{
?>
   <tr align="center">
   <!--  The case numbe code  -->
   <?php
	for($i=0;$i<10;$i++)
	   echo 	 "<td><font size=1 face=\"verdana,arial\" color= \"#990000\">".$i."</td>";
	?>
   </tr>
   <tr>
	<?php
	
	for($i=0;$i<10;$i++)
	{
	   echo 	'<td>';
	   if(substr($full_en,$n,1)==$i) echo '<img src="f.gif"';
	     else echo  '<img src="b.gif"';
	   echo ' border=0 width=18 height=6 align="absmiddle"></td>';
	}
	?>
   </tr>
<?php
}
?>

 </table>
 
 <!-- Barcode for the batch nr  -->
 <?php
 	$in_cache=1;
	
	if(!file_exists('../cache/barcodes/form_'.$batch_nr.'.png'))
	{
          echo "<img src='".$root_path."classes/barcode/image.php?code=".$batch_nr."&style=68&type=I25&width=145&height=40&xres=2&font=5&label=1&form_file=1' border=0 width=0 height=0>";
	      if(!file_exists('../cache/barcodes/form_'.$batch_nr.'.png'))
	     {
             echo "<img src='".$root_path."classes/barcode/image.php?code=".$batch_nr."&style=68&type=I25&width=145&height=40&xres=2&font=5' border=0>";
			 $in_cache=0;
		 }
	}

    if($in_cache)   echo '<img src="'.$root_path.'cache/barcodes/form_'.$batch_nr.'.png"  border=0>';
?>

<!--  Table for the day and month code -->
   <table border=0 cellspacing=0 cellpadding=0>
   <tr align="center">
   <?php
	for($i=1;$i<11;$i++)
	   echo 	 "<td><font size=1 face=\"verdana,arial\" color= \"#990000\">".$i."</td>";
	?>
   <td><font size=1 face="arial" color= "#990000">20</td>

   <td><font size=1 face="arial" color= "#990000">30</td>

   </tr>

   <tr align="center">
   <?php
   
   $day_tens=0;
   $day_ones=0;
   
   if($edit_form || $read_form )
   {
      /* Process the sampling date, isolate the elements from the DATE format */
      list($yearval,$monval,$dayval) = explode("-",$stored_request['sample_date']);
   }
   else
   {
      /* If fresh form, assume today */
      $yearval=(int)date('Y');
      $dayval=(int)date('d');
	  $monval=(int)date('m');
   }
   
   /* Process the day of the week, separate the 10's from ones */
   
   if($dayval>29)
   {
     $day_tens=30;
	 $day_ones=$dayval-$day_tens;
   }
   elseif($dayval>19)
   {
     $day_tens=20;
	 $day_ones=$dayval-$day_tens;
   }
   elseif($dayval>10)
   {
     $day_tens=10;
	 $day_ones=$dayval-$day_tens;
   }
   else
   {
    $day_ones=$dayval;
   }
   //echo $day_ones." ".$day_tens;
	for($i=1;$i<10;$i++)
	{
	   echo 	'<td>';
	   if($day_ones==$i) echo '<img src="f.gif"';
	     else echo  '<img src="b.gif"';
	   echo ' border=0 width=18 height=6 align="absmiddle"></td>';
	}
	/* For the 10's */
	
   echo 	'<td>';
	  if($day_tens==10) echo '<img src="f.gif"';
	     else echo  '<img src="b.gif"';
	   echo ' border=0 width=18 height=6 align="absmiddle"></td>';

	   
	/* For the 20's */

	   echo 	'<td>';
	   if($day_tens==20) echo '<img src="f.gif"';
	     else echo  '<img src="b.gif"';
	   echo ' border=0 width=18 height=6 align="absmiddle"></td>';

	   
	/* For the 30's */

	   echo 	'<td>';
	   if($day_tens==30) echo '<img src="f.gif"';
	     else echo  '<img src="b.gif"';
	   echo ' border=0 width=18 height=6 align="absmiddle"></td>';

	?>
   </tr>
   <tr>
   <?php
	for($i=1;$i<13;$i++)
	   echo 	 "<td><font size=1 face=\"arial\" color= \"#990000\">".$LDShortMonth[$i]."&nbsp;</td>";
	?>

   </tr>
   <tr>
	<?php
	
	for($i=1;$i<13;$i++)
	{
	   echo 	'<td>';
	   if($monval==$i) echo '<img src="f.gif"';
	     else echo  '<img src="b.gif"';
	   echo ' border=0 width=18 height=6 align="absmiddle"></td>';
	}
	?>
   </tr>
  <tr>
    <td><font size=1>&nbsp;</td>
  </tr>

 </table>

</td>
	</tr>
<!--  The red row for batch number -->
	<tr bgcolor="#ee6666">	    

	<td colspan=4><font size=1 color="#ffffff" face="verdana,arial">
	<b><?php echo $LDBatchNumber." ".$batch_nr ?>  </b>
    </td>

	</tr>	
<!--  The row for material and diagnosis -->
	<tr bgcolor="<?php echo $bgc1 ?>">	    
	<td ><font size=3 color="#cc0000" face="verdana,arial">
	<b><?php echo $LDMaterial ?></b><br>
	<b><?php echo $LDDiagnosis ?></b></font>
	<font size=1 color="#990000" face="verdana,arial">
	<br><?php echo $LDImmuneSupp ?> 	
    </td>
	
	<td colspan=3><font size=3 color="#cc0000" face="verdana,arial">
	<input type="text" name="material_note" size=40 maxlength=40 value="<?php if($edit_form || $read_form) echo stripslashes($stored_request['material_note']); ?>">
                 <br>
	<input type="text" name="diagnosis_note" size=40 maxlength=40 value="<?php if($edit_form || $read_form) echo stripslashes($stored_request['diagnosis_note']); ?>"><br>
	</font>
	<font size=1 color="#990000" face="verdana,arial">
	<input type="radio" name="immune_supp" value=1 <?php if(($edit_form || $read_form) && $stored_request['immune_supp']) echo "checked" ; ?>> <?php echo $LDYes ?>	<input type="radio" name="immune_supp" value=0  <?php if(!$mode || !$stored_request['immune_supp'] ) echo "checked" ; ?>> <?php echo $LDNo ?><br>
    </td>

	</tr>	
	</table>
<p>

<?php
if($edit)
{

/* If in edit mode display the control buttons */
require($root_path."modules/laboratory/includes/inc_test_request_controls.php");

require($root_path."modules/laboratory/includes/inc_test_request_hiddenvars.php");

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
