<?php
/* Smarty version 3.1.40, created on 2024-11-05 19:24:39
  from '/home/tim/code/care2x/gui/smarty_template/templates/default/medocs/main.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_672a70f733bd46_78952114',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1462a0aa196c9d849e62e21adcaa8966df523bea' => 
    array (
      0 => '/home/tim/code/care2x/gui/smarty_template/templates/default/medocs/main.tpl',
      1 => 1726137535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:medocs/tabs.tpl' => 1,
    'file:registration_admission/basic_data.tpl' => 1,
    'file:registration_admission/common_norecord.tpl' => 1,
  ),
),false)) {
function content_672a70f733bd46_78952114 (Smarty_Internal_Template $_smarty_tpl) {
?>
<table width="100%" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td><?php $_smarty_tpl->_subTemplateRender("file:medocs/tabs.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?></td>
    </tr>

    <tr>
      <td>

		<table width="700" cellspacing="0" cellpadding="0">
		<tbody>
			<tr>
				<td>
					<?php $_smarty_tpl->_subTemplateRender("file:registration_admission/basic_data.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
				</td>
			</tr>

			<tr>
				<td>
					<?php if ($_smarty_tpl->tpl_vars['bShowNoRecord']->value) {?>
						<?php $_smarty_tpl->_subTemplateRender("file:registration_admission/common_norecord.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
					<?php } else { ?>
						<?php $_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['sDocsBlockIncludeFile']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
					<?php }?>
	  			</td>
    		</tr>
		</tbody>
		</table>

	  </td>
    </tr>

	<tr>
      <td>
			<?php echo $_smarty_tpl->tpl_vars['sNewLinkIcon']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['sNewRecLink']->value;?>
<br>
			<?php echo $_smarty_tpl->tpl_vars['sPdfLinkIcon']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['sMakePdfLink']->value;?>
<br>
			<?php echo $_smarty_tpl->tpl_vars['sListLinkIcon']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['sListRecLink']->value;?>
<p>
			<?php echo $_smarty_tpl->tpl_vars['pbBottomClose']->value;?>

	  </td>
    </tr>

  </tbody>
</table>
<?php }
}
