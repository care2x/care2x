<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
include($root_path.'language/en/lang_en_reporting.php');
//require($root_path.'include/core/inc_environment_global.php');
require_once($root_path.'include/care_api_classes/class_tz_insurance.php');

$insurance_obj = new Insurance_tz;

?>
<head>
<style type="text/css">
.report{
font-size: 10px;
border-collapse:collapse;
}
</style>
</head>
<BODY bgcolor="#ffffff" link="#000066" alink="#cc0000" vlink="#000066">
<form>
<table width=100% border=0 cellspacing=0 height=100%>
<tbody class="main">





	<tr>

	  <td  valign="top" align="middle" height="35">
		   <table width="770" border=0 align="center" cellspacing="0"  class="titlebar">
 <tr valign=top  class="titlebar" >
  <td width="423" bgcolor="#99ccff" >
    &nbsp;&nbsp;<font color="#330066">INSURANCE COMPANIES REPORT</font></td>
  <td width="238" align=right bgcolor="#99ccff">
   <a href="javascript: history.back();"><img src="../../gui/img/control/default/en/en_back2.gif" /></a>
   <td width="103" bgcolor="#99ccff" ><a href="<?php echo $root_path;?>modules/reporting_tz/reporting_main_menu.php" ><img src="../../gui/img/control/default/en/en_close2.gif" border=0 width="103" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a></td>
   </td>
    </tr>
 </table>
</form>
<!-- <P> -->

<script language="javascript" src="../../js/datetimepicker.js"></script>						    
<form id="form1" name="form1" method="post" action="">
<table width="596" border="0" align="center" bgcolor="#CCCCFF">
    <tr>
      <td width="47">FROM:</td><td width="144"><input type="text" id="dfrom" name="dfrom" value="<? echo $_POST['dfrom']?>"/></td>
      <td width="98"><a href="javascript:NewCal('dfrom','ddmmyyyy')"><img src="../../gui/img/common/default/calendar.gif" /></a></td>
      <td width="47">TO:</td>
      <td width="144"><input type="text" id="dto" name="dto" value="<?php echo $_POST['dto']?>" /></td>
      <td width="56"><p><a href="javascript:NewCal('dto','ddmmyyyy')"><img src="../../gui/img/common/default/calendar.gif" /></a></p></td></tr>
      
     
</table>
<table width="596" border="0" align="center" bgcolor="#CCCCFF">
  <tr>
    <th width="363" scope="col"><?php echo  $LDSelectCompany; ?></th>
    <th width="67" scope="col"><?php echo $LDAdmitType; ?></th>
    <th width="164" scope="col">&nbsp;</th>
  </tr>
  <tr>
    <td><?php echo $insurance_obj->ShowAllInsurancesForQuotatuion(); ?></td>

    <td><?php echo '<SELECT name="admission_id">';
	echo '<OPTION selected value="0" >All</OPTION>';
	echo '<OPTION value="2">Outpatient</OPTION>';
        echo '<OPTION value="1">Inpatient</OPTION>';

        echo '</SELECT>';?></td>
    <td><input type="submit" name="show" value="SHOW"></td>
  </tr>
</table>

</form>
<!-- <p>&nbsp;    </p> -->

<?php

//SELECTION MADE BY USER

//Date
$dfrom=$_POST['dfrom'];
$dto  =$_POST['dto'];

//insurance company
if($_POST['insurance']==-1){
	$company=0;
}else{
$company=$_POST['insurance'];
}



//admission type, in_out_patient

$in_out_patient=$_POST['admission_id'];




switch ($in_out_patient){

//inpatient
case 1:
$in_out_patients= 'encounter_class_nr=1';
break;

//outpatient
case 2:
$in_out_patients='encounter_class_nr=2';
break;

//all
case 0:
$in_out_patients='encounter_class_nr>0';
break;


default:

$in_out_patients= FALSE;
break;
 
}




//FORM VALIDATION
if(!$dfrom || !$dto ){
  echo '<strong>Please enter correct date and insurance company</strong>';
exit;
}

