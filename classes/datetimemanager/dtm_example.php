<?php

/**
 *
 * dtm_example.php
 *
 * This is a very simple example of how to use class.dateTimeManager.php.
 *
 * Name: dateTimeManager
 * Author: Albert L. Lash, IV
 * Email: alash@plateauinnovation.com
 * Version: 0.1
 * Date: 08/29/02 1:00PM EST
 * License: GPL
 *
 */



/** Includes */
include("class.dateTimeManager.php");

/** Create new dateTimeManager object */
$shift_time_back = new dateTimeManager;

/** Shift time back three days */
$new_time = $shift_time_back->shift_dates($right_now='', "-15", "d");

/** Let us view the new time */
echo $new_time;






?>
