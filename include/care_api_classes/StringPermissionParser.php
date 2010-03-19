<?php
/*
 * Created on 6-feb-06 by Daniele Palmas and Guido Porruvecchio
 */
 require_once('StringParser.php');
 
 class StringPermissionParser extends StringParser {
 	
 	function isPresent($perm){
 		if($this->getString() == 'System_Admin')
 			return true;
 		if($this->getString() == '_a_0_all ') {
 			if( ($perm != 'System Admin') && ($perm != 'Special Tools'))
 				return true;
 			else
 				return false;
 		}
 		if ($this->getString()!='' && ($perm == 'Patient' || $perm == 'Appointments' || $perm == 'Ambulatory' || $perm == 'Intranet Email' || $perm == 'Special Tools')) 
 			return true;
 		return StringParser::isPresent($perm);
 	}
 	
 };
 
?>

