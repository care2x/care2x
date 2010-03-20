<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
define('LANG_FILE','or.php');
$local_user='ck_op_pflegelogbuch_user';
require_once($root_path.'include/inc_front_chain_lang.php');
# Create the personell object 
require_once($root_path.'include/care_api_classes/class_personell.php');
$pers_obj=new Personell;

$title=$LDOpPersonElements[$winid];
switch($winid)
{
	case 'operator': 
							$stitle='O';
							break;
	case 'assist': 
							$stitle='A';
							break;
	case 'scrub': 
							$stitle='I';
							break;
	case 'rotating': 
							$stitle='O';
							break;
	case 'ana': 
							$element='an_doctor';
							//$maxelement=10;
							break;
	default:{header('Location:'.$root_path.'/language/'.$lang.'/lang_'.$lang.'_invalid-access-warning.php'); exit;}; 
}

$thisfile=basename(__FILE__);
$forwardfile="op-pflege-log-getinfo.php?sid=$sid&lang=$lang&winid=$winid&mode=save&enc_nr=$enc_nr&dept_nr=$dept_nr&saal=$saal&pyear=$pyear&pmonth=$pmonth&pday=$pday&op_nr=$op_nr";

$search=$pers_obj->searchPersonellBasicInfo($inputdata);

?>

<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
<TITLE><?php echo $title ?></TITLE>

<script language="javascript">
<!-- 
  function resetinput(){
	document.infoform.reset();
	}

  function pruf(d){
	if(!d.inputdata.value) return false;
	else return true
	}
function savedata(iln,ifn,inx,ipr)
{
	x=inx.selectedIndex;
	//urlholder="<?php echo $forwardfile ?>&ln="+ln+"&fn="+fn+"&nx="+d[x].value;
	//window.location.replace(urlholder);
	d=document.infoform;
	d.action="op-pflege-log-getinfo.php";
	d.ln.value=iln;
	d.fn.value=ifn;
	d.pr.value=ipr;
	d.nx.value=inx[x].value;
	d.inputdata.value="?";
	d.submit();
}
-->
</script>
<?php
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>

