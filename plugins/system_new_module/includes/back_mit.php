<br/><br/>
<form action="<?php echo '../../modules/'.$ModulNeuBez.'/test_person_search.php?sid='.$sid.'&lang='.$lang?>">
<input type="submit" name="back" value="Anderen Patienten wählen">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
</form>
<br/>

<form action="<?php echo '../../modules/'.$ModulNeuBez.'/sub_'.$ModulNeuBez.'.php?sid='.$sid.'&lang='.$lang?>">
<input type="submit" name="back" value="Zurück zur Auswahl dieser Modulgruppe">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
</form>
<br/>

<form action="<?php echo '../../main/startframe.php?sid=$sid&lang=$lang'?>">
<input type="submit" name="back" value="Zurück zur Hauptseite">
</form>


