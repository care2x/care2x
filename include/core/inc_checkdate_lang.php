<?php
if(file_exists($root_path."language/$lang/lang_".$lang."_checkdate.php")) include_once($root_path."language/$lang/lang_".$lang."_checkdate.php");
 else include_once($root_path."language/en/lang_en_checkdate.php");
?>

var errDate="<?php echo $LDErrorDate.'   ['.$date_format.']'; ?>";
var errDateLen="<?php echo $LDErrorDateLen ?>";
var errDateFormat="<?php echo $LDErrorDateFormat ?>";
var errNotNumeric="<?php echo $LDErrorNotNumeric ?>";
var errYear="<?php echo $LDErrorYear ?>";
var errMonth="<?php echo $LDErrorMonth ?>";
var errDay="<?php echo $LDErrorDay ?>";

var Jan="<?php echo $LDMonthFullName[1]; ?>";
var Feb="<?php echo $LDMonthFullName[2]; ?>";
var Mar="<?php echo $LDMonthFullName[3]; ?>";
var Apr="<?php echo $LDMonthFullName[4]; ?>";
var May="<?php echo $LDMonthFullName[5]; ?>";
var Jun="<?php echo $LDMonthFullName[6]; ?>";
var Jul="<?php echo $LDMonthFullName[7]; ?>";
var Aug="<?php echo $LDMonthFullName[8]; ?>";
var Sep="<?php echo $LDMonthFullName[9]; ?>";
var Oct="<?php echo $LDMonthFullName[10]; ?>";
var Nov="<?php echo $LDMonthFullName[11]; ?>";
var Dec="<?php echo $LDMonthFullName[12]; ?>";

var Mon="<?php echo $LDDayShortName[0]; ?>";
var Tue="<?php echo $LDDayShortName[1]; ?>";
var Wed="<?php echo $LDDayShortName[2]; ?>";
var Thu="<?php echo $LDDayShortName[3]; ?>";
var Fri="<?php echo $LDDayShortName[4]; ?>";
var Sat="<?php echo $LDDayShortName[5]; ?>";
var Sun="<?php echo $LDDayShortName[6]; ?>";

