{{* Smarty 2.6.0 Template - pathology.tpl 06.05.2004 Elpidio Latorilla *}}
{{* Definition :  "pb.."  alias for a GUI pushbutton-element *}}
{{*            :  "gif.." alias for a GIF element like "src=xxx.gif" *}}
{{*            :  "tbl.." alias for a <TABLE> .. </TABLE> element *}}
{{*            :  "input.." alias for a <INPUT> .. </INPUT> element *}}
{{*            :  "val.." alias for a value attribute of an <INPUT> .. </INPUT> element *}}

<table   cellpadding="0" cellspacing=1 border="0" width=700>

	<!-- Header row for patient label, dept. info and identifiers -->

	<tr  valign="top" bgcolor="{{$bgc1}}">
	<td>
		{{if $edit || $printmode || $read_form}}
			{{$barcode_label_single_large}}
		{{else}}
			{{if $show_searchmask}}
				{{$searchmask}}
			{{/if}}
		{{/if}}
	</td>

	<td class=fva2_ml10><div class="fva2_ml10">

		<table border=0  cellpadding=0 cellspacing=0 width=100%>

			<tr>
			<td rowspan=9 align="left" valign="top"><font size=5 color="#0000ff"><b>{{$formtitle}}</b></font><br>
				<font size=1 color="#000099">{{$LDTel}}
			</td>
			<td class="fvag_ml10" align="right"></td>
			<td>
				<img src="../gui/img/common/default/pixel.gif" border=0 width=50 height=2>
			</td>
			</tr>

			<tr>
			<td class="fvag_ml10" align="right">{{$LDEntryDate}} &nbsp;{{$miniCalendar}}</td>
			<td class=fva0_ml10>{{$entry_date}}</td>
			</tr>

			<tr>
			<td class="fvag_ml10" align="right">{{$LDJournalNumber}} &nbsp;</td>
			<td>	{{$val_journal_nr}}</td>
			</tr>

			<tr>
			<td class="fvag_ml10" align="right">{{$LDBlockNumber}} &nbsp;</td>
			<td>{{$val_blocks_nr}}</td>
			</tr>

			<tr>
			<td class="fvag_ml10" align="right">{{$LDDeepCuts}} &nbsp;</td>
			<td>{{$val_deep_cuts}}</td>
			</tr>

			<tr>
			<td class="fvag_ml10" align="right">{{$LDSpecialDye}} &nbsp;</td>
			<td>{{$val_special_dye}}	</td>
			</tr>

			<tr>
			<td class="fvag_ml10" align="right">{{$LDImmuneHistoChem}} &nbsp;</td>
			<td>{{$val_immune_histochem}}</td>
			</tr>

			<tr>
			<td class="fvag_ml10" align="right">{{$LDHormoneReceptors}} &nbsp;</td>
			<td>{{$val_hormone_receptors}}</td>
			</tr>

			<tr>
			<td class="fvag_ml10" align="right">{{$LDSpecials}} &nbsp;</td>
			<td>{{$val_specials}}</td>
			</tr>

		</table>

		</div>
	</td>
	</tr>

	<!-- Second row block for batch barcode, express flags, tel nrs.  -->
	
	<tr bgcolor="{{$bgc1}}">
	<td  valign="top" colspan=2><font color="#000099">

		<table border=0 cellspacing=0 cellpadding=0 width=100%>
		
			<tr>
			<td><div class=fva0_ml10>{{$input_quick_cut}} <b>{{$LDSpeedCut}}</b></td>
			<td><div class=fva0_ml10>{{$LDRelayResult}}&nbsp;
				{{if $edit}} <input type="text" name="qc_phone" size=20 maxlength=25  value="{{$input_qc_phone}}">
				{{else}} {{$val_qc_phone}}
				{{/if}}
			</td>
			<td rowspan=2 align="right" >
				<font size=1 color="#000099" face="verdana,arial">{{$batch_nr}}</font>&nbsp;&nbsp;<br>
				{{$gifBatchBarcode}}&nbsp;&nbsp;
			</td>
			</tr>
		
			<tr>
			<td><div class=fva0_ml10>{{$input_quick_diagnosis}} <b>{{$LDSpeedTest}}</b> </td>
			<td><div class=fva0_ml10>{{$LDRelayResult}}&nbsp;
				{{if $edit}}<input type="text" name="qd_phone" size=20 maxlength=25  value="{{$input_qd_phone}}">
				{{else}} {{$val_qd_phone}}
				{{/if}}
			</td>
			</tr>
	
		</table>
	
	</td>
<!-- 
	<td  valign=top><div class=fva0_ml10><font color="#000099">
		{{$LDSpecialNotice}}:<br>
		<input type="text" name="specials" size=55 maxlength=60>

	</div>
	</td>
-->
	</tr>

