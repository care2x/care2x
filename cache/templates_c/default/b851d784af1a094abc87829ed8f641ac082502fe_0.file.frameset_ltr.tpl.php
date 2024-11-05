<?php
/* Smarty version 3.1.40, created on 2024-11-04 15:03:44
  from '/home/tim/code/care2x/gui/smarty_template/templates/default/common/frameset_ltr.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_6728e250ac7d36_82397974',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b851d784af1a094abc87829ed8f641ac082502fe' => 
    array (
      0 => '/home/tim/code/care2x/gui/smarty_template/templates/default/common/frameset_ltr.tpl',
      1 => 1726137535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6728e250ac7d36_82397974 (Smarty_Internal_Template $_smarty_tpl) {
?>
<frameset cols="<?php echo $_smarty_tpl->tpl_vars['gui_frame_left_nav_width']->value;?>
,*" border="<?php echo $_smarty_tpl->tpl_vars['gui_frame_left_nav_border']->value;?>
">
	<FRAME  NAME = "STARTPAGE" <?php echo $_smarty_tpl->tpl_vars['sStartFrameSource']->value;?>
 MARGINHEIGHT="5"	MARGINWIDTH  ="5" SCROLLING="auto" >
	<FRAME NAME = "CONTENTS" <?php echo $_smarty_tpl->tpl_vars['sContentsFrameSource']->value;?>
>
</frameset><?php }
}
