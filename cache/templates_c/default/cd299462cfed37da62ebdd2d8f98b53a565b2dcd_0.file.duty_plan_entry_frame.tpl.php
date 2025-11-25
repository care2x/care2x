<?php
/* Smarty version 3.1.40, created on 2024-11-06 18:29:22
  from '/home/tim/code/care2x/gui/smarty_template/templates/default/common/duty_plan_entry_frame.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_672bb5826b32d9_14722488',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cd299462cfed37da62ebdd2d8f98b53a565b2dcd' => 
    array (
      0 => '/home/tim/code/care2x/gui/smarty_template/templates/default/common/duty_plan_entry_frame.tpl',
      1 => 1726137535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_672bb5826b32d9_14722488 (Smarty_Internal_Template $_smarty_tpl) {
?>
<form name="dienstplan" <?php echo $_smarty_tpl->tpl_vars['sFormAction']->value;?>
 method="post">

<ul>

<font size=4>
<?php echo $_smarty_tpl->tpl_vars['LDMonth']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['sMonthSelect']->value;?>
 &nbsp; <?php echo $_smarty_tpl->tpl_vars['LDYear']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['sYearSelect']->value;?>

</font>

<table border="0">
  <tbody>
    <tr>
      <td colspan="3" valign="top">
        
		<table border=0 cellpadding=0 cellspacing=1 width="100%" class="frame">
        <tbody>
          <tr class="submenu2_titlebar" style="font-size:16px">
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td colspan="2"><?php echo $_smarty_tpl->tpl_vars['LDStandbyPerson']->value;?>
</td>
			 <td colspan="2"><?php echo $_smarty_tpl->tpl_vars['LDOnCall']->value;?>
</td>
          </tr>
		  
		  <?php echo $_smarty_tpl->tpl_vars['sDutyRows']->value;?>


        </tbody>
        </table>

	  </td>
      <td valign="top">
        <?php echo $_smarty_tpl->tpl_vars['sSave']->value;?>

		<p>
		<?php echo $_smarty_tpl->tpl_vars['sClose']->value;?>

      </td>
    </tr>
    <tr>
      <td colspan="3"><?php echo $_smarty_tpl->tpl_vars['sSave']->value;?>
&nbsp;&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['sClose']->value;?>
</td>
      <td>&nbsp;</td>
    </tr>  
  </tbody>
</table>
</ul>

<?php echo $_smarty_tpl->tpl_vars['sHiddenInputs']->value;?>


</form><?php }
}
