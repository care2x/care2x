<?php
/*
 * TextField
 *
 * This class represents a text field that will 
 * collect password information from the user.
 */
class PasswordField extends Field {
    
    function PasswordField($name, $label, $default){
        parent::Field($name, $label, 'password', $default);
    }
}
?>