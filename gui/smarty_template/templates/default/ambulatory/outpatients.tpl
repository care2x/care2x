{{* ward_occupancy.tpl 2004-06-15 Elpidio Latorilla *}}
{{* main frame containing ward list and submenu block *}}

{{$sWarningPrompt}}
<table cellspacing="0" cellpadding="0" width="100%">
<tbody>
	<tr valign="top">
		<td>
			{{if $bShowPatientsList}}
				{{include file="ambulatory/outpatients_list.tpl"}}
			{{/if}}
			<p>
			{{$pbClose}}
		</td>
		<td align="right">
			{{$sSubMenuBlock}}
		</td>
	</tr>
</tbody>
</table>
