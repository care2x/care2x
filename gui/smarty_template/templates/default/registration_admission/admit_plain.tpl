<table width="100%" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td>{{include file="registration_admission/admit_tabs.tpl"}}</td>
    </tr>
    <tr>
      <td>

				{{$sMainDataBlock}}

				{{if $sMainIncludeFile}}
					{{include file=$sMainIncludeFile}}
				{{/if}}

			</td>
    </tr>
  </tbody>
</table>
