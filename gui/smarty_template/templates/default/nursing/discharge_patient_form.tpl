{{* discharge_patient_form.tpl : Discharge form 2004-06-12 Elpidio Latorilla *}}
{{* Note: never rename the input when redimensioning or repositioning it *}}

<ul>

<div class="prompt">{{$sPrompt}}</div>

<form action="{{$thisfile}}" name="discform" method="post" onSubmit="return pruf(this)">

	<table border=0 cellspacing="1">
		<tr>
			<td colspan=2 class="adm_input">
				{{$sBarcodeLabel}} {{$img_source}}
			</td>
		</tr>
		<tr>
			<td class="adm_item">{{$LDLocation}}:</td>
			<td class="adm_input">{{$sLocation}}</td>
		</tr>
			<td class="adm_item">{{$LDDate}}:</td>
			<td class="adm_input">
				{{if $released}}
					{{$x_date}}
				{{else}}
					{{$sDateInput}} {{$sDateMiniCalendar}}
				{{/if}}
			</td>
		</tr>
		<tr>
			<td class="adm_item">{{$LDClockTime}}:</td>
			<td class="adm_input">
				{{if $released}}
					{{$x_time}}
				{{else}}
					{{$sTimeInput}}
				{{/if}}
			</td>
		</tr>
		<tr>
			<td class="adm_item">{{$LDReleaseType}}:</td>
			<td class="adm_input">
				{{$sDischargeTypes}}
			</td>
		</tr>
		<tr>
			<td class="adm_item">{{$LDNotes}}:</td>
			<td class="adm_input">
				{{if $released}}
					{{$info}}
				{{else}}
					<textarea name="info" cols=40 rows=3></textarea>
				{{/if}}
			</td>
		</tr>
		<tr>
			<td class="adm_item">{{$LDNurse}}:</td>
			<td class="adm_input">
				{{if $released}}
					{{$encoder}}
				{{else}}
					<input type="text" name="encoder" size=25 maxlength=30 value="{{$encoder}}">
				{{/if}}
			</td>
		</tr>

	{{if $bShowValidator}}
		<tr>
			<td class="adm_item">{{$pbSubmit}}</td>
			<td class="adm_input">{{$sValidatorCheckBox}} {{$LDYesSure}}</td>
		</tr>
	{{/if}}
	
	</table>

	{{$sHiddenInputs}}

</form>

{{$pbCancel}}

</ul>
