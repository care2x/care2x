<?php
/* Smarty version 3.1.40, created on 2025-11-25 09:40:29
  from '/home/tim/code/care2x/gui/smarty_template/templates/default/registration_admission/admit_input.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_6925798dda8775_34725525',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '731fc93b08cdf284930f788ced7430ca0d098581' => 
    array (
      0 => '/home/tim/code/care2x/gui/smarty_template/templates/default/registration_admission/admit_input.tpl',
      1 => 1726137535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:registration_admission/admit_tabs.tpl' => 1,
    'file:registration_admission/admit_form.tpl' => 1,
  ),
),false)) {
function content_6925798dda8775_34725525 (Smarty_Internal_Template $_smarty_tpl) {
?><table width="100%" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td><?php $_smarty_tpl->_subTemplateRender("file:registration_admission/admit_tabs.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?></td>
    </tr>
	<tr>
      <td>
		<?php if ($_smarty_tpl->tpl_vars['LDPlsSelectPatientFirst']->value) {?>
		
			<table border=0>
				<tr>
					<td valign="bottom"><?php echo $_smarty_tpl->tpl_vars['sSearchPromptImg']->value;?>
</td>
					<td class="prompt"><?php echo $_smarty_tpl->tpl_vars['LDPlsSelectPatientFirst']->value;?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['sMascotImg']->value;?>
</td>
				</tr>
			</table>

			<table border=0 cellpadding=10 bgcolor="<?php echo $_smarty_tpl->tpl_vars['entry_border_bgcolor']->value;?>
">
				<tr>
					<td><?php echo $_smarty_tpl->tpl_vars['sSearchMask']->value;?>
</td>
				</tr>
			</table>

			<div class="prompt"><br>
				<?php echo $_smarty_tpl->tpl_vars['sWarnIcon']->value;?>


				<?php echo $_smarty_tpl->tpl_vars['LDRedirectToRegistry']->value;?>

			</div>

		<?php } else { ?>
			<table border=0 width="650" cellspacing="0" cellpadding="0">
				<tr>
					<td valign="bottom">
						<?php $_smarty_tpl->_subTemplateRender("file:registration_admission/admit_form.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?> 					</td>
				</tr>
			</table>
		<?php }?>

	  </td>
    </tr>
    <tr>
      <td>
	  	&nbsp;
		<p>
		<?php echo $_smarty_tpl->tpl_vars['sSearchLink']->value;?>

		<br>
		<?php echo $_smarty_tpl->tpl_vars['sArchiveLink']->value;?>

		<p>
		<?php echo $_smarty_tpl->tpl_vars['pbCancel']->value;?>

	</td>
    </tr>
  </tbody>
</table>
<?php }
}
