<?php
/*
 * CreateAdmin Class
 *
 * This action creates Administrator user account.  
 */
class CreateAdmin extends SQLAction {
    
    var $admin_user;

    var $admin_pass;
    
   /* function CreateAdmin($params) {
        parent::SQLAction($params);
        
        $this->interactive = false;
        $this->grouping = false;
    }*/
    
    /*
     * This function needs to be overriden in the implementing class
     * and should return either TRUE or FALSE.
     * 
     * @var $params array Array of parameters needed for the specific implementation
     */
    function perform() {
        if (empty($this->loop)) {
            $this->loop = 1;
        }

        if($this->prepareParameters() === FALSE){
            $this->result = INSTALLER_ACTION_FAIL;
            return $this->result;
        }

        # Connect to the DB
        $db = $this->connect();
        if ($db === FALSE)
            return $this->result;

        $sql = "INSERT INTO care_users (name, login_id, password, permission, exc, modify_id, create_id) VALUES ('admin', '".$this->admin_user."', '".md5($this->admin_pass)."', 'System_Admin', 1, 'auto-installer', 'auto-installer')";

        @$ok = $db->Execute($sql);
        if ($ok) {
            $this->result = INSTALLER_ACTION_SUCCESS;
            $this->result_message = "Administrator user created successfully";
            $this->loop = 3;
        } else {
            $this->result = INSTALLER_ACTION_FAIL;
            $this->result_message = "Cannot create Administrator user: ".$db->ErrorMsg();
            $this->loop = 2;
        }
        
        return $this->result;
    }
        
    function prepareParameters() {
        if ($this->prepareDBParameters() === FALSE)
            return FALSE;

        $engine =& $GLOBALS['INSTALLER']['ENGINE'];

        if (isset($this->params['adminuser_field'])) {
            $adminuser_field = $engine->getField($this->params['adminuser_field']);
            $this->admin_user = $adminuser_field->value;
        } else if (isset($this->params['adminuser'])) {
            $this->admin_user = $this->params['adminuser'];
        } else {
            $this->result_message = "Could not determine Administrator username, please provide a adminuser_field or adminuser parameter!";
            return FALSE;
        }

        if (isset($this->params['adminpass_field'])) {
            $adminpass_field = $engine->getField($this->params['adminpass_field']);
            $this->admin_pass = $adminpass_field->value;
        } else if (isset($this->params['adminpass'])) {
            $this->admin_pass = $this->params['adminpass'];
        } else {
            $this->result_message = "Could not determine Administrator password, please provide a adminpass_field or adminpass parameter!";
            return FALSE;
        }
    }
    
}
?>
