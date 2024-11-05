<?php
/* Smarty version 3.1.40, created on 2024-11-04 22:35:42
  from '/home/tim/code/care2x/gui/smarty_template/templates/default/nursing/ward_occupancy.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_67294c3ece6895_95139230',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5494f110af014586a733eb390f13db9fc30a159a' => 
    array (
      0 => '/home/tim/code/care2x/gui/smarty_template/templates/default/nursing/ward_occupancy.tpl',
      1 => 1726137535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:nursing/ward_occupancy_list.tpl' => 1,
  ),
),false)) {
function content_67294c3ece6895_95139230 (Smarty_Internal_Template $_smarty_tpl) {
echo $_smarty_tpl->tpl_vars['sWarningPrompt']->value;?>

<table cellspacing="0" cellpadding="0" width="100%">
  <tbody>
    <tr valign="top">
      <td><?php $_smarty_tpl->_subTemplateRender("file:nursing/ward_occupancy_list.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?></td>
      <td align="right"><?php echo $_smarty_tpl->tpl_vars['sSubMenuBlock']->value;?>
</td>
    </tr>
  </tbody>
</table>
<p>
<?php echo $_smarty_tpl->tpl_vars['pbClose']->value;?>

<br>
<?php echo $_smarty_tpl->tpl_vars['sOpenWardMngmt']->value;?>

</p><?php }
}
