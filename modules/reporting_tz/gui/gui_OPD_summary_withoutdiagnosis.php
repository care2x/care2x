<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
 <TITLE> <?php echo $LDReportingModule; ?> </TITLE>
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
    	urlholder="./OPD_Admissions.php?printout=TRUE&start=<?php echo $start;?>&end=<?php echo $end;?>" ;
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


function getinfo(pn){
<?php /* if($edit)*/
	{ echo '
	urlholder="'.$root_path.'modules/nursing/nursing-station-patientdaten.php'.URL_REDIRECT_APPEND;
	echo '&pn=" + pn + "';
	echo "&pday=$pday&pmonth=$pmonth&pyear=$pyear&edit=$edit&station=$station"; 
	echo '";';
	echo '
	patientwin=window.open(urlholder,pn,"width=700,height=600,menubar=no,resizable=yes,scrollbars=yes");
	
	patientwin.moveTo(0,0)
	patientwin.resizeTo(screen.availWidth,screen.availHeight)';
	}
	/*else echo '
	window.location.href=\'nursing-station-pass.php'.URL_APPEND.'&rt=pflege&edit=1&station='.$station.'\'';*/
?>
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
          <td width="202" bgcolor="#99ccff" > &nbsp;&nbsp;<font color="#330066"><?php echo $LDReportingOPDSummary; ?> - <?php echo $LDPatientsWithoutDiagnosis; ?></font></td>
  <td width="408" align=right bgcolor="#99ccff">
   <a href="javascript: history.back();"><img src="../../gui/img/control/default/en/en_back2.gif" border=0 width="110" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)" ></a>
   <a href="javascript:gethelp('reporting_overview.php','Reporting :: Overview')"><img src="../../gui/img/control/default/en/en_hilfe-r.gif" border=0 width="75" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>
   <a href="<?php echo $root_path;?>modules/reporting_tz/reporting_main_menu.php" ><img src="../../gui/img/control/default/en/en_close2.gif" border=0 width="103" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>  
  </td>
 </tr>
 </table>	
 
<!-- END HEAD OF HTML CONTENT -->

<form name="form1" method="post" action=""></p>
        <?php // require_once($root_path.$top_dir.'include/inc_gui_timeframe.php'); ?>
        <p><br>
          <br>
          <br>
        </p>
          <table width="644" border="1" cellspacing="0" cellpadding="0" align="center" bgcolor=#ffffdd>
          <tr> 
            <td width="124" bgcolor="#ffffaa" ><b><?php echo $LDName; ?></td>
            <td width="79" bgcolor="#ffffaa" ><b><?php echo $LDBday; ?></td>
            <td width="51" bgcolor="#ffffaa" ><b><?php echo $LDFileNr; ?></td>
			<td width="51" bgcolor="#ffffaa" ><b><?php echo $LDOptions; ?></td>
			            
          </tr>
		  </table>
		  <?php 

		

		
		 
		 
		// echo "Start time of the script:".date("G:i:s")."<br>";
		 //echo "Looking for test $TestID by time range: day: ".date("d.m.y", $start_timeframe)." starttime: ".date("d.m.y :: G:i:s",$start_timeframe)." endtime: ".date("d.m.y :: G:i:s", $end_timeframe)."<br>";
			
		 // if ($debug) echo "elements in the array: ".sizeof($res_array)."<br>";
		  //$db->Execute("SET @@max_heap_table_size=4294967296");
		  while(list($u,$v)=each($res_array) )
		  {
		  $pid=$v['PID'];
		  $enr=$v['ENR'];
		
			 $sql_no_per = "SELECT * FROM care_person WHERE pid='$pid'  ";			  
			 $db_ptr_no_per = $db->Execute($sql_no_per);
			 $db_row_no_per = $db_ptr_no_per->FetchRow();
			 $data[]=array("name" => $db_row_no_per['name_last'] .'  '.$db_row_no_per['name_first'],"datebirth" => $db_row_no_per['date_birth'],"hospital_nr" => $db_row_no_per['selian_pid'],"enr" => $enr);
			 $names[]=array($db_row_no_per['name_last'] .'  '.$db_row_no_per['name_first']);
			 $datebirth[]=array($db_row_no_per['date_birth']);
			 $hospital_nr[]=array($db_row_no_per['selian_pid']);
			 $e_nr[]=array($enr);
			 //$total=$db_row_no['return_underage'];
			 
		  ?>
		  <!--  <table width="644" border="1" cellspacing="0" cellpadding="0" align="center" bgcolor=#ffffdd>
          <tr> 
            <td width="124" bgcolor="#ffffaa" ><?php echo $db_row_no_per['name_last'] .'  '.$db_row_no_per['name_first']; ?></td>
            <td width="79" bgcolor="#ffffaa" ><?php echo $db_row_no_per['date_birth']; ?></td>
            <td width="51" bgcolor="#ffffaa" ><?php echo $db_row_no_per['selian_pid']; ?></td>
			 <td width="51" bgcolor="#ffffaa" ><a href="javascript:getinfo(<?PHP echo $enr;?>)"><img src="../../gui/img/common/default/open.gif" border=0 width="20" height="20" alt="Open patient's charts folder"></a></td>
          </tr>-->
		  
		<?php
		 }
		 
		 //array_multisort($names,SORT_ASC,$hospital_nr,SORT_DESC,$e_nr,SORT_ASC,$datebirth,SORT_ASC);
		 
				 
			//foreach ($data as $key => $value) 
    		//{
    			// $name[$key]  = $value['name']."</br>";
    				//$edition[$key] = $row['edition'];
    				
    	//	} 
    		//	array_multisort("name",SORT_ASC,"hospital_nr",SORT_DESC,$enr,SORT_ASC,$datebirth,SORT_ASC,$data); 
			 //
			 //echo count($names);
			 sort($data);
			for($i=0;$i<count($names);$i++)
			{
				?>
			<table width="644" border="1" cellspacing="0" cellpadding="0" align="center" bgcolor=#ffffdd>
			<tr>
            <td width="124" bgcolor="#ffffaa" ><?php echo $data[$i]["name"]?></td>
            <td width="79"  bgcolor="#ffffaa" ><?php echo $data[$i]["datebirth"]?></td>
            <td width="51" bgcolor="#ffffaa" ><?php echo $data[$i]["hospital_nr"]?></td>
	        <td width="51" bgcolor="#ffffaa" ><a href="javascript:getinfo(<?PHP echo $data[$i]["enr"];?>)"><img src="../../gui/img/common/default/open.gif" border=0 width="20" height="20" alt="Open patient's charts folder"></a></td>    
          	</tr>
				
				
			<?php 
			//echo $data[$i]["name"]."</br>";
			}
			
			?>
        </table>
		<br>
		<?php 
		
		// echo "End time of the script:".date("G:i:s")."<br>";
		
		
		 $maxPage = ceil($numrows/$rowsPerPage); 

