<?php
/*
 * Version class
 * 
 */

require_once realpath(dirname(__FILE__)).'/ActionSet.php';
require_once realpath(dirname(__FILE__)).'/TestSet.php';
require_once realpath(dirname(__FILE__)).'/FieldSet.php';

class Version{

	var $version;
	
	var $long_version;
	
	var $actions;

	var $finalAction;
	
	var $tests;
	
	var $fields;
	
	function Version($version, $long_version){
		$this->version = $version;
		$this->long_version = $long_version;
		$this->actions = new ActionSet();
		$this->tests = new TestSet();
		$this->fields = new FieldSet();
	}
	
	function addTest($class_name, $params){
		require_once Installer::getTestPath($class_name);
		$this->tests->add(new $class_name($params));
	}
	
	function addAction($class_name, $title, $params) {
		require_once Installer::getActionPath($class_name);
		$this->actions->add(new $class_name($title, $params));		
	}

	function addFinalAction($class_name, $title, $params) {
		require_once Installer::getActionPath($class_name);
		$this->finalAction = new $class_name($title, $params);
	} 

	function getVersion(){
		return $this->version;
	}
	
	function getLongVersion() {
		return $this->long_version;
	}

	function collectText($name, $label, $default = ''){
		$this->fields->add(new TextField($name, $label, $default));
	}

    function collectPassword($name, $label, $default = ''){
        $this->fields->add(new PasswordField($name, $label, $default));
    }

    function collectOption($name, $label, $options, $values, $default) {
        $this->fields->add(new SelectField($name, $label, $options, $values, $default));
    }

    function addSeparator($label) {
        $this->fields->add(new SeparatorField($label));
    }
}
?>
