<?php
/**
*    class.Calendar by Jürgen Lang - www.getinspired.at
*   Modifications done by elpidio latorilla for Care2002 
*/
class Calendar {
	/** CONFIG **/
		// Calendar width in percent or pixels, 0 IF AUTO
		var $intCalWidth = 0;
		// Calendar border
		var $intCalBorder = 0;
		// Calendar color
		var $strCalColor = "#9FA58D";
		// Navigation border
		var $intNavBorder = 0;
		// Navigation color
		var $strNavColor = "#EDEEEA";
		// Main-part border
		var $intMainBorder = 0;
		// Main-part color
		var $strMainColor = "#C9CCBF";
		// Headline color (Mon, Tue, ...)
		var $strHeaderColor = "#DDDFD7";
		// Prepend of selected day
		var $strHighlightDayPrepend	= "<font color=\"red\"><B>";
		// Append of selected day
		var $strHighlightDayAppend = "</B></font>";
		// Empty entry color
		var $strEmptyColor = "#F2F2F2";
		// Color of weekdays
		var $strDayColor = "#ffffff";
		// Color of actual day
		var $strTodayColor = "yellow";
		// Color of weekend days SUN and SAT
		var $strWeekendColor = "#ffeecc";
		// Calendar padding
		var $intDayPadding = 1;
		// Calendar spacing
		var $intDaySpacing = 1;
		
		// Flag to deactivate "future" link : added by Elpidio Latorilla 2003-04-25
		var $deactivate_future=0;
		// future date color
		var $strFutureDayColor='gray';
		
	/* Function to set the activate "future" day : Added by Elpidio Latorilla 2003-04-25 */
	function activateFutureDay(){
		$this->deactivate_future=0;
	}
	/* Function to set the activate "future" day : Added by Elpidio Latorilla 2003-04-25 */
	function deactivateFutureDay(){
		$this->deactivate_future=1;
	}
		