$dfrom_unixtime=strtotime($dfrom);
$dto_unixtime  =strtotime($dto. '+1 day');


 
//query all the necessary data

/*
$sql_tmp_insurance_billing="CREATE TEMPORARY TABLE insurance_temp SELECT distinct cp.pid,name_first,cp.name_last,cp.date_birth,billelem.amount,billelem.price,cp.selian_pid, billelem.date_change,(billelem.amount * billelem.price) AS total_price,cp.membership_nr,ce.form_nr,ctzpricelist.item_description,ctzpricelist.item_number,ctzpricelist.purchasing_class,billelem.insurance_id,ce.encounter_class_nr,billarchive.encounter_nr FROM care_person AS cp INNER JOIN care_encounter AS ce ON ce.pid=cp.pid INNER JOIN care_tz_billing_archive AS billarchive ON billarchive.encounter_nr=ce.encounter_nr INNER JOIN care_tz_billing_archive_elem AS billelem ON billarchive.nr=billelem.nr INNER JOIN care_tz_drugsandservices AS ctzpricelist ON ctzpricelist.item_description=billelem.description WHERE $in_out_patients AND  billelem.insurance_id>0  AND  billelem.date_change BETWEEN  $dfrom_unixtime AND $dto_unixtime AND billelem.insurance_id =$company ";
$sql_tmp_result = $db->Execute($sql_tmp_insurance_billing);
*/


$sql_insurance=" CREATE TEMPORARY TABLE insurance_temp SELECT cp.pid,billelem.date_change AS billed_date,cp.name_first,cp.name_last,cp.date_birth,cp.selian_pid,cp.membership_nr,ce.form_nr,ce.encounter_date AS admission_date,billelem.description,ctzpricelist.item_number,billelem.price,ctzpricelist.purchasing_class,(billelem.amount * billelem.price) AS total_price, billelem.insurance_id,ce.encounter_class_nr FROM care_person AS cp INNER JOIN care_encounter AS ce ON ce.pid=cp.pid INNER JOIN care_tz_billing_archive AS billarchive ON billarchive.encounter_nr=ce.encounter_nr INNER JOIN care_tz_billing_archive_elem AS billelem ON billarchive.nr=billelem.nr INNER JOIN care_tz_drugsandservices AS ctzpricelist ON ctzpricelist.item_id=billelem.item_number   WHERE billelem.date_change BETWEEN $dfrom_unixtime AND $dto_unixtime AND billelem.insurance_id=$company ";
$sql_insurance_result=$db->Execute($sql_insurance);

//below query will make it possible to search for deposit
$sql_deposit="CREATE TEMPORARY TABLE deposit_temp SELECT cp.pid, cp.name_first, cp.name_last,cp.date_birth,cp.membership_nr,ce.form_nr,cp.selian_pid,ce.encounter_nr,ce.encounter_class_nr,cbae.insurance_id,ce.encounter_date,cbae.date_change AS billed_date, cbae.description, cbae.amount, cbae.price
FROM care_person AS cp
INNER JOIN care_encounter AS ce ON cp.pid = ce.pid
INNER JOIN care_tz_billing_archive AS cba ON ce.encounter_nr = cba.encounter_nr
INNER JOIN care_tz_billing_archive_elem AS cbae ON cbae.nr = cba.nr
WHERE cbae.date_change
BETWEEN $dfrom_unixtime AND $dto_unixtime";



$deposit_result=$db->Execute($sql_deposit);
$sql_adv="SELECT  * FROM deposit_temp WHERE insurance_id=$company AND $in_out_patients AND description='Advance'";
$sql_topup="SELECT  * FROM deposit_temp WHERE insurance_id=$company AND $in_out_patients AND description='Topup'";
$sql_refund="SELECT * FROM deposit_temp WHERE insurance_id=$company AND $in_out_patients AND description='Refund'";



$result_adv=$db->Execute($sql_adv);
$result_topup=$db->Execute($sql_topup);
$result_refund=$db->Execute($sql_refund);

