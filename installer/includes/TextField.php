<?php
/*
 * TextField
 *
 * This class represents a text field that will
 * collect information from the user.
 */
class TextField extends Field {

	function __construct($name, $label, $default){
		parent::__construct($name, $label, 'text', $default);
	}
}
?>
