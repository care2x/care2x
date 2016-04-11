<?php
if ($PRINTOUT) {

echo '<head>
<script language="javascript"> this.window.print(); </script>
<title>'.$LDPharmacyReport.'</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>';
echo '<html><body>';
echo '<table width="500" border="1" cellspacing="0" cellpadding="0" align="center" ';
$rep_obj->DisplayPharmacyTableHead($category,$admission,$bill_type);
$rep_obj->DisplayPharmacyResultRows($start_timeframe, $end_timeframe, $category, $admission, $bill_type);
echo '</table>';
echo '</html></body>';
exit();
}
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
 <TITLE><?php echo $LDReportingModule; ?></TITLE>
 <meta name="Description" content="Hospital and Healthcare Integrated Information System - CARE2x">
 <meta name="Author" content="Robert Meggle">
 <meta name="Generator" content="various: Quanta, AceHTML 4 Freeware, NuSphere, PHP Coder">
 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

  	<script language="javascript" >
<!-- 
function gethelp(x,s,x1,x2,x3,x4)
{
	if (!x) x="";
	urlholder="../../main/help-router.php?sid=<?php echo sid;?>&lang=$lang&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3+"&x4="+x4;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
    function printOut(start_timeframe, end_timeframe, admission, bill_type)
    {
    	urlholder="./reporting_pharmacy.php?printout=TRUE&start_timeframe="+start_timeframe+"&end_timeframe="+end_timeframe+"&admission="+admission+"&bill_type="+bill_type;
    	testprintout=window.open(urlholder,"printout","width=800,height=600,menubar=no,resizable=yes,scrollbars=yes");
      	window.testprintout.moveTo(0,0);
    }
	
//-->
 <?php require($root_path.'include/inc_checkdate_lang.php'); ?>

</script> 

<script language="javascript" src="<?php echo $root_path; ?>js/setdatetime.js"></script>
<script language="javascript" src="<?php echo $root_path; ?>js/checkdate.js"></script>
<script language="javascript" src="<?php echo $root_path; ?>js/dtpick_care2x.js"></script>
<script src="<?php print $root_path; ?>/include/_jquery.js" language="javascript"></script> 

<link rel="stylesheet" href="../../css/themes/default/default.css" type="text/css">
<script language="javascript" src="../../js/hilitebu.js"></script>

<STYLE TYPE="text/css">
A:link  {color: #000066;}
A:hover {color: #cc0033;}
A:active {color: #cc0000;}
A:visited {color: #000066;}
A:visited:active {color: #cc0000;}
A:visited:hover {color: #cc0033;}
</style>
<script language="JavaScript">
<!--
function popPic(pid,nm){

 if(pid!="") regpicwindow = window.open("../../main/pop_reg_pic.php?sid=<?php echo sid;?>&lang=$lang&pid="+pid+"&nm="+nm,"regpicwin","toolbar=no,scrollbars,width=180,height=250");

}
// -->
</script>

 
</HEAD>

<BODY bgcolor=#ffffff link=#000066 alink=#cc0000 vlink=#000066  >

<!-- START HEAD OF HTML CONTENT -->
<table width=100% border=0 cellspacing=0 height=100%>
<tbody class="main">

	<tr>

		<td  valign="top" align="middle" height="35">
			 <table cellspacing="0"  class="titlebar" border=0>
 <tr valign=top  class="titlebar" >
  <td width="202" bgcolor="#99ccff" >
    &nbsp;&nbsp;<font color="#330066"><?php echo $LDReportingPharmacyReport; ?></font></td>
  <td width="408" align=right bgcolor="#99ccff">
   <a href="javascript: history.back();"><img src="../../gui/img/control/default/en/en_back2.gif" border=0 width="110" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)" ></a>
   <a href="javascript:gethelp('reporting_overview.php','Reporting :: Overview')"><img src="../../gui/img/control/default/en/en_hilfe-r.gif" border=0 width="75" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>
   <a href="<?php echo $root_path;?>modules/reporting_tz/reporting_main_menu.php" ><img src="../../gui/img/control/default/en/en_close2.gif" border=0 width="103" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>  
  </td>
 </tr>
 </table>	
 
<!-- END HEAD OF HTML CONTENT -->

						<form name="form1" method="post" action="">				
                          </p>
					<?php require_once($root_path.$top_dir.'include/inc_gui_timeframe_date.php'); ?>

			         

						  <br><br><br>
                                   
                    <?php echo '<b>'.$payment_type.'</b><br>';?>      
                   <?php  echo 'From:'.$_POST['date_from'].' '.'00:00:00 '.'To:'.$_POST['date_to'].' '.'23:59:59';?>  
                          <table width="500" border="1" cellspacing="0" cellpadding="0" align="center" bgcolor=#ffffdd>
                          <?php $rep_obj->DisplayPharmacyTableHead($category,$admission,$bill_type);?> 
<?
//start date manipulation
$dfrom=$_POST['date_from'];
$dto  =$_POST['date_to'];

if((!$dfrom) || (!$dto) ){
		  echo 'PLEASE SELECT DATE RANGE';
		  exit;
		  }
//change data to mysql format
$selected_date_start        =@formatDate2STD($dfrom,$date_format);
$selected_date_end          =@formatDate2STD($dto,$date_format);
//end of mysql format 

$f_date_start               =strtotime($selected_date_start);
$f_date_end                 =strtotime($selected_date_end);

$day_start = date("d",$f_date_start); 
$month_start = date("n",$f_date_start);
$year_start = date("Y",$f_date_start);
        
$day_end = date("d",$f_date_end); 
$month_end = date("n",$f_date_end);
$year_end = date("Y",$f_date_end);
        
             

	
$start_timeframe =  mktime (0,0,0,$month_start, $day_start, $year_start);
$end_timeframe   =  mktime (23,59,59,$month_end, $day_end, $year_end);
//end date manipulation

$bill_type=$_POST['paytype'];

switch($bill_type){
//case  "0"://cash and credit
 // $bill="AND b.insurance_id>=0";
  //break;
case  "0"://cash
  $bill="AND b.insurance_id=0";
  break;
case  "1"://credit
  $bill="AND b.insurance_id>0";
  break;
default:
$bill="AND b.insurance_id>=0";

}
//The lines below were edited by Israel Pascal to include subtores in the reports
$store=$_POST['stockloc'];
if($store=="all"){
$substore="";
}else{
$substore="AND b.sub_store='".$store."'";
}
$query_pharmacy="SELECT drp.partcode,drp.purchasing_class,b.description,b.price AS unit_price, SUM(b.amount) AS qty
FROM care_tz_billing_archive_elem b
INNER JOIN care_tz_drugsandservices drp ON b.item_number = drp.item_id
WHERE b.date_change BETWEEN $start_timeframe AND $end_timeframe $bill $substore AND (purchasing_class ='drug_list' OR purchasing_class='special_ctc_list' OR purchasing_class='special_others_list' OR purchasing_class ='drug_list_nhif' )
GROUP BY b.item_number";


//echo $query_pharmacy;

$result_pharmacy=$db->Execute($query_pharmacy);


$data=array();
while($rows=$result_pharmacy->FetchRow()){$data['dawa'][]=$rows;}

$count=count($data['dawa']);
$count1=$count-1;

$total_cost=0;

for($i=0; $i<=$count1; $i++){
$total_cost=$total_cost+$data['dawa'][$i]['unit_price']*$data['dawa'][$i]['qty'];

//USER READABLE PURCHASING CLASS
switch ($data['dawa'][$i]['purchasing_class']){
    case "drug_list":
      $class="GENERAL USE";
    break;
  
    case "special_ctc_list":
      $class="CTC DRUG";
    break;

    case "special_others_list":
      $class="OTHER DRUG";
    break;

    case "drug_list_nhif":
      $class="NHIF DRUG";
    break;
    
    default:
      $class="UNKNOWN";
    break; 
  
}

   
?>

<tr><td><?echo $data['dawa'][$i]['partcode'];?></td><td><?echo $data['dawa'][$i]['description'];?><b><?php echo $class;?></b></td><td><?php echo number_format($data['dawa'][$i]['unit_price'],2);?></td><td><?php echo $data['dawa'][$i]['qty'];?></td><td><?php echo number_format($data['dawa'][$i]['unit_price']*$data['dawa'][$i]['qty'],2);?></td></td></tr>
<?php
}
?>
<tr><td colspan="4"><b>TOTAL COST</b></td><td><b><?php echo number_format($total_cost,2); ?></b></td></tr>
    
                            

							<?php //$rep_obj->DisplayPharmacyResultRows($start_timeframe,$end_timeframe, $category, $admission,$bill_type);?>
                                                            

                          </table>
				</form>			  
						  <br><br><br>						  
<a href="javascript:printOut(<?php echo $start_timeframe.",".$end_timeframe.",".$admission.",".$bill_type;?>)"><img border=0 src=<?php echo $root_path;?>/gui/img/common/default/billing_print_out.gif></a><br>

<!-- START BOTTIOM OF HTML CONTENT --->
<table width="100%" border="0" cellspacing="0" cellpadding="1" bgcolor="#cfcfcf">
<tr>
	<td align="center">
  		<table width="100%" bgcolor="#ffffff" cellspacing=0 cellpadding=5>
   		<tr>
   			<td>
	    		<div class="copyright">
					<script language="JavaScript">
					<!-- Script Begin
					function openCreditsWindow() {
					
						urlholder="../../language/$lang/$lang_credits.php?lang=$lang";
						creditswin=window.open(urlholder,"creditswin","width=500,height=600,menubar=no,resizable=yes,scrollbars=yes");
					
					}
					//  Script End -->
					</script>

	
					 <a href="http://www.care2x.org" target=_new>CARE2X 2nd Generation pre-deployment 2.0.2</a> :: <a href="../../legal_gnu_gpl.htm" target=_new> License</a> ::
					 <a href=mailto:info@care2x.org>Contact</a>  :: <a href="../../language/en/en_privacy.htm" target="pp"> Our Privacy Policy </a> ::
					 <a href="../../docs/show_legal.php?lang=$lang" target="lgl"> Legal </a> ::
					 <a href="javascript:openCreditsWindow()"> Credits </a> ::.<br>

				</div>
    		</td>
   		<tr>
  		</table>
	</td>
	</tr>
</table>
<!-- START BOTTIOM OF HTML CONTENT --->

</body>