//echo mysql_num_rows($result_adv);




$sql_insurance_temp="SELECT pid,billed_date,admission_date,name_first,name_last,date_birth,selian_pid,membership_nr,form_nr,description,price,purchasing_class,total_price FROM insurance_temp WHERE $in_out_patients  ORDER BY admission_date ASC ";
$sql_insurance_temp_result=$db->Execute($sql_insurance_temp);

$sql_insurance_temp_group="SELECT purchasing_class,sum(total_price) AS total FROM insurance_temp WHERE $in_out_patients GROUP BY purchasing_class ";
$insurance_temp_group_result=$db->Execute($sql_insurance_temp_group);



	

	




 








/*
$count_forms_query="SELECT DISTINCT count(form_nr) AS forms FROM insurance_temp";
$count_forms_result= $db->Execute($count_forms_query);
echo $count_forms_result;
*/




$company_name="SELECT name FROM care_tz_company WHERE id = $company";
$company_result=$db->Execute($company_name);
while($company_row=$company_result->FetchRow()){
     $company_names=$company_row['name'];
}

if(!$company_names){
	$company_names='CASH';
	}                 
?>
                                          
<form>
<table class="report" width="90%" border="1" valign="top"> 
  <tr bgcolor="lightgrey">
  <th width="70" >FROM:</th><th><?php echo date('d-m-Y',strtotime($dfrom));?></th><th width="70">TO:</th><th><?php echo date('d-m-Y',strtotime($dto));?></th><th colspan="6"><?php echo $company_names;?></th> 
  </tr>

  <tr>
    <th width="70" scope="col" font-size="8"> <?php   echo  $LDBilled_date;?></th>
    <th width="70" scope="col"> <?php   echo  $LDAdmission_date;?></th>
    <th width="136" scope="col"><?php   echo  $LDPatient;?></th>
    <th width="136" scope="col"><?php   echo  $LDBirthDate;?></th>
    <th width="90" scope="col"> <?php   echo  $LDSelianfilenumber;?></th>
    <th width="137" scope="col"><?php   echo  $LDMembership_NR;?></th>
    <th width="90" scope="col"> <?php   echo  $LDForm_NR; ?></th>
    <th width="86" scope="col"> <?php   echo  $LDDescription;?></th>
    <th width="82" scope="col"> <?php   echo  $LDGroup; ?></th>
    <th width="70" scope="col"> <?php   echo  $LDPrice; ?></th>
  </tr>

<?php
$total_all=0;
while($rows=$sql_insurance_temp_result->FetchRow()){
$date                    =$rows['billed_date'];
$date                    =date('j-m-Y',$date);
$admission_date          =$rows['admission_date'];
$admission_date          =date('j-m-Y',strtotime($admission_date ));
$first_name              =$rows['name_first'];
$last_name               =$rows['name_last'];
$birth_date              =$rows['date_birth'];
$birth_date              =date('j-m-Y',strtotime($birth_date )); 
$registration_nr         =$rows['selian_pid'];
$membership_nr           =$rows['membership_nr'];
$form_nr                 =$rows['form_nr'];
$item_name               =$rows['description'];
$price                   =$rows['price'];
$group                   =$rows['purchasing_class'];
$total                   =$rows['total_price'];
//echo $date.' '.$first_name.' '.$last_name.' '.$registration_nr.' '.$membership_nr.' '.$form_nr.' '.$item_name.' '.$price.' '.$group.' '.$total.'<br>';
echo '<tr>
    <td>&nbsp;'.$date.'</td>
     <td>&nbsp;'.$admission_date.'</td>
    <td>&nbsp;'.$first_name.' '.$last_name .'</td>
    <td>&nbsp;'.$birth_date.'</td>
    <td>&nbsp;'.$registration_nr.'</td>
    <td>&nbsp;'.$membership_nr.'</td>
    <td>&nbsp;'.$form_nr.'</td>
    <td>&nbsp;'.$item_name .'</td>
    <td>&nbsp;'.$group .'</td>
    <td>&nbsp;'.number_format($total).'</td>
  </tr>';

$total_all+=$rows['total_price'];
}

