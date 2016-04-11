<?php
// PRINTOUT - SECTION :: See below for common GUI
if ($printout) {
echo '<head>
<script language="javascript"> this.window.print(); </script>
<title>Mtuha OPD Summary</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>';
echo '<html><body>';
?>
<DIV align="center">
	<h1><?php echo $LDOPDTotalSummary; ?><?php echo date('F Y',$start);?></h1>
	<p><?php echo $LDCreationTime; ?><?php echo date("F j, Y, g:i a");?></p>
</DIV>
                         <table width="750" border="1" cellspacing="0" cellpadding="0" align="center" bgcolor=#ffffdd>
                            <tr>
                              <td  width="100" rowspan="2" bgcolor="#ffffaa"></td>
							  <td colspan="3" align="center"  bgcolor="#ffffaa">&lt; 1 Month </td>
							  <td colspan="3" align="center">1 month to &lt; 1yr </td>
                              <td colspan="3" align="center"  bgcolor="#ffffaa">1 yr to &lt; 5yrs </td>
                              <!--<td colspan="3" align="center">5 yrs and above</td>-->
                              <td colspan="3" align="center" bgcolor="#ffffaa">60 yrs and above</td>
                              <td colspan="3" align="center">5 yrs to &lt; 60yrs </td>
                              <td rowspan="2" bgcolor="#ffffaa"><?php echo $LDtotal_opd; ?></td>
                            </tr>
							<tr>
                              <td width="50" bgcolor="#ffffaa"><?php echo $LDMale; ?></td>
                              <td width="50" bgcolor="#ffffaa"><?php echo $LDFemale; ?></td>
                              <td width="50" bgcolor="#ffffaa"><?php echo $LDTotal_opd; ?></td>
							  <td width="50"><?php echo $LDMale; ?></td>
                              <td width="50"><?php echo $LDFemale; ?></td>
                              <td width="50"><?php echo $LDTotal_opd; ?></td>
							  <td width="50" bgcolor="#ffffaa"><?php echo $LDMale; ?></td>
                              <td width="50" bgcolor="#ffffaa"><?php echo $LDFemale; ?></td>
                              <td width="50" bgcolor="#ffffaa"><?php echo $LDTotal_opd; ?></td>
							  <!--<td width="50"> //echo $LDMale; ?></td>
                              <td width="50"> //$LDFemale; ?></td>
                              <td width="50">//$LDTotal_opd; ?></td>-->
                              <td width="50" bgcolor="#ffffaa"><?php echo $LDMale; ?></td>
                              <td width="50" bgcolor="#ffffaa"><?php echo $LDFemale; ?></td>
                              <td width="50" bgcolor="#ffffaa"><?php echo $LDTotal_opd; ?></td>
                              <td width="50"><?php echo $LDMale; ?></td>
                              <td width="50"><?php echo $LDFemale; ?></td>
                              <td width="50"><?php echo $LDTotal_opd; ?></td>
							  
                            </tr>
                            <tr>
                              <td width="100"><?php echo $LDOPDVisits; ?></b> </td>
                              <td bgcolor="#ffffaa"><?php echo $arr_reg['underage']['male'];?></td>
                              <td bgcolor="#ffffaa"><?php echo $arr_reg['underage']['female'];?></td>
                              <td bgcolor="#ffffaa"><?php echo $arr_reg['underage']['total'];?></td>
							  
                              <td><?php echo $arr_reg['underyr']['male'];?></td>
                              <td><?php echo $arr_reg['underyr']['female'];?></td>
							  <td><?php echo $arr_reg['underyr']['total'];?></td>
							  
                              <td bgcolor="#ffffaa"><?php echo $arr_reg['under5']['male'];?></td>
                              <td bgcolor="#ffffaa"><?php echo $arr_reg['under5']['female'];?></td>
                              <td bgcolor="#ffffaa"><?php echo $arr_reg['under5']['total'];?></td>
							  
                              <!--<td> //echo $arr_reg['over5']['male'];?></td>
                              <td> //echo $arr_reg['over5']['female'];?></td>
							  <td>//echo $arr_reg['over5']['total'];?></td>-->
							  
							  <td bgcolor="#ffffaa"><?php echo $arr_reg['over60']['male'];?></td>
                              <td bgcolor="#ffffaa"><?php echo $arr_reg['over60']['female'];?></td>
							  <td bgcolor="#ffffaa"><?php echo $arr_reg['over60']['total'];?></td>
							  
							  <td><?php echo $arr_reg['under60']['male'];?></td>
                              <td><?php echo $arr_reg['under60']['female'];?></td>
                              <td><?php echo $arr_reg['under60']['total'];?></td>
							  
							  							  
							  <td bgcolor="#ffffaa"><b><?php echo $arr_reg['total'];?></b></td>
                            </tr>
                            <tr>
                              <td width="100"><?php echo $LDFirstTimePatients; ?></b></td>
                              <td bgcolor="#ffffaa"><?php echo $arr_new['underage']['male'];?></td>
                              <td bgcolor="#ffffaa"><?php echo $arr_new['underage']['female'];?></td>
                              <td bgcolor="#ffffaa"><?php echo $arr_new['underage']['total'];?></td>
							  
                              <td><?php echo $arr_new['underyr']['male'];?></td>
                              <td><?php echo $arr_new['underyr']['female'];?></td>
							  <td><?php echo $arr_new['underyr']['total'];?></td>
							  
                              <td bgcolor="#ffffaa"><?php echo $arr_new['under5']['male'];?></td>
                              <td bgcolor="#ffffaa"><?php echo $arr_new['under5']['female'];?></td>
                              <td bgcolor="#ffffaa"><?php echo $arr_new['under5']['total'];?></td>
							  
                            <!--  <td> //echo $arr_new['over5']['male']></td>
                              <td> //echo $arr_new['over5']['female'];</td>
							  <td>//echo $arr_new['over5']['total'];</td>-->
							  
							  <td bgcolor="#ffffaa"><?php echo $arr_new['over60']['male'];?></td>
                              <td bgcolor="#ffffaa"><?php echo $arr_new['over60']['female'];?></td>
							  <td bgcolor="#ffffaa"><?php echo $arr_new['over60']['total'];?></td>
							  
							  <td><?php echo $arr_new['under60']['male'];?></td>
                              <td><?php echo $arr_new['under60']['female'];?></td>
							  <td><?php echo $arr_new['under60']['total'];?></td>
							  
							  
							  
							  <td bgcolor="#ffffaa"><b><?php echo $arr_new['total'];?></b></td>                         
                            </tr>
			    <tr>
                              <td width="100"><?php echo $LDNewPatients; ?></b></td>
                              <td bgcolor="#ffffaa"><?php echo $arr_newreg['underage']['male'];?></td>
                              <td bgcolor="#ffffaa"><?php echo $arr_newreg['underage']['female'];?></td>
                              <td bgcolor="#ffffaa"><?php echo $arr_newreg['underage']['total'];?></td>
							  
                              <td><?php echo $arr_newreg['underyr']['male'];?></td>
                              <td><?php echo $arr_newreg['underyr']['female'];?></td>
							  <td><?php echo $arr_newreg['underyr']['total'];?></td>
							  
                              <td bgcolor="#ffffaa"><?php echo $arr_newreg['under5']['male'];?></td>
                              <td bgcolor="#ffffaa"><?php echo $arr_newreg['under5']['female'];?></td>
                              <td bgcolor="#ffffaa"><?php echo $arr_newreg['under5']['total'];?></td>
							  
                              <!--<td>< //echo $arr_newreg['over5']['male'];?></td>
                              <td> //echo $arr_newreg['over5']['female'];?></td>
							  <td> //echo $arr_newreg['over5']['total'];</td>-->
							  
							  <td bgcolor="#ffffaa"><?php echo $arr_newreg['over60']['male'];?></td>
                              <td bgcolor="#ffffaa"><?php echo $arr_newreg['over60']['female'];?></td>
							  <td bgcolor="#ffffaa"><?php echo $arr_newreg['over60']['total'];?></td>
							  
							  <td><?php echo $arr_newreg['under60']['male'];?></td>
                              <td><?php echo $arr_newreg['under60']['female'];?></td>
							  <td><?php echo $arr_newreg['under60']['total'];?></td>
							  
							  <td bgcolor="#ffffaa"><b><?php echo $arr_newreg['total'];?></b></td>                         
                            </tr>
                             <tr>
                              <td><?php echo $LDReturnPatients; ?></td>
                              <td bgcolor="#ffffaa"><?php echo $arr_ret['underage']['male'];?></td>
                              <td bgcolor="#ffffaa"><?php echo $arr_ret['underage']['female'];?></td>
                              <td bgcolor="#ffffaa"><?php echo $arr_ret['underage']['total'];?></td>
							  
                              <td><?php echo $arr_ret['underyr']['male'];?></td>
                              <td><?php echo $arr_ret['underyr']['female'];?></td>
							  <td><?php echo $arr_ret['underyr']['total'];?></td>
							  
                              <td bgcolor="#ffffaa"><?php echo $arr_ret['under5']['male'];?></td>
                              <td bgcolor="#ffffaa"><?php echo $arr_ret['under5']['female'];?></td>
                              <td bgcolor="#ffffaa"><?php echo $arr_ret['under5']['total'];?></td>
							  
                              <!--<td> //echo $arr_ret['over5']['male'];?></td>
                              <td>< //echo $arr_ret['over5']['female'];?></td>
							  <td>< //echo $arr_ret['over5']['total'];></td>-->
							  
							   <td bgcolor="#ffffaa"><?php echo $arr_ret['over60']['male'];?></td>
                              <td bgcolor="#ffffaa"><?php echo $arr_ret['over60']['female'];?></td>
							  <td bgcolor="#ffffaa"><?php echo $arr_ret['over60']['total'];?></td>
							  
                               <td><?php echo $arr_ret['under60']['male'];?></td>
                              <td><?php echo $arr_ret['under60']['female'];?></td>
							  <td><?php echo $arr_ret['under60']['total'];?></td>
							  							  
							  
							  
							  <td bgcolor="#ffffaa"><b><?php echo $arr_ret['total'];?></b></td> 
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
    	urlholder="./mtuha_opd_summary.php?printout=TRUE&start=<?php echo $start;?>&end=<?php echo $end;?>" ;
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
  <td width="202" bgcolor="#99ccff" >
    &nbsp;&nbsp;<font color="#330066"><?php echo $LDMtuhaOPDSummary; ?></font></td>
  <td width="408" align=right bgcolor="#99ccff">
   <a href="javascript: history.back();"><img src="../../gui/img/control/default/en/en_back2.gif" border=0 width="110" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)" ></a>
   <a href="javascript:gethelp('reporting_overview.php','Reporting :: Overviw')"><img src="../../gui/img/control/default/en/en_hilfe-r.gif" border=0 width="75" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>
   <a href="<?php echo $root_path;?>modules/reporting_tz/reporting_main_menu.php" ><img src="../../gui/img/control/default/en/en_close2.gif" border=0 width="103" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>  
  </td>
 </tr>
 </table>	
 
