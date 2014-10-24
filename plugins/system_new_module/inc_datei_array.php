<?PHP
//Diese Datei ist ein Include von Traps_anlegen.inc.php, 
//hier werden die Standardinclude-datien ins neue Modulverzeichnis kopiert.

//Variablen für den Quellpfad
$quellpfad=($root_path . $newmodule_includepath);

//Prüfen ob die Variablen Werte enthalten um den Zielpfad anzulegen
if ($root_path=="" or ModulNeuBez==""){
    echo $err_ida_var_fehlt;
		exit;
		}
else {
$zielpfad =($root_path . "modules/".$ModulNeuBez . "/");

//Prüfen ob der Zielpfad bereits existiert
if(is_dir($zielpfad)) {
   //Pfad existiert
	 }
else{ 
    echo $err_keinpfad;
		exit;
    }


//echo "zielpfad: ".$zielpfad;

//Array für die Dateien laden
require_once("daten_inc_dateiarray.php");

	 //test_person_search aus dem array genommen da unten neu generiert und
	 //inhalte ersetzt werden.
//zähle die Anzahl der im Array enthaltenen Werte	 
$anzahl=count($inc_datei_array);	 

//mittels While-Schlaufe alle Dateien kopieren
$i=0;
WHILE ($i<$anzahl){
      IF(copy($quellpfad . $inc_datei_array[$i],$zielpfad . $inc_datei_array[$i])){
         //echo "Datei ".$inc_datei_array[$i]." kopiert.</br>";
	    }
      else{
         echo $err_kopieren.$inc_datei_array[$i].err_fehlgeschlagen;
      }
   $i++;
}
}
/*Die Datei main-pass wird separat kopiert, da sie umbenannt werden muss.
$neue_main_pass_datei=$zielpfad.$ModulNeuBez."-"."main-pass.php";
if(copy($quellpfad."main-pass.php",$neue_main_pass_datei)){
   //echo "Datei   main-pass.php kopiert.</br>";
	    }
      else{
         echo $err_mainpass_copy;
  	   }*/
			 
// funktionierener teil eine datei
$qdatei="main-pass.php";
$datei=fopen($quellpfad.$qdatei,"r");
$zieldatei=$ModulNeuBez."-".$qdatei;
$zdatei=fopen($zielpfad.$zieldatei,"w+");	
$ix=1;
//innere Schleife
while (!feof($datei)) {
//eine Zeile auslesen
$buffer = fgets($datei,4096);
//eine Zeile untersuchen und ersetzen
$buffer = ereg_replace("#Modulname#",$ModulNeuBez,$buffer);
//schreiben
fwrite($zdatei,$buffer);
//echo $buffer."</br>";
$ix++;
}		//Ende innere Schleife
fclose($datei);
fclose($zdatei);

// funktionierener teil zweite datei
$qdatei="person_search.php";
$datei=fopen($quellpfad.$qdatei,"r");
$zieldatei="test_".$qdatei;
$zdatei=fopen($zielpfad.$zieldatei,"w+");	
$ix=1;
//innere Schleife
while (!feof($datei)) {
//eine Zeile auslesen
$buffer = fgets($datei,4096);
//eine Zeile untersuchen und ersetzen
$buffer = ereg_replace("#Modulname#",$ModulNeuBez,$buffer);
//schreiben
fwrite($zdatei,$buffer);
//echo $buffer."</br>";
$ix++;
}		//Ende innere Schleife
fclose($datei);
fclose($zdatei);
