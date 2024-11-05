<?php
/* Smarty version 3.1.40, created on 2024-11-04 19:52:21
  from '/home/tim/code/care2x/gui/smarty_template/templates/default/registration_admission/admit_plain.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_672925f5dbbb76_39741536',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '618f3a3ba33ae6dda0a965e883b96c4ece461ff3' => 
    array (
      0 => '/home/tim/code/care2x/gui/smarty_template/templates/default/registration_admission/admit_plain.tpl',
      1 => 1726137535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:registration_admission/admit_tabs.tpl' => 1,
  ),
),false)) {
function content_672925f5dbbb76_39741536 (Smarty_Internal_Template $_smarty_tpl) {
?><table width="100%" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td><?php $_smarty_tpl->_subTemplateRender("file:registration_admission/admit_tabs.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?></td>
    </tr>
    <tr>
      <td>

				<?php echo $_smarty_tpl->tpl_vars['sMainDataBlock']->value;?>


				<?php if ($_smarty_tpl->tpl_vars['sMainIncludeFile']->value) {?>
					<?php $_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['sMainIncludeFile']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
				<?php }?>

			</td>
    </tr>
  </tbody>
</table>
<?php }
}
