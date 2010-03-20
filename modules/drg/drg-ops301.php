<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/*
CARE2X Integrated Information System Deployment 2.2 - 2006-07-10 for Hospitals and Health Care Organizations and Services
Copyright (C) 2002,2003,2004,2005  Elpidio Latorilla & Intellin.org	
GNU GPL. For details read file "copy_notice.txt".
*/
define('CATEGORY_NAME_FULL',1); // 1= the category names are to be displayed in full, 0 = only short codes are displayed 
define('LOCALIZATION_NAME_FULL',1);// 1= the localization names are to be displayed in full, 0 = only short codes are displayed 
define('LANG_FILE','drg.php');

require_once('drg_inc_local_user.php');

require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/care_api_classes/class_drg.php');
$DRG_obj=new DRG($pn); // Create a drg object

//$db->debug=1;

$toggle=0;
$thisfile=basename(__FILE__);

if(isset($mode)&&!empty($mode)){
	$saved_header="location:$thisfile?sid=$sid&lang=$lang&pn=$pn&edit=$edit&ln=$ln&fn=$fn&bd=$bd&opnr=$opnr&group_nr=$group_nr&dept_nr=$dept_nr&dept_nr=$dept_nr&oprm=$oprm&y=$y&m=$m&d=$d&display=$display&newsave=1";
}
switch($mode)
{
	case 'delete': 
	{				
		if($DRG_obj->deleteProcedure($itemx)){
			header($saved_header);
			exit;
		}
		break;
	}									
	case 'update_stat':
	{				
		if($DRG_obj->setProcedureCategory($pn,$itemx,$val)){
			header($saved_header);
			exit;
		}
		break;
	}									
	case 'update_loc':
	{				
		if($DRG_obj->setProcedureLocalization($itemx,$val)){
			header($saved_header);
			exit;
		}
		break;
	}									
} // end of switch
if(!isset($group_nr)) $group_nr=0;
if(!isset($opnr)) $opnr=0;

if($display=='composite'){
	$drg=&$DRG_obj->ProcedureCodes($group_nr);
}else{
	$drg=&$DRG_obj->OPProcedureCodes($opnr);
}
/* Load the icon images */
$img_delete=createComIcon($root_path,'delete2.gif','0','right',TRUE);

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE></TITLE>
 
  <script language="javascript">
<!-- 
function pruf(d)
{
	if((d.keyword.value=="")||(d.keyword.value==" ")) return false;
}
function openOPSsearch(k,x)
{
	urlholder="drg-ops301-search.php?sid=<?php echo "$sid&lang=$lang&pn=$pn&edit=$edit&ln=$ln&fn=$fn&bd=$bd&opnr=$opnr&group_nr=$group_nr&dept_nr=$dept_nr&oprm=$oprm" ?>&keyword="+k+"&showonly="+x;
	drgwin_<?php echo $uid ?>=window.open(urlholder,"drgwin_<?php echo $uid ?>","width=600,height=450,menubar=no,resizable=yes,scrollbars=yes");
	window.drgwin_<?php echo $uid ?>.moveTo(100,100);
}
function openQuicklist(t)
{
	urlholder="drg-quicklist.php?sid=<?php echo "$sid&lang=$lang&pn=$pn&edit=$edit&ln=$ln&fn=$fn&bd=$bd&opnr=$opnr&group_nr=$group_nr&dept_nr=$dept_nr&oprm=$oprm" ?>&target="+t;
	drgwin_<?php echo $uid ?>=window.open(urlholder,"drgwin_<?php echo $uid ?>","width=600,height=450,menubar=no,resizable=yes,scrollbars=yes");
	//window.drgwin_<?php echo $uid ?>.moveTo(100,100);
}
function deleteItem(i)
{
	if(confirm("<?php echo $LDAlertSureDelete ?>"))
	{
		//window.location.href='drg-ops301.php?sid=<?php echo "$sid&lang=$lang&mode=delete&pn=$pn&edit=$edit&ln=$ln&fn=$fn&bd=$bd&opnr=$opnr&group_nr=$group_nr&dept_nr=$dept_nr&oprm=$oprm&display=$display" ?>&item='+i;
		document.submitter.itemx.value=i;
		document.submitter.mode.value="delete";
		document.submitter.submit();
	}
}
function makeChange(v,i,m)
{
	//window.location.replace('<?php echo "$thisfile?sid=$sid&lang=$lang&mode=updatestat&pn=$pn&edit=$edit&ln=$ln&fn=$fn&bd=$bd&opnr=$opnr&group_nr=$group_nr&dept_nr=$dept_nr&oprm=$oprm&display=$display" ?>&item='+i+'&val='+v);
	document.submitter.val.value=v;
	document.submitter.itemx.value=i;
	document.submitter.mode.value=m;
	document.submitter.submit();
}

