<?php
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
require_once($root_path.'include/care_api_classes/class_globalconfig.php');
$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
$glob_obj->getConfig();

global $db;
$debug=false;
($debug) ? $db->debug=true : $db->debug=FALSE;
$sql = array();
if(isset($_REQUEST['change']) and isset($GLOBAL_CONFIG['kwamoja_fileopen_item']))
{
	$sql[] = "UPDATE care_config_global SET `value` = '" . $_REQUEST['kwamoja_fileopen_item'] . "',
										  `modify_id` = '" . $_SESSION['sess_login_userid'] . "',
										  `modify_time` = NOW()
										 WHERE CONVERT(`care_config_global`.`type` USING utf8) = 'kwamoja_fileopen_item' LIMIT 1";
	$sql[] = "UPDATE care_config_global SET `value` = '" . $_REQUEST['kwamoja_admissions_item'] . "',
										  `modify_id` = '" . $_SESSION['sess_login_userid'] . "',
										  `modify_time` = NOW()
										 WHERE CONVERT(`care_config_global`.`type` USING utf8) = 'kwamoja_admissions_item' LIMIT 1";
	foreach ($sql as $Query) {
		$db->Execute($Query);
	}
	$glob_obj->getConfig();
} elseif(isset($_REQUEST['change'])) {
	$sql[] = "INSERT INTO care_config_global (`type`, `value`, `notes`, `status`, `history`, `modify_id`, `modify_time`, `create_id`, `create_time`)
										VALUES ('kwamoja_fileopen_item', '" . $_REQUEST['kwamoja_fileopen_item'] . "', NULL, '', '', '', NOW(), '" . $_SESSION['sess_login_userid'] . "', NOW())";
	$sql[] = "INSERT INTO care_config_global (`type`, `value`, `notes`, `status`, `history`, `modify_id`, `modify_time`, `create_id`, `create_time`)
										VALUES ('kwamoja_admissions_item', '" . $_REQUEST['kwamoja_admissions_item'] . "', NULL, '', '', '', NOW(), '" . $_SESSION['sess_login_userid'] . "', NOW())";
	foreach ($sql as $Query) {
		$db->Execute($Query);
	}
	$glob_obj->getConfig();
}

?>

<HTML>
<HEAD>
 <TITLE>KwaMoja Registration/Admission Configuration</TITLE>
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
    &nbsp;&nbsp;<font color="#330066">KwaMoja Registration/Admission Configuration</font>
       </td>
  <td bgcolor="#99ccff" align=right><a
   href="edv_generally_management.php?sid=<?php echo $sid."&lang=".$lang;?>73&ntid=false"><img src="../../gui/img/control/blue_aqua/en/en_back2.gif" border=0 width="76" height="21" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)" ></a><a
   href="javascript:gethelp('edp.php','access','')"><img src="../../gui/img/control/blue_aqua/en/en_hilfe-r.gif" border=0 width="76" height="21" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a><a
   href="edv-system-admi-welcome.php?sid=<?php echo $sid."&lang=".$lang;?>&ntid=false" ><img src="../../gui/img/control/blue_aqua/en/en_close2.gif" border=0 width="76" height="21" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>     </td>
 </tr>

 </table>

 <br><br>
 <?php
if (!isset($GLOBAL_CONFIG['kwamoja_database']) or $GLOBAL_CONFIG['kwamoja_database']=='') {
	echo '<font  color="#FF0000"><b>You must first select the KwaMoja-Medical database to use</b></font>';
	exit;
} else {
 $sql = "SELECT stockid,
				description
			FROM " . $GLOBAL_CONFIG['kwamoja_database'] . ".stockmaster
			INNER JOIN " . $GLOBAL_CONFIG['kwamoja_database'] . ".stockcategory
				ON " . $GLOBAL_CONFIG['kwamoja_database'] . ".stockmaster.categoryid=" . $GLOBAL_CONFIG['kwamoja_database'] . ".stockcategory.categoryid
			WHERE stocktype='" . $GLOBAL_CONFIG['kwamoja_registration_stock_type'] . "'";
 $Result=$db->Execute($sql);
 while ($StockCodeRows=$Result->FetchRow()) {
	$StockCodes[$StockCodeRows['stockid']] = $StockCodeRows['description'];
 }


echo '<form  method="post" name="form">
		<table border=0 cellspacing=1 cellpadding=5>';

echo '<tr>
		<td bgcolor="#64B2FF" align="left"><FONT  color="#050561"><b>Select the stock item for initial registration of patient</b></FONT></td>
		<td bgcolor="#64B2FF"  align="left">
			<select name="kwamoja_fileopen_item">';
echo '<option name=""></option>';
foreach ($StockCodes as $stockid=>$description) {
	if($GLOBAL_CONFIG['kwamoja_fileopen_item']==$stockid) {
		echo '<option selected="selected" value="' . $stockid . '">' . $description . '</option>';
	} else {
		echo '<option value="' . $stockid . '">' . $description . '</option>';
	}
}
echo '</select>
		</td>
	</tr>';

echo '<tr>
		<td bgcolor="#64B2FF" align="left"><FONT  color="#050561"><b>Select the stock item for subsequent admissions</b></FONT></td>
		<td bgcolor="#64B2FF"  align="left">
			<select name="kwamoja_admissions_item">';
echo '<option name=""></option>';
foreach ($StockCodes as $stockid=>$description) {
	if($GLOBAL_CONFIG['kwamoja_admissions_item']==$stockid) {
		echo '<option selected="selected" value="' . $stockid . '">' . $description . '</option>';
	} else {
		echo '<option value="' . $stockid . '">' . $description . '</option>';
	}
}
echo '</select>
		</td>
	</tr>';

echo '<tr>
		<td colspan="2" align="middle">
			<input type="hidden" name="change" value="true">
			<input type="submit" value="Change">
		</td>
	</tr>';

echo '</table>
	</form>';

}
?>

<ul>
</html>