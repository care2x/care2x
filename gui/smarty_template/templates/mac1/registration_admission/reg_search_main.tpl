{{* reg_search_main.tpl  Mainframe for patient/person registration search page *}}

<div align="center">
{{$sPretext}}

{{* Never remove the ff: 2 tags from this template *}}
{{$sJSGetHelp}}
{{$LDTipsTricks}}

{{* Never remove the $sJSFormCheck tag from this template *}}
{{$sJSFormCheck}}

<table class="reg_searchmask_border" border=0 cellpadding=10>
	<tr>
		<td>
			<table class="reg_searchmask" cellpadding="5" cellspacing="5">
			<tbody>
				<tr>
					<td>
						<form {{$sFormParams}}>
							&nbsp;
							<br>
							{{$searchprompt}}
							<br>
							{{* Never rename this input. Redimensioning it is allowed. *}}
							<input type="text" name="searchkey" size=40 maxlength=80>
							<p>
							{{$sCheckBoxFirstName}} {{$LDIncludeFirstName}}
							
							{{* Do not move the sHiddenInputs outside the <form> block *}}
							{{$sHiddenInputs}}
						</form>
					</td>
				</tr>
			</tbody>
			</table>
		</td>
	</tr>
</table>
<p>
{{$sCancelButton}}
<p>

{{$LDSearchFound}}

{{if $bShowResult}}
	<p>
	<table border=0 cellpadding=2 cellspacing=1>
		
		{{* This is the title row *}}
		<tr class="reg_list_titlebar">
			<td>{{$LDRegistryNr}}</td>
			<td>{{$LDSex}}</td>
			<td>{{$LDLastName}}</td>
			<td>{{$LDFirstName}}</td>
			<td>{{$LDBday}}</td>
			<td>{{$LDZipCode}}</td>
			<td>&nbsp;{{$LDOptions}}</td>         
		</tr>

		{{* The content of sResultListRows is generated using the reg_search_list_row.tpl template *}}
		{{$sResultListRows}}

		<tr>
			<td colspan=6>{{$sPreviousPage}}</td>
			<td align=right>{{$sNextPage}}</td>
		</tr>
	</table>
{{/if}}

{{$sPostText}}
</div>
