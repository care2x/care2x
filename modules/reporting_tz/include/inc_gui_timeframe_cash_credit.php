<table width="59%" border="0" align="center">
    <tr>
        <td><?php echo $LDDateFrom; ?><input name="date_from" id="date_from" type="text" size=10 maxlength=10 value="<?php echo $_POST['date_from'] ?>">
            <a href="javascript:show_calendar('form1.date_from','<?php echo $date_format ?>')">
                <img <?php echo createComIcon($root_path, 'show-calendar.gif', '0', 'absmiddle'); ?>></a>
            <?php echo $LDDateTo; ?>
            <input name="date_to" id="date_to" type="text" size=10 maxlength=10 value="<?php echo $_POST['date_to'] ?>" >
            <a href="javascript:show_calendar('form1.date_to','<?php echo $date_format ?>')">
                <img <?php echo createComIcon($root_path, 'show-calendar.gif', '0', 'absmiddle'); ?>></a>

            <font size=1>[<?php
            $dfbuffer = "LD_" . strtr($date_format, ".-/", "phs");
            echo $$dfbuffer;
            ?>]
            <?php echo $insurance_obj->ShowAllInsurancesForQuotatuion(); ?>
            <select name="admission_id" id="admission_id" onChange="javascript:popdepts()">
                <OPTION selected value="all_opd_ipd" >All</OPTION>
                <OPTION value="2">Outpatient</OPTION>
                <OPTION value="1">Inpatient</OPTION>
            </select>
             <div id="dept">all_opd_ipd</div>
            <?php ?>
            <input type="submit" name="show"  value="<?php echo $LDShow; ?>">
        </td>

    </tr>
</table>	














