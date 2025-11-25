<?php
/* Smarty version 3.1.40, created on 2024-11-05 19:24:56
  from '/home/tim/code/care2x/gui/smarty_template/templates/default/medocs/main_plain.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_672a7108ca42a8_35420683',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fef8b287a7765a9aad656856a23128d73de2bf0a' => 
    array (
      0 => '/home/tim/code/care2x/gui/smarty_template/templates/default/medocs/main_plain.tpl',
      1 => 1726137535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:medocs/tabs.tpl' => 1,
  ),
),false)) {
function content_672a7108ca42a8_35420683 (Smarty_Internal_Template $_smarty_tpl) {
?><table width="100%" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td><?php $_smarty_tpl->_subTemplateRender("file:medocs/tabs.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?></td>
    </tr>
    <tr>
      <td>
			&nbsp;<br>
			<?php echo $_smarty_tpl->tpl_vars['sMainDataBlock']->value;?>


	  </td>
    </tr>
  </tbody>
</table>
<?php }
}
