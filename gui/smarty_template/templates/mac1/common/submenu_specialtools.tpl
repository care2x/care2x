<blockquote>
<TABLE cellSpacing=0 cellPadding=0 border=0 class="submenu_frame">
	<TBODY>
	<TR>
		<TD>
			<TABLE cellSpacing=1 cellPadding=3>
 				<TBODY class="submenu">
					{{$LDPlugins}}
					{{include file='common/submenu_row_spacer.tpl'}}
					{{$LDBilling}}
					{{include file='common/submenu_row_spacer.tpl'}}
					{{$LDPersonellMngmnt}}
					{{include file='common/submenu_row_spacer.tpl'}}
					{{$LDInsuranceCoMngr}}
					{{include file='common/submenu_row_spacer.tpl'}}
					{{$LDAddressMngr}}
					{{include file='common/submenu_row_spacer.tpl'}}
					{{$LDPhotoLab}}
					{{include file='common/submenu_row_spacer.tpl'}}
					{{$LDWebCam}}
					{{include file='common/submenu_row_spacer.tpl'}}
					{{$LDStandbyDuty}}
					{{include file='common/submenu_row_spacer.tpl'}}
					{{$LDCalendar}}
					{{include file='common/submenu_row_spacer.tpl'}}
					{{$LDNews}}
					{{include file='common/submenu_row_spacer.tpl'}}
					{{$LDCalc}}
					{{include file='common/submenu_row_spacer.tpl'}}

					{{if $bShowClock}}
						{{$LDClock}}
						{{include file='common/submenu_row_spacer.tpl'}}
					{{/if}}

					{{$LDUserConfigOpt}}
					{{include file='common/submenu_row_spacer.tpl'}}
					{{$LDAccessPw}}
					{{include file='common/submenu_row_spacer.tpl'}}
					{{$LDNewsgroup}}

				</TBODY>
			</TABLE>
		</TD>
	</TR>
	</TBODY>
</TABLE>
<p>
<a href="{{$breakfile}}"><img {{$gifClose2}} alt="{{$LDCloseAlt}}" {{$dhtml}}></a>
</blockquote>
