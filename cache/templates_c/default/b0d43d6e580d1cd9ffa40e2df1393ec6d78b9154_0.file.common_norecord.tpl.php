<?php
/* Smarty version 3.1.40, created on 2024-11-05 19:24:00
  from '/home/tim/code/care2x/gui/smarty_template/templates/default/registration_admission/common_norecord.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_672a70d094d968_17167114',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b0d43d6e580d1cd9ffa40e2df1393ec6d78b9154' => 
    array (
      0 => '/home/tim/code/care2x/gui/smarty_template/templates/default/registration_admission/common_norecord.tpl',
      1 => 1726137535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_672a70d094d968_17167114 (Smarty_Internal_Template $_smarty_tpl) {
?>						<table border=0>
							<tr>
								<td><?php echo $_smarty_tpl->tpl_vars['sMascotImg']->value;?>
</td>
								<td class="prompt">
									<?php echo $_smarty_tpl->tpl_vars['norecordyet']->value;?>

								</td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td>
									<?php echo $_smarty_tpl->tpl_vars['sPromptIcon']->value;?>
 &nbsp; <?php echo $_smarty_tpl->tpl_vars['sPromptLink']->value;?>

								</td>
							</tr>
						</table><?php }
}
