<?php
/**
* @package care_api
*/
/** */
require_once($root_path.'include/care_api_classes/class_globalconfig.php');
/**
* Class for session time out routines.
*
* Extends the class "GlobalConfig".
* Note this class should be instantiated only after a "$db" adodb  connector object
* has been established by an adodb instance
* @package care_api
*/
class TimeOut extends GlobalConfig {
	/**
	* Time-out start count variable. This is a reference to the session variable.
	* @var int
	*/
	var $tostart;
	/**
	* Status if timeout is to be checked or not.
	* @var int
	*/
	var $tcheck;
	/**
	* Elapsed time of inactivity in MinutesSeconds format e.g.  530 = 5 minutes, 20 seconds or e.g. 2000 = 20 minutes, 00 seconds.
	* @var int
	*/
	var $totime;
	
	/**
	* Constructor. 
	*
	* The session variable which stores the time out count start value should be passed by reference.
	* @param $tostart (var) reference passed variable
	* @param $tcheck (bool) if time out is to be checked or not
	* @param $totime (int)  time out length of time in MinutesSeconds 
	*   format e.g.  530 = 5 minutes, 20 seconds or e.g. 2000 = 20 minutes, 00 seconds
	*/
	function TimeOut(&$tostart,$tcheck=TRUE,$totime=10){
		$this->$tostart=$tostart;
		$this->$tcheck=$tcheck;
		$this->totime=$totime;
	}
	/**
	* Resets the time out count start time
	* @param $ts (int) optionally a time value can be passed as the count start
	* return resetted start value
	*/
	
	function Reset($ts=0){
		if(!$ts) $ts=date('is'); 
		$this->tostart=$ts;
		return $ts;
	}
	/**
	* Checks if the session has timed out
	* @param $tnow (int) the current time
	* return TRUE if timed out, FALSE if not 
	*/
	function isTimedOut($tnow=0){
		if($this->tstatus&&!$now){
	  		# Check if session is still valid 
			if(($tnow-$this->tostart) >= $this->$totime){
				 return TRUE;		
			}else{
				# Reset the time-out start time
				$this->Reset();
				return FALSE;
			}
		}else{
			return FALSE;
		}
	}
}
