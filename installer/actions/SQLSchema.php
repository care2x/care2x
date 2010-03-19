<?php
/*
 * SQLSchema Class
 *
 * This action creates the DB schema from the given AXMLS descriptor. 
 */
class SQLSchema extends SQLFile {
	
	var $schema_file;
	
	function SQLSchema($title, $params) {
		parent::SQLFile($title, $params);
		
		$this->interactive = true;
		$this->grouping = false;
	}
	
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
		
		if(!is_readable($this->schema_file)){
			$this->result = INSTALLER_ACTION_FAIL;
			$this->result_message = "Could not read file sql $this->schema_file.";
			$this->loop = 2;
			return $this->result;
		}

        # Connect to the DB
        $db = $this->connect();
        if ($db === FALSE)
            return $this->result;

        # Create empty ADOdb connection
        $conn = ADONewConnection($this->type);
		
		# Create new ADO Schema object
		$schema = new adoSchema($conn);
		
		# Build the SQL query from the Schema file
		$sql = $schema->ParseSchema($this->schema_file);

		# Execute the SQL query
		# "2" is status returned by ExecuteSQLArray()
        $dict = NewDataDictionary($db);
		@$ok = (2 == $dict->ExecuteSQLArray($sql, FALSE));
		if ($ok) {
			$this->result = INSTALLER_ACTION_SUCCESS;
			$this->result_message = "DB schema loaded successfully";
			$this->loop = 3;
		} else {
			$this->result = INSTALLER_ACTION_FAIL;
			$this->result_message = "Errors on execution of the schema SQL: ".$db->ErrorMsg();
			$this->loop = 2;
		}
		
		return $this->result;
	}
	
	function prepareParameters() {
        if ($this->prepareDBParameters() === FALSE)
            return FALSE;

		if (!isset($this->params['schema'])){
			$this->result_message = "You must provide a schema parameter";
			return FALSE;
		} else {
			$this->schema_file = $this->params['schema'];
		}
	}
	
}
?>
