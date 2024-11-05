<?php
/* Smarty version 3.1.40, created on 2024-11-04 22:35:23
  from '/home/tim/code/care2x/gui/smarty_template/templates/default/nursing/nursing-schnellansicht.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_67294c2be67487_72996473',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3741821eb9eac20f951ad880326cfe017d5b0d5d' => 
    array (
      0 => '/home/tim/code/care2x/gui/smarty_template/templates/default/nursing/nursing-schnellansicht.tpl',
      1 => 1726137535,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67294c2be67487_72996473 (Smarty_Internal_Template $_smarty_tpl) {
?><!--
Do not attempt to edit the javascript code block unless you are 100% sure you know what you are doing !!
-->
<?php echo '<script'; ?>
 language="javascript">
<!--
var urlholder;

 function gotostat(station){
    winw=screen.width ;
    winw=(winw / 2) - 400;
    winh=screen.height ;
    winh=(winh / 2) - 300;
    winspecs="width=800,height=600,screenX=" + winw + ",screenY=" + winh + ",menubar=no,resizable=yes,scrollbars=yes";

     urlholder="nursing-station.php?route=validroute&user={$aufnahme_user}&station=" + station;
     stationwin=window.open(urlholder,station,winspecs);
 }

 function statbel(e,ward_nr,st){

  <?php if ($_smarty_tpl->tpl_vars['dhtml']->value) {?>
     w=window.parent.screen.width;
     h=window.parent.screen.height;
  <?php } else { ?>
     w=800;
     h=600;
  <?php }?>

  winspecs="menubar=no,resizable=yes,scrollbars=yes,width=" + (w-15) + ", height=" + (h-60);

  if (e==1) urlholder="nursing-station-pass.php?rt=pflege&sid=<?php echo $_smarty_tpl->tpl_vars['SID_Parameter']->value;?>
&edit=1&retpath=quick&ward_nr="+ward_nr+"&station="+st;
  else urlholder="nursing-station.php?rt=pflege&sid=<?php echo $_smarty_tpl->tpl_vars['SID_Parameter']->value;?>
&edit=0&retpath=quick&ward_nr="+ward_nr+"&station="+st;
  //stationwin=window.open(urlholder,station,winspecs);
  window.location.href=urlholder;
 }
 -->
<?php echo '</script'; ?>
>

<?php echo $_smarty_tpl->tpl_vars['tblCalendar']->value;?>

<div class="warnprompt">
	<img <?php echo $_smarty_tpl->tpl_vars['gifVarrow']->value;?>
 alt=""><?php if ($_smarty_tpl->tpl_vars['is_today']->value) {?> <?php echo $_smarty_tpl->tpl_vars['LDTodays']->value;?>
 <?php } else { ?> <?php echo $_smarty_tpl->tpl_vars['LDOld']->value;?>
 <?php }?> <?php echo $_smarty_tpl->tpl_vars['LDOccupancy']->value;?>

	&nbsp;&nbsp;
	(<?php echo $_smarty_tpl->tpl_vars['formatDate2Local']->value;?>
)
</div>

<table  cellpadding="0" cellspacing=0 border="0"  width="100%">

	<tr class="wardlisttitlerow" align=center><td><b>&nbsp;<?php echo $_smarty_tpl->tpl_vars['LDStation']->value;?>
&nbsp;</b></td>
		<td><img  <?php echo $_smarty_tpl->tpl_vars['gifImg_mangr']->value;?>
 alt="<?php echo $_smarty_tpl->tpl_vars['LDNrUnocc']->value;?>
"> <font face="verdana,arial" size="2" ><b><?php echo $_smarty_tpl->tpl_vars['LDFreeBed']->value;?>
</b></td>
		<td><font  color="<?php echo $_smarty_tpl->tpl_vars['PIE_CHART_USED_COLOR']->value;?>
">&nbsp;<b><?php echo $_smarty_tpl->tpl_vars['LDOccupied']->value;?>
</b></font></td>
		<td>&nbsp;<b><?php echo $_smarty_tpl->tpl_vars['LDOccupancy']->value;?>
 (%)</b></td>
		<td>&nbsp;<b><?php echo $_smarty_tpl->tpl_vars['LDBedNr']->value;?>
</b></td>
		<td><b>&nbsp;<?php echo $_smarty_tpl->tpl_vars['LDOptions']->value;?>
&nbsp;</b></td>
	</tr>

    <?php echo $_smarty_tpl->tpl_vars['WardRows']->value;?>


</table>

	<br>

<?php if (!$_smarty_tpl->tpl_vars['iWardCount']->value) {?>
	<p class="warnprompt">
	<img <?php echo $_smarty_tpl->tpl_vars['gifMascot1_r']->value;?>
 alt="">
    <b><?php echo $_smarty_tpl->tpl_vars['LDNoOcc']->value;?>
</b>
	</p>
	
	<p>
	<a href="<?php echo $_smarty_tpl->tpl_vars['LINKArchiv']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['LDClk2Archive']->value;?>
 <img <?php echo $_smarty_tpl->tpl_vars['gifBul_arrowgrnlrg']->value;?>
 alt=""></a>
	</p>
	<br>&nbsp;
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['from']->value == "arch") {?>
	<a href="<?php echo $_smarty_tpl->tpl_vars['LINKArchiv']->value;?>
"><img <?php echo $_smarty_tpl->tpl_vars['pbBack2']->value;?>
 alt="" width=110 height=24></a>
<?php } else { ?>
	<a href="<?php echo $_smarty_tpl->tpl_vars['breakfile']->value;?>
"><img <?php echo $_smarty_tpl->tpl_vars['gifClose2']->value;?>
 alt="<?php echo $_smarty_tpl->tpl_vars['LDCloseAlt']->value;?>
" <?php echo $_smarty_tpl->tpl_vars['dhtml']->value;?>
></a>
<?php }
}
}
