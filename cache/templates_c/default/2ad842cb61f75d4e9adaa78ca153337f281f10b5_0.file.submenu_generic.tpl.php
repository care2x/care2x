<?php
/* Smarty version 3.1.40, created on 2024-11-04 19:53:48
  from '/home/tim/code/care2x/gui/smarty_template/templates/default/ambulatory/submenu_generic.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_6729264c0e6307_20457275',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2ad842cb61f75d4e9adaa78ca153337f281f10b5' => 
    array (
      0 => '/home/tim/code/care2x/gui/smarty_template/templates/default/ambulatory/submenu_generic.tpl',
      1 => 1726137535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6729264c0e6307_20457275 (Smarty_Internal_Template $_smarty_tpl) {
?>		<form name="dept_select" method="post" action="">
			<TABLE cellSpacing=0  width=600 class="submenu_frame" cellpadding="0">
			<TBODY>
			<TR>
				<TD>
					<TABLE cellSpacing=1 cellPadding=3 width=600>
					<TBODY class="submenu">

						<TR>
							<td colspan="3" class="submenu_title"  align=left><?php echo $_smarty_tpl->tpl_vars['TP_SELECT_BLOCK']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['sTitleIcon']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['LDSelectDept']->value;?>
 </td>
						</tr>

						<TR>
							<td align=center><?php echo $_smarty_tpl->tpl_vars['sApptIcon']->value;?>
</td>
							<TD class="submenu_item"><nobr><?php echo $_smarty_tpl->tpl_vars['TP_HREF_APPT1']->value;?>
</nobr></TD>
							<TD><?php echo $_smarty_tpl->tpl_vars['LDAppointmentsTxt']->value;?>
</TD>
						</tr>
						
						<TR>
							<td align=center><?php echo $_smarty_tpl->tpl_vars['sOutPatientIcon']->value;?>
</td>
							<TD class="submenu_item"><nobr><?php echo $_smarty_tpl->tpl_vars['TP_HREF_PWL1']->value;?>
</nobr></TD>
							<TD><?php echo $_smarty_tpl->tpl_vars['LDPWListTxt']->value;?>
</TD>
						</tr>
						
						<TR>
							<td align=center><?php echo $_smarty_tpl->tpl_vars['sPendReqIcon']->value;?>
</td>
							<TD class="submenu_item"><nobr><?php echo $_smarty_tpl->tpl_vars['TP_HREF_PREQ1']->value;?>
</nobr></TD>
							<TD><?php echo $_smarty_tpl->tpl_vars['LDPendingRequestTxt']->value;?>
</TD>
						</tr>
						
						<TR>
							<td align=center><?php echo $_smarty_tpl->tpl_vars['sNewsIcon']->value;?>
</td>
							<TD class="submenu_item"><nobr><?php echo $_smarty_tpl->tpl_vars['TP_HREF_NEWS1']->value;?>
</nobr></TD>
							<TD><?php echo $_smarty_tpl->tpl_vars['LDNewsTxt']->value;?>
</TD>
						</tr>

					</TBODY>
					</TABLE>
				</TD>
			</TR>
			</TBODY>
			</TABLE>
			<!--do not omit  $TP _HINPUTS , must be inside the form tags -->
			<?php echo $_smarty_tpl->tpl_vars['TP_HINPUTS']->value;?>

			<?php echo $_smarty_tpl->tpl_vars['TP_HIDDENS']->value;?>

		</form>
<?php }
}
