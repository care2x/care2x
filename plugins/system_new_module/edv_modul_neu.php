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

<!-- Java Script für Entscheidung ob das Modul so angelegt werden soll oder nicht.
FAlls ja, edv_modul_neu_2 php ausführen, falls nein, eine Seite zurück zu edv.php
return false ist nötig damit die action - Anweisung in der FORM nicht ausgeführt wird. 
Die Action muss vorhanden sein, falls ein Browser Java nicht aktiviert hat. -->
<script language="JavaScript" type="text/javascript">
<!--
function submitja(){
				 document.ModulNeu.action="edv_modul_neu_2.php";
				 document.ModulNeu.submit();
				 return false;
				 }
function submitnein(){
				 //document.ModulNeu.action="../system_admin/edv.php";
				  document.ModulNeu.action="../system_admin/sub_modul_neu.php";
				 document.ModulNeu.submit();
				 return false;				 
				 }				 
//-->
</script>

<!-- JavaSript um das Pulldownmenü im Formular zu aktivieren oder nicht -->
<!-- http://www.werner-jakob.de/WEB-DHTML/der_divtag.htm -->
<script> 
<!--
function turnOn() 
{ 
//document.ModulNeu.menufolge.disabled=false; 
elem=document.getElementById("test");
elem.style.visibility="visible";
} 
function turnOff() 
{ 
//document.ModulNeu.menufolge.disabled=true; 
elem=document.getElementById("test");
elem.style.visibility="hidden"; 
} 
//-->
</script> 

<?php

// Den <BODY> includen
//Variablen die im Body benötigt werden

//für den <BODY>, Angabe wo bei onclick der Focus stehen beim Laden der Seite soll
$this_page_focusfeld="document.ModulNeu.ModulNeuBez.focus();document.ModulNeu.ModulNeuBez.select()";

require ($root_path.$newmodule_includepath."inc_body.php");

// blauer Titelblock einbinden
//Variablen des Titelblocks
//Hilfedatei
$new_hlp_file="edv_modul_neu_hlp1.php";

//Variable für Überschrift Titellesite
$thismodulname=$LDEDP . " - " . $LDNeuesModulanlegen;
										 
include($root_path.$newmodule_includepath."inc_titelblock.php");
?>

<!-- ********************************************** -->
<!-- Ab hier kann komplett eigener Code erfolgen -->
<!-- ********************************************** -->

<?PHP
//check if module name is already set, if not leave module name empty
if(isset($_REQUEST["ModulNeuBez"])){
 $ModulNeuBez = $_REQUEST["ModulNeuBez"];
}
else {
 $ModulNeuBez = "";
}
?>

<!-- **** Eingabeformular erstellen für den Modulnamen **** -->

<!-- Beginn des Formulars -->
<!-- versteckte Felder für SID und LANG erstellen-->
<FORM name="ModulNeu" action="edv_modul_neu_2.php" >
<input type='hidden' value="<?php echo $sid ?>" name="sid" />
<input type='hidden' value="<?php echo $lang ?>" name="lang" /><br/>
<!-- Modulnamen eingeben-->
<FONT FACE="Arial" COLOR="<?php echo $cfg['top_txtcolor']; ?>" ><STRONG><?php echo $modul_titel ?></STRONG><br></FONT><br/>
<input type="text" name="ModulNeuBez"  size="30" maxlength="30" value="<?php echo $ModulNeuBez; ?>" >
<p>
<!-- Rahmen erstellen für  das Radiofeld, ob ein Standardmenüeintrag erwünscht ist oder nicht-->
<table border="1" bgcolor="<?php echo $cfg['top_bgcolor']; ?>"  width="90%">
<tr>
<td>
<br/>
<!-- Eintrag erwünscht, standardmässig akiviert-->
<input type="radio" name="stdmenuejanein" value="1" onClick="turnOn()" checked>

<FONT FACE='ARIAL' COLOR="<?php echo $cfg['top_txtcolor']; ?>"><?php echo $menue_eintrag_ja ?></FONT><br/>

<!-- Rahmen für die Auswahl, an welcher Stelle das neue Modul im Menü erscheinen soll  -->
<table border="0" width="90%" >
<tr><td HEIGHT="*" style='vertical-align:bottom;'><div style="position:relative; left:20px;"><br/>

<!-- Select legt das Pulldownmenü an-->
<div id="test">
<?
//*** Vorbereitung zum Füllen des Menüs ***//

//Verbindung zur Datenbank herstellen
//require_once ("Verbindungs_Vars.php");
require_once ("Verbindung.inc.php");

//Anzahl Datensätze aus care_menu_main bestimmen
// SQL String füllen
$sql="SELECT count(*) FROM care_menu_main;";
//SQL ausführen
$rs=&$conn->Execute($sql);
//Felderzahl in Variable schreiben
$max_sort_nr=$rs->fields[0];
//echo $max_sort_nr." ist die anzahl der felder";
?>


<SELECT name="menufolge" size="1" >
<?
//hier war die mysqlverbindung

//Menüstellen füllen //
echo "<OPTION SELECTED>".$LD_automatic;
for($i=1;$i<=$max_sort_nr;$i++){
      if ($i<10){
         echo "<OPTION>0".$i.". ".$LD_stelle."</OPTION>";
		  }
			elseif ($i>=10) {
			   echo "<OPTION>".$i.". ".$LD_stelle."</OPTION>";
			}
}			
?>

<!-- Pulldown-Menue und Tabelle schliessen -->
</SELECT></br>
<!-- Beschreibung ausgeben, wozu das Pulldownmenü gut ist-->
<FONT FACE='ARIAL' COLOR="#990000""<?php echo $cfg['top_txtcolor']; ?>"><?php echo $LD_menufolge_txt1." "; ?></font>
<FONT FACE='ARIAL' COLOR="#990000""<?php echo $cfg['top_txtcolor']; ?>"><?php echo $LD_menufolge_txt2; ?></font><br/>
									
</td></tr></table>	

</div>

<!-- den Wert von $max_sort_nr an nächstes Formular übergeben -->
<input type="hidden" name="max_sort_nr" value="<?php echo $max_sort_nr;?>">

<br/>

<!-- Menü - Eintrag  N I C H T  erwünscht -->

<input type="radio" name="stdmenuejanein" value="2"  onClick="turnOff()">
<FONT FACE='ARIAL' COLOR="<?php echo $cfg['top_txtcolor']; ?>"><?php echo $menue_eintrag_nein ?><br/><br/>

</td></tr></table>	


<br/>

<!-- Rahmen erstellen für die Checkbox ob ein Untermenü gewünscht ist oder nicht 
<table border="1" width="80%" >
<tr><td><br/>
<input type="checkbox" name="mit_untermenu" value="1" >
<FONT FACE='ARIAL' COLOR="<?php echo $cfg['top_txtcolor']; ?>"><?php echo $LD_mit_untermenu; ?>
<br/></br>										
</td></tr></table><br/>
-->

<!-- Buttons erstellen um das Formular abzuschicken  -->
<input type="submit" onclick="submitja();" size="30" value="<?php echo $modulanlegen; ?>" >
<input type="submit" onclick="submitnein();" size="30" value="<?php echo $LDBack; ?>" >

<!-- Ende des Formulars -->
</FORM>

<?
// Fusszeile mit Copyright, etc. includen
require_once ($root_path.$newmodule_includepath."footnote.inc.php");
?>
