{{* ward_occupancy_list.tpl  2004-05-15 Elpidio Latorilla *}}
{{* Table frame for the occupancy list *}}

<table cellspacing="0" width="100%">
<tbody>
	<tr>
		<td class="adm_item">{{$LDRoom}}</td>
		<td class="adm_item">{{$LDBed}}</td>
		<td class="adm_item">{{$LDFamilyName}}, {{$LDName}}</td>
		<td class="adm_item">{{$LDBirthDate}}</td>
		<td class="adm_item">{{$LDBillType}}</td>
		<td class="adm_item"></td> &nbsp;
	</tr>

	{{$sOccListRows}}

 </tbody>
</table>
