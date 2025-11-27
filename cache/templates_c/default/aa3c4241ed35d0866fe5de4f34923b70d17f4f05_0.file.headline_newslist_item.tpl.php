<?php
/* Smarty version 3.1.40, created on 2025-11-27 18:06:21
  from '/home/tim/code/care2x/gui/smarty_template/templates/default/news/headline_newslist_item.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_6928931d71ba57_35287094',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'aa3c4241ed35d0866fe5de4f34923b70d17f4f05' => 
    array (
      0 => '/home/tim/code/care2x/gui/smarty_template/templates/default/news/headline_newslist_item.tpl',
      1 => 1726137535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6928931d71ba57_35287094 (Smarty_Internal_Template $_smarty_tpl) {
?>
<img <?php echo $_smarty_tpl->tpl_vars['sHeadlineImg']->value;?>
 align="left" border=0 hspace=10 <?php echo $_smarty_tpl->tpl_vars['sImgWidth']->value;?>
>
<?php echo $_smarty_tpl->tpl_vars['sHeadlineItemTitle']->value;?>


<?php if ($_smarty_tpl->tpl_vars['sPreface']->value) {?>
	<br>
	<?php echo $_smarty_tpl->tpl_vars['sPreface']->value;?>

<?php }?>

<?php if ($_smarty_tpl->tpl_vars['sNewsPreview']->value) {?>
	<p>
	<?php echo $_smarty_tpl->tpl_vars['sNewsPreview']->value;?>

<?php }?>

<br>
<font size=1><?php echo $_smarty_tpl->tpl_vars['sEditorLink']->value;?>
</font>
<?php }
}
