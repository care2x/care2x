<?php
/* Smarty version 3.1.40, created on 2024-11-05 18:00:11
  from '/home/tim/code/care2x/gui/smarty_template/templates/default/ecombill/create_item.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_672a5d2b262302_70672536',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '596e44e447e5ccad99101a18afc703caa2820ec1' => 
    array (
      0 => '/home/tim/code/care2x/gui/smarty_template/templates/default/ecombill/create_item.tpl',
      1 => 1726137535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_672a5d2b262302_70672536 (Smarty_Internal_Template $_smarty_tpl) {
?><ul>
<div class="prompt"><?php echo $_smarty_tpl->tpl_vars['FormTitle']->value;?>
</div>

<?php echo $_smarty_tpl->tpl_vars['sFormTag']->value;?>

	<table cellpadding="5"  border="0" cellspacing=1>
		<tr>
			<td bgcolor=#dddddd >
				<?php echo $_smarty_tpl->tpl_vars['LDName']->value;?>
:<br>
				<input type="text" name="LabTestName" size=30 maxlength=30><p>
				<?php echo $_smarty_tpl->tpl_vars['LDCode']->value;?>
:<br>
				<input type="text" name="TestCode" size=30 maxlength=14><br>
			</td>

			<td bgcolor=#dddddd >
				<?php echo $_smarty_tpl->tpl_vars['LDPriceUnit']->value;?>
:<br>
				<input type="text" name="LabPrice" size=30 ><p>
				<?php echo $_smarty_tpl->tpl_vars['LDEnterValueDiscount']->value;?>
:<br>
				<input type="text" name="Discount" size=30>
			</td>
		</tr>
	</table>
<p>
<?php echo $_smarty_tpl->tpl_vars['sHiddenInputs']->value;?>

<p>
<?php echo $_smarty_tpl->tpl_vars['pbSubmit']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['pbCancel']->value;?>

</form>

</ul><?php }
}
