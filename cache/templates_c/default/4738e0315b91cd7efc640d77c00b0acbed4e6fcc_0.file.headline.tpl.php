<?php
/* Smarty version 3.1.40, created on 2025-11-27 18:06:21
  from '/home/tim/code/care2x/gui/smarty_template/templates/default/news/headline.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_6928931d882a59_95079131',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4738e0315b91cd7efc640d77c00b0acbed4e6fcc' => 
    array (
      0 => '/home/tim/code/care2x/gui/smarty_template/templates/default/news/headline.tpl',
      1 => 1726137535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:news/headline_newslist.tpl' => 1,
  ),
),false)) {
function content_6928931d882a59_95079131 (Smarty_Internal_Template $_smarty_tpl) {
?>
<TABLE CELLSPACING=3 cellpadding=0 border="0" width="<?php echo $_smarty_tpl->tpl_vars['news_normal_display_width']->value;?>
">

	<tr>
		<td VALIGN="top" width="100%">

			<?php $_smarty_tpl->_subTemplateRender("file:news/headline_newslist.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

		</td>
		<!--      Vertical spacer column      -->
		<TD   width=1  background="../../gui/img/common/biju/vert_reuna_20b.gif"></TD>

		<TD VALIGN="top">

			<?php echo $_smarty_tpl->tpl_vars['sSubMenuBlock']->value;?>


		</TD>
	</tr>
</table>
<?php }
}
