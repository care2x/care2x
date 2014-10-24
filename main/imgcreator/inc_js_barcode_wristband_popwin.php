<script  language="javascript">
<!-- 
function makeBarcodeLabel(en)
{
	urlholder="<?php echo $root_path; ?>main/barcode-labels.php<?php echo URL_REDIRECT_APPEND."&full_en=".$_SESSION['sess_full_en']; ?>&en="+en;
	bclabel=window.open(urlholder,"bclabel","menubar=no,resizable=yes,scrollbars=yes");
}

function makeWristBands(en)
{
	urlholder="<?php echo $root_path; ?>main/barcode-wristbands.php<?php echo URL_REDIRECT_APPEND."&full_en=".$_SESSION['sess_full_en']; ?>&en="+en;
	wclabel<?php echo $sid ?>=window.open(urlholder,"wblabel<?php echo $sid ?>","menubar=no,resizable=yes,scrollbars=yes");
}
-->
</script>
