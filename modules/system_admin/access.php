<?php
require('./roots.php');
require($root_path.'include/access_log.php');


session_start();
if (isset($_GET["order"])) {
	$order = @$_GET["order"];
}
if (isset($_GET["type"])) {
	$ordtype = @$_GET["type"];
}

if (isset($_POST["filter"])) {
	$filter = @$_POST["filter"];
}
if (isset($_POST["filter_field"])) {
	$filterfield = @$_POST["filter_field"];
}
$wholeonly = false;
if (isset($_POST["wholeonly"])) {
	$wholeonly = @$_POST["wholeonly"];
}

if (!isset($order) && isset($_SESSION["order"])) {
	$order = $_SESSION["order"];
}
if (!isset($ordtype) && isset($_SESSION["type"])) {
	$ordtype = $_SESSION["type"];
}
if (!isset($filter) && isset($_SESSION["filter"])) {
	$filter = $_SESSION["filter"];
}
if (!isset($filterfield) && isset($_SESSION["filter_field"])) {
	$filterfield = $_SESSION["filter_field"];
}

?>

<html>
<head>
<title>Logs manager</title>
<meta name="generator" http-equiv="content-type" content="text/html">
<style type="text/css">
body {
	background-color: #FFFFFF;
	color: #000000;
	font-family: Arial;
	font-size: 12px;
}

.bd {
	background-color: #FFFFFF;
	color: #000000;
	font-family: Arial;
	font-size: 12px;
}

.tbl {
	background-color: #DEE7DE;
}

a:link {
	color: #FF0000;
	font-family: Arial;
	font-size: 12px;
}

a:active {
	color: #0000FF;
	font-family: Arial;
	font-size: 12px;
}

a:visited {
	color: #800080;
	font-family: Arial;
	font-size: 12px;
}

.hr {
	background-color: #CEC6B5;
	color: #000000;
	font-family: Arial;
	font-size: 12px;
}

a.hr:link {
	color: #000000;
	font-family: Arial;
	font-size: 12px;
}

a.hr:active {
	color: #000000;
	font-family: Arial;
	font-size: 12px;
}

a.hr:visited {
	color: #000000;
	font-family: Arial;
	font-size: 12px;
}

.dr {
	background-color: #DEE7DE;
	color: #000000;
	font-family: Arial;
	font-size: 12px;
}

.sr {
	background-color: #FFFBF0;
	color: #000000;
	font-family: Arial;
	font-size: 12px;
}
</style>
</head>
<body>
<table class="bd" width="100%">
	<tr>
		<td class="hr">
		<h2>Access Log Manager</h2>
		</td>
	</tr>
</table>
<table width="100%">
	<tr>

		<td width="5%"></td>
		<td bgcolor="#e0e0e0"></td>
		<td width="5%"></td>
		<td width="80%" valign="top">
		<?php
		
		$a = @$_GET["a"];
		$recid = @$_GET["recid"];
		$page = @$_GET["page"];
		if (!isset($page)) {
			$page = 1;
		}

		select();

		if (isset($order)) {
			$_SESSION["order"] = $order;
		}
		if (isset($ordtype)) {
			$_SESSION["type"] = $ordtype;
		}
		if (isset($filter)) {
			$_SESSION["filter"] = $filter;
		}
		if (isset($filterfield)) {
			$_SESSION["filter_field"] = $filterfield;
		}
		if (isset($wholeonly)) {
			$_SESSION["wholeonly"] = $wholeonly;
		}

		?></td>
	</tr>
</table>
<table class="bd" width="100%">
	<tr>
		<td class="hr">log manager/</td>
	</tr>
</table>
</body>
</html>

		<?php 
