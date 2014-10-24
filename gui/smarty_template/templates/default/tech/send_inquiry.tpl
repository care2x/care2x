{{* Repair report input form. send_request.tpl 2004-06-12 Elpidio Latorilla *}}
{{* Note: never rename the input, when redimensioning or repositioning it  *}}

<ul>

{{if $bShowInquiry}}
	{{include file="tech/show_inquiry.tpl"}}
{{/if}}

<table cellpadding="5"  border="0" cellspacing=1 width=100%>
	<tr valign=top>
		<td>

			<div class="prompt">{{$sButton}} {{$LDQuestions}}<br><font size="1">{{$LDPlsNoRequest}}</font></div>

			{{$sFormTag}}
			<table cellpadding="5"  border="0" cellspacing=1>
				<tr>
					<td bgcolor=#dddddd >
						{{$LDEnterQuestion}}:<br>
						{{* Note: never rename the input, when redimensioning or repositioning it  *}}
						<TEXTAREA NAME="query" Content-Type="text/html" COLS="50" ROWS="10"></TEXTAREA>
					</td>
				</tr>
				<tr>
					<td bgcolor=#dddddd >
						{{* Note: never rename the input, when redimensioning or repositioning it  *}}
						{{$LDName}}:<br><input type="text" name="inquirer" size="30"  value="{{$sInquirer}}"> <br>
						{{$LDDept}}:<br><input type="text" name="dept" size="30" value="{{$dept_name}}">
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
			{{$sButton}}  {{$sReportLink}}<br>

		</td>

		<td align="center">
			{{include file="tech/inquiry_listbox.tpl"}}
		</td>
	</tr>
</table>
</ul>