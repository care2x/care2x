<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
require($root_path.'language/en/lang_en_date_time.php');
require($root_path.'include/core/inc_date_format_functions.php');





//BLOCK PAYMENT IS WRITTEN BY ISRAEL PASCAL
//ELCT ICT UNIT 
//israel.pascal10@gmail.com, +255719709660, +255767809660


?>


<script language="javascript" src="../../js/datetimepicker.js"></script>
<table width=100% border=0 cellspacing=0 height=100%>
<tbody class="main">





	<tr>

	  <td  valign="top" align="middle" height="35">
		   <table width="770" border=0 align="center" cellspacing="0"  class="titlebar">
 <tr valign=top  class="titlebar" >
  <td width="423" bgcolor="#99ccff" >
    &nbsp;&nbsp;<font color="#330066">BLOCK PAYMENT SUMMARY REPORT</font></td>
  <td width="238" align=right bgcolor="#99ccff">
   <a href="javascript: history.back();"><img src="../../gui/img/control/default/en/en_back2.gif" /></a>
   <td width="103" bgcolor="#99ccff" ><a href="<?php echo $root_path;?>modules/reporting_tz/reporting_main_menu.php" ><img src="../../gui/img/control/default/en/en_close2.gif" border=0 width="103" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a></td>
   </td>
    </tr>
 </table>
<p>&nbsp; </p>
			 
<form id="form1" name="form1" method="post" action="">
  <table width="596" border="0" align="center" bgcolor="#CCCCFF">
    <tr>
      <td width="81">FROM:</td>
      <td width="144"><input type="text" id="dfrom" name="dfrom" /></td>
      <td width="98"><a href="javascript:NewCal('dfrom','ddmmyyyy')"><img src="../../gui/img/common/default/calendar.gif" /></a></td>
      <td width="47">TO:</td>
      <td width="144"><input type="text" id="dto" name="dto"/></td>
      <td width="56"><a href="javascript:NewCal('dto','ddmmyyyy')"><img src="../../gui/img/common/default/calendar.gif" /></a><td>Type</td></td>
      <td><?php echo '<SELECT name="trans_id">';

        echo '<OPTION selected value="" >Cash</OPTION>';
        echo '<OPTION value="0">Cash</OPTION>';
        echo '<OPTION value="1">Credit</OPTION>';
        echo '<OPTION value="2">All</OPTION>';
        echo '</SELECT>';
        	 ?></td>
        	<td><input type="submit" name="show" value="SHOW" /></td>
    </tr>
  </table>
</form>
<?php
$dfrom       =   $_POST['dfrom'];
$dto         =   $_POST['dto'];
$trans_type  =   $_POST['trans_id'];




switch($trans_type) {
	 
   case  0: //cash
       $bill_type = 'billelem.insurance_id=0';
       $bill_type_drugs = 'b.insurance_id=0';
       $payment   = 'CASH';
       break;
       
   case  1: //credit
       $bill_type = 'billelem.insurance_id>0';
       $bill_type_drugs = 'b.insurance_id>0';
       $payment   = 'CREDIT';
       break;
       
   case 2:  //all 
       $bill_type = 'billelem.insurance_id>=0';
       $bill_type_drugs = 'b.insurance_id>=0';
       $payment   = 'CASH and CREDIT';
       break;
              
        
 } 


$selected_date_start        =@formatDate2STD($dfrom,$date_format);
$selected_date_end          =@formatDate2STD($dto,$date_format); 
$f_date_start               =strtotime($selected_date_start);
$f_date_end                 =strtotime($selected_date_end);
      
                
                               
$day_start                 =date("d",$f_date_start); 
$month_start               =date("n",$f_date_start);
$year_start                =date("Y",$f_date_start);
        
$day_end                   =date("d",$f_date_end); 
$month_end                 =date("n",$f_date_end);
$year_end                  =date("Y",$f_date_end);
        
             

	
$start_timeframe           =mktime (0,0,0,$month_start, $day_start, $year_start);
$end_timeframe             =mktime (23,59,59,$month_end, $day_end, $year_end);
                      




