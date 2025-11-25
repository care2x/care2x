<?php
/* Smarty version 3.1.40, created on 2025-11-25 10:20:17
  from '/home/tim/code/care2x/gui/smarty_template/templates/default/news/headline_news.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_692582e103bba8_30567582',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '76d08bb2cc464c0ceb7ae381c3e146402bc6fc48' => 
    array (
      0 => '/home/tim/code/care2x/gui/smarty_template/templates/default/news/headline_news.tpl',
      1 => 1726137535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:news/headline_titleblock.tpl' => 1,
  ),
),false)) {
function content_692582e103bba8_30567582 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['bShowPrompt']->value) {?>
<table>
	<tr>
		<td><?php echo $_smarty_tpl->tpl_vars['sMascotImg']->value;?>
</td>
		<td  class="prompt">
			<?php echo $_smarty_tpl->tpl_vars['LDArticleSaved']->value;?>

			<hr>
		</td>
	</tr>
</table>
<?php }?>

<TABLE CELLSPACING=3 cellpadding=0 border="0" width="<?php echo $_smarty_tpl->tpl_vars['news_normal_display_width']->value;?>
">

	<tr>
		<td VALIGN="top" width="100%">

			<?php $_smarty_tpl->_subTemplateRender("file:news/headline_titleblock.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
			<p>
			<?php $_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['sNewsBodyTemplate']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
			<p>
			<?php echo $_smarty_tpl->tpl_vars['sBackLink']->value;?>


		</td>

		<!--      Vertical spacer column      -->
		<TD   width=1  background="../gui/img/common/biju/vert_reuna_20b.gif">&nbsp;</TD>

		<TD VALIGN="top">

			<?php echo $_smarty_tpl->tpl_vars['sSubMenuBlock']->value;?>


		</TD>
	</tr>
</table>
<?php }
}
