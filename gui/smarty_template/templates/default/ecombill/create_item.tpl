<ul>
<div class="prompt">{{$FormTitle}}</div>

{{$sFormTag}}
	<table cellpadding="5"  border="0" cellspacing=1>
		<tr>
			<td bgcolor=#dddddd >
				{{$LDName}}:<br>
				<input type="text" name="LabTestName" size=30 maxlength=30><p>
				{{$LDCode}}:<br>
				<input type="text" name="TestCode" size=30 maxlength=14><br>
			</td>

			<td bgcolor=#dddddd >
				{{$LDPriceUnit}}:<br>
				<input type="text" name="LabPrice" size=30 ><p>
				{{$LDEnterValueDiscount}}:<br>
				<input type="text" name="Discount" size=30>
			</td>
		</tr>
	</table>
<p>
{{$sHiddenInputs}}
<p>
{{$pbSubmit}} {{$pbCancel}}
</form>

</ul>