<?php
/* Smarty version 3.1.40, created on 2024-11-06 21:00:50
  from '/home/tim/code/care2x/gui/smarty_template/templates/default/system_admin/quick_informer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_672bd90275f1b4_57917546',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0c66cc2b4a2d5e109b5119fed7acd25c006fdb10' => 
    array (
      0 => '/home/tim/code/care2x/gui/smarty_template/templates/default/system_admin/quick_informer.tpl',
      1 => 1726137535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_672bd90275f1b4_57917546 (Smarty_Internal_Template $_smarty_tpl) {
?>
<ul>
<FONT class="prompt"><p>
<?php echo $_smarty_tpl->tpl_vars['sMascotImg']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['LDDataSaved']->value;?>

<p>
<?php echo $_smarty_tpl->tpl_vars['LDEnterInfo']->value;?>

</font>
<p>

<form <?php echo $_smarty_tpl->tpl_vars['sFormAction']->value;?>
 method="post" name="quickinfo">
<table border=0 cellspacing=1 cellpadding=5>
<tr>
	<td class="adm_item" align="right"><FONT  color="#0000cc"><b><?php echo $_smarty_tpl->tpl_vars['LDPhonePolice']->value;?>
</b> </FONT></td>
	<td class="adm_input"><input type="text" name="main_info_police_nr" size=40 maxlength=40 value="<?php echo $_smarty_tpl->tpl_vars['main_info_police_nr']->value;?>
">
      </td>
	</tr>
<tr>
	<td class="adm_item" align="right"><FONT  color="#0000cc"><b><?php echo $_smarty_tpl->tpl_vars['LDPhoneFire']->value;?>
</b> </FONT></td>
	<td class="adm_input"><input type="text" name="main_info_fire_dept_nr" size=40 maxlength=40 value="<?php echo $_smarty_tpl->tpl_vars['main_info_fire_dept_nr']->value;?>
">
      </td>
	</tr>
<tr>
	<td class="adm_item" align="right"><FONT  color="#0000cc"><b><?php echo $_smarty_tpl->tpl_vars['LDAmbulance']->value;?>
</b> </FONT></td>
	<td class="adm_input"><input type="text" name="main_info_emgcy_nr" size=40 maxlength=40 value="<?php echo $_smarty_tpl->tpl_vars['main_info_emgcy_nr']->value;?>
">
      </td>
	</tr>
<tr>
	<td class="adm_item" align="right"><FONT  color="#0000cc"><b><?php echo $_smarty_tpl->tpl_vars['LDPhone']->value;?>
</b> </FONT></td>
	<td class="adm_input"><input type="text" name="main_info_phone" size=40 maxlength=40 value="<?php echo $_smarty_tpl->tpl_vars['main_info_phone']->value;?>
">
      </td>
	</tr>
<tr>
	<td class="adm_item" align="right"><FONT  color="#0000cc"><b><?php echo $_smarty_tpl->tpl_vars['LDFax']->value;?>
</b> </FONT></td>
	<td class="adm_input"><input type="text" name="main_info_fax" size=40 maxlength=40 value="<?php echo $_smarty_tpl->tpl_vars['main_info_fax']->value;?>
">
      </td>
	</tr>
<tr>
	<td class="adm_item" align="right"><FONT  color="#0000cc"><b><?php echo $_smarty_tpl->tpl_vars['LDAddress']->value;?>
</b> </FONT></td>
	<td class="adm_input"><textarea name="main_info_address" cols=33 rows=5 wrap="physical"><?php echo $_smarty_tpl->tpl_vars['main_info_address']->value;?>
</textarea>

      </td>
	</tr>
<tr>
	<td class="adm_item" align="right"><FONT  color="#0000cc"><b><?php echo $_smarty_tpl->tpl_vars['LDEmail']->value;?>
</b> </FONT></td>
	<td class="adm_input"><input type="text" name="main_info_email" size=40 maxlength=60 value="<?php echo $_smarty_tpl->tpl_vars['main_info_email']->value;?>
">
      </td>
	</tr>
</table>
<p>
<?php echo $_smarty_tpl->tpl_vars['sSave']->value;?>
&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['sCancel']->value;?>

</form><?php }
}
