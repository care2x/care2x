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
if(isset($_REQUEST['change'])
		and isset($GLOBAL_CONFIG['kwamoja_default_terms'])
		and isset($GLOBAL_CONFIG['kwamoja_default_reason'])
		and isset($GLOBAL_CONFIG['kwamoja_default_debtor_type'])
		and isset($GLOBAL_CONFIG['kwamoja_default_area'])
		and isset($GLOBAL_CONFIG['kwamoja_default_salesman'])
		and isset($GLOBAL_CONFIG['kwamoja_default_location'])
		and isset($GLOBAL_CONFIG['kwamoja_default_shipper'])
		and isset($GLOBAL_CONFIG['kwamoja_default_tax_group']))
{
	$sql[] = "UPDATE care_config_global SET `value` = '" . $_REQUEST['kwamoja_default_terms'] . "',
										  `modify_id` = '" . $_SESSION['sess_login_userid'] . "',
										  `modify_time` = NOW()
										 WHERE CONVERT(`care_config_global`.`type` USING utf8) = 'kwamoja_default_terms' LIMIT 1";
	$sql[] = "UPDATE care_config_global SET `value` = '" . $_REQUEST['kwamoja_default_reason'] . "',
										  `modify_id` = '" . $_SESSION['sess_login_userid'] . "',
										  `modify_time` = NOW()
										 WHERE CONVERT(`care_config_global`.`type` USING utf8) = 'kwamoja_default_reason' LIMIT 1";
	$sql[] = "UPDATE care_config_global SET `value` = '" . $_REQUEST['kwamoja_default_debtor_type'] . "',
										  `modify_id` = '" . $_SESSION['sess_login_userid'] . "',
										  `modify_time` = NOW()
										 WHERE CONVERT(`care_config_global`.`type` USING utf8) = 'kwamoja_default_debtor_type' LIMIT 1";
	$sql[] = "UPDATE care_config_global SET `value` = '" . $_REQUEST['kwamoja_default_area'] . "',
										  `modify_id` = '" . $_SESSION['sess_login_userid'] . "',
										  `modify_time` = NOW()
										 WHERE CONVERT(`care_config_global`.`type` USING utf8) = 'kwamoja_default_salesman' LIMIT 1";
	$sql[] = "UPDATE care_config_global SET `value` = '" . $_REQUEST['kwamoja_default_salesman'] . "',
										  `modify_id` = '" . $_SESSION['sess_login_userid'] . "',
										  `modify_time` = NOW()
										 WHERE CONVERT(`care_config_global`.`type` USING utf8) = 'kwamoja_default_salesman' LIMIT 1";
	$sql[] = "UPDATE care_config_global SET `value` = '" . $_REQUEST['kwamoja_default_location'] . "',
										  `modify_id` = '" . $_SESSION['sess_login_userid'] . "',
										  `modify_time` = NOW()
										 WHERE CONVERT(`care_config_global`.`type` USING utf8) = 'kwamoja_default_location' LIMIT 1";
	$sql[] = "UPDATE care_config_global SET `value` = '" . $_REQUEST['kwamoja_default_shipper'] . "',
										  `modify_id` = '" . $_SESSION['sess_login_userid'] . "',
										  `modify_time` = NOW()
										 WHERE CONVERT(`care_config_global`.`type` USING utf8) = 'kwamoja_default_shipper' LIMIT 1";
	$sql[] = "UPDATE care_config_global SET `value` = '" . $_REQUEST['kwamoja_default_tax_group'] . "',
										  `modify_id` = '" . $_SESSION['sess_login_userid'] . "',
										  `modify_time` = NOW()
										 WHERE CONVERT(`care_config_global`.`type` USING utf8) = 'kwamoja_default_tax_group' LIMIT 1";
	foreach ($sql as $Query) {
		$db->Execute($Query);
	}
	$glob_obj->getConfig();
} elseif(isset($_REQUEST['change'])) {
	$sql[] = "INSERT INTO care_config_global (`type`, `value`, `notes`, `status`, `history`, `modify_id`, `modify_time`, `create_id`, `create_time`)
										VALUES ('kwamoja_default_terms', '" . $_REQUEST['kwamoja_default_terms'] . "', NULL, '', '', '', NOW(), '" . $_SESSION['sess_login_userid'] . "', NOW())";
	$sql[] = "INSERT INTO care_config_global (`type`, `value`, `notes`, `status`, `history`, `modify_id`, `modify_time`, `create_id`, `create_time`)
										VALUES ('kwamoja_default_reason', '" . $_REQUEST['kwamoja_default_reason'] . "', NULL, '', '', '', NOW(), '" . $_SESSION['sess_login_userid'] . "', NOW())";
	$sql[] = "INSERT INTO care_config_global (`type`, `value`, `notes`, `status`, `history`, `modify_id`, `modify_time`, `create_id`, `create_time`)
										VALUES ('kwamoja_default_debtor_type', '" . $_REQUEST['kwamoja_default_debtor_type'] . "', NULL, '', '', '', NOW(), '" . $_SESSION['sess_login_userid'] . "', NOW())";
	$sql[] = "INSERT INTO care_config_global (`type`, `value`, `notes`, `status`, `history`, `modify_id`, `modify_time`, `create_id`, `create_time`)
										VALUES ('kwamoja_default_area', '" . $_REQUEST['kwamoja_default_area'] . "', NULL, '', '', '', NOW(), '" . $_SESSION['sess_login_userid'] . "', NOW())";
	$sql[] = "INSERT INTO care_config_global (`type`, `value`, `notes`, `status`, `history`, `modify_id`, `modify_time`, `create_id`, `create_time`)
										VALUES ('kwamoja_default_salesman', '" . $_REQUEST['kwamoja_default_salesman'] . "', NULL, '', '', '', NOW(), '" . $_SESSION['sess_login_userid'] . "', NOW())";
	$sql[] = "INSERT INTO care_config_global (`type`, `value`, `notes`, `status`, `history`, `modify_id`, `modify_time`, `create_id`, `create_time`)
										VALUES ('kwamoja_default_location', '" . $_REQUEST['kwamoja_default_location'] . "', NULL, '', '', '', NOW(), '" . $_SESSION['sess_login_userid'] . "', NOW())";
	$sql[] = "INSERT INTO care_config_global (`type`, `value`, `notes`, `status`, `history`, `modify_id`, `modify_time`, `create_id`, `create_time`)
										VALUES ('kwamoja_default_shipper', '" . $_REQUEST['kwamoja_default_shipper'] . "', NULL, '', '', '', NOW(), '" . $_SESSION['sess_login_userid'] . "', NOW())";
	$sql[] = "INSERT INTO care_config_global (`type`, `value`, `notes`, `status`, `history`, `modify_id`, `modify_time`, `create_id`, `create_time`)
										VALUES ('kwamoja_default_tax_group', '" . $_REQUEST['kwamoja_default_tax_group'] . "', NULL, '', '', '', NOW(), '" . $_SESSION['sess_login_userid'] . "', NOW())";
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
    &nbsp;&nbsp;<font color="#330066">Default KwaMoja Configuration Values</font>
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
 $PaymentTermsSQL = "SELECT termsindicator,
							terms
			FROM " . $GLOBAL_CONFIG['kwamoja_database'] . ".paymentterms";
 $Result=$db->Execute($PaymentTermsSQL);
 while ($PaymentTermsRows=$Result->FetchRow()) {
	$PaymentTerms[$PaymentTermsRows['termsindicator']] = $PaymentTermsRows['terms'];
 }

 $HoldReasonsSQL = "SELECT reasoncode,
							reasondescription
			FROM " . $GLOBAL_CONFIG['kwamoja_database'] . ".holdreasons";
 $Result=$db->Execute($HoldReasonsSQL);
 while ($HoldReasonsRows=$Result->FetchRow()) {
	$HoldReasons[$HoldReasonsRows['reasoncode']] = $HoldReasonsRows['reasondescription'];
 }

 $DebtorTypesSQL = "SELECT typeid,
							typename
			FROM " . $GLOBAL_CONFIG['kwamoja_database'] . ".debtortype";
 $Result=$db->Execute($DebtorTypesSQL);
 while ($DebtorTypesRows=$Result->FetchRow()) {
	$DebtorTypes[$DebtorTypesRows['typeid']] = $DebtorTypesRows['typename'];
 }

 $AreasSQL = "SELECT areacode,
						areadescription
			FROM " . $GLOBAL_CONFIG['kwamoja_database'] . ".areas";
 $Result=$db->Execute($AreasSQL);
 while ($AreasRows=$Result->FetchRow()) {
	$Areas[$AreasRows['areacode']] = $AreasRows['areadescription'];
 }

 $SalesManSQL = "SELECT salesmancode,
						salesmanname
			FROM " . $GLOBAL_CONFIG['kwamoja_database'] . ".salesman";
 $Result=$db->Execute($SalesManSQL);
 while ($SalesManRows=$Result->FetchRow()) {
	$SalesMen[$SalesManRows['salesmancode']] = $SalesManRows['salesmanname'];
 }

 $SalesManSQL = "SELECT salesmancode,
						salesmanname
			FROM " . $GLOBAL_CONFIG['kwamoja_database'] . ".salesman";
 $Result=$db->Execute($SalesManSQL);
 while ($SalesManRows=$Result->FetchRow()) {
	$SalesMen[$SalesManRows['salesmancode']] = $SalesManRows['salesmanname'];
 }

 $LocationsSQL = "SELECT loccode,
						locationname
			FROM " . $GLOBAL_CONFIG['kwamoja_database'] . ".locations";
 $Result=$db->Execute($LocationsSQL);
 while ($LocationsRows=$Result->FetchRow()) {
	$Locations[$LocationsRows['loccode']] = $LocationsRows['locationname'];
 }

 $ShippersSQL = "SELECT shipper_id,
						shippername
			FROM " . $GLOBAL_CONFIG['kwamoja_database'] . ".shippers";
 $Result=$db->Execute($ShippersSQL);
 while ($ShippersRows=$Result->FetchRow()) {
	$Shippers[$ShippersRows['shipper_id']] = $ShippersRows['shippername'];
 }

 $TaxGroupsSQL = "SELECT taxgroupid,
						taxgroupdescription
			FROM " . $GLOBAL_CONFIG['kwamoja_database'] . ".taxgroups";
 $Result=$db->Execute($TaxGroupsSQL);
 while ($TaxGroupRows=$Result->FetchRow()) {
	$TaxGroups[$TaxGroupRows['taxgroupid']] = $TaxGroupRows['taxgroupdescription'];
 }

echo '<form  method="post" name="form">
		<table border=0 cellspacing=1 cellpadding=5>';

echo '<tr>
		<td bgcolor="#64B2FF" align="left"><FONT  color="#050561"><b>Select the default payment terms to use on registration of patient</b></FONT></td>
		<td bgcolor="#64B2FF"  align="left">
			<select name="kwamoja_default_terms">';
echo '<option name=""></option>';
foreach ($PaymentTerms as $termid=>$terms) {
	if($GLOBAL_CONFIG['kwamoja_default_terms']==$termid) {
		echo '<option selected="selected" value="' . $termid . '">' . $terms . '</option>';
	} else {
		echo '<option value="' . $termid . '">' . $terms . '</option>';
	}
}
echo '</select>
		</td>
	</tr>';

echo '<tr>
		<td bgcolor="#64B2FF" align="left"><FONT  color="#050561"><b>Select the default hold reason to use on registration of patient</b></FONT></td>
		<td bgcolor="#64B2FF"  align="left">
			<select name="kwamoja_default_reason">';
echo '<option name=""></option>';
foreach ($HoldReasons as $code=>$reason) {
	if($GLOBAL_CONFIG['kwamoja_default_reason']==$code) {
		echo '<option selected="selected" value="' . $code . '">' . $reason . '</option>';
	} else {
		echo '<option value="' . $code . '">' . $reason . '</option>';
	}
}
echo '</select>
		</td>
	</tr>';

echo '<tr>
		<td bgcolor="#64B2FF" align="left"><FONT  color="#050561"><b>Select the default customer type to use on registration of patient</b></FONT></td>
		<td bgcolor="#64B2FF"  align="left">
			<select name="kwamoja_default_debtor_type">';
echo '<option name=""></option>';
foreach ($DebtorTypes as $typeid=>$typename) {
	if($GLOBAL_CONFIG['kwamoja_default_debtor_type']==$typeid) {
		echo '<option selected="selected" value="' . $typeid . '">' . $typename . '</option>';
	} else {
		echo '<option value="' . $typeid . '">' . $typename . '</option>';
	}
}
echo '</select>
		</td>
	</tr>';

echo '<tr>
		<td bgcolor="#64B2FF" align="left"><FONT  color="#050561"><b>Select the default sales area to use on registration of patient</b></FONT></td>
		<td bgcolor="#64B2FF"  align="left">
			<select name="kwamoja_default_area">';
echo '<option name=""></option>';
foreach ($Areas as $areacode=>$areadescription) {
	if($GLOBAL_CONFIG['kwamoja_default_area']==$areacode) {
		echo '<option selected="selected" value="' . $areacode . '">' . $areadescription . '</option>';
	} else {
		echo '<option value="' . $areacode . '">' . $areadescription . '</option>';
	}
}
echo '</select>
		</td>
	</tr>';

echo '<tr>
		<td bgcolor="#64B2FF" align="left"><FONT  color="#050561"><b>Select the default salesman to use on registration of patient</b></FONT></td>
		<td bgcolor="#64B2FF"  align="left">
			<select name="kwamoja_default_salesman">';
echo '<option name=""></option>';
foreach ($SalesMen as $code=>$name) {
	if($GLOBAL_CONFIG['kwamoja_default_salesman']==$code) {
		echo '<option selected="selected" value="' . $code . '">' . $name . '</option>';
	} else {
		echo '<option value="' . $code . '">' . $name . '</option>';
	}
}
echo '</select>
		</td>
	</tr>';

echo '<tr>
		<td bgcolor="#64B2FF" align="left"><FONT  color="#050561"><b>Select the default location to use on registration of patient</b></FONT></td>
		<td bgcolor="#64B2FF"  align="left">
			<select name="kwamoja_default_location">';
echo '<option name=""></option>';
foreach ($Locations as $loccode=>$locationname) {
	if($GLOBAL_CONFIG['kwamoja_default_location']==$loccode) {
		echo '<option selected="selected" value="' . $loccode . '">' . $locationname . '</option>';
	} else {
		echo '<option value="' . $loccode . '">' . $locationname . '</option>';
	}
}
echo '</select>
		</td>
	</tr>';

echo '<tr>
		<td bgcolor="#64B2FF" align="left"><FONT  color="#050561"><b>Select the default shipper to use on registration of patient</b></FONT></td>
		<td bgcolor="#64B2FF"  align="left">
			<select name="kwamoja_default_shipper">';
echo '<option name=""></option>';
foreach ($Shippers as $shipperid=>$shippername) {
	if($GLOBAL_CONFIG['kwamoja_default_shipper']==$shipperid) {
		echo '<option selected="selected" value="' . $shipperid . '">' . $shippername . '</option>';
	} else {
		echo '<option value="' . $shipperid . '">' . $shippername . '</option>';
	}
}
echo '</select>
		</td>
	</tr>';

echo '<tr>
		<td bgcolor="#64B2FF" align="left"><FONT  color="#050561"><b>Select the default tax group to use on registration of patient</b></FONT></td>
		<td bgcolor="#64B2FF"  align="left">
			<select name="kwamoja_default_tax_group">';
echo '<option name=""></option>';
foreach ($TaxGroups as $id=>$name) {
	if($GLOBAL_CONFIG['kwamoja_default_tax_group']==$id) {
		echo '<option selected="selected" value="' . $id . '">' . $name . '</option>';
	} else {
		echo '<option value="' . $id . '">' . $name . '</option>';
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