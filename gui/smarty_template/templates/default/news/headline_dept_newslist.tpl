{{* Template for department's headlines page *}}
{{* Used by /modules/news/newscolumns.php *}}

<table width="100%">
  <tbody>
    <tr>
      <td valign="top" width="50%">{{$sNews_1}}</td>
      <td valign="top" width="50%">{{$sNews_2}}</td>
    </tr>
    <tr>
      <td valign="top" width="50%">{{$sNews_3}}</td>
      <td valign="top" width="50%">{{$sNews_4}}</td>
    </tr>
    <tr>
      <td colspan="2">
		
		{{* New archive list or news category #5 block *}}
		
		{{if $bShowArchiveList}}

			{{$subtitle}}
			<table border=0 cellspacing=0 cellpadding=0>
			<tr>
			<td bgcolor=#0>
				<table border=0 cellspacing=1 cellpadding=5>
					<tr bgcolor=#ffffff>
						<td><b>{{$LDArticle}}</b></td>
						<td>&nbsp;</td>
						<td><b>{{$LDWrittenBy}}:</b></td>
						<td><b>{{$LDWrittenOn}}:</b></td>
					</tr>
					{{$sNewsArchiveList}}
				</table>
			</td>
			</tr>
			</table>

		{{/if}}
		
		{{* End of news category #5 block *}}

	  </td>
    </tr>
    <tr>
      <td colspan="2">
		{{$sMainEditorLink}}
	  </td>
    </tr>
  </tbody>
</table>
