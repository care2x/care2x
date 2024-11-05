<?php
/* Smarty version 3.1.40, created on 2024-11-04 22:22:48
  from '/home/tim/code/care2x/gui/smarty_template/templates/default/appointment/appt_list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_6729493810b380_52542596',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ca60166d7827247815e13dae1702ed66b07f9079' => 
    array (
      0 => '/home/tim/code/care2x/gui/smarty_template/templates/default/appointment/appt_list.tpl',
      1 => 1726137535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6729493810b380_52542596 (Smarty_Internal_Template $_smarty_tpl) {
?>
<table width=100% border=0 cellpadding="0" cellspacing=0>
	<tbody>
	<tr>
		<td>
			<?php echo $_smarty_tpl->tpl_vars['sMiniCalendar']->value;?>

		</td>
		<td>

			<form name="bydept">
				<?php echo $_smarty_tpl->tpl_vars['LDListApptByDept']->value;?>
<br>
				<nobr>
				<?php echo $_smarty_tpl->tpl_vars['sByDeptSelect']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['pbByDeptGo']->value;?>

				</nobr>
								<?php echo $_smarty_tpl->tpl_vars['sByDeptHiddenInputs']->value;?>

			</form>
			<br>
			<form name="bydoc">
				<?php echo $_smarty_tpl->tpl_vars['LDListApptByDoc']->value;?>
<br>
				<nobr>
				<?php echo $_smarty_tpl->tpl_vars['sByDocSelect']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['pbByDocGo']->value;?>

				</nobr>
								<?php echo $_smarty_tpl->tpl_vars['sByDocHiddenInputs']->value;?>

			</form>

		</td>
	</tr>
	<tr>
		<td colspan="2">
			<?php if ($_smarty_tpl->tpl_vars['bShowPrompt']->value) {?>
				<table>
				<tbody>
					<tr>
						<td><?php echo $_smarty_tpl->tpl_vars['sMascotImg']->value;?>
</td>
						<td class="warnprompt"><?php echo $_smarty_tpl->tpl_vars['sPrompt']->value;?>
</td>
					</tr>
				</tbody>
				</table>
			<?php }?>
			<?php echo $_smarty_tpl->tpl_vars['sApptList']->value;?>
<p>
			<?php echo $_smarty_tpl->tpl_vars['sButton']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['sNewApptLink']->value;?>
<p>
			<?php echo $_smarty_tpl->tpl_vars['pbClose']->value;?>

		</td>
	</tr>
	</tbody>
</table><?php }
}
