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
if(isset($_REQUEST['change']) and isset($GLOBAL_CONFIG['kwamoja_registration_stock_type']))
{
	$sql[] = "UPDATE care_config_global SET `value` = '" . $_REQUEST['kwamoja_registration_stock_type'] . "',
										  `modify_id` = '" . $_SESSION['sess_login_userid'] . "',
										  `modify_time` = NOW()
										 WHERE CONVERT(`care_config_global`.`type` USING utf8) = 'kwamoja_registration_stock_type' LIMIT 1";
	$sql[] = "UPDATE care_config_global SET `value` = '" . $_REQUEST['kwamoja_pharmaceuticals_stock_type'] . "',
										  `modify_id` = '" . $_SESSION['sess_login_userid'] . "',
										  `modify_time` = NOW()
										 WHERE CONVERT(`care_config_global`.`type` USING utf8) = 'kwamoja_pharmaceuticals_stock_type' LIMIT 1";
	$sql[] = "UPDATE care_config_global SET `value` = '" . $_REQUEST['kwamoja_labtests_stock_type'] . "',
										  `modify_id` = '" . $_SESSION['sess_login_userid'] . "',
										  `modify_time` = NOW()
										 WHERE CONVERT(`care_config_global`.`type` USING utf8) = 'kwamoja_labtests_stock_type' LIMIT 1";
	$sql[] = "UPDATE care_config_global SET `value` = '" . $_REQUEST['kwamoja_radiology_stock_type'] . "',
										  `modify_id` = '" . $_SESSION['sess_login_userid'] . "',
										  `modify_time` = NOW()
										 WHERE CONVERT(`care_config_global`.`type` USING utf8) = 'kwamoja_radiology_stock_type' LIMIT 1";
	$sql[] = "UPDATE care_config_global SET `value` = '" . $_REQUEST['kwamoja_othermeds_stock_type'] . "',
										  `modify_id` = '" . $_SESSION['sess_login_userid'] . "',
										  `modify_time` = NOW()
										 WHERE CONVERT(`care_config_global`.`type` USING utf8) = 'kwamoja_othermeds_stock_type' LIMIT 1";
	$sql[] = "UPDATE care_config_global SET `value` = '" . $_REQUEST['kwamoja_nonmeds_stock_type'] . "',
										  `modify_id` = '" . $_SESSION['sess_login_userid'] . "',
										  `modify_time` = NOW()
										 WHERE CONVERT(`care_config_global`.`type` USING utf8) = 'kwamoja_nonmeds_stock_type' LIMIT 1";
	$sql[] = "UPDATE care_config_global SET `value` = '" . $_REQUEST['kwamoja_medcons_stock_type'] . "',
										  `modify_id` = '" . $_SESSION['sess_login_userid'] . "',
										  `modify_time` = NOW()
										 WHERE CONVERT(`care_config_global`.`type` USING utf8) = 'kwamoja_medcons_stock_type' LIMIT 1";
	foreach ($sql as $Query) {
		$db->Execute($Query);
	}
	$glob_obj->getConfig();
} elseif(isset($_REQUEST['change'])) {
	$sql[] = "INSERT INTO care_config_global (`type`, `value`, `notes`, `status`, `history`, `modify_id`, `modify_time`, `create_id`, `create_time`)
										VALUES ('kwamoja_registration_stock_type', '" . $_REQUEST['kwamoja_registration_stock_type'] . "', NULL, '', '', '', NOW(), '" . $_SESSION['sess_login_userid'] . "', NOW())";
	$sql[] = "INSERT INTO care_config_global (`type`, `value`, `notes`, `status`, `history`, `modify_id`, `modify_time`, `create_id`, `create_time`)
										VALUES ('kwamoja_pharmaceuticals_stock_type', '" . $_REQUEST['kwamoja_pharmaceuticals_stock_type'] . "', NULL, '', '', '', NOW(), '" . $_SESSION['sess_login_userid'] . "', NOW())";
	$sql[] = "INSERT INTO care_config_global (`type`, `value`, `notes`, `status`, `history`, `modify_id`, `modify_time`, `create_id`, `create_time`)
										VALUES ('kwamoja_labtests_stock_type', '" . $_REQUEST['kwamoja_labtests_stock_type'] . "', NULL, '', '', '', NOW(), '" . $_SESSION['sess_login_userid'] . "', NOW())";
	$sql[] = "INSERT INTO care_config_global (`type`, `value`, `notes`, `status`, `history`, `modify_id`, `modify_time`, `create_id`, `create_time`)
										VALUES ('kwamoja_radiology_stock_type', '" . $_REQUEST['kwamoja_radiology_stock_type'] . "', NULL, '', '', '', NOW(), '" . $_SESSION['sess_login_userid'] . "', NOW())";
	$sql[] = "INSERT INTO care_config_global (`type`, `value`, `notes`, `status`, `history`, `modify_id`, `modify_time`, `create_id`, `create_time`)
										VALUES ('kwamoja_othermeds_stock_type', '" . $_REQUEST['kwamoja_othermeds_stock_type'] . "', NULL, '', '', '', NOW(), '" . $_SESSION['sess_login_userid'] . "', NOW())";
	$sql[] = "INSERT INTO care_config_global (`type`, `value`, `notes`, `status`, `history`, `modify_id`, `modify_time`, `create_id`, `create_time`)
										VALUES ('kwamoja_nonmeds_stock_type', '" . $_REQUEST['kwamoja_nonmeds_stock_type'] . "', NULL, '', '', '', NOW(), '" . $_SESSION['sess_login_userid'] . "', NOW())";
	$sql[] = "INSERT INTO care_config_global (`type`, `value`, `notes`, `status`, `history`, `modify_id`, `modify_time`, `create_id`, `create_time`)
										VALUES ('kwamoja_medcons_stock_type', '" . $_REQUEST['kwamoja_medcons_stock_type'] . "', NULL, '', '', '', NOW(), '" . $_SESSION['sess_login_userid'] . "', NOW())";
	foreach ($sql as $Query) {
		$db->Execute($Query);
	}
	$glob_obj->getConfig();
}

