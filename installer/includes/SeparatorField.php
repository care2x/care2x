<?php
/*
 * SeparatorField
 *
 * This class represents a separator that could be used to separate 
 * other fields into groups. 
 */
class SeparatorField extends Field {
    
    function SeparatorField($label){
        parent::Field('', $label, 'separator', '');
    }
}
?>