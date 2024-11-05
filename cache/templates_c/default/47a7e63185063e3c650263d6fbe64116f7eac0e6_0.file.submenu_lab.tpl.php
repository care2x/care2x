<?php
/* Smarty version 3.1.40, created on 2024-11-04 22:15:56
  from '/home/tim/code/care2x/gui/smarty_template/templates/default/laboratory/submenu_lab.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_6729479ce66933_60905362',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '47a7e63185063e3c650263d6fbe64116f7eac0e6' => 
    array (
      0 => '/home/tim/code/care2x/gui/smarty_template/templates/default/laboratory/submenu_lab.tpl',
      1 => 1726137535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common/submenu_row_spacer.tpl' => 7,
  ),
),false)) {
function content_6729479ce66933_60905362 (Smarty_Internal_Template $_smarty_tpl) {
?>			<blockquote>
			<TABLE cellSpacing=0  width=600 class="submenu_frame" cellpadding="0">
			<TBODY>
			<TR>
				<TD>
					<TABLE cellSpacing=1 cellPadding=3 width=600>
					<TBODY class="submenu">
						<TR>
							<TD class="submenu_title" colspan=2><?php echo $_smarty_tpl->tpl_vars['LDMedLab']->value;?>
</TD>
						</tr>
						<TR>
							<TD class="submenu_item" width=35<?php echo '%>';?>
<nobr><?php echo $_smarty_tpl->tpl_vars['LDMedLabTestRequest']->value;?>
</nobr></TD>
							<TD><?php echo $_smarty_tpl->tpl_vars['LDTestRequestChemLabTxt']->value;?>
</TD>
						</tr>
						<?php $_smarty_tpl->_subTemplateRender("file:common/submenu_row_spacer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

						<TR>
							<TD class="submenu_item" width=35<?php echo '%>';?>
<nobr><?php echo $_smarty_tpl->tpl_vars['LDMedLabTestReception']->value;?>
</nobr></TD>
							<TD><?php echo $_smarty_tpl->tpl_vars['LDTestReceptionTxt']->value;?>
</TD>
						</tr>
						<?php $_smarty_tpl->_subTemplateRender("file:common/submenu_row_spacer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

						<TR>
							<TD class="submenu_item" width=35<?php echo '%>';?>
<nobr><?php echo $_smarty_tpl->tpl_vars['LDSeeData']->value;?>
</nobr></TD>
							<TD><?php echo $_smarty_tpl->tpl_vars['LDSeeLabData']->value;?>
</TD>
						</tr>
						<?php $_smarty_tpl->_subTemplateRender("file:common/submenu_row_spacer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

						<TR>
							<TD class="submenu_item" width=35<?php echo '%>';?>
<nobr><?php echo $_smarty_tpl->tpl_vars['LDNewData']->value;?>
</nobr></TD>
							<TD><?php echo $_smarty_tpl->tpl_vars['LDEnterLabData']->value;?>
</TD>
						</tr>

					</TBODY>
					</TABLE>
				</TD>
			</TR>
			</TBODY>
			</TABLE>
			<p>
			<TABLE cellSpacing=0  width=600 class="submenu_frame" cellpadding="0">
			<TBODY>
			<TR>
				<TD>
					<TABLE cellSpacing=1 cellPadding=3 width=600>
					<TBODY class="submenu">
						<TR>
							<TD class="submenu_title" colspan=2><?php echo $_smarty_tpl->tpl_vars['LDPathLab']->value;?>
</TD>
						</tr>
						<TR>
							<TD class="submenu_item" width=35<?php echo '%>';?>
<nobr><?php echo $_smarty_tpl->tpl_vars['LDPathLabTestRequest']->value;?>
</nobr></TD>
							<TD><?php echo $_smarty_tpl->tpl_vars['LDTestRequestPathoTxt']->value;?>
</TD>
						</tr>
						<?php $_smarty_tpl->_subTemplateRender("file:common/submenu_row_spacer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

						<TR>
							<TD class="submenu_item" width=35<?php echo '%>';?>
<nobr><?php echo $_smarty_tpl->tpl_vars['LDPathLabTestReception']->value;?>
</nobr></TD>
							<TD><?php echo $_smarty_tpl->tpl_vars['LDTestReceptionTxt']->value;?>
</TD>
						</tr>

					</TBODY>
					</TABLE>
				</TD>
			</TR>
			</TBODY>
			</TABLE>
			<p>
			<TABLE cellSpacing=0  width=600 class="submenu_frame" cellpadding="0">
			<TBODY>
			<TR>
				<TD>
					<TABLE cellSpacing=1 cellPadding=3 width=600>
					<TBODY class="submenu">
						<TR>
							<TD class="submenu_title" colspan=2><?php echo $_smarty_tpl->tpl_vars['LDBacLab']->value;?>
</TD>
						</tr>
						<TR>
							<TD class="submenu_item" width=35<?php echo '%>';?>
<nobr><?php echo $_smarty_tpl->tpl_vars['LDBacLabTestRequest']->value;?>
</nobr></TD>
							<TD><?php echo $_smarty_tpl->tpl_vars['LDTestRequestBacterioTxt']->value;?>
</TD>
						</tr>
						<?php $_smarty_tpl->_subTemplateRender("file:common/submenu_row_spacer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

						<TR>
							<TD class="submenu_item" width=35<?php echo '%>';?>
<nobr><?php echo $_smarty_tpl->tpl_vars['LDBacLabTestReception']->value;?>
</nobr></TD>
							<TD><?php echo $_smarty_tpl->tpl_vars['LDTestReceptionTxt']->value;?>
</TD>
						</tr>

					</TBODY>
					</TABLE>
				</TD>
			</TR>
			</TBODY>
			</TABLE>
			<p>
			<TABLE cellSpacing=0  width=600 class="submenu_frame" cellpadding="0">
			<TBODY>
			<TR>
				<TD>
					<TABLE cellSpacing=1 cellPadding=3 width=600>
					<TBODY class="submenu">
						<TR>
							<TD class="submenu_title" colspan=2><?php echo $_smarty_tpl->tpl_vars['LDBloodBank']->value;?>
</TD>
						</tr>
						<TR>
							<TD class="submenu_item" width=35<?php echo '%>';?>
<nobr><?php echo $_smarty_tpl->tpl_vars['LDBloodRequest']->value;?>
</nobr></TD>
							<TD><?php echo $_smarty_tpl->tpl_vars['LDBloodRequestTxt']->value;?>
</TD>
						</tr>
						<?php $_smarty_tpl->_subTemplateRender("file:common/submenu_row_spacer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

						<TR>
							<TD class="submenu_item" width=35<?php echo '%>';?>
<nobr><?php echo $_smarty_tpl->tpl_vars['LDBloodTestReception']->value;?>
</nobr></TD>
							<TD><?php echo $_smarty_tpl->tpl_vars['LDTestReceptionTxt']->value;?>
</TD>
						</tr>

					</TBODY>
					</TABLE>
				</TD>
			</TR>
			</TBODY>
			</TABLE>
			<p>
			<TABLE cellSpacing=0  width=600 class="submenu_frame" cellpadding="0">
			<TBODY>
			<TR>
				<TD>
					<TABLE cellSpacing=1 cellPadding=3 width=600>
					<TBODY class="submenu">
						<TR>
							<TD class="submenu_title" colspan=2><?php echo $_smarty_tpl->tpl_vars['LDAdministration']->value;?>
</TD>
						</tr>
						<TR>
							<TD class="submenu_item" width=35% ><nobr><?php echo $_smarty_tpl->tpl_vars['LDTestParameters']->value;?>
</nobr></TD>
							<TD><?php echo $_smarty_tpl->tpl_vars['LDTestParametersTxt']->value;?>
</TD>
						</tr>
						<?php $_smarty_tpl->_subTemplateRender("file:common/submenu_row_spacer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>						
						<TR>
							<TD class="submenu_item" width=35% ><nobr><?php echo $_smarty_tpl->tpl_vars['LDTestGroups']->value;?>
</nobr></TD>
							<TD><?php echo $_smarty_tpl->tpl_vars['LDTestGroupsTxt']->value;?>
</TD>
						</tr>
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
