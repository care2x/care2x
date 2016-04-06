<?php 
if ($printout) {
echo '<head>
<script language="javascript"> this.window.print(); </script>
<title>OPD Summary</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>';
echo '<html><body>';
?>
<DIV align="center">
	<h1><?php echo 'OPD Departments Admission Summary'; ?><?php echo date('F Y',$start);?></h1>
	<p><?php echo $LDCreationTime; ?><?php echo date("F j, Y, g:i a");?></p>
</DIV>
         <table width="644" border="1" cellspacing="0" cellpadding="0" align="center" bgcolor=#ffffdd>
          <tr> 
           <td width="79" bgcolor="#ffffaa" widtd="220"><b>Date</td>
          <?php
          $sql_dept="SELECT name_formal as DepartmentName FROM tmp_table3  WHERE admit_outpatient ='1' and type='1' and status !='hidden' order by name_short";
			  $db_ptr_dept = $db->Execute($sql_dept);
			  while($db_row_dept=$db_ptr_dept->FetchRow())
			  {
			  
          echo '<td width="79" bgcolor="#ffffaa" widtd="220"><b>'.$db_row_dept['DepartmentName'].'</td>';
			  }
          ?>
           <td width="79" bgcolor="#ffffaa" widtd="220"><b>Total</td>
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

		  	  
		  	  echo '<tr><td width="79" bgcolor="#ffffaa" widtd="220">'.$current_date.'</td>';
		  	  $sql_dept="SELECT nr  FROM tmp_table3  WHERE admit_outpatient ='1' and type='1' and status !='hidden' order by name_short";
			  $db_ptr_dept = $db->Execute($sql_dept);
			  while($db_row_dept=$db_ptr_dept->FetchRow())
			  {
			  $dept_nr=$db_row_dept['nr'];
			  $sql_patients="SELECT count( * ) AS dept_total FROM tmp_table WHERE current_dept_nr='$dept_nr' AND date_format( encounter_date, '%d/%m/%y' ) ='$current_date'";
			  $db_ptr_patients = $db->Execute($sql_patients);
			  $db_row_patients=$db_ptr_patients->FetchRow();
			  
			  $total_patients=$db_row_patients['dept_total'];
			  echo '<td width="79" bgcolor="#ffffaa" widtd="220">'.$total_patients.'</td>';
			  $day_total_patients +=$total_patients;
			  /*$sql_age5_14="SELECT count( * ) AS Total_age5_14 FROM $tmp_table2 WHERE (DATE_FORMAT( NOW( ) , '%Y' ) - DATE_FORMAT( date_birth, '%Y' ) ) >=5  AND (DATE_FORMAT( NOW( ) , '%Y' ) - DATE_FORMAT( date_birth, '%Y' ) ) <=14 AND date_format( date_reg, '%d.%m.%y' ) ='$date_person_reg'";
			  $db_ptr_age5_14 = $db->Execute($sql_age5_14);
  			  $sql_new="SELECT count( * ) AS NEW  FROM $tmp_table2 WHERE date_format( date_reg, '%d.%m.%y' ) ='$date_person_reg' ";
			  //$sql_new="SELECT count( * ) AS NEW  FROM care_person,care_encounter WHERE date_format( date_reg, '%d.%m.%y' ) ='$date_person_reg' and care_person.pid=care_encounter.pid and date_format( care_encounter.encounter_date, '%d.%m.%y' )=date_format( care_person.date_reg, '%d.%m.%y' )";
			  $db_ptr_new = $db->Execute($sql_new);
			  
			  $db_row_under_age=$db_ptr_under_age->FetchRow();
			  $db_row_age5_14=$db_ptr_age5_14->FetchRow();
			  $db_row_new=$db_ptr_new->FetchRow();
			  
			  $total_opd=$total_opd+$v['AMOUNT_ENCOUTERS'];
			  //$total_new=$total_new+$v['NEW'];
			  $total_new=$total_new+$db_row_new['NEW'];
			  $total_return=$total_opd-$total_new;
			  $total_underage=$total_underage+$db_row_under_age['Total_underage'];
			  $total_age5_14=$total_age5_14+$db_row_age5_14['Total_age5_14'];
			  $total_paediatrics= $total_underage+$total_age5_14;			  
			  */
			  }
		  ?>
		  <td width="79" bgcolor="#ffffaa" widtd="220"><?php echo $day_total_patients ?></td>
		  <?php  $day_total_patients=0; ?>
		  </tr>
		     <!-- <table width="644" border="1" cellspacing="0" cellpadding="0" align="center" bgcolor=#ffffdd>
         <tr> 
            <td width="79" bgcolor="#ffffaa" widtd="220"><?php echo $v['REGISTRATION_DATE']; ?></td>
           <td width="104" bgcolor="#ffffaa" widtd="32"><?php echo $v['AMOUNT_ENCOUTERS']; ?></td>
            <td width="51" bgcolor="#ffffaa" widtd="32"><?php echo $db_row_new['NEW'];//$v1['NEW']; ?></td>
            <td width="65" bgcolor="#ffffaa"><?php echo $v['AMOUNT_ENCOUTERS']-$db_row_new['NEW'] //echo $v['RET']; ?></td>
            <td width="100" bgcolor="#ffffaa" widtd="64"><?php echo $db_row_under_age['Total_underage']; ?></td>
            <td width="74" bgcolor="#ffffaa" widtd="64"><?php echo $db_row_age5_14['Total_age5_14']; ?></td>
            <td width="155" bgcolor="#ffffaa" widtd="64"><?php echo $db_row_under_age['Total_underage'] + $db_row_age5_14['Total_age5_14']; ?></td>
          </tr>-->
		  
		<?php }
		// echo "End time of the script:".date("G:i:s")."<br>";
		?>
		<tr> 
            <td width="79"  widtd="220"><b><?php echo $LDtotal; ?></td>
        <?php
             
		  	   $sql_dept_total="SELECT nr  FROM tmp_table3 WHERE admit_outpatient ='1' and type='1' and status !='hidden' order by name_short";
			  $db_ptr_dept_total = $db->Execute($sql_dept_total);
			  $stdate=trim($startdate);
			  while($db_row_dept_total=$db_ptr_dept_total->FetchRow())
			  {
			  $dept_nr_total=$db_row_dept_total['nr'];
			  $sql_patients_total="SELECT count( * ) AS dept_total FROM tmp_table WHERE current_dept_nr='$dept_nr_total' AND date_format( encounter_date, '%y.%m.%d' ) >='$startdate' AND date_format( encounter_date, '%y.%m.%d' ) <='$enddate'";
			  
			  $db_ptr_patients_total = $db->Execute($sql_patients_total);
			  $db_row_patients_total=$db_ptr_patients_total->FetchRow();
			  
			  $total_patients_total=$db_row_patients_total['dept_total'];
			  echo '<td width="79" bgcolor="#ffffaa" widtd="220">'.$total_patients_total.'</td>';
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
    	urlholder="./OPD_Department_Admissions.php?printout=TRUE&start=<?php echo $start;?>&end=<?php echo $end;?>" ;
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
          <td width="202" bgcolor="#99ccff" > &nbsp;&nbsp;<font color="#330066"><?php echo 'OPD Department Admission Summary'; ?></font></td>
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
          <br>
        </p>
        <table width="644" border="1" cellspacing="0" cellpadding="0" align="center" bgcolor=#ffffdd>
		<DIV align="center">
			<h2><?php echo 'OPD Departments Admission Summary '; ?><?php echo date('F Y',$start);?></h1>
			<p><?php echo $LDCreationTime; ?><?php echo date("F j, Y, g:i a");?></p>
		</DIV>
          <tr> 
           <td width="79" bgcolor="#ffffaa" widtd="220"><b>Date</td>
          <?php
          $sql_dept="SELECT name_formal as DepartmentName FROM tmp_table3 WHERE admit_outpatient ='1' and type='1' and status !='hidden' order by name_short ASC";
			  $db_ptr_dept = $db->Execute($sql_dept);  
			  while($db_row_dept=$db_ptr_dept->FetchRow())
			  {
			  
          echo '<td width="79" bgcolor="#ffffaa" widtd="220"><b>'.$db_row_dept['DepartmentName'].'</td>';
			  }
          ?>
           <td width="79" bgcolor="#ffffaa" widtd="220"><b>Total</td>
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

		  	  
		  	  echo '<tr><td width="79" bgcolor="#ffffaa" widtd="220">'.$current_date.'</td>';
		  	   $sql_dept="SELECT nr  FROM tmp_table3 WHERE admit_outpatient=1 and type=1 and status !='hidden' order by name_short";
			  $db_ptr_dept = $db->Execute($sql_dept);
			  while($db_row_dept=$db_ptr_dept->FetchRow())
			  {
			  $dept_nr=$db_row_dept['nr'];
			  $sql_patients="SELECT count( * ) AS dept_total FROM tmp_table WHERE current_dept_nr='$dept_nr' AND date_format( encounter_date, '%d/%m/%y' ) ='$current_date'"; 
			  $db_ptr_patients = $db->Execute($sql_patients);
			  $db_row_patients=$db_ptr_patients->FetchRow();
			  
			  $total_patients=$db_row_patients['dept_total'];
			  echo '<td width="79" bgcolor="#ffffaa" widtd="220">'.$total_patients.'</td>';
			  $day_total_patients +=$total_patients;
			  /*$sql_age5_14="SELECT count( * ) AS Total_age5_14 FROM $tmp_table2 WHERE (DATE_FORMAT( NOW( ) , '%Y' ) - DATE_FORMAT( date_birth, '%Y' ) ) >=5  AND (DATE_FORMAT( NOW( ) , '%Y' ) - DATE_FORMAT( date_birth, '%Y' ) ) <=14 AND date_format( date_reg, '%d.%m.%y' ) ='$date_person_reg'";
			  $db_ptr_age5_14 = $db->Execute($sql_age5_14);
  			  $sql_new="SELECT count( * ) AS NEW  FROM $tmp_table2 WHERE date_format( date_reg, '%d.%m.%y' ) ='$date_person_reg' ";
			  //$sql_new="SELECT count( * ) AS NEW  FROM care_person,care_encounter WHERE date_format( date_reg, '%d.%m.%y' ) ='$date_person_reg' and care_person.pid=care_encounter.pid and date_format( care_encounter.encounter_date, '%d.%m.%y' )=date_format( care_person.date_reg, '%d.%m.%y' )";
			  $db_ptr_new = $db->Execute($sql_new);
			  
			  $db_row_under_age=$db_ptr_under_age->FetchRow();
			  $db_row_age5_14=$db_ptr_age5_14->FetchRow();
			  $db_row_new=$db_ptr_new->FetchRow();
			  
			  $total_opd=$total_opd+$v['AMOUNT_ENCOUTERS'];
			  //$total_new=$total_new+$v['NEW'];
			  $total_new=$total_new+$db_row_new['NEW'];
			  $total_return=$total_opd-$total_new;
			  $total_underage=$total_underage+$db_row_under_age['Total_underage'];
			  $total_age5_14=$total_age5_14+$db_row_age5_14['Total_age5_14'];
			  $total_paediatrics= $total_underage+$total_age5_14;			  
			  */
			  }
			 
		  ?>
		  <td width="79" bgcolor="#ffffaa" widtd="220"><?php echo $day_total_patients ?></td>
		  
		  <?php  $day_total_patients=0; 
		  // $month_total_patients +=$total_patients;?>
		  </tr>
		     
         <!--<tr> 
           <td width="79" bgcolor="#ffffaa" widtd="220"><b>Total</td>
            
             <!--<td width="51" bgcolor="#ffffaa" widtd="32"><?php echo $db_row_new['NEW'];//$v1['NEW']; ?></td>
            <td width="65" bgcolor="#ffffaa"><?php echo $v['AMOUNT_ENCOUTERS']-$db_row_new['NEW'] //echo $v['RET']; ?></td>
            <td width="100" bgcolor="#ffffaa" widtd="64"><?php echo $db_row_under_age['Total_underage']; ?></td>
            <td width="74" bgcolor="#ffffaa" widtd="64"><?php echo $db_row_age5_14['Total_age5_14']; ?></td>
            <td width="155" bgcolor="#ffffaa" widtd="64"><?php echo $db_row_under_age['Total_underage'] + $db_row_age5_14['Total_age5_14']; ?></td>
          
          </tr>
		  -->
		<?php }
		// echo "End time of the script:".date("G:i:s")."<br>";
		?>
		<tr> 
            <td width="79" bgcolor="#ffffaa" widtd="220"><b><?php echo $LDtotal; ?></td>
        <?php
             
		  	   $sql_dept_total="SELECT nr  FROM tmp_table3 WHERE admit_outpatient =1 and type=1 and status !='hidden' order by name_short";
			  $db_ptr_dept_total = $db->Execute($sql_dept_total);
			  $stdate=trim($startdate);
			  while($db_row_dept_total=$db_ptr_dept_total->FetchRow())
			  {
			  $dept_nr_total=$db_row_dept_total['nr'];
			  $sql_patients_total="SELECT count( * ) AS dept_total FROM tmp_table WHERE current_dept_nr='$dept_nr_total' AND date_format( encounter_date, '%y.%m.%d' ) >='$startdate' AND date_format( encounter_date, '%y.%m.%d' ) <='$enddate'";
			  
			  $db_ptr_patients_total = $db->Execute($sql_patients_total);
			  $db_row_patients_total=$db_ptr_patients_total->FetchRow();
			  
			  $total_patients_total=$db_row_patients_total['dept_total'];
			  echo '<td width="79" bgcolor="#ffffaa" widtd="220">'.$total_patients_total.'</td>';
			  $day_total_patients_total +=$total_patients_total;
			  }
			  ?>
            
            <td width="104" bgcolor="#ffffaa" widtd="32"><?php echo  $day_total_patients_total; ?></td>
            
        <!--    <td width="104" bgcolor="#ffffaa" widtd="32"><?php echo $total_opd;?></td>
            <td width="51" bgcolor="#ffffaa" widtd="32"><?php echo $total_new;?></td>
            <td width="65" bgcolor="#ffffaa"><?php echo $total_return;?></td>
            <td width="100" bgcolor="#ffffaa" widtd="64"><?php echo $total_underage ?></td>
            <td width="74" bgcolor="#ffffaa" widtd="64"><?php echo $total_age5_14 ?></td>
            <td width="155" bgcolor="#ffffaa" widtd="64"> <?php echo $total_paediatrics ?></td>
          -->
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