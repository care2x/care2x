{{* Template for admission input and data display *}}
{{* Files using this: *}}
{{* - /modules/registration_admission/aufnahme_start.php *}}
{{* - /modules/registration_admission/aufnahme_daten_zeigen.php *}}

	{{if $bSetAsForm}}
	<form method="post" action="{{$thisfile}}" name="aufnahmeform" onSubmit="return chkform(this)"  ENCTYPE="multipart/form-data">
	{{/if}}
		
		<table border="0" cellspacing=1 cellpadding=0 width="100%">

		{{if $error}}
				<tr>
					<td colspan=4 class="warnprompt">
						<center>
						{{$sMascotImg}}
						{{$LDError}}
						</center>
					</td>
				</tr>
		{{/if}}

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
					<td  class="adm_item">
						{{$LDCaseNr}}
					</td>
					<td class="adm_input">
						{{$encounter_nr}}
						<br>
						{{$sEncBarcode}} {{$sHiddenBarcode}}
					</td>
					<td {{$sRowSpan}} align="center" class="photo_id">
						{{$img_source}}
						<!--  gjergji -->
						<br> 
						{{$sFileBrowserInput}}
						<!--  end : gjergji -->	
					</td>
				</tr>

				<tr>
					<td  class="adm_item">
						{{$LDAdmitDate}}:
					</td>
					<td class="adm_input">
						{{$sAdmitDate}}
					</td>
				</tr>

				<tr>
					<td class="adm_item">
					{{$LDAdmitTime}}:
					</td>
					<td class="adm_input">
						{{$sAdmitTime}}
					</td>
				</tr>

				<tr>
					<td class="adm_item">
						{{$LDTitle}}:
					</td>
					<td class="adm_input">
						{{$title}}
					</td>
				</tr>

				<tr>
					<td class="adm_item">
						{{$LDLastName}}:
					</td>
					<td bgcolor="#ffffee" class="vi_data"><b>
						{{$name_last}}</b>
					</td>
				</tr>

				<tr>
					<td class="adm_item">
						{{$LDFirstName}}:
					</td>
					<td bgcolor="#ffffee" class="vi_data">
						{{$name_first}} &nbsp; {{$sCrossImg}}
					</td>
				</tr>

			{{if $name_2}}
				<tr>
					<td class="adm_item">
						{{$LDName2}}:
					</td>
					<td bgcolor="#ffffee">
						{{$name_2}}
					</td>
				</tr>
			{{/if}}

			{{if $name_3}}
				<tr>
					<td class="adm_item">
						{{$LDName3}}:
					</td>
					<td bgcolor="#ffffee">
						{{$name_3}}
					</td>
				</tr>
			{{/if}}

			{{if $name_middle}}
				<tr>
					<td class="adm_item">
						{{$LDNameMid}}:
					</td>
					<td bgcolor="#ffffee">
						{{$name_middle}}
					</td>
				</tr>
			{{/if}}

				<tr>
					<td class="adm_item">
						{{$LDBday}}:
					</td>
					<td bgcolor="#ffffee" class="vi_data">
						{{$sBdayDate}} &nbsp; {{$sCrossImg}} &nbsp; <font color="black">{{$sDeathDate}}</font>
					</td>
					<td bgcolor="#ffffee">
						{{$LDSex}}: {{$sSexType}}
					</td>
				</tr>

			{{if $LDBloodGroup}}
				<tr>
					<td class="adm_item">
						{{$LDBloodGroup}}:
					</td>
					<td class="adm_input" colspan=2>&nbsp;
						{{$blood_group}}
					</td>
				</tr>
			{{/if}}

				<tr>
					<td class="adm_item">
						{{$LDAddress}}:
					</td>
					<td colspan=2 class="adm_input">
						{{$addr_str}}  {{$addr_str_nr}}
						<br>
						{{$addr_zip}} {{$addr_citytown_name}}
					</td>
				</tr>

				<tr>
					<td class="adm_item">
						<font color="red">{{$LDAdmitShowTypeInput}}</font>:
					</td>
					<td class="adm_input">
						{{$sAdmitShowTypeInput}}
					</td>
					<td class="adm_input">
					{{if $LDShowTriageData}}
						<span class="triageWhite">{{$sAdmitTriageWhite}}</span>
						<span class="triageGreen">{{$sAdmitTriageGreen}}</span>
						<span class="triageYellow">{{$sAdmitTriageYellow}}</span>
						<span class="triageRed">{{$sAdmitTriageRed}}</span>
						{{$sAdmitTriage}}
					{{else}}
						<label class="triageWhite"><input type = 'radio' name ='triage' value='white'>{{$sAdmitTriageWhite}}</label>
						<label class="triageGreen"><input type = 'radio' name ='triage' value='green'>{{$sAdmitTriageGreen}}</label>
						<label class="triageYellow"><input type = 'radio' name ='triage' value='yellow'>{{$sAdmitTriageYellow}}</label>
						<label class="triageRed"><input type = 'radio' name ='triage' value='red'>{{$sAdmitTriageRed}}</label>
					{{/if}}					
					</td>
				</tr>
				<tr>					
					<td class="adm_item">
						<font color="red">{{$LDAdmitClass}}</font>:
					</td>
					<td colspan=2 class="adm_input">
						{{$sAdmitClassInput}}
					</td>
				</tr>
			{{if $LDWard}}
				<tr>
					<td class="adm_item">
						<font color="red">{{$LDWard}}</font>:
					</td>
					<td colspan=2 class="adm_input">
						{{$sWardInput}}
					</td>
				</tr>
			{{/if}}

			{{if $LDDepartment}}
				<tr>
					<td class="adm_item">
						<font color="red">{{$LDDepartment}}</font>:
					</td>
					<td colspan=2 class="adm_input">
						{{$sDeptInput}}
					</td>
				</tr>
			{{/if}}
			
				<tr>
					<td class="adm_item">
						{{$LDDiagnosis}}:
					</td>
					<td colspan=2 class="adm_input">
						{{$referrer_diagnosis}}
					</td>
				</tr>
				<tr>
					<td class="adm_item">
						{{$LDRecBy}}:
					</td>
					<td colspan=2 class="adm_input">
						{{$referrer_dr}}
					</td>
				</tr>
				<tr>
					<td class="adm_item">
						{{$LDTherapy}}:
					</td>
					<td colspan=2 class="adm_input">
						{{ $referrer_recom_therapy}}
					</td>
				</tr>
				<tr>
					<td class="adm_item">
						{{$LDSpecials}}:
					</td>
					<td colspan=2 class="adm_input">
						{{$referrer_notes}}
					</td>
				</tr>

				<!-- The insurance class  -->
				<tr>
					<td class="adm_item">
						{{$LDBillType}}:
					</td>
					<td colspan=2 class="adm_input">
						{{$sBillTypeInput}}
					</td>
				</tr>

				<tr>
					<td class="adm_item">
						{{$LDInsuranceNr}}:
					</td>
					<td colspan=2 class="adm_input">
						{{$insurance_nr}}
					</td>
				</tr>
				<tr>
					<td class="adm_item">
						{{$LDInsuranceCo}}:
					</td>
					<td colspan=2 class="adm_input">
						{{$insurance_firm_name}}
					</td>
				</tr>
			{{if $LDCareServiceClass}}
				<tr>
					<td class="adm_item">
						{{$LDCareServiceClass}}:
					</td>
					<td colspan=2 class="adm_input">
						{{$sCareServiceInput}} {{$LDFrom}} {{$sCSFromInput}} {{$LDTo}} {{$sCSToInput}} {{$sCSHidden}}
					</td>
				</tr>
			{{/if}}

			{{if $LDRoomServiceClass}}
				<tr>
					<td class="adm_item">
						{{$LDRoomServiceClass}}:
					</td>
					<td colspan=2 class="adm_input">
						{{$sCareRoomInput}} {{$LDFrom}} {{$sRSFromInput}} {{$LDTo}} {{$sRSToInput}} {{$sRSHidden}}
					</td>
				</tr>
			{{/if}}
			
			{{if $LDAttDrServiceClass}}
				<tr>
					<td class="adm_item">
						{{$LDAttDrServiceClass}}:
					</td>
					<td colspan=2 class="adm_input">
						{{$sCareDrInput}} {{$LDFrom}} {{$sDSFromInput}} {{$LDTo}} {{$sDSToInput}} {{$sDSHidden}}
					</td>
				</tr>
			{{/if}}

				<tr>
					<td class="adm_item">
						{{$LDAdmitBy}}:
					</td>
					<td colspan=2 class="adm_input">
						{{$encoder}}
					</td>
				</tr>

				{{$sHiddenInputs}}

				<tr>
					<td colspan="3">
						&nbsp;
					</td>
				</tr>
				<tr>
					<td>
						{{$pbSave}}
					</td>
					<td align="right">
						{{$pbRefresh}} {{$pbRegData}}
					</td>
					<td align="right">
						{{$pbCancel}}
					</td>
				</tr>

		</table>
	
			{{$sErrorHidInputs}}
			{{$sUpdateHidInputs}}

	{{if $bSetAsForm}}
	</form>
	{{/if}}

	{{$sNewDataForm}}
	<p>
