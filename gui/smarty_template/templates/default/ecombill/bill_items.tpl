<center>
<div class="prompt">{{$FormTitle}}</div>
<p></p>
{{$sFormTag}}
	<table cellSpacing="1" cellPadding="3" bgColor="#999999" border="0" width="80%">
		<tr bgColor="#eeeeee">
		{{if $itemID}}
			<th height="7" align="center" bgcolor="#CCCCCC"></th>
		{{/if}}
			<th height="7" align="center" bgcolor="#CCCCCC">{{$LDTestName}}</th>
			<th align="center" height="7" bgcolor="#CCCCCC">{{$LDTestCode}}</th>
			<th height="7" align="center" bgcolor="#CCCCCC">{{$LDCostperunit}}</th>
			<th height="7" align="center" valign="middle" bgcolor="#CCCCCC">{{$LDNumberofUnits}}</th>
		</tr>
		
		{{$ItemLine}}
	
	 </tbody>
	</table>
<p>
{{$sHiddenInputs}}
<p>
{{$pbSubmit}} {{$pbCancel}}
</center>
</form>
</ul>