<!-- END HEAD OF HTML CONTENT -->

<form name="form1" method="post" action="">
                          </p>
							<?php require_once($root_path.$top_dir.'include/inc_gui_timeframe.php'); ?>			
						  <br><br><br>
                          <table width="750" border="1" cellspacing="0" cellpadding="0" align="center" bgcolor=#ffffdd>
                            <tr>
                              <td  width="100" rowspan="2" bgcolor="#ffffaa"></td>
							  <td colspan="3" align="center"  bgcolor="#ffffaa">&lt; 1 Month </td>
							  <td colspan="3" align="center">1 month to &lt; 1yr </td>
                              <td colspan="3" align="center"  bgcolor="#ffffaa">1 yr to &lt; 5yrs </td>
                             <!-- <td colspan="3" align="center">5 yrs and above</td>-->
                              <td colspan="3" align="center" bgcolor="#ffffaa">60 yrs and above</td>
                              <td colspan="3" align="center">5 yrs to &lt; 60yrs </td>
                              <td rowspan="2" bgcolor="#ffffaa"><?php echo $LDtotal_opd; ?></td>
                            </tr>
							<tr>
                              <td width="50" bgcolor="#ffffaa"><?php echo $LDMale; ?></td>
                              <td width="50" bgcolor="#ffffaa"><?php echo $LDFemale; ?></td>
                              <td width="50" bgcolor="#ffffaa"><?php echo $LDTotal_opd; ?></td>
							  <td width="50"><?php echo $LDMale; ?></td>
                              <td width="50"><?php echo $LDFemale; ?></td>
                              <td width="50"><?php echo $LDTotal_opd; ?></td>
							  <td width="50" bgcolor="#ffffaa"><?php echo $LDMale; ?></td>
                              <td width="50" bgcolor="#ffffaa"><?php echo $LDFemale; ?></td>
                              <td width="50" bgcolor="#ffffaa"><?php echo $LDTotal_opd; ?></td>
							 <!-- <td width="50"></td>
                              <td width="50"></td>
                              <td width="50"></td>-->
                              <td width="50"><?php echo $LDMale; ?></td>
                              <td width="50"><?php echo $LDFemale; ?></td>
                              <td width="50"><?php echo $LDTotal_opd; ?></td>
                              <td width="50" bgcolor="#ffffaa"><?php echo $LDMale; ?></td>
                              <td width="50" bgcolor="#ffffaa"><?php echo $LDFemale; ?></td>
                              <td width="50" bgcolor="#ffffaa"><?php echo $LDTotal_opd; ?></td>
							  
                            </tr>
                            <tr>
                              <td width="100"><?php echo $LDOPDVisits; ?></b> </td>
                              <td bgcolor="#ffffaa"><?php echo $arr_reg['underage']['male'];?></td>
                              <td bgcolor="#ffffaa"><?php echo $arr_reg['underage']['female'];?></td>
                              <td bgcolor="#ffffaa"><?php echo $arr_reg['underage']['total'];?></td>
							  
                              <td><?php echo $arr_reg['underyr']['male'];?></td>
                              <td><?php echo $arr_reg['underyr']['female'];?></td>
							  <td><?php echo $arr_reg['underyr']['total'];?></td>
							  
                              <td bgcolor="#ffffaa"><?php echo $arr_reg['under5']['male'];?></td>
                              <td bgcolor="#ffffaa"><?php echo $arr_reg['under5']['female'];?></td>
                              <td bgcolor="#ffffaa"><?php echo $arr_reg['under5']['total'];?></td>
							  
                             <!-- <td> //echo $arr_reg['over5']['male'];?></td>
                              <td> //echo $arr_reg['over5']['female'];?></td>
							  <td> //echo $arr_reg['over5']['total'];?></td>-->
							  
							  <td ><?php echo $arr_reg['over60']['male'];?></td>
                              <td ><?php echo $arr_reg['over60']['female'];?></td>
							  <td ><?php echo $arr_reg['over60']['total'];?></td>
							  
							  <td bgcolor="#ffffaa"><?php echo $arr_reg['under60']['male'];?></td>
                              <td bgcolor="#ffffaa"><?php echo $arr_reg['under60']['female'];?></td>
                              <td bgcolor="#ffffaa"><?php echo $arr_reg['under60']['total'];?></td>
							  
							  							  
							  <td bgcolor="#ffffaa"><b><?php echo $arr_reg['total'];?></b></td>
                            </tr>
                            <tr>
                              <td width="100"><?php echo $LDFirstTimePatients; ?></b></td>
                              <td ><?php echo $arr_new['underage']['male'];?></td>
                              <td ><?php echo $arr_new['underage']['female'];?></td>
                              <td ><?php echo $arr_new['underage']['total'];?></td>
							  
                              <td bgcolor="#ffffaa"><?php echo $arr_new['underyr']['male'];?></td>
                              <td bgcolor="#ffffaa"><?php echo $arr_new['underyr']['female'];?></td>
							  <td bgcolor="#ffffaa"><?php echo $arr_new['underyr']['total'];?></td>
							  
                              <td ><?php echo $arr_new['under5']['male'];?></td>
                              <td ><?php echo $arr_new['under5']['female'];?></td>
                              <td ><?php echo $arr_new['under5']['total'];?></td>
							  
                              <!--<td><</td>
                              <td><</td>
							  <td></td>-->
							  
							  <td bgcolor="#ffffaa"><?php echo $arr_new['over60']['male'];?></td>
                              <td bgcolor="#ffffaa"><?php echo $arr_new['over60']['female'];?></td>
							  <td bgcolor="#ffffaa"><?php echo $arr_new['over60']['total'];?></td>
							  
							  <td><?php echo $arr_new['under60']['male'];?></td>
                              <td><?php echo $arr_new['under60']['female'];?></td>
							  <td><?php echo $arr_new['under60']['total'];?></td>
							  
							  
							  
							  <td bgcolor="#ffffaa"><b><?php echo $arr_new['total'];?></b></td>                         
                            </tr>
			    <tr>
                              <td width="100"><?php echo $LDNewPatients; ?></b></td>
                              <td bgcolor="#ffffaa"><?php echo $arr_newreg['underage']['male'];?></td>
                              <td bgcolor="#ffffaa"><?php echo $arr_newreg['underage']['female'];?></td>
                              <td bgcolor="#ffffaa"><?php echo $arr_newreg['underage']['total'];?></td>
							  
                              <td><?php echo $arr_newreg['underyr']['male'];?></td>
                              <td><?php echo $arr_newreg['underyr']['female'];?></td>
							  <td><?php echo $arr_newreg['underyr']['total'];?></td>
							  
                              <td bgcolor="#ffffaa"><?php echo $arr_newreg['under5']['male'];?></td>
                              <td bgcolor="#ffffaa"><?php echo $arr_newreg['under5']['female'];?></td>
                              <td bgcolor="#ffffaa"><?php echo $arr_newreg['under5']['total'];?></td>
							  
                             <!--<td><</td>
                              <td><</td>
							  <td></td>-->
							  
							  <td><?php echo $arr_newreg['over60']['male'];?></td>
                              <td><?php echo $arr_newreg['over60']['female'];?></td>
							  <td ><?php echo $arr_newreg['over60']['total'];?></td>
							  
							  <td bgcolor="#ffffaa"><?php echo $arr_newreg['under60']['male'];?></td>
                              <td bgcolor="#ffffaa"><?php echo $arr_newreg['under60']['female'];?></td>
							  <td bgcolor="#ffffaa"><?php echo $arr_newreg['under60']['total'];?></td>
							  
							  <td bgcolor="#ffffaa"><b><?php echo $arr_newreg['total'];?></b></td>                         
                            </tr>
                             <tr>
                              <td><?php echo $LDReturnPatients; ?></td>
                              <td bgcolor="#ffffaa"><?php echo $arr_ret['underage']['male'];?></td>
                              <td bgcolor="#ffffaa"><?php echo $arr_ret['underage']['female'];?></td>
                              <td bgcolor="#ffffaa"><?php echo $arr_ret['underage']['total'];?></td>
							  
                              <td><?php echo $arr_ret['underyr']['male'];?></td>
                              <td><?php echo $arr_ret['underyr']['female'];?></td>
							  <td><?php echo $arr_ret['underyr']['total'];?></td>
							  
                              <td bgcolor="#ffffaa"><?php echo $arr_ret['under5']['male'];?></td>
                              <td bgcolor="#ffffaa"><?php echo $arr_ret['under5']['female'];?></td>
                              <td bgcolor="#ffffaa"><?php echo $arr_ret['under5']['total'];?></td>
							  
                             <!--<td><</td>
                              <td><</td>
							  <td></td>-->
							  
							   <td ><?php echo $arr_ret['over60']['male'];?></td>
                              <td ><?php echo $arr_ret['over60']['female'];?></td>
							  <td ><?php echo $arr_ret['over60']['total'];?></td>
							  
                               <td bgcolor="#ffffaa"><?php echo $arr_ret['under60']['male'];?></td>
                              <td bgcolor="#ffffaa"><?php echo $arr_ret['under60']['female'];?></td>
							  <td bgcolor="#ffffaa"><?php echo $arr_ret['under60']['total'];?></td>
							  							  
							  
							  
							  <td bgcolor="#ffffaa"><b><?php echo $arr_ret['total'];?></b></td> 
                            </tr>							

                          </table>
				</form>
<a href="javascript:printOut()"><img border=0 src=<?php echo $root_path;?>/gui/img/common/default/billing_print_out.gif></a><br>									  
						  <br><br><br>						  


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
