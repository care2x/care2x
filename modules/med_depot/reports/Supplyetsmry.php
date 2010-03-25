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
define("EW_REPORT_TABLE_VAR", "Supplyet", TRUE);
define("EW_REPORT_TABLE_GROUP_PER_PAGE", "grpperpage", TRUE);
define("EW_REPORT_TABLE_SESSION_GROUP_PER_PAGE", "Supplyet_grpperpage", TRUE);
define("EW_REPORT_TABLE_START_GROUP", "start", TRUE);
define("EW_REPORT_TABLE_SESSION_START_GROUP", "Supplyet_start", TRUE);
define("EW_REPORT_TABLE_SESSION_SEARCH", "Supplyet_search", TRUE);
define("EW_REPORT_TABLE_CHILD_USER_ID", "childuserid", TRUE);
define("EW_REPORT_TABLE_SESSION_CHILD_USER_ID", "Supplyet_childuserid", TRUE);

// Table level SQL
$EW_REPORT_TABLE_SQL_FROM = "care_supplier INNER JOIN care_supply ON (care_supplier.idcare_supplier = care_supply.idcare_supplier)";
$EW_REPORT_TABLE_SQL_SELECT = "SELECT care_supplier.supplier, care_supply.notes, care_supply.bill_nr, care_supply.articles, care_supply.`status` FROM " . $EW_REPORT_TABLE_SQL_FROM;
$EW_REPORT_TABLE_SQL_WHERE = "";
$EW_REPORT_TABLE_SQL_GROUPBY = "";
$EW_REPORT_TABLE_SQL_HAVING = "";
$EW_REPORT_TABLE_SQL_ORDERBY = "";
$EW_REPORT_TABLE_SQL_USERID_FILTER = "";
$af_supplier = NULL; // Popup filter for supplier
$af_notes = NULL; // Popup filter for notes
$af_bill_nr = NULL; // Popup filter for bill_nr
$af_articles = NULL; // Popup filter for articles
$af_status = NULL; // Popup filter for status
?>
<?php

// Initialize common variables
// Paging variables

$nRecCount = 0; // Record count
$nStartGrp = 0; // Start group
$nStopGrp = 0; // Stop group
$nTotalGrps = 0; // Total groups
$nGrpCount = 0; // Group count
$nDisplayGrps = 3; // Groups per page
$nGrpRange = 10;

// Clear field for ext filter
$sClearExtFilter = "";

// Dropdown filters
// Field supplier

$sv_supplier = ""; $svd_supplier = "";
$sr_supplier = array();

// Field bill_nr
$sv_bill_nr = ""; $svd_bill_nr = "";
$sr_bill_nr = array();

// Extended filters
// Custom filters

$ewrpt_CustomFilters = array();
?>
<?php
?>
<?php

// Field variables
$x_supplier = NULL;
$x_notes = NULL;
$x_bill_nr = NULL;
$x_articles = NULL;
$x_status = NULL;

// Detail variables
$o_supplier = NULL; $t_supplier = NULL; $ft_supplier = 200; $rf_supplieri= NULL; $rt_supplier = NULL;
$o_notes = NULL; $t_notes = NULL; $ft_notes = 200; $rf_notes = NULL; $rt_notes = NULL;
$o_bill_nr = NULL; $t_bill_nr = NULL; $ft_bill_nr = 200; $rf_bill_nr = NULL; $rt_bill_nr = NULL;
$o_articles = NULL; $t_articles = NULL; $ft_articles = 201; $rf_articles = NULL; $rt_articles = NULL;
$o_status = NULL; $t_status = NULL; $ft_status = 200; $rf_status = NULL; $rt_status = NULL;
?>
<?php

// Open connection to the database
$conn = ewrpt_Connect();

// Filter
$sFilter = "";

// Aggregate variables
// 1st dimension = no of groups (level 0 used for grand total)
// 2nd dimension = no of fields

