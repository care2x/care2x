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
         <table border="1" cellspacing="0" cellpadding="0" align="center" bgcolor=#ffffdd>
          <tr> 
           <td><b>Date</td>
          <?php
          $sql_ward="SELECT name as WardName FROM tmp_ward WHERE is_temp_closed !='1' and status !='inactive' order by name ASC";
			  $db_ptr_ward = $db->Execute($sql_ward);
			  while($db_row_ward=$db_ptr_ward->FetchRow())
			  {
			  
          echo '<td><b>'.$db_row_ward['WardName'].'</td>';
			  }
          ?>

				<td><b>TOTAL</td>
          
          </tr>
		  
		  <?php 

		
		 	$first_day_of_req_month = date ("d",$start_timeframe);
			$last_day_of_req_month = date ("d",$end_timeframe-1);
			
			for ($day=$first_day_of_req_month; $day<=$last_day_of_req_month ; $day++) {
				$current_day = $rep_obj->_get_requested_day($start_timeframe, $day-1);
				
				$current_date = date("d/m/y",$rep_obj->_get_requested_day($start_timeframe, $day-1,FALSE));
		  
		  		if ($current_day > time()) {
					if (!$PRINTOUT)$bg_color="#ffffff";
					$italic_tag_open="<i>";
					$italic_tag_close="</i>";
				} else {
					if (!$PRINTOUT)$bg_color="#ffffaa";
					$italic_tag_open="";
					$italic_tag_close="";
				} // end of if ($current_day > time())

		  	  
		  	  echo '<tr><td>'.$italic_tag_open.$current_date.$italic_tag_close.'</td>';
		  	  $sql_ward="SELECT nr  FROM tmp_ward WHERE is_temp_closed !='1' and status !='inactive' order by name ASC";
			  $db_ptr_ward = $db->Execute($sql_ward); 
			  while($db_row_ward=$db_ptr_ward->FetchRow())
			  {
			  $ward_nr=$db_row_ward['nr'];
			  $sql_patients="SELECT count( * ) AS ward_total FROM tmp_table WHERE current_ward_nr='$ward_nr' AND date_format( discharge_date, '%d/%m/%y' ) ='$current_date'"; 
			  $db_ptr_patients = $db->Execute($sql_patients);
			  $db_row_patients=$db_ptr_patients->FetchRow();
	
			  $total_patients=$db_row_patients['ward_total'];
			  echo '<td>'.$italic_tag_open.$total_patients.$italic_tag_close.'</td>';
			  
			  $day_total_patients +=$total_patients;
			 
			  }
		  ?>
		  		<td><?php echo $italic_tag_open.$day_total_patients.$italic_tag_close; ?></td>
		  
		  <?php  $day_total_patients=0; ?>
		  </tr>
		  
		<?php }
		// echo "End time of the script:".date("G:i:s")."<br>";
		?>
		<tr> 
            <td width><b><?php echo $LDtotal; ?></td>
       <?php
             
		  	   $sql_ward_total="SELECT nr  FROM tmp_ward WHERE is_temp_closed !='1' and status !='inactive' order by name ASC";
			  $db_ptr_ward_total = $db->Execute($sql_ward_total);
			  $stdate=trim($startdate);
			  while($db_row_ward_total=$db_ptr_ward_total->FetchRow())
			  {
			  $ward_nr=$db_row_ward_total['nr'];
			  $sql_admission_total="SELECT count( * ) AS admission_total FROM tmp_table WHERE current_ward_nr='$ward_nr' AND date_format( discharge_date, '%y.%m.%d' ) >='$startdate' AND date_format( discharge_date, '%y.%m.%d' ) <='$enddate'"; 
			  
			  $db_ptr_admission_total = $db->Execute($sql_admission_total);
			  $db_row_admission_total=$db_ptr_admission_total->FetchRow();
			  $total_admission_ward=$db_row_admission_total['admission_total'];
			   
			  echo '<td>'.$total_admission_ward.'</td>';
			   
			  $total_admission +=$total_admission_ward;
			  }
			  ?>
				
				<td><?php echo $total_admission; ?></td>
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
 <meta name="Author" content="Moye Masenga">
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
		<DIV align="center">
			<h2><?php echo 'IPD Discharge Summary '; ?><?php echo date('F Y',$start);?></h1>
			<p><?php echo $LDCreationTime; ?><?php echo date("F j, Y, g:i a");?></p>
		</DIV>
        <table border="1" cellspacing="0" cellpadding="0" align="center" bgcolor=#ffffdd>
          <tr> 
           <td bgcolor="#ffffaa"><b>Date</td>
          <?php
          $sql_ward="SELECT name as WardName FROM tmp_ward WHERE  is_temp_closed !='1' and status !='inactive' order by name ASC";
	 
			  $db_ptr_ward = $db->Execute($sql_ward);
			  while($db_row_ward=$db_ptr_ward->FetchRow())
			  {
			  
         echo '<td  bgcolor="#ffffaa"><b>'.$db_row_ward['WardName'].'</td>';
			  }
          ?>

				<td bgcolor="#ffffaa"><b>TOTAL</td>
          </tr>
		  
		  <?php 
		  
		  
		  	$first_day_of_req_month = date ("d",$start_timeframe);
			$last_day_of_req_month = date ("d",$end_timeframe);
		
			for ($day=$first_day_of_req_month; $day<=$last_day_of_req_month ; $day++) {
				$current_day = $rep_obj->_get_requested_day($start_timeframe, $day-1);
				
				$current_date = date("d/m/y",$rep_obj->_get_requested_day($start_timeframe, $day-1,FALSE));
		  
		  		if ($current_day > time()) {
					if (!$PRINTOUT)$bg_color="#ffffff";
					$italic_tag_open="<i>";
					$italic_tag_close="</i>";
				} else {
					if (!$PRINTOUT)$bg_color="#ffffaa";
					$italic_tag_open="";
					$italic_tag_close="";
				} // end of if ($current_day > time())

		  	  echo '<tr><td  bgcolor="#ffffaa">'.$italic_tag_open.$current_date.$italic_tag_close.'</td>';
		  	   $sql_ward="SELECT nr  FROM tmp_ward WHERE is_temp_closed !='1'  and status !='inactive' order by name ASC";
			  $db_ptr_ward = $db->Execute($sql_ward);
			  while($db_row_ward=$db_ptr_ward->FetchRow())
			  {
			  $ward_nr=$db_row_ward['nr'];
			  $sql_patients="SELECT count( * ) AS ward_total FROM tmp_table WHERE current_ward_nr='$ward_nr' AND date_format( discharge_date, '%d/%m/%y' ) ='$current_date'";    
			  $db_ptr_patients = $db->Execute($sql_patients);
			  $db_row_patients=$db_ptr_patients->FetchRow();
			  
			  $total_patients=$db_row_patients['ward_total'];
			  echo '<td bgcolor="#ffeeaa">'.$italic_tag_open.$total_patients.$italic_tag_close.'</td>';
			  
			  $day_total_patients +=$total_patients;
			  
			  }
			 
		  ?>
		  			
		 		<td  bgcolor="#ffeeaa"><?php echo $italic_tag_open.$day_total_patients.$italic_tag_close; ?></td>
				
		  <?php  $day_total_patients=0; 
		  // $month_total_patients +=$total_patients;?>
		  </tr>
		     
		<?php }
		// echo "End time of the script:".date("G:i:s")."<br>";
		?>
		<tr> 
            <td bgcolor="#ffffaa"><b><?php echo $LDtotal; ?></td>
        <?php
             
		  	   $sql_ward_total="SELECT nr  FROM tmp_ward WHERE is_temp_closed !='1' and status !='inactive' order by name ASC";
			  $db_ptr_ward_total = $db->Execute($sql_ward_total);
			  $stdate=trim($startdate);
			  while($db_row_ward_total=$db_ptr_ward_total->FetchRow())
			  {
			  $ward_nr=$db_row_ward_total['nr'];
			  $sql_admission_total="SELECT count( * ) AS admission_total FROM tmp_table WHERE current_ward_nr='$ward_nr' AND date_format( discharge_date, '%y.%m.%d' ) >='$startdate' AND date_format( discharge_date, '%y.%m.%d' ) <='$enddate'"; 
			  
			  $db_ptr_admission_total = $db->Execute($sql_admission_total);
			  $db_row_admission_total=$db_ptr_admission_total->FetchRow();
			  $total_admission_ward=$db_row_admission_total['admission_total'];
			   
			  echo '<td bgcolor="#ffffaa" >'.$total_admission_ward.'</td>';
			   
			  $total_admission +=$total_admission_ward;
			  }
			  ?>
				
				<td bgcolor="#ffffaa" ><?php echo $total_admission; ?></td>
          </tr>  
        </table>
        <p>&nbsp; </p>
      
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