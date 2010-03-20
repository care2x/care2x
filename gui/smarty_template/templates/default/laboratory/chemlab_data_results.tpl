{{* chemlab_data_results.tpl *}}

<table width="100%" border="0">
  <tbody>
    <tr valign="top">
      <td>
				{{* table block for the patient basic data *}}
				<form method="post" {{$sFormAction}} onSubmit="return pruf(this)" name="datain">
					<table>
					<tbody>
						<tr>
							<td class="adm_item">{{$LDCaseNr}}:</td>
							<td class="adm_input">{{$encounter_nr}}</td>
						</tr>
						<tr>
							<td class="adm_item">{{$LDLastName}}, {{$LDName}}, {{$LDBday}}:</td>
							<td class="adm_input"><b>{{$sLastName}}, {{$sName}} {{$sBday}}</b></td>
						</tr>
						<tr>
							<td class="adm_item">{{$LDJobIdNr}}:</td>
							<td class="adm_input">{{$sJobIdNr}}</td>
						</tr>
						<tr>
							<td class="adm_item">{{$LDExamDate}}:</td>
							<td class="adm_input">{{$sExamDate}} {{$sMiniCalendar}}</td>
						</tr>
					</tbody>
					</table>
				
					<table cellspacing=1 cellpadding=1 width="100%"  bgcolor=#ffdddd >
					<tbody>
						<tr>
							<td colspan="2" style="color: white; background-color: red; font-weight: bold;">{{$sParamGroup}}</td>
						</tr>
						<tr>
							<td colspan="2">
							
								{{* Table block for the parameters *}}
								<table cellpadding=0 cellspacing=1>
								<tbody>
									{{* Rows of parameters *}}
									{{$sParameters}}
								</tbody>
								</table>

							</td>
						</tr>
						<tr>
							<td>{{$pbSave}}</td>
							<td align="right">{{$pbShowReport}} {{$pbCancel}}</td>
						</tr>
					</tbody>
					</table>
					{{$sSaveParamHiddenInputs}}
					{{$sSelectGroupHiddenInputs}}
				</form>
				
				{{* Block for parameter group select box *}}
<!--				<form {{$sFormAction}} method=post onSubmit="return chkselect(this)" name="paramselect">
					<table>
					<tbody>
						<tr>
							<td colspan="3"><b>{{$LDSelectParamGroup}}</b></td>
						</tr>
						<tr>
							<td>{{$LDParamGroup}}</td>
							<td>{{$sParamGroupSelect}}</td>
							<td>{{$sSubmitSelect}}</td>
						</tr>
					</tbody>
					</table>
					{{$sSelectGroupHiddenInputs}}
				</form> -->

	  </td>
      <td width="20%">
				{{* Table block for the help links *}}
				<table class="submenu3_body">
				<tbody>
					<tr>
						<td>{{$sAskIcon}}</td>
						<td>{{$LDParamNoSee}}</td>
					</tr>
					<tr>
						<td>{{$sAskIcon}}</td>
						<td>{{$LDOnlyPair}}</td>
					</tr>
					<tr>
						<td>{{$sAskIcon}}</td>
						<td>{{$LDHow2Save}}</td>
					</tr>
					<tr>
						<td>{{$sAskIcon}}</td>
						<td>{{$LDWrongValueHow}}</td>
					</tr>
					<tr>
						<td>{{$sAskIcon}}</td>
						<td>{{$LDVal2Note}}</td>
					</tr>
					<tr>
						<td>{{$sAskIcon}}</td>
						<td>{{$LDImDone}}</td>
					</tr>
				</tbody>
			</table>
	  </td>
    </tr>
  </tbody>
</table>