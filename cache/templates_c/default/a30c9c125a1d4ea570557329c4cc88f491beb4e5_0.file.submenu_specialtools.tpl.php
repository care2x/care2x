<?php
/* Smarty version 3.1.40, created on 2024-11-04 19:51:28
  from '/home/tim/code/care2x/gui/smarty_template/templates/default/common/submenu_specialtools.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_672925c04f8218_37459359',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a30c9c125a1d4ea570557329c4cc88f491beb4e5' => 
    array (
      0 => '/home/tim/code/care2x/gui/smarty_template/templates/default/common/submenu_specialtools.tpl',
      1 => 1726137535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common/submenu_row_spacer.tpl' => 15,
  ),
),false)) {
function content_672925c04f8218_37459359 (Smarty_Internal_Template $_smarty_tpl) {
?><blockquote>
<TABLE cellSpacing=0 cellPadding=0 border=0 class="submenu_frame">
	<TBODY>
	<TR>
		<TD>
			<TABLE cellSpacing=1 cellPadding=3>
 				<TBODY class="submenu">
					<?php echo $_smarty_tpl->tpl_vars['LDPlugins']->value;?>

					<?php $_smarty_tpl->_subTemplateRender('file:common/submenu_row_spacer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
					<?php echo $_smarty_tpl->tpl_vars['LDBilling']->value;?>

					<?php $_smarty_tpl->_subTemplateRender('file:common/submenu_row_spacer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
					<?php echo $_smarty_tpl->tpl_vars['LDPersonellMngmnt']->value;?>

					<?php $_smarty_tpl->_subTemplateRender('file:common/submenu_row_spacer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
					<?php echo $_smarty_tpl->tpl_vars['LDInsuranceCoMngr']->value;?>

					<?php $_smarty_tpl->_subTemplateRender('file:common/submenu_row_spacer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
					<?php echo $_smarty_tpl->tpl_vars['LDAddressMngr']->value;?>

					<?php $_smarty_tpl->_subTemplateRender('file:common/submenu_row_spacer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
					<?php echo $_smarty_tpl->tpl_vars['LDImmunizationMngr']->value;?>

					<?php $_smarty_tpl->_subTemplateRender('file:common/submenu_row_spacer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
					<?php echo $_smarty_tpl->tpl_vars['LDPhotoLab']->value;?>

					<?php $_smarty_tpl->_subTemplateRender('file:common/submenu_row_spacer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
					<?php echo $_smarty_tpl->tpl_vars['LDWebCam']->value;?>

					<?php $_smarty_tpl->_subTemplateRender('file:common/submenu_row_spacer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
					<?php echo $_smarty_tpl->tpl_vars['LDStandbyDuty']->value;?>

					<?php $_smarty_tpl->_subTemplateRender('file:common/submenu_row_spacer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
					<?php echo $_smarty_tpl->tpl_vars['LDCalendar']->value;?>

					<?php $_smarty_tpl->_subTemplateRender('file:common/submenu_row_spacer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
					<?php echo $_smarty_tpl->tpl_vars['LDNews']->value;?>

					<?php $_smarty_tpl->_subTemplateRender('file:common/submenu_row_spacer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
					<?php echo $_smarty_tpl->tpl_vars['LDCalc']->value;?>

					<?php $_smarty_tpl->_subTemplateRender('file:common/submenu_row_spacer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

					<?php if ($_smarty_tpl->tpl_vars['bShowClock']->value) {?>
						<?php echo $_smarty_tpl->tpl_vars['LDClock']->value;?>

						<?php $_smarty_tpl->_subTemplateRender('file:common/submenu_row_spacer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
					<?php }?>

					<?php echo $_smarty_tpl->tpl_vars['LDUserConfigOpt']->value;?>

					<?php $_smarty_tpl->_subTemplateRender('file:common/submenu_row_spacer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
					<?php echo $_smarty_tpl->tpl_vars['LDAccessPw']->value;?>

					<?php $_smarty_tpl->_subTemplateRender('file:common/submenu_row_spacer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
					<?php echo $_smarty_tpl->tpl_vars['LDNewsgroup']->value;?>


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
</blockquote>
<?php }
}
