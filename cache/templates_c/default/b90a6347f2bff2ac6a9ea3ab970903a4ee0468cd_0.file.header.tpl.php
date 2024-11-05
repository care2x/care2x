<?php
/* Smarty version 3.1.40, created on 2024-11-04 19:50:50
  from '/home/tim/code/care2x/gui/smarty_template/templates/default/common/header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_6729259a22a836_00557244',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b90a6347f2bff2ac6a9ea3ab970903a4ee0468cd' => 
    array (
      0 => '/home/tim/code/care2x/gui/smarty_template/templates/default/common/header.tpl',
      1 => 1726137535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common/metaheaders.tpl' => 1,
  ),
),false)) {
function content_6729259a22a836_00557244 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php echo $_smarty_tpl->tpl_vars['HTMLtag']->value;?>

<HEAD>
 <TITLE><?php echo $_smarty_tpl->tpl_vars['sWindowTitle']->value;?>
 - <?php echo $_smarty_tpl->tpl_vars['Name']->value;?>
</TITLE>
 <?php $_smarty_tpl->_subTemplateRender("file:common/metaheaders.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
 <?php echo $_smarty_tpl->tpl_vars['setCharSet']->value;?>


 <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['JavaScript']->value, 'currentJS');
$_smarty_tpl->tpl_vars['currentJS']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['currentJS']->value) {
$_smarty_tpl->tpl_vars['currentJS']->do_else = false;
?>
 	<?php echo $_smarty_tpl->tpl_vars['currentJS']->value;?>

 <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

</HEAD>
<BODY  <?php echo $_smarty_tpl->tpl_vars['bgcolor']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['sLinkColors']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['sOnLoadJs']->value;?>
>
<?php }
}
