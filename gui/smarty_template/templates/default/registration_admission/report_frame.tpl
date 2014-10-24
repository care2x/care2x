{{* Template for reports (notes) *}}

<table border=0 cellpadding=4 cellspacing=1 width=100%>
	<tr class="adm_item">
		<td>{{$LDDate}}</td>
		<td>{{$subtitle}}</td>
		<td>{{ $LDDetails}}</td>
		<td>{{$LDBy}}</td>
	{{if $parent_admit}}
		<td>{{$LDEncounterNr}}</td>
	{{/if}}
	</tr>

	{{$sReportRows}}

</table>