<?PHP
//diese Datei wird von radio_tabwahl.php gestartet


//***Variablen für dieses Modul setzen***

//Variable für die in diesem Modul benutzte Individual-Sprachdatei 
$lang_thismodule_used="modulneu.php";
require('./roots.php');

// Error Meldungen unterdrücken, inc_environment_global.php includen, Standard-Sprachdateien einbinden,
// Dateischutz etc
//variabeln für inc_modul_top.php
//Variable für die in diesem Modul benutzte Individual-Sprachdatei
$lang_thismodule_used="modulneu.php";

//Cookiename setzen
$this_cookie_name='ck_edv_user';
require_once($root_path.$newmodule_includepath."inc_modul_top.php");
//$returnfile="edv_modul_neu_2.php?sid=$sid&lang=$lang&ModulNeuBez=$ModulNeuBez";
$returnfile=$root_path.$top_dir."sub_modul_neu.php?sid=$sid&lang=$lang&ModulNeuBez=$ModulNeuBez";
$breakfile=$root_path."main/startframe.php?sid=$sid&lang=$lang";
?>

<?PHP
//Head includen
require_once($root_path.$newmodule_includepath."head_include.inc.php");

// Den <BODY> includen
require ($root_path.$newmodule_includepath."inc_body.php");

// blauer Titelblock einbinden
//Variablen des Titelblocks
//Hilfedatei
$new_hlp_file="edv_modul_neu_hlp1.php";

//Variable für Überschrift Titellesite
$thismodulname=$LDEDP . " - " . $LDNeuesModulanlegen;
										 
//echo "Diese Datei heisst <strong>hauptdatei_schreiben.php</strong>";
										 
include($root_path.$newmodule_includepath."inc_titelblock.php");
?>


<?PHP
$tab_name=$_REQUEST['tab_name'];
$suchfeld=$_REQUEST['suchfeld'];
$tabellentitel=$_REQUEST['tabellentitel'];
$user=$_REQUEST['user'];
$used_db=$_REQUEST['used_db'];
$host=$_REQUEST['host'];
$sortfeld2=$_REQUEST['sortfeld2'];
$ModulNeuBez=$_REQUEST['ModulNeuBez'];
$leere_seite=$_REQUEST['leere_seite'];
$pat_bez=$_REQUEST['pat_bez'];
//echo "<br/>".$tab_name." x ".$sortierfeld." x ".$tabellentitel." x ".$host." x ".$ModulNeuBez;


require_once("hauptdatei_teil1.php");

if ($leere_seite=="0"){
   require_once("hauptdatei_teil2.php");
	 }

//Gratulationsformular laden
require ("Schlusssatz.php");	 
?>
