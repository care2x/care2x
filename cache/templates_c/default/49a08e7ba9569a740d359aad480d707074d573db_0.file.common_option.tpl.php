<?php
/* Smarty version 3.1.40, created on 2024-11-05 19:24:00
  from '/home/tim/code/care2x/gui/smarty_template/templates/default/registration_admission/common_option.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_672a70d0932ce0_07133454',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '49a08e7ba9569a740d359aad480d707074d573db' => 
    array (
      0 => '/home/tim/code/care2x/gui/smarty_template/templates/default/registration_admission/common_option.tpl',
      1 => 1726137535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:registration_admission/basic_data.tpl' => 1,
    'file:registration_admission/common_norecord.tpl' => 1,
  ),
),false)) {
function content_672a70d0932ce0_07133454 (Smarty_Internal_Template $_smarty_tpl) {
?>
<table width="100%" cellspacing="0" cellpadding="0">
  <tbody>

    <tr>
      <td><?php $_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['sTabsFile']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?></td>
    </tr>

    <tr>
      <td>
			<table cellspacing="0" cellpadding="0" width=800>
			<tbody>
				<tr valign="top">
					<td>
						<?php $_smarty_tpl->_subTemplateRender("file:registration_admission/basic_data.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
						
						<?php if ($_smarty_tpl->tpl_vars['bShowNoRecord']->value) {?>
							<?php $_smarty_tpl->_subTemplateRender("file:registration_admission/common_norecord.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
						<?php }?>

						<?php echo $_smarty_tpl->tpl_vars['sOptionBlock']->value;?>

					
					</td>
					<td><?php echo $_smarty_tpl->tpl_vars['sOptionsMenu']->value;?>
</td>
				</tr>
			</tbody>
			</table>
	  </td>
    </tr>

	<tr>
      <td valign="top">
	  	<?php echo $_smarty_tpl->tpl_vars['sBottomControls']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['pbPersonData']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['pbAdmitData']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['pbMakeBarcode']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['pbMakeWristBands']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['pbBottomClose']->value;?>

	</td>
    </tr>

    <tr>
      <td>
	  	&nbsp;
		<br>
	  	<?php echo $_smarty_tpl->tpl_vars['sAdmitLink']->value;?>

		<br>
		<?php echo $_smarty_tpl->tpl_vars['sSearchLink']->value;?>

		<br>
		<?php echo $_smarty_tpl->tpl_vars['sArchiveLink']->value;?>

	</td>
    </tr>

  </tbody>
</table>
<?php }
}
