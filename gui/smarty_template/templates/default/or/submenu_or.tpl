			<blockquote>
		 	<div class="prompt">{{$LDOrDocs}}</div>
			<TABLE cellSpacing=0  width=600 class="submenu_frame" cellpadding="0">
			<TBODY>
			<TR>
				<TD>
					<TABLE cellSpacing=1 cellPadding=3 width=600>
					<TBODY class="submenu">

						<TR>
							<TD class="submenu_item" width=35%>{{$LDOrDocument}}</TD>
							<TD>{{$LDOrDocumentTxt}}</TD>
						</tr>
						{{include file="common/submenu_row_spacer.tpl"}}

						<TR>
							<TD class="submenu_item" width=35%>{{$LDQviewDocs}}</TD>
							<TD>{{$LDQviewTxtDocs}}</TD>
						</tr>

					</TBODY>
					</TABLE>
				</TD>
			</TR>
			</TBODY>
			</TABLE>

			<p>
		 	<div class="prompt">{{$LDOrNursing}}</div>
			<TABLE cellSpacing=0  width=600 class="submenu_frame" cellpadding="0">
			<TBODY>
			<TR>
				<TD>
					<TABLE cellSpacing=1 cellPadding=3 width=600>
					<TBODY class="submenu">

						<TR>
							<TD class="submenu_item" width=35%>{{$LDOrLogBook}}</TD>
							<TD>{{$LDOrLogBookTxt}}</TD>
						</tr>
						{{include file="common/submenu_row_spacer.tpl"}}

						<TR>
							<TD class="submenu_item" width=35%>{{$LDORNOCQuickView}}</TD>
							<TD>{{$LDQviewTxtNurse}}</TD>
						</tr>
						{{include file="common/submenu_row_spacer.tpl"}}

						<TR>
							<TD class="submenu_item" width=35%>{{$LDORNOCScheduler}}</TD>
							<TD>{{$LDDutyPlanTxt}}</TD>
						</tr>
						{{include file="common/submenu_row_spacer.tpl"}}

						<TR>
							<TD class="submenu_item" width=35%>{{$LDOnCallDuty}}</TD>
							<TD>{{$LDOnCallDutyTxt}}</TD>
						</tr>

					</TBODY>
					</TABLE>
				</TD>
			</TR>
			</TBODY>
			</TABLE>

			<p>
		 	<div class="prompt">{{$LDORAnesthesia}}</div>
			<TABLE cellSpacing=0  width=600 class="submenu_frame" cellpadding="0">
			<TBODY>
			<TR>
				<TD>
					<TABLE cellSpacing=1 cellPadding=3 width=600>
					<TBODY class="submenu">

						<TR>
							<TD class="submenu_item" width=35%>{{$LDORAnaQuickView}}</TD>
							<TD>{{$LDQviewTxtAna}}</TD>
						</tr>
						{{include file="common/submenu_row_spacer.tpl"}}

						<TR>
							<TD class="submenu_item" width=35%>{{$LDORAnaNOCScheduler}}</TD>
							<TD>{{$LDDutyPlanTxt}}</TD>
						</tr>

					</TBODY>
					</TABLE>
				</TD>
			</TR>
			</TBODY>
			</TABLE>
			
			{{$sOnHoverMenu}}

			<p>
			<a href="{{$breakfile}}"><img {{$gifClose2}} alt="{{$LDCloseAlt}}" {{$dhtml}}></a>
			<p>
			</blockquote>
