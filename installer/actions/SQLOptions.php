<?php
/*
 * SQLOptions Class
 *
 * This is an abstract class that needs to have at
 * least the perform method overridden
 */
class SQLOptions extends SQLFile {
	
	var $params_prepared = false;
	var $file = "";	

	function SQLOptions($title, $params){
		parent::BaseAction($title, $params);
		
		$this->interactive = true;
		$this->grouping = true;
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
			$this->result_message = "Completed optional database file installation.";
			return $this->result;
		}

		if($this->prepareParameters() === FALSE){
			$this->result = INSTALLER_ACTION_FAIL;
			return $this->result;
		}
		$sql_commands = array();
		$file = $this->file;
		if(!empty($file) && !is_readable($file)){
                	$this->result = INSTALLER_ACTION_FAIL;
                        $this->result_message = "Could not read file sql $file.";
                        $this->loop = 2;
                        return $this->result;
                }
		else if ($this->loop < 3) {
			$this->loop = 3;
			$this->result = INSTALLER_ACTION_WARNING;
                        $this->result_message = "The database file you selected is being installed, this may take several minutes especially for larger code packs.";
			return $this->result;
		}

		$file_contents = file($file);
		$file_contents = join('', $file_contents);
		if(!$this->splitMySqlFile($sql_commands[], $file_contents)){
			$this->result = INSTALLER_ACTION_FAIL;
			$this->result_message = "Error parsing file $file";
			$this->loop = 2;
			return $this->result;
		}
		
		# Connect to the DB
		$db = $this->connect();
		if ($db === FALSE)
			return $this->result;

		$query_count = 0;
		foreach($sql_commands as $sql_command_set) {
			if (!is_null($sql_command_set)) {
				foreach($sql_command_set as $sql_statement) {
					$this->result_message =$sql_statement['query'];
					@$ok = $db->Execute($sql_statement['query']);
					if (!$ok) {
						$this->result_message = "Error running SQL query: <BR>\n".$sql_statement['query']."<BR>\n".$db->ErrorMsg();
						$this->result = INSTALLER_ACTION_FAIL;
						$this->loop = 2;
						return $this->result;
					}
					$query_count++;
				}
			}
		}
		$this->result = INSTALLER_ACTION_WARNING;
		$this->result_message = "Loaded database file with $query_count queries";
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
                  if (preg_match("/^.*\.sql$/",$entry)) {
			       		$pretty_name = ucwords(str_replace("_"," ",preg_replace("/^(.*)\.sql/","\$1",$entry)));
                     $this->file_list[$pretty_name] = $d->path . "/" . $entry;
                   }
                                }
                                $d->close();
                        }
                        else if (file_exists($file)) {
				$pretty_name = ucwords(str_replace("_"," ",preg_replace("/^.*\/(.*)\.sql$/","\$1",$file)));
                                $this->file_list[$pretty_name] = $file;
                        }
                }
		}	
		$this->params_prepared = true;
	}

	function getHTML($smarty){
		if($this->prepareParameters() === FALSE){
                        $this->result = INSTALLER_ACTION_FAIL;
                        return $this->result;
                }

		$smarty->assign("files",$this->file_list);	
		$smarty->assign("loop",$this->loop);
		$smarty->assign_by_ref('ACTION', $this);
                if ($this->loop == 3) {
			$es =& $GLOBALS['INSTALLER']['SMARTY'];
                	$es->assign('HEADER_EXTRAS','<META HTTP-EQUIV=Refresh CONTENT="2; URL=install.php?save_action=true">');
		}
                return $smarty->fetch(Installer::getTemplatePath('action_sql_options.tpl'));
        }

	function dataSubmitted(){
                if (isset($_POST['install_sql_done'])) {
			$this->loop = 5;
			return $this->result;
		}
		else if (isset($_POST['install_sql'])) {
			if (isset($_POST['optfile'])) {
						//gjergji : fixed problem with magic_quotes on on windows...
						if (get_magic_quotes_gpc() == 1 ){
							if (!empty($_GET))    { $_GET    = strip_magic_quotes($_GET);    }
							if (!empty($_POST))   { $_POST   = strip_magic_quotes($_POST);   }
							if (!empty($_COOKIE)) { $_COOKIE = strip_magic_quotes($_COOKIE); }
					}
				if (array_search($_POST['optfile'], $this->file_list)) {
					$this->file = $_POST['optfile'];
					
					$this->result = INSTALLER_ACTION_FAIL;
					$this->result_message = "Installing File.";
					return $this->result;

				}
			}
		}
		return false;
        }
}
?>
