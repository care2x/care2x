<?php
/* Smarty version 3.1.40, created on 2024-11-05 09:03:45
  from '/home/tim/code/care2x/gui/smarty_template/templates/default/nursing/discharge_patient_form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_6729df711a8fd9_47768361',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4d41c1b3aa7ec24328238b6d39afd3251c40241f' => 
    array (
      0 => '/home/tim/code/care2x/gui/smarty_template/templates/default/nursing/discharge_patient_form.tpl',
      1 => 1726137535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6729df711a8fd9_47768361 (Smarty_Internal_Template $_smarty_tpl) {
?>
<ul>

<div class="prompt"><?php echo $_smarty_tpl->tpl_vars['sPrompt']->value;?>
</div>

<form action="<?php echo $_smarty_tpl->tpl_vars['thisfile']->value;?>
" name="discform" method="post" onSubmit="return pruf(this)">

	<table border=0 cellspacing="1">
		<tr>
			<td colspan=2 class="adm_input">
				<?php echo $_smarty_tpl->tpl_vars['sBarcodeLabel']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['img_source']->value;?>

			</td>
		</tr>
		<tr>
			<td class="adm_item"><?php echo $_smarty_tpl->tpl_vars['LDLocation']->value;?>
:</td>
			<td class="adm_input"><?php echo $_smarty_tpl->tpl_vars['sLocation']->value;?>
</td>
		</tr>
			<td class="adm_item"><?php echo $_smarty_tpl->tpl_vars['LDDate']->value;?>
:</td>
			<td class="adm_input">
				<?php if ($_smarty_tpl->tpl_vars['released']->value) {?>
					<?php echo $_smarty_tpl->tpl_vars['x_date']->value;?>

				<?php } else { ?>
					<?php echo $_smarty_tpl->tpl_vars['sDateInput']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['sDateMiniCalendar']->value;?>

				<?php }?>
			</td>
		</tr>
		<tr>
			<td class="adm_item"><?php echo $_smarty_tpl->tpl_vars['LDClockTime']->value;?>
:</td>
			<td class="adm_input">
				<?php if ($_smarty_tpl->tpl_vars['released']->value) {?>
					<?php echo $_smarty_tpl->tpl_vars['x_time']->value;?>

				<?php } else { ?>
					<?php echo $_smarty_tpl->tpl_vars['sTimeInput']->value;?>

				<?php }?>
			</td>
		</tr>
		<tr>
			<td class="adm_item"><?php echo $_smarty_tpl->tpl_vars['LDReleaseType']->value;?>
:</td>
			<td class="adm_input">
				<?php echo $_smarty_tpl->tpl_vars['sDischargeTypes']->value;?>

			</td>
		</tr>
		<tr>
			<td class="adm_item"><?php echo $_smarty_tpl->tpl_vars['LDNotes']->value;?>
:</td>
			<td class="adm_input">
				<?php if ($_smarty_tpl->tpl_vars['released']->value) {?>
					<?php echo $_smarty_tpl->tpl_vars['info']->value;?>

				<?php } else { ?>
					<textarea name="info" cols=40 rows=3></textarea>
				<?php }?>
			</td>
		</tr>
		<tr>
			<td class="adm_item"><?php echo $_smarty_tpl->tpl_vars['LDNurse']->value;?>
:</td>
			<td class="adm_input">
				<?php if ($_smarty_tpl->tpl_vars['released']->value) {?>
					<?php echo $_smarty_tpl->tpl_vars['encoder']->value;?>

				<?php } else { ?>
					<input type="text" name="encoder" size=25 maxlength=30 value="<?php echo $_smarty_tpl->tpl_vars['encoder']->value;?>
">
				<?php }?>
			</td>
		</tr>

	<?php if ($_smarty_tpl->tpl_vars['bShowValidator']->value) {?>
		<tr>
			<td class="adm_item"><?php echo $_smarty_tpl->tpl_vars['pbSubmit']->value;?>
</td>
			<td class="adm_input"><?php echo $_smarty_tpl->tpl_vars['sValidatorCheckBox']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['LDYesSure']->value;?>
</td>
		</tr>
	<?php }?>
	
	</table>

	<?php echo $_smarty_tpl->tpl_vars['sHiddenInputs']->value;?>


</form>

<?php echo $_smarty_tpl->tpl_vars['pbCancel']->value;?>


</ul>
<?php }
}
