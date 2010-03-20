{{* submenu_tableframe.tpl   Submenu's subframe framing the item rows *}}

<blockquote>

&nbsp;<br>

<TABLE cellSpacing=0 cellPadding=0 border=0 class="submenu_frame">
	<TBODY>
	<TR>
		<TD>
			<TABLE cellSpacing=1 cellPadding=3>
 				<TBODY class="submenu" >
					
					{{* In case of submenus w/o template (e.g plugins), the rows are delivered here as one single html string *}}
					{{if $sSubMenuRows}}
						{{$sSubMenuRows}}
					{{/if}}

					{{* In case of submenus with own template, the template filename is sent here for including *}}
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
