{{* This is the template for each headline item displayed on the headlines list *}}

<img {{$sHeadlineImg}} align="left" border=0 hspace=10 {{$sImgWidth}}>
{{$sHeadlineItemTitle}}

{{if $sPreface}}
	<br>
	{{$sPreface}}
{{/if}}

{{if $sNewsPreview}}
	<p>
	{{$sNewsPreview}}
{{/if}}

<br>
<font size=1>{{$sEditorLink}}</font>