?>

<HTML>
<HEAD>
 <TITLE>Select the KwaMoja stock types</TITLE>
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
    &nbsp;&nbsp;<font color="#330066">Select the KwaMoja stock types</font>
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
	$sql = "SELECT type, name FROM " . $GLOBAL_CONFIG['kwamoja_database'] . ".stocktypes;";
	$Result=$db->Execute($sql);
	while ($StockTypeRows=$Result->FetchRow()) {
		$StockTypes[$StockTypeRows['type']] = $StockTypeRows['name'];
	}


echo '<form  method="post" name="form">
<table border=0 cellspacing=1 cellpadding=5>';

echo '<tr>
		<td align="left" bgcolor="#64B2FF"><FONT color="#050561"><b>Registration / Admission - Stock Type</b></FONT></td>
		<td bgcolor="#64B2FF" align="left">
			<select name="kwamoja_registration_stock_type">';
foreach ($StockTypes as $type=>$name) {
	if($GLOBAL_CONFIG['kwamoja_registration_stock_type']==$type) {
		echo '<option selected="selected" value="' . $type . '">' . $name . '</option>';
	} else {
		echo '<option value="' . $type . '">' . $name . '</option>';
	}
}
echo '</select>
	</td>
	</tr>';

echo '<tr>
		<td align="left" bgcolor="#64B2FF"><FONT color="#050561"><b>Pharmaceuticals - Stock Type</b></FONT></td>
		<td bgcolor="#64B2FF" align="left">
			<select name="kwamoja_pharmaceuticals_stock_type">';
foreach ($StockTypes as $type=>$name) {
	if($GLOBAL_CONFIG['kwamoja_pharmaceuticals_stock_type']==$type) {
		echo '<option selected="selected" value="' . $type . '">' . $name . '</option>';
	} else {
		echo '<option value="' . $type . '">' . $name . '</option>';
	}
}
echo '</select>
	</td>
	</tr>';

echo '<tr>
		<td align="left" bgcolor="#64B2FF"><FONT color="#050561"><b>Laboratory Tests - Stock Type</b></FONT></td>
		<td bgcolor="#64B2FF" align="left">
			<select name="kwamoja_labtests_stock_type">';
foreach ($StockTypes as $type=>$name) {
	if($GLOBAL_CONFIG['kwamoja_labtests_stock_type']==$type) {
		echo '<option selected="selected" value="' . $type . '">' . $name . '</option>';
	} else {
		echo '<option value="' . $type . '">' . $name . '</option>';
	}
}
echo '</select>
	</td>
	</tr>';

echo '<tr>
		<td align="left" bgcolor="#64B2FF"><FONT color="#050561"><b>Radiology Tests - Stock Type</b></FONT></td>
		<td bgcolor="#64B2FF" align="left">
			<select name="kwamoja_radiology_stock_type">';
foreach ($StockTypes as $type=>$name) {
	if($GLOBAL_CONFIG['kwamoja_radiology_stock_type']==$type) {
		echo '<option selected="selected" value="' . $type . '">' . $name . '</option>';
	} else {
		echo '<option value="' . $type . '">' . $name . '</option>';
	}
}
echo '</select>
	</td>
	</tr>';

echo '<tr>
		<td align="left" bgcolor="#64B2FF"><FONT color="#050561"><b>Other medical services - Stock Type</b></FONT></td>
		<td bgcolor="#64B2FF" align="left">
			<select name="kwamoja_othermeds_stock_type">';
foreach ($StockTypes as $type=>$name) {
	if($GLOBAL_CONFIG['kwamoja_othermeds_stock_type']==$type) {
		echo '<option selected="selected" value="' . $type . '">' . $name . '</option>';
	} else {
		echo '<option value="' . $type . '">' . $name . '</option>';
	}
}
echo '</select>
	</td>
	</tr>';

echo '<tr>
		<td align="left" bgcolor="#64B2FF"><FONT color="#050561"><b>Non medical services - Stock Type</b></FONT></td>
		<td bgcolor="#64B2FF" align="left">
			<select name="kwamoja_nonmeds_stock_type">';
foreach ($StockTypes as $type=>$name) {
	if($GLOBAL_CONFIG['kwamoja_nonmeds_stock_type']==$type) {
		echo '<option selected="selected" value="' . $type . '">' . $name . '</option>';
	} else {
		echo '<option value="' . $type . '">' . $name . '</option>';
	}
}
echo '</select>
	</td>
	</tr>';

echo '<tr>
		<td align="left" bgcolor="#64B2FF"><FONT color="#050561"><b>Other Medical Consumables - Stock Type</b></FONT></td>
		<td bgcolor="#64B2FF" align="left">
			<select name="kwamoja_medcons_stock_type">';
foreach ($StockTypes as $type=>$name) {
	if($GLOBAL_CONFIG['kwamoja_medcons_stock_type']==$type) {
		echo '<option selected="selected" value="' . $type . '">' . $name . '</option>';
	} else {
		echo '<option value="' . $type . '">' . $name . '</option>';
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