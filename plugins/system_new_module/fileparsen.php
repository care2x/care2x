<?php
/*
//Array für die 2 Dateien anlegen
$datename=array(2);
$dateiname[0]="main-pass.php";
$dateiname[1]="test_person_search.php";
//Lauf-Variablen anlegen
$iy=0;
$ix=1;

//Schleife, bis beide Dateien bearbeitet und erstellt sind
while ($iy<2){
//Datei 1 bzw 2 öffnen
$datei=fopen($quellpfad.$dateiname[$iy],"r");

// Zieldatei festlegen
   if ($iy==0){
       $zieldatei=$ModulNeuBez."-".$dateiname[0];
	    }
   else{
      $zieldatei=$dateiname[1];
	    }
//Zieldatei anlegen
$zdatei=fopen($zielpfad.$zieldatei,"w+");	
	
//innere Schleife

while (!feof($datei)) {
//eine Zeile auslesen
$buffer = fgets($datei,4096);
//eine Zeile untersuchen und ersetzen
$buffer = ereg_replace("#Modulname#",$ModulNeuBez,$buffer);
//diese Zeile schreiben
fwrite($zdatei,$buffer);

$ix++;
}		//Ende innere Schleife
$iy++;
}
fclose($datei);
fclose($zdatei);			 
?>

*/


$qdatei="main-pass.php";
$datei=fopen($quellpfad.$qdatei,"r");
$zieldatei=$ModulNeuBez."-".$qdatei;
$zdatei=fopen($zielpfad.$zieldatei,"w+");	
$ix=1;
	
	
//innere Schleife
while (!feof($qdatei)) {
//eine Zeile auslesen
$buffer = fgets($qdatei,4096);
//eine Zeile untersuchen und ersetzen
$buffer = ereg_replace("#Modulname#",$ModulNeuBez,$buffer);
//schreiben
fwrite($zdatei,$buffer);

$ix++;
}		//Ende innere Schleife
fclose($qdatei);
fclose($zdatei);
?>

