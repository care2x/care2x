<table width="100%" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td>{{include file="registration_admission/admit_tabs.tpl"}}</td>
    </tr>
	<tr>
      <td>
		{{if $LDPlsSelectPatientFirst}}
		
			<table border=0>
				<tr>
					<td valign="bottom">{{$sSearchPromptImg}}</td>
					<td class="prompt">{{$LDPlsSelectPatientFirst}}</td>
					<td>{{$sMascotImg}}</td>
				</tr>
			</table>

			<table border=0 cellpadding=10 bgcolor="{{$entry_border_bgcolor}}">
				<tr>
					<td>{{$sSearchMask}}</td>
				</tr>
			</table>

			<div class="prompt"><br>
				{{$sWarnIcon}}

				{{$LDRedirectToRegistry}}
			</div>

		{{else}}
			<table border=0 width="650" cellspacing="0" cellpadding="0">
				<tr>
					<td valign="bottom">
						{{include file="registration_admission/admit_form.tpl"}} {{* $sAdmitForm *}}
					</td>
				</tr>
			</table>
		{{/if}}

	  </td>
    </tr>
    <tr>
      <td>
	  	&nbsp;
		<p>
		{{$sSearchLink}}
		<br>
		{{$sArchiveLink}}
		<p>
		{{$pbCancel}}
	</td>
    </tr>
  </tbody>
</table>
