<?php
/* Smarty version 3.1.40, created on 2024-11-04 19:51:04
  from '/home/tim/code/care2x/gui/smarty_template/templates/default/common/submenu_row_spacer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_672925a8a89424_52938857',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6da7c179f2e9c08f58b07a0ec644f613f5a022e8' => 
    array (
      0 => '/home/tim/code/care2x/gui/smarty_template/templates/default/common/submenu_row_spacer.tpl',
      1 => 1726137535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_672925a8a89424_52938857 (Smarty_Internal_Template $_smarty_tpl) {
?><TR  height=1>
	<?php if ((isset($_smarty_tpl->tpl_vars['root_path']->value))) {?>
	<TD colSpan=3 class="vspace"><IMG height=1 src="<?php echo $_smarty_tpl->tpl_vars['root_path']->value;?>
gui/img/common/default/pixel.gif" width=5></TD>
	<?php } else { ?>
	<TD colSpan=3 class="vspace"><IMG height=1 src="../../gui/img/common/default/pixel.gif" width=5></TD>
	<?php }?>
</TR><?php }
}
