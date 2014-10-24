<?PHP
//***Variablen GENERELL für dieses Modul setzen***//

//Variable für dieHilfedatei
$new_hlp_file="edv_modul_neu_hlp2.php";

//Variable für die in diesem Modul benutzte Individual-Sprachdatei 
$lang_thismodule_used="modulneu.php";

//*** Variablen, SPEZIELL in dieser Datei gebraucht ***//

// Falls das Eingabefeld Daten enthält, den Focus mittels JAVA auf ein Feld setzen, sonst nicht.
if ($ModulNeuBez==""){
   $this_page_focusfeld="";
   }
else {
	 $this_page_focusfeld="document.modul3.jafeld.focus()";
	 }
	 
//Variable, ob ein Standardmenü generiert werden soll oder nicht
$stdmenuejanein=$_REQUEST['stdmenuejanein'];


//*** REQUIRES***//
$max_sort_nr=$_REQUEST['max_sort_nr'];


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
$returnfile="edv_modul_neu.php?sid=$sid&lang=$lang&ModulNeuBez=$ModulNeuBez";
$breakfile=$root_path."main/startframe.php?sid=$sid&lang=$lang";
?>

<?PHP
//Head includen
require_once($root_path.$newmodule_includepath."head_include.inc.php");
?>

<!-- Java Script für Entscheidung ob das Modul so angelegt werden soll oder nicht.
FAlls ja, edv_modul_neu_3.php ausführen, falls nein, eine Seite zurück zu edv_modul_neu.php
return false ist nötig damit die action - Anweisung in der FORM nicht ausgeführt wird. 
Die Action muss vorhanden sein, falls ein Browser Java nicht aktiviert hat. -->
<script language="JavaScript" type="text/javascript">
<!--

function submityes(){
				 document.modul3.action="edv_modul_neu_3.php";
				 document.modul3.submit();
				 return false;
				 }
function submitno(){
				 document.modul3.action="edv_modul_neu.php";
				 document.modul3.submit();
				 return false;				 
				 }				 
//-->

</script>

<!-- Cursor beim öffnen standardmässig auf "JA" setzen 
<? $javaline="'document.modul3.jafeld.focus()'" ?>
<? echo "$javaline;" ?> onLoad="document.modul3.jafeld.focus()"
-->
<?PHP

// Den <BODY> includen 
require ($root_path.$newmodule_includepath."inc_body.php");

// blauer Titelblock einbinden
//Variablen des Titelblocks
//Hilfedatei
$new_hlp_file="edv_modul_neu_hlp1.php";

//Variable für Überschrift Titellesite
$thismodulname=$LDEDP . " - " . $LDNeuesModulanlegen;
										 
include($root_path.$newmodule_includepath."inc_titelblock.php");
?>

<?PHP
//Das Eingabefeld formatieren, von evtl. Tags befreien, Sonderzeichen & Umlaute in HTML Codes umwandeln
require($root_path.$newmodule_includepath."inc_func_shorten.php");
$ModulNeuBez= strip_tags($ModulNeuBez);
$ModulNeuBez= htmlentities($ModulNeuBez);
$alteBez=$ModulNeuBez;

$werte=shorten($ModulNeuBez);
$ModulNeuBez=$werte[0];

    if ($werte[1]=="true"){
    echo "<FONT FACE='ARIAL' color='#ff0000'><STRONG>$blank_eingabe</STRONG></FONT></br><br/>";
    }


// Prüfen ob das Eingabefeld Daten enthält
if ($ModulNeuBez=="" or $ModulNeuBez==" "){
?>
	 <FONT FACE='ARIAL' color='#ff0000'><STRONG><?PHP echo "<blink>".$fehleingabe."</blink>"; ?> </STRONG></FONT>
<?PHP
}

else {
?>
<!--Farbe dunkelrot: color="#990000"-->
<FONT FACE='ARIAL'  COLOR="<?php echo $cfg['top_txtcolor']; ?>"><STRONG><?php echo $kontrollmeldung_1; ?> </STRONG></FONT>
<Font Face='ARIAL'  COLOR="#990000"><STRONG><I> <?PHP echo $ModulNeuBez;?> </STRONG></I></FONT>

<FORM name= "modul3" action="edv_modul_neu_3.php" method="post">

<FONT FACE='ARIAL' COLOR="<?php echo $cfg['top_txtcolor']; ?>"><STRONG><?php echo $kontrollmeldung_3; ?></STRONG></FONT><br/><br/><br/>
<input type="submit"   name="jafeld"  value="<?php echo $LDja; ?>" maxlength="30" size="30"  >
<input type="hidden" value="<? echo $ModulNeuBez; ?>" name="ModulNeuBez"  size="37" maxlength="30" >
<INPUT type='hidden' value="<?php echo $max_sort_nr; ?>" name="max_sort_nr" />
<INPUT type='hidden' value="<?php echo $menufolge; ?>" name="menufolge" />
<INPUT type='hidden' value="<?php echo $sid; ?>" name="sid" />
<INPUT type='hidden' value="<?php echo $stdmenuejanein; ?>" name="stdmenuejanein" />
<!--<INPUT type='hidden' value="<?php echo $mit_untermenu; ?>" name="mit_untermenu" />-->
<INPUT type='hidden' value="<?php echo $lang; ?>" name="lang" />
</form>

<FORM name= "no" action="edv_modul_neu.php" method="post">
<INPUT type="submit" name="neinfeld" value="<?PHP echo $LDnein; ?>">
<INPUT type="hidden" name="ModulNeuBez" value="<? echo $alteBez; ?>"> 
<INPUT type='hidden' name="sid"  value="<?php echo $sid ?>"  />
<INPUT type='hidden' name="lang" value="<?php echo $lang ?>"  />

</form>
<?
}
?>
<?
// Fusszeile mit Copyright, etc. includen
require_once ($root_path.$newmodule_includepath."footnote.inc.php");
?>
