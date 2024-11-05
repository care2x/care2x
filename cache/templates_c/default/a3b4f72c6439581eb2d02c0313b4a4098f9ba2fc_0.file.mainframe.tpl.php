<?php
/* Smarty version 3.1.40, created on 2024-11-04 19:50:50
  from '/home/tim/code/care2x/gui/smarty_template/templates/default/common/mainframe.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_6729259a222424_53046128',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a3b4f72c6439581eb2d02c0313b4a4098f9ba2fc' => 
    array (
      0 => '/home/tim/code/care2x/gui/smarty_template/templates/default/common/mainframe.tpl',
      1 => 1726137535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common/header.tpl' => 1,
    'file:common/header_topblock.tpl' => 1,
  ),
),false)) {
function content_6729259a222424_53046128 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:common/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<table width=100% border=0 cellspacing=0 height=100<?php echo '%>';?>

<tbody class="main">
<?php if (!$_smarty_tpl->tpl_vars['bHideTitleBar']->value) {?>
	<tr>
		<td  valign="top" align="middle" height="35">
			<?php $_smarty_tpl->_subTemplateRender("file:common/header_topblock.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		</td>
	</tr>
<?php }?>

	<tr>
		<td bgcolor=<?php echo $_smarty_tpl->tpl_vars['body_bgcolor']->value;?>
 valign=top>
		
						<?php if ($_smarty_tpl->tpl_vars['sMainBlockIncludeFile']->value != '') {?>
				<?php $_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['sMainBlockIncludeFile']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['sMainFrameBlockData']->value != '') {?>
				<?php echo $_smarty_tpl->tpl_vars['sMainFrameBlockData']->value;?>

			<?php }?>
			
		</td>
	</tr>
	


	</tbody>
 </table>


<?php }
}
