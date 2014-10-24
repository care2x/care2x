{{* patient_data_basic.tpl  Shows very basic patient data 2004-06-27 Elpidio Latorilla *}}

<table>
<tbody>
	<tr>
		<td class="adm_item">{{$LDCaseNr}}:</td>
		<td class="adm_input">{{$encounter_nr}}</td>
	</tr>
	<tr>
		<td class="adm_item">{{$LDLastName}}, {{$LDName}}, {{$LDBday}}:</td>
		<td class="adm_input"><b>{{$sLastName}}, {{$sName}} {{$sBday}}</b></td>
	</tr>
</tbody>
</table>