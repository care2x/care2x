<?php
if($rows){
?>
<script language="javascript" >
<!-- 
function openDRGComposite(enr,edit,isd){
<?php if($cfg['dhtml'])
	echo '
			w=window.parent.screen.width;
			h=window.parent.screen.height;';
	else
	echo '
			w=800;
			h=650;';
?>
	
	drgcomp_<?php echo $_SESSION['sess_pid'].$sid; ?>=window.open("<?php echo $root_path ?>modules/drg/drg-composite-start.php<?php echo URL_REDIRECT_APPEND."&display=composite&pn=\"+enr+\"&edit=\"+edit+\"&is_discharged=\"+isd+\"&ln=$name_last&fn=$name_first&bd=$date_birth"; ?>","drgcomp_<?php echo $encounter_nr.$sid; ?>","menubar=no,resizable=yes,scrollbars=yes, width=" + (w-15) + ", height=" + (h-60));
	window.drgcomp_<?php echo $_SESSION['sess_pid'].$sid; ?>.moveTo(0,0);
} 
//-->
</script>
<table border=0 cellpadding=0 cellspacing=0 width=100%>
  <tr bgcolor="#f6f6f6" valign="top">
    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066">&nbsp;</td>
    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDDate; ?></td>
    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDEncounterNr; ?></td>
    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDShow; ?></td>
  </tr>
<?php
		while($row=$drg_obj->FetchRow()){
			$buf=1;
			if($row['is_discharged']) $buf=0;
?>
  <tr bgcolor="#fefefe" valign="top">
    <td><FONT SIZE=-1  FACE="Arial"><?php if($buf) echo '<img '.createComIcon($root_path,'check2.gif','0','',TRUE).'>'; else echo '&nbsp;'; ?></td>
    <td><FONT SIZE=-1  FACE="Arial"><?php echo @formatDate2Local($row['encounter_date'],$date_format); ?></td>
    <td><FONT SIZE=-1  FACE="Arial"><a href="javascript:openDRGComposite('<?php echo $row['encounter_nr'] ?>','<?php echo $buf; ?>','<?php echo $row['is_discharged'] ?>')"><?php echo $row['encounter_nr']; ?></a></td>
    <td><a href="javascript:openDRGComposite('<?php echo $row['encounter_nr'] ?>','<?php echo $buf; ?>','<?php echo $row['is_discharged'] ?>')"><img <?php echo createComIcon($root_path,'info2.gif','0','',TRUE); ?></td>
  </tr>

<?php
	}
?>
</table>
<?php
}
?>

