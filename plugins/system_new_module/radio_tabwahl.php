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

//Name dieser Datei	ausgeben
//echo "Diese Datei heisst <strong>radio_tabwahl.php</strong>.";

include($root_path.$newmodule_includepath."inc_titelblock.php");
//echo $pid."<br/>";
//echo $pat_bez;

//Variable auf Null setzen falls KEIN Patientenbezogenes Modul gewünscht
if ($pat_bez!="1"){
  $pat_bez="0"; 
	}
?>

<!-- Rahmen erstellen für für RADIOBOX, was in Hauptdatei eingebundenwerden soll. gewünscht ist oder nicht--> 
<table border="1" width="80%" >
<tr><td><br/>
<ul>
<?php 
// Variable festlegen für das Ziel des folgenden Formulars
$radio1_file=$root_path.$top_dir."hauptdatei_schreiben.php";
?>
<!-- Form für vorhandene Tabelle in DBFORM bearbeiten erstellen -->
<form action="<?php echo $radio1_file ?>">

<li>  
	 <FONT FACE='ARIAL' color="<?php echo $cfg['top_txtcolor']; ?>"><?php echo $LD_wahl1;?></FONT></li><br/>
	 
	<input type='text'   name="tab_name" value="<? echo $ModulNeuBez; ?>"><!-- style="text-align:right" -->
	   <FONT FACE='ARIAL' color="<?php echo $cfg['top_txtcolor']; ?>"><?php echo $nenne_tabelle ?></FONT><br/>
		 
	<input type='text'   name="tabellentitel" value="Überschrift">
	   <FONT FACE='ARIAL' color="<?php echo $cfg['top_txtcolor']; ?>"><?php echo $nenne_tab_bezeichner ?></FONT><br/>
	 	
  <input type='text'   name="suchfeld" value="id">
	   <FONT FACE='ARIAL' color="<?php echo $cfg['top_txtcolor']; ?>"><?php echo $nenne_suchfeld ?></FONT><br/>
     
  
  <input type='text'   name="sortfeld2" value="name">
	   <FONT FACE='ARIAL' color="<?php echo $cfg['top_txtcolor']; ?>"><?php echo $nenne_anzeigefeld ?></FONT><br/>
		 
  <input type='text'   name="host" value="localhost">
	   <FONT FACE='ARIAL' color="<?php echo $cfg['top_txtcolor']; ?>"><?php echo $nenne_server ?></FONT><br/>
	 
	    <input type="hidden" name="user" value="root">
      <input type="hidden" name="used_db" value="care2xdb">
      <input type="hidden" name="ModulNeuBez" value="<? echo $ModulNeuBez; ?>"><br/>
			
	    <INPUT type='hidden' name="sid" value="<?php echo $sid ?>" />
      <INPUT type='hidden' name="lang"value="<?php echo $lang ?>"  />
			<INPUT type='hidden' name="pat_bez"value="<?php echo $pat_bez ?>"  />
      <input type="hidden" name="leere_seite" value="0">
			
<!-- Button erstellen für "Ja, den da" -->
   <input type="image" <?php if($cfg['dhtml'])echo 'img '.createLDImgSrc($root_path,'ok_small.gif','0').'  class="fadeOut" >';?></a>
	 <input type="reset" value="<?php echo $setback_fields;?>">
</form>


<!-- Form für selbst eine neue Tabelle anlegen und diese dann gleich einbinden -->
<li> <FONT FACE='ARIAL' color="<?php echo $cfg['top_txtcolor']; ?>"><?PHP echo $LD_wahl2;?></FONT><br></li>
<?$radio1_file=$root_path.$top_dir."radio1_memofeld.php?sid=".$sid."&lang=".$lang."&pid=".$pid."&ModulNeuBez=".$ModulNeuBez."&pid=".$pid."&pat_bez=".$pat_bez;
		 if($cfg['dhtml'])echo ' <a href="'.$radio1_file.'"><img '.createLDImgSrc($root_path,'ok_small.gif','0').'  class="fadeOut" >';?></a>
		 
<br/><br/>
<!--
<li><FONT FACE='ARIAL' color="<?php echo $cfg['top_txtcolor']; ?>"><?PHP echo "Nichts, leere Seite";?></FONT></li><br/>
<?
$radio1_file=$root_path.$root_path.$top_dir."leo.php?sid=".$sid."&lang=".$lang."&pid=".$pid."&ModulNeuBez=".$ModulNeuBez."&tab_name=".$tab_name."&pid=".$pid."&pat_bez=".$pat_bez;
		 if($cfg['dhtml'])echo ' <a href="'.$radio1_file.'"><img '.createLDImgSrc($root_path,'ok_small.gif','0').'  class="fadeOut" >';?></a>
-->

<!-- Form für eine leere Seite anlegen -->		 
<?php $radio1_file=$root_path.$top_dir."hauptdatei_schreiben.php";?>
<form action="<?php echo $radio1_file ?>">
<li>  
	 <FONT FACE='ARIAL' color="<?php echo $cfg['top_txtcolor']; ?>"><?php echo $LD_wahl3;?></FONT></li>
	 <INPUT type='hidden' name="sid" value="<?php echo $sid ?>" />
   <INPUT type='hidden' name="lang"value="<?php echo $lang ?>"/>
	 <input type="hidden" name="ModulNeuBez" value="<? echo $ModulNeuBez; ?>">
	 <INPUT type='hidden' name="pat_bez"value="<?php echo $pat_bez ?>"  />
	 <input type="hidden" name="leere_seite" value="1">
	
<!-- Button erstellen für "Ja, den da" -->
   </br><input type="image" <?php if($cfg['dhtml'])echo 'img '.createLDImgSrc($root_path,'ok_small.gif','0').'  class="fadeOut" >';?>
</form>	 
</ul>

									
</td></tr></table>

<br/></br>	



<br/></br>
<!-- Button erstellen für "Zurück" -->
<?php if($cfg['dhtml'])echo'<a href="'.$returnfile.'"><img '.createLDImgSrc($root_path,'back2.gif','0').'  class="fadeOut" >';?></a>

</p>
