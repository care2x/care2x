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
<?php include "phprptinc/ewrfn2.php"; ?>
<?php

// Get chart id
$cht_id = @$_GET["id"];

// Get chart configuration from session
$cht_parms = @$_SESSION[$cht_id . "_parms"];
$cht_trends = @$_SESSION[$cht_id . "_trends"];

// Initialize default values
// Chart caption

SetupChartParm("caption", "Chart");

// Show names/values/hover
SetupChartParm("shownames", "1"); // Default show names
SetupChartParm("showvalues", "1"); // Default show values
SetupChartParm("showhover", "1"); // Default show hover

// Get chart type
$cht_type = LoadParm("type");
$cht_series = (intval($cht_type) >= 9) ? 1 : 0; // $cht_series = 1 (Multi series charts)

// Get shownames/showvalues/showhovercap
$cht_shownames = LoadParm("shownames");
$cht_showvalues = LoadParm("showvalues");
$cht_showhovercap = LoadParm("showhovercap");

// Format percent for Pie charts
$cht_showPercentageValues = LoadParm("showPercentageValues");
$cht_showPercentageInLabel = LoadParm("showPercentageInLabel");
if ($cht_type == 2 || $cht_type == 6 || $cht_type == 8) {
	if (($cht_showhovercap == "1" && $cht_showPercentageValues == "1") ||
	($cht_showvalues == "1" && $cht_showPercentageInLabel == "1")) {
		SetupChartParm("formatNumber", "1");
		SaveParm("formatNumber", "1");
	}
}

// Get chart alpha & color pallette
$cht_alpha = LoadParm("alpha");
$cht_colorpalette = LoadParm("colorpalette");
$ar_cht_colorpalette = explode("|", $cht_colorpalette);

// Get decimal precision
$cht_decimalprecision = LoadParm("decimalPrecision");

// Build chart content
$sChartContent = ChartXml($cht_id);

// Output chart content
if ($sChartContent <> "") {

	// Use utf-8 by default
	header("Content-Type: text/xml; charset=UTF-8");

	// Write utf-8 BOM
	echo "\xEF\xBB\xBF";

	// Write utf-8 encoding
	echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?>";

	// Write content
	echo $sChartContent;
	exit;
}

// Set up default chart parm
function SetupChartParm($key, $value) {
	global $cht_parms;
	if (is_array($cht_parms)) {
		$parm = LoadParm($key);
		if (is_null($parm)) {
			$cht_parms[$key] = array($key, $value, TRUE);
		} elseif ($parm == "") {
			SaveParm($key, $value);
		}
	}
}

// Load chart parm
function LoadParm($key) {
	global $cht_parms;
	if (is_array($cht_parms) && array_key_exists($key, $cht_parms))
		return $cht_parms[$key][1];
	return NULL;
}

// Save chart parm
function SaveParm($key, $value) {
	global $cht_parms;
	if (is_array($cht_parms) && array_key_exists($key, $cht_parms))
		$cht_parms[$key][1] = $value;
}

// Output chart XML
function ChartXml($id) {
	global $cht_series, $cht_alpha;
	$chartdata = @$_SESSION[$id . "_data"]; // Load chart data from session
	$wrk = "";
	if (is_array($chartdata)) {
		$wrk .= ChartHeader(1); // Get chart header
		if ($cht_series == 1) { // Multi series

			// Get series name
			$sFirstSeries = $chartdata[0][1]; // First series name
			for ($i = 1; $i < count($chartdata); $i++) {
				if (trim(strval($chartdata[$i][1])) == trim(strval($sFirstSeries)))
					break;
			}
			$nSeries = $i;
			$nCat = intval(count($chartdata)/$nSeries);

			// Write cat
			$wrk .= ChartCatHeader(1);
			for ($i = 0; $i < $nCat; $i++) {
				$name = $chartdata[$i*$nSeries][0];
				$wrk .= ChartCatContent($name);
			}
			$wrk .= ChartCatHeader(2);

			// Write series
			for ($i = 0; $i < $nSeries; $i++) {
				$name = $chartdata[$i][1];
				if (is_null($name)) {
					$name = "(Null)";
				} elseif ($name == "") {
					$name = "(Empty)";
				}
				$color = GetPaletteColor($i);
				$wrk .= ChartSeriesHeader(1, $name, $color, $cht_alpha);
				for ($j = 0; $j < $nCat; $j++) {
					$val = $chartdata[$i+$j*$nSeries][2];
					$val = (is_null($val)) ? 0 : (float)$val;
					$wrk .= ChartSeriesContent($val); // Get chart series content
				}
				$wrk .= ChartSeriesHeader(2, $name, $color, $cht_alpha);
			}
		} else { // Single series
			for ($i = 0; $i < count($chartdata); $i++) {
				$name = $chartdata[$i][0];
				if (is_null($name)) {
					$name = "(Null)";
				} elseif ($name == "") {
					$name = "(Empty)";
				}
				$color = GetPaletteColor($i);
				if ($chartdata[$i][1] <> "") 
					$name .= ", " . $chartdata[$i][1];
				$val = $chartdata[$i][2];
				$val = (is_null($val)) ? 0 : (float)$val;
				$wrk .= ChartContent($name, $val, $color, $cht_alpha, @$link); // Get chart content
			}
		}

		// Get trend lines
		$wrk .= ChartTrendLines();

		// Get chart footer
		$wrk .= ChartHeader(2);
	}
	return $wrk;

	// ewrpt_Trace($wrk);
}

