<?php
/* Smarty version 3.1.40, created on 2025-11-27 18:06:23
  from '/home/tim/code/care2x/gui/smarty_template/templates/default/main/passcheck_entry_mask.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_6928931faccec7_87086568',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd4445349d0a9a5fade1f8f829d7ef630981c96f9' => 
    array (
      0 => '/home/tim/code/care2x/gui/smarty_template/templates/default/main/passcheck_entry_mask.tpl',
      1 => 1726137535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6928931faccec7_87086568 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!--<table width=100% border=0 cellpadding="0" cellspacing="0">-->


	<tr>
		<td class="passborder" colspan=3>&nbsp;</td>
	</tr>

	<tr>
		<td class="passborder" width=1<?php echo '%>';?>
</td>
		<td class="passbody">
			<p><br>
			<center>

			<?php if ($_smarty_tpl->tpl_vars['bShowErrorPrompt']->value) {?>
				<table border=0>
					<tr>
						<td><?php echo $_smarty_tpl->tpl_vars['sMascotImg']->value;?>
</td>
						<td align="center"><?php echo $_smarty_tpl->tpl_vars['sErrorMsg']->value;?>
</td>
					</tr>
				</table>
			<?php }?>

			<table border=0 cellpadding=0  cellspacing=0>
				<tr>
					<?php echo $_smarty_tpl->tpl_vars['sMascotColumn']->value;?>

					<td valign=top>
						<table cellspacing=0 class="passmaskframe">
							<tr>
								<td>
									<table cellpadding=20 cellspacing=0 class="passmask">
										<tr>
											<td>

												<p>
												<FORM <?php echo $_smarty_tpl->tpl_vars['sPassFormParams']->value;?>
>
													<div class="prompt">
														<?php echo $_smarty_tpl->tpl_vars['LDPwNeeded']->value;?>
!<p>
													</div>
													<nobr><?php echo $_smarty_tpl->tpl_vars['LDUserPrompt']->value;?>
:</nobr>
													<br>
													<INPUT type="text" name="userid" size="14" maxlength="25"> <p>
													<nobr><?php echo $_smarty_tpl->tpl_vars['LDPwPrompt']->value;?>
:<br>
													<INPUT type="password" name="keyword" size="14" maxlength="25">

																										<?php echo $_smarty_tpl->tpl_vars['sPassHiddenInputs']->value;?>


													</nobr><p>
													<?php echo $_smarty_tpl->tpl_vars['sPassSubmitButton']->value;?>
&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['sCancelButton']->value;?>

												</form>

											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>

			<p><br>
			</center>

		</td>
		<td class="passborder">
			&nbsp;
			</td>
	</tr>

	<tr >
		<td class="passborder" colspan=3>&nbsp;</td>
	</tr>

</table><?php }
}
