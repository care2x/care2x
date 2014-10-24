<?PHP


//Standardpfade setzen
require('./roots.php');

//Verbindungsvariablen laden
require_once("Verbindungs_Vars.php");

//neues Modul: Eintrag ins Standardmenü mit ADODB
//ADODB Funktionen einbinden

  if (require_once("../../classes/adodb/adodb.inc.php")){
     }
  else{
      echo "Es konnte keine Verbindung zu ADODB aus Verbindung.inc.php erstellt werden.<br/>";
			break;
		  }
//Herstellen einer Verbindung zu MySQL, und der Datenbank
$conn = &ADONewConnection($db_art); 
//$conn->debug=true;
$conn->PConnect($host,$user,$pwd,$dbname);

if(!$conn) echo "nix db";

echo "well";
?>