$nDtls = 6;
$nGrps = 1;
$val = ewrpt_InitArray($nDtls, 0);
$cnt = ewrpt_Init2DArray($nGrps, $nDtls, 0);
$smry = ewrpt_Init2DArray($nGrps, $nDtls, 0);
$mn = ewrpt_Init2DArray($nGrps, $nDtls, NULL);
$mx = ewrpt_Init2DArray($nGrps, $nDtls, NULL);
$grandsmry = ewrpt_InitArray($nDtls, 0);
$grandmn = ewrpt_InitArray($nDtls, NULL);
$grandmx = ewrpt_InitArray($nDtls, NULL);

// Set up if accumulation required
$col = array(FALSE, FALSE, FALSE, FALSE, FALSE, FALSE);

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
<script type="text/javascript">
var ewrpt_DateSep = "/";
</script>
<script type="text/javascript" src="phprptjs/ewrpt.js"></script>
<script type="text/javascript">

function ewrpt_ValidateExtFilter(form_obj) {
	return true;
}
</script>
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
</script>
<!-- Table Container (Begin) -->
<table id="ewContainer" cellspacing="0" cellpadding="0" border="0">
<!-- Top Container (Begin) -->
<tr><td colspan="3" class="ewPadding"><div id="ewTop" class="phpreportmaker">
<!-- top slot -->
<a name="top"></a>
Supplyet
<?php if ($bFilterApplied) { ?>
&nbsp;&nbsp;<a href="Supplyetsmry.php?cmd=reset">Pastro te gjithe filtrat</a>
<?php } ?>
<br /><br />
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
<!-- summary report starts -->
<div id="report_summary">
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
<form name="fSupplyetsummaryfilter" id="fSupplyetsummaryfilter" action="Supplyetsmry.php" onSubmit="return ewrpt_ValidateExtFilter(this);">
<table class="ewRptExtFilter">
	<tr>
		<td><span class="phpreportmaker">Furnitori</span></td>
		<td></td>
		<td colspan="4"><span class="ewRptSearchOpr">
		<select name="sv_supplier" id="sv_supplier"<?php echo ($sClearExtFilter == 'Supplyet_supplier') ? " class=\"ewInputCleared\"" : "" ?>>
		<option value=""></option>
<?php

// Popup filter
if (is_array($ewrpt_CustomFilters)) {
	for ($i = 0; $i < count($ewrpt_CustomFilters); $i++) {
		if ($ewrpt_CustomFilters[$i][0] == 'supplier') {
?>
		<option value="<?php echo "@@" . $ewrpt_CustomFilters[$i][1] ?>"<?php if (strval($sv_supplier) == "@@" . $ewrpt_CustomFilters[$i][1]) echo " selected" ?>><?php echo $ewrpt_CustomFilters[$i][2] ?></option>
<?php
		}
	}
}
if (is_array($sr_supplier)) {
	for ($i = 0; $i < count($sr_supplier); $i++) {
?>
		<option value="<?php echo $sr_supplier[$i] ?>"<?php if (strval($sv_supplier) ==  strval($sr_supplier[$i])) echo " selected" ?>><?php echo ewrpt_DropDownDisplayValue($sr_supplier[$i], "", 0) ?></option>
<?php
	}
}
?>
		</select>
		</span></td>
	</tr>
	<tr>
		<td><span class="phpreportmaker">Fatura Nr</span></td>
		<td></td>
		<td colspan="4"><span class="ewRptSearchOpr">
		<select name="sv_bill_nr" id="sv_bill_nr"<?php echo ($sClearExtFilter == 'Supplyet_bill_nr') ? " class=\"ewInputCleared\"" : "" ?>>
		<option value=""></option>
<?php

