<?php
/*
 * Created on 6-feb-06 by Daniele Palmas and Guido Porruvecchio
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
 class StringParser {
 	
 	var $pstring;
 	
 	function StringParser(){
 		$this->pstring = NULL;
 	}
 	
 	function setString($perm){
 		$this->pstring = $perm;
 	}
 	
 	function getString(){
 		return $this->pstring;
 	}

 	function isPresent($perm){
 		return strpos($this->pstring, $perm) != false;
 	}
 };
 
?>

