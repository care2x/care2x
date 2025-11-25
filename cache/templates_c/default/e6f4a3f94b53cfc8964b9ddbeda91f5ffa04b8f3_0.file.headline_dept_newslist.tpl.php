<?php
/* Smarty version 3.1.40, created on 2024-11-05 19:22:45
  from '/home/tim/code/care2x/gui/smarty_template/templates/default/news/headline_dept_newslist.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_672a7085aadfb9_97991415',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e6f4a3f94b53cfc8964b9ddbeda91f5ffa04b8f3' => 
    array (
      0 => '/home/tim/code/care2x/gui/smarty_template/templates/default/news/headline_dept_newslist.tpl',
      1 => 1726137535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_672a7085aadfb9_97991415 (Smarty_Internal_Template $_smarty_tpl) {
?>
<table width="100%">
  <tbody>
    <tr>
      <td valign="top" width="50%"><?php echo $_smarty_tpl->tpl_vars['sNews_1']->value;?>
</td>
      <td valign="top" width="50%"><?php echo $_smarty_tpl->tpl_vars['sNews_2']->value;?>
</td>
    </tr>
    <tr>
      <td valign="top" width="50%"><?php echo $_smarty_tpl->tpl_vars['sNews_3']->value;?>
</td>
      <td valign="top" width="50%"><?php echo $_smarty_tpl->tpl_vars['sNews_4']->value;?>
</td>
    </tr>
    <tr>
      <td colspan="2">
		
				
		<?php if ($_smarty_tpl->tpl_vars['bShowArchiveList']->value) {?>

			<?php echo $_smarty_tpl->tpl_vars['subtitle']->value;?>

			<table border=0 cellspacing=0 cellpadding=0>
			<tr>
			<td bgcolor=#0>
				<table border=0 cellspacing=1 cellpadding=5>
					<tr bgcolor=#ffffff>
						<td><b><?php echo $_smarty_tpl->tpl_vars['LDArticle']->value;?>
</b></td>
						<td>&nbsp;</td>
						<td><b><?php echo $_smarty_tpl->tpl_vars['LDWrittenBy']->value;?>
:</b></td>
						<td><b><?php echo $_smarty_tpl->tpl_vars['LDWrittenOn']->value;?>
:</b></td>
					</tr>
					<?php echo $_smarty_tpl->tpl_vars['sNewsArchiveList']->value;?>

				</table>
			</td>
			</tr>
			</table>

		<?php }?>
		
		
	  </td>
    </tr>
    <tr>
      <td colspan="2">
		<?php echo $_smarty_tpl->tpl_vars['sMainEditorLink']->value;?>

	  </td>
    </tr>
  </tbody>
</table>
<?php }
}
