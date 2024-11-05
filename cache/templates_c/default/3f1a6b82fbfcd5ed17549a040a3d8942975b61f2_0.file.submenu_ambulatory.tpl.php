<?php
/* Smarty version 3.1.40, created on 2024-11-04 19:53:48
  from '/home/tim/code/care2x/gui/smarty_template/templates/default/ambulatory/submenu_ambulatory.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_6729264c0e2034_30198129',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3f1a6b82fbfcd5ed17549a040a3d8942975b61f2' => 
    array (
      0 => '/home/tim/code/care2x/gui/smarty_template/templates/default/ambulatory/submenu_ambulatory.tpl',
      1 => 1726137535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:ambulatory/submenu_generic.tpl' => 1,
  ),
),false)) {
function content_6729264c0e2034_30198129 (Smarty_Internal_Template $_smarty_tpl) {
?><blockquote>
<table border=0 cellpadding=5>

  <tr>
    <td colspan=2>
		<?php $_smarty_tpl->_subTemplateRender("file:ambulatory/submenu_generic.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
	</td>
  </tr>
  
    <tr>
    <td width=50<?php echo '%>';?>

		<?php echo $_smarty_tpl->tpl_vars['sTopLeftSubMenu']->value;?>

	</td>
    <td width=50<?php echo '%>';?>

		<?php echo $_smarty_tpl->tpl_vars['sTopRightSubMenu']->value;?>

	</td>
  </tr>

	<tr>
    <td width=50<?php echo '%>';?>

		<?php echo $_smarty_tpl->tpl_vars['sMidLeftSubMenu']->value;?>

	</td>
    <td width=50<?php echo '%>';?>

		<?php echo $_smarty_tpl->tpl_vars['sMidRightSubMenu']->value;?>

	</td>
  </tr>

	<tr>
    <td width=50<?php echo '%>';?>

		<?php echo $_smarty_tpl->tpl_vars['sBottomLeftSubMenu']->value;?>

	</td>
    <td width=50<?php echo '%>';?>

		<?php echo $_smarty_tpl->tpl_vars['sBottomRightSubMenu']->value;?>

	</td>
  </tr>

</table>
<a href="<?php echo $_smarty_tpl->tpl_vars['breakfile']->value;?>
"><img <?php echo $_smarty_tpl->tpl_vars['gifClose2']->value;?>
 alt="<?php echo $_smarty_tpl->tpl_vars['LDCloseAlt']->value;?>
" <?php echo $_smarty_tpl->tpl_vars['dhtml']->value;?>
></a>
</blockquote><?php }
}