// Popup filter
if (is_array($ewrpt_CustomFilters)) {
	for ($i = 0; $i < count($ewrpt_CustomFilters); $i++) {
		if ($ewrpt_CustomFilters[$i][0] == 'bill_nr') {
?>
		<option value="<?php echo "@@" . $ewrpt_CustomFilters[$i][1] ?>"<?php if (strval($sv_bill_nr) == "@@" . $ewrpt_CustomFilters[$i][1]) echo " selected" ?>><?php echo $ewrpt_CustomFilters[$i][2] ?></option>
<?php
		}
	}
}
if (is_array($sr_bill_nr)) {
	for ($i = 0; $i < count($sr_bill_nr); $i++) {
?>
		<option value="<?php echo $sr_bill_nr[$i] ?>"<?php if (strval($sv_bill_nr) ==  strval($sr_bill_nr[$i])) echo " selected" ?>><?php echo ewrpt_DropDownDisplayValue($sr_bill_nr[$i], "", 0) ?></option>
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
	$toaliMadh = 0;
while (($rs && !$rs->EOF) || $bShowFirstHeader) {

	// Show header
	if ($bShowFirstHeader) {
?>
	<tr>
		<td valign="bottom" class="ewTableHeader">
		Furnitori
		</td>
		<td valign="bottom" class="ewTableHeader">
		Shenime
		</td>
		<td valign="bottom" class="ewTableHeader">
		Fatura Nr
		</td>
		<td valign="bottom" class="ewTableHeader">
		Medikamenti
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
<!--		<td valign="bottom" class="ewTableHeader">
		Gjendja
		</td> -->
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
?>
	<tr<?php echo $sItemRowClass; ?>>
		<td class="ewRptGrpField2">
<?php echo $x_supplier ?>
</td>
		<td class="ewRptGrpField2">
<?php echo $x_notes ?>
</td>
		<td class="ewRptGrpField2">
<?php echo $x_bill_nr ?>
</td>
<?php
	$kot = explode(" ",$x_articles);
	$i = 0;
	$value = 0;
	foreach($kot as $key => $val) {
		unset($kaka);
		$kaka = explode("&",$val);
		if($i > 0) echo "<tr><td class=\"ewRptGrpField2\"></td><td class=\"ewRptGrpField2\"></td><td class=\"ewRptGrpField2\"></td>";
		foreach($kaka as $kakakey => $kakavalue) {
			unset($muti);
			$muti = explode("=",$kakavalue);
			if( $muti[0] == "artikelname"  || $muti[0] == "pcs" || $muti[0] == "price" || $muti[0] == "value" || $muti[0] == "expiry_date") {
					if($muti[0] == "pcs" || $muti[0] == "price" || $muti[0] == "value" || $muti[0] == "expiry_date" ) 
						echo "<td class=\"ewRptDtlField\" align=\"right\">" . $muti[1] . "</td>\n";
					else
						echo "<td class=\"ewRptDtlField\">" . $muti[1] . "</td>\n";
			}
			if($muti[0] == "value" ) $value += $muti[1];

		}
			if($i == 0) echo "</tr>";
			$i++;
	}
	$toaliMadh += $value;
?>
	</tr>
	<tr>
		<td class="ewRptGrpField1"></td>
		<td colspan="5" class="ewRptGrpSummary2">Permbledhja per Fatura Nr: <?php echo $x_bill_nr ?> (<?php echo $i ?> Detajet e vleres)</td>
		<td class="ewRptGrpSummary2" align="right"><?php echo $value ?></td>
		<td class="ewRptGrpField1"></td>
		</tr>
	<tr>
	
<?php

		// Accumulate page summary
		AccumulateSummary();
	}

	// Accumulate grand summary
	AccumulateGrandSummary();

	// Get next record
	GetRow(2);
	$nGrpCount++;
} // End while
?>
<?php if ($nTotalGrps > 0) { ?>
	<!-- tr><td colspan="5"><span class="phpreportmaker">&nbsp;<br /></span></td></tr -->
	<tr class="ewRptGrandSummary">
		<td colspan="7">Totali i madh (<?php echo ewrpt_FormatNumber($cnt[0][0],0,-2,-2,-2); ?> Detajet e vleres) </td>
		<td><?php echo $toaliMadh; ?></td>	
	</tr>
			
<?php } ?>
</table>
<br />
<form action="Supplyetsmry.php" name="ewpagerform" id="ewpagerform">
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
	<td><a href="Supplyetsmry.php?start=1"><img src="phprptimages/first.gif" alt="Pare" width="16" height="16" border="0"></a></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($PrevStart == $nStartGrp) { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="Paraardhes" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><a href="Supplyetsmry.php?start=<?php echo $PrevStart; ?>"><img src="phprptimages/prev.gif" alt="Paraardhes" width="16" height="16" border="0"></a></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" value="<?php echo intval(($nStartGrp-1)/$nDisplayGrps+1); ?>" size="4"></td>
<!--next page button-->
	<?php if ($NextStart == $nStartGrp) { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="Pasardhes" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><a href="Supplyetsmry.php?start=<?php echo $NextStart; ?>"><img src="phprptimages/next.gif" alt="Pasardhes" width="16" height="16" border="0"></a></td>
	<?php  } ?>
<!--last page button-->
	<?php if ($LastStart == $nStartGrp) { ?>
	<td><img src="phprptimages/lastdisab.gif" alt="fundit" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><a href="Supplyetsmry.php?start=<?php echo $LastStart; ?>"><img src="phprptimages/last.gif" alt="fundit" width="16" height="16" border="0"></a></td>
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
	<span class="phpreportmaker">Jepni nje kriter kerkimi</span>
	<?php } else { ?>
	<span class="phpreportmaker">Nuk ka vlera</span>
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
<option value="ALL"<?php if (@$_SESSION[EW_REPORT_TABLE_SESSION_GROUP_PER_PAGE] == -1) echo " selected" ?>>Te gjitha vlerat</option>
</select>
		</span></td>
<?php } ?>
	</tr>
</table>
</form>
</div>
<!-- Summary Report Ends -->
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
<?php
$conn->Close();
?>
<?php include "phprptinc/footer.php"; ?>
<?php

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
			$GLOBALS['x_supplier'] = $rs->fields('supplier');
			$GLOBALS['x_notes'] = $rs->fields('notes');
			$GLOBALS['x_bill_nr'] = $rs->fields('bill_nr');
			$GLOBALS['x_articles'] = $rs->fields('articles');
			$GLOBALS['x_status'] = $rs->fields('status');
			$val[1] = $GLOBALS['x_supplier'];
			$val[2] = $GLOBALS['x_notes'];
			$val[3] = $GLOBALS['x_bill_nr'];
			$val[4] = $GLOBALS['x_articles'];
			$val[5] = $GLOBALS['x_status'];
			break;
		} else {
			$rs->MoveNext();
		}
	}
	if ($rs->EOF) {
		$GLOBALS['x_supplier'] = "";
		$GLOBALS['x_notes'] = "";
		$GLOBALS['x_bill_nr'] = "";
		$GLOBALS['x_articles'] = "";
		$GLOBALS['x_status'] = "";
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
			ResetPager();
		}
	}

	// Load selection criteria to array
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
		if ($bValidRow)
			$grpcnt++;
		$rs->MoveNext();
	}

	// Set up total number of groups
	$nTotalGrps = $grpcnt;
}

