<?php
/* Smarty version 3.1.40, created on 2024-11-06 18:44:34
  from '/home/tim/code/care2x/gui/smarty_template/templates/default/laboratory/chemlab_data_results.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_672bb9121c81b0_90533897',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '56fc333e984ed25c16803842d6f617e26b575dcc' => 
    array (
      0 => '/home/tim/code/care2x/gui/smarty_template/templates/default/laboratory/chemlab_data_results.tpl',
      1 => 1726137535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_672bb9121c81b0_90533897 (Smarty_Internal_Template $_smarty_tpl) {
?>
<table width="100%" border="0">
  <tbody>
    <tr valign="top">
      <td>
								<form method="post" <?php echo $_smarty_tpl->tpl_vars['sFormAction']->value;?>
 onSubmit="return pruf(this)" name="datain">
					<table>
					<tbody>
						<tr>
							<td class="adm_item"><?php echo $_smarty_tpl->tpl_vars['LDCaseNr']->value;?>
:</td>
							<td class="adm_input"><?php echo $_smarty_tpl->tpl_vars['encounter_nr']->value;?>
</td>
						</tr>
						<tr>
							<td class="adm_item"><?php echo $_smarty_tpl->tpl_vars['LDLastName']->value;?>
, <?php echo $_smarty_tpl->tpl_vars['LDName']->value;?>
, <?php echo $_smarty_tpl->tpl_vars['LDBday']->value;?>
:</td>
							<td class="adm_input"><b><?php echo $_smarty_tpl->tpl_vars['sLastName']->value;?>
, <?php echo $_smarty_tpl->tpl_vars['sName']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['sBday']->value;?>
</b></td>
						</tr>
						<tr>
							<td class="adm_item"><?php echo $_smarty_tpl->tpl_vars['LDJobIdNr']->value;?>
:</td>
							<td class="adm_input"><?php echo $_smarty_tpl->tpl_vars['sJobIdNr']->value;?>
</td>
						</tr>
						<tr>
							<td class="adm_item"><?php echo $_smarty_tpl->tpl_vars['LDExamDate']->value;?>
:</td>
							<td class="adm_input"><?php echo $_smarty_tpl->tpl_vars['sExamDate']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['sMiniCalendar']->value;?>
</td>
						</tr>
					</tbody>
					</table>
				
					<table cellspacing=1 cellpadding=1 width="100%"  bgcolor=#ffdddd >
					<tbody>
						<tr>
							<td colspan="2" style="color: white; background-color: red; font-weight: bold;"><?php echo $_smarty_tpl->tpl_vars['sParamGroup']->value;?>
</td>
						</tr>
						<tr>
							<td colspan="2">
							
																<table cellpadding=0 cellspacing=1>
								<tbody>
																		<?php echo $_smarty_tpl->tpl_vars['sParameters']->value;?>

								</tbody>
								</table>

							</td>
						</tr>
						<tr>
							<td><?php echo $_smarty_tpl->tpl_vars['pbSave']->value;?>
</td>
							<td align="right"><?php echo $_smarty_tpl->tpl_vars['pbShowReport']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['pbCancel']->value;?>
</td>
						</tr>
					</tbody>
					</table>
					<?php echo $_smarty_tpl->tpl_vars['sSaveParamHiddenInputs']->value;?>

					<?php echo $_smarty_tpl->tpl_vars['sSelectGroupHiddenInputs']->value;?>

				</form>
				
				<!--				<form <?php echo $_smarty_tpl->tpl_vars['sFormAction']->value;?>
 method=post onSubmit="return chkselect(this)" name="paramselect">
					<table>
					<tbody>
						<tr>
							<td colspan="3"><b><?php echo $_smarty_tpl->tpl_vars['LDSelectParamGroup']->value;?>
</b></td>
						</tr>
						<tr>
							<td><?php echo $_smarty_tpl->tpl_vars['LDParamGroup']->value;?>
</td>
							<td><?php echo $_smarty_tpl->tpl_vars['sParamGroupSelect']->value;?>
</td>
							<td><?php echo $_smarty_tpl->tpl_vars['sSubmitSelect']->value;?>
</td>
						</tr>
					</tbody>
					</table>
					<?php echo $_smarty_tpl->tpl_vars['sSelectGroupHiddenInputs']->value;?>

				</form> -->

	  </td>
      <td width="20%">
								<table class="submenu3_body">
				<tbody>
					<tr>
						<td><?php echo $_smarty_tpl->tpl_vars['sAskIcon']->value;?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['LDParamNoSee']->value;?>
</td>
					</tr>
					<tr>
						<td><?php echo $_smarty_tpl->tpl_vars['sAskIcon']->value;?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['LDOnlyPair']->value;?>
</td>
					</tr>
					<tr>
						<td><?php echo $_smarty_tpl->tpl_vars['sAskIcon']->value;?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['LDHow2Save']->value;?>
</td>
					</tr>
					<tr>
						<td><?php echo $_smarty_tpl->tpl_vars['sAskIcon']->value;?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['LDWrongValueHow']->value;?>
</td>
					</tr>
					<tr>
						<td><?php echo $_smarty_tpl->tpl_vars['sAskIcon']->value;?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['LDVal2Note']->value;?>
</td>
					</tr>
					<tr>
						<td><?php echo $_smarty_tpl->tpl_vars['sAskIcon']->value;?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['LDImDone']->value;?>
</td>
					</tr>
				</tbody>
			</table>
	  </td>
    </tr>
  </tbody>
</table><?php }
}