echo '<tr bgcolor="lightgrey"><td colspan="10" align="center">PATIENT DEPOSIT</td></tr>';
$total_deposit=0;
while($rows_adv=$result_adv->FetchRow()){
	//$total_adv=0;
	echo '<tr>
    <td>&nbsp;'.date('j-m-Y',$rows_adv['billed_date']).'</td>
     <td>&nbsp;'.date('j-m-Y',strtotime($rows_adv['encounter_date'] )).'</td>
    <td>&nbsp;'.$rows_adv['name_first'].' '.$rows_adv['name_last'] .'</td>
    <td>&nbsp;'.date('j-m-Y',strtotime($rows_adv['date_birth'])).'</td>
    <td>&nbsp;'.$rows_adv['selian_pid'].'</td>
    <td>&nbsp;'.$rows_adv['membership_nr'].'</td>
    <td>&nbsp;'.$rows_adv['form_nr'].'</td>
    <td>&nbsp;'.$LDDeposit.'</td>
    <td>&nbsp;'.$LDDeposit.'</td>
    <td>&nbsp;'.number_format($rows_adv['price']).'</td>
       
  </tr>';
    $total_deposit+=$rows_adv['price'];
	 
	}
	
	
	
while($rows_topup=$result_topup->FetchRow()){
	echo '<tr>
    <td>&nbsp;'.date('j-m-Y',$rows_topup['billed_date']).'</td>
     <td>&nbsp;'.date('j-m-Y',strtotime($rows_topup['encounter_date'] )).'</td>
    <td>&nbsp;'.$rows_topup['name_first'].' '.$rows_topup['name_last'] .'</td>
    <td>&nbsp;'.date('j-m-Y',strtotime($rows_topup['date_birth'])).'</td>
    <td>&nbsp;'.$rows_topup['selian_pid'].'</td>
    <td>&nbsp;'.$rows_topup['membership_nr'].'</td>
    <td>&nbsp;'.$rows_topup['form_nr'].'</td>
    <td>&nbsp;'.$LDTopup.'</td>
    <td>&nbsp;'.$LDTopup.'</td>
    <td>&nbsp;'.number_format($rows_topup['price']).'</td>
       
  </tr>';	
	$total_deposit+=$rows_topup['price'];
}

while($rows_refund=$result_refund->FetchRow()){
	echo '<tr>
    <td>&nbsp;'.date('j-m-Y',$rows_refund['billed_date']).'</td>
     <td>&nbsp;'.date('j-m-Y',strtotime($rows_refund['encounter_date'] )).'</td>
    <td>&nbsp;'.$rows_refund['name_first'].' '.$rows_refund['name_last'] .'</td>
    <td>&nbsp;'.date('j-m-Y',strtotime($rows_refund['date_birth'])).'</td>
    <td>&nbsp;'.$rows_refund['selian_pid'].'</td>
    <td>&nbsp;'.$rows_refund['membership_nr'].'</td>
    <td>&nbsp;'.$rows_refund['form_nr'].'</td>
    <td>&nbsp;'.$LDRefund.'</td>
    <td>&nbsp;'.$LDRefund.'</td>
    <td>&nbsp;'.number_format($rows_refund['price']).'</td>
       
  </tr>';	
	$total_deposit+=$rows_refund['price'];
}

echo '<tr bgcolor="lightgrey"><td colspan="9" align="center"><h2>GRAND TOTAL:</h2></td><td><h2>'.number_format($total_all+$total_deposit).'</h2></td></tr>';
 
echo '</table>';
?>  
<?php

