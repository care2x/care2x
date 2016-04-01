<?php

# include ADOdb class files
require_once(APP_PATH.'/classes/adodb/adodb.inc.php');
require_once(APP_PATH.'/classes/adodb/adodb-errorhandler.inc.php');
require_once(APP_PATH.'/classes/adodb/adodb-xmlschema.inc.php');

/*
 * SQLAction Class
 *
 * This is an abstract class that needs to have at
 * least the perform method overridden
 */
class SQLAction extends BaseAction {

    var $server;
    
    var $username;
    
    var $password;
    
    var $type;
    
    var $db_name;

    function SQLAction($title, $params) {
        $this->title = $title;
        $this->params = $params;
    }

    function prepareDBParameters() {
        $engine =& $GLOBALS['INSTALLER']['ENGINE'];

        if (isset($this->params['server_field'])) {
            $server_field = $engine->getField($this->params['server_field']);
            $this->server = $server_field->value;
        } else if (isset($this->params['server'])) {
             $this->server = $this->params['server'];
        } else {
            $this->result_message = "Could not determine server name, please provide a server_field or server parameter!";
            return FALSE;
        }
        
        if (isset($this->params['username_field'])) {
            $username_field = $engine->getField($this->params['username_field']);
            $this->username = $username_field->value;
        } else if (isset($this->params['username'])) {
            $this->username = $this->params['username'];
        } else {
            $this->result_message = "Could not determine datbase username, please provide a username_field or username parameter!";
            return FALSE;
        }

        if (isset($this->params['password_field'])) {
            $password_field = $engine->getField($this->params['password_field']);
            $this->password = $password_field->value;
        } else if (isset($this->params['password'])) {
            $this->password = $this->params['password'];
        } else {
            $this->result_message = "Could not determine database password, please provide a password_field or password parameter!";
            return FALSE;
        }
        
        if (isset($this->params['type_field'])) {
            $type_field = $engine->getField($this->params['type_field']);
            $this->type = $type_field->value;
        } else if (isset($this->params['type'])) {
            $this->type = $this->params['type'];
        } else {
            $this->result_message = "Could not determine database type, please provide a type_field or type parameter!";
            return FALSE;
        }
        
        if (isset($this->params['db_field'])) {
            $database_field = $engine->getField($this->params['db_field']);
            $this->db_name = $database_field->value;
        } else if (isset($this->params['db_name'])) {
            $this->db_name = $this->params['db_name'];
        } else {
            $this->result_message = "Could not determine database name, please provide a db_field or db_name parameter!";
            return FALSE;
        }
    }

    function connect() {
        # Construct the database address
        $address = $this->server;

        # Create ADODB connection object
        @$db = ADONewConnection($this->type);
        if (!$db) {
            $this->result = INSTALLER_ACTION_FAIL;
            $this->result_message = "Cannot create ADODB connection of type $this->type";
            $this->loop = 2;
            return FALSE;
        }
        
        # First try to connect to the exact database on server
        @$ok = $db->Connect($address, $this->username, $this->password, $this->db_name);
        
        # If failed to connect to the database, then create it
        if (!$ok) {
            # Failed db connection has to be constructed from start
            @$db = ADONewConnection($this->type);
            if (!$db) {
                $this->result = INSTALLER_ACTION_FAIL;
                $this->result_message = "Could not create ADODB connection of type $this->type";
                $this->loop = 2;
                return FALSE;
            }
            
            # Try connecting without database parameter
            @$ok = $db->Connect($address, $this->username, $this->password);
            if (!$ok) {
                $this->result = INSTALLER_ACTION_FAIL;
                $this->result_message = "Could not connect to $this->dbtype database server $address with username $this->username: ".$db->ErrorMsg();
                $this->loop = 2;
                return FALSE;
            }
            
            # LATIN1 encoding is required for PostgreSQL databases
            $taboptarray = array('postgres' => 'ENCODING = \'LATIN1\'');
            
            # Get SQL to create database
            $dict = NewDataDictionary($db);
            $sql = $dict->CreateDatabase($this->db_name, $taboptarray);
            
            # Try creating database
            # "2" is status returned by ExecuteSQLArray()
            @$ok = (2 == $dict->ExecuteSQLArray($sql));
            if (!$ok) {
                $this->result = INSTALLER_ACTION_FAIL;
                $this->result_message = "Could not create database $this->db_name: ".$db->ErrorMsg();
                $this->loop = 2;
                return FALSE;
            }
            
            # Try to connect after creating
            @$ok = $db->Connect($address, $this->username, $this->password, $this->db_name);
            if (!$ok) {
                $this->result = INSTALLER_ACTION_FAIL;
                $this->result_message = "Could connect to database $this->db_name just after successfully creating it: ".$db->ErrorMsg();
                $this->loop = 2;
                return FALSE;
            }
        }

        return $db;
    }

}
?>
