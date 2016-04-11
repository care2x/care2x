<?php
if($substore_value) header("location: pharmacy_tz.php");

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
function getARV(path) {
	urlholder="<?php echo $root_path ?>"+path+"<?php echo URL_REDIRECT_APPEND; ?>";
	patientwin=window.open(urlholder,"arv","menubar=no,resizable=yes,scrollbars=yes");
	patientwin.resizeTo(screen.availWidth,screen.availHeight);
	patientwin.focus();
}



// -->
</script>


</HEAD>
<BODY bgcolor=#ffffff link=#000066 alink=#cc0000 vlink=#000066  >

<!-- START HEAD OF HTML CONTENT --->

<table width=100% border=0 cellspacing=0 height=100%>
	<tr>
		<td  valign="top" align="middle" height="35">
			 <table cellspacing="0"  class="titlebar" border=0>
 				<tr valign=top  class="titlebar" >
  					<td width="202" bgcolor="#99ccff" >
    					&nbsp;&nbsp;<font color="#330066"><?php echo $LDPharmacyReports; ?></font></td>
						  <td width="408" align=right bgcolor="#99ccff">
						   <a href="javascript: history.back();"><img src="../../gui/img/control/default/en/en_back2.gif" border=0 width="110" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)" ></a>
						   <a href="javascript:gethelp('reporting_overview.php','Reporting :: Overview')"><img src="../../gui/img/control/default/en/en_hilfe-r.gif" border=0 width="75" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>
						   <a href="<?php echo $root_path;?>modules/news/start_page.php" ><img src="../../gui/img/control/default/en/en_close2.gif" border=0 width="103" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>
						  </td>
  					 </tr>
 </table>

<!-- END OF HEAD OF HTML CONTENT--->
<?php
$data=array();
$sql_subtore="SELECT loccode, locationname FROM locations";
$substore_result =$db->Execute($sql_subtore);
while($r=$substore_result->FetchRow()){
$data['subtore'][]=$r;
}



?>
<form name="form1" method="POST" action="">
  <p>&nbsp;</p>
  <table width="746" border="0">
    <tr>
      <td width="19" bgcolor="#CCCCCC" scope="col"><img src="../../gui/img/common/default/icontopdf.gif"></td>
      <td width="150" bgcolor="#CCCCCC" scope="col">
      <select name="substore">
      <option value=""></option>
      <?php
      while(list($x,$v)=each($data['subtore'])){
       
         ?>
       <option value="<?php echo $v['loccode'];?>"><?php echo $v['locationname'];?></option>
       <?php
      } 
      ?>
       
      </select>
</td>
      <td width="19" bgcolor="#CCCCCC" scope="col"><img src="../../gui/img/common/default/l-arrowgrnlrg.gif"></td>
      <td width="100" bgcolor="#CCCCCC" scope="col">SUB-STORES</td>
    </tr>
    <tr>
      <td bgcolor="#CCCCCC">&nbsp;</td>
      <td bgcolor="#CCCCCC"><input type="submit" value="CLICK THIS BUTTON" ></td>
      <td bgcolor="#CCCCCC">&nbsp;</td>
      <td bgcolor="#CCCCCC">&nbsp;ACCESS PATIENT LIST</td>
    </tr>
  </table>
<p>&nbsp;</p>
</form>

<?php
$substore_value=$_POST['substore'];
?>







