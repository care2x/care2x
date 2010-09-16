{{* login_config.tpl   Workstation config page after successful login *}}
{{* Input elements are laid out in raw form to allow redimensioning *}}
{{* NOTE: Redimensioning the input elements is allowed but never rename the input elements *}}

<ul>

<table>
	<tr>
		<td align=right><img {{$gifMascot}} align="absmiddle"></td>
		<td>
			<font class="warnprompt">{{$sPromptText}}</font>
			<br>
			{{$sUserName}}
		</font>
		</td>
	</tr>
</table>

<form {{$sFormParams}}>

	{{* Do not move the ff: table block outside the <form></form> block *}}

	<table cellSpacing=0 cellPadding=0 border=0 class="submenu_frame">
	<tbody>
		<tr>
			<td>
				<table cellSpacing=1 cellPadding=3  border=0>
				<tbody class="submenu">
					<tr class="submenu_title">
						<td colspan="3">{{$LDPcID}}</td>
					</tr>
					<tr>
						<td>{{$sDeptIcon}}</td>
						<td>{{$sDeptSelect}}</td>
						<td>{{$LDDept}}</td>
					</tr>
						<td>&nbsp;</td>
						<TD colSpan=3 class="vspace"><IMG height=1 src="../gui/img/common/default/pixel.gif" width=5></TD>
						<td>&nbsp;</td>
					<tr>
						<td>{{$sWardIcon}}</td>
						<td>{{$sWardSelect}}</td>
						<td>{{$LDWard}}</td>
					</tr>
						<td>&nbsp;</td>
						<TD colSpan=3 class="vspace"><IMG height=1 src="../gui/img/common/default/pixel.gif" width=5></TD>
						<td>&nbsp;</td>
					<tr>
						<td>{{$sWardORIcon}}</td>
						<td><input type="text" name="thispc_room_nr" size=20 maxlength=25 value="{{$sWardORValue}}"></td>
						<td>{{$LDWardOR}}</td>
					</tr>
						<td>&nbsp;</td>
						<TD colSpan=3 class="vspace"><IMG height=1 src="../gui/img/common/default/pixel.gif" width=5></TD>
						<td>&nbsp;</td>
					<tr>
						<td>{{$sPhoneNrIcon}}</td>
						<td><input type="text" name="thispc_phone" size=20 maxlength=25 value="{{$sPhoneNrValue}}"></td>
						<td>{{$LDPhoneNr}}</td>
					</tr>
						<td>&nbsp;</td>
						<TD colSpan=3 class="vspace"><IMG height=1 src="../gui/img/common/default/pixel.gif" width=5></TD>
						<td>&nbsp;</td>
					<tr>
						<td>{{$sIntercomNrIcon}}</td>
						<td><input type="text" name="thispc_intercom" size=20 maxlength=25 value="{{$sIntercomNrValue}}"></td>
						<td>{{$LDIntercomNr}}</td>
					</tr>
						<td>&nbsp;</td>
						<TD colSpan=3 class="vspace"><IMG height=1 src="../gui/img/common/default/pixel.gif" width=5></TD>
						<td>&nbsp;</td>
					<tr>
						<td>{{$sIPAddressIcon}}</td>
						<td>{{$sIPAddress}}</td>
						<td>{{$LDPcIP}}</td>
					</tr>
				</tbody>
				</table>
			</td>
		</tr>
	</tbody>
	</table>
	<p>
	{{* Do not move the following elements outside the <form></form> block *}}

	{{$sHiddenInputs}}
	{{$sSubmitFormButton}} {{$sNoChangeButton}}&nbsp;{{$sCancelButton}}

</form>

</ul>