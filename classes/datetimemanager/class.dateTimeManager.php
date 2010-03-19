<?php
/**
 *
 * class.dateTimeManager.php
 *
 * This class manages the many different transformations that can be done on
 * datetimes. These include shifting datetimes, rolling over into consecutive
 * months, years, and the like. It uses the format: YYYY-MM-DD HH:MM:SS.
 *
 * Name: class.dateTimeManager.php
 * Author: Albert L. Lash, IV
 * Email: alash@plateauinnovation.com
 * Version: 0.1
 * Date: 08/29/02 1:00PM EST
 * License: GPL
 *
 */

class dateTimeManager {

    var $datetime = null; 			// This is the date shifting from, not currently active
    var $shift_amount = null;		// This is the amount to shift, backwards
    								// if you need forwards use a negative number
    var $shift_unit = null;			// This is what you are shifting
	
	var $fulldatetime=false; // 2003-04-20 Modified by Elpidio Latorilla for Care2002  to return either full datetime or date only, default is date only



/*    function dateTimeManager() // modified by Elpidio Latorilla 2003-04-20
    {
		// Needs a constructor?
		
    }
*/
    function dateTimeManager($retformat=false)
    {
		// constructor
		$this->fulldatetime=$retformat;
    }
    /** Shifts from and to dates by $shift_amount of $shift_units
	shift_units:
	    months = mo;
	    days = d;
	    years = y;
	    hours = h;
	    minutes = mi;
	    seconds = s;
	    */
    function shift_dates($datetime, $shift_amount, $shift_unit) {

		//Split into separate sections: date and time
		// Right now these are not used as currently only shifts from "right now"
		//$dateandtime = explode(' ', $datetime);
		//$date = $dateandtime[0];
		//$time = $dateandime[1];
		if(empty($datetime)){
			$d=date('d');
			$m=date('m');
			$Y=date('Y');
		}else{
			list($date,$time) = explode(' ', $datetime);
			list($Y,$m,$d)=explode('-',$date);
			list($H,$i,$s)=explode(':',$time);
		}
			// If the date is shifting
		if($shift_unit=='mo') {
			$newdate = mktime (date('H'),date('i'),date('s'),date('m')-$shift_amount,date('d'), date('Y'));
			//$newdate = date("Y-m-d H:i:s", $newdate); // modified by Elpidio Latorilla 2003-04-20
		} elseif( $shift_unit=='d') {
			//echo "..$shift_amount..";
			//$newdate = mktime (date('H'),date('i'),date('s'),date('m'),date('d')-$shift_amount, date('Y')); // modified by Elpidio Latorilla 2003-04-20
			$newdate = mktime ($H,$i,$s,$m,$d-$shift_amount, $Y);
			//$newdate = date("Y-m-d H:i:s", $newdate); // modified by Elpidio Latorilla 2003-04-20
		} elseif ($shift_unit=='y') {
			$newdate = mktime (date('H'),date('i'),date('s'),date('m'),date('d'), date('Y')-$shift_amount);
			//$newdate = date("Y-m-d H:i:s", $newdate); // modified by Elpidio Latorilla 2003-04-20

		// if the time is shifting, can leave for later
		} elseif( $shift_unit=='h') {
			//echo "..$shift_amount..";
			$newdate = mktime (date('H')-$shift_amount,date('i'),date('s'),date('m'),date('d'), date('Y'));
			//$newdate = date("Y-m-d H:i:s", $newdate); // modified by Elpidio Latorilla 2003-04-20
		} elseif ($shift_unit=='mi') {
			$newdate = mktime (date('H'),date('i')-$shift_amount,date('s'),date('m'),date('d'), date('Y'));
			//$newdate = date("Y-m-d H:i:s", $newdate); // modified by Elpidio Latorilla 2003-04-20
		} elseif( $shift_unit=='s') {
			//echo "..$shift_amount..";
			$newdate = mktime (date('H'),date('i'),date('s')-$shift_amount,date('m'),date('d'), date('Y'));
			//$newdate = date("Y-m-d H:i:s", $newdate); // modified by Elpidio Latorilla 2003-04-20
		}
		
		//return $newdate;// modified by Elpidio Latorilla 2003-04-20

		if($this->fulldatetime) {
			return date('Y-m-d H:i:s', $newdate);
		}else{
			return date('Y-m-d', $newdate);
		}
    }
}
?>
