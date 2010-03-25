<table width="100%" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td>{{include file="registration_admission/reg_tabs.tpl"}}</td>
    </tr>

    <tr>
      <td>
			<table cellspacing="0" cellpadding="0" width=800>
			<tbody>
				<tr valign="top">
					<td>{{$sRegForm}}</td>
					<td>{{$sRegOptions}}</td>
				</tr>
			</tbody>
			</table>
	  </td>
    </tr>
    
	<tr>
      <td valign="top">
	  {{$pbNewSearch}} {{$pbUpdateData}} {{$pbShowAdmData}} {{$pbAdmitInpatient}} {{$pbAdmitOutpatient}} {{$pbAdmitPrintout}} {{$pbRegNewPerson}}
	</td>
    </tr>

    <tr>
      <td>
		{{$sSearchLink}}
		<br>
		{{$sArchiveLink}}
		<p>
		{{$pbCancel}}
	</td>
    </tr>

  </tbody>
</table>
