{{* Template for displaying basic data of patient/person *}}
{{* Used by /nursing/nursing-station-assignwaiting.php *}}

		<table border="0" cellspacing=1 cellpadding=0 width="100%">

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
						{{$LDTitle}} {{$LDLastName}}, {{$LDFirstName}}:
					</td>
					<td {{$sClassInput}}>
						{{$title}} <font  class="vi_data">{{$name_last}}, {{$name_first}}</font>
					</td>
				</tr>

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
					<td {{$sClassInput}}>
						{{$blood_group}}
					</td>
				</tr>
			{{/if}}

				<tr>
					<td {{$sClassItem}}>
						{{$LDBillType}}:
					</td>
					<td {{$sClassInput}}>
						{{$billing_type}}
					</td>
				</tr>

				<tr>
					<td {{$sClassItem}}>
						{{$LDDiagnosis}}:
					</td>
					<td {{$sClassInput}} colspan="2">
						{{$referrer_diagnosis}}
					</td>
				</tr>
				
				<tr>
					<td {{$sClassItem}}>
						{{$LDTherapy}}:
					</td>
					<td {{$sClassInput}} colspan="2">
						{{$referrer_recom_therapy}}
					</td>
				</tr>
				
				<tr>
					<td {{$sClassItem}}>
						{{$LDSpecials}}:
					</td>
					<td {{$sClassInput}} colspan="2">
						{{$referrer_notes}}
					</td>
				</tr>

		</table>
