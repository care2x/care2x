<?php
if($rows){
	# Transfer data into array
	while($row=$pregs->FetchRow()){
		$pregbuf[$row['encounter_nr']]=$row;
		$buffer=$row['encounter_nr'];
	}
	$this_enc_preg=false;
	if(!isset($show_preg_enc)||!$show_preg_enc){
		if($parent_admit) {
			$show_preg_enc=$_SESSION['sess_en'];
			$this_enc_preg=true;
		}elseif($rows==1){
			$show_preg_enc=$buffer;
		}
	}
	
?>
<table border=0 cellpadding=0 cellspacing=0 width=100%>
<?php
	$show_details=false;
	if($show_preg_enc&&isset($pregbuf[$show_preg_enc])){
		$show_details=true;
		# Get the field names
		$fields=&$obj->coreFieldNames();
		# If not this encounter´s pregnancy, show warn notice
		
?>

	<tr>
	<td colspan=6>
	<table border=0 cellpadding=1 cellspacing=1 width=100% class="frame">
<?php
		if(!$parent_admit){
?>

  	<tr bgcolor="#fefefe">
    <td <?php echo $tbg; ?>><FONT color="#ff0000"><b><?php echo $LDEncounterNr; ?></b></font></td>
    <td <?php echo $tbg; ?>><FONT color="#ff0000"><?php echo $pregbuf[$show_preg_enc]['encounter_nr'] ?></font></td>
  	</tr>

<?php
		}

		while(list($z,$x)=each($fields)){
			if($x=='status') break;
			if($x=='nr'||$x=='encounter_nr'||empty($pregbuf[$show_preg_enc][$x])) continue;
?>


  <tr bgcolor="#fefefe">
    <td><FONT color="#006600"><b><?php echo $LD[$x]; ?></b></font></td>
    <td>
	<?php 
			switch($x){
				case 'delivery_date': echo formatDate2Local($pregbuf[$show_preg_enc][$x],$date_format); break;
				case 'delivery_time': echo convertTimeToLocal($pregbuf[$show_preg_enc][$x]); break;
				case 'delivery_mode':
					$buf=&$obj->getDeliveryMode($pregbuf[$show_preg_enc]['delivery_mode']);
					if(isset($$buf['LD_var']) && $$buf['LD_var']) echo $$buf['LD_var'];
						else echo $buf['name'];
					break;
				case 'outcome':
					$buf=&$obj->getOutcome($pregbuf[$show_preg_enc]['outcome']);
					if(isset($$buf['LD_var']) && $$buf['LD_var']) echo $$buf['LD_var'];
						else echo $buf['name'];
					break;
				case 'induction_method':
					$buf=&$obj->getInductionMethod($pregbuf[$show_preg_enc][$x]);
					if(isset($$buf['LD_var']) && $$buf['LD_var']) echo $$buf['LD_var'];
						else echo $buf['name'];
					break;
				case 'perineum':
					$buf=&$obj->getPerineum($pregbuf[$show_preg_enc][$x]);
					if(isset($$buf['LD_var']) && $$buf['LD_var']) echo $$buf['LD_var'];
						else echo $buf['name'];
					break;
				case 'anaesth_type_nr':
					$buf=&$obj->getAnaesthesia($pregbuf[$show_preg_enc][$x]);
					if(isset($$buf['LD_var']) && $$buf['LD_var']) echo $$buf['LD_var'];
						else echo $buf['name'];
					break;
				case 'child_encounter_nr':
					if($pregbuf[$show_preg_enc][$x]){
						$buf=explode(' ',$pregbuf[$show_preg_enc][$x]);
						while(list($q,$r)=each($buf)){
							 echo'<a href="aufnahme_daten_zeigen.php'.URL_APPEND.'&encounter_nr='.$r.'&origin=admit&target='.$target.'">'.$r.'</a> ';
						}
					}
					break;
				case 'is_booked':
					if($pregbuf[$show_preg_enc][$x]) echo $LDYes;
						else echo $LDNo;
					break;
				case 'proteinuria':
					if($pregbuf[$show_preg_enc][$x]) echo $LDYes;
						else echo $LDNo;
					break;
				default: echo $pregbuf[$show_preg_enc][$x];
			}
	?></td>
  </tr>

<?php

		}
?>
	</table>
	
	</td>
	</tr>
<?php
}

	if($parent_admit&&$edit&&($show_preg_enc==$_SESSION['sess_en']||$no_enc_preg)){
?>
  <tr valign="top">
    <td colspan=2>&nbsp;<br>
	<img <?php echo createComIcon($root_path,'bul_arrowgrnlrg.gif','0','absmiddle'); ?>>
	<a href="<?php 
		echo$thisfile.URL_APPEND.'&pid='.$_SESSION['sess_pid'].'&target='. strtr($target,' ','+').'&mode=new&allow_update='.$allow_update;
		if($this_enc_preg) echo '&rec_nr='.$pregbuf[$show_preg_enc]['nr'];
	 ?>"> 
<?php 
		if($no_enc_preg) echo $LDEnterNewRecord;
			else echo $LD['update_preg_details']; 
?>
	</a>&nbsp;<p>
	</td>
	</tr>
<?php
	}
	if($show_details&&$rows>1){
?>
  <tr bgcolor="#f6f6f6" valign="top">
    <td colspan=6><img <?php echo createComIcon($root_path,'dwnarrowgrnlrg.gif','absmiddle') ?>> <font size=3><?php echo $LDOtherRecords; ?></font>
</td>
  </tr>

<?php	
	}

	if($rows>1||($no_enc_preg)){
	
?>
  <tr bgcolor="#f6f6f6" valign="top">
    <td <?php echo $tbg; ?>><FONT color="#000066">&nbsp;</td>
    <td <?php echo $tbg; ?>><FONT color="#000066"><?php echo $LDEncounterNr; ?></td>
    <td <?php echo $tbg; ?>><FONT color="#000066"><?php echo $LDDelivery.' '.$LDDate; ?></td>
    <td <?php echo $tbg; ?>><FONT color="#000066"><?php echo $LDDelivery.' '.$LDMode; ?></td>
    <td <?php echo $tbg; ?>><FONT color="#000066"><?php echo $LDOutcome; ?></td>
    <td <?php echo $tbg; ?>><FONT color="#000066"><?php echo $LDNrOfFetus; ?></td>
  </tr>
<?php
		while(list($x,$v)=each($pregbuf)){
			# Do not list this encounter´s pregnancy in the admission module
			if($x==$show_preg_enc) continue;
?>
  <tr bgcolor="#fefefe" valign="top">
    <td>
<?php
		if($parent_admit&&($v['encounter_nr']==$_SESSION['sess_en']))	echo '<img '.createComIcon($root_path,'info3.gif','0').'>';
			else echo '&nbsp;';
?>
	</td>
    <td><a href="<?php echo $thisfile.URL_APPEND.'&target='.$target.'&show_preg_enc='.$v['encounter_nr'] ?>"><?php echo $v['encounter_nr']; ?></a></td>
    <td><?php echo @formatDate2Local($v['delivery_date'],$date_format); ?></td>
    <td><?php echo $v['delivery_mode']; ?></td>
    <td><?php echo $v['outcome']; ?></td>
    <td><?php echo $v['nr_of_fetuses']; ?></td>
  </tr>

<?php
		}
	}

?>
</table>
<?php
}
?>
