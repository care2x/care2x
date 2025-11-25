<?php
/* Smarty version 3.1.40, created on 2024-11-05 19:23:10
  from '/home/tim/code/care2x/gui/smarty_template/templates/default/registration_admission/admit_search_list_row.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_672a709e9fd956_30916141',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3b053bf290b7a78e77506212bd20e3ef592fe51e' => 
    array (
      0 => '/home/tim/code/care2x/gui/smarty_template/templates/default/registration_admission/admit_search_list_row.tpl',
      1 => 1726137535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_672a709e9fd956_30916141 (Smarty_Internal_Template $_smarty_tpl) {
?>
<tr  <?php if ($_smarty_tpl->tpl_vars['toggle']->value) {?> class="wardlistrow2" <?php } else { ?> class="wardlistrow1" <?php }?>>
	<td>&nbsp;<?php echo $_smarty_tpl->tpl_vars['sCaseNr']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['sOutpatientIcon']->value;?>
 <font size=1 color="red"><?php echo $_smarty_tpl->tpl_vars['LDAmbulant']->value;?>
</font></td>
	<td>&nbsp;<?php echo $_smarty_tpl->tpl_vars['sSex']->value;?>
</td>
	<td>&nbsp;<?php echo $_smarty_tpl->tpl_vars['sLastName']->value;?>
</td>
	<td>&nbsp;<?php echo $_smarty_tpl->tpl_vars['sFirstName']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['sCrossIcon']->value;?>
</td>
	<td>&nbsp;<?php echo $_smarty_tpl->tpl_vars['sBday']->value;?>
</td>
	<td>&nbsp;<?php echo $_smarty_tpl->tpl_vars['sZipCode']->value;?>
</td>
	<td align="center">&nbsp;<?php echo $_smarty_tpl->tpl_vars['sOptions']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['sHiddenBarcode']->value;?>
</td>
</tr>
<?php }
}
