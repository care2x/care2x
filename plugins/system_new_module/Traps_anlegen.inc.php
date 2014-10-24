<?PHP
/**************************************************/
//1 Datei roots.php im neuen Verzeichnis erstellen und füllen		
$dateiname=("roots.php");
//Pfad für das neue Modul
$pfad=$root_path."modules/$ModulNeuBez/";

//Datei öffnen
$datei=fopen($pfad . $dateiname,"w");

//Inhalt der neuen roots.php Datei
$zeile1="<?php\n";
$zeile2="\$root_path='../../';\n";
$zeile3="\$top_dir='modules/" . $ModulNeuBez . "';\n";
$zeile4="?>\n";

//Schreiben und schliessen der Datei
fwrite($datei,$zeile1);
fwrite($datei,$zeile2);
fwrite($datei,$zeile3);
fwrite($datei,$zeile4);
fclose($datei);
/**************************************************/
//Ende1 Datei roots.php erstellen
?>

<?
/**************************************************/
//2 Datei index.htm im neuen Verzeichnis erstellen und füllen
$dateiname=("index.htm");
//Pfad für das neue Modul
$pfad=$root_path."modules/$ModulNeuBez/";

//Datei öffnen
$datei=fopen($pfad . $dateiname,"w");

//Inhalt der Trapfile
$zeile1="<meta http-equiv=\"refresh\" content=\"0; url=../../\">";
fwrite($datei,$zeile1);
fclose($datei);
//echo "<p>Eine Datei mit der Bezeichnung <strong><i>" . $dateiname . "</strong></i> wurde erstellt. </p>";

/***************************************************/
//Ende2 der index.htm
?>

<?
/***************************************************/
//3 Datei index.html im neuen Verzeichnis erstellen und füllen
copy($pfad . $dateiname,$pfad . $dateiname . "l");
//echo "<p>Eine Datei mit der Bezeichnung <strong><i>" . $dateiname . "l </strong></i> wurde erstellt. </p>";
/***************************************************/
//Ende3 der index.html
?>

<?
/**************************************************/
//4 Datei index.php im neuen Verzeichnis erstellen und füllen
$dateiname=("index.php");
//Pfad für das neue Modul
$pfad=$root_path."modules/$ModulNeuBez/";

//Datei öffnen
$datei=fopen($pfad . $dateiname,"w");

//Inhalt der Trapfile
$zeile1="<?php\n";
$zeile2="header('location:../../index.php');\n";
$zeile3="exit\n";
$zeile4="?>\n";

//Inhalte in die Datei schreiben
fwrite($datei,$zeile1);
fwrite($datei,$zeile2);
fwrite($datei,$zeile3);
fwrite($datei,$zeile4);
fclose($datei);
//echo "<p>Eine Datei mit der Bezeichnung <strong><i>" . $dateiname . "</strong></i> wurde erstellt. </p>";	 
/***************************************************/
//Ende4 der index.php   
?>

<?PHP

// Die Standarddateien aus /modules/system_new_module/includes/ in den neuen Ordner kopieren.
//inc_modul_top.php, head_include.inc.php, inc_body.php, inc_titelblock.php, submenu1.php
// ggf. müssen noch Anpassungen in den Dateien vorgenommen werden
require_once("inc_datei_array.php");
//require_once ("fileparsen.php");
// Datei mit Submenü erstellen
   include("sub_modulname_anlegen.php");
   
?>



<?PHP
//Anlegen der Sprachdateien in deutsch und enlisch (standard)
require("sprachdatei_anlegen_de_en.php");

//Anlegen der Hilfedateien in deutsch und enlisch (standard)
//require("hilfedatei_anlegen_de_en.php");
?>
