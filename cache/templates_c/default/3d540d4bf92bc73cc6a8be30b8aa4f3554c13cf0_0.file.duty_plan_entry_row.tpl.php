<?php
/* Smarty version 3.1.40, created on 2024-11-06 18:29:22
  from '/home/tim/code/care2x/gui/smarty_template/templates/default/common/duty_plan_entry_row.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_672bb58266f071_86345548',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3d540d4bf92bc73cc6a8be30b8aa4f3554c13cf0' => 
    array (
      0 => '/home/tim/code/care2x/gui/smarty_template/templates/default/common/duty_plan_entry_row.tpl',
      1 => 1726137535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_672bb58266f071_86345548 (Smarty_Internal_Template $_smarty_tpl) {
?>
<tr <?php echo $_smarty_tpl->tpl_vars['sRowClass']->value;?>
>
	<td><?php echo $_smarty_tpl->tpl_vars['iDayNr']->value;?>
</td>
	<td><?php echo $_smarty_tpl->tpl_vars['LDShortDay']->value;?>
</td>
	<td><nobr><?php echo $_smarty_tpl->tpl_vars['sIcon1']->value;?>
&nbsp<?php echo $_smarty_tpl->tpl_vars['sInput1']->value;?>
</nobr></td>
	<td><?php echo $_smarty_tpl->tpl_vars['sPopWin1']->value;?>
</td>
	<td><nobr><?php echo $_smarty_tpl->tpl_vars['sIcon2']->value;?>
&nbsp<?php echo $_smarty_tpl->tpl_vars['sInput2']->value;?>
</nobr></td>
	<td><?php echo $_smarty_tpl->tpl_vars['sPopWin2']->value;?>
</td>
</tr><?php }
}
