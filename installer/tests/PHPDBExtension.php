<?php
/*
 * PHPDBExtension
 *
 * Tests that the database extension for the selected
 * database type is loaded into the running PHP instance
 */
 
class PHPDBExtension extends BaseTest {

    var $type;

    function PHPDBExtension($params) {
        parent::BaseTest($params);

        if(!is_array($this->params) || count($this->params) <= 0){
            ErrorStack::addError("Invalid parameters, you need to provide the field names", ERRORSTACK_ERROR, 'PHPDBExtension');
            $this->result = INSTALLER_TEST_FAIL;
            return $this->result;
        }
    }

    function prepareParameters() {
        $engine =& $GLOBALS['INSTALLER']['ENGINE'];
        if (isset($this->params['type_field'])) {
            $type_field = $engine->getField($this->params['type_field']);
            $this->type = $type_field->value;
        } else if (isset($this->params['type'])) {
            $this->type = $this->params['type'];
        } else {
            $this->result_message = "Could not determine database type, please provide a type_field or type parameter!";
            return FALSE;
        }
        if ($this->type == 'postgres7') $this->type = 'pgsql';
    }

    function perform(){
        if($this->prepareParameters() === FALSE){
            $this->result = INSTALLER_TEST_FAIL;
            return $this->result;
        }

        $this->result_message = "PHP Database Extension $this->type found";
        $this->result = INSTALLER_TEST_SUCCESS;
        if(!extension_loaded($this->type)){
            $this->result = INSTALLER_TEST_FAIL;
            $this->result_message = "PHP Database Extension $this->type is not loaded";
        }
        
        return $this->result;
    }
}
?>