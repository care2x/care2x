<?php
if($rows){
?>

<table border=0 cellpadding=0 cellspacing=1 width=100% >
  <tr class="reg_list_titlebar">
    <td>&nbsp;</td>
    <td><?php echo $LDDate; ?></td>
    <td><?php echo $LDEncounterNr; ?></td>
    <td><?php echo $LDAdmitType; ?></td>
    <td><?php echo $LDStatus; ?></td>
    <td><?php echo $LDDischargeDate; ?></td>
  </tr>
<?php
		while($row=$list_obj->FetchRow()){
			$buf=1;
			if($row['is_discharged']) $buf=0;
?>
  <tr bgcolor="#fefefe" valign="top">
    <td><?php if($buf) echo '<img '.createComIcon($root_path,'check2.gif','0','',TRUE).'>'; else echo '&nbsp;'; ?></td>
    <td><?php echo @formatDate2Local($row['encounter_date'],$date_format); ?></td>
    <td>
	<a href="aufnahme_daten_zeigen.php<?php echo URL_APPEND ?>&encounter_nr=<?php echo $row['encounter_nr']; ?>&origin=patreg_reg"><?php echo $row['encounter_nr'];	?></a>
	</td>
    <td>
	<?php 
 		if (isset($$enc_class[$row['encounter_class_nr']]['LD_var'])&&!empty($$enc_class[$row['encounter_class_nr']]['LD_var'])) echo $$enc_class[$row['encounter_class_nr']]['LD_var']; 
    		else echo  $enc_class[$row['encounter_class_nr']]['name']; 	
	?>
	</td>
    <td><?php if($row['is_discharged']) echo $LDDischarged; ?></td>
    <td><?php if($row['discharge_date']&&$row['discharge_date']!='0000-00-00') echo @formatDate2Local($row['discharge_date'],$date_format); ?></td>
    <td></td>
  </tr>

<?php
	}
?>
</table>
<?php
}
?>

