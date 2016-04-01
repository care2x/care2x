<tr>
    <td id="field_label">{$field->label}</td>
    <td id="field_value">
        <select name='FIELDS[{$field->name}]'>
            {html_options values=$field->values output=$field->options selected=$field->default}
        </select>
    </td>
</tr>
