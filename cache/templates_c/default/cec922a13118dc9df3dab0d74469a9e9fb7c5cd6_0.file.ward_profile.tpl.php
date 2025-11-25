<?php
/* Smarty version 3.1.40, created on 2024-11-06 18:42:50
  from '/home/tim/code/care2x/gui/smarty_template/templates/default/nursing/ward_profile.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_672bb8aa31d582_42376889',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cec922a13118dc9df3dab0d74469a9e9fb7c5cd6' => 
    array (
      0 => '/home/tim/code/care2x/gui/smarty_template/templates/default/nursing/ward_profile.tpl',
      1 => 1726137535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_672bb8aa31d582_42376889 (Smarty_Internal_Template $_smarty_tpl) {
?>
<ul>
<table>
  <tbody>
    <tr>
      <td class="adm_item"><?php echo $_smarty_tpl->tpl_vars['LDStation']->value;?>
</td>
      <td class="adm_input" colspan="2"><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</td>
    </tr>
    <tr>
      <td class="adm_item"><?php echo $_smarty_tpl->tpl_vars['LDWard_ID']->value;?>
</td>
      <td class="adm_input" colspan="2"><?php echo $_smarty_tpl->tpl_vars['ward_id']->value;?>
</td>
    </tr>
    <tr>
      <td class="adm_item"><?php echo $_smarty_tpl->tpl_vars['LDDept']->value;?>
</td>
      <td class="adm_input" colspan="2"><?php echo $_smarty_tpl->tpl_vars['dept_name']->value;?>
</td>
    </tr>
    <tr>
      <td class="adm_item"><?php echo $_smarty_tpl->tpl_vars['LDDescription']->value;?>
</td>
      <td class="adm_input" colspan="2"><?php echo $_smarty_tpl->tpl_vars['description']->value;?>
</td>
    </tr>
    <tr>
      <td class="adm_item"><?php echo $_smarty_tpl->tpl_vars['LDRoom1Nr']->value;?>
</td>
      <td class="adm_input" colspan="2"><?php echo $_smarty_tpl->tpl_vars['room_nr_start']->value;?>
</td>
    </tr>
    <tr>
      <td class="adm_item"><?php echo $_smarty_tpl->tpl_vars['LDRoom2Nr']->value;?>
</td>
      <td class="adm_input" colspan="2"><?php echo $_smarty_tpl->tpl_vars['room_nr_end']->value;?>
</td>
    </tr>
    <tr>
      <td class="adm_item"><?php echo $_smarty_tpl->tpl_vars['LDRoomPrefix']->value;?>
</td>
      <td class="adm_input" colspan="2"><?php echo $_smarty_tpl->tpl_vars['roomprefix']->value;?>
</td>
    </tr>
   <tr>
      <td class="adm_item"><?php echo $_smarty_tpl->tpl_vars['LDCreatedOn']->value;?>
</td>
      <td class="adm_input" colspan="2"><?php echo $_smarty_tpl->tpl_vars['date_create']->value;?>
</td>
    </tr>
   <tr>
      <td class="adm_item"><?php echo $_smarty_tpl->tpl_vars['LDCreatedBy']->value;?>
</td>
      <td class="adm_input" colspan="2"><?php echo $_smarty_tpl->tpl_vars['create_id']->value;?>
</td>
    </tr>

  <?php if ($_smarty_tpl->tpl_vars['bShowRooms']->value) {?>
   <tr>
      <td class="adm_item" colspan="3">&nbsp;</td>
    </tr>
   <tr  class="wardlisttitlerow">
      <td><?php echo $_smarty_tpl->tpl_vars['LDRoom']->value;?>
</td>
      <td><?php echo $_smarty_tpl->tpl_vars['LDBedNr']->value;?>
</td>
      <td><?php echo $_smarty_tpl->tpl_vars['LDRoomShortDescription']->value;?>
</td>
    </tr>
	
	<?php echo $_smarty_tpl->tpl_vars['sRoomRows']->value;?>

  
  <?php }?>

  </tbody>
</table>
<p>

<table width="100%">
  <tbody>
    <tr valign="top">
      <td><?php echo $_smarty_tpl->tpl_vars['sClose']->value;?>
</td>
      <td align="right"><?php echo $_smarty_tpl->tpl_vars['sWardClosure']->value;?>
</td>
    </tr>
  </tbody>
</table>

</ul><?php }
}
