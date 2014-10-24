<?php
if($rows){
?>
<table border=0 cellpadding=1 cellspacing=0 width=100%>
  <tr bgcolor="#f6f6f6" valign="top">
    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066">&nbsp;</td>
    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDDate; ?></td>
    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDEncounterNr; ?></td>
    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDDiagnosis2; ?></td>
    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDShow; ?></td>
  </tr>
<?php
		while($row=$med_obj->FetchRow()){
			$buf=1;
			if($row['is_discharged']) $buf=0;
			$aref=$root_path.'modules/medocs/show_medocs.php'.URL_APPEND.'&edit='.$buf.'&encounter_nr='.$row['encounter_nr'].'&is_discharged='.$row['is_discharged'];
?>
  <tr bgcolor="#fefefe" valign="top">
    <td><FONT SIZE=-1  FACE="Arial"><?php if($buf) echo '<img '.createComIcon($root_path,'check2.gif','0','',TRUE).'>'; else echo '&nbsp;'; ?></td>
    <td><FONT SIZE=-1  FACE="Arial"><?php if($row['date']) echo @formatDate2Local($row['date'],$date_format); else echo '?'; ?></td>
    <td><FONT SIZE=-1  FACE="Arial"><a href="<?php echo $aref; ?>"><?php echo $row['encounter_nr']; ?></a></td>
    <td><FONT SIZE=-1  FACE="Arial"><a href="<?php echo $aref; ?>"><?php echo nl2br(substr($row['notes'],0,50)); ?></a></td>
    <td><a href="<?php echo $aref ?>"><img <?php echo createComIcon($root_path,'info2.gif','0','',TRUE); ?>></a></td>
  </tr>

<?php
	}

?>
</table>
<?php
}
?>

