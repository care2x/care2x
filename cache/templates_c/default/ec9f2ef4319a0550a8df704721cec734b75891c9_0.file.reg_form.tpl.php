<?php
/* Smarty version 3.1.40, created on 2025-11-27 18:06:26
  from '/home/tim/code/care2x/gui/smarty_template/templates/default/registration_admission/reg_form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_6928932253c8b8_05180331',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ec9f2ef4319a0550a8df704721cec734b75891c9' => 
    array (
      0 => '/home/tim/code/care2x/gui/smarty_template/templates/default/registration_admission/reg_form.tpl',
      1 => 1726137535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:registration_admission/reg_error_duplicate.tpl' => 1,
  ),
),false)) {
function content_6928932253c8b8_05180331 (Smarty_Internal_Template $_smarty_tpl) {
?>				<?php echo $_smarty_tpl->tpl_vars['sRegFormJavaScript']->value;?>


				<?php if ($_smarty_tpl->tpl_vars['error']->value || $_smarty_tpl->tpl_vars['errorDupPerson']->value) {?>
			<?php $_smarty_tpl->_subTemplateRender("file:registration_admission/reg_error_duplicate.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		<?php }?>

				<?php echo $_smarty_tpl->tpl_vars['pretext']->value;?>

		
		<?php if ($_smarty_tpl->tpl_vars['bSetAsForm']->value) {?>
		<form method="post" action="<?php echo $_smarty_tpl->tpl_vars['thisfile']->value;?>
" name="aufnahmeform" ENCTYPE="multipart/form-data" onSubmit="return chkform(this)">
		<?php }?>

		<table border=0 cellspacing=0 cellpadding=0 <?php echo $_smarty_tpl->tpl_vars['sFormWidth']->value;?>
>
				<tr>
					<td class="reg_item">
						<?php echo $_smarty_tpl->tpl_vars['LDRegistryNr']->value;?>

					</td>
					<td class="reg_input">
						<?php echo $_smarty_tpl->tpl_vars['pid']->value;?>

						<br>
						<?php echo $_smarty_tpl->tpl_vars['sBarcodeImg']->value;?>

					</td>
					<td <?php echo $_smarty_tpl->tpl_vars['sPicTdRowSpan']->value;?>
 class="photo_id" align="center">
						<a href="#"  onClick="showpic(document.aufnahmeform.photo_filename)"><img <?php echo $_smarty_tpl->tpl_vars['img_source']->value;?>
 name="headpic"></a>
						<br>
						<?php echo $_smarty_tpl->tpl_vars['LDPhoto']->value;?>

						<br>
						<?php echo $_smarty_tpl->tpl_vars['sFileBrowserInput']->value;?>

					</td>
				</tr>

				<tr>
					<td  class="reg_item">
						<?php echo $_smarty_tpl->tpl_vars['LDRegDate']->value;?>

					</td>
					<td class="reg_input">
						<FONT color="#800000">
						<?php echo $_smarty_tpl->tpl_vars['sRegDate']->value;?>

					</td>
				</tr>

				<tr>
					<td  class="reg_item">
						<?php echo $_smarty_tpl->tpl_vars['LDRegTime']->value;?>

					</td>
					<td class="reg_input">
						<FONT color="#800000">
						<?php echo $_smarty_tpl->tpl_vars['sRegTime']->value;?>

					</td>
				</tr>

				
				<?php echo $_smarty_tpl->tpl_vars['sPersonTitle']->value;?>

				<?php echo $_smarty_tpl->tpl_vars['sNameLast']->value;?>

				<?php echo $_smarty_tpl->tpl_vars['sNameFirst']->value;?>

				<?php echo $_smarty_tpl->tpl_vars['sName2']->value;?>

				<?php echo $_smarty_tpl->tpl_vars['sName3']->value;?>

				<?php echo $_smarty_tpl->tpl_vars['sNameMiddle']->value;?>

				<?php echo $_smarty_tpl->tpl_vars['sNameMaiden']->value;?>

				<?php echo $_smarty_tpl->tpl_vars['sNameOthers']->value;?>


				<tr>
					<td class="reg_input_must">
						<?php echo $_smarty_tpl->tpl_vars['LDBday']->value;?>

					</td>
					<td class="reg_input_must">
						<?php echo $_smarty_tpl->tpl_vars['sBdayInput']->value;?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['sCrossImg']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['sDeathDate']->value;?>

					</td>
					<td class="reg_input_must">
						<?php echo $_smarty_tpl->tpl_vars['LDSex']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['sSexM']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['LDMale']->value;?>
&nbsp;&nbsp; <?php echo $_smarty_tpl->tpl_vars['sSexF']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['LDFemale']->value;?>

					</td>
				</tr>

			<?php if ($_smarty_tpl->tpl_vars['LDBloodGroup']->value) {?>
				<tr>
				<td class="reg_item">
					<?php echo $_smarty_tpl->tpl_vars['LDBloodGroup']->value;?>

				</td>
				<td colspan=2 class="reg_input">
					<?php echo $_smarty_tpl->tpl_vars['sBGAInput']->value;
echo $_smarty_tpl->tpl_vars['LDA']->value;?>
  &nbsp;&nbsp; <?php echo $_smarty_tpl->tpl_vars['sBGBInput']->value;
echo $_smarty_tpl->tpl_vars['LDB']->value;?>
 &nbsp;&nbsp; <?php echo $_smarty_tpl->tpl_vars['sBGABInput']->value;
echo $_smarty_tpl->tpl_vars['LDAB']->value;?>
  &nbsp;&nbsp; <?php echo $_smarty_tpl->tpl_vars['sBGOInput']->value;
echo $_smarty_tpl->tpl_vars['LDO']->value;?>

				</td>
				</tr>
			<?php }?>

			<?php if ($_smarty_tpl->tpl_vars['LDCivilStatus']->value) {?>
				<tr>
				<td class="reg_item">
					<?php echo $_smarty_tpl->tpl_vars['LDCivilStatus']->value;?>

				</td>
				<td colspan=2 class="reg_input">
					<?php echo $_smarty_tpl->tpl_vars['sCSSingleInput']->value;
echo $_smarty_tpl->tpl_vars['LDSingle']->value;?>
  &nbsp;&nbsp;
					<?php echo $_smarty_tpl->tpl_vars['sCSMarriedInput']->value;
echo $_smarty_tpl->tpl_vars['LDMarried']->value;?>
 &nbsp;&nbsp;
					<?php echo $_smarty_tpl->tpl_vars['sCSDivorcedInput']->value;
echo $_smarty_tpl->tpl_vars['LDDivorced']->value;?>
  &nbsp;&nbsp;
					<?php echo $_smarty_tpl->tpl_vars['sCSWidowedInput']->value;
echo $_smarty_tpl->tpl_vars['LDWidowed']->value;?>
 &nbsp;&nbsp;
					<?php echo $_smarty_tpl->tpl_vars['sCSSeparatedInput']->value;
echo $_smarty_tpl->tpl_vars['LDSeparated']->value;?>

				</td>
				</tr>
			<?php }?>

				<tr>
				<td colspan=3>
					<?php echo $_smarty_tpl->tpl_vars['LDAddress']->value;?>

				</td>
				</tr>

				<tr>
					<td class="reg_input_must">
						<?php echo $_smarty_tpl->tpl_vars['LDStreet']->value;?>

					</td>
					<td class="reg_input_must">
						<?php echo $_smarty_tpl->tpl_vars['sStreetInput']->value;?>

					</td>
					<td class="reg_input_must">
						<?php echo $_smarty_tpl->tpl_vars['LDStreetNr']->value;?>
 &nbsp;&nbsp; <?php echo $_smarty_tpl->tpl_vars['sStreetNrInput']->value;?>

					</td>
				</tr>

				<tr>
					<td class="reg_input_must">
						<?php echo $_smarty_tpl->tpl_vars['LDTownCity']->value;?>

					</td>
					<td class="reg_input_must">
						<?php echo $_smarty_tpl->tpl_vars['sTownCityInput']->value;?>
 
					</td>
					<td class="reg_input_must">
						<?php echo $_smarty_tpl->tpl_vars['LDZipCode']->value;?>
 &nbsp;&nbsp; <?php echo $_smarty_tpl->tpl_vars['sZipCodeInput']->value;?>

					</td>
				</tr>

			<?php if ($_smarty_tpl->tpl_vars['bShowInsurance']->value) {?>

				<tr class="reg_input_must">
				<td>
					&nbsp;
				</td>
				<td colspan=2 >
					<?php echo $_smarty_tpl->tpl_vars['sErrorInsClass']->value;?>
 
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['sInsClasses']->value, 'InsClass');
$_smarty_tpl->tpl_vars['InsClass']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['InsClass']->value) {
$_smarty_tpl->tpl_vars['InsClass']->do_else = false;
?>
						<?php echo $_smarty_tpl->tpl_vars['InsClass']->value;?>

					<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				</td>
			
				</tr>
				
				<tr>
					<td>
						<?php echo $_smarty_tpl->tpl_vars['sInsuranceNr']->value;?>

					</td>
				</tr>
				
				<tr>
				<td class="reg_item">
					<?php echo $_smarty_tpl->tpl_vars['LDInsuranceCo']->value;?>

				</td>
				<td colspan=2 class="reg_input">
					<?php echo $_smarty_tpl->tpl_vars['sInsCoNameInput']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['sInsCoMiniCalendar']->value;?>

				</td>	
				</tr>
			<?php }?>

			<?php if ($_smarty_tpl->tpl_vars['bNoInsurance']->value) {?>
				<tr>
				<td>
					&nbsp;
				</td>
				<td colspan=2 class="reg_input">
					<?php echo $_smarty_tpl->tpl_vars['LDSeveralInsurances']->value;?>

				</td>
				</tr>
			<?php }?>

				
				<?php echo $_smarty_tpl->tpl_vars['sPhone1']->value;?>

				<?php echo $_smarty_tpl->tpl_vars['sPhone2']->value;?>

				<?php echo $_smarty_tpl->tpl_vars['sCellPhone1']->value;?>

				<?php echo $_smarty_tpl->tpl_vars['sCellPhone2']->value;?>

				<?php echo $_smarty_tpl->tpl_vars['sFax']->value;?>

				<?php echo $_smarty_tpl->tpl_vars['sEmail']->value;?>

				<?php echo $_smarty_tpl->tpl_vars['sCitizenship']->value;?>

				<?php echo $_smarty_tpl->tpl_vars['sSSSNr']->value;?>

				<?php echo $_smarty_tpl->tpl_vars['sNatIdNr']->value;?>

				<?php echo $_smarty_tpl->tpl_vars['sReligion']->value;?>


				<tr>
				<td class="reg_item">
					<?php echo $_smarty_tpl->tpl_vars['LDEthnicOrig']->value;?>

				</td>
				<td colspan=2 class="reg_input">
					<?php echo $_smarty_tpl->tpl_vars['sEthnicOrigInput']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['sEthnicOrigMiniCalendar']->value;?>

				</td>
			</tr>
			
			<?php if ($_smarty_tpl->tpl_vars['bShowOtherHospNr']->value) {?>
				<tr>
				<td class="reg_item" valign=top class="reg_input">
					<?php echo $_smarty_tpl->tpl_vars['LDOtherHospitalNr']->value;?>

				</td>
				<td colspan=2 class="reg_input">
					<?php echo $_smarty_tpl->tpl_vars['sOtherNr']->value;?>

					<?php echo $_smarty_tpl->tpl_vars['sOtherNrSelect']->value;?>

				</td>
				</tr>
				<?php }?>

				<tr>
				<td class="reg_item">
					<?php echo $_smarty_tpl->tpl_vars['LDRegBy']->value;?>

				</td>
				<td colspan=2 class="reg_input">
					<?php echo $_smarty_tpl->tpl_vars['sRegByInput']->value;?>

				</td>
			</tr>
		</table>

		<?php echo $_smarty_tpl->tpl_vars['sHiddenInputs']->value;?>

		<?php echo $_smarty_tpl->tpl_vars['sUpdateHiddenInputs']->value;?>

		<p>
		<?php echo $_smarty_tpl->tpl_vars['pbSubmit']->value;?>
 &nbsp;&nbsp; <?php echo $_smarty_tpl->tpl_vars['pbReset']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['pbForceSave']->value;?>


		<?php if ($_smarty_tpl->tpl_vars['bSetAsForm']->value) {?>
		</form>
		<?php }?>

		<?php echo $_smarty_tpl->tpl_vars['sNewDataForm']->value;?>

<?php }
}
