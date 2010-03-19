<?php
/*
 * RenameFile Class
 *
 * This action will rename the specified critical installation files. 
 */
class RenameFile extends BaseAction {

	var $file_list;
	
	var $message;
		
	function RenameFile($title, $params){
		parent::BaseAction($title, $params);
		
		$this->interactive = false;
		$this->grouping = true;
	}
	
	/*
	 * This function needs to be overriden in the implementing class
	 * and should return either TRUE or FALSE.
	 * 
	 * @var $params array Array of parameters needed for the specific implementation
	 */
	function perform() {
		if($this->prepareParameters() === FALSE) {
			$this->result = INSTALLER_ACTION_FAIL;
			return $this->result;
		}
		
		$sql_commands = array();
		foreach ($this->file_list as $old_file => $new_file){
			if (file_exists($old_file)) {
				if (rename($old_file, $new_file) === FALSE) {
					$this->result = INSTALLER_ACTION_FAIL;
					$this->result_message = "Could not rename file $old_file. Possibly, there is file permissions problem. ";
					return $this->result;
				}
			}
		}
		
		$this->result_message = $this->message;
		$this->result = INSTALLER_ACTION_SUCCESS;
		return $this->result;
	}
			
	function prepareParameters(){
		$this->replacements = array();
		$engine =& $GLOBALS['INSTALLER']['ENGINE'];
		if(isset($this->params['fields'])){
			if(is_array($this->params['fields']) && count($this->params['fields']) > 0){
				foreach($this->params['fields'] as $marker => $field){
					if(!empty($marker)){
						$this->replacements[] =& new ReplaceString_Replacement($marker, $field);
					}
				}	
			}
		}

		if(isset($this->params['strings'])){
			if(is_array($this->params['strings']) && count($this->params['strings']) > 0){
				foreach($this->params['strings'] as $marker => $string){
					if(!empty($marker)){
						$this->replacements[] =& new ReplaceString_Replacement($marker, '',$string);
					}
				}	
			}
		}
		
		// Get file list
		if(!isset($this->params['files']) || !is_array($this->params['files']) || count($this->params['files']) == 0){
			$this->result_message = "You must provide a files parameter that is an array of the files to work on";
			return FALSE;
		}else{
			$this->file_list = $this->params['files'];			
		}		

		// Get success message
		if(isset($this->params['message']) && !empty($this->params['message'])){
			$this->message = $this->params['message'];
		}else{
			$this->message = "All files updated!";			
		}		
	}
}
?>
