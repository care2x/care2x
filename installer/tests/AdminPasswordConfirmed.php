<?php
/*
 * AdminPasswordConfirmed
 *
 * Tests if the user has entered the administrator twice identically. 
 */
 
class AdminPasswordConfirmed extends BaseTest {
    
    var $password;
    
    var $confirm;
    
    function AdminPasswordConfirmed($params) {
        parent::BaseTest($params);

        if(!is_array($this->params) || count($this->params) <= 0){
            ErrorStack::addError("Invalid parameters, you need to provide the password field names", ERRORSTACK_ERROR, 'AdminPasswordConfirmed');
            $this->result = INSTALLER_TEST_FAIL;
            return $this->result;
        }
    }
    
    function prepareParameters() {
        $engine =& $GLOBALS['INSTALLER']['ENGINE'];

        if (isset($this->params['password_field'])) {
            $password_field = $engine->getField($this->params['password_field']);
            $this->password = $password_field->value;
        } else if (isset($this->params['password'])) {
            $this->password = $this->params['password'];
        } else {
            $this->result_message = "Could not determine administrator password, please provide a password_field or password parameter!";
            return FALSE;
        }

        if (isset($this->params['confirm_field'])) {
            $confirm_field = $engine->getField($this->params['confirm_field']);
            $this->confirm = $confirm_field->value;
        } else if (isset($this->params['confirm'])) {
            $this->confirm = $this->params['confirm'];
        } else {
            $this->result_message = "Could not determine administrator confirm password, please provide a confirm_field or confirm parameter!";
            return FALSE;
        }
    }
    
    function perform(){
        if ($this->prepareParameters() === FALSE) {
            $this->result = INSTALLER_TEST_FAIL;
            return $this->result;
        }

        if (strcmp($this->password, $this->confirm) == 0) {
            $this->result = INSTALLER_TEST_SUCCESS;
            $this->result_message = "Administrator password confirmed correctly";
        } else {
            $this->result = INSTALLER_TEST_FAIL;
            $this->result_message = "Administrator password is not confirmed correctly. Make sure you have entered identical values in the 'Password' and 'Confirm Password' fields";
        }
        
        return $this->result;
    }
}
?>