$sql_tmp_insurance_billing="CREATE TEMPORARY TABLE money_collection_temp SELECT distinct billelem.amount,billelem.description,billelem.price,billelem.date_change,(billelem.amount * billelem.price) AS total_price,ctzpricelist.item_description,ctzpricelist.item_number,ctzpricelist.item_id,ctzpricelist.purchasing_class,ctzpricelist.item_full_description,billelem.insurance_id,ce.encounter_class_nr,billarchive.encounter_nr FROM care_person AS cp INNER JOIN care_encounter AS ce ON ce.pid=cp.pid INNER JOIN care_tz_billing_archive AS billarchive ON billarchive.encounter_nr=ce.encounter_nr INNER JOIN care_tz_billing_archive_elem AS billelem ON billarchive.nr=billelem.nr INNER JOIN care_tz_drugsandservices AS ctzpricelist ON ctzpricelist.item_description=billelem.description WHERE $bill_type   AND billelem.date_change BETWEEN $start_timeframe   AND $end_timeframe";
$sql_tmp_result = $db->Execute($sql_tmp_insurance_billing);

if(!$sql_tmp_result){
echo 'ENTER DATE CLICK SHOW';
exit;
}


//START OF BLOCK PAYMENT
//*******************************************NOT APPLICABLE FOR AICC HOSPITAL***************************************************************
/*                                                                                                                                         *
//SUM FOR REFERRAL                                                                                                                         *  
$referral_query="SELECT description,SUM(total_price) AS total_referral FROM money_collection_temp                                          * 
                 WHERE description = 'cons-referral' AND purchasing_class='service' ";                                                     *
$referral_query_result=$db->Execute($referral_query);                                                                                      *
while($referral_rows=$referral_query_result->FetchRow()){                                                                                  *
     if(isset($referral_rows['total_referral'])){                                                                                          *
      $total_referral=$referral_rows['total_referral'];                                                                                    * 
      }else{                                                                                                                               * 
       $total_referral=0;                                                                                                                  *  
       }                                                                                                                                   * 
}                                                                                                                                          * 
                                                                                                                                           *
                                                                                                                                           *
//SUM FOR SELF-REFERRAL                                                                                                                    *
$self_referral_query="SELECT description, SUM(total_price) AS total_self_referral FROM money_collection_temp                               *
                      WHERE description='cons-self-referral' AND purchasing_class='service'";                                              *
$self_referral_query_result=$db->Execute($self_referral_query);                                                                            *   
while($self_referral_rows=$self_referral_query_result->FetchRow()){
     if(isset($self_referral_rows['total_self_referral'])){
       $total_self_referral=$self_referral_rows['total_self_referral'];
      }else{
       $total_self_referral=0;
       }
}

//SUM FOR ADMISSION
$admission_query="SELECT description, SUM(total_price) AS total_admission FROM money_collection_temp
                  WHERE description='cons-admission' AND purchasing_class='service'";
$admission_query_result=$db->Execute($admission_query);
while($admission_query_rows=$admission_query_result->FetchRow()){
     if(isset($admission_query_rows['total_admission'])){
      $total_admission=$admission_query_rows['total_admission'];
     }else{
          $total_admission=0;
      }
}  


//SUM FOR FOREIGNER
$foreigner_query="SELECT description, SUM(total_price) AS total_foreigner FROM money_collection_temp
                  WHERE description='cons-foreigner' AND purchasing_class='service'";
$foreigner_query_result=$db->Execute($foreigner_query);
while($foreigner_query_rows=$foreigner_query_result->FetchRow()){
     if(isset($foreigner_query_rows['total_foreigner'])){
      $total_foreigner=$foreigner_query_rows['total_foreigner'];
     }else{
          $total_foreigner=0;
      }
}

//SUM FOR FAST TRACK
$fast_track_query="SELECT description, SUM(total_price) AS total_fast_track FROM money_collection_temp
                  WHERE description='cons-fast track' AND purchasing_class='service'";
$cons_fast_track_query_result=$db->Execute($fast_track_query);
while($fast_track_query_rows=$cons_fast_track_query_result->FetchRow()){
     if(isset($fast_track_query_rows['total_fast_track'])){
      $total_fast_track=$fast_track_query_rows['total_fast_track'];
     }else{
          $total_fast_track=0;
      }
} 


 


//SUM FOR REVISIT WITHIN 7 DAYS
$revisit_7_days_query="SELECT description, SUM(total_price) AS total_revisit FROM money_collection_temp
                      WHERE description='cons-revisit-within-7days' AND purchasing_class='service'";
$revisit_query_result=$db->Execute($revisit_7_days_query);
while($revisit_rows=$revisit_query_result->FetchRow()){
      if(isset($revisit_rows['total_revisit'])){
      $total_revisit=$revisit_rows['total_revisit'];
      }else{
      $total_revisit=0;
       }
    
}
               
//SUM PATIENT PARTIAL PAYMENT 10,000
$partial_10000_query="SELECT description, SUM(total_price) AS total_partial_10000 FROM money_collection_temp
                WHERE description='cons-Partial Payment-10000' AND purchasing_class='service'";
$partial_10000_result=$db->Execute($partial_10000_query);
while($partial_10000_rows=$partial_10000_result->FetchRow()){
     if(isset($partial_10000_rows['total_partial_10000'])){
       $total_partial_10000=$partial_10000_rows['total_partial_10000'];
     }else{
         $total_partial_10000=0;
     }
} 


//SUM PATIENT PARTIAL PAYMENT 12,000
$partial_12000_query="SELECT description, SUM(total_price) AS total_partial_12000 FROM money_collection_temp
                WHERE description='cons-Partial Payment-12000' AND purchasing_class='service'";
$partial_12000_result=$db->Execute($partial_12000_query);
while($partial_12000_rows=$partial_12000_result->FetchRow()){
     if(isset($partial_12000_rows['total_partial_12000'])){
       $total_partial_12000=$partial_12000_rows['total_partial_12000'];
     }else{
         $total_partial_12000=0;
     }
} 

//SUM PATIENT PARTIAL PAYMENT 3,000
$partial_3000_query="SELECT description, SUM(total_price) AS total_partial_3000 FROM money_collection_temp
                WHERE description='cons-Partial Payment-3000' AND purchasing_class='service'";
$partial_3000_result=$db->Execute($partial_3000_query);
while($partial_3000_rows=$partial_3000_result->FetchRow()){
     if(isset($partial_3000_rows['total_partial_3000'])){
       $total_partial_3000=$partial_3000_rows['total_partial_3000'];
     }else{
         $total_partial_3000=0;
     }
} 


//SUM PATIENT PARTIAL PAYMENT 5,000
$partial_5000_query="SELECT description, SUM(total_price) AS total_partial_5000 FROM money_collection_temp
                WHERE description='cons-Partial Payment-5000' AND purchasing_class='service'";
$partial_5000_result=$db->Execute($partial_5000_query);
while($partial_5000_rows=$partial_5000_result->FetchRow()){
     if(isset($partial_5000_rows['total_partial_5000'])){                                                                                       *
       $total_partial_5000=$partial_5000_rows['total_partial_5000'];                                                                            *
     }else{                                                                                                                                     *
         $total_partial_5000=0;                                                                                                                 *
     }                                                                                                                                          *
}                                                                                                                                               * 
*/                                                                                                                                              
//**********************************************END OF NOT APPLICABLE FOR AICC HOSPITAL**********************************************************
//END OF BLOCK PAYMENT



