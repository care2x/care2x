<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
define('LANG_FILE','or.php');
$local_user='ck_op_pflegelogbuch_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');
/* Create the personell object */
require_once($root_path.'include/care_api_classes/class_personell.php');
$pers_obj=new Personell;

$title=$LDOpPersonElements[$winid];


switch($winid)
{
	case 'operator': 
							$element='operator';
							//$maxelement=10;
							$quickid='doctor';
							$quicklist=$pers_obj->getDoctorsOfDept($dept_nr);
							break;
	case 'assist': 
							$element='assistant';
							//$maxelement=10;
							$quickid='doctor';
							$quicklist=$pers_obj->getDoctorsOfDept($dept_nr);
							break;
	case 'scrub': 
							$element='scrub_nurse';
							//$maxelement=10;
							$quickid='nurse';
							$quicklist=$pers_obj->getNursesOfDept($dept_nr);
							break;
	case 'rotating':
							$element='rotating_nurse';
							//$maxelement=10;
							$quickid='nurse';
							$quicklist=$pers_obj->getNursesOfDept($dept_nr);
							break;
	case 'ana':
							$element='an_doctor';
							//$maxelement=10;
							$quickid='doctor';
							$quicklist=$pers_obj->getDoctorsOfDept(42); // 42 = anesthesiology department
							break;
	default:{header('Location:'.$root_path.'language/'.$lang.'/lang_'.$lang.'_invalid-access-warning.php'); exit;}; 
}

if($pers_obj->record_count) $quickexist=true;

$thisfile=basename(__FILE__);

/* Establish db connection */
if(!isset($db)||!$db) include($root_path.'include/core/inc_db_makelink.php');
if($dblink_ok){	
	// get data if exists
	$dbtable='care_encounter_op';
	$sql="SELECT $element,encoding FROM $dbtable
					 WHERE encounter_nr='$enc_nr'
					 AND dept_nr='$dept_nr'
					 AND op_nr='$op_nr'
					 AND op_room='$saal'";

	if($ergebnis=$db->Execute($sql)){
		$rows=$ergebnis->Recordcount();
		if($rows){
			$result=$ergebnis->FetchRow();
			$fileexist=1;
			//echo $sql."<br>";
		}
	}else{
		echo "$LDDbNoRead<br>";
	} 
				
		if($mode=='save')
		{
					$dbtable='care_encounter_op';

					//$encoder=$ck_op_pflegelogbuch_user; 
		
					if($fileexist)
						{
										
							// $dbuf=htmlspecialchars($dbuf);
							$result[encoding].=" ~e=".$encoder."&d=".date("d.m.Y")."&t=".date("H.i")."&a=".$element;
							if($delitem!="")
							{
								$elem=explode("~",trim($result[$element]));
								//if(!$elem[0]) array_splice($elem,0,1);
								array_splice($elem,$delitem,1);
								sort($elem,SORT_REGULAR);
								$result[$element]=implode("~",$elem);
							}
							else
							{
								//$sbuf=$result[$element]." ~n=".$ln.",+".$fn."&x=".$nx;
								$dbuf=explode("~",$result[$element]);
								$dbuf[]="n=".$ln.",+".$fn."&x=".$nx;
								sort($dbuf,SORT_REGULAR);
								$result[$element]=implode("~",$dbuf);
								//$result[$element]=$result[$element]." ~n=".$ln.",+".$fn."&x=".$nx;
							}
							//echo $result[$element];
							$sql="UPDATE $dbtable SET $element='".$result[$element]."',encoding='$result[encoding]'
					 				WHERE encounter_nr='$enc_nr'
					 						AND dept_nr='$dept_nr'
					 						AND op_nr='$op_nr'
					 						AND op_room='$saal'";
											
							if($ergebnis=$db->Execute($sql))
       							{
									//echo $sql." new update <br>";
									$saveok=1;
								}
								else { echo "$LDDbNoSave<br>"; } 
						} // else create new entry
						else
						{
							// get the orig patient data
							$dbtable='care_admission_patient';
							$sql="SELECT name,vorname,gebdatum,address FROM $dbtable WHERE patnum='$patnum'";

							if($ergebnis=$db->Execute($sql))
       						{
								$rows=0;
								if( $result=$ergebnis->FetchRow()) $rows++;
								if($rows)
								{
									mysql_data_seek($ergebnis,0);
									$result=$ergebnis->FetchRow();		
									$dbtable='care_encounter_op';
									$sql="INSERT INTO $dbtable 
										(
										year,
										dept_nr,
										op_room,
										op_nr,
										op_date,
										encounter_nr,
										$element,
										encoding,
										doc_date,
										doc_time
										)
									 	VALUES
										(
										'$pyear',
										'$dept_nr',
										'$saal',
										'$op_nr',
										'".$pday.".".$pmonth.".".$pyear."',
										'$enc_nr',
										'n=".$ln.",+".$fn."&x=".$nx."',
										'e=".$encoder."&d=".date("d.m.Y")."&t=".date("H.i")."&a=".$element."',
										'".date("d.m.Y")."',
										'".date("H.i")."'
										)";

									if($ergebnis=$db->Execute($sql))
       								{
										//echo $sql." new insert <br>";
										$saveok=1;
									}
									else { echo "$LDDbNoSave<br>"; } 
								 } // end of if rows
							} // end of if ergebnis
								else { echo "$LDDbNoRead<br>"; } 
						}//end of else
					if($saveok)
						{
						
							header("location:$thisfile?sid=$sid&lang=$lang&mode=saveok&winid=$winid&enc_nr=$enc_nr&dept_nr=$dept_nr&saal=$saal&pyear=$pyear&pmonth=$pmonth&pday=$pday&op_nr=$op_nr");
						}
				}// end of if(mode==save)
			else $saved=0;
}
  else { echo "$LDDbNoLink<br>"; } 


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

