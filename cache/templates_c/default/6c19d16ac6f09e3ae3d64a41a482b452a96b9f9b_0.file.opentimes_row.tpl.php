<?php
/* Smarty version 3.1.40, created on 2025-11-25 10:20:41
  from '/home/tim/code/care2x/gui/smarty_template/templates/default/common/opentimes_row.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_692582f9a27fa3_49973758',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6c19d16ac6f09e3ae3d64a41a482b452a96b9f9b' => 
    array (
      0 => '/home/tim/code/care2x/gui/smarty_template/templates/default/common/opentimes_row.tpl',
      1 => 1726137535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_692582f9a27fa3_49973758 (Smarty_Internal_Template $_smarty_tpl) {
?>
<tr bgcolor=#ffffff>
	<td><?php echo $_smarty_tpl->tpl_vars['sOpenDay']->value;?>
</td>
	<td><?php echo $_smarty_tpl->tpl_vars['sOpenTimes']->value;?>
</td>
	<td><?php echo $_smarty_tpl->tpl_vars['sVisitTimes']->value;?>
</td>
</tr>
<?php }
}
