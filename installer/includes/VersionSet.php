<?php
/*
 * BaseSet class
 *
 * A type sensitive Set implementation for PHP
 * 
 */
 
class VersionSet extends BaseSet{

	var $complete = null;
	
	function VersionSet(){
		parent::BaseSet('Version');
	}
	
	function validate(){
		$this->reset();
		while($version =& $this->get()){
			if(!$version->validate()){
				$this->_addError("Validation failed on version ".$version->getVersion().": ".$version->getErrorsHTML());
			}
		}	
	}

	function complete(){
		return $this->testsComplete() && $this->actionsComplete();	
	}
	
	function &getTestsForUpgrade($old_version){
		$tests = array();
		$this->reset();
		while($version =& $this->get()){
			if(version_compare($version->getVersion(), $old_version, '>')){
				$version->tests->reset();
				while($test =& $version->tests->get()){
					$tests[] =& $test;
				}
			}
		}
		
		return $tests;
	}

	function &getNextActionsForUpgrade($old_version){
		$actions = array();
		$this->reset();
		while($version =& $this->get()){
			if(version_compare($version->getVersion(), $old_version, '>')){
				$version->actions->reset();
				while($action =& $version->actions->get()){
					if(!$action->success()){
						if($action->allowGrouping()){
							$actions[] =& $action;
						}else{
							if(count($actions) == 0){
								$actions[] =& $action;
							}
							return $actions;
						}
					}
				}
			}
		}
		
		return $actions;
	}

	function &getFieldsForUpgrade($old_version){
		$fields = array();
		$this->reset();
		while($version =& $this->get()){
			if(version_compare($version->getVersion(), $old_version, '>')){
				$version->fields->reset();
				while($field =& $version->fields->get()){
					$fields[] =& $field;
				}
			}
		}
		
		return $fields;
	}

	function testsComplete($old_version){
		$tests = array();
		$this->reset();
		while($version =& $this->get()){
			if(version_compare($version->getVersion(), $old_version, '>')){
				$version->tests->reset();
				while($test =& $version->tests->get()){
					if(!$test->success()){
						return FALSE;
					}
				}
			}
		}
		
		$return = TRUE;
		return $return;
	}

	function actionsComplete($old_version){
		$this->reset();
		while($version =& $this->get()){
			if(version_compare($version->getVersion(), $old_version, '>')){
				$version->actions->reset();
				while($action =& $version->actions->get()){
					if(!$action->success()){
						return FALSE;
					}
				}
			}
		}
		
		$return = TRUE;
		return $return;
	}

	function &getField($name){
		$fields = array();
		$this->reset();
		while($version =& $this->get()){
			$version->fields->reset();
			while($field =& $version->fields->get()){
				if($field->name == $name){
					return $field;
				}
			}
		}
		
		$return = false;
		return $return;		
	}

	function &getFinalAction($old_version) {
		$this->reset();
		while ($version =& $this->get()){
			if (version_compare($version->getVersion(), $old_version, '>')) {
				return $version->finalAction;
			}
		}
		
		return FALSE;
	}
	
	function getNewestVersion() {
		$newest_version = FALSE;
		
		$this->reset();
		while ($version =& $this->get()){
			if (version_compare($version->getVersion(), $newest_version, '>')) {
				$newest_version = $version->getVersion();
			}
		}
		
		return $newest_version;
	}
	
	function getNewestLongVersion() {
		$newest_version = FALSE;
		
		$this->reset();
		while ($version =& $this->get()){
			if (version_compare($version->getVersion(), $newest_version, '>')) {
				$newest_version = $version->getLongVersion();
			}
		}
		
		return $newest_version;
	}
}
?>
