<?PHP

//Standardpfade setzen
require('./roots.php');

// Error Meldungen unterdrücken, inc_environment_global.php includen, Standard-Sprachdateien einbinden,
// Dateischutz etc
	 						 //variabeln für inc_modul_top.php
							 						 //Variable für die in diesem Modul benutzte Individual-Sprachdatei 
													 $lang_thismodule_used="modulneu.php";
													 
													 //Cookiename setzen
													 $this_cookie_name='ck_edv_user';
													 
require_once($root_path.$newmodule_includepath."inc_modul_top.php");

// ggf. $breakfile und $returnfile neu definieren
$breakfile=$root_path."main/startframe.php?sid=$sid&lang=$lang";
$returnfile=$root_path."/modules/system_admin/sub_modul_neu.php?sid=$sid&lang=$lang&from=$from";

//Head includen
require_once($root_path.$newmodule_includepath."head_include.inc.php");

?>


<?php

// Den <BODY> includen
	 		 //Variablen die im Body benötigt werden
			 
			      //für den <BODY>, Angabe wo bei onclick der Focus stehen soll beim Laden der Seite
						$this_page_focusfeld=""; 
						
require ($root_path.$newmodule_includepath."inc_body.php");




// blauer Titelblock einbinden
	 				//Variablen des Titelblocks
										 //Hilfedatei
										 $new_hlp_file="edv_modul_neu_hlp1.php";
										 
										 //Variable für Überschrift Titellesite
										 $thismodulname=$LDEDP." - Modulgenerator";
										 
include($root_path.$newmodule_includepath."inc_titelblock.php");
?>

<!-- ********************************************** -->
<!-- Ab hier kann komplett eigener Code erfolgen -->
<!-- ********************************************** -->
<?php

if (is_file("xy.html")){
    
		include "xy.html";
		}
else {
     echo "Datei xy.html nicht gefunden oder in ihrer Sprache noch nicht vorhanden.";
}
		 
?>
