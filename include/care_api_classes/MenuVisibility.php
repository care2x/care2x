<?php
/*
 * Created on 15-feb-2006 by Daniele Palmas and Guido Porruvecchio
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 require_once('StringPermissionParser.php');
 
 class MenuVisibility {
 	var $matches = array("Admission"=>"admission", "Medocs"=>"medocs", "Doctors"=>"doctors", "Nursing"=>"nursing",
 						 "OR"=>"op", "Laboratories"=>"lab", "Radiology"=>"radio", "Pharmacy"=>"pharma",
 						 "Medical Depot"=>"meddepot", "Directory"=>"teldir", "Tech Support"=>"tech",
 						 "System Admin"=>"System Admin", "Special Tools"=>"Special Tools",
 						 "Patient"=>"Patient", "Appointments"=>"Appointments", "Ambulatory"=>"Ambulatory",
 						 "Intranet Email"=>"Intranet Email");
 	var $strParser;
 	
 	function MenuVisibility($stringPermissions) {
 		$this->strParser = new StringPermissionParser();
 		$this->strParser->setString($stringPermissions);
 	}
 	
 	function isAllowed($stringMenu) {
 		if (!(array_key_exists($stringMenu, $this->matches))) 
 			return false;
 		if ( $this->strParser->isPresent($this->matches[$stringMenu]) ) 
 			return true;
 		else 
 			return false;
 	}
 	
 	function isLogged($user) {
 		if ($_COOKIE[$user]=='true') return true;
 		else return false;
 	}
 
 }
?>
