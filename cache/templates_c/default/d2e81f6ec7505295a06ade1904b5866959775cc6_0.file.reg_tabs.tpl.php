<?php
/* Smarty version 3.1.40, created on 2025-11-27 18:06:26
  from '/home/tim/code/care2x/gui/smarty_template/templates/default/registration_admission/reg_tabs.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_69289322572304_02657674',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd2e81f6ec7505295a06ade1904b5866959775cc6' => 
    array (
      0 => '/home/tim/code/care2x/gui/smarty_template/templates/default/registration_admission/reg_tabs.tpl',
      1 => 1726137535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69289322572304_02657674 (Smarty_Internal_Template $_smarty_tpl) {
?><table width="100%" cellspacing="0" cellpadding="0">
  <tbody>
  <?php if ($_smarty_tpl->tpl_vars['bShowTabs']->value) {?>
    <tr>
      <td height=24><?php echo $_smarty_tpl->tpl_vars['pbNew']->value;
echo $_smarty_tpl->tpl_vars['pbSearch']->value;
echo $_smarty_tpl->tpl_vars['pbAdvSearch']->value;
echo $_smarty_tpl->tpl_vars['sHSpacer']->value;
echo $_smarty_tpl->tpl_vars['pbSwitchMode']->value;?>
</td>
    </tr>
  <?php }?>
    <tr>
      <td <?php echo $_smarty_tpl->tpl_vars['sRegDividerClass']->value;?>
><img src="../../gui/img/common/default/p.gif" border=0 width=1 height=5><?php echo $_smarty_tpl->tpl_vars['sSubTitle']->value;
echo $_smarty_tpl->tpl_vars['sWarnText']->value;?>
</td>
    </tr>
  </tbody>
</table>
<?php }
}
