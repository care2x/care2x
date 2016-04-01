<?php
/*
 * DBVersionOver
 *
 * Tests that the running Database Version is >= the supplied parameter
 */
 
class DBVersionOver extends BaseTest {
	var $server;
	
	var $username;
	
	var $password;

    var $type;
	
	var $version;
	
	function DBVersionOver($params) {
		parent::BaseTest($params);

		if(!is_array($this->params) || count($this->params) <= 0){
			ErrorStack::addError("Invalid parameters, you need to provide the field names and version", ERRORSTACK_ERROR, 'DBVersionOver');
			$this->result = INSTALLER_TEST_FAIL;
			return $this->result;
		}
	}
	
	function prepareParameters() {
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
			$this->result_message = "Could not determine datbase password, please provide a password_field or password parameter!";
			return FALSE;
		}

        if (isset($this->params['type_field'])) {
            $type_field = $engine->getField($this->params['type_field']);
            $this->type = $type_field->value;
        } else if (isset($this->params['type'])) {
            $this->type = $this->params['type'];
        } else {
            $this->result_message = "Could not determine datbase type, please provide a type_field or type parameter!";
            return FALSE;
        }
		
		if(isset($this->params['version'])) {
			$this->version = $this->params['version'];
		} else {
			$this->result_message = "Could not find required version number, please provide a version parameter!";
			return FALSE;
		}
	}
	
	function perform(){
		if ($this->prepareParameters() === FALSE) {
			$this->result = INSTALLER_TEST_FAIL;
			return $this->result;
		}

        # include ADOdb class files
        require_once('../classes/adodb/adodb.inc.php');
        require_once('../classes/adodb/adodb-errorhandler.inc.php');

        # Create ADODB connection object
        @$db = ADONewConnection($this->type);
        if (!$db) {
            $this->result = INSTALLER_TEST_FAIL;
            $this->result_message = "Cannot create ADODB connection of type $this->type";
            return $this->result;
        }

        # Construct the database address
        $address = $this->server;
        # Connect to the database
        @$ok = $db->Connect($address, $this->username, $this->password);
        if (!$ok) {
            $this->result = INSTALLER_TEST_FAIL;
            $this->result_message = "Could not connect to $this->dbtype database server $address with username $this->username: ".$db->ErrorMsg();
            return $this->result;
        }

        # Obtain version information about the database
        @$info = $db->ServerInfo();
        if (!$info) {
            $this->result = INSTALLER_TEST_FAIL;
            $this->result_message = "Error getting database server version information: ".$db->ErrorMsg();
            return $this->result;
        }

        $ver = $info['version'];
        $target_version = $this->version[$this->type];
        if (version_compare($ver, $target_version, '>=')) {
            $this->result = INSTALLER_TEST_SUCCESS;
            $this->result_message = "You are running $this->type version $ver which is >= $target_version";
        } else {
            $this->result = INSTALLER_TEST_FAIL;
            $this->result_message = "You are running $this->type version $ver which is < $target_version";
        }
		
		return $this->result;
	}
}
?>
