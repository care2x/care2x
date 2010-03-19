<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi('inc_accessplan_areas.php',$PHP_SELF)) 
	die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/

function checkselect($actual,$ref)
{
  if($actual==$ref) return "selected"; else return "";
}


function createselecttable($itemselect)
{
$opts=array("","alle","M1","M2","M3","M4","M5","M6","M7","M8","M9","alle_M","P1","P1","P2","P3","P4","P5","alle_P",
				"Pflege","OP","alle_OP","Labor_Abfrage","Labor_Eingabe","Technik","Lohn_Buch","Personal","Cafe",
				"Aufnahme","Medocs","Dienstplan_OP_Pflege","Ärzte","OP_Arzt","Apotheke");

for($k=0;$k<sizeof($opts);$k++)
print '<option value="'.$opts[$k].'" '.checkselect($itemselect,"$opts[$k]").'>'.strtr($opts[$k],"_"," ").'</option>';

}
?>
