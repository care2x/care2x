{{* Smarty Template - mainframe.tpl 2004-06-11 Elpidio Latorilla *}}
{{* This is the main template that frames the main work page *}}

{{config_load file=test.conf section="setup"}}

{{include file="common/header.tpl"}}

<table width=100% border=0 cellspacing=0 height=100%>
<tbody class="main">
{{if not $bHideTitleBar}}
	<tr>
		<td  valign="top" align="middle" height="35">
			{{include file="common/header_topblock.tpl"}}
		</td>
	</tr>
{{/if}}

	<tr>
		<td bgcolor={{$body_bgcolor}} valign=top>              
			<div align="center">

			{{* Note the ff: conditional block must always go together *}}
			{{if $sMainBlockIncludeFile ne ""}}
				{{include file=$sMainBlockIncludeFile}}
			{{/if}}
			{{if $sMainFrameBlockData ne ""}}
				{{$sMainFrameBlockData}}
			{{/if}}
			{{* end of conditional block *}}
			
			</div>
		</td>
	</tr>
	
	{{if $sCopyright}}
	<tr valign=top >
		<td bgcolor={{$bot_bgcolor}}>
			{{if not $bHideCopyright}}
				{{include file="common/copyright.tpl"}}
			{{/if}}
		</td>
	</tr>
	{{/if}}

	</tbody>
 </table>

{{include file="common/footer.tpl"}}
