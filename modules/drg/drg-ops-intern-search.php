<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.2 - 2006-07-10
* GNU General Public License
* Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','drg.php');

require_once('drg_inc_local_user.php');

//$db->debug=1;

require_once($root_path.'include/inc_front_chain_lang.php');

if (!isset($pn)||!$pn) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php?mode=close"); exit;}; 

require_once($root_path.'include/care_api_classes/class_drg.php');

$drg_obj=new DRG($pn);

if($saveok)
{
?>
    <script language="javascript" >
    window.opener.location.replace('drg-ops-intern.php?sid=<?php echo "$sid&lang=$lang&pn=$pn&opnr=$opnr&group_nr=$group_nr&edit=$edit&ln=$ln&fn=$fn&bd=$bd&dept_nr=$dept_nr&oprm=$oprm&y=$y&m=$m&d=$d&display=composite&newsave=1"; ?>');
    //window.opener.parent.INTERN.location.reload();
    window.close();
   </script>
<?php   

   exit; 
 }

//$db->debug=true;
$toggle=0;

$thisfile='drg-ops-intern-search.php';

if($mode=='save')
{
	$target='ops-intern';
	$element='ops_intern_code';
	$itemselector='sel';
	include($root_path.'include/inc_drg_entry_save.php');
}else{

	$keyword=trim($keyword);
	if(($keyword)&&($keyword!=' ')){
		if($drg=$drg_obj->searchGroup($keyword)){
			$linecount=$drg->RecordCount();
		}
	}
}

/* Preset the images */

$img['delete']=createComIcon($root_path,'delete2.gif','0','right',TRUE);
$img['arrow']=createComIcon($root_path,'l_arrowgrnsm.gif','0','absmiddle',TRUE);
$img['info']=createComIcon($root_path,'button_info.gif','0','absmiddle',TRUE);
$img['bubble']=createComIcon($root_path,'bubble2.gif','0','absmiddle',TRUE);
$img['blue']=createComIcon($root_path,'l2-blue.gif','0','',TRUE);
$img['t2']=createComIcon($root_path,'t2-blue.gif','0','',TRUE);

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE><?php echo $LDInternalCodeNr ?></TITLE>
  <script language="javascript" src="<?php echo $root_path ?>js/showhide-div.js">
</script>
  <script language="javascript">
<!-- 
function pruf(d)
{
	if((d.keyword.value=="")||(d.keyword.value==" ")) return false;
}
function subsearch(k)
{
	//window.location.href='drg-icd10-search.php?sid=<?php echo "sid=$sid&lang=$lang&pn=$pn&opnr=$opnr&edit=$edit&ln=$ln&fn=$fn&bd=$bd&dept_nr=$dept_nr&oprm=$oprm&display=$display" ?>&keyword='+k;
	document.searchdata.keyword.value=k;
	document.searchdata.submit();
}
function checkselect(d)
{
	var ret=false;
	var x=d.lastindex.value;
	for(i=0;i<x;i++)
	if(eval("d.sel"+i+".checked"))
	{
		ret=true;
		break;
	}
	return ret;
}
// -->
</script>
 
<?php 
require($root_path.'include/inc_css_a_hilitebu.php');
?>
 
</HEAD>

