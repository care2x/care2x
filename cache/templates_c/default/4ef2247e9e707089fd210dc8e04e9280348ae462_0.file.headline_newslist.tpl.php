<?php
/* Smarty version 3.1.40, created on 2025-11-27 18:06:21
  from '/home/tim/code/care2x/gui/smarty_template/templates/default/news/headline_newslist.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_6928931d8ae3a3_60643009',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4ef2247e9e707089fd210dc8e04e9280348ae462' => 
    array (
      0 => '/home/tim/code/care2x/gui/smarty_template/templates/default/news/headline_newslist.tpl',
      1 => 1726137535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:news/headline_titleblock.tpl' => 1,
  ),
),false)) {
function content_6928931d8ae3a3_60643009 (Smarty_Internal_Template $_smarty_tpl) {
?><table width=100<?php echo '%>';?>

	<tr>
		<td>
			<?php $_smarty_tpl->_subTemplateRender("file:news/headline_titleblock.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		</td>
	</tr>

	<tr valign=top>
		<td>
			<?php echo $_smarty_tpl->tpl_vars['sNews_1']->value;?>

			<hr>
		</td>
	</tr>

	<tr valign=top>
	<td>
			<?php echo $_smarty_tpl->tpl_vars['sNews_2']->value;?>

			<hr>
		</td>
	</tr>

	<tr valign=top>
		<td>
			<?php echo $_smarty_tpl->tpl_vars['sNews_3']->value;?>

			<hr>
		</td>
	</tr>
	
</table>
<?php }
}