//consultation for specialist
$cons_specialist="SELECT description, SUM(total_price) AS total_specialist FROM money_collection_temp
                  WHERE item_number='C02' AND purchasing_class='service'";
$specialist_query_result=$db->Execute($cons_specialist);
while($specialist_query_rows=$specialist_query_result->FetchRow()){
     if(isset($specialist_query_rows['total_specialist'])){
      $total_specialist=$specialist_query_rows['total_specialist'];

     }else{

          $total_specialist=0;

      }

}



//consultation for general
$cons_general="SELECT description, SUM(total_price) AS total_general FROM money_collection_temp
                  WHERE item_number='C01' AND purchasing_class='service'";
$general_query_result=$db->Execute($cons_general);
while($general_query_rows=$general_query_result->FetchRow()){
     if(isset($general_query_rows['total_general'])){
      $total_general=$general_query_rows['total_general'];
     }else{
          $total_general=0;
      }
}

//CONSULTATION RCH
$RCH="SELECT description, SUM(total_price) AS total_RCH FROM money_collection_temp
WHERE item_number='C03' AND purchasing_class='service'";
$rch_query_result=$db->Execute($RCH);
while($rch_query_rows=$rch_query_result->FetchRow()){
     if(isset($rch_query_rows['total_RCH'])){
      $total_RCH=$rch_query_rows['total_RCH'];

     }else{

          $total_RCH=0;

      }

}


