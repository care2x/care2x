<a href="<?php echo $updatefile.URL_APPEND.'&encounter_nr='.$_SESSION['sess_en'].'&update=1&target='.$target; ?>"><img <?php echo createLDImgSrc($root_path,'update_data.gif','0','top') ?>></a>
<a href="javascript:makeBarcodeLabel('<?php echo $_SESSION['sess_en'];  ?>')"><img <?php echo createLDImgSrc($root_path,'barcode_label.gif','0','top') ?>></a>
<a href="javascript:makeWristBands('<?php echo $_SESSION['sess_en']; ?>')"><img <?php echo createLDImgSrc($root_path,'barcode_wristband.gif','0','top') ?>></a>
