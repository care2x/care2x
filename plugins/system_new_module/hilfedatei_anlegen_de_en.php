<?php

//Hilfedatei "help_$lang_<modulname>_hlp.php" in deutsch 
//anlegen unter /help/de 
$help_pfad=$root_path."help/de/";
$help_de_datei="help_de_".$ModulNeuBez."_hlp.php";
$file=$help_pfad.$help_de_datei;
//echo "</br>".$file;

//Datei öffnen
if($datei=fopen($file,"w")){
     //echo "deutsche Hilfedatei angelegt.</br>";
	}
else {
     echo "deutsche Hilfe anlegen gescheitert.</br>";
		 }

//Inhalt der deutschen Hilfedatei 
$zeile1="<?PHP\n";
$kommentar1="//Um ihren eigenen Hilfetext zu benutzen, löschen Sie die folgende\n"; 
$kommentar2="//Zeile und ersetzen Sie sie mit Code nach dem Schema aus der Datei /modules/system_new_module/includes/std_hlp_file_example.php\n";
$text="require_once(\$root_path.\"modules/system_new_module/includes/std_hlp_file_example.php\")\n";
$zeile2="?>\n";
fwrite($datei,$zeile1);
fwrite($datei,$kommentar1);
fwrite($datei,$kommentar2);
fwrite($datei,$text);
fwrite($datei,$zeile2);
fclose($datei); 

//Hilfedatei "help_$lang_<modulname>.php" englisch
//anlegen unter /help/en
$help_pfad=$root_path."help/en/";
$help_en_datei="help_en_".$ModulNeuBez."_hlp.php";
$file=$help_pfad.$help_en_datei;
//echo "</br>".$file;

//Datei öffnen
if($datei=fopen($file,"w")){
     //echo "Hilfedatei angelegt.</br>";
	}
else {
     echo "englsiche (standard)Hilfe anlegen gescheitert.</br>";
		 }

//Inhalt der englischen Hilfedatei 
$zeile1="<?PHP\n";
$kommentar1="//For using your own help text, delete the following line and\n"; 
$kommentar2="//replace it with code with the sheme from the file /modules/system_new_module/includes/std_hlp_file_example.php\n";
$text="require_once(\$root_path.\"modules/system_new_module/includes/std_hlp_file_example.php\")\n";
$zeile2="?>\n";
fwrite($datei,$zeile1);
fwrite($datei,$kommentar1);
fwrite($datei,$kommentar2);
fwrite($datei,$text);
fwrite($datei,$zeile2);
fclose($datei); 
?>

