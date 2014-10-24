<?php
/*** Grundgerüst zum Darstellen einer Tabelle mit dbForm ***/

$host="localhost";
$user="root";
$used_db="care2xdb";

$tabelle=$tab_name;
$tabellentitel="Testdatenbank";
$suchfeld="sort_nr";

//include DBFORM
include_once("./dbForm/formFields.inc");
include_once("./dbForm/tempxxxlate.inc");
include_once("./dbForm/dbForm.inc");

//include ADODB
include_once("./adodb/adodb.inc.php");
//include_once($root_path."classes/adodb/adodb.inc.php");
?>
