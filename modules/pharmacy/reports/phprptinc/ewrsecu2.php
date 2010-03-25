<?php

// Advanced User Level Security for PHP Report Maker 2.0
$arUserLevel = array();
$arUserLevelPriv = array();

// Define User Level Variables
$ewCurLvl = CurrentUserLevel();
$ewCurSec = NULL;

// No user level security
function SetUpUserLevel() {

	// User Level not used
}

// Get current user privilege
function CurrentUserLevelPriv($TableName) {
	return GetUserLevelPrivEx($TableName, CurrentUserLevel());
}

// Get user privilege based on table name and user level
function GetUserLevelPrivEx($TableName, $UserLevelID) {
	global $arUserLevelPriv;
	$userLevelPrivEx = 0;
	if (strval($UserLevelID) == "-1") {
		return 31;
	} elseif ($UserLevelID >=0) {
		if (is_array($arUserLevelPriv)) {
			foreach ($arUserLevelPriv as $row) {
				list($table, $levelid, $priv) = $row;
				if (strtolower($table) == strtolower($TableName) && strval($levelid) == strval($UserLevelID)) {
					if (is_null($priv) || !is_numeric($priv)) return 0;
					return intval($priv);
				}
			}
		}
	}
}

// Get current user level name
function CurrentUserLevelName() {
	return GetUserLevelName(CurrentUserLevel());
}

// Get user level name based on user level
function GetUserLevelName($UserLevelID) {
	global $arUserLevel;
	if (strval($UserLevelID) == "-1") {
		return "Administrator";
	} elseif ($UserLevelID >= 0) {
		if (is_array($arUserLevel)) {
			foreach ($arUserLevel as $row) {
				list($levelid, $name) = $row;
				if (strval($levelid) == strval($UserLevelID))
					return $name;
			}
		}
	}
}

// Show user levels
function ShowUserLevelInfo() {
	global $arUserLevel;
	global $arUserLevelPriv;
	echo "<pre class=\"phpreportmaker\">";
	print_r($arUserLevel);
	print_r($arUserLevelPriv);
	echo "</pre>";
	echo "<p>CurrentUserLevel = " . CurrentUserLevel() . "</p>";
}

// Function to check privilege for List page (for menu items)
function AllowList($TableName) {
	return (CurrentUserLevelPriv($TableName) & EW_ALLOW_LIST);
}

// Get current user name from session
function CurrentUserName() {
	return @$_SESSION[EW_REPORT_SESSION_USERNAME];
}

// Get current user id from session
function CurrentUserID() {
	return strval(@$_SESSION[EW_REPORT_SESSION_USERID]);
}

// Get current parent user id from session
function CurrentParentUserID() {
	return @$_SESSION[EW_REPORT_SESSION_PARENT_USERID];
}

// Get current user level from session
function CurrentUserLevel() {
	return @$_SESSION[EW_REPORT_SESSION_USERLEVEL];
}

// Check if user is logged in
function IsLoggedIn() {
	return (@$_SESSION[EW_REPORT_SESSION_STATUS] == "login");
}

// Check if user is system administrator
function IsSysAdmin() {
	return (@$_SESSION[EW_REPORT_SESSION_SYSTEM_ADMIN] == 1);
}

// Load user level from session
function LoadUserLevel() {
	SetupUserLevel();
}
?>
