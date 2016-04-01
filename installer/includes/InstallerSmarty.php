<?php
//error_reporting(E_ALL ^ E_NOTICE);
require_once(APP_PATH.'/classes/smarty/Smarty.class.php');

/*
 * InstallerSmarty class
 *
 * Base Smarty class to be used by the installer. This
 * class will setup some necessary variables.
 */
class InstallerSmarty extends Smarty {

	public function __construct(){
		parent::__construct();
		$this->template_dir = INSTALLER_PATH;
		$this->cache_dir = $GLOBALS['INSTALLER']['ENGINE']->getSetting('WRITABLE_DIR');
		$this->config_dir = realpath(dirname(__FILE__)).'/smarty';
		$this->compile_dir = $GLOBALS['INSTALLER']['ENGINE']->getSetting('WRITABLE_DIR');

		// Setup some variables
		$this->assign('APP_NAME', $GLOBALS['INSTALLER']['ENGINE']->getSetting('APP_NAME'));
	}
}
?>