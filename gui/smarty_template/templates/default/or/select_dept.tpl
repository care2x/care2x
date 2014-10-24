{{* or_doc.tpl Template for selecting department. 2004-06-26 Elpidio Latorilla *}}

<ul>
<table border=0>
	<tr>
		<td>
			{{$sMascotImg}}
		</td>

		<td colspan=4 class="prompt">
			<center>
			{{$LDPlsSelectDept}}
			</center>
		</td>
	</tr>
</table>

<table  cellpadding="2" cellspacing=0 border="0">
	{{$sDeptRows}}
</table>

<p>
{{$sBackLink}}
</ul>
<p>