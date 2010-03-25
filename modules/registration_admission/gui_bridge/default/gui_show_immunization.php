
<script  language="javascript">
<!-- 
function popImmNotes(nr) {
	urlholder="./immunization_notes.php<?php echo URL_REDIRECT_APPEND; ?>&nr="+nr;
	IMMWIN<?php echo $sid ?>=window.open(urlholder,"histwin<?php echo $sid ?>","menubar=no,width=400,height=300,resizable=yes,scrollbars=yes");
}
-->
</script>

<table border=0 cellpadding=4 cellspacing=1 width=100% class="frame">
  <tr bgcolor="#f6f6f6">
    <td <?php echo $tbg; ?>></td>
    <td <?php echo $tbg; ?>><FONT  color="#000066"><?php echo $LDDate; ?></td>
    <td <?php echo $tbg; ?>><FONT  color="#000066"><?php echo $LDType; ?></td>
    <td <?php echo $tbg; ?>><FONT  color="#000066"><?php echo $LDMedicine; ?></td>
    <td <?php echo $tbg; ?>><FONT  color="#000066"><?php echo $LDTiter; ?></td>
    <td <?php echo $tbg; ?>><FONT  color="#000066"><?php echo $LDRefreshDate; ?></td>
  </tr>
<?php
$toggle=0;
while($row=$result->FetchRow()){
	if($toggle) $bgc='#f3f3f3';
		else $bgc='#fefefe';
	$toggle=!$toggle;?>


  <tr bgcolor="<?php echo $bgc; ?>">
    <td rowspan=2 valign="top">
	<?php if(!empty($row['notes'])) { ?>
	<a href="javascript:popImmNotes(<?php echo $row['nr']; ?>)"><img <?php echo createComIcon($root_path,'info3.gif','0','',TRUE); ?>></a>
	<?php } ?>
	</td>
    <td rowspan=2 valign="top"><?php echo @formatDate2Local($row['date'],$date_format); ?></td>
    <td rowspan=2 valign="top"><FONT  color="#006600"><b><?php echo $row['type']; ?></b></td>
    <td rowspan=2 valign="top"><?php echo $row['medicine']; ?></td>
    <td rowspan=2 valign="top"><?php echo $row['titer']; ?></td>
    <td>
	<?php 
		if($row['refresh_date']!='0000-00-00') echo @formatDate2Local($row['refresh_date'],$date_format);
			else echo '&nbsp;'; ?></td>
  </tr>
  <tr bgcolor="<?php echo $bgc; ?>">
    <td><FONT SIZE=1>
	<FONT  color="#660000"><?php echo $LDDosage; ?></font><br>
	<?php echo $row['dosage']; ?><br>
	<FONT  color="#660000"><?php echo $LDAppType; ?></font><br>
	<?php echo $row['app_type_name']; ?><br>
	<FONT  color="#660000"><?php echo $LDAppBy; ?></font><br>
	<?php echo $row['application_by']; ?><br>
	</td>
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
