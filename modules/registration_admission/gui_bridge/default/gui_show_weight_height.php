<script  language="javascript">
function popNotes(d){
	alert(d);
}
-->
</script>
<table border=0 cellpadding=4 cellspacing=1 width=100% class="frame">
  <tr bgcolor="#f6f6f6">
    <td <?php echo $tbg; ?>><FONT color="#000066"><?php echo $LDDate; ?></td>
    <td <?php echo $tbg; ?>><FONT color="#000066"><?php echo $LDTime; ?></td>
     <td <?php echo $tbg; ?>><FONT color="#000066"><?php echo $LDWeight; ?></td>
    <td <?php echo $tbg; ?>>&nbsp;</td>
    <td  <?php echo $tbg; ?>><FONT color="#000066"><?php echo $LDHeight; ?></td>
    <td <?php echo $tbg; ?>>&nbsp;</td>
     <td  <?php echo $tbg; ?>><FONT color="#000066"><?php echo $LD['head_circumference']; ?></td>
    <td <?php echo $tbg; ?>>&nbsp;</td>
   <td  <?php echo $tbg; ?>><FONT color="#000066"><?php echo $LDEncounterNr; ?></td>
  </tr>

<?php
$toggle=0;
while(list($x,$row)=each($msr_comp)){
	if($toggle) $bgc='#f3f3f3';
		else $bgc='#fefefe';
	$toggle=!$toggle;
?>
  <tr bgcolor="<?php echo $bgc; ?>">
    <td><?php echo @formatDate2Local($row['msr_date'],$date_format); ?></td>
    <td><?php echo strtr($row['msr_time'],'.',':'); ?></td>
    <td>
	<?php 
		if($row[6]['notes']) echo '<a href="javascript:popNotes(\''.$row[6]['notes'].'\')" title="'.$row[6]['notes'].'">'.$row[6]['value'].'</a>';
			else echo $row[6]['value']; 
	?></td>
     <td><FONT SIZE=1 ><?php echo $unit_ids[$row[6]['unit_nr']]; ?></td>
    <td>
	<?php 
		if($row[7]['notes']) echo '<a href="javascript:popNotes(\''.$row[7]['notes'].'\')" title="'.$row[7]['notes'].'">'.$row[7]['value'].'</a>';
			else echo $row[7]['value']; 
	?></td>
     <td><FONT SIZE=1 ><?php echo $unit_ids[$row[7]['unit_nr']]; ?></td>
    <td>
	<?php 
		if($row[9]['notes']) echo '<a href="javascript:popNotes(\''.$row[9]['notes'].'\')" title="'.$row[9]['notes'].'">'.$row[9]['value'].'</a>';
			else echo $row[9]['value']; 
	?></td>
     <td><FONT SIZE=1 ><?php echo $unit_ids[$row[9]['unit_nr']]; ?></td>
   <td><?php echo $row['encounter_nr']; ?></td>
  </tr>

<?php
}
?>

</table>
<?php
if($parent_admit&&!$is_discharged) {
?>
<p>
<img <?php echo createComIcon($root_path,'bul_arrowgrnlrg.gif','0','absmiddle'); ?>>
<a href="<?php echo $thisfile.URL_APPEND.'&pid='.$_SESSION['sess_pid'].'&target='.$target.'&mode=new'; ?>"> 
<?php echo $LDEnterNewRecord; ?>
</a>
<?php
}
?>
