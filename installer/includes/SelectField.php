<?php
/*
 * SelectField
 *
 * This class represents a select field that will
 * collect choice from the user.
 */
class SelectField extends Field {
    
    var $options;
    
    var $values;
    
    function SelectField($name, $label, $options, $values, $default) {
        parent::Field($name, $label, 'select', $default);
        
        $this->options = $options;
        $this->values = $values;
    }
}
?>