// print the link to access each page 
$self = $_SERVER['PHP_SELF']; 
$nav = ''; 
for($page = 1; $page <= $maxPage; $page++) 
{ 
    if ($page == $pageNum) 
    { 
        $nav .= " $page ";   // no need to create a link to current page 
    } 
    else 
    { 
        $nav .= " <a href=\"$self?page=$page\">$page</a> "; 
    }         
} 

// creating previous and next link 
// plus the link to go straight to 
// the first and last page 

if ($pageNum > 1) 
{ 
    $page = $pageNum - 1; 
    $prev = " <a href=\"$self?page=$page\">[".$LDPrev."]</a> "; 
     
    $first = " <a href=\"$self?page=1\">[".$LDFirstPage."]</a> "; 
}  
else 
{ 
    $prev  = '&nbsp;'; // we're on page one, don't print previous link 
    $first = '&nbsp;'; // nor the first page link 
} 

if ($pageNum < $maxPage) 
{ 
    $page = $pageNum + 1; 
    $next = " <a href=\"$self?page=$page\">[".$LDNext."]</a> "; 
     
    $last = " <a href=\"$self?page=$maxPage\">[".$LDLastPage."]</a> "; 
}  
else 
{ 
    $next = '&nbsp;'; // we're on the last page, don't print next link 
    $last = '&nbsp;'; // nor the last page link 
} 

// print the navigation link 
 

		?>
		<?php echo $first . $prev  . $next . $last; ?>
        <p>&nbsp; </p>
       <!-- <table width="500" border="1" cellspacing="0" cellpadding="0" align="center" bgcolor=#ffffdd>
                            <tr>
                              <td widtd="220" bgcolor="#ffffaa"><?php echo $LDOPDVisits; ?>  </td>
                              <td widtd="32" bgcolor="#ffffaa">&lt; 5 </td>
                              <td widtd="32" bgcolor="#ffffaa">&gt; 5 </td>
                              <td colspan="2" bgcolor="#ffffaa"><?php echo $LDsex; ?> </td>
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
                              <td bgcolor="#ffffaa"><b><?php echo $LDTotalPediatrics; ?> </b></td>
                              <td><?php echo $arr_ret['Total_Pedriatics']['underage'];?></td>
                              <td>&nbsp;</td>
                              <td colspan="2">&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>

                          </table>-->
				</form>			  
						<!--<a href="javascript:printOut()"><img border=0 src=<?php echo $root_path;?>/gui/img/common/default/billing_print_out.gif></a><br>									  
						  <br><br><br>  <br><br><br> -->						  


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
