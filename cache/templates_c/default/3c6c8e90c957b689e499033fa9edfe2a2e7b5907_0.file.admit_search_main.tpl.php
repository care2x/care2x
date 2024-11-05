<?php
/* Smarty version 3.1.40, created on 2024-11-04 19:52:21
  from '/home/tim/code/care2x/gui/smarty_template/templates/default/registration_admission/admit_search_main.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_672925f5dc2fe9_15809463',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3c6c8e90c957b689e499033fa9edfe2a2e7b5907' => 
    array (
      0 => '/home/tim/code/care2x/gui/smarty_template/templates/default/registration_admission/admit_search_main.tpl',
      1 => 1726137535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_672925f5dc2fe9_15809463 (Smarty_Internal_Template $_smarty_tpl) {
echo $_smarty_tpl->tpl_vars['sPretext']->value;?>


<?php echo $_smarty_tpl->tpl_vars['sJSFormCheck']->value;?>


<p>

<table class="admit_searchmask_border" border=0 cellpadding=10>
	<tr>
		<td>
			<table class="admit_searchmask" cellpadding="5" cellspacing="5">
			<tbody>
				<tr>
					<td>
						<form <?php echo $_smarty_tpl->tpl_vars['sFormParams']->value;?>
>
							&nbsp;
							<br>
							<?php echo $_smarty_tpl->tpl_vars['searchprompt']->value;?>

							<br>
														<input type="text" name="searchkey" size=40 maxlength=80>
							<p>
							<?php echo $_smarty_tpl->tpl_vars['sCheckBoxFirstName']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['LDIncludeFirstName']->value;?>

							
														<?php echo $_smarty_tpl->tpl_vars['sHiddenInputs']->value;?>

						</form>
					</td>
				</tr>
			</tbody>
			</table>
		</td>
	</tr>
</table>
<p>
<?php echo $_smarty_tpl->tpl_vars['sCancelButton']->value;?>

<p>

<?php echo $_smarty_tpl->tpl_vars['LDSearchFound']->value;?>


<?php if ($_smarty_tpl->tpl_vars['bShowResult']->value) {?>
	<p>
	<table border=0 cellpadding=2 cellspacing=1>
		
				<tr class="reg_list_titlebar">
			<td><?php echo $_smarty_tpl->tpl_vars['LDCaseNr']->value;?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['LDSex']->value;?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['LDLastName']->value;?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['LDFirstName']->value;?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['LDBday']->value;?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['LDZipCode']->value;?>
</td>
			<td>&nbsp;<?php echo $_smarty_tpl->tpl_vars['LDOptions']->value;?>
</td>         
		</tr>

				<?php echo $_smarty_tpl->tpl_vars['sResultListRows']->value;?>


		<tr>
			<td colspan=6><?php echo $_smarty_tpl->tpl_vars['sPreviousPage']->value;?>
</td>
			<td align=right><?php echo $_smarty_tpl->tpl_vars['sNextPage']->value;?>
</td>
		</tr>
	</table>
<?php }?>
<hr>
<?php echo $_smarty_tpl->tpl_vars['sPostText']->value;?>


<?php }
}
