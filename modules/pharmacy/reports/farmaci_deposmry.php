<?php
session_start();
ob_start();
?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<?php include "phprptinc/ewrcfg2.php"; ?>
<?php include "phprptinc/ewmysql.php"; ?>
<?php include "phprptinc/ewrfn2.php"; ?>
<?php include "phprptinc/ewrsecu2.php"; ?>
<?php

// Table level constants
define("EW_REPORT_TABLE_VAR", "Farmaci_Depo", TRUE);
define("EW_REPORT_TABLE_GROUP_PER_PAGE", "grpperpage", TRUE);
define("EW_REPORT_TABLE_SESSION_GROUP_PER_PAGE", "Farmaci_Depo_grpperpage", TRUE);
define("EW_REPORT_TABLE_START_GROUP", "start", TRUE);
define("EW_REPORT_TABLE_SESSION_START_GROUP", "Farmaci_Depo_start", TRUE);
define("EW_REPORT_TABLE_SESSION_SEARCH", "Farmaci_Depo_search", TRUE);
define("EW_REPORT_TABLE_CHILD_USER_ID", "childuserid", TRUE);
define("EW_REPORT_TABLE_SESSION_CHILD_USER_ID", "Farmaci_Depo_childuserid", TRUE);

// Table level SQL
$EW_REPORT_TABLE_SQL_FROM = "care_med_orderlist INNER JOIN care_med_orderlist_sub ON (care_med_orderlist.order_nr = care_med_orderlist_sub.order_nr_sub) INNER JOIN care_department ON (care_med_orderlist.dept_nr = care_department.nr)";
$EW_REPORT_TABLE_SQL_SELECT = "SELECT care_med_orderlist.order_date, care_med_orderlist_sub.value, care_med_orderlist_sub.price, care_med_orderlist_sub.expiry_date, care_med_orderlist_sub.unit, care_med_orderlist_sub.pcs, care_med_orderlist_sub.artikelname, care_med_orderlist_sub.bestellnum, care_department.name_formal FROM " . $EW_REPORT_TABLE_SQL_FROM;
$EW_REPORT_TABLE_SQL_WHERE = "";
$EW_REPORT_TABLE_SQL_GROUPBY = "";
$EW_REPORT_TABLE_SQL_HAVING = "";
$EW_REPORT_TABLE_SQL_ORDERBY = "care_med_orderlist.order_date DESC";
$EW_REPORT_TABLE_SQL_USERID_FILTER = "";
$af_order_date = array(); // Popup filter for order_date
$af_order_date[0][0] = "@@1";
$af_order_date[0][1] = "Last month";
$af_order_date[0][2] = "ewrpt_IsLastMonth";
$af_order_date[1][0] = "@@2";
$af_order_date[1][1] = "This month";
$af_order_date[1][2] = "ewrpt_IsThisMonth";
$af_order_date[2][0] = "@@3";
$af_order_date[2][1] = "Next month";
$af_order_date[2][2] = "ewrpt_IsNextMonth";
$af_order_date[3][0] = "@@4";
$af_order_date[3][1] = "Last two weeks";
$af_order_date[3][2] = "ewrpt_IsLast2Weeks";
$af_order_date[4][0] = "@@5";
$af_order_date[4][1] = "Last week";
$af_order_date[4][2] = "ewrpt_IsLastWeek";
$af_order_date[5][0] = "@@6";
$af_order_date[5][1] = "This week";
$af_order_date[5][2] = "ewrpt_IsThisWeek";
$af_order_date[6][0] = "@@7";
$af_order_date[6][1] = "Next week";
$af_order_date[6][2] = "ewrpt_IsNextWeek";
$af_order_date[7][0] = "@@8";
$af_order_date[7][1] = "Next two weeks";
$af_order_date[7][2] = "ewrpt_IsNext2Weeks";
$af_name_formal = NULL; // Popup filter for name_formal
$af_bestellnum = NULL; // Popup filter for bestellnum
$af_artikelname = NULL; // Popup filter for artikelname
$af_unit = NULL; // Popup filter for unit
$af_pcs = NULL; // Popup filter for pcs
$af_price = NULL; // Popup filter for price
$af_value = NULL; // Popup filter for value
$af_expiry_date = NULL; // Popup filter for expiry_date
?>
<?php
$sExport = @$_GET["export"]; // Load export request
if ($sExport == "html") {

	// Printer friendly
}
if ($sExport == "excel") {
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment; filename=' . EW_REPORT_TABLE_VAR .'.xls');
}
if ($sExport == "word") {
	header('Content-Type: application/vnd.ms-word');
	header('Content-Disposition: attachment; filename=' . EW_REPORT_TABLE_VAR .'.doc');
}
?>
<?php

// Initialize common variables
// Paging variables

$nRecCount = 0; // Record count
$nStartGrp = 0; // Start group
$nStopGrp = 0; // Stop group
$nTotalGrps = 0; // Total groups
$nGrpCount = 0; // Group count
$nDisplayGrps = 10; // Groups per page
$nGrpRange = 10;

// Clear field for ext filter
$sClearExtFilter = "";

// Dropdown filters
// Field order_date

$sv_order_date = ""; $svd_order_date = "";
$sr_order_date = array();

// Field name_formal
$sv_name_formal = ""; $svd_name_formal = "";
$sr_name_formal = array();

// Field artikelname
$sv_artikelname = ""; $svd_artikelname = "";
$sr_artikelname = array();

// Extended filters
// Custom filters

$ewrpt_CustomFilters = array();
?>
<?php
$EW_REPORT_FIELD_ORDER_DATE_SQL_SELECT = "SELECT DISTINCT care_med_orderlist.order_date FROM " . $EW_REPORT_TABLE_SQL_FROM;
$EW_REPORT_FIELD_ORDER_DATE_SQL_ORDERBY = "care_med_orderlist.order_date";
$EW_REPORT_FIELD_NAME_FORMAL_SQL_SELECT = "SELECT DISTINCT care_department.name_formal FROM " . $EW_REPORT_TABLE_SQL_FROM;
$EW_REPORT_FIELD_NAME_FORMAL_SQL_ORDERBY = "care_department.name_formal";
$EW_REPORT_FIELD_ARTIKELNAME_SQL_SELECT = "SELECT DISTINCT care_med_orderlist_sub.artikelname FROM " . $EW_REPORT_TABLE_SQL_FROM;
$EW_REPORT_FIELD_ARTIKELNAME_SQL_ORDERBY = "care_med_orderlist_sub.artikelname";
?>
<?php

// Field variables
$x_order_date = NULL;
$x_name_formal = NULL;
$x_bestellnum = NULL;
$x_artikelname = NULL;
$x_unit = NULL;
$x_pcs = NULL;
$x_price = NULL;
$x_value = NULL;
$x_expiry_date = NULL;

// Group variables
$o_order_date = NULL; $g_order_date = NULL; $dg_order_date = NULL; $t_order_date = NULL; $ft_order_date = 133; $gf_order_date = $ft_order_date; $gb_order_date = ""; $gi_order_date = "0"; $rf_order_date = NULL; $rt_order_date = NULL;

// Detail variables
$o_name_formal = NULL; $t_name_formal = NULL; $ft_name_formal = 200; $rf_name_formal = NULL; $rt_name_formal = NULL;
$o_bestellnum = NULL; $t_bestellnum = NULL; $ft_bestellnum = 200; $rf_bestellnum = NULL; $rt_bestellnum = NULL;
$o_artikelname = NULL; $t_artikelname = NULL; $ft_artikelname = 200; $rf_artikelname = NULL; $rt_artikelname = NULL;
$o_unit = NULL; $t_unit = NULL; $ft_unit = 200; $rf_unit = NULL; $rt_unit = NULL;
$o_pcs = NULL; $t_pcs = NULL; $ft_pcs = 5; $rf_pcs = NULL; $rt_pcs = NULL;
$o_price = NULL; $t_price = NULL; $ft_price = 131; $rf_price = NULL; $rt_price = NULL;
$o_value = NULL; $t_value = NULL; $ft_value = 131; $rf_value = NULL; $rt_value = NULL;
$o_expiry_date = NULL; $t_expiry_date = NULL; $ft_expiry_date = 133; $rf_expiry_date = NULL; $rt_expiry_date = NULL;
?>
<?php

// Open connection to the database
$conn = ewrpt_Connect();

// Filter
$sFilter = "";

// Aggregate variables
// 1st dimension = no of groups (level 0 used for grand total)
// 2nd dimension = no of fields

$nDtls = 9;
$nGrps = 2;
$val = ewrpt_InitArray($nDtls, 0);
$cnt = ewrpt_Init2DArray($nGrps, $nDtls, 0);
$smry = ewrpt_Init2DArray($nGrps, $nDtls, 0);
$mn = ewrpt_Init2DArray($nGrps, $nDtls, NULL);
$mx = ewrpt_Init2DArray($nGrps, $nDtls, NULL);
$grandsmry = ewrpt_InitArray($nDtls, 0);
$grandmn = ewrpt_InitArray($nDtls, NULL);
$grandmx = ewrpt_InitArray($nDtls, NULL);

// Set up if accumulation required
$col = array(FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, TRUE, FALSE);

// Set up groups per page dynamically
SetUpDisplayGrps();

// Load default filter values
LoadDefaultFilters();

// Set up popup filter
SetupPopup();

// Extended filter
// Get dropdown values

GetExtendedFilterValues();

// Set up custom filters
SetupCustomFilters();

// Build extended filter
$sExtendedFilter = GetExtendedFilter();
if ($sExtendedFilter <> "") {
	if ($sFilter <> "")
  	$sExtendedFilter = "($sFilter) AND ($sExtendedFilter)";
} else {
	$sExtendedFilter = $sFilter;
}

// Check if filter applied
$bFilterApplied = CheckFilter();

// Build SQL
$sSql = ewrpt_BuildReportSql("", $EW_REPORT_TABLE_SQL_SELECT, $EW_REPORT_TABLE_SQL_WHERE, $EW_REPORT_TABLE_SQL_GROUPBY, $EW_REPORT_TABLE_SQL_HAVING, $EW_REPORT_TABLE_SQL_ORDERBY, "", $sExtendedFilter, @$sSort);

// echo $sSql . "<br />"; // Uncomment to show SQL
// Load recordset

$rs = $conn->Execute($sSql);
$rscnt = ($rs) ? $rs->RecordCount() : 0;

