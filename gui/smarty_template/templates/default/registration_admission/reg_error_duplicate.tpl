			{{if $error}}
				<tr bgcolor=#ffffee>
					<td colspan=3 class="warnprompt">
					<center>
					{{$sErrorImg}} {{$sErrorText}}
					</center>
					</td>
				</tr>
			{{/if}}
			{{if $errorDupPerson}}
				<tr bgcolor=#ffffee>
					<td colspan=3>
					<center>
						<table border=0>
							<tr>
								<td>{{$sErrorImg}}</td>
								<td class="warnprompt">
									{{$LDPersonDuplicate}} {{$sErrorText}}
								</td>
							</tr>
						</table>
					</center>
					</td>
				</tr>

				<tr>
					<td colspan=3>

						<table border=0 cellspacing=0 cellpadding=1 class="submenu_frame" width=100%>
							<tr>
								<td>
									<table border=0 cellspacing=0 width=100% >
										{{$sDupDataColNameRow}}
										{{$sDupDataRows}}
									</table>
								</td>
							</tr>
						</table>
						<p>
					</td>
				</tr>
			{{/if}}
