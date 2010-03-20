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

require_once($root_path.'include/inc_front_chain_lang.php');
//if (!isset($opnr) || !$opnr) {header("Location:".$root_path."language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;};

# Create drg object
require_once($root_path.'include/care_api_classes/class_drg.php');
$drg=& new DRG;

//$db->debug=true;

if($saveok){
?>
<script language="javascript" >
	window.opener.location.replace('drg-icd10.php?sid=<?php echo "$sid&lang=$lang&pn=$pn&opnr=$opnr&edit=$edit&ln=$ln&fn=$fn&bd=$bd&group_nr=$group_nr&dept_nr=$dept_nr&oprm=$oprm&y=$y&m=$m&d=$d&display=composite&newsave=1"; ?>');
    //window.opener.parent.ICD.location.reload();
	window.close();
</script>

<?php
  exit;
}

$toggle=0;
$thisfile='drg-icd10-search.php';

if($mode=='save'){
    /* Initialiase control elements */
	$target='icd10';
	$element='icd_code';
	$save_related=1;
	$element_related='related_icd';
	$itemselector='sel';
	$hidselector='icd_px';
	include($root_path.'include/inc_drg_entry_save.php');
}else{

	$keyword=trim($keyword);
	if(!empty($keyword)){
	 
		$fielddata='diagnosis_code,description,sub_level,inclusive,exclusive,notes,remarks,extra_subclass,extra_codes,std_code';
		
		# Search routine starts here

		if(strlen($keyword)<3){
		
			# Added the special case of Bosnian (or Serbian) version with the latin description in the "description" field
			#and the actual local language version in the "note" field
			if($lang=="bs" || $lang == "sr") $sAddWhere= "OR notes $sql_LIKE '$keyword%'";
				else $sAddWhere ='';

			$sql="SELECT $fielddata FROM $drg->tb_diag_codes WHERE (diagnosis_code $sql_LIKE '%$keyword%' OR description $sql_LIKE '$keyword%' $sAddWhere) AND type <> 'table'";

			}else{

			# Added the special case of Bosnian (or Serbian) version with the latin description in the "description" field
			#and the actual local language version in the "note" field
			if($lang=="bs" || $lang == "sr") $sAddWhere= "OR notes $sql_LIKE '%$keyword%'";
				else $sAddWhere ='';

				$sql="SELECT $fielddata FROM $drg->tb_diag_codes WHERE (diagnosis_code $sql_LIKE '%$keyword%' OR description $sql_LIKE '%$keyword%' $sAddWhere) AND type <> 'table'";
			
			}
//echo $sql;
		$ergebnis=$db->SelectLimit($sql,50);
		if($ergebnis){
			$linecount=0;
			if ($linecount=$ergebnis->RecordCount()){
				if(strlen($keyword)<3){
					$advsql="SELECT sub_level FROM $drg->tb_diag_codes WHERE (diagnosis_code $sql_LIKE '%$keyword%' OR description $sql_LIKE '$keyword%') AND type <> 'table'";
				}else{
					$advsql="SELECT sub_level FROM $drg->tb_diag_codes WHERE (diagnosis_code $sql_LIKE '%$keyword%' OR description $sql_LIKE '%$keyword%') AND type <> 'table'";
				}
        		$adv=$db->SelectLimit($advsql,50);
			}
		}else {echo "<p>".$sql."<p>$LDDbNoRead"; };
	}
}

/* Load the icon images */

$img['delete']=createComIcon($root_path,'delete2.gif','0','right',TRUE);
$img['arrow']=createComIcon($root_path,'l_arrowgrnsm.gif','0','absmiddle',TRUE);
$img['warn']=createComIcon($root_path,'warn.gif','0','absmiddle',TRUE);
$img['info']=createComIcon($root_path,'button_info.gif','0','absmiddle',TRUE);
$img['bubble']=createComIcon($root_path,'bubble2.gif','0','absmiddle',TRUE);
$img['blue']=createComIcon($root_path,'l2-blue.gif','0','',TRUE);
$img['t2']=createComIcon($root_path,'t2-blue.gif','0','',TRUE);
$img['plus']=createComIcon($root_path,'plus2.gif','0','absmiddle',TRUE);
$img['reset']=createComIcon($root_path,'button_reset.gif','0','absmiddle',TRUE);

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE><?php echo $LDIcd10Search ?></TITLE>
 <script language="javascript" src="<?php echo $root_path; ?>js/showhide-div.js">
