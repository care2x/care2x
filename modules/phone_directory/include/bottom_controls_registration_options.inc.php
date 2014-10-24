<a href="patient_register_show.php<?php echo URL_APPEND ?>&pid=<?php echo $pid ?>&update=1&target=<?php echo $target ?>"><img 
<?php echo createLDImgSrc($root_path,'reg_data.gif','0','absmiddle') ?>></a>

<?php
if($current_encounter){
?>
<a href="aufnahme_daten_zeigen.php<?php echo URL_APPEND ?>&encounter_nr=<?php echo $current_encounter ?>&origin=patreg_reg"><img <?php echo createLDImgSrc($root_path,'admission_data.gif','0','absmiddle') ?>></a>
<?php
}elseif(!$death_date||$death_date=='0000-00-00'){
?>
<a href="<?php echo $admissionfile ?>&pid=<?php echo $pid ?>&origin=patreg_reg&encounter_class_nr=1"><img <?php echo createLDImgSrc($root_path,'admit_inpatient.gif','0','absmiddle') ?>></a>
<a href="<?php echo $admissionfile ?>&pid=<?php echo $pid ?>&origin=patreg_reg&encounter_class_nr=2"><img <?php echo createLDImgSrc($root_path,'admit_outpatient.gif','0','absmiddle') ?>></a>
<?php
}
?>

<form action="patient_register.php" method=post>
<input type=submit value="<?php echo $LDNewForm ?>">
<input type=hidden name="sid" value=<?php echo $sid; ?>>
<input type=hidden name="lang" value="<?php echo $lang; ?>">
</form>
