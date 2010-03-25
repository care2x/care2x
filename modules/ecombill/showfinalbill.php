<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* eComBill 1.0.04 for Care2002 beta 1.0.04 
* (2003-04-30)
* adapted from eComBill beta 0.2 
* developed by ecomscience.com http://www.ecomscience.com 
* GPL License
*/
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
$local_user='aufnahme_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');
require_once($root_path.'include/core/inc_date_format_functions.php');

$patqry="SELECT e.*,p.* FROM care_encounter AS e, care_person AS p WHERE e.encounter_nr=$patientno AND e.pid=p.pid";

$resultpatqry=$db->Execute($patqry);
if(is_object($resultpatqry)) $patient=$resultpatqry->FetchRow();
else $patient=array();

$finalqry="SELECT bill_amount,bill_outstanding FROM care_billing_bill WHERE bill_encounter_nr=$patientno ORDER BY bill_bill_no";
$resultfinalqry=$db->Execute($finalqry);
if(is_object($resultfinalqry)) $cntbill=$resultfinalqry->RecordCount();

$finshowqry="SELECT final_date,final_total_bill_amount,final_discount,final_total_receipt_amount,final_amount_due,final_amount_recieved FROM care_billing_final WHERE final_encounter_nr='$patientno'";
$finshowresult=$db->Execute($finshowqry);
if(is_object($finshowresult)) $final=$finshowresult->FetchRow();


$breakfile='patient_bill_links.php'.URL_APPEND.'&patientno='.$patientno.'&full_en='.$full_en;
    
?>
<?php html_rtl($lang); ?>
<head>
<?php echo setCharSet(); ?>
<title>Patient Name</title>
</head>
<body bgcolor="#FFFFFF" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0>
<table border="0" width="101%" bgcolor=#99ccff>
	<tr>
		<td width="101%"><font color="#330066" size="+2" face="Arial"><strong><?php echo $LDFinalBill; ?></strong></font></td>
	</tr>
</table>
<form name=confirmfrmfinal method="POST" action="postfinalbill.php">
	<p>&nbsp;</p>
	<div align="center">
		<center>
			<table border="1" width="585" height="233" bordercolor="#000000" style="border-style: solid">
				<tr>
					<td width="348" height="155" valign="top" bordercolor="#FFFFFF"> <b><?php echo $LDGeneralInfo; ?>:</b>
						<table border="0" width="721%" height="155" cellpadding="0">
							<tr>
								<td width="100%" height="19"><?php echo $LDPatientName; ?>: <?php echo $patient['title'].' '.$patient['name_first'].' '.$patient['name_last'];?></td>
							</tr>
							<tr>
								<td valign=top width="20%"> <?php echo $LDPatientAddress; ?>: <?php echo $patient['addr_str'].$patient['addr_str_nr'].'<br>'.$patient['addr_zip'].$patient['addr_citytown_nr'];?></td>
							</tr>
							<tr>
								<td width="100%" height="25"><?php echo $LDPatientType; ?>: <?php echo $patient['encounter_class_nr'];?></td>
							</tr>
							<tr>
								<td width="100%" height="25"><?php echo $LDDateofBirth; ?>: <?php echo formatDate2Local($patient['date_birth'],$date_format);?></td>
							</tr>
							<tr>
								<td width="100%" height="19"><?php echo $LDSex; ?> : <?php echo $patient['sex'];?></td>
							</tr>
							<tr>
								<td width="100%" height="12"><?php echo $LDPatientNumber; ?>:<?php echo $full_en;?></td>
							</tr>
						</table>
					</td>
					<td width="287" height="155" valign="top" bordercolor="#FFFFFF"> &nbsp;
						<table border="0" width="100%" height="150">
							<tr>
								<td width="100%" height="19"><?php echo $LDBillNo; ?>:<?php echo $finalbillno; ?></td>
							</tr>
							<tr>
								<td width="100%" height="19"><?php echo $LDBillDate; ?>:<?php echo formatDate2Local($final['final_date'],$date_format); ?></td>
							</tr>
							<tr>
								<td width="100%" height="19"><?php echo $LDDateofAdmission; ?>: <?php echo formatDate2Local($patient['encounter_date'],$date_format);?></td>
							</tr>
							<tr>
								<td width="100%" height="19"></td>
							</tr>
							<tr>
								<td width="100%" height="19"></td>
							</tr>
							<tr>
								<td width="100%" height="19"></td>
							</tr>
							<tr>
								<td width="100%" height="19"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="2" height="1" width="641" bordercolor="#FFFFFF">
						<p><b><?php echo $LDBillingInformation; ?>:</b></p>
					</td>
				</tr>
				<tr>
					<td height="107" width="414" bordercolor="#FFFFFF">
						<table border="0" width="107%" height="127">
							<tr>
								<td width="75%" valign="middle" align="left" height="18"><?php echo $LDTotal; ?></td>
								<td width="28%" valign="middle" align="right" height="18"><?php echo $final['final_total_bill_amount']; ?></td>
							</tr>
							<tr>
								<td width="75%" valign="middle" align="left" height="19" bordercolor="#FFFFFF"><?php echo $LDDiscountonTotalAmount; ?></td>
								<td width="28%" valign="middle" align="right" height="19"> <?php echo $final['final_discount']; ?> </td>
							</tr>
							<?php
					            $discamt=$final['final_discount'];
					            $tbamt=$final['final_total_bill_amount'];
					            $discamt=($discamt/100)*$tbamt;
					            $discamt=$tbamt-$discamt;            
				            ?>
							<tr>
								<td width="75%" valign="middle" align="left" height="18"><?php echo $LDAmountAfterDiscount; ?></td>
								<td width="28%" valign="middle" align="right" height="18"><?php echo $discamt; ?></td>
							</tr>
							<tr>
								<td width="75%" valign="middle" align="left" height="19"><?php echo $LDAmountPreviouslyReceived; ?></td>
								<td width="28%" valign="middle" align="right" height="19"><?php echo $final['final_total_receipt_amount']; ?></td>
							</tr>
							<tr>
								<td width="75%" valign="middle" align="left" height="19"><?php echo $LDAmountDue; ?></td>
								<td width="28%" valign="middle" align="right" height="19"><?php echo $final['final_amount_due']; ?></td>
							</tr>
							<tr>
								<td width="75%" valign="middle" align="left" height="19" bordercolor="#FFFFFF"><?php echo $LDCurrentPaidAmount;?></td>
								<td width="28%" valign="middle" align="right" height="19"> <?php echo $final['final_amount_recieved']; ?> </td>
								<input type="hidden" name="cleared" value="cleared">
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<input type="hidden" name="patientno" value=<?php echo $patientno; ?>>
			<input type="hidden" name="totalbill" value=<?php echo $totalbill; ?>>
			<input type="hidden" name="discount" value=<?php echo $discount; ?>>
			<input type="hidden" name="paidamt" value=<?php echo $paidamt; ?>>
			<input type="hidden" name="amtdue" value=<?php echo $amtdue; ?>>
			<input type="hidden" name="final_bill_no" value=<?php echo $final_bill_no; ?>>
			<p>&nbsp;</p>
			<a href="javascript:window.print();">
				<img <?php echo createLDImgSrc($root_path,'printout.gif','0'); ?> />
			</a>
			<a href="<?php echo $breakfile ?>">
				<img <?php echo createLDImgSrc($root_path,'close2.gif','0'); ?> />
			</a>
		</center>
	</div>
</form>
<?php
require($root_path.'include/core/inc_load_copyrite.php');
?>
</body>
</html>