// Detail distinct and selection values
InitReportData($rs);
if ($nDisplayGrps <= 0) // Display all groups
	$nDisplayGrps = $nTotalGrps;
$nStartGrp = 1;

// Set up start position if not export all
if (!(EW_REPORT_EXPORT_ALL && @$sExport <> ""))
	SetUpStartGroup();
?>
<?php include "phprptinc/header.php"; ?>
<?php if (@$sExport == "") { ?>
<script type="text/javascript">
var ewrpt_DateSep = "/";
</script>
<script type="text/javascript" src="phprptjs/ewrpt.js"></script>
<script type="text/javascript">

function ewrpt_ValidateExtFilter(form_obj) {
	return true;
}
</script>
<link rel="stylesheet" type="text/css" media="all" href="jscalendar/calendar-win2k-1.css" title="win2k-1" />
<script type="text/javascript" src="jscalendar/calendar.js"></script>
<script type="text/javascript" src="jscalendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="jscalendar/calendar-setup.js"></script>
<?php } ?>
<?php if (@$sExport == "") { ?>
<script src="phprptjs/x/x_core.js" type="text/javascript"></script>
<script src="phprptjs/x/x_event.js" type="text/javascript"></script>
<script src="phprptjs/x/x_drag.js" type="text/javascript"></script>
<script src="phprptjs/popup.js" type="text/javascript"></script>
<script src="phprptjs/ewrptpop.js" type="text/javascript"></script>
<script src="FusionChartsFree/JSClass/FusionCharts.js" type="text/javascript"></script>
<script type="text/javascript">
var EW_REPORT_POPUP_ALL = "(Te gjitha)";
var EW_REPORT_POPUP_OK = "  OK  ";
var EW_REPORT_POPUP_CANCEL = "Anullo";
var EW_REPORT_POPUP_FROM = "Nga";
var EW_REPORT_POPUP_TO = "Te";
var EW_REPORT_POPUP_PLEASE_SELECT = "Ju lutem zgjidhni";
var EW_REPORT_POPUP_NO_VALUE = "Nuk eshte zgjedhur asnje vlere!";

// popup fields
<?php $jsdata = ewrpt_GetJsData($val_order_date, $sel_order_date, $ft_order_date) ?>
ewrpt_CreatePopup("Farmaci_Depo_order_date", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($val_name_formal, $sel_name_formal, $ft_name_formal) ?>
ewrpt_CreatePopup("Farmaci_Depo_name_formal", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($val_artikelname, $sel_artikelname, $ft_artikelname) ?>
ewrpt_CreatePopup("Farmaci_Depo_artikelname", [<?php echo $jsdata ?>]);
</script>
<div id="Farmaci_Depo_order_date_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Farmaci_Depo_name_formal_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Farmaci_Depo_artikelname_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<?php } ?>
<?php if (@$sExport == "") { ?>
<!-- Table Container (Begin) -->
<table id="ewContainer" cellspacing="0" cellpadding="0" border="0">
<!-- Top Container (Begin) -->
<tr><td colspan="3" class="ewPadding"><div id="ewTop" class="phpreportmaker">
<!-- top slot -->
<a name="top"></a>
<?php } ?>
Farmaci Depo
<?php if (@$sExport == "") { ?>
&nbsp;&nbsp;<a href="farmaci_deposmry.php?export=html">Per printim</a>
&nbsp;&nbsp;<a href="farmaci_deposmry.php?export=excel">Eksporto ne Excel</a>
&nbsp;&nbsp;<a href="farmaci_deposmry.php?export=word">Eksporto ne Word</a>
<?php if ($bFilterApplied) { ?>
&nbsp;&nbsp;<a href="farmaci_deposmry.php?cmd=reset">Pastro te gjithe filtrat</a>
<?php } ?>
<?php } ?>
<br /><br />
<?php if (@$sExport == "") { ?>
</div></td></tr>
<!-- Top Container (End) -->
<tr>
	<!-- Left Container (Begin) -->
	<td valign="top"><div id="ewLeft" class="phpreportmaker">
	<!-- Left slot -->
	</div></td>
	<!-- Left Container (End) -->
	<!-- Center Container - Report (Begin) -->
	<td valign="top" class="ewPadding"><div id="ewCenter" class="phpreportmaker">
	<!-- center slot -->
<?php } ?>
<!-- summary report starts -->
<div id="report_summary">
<?php if (@$sExport == "") { ?>
<?php
if (EW_REPORT_FILTER_PANEL_OPTION == 2 || (EW_REPORT_FILTER_PANEL_OPTION == 3 && $bFilterApplied) || $sExtendedFilter == "0=101") {
	$sButtonImage = "phprptimages/collapse.gif";
	$sDivDisplay = "";
} else {
	$sButtonImage = "phprptimages/expand.gif";
	$sDivDisplay = " style=\"display: none;\"";
}
?>
<a href="javascript:ewrpt_ToggleFilterPanel();" style="text-decoration: none;"><img id="ewrptToggleFilterImg" src="<?php echo $sButtonImage ?>" alt="" width="9" height="9" border="0"></a><span class="phpreportmaker">&nbsp;Filtrat</span><br /><br />
<div id="ewrptExtFilterPanel"<?php echo $sDivDisplay ?>>
<!-- Search form (begin) -->
<form name="fFarmaci_Deposummaryfilter" id="fFarmaci_Deposummaryfilter" action="farmaci_deposmry.php" onSubmit="return ewrpt_ValidateExtFilter(this);">
<table class="ewRptExtFilter">
	<tr>
		<td><span class="phpreportmaker">Data</span></td>
		<td></td>
		<td colspan="4"><span class="ewRptSearchOpr">
		<select name="sv_order_date" id="sv_order_date"<?php echo ($sClearExtFilter == 'Farmaci_Depo_order_date') ? " class=\"ewInputCleared\"" : "" ?>>
		<option value=""></option>
<?php

// Popup filter
if (is_array($ewrpt_CustomFilters)) {
	for ($i = 0; $i < count($ewrpt_CustomFilters); $i++) {
		if ($ewrpt_CustomFilters[$i][0] == 'order_date') {
?>
		<option value="<?php echo "@@" . $ewrpt_CustomFilters[$i][1] ?>"<?php if (strval($sv_order_date) == "@@" . $ewrpt_CustomFilters[$i][1]) echo " selected" ?>><?php echo $ewrpt_CustomFilters[$i][2] ?></option>
<?php
		}
	}
}
if (is_array($sr_order_date)) {
	for ($i = 0; $i < count($sr_order_date); $i++) {
?>
		<option value="<?php echo $sr_order_date[$i] ?>"<?php if (strval($sv_order_date) ==  strval($sr_order_date[$i])) echo " selected" ?>><?php echo ewrpt_DropDownDisplayValue($sr_order_date[$i], "date", 7) ?></option>
<?php
	}
}
?>
		</select>
		</span></td>
	</tr>
	<tr>
		<td><span class="phpreportmaker">Farmacia</span></td>
		<td></td>
		<td colspan="4"><span class="ewRptSearchOpr">
		<select name="sv_name_formal" id="sv_name_formal"<?php echo ($sClearExtFilter == 'Farmaci_Depo_name_formal') ? " class=\"ewInputCleared\"" : "" ?>>
		<option value=""></option>
<?php

// Popup filter
if (is_array($ewrpt_CustomFilters)) {
	for ($i = 0; $i < count($ewrpt_CustomFilters); $i++) {
		if ($ewrpt_CustomFilters[$i][0] == 'name_formal') {
?>
		<option value="<?php echo "@@" . $ewrpt_CustomFilters[$i][1] ?>"<?php if (strval($sv_name_formal) == "@@" . $ewrpt_CustomFilters[$i][1]) echo " selected" ?>><?php echo $ewrpt_CustomFilters[$i][2] ?></option>
<?php
		}
	}
}
if (is_array($sr_name_formal)) {
	for ($i = 0; $i < count($sr_name_formal); $i++) {
?>
		<option value="<?php echo $sr_name_formal[$i] ?>"<?php if (strval($sv_name_formal) ==  strval($sr_name_formal[$i])) echo " selected" ?>><?php echo ewrpt_DropDownDisplayValue($sr_name_formal[$i], "", 0) ?></option>
<?php
	}
}
?>
		</select>
		</span></td>
	</tr>
	<tr>
		<td><span class="phpreportmaker">Medikamenti</span></td>
		<td></td>
		<td colspan="4"><span class="ewRptSearchOpr">
		<select name="sv_artikelname" id="sv_artikelname"<?php echo ($sClearExtFilter == 'Farmaci_Depo_artikelname') ? " class=\"ewInputCleared\"" : "" ?>>
		<option value=""></option>
<?php

// Popup filter
if (is_array($ewrpt_CustomFilters)) {
	for ($i = 0; $i < count($ewrpt_CustomFilters); $i++) {
		if ($ewrpt_CustomFilters[$i][0] == 'artikelname') {
?>
		<option value="<?php echo "@@" . $ewrpt_CustomFilters[$i][1] ?>"<?php if (strval($sv_artikelname) == "@@" . $ewrpt_CustomFilters[$i][1]) echo " selected" ?>><?php echo $ewrpt_CustomFilters[$i][2] ?></option>
<?php
		}
	}
}
if (is_array($sr_artikelname)) {
	for ($i = 0; $i < count($sr_artikelname); $i++) {
?>
		<option value="<?php echo $sr_artikelname[$i] ?>"<?php if (strval($sv_artikelname) ==  strval($sr_artikelname[$i])) echo " selected" ?>><?php echo ewrpt_DropDownDisplayValue($sr_artikelname[$i], "", 0) ?></option>
<?php
	}
}
?>
		</select>
		</span></td>
	</tr>
</table>
<table class="ewRptExtFilter">
	<tr>
		<td><span class="phpreportmaker">
			<input type="Submit" name="Submit" id="Submit" value="Kerko">&nbsp;
			<input type="Reset" name="Reset" id="Reset" value="Pastro">&nbsp;
		</span></td>
	</tr>
</table>
</form>
<!-- Search form (end) -->
</div>
<br />
<?php } ?>
<?php if (defined("EW_REPORT_SHOW_CURRENT_FILTER")) { ?>
<div id="ewrptFilterList">
<?php ShowFilterList() ?>
</div>
<br />
<?php } ?>
<!-- Report Grid (Begin) -->
<table id="ewReport" class="ewTable">
<?php

// Set the last group to display if not export all
if (EW_REPORT_EXPORT_ALL && @$sExport <> "") {
	$nStopGrp = $nTotalGrps;
} else {
	$nStopGrp = $nStartGrp + $nDisplayGrps - 1;
}

// Stop group <= total number of groups
if (intval($nStopGrp) > intval($nTotalGrps))
	$nStopGrp = $nTotalGrps;
$nRecCount = 0;

// Init summary values
ResetLevelSummary(0);

// Get first row
if ($rscnt > 0) {
	GetRow(1);
	$nGrpCount = 1;
}

// Force show first header
$bShowFirstHeader = TRUE;
while (($rs && !$rs->EOF) || $bShowFirstHeader) {

	// Show header
	if ($bShowFirstHeader) {
?>
	<tr>
		<td valign="bottom" class="ewRptGrpHeader1">
		<?php if ($bShowFirstHeader || ChkLvlBreak(1)) { ?>
		Data
<?php if (@$sExport == "") { ?>
		<a href="#" onClick="ewrpt_ShowPopup(this.name, 'Farmaci_Depo_order_date', true, '<?php echo $rf_order_date; ?>', '<?php echo $rt_order_date; ?>');return false;" name="x_order_date<?php echo $cnt[0][0]; ?>" id="x_order_date<?php echo $cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt=""></a>
<?php } ?>
		<?php } ?>
		</td>
		<td valign="bottom" class="ewTableHeader">
		Farmacia
<?php if (@$sExport == "") { ?>
		<a href="#" onClick="ewrpt_ShowPopup(this.name, 'Farmaci_Depo_name_formal', false, '<?php echo $rf_name_formal; ?>', '<?php echo $rt_name_formal; ?>');return false;" name="x_name_formal<?php echo $cnt[0][0]; ?>" id="x_name_formal<?php echo $cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt=""></a>
<?php } ?>
		</td>
		<td valign="bottom" class="ewTableHeader">
		Kodi
		</td>
		<td valign="bottom" class="ewTableHeader">
		Medikamenti
<?php if (@$sExport == "") { ?>
		<a href="#" onClick="ewrpt_ShowPopup(this.name, 'Farmaci_Depo_artikelname', false, '<?php echo $rf_artikelname; ?>', '<?php echo $rt_artikelname; ?>');return false;" name="x_artikelname<?php echo $cnt[0][0]; ?>" id="x_artikelname<?php echo $cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt=""></a>
<?php } ?>
		</td>
		<td valign="bottom" class="ewTableHeader">
		Njesia
		</td>
		<td valign="bottom" class="ewTableHeader">
		Sasia
		</td>
		<td valign="bottom" class="ewTableHeader">
		Cmimi
		</td>
		<td valign="bottom" class="ewTableHeader">
		Vlera
		</td>
		<td valign="bottom" class="ewTableHeader">
		Skadenca
		</td>
	</tr>
<?php
		$bShowFirstHeader = FALSE;
	}
	if (intval($nGrpCount) >= intval($nStartGrp) && $nGrpCount <= $nStopGrp) {
		$nRecCount++;

		// Set row color
		$sItemRowClass = " class=\"ewTableRow\"";

		// Display alternate color for rows
		if ($nRecCount % 2 <> 1)
			$sItemRowClass = " class=\"ewTableAltRow\"";

		// Show group values
		$dg_order_date = $x_order_date;
		if ((is_null($x_order_date) && is_null($o_order_date)) ||
			(($x_order_date <> "" && $o_order_date == $dg_order_date) && !ChkLvlBreak(1))) {
			$dg_order_date = "";
		} elseif (is_null($x_order_date)) {
			$dg_order_date = EW_REPORT_NULL_LABEL;
		} elseif ($x_order_date == "") {
			$dg_order_date = EW_REPORT_EMPTY_LABEL;
		}
?>
	<tr<?php echo $sItemRowClass; ?>>
		<td class="ewRptGrpField1">
		<?php $t_order_date = $x_order_date; $x_order_date = $dg_order_date; ?>
<?php echo ewrpt_FormatDateTime($x_order_date,7) ?>
		<?php $x_order_date = $t_order_date; ?></td>
		<td class="ewRptDtlField">
<?php echo $x_name_formal ?>
</td>
		<td class="ewRptDtlField">
<?php echo $x_bestellnum ?>
</td>
		<td class="ewRptDtlField">
<?php echo $x_artikelname ?>
</td>
		<td class="ewRptDtlField">
<div align="right"><?php echo $x_unit ?></div>
</td>
		<td class="ewRptDtlField">
<div align="right"><?php echo $x_pcs ?></div>
</td>
		<td class="ewRptDtlField">
<div align="right"><?php echo $x_price ?></div>
</td>
		<td class="ewRptDtlField">
<div align="right"><?php echo $x_value ?></div>
</td>
		<td class="ewRptDtlField">
<div align="right"><?php echo ewrpt_FormatDateTime($x_expiry_date,7) ?></div>
</td>
	</tr>
<?php

		// Accumulate page summary
		AccumulateSummary();
	}

	// Accumulate grand summary
	AccumulateGrandSummary();

	// Save old group values
	$o_order_date = $x_order_date;

	// Get next record
	GetRow(2);

	// Show Footers
	if (intval($nGrpCount) >= intval($nStartGrp) && $nGrpCount <= $nStopGrp) {
?>
<?php
		if (ChkLvlBreak(1) && intval(@$cnt[1][0]) > 0) {
?>
	<tr>
		<td colspan="9" class="ewRptGrpSummary1">Permbledhja per Data: <?php $t_order_date = $x_order_date; $x_order_date = $o_order_date; ?>
<?php echo ewrpt_FormatDateTime($x_order_date,7) ?>
<?php $x_order_date = $t_order_date; ?> (<?php echo ewrpt_FormatNumber($cnt[1][0],0,-2,-2,-2); ?> Detajet e vleres)</td></tr>
	<tr>
		<td colspan="1" class="ewRptGrpSummary1">SHUMA</td>
		<td class="ewRptGrpSummary1">&nbsp;</td>
		<td class="ewRptGrpSummary1">&nbsp;</td>
		<td class="ewRptGrpSummary1">&nbsp;</td>
		<td class="ewRptGrpSummary1">&nbsp;</td>
		<td class="ewRptGrpSummary1">&nbsp;</td>
		<td class="ewRptGrpSummary1">&nbsp;</td>
		<td class="ewRptGrpSummary1">
		<?php $t_value = $x_value; ?>
		<?php $x_value = $smry[1][7]; // Load SUM ?>
<div align="right"><?php echo $x_value ?></div>
		<?php $x_value = $t_value; ?>
		</td>
		<td class="ewRptGrpSummary1">&nbsp;</td>
	</tr>
<?php

			// Reset level 1 summary
			ResetLevelSummary(1);
		}
?>
<?php
	}

	// Increment group count
	if (ChkLvlBreak(1))
		$nGrpCount++;
} // End while
?>
<?php if ($nTotalGrps > 0) { ?>
	<!-- tr><td colspan="9"><span class="phpreportmaker">&nbsp;<br /></span></td></tr -->
	<tr class="ewRptGrandSummary"><td colspan="9">Totali i madh (<?php echo ewrpt_FormatNumber($cnt[0][0],0,-2,-2,-2); ?> Detajet e vleres)</td></tr>
	<tr class="ewRptGrandSummary">
		<td colspan="1" class="ewRptGrpAggregate">SHUMA</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>
		<?php $t_value = $x_value; ?>
		<?php $x_value = $grandsmry[7]; // Load SUM ?>
<div align="right"><?php echo $x_value ?></div>
		<?php $x_value = $t_value; ?>
		</td>
		<td>&nbsp;</td>
	</tr>
<?php } ?>
</table>
<br />
<?php if (@$sExport == "") { ?>
<form action="farmaci_deposmry.php" name="ewpagerform" id="ewpagerform">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td nowrap>
<?php
if ($nTotalGrps > 0) {
	$rsEof = ($nTotalGrps < ($nStartGrp + $nDisplayGrps));
	$PrevStart = $nStartGrp - $nDisplayGrps;
	if ($PrevStart < 1)
		$PrevStart = 1;
	$NextStart = $nStartGrp + $nDisplayGrps;
	if ($NextStart > $nTotalGrps)
		$NextStart = $nStartGrp;
	$LastStart = intval(($nTotalGrps-1)/$nDisplayGrps)*$nDisplayGrps+1;
?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker">Faqe&nbsp;</span></td>
<!--first page button-->
	<?php if ($nStartGrp == 1) { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="Pare" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><a href="farmaci_deposmry.php?start=1"><img src="phprptimages/first.gif" alt="Pare" width="16" height="16" border="0"></a></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($PrevStart == $nStartGrp) { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="Paraardhes" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><a href="farmaci_deposmry.php?start=<?php echo $PrevStart; ?>"><img src="phprptimages/prev.gif" alt="Paraardhes" width="16" height="16" border="0"></a></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" value="<?php echo intval(($nStartGrp-1)/$nDisplayGrps+1); ?>" size="4"></td>
<!--next page button-->
	<?php if ($NextStart == $nStartGrp) { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="Pasardhes" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><a href="farmaci_deposmry.php?start=<?php echo $NextStart; ?>"><img src="phprptimages/next.gif" alt="Pasardhes" width="16" height="16" border="0"></a></td>
	<?php  } ?>
<!--last page button-->
	<?php if ($LastStart == $nStartGrp) { ?>
	<td><img src="phprptimages/lastdisab.gif" alt="fundit" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><a href="farmaci_deposmry.php?start=<?php echo $LastStart; ?>"><img src="phprptimages/last.gif" alt="fundit" width="16" height="16" border="0"></a></td>
	<?php } ?>
	<td><span class="phpreportmaker">&nbsp;nga <?php echo intval(($nTotalGrps-1)/$nDisplayGrps+1);?></span></td>
	</tr></table>
	<?php
	if ($nStartGrp > $nTotalGrps)
		$nStartGrp = $nTotalGrps;
	$nStopGrp = $nStartGrp + $nDisplayGrps - 1;
	$nGrpCount = $nTotalGrps - 1;
	if ($rsEof)
		$nGrpCount = $nTotalGrps;
	if ($nStopGrp > $nGrpCount)
		$nStopGrp = $nGrpCount; ?>
	<span class="phpreportmaker"> <?php echo $nStartGrp; ?> te <?php echo $nStopGrp; ?> nga <?php echo $nTotalGrps; ?></span>
<?php } else { ?>
	<?php if ($sExtendedFilter == "0=101") { ?>
	<span class="phpreportmaker">Jeni nje kriter kerkimi</span>
	<?php } else { ?>
	<span class="phpreportmaker">Nuk ka value</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($nTotalGrps > 0) { ?>
		<td nowrap>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" valign="top" nowrap><span class="phpreportmaker">Grupe per faqe&nbsp;
<select name="<?php echo EW_REPORT_TABLE_GROUP_PER_PAGE; ?>" onChange="this.form.submit();" class="phpreportmaker">
<option value="1"<?php if ($nDisplayGrps == 1) echo " selected" ?>>1</option>
<option value="2"<?php if ($nDisplayGrps == 2) echo " selected" ?>>2</option>
<option value="3"<?php if ($nDisplayGrps == 3) echo " selected" ?>>3</option>
<option value="4"<?php if ($nDisplayGrps == 4) echo " selected" ?>>4</option>
<option value="5"<?php if ($nDisplayGrps == 5) echo " selected" ?>>5</option>
<option value="10"<?php if ($nDisplayGrps == 10) echo " selected" ?>>10</option>
<option value="20"<?php if ($nDisplayGrps == 20) echo " selected" ?>>20</option>
<option value="50"<?php if ($nDisplayGrps == 50) echo " selected" ?>>50</option>
<option value="ALL"<?php if (@$_SESSION[EW_REPORT_TABLE_SESSION_GROUP_PER_PAGE] == -1) echo " selected" ?>>Te gjitha valuet</option>
</select>
		</span></td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
</div>
<!-- Summary Report Ends -->
<?php if (@$sExport == "") { ?>
	</div><br /></td>
	<!-- Center Container - Report (End) -->
	<!-- Right Container (Begin) -->
	<td valign="top"><div id="ewRight" class="phpreportmaker">
	<!-- Right slot -->
	</div></td>
	<!-- Right Container (End) -->
</tr>
<!-- Bottom Container (Begin) -->
<tr><td colspan="3"><div id="ewBottom" class="phpreportmaker">
	<!-- Bottom slot -->
	</div><br /></td></tr>
<!-- Bottom Container (End) -->
</table>
<!-- Table Container (End) -->
<?php } ?>
<?php
$conn->Close();
?>
<?php include "phprptinc/footer.php"; ?>
<?php

// Check level break
function ChkLvlBreak($lvl) {
	switch ($lvl) {
		case 1:
			return (is_null($GLOBALS["x_order_date"]) && !is_null($GLOBALS["o_order_date"])) ||
				(!is_null($GLOBALS["x_order_date"]) && is_null($GLOBALS["o_order_date"])) ||
				($GLOBALS["x_order_date"] <> $GLOBALS["o_order_date"]);
	}
}

// Accummulate summary
function AccumulateSummary() {
	global $smry, $cnt, $col, $val, $mn, $mx;
	for ($ix = 0; $ix < count($smry); $ix++) {
		for ($iy = 1; $iy < count($smry[$ix]); $iy++) {
			$cnt[$ix][$iy]++;
			if ($col[$iy]) {
				$valwrk = $val[$iy];
				if (is_null($valwrk) || !is_numeric($valwrk)) {

					// skip
				} else {
					$smry[$ix][$iy] += $valwrk;
					if (is_null($mn[$ix][$iy])) {
						$mn[$ix][$iy] = $valwrk;
						$mx[$ix][$iy] = $valwrk;
					} else {
						if ($mn[$ix][$iy] > $valwrk) $mn[$ix][$iy] = $valwrk;
						if ($mx[$ix][$iy] < $valwrk) $mx[$ix][$iy] = $valwrk;
					}
				}
			}
		}
	}
	for ($ix = 1; $ix < count($smry); $ix++) {
		$cnt[$ix][0]++;
	}
}

// Reset level summary
function ResetLevelSummary($lvl) {
	global $smry, $cnt, $col, $mn, $mx, $nRecCount, $grandsmry;

	// Clear summary values
	for ($ix = $lvl; $ix < count($smry); $ix++) {
		for ($iy = 1; $iy < count($smry[$ix]); $iy++) {
			$cnt[$ix][$iy] = 0;
			if ($col[$iy]) {
				$smry[$ix][$iy] = 0;
				$mn[$ix][$iy] = NULL;
				$mx[$ix][$iy] = NULL;
			}
		}
	}
	for ($ix = $lvl; $ix < count($smry); $ix++) {
		$cnt[$ix][0] = 0;
	}

	// Clear grand summary
	if ($lvl == 0) {
		for ($iy = 1; $iy < count($grandsmry[$iy]); $iy++) {
			if ($col[$iy]) {
				$grandsmry[$iy] = 0;
				$grandmn[$iy] = NULL;
				$grandmx[$iy] = NULL;
			}
		}
	}

	// Clear old values
	if ($lvl <= 1) $GLOBALS["o_order_date"] = "";

	// Reset record count
	$nRecCount = 0;
}

// Accummulate grand summary
function AccumulateGrandSummary() {
	global $cnt, $col, $val, $grandsmry, $grandmn, $grandmx;
	@$cnt[0][0]++;
	for ($iy = 1; $iy < count($grandsmry); $iy++) {
		if ($col[$iy]) {
			$valwrk = $val[$iy];
			if (is_null($valwrk) || !is_numeric($valwrk)) {

				// skip
			} else {
				$grandsmry[$iy] += $valwrk;
				if (is_null($grandmn[$iy])) {
					$grandmn[$iy] = $valwrk;
					$grandmx[$iy] = $valwrk;
				} else {
					if ($grandmn[$iy] > $valwrk) $grandmn[$iy] = $valwrk;
					if ($grandmx[$iy] < $valwrk) $grandmx[$iy] = $valwrk;
				}
			}
		}
	}
}

// Get row values
function GetRow($opt) {
	global $rs, $val;
	if (!$rs)
		return;
	if ($opt == 1) { // Get first row
		$rs->MoveFirst();
	} else { // Get next row
		$rs->MoveNext();
	}
	while (!$rs->EOF) {
		if (ValidRow($rs)) {
			$GLOBALS['x_order_date'] = $rs->fields('order_date');
			$GLOBALS['x_name_formal'] = $rs->fields('name_formal');
			$GLOBALS['x_bestellnum'] = $rs->fields('bestellnum');
			$GLOBALS['x_artikelname'] = $rs->fields('artikelname');
			$GLOBALS['x_unit'] = $rs->fields('unit');
			$GLOBALS['x_pcs'] = $rs->fields('pcs');
			$GLOBALS['x_price'] = $rs->fields('price');
			$GLOBALS['x_value'] = $rs->fields('value');
			$GLOBALS['x_expiry_date'] = $rs->fields('expiry_date');
			$val[1] = $GLOBALS['x_name_formal'];
			$val[2] = $GLOBALS['x_bestellnum'];
			$val[3] = $GLOBALS['x_artikelname'];
			$val[4] = $GLOBALS['x_unit'];
			$val[5] = $GLOBALS['x_pcs'];
			$val[6] = $GLOBALS['x_price'];
			$val[7] = $GLOBALS['x_value'];
			$val[8] = $GLOBALS['x_expiry_date'];
			break;
		} else {
			$rs->MoveNext();
		}
	}
	if ($rs->EOF) {
		$GLOBALS['x_order_date'] = "";
		$GLOBALS['x_name_formal'] = "";
		$GLOBALS['x_bestellnum'] = "";
		$GLOBALS['x_artikelname'] = "";
		$GLOBALS['x_unit'] = "";
		$GLOBALS['x_pcs'] = "";
		$GLOBALS['x_price'] = "";
		$GLOBALS['x_value'] = "";
		$GLOBALS['x_expiry_date'] = "";
	}
}

//  Set up starting group
function SetUpStartGroup() {
	global $nStartGrp, $nTotalGrps, $nDisplayGrps;

	// Exit if no groups
	if ($nDisplayGrps == 0)
		return;

	// Check for a 'start' parameter
	if (@$_GET[EW_REPORT_TABLE_START_GROUP] != "") {
		$nStartGrp = $_GET[EW_REPORT_TABLE_START_GROUP];
		$_SESSION[EW_REPORT_TABLE_SESSION_START_GROUP] = $nStartGrp;
	} elseif (@$_GET["pageno"] != "") {
		$nPageNo = $_GET["pageno"];
		if (is_numeric($nPageNo)) {
			$nStartGrp = ($nPageNo-1)*$nDisplayGrps+1;
			if ($nStartGrp <= 0) {
				$nStartGrp = 1;
			} elseif ($nStartGrp >= intval(($nTotalGrps-1)/$nDisplayGrps)*$nDisplayGrps+1) {
				$nStartGrp = intval(($nTotalGrps-1)/$nDisplayGrps)*$nDisplayGrps+1;
			}
			$_SESSION[EW_REPORT_TABLE_SESSION_START_GROUP] = $nStartGrp;
		} else {
			$nStartGrp = @$_SESSION[EW_REPORT_TABLE_SESSION_START_GROUP];
		}
	} else {
		$nStartGrp = @$_SESSION[EW_REPORT_TABLE_SESSION_START_GROUP];	
	}

	// Check if correct start group counter
	if (!is_numeric($nStartGrp) || $nStartGrp == "") { // Avoid invalid start group counter
		$nStartGrp = 1; // Reset start group counter
		$_SESSION[EW_REPORT_TABLE_SESSION_START_GROUP] = $nStartGrp;
	} elseif (intval($nStartGrp) > intval($nTotalGrps)) { // Avoid starting group > total groups
		$nStartGrp = intval(($nTotalGrps-1)/$nDisplayGrps) * $nDisplayGrps + 1; // Point to last page first group
		$_SESSION[EW_REPORT_TABLE_SESSION_START_GROUP] = $nStartGrp;
	} elseif (($nStartGrp-1) % $nDisplayGrps <> 0) {
		$nStartGrp = intval(($nStartGrp-1)/$nDisplayGrps) * $nDisplayGrps + 1; // Point to page boundary
		$_SESSION[EW_REPORT_TABLE_SESSION_START_GROUP] = $nStartGrp;
	}
}

// Set up popup
function SetupPopup() {
	global $conn, $sFilter;

	// Initialize popup
	// Build distinct values for order_date

	ewrpt_SetupDistinctValuesFromFilter($GLOBALS["val_order_date"], $GLOBALS["af_order_date"]); // Set up popup filter
	$bNullValue = FALSE;
	$bEmptyValue = FALSE;
	$sSql = ewrpt_BuildReportSql("", $GLOBALS["EW_REPORT_FIELD_ORDER_DATE_SQL_SELECT"], $GLOBALS["EW_REPORT_TABLE_SQL_WHERE"], $GLOBALS["EW_REPORT_TABLE_SQL_GROUPBY"], $GLOBALS["EW_REPORT_TABLE_SQL_HAVING"], $GLOBALS["EW_REPORT_FIELD_ORDER_DATE_SQL_ORDERBY"], "", $sFilter, "");
	$rswrk = $conn->Execute($sSql);
	while ($rswrk && !$rswrk->EOF) {
		$x_order_date = $rswrk->fields[0];
		if (is_null($x_order_date)) {
			$bNullValue = TRUE;
		} elseif ($x_order_date == "") {
			$bEmptyValue = TRUE;
		} else {
			$g_order_date = $x_order_date;
			$dg_order_date = ewrpt_FormatDateTime($x_order_date,7);
			ewrpt_SetupDistinctValues($GLOBALS["val_order_date"], $g_order_date, $dg_order_date, FALSE);
		}
		$rswrk->MoveNext();
	}
	if ($rswrk)
		$rswrk->Close();
	if ($bEmptyValue)
		ewrpt_SetupDistinctValues($GLOBALS["val_order_date"], EW_REPORT_EMPTY_VALUE, EW_REPORT_EMPTY_LABEL, FALSE);
	if ($bNullValue)
		ewrpt_SetupDistinctValues($GLOBALS["val_order_date"], EW_REPORT_NULL_VALUE, EW_REPORT_NULL_LABEL, FALSE);

	// Build distinct values for name_formal
	$bNullValue = FALSE;
	$bEmptyValue = FALSE;
	$sSql = ewrpt_BuildReportSql("", $GLOBALS["EW_REPORT_FIELD_NAME_FORMAL_SQL_SELECT"], $GLOBALS["EW_REPORT_TABLE_SQL_WHERE"], $GLOBALS["EW_REPORT_TABLE_SQL_GROUPBY"], $GLOBALS["EW_REPORT_TABLE_SQL_HAVING"], $GLOBALS["EW_REPORT_FIELD_NAME_FORMAL_SQL_ORDERBY"], "", $sFilter, "");
	$rswrk = $conn->Execute($sSql);
	while ($rswrk && !$rswrk->EOF) {
		$x_name_formal = $rswrk->fields[0];
		if (is_null($x_name_formal)) {
			$bNullValue = TRUE;
		} elseif ($x_name_formal == "") {
			$bEmptyValue = TRUE;
		} else {
			$t_name_formal = $x_name_formal;
			ewrpt_SetupDistinctValues($GLOBALS["val_name_formal"], $x_name_formal, $t_name_formal, FALSE);
		}
		$rswrk->MoveNext();
	}
	if ($rswrk)
		$rswrk->Close();
	if ($bEmptyValue)
		ewrpt_SetupDistinctValues($GLOBALS["val_name_formal"], EW_REPORT_EMPTY_VALUE, EW_REPORT_EMPTY_LABEL, FALSE);
	if ($bNullValue)
		ewrpt_SetupDistinctValues($GLOBALS["val_name_formal"], EW_REPORT_NULL_VALUE, EW_REPORT_NULL_LABEL, FALSE);

	// Build distinct values for artikelname
	$bNullValue = FALSE;
	$bEmptyValue = FALSE;
	$sSql = ewrpt_BuildReportSql("", $GLOBALS["EW_REPORT_FIELD_ARTIKELNAME_SQL_SELECT"], $GLOBALS["EW_REPORT_TABLE_SQL_WHERE"], $GLOBALS["EW_REPORT_TABLE_SQL_GROUPBY"], $GLOBALS["EW_REPORT_TABLE_SQL_HAVING"], $GLOBALS["EW_REPORT_FIELD_ARTIKELNAME_SQL_ORDERBY"], "", $sFilter, "");
	$rswrk = $conn->Execute($sSql);
	while ($rswrk && !$rswrk->EOF) {
		$x_artikelname = $rswrk->fields[0];
		if (is_null($x_artikelname)) {
			$bNullValue = TRUE;
		} elseif ($x_artikelname == "") {
			$bEmptyValue = TRUE;
		} else {
			$t_artikelname = $x_artikelname;
			ewrpt_SetupDistinctValues($GLOBALS["val_artikelname"], $x_artikelname, $t_artikelname, FALSE);
		}
		$rswrk->MoveNext();
	}
	if ($rswrk)
		$rswrk->Close();
	if ($bEmptyValue)
		ewrpt_SetupDistinctValues($GLOBALS["val_artikelname"], EW_REPORT_EMPTY_VALUE, EW_REPORT_EMPTY_LABEL, FALSE);
	if ($bNullValue)
		ewrpt_SetupDistinctValues($GLOBALS["val_artikelname"], EW_REPORT_NULL_VALUE, EW_REPORT_NULL_LABEL, FALSE);

	// Process post back form
	if (count($_POST) > 0) {
		$sName = @$_POST["popup"]; // Get popup form name
		if ($sName <> "") {
		$cntValues = (is_array(@$_POST["sel_$sName"])) ? count($_POST["sel_$sName"]) : 0;
			if ($cntValues > 0) {
				$arValues = ewrpt_StripSlashes($_POST["sel_$sName"]);
				if (trim($arValues[0]) == "") // Select all
					$arValues = EW_REPORT_INIT_VALUE;
				if (!ewrpt_MatchedArray($arValues, $_SESSION["sel_$sName"])) {
					if (HasSessionFilterValues($sName))
						$GLOBALS["sClearExtFilter"] = $sName; // Clear extended filter for this field
				}
				$_SESSION["sel_$sName"] = $arValues;
				$_SESSION["rf_$sName"] = ewrpt_StripSlashes(@$_POST["rf_$sName"]);
				$_SESSION["rt_$sName"] = ewrpt_StripSlashes(@$_POST["rt_$sName"]);
				ResetPager();
			}
		}

	// Get 'reset' command
	} elseif (@$_GET["cmd"] <> "") {
		$sCmd = $_GET["cmd"];
		if (strtolower($sCmd) == "reset") {
			ClearSessionSelection('order_date');
			ClearSessionSelection('name_formal');
			ClearSessionSelection('artikelname');
			ResetPager();
		}
	}

	// Load selection criteria to array
	// Get Data selected values

	if (is_array(@$_SESSION["sel_Farmaci_Depo_order_date"])) {
		LoadSelectionFromSession('order_date');
	} elseif (@$_SESSION["sel_Farmaci_Depo_order_date"] == EW_REPORT_INIT_VALUE) { // Select all
		$GLOBALS["sel_order_date"] = "";
	}

	// Get Farmacia selected values
	if (is_array(@$_SESSION["sel_Farmaci_Depo_name_formal"])) {
		LoadSelectionFromSession('name_formal');
	} elseif (@$_SESSION["sel_Farmaci_Depo_name_formal"] == EW_REPORT_INIT_VALUE) { // Select all
		$GLOBALS["sel_name_formal"] = "";
	}

	// Get Medikamenti selected values
	if (is_array(@$_SESSION["sel_Farmaci_Depo_artikelname"])) {
		LoadSelectionFromSession('artikelname');
	} elseif (@$_SESSION["sel_Farmaci_Depo_artikelname"] == EW_REPORT_INIT_VALUE) { // Select all
		$GLOBALS["sel_artikelname"] = "";
	}
}

// Reset pager
function ResetPager() {

	// Reset start position (reset command)
	global $nStartGrp, $nTotalGrps;
	$nStartGrp = 1;
	$_SESSION[EW_REPORT_TABLE_SESSION_START_GROUP] = $nStartGrp;
}

// Initialize group data - total number of groups + grouping field arrays
function InitReportData(&$rs) {
	global $nTotalGrps;

	// Initialize group count
	$grpcnt = 0;
	while ($rs && !$rs->EOF) {
		$bValidRow = ValidRow($rs);

		// Update group count
		if ($bValidRow) {
			$x_order_date = $rs->fields('order_date');
			$g_order_date = $x_order_date;
			$bNewGroup = ($grpcnt == 0) ||
				(is_null($grpvalue) && !is_null($x_order_date)) ||
				(!is_null($grpvalue) && is_null($x_order_date)) ||
				(@$grpvalue <> $g_order_date);
			if ($bNewGroup) {
				$grpvalue = $g_order_date;
				$grpcnt++;
			}
		}
		$rs->MoveNext();
	}

	// Set up total number of groups
	$nTotalGrps = $grpcnt;
}

// Check if row is valid
function ValidRow(&$rs) {
	if (!ewrpt_SelectedValue($GLOBALS["sel_order_date"], $rs->fields('order_date'), $GLOBALS["ft_order_date"], $GLOBALS["af_order_date"]))
		return FALSE;
	if (!ewrpt_SelectedValue($GLOBALS["sel_name_formal"], $rs->fields('name_formal'), $GLOBALS["ft_name_formal"], $GLOBALS["af_name_formal"]))
		return FALSE;
	if (!ewrpt_SelectedValue($GLOBALS["sel_artikelname"], $rs->fields('artikelname'), $GLOBALS["ft_artikelname"], $GLOBALS["af_artikelname"]))
		return FALSE;
	return TRUE;
}
?>
<?php

// Set up number of groups displayed per page
function SetUpDisplayGrps() {
	global $nDisplayGrps, $nStartGrp;
	$sWrk = @$_GET[EW_REPORT_TABLE_GROUP_PER_PAGE];
	if ($sWrk <> "") {
		if (is_numeric($sWrk)) {
			$nDisplayGrps = intval($sWrk);
		} else {
			if (strtoupper($sWrk) == "ALL") { // display all groups
				$nDisplayGrps = -1;
			} else {
				$nDisplayGrps = 10; // Non-numeric, load default
			}
		}
		$_SESSION[EW_REPORT_TABLE_SESSION_GROUP_PER_PAGE] = $nDisplayGrps; // Save to session

		// Reset start position (reset command)
		$nStartGrp = 1;
		$_SESSION[EW_REPORT_TABLE_SESSION_START_GROUP] = $nStartGrp;
	} else {
		if (@$_SESSION[EW_REPORT_TABLE_SESSION_GROUP_PER_PAGE] <> "") {
			$nDisplayGrps = $_SESSION[EW_REPORT_TABLE_SESSION_GROUP_PER_PAGE]; // Restore from session
		} else {
			$nDisplayGrps = 10; // Load default
		}
	}
}
?>
<?php

// Get extended filter values
function GetExtendedFilterValues() {

	// Field order_date
	$sSelect = "SELECT DISTINCT care_med_orderlist.order_date FROM " . $GLOBALS["EW_REPORT_TABLE_SQL_FROM"];
	$sOrderBy = "care_med_orderlist.order_date ASC";
	$wrkSql = ewrpt_BuildReportSql("", $sSelect, $GLOBALS["EW_REPORT_TABLE_SQL_WHERE"], "", "", $sOrderBy, "", "", "");
	$GLOBALS["sr_order_date"] = ewrpt_GetDistinctValues("date", $wrkSql);

	// Field name_formal
	$sSelect = "SELECT DISTINCT care_department.name_formal FROM " . $GLOBALS["EW_REPORT_TABLE_SQL_FROM"];
	$sOrderBy = "care_department.name_formal ASC";
	$wrkSql = ewrpt_BuildReportSql("", $sSelect, $GLOBALS["EW_REPORT_TABLE_SQL_WHERE"], "", "", $sOrderBy, "", "", "");
	$GLOBALS["sr_name_formal"] = ewrpt_GetDistinctValues("", $wrkSql);

	// Field artikelname
	$sSelect = "SELECT DISTINCT care_med_orderlist_sub.artikelname FROM " . $GLOBALS["EW_REPORT_TABLE_SQL_FROM"];
	$sOrderBy = "care_med_orderlist_sub.artikelname ASC";
	$wrkSql = ewrpt_BuildReportSql("", $sSelect, $GLOBALS["EW_REPORT_TABLE_SQL_WHERE"], "", "", $sOrderBy, "", "", "");
	$GLOBALS["sr_artikelname"] = ewrpt_GetDistinctValues("", $wrkSql);
}

// Return extended filter
function GetExtendedFilter() {
	$sFilter = "";
	$bPostBack = (count($_POST) > 0);
	$bRestoreSession = TRUE;
	$bSetupFilter = FALSE;

	// Reset extended filter if filter changed
	if ($bPostBack) {

		// Clear dropdown for field order_date
		if ($GLOBALS["sClearExtFilter"] == 'Farmaci_Depo_order_date')
			SetSessionDropDownValue(EW_REPORT_INIT_VALUE, 'order_date');

		// Clear dropdown for field name_formal
		if ($GLOBALS["sClearExtFilter"] == 'Farmaci_Depo_name_formal')
			SetSessionDropDownValue(EW_REPORT_INIT_VALUE, 'name_formal');

		// Clear dropdown for field artikelname
		if ($GLOBALS["sClearExtFilter"] == 'Farmaci_Depo_artikelname')
			SetSessionDropDownValue(EW_REPORT_INIT_VALUE, 'artikelname');

	// Reset search command
	} elseif (@$_GET["cmd"] == "reset") {

		// Load default values
		// Field order_date

		SetSessionDropDownValue($GLOBALS["sv_order_date"], 'order_date');

		// Field name_formal
		SetSessionDropDownValue($GLOBALS["sv_name_formal"], 'name_formal');

		// Field artikelname
		SetSessionDropDownValue($GLOBALS["sv_artikelname"], 'artikelname');
		$bSetupFilter = TRUE;
	} else {

		// Field order_date
		if (GetDropDownValue($GLOBALS["sv_order_date"], 'order_date')) {
			$bSetupFilter = TRUE;
			$bRestoreSession = FALSE;
		} elseif ($GLOBALS["sv_order_date"] <> EW_REPORT_INIT_VALUE && !isset($_SESSION['sv_Farmaci_Depo_order_date'])) {
			$bSetupFilter = TRUE;
		}

		// Field name_formal
		if (GetDropDownValue($GLOBALS["sv_name_formal"], 'name_formal')) {
			$bSetupFilter = TRUE;
			$bRestoreSession = FALSE;
		} elseif ($GLOBALS["sv_name_formal"] <> EW_REPORT_INIT_VALUE && !isset($_SESSION['sv_Farmaci_Depo_name_formal'])) {
			$bSetupFilter = TRUE;
		}

		// Field artikelname
		if (GetDropDownValue($GLOBALS["sv_artikelname"], 'artikelname')) {
			$bSetupFilter = TRUE;
			$bRestoreSession = FALSE;
		} elseif ($GLOBALS["sv_artikelname"] <> EW_REPORT_INIT_VALUE && !isset($_SESSION['sv_Farmaci_Depo_artikelname'])) {
			$bSetupFilter = TRUE;
		}
	}

	// Restore session
	if ($bRestoreSession) {

		// Field order_date
		GetSessionDropDownValue($GLOBALS["sv_order_date"], 'order_date');

		// Field name_formal
		GetSessionDropDownValue($GLOBALS["sv_name_formal"], 'name_formal');

		// Field artikelname
		GetSessionDropDownValue($GLOBALS["sv_artikelname"], 'artikelname');
	}

	// Build SQL
	// Field order_date

	BuildDropDownFilter($sFilter, 'order_date', 'care_med_orderlist.order_date', EW_REPORT_DATATYPE_DATE, 7, $GLOBALS["sv_order_date"], "");

	// Field name_formal
	BuildDropDownFilter($sFilter, 'name_formal', 'care_department.name_formal', EW_REPORT_DATATYPE_STRING, 0, $GLOBALS["sv_name_formal"], "");

	// Field artikelname
	BuildDropDownFilter($sFilter, 'artikelname', 'care_med_orderlist_sub.artikelname', EW_REPORT_DATATYPE_STRING, 0, $GLOBALS["sv_artikelname"], "");

	// Save parms to session
	// Field order_date

	SetSessionDropDownValue($GLOBALS["sv_order_date"], 'order_date');

	// Field name_formal
	SetSessionDropDownValue($GLOBALS["sv_name_formal"], 'name_formal');

	// Field artikelname
	SetSessionDropDownValue($GLOBALS["sv_artikelname"], 'artikelname');

	// Setup filter
	if ($bSetupFilter) {

		// Field order_date
		//$GLOBALS["sel_order_date"] = "";

		$sWrk = "";
		BuildDropDownFilter($sWrk, 'order_date', 'care_med_orderlist.order_date', EW_REPORT_DATATYPE_DATE, 7, $GLOBALS["sv_order_date"], "");
		LoadSelectionFromFilter('order_date', $sWrk, $GLOBALS["sel_order_date"]);
		$_SESSION['sel_Farmaci_Depo_order_date'] = $GLOBALS["sel_order_date"];

		// Field name_formal
		//$GLOBALS["sel_name_formal"] = "";

		$sWrk = "";
		BuildDropDownFilter($sWrk, 'name_formal', 'care_department.name_formal', EW_REPORT_DATATYPE_STRING, 0, $GLOBALS["sv_name_formal"], "");
		LoadSelectionFromFilter('name_formal', $sWrk, $GLOBALS["sel_name_formal"]);
		$_SESSION['sel_Farmaci_Depo_name_formal'] = $GLOBALS["sel_name_formal"];

		// Field artikelname
		//$GLOBALS["sel_artikelname"] = "";

		$sWrk = "";
		BuildDropDownFilter($sWrk, 'artikelname', 'care_med_orderlist_sub.artikelname', EW_REPORT_DATATYPE_STRING, 0, $GLOBALS["sv_artikelname"], "");
		LoadSelectionFromFilter('artikelname', $sWrk, $GLOBALS["sel_artikelname"]);
		$_SESSION['sel_Farmaci_Depo_artikelname'] = $GLOBALS["sel_artikelname"];
	}
	return $sFilter;
}

// Get drop down value from querystring
function GetDropDownValue(&$sv, $parm) {
	if (count($_POST) > 0)
		return FALSE; // Skip post back
	if (isset($_GET["sv_$parm"])) {
		$sv = ewrpt_StripSlashes($_GET["sv_$parm"]);
		return TRUE;
	}
	return FALSE;
}

// Get filter values from querystring
function GetFilterValues(&$sv1, &$so1, &$sc, &$sv2, &$so2, $parm) {
	if (count($_POST) > 0)
		return; // Skip post back
	$got = FALSE;
	if (@$_GET["sv1_$parm"] <> "") {
		$sv1 = ewrpt_StripSlashes($_GET["sv1_$parm"]);
		$got = TRUE;
	}
	if (@$_GET["so1_$parm"] <> "") {
		$so1 = ewrpt_StripSlashes($_GET["so1_$parm"]);
		$got = TRUE;
	}
	if (@$_GET["sc_$parm"] <> "") {
		$sc = ewrpt_StripSlashes($_GET["sc_$parm"]);
		$got = TRUE;
	}
	if (@$_GET["sv2_$parm"] <> "") {
		$sv2 = ewrpt_StripSlashes($_GET["sv2_$parm"]);
		$got = TRUE;
	}
	if (@$_GET["so2_$parm"] <> "") {
		$so2 = ewrpt_StripSlashes($_GET["so2_$parm"]);
		$got = TRUE;
	}
	return $got;
}

// Set default ext filter
function SetDefaultExtFilter($parm, $so1, $sv1, $sc, $so2, $sv2) {
	$GLOBALS["sv1d_$parm"] = $sv1; // Default ext filter value 1
	$GLOBALS["sv2d_$parm"] = $sv2; // Default ext filter value 2 (if operator 2 is enabled)
	$GLOBALS["so1d_$parm"] = $so1; // Default search operator 1
	$GLOBALS["so2d_$parm"] = $so2; // Default search operator 2 (if operator 2 is enabled)
	$GLOBALS["scd_$parm"] = $sc; // Default search condition (if operator 2 is enabled)
}

// Apply default ext filter
function ApplyDefaultExtFilter($parm) {
	$GLOBALS["sv1_$parm"] = $GLOBALS["sv1d_$parm"];
	$GLOBALS["sv2_$parm"] = $GLOBALS["sv2d_$parm"];
	$GLOBALS["so1_$parm"] = $GLOBALS["so1d_$parm"];
	$GLOBALS["so2_$parm"] = $GLOBALS["so2d_$parm"];
	$GLOBALS["sc_$parm"] = $GLOBALS["scd_$parm"];
}

// Check if ext filter applied
function ExtFilterApplied($parm) {
	return (strval($GLOBALS["sv1_$parm"]) <> strval($GLOBALS["sv1d_$parm"]) ||
		strval($GLOBALS["sv2_$parm"]) <> strval($GLOBALS["sv2d_$parm"]) ||
		strval($GLOBALS["so1_$parm"]) <> strval($GLOBALS["so1d_$parm"]) ||
		strval($GLOBALS["so2_$parm"]) <> strval($GLOBALS["so2d_$parm"]) ||
		strval($GLOBALS["sc_$parm"]) <> strval($GLOBALS["scd_$parm"]));
}

// Load selection from a filter clause
function LoadSelectionFromFilter($parm, $filter, &$sel) {
	$sel = "";
	if ($filter <> "") {
		$sSql = ewrpt_BuildReportSql("", $GLOBALS["EW_REPORT_FIELD_" . strtoupper($parm) . "_SQL_SELECT"], $GLOBALS["EW_REPORT_TABLE_SQL_WHERE"], $GLOBALS["EW_REPORT_TABLE_SQL_GROUPBY"], $GLOBALS["EW_REPORT_TABLE_SQL_HAVING"], $GLOBALS["EW_REPORT_FIELD_" . strtoupper($parm) . "_SQL_ORDERBY"], "", $filter, "");
		ewrpt_LoadArrayFromSql($sSql, $sel);
	}
}

// Get dropdown value from session
function GetSessionDropDownValue(&$sv, $parm) {
	GetSessionValue($sv, 'sv_Farmaci_Depo_' . $parm);
}

// Get filter values from session
function GetSessionFilterValues(&$sv1, &$so1, &$sc, &$sv2, &$so2, $parm) {
	GetSessionValue($sv1, 'sv1_Farmaci_Depo_' . $parm);
	GetSessionValue($so1, 'so1_Farmaci_Depo_' . $parm);
	GetSessionValue($sc, 'sc_Farmaci_Depo_' . $parm);
	GetSessionValue($sv2, 'sv2_Farmaci_Depo_' . $parm);
	GetSessionValue($so2, 'so2_Farmaci_Depo_' . $parm);
}

// Get value from session
function GetSessionValue(&$sv, $sn) {
	if (isset($_SESSION[$sn]))
		$sv = $_SESSION[$sn];
}

// Set dropdown value to session
function SetSessionDropDownValue($sv, $parm) {
	$_SESSION['sv_Farmaci_Depo_' . $parm] = $sv;
}

// Set filter values to session
function SetSessionFilterValues($sv1, $so1, $sc, $sv2, $so2, $parm) {
	$_SESSION['sv1_Farmaci_Depo_' . $parm] = $sv1;
	$_SESSION['so1_Farmaci_Depo_' . $parm] = $so1;
	$_SESSION['sc_Farmaci_Depo_' . $parm] = $sc;
	$_SESSION['sv2_Farmaci_Depo_' . $parm] = $sv2;
	$_SESSION['so2_Farmaci_Depo_' . $parm] = $so2;
}

// Check if has Session filter values
function HasSessionFilterValues($parm) {
	return ((@$_SESSION['sv_' . $parm] <> "" && @$_SESSION['sv_' . $parm] <> EW_REPORT_INIT_VALUE) ||
		(@$_SESSION['sv1_' . $parm] <> "" && @$_SESSION['sv1_' . $parm] <> EW_REPORT_INIT_VALUE) ||
		(@$_SESSION['sv2_' . $parm] <> "" && @$_SESSION['sv2_' . $parm] <> EW_REPORT_INIT_VALUE));
}

// Build dropdown filter
function BuildDropDownFilter(&$FilterClause, $FldName, $FldExpression, $FldDataType, $FldDateTimeFormat, $FldVal, $FldOpr) {
	$sWrk = "";
	if ($FldVal == EW_REPORT_NULL_VALUE) {
		$sWrk = $FldExpression . " IS NULL";
	} elseif ($FldVal == EW_REPORT_EMPTY_VALUE) {
		$sWrk = $FldExpression . " = ''";
	} else {
		if (substr($FldVal, 0, 2) == "@@") {
			$sWrk = CustomFilter($FldName, $FldExpression, $FldVal);
		} else {
			if ($FldVal <> "" && $FldVal <> EW_REPORT_INIT_VALUE) {
				if ($FldDataType == EW_REPORT_DATATYPE_DATE && $FldOpr <> "") {
					$sWrk = DateFilterString($FldOpr, $FldVal, $FldDataType);
				} else {
					$sWrk = FilterString("=", $FldVal, $FldDataType);
				}
			}
			if ($sWrk <> "") $sWrk = $FldExpression . $sWrk;
		}
	}
	if ($sWrk <> "") {
		if ($FilterClause <> "") $FilterClause = "(" . $FilterClause . ") AND ";
		$FilterClause .= "(" . $sWrk . ")";
	}
}

// Register custom filter
function RegisterCustomFilter($FldName, $FilterName, $DisplayName, $FldExpression, $FunctionName) {
	global $ewrpt_CustomFilters;
	if (!is_array($ewrpt_CustomFilters))
		$ewrpt_CustomFilters = array();
	$ewrpt_CustomFilters[] = array($FldName, $FilterName, $DisplayName, $FldExpression, $FunctionName);
}

// Custom filter
function CustomFilter($FldName, $FldExpression, $FldVal) {
	global $ewrpt_CustomFilters;
	$sWrk = "";
	$sParm = substr($FldVal, 2);
	if (is_array($ewrpt_CustomFilters)) {
		for ($i = 0; $i < count($ewrpt_CustomFilters); $i++) {
			if ($ewrpt_CustomFilters[$i][0] == $FldName && $ewrpt_CustomFilters[$i][1] == $sParm) {
				$sFld = $ewrpt_CustomFilters[$i][3];
				$sFn = $ewrpt_CustomFilters[$i][4];
				$sWrk = $sFn($sFld);
				break;
			}
		}
	}
	return $sWrk;
}

// Build extended filter
function BuildExtendedFilter(&$FilterClause, $FldName, $FldExpression, $FldDataType, $FldDateTimeFormat, $FldVal1, $FldOpr1, $FldCond, $FldVal2, $FldOpr2) {
	$sWrk = "";
	$FldOpr1 = strtoupper(trim($FldOpr1));
	if ($FldOpr1 == "") $FldOpr1 = "=";
	$FldOpr2 = strtoupper(trim($FldOpr2));
	if ($FldOpr2 == "") $FldOpr2 = "=";
	$wrkFldVal1 = $FldVal1;
	$wrkFldVal2 = $FldVal2;
	if ($FldDataType == EW_REPORT_DATATYPE_BOOLEAN) {
		if ($wrkFldVal1 <> "") $wrkFldVal1 = ($wrkFldVal1 == "1") ? EW_REPORT_TRUE_STRING : EW_REPORT_FALSE_STRING;
		if ($wrkFldVal2 <> "") $wrkFldVal2 = ($wrkFldVal2 == "1") ? EW_REPORT_TRUE_STRING : EW_REPORT_FALSE_STRING;
	} elseif ($FldDataType == EW_REPORT_DATATYPE_DATE) {
		if ($wrkFldVal1 <> "") $wrkFldVal1 = ewrpt_UnFormatDateTime($wrkFldVal1, $FldDateTimeFormat);
		if ($wrkFldVal2 <> "") $wrkFldVal2 = ewrpt_UnFormatDateTime($wrkFldVal2, $FldDateTimeFormat);
	}
	if ($FldOpr1 == "BETWEEN") {
		$IsValidValue = ($FldDataType <> EW_REPORT_DATATYPE_NUMBER ||
			($FldDataType == EW_REPORT_DATATYPE_NUMBER && is_numeric($wrkFldVal1) && is_numeric($wrkFldVal2)));
		if ($wrkFldVal1 <> "" && $wrkFldVal2 <> "" && $IsValidValue)
			$sWrk = $FldExpression . " BETWEEN " . ewrpt_QuotedValue($wrkFldVal1, $FldDataType) .
				" AND " . ewrpt_QuotedValue($wrkFldVal2, $FldDataType);
	} elseif ($FldOpr1 == "IS NULL" || $FldOpr1 == "IS NOT NULL") {
		$sWrk = $FldExpression . " " . $wrkFldVal1;
	} else {
		$IsValidValue = ($FldDataType <> EW_REPORT_DATATYPE_NUMBER ||
			($FldDataType == EW_REPORT_DATATYPE_NUMBER && is_numeric($wrkFldVal1)));
		if ($wrkFldVal1 <> "" && $IsValidValue && ewrpt_IsValidOpr($FldOpr1, $FldDataType))
			$sWrk = $FldExpression . FilterString($FldOpr1, $wrkFldVal1, $FldDataType);
		$IsValidValue = ($FldDataType <> EW_REPORT_DATATYPE_NUMBER ||
			($FldDataType == EW_REPORT_DATATYPE_NUMBER && is_numeric($wrkFldVal2)));
		if ($wrkFldVal2 <> "" && $IsValidValue && ewrpt_IsValidOpr($FldOpr2, $FldDataType)) {
			if ($sWrk <> "")
				$sWrk .= " " . (($FldCond = "OR") ? "OR" : "AND") . " ";
			$sWrk .= $FldExpression & FilterString($FldOpr2, $wrkFldVal2, $FldDataType);
		}
	}
	if ($sWrk <> "") {
		if ($FilterClause <> "") $FilterClause .= " AND ";
		$FilterClause .= "(" . $sWrk . ")";
	}
}

// Return filter string
function FilterString($FldOpr, $FldVal, $FldType) {
	if ($FldOpr == "LIKE" || $FldOpr == "NOT LIKE") {
		return " " . $FldOpr . " " . ewrpt_QuotedValue("%$FldVal%", $FldType);
	} elseif ($FldOpr == "STARTS WITH") {
		return " LIKE " . ewrpt_QuotedValue("$FldVal%", $FldType);
	} else {
		return " $FldOpr " . ewrpt_QuotedValue($FldVal, $FldType);
	}
}

// Return date search string
function DateFilterString($FldOpr, $FldVal, $FldType) {
	$wrkVal1 = DateVal($FldOpr, $FldVal, 1);
	$wrkVal2 = DateVal($FldOpr, $FldVal, 2);
	if ($wrkVal1 <> "" && $wrkVal2 <> "") {
		return " BETWEEN " . ewrpt_QuotedValue($wrkVal1, $FldType) . " AND " . ewrpt_QuotedValue($wrkVal2, $FldType);
	} else {
		return "";
	}
}

// Return date value
function DateVal($FldOpr, $FldVal, $ValType) {

	// Compose date string
	switch (strtolower($FldOpr)) {
	case "year":
		if ($ValType == 1) {
			$wrkVal = "$FldVal-01-01";
		} elseif ($ValType == 2) {
			$wrkVal = "$FldVal-12-31";
		}
		break;
	case "quarter":
		list($y, $q) = explode("|", $FldVal);
		if (intval($y) == 0 || intval($q) == 0) {
			$wrkVal = "0000-00-00";
		} else {
			if ($ValType == 1) {
				$m = ($q - 1) * 3 + 1;
				$m = str_pad($m, 2, "0", STR_PAD_LEFT);
				$wrkVal = "$y-$m-01";
			} elseif ($ValType == 2) {
				$m = ($q - 1) * 3 + 3;
				$m = str_pad($m, 2, "0", STR_PAD_LEFT);
				$wrkVal = "$y-$m-" . ewrpt_DaysInMonth($y, $m);
			}
		}
		break;
	case "month":
		list($y, $m) = explode("|", $FldVal);
		if (intval($y) == 0 || intval($m) == 0) {
			$wrkVal = "0000-00-00";
		} else {
			if ($ValType == 1) {
				$m = str_pad($m, 2, "0", STR_PAD_LEFT);
				$wrkVal = "$y-$m-01";
			} elseif ($ValType == 2) {
				$m = str_pad($m, 2, "0", STR_PAD_LEFT);
				$wrkVal = "$y-$m-" . ewrpt_DaysInMonth($y, $m);
			}
		}
		break;
	case "day":
		$wrkVal = str_replace("|", "-", $FldVal);
	}

	// Add time if necessary
	if (preg_match('/(\d{4}|\d{2})-(\d{1,2})-(\d{1,2})/', $wrkVal)) { // date without time
		if ($ValType == 1) {
			$wrkVal .= " 00:00:00";
		} elseif ($ValType == 2) {
			$wrkVal .= " 23:59:59";
		}
	}

	// Check if datetime
	if (preg_match('/(\d{4}|\d{2})-(\d{1,2})-(\d{1,2}) (\d{1,2}):(\d{1,2}):(\d{1,2})/', $wrkVal)) { // datetime
		$DateVal = $wrkVal;
	} else {
		$DateVal = "";
	}
	return $DateVal;
}
?>
<?php

// Clear selection stored in session
function ClearSessionSelection($parm) {
	$_SESSION["sel_Farmaci_Depo_$parm"] = "";
	$_SESSION["rf_Farmaci_Depo_$parm"] = "";
	$_SESSION["rt_Farmaci_Depo_$parm"] = "";
}

// Load selection from session
function LoadSelectionFromSession($parm) {
	$GLOBALS["sel_$parm"] = @$_SESSION["sel_Farmaci_Depo_$parm"];
	$GLOBALS["rf_$parm"] = @$_SESSION["rf_Farmaci_Depo_$parm"];
	$GLOBALS["rt_$parm"] = @$_SESSION["rt_Farmaci_Depo_$parm"];
}

// Load default value for filters
function LoadDefaultFilters() {

	/**
	* Set up default values for dropdown filters
	*/

	// Field order_date
	$GLOBALS["svd_order_date"] = "0000-00-00";
	$GLOBALS["sv_order_date"] = $GLOBALS["svd_order_date"];
	$sWrk = "";
	BuildDropDownFilter($sWrk, 'order_date', 'care_med_orderlist.order_date', EW_REPORT_DATATYPE_DATE, 7, $GLOBALS["sv_order_date"], "");
	LoadSelectionFromFilter('order_date', $sWrk, $GLOBALS["seld_order_date"]);

	// Field name_formal
	$GLOBALS["svd_name_formal"] = EW_REPORT_INIT_VALUE;
	$GLOBALS["sv_name_formal"] = $GLOBALS["svd_name_formal"];
	$sWrk = "";
	BuildDropDownFilter($sWrk, 'name_formal', 'care_department.name_formal', EW_REPORT_DATATYPE_STRING, 0, $GLOBALS["sv_name_formal"], "");
	LoadSelectionFromFilter('name_formal', $sWrk, $GLOBALS["seld_name_formal"]);

	// Field artikelname
	$GLOBALS["svd_artikelname"] = EW_REPORT_INIT_VALUE;
	$GLOBALS["sv_artikelname"] = $GLOBALS["svd_artikelname"];
	$sWrk = "";
	BuildDropDownFilter($sWrk, 'artikelname', 'care_med_orderlist_sub.artikelname', EW_REPORT_DATATYPE_STRING, 0, $GLOBALS["sv_artikelname"], "");
	LoadSelectionFromFilter('artikelname', $sWrk, $GLOBALS["seld_artikelname"]);

	/**
	* Set up default values for extended filters
	* function SetDefaultExtFilter($parm, $so1, $sv1, $sc, $so2, $sv2)
	* Parameters:
	* $parm - Field name
	* $so1 - Default search operator 1
	* $sv1 - Default ext filter value 1
	* $sc - Default search condition (if operator 2 is enabled)
	* $so2 - Default search operator 2 (if operator 2 is enabled)
	* $sv2 - Default ext filter value 2 (if operator 2 is enabled)
	*/

	/**
	* Set up default values for popup filters
	* NOTE: if extended filter is enabled, use default values in extended filter instead
	*/
}

// Check if filter applied
function CheckFilter() {

	// Check order_date dropdown filter
	if (strval($GLOBALS["svd_order_date"]) <> strval($GLOBALS["sv_order_date"]))
		return TRUE;

	// Check order_date popup filter
	if (!ewrpt_MatchedArray($GLOBALS["seld_order_date"], $GLOBALS["sel_order_date"]))
		return TRUE;

	// Check name_formal dropdown filter
	if (strval($GLOBALS["svd_name_formal"]) <> strval($GLOBALS["sv_name_formal"]))
		return TRUE;

	// Check name_formal popup filter
	if (!ewrpt_MatchedArray($GLOBALS["seld_name_formal"], $GLOBALS["sel_name_formal"]))
		return TRUE;

	// Check artikelname dropdown filter
	if (strval($GLOBALS["svd_artikelname"]) <> strval($GLOBALS["sv_artikelname"]))
		return TRUE;

	// Check artikelname popup filter
	if (!ewrpt_MatchedArray($GLOBALS["seld_artikelname"], $GLOBALS["sel_artikelname"]))
		return TRUE;
	return FALSE;
}

// Show list of filters
function ShowFilterList() {

	// Initialize
	$sFilterList = "";

	// Field order_date
	$sExtWrk = "";
	$sWrk = "";
	BuildDropDownFilter($sExtWrk, 'order_date', 'care_med_orderlist.order_date', EW_REPORT_DATATYPE_DATE, 7, $GLOBALS["sv_order_date"], "");
	if (is_array($GLOBALS["sel_order_date"]))
		$sWrk = ewrpt_JoinArray($GLOBALS["sel_order_date"], ", ", EW_REPORT_DATATYPE_DATE);
	if ($sExtWrk <> "" || $sWrk <> "")
		$sFilterList .= "Data<br />";
	if ($sExtWrk <> "")
		$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
	if ($sWrk <> "")
		$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

	// Field name_formal
	$sExtWrk = "";
	$sWrk = "";
	BuildDropDownFilter($sExtWrk, 'name_formal', 'care_department.name_formal', EW_REPORT_DATATYPE_STRING, 0, $GLOBALS["sv_name_formal"], "");
	if (is_array($GLOBALS["sel_name_formal"]))
		$sWrk = ewrpt_JoinArray($GLOBALS["sel_name_formal"], ", ", EW_REPORT_DATATYPE_STRING);
	if ($sExtWrk <> "" || $sWrk <> "")
		$sFilterList .= "Farmacia<br />";
	if ($sExtWrk <> "")
		$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
	if ($sWrk <> "")
		$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

	// Field artikelname
	$sExtWrk = "";
	$sWrk = "";
	BuildDropDownFilter($sExtWrk, 'artikelname', 'care_med_orderlist_sub.artikelname', EW_REPORT_DATATYPE_STRING, 0, $GLOBALS["sv_artikelname"], "");
	if (is_array($GLOBALS["sel_artikelname"]))
		$sWrk = ewrpt_JoinArray($GLOBALS["sel_artikelname"], ", ", EW_REPORT_DATATYPE_STRING);
	if ($sExtWrk <> "" || $sWrk <> "")
		$sFilterList .= "Medikamenti<br />";
	if ($sExtWrk <> "")
		$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
	if ($sWrk <> "")
		$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

	// Show Filters
	if ($sFilterList <> "")
		echo "CURRENT FILTERS:<br />$sFilterList";
}

/**
 * Regsiter your Custom filters here
 */

// Setup custom filters
function SetupCustomFilters() {

	// 1. Register your custom filter below (see example)
	// 2. Write your custom filter function (see example fucntions: GetLastMonthFilter, GetStartsWithAFilter)
	// name_formal (example)
	//RegisterCustomFilter('name_formal', 'StartsWithA', 'Starts With A', 'care_department.name_formal', 'GetStartsWithAFilter');
	// artikelname (example)
	//RegisterCustomFilter('artikelname', 'StartsWithA', 'Starts With A', 'care_med_orderlist_sub.artikelname', 'GetStartsWithAFilter');

}

/**
 * Write your Custom filters here
 */

// Filter for 'Last Month' (example)
function GetLastMonthFilter($FldExpression) {
	$today = getdate();
	$lastmonth = mktime(0, 0, 0, $today['mon']-1, 1, $today['year']);
	$sVal = date("Y|m", $lastmonth);
	$sWrk = $FldExpression . " BETWEEN " .
		ewrpt_QuotedValue(DateVal("month", $sVal, 1), EW_REPORT_DATATYPE_DATE) .
		" AND " .
		ewrpt_QuotedValue(DateVal("month", $sVal, 2), EW_REPORT_DATATYPE_DATE);
	return $sWrk;
}

// Filter for 'Starts With A' (example)
function GetStartsWithAFilter($FldExpression) {
	return $FldExpression . " LIKE 'A%'";
}
?>
