{{* chemlab_data_results_show.tpl  Table display of lab results 2004-06-27 Elpidio Latorilla *}}
{{* Used by /modules/laboratory/labor_datalist_noedit.php *}}

<ul>
	{{include file="laboratory/patient_data_basic.tpl"}}
	<p>
	<button onClick="javascript:prep2submit()">{{$sMakeGraphButton}}</button>
	<button onClick="javascript:openReport()">{{$sOpenReport}}</button>
	</p>
	   <table border=0 class="frame" cellspacing=0 cellpadding=0>
		<tbody>
			<tr>
				<td>
					{{$sLabResultsTable}}
				</td>
			</tr>
		</tbody>
		</table>
	<p>
	<button onClick="javascript:prep2submit()">{{$sMakeGraphButton}}</button> {{$sClose}}
	</p>
</ul>
