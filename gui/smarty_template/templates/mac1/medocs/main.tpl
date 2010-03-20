{{* Frame template of medocs page *}}
{{* Note: this template uses a template from the /registration_admission/ *}}

<table width="100%" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td>{{include file="medocs/tabs.tpl"}}</td>
    </tr>

    <tr>
      <td>

		<table width="700" cellspacing="0" cellpadding="0">
		<tbody>
			<tr>
				<td>
					{{include file="registration_admission/basic_data.tpl"}}
				</td>
			</tr>

			<tr>
				<td>
					{{if $bShowNoRecord}}
						{{include file="registration_admission/common_norecord.tpl"}}
					{{else}}
						{{include file=$sDocsBlockIncludeFile}}
					{{/if}}
	  			</td>
    		</tr>
		</tbody>
		</table>

	  </td>
    </tr>

	<tr>
      <td>
			{{$sNewLinkIcon}} {{$sNewRecLink}}<br>
			{{$sPdfLinkIcon}} {{$sMakePdfLink}}<br>
			{{$sListLinkIcon}} {{$sListRecLink}}<p>
			{{$pbBottomClose}}
	  </td>
    </tr>

  </tbody>
</table>
