<?php
/* Smarty version 3.1.40, created on 2024-11-04 22:42:10
  from '/home/tim/code/care2x/gui/smarty_template/templates/default/main/login_config.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_67294dc2a51445_99625234',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7a3facab6834220b86ad51de69762ff6f0cb766d' => 
    array (
      0 => '/home/tim/code/care2x/gui/smarty_template/templates/default/main/login_config.tpl',
      1 => 1726137535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67294dc2a51445_99625234 (Smarty_Internal_Template $_smarty_tpl) {
?>
<ul>

<table>
	<tr>
		<td align=right><img <?php echo $_smarty_tpl->tpl_vars['gifMascot']->value;?>
 align="absmiddle"></td>
		<td>
			<font class="warnprompt"><?php echo $_smarty_tpl->tpl_vars['sPromptText']->value;?>
</font>
			<br>
			<?php echo $_smarty_tpl->tpl_vars['sUserName']->value;?>

		</font>
		</td>
	</tr>
</table>

<form <?php echo $_smarty_tpl->tpl_vars['sFormParams']->value;?>
>

	
	<table cellSpacing=0 cellPadding=0 border=0 class="submenu_frame">
	<tbody>
		<tr>
			<td>
				<table cellSpacing=1 cellPadding=3  border=0>
				<tbody class="submenu">
					<tr class="submenu_title">
						<td colspan="3"><?php echo $_smarty_tpl->tpl_vars['LDPcID']->value;?>
</td>
					</tr>
					<tr>
						<td><?php echo $_smarty_tpl->tpl_vars['sDeptIcon']->value;?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['sDeptSelect']->value;?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['LDDept']->value;?>
</td>
					</tr>

					<tr>
						<td><?php echo $_smarty_tpl->tpl_vars['sWardIcon']->value;?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['sWardSelect']->value;?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['LDWard']->value;?>
</td>
					</tr>

					<tr>
						<td><?php echo $_smarty_tpl->tpl_vars['sWardORIcon']->value;?>
</td>
						<td><input type="text" name="thispc_room_nr" size=20 maxlength=25 value="<?php echo $_smarty_tpl->tpl_vars['sWardORValue']->value;?>
"></td>
						<td><?php echo $_smarty_tpl->tpl_vars['LDWardOR']->value;?>
</td>
					</tr>

					<tr>
						<td><?php echo $_smarty_tpl->tpl_vars['sPhoneNrIcon']->value;?>
</td>
						<td><input type="text" name="thispc_phone" size=20 maxlength=25 value="<?php echo $_smarty_tpl->tpl_vars['sPhoneNrValue']->value;?>
"></td>
						<td><?php echo $_smarty_tpl->tpl_vars['LDPhoneNr']->value;?>
</td>
					</tr>

					<tr>
						<td><?php echo $_smarty_tpl->tpl_vars['sIntercomNrIcon']->value;?>
</td>
						<td><input type="text" name="thispc_intercom" size=20 maxlength=25 value="<?php echo $_smarty_tpl->tpl_vars['sIntercomNrValue']->value;?>
"></td>
						<td><?php echo $_smarty_tpl->tpl_vars['LDIntercomNr']->value;?>
</td>
					</tr>

					<tr>
						<td><?php echo $_smarty_tpl->tpl_vars['sIPAddressIcon']->value;?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['sIPAddress']->value;?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['LDPcIP']->value;?>
</td>
					</tr>
				</tbody>
				</table>
			</td>
		</tr>
	</tbody>
	</table>
	<p>
	
	<?php echo $_smarty_tpl->tpl_vars['sHiddenInputs']->value;?>

	<?php echo $_smarty_tpl->tpl_vars['sSubmitFormButton']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['sNoChangeButton']->value;?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['sCancelButton']->value;?>


</form>

</ul><?php }
}
