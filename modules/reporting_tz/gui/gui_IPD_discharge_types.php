<?php 
if ($printout) {
echo '<head>
<script language="javascript"> this.window.print(); </script>
<title>IPD Discharge Summary</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>';
echo '<html><body>';
?>
<DIV align="center">
	<h1><?php echo 'IPD Discharge Summary'; ?><?php echo date('F Y',$start);?></h1>
	<p><?php echo $LDCreationTime; ?><?php echo date("F j, Y, g:i a");?></p>
</DIV>
         <table width="100%" border="1" cellspacing="0" cellpadding="0" align="center" bgcolor=#ffffdd>
          <tr> 
           <td  bgcolor="#ffffaa"><b>Date</td>
          <?php
          $sql_disch="SELECT name as DischType FROM $tmp_disch";
			  $db_ptr_disch = $db->Execute($sql_disch);
			  while($db_row_disch=$db_ptr_disch->FetchRow())
			  {
			  
          echo '<td bgcolor="#ffffaa"><b>'.$db_row_disch['DischType'].'</td>';
			  }
          ?>
           <td  bgcolor="#ffffaa" widtd="220"><b>Total</td>
          </tr>
		  
		  <?php 

		// echo "Start time of the script:".date("G:i:s")."<br>";
		 //echo "Looking for test $TestID by time range: day: ".date("d.m.y", $start_timeframe)." starttime: ".date("d.m.y :: G:i:s",$start_timeframe)." endtime: ".date("d.m.y :: G:i:s", $end_timeframe)."<br>";
			
		  if ($debug) echo "elements in the array: ".sizeof($res_array)."<br>";
		  $db->Execute("SET @@max_heap_table_size=4294967296");
		  while(list($u,$v)=each($res_array) )
		  {
		  
		  	  $date_person_reg = $v['DISCHARGE_DATE'];
		  	  
		  	  echo '<tr><td  bgcolor="#ffffaa" widtd="220">'.$v['DISCHARGE_DATE'].'</td>';
		  	  $sql_ward="SELECT nr FROM $tmp_disch ";
			  $db_ptr_disch = $db->Execute($sql_disch);
			  while($db_row_disch=$db_ptr_disch->FetchRow())
			  {
			  $disch_nr=$db_row_disch['nr'];
			  $sql_patients="SELECT count( * ) AS ward_total FROM $tmp_table WHERE discharge_type='$disch_nr' AND date_format( discharge_date, '%d.%m.%y' ) ='$start' ";
			  $db_ptr_patients = $db->Execute($sql_patients);
			  $db_row_patients=$db_ptr_patients->FetchRow();
			  
			  $total_patients=$db_row_patients['ward_total'];
			  echo '<td  bgcolor="#ffffaa" widtd="220">'.$total_patients.'</td>';
			  $day_total_patients +=$total_patients;
			  
			  }
		  ?>
		  <td  bgcolor="#ffffaa" widtd="220"><?php echo $day_total_patients ?></td>
		  <?php  $day_total_patients=0; ?>
		  </tr>
		     
		  
		<?php }
		// echo "End time of the script:".date("G:i:s")."<br>";
		?>
		<tr> 
            <td  bgcolor="#ffffaa" widtd="220"><b><?php echo $LDtotal; ?></td>
        <?php
             
		  	  $sql_disch_total="SELECT nr  FROM $tmp_disch";
			  $db_ptr_disch_total = $db->Execute($sql_disch_total);
			  $stdate=trim($startdate);
			  while($db_row_disch_total=$db_ptr_disch_total->FetchRow())
			  {
			  $disch_nr_total=$db_row_disch_total['nr'];
			  $sql_patients_total="SELECT count( * ) AS ward_total FROM $tmp_table WHERE discharge_type='$disch_nr_total' AND date_format( discharge_date, '%y.%m.%d' ) >='$startdate' AND date_format( discharge_date, '%y.%m.%d' ) <='$enddate'";
			  
			  $db_ptr_patients_total = $db->Execute($sql_patients_total);
			  $db_row_patients_total=$db_ptr_patients_total->FetchRow();
			  
			  $total_patients_total=$db_row_patients_total['ward_total'];
			  echo '<td  bgcolor="#ffffaa" widtd="220">'.$total_patients_total.'</td>';
			  $day_total_patients_total +=$total_patients_total;
			  }
			  ?>
            
            <td width="104" bgcolor="#ffffaa" widtd="32"><?php echo  $day_total_patients_total; ?></td>
            </tr>
        </table>
                        
<?php
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
	function printOut()
    {
    	urlholder="./IPD_discharge.php?printout=TRUE&start=<?php echo $start;?>&end=<?php echo $end;?>" ;
    	testprintout=window.open(urlholder,"printout","width=800,height=600,menubar=no,resizable=yes,scrollbars=yes");
      	window.testprintout.moveTo(0,0);
    }

// -->

</script> 
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
          <td width="202" bgcolor="#99ccff" > &nbsp;&nbsp;<font color="#330066"><?php echo 'IPD Discharge Summary'; ?></font></td>
  <td width="408" align=right bgcolor="#99ccff">
   <a href="javascript: history.back();"><img src="../../gui/img/control/default/en/en_back2.gif" border=0 width="110" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)" ></a>
   <a href="javascript:gethelp('reporting_overview.php','Reporting :: Overview')"><img src="../../gui/img/control/default/en/en_hilfe-r.gif" border=0 width="75" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>
   <a href="<?php echo $root_path;?>modules/reporting_tz/reporting_main_menu.php" ><img src="../../gui/img/control/default/en/en_close2.gif" border=0 width="103" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>  
  </td>
 </tr>
 </table>	
 
