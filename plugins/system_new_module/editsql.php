<?PHP
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
$returnfile="radio1_memofeld.php?sid=$sid&lang=$lang&ModulNeuBez=$ModulNeuBez";
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
	
include($root_path.$newmodule_includepath."inc_titelblock.php");
// Ende der Standardeinbindungen

/*
$tx= basename(__FILE__);
echo "Name diesr Datei:  <i><strong> ".$tx."</i></strong><br/><br/><br/>";

echo $sid."</br>";
echo $lang."</br>";
echo $suchfeld."</br>";
echo $tabellentitel."</br>";
echo $host."</br>";
echo $user."</br>";
echo $used_db."</br>";
echo $ModulNeuBez."</br>";
echo $tab_name."</br>";
echo $sortfeld2."</br>";
*/

?><FONT FACE='ARIAL' color="<?php echo $cfg['top_txtcolor']; ?>"><?php
//echo"In dieser Datei <strong> ".$tx."</i></strong> wird ADODB Code ausgeführt, um eine neue Tabelle anzulegen.";


?>
<table border="0" width="80%">
<th align="left">
<FONT FACE='ARIAL' color="<?php echo $cfg['top_txtcolor']; ?>"><?php
echo $sql_meldung;?>
</th>
<tr>
<td bgcolor="#ffff99">
<?echo "<br>".$sqlstring."<br><br>";?>
</td><br><br>
</tr>
</table>
<?


//ADODB Funktionen einbinden
require_once("../../../adodb/adodb.inc.php");

//Herstellen einer Verbindung zu MySQL, und der Datenbank
$conn = &ADONewConnection('mysql');
//$conn->debug=true;
$conn->PConnect('localhost','root','','care2xdb');

$anlege=&$conn->Execute($sqlstring);

//Ende  Datenbanktabelle anlegen


// Hauptdatei erstellen, wdie Datei Hauptdatei_schreiben.php einbindne

require ("hauptdatei_teil1.php");
require ("hauptdatei_teil2.php");


//Gratulationsformular laden
require ("Schlusssatz.php");
?>


