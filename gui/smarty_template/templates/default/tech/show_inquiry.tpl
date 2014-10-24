{{* Template for showing the inquiry data show_inquiry.tpl 2004-06-12 Elpidio Latorilla *}}

<table cellspacing=0 cellpadding=1 border=0 bgcolor="#999999" >
	<tr>
		<td>
			<table  cellspacing=0 cellpadding=2 >
				<tr class="submenu2_titlebar">
					<td>
						{{$sInquirerData}}
					</td>
				</tr>
				<tr>
					<td class="submenu2_list">
						{{$sInquiry}}
					</td>
				</tr> 

			{{if $bShowAnswer}}
				<tr class="submenu2_titlebar">
					<td>
							<b>{{$sReplyData}}:</b>
					</td>
				</tr>
				<tr class="submenu2_body2">
					<td>
						{{$sReply}}
					</td>
				</tr>'
			{{/if}}

			</table>
		</td>
	</tr>
</table>
<hr>