<!-- Lower block for the main request information -->

	<tr bgcolor="{{$bgc1}}">
	<td valign=top>
		<div class=fva2_ml10><p><br>
		<b>{{$LDMatType}}:</b><br>
		{{$input_material_type_pe}} {{$LDPE}}<br>
		{{$input_material_type_op_specimen}} {{$LDSpecimen}}<br>
		{{$input_material_type_shave}} {{$LDShave}}<br>
		{{$input_material_type_cytology}} {{$LDCytology}}<br>
	</td>
	<td><div class=fva0_ml10>
		{{if $edit}}	<textarea name="material_desc" cols=46 rows=8 wrap="physical">{{$val_material_desc}}</textarea>
		{{else}} {{$val_material_desc}}
		{{/if}}
	</td>
	</tr>
	
	<tr bgcolor="{{$bgc1}}">
	<td  valign="top" colspan=2><div class="fva0_ml10"><font color="#000099">
		<b>{{$LDLocalization}}<b><br>
		{{if $edit}}<textarea name="localization" cols=82 rows=2 wrap="physical">{{$val_localization}}</textarea>
		{{else}} {{$gifVSpacer}} {{$val_localization}}
		{{/if}}
  	</div>
	</td>
	</tr>

	<tr bgcolor="{{$bgc1}}">
	<td  valign="top" colspan=2 ><div class=fva0_ml10><font color="#000099">
		<b>{{$LDClinicalQuestions}}</b><br>
		{{if $edit}}<textarea name="clinical_note" cols=82 rows=2 wrap="physical">{{$val_clinical_note}}</textarea>
		{{else}} {{$gifVSpacer}} {{$val_clinical_note}}
		{{/if}}
	</div>
	</td>
	</tr>

	<tr bgcolor="{{$bgc1}}">
		<td  valign="top" colspan=2 ><div class=fva0_ml10><font color="#000099">
		<b>{{$LDExtraInfo}}</b><font size=1 face="arial"> {{$LDExtraInfoSample}}<br>
		{{if $edit}}<textarea name="extra_note" cols=82 rows=2 wrap="physical">{{$val_extra_note}}</textarea>
		{{else}} {{$gifVSpacer}} {{$val_extra_note}}
		{{/if}}
	</div></td>
	</tr>

	<tr bgcolor="{{$bgc1}}">
		<td  valign="top" colspan=2 ><div class=fva0_ml10><font color="#000099">
		<b>{{$LDRepeatedTest}}</b><font size=1 face="arial"> {{$LDRepeatedTestPls}}<br>
		{{if $edit}}<input type="text" name="repeat_note" size=95 maxlength=100 value="{{$val_repeat_note}}">
		{{else}} {{$gifVSpacer}} {{$val_clinical_note}}
		{{/if}}
	</div></td>
	</tr>

	<tr bgcolor="{{$bgc1}}">
		<td  valign="top" colspan=2 ><div class=fva0_ml10><font color="#000099">
		<b>{{$LDForGynTests}}</b>

		<table border=0 cellpadding=1 cellspacing=1 width=100%>
			<tr>
			<td align="right"><div class=fva0_ml10>{{$LDLastPeriod}}</td>
			<td>
				{{if $edit}}<input type="text" name="gyn_last_period" size=15 maxlength=25 value="{{$val_gyn_last_period}}">
				{{else}} {{$val_gyn_last_period}}
				{{/if}}
			</td>
			<td align="right"><div class=fva0_ml10>{{$LDMenopauseSince}}</td>
			<td>
				{{if $edit}}<input type="text" name="gyn_menopause_since" size=15 maxlength=25 value="{{$val_gyn_menopause_since}}">
				{{else}} {{$val_gyn_menopause_since}}
				{{/if}}
			</td>
			<td align="right"><div class=fva0_ml10>{{$LDHormoneTherapy}}</td>
			<td>
				{{if $edit}}<input type="text" name="gyn_hormone_therapy" size=15 maxlength=25 value="{{$val_gyn_hormone_therapy}}">&nbsp;
				{{else}} {{$val_gyn_hormone_therapy}}
				{{/if}}
			</td>
			</tr>
		
			<tr>
			<td align="right"><div class=fva0_ml10>{{$LDPeriodType}}</td>
			<td>
				{{if $edit}}<input type="text" name="gyn_period_type" size=15 maxlength=25 value="{{$val_gyn_period_type}}">
				{{else}} {{$val_gyn_period_type}}
				{{/if}}
			</td>
			<td align="right"><div class=fva0_ml10>{{$LDHysterectomy}}</td>
			<td>
				{{if $edit}}<input type="text" name="gyn_hysterectomy" size=15 maxlength=25 value="{{$val_gyn_hysterectomy}}">
				{{else}} {{$val_gyn_hysterectomy}}
				{{/if}}
			</td>
			<td align="right"><div class=fva0_ml10>{{$LDIUD}}</td>
			<td>
				{{if $edit}}<input type="text" name="gyn_iud" size=15 maxlength=25 value="{{$val_gyn_iud}}">&nbsp;
				{{else}} {{$val_gyn_iud}}
				{{/if}}
			</td>
			</tr>
			<tr>
			<td align="right"><div class=fva0_ml10>{{$LDGravidity}}</td>
			<td>
				{{if $edit}}<input type="text" name="gyn_gravida" size=15 maxlength=25 value="{{$val_gyn_gravida}}">
				{{else}} {{$val_gyn_gravida}}
				{{/if}}
			</td>
			<td align="right"><div class=fva0_ml10>{{$LDContraceptive}}</td>
			<td>
				{{if $edit}}<input type="text" name="gyn_contraceptive" size=15 maxlength=25 value="{{$val_gyn_contraceptive}}">
				{{else}} {{$val_gyn_contraceptive}}
				{{/if}}
			</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			</tr>
		</table>

	</div>
	</td>
	</tr>

	<tr bgcolor="{{$bgc1}}">
	<td ><div class=fva2_ml10><font color="#000099">
		 {{$LDOpDate}}:<br>
		{{$inputOpDate}} {{$gifOpCalendar}}
	</div>
	</td>
	<td align="right"><div class=fva2_ml10><font color="#000099">
		{{$LDDoctor}}/{{$LDDept}}:
		{{if $edit}}<input type="text" name="doctor_sign" size=40 maxlength=60 value="{{$val_doctor_sign}}">
		{{else}} {{$val_doctor_sign}}
		{{/if}}
	</div>
	</td>
	</tr>
</table>
