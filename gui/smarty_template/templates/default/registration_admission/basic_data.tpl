{{* Template for displaying basic data of patient/person *}}
{{* Used by /modules/registration_admission/gui_bridge/default/gui_show.php *}}

		<table border="0" cellspacing=1 cellpadding=0 width="100%">

		{{if $is_discharged}}
				<tr>
					<td bgcolor="red" colspan="3">
						&nbsp;
						{{$sWarnIcon}}
						<font color="#ffffff">
						<b>
						{{$sDischarged}}
						</b>
						</font>
					</td>
				</tr>
		{{/if}}

				<tr>
					<td  {{$sClassItem}}>
						{{$LDCaseNr}}
					</td>
					<td {{$sClassInput}}>
						{{$sEncNrPID}}
					</td>
					<td {{$sRowSpan}} align="center" class="photo_id">
						{{$img_source}}
					</td>
				</tr>

				<tr>
					<td {{$sClassItem}}>
						{{$LDTitle}}:
					</td>
					<td {{$sClassInput}}>
						{{$title}}
					</td>
				</tr>

				<tr>
					<td {{$sClassItem}}>
						{{$LDLastName}}:
					</td>
					<td bgcolor="#ffffee" class="vi_data"><b>
						{{$name_last}}</b>
					</td>
				</tr>

				<tr>
					<td {{$sClassItem}}>
						{{$LDFirstName}}:
					</td>
					<td bgcolor="#ffffee" class="vi_data">
						{{$name_first}}
					</td>
				</tr>

			{{if $name_2}}
				<tr>
					<td {{$sClassItem}}>
						{{$LDName2}}:
					</td>
					<td bgcolor="#ffffee">
						{{$name_2}}
					</td>
				</tr>
			{{/if}}

			{{if $name_3}}
				<tr>
					<td {{$sClassItem}}>
						{{$LDName3}}:
					</td>
					<td bgcolor="#ffffee">
						{{$name_3}}
					</td>
				</tr>
			{{/if}}

			{{if $name_middle}}
				<tr>
					<td {{$sClassItem}}>
						{{$LDNameMid}}:
					</td>
					<td bgcolor="#ffffee">
						{{$name_middle}}
					</td>
				</tr>
			{{/if}}

				<tr>
					<td {{$sClassItem}}>
						{{$LDBday}}:
					</td>
					<td bgcolor="#ffffee" class="vi_data">
						{{$sBdayDate}} &nbsp; {{$sCrossImg}} &nbsp; <font color="black">{{$sDeathDate}}</font>
					</td>
				</tr>

				<tr>
					<td {{$sClassItem}}>
						{{$LDSex}}:
					</td>
					<td {{$sClassInput}}>
						{{$sSexType}}
					</td>
				</tr>

			{{if $LDBloodGroup}}
				<tr>
					<td {{$sClassItem}}>
						{{$LDBloodGroup}}:
					</td>
					<td  {{$sClassInput}}>&nbsp;
						{{$blood_group}}
					</td>
				</tr>
			{{/if}}

		</table>