<BODY   onLoad="if(window.focus) window.focus();
<?php if(!$showonly) : ?>
document.searchdata.keyword.select();document.searchdata.keyword.focus();
<?php endif; ?>
" bgcolor=<?php echo $cfg['body_bgcolor']; ?>
<?php if (!$cfg['dhtml']){ echo ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<FONT    SIZE=-1  FACE="Arial">
<ul>
<FORM action="<?php echo $thisfile ?>" method="post" name="searchdata" onSubmit="return pruf(this)">
<a href="javascript:window.close()"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> align="right"></a>
<?php if(!$showonly) : ?>
<FONT    SIZE=3  FACE="verdana,Arial" color="#660000"><b><?php echo $LDOpsIntern ?></b>&nbsp;
</font>
<font size=3>
<INPUT type="text" name="keyword" size="50" maxlength="60" onfocus=this.select() value="<?php echo $keyword ?>"></font>
<br>
<INPUT type="submit" name="versand" value="<?php echo $LDSearch ?>">
<?php else : ?>
<input type="hidden" name="keyword" value="">
<?php endif;?>
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
<input type="hidden" name="current" value="<?php echo $current; ?>">
<input type="hidden" name="oprm" value="<?php echo $oprm; ?>">
<input type="hidden" name="display" value="<?php echo $display; ?>">
</FORM>
<p>

<form name="ops301" <?php if(!isset($current)||!$current) { ?>  onSubmit="return checkselect(this)" <?php } ?>>

<table border=0 cellpadding=0 cellspacing=0 width='100%'> 
<tr bgcolor="#660000">
<td width="20">
<?php if(!$showonly) : ?>
<img <?php echo $img['delete'] ?> alt="<?php echo $LDReset ?>" onClick="javascript:document.ops301.reset()">
<?php endif; ?>
</td>
<td><font face=arial size=2 color=#ffffff>&nbsp;<b><nobr><?php echo $LDOpsIntern ?></nobr></b>&nbsp;</td>

<td colspan=7><font face=arial size=2 color=#ffffff>&nbsp;&nbsp;&nbsp;<b><?php echo $LDDescription ?></b>
</td>
		
</tr>

<?php
function cleandata(&$buf)
{
	return strtr($buf,",.()*+-","_______");
}

function drawAdditional($tag,&$codebuf,&$databuf,$bkcolor,&$alttag)
{
	global $LDClose, $img;
	
	
							//echo '&nbsp;<a href="javascript:ssm(\''.$tag.'_'.cleandata($codebuf).'\'); clearTimeout(timer)"><img src="../img/l_arrowGrnSm.gif" border=0 width=12 height=12 alt="'.$alttag.'" align="absmiddle"></a>';
							echo '<DIV id='.$tag.'_'.cleandata($codebuf).'
									style=" VISIBILITY: hidden; POSITION: absolute;">
									<TABLE cellSpacing=1 cellPadding=0 bgColor="#000000" border=0>
  									<TR>
   									 <TD>
      									<TABLE cellSpacing=1 cellPadding=7 width="100%" bgColor="#'.$bkcolor.'" border=0><TBODY>
        								<TR>
										<TD bgColor="#'.$bkcolor.'">
										<a href="javascript:hsm()"><img '.$img['delete'].' alt="'.$LDClose.'" ></a>
										<font face=arial size=2><b><font color="#003300">'.$alttag.':</font></b><br>'.$databuf.'
										</TD></TR></TABLE></TD></TR></TBODY></TABLE></div>';
}

function drawdata(&$data)
{
	global $toggle,$LDInclusive,$LDExclusive,$LDNotes,$LDRemarks,$LDExtraCodes,$LDAddCodes,
	         $idx,$keyword,$showonly,$img,$current;
			 //$img_arrow,$img_info, $img_bubble, $img_blue, $img_t2;

	
						echo "
						<tr class=";
						if($toggle) { echo "wardlistrow2>"; $toggle=0;} else {echo "wardlistrow1>"; $toggle=1;};
						echo '
						<td>';
						if(!$showonly)
							{
/*								$valbuf="code=$data['code']";
								if(!stristr($data['code'],".")) $valbuf.="&des=$data[description]";
									else $valbuf.="&des=$parentdata[description] <b>$data[description]</b>";
*/						 		if($current) echo  '<input type="radio" name="sel" value="'.$data['nr'].'">';
										else echo '<input type="checkbox" name="sel'.$idx.'" value="'.$data['nr'].'">';
								 $idx++;
							}
						echo '
							</td>
							<td><font face=arial size=2><nobr>';
						//echo " *$parentcode +$grandcode";
						 echo $data['code'].'&nbsp;';		
						echo "&nbsp;</nobr></td>";
						switch($data[sub_level])
							{
								case 0:echo '
													<td colspan=7>';
											break;
								case 1:echo '
													<td colspan=7>';
											break;
								case 2: echo '
													<td colspan=2>&nbsp;</td>
													<td valign="top">';
											echo '&nbsp;';
											echo '
													</td><td colspan=4>';
											break;
								case 3: echo '
													<td colspan=3>&nbsp;</td>
													<td valign="top">';
											if($advdata[sub_level]<$data[sub_level]) echo '<img '.$img['blue'].'>'; else echo '<img '.$img['t2'].'>';
											echo '</td>
													<td colspan=3>';
											break;
								case 4: echo '
													<td colspan=4>&nbsp;</td>
													<td valign="top">';
											if($advdata[sub_level]<$data[sub_level]) echo '<img '.$img['blue'].'>'; else echo '<img '.$img['t2'].'>';
											echo '</td>
													<td colspan=2>&nbsp;';
											break;
								case 5: echo '
													<td colspan=5>&nbsp;</td>
													<td valign="top">';
											if($advdata[sub_level]<$data[sub_level]) echo '<img '.$img['blue'].'>'; else echo '<img '.$img['t2'].'>';
											echo '</td>
													<td>&nbsp;';
											break;
							}
						//echo '<font face=arial size=2>'.trim($data[description]);
						echo '<font face=arial size=2>';
						echo "$data[description]&nbsp;";		
						
						if($data[inclusive])
						{
							echo '&nbsp;<a href="javascript:ssm(\'i_'.cleandata($data['code']).'\');"><img '.$img['arrow'].' alt="'.$LDInclusive.'"></a>';
							drawAdditional("i",$data['code'],$data[inclusive],"00ffcc",$LDInclusive);
						}
						//if($data[inclusive]) echo '<br><font size=2 color="#00aa00">'.$data[inclusive].'</font>';
						if($data[exclusive])
						{
							echo '&nbsp;<a href="javascript:ssm(\'e_'.cleandata($data['code']).'\');"><img '.$img['warn'].' alt="'.$LDExclusive.'"></a>';
							drawAdditional("e",$data['code'],$data[exclusive],"ffccee",$LDExclusive);
						}
						if($data[notes]) 
						{
							echo '&nbsp;<a href="javascript:ssm(\'n_'.cleandata($data['code']).'\');"><img '.$img['info'].' alt="'.$LDNotes.'"></a>';
							drawAdditional("n",$data['code'],$data[notes],"ffcc99",$LDNotes);
						}
						if($data[remarks]) 
						{
							echo '&nbsp;<a href="javascript:ssm(\'r_'.cleandata($data['code']).'\');"><img '.$img['bubble'].' alt="'.$LDRemarks.'"></a>';
							drawAdditional("r",$data['code'],$data[remarks],"cceeff",$LDRemarks);
						}
						echo '</td>';
					echo "</tr>";
}

if ($drg){ 
	$idx=0;
	while($row=$drg->FetchRow()){
		drawdata($row);
	}
}
?>

</table>
<?php if(!$showonly&&($linecount>0)) { ?>
<input type="hidden" name="lastindex" value="<?php echo $idx ?>">
<input type="submit" value="<?php echo $LDApplySelection ?>">
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
<input type="hidden" name="current" value="<?php echo $current; ?>">
<input type="hidden" name="oprm" value="<?php echo $oprm; ?>">
<input type="hidden" name="display" value="<?php echo $display; ?>">
<input type="hidden" name="mode" value="save">

</form>
<?php 
}else{
/*

?>
<p>
<a href="javascript:window.close()"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>></a>
<?php 
*/
}
?>
<?php if(($linecount>15)&&!$showonly) { ?>

<p>
<FORM action="<?php echo $thisfile ?>" method="post" onSubmit="return pruf(this)" name="form2">
<a href="javascript:window.close()"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?> align="right"></a>
<font face="Arial,Verdana"  color="#000000" size=-1>
<INPUT type="text" name="keyword" size="14" maxlength="25" value="<?php echo $keyword ?>">
<br>
<INPUT type="submit" name="versand" value="<?php echo $LDSearch ?>">
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
<input type="hidden" name="current" value="<?php echo $current; ?>">
<input type="hidden" name="oprm" value="<?php echo $oprm; ?>">
<input type="hidden" name="display" value="<?php echo $display; ?>">
</font></FORM>			
						<p>
<?php } ?>
</ul>
&nbsp;
</FONT>


</FONT>


</BODY>
</HTML>