<STYLE type=text/css>
div.box { border: double; border-width: thin; width: 100%; border-color: black; }
.v12 { font-family:verdana,arial;font-size:12; }
.v13 { font-family:verdana,arial;font-size:13; }
.v13_n { font-family:verdana,arial;font-size:13;color:#0000cc }
.v10 { font-family:verdana,arial;font-size:10; }
</style>

</HEAD>
<BODY   bgcolor="#cde1ec" TEXT="#000000" LINK="#0000FF" VLINK="#800080" topmargin=2 marginheight=2 
onLoad="<?php if($saved) echo "parentrefresh();"; ?>if (window.focus) window.focus(); window.focus();document.infoform.inputdata.focus();" >
<a href="javascript:gethelp()"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?> alt="<?php echo $LDHelp ?>" align="right"></a>

<form name="infoform" action="op-pflege-log-getpersonell.php" method="post" onSubmit="return pruf(this)">
<img <?php echo createComIcon($root_path,'magnify.gif','0','absmiddle'); ?>><font face=verdana,arial size=5 color=maroon>
<b>
<?php 
	echo str_replace("~tagword~",$title,$LDSearchPerson)."...";
	//echo $tage[$dyidx]." ($dy".".".$mo.".".$yr.")</font>";
?>
</b>
</font>

<table border=0 width=100% bgcolor="#6f6f6f" cellspacing=0 cellpadding=0 >
  <tr>
    <td>
<table border=0 width=100% cellspacing=1>
  <tr>
	<td  align=center bgcolor="#cfcfcf" class="v13_n" colspan=5><?php echo $LDSearchResult ?>:</td>
  </tr>
 <tr>
    <td align=center bgcolor="#ffffff" class="v13_n" >
<?php echo $LDLastName ?>
	</td> 
    <td align=center bgcolor="#ffffff" class="v13_n" >
<?php echo $LDName ?>

	</td> 
    <td align=center bgcolor="#ffffff"  class="v13_n" >
<?php echo $LDJobId ?>

	</td> 
    <td align=center bgcolor="#ffffff"   class="v13_n" >
<?php echo "$LDOr $LDFunction" ?>
	</td> 
    <td align=center bgcolor="#ffffff"   class="v13_n" >

	</td> 
  </tr>	

<?php if($pers_obj->record_count) : ?>

<?php 	$counter=0;
		while($result=$search->FetchRow())
		{
			echo '
	  		<tr bgcolor="#ffffff">
    			<td class="v13" >
				&nbsp;<a href="javascript:savedata(\''.$result[name_last].'\',\''.$result[name_first].'\',document.infoform.f'.$counter.',\''.$result[job_function_title].'\')" title="'.str_replace("~tagword~",$title,$LDUseData).'">'.$result[name_last].'</a>
				</td> 
    			<td   class="v13" >
				&nbsp;<a href="javascript:savedata(\''.$result[name_last].'\',\''.$result[name_first].'\',document.infoform.f'.$counter.',\''.$result[job_function_title].'\')" title="'.str_replace("~tagword~",$title,$LDUseData).'">'.$result[name_first].'</a>
				</td> 
    			<td class="v13" >
				&nbsp;'.$result[job_function_title].'
				</td> 
    			<td   class="v13" >
				<select name="f'.$counter.'">';
				for($i=1;$i<=($entrycount);$i++)
				{
					echo '
    				<option value="'.$i.'" ';
					if($i==$entrycount) echo "selected";
					echo '>'.$title.' '.$i.'</option>';
				}
    			echo '
				</select>
    
				</td> 
    			<td   class="v13" >
				&nbsp;<a href="javascript:savedata(\''.$result[name_last].'\',\''.$result[name_first].'\',document.infoform.f'.$counter.',\''.$result[job_function_title].'\')"><img '.createComIcon($root_path,'uparrowgrnlrg.gif','0').' align=absmiddle>
				'.str_replace("~tagword~",$title,$LDUseData).'..</a>
				</td> 
    			
  				</tr>';
				$counter++;
		}
?>

<?php else : ?>
  <tr>
    <td bgcolor="#ffffff"  colspan=5 align=center>
	
	<table border=0>
   <tr>
     <td><img <?php echo createMascot($root_path,'mascot1_r.gif','0','bottom'); ?>> </td>
     <td><font size=3 color=maroon face=verdana,arial>
	 <?php echo $LDSorryNotFound ?>
	</td>
   </tr>
 </table>
 
	
	
	</td> 

  </tr>	
<?php endif ?>


  		<tr>
   			 <td  class="v12"  bgcolor="#cfcfcf" colspan=5>&nbsp;
		 </td>

		  </tr>
  		<tr>
   			 <td  class="v12"  bgcolor="#ffffff" colspan=5 align=center><br><p>
			<font size=3><b><?php echo str_replace("~tagword~",$title,$LDSearchNewPerson) ?>:</b>	<br>
			 <input type="text" name="inputdata" size=25 maxlength=30><br> <input type="submit" value="<?php echo $LDSearch ?>"><p><br>
			 </td>

		  </tr>
	 
		  </table>
</td>
  </tr>
</table>

<input type="hidden" name="encoder" value="<?php echo $ck_op_pflegelogbuch_user; ?>">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="winid" value="<?php echo $winid ?>">
<input type="hidden" name="pyear" value="<?php echo $pyear ?>">
<input type="hidden" name="pmonth" value="<?php echo $pmonth ?>">
<input type="hidden" name="pday" value="<?php echo $pday ?>">
<input type="hidden" name="dept_nr" value="<?php echo $dept_nr ?>">
<input type="hidden" name="saal" value="<?php echo $saal ?>">
<input type="hidden" name="op_nr" value="<?php echo $op_nr ?>">
<input type="hidden" name="enc_nr" value="<?php echo $enc_nr ?>">
<input type="hidden" name="title" value="<?php echo $title ?>">
<input type="hidden" name="entrycount" value="<?php echo $entrycount ?>">
<input type="hidden" name="mode" value="save">
<input type="hidden" name="ln" value="">
<input type="hidden" name="fn" value="">
<input type="hidden" name="pr" value="">
<input type="hidden" name="nx" value="">

</form>
<p>
<a href="<?php echo "op-pflege-log-getinfo.php?sid=$sid&lang=$lang&dept_nr=$dept_nr&saal=$saal&op_nr=$op_nr&enc_nr=$enc_nr&pday=$pday&pmonth=$pmonth&pyear=$pyear&winid=$winid";?>"><img <?php echo createLDImgSrc($root_path,'back2.gif','0','left'); ?>>
</a><a href="javascript:window.close()">
<img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?> border="0" alt="<?php echo $LDClose ?>" align="right">
</a>

</BODY>

</HTML>
