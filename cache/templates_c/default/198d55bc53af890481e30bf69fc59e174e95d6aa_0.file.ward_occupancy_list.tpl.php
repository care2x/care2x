<?php
/* Smarty version 3.1.40, created on 2024-11-04 22:35:42
  from '/home/tim/code/care2x/gui/smarty_template/templates/default/nursing/ward_occupancy_list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_67294c3ece8fa3_15748542',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '198d55bc53af890481e30bf69fc59e174e95d6aa' => 
    array (
      0 => '/home/tim/code/care2x/gui/smarty_template/templates/default/nursing/ward_occupancy_list.tpl',
      1 => 1726137535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67294c3ece8fa3_15748542 (Smarty_Internal_Template $_smarty_tpl) {
?>
<table cellspacing="0">
<tbody>
	<tr>
		<td class="wardlisttitlerow">&nbsp;</td>
		<td class="wardlisttitlerow"><?php echo $_smarty_tpl->tpl_vars['LDRoom']->value;?>
</td>
		<td class="wardlisttitlerow"><?php echo $_smarty_tpl->tpl_vars['LDBed']->value;?>
</td>
		<td class="wardlisttitlerow"><?php echo $_smarty_tpl->tpl_vars['LDFamilyName']->value;?>
, <?php echo $_smarty_tpl->tpl_vars['LDName']->value;?>
</td>
		<td class="wardlisttitlerow"><?php echo $_smarty_tpl->tpl_vars['LDBirthDate']->value;?>
</td>
		<td class="wardlisttitlerow"><?php echo $_smarty_tpl->tpl_vars['LDPatNr']->value;?>
</td>
		<td class="wardlisttitlerow"><?php echo $_smarty_tpl->tpl_vars['LDInsuranceType']->value;?>
</td>
		<td class="wardlisttitlerow"><?php echo $_smarty_tpl->tpl_vars['LDOptions']->value;?>
</td>
	</tr>

	<?php echo $_smarty_tpl->tpl_vars['sOccListRows']->value;?>


 </tbody>
</table>
<?php }
}
