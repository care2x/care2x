<?php
/* Smarty version 3.1.40, created on 2024-11-04 22:35:15
  from '/home/tim/code/care2x/gui/smarty_template/templates/default/nursing/nursing.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_67294c230fad47_75082414',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '15fdf5cda5a425fa23ba46b9c9ee334a23a5b00a' => 
    array (
      0 => '/home/tim/code/care2x/gui/smarty_template/templates/default/nursing/nursing.tpl',
      1 => 1726137535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common/submenu_row_spacer.tpl' => 5,
  ),
),false)) {
function content_67294c230fad47_75082414 (Smarty_Internal_Template $_smarty_tpl) {
?>		 <blockquote>
			<TABLE cellSpacing=0  width=600 class="submenu_frame" cellpadding="0">
			<TBODY>
			<TR>
				<TD>
					<TABLE cellSpacing=1 cellPadding=3 width=600>
					<TBODY class="submenu">

					<?php echo $_smarty_tpl->tpl_vars['LDNursingStations']->value;?>


					<TR>
						<td colspan=3>
							<table border=0 cellpadding=1 cellspacing=1>
							<?php echo $_smarty_tpl->tpl_vars['tblWardInfo']->value;?>

							</table>
						</td>
					</TR>

					<?php $_smarty_tpl->_subTemplateRender("file:common/submenu_row_spacer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

					<?php echo $_smarty_tpl->tpl_vars['LDQuickView']->value;?>


					<?php $_smarty_tpl->_subTemplateRender("file:common/submenu_row_spacer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

					<?php echo $_smarty_tpl->tpl_vars['LDSearchPatient']->value;?>


					<?php $_smarty_tpl->_subTemplateRender("file:common/submenu_row_spacer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

					<?php echo $_smarty_tpl->tpl_vars['LDArchive']->value;?>


					<?php $_smarty_tpl->_subTemplateRender("file:common/submenu_row_spacer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

					<?php echo $_smarty_tpl->tpl_vars['LDNursesList']->value;?>


					<?php $_smarty_tpl->_subTemplateRender("file:common/submenu_row_spacer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

					<?php echo $_smarty_tpl->tpl_vars['LDNews']->value;?>


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
