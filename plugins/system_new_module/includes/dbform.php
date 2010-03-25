<?
$tab_name=$_REQUEST['tab_name'];
$suchfeld=$_REQUEST['suchfeld'];
$tabellentitel=$_REQUEST['tabellentitel'];
$host=$_REQUEST['host'];
$user=$_REQUEST['user'];
$user_db=$_REQUEST['user_db'];
/*
echo $tab_name."<br/>";
echo $suchfeld."<br/>";
echo $tabellentitel."<br/>";
echo $host."<br/>";
echo $user."<br/>";
echo $used_db."<br/>";
*/

//include DBFORM
include_once("../../../dbForm/formFields.inc");
include_once("../../../dbForm/tempxxxlate.inc");
include_once("../../../dbForm/dbForm.inc");

//include ADODB
include_once("../../../adodb/adodb.inc.php");
//include_once($root_path."classes/adodb/adodb.inc.php");

//Ende des Grundgerüsts

$conn = &ADONewConnection("mysql");
//$conn->debug = true;

$conn->Connect($host, $user, "", $used_db);
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;

//To create a form for the person table
$dbForm = new dbForm($tabellentitel, $conn, $tab_name);

//We now need to set the search field. x Felder können nach select angegeben werden
$dbForm->setSearchField($suchfeld, "select $suchfeld, name from $tab_name");

$dbForm->processForm();

$dbForm->setTemplateFile("testform.tpl");

$dbForm->displayForm();
?>