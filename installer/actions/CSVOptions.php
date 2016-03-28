<?php
/*
 * SQLOptions Class
 *
 * This is an abstract class that needs to have at
 * least the perform method overridden
 */
class CSVOptions extends SQLOptions {

	function CSVOptions($title, $params){
		parent::SQLOptions($title, $params);

	}
	
	/*
	 * This function needs to be overriden in the implementing class
	 * and should return either TRUE or FALSE.
	 * 
	 * @var $params array Array of parameters needed for the specific implementation
	 */
	function perform(){
		if (empty($this->loop)) {
			$this->loop = 1;
		}
		elseif ($this->loop == 5) {
			$this->result = INSTALLER_ACTION_SUCCESS;
			$this->result_message = "Completed optional database table installation.";
			return $this->result;
		}

		if($this->prepareParameters() === FALSE){
			$this->result = INSTALLER_ACTION_FAIL;
			return $this->result;
		}

		$file = $this->file;
		if(!empty($file) && !is_readable($file)){
                	$this->result = INSTALLER_ACTION_FAIL;
                        $this->result_message = "Could not read file $file.";
                        $this->loop = 2;
                        return $this->result;
                }
		else if ($this->loop < 3) {
			$this->loop = 3;
			$this->result = INSTALLER_ACTION_WARNING;
                        $this->result_message = "The database table you selected is being installed, this may take several minutes especially for larger code packs.";
			return $this->result;
		}
		
		# Connect to the DB
		$db = $this->connect();
		if ($db === FALSE)
			return $this->result;

		# Open the file for reading
		$handle = fopen($file, "r");
		if (!$handle) {
			   $this->result = INSTALLER_ACTION_FAIL;
                        $this->result_message = "Could not open file $file for reading.";
                        $this->loop = 2;
                        return $this->result;
		}

		# The name of the table is the name of the file without the extention and with prefix "care_"
		$table = "care_".basename($file, ".csv");

		# Read the first line to get the number of table columns
		$columns = fgetcsv($handle, 32768, ";");

        # Rewind the file pointer to the beginning of the file
        rewind($handle);
  	
		# Construct the sql template
		//$sql_template = "INSERT INTO ".$table." (".implode(",", $columns).") values (".implode(",", array_fill(0, count($columns), "?")).");";
        $sql_template = "INSERT INTO ".$table." VALUES (".implode(",", array_fill(0, count($columns), "?")).");";

		# Prepare the template
		$sql = $db->Prepare($sql_template);

		# Read the rest of the file and fill the database table with the content
		$query_count = 0;
		while (!feof($handle)) {
			# Read next line
			$values = fgetcsv($handle, 32768, ";");
			if ($values[0] != null) {
                # Unescape values
                $values = array_map('stripslashes', $values);

				# Execute the sql query
				@$ok = $db->Execute($sql, $values);
				if (!$ok) {
					$this->result_message = "Error running SQL query: <BR>\n".$sql_statement['query']."<BR>\n".$db->ErrorMsg();
					$this->result = INSTALLER_ACTION_FAIL;
					$this->loop = 2;
					return $this->result;
				}
				$query_count++;
			}
		}

		# Close the file handle
		fclose($handle);

		$this->result = INSTALLER_ACTION_WARNING;
		$this->result_message = "Loaded database table with $query_count queries";
		$k = array_search($this->file,$this->file_list);
		if (isset($this->file_list[$k]))
			unset($this->file_list[$k]);
		$this->file = "";

		$this->loop = 1;	
		return $this->result;
	}

		
	function prepareParameters(){
		if ($this->params_prepared) {
			return true;
		}

		if ($this->prepareDBParameters() === FALSE)
			return FALSE;

		// Get file list
		if(!isset($this->params['files']) || !is_array($this->params['files']) || count($this->params['files']) == 0){
			$this->result_message = "You must provide a files parameter that is an array of the files to load";
			return FALSE;
		}else{

			$this->file_list = array();
                	foreach($this->params['files'] as $file){
                        if(is_dir($file)) {
                                $d = dir($file);
                                while (false !== ($entry = $d->read())) {
                                   if (preg_match("/^.*\.csv$/",$entry)) {
					$pretty_name = ucwords(str_replace("_"," ",preg_replace("/^(.*)\.csv/","\$1",$entry)));
                                        $this->file_list[$pretty_name] = $d->path . "/" . $entry;
                                   }
                                }
                                $d->close();
                        }
                        else if (file_exists($file)) {
				$pretty_name = ucwords(str_replace("_"," ",preg_replace("/^.*\/(.*)\.csv$/","\$1",$file)));
                                $this->file_list[$pretty_name] = $file;
                        }
                }
		}	
		$this->params_prepared = true;
	}
}
?>
