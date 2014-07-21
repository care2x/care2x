<?php
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
require_once($root_path.'include/care_api_classes/class_globalconfig.php');
$glob_obj=new GlobalConfig($GLOBAL_CONFIG);


global $db;
$debug=false;
($debug) ? $db->debug=true : $db->debug=FALSE;

if(isset($_REQUEST['change']) and $_REQUEST['change'] == true)
{
	$sql = 'UPDATE care_config_global SET `value` = \''.$_REQUEST['is_transmit_to_weberp_enable'].'\', `modify_time` = NOW() WHERE CONVERT(`care_config_global`.`type` USING utf8) = \'is_transmit_to_weberp_enable\' LIMIT 1;';
	$db->Execute($sql);
	$sql = 'UPDATE care_config_global SET `value` = \''.$_REQUEST['ServerURL'].'\', `modify_time` = NOW() WHERE CONVERT(`care_config_global`.`type` USING utf8) = \'xml-rpc_server\' LIMIT 1;';
	$db->Execute($sql);
}

$glob_obj->getConfig('is%');
if($GLOBAL_CONFIG['is_transmit_to_weberp_enable'] == "")
{
	$sql = 'INSERT INTO care_config_global (`type`, `value`, `notes`, `status`, `history`, `modify_id`, `modify_time`, `create_id`, `create_time`) VALUES (\'is_transmit_to_weberp_enable\', \'0\', NULL, \'\', \'\', \'\', NOW(), \'\', \'0000-00-00 00:00:00\');';
	$db->Execute($sql);
}

$glob_obj->getConfig('xml%');
if($GLOBAL_CONFIG['xml-rpc_server'] == "")
{
	$sql = "INSERT INTO care_config_global (`type`, `value`, `notes`, `status`, `history`, `modify_id`, `modify_time`, `create_id`, `create_time`) VALUES ('xml-rpc_server', '', NULL, '', '', '', NOW(), '', '0000-00-00 00:00:00')";
	$db->Execute($sql);
}


?>

<HTML>
<HEAD>
 <TITLE>Generally Management - </TITLE>
 <meta name="Description" content="Hospital and Healthcare Integrated Information System - CARE2x">
<meta name="Author" content="Elpidio Latorilla">
<meta name="Generator" content="various: Quanta, AceHTML 4 Freeware, NuSphere, PHP Coder">
 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

  	<script language="javascript" >
<!--
function gethelp(x,s,x1,x2,x3,x4)
{
	if (!x) x="";
	urlholder="../../main/help-router.php?sid=<?php echo $sid."&lang=".$lang;?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3+"&x4="+x4;
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

 if(pid!="") regpicwindow = window.open("../../main/pop_reg_pic.php?sid=<?php echo $sid."&lang=".$lang;?>&pid="+pid+"&nm="+nm,"regpicwin","toolbar=no,scrollbars,width=180,height=250");

}
// -->
</script>


</HEAD>
<BODY bgcolor=#ffffff link=#000066 alink=#cc0000 vlink=#000066  >
<table width=100% border=0 cellspacing=0 height=100%>
<tbody class="main">
	<tr>

		<td  valign="top" align="middle" height="35">
			 <table cellspacing="0"  class="titlebar" border=0>
 <tr valign=top  class="titlebar" >
  <td bgcolor="#99ccff" width="100%" >
    &nbsp;&nbsp;<font color="#330066">XML-RPC Interface Configuration</font>
       </td>
  <td bgcolor="#99ccff" align=right><a
   href="edv_generally_management.php?sid=<?php echo $sid."&lang=".$lang;?>73&ntid=false"><img src="../../gui/img/control/blue_aqua/en/en_back2.gif" border=0 width="76" height="21" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)" ></a><a
   href="javascript:gethelp('edp.php','access','')"><img src="../../gui/img/control/blue_aqua/en/en_hilfe-r.gif" border=0 width="76" height="21" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a><a
   href="edv-system-admi-welcome.php?sid=<?php echo $sid."&lang=".$lang;?>&ntid=false" ><img src="../../gui/img/control/blue_aqua/en/en_close2.gif" border=0 width="76" height="21" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>     </td>
 </tr>

 </table>

 <br><br>
 <form  method="post" name="form">
<table border=0 cellspacing=1 cellpadding=5>
<tr>
	<td class="adm_item" align="left"><FONT  color="#0000cc"><b><?php echo 'Enable the XML-RPC Interface to KwaMoja'; ?></b></FONT></td>
	<td  align="left">

	<select name="is_transmit_to_weberp_enable">
	<?php
	if($GLOBAL_CONFIG['is_transmit_to_weberp_enable']==1)
	{
		echo '<option value="1" selected>Yes</option>';
		echo '<option value="0">No</option>';
	}
	else
	{
		echo '<option value="1">Yes</option>';
		echo '<option value="0" selected>No</option>';
	}
	?>
	</select>
	</td>
	</tr>
	<tr>
	<td class="adm_item" align="left"><FONT  color="#0000cc"><b><?php echo 'Full URL of the KwaMoja XML-RPC server'; ?></b></FONT></td>
	<td><input type="text" name="ServerURL" size="70" value="<?php echo $GLOBAL_CONFIG['xml-rpc_server']; ?>" /></td>
	</tr>
	<tr>
		<td colspan="2" align="middle">
	<input type="hidden" name="change" value="true">
	<input type="submit" value="Change">
	</td>
</tr>

</table>
</form>


<ul>
</html>