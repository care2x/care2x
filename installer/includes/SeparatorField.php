<?php
/*
 * SeparatorField
 *
 * This class represents a separator that could be used to separate
 * other fields into groups.
 */
class SeparatorField extends Field {

    function __construct($label){
        parent::__construct('', $label, 'separator', '');
    }
}
?>