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
$returnfile="radio_tabwahl.php?sid=$sid&lang=$lang&ModulNeuBez=$ModulNeuBez&pat_bez=$pat_bez";
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
	

									 
include($root_path.$newmodule_includepath."inc_titelblock.php");
// Ende der Standardeinbindungen


//echo $pat_bez."<br/>";

/*Anzeigen des eigenen Dateinamens
$tx= basename(__FILE__);
echo "Name dieser Datei:  <i><strong> ".$tx."</i></strong><br/><br/><br/>";
*/

//echo "<FONT FACE='ARIAL' color='#330066'><STRONG>Wahl 2 - Die Wahl fiel auf: <i>eine SQL Tabelle im Memofeld editieren und anlegen </i>.</strong></font>";

$sql_code="CREATE TABLE $ModulNeuBez (id INT NOT NULL AUTO_INCREMENT ,n1 VARCHAR( 30 ) NOT NULL ,n2 VARCHAR( 30 ) NOT NULL ,PRIMARY KEY ( id ));";
?>
<p>
<?php echo "<form action=\"editsql.php?sid=\".$sid.\"&lang=\".$lang.\"&ModulNeuBez=\".$ModulNeuBez.\">"?> 
<FONT FACE='ARIAL'  color='#330066'><STRONG><?php echo $infoline ?></STRONG></FONT>

<textarea onmouseover="this.style.backgroundColor='#ffff00'; this.style.color='#0000ff' "  onmouseout="this.style.backgroundColor='#ffff99'; this.style.color='#000000' "  style="background:ffff99" name="sqlstring" cols="83" rows="10" ><?echo $sql_code;?></textarea><br/><br/><br/>

<input type='text' name="tab_name" value="<? echo $ModulNeuBez; ?>">
   <FONT FACE='ARIAL' color="<?php echo $cfg['top_txtcolor']; ?>"><?php echo $nenne_tabelle." ".$nenne_tabelle2; ?> </FONT><br/>
<input type='text'   name="tabellentitel" value="Überschrift">
    <FONT FACE='ARIAL' color="<?php echo $cfg['top_txtcolor']; ?>"><?php echo $nenne_tab_bezeichner; ?></FONT><br/>
<input type='text'   name="suchfeld" value="id">
    <FONT FACE='ARIAL' color="<?php echo $cfg['top_txtcolor']; ?>"><?php echo $nenne_suchfeld; ?></FONT><br/>
<input type='text'   name="sortfeld2" value="name">
   <FONT FACE='ARIAL' color="<?php echo $cfg['top_txtcolor']; ?>"><?php echo $nenne_anzeigefeld; ?></FONT><br/>
<input type='text'   name="host" value="localhost">
   <FONT FACE='ARIAL' color="<?php echo $cfg['top_txtcolor']; ?>"><?php echo $nenne_server; ?></FONT><br/>
	 
	    <input type="hidden" name="user" value="root">
      <input type="hidden" name="used_db" value="care2xdb">
      <input type="hidden" name="ModulNeuBez" value="<? echo $ModulNeuBez; ?>">
			
			<input type="hidden" name="lang" value="<?php echo $lang; ?>">
			<input type="hidden" name="sid" value="<?php echo $sid; ?>">
			<input type="hidden" name="leere_seite" value="0">
<br><br>

<input type="submit" value="<?php echo $fertig; ?>">
<input type="reset" value="<?php echo $setback_fields; ?>" name="reset">

</form>
