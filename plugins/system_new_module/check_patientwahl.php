<?php

//Standardpfade setzen
require('./roots.php');

// Error Meldungen unterdrücken, inc_environment_global.php includen, Standard-Sprachdateien einbinden,
// Dateischutz etc
//variabeln für inc_modul_top.php
//Variable für die in diesem Modul benutzte Individual-Sprachdatei
$lang_thismodule_used="modulneu.php";

//Cookiename setzen
$this_cookie_name='ck_edv_user';
define('NO_TEMPLATE', TRUE);
require_once($root_path.$newmodule_includepath."inc_modul_top.php");

// ggf. $breakfile und $returnfile neu definieren
$breakfile=$root_path."main/startframe.php?sid=$sid&lang=$lang";
$returnfile="check_patientwahl.php?sid=".$sid."&lang=".$lang."&ModulNeuBez=".$ModulNeuBez;
//Head includen
require_once($root_path.$newmodule_includepath."head_include.inc.php");

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
$thismodulname=$LDEDP . " - " . $LDNeuesModulanlegen;

//Name dieser Datei oben ausgeben
//echo "Diese Datei heisst <strong>check_patientwahl.php</strong>";		
								 
include($root_path.$newmodule_includepath."inc_titelblock.php");

//echo $lang.$sid.$ModulNeuBez."<br/>";

$ModulNeuBez=$_REQUEST['ModulNeuBez'];
?>

<form action="radio_tabwahl.php<?php echo '?sid='.$sid.'&lang='.$lang ?>">
<!--<form action="test_person_search.php<?php echo '?sid='.$sid.'&lang='.$lang ?>">-->
<FONT FACE='ARIAL' COLOR="<?php echo $cfg['top_txtcolor']; ?>"><STRONG><?PHP echo $LD_headline_frage;?></STRONG></FONT>
<p>

<!-- Rahmen erstellen für die Checkbox ob Patientenbezogen gewünscht ist oder nicht--> 
<table border="1" width="80%" >
<tr><td><br/>
<input type="checkbox" name="pat_bez" value="1" checked >
<FONT FACE='ARIAL' COLOR="<?php echo $cfg['top_txtcolor']; ?>"><?php echo $haken_info; ?></FONT>
<input type="hidden"name="ModulNeuBez" value="<? echo $ModulNeuBez; ?>">
<INPUT type='hidden' value="<?php echo $sid ?>" name="sid" />
<INPUT type='hidden' value="<?php echo $lang ?>" name="lang" />
<br/></br>										
</td></tr></table>
<br/><br/><br/><br/>


<!-- Button erstellen für "Zurück" -->
<?php if($cfg['dhtml'])echo'<a href="'.$returnfile.'"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>

<!-- Button erstellen für "Weiter" mit radio_tabwahl.php -->
<input type="image" <?php if($cfg['dhtml'])echo 'img '.createLDImgSrc($root_path,'continue.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>


</p>
</form>
