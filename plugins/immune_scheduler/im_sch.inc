<?php

// Add a certain number to an existing date and specify what that number indicates
// years, quarters, months, etc.
function DateAdd ($interval,  $number, $date) 
{
    $date_time_array  = getdate($date);
	$hours =  $date_time_array["hours"];
	$minutes =  $date_time_array["minutes"];
	$seconds =  $date_time_array["seconds"];
	$month =  $date_time_array["mon"];
	$day =  $date_time_array["mday"];
	$year =  $date_time_array["year"];

    switch ($interval) {
    
        case "yyyy":
            $year +=$number;
            break;        
        case "q":
            $year +=($number*3);
            break;        
        case "m":
            $month +=$number;
            break;        
        case "y":
        case "d":
        case "w":
             $day+=$number;
            break;        
        case "ww":
             $day+=($number*7);
            break;        
        case "h":
             $hours+=$number;
            break;        
        case "n":
             $minutes+=$number;
            break;        
        case "s":
             $seconds+=$number;
            break;        

    }    
	$timestamp =  mktime($hours ,$minutes, $seconds,$month ,$day, $year);
    return $timestamp;
}

function DateDiff ($interval, $date1,$date2) 
{
    // get the number of seconds between the two dates
	$timedifference =  $date2 - $date1;
    
    switch ($interval) {
        case "w":
            $retval  = bcdiv($timedifference ,604800);
            break;
        case "d":
            $retval  = bcdiv( $timedifference,86400);
            break;
        case "h":
             $retval = bcdiv ($timedifference,3600);
            break;        
        case "n":
            $retval  = bcdiv( $timedifference,60);
            break;        
        case "s":
            $retval  = $timedifference;
            break;        

    }    
    return $retval;
}

// Displays a message properly formatted
function displayIt($variable)
{
	echo "<DIV ALIGN=CENTER><B>$variable</B></DIV>";
}

// Displays a message properly formatted
function exitIt($variable)
{
	echo "<DIV ALIGN=CENTER><B><font face='Verdana' size='2' color='#0000FF'><B>$variable</FONT></B></DIV>";
	include("imsch_form.inc");
	exit();
}

?>