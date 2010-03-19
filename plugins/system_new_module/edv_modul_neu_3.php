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
//$returnfile="edv_modul_neu_2.php?sid=$sid&lang=$lang&ModulNeuBez=$ModulNeuBez";
$returnfile="check_patientwahl.php?sid=$sid&lang=$lang&ModulNeuBez=$ModulNeuBez";
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
										 
//echo "Diese Datei heisst <strong>edv_modul_neu_3.php</strong>";										 

include($root_path.$newmodule_includepath."inc_titelblock.php");
?>

<?PHP

//Variablen einlesen

$ModulNeuBez=$_REQUEST['ModulNeuBez'];
$stdmenuejanein=$_REQUEST['stdmenuejanein'];
$menufolge=$_REQUEST['menufolge'];
$max_sort_nr=$_REQUEST['max_sort_nr'];
$patientenbezogen=$_REQUEST['patientenbezogen'];


// $sort_nr auf die gewünschte Stelle setzen, alle nachfolgenden Datensätze 
//in care_menu_main um eins erhöhen
if ($menufolge=="automatisch"){
    //echo " menufolge ist automatisch, Modul wird an letzter Stelle angefügt.</br>";
		$sort_nr=$max_sort_nr+1;
		// Variabla $updateflag wird ausgewertet in Datei menueintrag_modul.inc.php, ob die Menühirarchie
		// neu gestetzt werden muss oder nicht(im Falle von false)
		$updateflag=false;
		//echo $sort_nr."</br>";
		}
else {
    $sort_nr=substr($menufolge,0,2); // extrahiert von z.B. 05. Stelle die ersten 2 Zeichen
		//echo " menufolge ist ". $menufolge.", ein sort_nr - update muss erfolgen.</br>";
		$updateflag=true;
		//echo $sort_nr."</br>";
		}
		
		
// Prüfen und ggf. Anlegen eines Verzeichnisses unter /Module.
require("ordner.inc.php");

//in dieser Datei befinden sich weitere Unterverzweigungen nach:
//Traps_anlegen.inc.php
//menueintrag_modul.inc.php - Prüfung erfolgt ob ein Eintrag erfolgen soll
//echo "Ordner, Sprach-und Hilfedateien,sowie Submenü und Menüeintrag sind erfolgt. Dies ist nur eine Meldung aus..neu_3.php.</BR>";

echo "<br/><Font FACE='Arial' color=".$cfg['top_txtcolor'].">Der Ordner wird jetzt erstellt.";
echo "<br/><Font FACE='Arial' color=".$cfg['top_txtcolor'].">Standarddateien werden kopiert.";
echo "<br/><Font FACE='Arial' color=".$cfg['top_txtcolor'].">Trap-Dateien werden erstellt.";
echo "<br/><Font FACE='Arial' color=".$cfg['top_txtcolor'].">Die Sprachdateien werden erstellt";
echo "<br/><Font FACE='Arial' color=".$cfg['top_txtcolor'].">Die Hilfedateien werden erstellt.";
echo "<br/><Font FACE='Arial' color=".$cfg['top_txtcolor'].">Die Datei für das Sub-Menü wird erstellt";
echo "<br/><Font FACE='Arial' color=".$cfg['top_txtcolor'].">Die Datei zur Passwortabfrage wird erstellt.";

echo "<br/><br/><Font FACE='Arial' color=".$cfg['top_txtcolor'].">$weiter_info";



// Es folgt ein Link auf eine wichtige Hinweisdatei, die Verfollständigungshinweise enthält wie
// wie man das neu erstellte Modul fehlerfrei und sicher mit cookies, passwortabfrage etc. macht
?>
<br/><br/>
<script type="text/javascript">
<!--
function PopupFenster() {
  F = window.open("xy.html","Popup","width=750,height=250");
}
-->
</script>

<a href="javascript:PopupFenster()"><?php echo $wichtige_info; ?></a>
<!-- <a href="hinweise.txt" target="1"><?php echo $wichtige_info; ?></a>-->	
	
	
<form action= "check_patientwahl.php<?php echo '?sid='.$sid.'&lang='.$lang ?>" >
<INPUT type='hidden' value="<?php echo $ModulNeuBez;?>" name="ModulNeuBez" >
<INPUT type='hidden' value="<?php echo $sid?>" name="sid" />
<INPUT type='hidden' value="<?php echo $lang?>" name="lang" />
<br/><br/>
<!-- Formular wird mittels Bild übergeben an check_patientwahl.php -->
<INPUT type="image" <?php if($cfg['dhtml'])echo 'img '.createLDImgSrc($root_path,'continue.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
