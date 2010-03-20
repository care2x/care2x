{{* Cafenews page encapsulating frame *}}

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
		<td VALIGN="top" width="100%" colspan="3">
			<a href="javascript:editcafe()">{{$sBasketImg}}</a> <FONT  SIZE=8 COLOR="#cc6600">{{$sTitle}}</FONT>
		</td>
	</tr>

	<tr>
		<td VALIGN="top" width="100%">
			{{include file=$sCafeNewsIncludeFile}}
			<p>
			{{$sBackLink}}
			</p>
		</td>

		<!--      Vertical spacer column      -->
		<td   width=1  background="../../gui/img/common/biju/vert_reuna_20b.gif">&nbsp;</td>

		<td VALIGN="top">

			<table cellspacing=0 cellpadding=1 border=0 align=right width=100%>
				<tr>
					<td>
						<table  cellspacing=1 cellpadding=2 align=right width=100% class="frame">
							<tr>
								<td align=center colspan=2 class="submenu3_titlebar">
									<b>{{$LDMenuToday}}</b>
								</td>
							</tr>
							<tr>
								<td class="submenu3_body">
									<nobr>{{$sTodaysMenu}}</nobr>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr >
					<td>
						<p><br>
						{{$sAskIcon}} <nobr>{{$sMenuAllLink}}</nobr><br><br>
						{{$sAskIcon}} <nobr>{{$sPricesLink}}</nobr>
						<hr>
						<nobr>{{$sCafeEditorialLink}}</nobr>
					</td>
				</tr>
			</table>

		</td>
	</tr>
</table>
