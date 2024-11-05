<?php
/* Smarty version 3.1.40, created on 2024-11-04 15:03:44
  from '/home/tim/code/care2x/gui/smarty_template/templates/default/common/baseframe.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_6728e250ac07e1_18148803',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '00871172fb91448571637d73536c5414e87c9fe6' => 
    array (
      0 => '/home/tim/code/care2x/gui/smarty_template/templates/default/common/baseframe.tpl',
      1 => 1726137535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common/metaheaders.tpl' => 1,
  ),
),false)) {
function content_6728e250ac07e1_18148803 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php echo $_smarty_tpl->tpl_vars['HTMLtag']->value;?>

<HEAD>
 <TITLE><?php echo $_smarty_tpl->tpl_vars['sWindowTitle']->value;?>
</TITLE>
 <?php $_smarty_tpl->_subTemplateRender("file:common/metaheaders.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
 <?php echo $_smarty_tpl->tpl_vars['setCharSet']->value;?>


</HEAD>


<?php $_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['sBaseFramesetTemplate']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

<noframes>
<BODY bgcolor=white>
<?php echo $_smarty_tpl->tpl_vars['LDNoFrame']->value;?>
<BR>
<A HREF="contents.htm"> OK</A>
</BODY>
</noframes>

</HTML><?php }
}
