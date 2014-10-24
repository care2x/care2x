{{* duty_plan_entry_row.tpl  Plan inputs row. 2004-06-26 Elpidio Latorilla *}}
{{* $iDayNr = Day calendar nr *}}
{{* $LDShorDay = Short day's name *}}
{{* $sIcon1 = decorative icon of the first duty *}}
{{* $sInput1 = input element of the first duty *}}
{{* $sIcon1 = decorative icon of the first duty *}}
{{* $sPopWin1 = link to pop the personnel list for duty 1 *}}
{{* $sIcon2 = decorative icon of the 2nd duty *}}
{{* $sInput2 = input element of the 2nd duty *}}
{{* $sPopWin2 = link to pop the personnel list for duty 2 *}}

<tr {{$sRowClass}}>
	<td>{{$iDayNr}}</td>
	<td>{{$LDShortDay}}</td>
	<td><nobr>{{$sIcon1}}&nbsp{{$sInput1}}</nobr></td>
	<td>{{$sPopWin1}}</td>
	<td><nobr>{{$sIcon2}}&nbsp{{$sInput2}}</nobr></td>
	<td>{{$sPopWin2}}</td>
</tr>