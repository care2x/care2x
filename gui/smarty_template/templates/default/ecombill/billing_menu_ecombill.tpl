
 <blockquote>
{{$sFormTag}}		 
		<TABLE cellSpacing=0  width=600 class="submenu_frame" cellpadding="0">
		<TBODY>
		<TR>
			<TD>
				<TABLE cellSpacing=1 cellPadding=3 width=600>
				<TBODY class="submenu">
				{{if $LDSelectHospitalServices}}
					{{$LDSelectHospitalServices}}
				
					{{include file="common/submenu_row_spacer.tpl"}}
				
					{{$LDSelectLaboratoryTests}}
				{{/if}}
				{{if $LDViewBill}}
					{{include file="common/submenu_row_spacer.tpl"}}

					{{$LDViewBill}}	
	
					{{include file="common/submenu_row_spacer.tpl"}}
				{{/if}}
				
				{{if $LDViewPayment}}
					{{$LDViewPayment}}
	
					{{include file="common/submenu_row_spacer.tpl"}}
				{{/if}}
				
				{{if $LDGenerateFinalBill}}
					{{$LDGenerateFinalBill}}
				{{/if}}

				{{if $LDPatienthasclearedallthebills}}
					{{$LDPatienthasclearedallthebills}}
				{{/if}}
				</TBODY>
				</TABLE>
			</TD>
		</TR>
		</TBODY>
		</TABLE>
	<p>
	{{$sHiddenInputs}}
	<p>
	</form>
	<p>
	<a href="{{$breakfile}}"><img {{$gifClose2}} alt="{{$LDCloseAlt}}" {{$dhtml}}></a>
	<p>
	</blockquote>
	