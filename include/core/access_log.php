<?php
require_once('inc_init_main.php');
require_once($root_path.'classes/adodb/adodb.inc.php');
require_once($root_path.'classes/adodb/adodb-errorpear.inc.php');
require_once($root_path.'classes/adodb/adodb-pager.inc.php');

/**
 * @class      AccessLogs
 * @short      Simple Read/Write log manager
 * @version    $Id$
 */

class AccessLog {

	private $conn;
	private $TB = "care_accesslog";
	private $ID = "ID";
	private $DT = "DATETIME";
	private $IP = "IP";
	private $LG = "LOGNOTE";
	private $UI = "USERID";
	private $UN = "USERNAME";
	private $PA = "PASSWORD";
	private $TF = "THISFILE";
	private $FF = "FILEFORWARD";
	private $LS = "LOGIN_SUCCESS";
		

	function AccessLog(  ) {
		global $dbtype,$dbhost,$dbusername,$dbpassword,$dbname;
		
		$this->conn = &ADONewConnection($dbtype); 
		$this->conn->PConnect($dbhost,$dbusername,$dbpassword,$dbname);
		
		if (!$this->conn){
    		$error_object = ADODB_Pear_Error();
    		die($error_object->message);
		}
	}

	public function RenderLogsTable ( $sql ) {

		$pager = new ADODB_Pager($this->conn,$sql);
    	return $pager->Render($rows_per_page=10); 
		
	}
	
	/*
	 * writes a log line
	 */
	public function writeline( $datetime = '', $ip = '', $lognote = '',
							$userid = '', $username = '', $password = '',
							$thisfile = '', $fileforward = '', $loginsuccess = '0' ) {
								
		$rs = $this->conn->Execute( "INSERT INTO " . $this->TB . " ( "
				. $this->DT . ", "
				. $this->IP . ", "
				. $this->LG . ", "
				. $this->UI . ", "
				. $this->UN . ", "
				. $this->PA . ", "
				. $this->TF . ", "
				. $this->FF . ", "
				. $this->LS . " )
				VALUES (
				'$datetime',
				'$ip',
				'$lognote',
				'$userid',
				'$username',
				'$password',
				'$thisfile',
				'$fileforward',
				'$loginsuccess' );"		);

		if (!$rs){
    		$error_object = ADODB_Pear_Error();
    		die($error_object->getMessage());
		}				

		return true;
	}
}
?>