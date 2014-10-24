{{* Department headline page encapsulating frame *}}

{{if $bShowPrompt}}
<table>
	<tr>
		<td>{{$sMascotImg}}</td>
		<td  class="prompt">
			{{$LDArticleSaved}}
			<hr>
		</td>
	</tr>
</table>
{{/if}}

<TABLE CELLSPACING=3 cellpadding=0 border="0" width="{{$news_normal_display_width}}">
	<tr>
		<td VALIGN="top">

			{{include file="news/headline_newslist_item.tpl"}}
			<p>
			{{$sBackLink}}

		</td>
	</tr>
</table>