//NURSING CARE
$nursing_care="SELECT description, SUM(total_price) AS total_nursingcare FROM money_collection_temp
WHERE item_number='NC01' AND purchasing_class='service'";
$nursingcare_query_result=$db->Execute($nursing_care);
while($nursingcare_query_rows=$nursingcare_query_result->FetchRow()){
     if(isset($nursingcare_query_rows['total_nursingcare'])){
      $total_nursingcare=$nursingcare_query_rows['total_nursingcare'];

     }else{

          $total_nursingcare=0;

      }

}

//BABY CARE
$baby_care="SELECT description, SUM(total_price) AS total_babycare FROM money_collection_temp
WHERE item_number='BC1' AND purchasing_class='service'";
$babycare_query_result=$db->Execute($baby_care);
while($babycare_query_rows=$babycare_query_result->FetchRow()){
     if(isset($babycare_query_rows['total_babycare'])){
      $total_babycare=$babycare_query_rows['total_babycare'];

     }else{

          $total_babycare=0;

      }

}

//LAST OFFICE
$last_office="SELECT description, SUM(total_price) AS total_lastoffice FROM money_collection_temp
WHERE item_number='LO1' AND purchasing_class='service'";
$lastoffice_query_result=$db->Execute($last_office);
while($lastoffice_query_rows=$lastoffice_query_result->FetchRow()){
     if(isset($lastoffice_query_rows['total_lastoffice'])){
      $total_lastoffice=$lastoffice_query_rows['total_lastoffice'];

     }else{

          $total_lastoffice=0;

      }

}

//DRESSING
$dressing="SELECT description, SUM(total_price) AS total_dressing FROM money_collection_temp
WHERE item_number='DR01' AND purchasing_class='service'";
$dressing_query_result=$db->Execute($dressing);
while($dressing_query_rows=$dressing_query_result->FetchRow()){
     if(isset($dressing_query_rows['total_dressing'])){
      $total_dressing=$dressing_query_rows['total_dressing'];

     }else{

          $total_dressing=0;

      }

}





//IPD GENERAL CONSULTATION
$ipd_gen_query="SELECT description, SUM(total_price) AS total_general_ipd FROM money_collection_temp
WHERE item_number='IPDG' AND purchasing_class='service'";
$ipd_gen_result=$db->Execute($ipd_gen_query);
while($ipd_gen_rows=$ipd_gen_result->FetchRow()){
     if(isset($ipd_gen_rows['total_general_ipd'])){
      $total_general_ipd=$ipd_gen_rows['total_general_ipd'];

     }else{

          $total_general_ipd=0;

      }

}

//IPD SPECIALIST CONSULTATION
$ipd_specialist_query="SELECT description, SUM(total_price) AS total_specialist_ipd FROM money_collection_temp
WHERE item_number='IPDS' AND purchasing_class='service'";
$ipd_spcialist_result=$db->Execute($ipd_specialist_query);
while($ipd_specialist_rows=$ipd_spcialist_result->FetchRow()){
     if(isset($ipd_specialist_rows['total_specialist_ipd'])){
      $total_specialist_ipd=$ipd_specialist_rows['total_specialist_ipd'];

     }else{

          $total_specialist_ipd=0;

      }

}



