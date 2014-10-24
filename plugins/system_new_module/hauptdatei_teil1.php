<?php

/***************************************************/
/***  H A U P T D A T E I    E R S T E L L E N   ***/
/***************************************************/

// Datei <modulname.php> im neuen Verzeichnis erstellen 

//Pfad für das neue Modul
$pfad=$root_path."modules/$ModulNeuBez/";

//Dateiname generieren auf Grundlage des Modulnamens
$dateiname=$ModulNeuBez . ".php";

// Prüfen ob die Datei bereits existiert
	if (is_file($pfad.$dateiname)){
	    echo $dateiname." -Datei gibt es schon, bitte überprüfen sie den Ordner <strong>".$pfad."</strong>";
			exit;
			}
		
 
//Datei öffnen
$datei=fopen($pfad . $dateiname,"w");

if(!$datei) echo "wrong ".$pfad . $dateiname;

//Inhalt dieser Datei in ein Array schreiben
$mainline=array(55);
$mainline[0]="<?PHP\n";
$mainline[1]="//***Variablen für dieses Modul setzen***\n";
$mainline[2]="//Variable für Individual-Sprachdateisetzen, Ausgabetext sollte in Variablen hier abgelegt werden.\n";

//$zeile4 Umgebungsvaliable für die spezielle Sprachdatei für das neue Modul setzen;
$mainline[3]="\$lang_thismodule_used=\"".$ModulNeuBez.".php\";\n";

// Variable für den Cookie setzen
$mainline[4]="// Variable für den Cookie setzen\n";
$mainline[5]="\$this_cookie_name=\"ck_".$ModulNeuBez."_user\";\n";

//Hilfedatei Variable setzen und erstellen
$mainline[6]="//Hilfedatei Variable setzen\n";
$mainline[7]="\$new_hlp_file=\"".$ModulNeuBez."_hlp.php\";\n";

$mainline[8]="//Variable für Überschrift der Titelleseite, des Submenüs o.ä.\n";
$mainline[9]="\$thismodulname=\"".$ModulNeuBez."\";\n";

// Standardpfadangaben laden
$mainline[10]="//Standardpfadangaben laden\n";
$mainline[11]="require(\"./roots.php\");\n";
//Array für die Dateien laden
require_once("daten_inc_dateiarray.php");
// Die aus daten_inc_dateiarray.php  Dateien einbinden
$mainline[12]="// Error Meldungen unterdrücken, inc_environment_global.php includen, Standard-Sprachdateien einbinden,\n";
$mainline[13]="// Dateischutz etc.\n"; 
$mainline[14]="require(\$root_path.\"modules/"."$ModulNeuBez"."/"."$inc_datei_array[0]\");\n";
$mainline[15]="// Den <HEAD> includen\n";
$mainline[16]="\$returnfile=\"sub_".$ModulNeuBez.".php\".URL_APPEND;\n";
$mainline[17]="\$breakfile=\$root_path.\"main/startframe.php\".URL_APPEND;\n";
$mainline[18]="require(\$root_path.\"modules/"."$ModulNeuBez"."/"."$inc_datei_array[1]\");\n";
$mainline[19]="// Den <BODY> includen \n";
$mainline[20]="require(\$root_path.\"modules/"."$ModulNeuBez"."/"."$inc_datei_array[2]\");\n";
$mainline[21]="// den blauen Titelblock einbinden\n";
$mainline[22]="require(\$root_path.\"modules/"."$ModulNeuBez"."/"."$inc_datei_array[3]\");\n";

/*** Hier erfolt der eigene Code***/
$mainline[23]="/*****************************************/\n";
$mainline[24]="// Eigener Code folgt ab hier.\n";
$mainline[25]="// Verweis auf die Datei mit DBForm.\n";
$mainline[26]="/*****************************************/\n";

//Prüfen ob eine Leere Seite gewünscht ist

if ($leere_seite=="1") {
   $mainline[27]="echo \"<h1><strong>Hier könnte ihr Code stehen.</strong></h1>\";?>\n";
	 $field_type="hidden";
   }
	 
else {	 
     $field_type="submit";
//Wert der $pat_bez auswerten und entsprechenden Link generieren
//Verweis auf die Seite mit der DBFORM Tabelle erstellen falls $pat_bez=1
if($pat_bez=="1"){
 
   $mainline[28]="?><form action=\"<?php echo '$root_path"."modules/$ModulNeuBez/test_person_search.php?sid=\$sid&lang=\$lang'?>\">\n";
	 }
else {
   //Wenn keine Patientenbezogene Auswahl getroffen werden soll
   $mainline[28]="?><form action=\"<?php echo '$root_path"."modules/$ModulNeuBez/$ModulNeuBez"."_dbform.php?sid=\$sid&lang=\$lang'?>\">\n";
     }
}  //ende von else

$mainline[29]="<input type=\"hidden\" name=\"lang\" value=\"<?php echo \$lang; ?>\">\n";
$mainline[30]="<input type=\"hidden\" name=\"sid\" value=\"<?php echo \$sid; ?>\">\n";
$mainline[31]="<input type=\"hidden\" name=\"pid\" value=\"<?php echo \$pid; ?>\">\n"; 
$mainline[32]="<input type=\"$field_type\" name=\"los\" value=\"Tabelle öffnen\">\n";
$mainline[33]="</form><?php\n";

$mainline[34]="require(\$root_path.\"modules/system_new_module/includes/footnote.inc.php\");\n";
$mainline[35]="?>\n";


//Anzahl der Codezeilen im Array bestimmen
$anzahl_mainline=count($mainline);

//Alle Codezeilen in die Datei einfügen
$i=0;
while($i<$anzahl_mainline){
			fwrite($datei,$mainline[$i]);
			$i++;
			}
fclose($datei);

if ($leere_seite=="0"){?>
<FONT FACE='ARIAL' color="<?php echo $cfg['top_txtcolor']; ?>"><?php echo "Die vorletzte Datei des Moduls $ModulNeuBez wurde generiert.<br/></font>"; 
   }
else {?>
<FONT FACE='ARIAL' color="<?php echo $cfg['top_txtcolor']; ?>"><?php echo "Die letzte Datei des Moduls $ModulNeuBez wurde generiert.<br/></font>";
	 }
?>
