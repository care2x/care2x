{{* appt_list.tpl  Appointment list template 2004-06-13 Elpidio Latorilla *}}

<table width=100% border=0 cellpadding="0" cellspacing=0>
	<tbody>
	<tr>
		<td>
			{{$sMiniCalendar}}
		</td>
		<td>

			<form name="bydept">
				{{$LDListApptByDept}}<br>
				<nobr>
				{{$sByDeptSelect}} {{$pbByDeptGo}}
				</nobr>
				{{* Do not move the $sByDeptHiddenInputs outside of the form *}}
				{{$sByDeptHiddenInputs}}
			</form>
			<br>
			<form name="bydoc">
				{{$LDListApptByDoc}}<br>
				<nobr>
				{{$sByDocSelect}} {{$pbByDocGo}}
				</nobr>
				{{* Do not move the $sByDocHiddenInputs outside of the form *}}
				{{$sByDocHiddenInputs}}
			</form>

		</td>
	</tr>
	<tr>
		<td colspan="2">
			{{if $bShowPrompt}}
				<table>
				<tbody>
					<tr>
						<td>{{$sMascotImg}}</td>
						<td class="warnprompt">{{$sPrompt}}</td>
					</tr>
				</tbody>
				</table>
			{{/if}}
			{{$sApptList}}<p>
			{{$sButton}} {{$sNewApptLink}}<p>
			{{$pbClose}}
		</td>
	</tr>
	</tbody>
</table>