//LABORATORY
$lab_query="SELECT description, SUM(total_price) AS total_lab FROM money_collection_temp WHERE purchasing_class='labtest'";
$lab_query_result=$db->Execute($lab_query);
while($lab_rows=$lab_query_result->FetchRow()){
     if(isset($lab_rows['total_lab'])){
      $lab_total=$lab_rows['total_lab'];
     }else{
        $lab_total=0;
      
     }
}            
            

//RADIOLOGY
$radio_query="SELECT description, SUM(total_price) AS total_radio FROM money_collection_temp WHERE purchasing_class='xray'";
$radio_result=$db->Execute($radio_query);
while($radio_rows=$radio_result->FetchRow()){
     if(isset($radio_rows['total_radio'])){
      $radio_total=$radio_rows['total_radio']; 
     }else{
      $radio_total=0;
      }
}             


//DRUGS
$drugs_query="SELECT description, SUM(total_price) AS total_drugs FROM money_collection_temp WHERE purchasing_class='drug_list'";
$drugs_result=$db->Execute($drugs_query);
while($drugs_rows=$drugs_result->FetchRow()){
    if(isset($drugs_rows['total_drugs'])){
     $drugs_total=$drugs_rows['total_drugs'];
    }else{
      $drugs_total=0;
     }
}
 

//DENTAL
$dental_query="SELECT description, SUM(total_price) AS total_dental FROM money_collection_temp WHERE purchasing_class='dental'";
$dental_result=$db->Execute($dental_query);
while($dental_rows=$dental_result->FetchRow()){
     if(isset($dental_rows['total_dental'])){
     $total_dental=$dental_rows['total_dental'];
  }else{
     $total_dental=0;
    }
}


//BED GENERAL
$bedgeneral_query="SELECT description, SUM(total_price) AS total_bedgeneral FROM money_collection_temp WHERE item_number = 'B01' AND purchasing_class='service'";
$bedgeneral_result=$db->Execute($bedgeneral_query);
while($bedgeneral_rows=$bedgeneral_result->FetchRow()){
    if(isset($bedgeneral_rows['total_bedgeneral'])){
     $total_bedgeneral=$bedgeneral_rows['total_bedgeneral'];
     }else{
       $total_bedgeneral=0;  
      }
}

//BED PRIVATE
$bedprivate_query="SELECT description, SUM(total_price) AS total_bedprivate FROM money_collection_temp WHERE item_number ='B02' AND purchasing_class='service'";
$bedprivate_result=$db->Execute($bedprivate_query);
while($bedprivate_rows=$bedprivate_result->FetchRow()){
    if(isset($bedprivate_rows['total_bedprivate'])){
     $total_bedprivate=$bedprivate_rows['total_bedprivate'];
     }else{
       $total_bedprivate=0;  
      }
}

//MINOR PROCEDURE
$minor_proc_query="SELECT SUM(total_price) AS total_minor_proc FROM money_collection_temp  WHERE purchasing_class='minor_proc_op'";
$minor_proc_result=$db->Execute($minor_proc_query);
while($minor_proc_rows=$minor_proc_result->FetchRow()){
    if(isset($minor_proc_rows['total_minor_proc'])){
     $minor_proc_total=$minor_proc_rows['total_minor_proc'];
       
    }else{
     $minor_proc_total=0; 
     }
}

//EYE SURGERY
$eye_surgery="SELECT SUM(total_price) AS total_eyesurgery FROM money_collection_temp  WHERE purchasing_class='eye-service'";
$eye_surgery_result=$db->Execute($eye_surgery);
while($eyesurgery_rows=$eye_surgery_result->FetchRow()){
    if(isset($eyesurgery_rows['total_eyesurgery'])){
     $eyesurgery_total=$eyesurgery_rows['total_eyesurgery'];
       
    }else{
     $eyesurgery_total=0; 
     }
}


//MAJOR PROCEDURE
$major_proc_query="SELECT SUM(total_price) AS total_major_proc FROM money_collection_temp  WHERE purchasing_class='surgical_op'";
$major_proc_result=$db->Execute($major_proc_query);
while($major_proc_rows=$major_proc_result->FetchRow()){
    if(isset($major_proc_rows['total_major_proc'])){
      $major_proc_total=$major_proc_rows['total_major_proc'];
     }else{
      $major_proc_total=0;
      }
}


