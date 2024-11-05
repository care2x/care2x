<?php
/* Smarty version 3.1.40, created on 2024-11-04 22:58:37
  from '/home/tim/code/care2x/gui/smarty_template/templates/default/ambulatory/outpatients.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_6729519db6b660_19520519',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7a03a9c3e9b0e0acc89ee2ed776a0d2130479711' => 
    array (
      0 => '/home/tim/code/care2x/gui/smarty_template/templates/default/ambulatory/outpatients.tpl',
      1 => 1726137535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:ambulatory/outpatients_list.tpl' => 1,
  ),
),false)) {
function content_6729519db6b660_19520519 (Smarty_Internal_Template $_smarty_tpl) {
echo $_smarty_tpl->tpl_vars['sWarningPrompt']->value;?>

<table cellspacing="0" cellpadding="0" width="100%">
<tbody>
	<tr valign="top">
		<td>
			<?php if ($_smarty_tpl->tpl_vars['bShowPatientsList']->value) {?>
				<?php $_smarty_tpl->_subTemplateRender("file:ambulatory/outpatients_list.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
			<?php }?>
			<p>
			<?php echo $_smarty_tpl->tpl_vars['pbClose']->value;?>

		</td>
		<td align="right">
			<?php echo $_smarty_tpl->tpl_vars['sSubMenuBlock']->value;?>

		</td>
	</tr>
</tbody>
</table>
<?php }
}
