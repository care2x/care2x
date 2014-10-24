{{* Frame template for displaying admission data *}}
{{* Used by  *}}
{{* Elpidio Latorilla 2004-06-07 *}}

<table width="100%" cellspacing="0" cellpadding="0">
  <tbody>

    <tr>
      <td>{{include file=$sTabsFile}}</td>
    </tr>

    <tr>
      <td>
			<table cellspacing="0" cellpadding="0" width=800>
			<tbody>
				<tr valign="top">
					<td>
						{{include file="registration_admission/basic_data.tpl"}}
						
						{{if $bShowNoRecord}}
							{{include file="registration_admission/common_norecord.tpl"}}
						{{/if}}

						{{$sOptionBlock}}
					
					</td>
					<td>{{$sOptionsMenu}}</td>
				</tr>
			</tbody>
			</table>
	  </td>
    </tr>

	<tr>
      <td valign="top">
	  	{{$sBottomControls}} {{$pbPersonData}} {{$pbAdmitData}} {{$pbMakeBarcode}} {{$pbMakeWristBands}} {{$pbBottomClose}}
	</td>
    </tr>

    <tr>
      <td>
	  	&nbsp;
		<br>
	  	{{$sAdmitLink}}
		<br>
		{{$sSearchLink}}
		<br>
		{{$sArchiveLink}}
	</td>
    </tr>

  </tbody>
</table>
