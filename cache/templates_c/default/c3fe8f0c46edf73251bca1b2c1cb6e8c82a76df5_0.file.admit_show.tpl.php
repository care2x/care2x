<?php
/* Smarty version 3.1.40, created on 2024-11-05 19:23:16
  from '/home/tim/code/care2x/gui/smarty_template/templates/default/registration_admission/admit_show.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_672a70a41f2897_32314562',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c3fe8f0c46edf73251bca1b2c1cb6e8c82a76df5' => 
    array (
      0 => '/home/tim/code/care2x/gui/smarty_template/templates/default/registration_admission/admit_show.tpl',
      1 => 1726137535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:registration_admission/admit_tabs.tpl' => 1,
    'file:registration_admission/admit_form.tpl' => 1,
  ),
),false)) {
function content_672a70a41f2897_32314562 (Smarty_Internal_Template $_smarty_tpl) {
?>
<table width="100%" cellspacing="0" cellpadding="0">
  <tbody>

    <tr>
      <td><?php $_smarty_tpl->_subTemplateRender("file:registration_admission/admit_tabs.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?></td>
    </tr>

    <tr>
      <td>
			<table cellspacing="0" cellpadding="0" width=800>
			<tbody>
				<tr valign="top">
					<td><?php $_smarty_tpl->_subTemplateRender("file:registration_admission/admit_form.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?></td>
					<td><?php echo $_smarty_tpl->tpl_vars['sAdmitOptions']->value;?>
</td>
				</tr>
			</tbody>
			</table>
	  </td>
    </tr>

	<tr>
      <td valign="top">
	  	<?php echo $_smarty_tpl->tpl_vars['sAdmitBottomControls']->value;?>
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
