<?php
/* Smarty version 3.1.40, created on 2024-11-04 15:09:17
  from '/home/tim/code/care2x/gui/smarty_template/templates/default/registration_admission/reg_row.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_6728e39d6a8947_76513916',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0a555e7e3a6d0860edad583370e42bdbaba10c9a' => 
    array (
      0 => '/home/tim/code/care2x/gui/smarty_template/templates/default/registration_admission/reg_row.tpl',
      1 => 1726137535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6728e39d6a8947_76513916 (Smarty_Internal_Template $_smarty_tpl) {
?><tr>
  <td <?php if ($_smarty_tpl->tpl_vars['must']->value) {?> class="reg_input_must" <?php } else { ?> class="reg_item" <?php }?> <?php echo $_smarty_tpl->tpl_vars['sColSpan1']->value;?>
><?php echo $_smarty_tpl->tpl_vars['sItem']->value;?>
</td>
  <td <?php if ($_smarty_tpl->tpl_vars['must']->value) {?> class="reg_input_must" <?php } else { ?> class="reg_input" <?php }?> <?php echo $_smarty_tpl->tpl_vars['sColSpan2']->value;?>
><?php echo $_smarty_tpl->tpl_vars['sInput']->value;?>
</td>
</tr><?php }
}
