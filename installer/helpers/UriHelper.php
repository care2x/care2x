<?php
function ConnectionTypeHelper() {
	
	// Determine if the request was over SSL (HTTPS)
	if (isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) && (strtolower($_SERVER['HTTPS']) != 'off')) {
		$https = 'https://';
	} else {
		$https = 'http://';
	}
	
	return $http;
}

function UriHelper() {

	$theURI = $_SERVER['HTTP_HOST'] . str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
	$theURI = substr($theURI,0,-10);
	
	
	return $theURI;
}