// Check if row is valid
function ValidRow(&$rs) {
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
				$nDisplayGrps = 3; // Non-numeric, load default
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
			$nDisplayGrps = 3; // Load default
		}
	}
}
?>
<?php

// Get extended filter values
function GetExtendedFilterValues() {

	// Field supplier
	$sSelect = "SELECT DISTINCT care_supplier.supplier FROM " . $GLOBALS["EW_REPORT_TABLE_SQL_FROM"];
	$sOrderBy = "care_supplier.supplier ASC";
	$wrkSql = ewrpt_BuildReportSql("", $sSelect, $GLOBALS["EW_REPORT_TABLE_SQL_WHERE"], "", "", $sOrderBy, "", "", "");
	$GLOBALS["sr_supplier"] = ewrpt_GetDistinctValues("", $wrkSql);

	// Field bill_nr
	$sSelect = "SELECT DISTINCT care_supply.bill_nr FROM " . $GLOBALS["EW_REPORT_TABLE_SQL_FROM"];
	$sOrderBy = "care_supply.bill_nr ASC";
	$wrkSql = ewrpt_BuildReportSql("", $sSelect, $GLOBALS["EW_REPORT_TABLE_SQL_WHERE"], "", "", $sOrderBy, "", "", "");
	$GLOBALS["sr_bill_nr"] = ewrpt_GetDistinctValues("", $wrkSql);
}

