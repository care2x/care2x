

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
 <TITLE>Pending Test Request (<?php echo $enc_obj->ShowPID($batch_nr); ?>) - </TITLE>
 <meta name="Description" content="Hospital and Healthcare Integrated Information System - CARE2x">
 <meta name="Author" content="Elpidio Latorilla">
 <meta name="Generator" content="various: Quanta, AceHTML 4 Freeware, NuSphere, PHP Coder">
 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

  	<script language="javascript" >
<!-- 
function gethelp(x,s,x1,x2,x3,x4)
{
	if (!x) x="";
	urlholder="../../main/help-router.php?sid=<?php echo $sid;?>&lang=en&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3+"&x4="+x4;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}

function printOut()
{
	urlholder="<?php echo $root_path;?>modules/registration_admission/show_prescription.php?externalcall=TRUE&printout=TRUE&pn=2005500002&sid=<?php echo $sid."&lang=".$lang;?>";
	testprintout=window.open(urlholder,"printout","width=800,height=600,menubar=no,resizable=yes,scrollbars=yes");
  
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

  	
<style type="text/css">
.lab {font-family: arial; font-size: 9; color:purple;}
.lmargin {margin-left: 5;}
</style>

<script language="JavaScript" src="<?php echo $root_path;?>js/cross.js"></script>
<script language="JavaScript" src="<?php echo $root_path;?>js/tooltips.js"></script>
<div id="BallonTip" style="POSITION:absolute; VISIBILITY:hidden; LEFT:-200px; Z-INDEX: 100"></div>


 
</HEAD>
<BODY bgcolor="#ffffff" link="#000066" alink="#cc0000" vlink="#000066" onload="setBallon('BallonTip');" >
<table width=100% border=0 cellspacing=0 height=100%>
<tbody class="main">
	<tr>

		<td  valign="top" align="middle" height="35">
			 <table cellspacing="0"  class="titlebar" border=0>
 <tr valign=top  class="titlebar" >
            <td bgcolor="#99ccff" > &nbsp;&nbsp;<font color="#330066">Pending 
              Bills (<?php echo $enc_obj->ShowPID($batch_nr); ?>)</font> </td>
  <td bgcolor="#99ccff" align=right><a
   href="javascript:gethelp('pending_prescriptions_pharmacy.php')"><img src="../../gui/img/control/default/en/en_hilfe-r.gif" border=0 width="75" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a><a
   href="../../modules/pharmacy_tz/pharmacy_tz.php?ntid=false&lang=$lang" ><img src="../../gui/img/control/default/en/en_close2.gif" border=0 width="103" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>  </td>
 </tr>

 </table>		</td>
	</tr>

	<tr>
		<td bgcolor=#ffffff valign=top>
		
													
<table border="0">
	<tr valign="top">
		<!-- Left block for the request list  -->
		    <td> <br>
              <br>
<?php 
  
  require($root_path.'include/inc_billing_pending_lister_fx.php'); 
  
?>
		    <td> 
		          <?php
		          if (!$NO_PENDING_PRESCRIPTIONS) {
		            echo '
                      <a href="javascript:printOut()"><img src="../../gui/img/control/default/en/en_printout.gif" border=0 align="absmiddle" width="99" height="24" alt="Print this form"></a> 
                      <a href="pharmacy_tz_pending_prescriptions.php?&mode=done&pn='.$pn.'&prescription_date='.$prescription_date.'>"><img src="../../gui/img/control/default/en/en_done.gif" border=0 align="absmiddle" width="75" height="24" alt="It�s done! Move the form to the archive"></a> 
                      <br>
                     ';}
                 
                  if ($NO_PENDING_PRESCRIPTIONS) {
                    echo '<br><br><br><br>&nbsp;&nbsp;&nbsp;&nbsp;no pending prescriptions...<br>';
                  } else {
                    echo '<iframe name="prescription" src="'.$root_path.'/modules/registration_admission/show_prescription.php?externalcall=TRUE&pn='.$pn.'&sid='.$sid.'" width="900" height="400" align="left" marginheight="0" marginwidth="0" hspace="0" vspace="0" scrolling="auto" frameborder="0" noresize></iframe> ';
                  }
               ?>
        </td>
	</tr>
</table>     


						
		</td>
	</tr>
	
		<tr valign=top >
		<td bgcolor=#cccccc>
							<table width="100%" border="1" cellspacing="0" cellpadding="1" bgcolor="#cfcfcf">
<tr>
<td align="center">

  <table width="100%" bgcolor="#ffffff" cellspacing=0 cellpadding=5>
   <tr>
   	<td>
	    <div class="copyright"> </div>
	    </td>
   <tr>
  </table>
</td>
</tr>
</table>
					</td>

	</tr>
	
	</tbody>
 </table>


</BODY>
</HTML>