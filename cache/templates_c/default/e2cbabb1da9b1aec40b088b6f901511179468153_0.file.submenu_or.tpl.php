<?php
/* Smarty version 3.1.40, created on 2024-11-04 22:19:37
  from '/home/tim/code/care2x/gui/smarty_template/templates/default/or/submenu_or.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_67294879e87a45_38858696',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e2cbabb1da9b1aec40b088b6f901511179468153' => 
    array (
      0 => '/home/tim/code/care2x/gui/smarty_template/templates/default/or/submenu_or.tpl',
      1 => 1726137535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common/submenu_row_spacer.tpl' => 9,
  ),
),false)) {
function content_67294879e87a45_38858696 (Smarty_Internal_Template $_smarty_tpl) {
?>
<blockquote>
<div class="prompt"><?php echo $_smarty_tpl->tpl_vars['LDOrDocs']->value;?>
</div>
<TABLE cellSpacing=0 width=600 class="submenu_frame" cellpadding="0">
	<TBODY>
		<TR>
			<TD>
			<TABLE cellSpacing=1 cellPadding=3 width=600>
				<TBODY class="submenu">

					<TR>
						<TD class="submenu_item" width=35<?php echo '%>';
echo $_smarty_tpl->tpl_vars['LDOrDocument']->value;?>
</TD>
						<TD><?php echo $_smarty_tpl->tpl_vars['LDOrDocumentTxt']->value;?>
</TD>
					</tr>
					<?php $_smarty_tpl->_subTemplateRender("file:common/submenu_row_spacer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
					<tr>
						<td colspan="2"><?php echo $_smarty_tpl->tpl_vars['LDOrDocumentMenu']->value;?>
</td>
					</tr>
					<?php $_smarty_tpl->_subTemplateRender("file:common/submenu_row_spacer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>					
					<TR>
						<TD class="submenu_item" width=35<?php echo '%>';
echo $_smarty_tpl->tpl_vars['LDQviewDocs']->value;?>
</TD>
						<TD><?php echo $_smarty_tpl->tpl_vars['LDQviewTxtDocs']->value;?>
</TD>
					</tr>

				</TBODY>
			</TABLE>
			</TD>
		</TR>
	</TBODY>
</TABLE>

<p>
<div class="prompt"><?php echo $_smarty_tpl->tpl_vars['LDOrNursing']->value;?>
</div>
<TABLE cellSpacing=0 width=600 class="submenu_frame" cellpadding="0">
	<TBODY>
		<TR>
			<TD>
			<TABLE cellSpacing=1 cellPadding=3 width=600>
				<TBODY class="submenu">

					<TR>
						<TD class="submenu_item" width=35<?php echo '%>';
echo $_smarty_tpl->tpl_vars['LDOrLogBook']->value;?>
</TD>
						<TD><?php echo $_smarty_tpl->tpl_vars['LDOrLogBookTxt']->value;?>
</TD>
					</tr>
					<?php $_smarty_tpl->_subTemplateRender("file:common/submenu_row_spacer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
					<tr>
						<td colspan="2"><?php echo $_smarty_tpl->tpl_vars['LDOrLogBookMenu']->value;?>
</td>
					</tr>
					<?php $_smarty_tpl->_subTemplateRender("file:common/submenu_row_spacer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>	
					<TR>
						<TD class="submenu_item" width=35<?php echo '%>';
echo $_smarty_tpl->tpl_vars['LDORNOCQuickView']->value;?>
</TD>
						<TD><?php echo $_smarty_tpl->tpl_vars['LDQviewTxtNurse']->value;?>
</TD>
					</tr>
					<?php $_smarty_tpl->_subTemplateRender("file:common/submenu_row_spacer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
					<tr>
						<td colspan="2"><?php echo $_smarty_tpl->tpl_vars['LDDutyPlanMenu']->value;?>
</td>
					</tr>
					<?php $_smarty_tpl->_subTemplateRender("file:common/submenu_row_spacer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>	
					<TR>
						<TD class="submenu_item" width=35<?php echo '%>';
echo $_smarty_tpl->tpl_vars['LDORNOCScheduler']->value;?>
</TD>
						<TD><?php echo $_smarty_tpl->tpl_vars['LDDutyPlanTxt']->value;?>
</TD>
					</tr>
					<?php $_smarty_tpl->_subTemplateRender("file:common/submenu_row_spacer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

					<TR>
						<TD class="submenu_item" width=35<?php echo '%>';
echo $_smarty_tpl->tpl_vars['LDOnCallDuty']->value;?>
</TD>
						<TD><?php echo $_smarty_tpl->tpl_vars['LDOnCallDutyTxt']->value;?>
</TD>
					</tr>

				</TBODY>
			</TABLE>
			</TD>
		</TR>
	</TBODY>
</TABLE>

<p>
<div class="prompt"><?php echo $_smarty_tpl->tpl_vars['LDORAnesthesia']->value;?>
</div>
<TABLE cellSpacing=0 width=600 class="submenu_frame" cellpadding="0">
	<TBODY>
		<TR>
			<TD>
			<TABLE cellSpacing=1 cellPadding=3 width=600>
				<TBODY class="submenu">

					<TR>
						<TD class="submenu_item" width=35<?php echo '%>';
echo $_smarty_tpl->tpl_vars['LDORAnaQuickView']->value;?>
</TD>
						<TD><?php echo $_smarty_tpl->tpl_vars['LDQviewTxtAna']->value;?>
</TD>
					</tr>
					<?php $_smarty_tpl->_subTemplateRender("file:common/submenu_row_spacer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

					<TR>
						<TD class="submenu_item" width=35<?php echo '%>';
echo $_smarty_tpl->tpl_vars['LDORAnaNOCScheduler']->value;?>
</TD>
						<TD><?php echo $_smarty_tpl->tpl_vars['LDDutyPlanTxt']->value;?>
</TD>
					</tr>
					<?php $_smarty_tpl->_subTemplateRender("file:common/submenu_row_spacer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
					<tr>
						<td colspan="2"><?php echo $_smarty_tpl->tpl_vars['LDORAnaNOCSchedulerMenu']->value;?>
</td>
					</tr>
				</TBODY>
			</TABLE>
			</TD>
		</TR>
	</TBODY>
</TABLE>

<?php echo $_smarty_tpl->tpl_vars['sOnHoverMenu']->value;?>


<p><a href="<?php echo $_smarty_tpl->tpl_vars['breakfile']->value;?>
"><img
	<?php echo $_smarty_tpl->tpl_vars['gifClose2']->value;?>
 alt="<?php echo $_smarty_tpl->tpl_vars['LDCloseAlt']->value;?>
"<?php echo $_smarty_tpl->tpl_vars['dhtml']->value;?>
></a>
<p>
</blockquote>
<?php }
}
