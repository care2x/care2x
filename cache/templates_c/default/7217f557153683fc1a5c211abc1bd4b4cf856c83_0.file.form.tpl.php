<?php
/* Smarty version 3.1.40, created on 2024-11-05 19:24:49
  from '/home/tim/code/care2x/gui/smarty_template/templates/default/medocs/form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_672a710117e2e3_99025028',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7217f557153683fc1a5c211abc1bd4b4cf856c83' => 
    array (
      0 => '/home/tim/code/care2x/gui/smarty_template/templates/default/medocs/form.tpl',
      1 => 1726137535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_672a710117e2e3_99025028 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['bSetAsForm']->value) {?>
	<?php echo $_smarty_tpl->tpl_vars['sDocsJavaScript']->value;?>

	<form method="post" name="entryform" onSubmit="return chkForm(this)">
<?php }?>

<table border=0 cellpadding=2 width=100<?php echo '%>';?>

   <tr bgcolor='#f6f6f6'>
     <td><?php echo $_smarty_tpl->tpl_vars['LDExtraInfo']->value;?>
<br>(<?php echo $_smarty_tpl->tpl_vars['LDInsurance']->value;?>
)</td>
     <td>

	 	<?php if ($_smarty_tpl->tpl_vars['bSetAsForm']->value) {?>
			<textarea name='aux_notes' cols=60 rows=2 wrap='physical'></textarea>
		<?php } else { ?>
			<?php echo $_smarty_tpl->tpl_vars['sExtraInfo']->value;?>

		<?php }?>

	 </td>
   </tr>
   <tr bgcolor='#f6f6f6'>
     <td><FONT color=red>*</font>  <?php echo $_smarty_tpl->tpl_vars['LDGotMedAdvice']->value;?>
</td>
     <td>

	 	<?php if ($_smarty_tpl->tpl_vars['bSetAsForm']->value) {?>
	 		<?php echo $_smarty_tpl->tpl_vars['sYesRadio']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['LDYes']->value;?>

         	<?php echo $_smarty_tpl->tpl_vars['sNoRadio']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['LDNo']->value;?>

		<?php } else { ?>
			<?php echo $_smarty_tpl->tpl_vars['sYesNo']->value;?>

		<?php }?>

         </td>
   </tr>
   <tr bgcolor='#f6f6f6'>
     <td><FONT  color='red'>*</font>  <?php echo $_smarty_tpl->tpl_vars['LDDiagnosis']->value;?>
</td>
     <td>

	 	<?php if ($_smarty_tpl->tpl_vars['bSetAsForm']->value) {?>
			<textarea name='text_diagnosis' cols=60 rows=8 wrap='physical'></textarea>
		<?php } else { ?>
			<?php echo $_smarty_tpl->tpl_vars['sDiagnosis']->value;?>

		<?php }?>


		</td>
   </tr>
   <tr bgcolor='#f6f6f6'>
     <td><FONT  color='red'>*</font>  <?php echo $_smarty_tpl->tpl_vars['LDTherapy']->value;?>
</td>
		<td>
		
	 	<?php if ($_smarty_tpl->tpl_vars['bSetAsForm']->value) {?>
			<textarea name='text_therapy' cols=60 rows=8 wrap='physical'></textarea>
		<?php } else { ?>
			<?php echo $_smarty_tpl->tpl_vars['sTherapy']->value;?>

		<?php }?>

		</td>
   </tr>
   <tr bgcolor='#f6f6f6'>
     <td><FONT  color='red'>*</font>  <?php echo $_smarty_tpl->tpl_vars['LDDate']->value;?>
</td>
     <td>
	 
	 	<?php if ($_smarty_tpl->tpl_vars['bSetAsForm']->value) {?>
			<!-- gjergji : not needed anymore, since the new calendar 
				<input type='text' name='date' size=10 maxlength=10 <?php echo $_smarty_tpl->tpl_vars['sDateValidateJs']->value;?>
>-->
			<?php echo $_smarty_tpl->tpl_vars['sDateMiniCalendar']->value;?>

		<?php } else { ?>
			<?php echo $_smarty_tpl->tpl_vars['sDate']->value;?>

		<?php }?>

	 </td>
   </tr>
   <tr bgcolor='#f6f6f6'>
     <td><FONT  color='red'>*</font>  <?php echo $_smarty_tpl->tpl_vars['LDBy']->value;?>
 </td>
     <td>

	 	<?php if ($_smarty_tpl->tpl_vars['bSetAsForm']->value) {?>
	 		<input type='text' name='personell_name' size=50 maxlength=60 value='<?php echo $_smarty_tpl->tpl_vars['TP_user_name']->value;?>
' readonly>
		<?php } else { ?>
			<?php echo $_smarty_tpl->tpl_vars['sAuthor']->value;?>

		<?php }?>

	 </td>
   </tr>
</table>

<?php if ($_smarty_tpl->tpl_vars['bSetAsForm']->value) {?>
	<?php echo $_smarty_tpl->tpl_vars['sHiddenInputs']->value;?>

	</form>
<?php }
}
}