	/** MAIN FUNCTION **/
	function mkCalendar ($intYear = "", $intMonth = "", $intDay = "", $dept_nr=0, $aux='') {
		## added by Elpidio Latorilla 2003-04-05
		global $LDMonthFullName, $LDDayShortName; 
		## Added by Elpidio Latorilla 2003-08-28
		global $thisfile;
		if(empty($PHP_SELF)) $PHP_SELF=$thisfile;
		##############################
		$intYear = $intYear ? $intYear : date("Y");
		$intMonth = $intMonth ? $intMonth : date("m");
		$intMonthTS = mktime (0, 0, 0, $intMonth, 1, $intYear);
		$intDaysInMonth = date("t", $intMonthTS);
		$intDayMonthStarts = date("w", $intMonthTS);
		
		$nextMonth = sprintf ("%02d", $intMonth + 1);
		if ($nextMonth > 12) {
			$nextMonth = sprintf ("%02d", 1);
			$nextYear = $intYear + 1;
		} else {
			$nextYear = $intYear;
		}
		$prevMonth = sprintf ("%02d", $intMonth - 1);
		if ($prevMonth < 1) {
			$prevMonth = sprintf ("%02d", 12);
			$prevYear = $intYear - 1;
		} else {
			$prevYear = $intYear;
		}
		$calWidth = 0 ? $this -> intCalWidth : "width=\"" . $this -> intCalWidth . "\"";
		echo "
<!---
	class.Calendar by Jürgen Lang - www.getinspired.at
--->
		";
		echo "
			<TABLE $calWidth border=\"" . $this -> intCalBorder . "\" cellpadding=\"2\" cellspacing=\"0\">
				<TR>
					<TD>
						<TABLE width=\"100%\" bgcolor=\"" . $this -> strCalColor . "\" border=\"" . $this -> intNavBorder . "\" cellpadding=\"3\" cellspacing=\"1\">
							<FORM name=\"CalOptions\">
							<TR bgcolor=\"" . $this -> strNavColor . "\">
								<TD align=\"center\" nowrap=\"nowrap\"><INPUT type=\"button\" value=\" < \" onClick=\"location.href = '$PHP_SELF".URL_REDIRECT_APPEND."&currYear=$prevYear&currMonth=$prevMonth';\" class=\"button\"></TD>
								<TD align=\"center\" nowrap=\"nowrap\">
									<SELECT name=\"currMonth\" class=\"SelectMisc\" onChange=\"location.href = '$PHP_SELF".URL_REDIRECT_APPEND."&currYear=' + document.CalOptions.currYear.value + '&currMonth=' + this.value;\">
		";
		for ($m = 1; $m <= 12; $m++) {
			if ($intMonth == $m) {
				$statusMonth = "selected=\"selected\"";
			} else {
				$statusMonth = "";
			}
/*			echo "
										<OPTION value=\"" . sprintf ("%02d", $m) . "\" $statusMonth>" . date ("F", mktime (0, 0, 0, $m, 1, $intYear))
			;
*/			
			echo "
										<OPTION value=\"" . sprintf ("%02d", $m) . "\" $statusMonth>" . $LDMonthFullName[$m]; // modified by ELpidio Latorilla 2003-04-05
			;
	}
		echo "						</SELECT>
									<SELECT name=\"currYear\" class=\"SelectMisc\" onChange=\"location.href = '$PHP_SELF".URL_REDIRECT_APPEND."&currYear=' + this.value + '&currMonth=' +  + document.CalOptions.currMonth.value;\">
		";
		for ($y = date ("Y") - 6; $y <= date ("Y") + 10; $y++) {
			if ($intYear == $y) {
				$statusYear = "selected=\"selected\"";
			} else {
				$statusYear = "";
			}
			echo "
										<OPTION value=\"$y\" $statusYear>$y"
			;
		}
		echo "					</TD>
								<TD align=\"center\" nowrap=\"nowrap\"><INPUT type=\"button\" value=\" > \" onClick=\"location.href = '$PHP_SELF".URL_REDIRECT_APPEND."&currYear=$nextYear&currMonth=$nextMonth';\" class=\"button\"></TD>
							</TR>
								<input type=\"hidden\" name=\"sid\" value=\"$sid\">
       							<input type=\"hidden\" name=\"lang\" value=\"$lang\">
							</FORM>
						</TABLE>
					</TD>
				</TR>
				<TR>
					<TD>
						<TABLE width=\"100%\" bgcolor=\"" . $this -> strCalColor . "\" border=\"" . $this -> intMainBorder . "\" cellpadding=\"" . $this -> intDayPadding . "\" cellspacing=\"" . $this -> intDaySpacing . "\">
							<TR bgcolor=\"" . $this -> strHeaderColor . "\">
								<TD align=\"center\"><font size=1 face=\"verdana,arial\">".$LDDayShortName[0]."</font></TD>
								<TD align=\"center\"><font size=1 face=\"verdana,arial\">".$LDDayShortName[1]."</font></TD>
								<TD align=\"center\"><font size=1 face=\"verdana,arial\">".$LDDayShortName[2]."</font></TD>
								<TD align=\"center\"><font size=1 face=\"verdana,arial\">".$LDDayShortName[3]."</font></TD>
								<TD align=\"center\"><font size=1 face=\"verdana,arial\">".$LDDayShortName[4]."</font></TD>
								<TD align=\"center\" bgcolor=\"" . $this -> strWeekendColor . "\"><font size=1 face=\"verdana,arial\"><B>".$LDDayShortName[5]."</B></font></TD>
								<TD align=\"center\" bgcolor=\"" . $this -> strWeekendColor . "\"><font size=1 face=\"verdana,arial\"><B>".$LDDayShortName[6]."</B></font></TD>
							</TR>
							<TR>
		";
		// Check if Sunday is first Day of Month
		if ($intDayMonthStarts == 0) {
			$intDayMonthStarts = 7;
		}
		for ($i = 0; $i < $intDayMonthStarts - 1; $i++) {
			echo "
								<TD align=\"center\" bgcolor=\"" . $this -> strEmptyColor . "\"><font size=1 face=\"verdana,arial\">&nbsp;</font></TD>
			";
		}
		for ($i = 1; $i <= $intDaysInMonth; $i++) {
			$i = sprintf ("%02d", $i);
			$intWeekDay++;
			$intCurrMonthTS = mktime (0, 0, 0, $intMonth, $i, $intYear);
			// Current Day
			if ($intYear . "-" . $intMonth . "-" . $i == date("Y-m-d")) {
				$currBGColor = $this -> strTodayColor;
			// Saturday || Sunday
			} else if (date ("w", $intCurrMonthTS) == 0 || date ("w", $intCurrMonthTS) == 6) {
				$currBGColor = $this -> strWeekendColor;
			// Normal Day
			} else {
				$currBGColor = $this -> strDayColor;
			}
			// Highlight selected Day
			if ($intDay == $i) {
				$DayPrepend = $this -> strHighlightDayPrepend;
				$DayAppend = $this -> strHighlightDayAppend;
			} else {
				$DayPrepend = "";
				$DayAppend = "";
			}
			// Write Day
/*			echo "
								<TD align=\"center\" bgcolor=\"$currBGColor\"><font size=1 face=\"verdana,arial\"><A href=\"$PHP_SELF".URL_APPEND."&currYear=$intYear&currMonth=$intMonth&currDay=$i\">$DayPrepend$i$DayAppend</A></font></TD>
			";
*/			
			/* Modified by Elpidio Latorilla 2003-04-25 for the future day activation/deactivation */
			if($this->deactivate_future&&("$intYear-$intMonth-$i">date('Y-m-d'))){
				echo "
								<TD align=\"center\" bgcolor=\"$currBGColor\"><font size=1 face=\"verdana,arial\" color=\"$this->strFutureDayColor\">$DayPrepend$i$DayAppend</font></TD>
				";
			}else{ 
				echo "
								<TD align=\"center\" bgcolor=\"$currBGColor\"><font size=1 face=\"verdana,arial\"><A href=\"$PHP_SELF".URL_APPEND."&currYear=$intYear&currMonth=$intMonth&currDay=$i&dept_nr=$dept_nr&aux=$aux\">$DayPrepend$i$DayAppend</A></font></TD>
				";
			}
			
			if (date ("w", $intCurrMonthTS) == 0 && $i < $intDaysInMonth) {
				$intWeekDay = 0;
				echo "
							</TR>
							<TR>
				";
			} else if (date ("w", $intCurrMonthTS) == 0 && $i == $intDaysInMonth) {
				$intWeekDay = 0;
				echo "
							</TR>
				";
			} else if ($i == $intDaysInMonth) {
				for ($d = 0; $d < 7 - $intWeekDay; $d++) {
					echo "
								<TD align=\"center\" bgcolor=\"" . $this -> strEmptyColor . "\"><font size=1 face=\"verdana,arial\">&nbsp;</font></TD>
					";
				}
				echo "
							</TR>
				";
			}
		}
		echo "
						</TABLE>
					</TD>
				</TR>
			</TABLE>
		";
	}
}

/** CREATE CALENDAR OBJECT **/
//$Calendar = new Calendar;
/** WRITE CALENDAR **/
//$Calendar -> mkCalendar ($currYear, $currMonth, $currDay);
?>
