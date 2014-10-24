<?php
$tbg= 'background="'.$root_path.'gui/img/common/'.$theme_com_icon.'/tableHeaderbg3.gif"';
?>
<table border=0 cellpadding=4 cellspacing=1 width=100%>
  <tr bgcolor="#f6f6f6">
    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDDate; ?></td>
    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDNotes; ?></td>
    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDDetails; ?></td>
    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDBy; ?></td>
    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDEncounterNr; ?></td>
  </tr>
<?php
$toggle=0;
while($row=$result->FetchRow()){
	if($toggle) $bgc='#f3f3f3';
		else $bgc='#fefefe';
	$toggle=!$toggle;
?>


  <tr  bgcolor="<?php echo $bgc; ?>"  valign="top">
    <td><FONT SIZE=-1  FACE="Arial"><?php if(!empty($row['date'])) echo @formatDate2Local($row['date'],$date_format); ?></td>
    <td><FONT SIZE=-1  FACE="Arial" color="#000033"><?php echo $row['notes']; ?></td>
    <td align="center"><a href="#"><img <?php echo createComIcon($root_path,'info3.gif','0'); ?>></a></td>
    <td><FONT SIZE=-1  FACE="Arial"><?php if($row['personell_nr']) echo $row['personell_nr']; ?></td>
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $_SESSION['sess_full_en']; ?></td>
  </tr>

<?php
}
?>
</table>
<p>
<img <?php echo createComIcon($root_path,'bul_arrowgrnlrg.gif','0','absmiddle'); ?>>
<a href="<?php echo $thisfile.URL_APPEND.'&pid='.$_SESSION['sess_pid'].'&target='.$target.'&mode=new'; ?>"> 
<?php echo $LDEnterNewRecord; ?>
</a>
