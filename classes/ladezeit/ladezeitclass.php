<?php
/* G�nni <guenni1981 at lycos dot de> */
// Create of the new class
class ladezeit {
	// definition of the local variables
	var $starttime;
	var $endtime;

	function start() {
		// Microseconds and store it to a local vairable
		list($usec, $sec) = explode(" ",microtime());

		// Save the result to the internal $starttime
		$this->starttime = ((float)$usec + (float)$sec);
	}
	 
	function ende() {
		list($usec, $sec) = explode(" ",microtime());
		$this->endtime = ((float)$usec + (float)$sec);
	}
	 
	function ausgabe() {
		// Endtime - Starttime = relative time what we want to know
		$time = $this->endtime - $this->starttime;

		// Show it
		echo 'Page generation time: '.$time;
	}
}
?>
