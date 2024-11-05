<?php
/* Smarty version 3.1.40, created on 2024-11-04 22:23:05
  from '/home/tim/code/care2x/gui/smarty_template/templates/default/registration_admission/reg_plain.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_67294949912170_37745091',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e645ec868b14252b16677d39e3beb65c657c6dd7' => 
    array (
      0 => '/home/tim/code/care2x/gui/smarty_template/templates/default/registration_admission/reg_plain.tpl',
      1 => 1726137535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:registration_admission/reg_tabs.tpl' => 1,
  ),
),false)) {
function content_67294949912170_37745091 (Smarty_Internal_Template $_smarty_tpl) {
?><table width="100%" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td><?php $_smarty_tpl->_subTemplateRender("file:registration_admission/reg_tabs.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?></td>
    </tr>

    <tr>
      <td>
			<?php echo $_smarty_tpl->tpl_vars['sMainDataBlock']->value;?>

	  </td>
    </tr>
  </tbody>
</table>
<?php }
}
