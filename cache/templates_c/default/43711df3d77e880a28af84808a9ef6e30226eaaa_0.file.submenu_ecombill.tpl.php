<?php
/* Smarty version 3.1.40, created on 2024-11-05 18:00:08
  from '/home/tim/code/care2x/gui/smarty_template/templates/default/ecombill/submenu_ecombill.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_672a5d2859cae8_87517275',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '43711df3d77e880a28af84808a9ef6e30226eaaa' => 
    array (
      0 => '/home/tim/code/care2x/gui/smarty_template/templates/default/ecombill/submenu_ecombill.tpl',
      1 => 1726137535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common/submenu_row_spacer.tpl' => 4,
  ),
),false)) {
function content_672a5d2859cae8_87517275 (Smarty_Internal_Template $_smarty_tpl) {
?>		 <blockquote>
			<TABLE cellSpacing=0  width=600 class="submenu_frame" cellpadding="0">
			<TBODY>
			<TR>
				<TD>
					<TABLE cellSpacing=1 cellPadding=3 width=600>
					<TBODY class="submenu">

					<?php echo $_smarty_tpl->tpl_vars['LDPharmaOrder']->value;?>


					<?php $_smarty_tpl->_subTemplateRender("file:common/submenu_row_spacer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

					<?php echo $_smarty_tpl->tpl_vars['LDHow2Order']->value;?>


					<?php $_smarty_tpl->_subTemplateRender("file:common/submenu_row_spacer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

					<?php echo $_smarty_tpl->tpl_vars['LDOrderCat']->value;?>


					<?php $_smarty_tpl->_subTemplateRender("file:common/submenu_row_spacer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

					<?php echo $_smarty_tpl->tpl_vars['LDOrderArchive']->value;?>


					<?php $_smarty_tpl->_subTemplateRender("file:common/submenu_row_spacer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

					<?php echo $_smarty_tpl->tpl_vars['LDPharmaDb']->value;?>


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
