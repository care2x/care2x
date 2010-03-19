<?php
/*
 * Field
 *
 * This is the base class that represents information
 * that will need to be collected from the user.
 */
class Field {

    var $name;
    
    var $label;
    
    var $type;
    
    var $value;
    
    var $default;

    var $completed;
    
    function Field($name, $label, $type, $default) {
        $this->name = $name;
        $this->label = $label;
        $this->type = $type;
        $this->default = $default;
    }
    
    /*
     * This method returns the HTML used to get
     * the user input.
     */
    function getHTML($smarty) {
        $smarty->assign_by_ref('field', $this);
        $output = $smarty->fetch(Installer::getTemplatePath("field_$this->type.tpl"));
        $smarty->clear_assign('field');
        
        return $output;
    }
    
    function saveField() {
        if (isset($_REQUEST['FIELDS'][$this->name])) {
            $this->value = $_REQUEST['FIELDS'][$this->name];
            $this->completed = true;
        }
    }
}
?>