function refreshparent()
{
	<?php $comdat="&dept_nr=$dept_nr&saal=$saal&thisday=$pyear-$pmonth-$pday&op_nr=$op_nr"; ?>
	//resetlogdisplays();resettimebars();resettimeframe();
	window.opener.parent.LOGINPUT.location.replace('<?php echo "oploginput.php?sid=$sid&lang=$lang&enc_nr=$enc_nr&mode=notimereset$comdat"; ?>');
	window.opener.parent.OPLOGMAIN.location.replace('<?php echo "oplogmain.php?sid=$sid&lang=$lang&gotoid=$enc_nr$comdat"; ?>');
}

function delete_item(i)
{
	d=document.infoform;
	d.action="<?php echo $thisfile ?>";
	d.delitem.value=i;
	d.inputdata.value="?";
	d.submit();
}
function savedata(iln,ifn,inx,ipr)
{
	x=inx.selectedIndex;
	//urlholder="<?php echo $forwardfile ?>&ln="+ln+"&fn="+fn+"&nx="+d[x].value;
	//window.location.replace(urlholder);
	d=document.quickselect;
	d.ln.value=iln;
	d.fn.value=ifn;
	d.pr.value=ipr;
	d.nx.value=inx[x].value;
	//d.inputdata.value="?";
	d.submit();
}
-->
</script>
<?php
require($root_path.'include/core/inc_js_gethelp.php');
require($root_path.'include/core/inc_css_a_hilitebu.php');
?>

