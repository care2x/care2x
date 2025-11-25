<?php
/* Smarty version 3.1.40, created on 2024-11-05 19:23:16
  from '/home/tim/code/care2x/gui/smarty_template/templates/default/registration_admission/admit_form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_672a70a4204b13_28385857',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8f4443f403b54aa58186cc31087471ddb07fbbda' => 
    array (
      0 => '/home/tim/code/care2x/gui/smarty_template/templates/default/registration_admission/admit_form.tpl',
      1 => 1726137535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_672a70a4204b13_28385857 (Smarty_Internal_Template $_smarty_tpl) {
?>
	<?php if ($_smarty_tpl->tpl_vars['bSetAsForm']->value) {?>
	<form method="post" action="<?php echo $_smarty_tpl->tpl_vars['thisfile']->value;?>
" name="aufnahmeform" onSubmit="return chkform(this)"  ENCTYPE="multipart/form-data">
	<?php }?>

		<table border="0" cellspacing=1 cellpadding=0 width="100%">

		<?php if ($_smarty_tpl->tpl_vars['error']->value) {?>
				<tr>
					<td colspan=4 class="warnprompt">
						<center>
						<?php echo $_smarty_tpl->tpl_vars['sMascotImg']->value;?>

						<?php echo $_smarty_tpl->tpl_vars['LDError']->value;?>

						</center>
					</td>
				</tr>
		<?php }?>

		<?php if ($_smarty_tpl->tpl_vars['is_discharged']->value) {?>
				<tr>
					<td bgcolor="red" colspan="3">
						&nbsp;
						<?php echo $_smarty_tpl->tpl_vars['sWarnIcon']->value;?>

						<font color="#ffffff">
						<b>
						<?php echo $_smarty_tpl->tpl_vars['sDischarged']->value;?>

						</b>
						</font>
					</td>
				</tr>
		<?php }?>

				<tr>
					<td  class="adm_item">
						<?php echo $_smarty_tpl->tpl_vars['LDCaseNr']->value;?>

					</td>
					<td class="adm_input">
						<?php echo $_smarty_tpl->tpl_vars['encounter_nr']->value;?>

						<br>
						<?php echo $_smarty_tpl->tpl_vars['sEncBarcode']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['sHiddenBarcode']->value;?>

					</td>
					<td <?php echo $_smarty_tpl->tpl_vars['sRowSpan']->value;?>
 align="center" class="photo_id">
						<?php echo $_smarty_tpl->tpl_vars['img_source']->value;?>

						<!--  gjergji -->
						<br>
						<?php echo $_smarty_tpl->tpl_vars['sFileBrowserInput']->value;?>

						<!--  end : gjergji -->
					</td>
				</tr>

				<tr>
					<td  class="adm_item">
						<?php echo $_smarty_tpl->tpl_vars['LDAdmitDate']->value;?>
:
					</td>
					<td class="adm_input">
						<?php echo $_smarty_tpl->tpl_vars['sAdmitDate']->value;?>

					</td>
				</tr>

				<tr>
					<td class="adm_item">
					<?php echo $_smarty_tpl->tpl_vars['LDAdmitTime']->value;?>
:
					</td>
					<td class="adm_input">
						<?php echo $_smarty_tpl->tpl_vars['sAdmitTime']->value;?>

					</td>
				</tr>

				<tr>
					<td class="adm_item">
						<?php echo $_smarty_tpl->tpl_vars['LDTitle']->value;?>
:
					</td>
					<td class="adm_input">
						<?php echo $_smarty_tpl->tpl_vars['title']->value;?>

					</td>
				</tr>

				<tr>
					<td class="adm_item">
						<?php echo $_smarty_tpl->tpl_vars['LDLastName']->value;?>
:
					</td>
					<td bgcolor="#ffffee" class="vi_data"><b>
						<?php echo $_smarty_tpl->tpl_vars['name_last']->value;?>
</b>
					</td>
				</tr>

				<tr>
					<td class="adm_item">
						<?php echo $_smarty_tpl->tpl_vars['LDFirstName']->value;?>
:
					</td>
					<td bgcolor="#ffffee" class="vi_data">
						<?php echo $_smarty_tpl->tpl_vars['name_first']->value;?>
 &nbsp; <?php echo $_smarty_tpl->tpl_vars['sCrossImg']->value;?>

					</td>
				</tr>

			<?php if ($_smarty_tpl->tpl_vars['name_2']->value) {?>
				<tr>
					<td class="adm_item">
						<?php echo $_smarty_tpl->tpl_vars['LDName2']->value;?>
:
					</td>
					<td bgcolor="#ffffee">
						<?php echo $_smarty_tpl->tpl_vars['name_2']->value;?>

					</td>
				</tr>
			<?php }?>

			<?php if ($_smarty_tpl->tpl_vars['name_3']->value) {?>
				<tr>
					<td class="adm_item">
						<?php echo $_smarty_tpl->tpl_vars['LDName3']->value;?>
:
					</td>
					<td bgcolor="#ffffee">
						<?php echo $_smarty_tpl->tpl_vars['name_3']->value;?>

					</td>
				</tr>
			<?php }?>

			<?php if ($_smarty_tpl->tpl_vars['name_middle']->value) {?>
				<tr>
					<td class="adm_item">
						<?php echo $_smarty_tpl->tpl_vars['LDNameMid']->value;?>
:
					</td>
					<td bgcolor="#ffffee">
						<?php echo $_smarty_tpl->tpl_vars['name_middle']->value;?>

					</td>
				</tr>
			<?php }?>

				<tr>
					<td class="adm_item">
						<?php echo $_smarty_tpl->tpl_vars['LDBday']->value;?>
:
					</td>
					<td bgcolor="#ffffee" class="vi_data">
						<?php echo $_smarty_tpl->tpl_vars['sBdayDate']->value;?>
 &nbsp; <?php echo $_smarty_tpl->tpl_vars['sCrossImg']->value;?>
 &nbsp; <font color="black"><?php echo $_smarty_tpl->tpl_vars['sDeathDate']->value;?>
</font>
					</td>
					<td bgcolor="#ffffee">
						<?php echo $_smarty_tpl->tpl_vars['LDSex']->value;?>
: <?php echo $_smarty_tpl->tpl_vars['sSexType']->value;?>

					</td>
				</tr>

			<?php if ($_smarty_tpl->tpl_vars['LDBloodGroup']->value) {?>
				<tr>
					<td class="adm_item">
						<?php echo $_smarty_tpl->tpl_vars['LDBloodGroup']->value;?>
:
					</td>
					<td class="adm_input" colspan=2>&nbsp;
						<?php echo $_smarty_tpl->tpl_vars['blood_group']->value;?>

					</td>
				</tr>
			<?php }?>

				<tr>
					<td class="adm_item">
						<?php echo $_smarty_tpl->tpl_vars['LDAddress']->value;?>
:
					</td>
					<td colspan=2 class="adm_input">
						<?php echo $_smarty_tpl->tpl_vars['addr_str']->value;?>
  <?php echo $_smarty_tpl->tpl_vars['addr_str_nr']->value;?>

						<br>
						<?php echo $_smarty_tpl->tpl_vars['addr_zip']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['addr_citytown_name']->value;?>

					</td>
				</tr>

				<tr>
					<td class="adm_item">
						<font color="red"><?php echo $_smarty_tpl->tpl_vars['LDAdmitShowTypeInput']->value;?>
</font>:
					</td>
					<td class="adm_input">
						<?php echo $_smarty_tpl->tpl_vars['sAdmitShowTypeInput']->value;?>

					</td>
					<td class="adm_input">
					<?php if ($_smarty_tpl->tpl_vars['LDShowTriageData']->value) {?>
						<span class="triageWhite"><?php echo $_smarty_tpl->tpl_vars['sAdmitTriageWhite']->value;?>
</span>
						<span class="triageGreen"><?php echo $_smarty_tpl->tpl_vars['sAdmitTriageGreen']->value;?>
</span>
						<span class="triageYellow"><?php echo $_smarty_tpl->tpl_vars['sAdmitTriageYellow']->value;?>
</span>
						<span class="triageRed"><?php echo $_smarty_tpl->tpl_vars['sAdmitTriageRed']->value;?>
</span>
						<?php echo $_smarty_tpl->tpl_vars['sAdmitTriage']->value;?>

					<?php } else { ?>
						<label class="triageWhite"><input type = 'radio' name ='triage' value='white'><?php echo $_smarty_tpl->tpl_vars['sAdmitTriageWhite']->value;?>
</label>
						<label class="triageGreen"><input type = 'radio' name ='triage' value='green'><?php echo $_smarty_tpl->tpl_vars['sAdmitTriageGreen']->value;?>
</label>
						<label class="triageYellow"><input type = 'radio' name ='triage' value='yellow'><?php echo $_smarty_tpl->tpl_vars['sAdmitTriageYellow']->value;?>
</label>
						<label class="triageRed"><input type = 'radio' name ='triage' value='red'><?php echo $_smarty_tpl->tpl_vars['sAdmitTriageRed']->value;?>
</label>
					<?php }?>
					</td>
				</tr>
				<tr>
					<td class="adm_item">
						<font color="red"><?php echo $_smarty_tpl->tpl_vars['LDAdmitClass']->value;?>
</font>:
					</td>
					<td colspan=2 class="adm_input">
						<?php echo $_smarty_tpl->tpl_vars['sAdmitClassInput']->value;?>

					</td>
				</tr>
			<?php if ($_smarty_tpl->tpl_vars['LDWard']->value) {?>
				<tr>
					<td class="adm_item">
						<font color="red"><?php echo $_smarty_tpl->tpl_vars['LDWard']->value;?>
</font>:
					</td>
					<td colspan=2 class="adm_input">
						<?php echo $_smarty_tpl->tpl_vars['sWardInput']->value;?>

					</td>
				</tr>
			<?php }?>

			<?php if ($_smarty_tpl->tpl_vars['LDDepartment']->value) {?>
				<tr>
					<td class="adm_item">
						<font color="red"><?php echo $_smarty_tpl->tpl_vars['LDDepartment']->value;?>
</font>:
					</td>
					<td colspan=2 class="adm_input">
						<?php echo $_smarty_tpl->tpl_vars['sDeptInput']->value;?>

					</td>
				</tr>
			<?php }?>

				<tr>
					<td class="adm_item">
						<?php echo $_smarty_tpl->tpl_vars['LDDiagnosis']->value;?>
:
					</td>
					<td colspan=2 class="adm_input">
						<?php echo $_smarty_tpl->tpl_vars['referrer_diagnosis']->value;?>

					</td>
				</tr>
				<tr>
					<td class="adm_item">
						<?php echo $_smarty_tpl->tpl_vars['LDRecBy']->value;?>
:
					</td>
					<td colspan=2 class="adm_input">
						<?php echo $_smarty_tpl->tpl_vars['referrer_dr']->value;?>

					</td>
				</tr>
				<tr>
					<td class="adm_item">
						<?php echo $_smarty_tpl->tpl_vars['LDTherapy']->value;?>
:
					</td>
					<td colspan=2 class="adm_input">
						<?php echo $_smarty_tpl->tpl_vars['referrer_recom_therapy']->value;?>

					</td>
				</tr>
				<tr>
					<td class="adm_item">
						<?php echo $_smarty_tpl->tpl_vars['LDSpecials']->value;?>
:
					</td>
					<td colspan=2 class="adm_input">
						<?php echo $_smarty_tpl->tpl_vars['referrer_notes']->value;?>

					</td>
				</tr>

				<!-- The insurance class  -->
			<?php if ($_smarty_tpl->tpl_vars['LDBillingClass']->value) {?>
				<tr>
					<td class="adm_item">
						<?php echo $_smarty_tpl->tpl_vars['LDBillType']->value;?>
:
					</td>
					<td colspan=2 class="adm_input">
						<?php echo $_smarty_tpl->tpl_vars['sBillTypeInput']->value;?>

					</td>
				</tr>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['LDInsuranceCompany']->value) {?>
				<tr>
					<td class="adm_item">
						<?php echo $_smarty_tpl->tpl_vars['LDInsuranceNr']->value;?>

					</td>
					<td colspan=2 class="adm_input">
						<?php echo $_smarty_tpl->tpl_vars['insurance_nr']->value;?>

					</td>
				</tr>
				<tr>
					<td class="adm_item">
						<?php echo $_smarty_tpl->tpl_vars['LDInsuranceCo']->value;?>

					</td>
					<td colspan=2 class="adm_input">
						<?php echo $_smarty_tpl->tpl_vars['insurance_firm_name']->value;?>

					</td>
				</tr>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['LDCareServiceClass']->value) {?>
				<tr>
					<td class="adm_item">
						<?php echo $_smarty_tpl->tpl_vars['LDCareServiceClass']->value;?>
:
					</td>
					<td colspan=2 class="adm_input">
						<?php echo $_smarty_tpl->tpl_vars['sCareServiceInput']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['LDFrom']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['sCSFromInput']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['LDTo']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['sCSToInput']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['sCSHidden']->value;?>

					</td>
				</tr>
			<?php }?>

			<?php if ($_smarty_tpl->tpl_vars['LDRoomServiceClass']->value) {?>
				<tr>
					<td class="adm_item">
						<?php echo $_smarty_tpl->tpl_vars['LDRoomServiceClass']->value;?>
:
					</td>
					<td colspan=2 class="adm_input">
						<?php echo $_smarty_tpl->tpl_vars['sCareRoomInput']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['LDFrom']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['sRSFromInput']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['LDTo']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['sRSToInput']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['sRSHidden']->value;?>

					</td>
				</tr>
			<?php }?>

			<?php if ($_smarty_tpl->tpl_vars['LDAttDrServiceClass']->value) {?>
				<tr>
					<td class="adm_item">
						<?php echo $_smarty_tpl->tpl_vars['LDAttDrServiceClass']->value;?>
:
					</td>
					<td colspan=2 class="adm_input">
						<?php echo $_smarty_tpl->tpl_vars['sCareDrInput']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['LDFrom']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['sDSFromInput']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['LDTo']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['sDSToInput']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['sDSHidden']->value;?>

					</td>
				</tr>
			<?php }?>

			<?php if ($_smarty_tpl->tpl_vars['LDAdmitBillItem']->value) {?>
				<tr>
					<td class="adm_item">
						<?php echo $_smarty_tpl->tpl_vars['LDAdmitBillItem']->value;?>
:
					</td>
					<td colspan=2 class="adm_input">
						<?php echo $_smarty_tpl->tpl_vars['sAdmitBillItem']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['sBIFromInput']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['sBIHidden']->value;?>

					</td>
				</tr>
			<?php }?>

			<?php if ($_smarty_tpl->tpl_vars['LDAdmitDoctorRefered']->value) {?>
				<tr>
					<td class="adm_item">
						<?php echo $_smarty_tpl->tpl_vars['LDAdmitDoctorRefered']->value;?>
:
					</td>
					<td colspan=2 class="adm_input">
						<?php echo $_smarty_tpl->tpl_vars['sAdmitDoctorRefered']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['sRefDrFromInput']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['sRefDrHidden']->value;?>

					</td>
				</tr>
			<?php }?>

				<tr>
					<td class="adm_item">
						<?php echo $_smarty_tpl->tpl_vars['LDAdmitBy']->value;?>
:
					</td>
					<td colspan=2 class="adm_input">
						<?php echo $_smarty_tpl->tpl_vars['encoder']->value;?>

					</td>
				</tr>

				<?php echo $_smarty_tpl->tpl_vars['sHiddenInputs']->value;?>


				<tr>
					<td colspan="3">
						&nbsp;
					</td>
				</tr>
				<tr>
					<td>
						<?php echo $_smarty_tpl->tpl_vars['pbSave']->value;?>

					</td>
					<td align="right">
						<?php echo $_smarty_tpl->tpl_vars['pbRefresh']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['pbRegData']->value;?>

					</td>
					<td align="right">
						<?php echo $_smarty_tpl->tpl_vars['pbCancel']->value;?>

					</td>
				</tr>

		</table>

			<?php echo $_smarty_tpl->tpl_vars['sErrorHidInputs']->value;?>

			<?php echo $_smarty_tpl->tpl_vars['sUpdateHidInputs']->value;?>


	<?php if ($_smarty_tpl->tpl_vars['bSetAsForm']->value) {?>
	</form>
	<?php }?>

	<?php echo $_smarty_tpl->tpl_vars['sNewDataForm']->value;?>

	<p>
<?php }
}
