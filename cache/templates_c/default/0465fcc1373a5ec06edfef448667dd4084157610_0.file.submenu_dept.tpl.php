<?php
/* Smarty version 3.1.40, created on 2024-11-04 22:31:54
  from '/home/tim/code/care2x/gui/smarty_template/templates/default/ambulatory/submenu_dept.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_67294b5a1660a6_02666842',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0465fcc1373a5ec06edfef448667dd4084157610' => 
    array (
      0 => '/home/tim/code/care2x/gui/smarty_template/templates/default/ambulatory/submenu_dept.tpl',
      1 => 1726137535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67294b5a1660a6_02666842 (Smarty_Internal_Template $_smarty_tpl) {
?>			<TABLE cellSpacing=0  width=100% class="submenu_frame" cellpadding="0">
			<TBODY>
			<TR>
				<TD>
					<TABLE cellSpacing=1 width=100%  cellPadding=3>
					<TBODY class="submenu">

						<TR>
							<TD colspan=2 class="submenu_title"><?php echo $_smarty_tpl->tpl_vars['sBlockTitle']->value;?>
</TD>
						</tr>

						<TR>
							<TD width=25 align=center><?php echo $_smarty_tpl->tpl_vars['sApptIcon']->value;?>
</TD>
							<TD class="submenu_item"><nobr><?php echo $_smarty_tpl->tpl_vars['sApptLink']->value;?>
</nobr></TD>
						</tr>

						<TR>
							<TD width=25 align=center><?php echo $_smarty_tpl->tpl_vars['sOutPatientIcon']->value;?>
</TD>
							<TD class="submenu_item"><nobr><?php echo $_smarty_tpl->tpl_vars['sOutPatientLink']->value;?>
</nobr></TD>
						</tr>

						<TR>
							<TD width=25 align=center><?php echo $_smarty_tpl->tpl_vars['sPendReqIcon']->value;?>
</TD>
							<TD class="submenu_item"><nobr><?php echo $_smarty_tpl->tpl_vars['sPendReqLink']->value;?>
</nobr></TD>
						</tr>

						<TR>
							<TD width=25 align=center><?php echo $_smarty_tpl->tpl_vars['sNewsIcon']->value;?>
</TD>
							<TD class="submenu_item"><nobr><?php echo $_smarty_tpl->tpl_vars['sNewsLink']->value;?>
</nobr></TD>
						</tr>

					</TBODY>
					</TABLE>
				</TD>
			</TR>
			</TBODY>
			</TABLE>


<?php }
}