// -->
</script>
 
<?php 
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>
 <?php if($newsave) : ?>
 <script language="javascript" >
//window.parent.opener.location.href='<?php echo "oploginput.php?sid=$sid&lang=$lang&mode=saveok&enc_nr=$pn&edit=$edit&op_nr=$opnr&group_nr=$group_nr&dept_nr=$dept_nr&saal=$oprm&pyear=$y&pmonth=$m&pday=$d" ?>';
</script>
<?php endif; ?>
</HEAD>

<BODY 
<?php if($display=='composite') echo 'topmargin=0 marginheight=0 leftmargin=0 marginwidth=0';
else  echo 'topmargin=2 marginheight=2';
?>
 onLoad="if(window.focus) window.focus()" bgcolor=<?php echo $cfg['body_bgcolor']; ?>
 bgcolor=<?php echo $cfg['body_bgcolor']; ?>
<?php if (!$cfg['dhtml']){ echo ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>
<form>
<?php if($display!="composite") : ?>
<a href="javascript:window.history.back()" ><img <?php echo createLDImgSrc($root_path,'back2.gif','0') ?> width=110 height=24 align="right"></a>
<FONT    SIZE=3  FACE="verdana,Arial" color="#006600">
<b><?php echo $LDOps301 ?></b></font>&nbsp;
<!--  <input type="button" value="<?php echo $LDSearch4OPS301 ?>" onClick="javascript:openOPSsearch('','0')">&nbsp;
 <input type="button" value="<?php echo $LDQuickList ?>" onClick="javascript:openOPSsearch('','0')">
 --><?php endif; ?>

<table border=0 width=100%>
  <tr>
    <td width=100% valign="top">
	<table border=0 cellpadding=1 cellspacing=1 width=100%> 
		<tr bgcolor="#009900">
 		<td><font size=2 color=#ffffff><b><nobr><?php echo $LDOps301 ?></nobr></b></td>
 		<td ><font size=2 color=#ffffff><b><?php echo $LDDescription ?></b></td>
 		<td ><font size=2 color=#ffffff><nobr><b><?php echo $LDCategory ?></b> <a href="javascript:gethelp('drg_proc_cat.php')" ><img <?php echo createComIcon($root_path,'frage.gif','0','absmiddle',TRUE) ?>></a></nobr></td>
 		<td ><font size=2 color=#ffffff><nobr><b><?php echo $LDLocalization ?> <a href="javascript:gethelp('drg_proc_loc.php')" ><img <?php echo createComIcon($root_path,'frage.gif','0','absmiddle',TRUE) ?>></a></nobr></b></td>
 		<td><font size=2 color=#ffffff><b><?php echo $LDDoneBy ?></b></td>
<?php if($display=='composite') : ?>
 		<td><font size=2 color=#ffffff>&nbsp;</td>
<?php endif; ?>
    	</tr>

<?php
if (is_object($drg)) { 
	# Load the diagnosis categories
	if($cat_obj=&$DRG_obj->ProcedureCategories()) $cat_ok=true;
		else $cat_ok=false;
	# Load the localization types
	if($loc_obj=&$DRG_obj->LocalizationTypes()) $loc_ok=true;
		else $loc_ok=false;
	
	while($procedure=$drg->FetchRow()){
		if($procedure['category_nr']=="1") $fcolor="#006600"; else $fcolor="#000000";
		echo "<tr class=";
		if($toggle) { echo "wardlistrow2>"; $toggle=0;} else {echo "wardlistrow1>"; $toggle=1;};
		echo '
		<td><font size=2><a href="javascript:openOPSsearch(\''.$procedure['code'].'\',\'1\')">'.$procedure['code'].'</a>
		</td>	
		<td><font size=2 color="'.$fcolor.'">'.$procedure['parent_desc'].' <b>'.$procedure['description'].'</b>
		</td>
		<td><font size=2  color="'.$fcolor.'">';
		if($procedure['category_nr']=="1"){
			if(defined('CATEGORY_NAME_FULL')&&CATEGORY_NAME_FULL){
			 echo "<b>$LDMain</b>";
			}else{
				echo  "<b>$LDMain_s</b>";
			}
		}elseif(!$edit){
			if($procedure['category_nr']){
				if($cat_ok){
					while($cat=$cat_obj->FetchRow()){
						if($procedure['category_nr']==$cat['nr']) break;
					}
					if(defined('CATEGORY_NAME_FULL')&&CATEGORY_NAME_FULL){
						if(isset($$cat['LD_var'])&&!empty($$cat['LD_var']))  echo $$cat['LD_var'];
							else echo $cat['name'];
					}else{
						if(isset($$cat['LD_var_short_code'])&&!empty($$cat['LD_var_short_code'])) echo $$cat['LD_var_short_code'];
							else echo $cat['short_code'];
					}
					# Reset the $cat_obj
					$cat_obj->MoveFirst();
				}
			}else{
				echo '&nbsp;';
			}
		}elseif($display=='composite'){
?>
			<select name="cat_<?php echo $procedure['procedure_nr'] ?>"  onChange="makeChange(this.value,'<?php echo $procedure['procedure_nr'] ?>','update_stat')">
<?php
	/* Create the option items */
	if($cat_ok){
		echo '<option value="">  </option>
		';
		while($cat=$cat_obj->FetchRow()){
			echo '
			<option value="'.$cat['nr'].'"';
			if($procedure['category_nr']==$cat['nr']) echo ' selected';
			echo '>';
			if(defined('CATEGORY_NAME_FULL')&&CATEGORY_NAME_FULL){
				if(isset($$cat['LD_var'])&&!empty($$cat['LD_var'])) echo $$cat['LD_var'];
					else echo $cat['name'];
			}else{
				if(isset($$cat['LD_var_short_code'])&&!empty($$cat['LD_var_short_code'])) echo $$cat['LD_var_short_code'];
					else echo $cat['short_code'];
			}
			echo '</option>';
		}
		# Reset the $cat_obj
		$cat_obj->MoveFirst();
	}
?>		
        	</select>
<?php
		}else{
		
			if(defined('CATEGORY_NAME_FULL')&&CATEGORY_NAME_FULL){
				if(isset($$procedure['cat_LD_var'])&&!empty($$procedure['cat_LD_var']))  echo $$procedure['cat_LD_var'];
					else echo $procedure['cat_name'];
			}else{
				if(isset($$procedure['cat_LD_var_short_code'])&&!empty($$procedure['cat_LD_var_short_code'])) echo $$procedure['cat_LD_var_short_code'];
					else echo $procedure['cat_short_code'];
			}
		}
		echo '</td>
				<td><font size=2  color="'.$fcolor.'">';
		if($display!='composite'){
			if(defined('LOCALIZATION_NAME_FULL')&&LOCALIZATION_NAME_FULL){
				if(isset($$procedure['loc_LD_var'])&&!empty($$procedure['loc_LD_var']))  echo $$procedure['loc_LD_var'];
					else echo $icd['loc_name'];
			}else{
				if(isset($$procedure['loc_LD_var_short_code'])&&!empty($$procedure['loc_LD_var_short_code'])) echo $$procedure['loc_LD_var_short_code'];
					else echo $procedure['loc_short_code'];
			}
		}elseif(!$edit){
			if($procedure['localization']){
				if($loc_ok){
					while($loc=$loc_obj->FetchRow()){
						if($procedure['localization']==$loc['nr']) break;
					}
					if(defined('LOCALIZATION_NAME_FULL')&&LOCALIZATION_NAME_FULL){
						if(isset($$loc['LD_var'])&&!empty($$loc['LD_var'])) echo $$loc['LD_var'];
							else echo $loc['name'];
					}else{
						if(isset($$loc['LD_var_short_code'])&&!empty($$loc['LD_var_short_code'])) echo $$loc['LD_var_short_code'];
							else echo $loc['short_code'];
					}
					# Reset the loc_obj object
					$loc_obj->MoveFirst();
				}
			}else{
				echo '&nbsp;';
			}
		}else{
?>
			<select name="loc_<?php echo $procedure['procedure_nr'] ?>"  onChange="makeChange(this.value,'<?php echo $procedure['procedure_nr'] ?>','update_loc')">
<?php
	/* Create the option items */
	if($loc_ok){
		echo '<option value="">  </option>
		';
		while($loc=$loc_obj->FetchRow()){
			echo '
			<option value="'.$loc['nr'].'"';
			if($procedure['localization']==$loc['nr']) echo ' selected';
			echo '>';
			if(defined('LOCALIZATION_NAME_FULL')&&LOCALIZATION_NAME_FULL){
				if(isset($$loc['LD_var'])&&!empty($$loc['LD_var'])) echo $$loc['LD_var'];
					else echo $loc['name'];
			}else{
				if(isset($$loc['LD_var_short_code'])&&!empty($$loc['LD_var_short_code'])) echo $$loc['LD_var_short_code'];
					else echo $loc['short_code'];
			}
			echo '</option>';
		}
			
		# Reset the loc_obj object
		$loc_obj->MoveFirst();

	}
?>		
        	</select>
								
<?php       
		}
		echo '</td>
				<td><font size=2>'.stripslashes($procedure['responsible_clinician']).' - '.$procedure['responsible_dept_nr'].'
				</td>';
		if($display=="composite"){
			echo '
					<td>';
			if($edit){
				echo '<a href="javascript:deleteItem(\''.$procedure['procedure_nr'].'\')"><img '.$img_delete.' alt="'.$LDDeleteEntry.'"></a>';
			}
			echo '
					</td>';
		}
		echo '</tr>';
	}
}

?>
	</table>
	
	</td>
	<?php if($display=="composite") { ?> 	 
	<td valign="top" bgcolor="#009900"><font size=2 color=#ffffff>
  		<?php
			if($edit){
		?>
	<input type="button" value="<?php echo $LDSearch ?>" onClick="javascript:openOPSsearch('','0')">&nbsp;
 	<p><input type="button" value="<?php echo $LDQuickList ?>" onClick="javascript:openQuicklist('procedure')"><p><br><p>
	
		<?php
			}
		?>
	<a href="javascript:window.parent.close()" ><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>></a></td>
	<?php } ?>  
	</tr>
</table>


</form>
<form name="submitter">
<input type="hidden" name="val" value="">
<input type="hidden" name="itemx" value="">
<input type="hidden" name="mode" value="">
<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="pn" value="<?php echo $pn; ?>">
<input type="hidden" name="opnr" value="<?php echo $opnr; ?>">
<input type="hidden" name="ln" value="<?php echo $ln; ?>">
<input type="hidden" name="fn" value="<?php echo $fn; ?>">
<input type="hidden" name="bd" value="<?php echo $bd; ?>">
<input type="hidden" name="dept_nr" value="<?php echo $dept_nr; ?>">
<input type="hidden" name="group_nr" value="<?php echo $group_nr; ?>">
<input type="hidden" name="edit" value="<?php echo $edit; ?>">
<input type="hidden" name="oprm" value="<?php echo $oprm; ?>">
<input type="hidden" name="display" value="<?php echo $display; ?>">
<input type="hidden" name="y" value="<?php echo $y; ?>">
<input type="hidden" name="m" value="<?php echo $m; ?>">
<input type="hidden" name="d" value="<?php echo $d; ?>">
</form>

</FONT>


</FONT>


</BODY>
</HTML>
