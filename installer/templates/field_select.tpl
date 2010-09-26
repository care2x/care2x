<div>
    <label id="field_label">{$field->label}</label>
    <select name='FIELDS[{$field->name}]'>
		{html_options values=$field->values output=$field->options selected=$field->default}
    </select>
</div>
<br />