//SUPPLIES
$supplies_query="SELECT SUM(total_price) AS total_supplies FROM money_collection_temp  WHERE purchasing_class='SUPPLIES'";
$supplies_result=$db->Execute($supplies_query);
while($supplies_rows=$supplies_result->FetchRow()){
if(isset($supplies_rows['total_supplies'])){
$supplies_total=$supplies_rows['total_supplies'];
}else{
$supplies_total=0;
}
}


$icu_query="SELECT SUM(total_price) AS total_icu FROM money_collection_temp WHERE item_description LIKE 'ICU%' AND purchasing_class='service'";
$icu_result=$db->Execute($icu_query);
while($icu_rows=$icu_result->FetchRow()){
if(isset($icu_rows['total_icu'])){
$icu_total=$icu_rows['total_icu'];
}else{
$icu_total=0;
}
}

//physiotherapy
$physio_query="SELECT SUM(total_price) AS total_physio FROM money_collection_temp  WHERE item_number='phy01' AND purchasing_class='service'";
$physio_result=$db->Execute($physio_query);
while($physio_rows=$physio_result->FetchRow()){
      if(isset($physio_rows['total_physio'])){
      $physio_total=$physio_rows['total_physio'];
      }else{
      $physio_total=0;
       }   
}







 ?>
 
 
 <form id="form2" name="form2" method="post" action="">
 <table width="605" border="1" >
 
 
 
  
  
  <tr valign="top" bgcolor="#CCCCCC"><td><b><font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#000000"> <?php echo  $payment.' INCOME:'; ?></font></b></td><td></td></tr>
  
 <tr valign="top" bgcolor="#CCCCCC"><td>Start Date:<?php echo $dfrom;?></td><td>End Date:<?php echo $dto;?></td></tr>
 
 <tr>
 
   <!--  <td width="174" bgcolor="#CCCCFF">DATE</td> -->
    <td width="224" bgcolor="#CCCCCC">Item Description </td>
    <td width="185" bgcolor="#CCCCCC">Sub-Total </td>
  </tr>
<?php




  
  	
/*
  echo '<tr><td width="224">REFERRAL</td><td width="185">'.number_format($total_referral,2).'</td></tr>';
  echo '<tr><td width="224">SELF REFERRAL</td><td width="185">'.number_format($total_self_referral,2).'</td></tr>';
  echo '<tr><td width="224">ADMISSION</td><td width="185">'.number_format($total_admission,2).'</td></tr>'; 
  echo '<tr><td width="224">PARTIAL PAYMENT 10000</td><td width="185">'.number_format($total_partial_10000,2).'</td></tr>';
  echo '<tr><td width="224">PARTIAL PAYMENT 12000</td><td width="185">'.number_format($total_partial_12000,2).'</td></tr>'; 
  echo '<tr><td width="224">PARTIAL PAYMENT 5000</td><td width="185">'.number_format($total_partial_5000,2).'</td></tr>'; 
  echo '<tr><td width="224">PARTIAL PAYMENT 3000</td><td width="185">'.number_format($total_partial_3000,2).'</td></tr>'; 
  echo '<tr><td width="224">FAST TRACK</td><td width="185">'.number_format($total_fast_track,2).'</td></tr>';
  echo '<tr><td width="224">FOREIGNER</td><td width="185">'.number_format($total_foreigner,2).'</td></tr>';
*/
echo '<tr><td width="224">CONSULTATION OPD SPECIALIST</td><td width="185">'.number_format($total_specialist,2).'</td></tr>';
echo '<tr><td width="224">CONSULTATION OPD GENERAL</td><td width="185">'.number_format($total_general,2).'</td></tr>';
echo '<tr><td width="224">CONSULTATION RCH </td><td width="185">'.number_format($total_RCH,2).'</td></tr>';
echo '<tr><td width="224">CONSULTATION IPD GENERAL</td><td width="185">'.number_format($total_general_ipd,2).'</td></tr>';
echo '<tr><td width="224">CONSULTATION IPD SPECIALIST</td><td width="185">'.number_format($total_specialist_ipd,2).'</td></tr>';
echo '<tr><td width="224">NURSING CARE</td><td width="185">'.number_format($total_nursingcare,2).'</td></tr>';
echo '<tr><td width="224">BABY CARE</td><td width="185">'.number_format($total_babycare,2).'</td></tr>';
echo '<tr><td width="224">LAST OFFICE</td><td width="185">'.number_format($total_lastoffice,2).'</td></tr>';
echo '<tr><td width="224">DRESSING</td><td width="185">'.number_format($total_dressing,2).'</td></tr>';
echo '<tr><td width="224">LABORATORY</td><td width="185">'.number_format($lab_total,2).'</td></tr>';
echo '<tr><td width="224">RADIOLOGY</td><td width="185">'.number_format($radio_total,2).'</td></tr>';
echo '<tr><td width="224">DRUGS</td><td width="185">'.number_format($drugs_total,2).'</td></tr>';  
echo '<tr><td width="224">DENTAL</td><td width="185">'.number_format($total_dental,2).'</td></tr>';
echo '<tr><td width="224">BED GENERAL</td><td width="185">'.number_format($total_bedgeneral,2).'</td></tr>';
echo '<tr><td width="224">BED PRIVATE</td><td width="185">'.number_format($total_bedprivate,2).'</td></tr>';
echo '<tr><td width="224">MAJOR PROCEDURE</td><td width="185">'.number_format($major_proc_total,2).'</td></tr>';
echo '<tr><td width="224">MINOR PROCEDURE</td><td width="185">'.number_format($minor_proc_total,2).'</td></tr>';
echo '<tr><td width="224">EYE SURGERY</td><td width="185">'.number_format($eyesurgery_total,2).'</td></tr>';
echo '<tr><td width="224">PHYSIOTHERAPY</td><td width="185">'.number_format( $physio_total,2).'</td></tr>'; 
echo '<tr><td width="224">SUPPLIES</td><td width="185">'.number_format($supplies_total,2).'</td></tr>';
  
