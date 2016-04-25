<?php
/*
 * TextField
 *
 * This class represents a text field that will
 * collect password information from the user.
 */
class PasswordField extends Field {

    function __construct($name, $label, $default){
        parent::__construct($name, $label, 'password', $default);
    }
}
?>