		 <blockquote>
			<TABLE cellSpacing=0  width=600 class="submenu_frame" cellpadding="0">
			<TBODY>
			<TR>
				<TD>
					<TABLE cellSpacing=1 cellPadding=3 width=600>
					<TBODY class="submenu">

					{{$LDNursingStations}}

					<TR>
						<td colspan=3>
							<table border=0 cellpadding=1 cellspacing=1>
							{{$tblWardInfo}}
							</table>
						</td>
					</TR>

					{{include file="common/submenu_row_spacer.tpl"}}

					{{$LDQuickView}}

					{{include file="common/submenu_row_spacer.tpl"}}

					{{$LDSearchPatient}}

					{{include file="common/submenu_row_spacer.tpl"}}

					{{$LDArchive}}

					{{include file="common/submenu_row_spacer.tpl"}}

					{{$LDStationMan}}

					{{include file="common/submenu_row_spacer.tpl"}}

					{{$LDNursesList}}

					{{include file="common/submenu_row_spacer.tpl"}}

					{{$LDNews}}

					</TBODY>
					</TABLE>
				</TD>
			</TR>
			</TBODY>
			</TABLE>

			<p>
			<a href="{{$breakfile}}"><img {{$gifClose2}} alt="{{$LDCloseAlt}}" {{$dhtml}}></a>
			<p>
			</blockquote>