while($rows_class=$insurance_temp_group_result->FetchRow()){
	  if($rows_class[0]==labtest){
		  $lab_total=$rows_class[1];
		}
		
	  if($rows_class[0]==xray){
		  $radio_total=$rows_class[1];
		  }
		  
		  
	  if($rows_class[0]==drug_list){
		  $drugs_total=$rows_class[1];
		  }
		  
		  
	  if($rows_class[0]==drug_list_nhif){
		  $drugs_nhif_total=$rows_class[1];
		  }
	
	  if($rows_class[0]==drug_list_ctc){
		  $drugs_ctc_total=$rows_class[1];
		  }
		
	  if($rows_class[0]==dental){
		  $dental_total=$rows_class[1];
		  }
	   
	  if($rows_class[0]==eye_service){
		  $macho_total=$rows_class[1];
		  }
		  
	   if($rows_class[0]==minor_proc_op){
		   $minor_proc_op_total=$rows_class[1];
		   }
		   
		   
	    if($rows_class[0]==surgical_op){
			$surgical_op_total=$rows_class[1];
			}
			
		if($rows_class[0]==service){
			$services_total=$rows_class[1];
			}
			
		 if($rows_class[0]==supplies){
			$supplies_total=$rows_class[1]; 
			}
			
		 if($rows_class[0]==supplies_laboratory){
			$supplies_laboratory_total=$rows_class[1]; 
			 }
			 
		 
			 
		 	 			  	  	  
		  	   	  	   	  	
	}

	
$all_drugs_total=$drugs_total+$drugs_ctc_total+$drugs_nhif_total;






//sum for all items
$grand_total=$all_drugs_total+$total_deposit+$lab_total+$radio_total+$dental_total+$macho_total+$minor_proc_op_total+$surgical_op_total+$services_total+$supplies_total+$supplies_laboratory_total;




echo $company_names;
?>            
<p>FROM:<?php echo date('d-m-Y',strtotime($dfrom)).'   ';  ?> TO:<?php echo date('d-m-Y',strtotime($dto));?></p>
<table class="report" width="90%" border="1">
  <tr>
    <th width="89" scope="col"><?php echo $LDLab;?></th>
    <th width="89" scope="col"><?php echo $LDDrugs;?></th>
    <th width="89" scope="col"><?php echo $LDRadilogy;?></th>
    <th width="89" scope="col"><?php echo $LDDental;?></th>
    <th width="89" scope="col"><?php echo $LDEye;?></th>
    <th width="89" scope="col"><?php echo $LDMinProc;?></th>
    <th width="89" scope="col"><?php echo $LDProcSurg;?></th>
    <th width="89" scope="col"><?php echo $LDServicesTotal;?></th>
    <th width="89" scope="col"><?php echo $LDConsum;?></th>
    <th width="89" scope="col"><?php echo $LDSuppliesLab;?></th>
      <th width="89" scope="col"><?php echo $LDDeposit;?></th>
      <th width="89" scope="col"><?php echo $LDtotal;?></th>
  </tr>
  <tr>
    <td>&nbsp;<?php echo number_format($lab_total); ?></td>
    <td>&nbsp;<?php echo number_format($all_drugs_total); ?></td>
    <td>&nbsp;<?php echo number_format($radio_total); ?></td>
    <td>&nbsp;<?php echo number_format($dental_total); ?></td>
    <td>&nbsp;<?php echo number_format($macho_total); ?></td>
    <td>&nbsp;<?php echo number_format($minor_proc_op_total); ?></td>
   <td>&nbsp;<?php echo number_format($surgical_op_total); ?>
   <td>&nbsp;<?php echo number_format($services_total); ?>
   <td>&nbsp;<?php echo number_format($supplies_total); ?>
   <td>&nbsp;<?php echo number_format($supplies_laboratory_total); ?>
   <td>&nbsp;<?php echo number_format($total_deposit); ?>
   <td>&nbsp;<?php echo number_format($grand_total); ?>
  </tr>
</table>
</form>
<p>Printed by ..........................................................................................</p>
<p>&nbsp;</p>
<p>Authorized by......................................................................................</p>
<p>&nbsp;</p>

<?php 
?>
 <p>&nbsp;   </p>
   
     <input type="button" name="print" value="PRINT" onclick="window.print(form2)" />
     
</BODY>   




