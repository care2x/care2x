<?PHP

/***************************************************/
/***************************************************/
// Sprachdateien in deutsch und englisch (standard) anlegen

//Pfad nach englisch
$pfad=$root_path."language/en/";
//Dateibezeichnung generieren
$dateiname="lang_en_" . $ModulNeuBez . ".php"; 

//Datei öffnen
$datei=fopen($pfad . $dateiname,"w");

//Inhalt der engl. Sprachdatei 
$zeile1="<?PHP\n";
$zeile2="\$beschreibung=\"$ModulNeuBez\";\n";
$zeile3="\$beschreibungtxt=\"executes the module $ModulNeuBez\";\n";
$zeile4="?>\n";
fwrite($datei,$zeile1);
fwrite($datei,$zeile2);
fwrite($datei,$zeile3);
fwrite($datei,$zeile4);
fclose($datei);
//echo "<p>Eine Datei mit der Bezeichnung <strong><i>" . $dateiname . "</strong></i> wurde erstellt. </p>";

/***************************************************/
//Ende englische Sprachdatei erstellen

//Pfad nach deutsch
$pfad=$root_path."language/de/";
//Dateibezeichnung generieren
$dateiname="lang_de_" . $ModulNeuBez . ".php"; 
//Datei öffnen
$datei=fopen($pfad . $dateiname,"w");

//Inhalt der Trapfile
$zeile1="<?PHP\n";
$zeile2="\$beschreibung=\"$ModulNeuBez\";\n";
$zeile3="\$beschreibungtxt=\"startet das Modul $ModulNeuBez\";\n";
$zeile4="?>\n";
fwrite($datei,$zeile1);
fwrite($datei,$zeile2);
fwrite($datei,$zeile3);
fwrite($datei,$zeile4);
fclose($datei);
//echo "<p>Eine Datei mit der Bezeichnung <strong><i>" . $dateiname . "</strong></i> wurde erstellt. </p>";
/***************************************************/
//Ende deutsche Sprachdatei erstellen

?>