</script>
  <script language="javascript">
<!-- 
function pruf(d)
{
	if((d.keyword.value=="")||(d.keyword.value==" ")) return false;
}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
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

<BODY  onLoad="if(window.focus) window.focus(); 
<?php if(!$showonly) : ?> document.searchdata.keyword.select();document.searchdata.keyword.focus();
<?php endif; ?>
" bgcolor=<?php echo $cfg['body_bgcolor']; ?>
<?php if (!$cfg['dhtml']){ echo ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<FONT    SIZE=-1  FACE="Arial">
<ul>
<FORM action="drg-icd10-search.php" method="post" name="searchdata" onSubmit="return pruf(this)">
<a href="javascript:window.close()"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> align="right"></a>
<?php if(!$showonly) : ?>
<FONT    SIZE=3  FACE="verdana,Arial" color="#0000aa"><b><?php echo $LDIcd10 ?></b>&nbsp;
</font>
<font size=3><INPUT type="text" name="keyword" size="50" maxlength="60" onfocus="this.select()" value="<?php echo $keyword ?>"></font> 
<br>
<INPUT type="submit" name="versand" value="<?php echo $LDSearch ?>">
<?php else : ?>
<input type="hidden" name="keyword" value="">
<?php endif; ?>
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
<input type="hidden" name="showonly" value="<?php echo $showonly; ?>">
<input type="hidden" name="target" value="<?php echo $target; ?>">
</FORM>
<p>
<form name="icd10" onSubmit="return checkselect(this)">
<table border=0 cellpadding=0 cellspacing=0 width='100%'> 
<tr bgcolor=#0000aa>
<td width="20">
<?php if(!$showonly) : ?>
<img <?php echo $img['delete'] ?> alt="<?php echo $LDReset ?>" onClick="javascript:document.icd10.reset()">
<?php endif; ?>
</td>
<td><font size=2 color=#ffffff>&nbsp;<b><?php echo $LDIcd10 ?></b>&nbsp;</td>
<td><font size=2 color=#ffffff>&nbsp;<b><?php echo $LDSGBV ?></b>&nbsp;</td>

<td colspan=7><font size=2 color=#ffffff>&nbsp;<b><?php echo $LDDescription ?></b>
</td>
		
</tr>

<?php
function cleandata(&$buf)
{
	return strtr($buf,",.()*+-!","________");
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
				<a href="javascript:hsm()"><img '.$img['delete'].' alt="'.$LDClose.'"></a>
				<font size=2><b><font color="#003300">'.$alttag.':</font></b><br>'.$databuf.'
				</TD></TR></TABLE></TD></TR></TBODY></TABLE></div>';
}

function drawdata(&$data,&$advdata)
{
	global $toggle,$parentcode,$grandcode,$priocolor,$LDInclusive,$LDExclusive,$LDNotes,$LDRemarks,$LDExtraCodes,$LDAddCodes;
 	global $idx,$parenthref,$showonly,$parentdata,$img;
						echo "
						<tr class=";
						if($priocolor) echo "hilite>";
						elseif($toggle) { echo "wardlistrow2>"; $toggle=0;} else {echo "wardlistrow1>"; $toggle=1;};
						echo '<td>';
						if($priocolor) echo "&nbsp;"; elseif(!$showonly)
						{
/*							$valbuf="code*$data[diagnosis_code]&cat*$data[std_code]";
							if(stristr($data[diagnosis_code],".-")) $valbuf.="&des*$data[description]";
								else $valbuf.="&des*$parentdata[description]: <b>$data[description]</b>";
*/						
						 echo '<input type="checkbox" name="sel'.$idx.'" value="'.$data['diagnosis_code'].'">
						 		<input type="hidden" name="icd_px'.$idx.'" value="'.$parentdata['diagnosis_code'].'">';
						 $idx++;
						}
						echo '
							</td>
							
							<td><font size=2><nobr>';
						//echo " *$parentcode +$grandcode";
					
						if($parenthref) 
							echo '<u><a href="javascript:subsearch(\''.substr($data[diagnosis_code],0,strpos($data['diagnosis_code'],"-")-1).'\')">'.$data['diagnosis_code'].'</a></U>';
						else echo $data['diagnosis_code'].'&nbsp;';		
						echo '&nbsp;</nobr>
						</td>
						<td align="center"><font size=2>'.$data['std_code'].'&nbsp;
							</td>';
										
						switch($data['sub_level'])
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
											echo '<img '.$img['t2'].'>';
											echo '
													</td><td colspan=4>';
											break;
								case 3: echo '
													<td colspan=3>&nbsp;</td>
													<td valign="top">';
											if($advdata['sub_level']<$data['sub_level']) echo '<img '.$img['blue'].'>'; else echo '<img '.$img['t2'].'>';
											echo '</td>
													<td colspan=3>';
											break;
								case 4: echo '
													<td colspan=4>&nbsp;</td>
											<td valign="top">';
											if($advdata['sub_level']<$data['sub_level']) echo '<img '.$img['blue'].'>'; else echo '<img '.$img['t2'].'>';
											echo '</td>
													<td colspan=2>&nbsp;';
											break;
								case 5: echo '
													<td colspan=5>&nbsp;</td>
											<td valign="top">';
											if($advdata['sub_level']<$data['sub_level']) echo '<img '.$img['blue'].'>'; else echo '<img '.$img['t2'].'>';
											echo '</td>
													<td>&nbsp;';
											break;
							}
						//echo '<font size=2>'.trim($data[description]);
						echo '<font size=2>';
						if($parenthref) echo '<u><a href="javascript:subsearch(\''.substr($data[diagnosis_code],0,strpos($data[diagnosis_code],"-")-1).'\')">'.$data[description].'</a></U>';
						else echo $data['description'].'&nbsp;';		
						if($data[inclusive]) 
						{
							echo '&nbsp;<a href="javascript:ssm(\'i_'.cleandata($data[diagnosis_code]).'\');"><img '.$img['arrow'].' alt="'.$LDInclusive.'"></a>';
							drawAdditional("i",$data[diagnosis_code],$data[inclusive],"00ffcc",$LDInclusive);
						}
						//if($data[inclusive]) echo '<br><font size=2 color="#00aa00">'.$data[inclusive].'</font>';
						if($data[exclusive])
						{
							 echo '&nbsp;<a href="javascript:ssm(\'e_'.cleandata($data[diagnosis_code]).'\');"><img '.$img['warn'].' alt="'.$LDExclusive.'"></a>';
							drawAdditional("e",$data[diagnosis_code],$data[exclusive],"ffccee",$LDExclusive);
						}
						if($data[notes])
						{
							echo '&nbsp;<a href="javascript:ssm(\'n_'.cleandata($data[diagnosis_code]).'\');"><img '.$img['info'].' alt="'.$LDNotes.'"></a>';
							drawAdditional("n",$data[diagnosis_code],$data[notes],"ffcc99",$LDNotes);
						}
						if($data[remarks]) 
						{
							echo '&nbsp;<a href="javascript:ssm(\'r_'.cleandata($data[diagnosis_code]).'\');"><img '.$img['bubble'].' alt="'.$LDRemarks.'"></a>';
							drawAdditional("r",$data[diagnosis_code],$data[remarks],"cceeff",$LDRemarks);
						}
						if($data[extra_codes])
						{
						 	echo '&nbsp;<a href="javascript:ssm(\'x_'.cleandata($data[diagnosis_code]).'\');"><img '.$img['plus'].' alt="'.$LDExtraCodes.'"></a>';
							drawAdditional("x",$data[diagnosis_code],$data[extra_codes],"ffff66",$LDExtraCodes);
						}
						if($data[extra_subclass])
						{
							echo '&nbsp;<a href="javascript:ssm(\'s_'.cleandata($data[diagnosis_code]).'\');"><img '.$img['reset'].' alt="'.$LDAddCodes.'"></a>';
							drawAdditional("s",$data[diagnosis_code],$data[extra_subclass],"efefef",$LDAddCodes);
						}
						echo '</td>';
						$parenthref=0;
}

			if ($linecount>0) 
				{ 
					$idx=0;
					$grandpa=array();
					$parent=array();
					$advzeile=$adv->FetchRow();
					while($zeile=$ergebnis->FetchRow())
					{
							$advzeile=$adv->FetchRow();
							// process code
							$strbuf=trim($zeile['diagnosis_code']);
							if(stristr($strbuf,".-")) 
							{
								$parentcode=substr($strbuf,0,strpos($strbuf,"."));
								$grandcode=substr($parentcode,0,2);
								$parent[$parentcode]=1;
								$parentdata=$zeile;
								//echo "parent";
								//$priocolor=1;
							}
							else
							{
								if(stristr($strbuf,"-"))
								{ 
									//
									$parentcode=substr($strbuf,0,3);
									$grandcode=substr($parentcode,1,2);
									$grandpa[$grandcode]=1;
									$priocolor=1;//echo "hello";
									$parent[$parentcode]=1; 
										// echo "grand";
									//echo "$grandcode $parentcode";
								}	
								else
								{
									$parentcode=substr($strbuf,0,3);
									$grandcode=substr($parentcode,0,2);
								}	
														
							}
							//echo "#$zeile[diagnosis_code] *$parentcode +$grandcode";
						
							if(!$grandpa[$grandcode])
							{
								//echo "grand";
								$sql="SELECT $fielddata FROM $drg->tb_diag_codes  WHERE  type <> 'table'  AND (diagnosis_code  $sql_LIKE '%".$grandcode."0-%' OR diagnosis_code  $sql_LIKE '%".$parentcode."-%') ";
        						$result=$db->SelectLimit($sql,1);
								if($result)
								{
									if($granddata=$result->FetchRow())
									{
										//mysql_data_seek($result,0);
										$priocolor=1;
										drawdata($granddata,$zeile);
										$grandpa[$grandcode]=1;
									}
										$priocolor=0;
								}
							}

							if(!$parent[$parentcode])
							{
								//echo "parent";
								$sql="SELECT $fielddata FROM $drg->tb_diag_codes  WHERE diagnosis_code $sql_LIKE '".$parentcode.".-%' AND type <> 'table'";
        						$lines=$db->SelectLimit($sql,1);
								if($lines)
								{
									if($lines->RecordCount())
									{
										$parenthref=1;
										$parentdata=$lines->FetchRow();
										drawdata($parentdata,$zeile);
										$parent[$parentcode]=1;
										//$idx++;
									}
								}
						}
						drawdata($zeile,$advzeile);
						//$idx++;
						echo "</tr>";
						$priocolor=0;
					}
				}
?>

</table>

<?php

if(!$showonly&&($linecount>0)) { 

?>
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
<input type="hidden" name="oprm" value="<?php echo $oprm; ?>">
<input type="hidden" name="display" value="<?php echo $display; ?>">
<input type="hidden" name="target" value="<?php echo $target; ?>">
<input type="hidden" name="mode" value="save">

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

</form>

<?php if(($linecount>15)&&!$showonly) : ?>

<p>
<FORM action="drg-icd10-search.php" method="post" onSubmit="return pruf(this)" name="form2">
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
<input type="hidden" name="oprm" value="<?php echo $oprm; ?>">
<input type="hidden" name="display" value="<?php echo $display; ?>">
<input type="hidden" name="showonly" value="<?php echo $showonly; ?>">
<input type="hidden" name="target" value="<?php echo $target; ?>">
</font></FORM>
<p>
<?php endif ?>
</ul>
&nbsp;
</FONT>


</FONT>


</BODY>
</HTML>
