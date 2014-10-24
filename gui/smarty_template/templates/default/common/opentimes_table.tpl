{{* opentimes_table.tpl  Table frame for the business hours and consultations hours. *}}
{{* Used by /modules/news/open_times.php *}}

<ul>
	<table border=0 cellspacing=0 cellpadding=0>
	<tr>
		<td bgcolor=#999999>
			<table border=0 cellspacing=1 cellpadding=5>
			<tr bgcolor=#ffffff>
				<td><b>{{$LDDayTxt}}</b></font></td>
				<td><b>{{$LDOpenHrsTxt}}</b></font></td>
				<td><b>{{$LDChkHrsTxt}}</b></font></td>
			</tr>
			
			{{* The data is generated with the use of the opentimes_row.tpl template *}}
			{{$sOpenTimesRows}}

			</table>
		</td>
	</tr>
	</table>

	<p>
	{{$sBreakFile}}
	<p>
</ul>