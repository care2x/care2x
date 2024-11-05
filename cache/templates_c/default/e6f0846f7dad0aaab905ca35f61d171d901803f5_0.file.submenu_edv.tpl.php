<?php
/* Smarty version 3.1.40, created on 2024-11-04 19:51:25
  from '/home/tim/code/care2x/gui/smarty_template/templates/default/system_admin/submenu_edv.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_672925bd4fda22_57312058',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e6f0846f7dad0aaab905ca35f61d171d901803f5' => 
    array (
      0 => '/home/tim/code/care2x/gui/smarty_template/templates/default/system_admin/submenu_edv.tpl',
      1 => 1726137535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common/submenu_row_spacer.tpl' => 3,
  ),
),false)) {
function content_672925bd4fda22_57312058 (Smarty_Internal_Template $_smarty_tpl) {
?>		 <blockquote>
			<TABLE cellSpacing=0  width=600 class="submenu_frame" cellpadding="0">
			<TBODY>
			<TR>
				<TD>
					<TABLE cellSpacing=1 cellPadding=3 width=600>
					<TBODY class="submenu">

					<?php echo $_smarty_tpl->tpl_vars['LDQViewTxt']->value;?>


<!--  				<?php $_smarty_tpl->_subTemplateRender("file:common/submenu_row_spacer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

					<?php echo $_smarty_tpl->tpl_vars['LDDutyPlanTxt']->value;?>


					<?php $_smarty_tpl->_subTemplateRender("file:common/submenu_row_spacer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

					<?php echo $_smarty_tpl->tpl_vars['LDDocsForumTxt']->value;?>

-->
					<?php $_smarty_tpl->_subTemplateRender("file:common/submenu_row_spacer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

					<?php echo $_smarty_tpl->tpl_vars['LDNewsTxt']->value;?>


					</TBODY>
					</TABLE>
				</TD>
			</TR>
			</TBODY>
			</TABLE>

			<p>
			<a href="<?php echo $_smarty_tpl->tpl_vars['breakfile']->value;?>
"><img <?php echo $_smarty_tpl->tpl_vars['gifClose2']->value;?>
 alt="<?php echo $_smarty_tpl->tpl_vars['LDCloseAlt']->value;?>
" <?php echo $_smarty_tpl->tpl_vars['dhtml']->value;?>
></a>
			<p>
			</blockquote>
<?php }
}
