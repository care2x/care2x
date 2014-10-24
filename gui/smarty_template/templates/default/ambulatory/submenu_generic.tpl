		<form name="dept_select" method="post" action="">
			<TABLE cellSpacing=0  width=600 class="submenu_frame" cellpadding="0">
			<TBODY>
			<TR>
				<TD>
					<TABLE cellSpacing=1 cellPadding=3 width=600>
					<TBODY class="submenu">

						<TR>
							<td colspan="3" class="submenu_title"  align=left>{{$TP_SELECT_BLOCK}} {{$sTitleIcon}} {{$LDSelectDept}} </td>
						</tr>

						<TR>
							<td align=center>{{$sApptIcon}}</td>
							<TD class="submenu_item"><nobr>{{$TP_HREF_APPT1}}</nobr></TD>
							<TD>{{$LDAppointmentsTxt}}</TD>
						</tr>
						
						<TR>
							<td align=center>{{$sOutPatientIcon}}</td>
							<TD class="submenu_item"><nobr>{{$TP_HREF_PWL1}}</nobr></TD>
							<TD>{{$LDPWListTxt}}</TD>
						</tr>
						
						<TR>
							<td align=center>{{$sPendReqIcon}}</td>
							<TD class="submenu_item"><nobr>{{$TP_HREF_PREQ1}}</nobr></TD>
							<TD>{{$LDPendingRequestTxt}}</TD>
						</tr>
						
						<TR>
							<td align=center>{{$sNewsIcon}}</td>
							<TD class="submenu_item"><nobr>{{$TP_HREF_NEWS1}}</nobr></TD>
							<TD>{{$LDNewsTxt}}</TD>
						</tr>

					</TBODY>
					</TABLE>
				</TD>
			</TR>
			</TBODY>
			</TABLE>
			<!--do not omit  $TP _HINPUTS , must be inside the form tags -->
			{{$TP_HINPUTS}}
			{{$TP_HIDDENS}}
		</form>
