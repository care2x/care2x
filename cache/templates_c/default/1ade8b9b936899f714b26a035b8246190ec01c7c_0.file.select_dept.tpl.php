<?php
/* Smarty version 3.1.40, created on 2024-11-06 18:29:18
  from '/home/tim/code/care2x/gui/smarty_template/templates/default/or/select_dept.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_672bb57ece6419_11906704',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1ade8b9b936899f714b26a035b8246190ec01c7c' => 
    array (
      0 => '/home/tim/code/care2x/gui/smarty_template/templates/default/or/select_dept.tpl',
      1 => 1726137535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_672bb57ece6419_11906704 (Smarty_Internal_Template $_smarty_tpl) {
?>
<ul>
<table border=0>
	<tr>
		<td>
			<?php echo $_smarty_tpl->tpl_vars['sMascotImg']->value;?>

		</td>

		<td colspan=4 class="prompt">
			<center>
			<?php echo $_smarty_tpl->tpl_vars['LDPlsSelectDept']->value;?>

			</center>
		</td>
	</tr>
</table>

<table  cellpadding="2" cellspacing=0 border="0">
	<?php echo $_smarty_tpl->tpl_vars['sDeptRows']->value;?>

</table>

<p>
<?php echo $_smarty_tpl->tpl_vars['sBackLink']->value;?>

</ul>
<p><?php }
}
