<a href="<?php echo 'aufnahme_daten_zeigen.php'.URL_APPEND.'&encounter_nr='.$_SESSION['sess_en'].'&target='.$target; ?>"><img <?php echo createLDImgSrc($root_path,'admission_data.gif','0','top') ?>></a>
<?php
if(!$is_discharged){
?>
<a href="javascript:makeBarcodeLabel('<?php echo $_SESSION['sess_en'];  ?>')"><img <?php echo createLDImgSrc($root_path,'barcode_label.gif','0','top') ?>></a>
<a href="javascript:makeWristBands('<?php echo $_SESSION['sess_en']; ?>')"><img <?php echo createLDImgSrc($root_path,'barcode_wristband.gif','0','top') ?>></a>
<?php
}
?>
