<center>
<div class="prompt">{{$FormTitle}}</div>
<p></p>
<table cellSpacing="1" cellPadding="3" bgColor="#999999" border="0" width="80%">
 <tbody>
	<tr bgColor="#eeeeee">
		<th height="7" align="center" bgcolor="#CCCCCC">{{$LDReceiptNumber}}</th>
		<th align="center" height="7" bgcolor="#CCCCCC">{{$LDReceiptDateTime}}</th>
	</tr>
	
	{{$ItemLine}}

 </tbody>
</table>
<p>
{{$sFormTag}}
{{$sHiddenInputs}}
</form>
<p>
{{$pbCancel}}
</center>
</ul>
