<?php
/* Smarty version 3.1.40, created on 2025-11-27 18:06:26
  from '/home/tim/code/care2x/gui/smarty_template/templates/default/common/header_topblock.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_692893225696c9_82007034',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0966067a9eb27624caa035f697901ab9a7cb70fe' => 
    array (
      0 => '/home/tim/code/care2x/gui/smarty_template/templates/default/common/header_topblock.tpl',
      1 => 1726137535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_692893225696c9_82007034 (Smarty_Internal_Template $_smarty_tpl) {
?> <table cellspacing="0"  class="titlebar" border=0>
 <tr valign=top  class="titlebar" >
  <td bgcolor="<?php echo $_smarty_tpl->tpl_vars['top_bgcolor']->value;?>
" >
    &nbsp;<?php echo $_smarty_tpl->tpl_vars['sTitleImage']->value;?>
&nbsp;<font color="<?php echo $_smarty_tpl->tpl_vars['top_txtcolor']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['sToolbarTitle']->value;?>
</font>
     <?php if ($_smarty_tpl->tpl_vars['Subtitle']->value) {?>
      - <?php echo $_smarty_tpl->tpl_vars['Subtitle']->value;?>

     <?php }?>
  </td>
  <td bgcolor="<?php echo $_smarty_tpl->tpl_vars['top_bgcolor']->value;?>
" align=right><?php if ($_smarty_tpl->tpl_vars['pbAux2']->value) {?><a
   href="<?php echo $_smarty_tpl->tpl_vars['pbAux2']->value;?>
"><img <?php echo $_smarty_tpl->tpl_vars['gifAux2']->value;?>
 alt="" <?php echo $_smarty_tpl->tpl_vars['dhtml']->value;?>
 ></a><?php }
if ($_smarty_tpl->tpl_vars['pbAux1']->value) {?><a
   href="<?php echo $_smarty_tpl->tpl_vars['pbAux1']->value;?>
"><img <?php echo $_smarty_tpl->tpl_vars['gifAux1']->value;?>
 alt="" <?php echo $_smarty_tpl->tpl_vars['dhtml']->value;?>
 ></a><?php }
if ($_smarty_tpl->tpl_vars['pbBack']->value) {?><a
   href="<?php echo $_smarty_tpl->tpl_vars['pbBack']->value;?>
"><img <?php echo $_smarty_tpl->tpl_vars['gifBack2']->value;?>
 alt="" <?php echo $_smarty_tpl->tpl_vars['dhtml']->value;?>
 ></a><?php }
if ($_smarty_tpl->tpl_vars['pbHelp']->value) {?><a
   href="<?php echo $_smarty_tpl->tpl_vars['pbHelp']->value;?>
"><img <?php echo $_smarty_tpl->tpl_vars['gifHilfeR']->value;?>
 alt="" <?php echo $_smarty_tpl->tpl_vars['dhtml']->value;?>
></a><?php }
if ($_smarty_tpl->tpl_vars['breakfile']->value) {?><a
   href="<?php echo $_smarty_tpl->tpl_vars['breakfile']->value;?>
" <?php echo $_smarty_tpl->tpl_vars['sCloseTarget']->value;?>
><img <?php echo $_smarty_tpl->tpl_vars['gifClose2']->value;?>
 alt="<?php echo $_smarty_tpl->tpl_vars['LDCloseAlt']->value;?>
" <?php echo $_smarty_tpl->tpl_vars['dhtml']->value;?>
></a><?php }?>
  </td>
 </tr>
 </table><?php }
}