//$c=$total_referral+$total_self_referral+$total_admission+$total_partial_10000+$total_partial_12000+$total_partial_5000+$total_partial_3000+$total_fast_track+$total_foreigner;
$c=$total_specialist+$total_general+$total_RCH+$total_general_ipd+$total_specialist_ipd;

$o=$lab_total+$radio_total+$total_nursingcare+$drugs_total+$total_dental+$total_bedgeneral+$total_bedprivate+$minor_proc_total+$major_proc_total+$eyesurgery_total+$physio_total+$supplies_total;

$g=$c+$o;










  ?>
  
 
   <table width="605" border="1" cellpadding="1" cellspacing="0" bordercolor="#999999">
        <tr>
          <td width="224" rowspan="2" bgcolor="#FFFF00" > 
            <b><font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#000000">Consultation:</font></b> <p>          
            <b><font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#000000"> 
          Other items/services: </font></b>          </td>
              <td width="185"  height="30" bgcolor="#FFFF00"> 
            <b> <font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#000000"><?php echo number_format($c,2); ?></font></b>          </td>
        </tr>
        <tr>
          <td width="185"  height="30" bgcolor="#FFFF00"> 
            <b> <font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#000000"><?php echo number_format($o,2); ?></font></b>          </td>
        </tr>
        <tr>
          <td bgcolor="#FFFF00" ><strong>Grand total TSH:</strong></td>
          <td  height="30" bgcolor="#FFFF00"><?php echo number_format($g,2); ?></td>
        </tr>
   </table> 
   <p>
</p>
   <p>
   </p>
  
  
  
 
   <table width="597" height="58" border="0">
     <tr>
       <td width="492">Prepared by CashierName:.................................................</td>
       <td width="95">&nbsp;</td>
     </tr>
	 <tr>
	 <td>
	 </td>
	 </tr>
     <tr>
       <td>Approved by:.......................................................................</td>
       <td>&nbsp;</td>
     </tr>
   </table>
   <p>&nbsp;   </p>
   <p>
     <input type="button" name="print" value="PRINT" onclick="window.print()" />
     
      </p>

 </form>






















