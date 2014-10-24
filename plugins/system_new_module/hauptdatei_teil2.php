<?php
/*** Zweiter Teil dieser Datei, dbForm-Datei anlegen ***/
//Pfad für das neue Modul
$pfad=$root_path."modules/$ModulNeuBez/";
//dbform-Datei schreiben
$dateiname=$ModulNeuBez."_dbform.php";
// Prüfen ob die Datei bereits existiert
	if (is_file($pfad.$dateiname)){ 
	    echo "dbForm-Datei gibt es schon, bitte überprüfen sie den Ordner <strong>".$pfad."/".$datpeiname."</strong><br/>";
			echo "Aktion ".$datei." erstellen abgebrochen.";
			exit;
			}
		
//Datei öffnen
$datei=fopen($pfad . $dateiname,"w");

if(!$datei) echo $pfad . $dateiname;

//Inhalt dieser Datei in ein Array schreiben
$dbformline=array(35);
$dbformline[0]="<?PHP\n";
$dbformline[1]="//***Variablen für dieses Modul setzen***\n";
$dbformline[2]="\$tab_name=\"$tab_name\";\n";
$dbformline[3]="\$suchfeld=\"$suchfeld\";\n";
$dbformline[4]="\$sortfeld2=\"$sortfeld2\";\n";
$dbformline[5]="\$tabellentitel=\"$tabellentitel \$pname\";\n";
$dbformline[6]="\$host=\"$host\";\n";
$dbformline[7]="\$user=\"$user\";\n";
$dbformline[8]="\$used_db=\"$used_db\";\n";

$dbformline[9]="\$ModulNeuBez=\"$ModulNeuBez\";\n";

$dbformline[10]="//include ADODBC\n";
$dbformline[11]="include_once(\"../../../adodb/adodb.inc.php\");\n";

$dbformline[12]="//include DBFORM\n";
$dbformline[13]="include_once(\"../../../dbForm/formFields.inc\");\n";
$dbformline[14]="include_once(\"../../../dbForm/template.inc\");\n";
$dbformline[15]="include_once(\"../../../dbForm/dbForm.inc\");\n";

$dbformline[16]="\$conn = &ADONewConnection(\"mysql\");\n";
$dbformline[17]="//\$conn->debug = true;\n";

$dbformline[18]="\$conn->Connect(\$host, \$user, \"\", \$used_db);\n";
$dbformline[19]="\$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;\n";

$dbformline[20]="//To create a form for the person table\n";
$dbformline[21]="\$dbForm = new dbForm(\$tabellentitel, \$conn, \$tab_name);\n";

$dbformline[22]="\$dbMinYear=1900;\n";
$dbformline[23]="\$dbMaxYear=2050;\n";

$dbformline[24]="//We now need to set the search field. x Felder können nach select angegeben werden\n";

if ($pat_bez=="1"){
    $dbformline[25]="\$dbForm->setSearchField(\$suchfeld, \"select \$suchfeld, \$sortfeld2 FROM \$tab_name WHERE pid=\$pid ORDER BY $sortfeld2\");\n";
}
else {
    $dbformline[25]="\$dbForm->setSearchField(\$suchfeld, \"select \$suchfeld, \$sortfeld2 FROM \$tab_name\");\n";
}

$dbformline[26]="//\$dbForm->removeField(\"$suchfeld\");\n";
$dbformline[27]="\$dbForm->setTemplateFile(\"testform.tpl\");\n";
$dbformline[28]="\$dbForm->processForm();\n";



$dbformline[29]="\$dbForm->displayForm();\n";

$dbformline[30]="require (\"back.php\");\n";
$dbformline[31]="?>\n";

//Anzahl der Codezeilen im Array bestimmen
$anzahl_dbformline=count($dbformline);

//Alle Codezeilen in die Datei einfügen
$i=0;
while($i<$anzahl_dbformline){
			fwrite($datei,$dbformline[$i]);
			$i++;
			}
fclose($datei);
?>
<FONT FACE='ARIAL' color="<?php echo $cfg['top_txtcolor']; ?>"><?php echo "Und auch die Letzte Datei des Moduls $ModulNeuBez wurde generiert.<br/></font>";

require "copy_back_php.php";

?>