// Get color
function GetPaletteColor($i) {
	global $ar_cht_colorpalette;
	if (is_array($ar_cht_colorpalette))
		return $ar_cht_colorpalette[$i % count($ar_cht_colorpalette)];
}

// Convert to HTML color
function ColorCode($c) {
	if ($c <> "") {

		// remove #
		$color = str_replace("#", "", $c);

		// fill to 6 digits
		return str_pad($color, 6, "0", STR_PAD_LEFT);
	} else {
		return "";
	}
}

// Output chart header
function ChartHeader($typ) {
	global $cht_parms;
	if ($typ == 1) {
		$wrk = "<graph";
		if (is_array($cht_parms)) {
			foreach ($cht_parms as $parm) {
				if ($parm[2])
					WriteAtt($wrk, $parm[0], $parm[1]);
			}
		}
		$wrk .= ">";
	} else {
		$wrk = "</graph>";
	}
	return $wrk;
}

// Get TrendLine XML
// <trendlines>
//    <line startvalue='0.8' displayValue='Good' color='FF0000' thickness='1' isTrendZone='0'/>
//    <line startvalue='-0.4' displayValue='Bad' color='009999' thickness='1' isTrendZone='0'/>
// </trendlines>
function ChartTrendLines() {
	global $cht_trends;
	$wrk = "";
	if (is_array($cht_trends)) {
		foreach ($cht_trends as $trend) {
			$wrk .= "<trendlines>";

			// Get all trend lines
			$wrk .= ChartTrendLine($trend[0], $trend[1], $trend[2], $trend[3], $trend[4], $trend[5], $trend[6], $trend[7]);
			$wrk .= "</trendlines>";
		}
	}
	return $wrk;
}

// Output trend line
function ChartTrendLine($startval, $endval, $color, $dispval, $thickness, $trendzone, $showontop, $alpha) {
	$wrk = "<line";
	WriteAtt($wrk, "startValue", $startval); // Starting y value
	if ($endval <> 0)
		WriteAtt($wrk, "endValue", $endval); // Ending y value
	WriteAtt($wrk, "color", CheckColorCode($color)); // Color
	if ($dispval <> "")
		WriteAtt($wrk, "displayValue", $dispval); // Display value
	if ($thickness > 0)
		WriteAtt($wrk, "thickness", $thickness); // Thickness
	WriteAtt($wrk, "isTrendZone", $trendzone); // Display trend as zone or line
	WriteAtt($wrk, "showOnTop", $showontop); // Show on top
	if ($alpha > 0)
		WriteAtt($wrk, "alpha", $alpha); // Alpha
	$wrk .= "/>";
	return $wrk;
}

// Category header/footer XML (multi series)
function ChartCatHeader($typ) {
	return ($typ == 1) ? "<categories>" : "</categories>";
}

// Category content XML (multi series)
function ChartCatContent($name) {
	$wrk = "<category";
	WriteAtt($wrk, "name", $name);
	$wrk .= "/>";
	return $wrk;
}

// Series header/footer XML (multi series)
function ChartSeriesHeader($typ, $name, $color, $alpha) {
	if ($typ == 1) {
		$wrk = "<dataset";
		WriteAtt($wrk, "seriesname", $name);
		WriteAtt($wrk, "color", ColorCode($color));
		WriteAtt($wrk, "alpha", $alpha);
		$wrk .= ">";
	} else {
		$wrk = "</dataset>";
	}
	return $wrk;
}

// Series content XML (multi series)
function ChartSeriesContent($val) {
	$wrk = "<set";
	WriteAtt($wrk, "value", ChartFormatNumber($val));
	$wrk .= "/>";
	return $wrk;
}

// Chart content XML
function ChartContent($name, $val, $color, $alpha, $lnk) {
	global $cht_shownames;
	$wrk = "<set";
	WriteAtt($wrk, "name", $name);
	WriteAtt($wrk, "value", $val);
	WriteAtt($wrk, "color", ColorCode($color));
	WriteAtt($wrk, "alpha", $alpha);
	WriteAtt($wrk, "link", $lnk);
	if ($cht_shownames == "1")
		WriteAtt($wrk, "showName", "1");
	$wrk .= " />";
	return $wrk;
}

// Format number for chart
function ChartFormatNumber($v) {
	global $cht_decimalprecision;
	if (is_null($cht_decimalprecision)) {
		return $v;
	} else {
		return number_format($v, $cht_decimalprecision, '.', '');
	}
}

// Write attribute
function WriteAtt(&$str, $name, $val) {
	$val = CheckColorCode(strval($val));
	if ($val <> "") $str .= " " . $name . "=\"" . ewrpt_XmlEncode(ewrpt_ConvertToUtf8($val)) . "\"";
}

// Check color code
function CheckColorCode($val) {
	if (substr($val, 0, 1) == "#" && strlen($val) == 7) {
		return substr($val, 1);
	} else {
		return $val;
	}
}
?>
