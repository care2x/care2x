<?php
/* Smarty version 3.1.40, created on 2025-11-27 18:06:26
  from '/home/tim/code/care2x/gui/smarty_template/templates/default/registration_admission/reg_input.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_6928932256e283_05041572',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '445633a96b2b10e7feb15f42ddc8377d47072e80' => 
    array (
      0 => '/home/tim/code/care2x/gui/smarty_template/templates/default/registration_admission/reg_input.tpl',
      1 => 1726137535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:registration_admission/reg_tabs.tpl' => 1,
  ),
),false)) {
function content_6928932256e283_05041572 (Smarty_Internal_Template $_smarty_tpl) {
?><table width="100%" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td><?php $_smarty_tpl->_subTemplateRender("file:registration_admission/reg_tabs.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?></td>
    </tr>
	<tr>
      <td><?php echo $_smarty_tpl->tpl_vars['sRegForm']->value;?>
</td>
    </tr>
    <tr>
      <td>
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
