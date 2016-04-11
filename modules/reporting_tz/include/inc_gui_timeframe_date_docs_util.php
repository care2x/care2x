
<label><?php echo $LDDateFrom; ?>

</label>

<input name="date_from" type="text" size=10 maxlength=10 >
<a href="javascript:show_calendar('form1.date_from','<?php echo $date_format ?>')">
    <img <?php echo createComIcon($root_path, 'show-calendar.gif', '0', 'absmiddle'); ?>></a>

<label><?php echo $LDDateTo; ?>

</label>
<input name="date_to" type="text" size=10 maxlength=10 >
<a href="javascript:show_calendar('form1.date_to','<?php echo $date_format ?>')">
    <img <?php echo createComIcon($root_path, 'show-calendar.gif', '0', 'absmiddle'); ?>></a>


<font size=1>[<?php
$dfbuffer = "LD_" . strtr($date_format, ".-/", "phs");
echo $$dfbuffer;
?>]			 
</br>
</br>
<label><?php echo 'Amount Per Patient Consultation' ?>

</label>

<input name="amount_per_person" type="text" size=10 maxlength=10 >


<label>
    <input type="submit" name="show" value="<?php echo $LDShow; ?>">
</label>

