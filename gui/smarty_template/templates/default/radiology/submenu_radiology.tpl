		 <blockquote>
			<TABLE cellSpacing=0  width=600 class="submenu_frame" cellpadding="0">
			<TBODY>
			<TR>
				<TD>
					<TABLE cellSpacing=1 cellPadding=3 width=600>
					<TBODY class="submenu">

					{{$LDTestRequestRadio}}

					{{include file="common/submenu_row_spacer.tpl"}}

					{{$LDTestReception}}

					{{include file="common/submenu_row_spacer.tpl"}}

					{{$LDDicomImages}}

					{{include file="common/submenu_row_spacer.tpl"}}

					{{$LDUploadDicom}}

					{{include file="common/submenu_row_spacer.tpl"}}

					{{$LDSelectViewer}}
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
