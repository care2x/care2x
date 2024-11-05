<?php
/* Smarty version 3.1.40, created on 2024-11-04 20:04:10
  from '/home/tim/code/care2x/gui/smarty_template/templates/default/common/duty_plan.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_672928ba51b3b9_11131360',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b7d787ea5ee64e88122d6470c465473dbb3faa96' => 
    array (
      0 => '/home/tim/code/care2x/gui/smarty_template/templates/default/common/duty_plan.tpl',
      1 => 1726137535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_672928ba51b3b9_11131360 (Smarty_Internal_Template $_smarty_tpl) {
?>
<ul>
<table border="0" width="80%">
  <tbody>
    <tr style="font-size:18px">
      <td><?php echo $_smarty_tpl->tpl_vars['sPrevMonth']->value;?>
</td>
      <td><?php echo $_smarty_tpl->tpl_vars['sThisMonth']->value;?>
</td>
      <td><?php echo $_smarty_tpl->tpl_vars['sNextMonth']->value;?>
</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" valign="top">
        
		<table border=0 cellpadding=0 cellspacing=1 width="100%" class="frame">
        <tbody>
          <tr class="submenu2_titlebar" style="font-size:16px">
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><?php echo $_smarty_tpl->tpl_vars['LDStandbyPerson']->value;?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['LDOnCall']->value;?>
</td>
          </tr>
		  
		  <?php echo $_smarty_tpl->tpl_vars['sDutyRows']->value;?>


        </tbody>
        </table>

	  </td>
      <td valign="top">
        <?php echo $_smarty_tpl->tpl_vars['sNewPlan']->value;?>

		<p>
		<?php echo $_smarty_tpl->tpl_vars['sCancel']->value;?>

      </td>
    </tr>
    <tr>
      <td colspan="3"><?php echo $_smarty_tpl->tpl_vars['sNewPlan']->value;?>
&nbsp;&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['sCancel']->value;?>
</td>
      <td>&nbsp;</td>
    </tr>  
  </tbody>
</table>
</ul>
<?php }
}
