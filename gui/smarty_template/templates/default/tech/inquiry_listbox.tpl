{{* Inquiries list box inquiry_listbox.tpl 2004-06-12 Elpidio Latorilla *}}

<form action="technik-questions.php">
	<table cellspacing=0 cellpadding=1 border=0 class="frame" width=20%>
		<tr>
			<td>

				<table  cellspacing=0 cellpadding=2 >
					<tr class="submenu2_titlebar">
						<td align=center>
							<b>{{$LDLastQuestions}}</b>
						</td>
					</tr>
					<tr class="submenu2_list">
						<td>
							{{$sInquiryList}}
						</td>
					</tr>
					<tr class="submenu2_body">
						<td>
							<center>
							{{$LDFrom}}:
							{{$sListboxHiddenInputs}}
							{{$sListboxSubmit}}
							</center>
						</td>
					</tr>
				</table>

			</td>
		</tr>
	</table>
</form>