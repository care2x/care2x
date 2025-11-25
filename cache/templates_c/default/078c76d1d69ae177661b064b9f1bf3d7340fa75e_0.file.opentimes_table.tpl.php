<?php
/* Smarty version 3.1.40, created on 2025-11-25 10:20:41
  from '/home/tim/code/care2x/gui/smarty_template/templates/default/common/opentimes_table.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_692582f9a2d3f7_13102314',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '078c76d1d69ae177661b064b9f1bf3d7340fa75e' => 
    array (
      0 => '/home/tim/code/care2x/gui/smarty_template/templates/default/common/opentimes_table.tpl',
      1 => 1726137535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_692582f9a2d3f7_13102314 (Smarty_Internal_Template $_smarty_tpl) {
?>
<ul>
	<table border=0 cellspacing=0 cellpadding=0>
	<tr>
		<td bgcolor=#999999>
			<table border=0 cellspacing=1 cellpadding=5>
			<tr bgcolor=#ffffff>
				<td><b><?php echo $_smarty_tpl->tpl_vars['LDDayTxt']->value;?>
</b></font></td>
				<td><b><?php echo $_smarty_tpl->tpl_vars['LDOpenHrsTxt']->value;?>
</b></font></td>
				<td><b><?php echo $_smarty_tpl->tpl_vars['LDChkHrsTxt']->value;?>
</b></font></td>
			</tr>
			
						<?php echo $_smarty_tpl->tpl_vars['sOpenTimesRows']->value;?>


			</table>
		</td>
	</tr>
	</table>

	<p>
	<?php echo $_smarty_tpl->tpl_vars['sBreakFile']->value;?>

	<p>
</ul><?php }
}
