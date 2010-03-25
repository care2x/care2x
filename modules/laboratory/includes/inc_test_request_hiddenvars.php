<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="station" value="<?php echo $station ?>">
<input type="hidden" name="dept" value="<?php echo $dept ?>">
<?php
if($target!='generic'){
?>
<input type="hidden" name="dept_nr" value="<?php echo $dept_nr; ?>">
<?php
}
?>
<input type="hidden" name="pn" value="<?php echo $pn ?>">
<input type="hidden" name="batch_nr" value="<?php echo $batch_nr ?>">
<input type="hidden" name="edit" value="<?php echo $edit ?>">
<input type="hidden" name="target" value="<?php echo $target ?>">
<input type="hidden" name="subtarget" value="<?php echo $subtarget ?>">
<input type="hidden" name="tracker" value="<?php echo $tracker ?>">
<input type="hidden" name="noresize" value="<?php echo $noresize ?>">
<input type="hidden" name="user_origin" value="<?php echo $user_origin ?>">
<input type="hidden" name="status" value="pending">
<input type="hidden" name="mode" value="<?php if($mode=="edit") echo "update"; else echo $mode ?>">
<input type="hidden" name="formtitle" value="<?php echo $formtitle; ?>">
