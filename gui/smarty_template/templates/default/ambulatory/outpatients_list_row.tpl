{{* ward_occupancy_list_row.tpl 2004-06-15 Elpidio Latorilla *}}
{{* One row for each occupant or room/bed *}}
{{* This template is used by /modules/nursing/nursing_station.php to populate the ward_occupancy_list.tpl template *}}

 {{if $bToggleRowClass}}
	<tr class="wardlistrow1">
 {{else}}
	<tr class="wardlistrow2">
 {{/if}}
		<td><font {{$sTimeFontClass}}>{{$sTime}}</font></td>
		<td>{{$sMiniColorBars}}</td>
		<td>&nbsp;{{$sBed}} {{$sBedIcon}}</td>
		<td>&nbsp;{{$sTitle}} {{$sFamilyName}}{{$cComma}} {{$sName}}</td>
		<td>&nbsp;{{$sBirthDate}}</td>
		<td>&nbsp;{{$sPatNr}}</td>
		<td>&nbsp;{{$sInsuranceType}}</td>
		<td>&nbsp;{{$sAdmitDataIcon}} {{$sChartFolderIcon}} {{$sNotesIcon}} <br /> {{$sTransferIcon}} {{$sBillIcon}} {{$sDischargeIcon}}</td>
	</tr>
	<tr>
		<td colspan="8" class="thinrow_vspacer">{{$sOnePixel}}</td>
	</tr>
