<blockquote>

&nbsp;<br>

<TABLE cellSpacing=0 cellPadding=0 border=0 class="submenu_frame">
	<TBODY>
	<TR>
		<TD>
			<TABLE cellSpacing=1 cellPadding=3>
 				<TBODY class="submenu">
					{{if $sSubMenuRows}}
						{{$sSubMenuRows}}
					{{/if}}

					{{if $sSubMenuRowsIncludeFile}}
						{{include file=$sSubMenuRowsIncludeFile}}
					{{/if}}
				</TBODY>
			</TABLE>
		</TD>
	</TR>
	</TBODY>
</TABLE>
<p>
<a href="{{$breakfile}}"><img {{$gifClose2}} alt="{{$LDCloseAlt}}" {{$dhtml}}></a>
</blockquote>
