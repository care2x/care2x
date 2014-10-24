{{* Repair request input form. repair_request.tpl 2004-06-12 Elpidio Latorilla *}}
{{* Used by /modules/tech/technik-reparatur-anfordern.php *}}
{{* Note: never rename the input, when redimensioning or repositioning it  *}}

<ul>
<div class="prompt">{{$sButton}} {{$LDReRepairTxt}}</div>

{{$sFormTag}}
	<table cellpadding="5"  border="0" cellspacing=1>
		<tr>
			<td bgcolor=#ffffcc valign="top">
				{{$LDRepairArea}}:<br>
				{{* Note: never rename the input, when redimensioning or repositioning it  *}}
				<input name="dept" type="text" value="{{$sArea}}" size="30" maxlength="25">
			</td>

			<td bgcolor=#ffffcc >
				{{$LDReporter}}:<br>
				{{* Note: never rename the input, when redimensioning or repositioning it  *}}
				<input type="text" name="reporter" size="30" value="{{$sUserName}}">
				<br>
				{{$LDPersonnelNr}}:<br>
				{{* Note: never rename the input, when redimensioning or repositioning it  *}}
				<input type="text" name="id" size="30" value=""><br>
				{{$LDPhoneNr}}:<br>
				{{* Note: never rename the input, when redimensioning or repositioning it  *}}
				<input type="text" name="tphone" size="30" value="{{$sThisPhoneNr}}">
			</td>
		</tr>
		<tr>
			<td colspan=2 bgcolor=#ffffcc ><FONT    SIZE=-1  FACE="Arial">
				{{$LDPlsDescribe}}:<br>
				{{* Note: never rename the input, when redimensioning or repositioning it  *}}
				<TEXTAREA NAME="job" Content-Type="text/html" COLS="60" ROWS="10"></TEXTAREA>
			</td>
		</tr>
</table>
<p>
{{$sHiddenInputs}}
&nbsp;
<p>
{{$pbSubmit}} {{$pbCancel}}
</form>

<p>
{{$sButton}}  {{$sReportLink}}<br>
{{$sButton}}  {{$sQuestionLink}}<br>

</ul>