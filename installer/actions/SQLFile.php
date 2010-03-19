<?php
/*
 * SQLFile Class
 *
 * This is an abstract class that needs to have at
 * least the perform method overridden
 */
class SQLFile extends SQLAction {
	
	var $file_list;
	
	var $loop;
	
	function SQLFile($title, $params){
		parent::SQLAction($title, $params);
		
		$this->interactive = true;
		$this->grouping = false;
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

		if($this->prepareParameters() === FALSE){
			$this->result = INSTALLER_ACTION_FAIL;
			return $this->result;
		}
		$sql_commands = array();
		foreach($this->file_list as $file) {
            # Replace %type% in the file name with the database type
            $file = str_replace("%type%", $this->type, $file);

			if(!is_readable($file)){
				$this->result = INSTALLER_ACTION_FAIL;
				$this->result_message = "Could not read file sql $file.";
				$this->loop = 2;
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
		}

        # Connect to the DB
        $db = $this->connect();
        if ($db === FALSE)
            return $this->result;

        $query_count = 0;
        foreach($sql_commands as $sql_command_set) {
            if (!is_null($sql_command_set)) {
                foreach($sql_command_set as $sql_statement) {
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
        $this->result = INSTALLER_ACTION_SUCCESS;
        $this->result_message = "Loaded ".count($this->file_list)." sql files with $query_count queries";
        $this->loop = 3;
		
		return $this->result;
	}
		
	function prepareParameters() {
        if ($this->prepareDBParameters() === FALSE)
            return FALSE;

		// Get file list
		if(!isset($this->params['files']) || !is_array($this->params['files']) || count($this->params['files']) == 0) {
			$this->result_message = "You must provide a files parameter that is an array of the files to load";
			return FALSE;
		} else {
			$this->file_list = $this->params['files'];
		}
	}

	/**
	* Function from phpMyAdmin (http://phpwizard.net/projects/phpMyAdmin/)
	*
 	* Removes comment and splits large sql files into individual queries
 	*
	* Last revision: September 23, 2001 - gandon
 	*
 	* @param   array    the splitted sql commands
 	* @param   string   the sql commands
 	* @return  boolean  always true
 	* @access  public
 	*/
	function splitMySqlFile(&$ret, $sql){
	    // do not trim, see bug #1030644
	    //$sql          = trim($sql);
	    $sql          = rtrim($sql, "\n\r");
	    $sql_len      = strlen($sql);
	    $char         = '';
	    $string_start = '';
	    $in_string    = FALSE;
	    $nothing      = TRUE;
	    $time0        = time();
	
	    for ($i = 0; $i < $sql_len; ++$i) {
	        $char = $sql[$i];
	
		//echo "parsing character $i<br>";
	
	        // We are in a string, check for not escaped end of strings except for
	        // backquotes that can't be escaped
	        if ($in_string) {
	            for (;;) {
	                $i         = strpos($sql, $string_start, $i);
	                // No end of string found -> add the current substring to the
	                // returned array
	                if (!$i) {
	        	//	echo "<br> instring <br>"; echo $sql;
		           $ret[] = array('query' => $sql, 'empty' => $nothing);
	                    return TRUE;
	                }
	                // Backquotes or no backslashes before quotes: it's indeed the
	                // end of the string -> exit the loop
	                else if ($string_start == '`' || $sql[$i-1] != '\\') {
	                    $string_start      = '';
	                    $in_string         = FALSE;
	                    break;
	                }
	                // one or more Backslashes before the presumed end of string...
	                else {
	                    // ... first checks for escaped backslashes
	                    $j                     = 2;
	                    $escaped_backslash     = FALSE;
	                    while ($i-$j > 0 && $sql[$i-$j] == '\\') {
	                        $escaped_backslash = !$escaped_backslash;
	                        $j++;
	                    }
	                    // ... if escaped backslashes: it's really the end of the
	                    // string -> exit the loop
	                    if ($escaped_backslash) {
	                        $string_start  = '';
	                        $in_string     = FALSE;
	                        break;
	                    }
	                    // ... else loop
	                    else {
	                        $i++;
	                    }
	                } // end if...elseif...else
	            } // end for
	        } // end if (in string)
	
	        // lets skip comments (/*, -- and #)
	        else if (($char == '-' && $sql_len > $i + 2 && $sql[$i + 1] == '-' && $sql[$i + 2] <= ' ') 
			|| $char == '#' 
			|| ($char == '/' && $sql_len > $i + 1 && $sql[$i + 1] == '*')) {
	            $i = strpos($sql, $char == '/' ? '*/' : "\n", $i);
	            // didn't we hit end of string?
	            if ($i === FALSE) {
	                break;
	            }
	            if ($char == '/') $i++;
	        }
	
	        // We are not in a string, first check for delimiter...
	        else if ($char == ';') {
	            // if delimiter found, add the parsed part to the returned array
			$parsedsql = substr($sql, 0, $i);
			//	echo "<br> midone <br>";echo $parsedsql;
	            $ret[]      = array('query' => $parsedsql, 'empty' => $nothing);
	            $nothing    = TRUE;
	            $sql        = ltrim(substr($sql, min($i + 1, $sql_len)));
	            $sql_len    = strlen($sql);
	            if ($sql_len) {
	                $i      = -1;
	            } else {
	                /// The submited statement(s) end(s) here
	                return TRUE;
	            }
	        } // end else if (is delimiter)
	
	        // ... then check for start of a string,...
	        else if (($char == '"') || ($char == '\'') || ($char == '`')) {
	            $in_string    = TRUE;
	            $nothing      = FALSE;
	            $string_start = $char;
	        } // end else if (is start of string)
	
	        elseif ($nothing) {
	            $nothing = FALSE;
	        }
	
	        //loic1: send a fake header each 30 sec. to bypass browser timeout
	        $time1     = time();
	        if ($time1 >= $time0 + 30) {
	            $time0 = $time1;
	            header('X-pmaPing: Pong');
	        } // end if
	    } // end for
	
	    // add any rest to the returned array
	    if (!empty($sql) && preg_match('@[^[:space:]]+@', $sql)) {
		//	echo "<br> bottomone <br>";echo $sql;
	        $ret[] = array('query' => $sql, 'empty' => $nothing);
	    }
	
	    return TRUE;
	}

    function getHTML($smarty) {
        $smarty->assign("loop",$this->loop);
        $smarty->assign_by_ref('ACTION', $this);
        if ($this->loop < 2) {
            $es =& $GLOBALS['INSTALLER']['SMARTY'];
            $es->assign('HEADER_EXTRAS','<META HTTP-EQUIV=Refresh CONTENT="2; URL=install.php?save_action=true">');
        }
        return $smarty->fetch(Installer::getTemplatePath('action_sql_file.tpl'));
    }

    function dataSubmitted() {
        return false;
    }

}
?>
