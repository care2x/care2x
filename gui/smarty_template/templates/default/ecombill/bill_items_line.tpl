<tr bgcolor="#eeeeee">
	{{if $itemID}}
	<td align="center" height="7">
		<input name="{{$itemName}}" id="{{$itemID}}" value="ON" type="checkbox">
	</td>
	{{/if}}
	<td align="center" height="7">{{$itemName}}</td>
	<td align="center" height="7">{{$itemCode}}</td>
	<td align="center" height="7">{{$itemPrice}}</td>
	<td align="center" height="7">{{$quantity}}</td>
</tr>