<STYLE type=text/css>
div.box { border: double; border-width: thin; width: 100%; border-color: black; }
.v12 { font-family:verdana,arial;font-size:12; }
.v13 { font-family:verdana,arial;font-size:13; }
.v13_n { font-family:verdana,arial;font-size:13; color:#0000cc}
.v10 { font-family:verdana,arial;font-size:10; }
</style>

</HEAD>
<BODY   bgcolor="#cde1ec" TEXT="#000000" LINK="#0000FF" VLINK="#800080"  topmargin=2 marginheight=2 
onLoad="<?php if($mode=="saveok") echo "refreshparent();window.focus();"; ?>if (window.focus) window.focus();
				window.focus();document.infoform.inputdata.focus();" >
<a href="javascript:gethelp('oplog.php','person','<?php echo $winid ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?> alt="<?php echo $LDHelp ?>" align="right"></a>
<form name="infoform" action="op-pflege-log-getpersonell.php" method="post" onSubmit="return pruf(this)">
				
<font face=verdana,arial size=5 color=maroon>
<b>
<?php 
	echo $title.'<br><font size=4>';	
?>
</b>
</font>
<p>
<table border=0 width=100% bgcolor="#6f6f6f" cellspacing=0 cellpadding=0 >
  <tr>
    <td>
<table border=0 width=100% cellspacing=1 cellpadding=0>
  <tr>
    <td  bgcolor="#cfcfcf" class="v13" colspan=6>&nbsp;<b><?php echo $LDCurrentEntries ?>:</b></td>
  </tr>
  <tr  class="v13_n">
    <td align=center bgcolor="#ffffff">
	</td>     <td align=center bgcolor="#ffffff" width="20%">
<!-- <?php echo "$LDLastName, $LDName" ?>
 -->	</td> 
    <td align=center bgcolor="#ffffff">
<?php echo $LDFunction ?>
	</td> 

    <td align=center bgcolor="#ffffff">
<?php echo $LDFrom ?>:
	</td> 

    <td align=center bgcolor="#ffffff" >
<?php echo $LDTo ?>:
	</td> 
    <td bgcolor="#ffffff">
&nbsp;<?php echo $LDExtraInfo ?>:
	</td> 
  </tr>	

<?php if($result[$element]!="") 
{
	//echo $result[$element];
	$dbuf=explode("~",trim($result[$element]));
	//if(!$dbuf[0]) array_splice($dbuf,0,1);
		$entrycount=sizeof($dbuf);
		$elems=array();
		for($i=0;$i<$entrycount;$i++)
		{
			if(trim($dbuf[$i])=="") continue;
			parse_str(trim($dbuf[$i]),$elems);
			echo '
	  		<tr bgcolor="#ffffff">
    			<td   class="v13" >
				&nbsp;<a href="javascript:delete_item(\''.$i.'\')"><img '.createComIcon($root_path,'delete2.gif','0').' alt="'.$LDDeleteEntry.'"></a>
				</td> 
    			<td   class="v13" >
				&nbsp;'.$elems[n].'
				</td> 
    			<td class="v13" >
				&nbsp;'.$title.' '.$elems[x].'
				</td> 
    			<td class="v13" >
				&nbsp;'.$elems[s].'<input type="text" name="ab" size=5 maxlength=5 value="">
				</td> 
    			<td class="v13" >
				&nbsp;'.$elems[e].'<input type="text" name="bis" size=5 maxlength=5 value="">
				</td> 
    			<td class="v13" >
				&nbsp;'.$elem[x].'<input type="text" name="x_info" size=30 maxlength=5 value="">
				</td> 
  				</tr>';
		}
}
 else
 
 {
 echo '
  <tr>'; 
for($i=0;$i<6;$i++)
echo '
    <td align=center bgcolor="#ffffff" align=center  class="v13" >
&nbsp;
	</td> ';
echo'
  </tr>	';
  }
 ?>

  		<tr>
   			 <td  class="v12"  bgcolor="#cfcfcf" colspan=6>&nbsp;
		 </td>

		  </tr>
  		<tr>
   			 <td  class="v12"  bgcolor="#ffffff" colspan=6 align=center>
			<font size=3><b><?php echo str_replace("~tagword~",$title,$LDSearchNewPerson) ?>:</b>	<br>
			 <input type="text" name="inputdata" size=25 maxlength=30><br> <input type="submit" value="OK">
			 </td>

		  </tr>
	 
		  </table>
</td>
  </tr>
</table>

<input type="hidden" name="encoder" value="<?php echo $_COOKIE[$local_user.$sid]; ?>">
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
<input type="hidden" name="entrycount" value="<?php if(!$entrycount) echo "1"; else echo $entrycount; ?>">
<input type="hidden" name="mode" value="save">
<input type="hidden" name="delitem" value="">
</form>
<p>
<?php if($quickexist) : ?>
<form name="quickselect" action="<?php echo $thisfile ?>" method="post">
<table border=0 width=100% bgcolor="#6f6f6f" cellspacing=0 cellpadding=0 >
  <tr>
    <td>
<table border=0 width=100% cellspacing=1>
  <tr>
	<td bgcolor="#cfcfcf" class="v13_n" colspan=4>&nbsp;<font color="#ff0000"><b><?php echo $LDQuickSelectList ?>:</b></td>
  </tr>
 <tr>
    <td align=center bgcolor="#ffffff" class="v13_n" >
<!-- <?php echo $LDLastName ?>
	</td> 
    <td align=center bgcolor="#ffffff" class="v13_n" >
<?php echo $LDName ?> -->

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


<?php 	$counter=0;
		while($qlist=$quicklist->FetchRow())
		{
			echo '
	  		<tr bgcolor="#ffffff">
    			<td class="v13" >
				&nbsp;<a href="javascript:savedata(\''.$qlist[name_last].'\',\''.$qlist[name_first].'\',document.quickselect.f'.$counter.',\''.$qlist[jof_function_title].'\')" title="'.str_replace("~tagword~",$title,$LDUseData).'">'.$qlist[name_last].', '.$qlist[name_first].'</a>
				</td> ';
    			/*<td   class="v13" >
				&nbsp;<a href="javascript:savedata(\''.$quicklist[lastname].'\',\''.$quicklist[firstname].'\',document.quickselect.f'.$counter.',\''.$quicklist[profession].'\')" title="'.str_replace("~tagword~",$title,$LDUseData).'">'.$quicklist[firstname].'</a>
				</td> */
			echo '
    			<td class="v13" >
				&nbsp;'.$qlist['job_function_title'].'
				</td> 
    			<td   class="v13" >
				<select name="f'.$counter.'">';
				if(!$entrycount) $entrycount=1;
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
				&nbsp;<a href="javascript:savedata(\''.$qlist[name_last].'\',\''.$qlist[name_first].'\',document.quickselect.f'.$counter.',\''.$qlist['job_function_title'].'\')"><img '.createComIcon($root_path,'uparrowgrnlrg.gif','0').' align=absmiddle>
				'.str_replace("~tagword~",$title,$LDUseData).'..</a>
				</td> 
    			
  				</tr>';
				$counter++;
		}
?>
		  </table>
</td>
  </tr>
</table>
<input type="hidden" name="encoder" value="<?php echo $_COOKIE[$local_user.$sid]; ?>">
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
<input type="hidden" name="mode" value="save">
<input type="hidden" name="ln" value="">
<input type="hidden" name="fn" value="">
<input type="hidden" name="pr" value="">
<input type="hidden" name="nx" value="">

</form>
<?php endif ?>

<div align=right>
&nbsp;&nbsp;
<a href="javascript:window.close()">
<?php if($mode=='saveok')  { ?>
<img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDClose ?>">
<?php }else{ ?>
<img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?> border="0" alt="<?php echo $LDClose ?>">
<?php } ?>
</a></div>
</BODY>

</HTML>