<!-- END HEAD OF HTML CONTENT -->

<form name="form1" method="post" action=""></p>
        <?php require_once($root_path.$top_dir.'include/inc_gui_timeframe.php'); ?>
        <p><br>
          
          <br>
        </p>
        <table width="100%" border="1" cellspacing="0" cellpadding="0" align="center" bgcolor=#ffffdd>
          <tr> 
           <td bgcolor="#ffffaa"><b>Date</td>
          <?php
          $sql_disch="SELECT name as DischType FROM $tmp_disch";
		 
			  $db_ptr_disch = $db->Execute($sql_disch);
			  while($db_row_disch=$db_ptr_disch->FetchRow())
			  {
			  
          echo '<td bgcolor="#ffffaa"><b>'.$db_row_disch['DischType'].'</td>';
			  }
          ?>
		  
		  		<td   bgcolor="#ffffaa" widtd="220"><b>Total<b></td>
          
          </tr>
		  
		  <?php 
			
		  if ($debug) echo "elements in the array: ".sizeof($res_array)."<br>";
		  $db->Execute("SET @@max_heap_table_size=4294967296");
		  while(list($u,$v)=each($res_array) )
		  {
		  	  
		  	  $date_discharge = date_format($v['DISCHARGE_DATE'],'%d.%m.%y');
		  	  
		  	  echo '<tr><td  bgcolor="#ffffaa" widtd="220">'.$v['DISCHARGE_DATE'].'</td>';
		  	  $sql_disch="SELECT nr  FROM $tmp_disch";
			  $db_ptr_disch = $db->Execute($sql_disch);
			  while($db_row_disch=$db_ptr_disch->FetchRow())
			  {
			  $disch_id=$db_row_disch['nr'];
			  $sql_patients="SELECT count( * ) AS ward_total FROM $tmp_table WHERE discharge_type='$disch_id' AND date_format( discharge_date, '%d.%m.%y' ) >='$date_discharge' AND date_format( discharge_date, '%d.%m.%y' ) <='$date_discharge'";
			  $db_ptr_patients = $db->Execute($sql_patients);
			  $db_row_patients=$db_ptr_patients->FetchRow();
			  
			  $total_patients=$db_row_patients['ward_total'];
			  echo '<td  bgcolor="#ffffaa" widtd="220">'.$total_patients.'</td>';
			  $day_total_patients +=$total_patients;
			  
			  }
			 
		  ?>
		  <td   bgcolor="#ffffaa" widtd="220"><?php echo $day_total_patients ?></td>
		  
		  <?php  $day_total_patients=0; 
		  // $month_total_patients +=$total_patients;?>
		  </tr>
		  
		<?php }
		// echo "End time of the script:".date("G:i:s")."<br>";
		?>
		<tr> 
            <td  bgcolor="#ffffaa" widtd="220"><b><?php echo $LDtotal; ?></td>
        <?php
             
		  	  $sql_disch_total="SELECT nr  FROM $tmp_disch";
			  $db_ptr_disch_total = $db->Execute($sql_disch_total);
			  $stdate=trim($startdate);
			  while($db_row_disch_total=$db_ptr_disch_total->FetchRow())
			  {
			  $disch_nr_total=$db_row_disch_total['nr'];
			  
			  $sql_discharge_total="SELECT count( * ) AS discharge_total FROM $tmp_table WHERE discharge_type='$disch_nr_total' AND date_format( discharge_date, '%y.%m.%d' ) >='$startdate' AND date_format( discharge_date, '%y.%m.%d' ) <='$enddate'";

			 
			  $db_ptr_discharge_total = $db->Execute($sql_discharge_total);
			  $db_row_discharge_total=$db_ptr_discharge_total->FetchRow();
			  $total_discharge_patients=$db_row_discharge_total['discharge_total'];
			  
			  echo '<td  bgcolor="#ffffaa" widtd="220">'.$total_discharge_patients.'</td>';

			   
			  $day_total_patients_total +=$total_discharge_patients;
			  }
			  ?>
			  
			  <td   bgcolor="#ffffaa" widtd="220"><?php echo $day_total_patients_total ?></td>
            
          </tr>  
        </table>
        <p>&nbsp; </p>
       <!-- <table width="500" border="1" cellspacing="0" cellpadding="0" align="center" bgcolor=#ffffdd>
                            <tr>
                              <td widtd="220" bgcolor="#ffffaa"><?php echo $LDOPDVisits; ?></td>
                              <td widtd="32" bgcolor="#ffffaa">&lt; 5 </td>
                              <td widtd="32" bgcolor="#ffffaa">&gt; 5 </td>
                              <td colspan="2" bgcolor="#ffffaa"><?php echo $LDsex; ?></td>
                              <td widtd="64" bgcolor="#ffffaa"><?php echo $LDtotal; ?></td>
                            </tr>
                            <tr>
                              <td bgcolor="#ffffaa"><b><?php echo $LDRETURN; ?></b></td>
                              <td><?php echo $arr_ret['return']['underage'];?></td>
                              <td><?php echo $arr_ret['return']['adult'];?></td>
                              <td width="69"><?php echo $arr_ret['return']['male'];?></td>
                              <td width="69"><?php echo $arr_ret['return']['female'];?></td>
                              <td><?php echo $arr_ret['return']['total'];?></td>
                            </tr>
                            <tr>
                              <td bgcolor="#ffffaa"><b><?php echo $LDNewRegistrations; ?></b> </td>
                              <td><?php echo $arr_ret['NewRegistration']['underage'];?></td>
                              <td><?php echo $arr_ret['NewRegistration']['adult'];?></td>
                              <td><?php echo $arr_ret['NewRegistration']['male'];?></td>
                              <td><?php echo $arr_ret['NewRegistration']['female'];?></td>
                              <td><?php echo $arr_ret['NewRegistration']['total'];?></td>
                            </tr>
                            <tr>
                              <td bgcolor="#ffffaa"><b><?php echo $LDViewsforthesameReason; ?></b> </td>
                              <td><?php echo $arr_ret['revisit']['underage'];?></td>
                              <td><?php echo $arr_ret['revisit']['adult'];?></td>
                              <td><?php echo $arr_ret['revisit']['male'];?></td>
                              <td><?php echo $arr_ret['revisit']['female'];?></td>
                              <td><?php echo $arr_ret['revisit']['total'];?></td>
                            </tr>							
                            <tr>
                              <td bgcolor="#ffffaa"><b><?php echo $LDtotal; ?></b></td>
                              <td><b><?php echo $arr_ret['Total']['underage'];?></b></td>
                              <td><b><?php echo $arr_ret['Total']['adult'];?></b></td>
                              <td><b><?php echo $arr_ret['Total']['male'];?></b></td>
                              <td><b><?php echo $arr_ret['Total']['female'];?></b></td>
                              <td><b><?php echo $arr_ret['Total']['total'];?></b></td>
                            </tr>							
                            <tr>
                              <td bgcolor="#ffffaa">&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td colspan="2">&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td bgcolor="#ffffaa"><b><?php echo $LDTotalPediatrics; ?></b></td>
                              <td><?php echo $arr_ret['Total_Pedriatics']['underage'];?></td>
                              <td>&nbsp;</td>
                              <td colspan="2">&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>

                          </table>-->
				</form>			  
						<a href="javascript:printOut()"><img border=0 src=<?php echo $root_path;?>/gui/img/common/default/billing_print_out.gif></a><br>									  
						  <br><br><br>  <br><br><br>						  


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