function select() {
	$logs = new AccessLog();
	global $a;
	global $page;
	global $filter;
	global $filterfield;
	global $wholeonly;
	global $order;
	global $ordtype;

	if ($a == "reset") {
		$filter = "";
		$filterfield = "";
		$wholeonly = "";
		$order = "";
		$ordtype = "";
	}

	$checkstr = "";
	if ($wholeonly) {
		$checkstr = " checked";
	}
	if ($ordtype == "asc") {
		$ordtypestr = "desc";
	} else {
		$ordtypestr = "asc";
	}
			

			?>
<hr size="1" noshade>
<form action="access.php" method="post">
<table class="bd" border="0" cellspacing="1" cellpadding="4">
	<tr>
		<td><b>Custom Filter</b>&nbsp;</td>
		<td><input type="text" name="filter" value="<?php echo $filter ?>"></td>
		<td>
			<select name="filter_field">
				<option value="">All Fields</option> 
				<option value="<?php echo "ID" ?>" <?php if ($filterfield == "ID") { echo "selected"; } ?>><?php echo htmlspecialchars("ID") ?></option>
				<option value="<?php echo "DATETIME" ?>" <?php if ($filterfield == "DATETIME") { echo "selected";  } ?>><?php echo htmlspecialchars("DATETIME") ?></option>
				<option value="<?php echo "IP" ?>" <?php if ($filterfield == "IP") {  echo "selected"; }?>><?php echo htmlspecialchars("IP") ?></option>
				<option value="<?php echo "LOGNOTE" ?>" <?php if ($filterfield == "LOGNOTE") { echo "selected";  } ?>><?php echo htmlspecialchars("LOGNOTE") ?></option>
				<option value="<?php echo "USERID" ?>" <?php if ($filterfield == "USERID") { echo "selected"; } ?>><?php echo htmlspecialchars("USERID") ?></option>
				<option value="<?php echo "USERNAME" ?>" <?php if ($filterfield == "USERNAME") { echo "selected"; } ?>><?php echo htmlspecialchars("USERNAME") ?></option>
				<option value="<?php echo "PASSWORD" ?>" <?php if ($filterfield == "PASSWORD") { echo "selected"; } ?>><?php echo htmlspecialchars("PASSWORD") ?></option>
				<option value="<?php echo "THISFILE" ?>" <?php if ($filterfield == "THISFILE") { echo "selected"; } ?>><?php echo htmlspecialchars("THISFILE") ?></option>
				<option value="<?php echo "FILEFORWARD" ?>" <?php if ($filterfield == "FILEFORWARD") { echo "selected"; } ?>><?php echo htmlspecialchars("FILEFORWARD") ?></option>
				<option value="<?php echo "LOGIN_SUCCESS" ?>"  <?php if ($filterfield == "LOGIN_SUCCESS") { echo "selected"; } ?>><?php echo htmlspecialchars("LOGIN_SUCCESS") ?></option>
			</select>
		</td>
		<td><input type="checkbox" name="wholeonly" <?php echo $checkstr ?>>Whole words only</td>
		<td>&nbsp;</td>
		<td><input type="submit" name="action" value="Apply Filter"></td>
		<td><a href="access.php?a=reset">Reset Filter</a></td>
	</tr>
</table>
</form>
<hr size="1" noshade>
<br>
	<?php
$sql = sql_select();
$logs->RenderLogsTable($sql);
	?>
<br>
	<?php 
}


function sqlstr($val) {
	return str_replace("'", "''", $val);
}

function sql_select() {
	global $order;
	global $ordtype;
	global $filter;
	global $filterfield;
	global $wholeonly;

	$filterstr = sqlstr($filter);
	if (!$wholeonly && isset($wholeonly) && $filterstr!='') {
		$filterstr = "%" .$filterstr ."%";
	}
	$sql = "SELECT ID, DATETIME, IP, LOGNOTE, USERID, USERNAME, PASSWORD, THISFILE, FILEFORWARD, LOGIN_SUCCESS FROM care_accesslog";
	if (isset($filterstr) && $filterstr!='' && isset($filterfield) && $filterfield!='') {
		$sql .= " where " .sqlstr($filterfield) ." like '" .$filterstr ."'";
	} else if (isset($filterstr) && $filterstr!='') {
		$sql .= " where (ID like '" .$filterstr ."') or (DATETIME like '" .$filterstr ."') or (IP like '" .$filterstr ."') or (LOGNOTE like '" .$filterstr ."') or (USERID like '" .$filterstr ."') or (USERNAME like '" .$filterstr ."') or (PASSWORD like '" .$filterstr ."') or (THISFILE like '" .$filterstr ."') or (FILEFORWARD like '" .$filterstr ."') or (LOGIN_SUCCESS like '" .$filterstr ."')";
	}
	if (isset($order) && $order!='') {
		$sql .= " order by \"" .sqlstr($order) ."\"";
	}
	if (isset($ordtype) && $ordtype!='') {
		$sql .= " " .sqlstr($ordtype);
	}

	return $sql;
}

?>
