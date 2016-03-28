<?php
/*
 * TextField
 *
 * This class represents a text field that will 
 * collect information from the user.
 */
class TextField extends Field {
	
	function TextField($name, $label, $default){
		parent::Field($name, $label, 'text', $default);
	}
}
?>
