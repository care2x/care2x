	<tr {{$sRowClass}}>
		<td>{{$sDate}}</td>
		<td>{{$sPreview}}</td>
		<td align=center>{{ $sDetails}} {{$sMakePdf}}</td>
		<td>{{$sAuthor}}</td>
	{{if $parent_admit}}
		<td>{{$sEncNr}}</td>
	{{/if}}
	</tr>