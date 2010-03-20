{{* Template for medocs (medical diagnosis/therapy record) *}}
{{* Note: the input tags are left here in raw form to give the GUI designer freedom to change  the input dimensions *}}
{{* Note: be very careful not to rename nor change the type of the input  *}}

{{if $bSetAsForm}}
	{{$sDocsJavaScript}}
	<form method="post" name="entryform" onSubmit="return chkForm(this)">
{{/if}}

<table border=0 cellpadding=2 width=100%>
   <tr bgcolor='#f6f6f6'>
     <td>{{$LDExtraInfo}}<br>({{$LDInsurance}})</td>
     <td>

	 	{{if $bSetAsForm}}
			<textarea name='aux_notes' cols=60 rows=2 wrap='physical'></textarea>
		{{else}}
			{{$sExtraInfo}}
		{{/if}}

	 </td>
   </tr>
   <tr bgcolor='#f6f6f6'>
     <td><FONT color=red>*</font>  {{$LDGotMedAdvice}}</td>
     <td>

	 	{{if $bSetAsForm}}
	 		{{$sYesRadio}} {{$LDYes}}
         	{{$sNoRadio}} {{$LDNo}}
		{{else}}
			{{$sYesNo}}
		{{/if}}

         </td>
   </tr>
   <tr bgcolor='#f6f6f6'>
     <td><FONT  color='red'>*</font>  {{$LDDiagnosis}}</td>
     <td>

	 	{{if $bSetAsForm}}
			<textarea name='text_diagnosis' cols=60 rows=8 wrap='physical'></textarea>
		{{else}}
			{{$sDiagnosis}}
		{{/if}}


		</td>
   </tr>
   <tr bgcolor='#f6f6f6'>
     <td><FONT  color='red'>*</font>  {{$LDTherapy}}</td>
		<td>
		
	 	{{if $bSetAsForm}}
			<textarea name='text_therapy' cols=60 rows=8 wrap='physical'></textarea>
		{{else}}
			{{$sTherapy}}
		{{/if}}

		</td>
   </tr>
   <tr bgcolor='#f6f6f6'>
     <td><FONT  color='red'>*</font>  {{$LDDate}}</td>
     <td>
	 
	 	{{if $bSetAsForm}}
			 <input type='text' name='date' size=10 maxlength=10 {{$sDateValidateJs}}>
			{{$sDateMiniCalendar}}
		{{else}}
			{{$sDate}}
		{{/if}}

	 </td>
   </tr>
   <tr bgcolor='#f6f6f6'>
     <td><FONT  color='red'>*</font>  {{$LDBy}} </td>
     <td>

	 	{{if $bSetAsForm}}
	 		<input type='text' name='personell_name' size=50 maxlength=60 value='{{$TP_user_name}}' readonly>
		{{else}}
			{{$sAuthor}}
		{{/if}}

	 </td>
   </tr>
</table>

{{if $bSetAsForm}}
	{{$sHiddenInputs}}
	</form>
{{/if}}