// Return extended filter
function GetExtendedFilter() {
	$sFilter = "";
	$bPostBack = (count($_POST) > 0);
	$bRestoreSession = TRUE;
	$bSetupFilter = FALSE;

	// Reset extended filter if filter changed
	if ($bPostBack) {

	// Reset search command
	} elseif (@$_GET["cmd"] == "reset") {

		// Load default values
		// Field supplier

		SetSessionDropDownValue($GLOBALS["sv_supplier"], 'supplier');

		// Field bill_nr
		SetSessionDropDownValue($GLOBALS["sv_bill_nr"], 'bill_nr');
		$bSetupFilter = TRUE;
	} else {

		// Field supplier
		if (GetDropDownValue($GLOBALS["sv_supplier"], 'supplier')) {
			$bSetupFilter = TRUE;
			$bRestoreSession = FALSE;
		} elseif ($GLOBALS["sv_supplier"] <> EW_REPORT_INIT_VALUE && !isset($_SESSION['sv_Supplyet_supplier'])) {
			$bSetupFilter = TRUE;
		}

		// Field bill_nr
		if (GetDropDownValue($GLOBALS["sv_bill_nr"], 'bill_nr')) {
			$bSetupFilter = TRUE;
			$bRestoreSession = FALSE;
		} elseif ($GLOBALS["sv_bill_nr"] <> EW_REPORT_INIT_VALUE && !isset($_SESSION['sv_Supplyet_bill_nr'])) {
			$bSetupFilter = TRUE;
		}
	}

	// Restore session
	if ($bRestoreSession) {

		// Field supplier
		GetSessionDropDownValue($GLOBALS["sv_supplier"], 'supplier');

		// Field bill_nr
		GetSessionDropDownValue($GLOBALS["sv_bill_nr"], 'bill_nr');
	}

	// Build SQL
	// Field supplier

	BuildDropDownFilter($sFilter, 'supplier', 'care_supplier.supplier', EW_REPORT_DATATYPE_STRING, 0, $GLOBALS["sv_supplier"], "");

	// Field bill_nr
	BuildDropDownFilter($sFilter, 'bill_nr', 'care_supply.bill_nr', EW_REPORT_DATATYPE_STRING, 0, $GLOBALS["sv_bill_nr"], "");

	// Save parms to session
	// Field supplier

	SetSessionDropDownValue($GLOBALS["sv_supplier"], 'supplier');

	// Field bill_nr
	SetSessionDropDownValue($GLOBALS["sv_bill_nr"], 'bill_nr');

	// Setup filter
	if ($bSetupFilter) {
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
	GetSessionValue($sv, 'sv_Supplyet_' . $parm);
}

// Get filter values from session
function GetSessionFilterValues(&$sv1, &$so1, &$sc, &$sv2, &$so2, $parm) {
	GetSessionValue($sv1, 'sv1_Supplyet_' . $parm);
	GetSessionValue($so1, 'so1_Supplyet_' . $parm);
	GetSessionValue($sc, 'sc_Supplyet_' . $parm);
	GetSessionValue($sv2, 'sv2_Supplyet_' . $parm);
	GetSessionValue($so2, 'so2_Supplyet_' . $parm);
}

// Get value from session
function GetSessionValue(&$sv, $sn) {
	if (isset($_SESSION[$sn]))
		$sv = $_SESSION[$sn];
}

// Set dropdown value to session
function SetSessionDropDownValue($sv, $parm) {
	$_SESSION['sv_Supplyet_' . $parm] = $sv;
}

// Set filter values to session
function SetSessionFilterValues($sv1, $so1, $sc, $sv2, $so2, $parm) {
	$_SESSION['sv1_Supplyet_' . $parm] = $sv1;
	$_SESSION['so1_Supplyet_' . $parm] = $so1;
	$_SESSION['sc_Supplyet_' . $parm] = $sc;
	$_SESSION['sv2_Supplyet_' . $parm] = $sv2;
	$_SESSION['so2_Supplyet_' . $parm] = $so2;
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
	$_SESSION["sel_Supplyet_$parm"] = "";
	$_SESSION["rf_Supplyet_$parm"] = "";
	$_SESSION["rt_Supplyet_$parm"] = "";
}

// Load selection from session
function LoadSelectionFromSession($parm) {
	$GLOBALS["sel_$parm"] = @$_SESSION["sel_Supplyet_$parm"];
	$GLOBALS["rf_$parm"] = @$_SESSION["rf_Supplyet_$parm"];
	$GLOBALS["rt_$parm"] = @$_SESSION["rt_Supplyet_$parm"];
}

// Load default value for filters
function LoadDefaultFilters() {

	/**
	* Set up default values for dropdown filters
	*/

	// Field supplier
	$GLOBALS["svd_supplier"] = EW_REPORT_INIT_VALUE;
	$GLOBALS["sv_supplier"] = $GLOBALS["svd_supplier"];

	// Field bill_nr
	$GLOBALS["svd_bill_nr"] = EW_REPORT_INIT_VALUE;
	$GLOBALS["sv_bill_nr"] = $GLOBALS["svd_bill_nr"];

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

	// Check supplieri dropdown filter
	if (strval($GLOBALS["svd_supplier"]) <> strval($GLOBALS["sv_supplier"]))
		return TRUE;

	// Check bill_nr dropdown filter
	if (strval($GLOBALS["svd_bill_nr"]) <> strval($GLOBALS["sv_bill_nr"]))
		return TRUE;
	return FALSE;
}

// Show list of filters
function ShowFilterList() {

	// Initialize
	$sFilterList = "";

	// Field supplier
	$sExtWrk = "";
	$sWrk = "";
	BuildDropDownFilter($sExtWrk, 'supplier', 'care_supplier.supplier', EW_REPORT_DATATYPE_STRING, 0, $GLOBALS["sv_supplier"], "");
	if ($sExtWrk <> "" || $sWrk <> "")
		$sFilterList .= "Furnitori<br />";
	if ($sExtWrk <> "")
		$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
	if ($sWrk <> "")
		$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

	// Field bill_nr
	$sExtWrk = "";
	$sWrk = "";
	BuildDropDownFilter($sExtWrk, 'bill_nr', 'care_supply.bill_nr', EW_REPORT_DATATYPE_STRING, 0, $GLOBALS["sv_bill_nr"], "");
	if ($sExtWrk <> "" || $sWrk <> "")
		$sFilterList .= "Fatura Nr<br />";
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
	// supplier (example)
	//RegisterCustomFilter('supplier', 'StartsWithA', 'Starts With A', 'care_supplier.supplier', 'GetStartsWithAFilter');
	// bill_nr (example)
	//RegisterCustomFilter('bill_nr', 'StartsWithA', 'Starts With A', 'care_supply.bill_nr', 'GetStartsWithAFilter');

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
