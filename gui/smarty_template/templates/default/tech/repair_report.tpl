{{* Repair report input form. repair_report.tpl 2004-06-12 Elpidio Latorilla *}}
{{* Used by /modules/tech/technik-reparatur-melden.php *}}
{{* Note: never rename the input, when redimensioning or repositioning it  *}}

<ul>
<div class="prompt">{{$sButton}} {{$LDRepairReport}} <font size="2">{{$LDPlsDoneOnly}}</font></div>

{{$sFormTag}}
	<table cellpadding="5"  border="0" cellspacing=1>
		<tr>
			<td bgcolor=#dddddd >
				{{$LDRepairArea}}:<br>
				{{* Note: never rename the input, when redimensioning or repositioning it  *}}
				<input type="text" name="dept" size=30 maxlength=30><p>
				{{$LDJobIdNr}}:<br>
				{{* Note: never rename the input, when redimensioning or repositioning it  *}}
				<input type="text" name="job_id" size=30 maxlength=14><br>
			</td>

			<td bgcolor=#dddddd >
				{{$LDTechnician}}:<br>
				{{* Note: never rename the input, when redimensioning or repositioning it  *}}
				<input type="text" name="reporter" size=30 ><p>
				{{$LDPersonnelNr}}:<br>
				{{* Note: never rename the input, when redimensioning or repositioning it  *}}
				<input type="text" name="id" size=30>
			</td>
		</tr>
		
		<tr>
			<td colspan=2 bgcolor=#dddddd >
				{{$LDPlsTypeReport}}<br>
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
{{$sButton}}  {{$sRepairLink}}<br>
{{$sButton}}  {{$sQuestionLink}}<br>

</ul>