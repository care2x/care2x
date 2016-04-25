<?php
/*
 * VersionCheck class
 *
 */

class VersionCheck{

	function __construct(){
	}

	function getCurrentVersion(){
		return FALSE;
	}

	function getSpecialActions($old_version){
		return FALSE;
	}
}
?>
