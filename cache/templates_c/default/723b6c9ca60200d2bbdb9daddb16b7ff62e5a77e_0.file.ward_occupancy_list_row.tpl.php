<?php
/* Smarty version 3.1.40, created on 2024-11-04 22:35:42
  from '/home/tim/code/care2x/gui/smarty_template/templates/default/nursing/ward_occupancy_list_row.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_67294c3ecd4376_94878303',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '723b6c9ca60200d2bbdb9daddb16b7ff62e5a77e' => 
    array (
      0 => '/home/tim/code/care2x/gui/smarty_template/templates/default/nursing/ward_occupancy_list_row.tpl',
      1 => 1726137535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67294c3ecd4376_94878303 (Smarty_Internal_Template $_smarty_tpl) {
?>
 <?php if ($_smarty_tpl->tpl_vars['bToggleRowClass']->value) {?>
	<tr class="wardlistrow1">
 <?php } else { ?>
	<tr class="wardlistrow2">
 <?php }?>
		<td><?php echo $_smarty_tpl->tpl_vars['sMiniColorBars']->value;?>
</td>
		<td>&nbsp;<?php echo $_smarty_tpl->tpl_vars['sRoom']->value;?>
</td>
		<td>&nbsp;<?php echo $_smarty_tpl->tpl_vars['sBed']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['sBedIcon']->value;?>
</td>
		<td>&nbsp;<?php echo $_smarty_tpl->tpl_vars['sTitle']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['sFamilyName']->value;
echo $_smarty_tpl->tpl_vars['cComma']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['sName']->value;?>
</td>
		<td>&nbsp;<?php echo $_smarty_tpl->tpl_vars['sBirthDate']->value;?>
</td>
		<td>&nbsp;<?php echo $_smarty_tpl->tpl_vars['sPatNr']->value;?>
</td>
		<td>&nbsp;<?php echo $_smarty_tpl->tpl_vars['sInsuranceType']->value;?>
</td>
		<td>&nbsp;<?php echo $_smarty_tpl->tpl_vars['sYellowPaper']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['sTarget']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['sChartFolderIcon']->value;?>
<br>
		<?php echo $_smarty_tpl->tpl_vars['sAdmitDataIcon']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['sTransferIcon']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['sDischargeIcon']->value;?>

		</td>
		</tr>
		<tr>
		<td colspan="8" class="thinrow_vspacer"><?php echo $_smarty_tpl->tpl_vars['sOnePixel']->value;?>
</td>
	</tr>
<?php }
}
