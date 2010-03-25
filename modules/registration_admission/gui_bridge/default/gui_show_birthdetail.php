<table border=0 cellpadding=1 cellspacing=1 width=100% class="frame">
<?php
if($rows){
	# Get the field names
	$fields=&$obj->coreFieldNames();
	
	while(list($z,$x)=each($fields)){
		if($x=='status') break;
		if(empty($birth[$x])||stristr('nr,encounter_nr,delivery_date,pid',$x)) continue;
?>


  <tr bgcolor="#fefefe">
    <td><FONT color="#006600"><b><?php echo $LD[$x]; ?></b></td>
    <td>
	<?php 
		switch($x){
				    //  header('Location:aufnahme_daten_zeigen.php'.URL_REDIRECT_APPEND.'&encounter_nr='.$encounter_nr.'&origin=admit&sem=isadmitted&target=entry');

			case 'parent_encounter_nr': echo'<a href="aufnahme_daten_zeigen.php'.URL_APPEND.'&encounter_nr='.$birth[$x].'&origin=admit&target='.$target.'">'.$birth[$x].'</a>'; break;
			case 'delivery_date': echo formatDate2Local($birth[$x],$date_format); break;
			case 'c_s_reason': 	echo nl2br($birth[$x]); break;
			case 'delivery_mode':
					$buf=&$obj->getDeliveryMode($birth[$x]);
					if(isset($$buf['LD_var'])&&$$buf['LD_var']) echo $$buf['LD_var'];
						else echo $buf['name'];
					break;
			case 'feeding':
					$buf=&$obj->getFeedingType($birth[$x]);
					if(isset($$buf['LD_var'])&&$$buf['LD_var']) echo $$buf['LD_var'];
						else echo $buf['name'];
					break;
			case 'disease_category':
					$buf=&$obj->getDiseaseCategory($birth[$x]);
					if(isset($$buf['LD_var'])&&$$buf['LD_var']) echo $$buf['LD_var'];
						else echo $buf['name'];
					break;
			case 'outcome':
					$buf=&$obj->getOutcome($birth[$x]);
					if(isset($$buf['LD_var'])&&$$buf['LD_var']) echo $$buf['LD_var'];
						else echo $buf['name'];
					break;
			case 'born_before_arrival':
					if($birth[$x]) echo $LDYes;
						else echo $LDNo;
					break;
			case 'posterio_occipital_position':
					if($birth[$x]) echo $LDYes;
						else echo $LDNo;
					break;
			case 'face_presentation':
					if($birth[$x]) echo $LDYes;
						else echo $LDNo;
					break;
			case 'classification': 	echo nl2br($birth[$x]); break;
			default: echo $birth[$x];
		}
	?></td>
  </tr>

<?php
	}
}
?>
</table>
<?php
if($parent_admit&&$edit) {
?>
<p>
<img <?php echo createComIcon($root_path,'bul_arrowgrnlrg.gif','0','absmiddle'); ?>>
<a href="<?php echo $thisfile.URL_APPEND.'&pid='.$_SESSION['sess_pid'].'&target='.$target.'&mode=new&allow_update='.$allow_update; ?>"> 
<?php 
if($rows) echo $LD['update_bd'];
	else echo $LDEnterNewRecord; ?>
</a>
<?php
}
?>
