<?php
/* Smarty version 3.1.40, created on 2024-11-05 19:24:00
  from '/home/tim/code/care2x/gui/smarty_template/templates/default/registration_admission/basic_data.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_672a70d0947825_96543156',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b5509c21089a1b374f3eb1e8e9fab8dbaaa1b7bb' => 
    array (
      0 => '/home/tim/code/care2x/gui/smarty_template/templates/default/registration_admission/basic_data.tpl',
      1 => 1726137535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_672a70d0947825_96543156 (Smarty_Internal_Template $_smarty_tpl) {
?>
		<table border="0" cellspacing=1 cellpadding=0 width="100%">

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
					<td  <?php echo $_smarty_tpl->tpl_vars['sClassItem']->value;?>
>
						<?php echo $_smarty_tpl->tpl_vars['LDCaseNr']->value;?>

					</td>
					<td <?php echo $_smarty_tpl->tpl_vars['sClassInput']->value;?>
>
						<?php echo $_smarty_tpl->tpl_vars['sEncNrPID']->value;?>

					</td>
					<td <?php echo $_smarty_tpl->tpl_vars['sRowSpan']->value;?>
 align="center" class="photo_id">
						<?php echo $_smarty_tpl->tpl_vars['img_source']->value;?>

					</td>
				</tr>

				<tr>
					<td <?php echo $_smarty_tpl->tpl_vars['sClassItem']->value;?>
>
						<?php echo $_smarty_tpl->tpl_vars['LDTitle']->value;?>
:
					</td>
					<td <?php echo $_smarty_tpl->tpl_vars['sClassInput']->value;?>
>
						<?php echo $_smarty_tpl->tpl_vars['title']->value;?>

					</td>
				</tr>

				<tr>
					<td <?php echo $_smarty_tpl->tpl_vars['sClassItem']->value;?>
>
						<?php echo $_smarty_tpl->tpl_vars['LDLastName']->value;?>
:
					</td>
					<td bgcolor="#ffffee" class="vi_data"><b>
						<?php echo $_smarty_tpl->tpl_vars['name_last']->value;?>
</b>
					</td>
				</tr>

				<tr>
					<td <?php echo $_smarty_tpl->tpl_vars['sClassItem']->value;?>
>
						<?php echo $_smarty_tpl->tpl_vars['LDFirstName']->value;?>
:
					</td>
					<td bgcolor="#ffffee" class="vi_data">
						<?php echo $_smarty_tpl->tpl_vars['name_first']->value;?>

					</td>
				</tr>

			<?php if ($_smarty_tpl->tpl_vars['name_2']->value) {?>
				<tr>
					<td <?php echo $_smarty_tpl->tpl_vars['sClassItem']->value;?>
>
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
					<td <?php echo $_smarty_tpl->tpl_vars['sClassItem']->value;?>
>
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
					<td <?php echo $_smarty_tpl->tpl_vars['sClassItem']->value;?>
>
						<?php echo $_smarty_tpl->tpl_vars['LDNameMid']->value;?>
:
					</td>
					<td bgcolor="#ffffee">
						<?php echo $_smarty_tpl->tpl_vars['name_middle']->value;?>

					</td>
				</tr>
			<?php }?>

				<tr>
					<td <?php echo $_smarty_tpl->tpl_vars['sClassItem']->value;?>
>
						<?php echo $_smarty_tpl->tpl_vars['LDBday']->value;?>
:
					</td>
					<td bgcolor="#ffffee" class="vi_data">
						<?php echo $_smarty_tpl->tpl_vars['sBdayDate']->value;?>
 &nbsp; <?php echo $_smarty_tpl->tpl_vars['sCrossImg']->value;?>
 &nbsp; <font color="black"><?php echo $_smarty_tpl->tpl_vars['sDeathDate']->value;?>
</font>
					</td>
				</tr>

				<tr>
					<td <?php echo $_smarty_tpl->tpl_vars['sClassItem']->value;?>
>
						<?php echo $_smarty_tpl->tpl_vars['LDSex']->value;?>
:
					</td>
					<td <?php echo $_smarty_tpl->tpl_vars['sClassInput']->value;?>
>
						<?php echo $_smarty_tpl->tpl_vars['sSexType']->value;?>

					</td>
				</tr>

			<?php if ($_smarty_tpl->tpl_vars['LDBloodGroup']->value) {?>
				<tr>
					<td <?php echo $_smarty_tpl->tpl_vars['sClassItem']->value;?>
>
						<?php echo $_smarty_tpl->tpl_vars['LDBloodGroup']->value;?>
:
					</td>
					<td  <?php echo $_smarty_tpl->tpl_vars['sClassInput']->value;?>
>&nbsp;
						<?php echo $_smarty_tpl->tpl_vars['blood_group']->value;?>

					</td>
				</tr>
			<?php }?>

		</table><?php }
}
