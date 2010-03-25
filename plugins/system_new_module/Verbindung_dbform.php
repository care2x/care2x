<?PHP

/*** Grundgerüst zum Darstellen einer Tabelle mit dbForm ***/

//Folgende Variablen müssen in der Ausgangsdatei, von wo diese hier aufgerufen wird, gesetzt sein!
/*
$host="localhost";
$user="root";
$used_db="care2xdb";

$tabelle="care_menu_main";
$tabellentitel="Testdatenbank";
$suchfeld="sort_nr";
*/

//include DBFORM
include_once("./dbForm/formFields.inc");
include_once("./dbForm/template.inc");
include_once("./dbForm/dbForm.inc");

//Herstellen einer Verbindung zu MySQL, und der Datenbank
require_once("Verbindung.inc.php");

//include ADODB
/*include_once("../../../adodb/adodb.inc.php");
$conn = &ADONewConnection("mysql");
$conn->Connect($host, $user, "", $used_db);
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
*/
?>

