<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/

# Default value for the maximum nr of rows per block displayed, define this to the value you wish
# In normal cases this value is derived from the db table "care_config_global" using the "pagin_insurance_list_max_block_rows" element.
define('MAX_BLOCK_ROWS',30); 
# Define to 1 if the search the returns single result should be automatically redirect to user input page
define('REDIRECT_SINGLERESULT',1);

$lang_tables[]='search.php';
define('LANG_FILE','or.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/core/inc_front_chain_lang.php');

# Added intrusion trap
if (!$internok&&!$_COOKIE['ck_op_pflegelogbuch_user'.$sid]) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;};

//$db->debug=true;

# initializations
$thisfile=basename(__FILE__);
$pdata=array();

if(!isset($thisday)||empty($thisday)) $thisday=date('Y-m-d');
list($pyear,$pmonth,$pday)=explode('-',$thisday);

$edit=true; # Set to edit mode
$datafound=FALSE; # The flag for op record
$patientfound=FALSE; # The flag for the patient

$md=$pday;
if(strlen($md)==1) $md='0'.$md;
# Create the encounter object 
require_once($root_path.'include/care_api_classes/class_encounter.php');
$enc_obj=new Encounter;

# Load the date formatter 
require_once($root_path.'include/core/inc_date_format_functions.php');

# Consider search and paginate modes separately
if($mode=='search'||$mode=='paginate'){

		# Initialize page´s control variables
		if($mode=='paginate'){
			$sk=$_SESSION['sess_searchkey'];
			//$searchkey='USE_SESSION_SEARCHKEY';
			//$mode='search';
		}else{
			# Reset paginator variables
			$pgx=0;
			$totalcount=0;
			$odir='ASC';
			$oitem='name_last';
		}
		# Paginator object
		require_once($root_path.'include/care_api_classes/class_paginator.php');
		$pagen=new Paginator($pgx,$thisfile,$_SESSION['sess_searchkey'],$root_path);
		
		$GLOBAL_CONFIG=array();
		require_once($root_path.'include/care_api_classes/class_globalconfig.php');
		$glob_obj=new GlobalConfig($GLOBAL_CONFIG);

		# Get the max nr of rows from global config
		$glob_obj->getConfig('pagin_or_patient_search_max_block_rows');
		if(empty($GLOBAL_CONFIG['pagin_or_patient_search_max_block_rows'])) $pagen->setMaxCount(MAX_BLOCK_ROWS); # Last resort, use the default defined at the start of this page
			else $pagen->setMaxCount($GLOBAL_CONFIG['pagin_or_patient_search_max_block_rows']);
		
		# Save the search keyword for eventual pagination routines
		if($mode=='search'){

			if(empty($gebdatum))
				if(empty($pname))
					if(empty($enc_nr)) ;
					else $sk=$enc_nr;
				else $sk=$pname;
			else $sk=$gebdatum;
			# Save searchkey to sessin for subsequent paginations
			$_SESSION['sess_searchkey']=$sk;
		}
		# Convert other wildcards
		$sk=strtr($sk,'*?','%_');

		$result=&$enc_obj->searchLimitEncounterBasicInfo($sk,$pagen->MaxCount(),$pgx,$oitem,$odir);
		//echo $enc_obj->getLastQuery();
		# Get the resulting record count
		$linecount=$enc_obj->LastRecordCount();
		if($linecount==1&&$mode=='search'&&REDIRECT_SINGLERESULT){
			$pdata=$result->FetchRow();
			header("location:oploginput.php".URL_REDIRECT_APPEND."&mode=get&enc_nr=".$pdata['encounter_nr']."&dept_nr=$dept_nr&saal=$saal&op_nr=$op_nr&pday=$pday&pmonth=$pmonth&pyear=$pyear");
			exit;
		}
		//$linecount=$address_obj->LastRecordCount();
		$pagen->setTotalBlockCount($linecount);
		# Count total available data
		if(isset($totalcount)&&$totalcount){
			$pagen->setTotalDataCount($totalcount);
		}else{
			@$enc_obj->searchEncounterBasicInfo($sk);
			$totalcount=$enc_obj->LastRecordCount();
			$pagen->setTotalDataCount($totalcount);
		}
		$pagen->setSortItem($oitem);
		$pagen->setSortDirection($odir);

}else{
		# Switch any further modes
		switch($mode){
			case 'save':
			{
				$dbtable='care_encounter_op';
				
				# check if entry is already existing
				$sql="SELECT nr,entry_out,cut_close,encoding FROM $dbtable 
						WHERE encounter_nr='$enc_nr' 
							AND op_nr='$op_nr'
							AND dept_nr='$dept_nr'
							AND op_room='$saal'";
							
				if($ergebnis=$db->Execute($sql)){

					$rows=$ergebnis->RecordCount();
					
					if($rows==1){
						 	$item=$ergebnis->FetchRow();
							// $dbuf=htmlspecialchars($dbuf);
							$content=$ergebnis->FetchRow();
							
							$content[encoding].=' ~e='.$encoder.'&d='.date('Y-m-d').'&t='.date('H:i:s');
							
							# create empty item update name
							$updateitem='';
							
							if($entry_time||$content['entry_out']){
								$dbuf=explode('~',$content['entry_out']);
								sort($dbuf,SORT_REGULAR);
								if(trim($entry_time)) $dbuf[0]=strtr('s='.$entry_time.'&e='.$exit_time,':','.');
									else array_splice($dbuf,0,1);
								$content['entry_out']=implode('~',$dbuf);
							}
							if($cut_time||$content['cut_close']){
								$dbuf=explode('~',$content['cut_close']);
								sort($dbuf,SORT_REGULAR);
								if(trim($cut_time)) $dbuf[0]=strtr('s='.$cut_time.'&e='.$close_time,':','.');
									else array_splice($dbuf,0,1);
								$content['cut_close']=implode('~',$dbuf);
							}


							$sql="UPDATE $dbtable 
									SET encoding='".$content['encoding']."'";
							if(!empty($diagnosis)){
								$sql.=",diagnosis=".$enc_obj->ConcatFieldString('diagnosis',htmlspecialchars($diagnosis)."\n");
								$updateitem .= ' diagnosis;';
							}
							$sql.=",anesthesia='$anesthesia',
									entry_out='".$content['entry_out']."',
									cut_close='".$content['cut_close']."'";
							if(!empty($op_therapy)){
								$sql.=",op_therapy=".$enc_obj->ConcatFieldString('op_therapy',htmlspecialchars($op_therapy)."\n");
								$updateitem .=' op_therapy;';
							}
							if(!empty($result_info)){
								$sql.=",result_info=".$enc_obj->ConcatFieldString('result_info',htmlspecialchars($result_info)."\n");
								$updateitem.=' result_info;';
							}
							
							# Append update item names to history
							$sql.= ",history = ".$enc_obj->ConcatHistory("Updated ".$updateitem." ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."\n");

							$sql.="	WHERE nr=".$item['nr']; 
											
							if($ergebnis=$enc_obj->Transact($sql)){
								//echo $sql." new update <br>";
								header("location:$thisfile?sid=$sid&lang=$lang&mode=saveok&enc_nr=$enc_nr&dept_nr=$dept_nr&saal=$saal&thisday=$thisday&op_nr=$op_nr");
								exit;
							}else{
								echo "$sql<br>$LDDbNoSave<br>";
							}
					}else{ //  Else no record yet, create new entry
							# first get the last op number
	  						$dbtable='care_encounter_op';
							
		 					$sql="SELECT op_nr FROM $dbtable WHERE dept_nr='$dept_nr' AND op_room='$saal' ORDER BY op_nr DESC";
							//echo $sql;
							
							if($ergebnis=$db->Execute($sql)){

								if($rows=$ergebnis->RecordCount()){
									$pdata=$ergebnis->FetchRow();
									$op_nr=$pdata['op_nr']+1;
									//echo $sql."<br>";
								}else{
									$op_nr=1;
								}
							}else{
								echo "$LDDbNoRead<br>";
								exit;
							} 
							

							if($entry_time) $eobuf="s=$entry_time&e=$exit_time";
							if($cut_time) $ccbuf="s=$cut_time&e=$close_time";
							
							$sql="INSERT INTO $dbtable
										(
										year,
										dept_nr,
										op_room,
										op_nr,
										op_date,
										op_src_date,
										encounter_nr,
										diagnosis,
										anesthesia,
										op_therapy,
										result_info,
										entry_out,
										cut_close,
										encoding,
										doc_date,
										doc_time,
										history,
										create_id,
										create_time
										)
									 	VALUES
										(
										'$pyear',
										'$dept_nr',
										'$saal',
										'$op_nr',
										'$op_date',
										'".date(Ymd)."',
										'$enc_nr',
										'".htmlspecialchars($diagnosis)."\n',
										'$anesthesia',
										'".htmlspecialchars($op_therapy)."\n',
										'".htmlspecialchars($result_info)."\n',
										'".strtr($eobuf,':','.')."',
										'".strtr($ccbuf,':','.')."',
										'e=".$encoder."&d=".date('Y-m-d')."&t=".date('H:i:s')."',
										'".date('Y-m-d')."',
										'".date('H:i:s')."',
										'Create ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."\n',
										'".$_SESSION['sess_user_name']."',
										'".date('YmdHis')."'
										)";

							if($ergebnis=$enc_obj->Transact($sql)){
								//echo $sql." new insert <br>";
								header("location:$thisfile?sid=$sid&lang=$lang&mode=saveok&enc_nr=$enc_nr&dept_nr=$dept_nr&saal=$saal&thisday=$thisday&op_nr=$op_nr");
							}else{
								echo "$sql<br>$LDDbNoSave<br>";
							} 
					} //end of else
				} // end of if ergebnis
				break;
			} // end of case 'save'
			 
			case 'get':
			{
				if($enc_obj->loadEncounterData($enc_nr)){
					$rows=$enc_obj->record_count;
					$pdata=$enc_obj->encounter;
					$lname=$pdata['name_last'];
					$fname=$pdata['name_first'];
					$bdate=$pdata['date_birth'];
					//$datafound=1;
					$patientfound=TRUE;
					//echo $sql."<br>";
				}
				break;// end of case search
			}
			
			default:
			{
				if(($mode=='saveok')||($mode=='edit')||($mode=='notimereset')){
					if($enc_obj->loadEncounterData($enc_nr)){
						$rows=$enc_obj->record_count;
						$pdata=$enc_obj->encounter;
						$lname=$pdata['name_last'];
						$fname=$pdata['name_first'];
						$bdate=$pdata['date_birth'];
					}
					$dbtable='care_encounter_op';
		 			$sql="SELECT * FROM $dbtable
								WHERE dept_nr='$dept_nr'
								AND op_room='$saal'
								AND encounter_nr='$enc_nr'
								AND op_nr='$op_nr'";

					if($ergebnis=$db->Execute($sql)){
						$rows=$ergebnis->RecordCount();
						if($rows==1){
							$arr=$ergebnis->FetchRow();
							$pdata=array_merge($pdata,$arr);
							$datafound=TRUE;
							$patientfound=TRUE;
							//echo $sql."<br>";
						}else{
							echo "<p>".$sql."<p>Multiple entries found pls notify the edv.";
						}
					}else{
						echo "$LDDbNoRead<br>";
					}
				}
				break;
			}
		} // end of switch mode
}

if(!isset($_SESSION['sess_comdat'])) $_SESSION['sess_comdat'] = "";
# Set the user origin
$_SESSION['sess_user_origin']='op_room';
$_SESSION['sess_comdat']="&enc_nr=".$pdata['encounter_nr']."&dept_nr=$dept_nr&saal=$saal&thisday=$pyear-$pmonth-$pday&op_nr=$op_nr&pyear=$pyear&pmonth=$pmonth&pday=$pday";

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE>OP Pflege Logbuch (Eingabefenster)</TITLE>

<script language="javascript">
<!-- 
function resettimebars()
{
	//window.parent.OPLOGIMGBAR.location.replace('oplogtimebar.php?filename=<?php echo $filename; ?>&rnd=<?php echo $r; ?>');
	window.parent.OPLOGIMGBAR.location.replace('<?php echo "oplogtimebar.php?sid=$sid&lang=$lang&internok=$internok&enc_nr=".$pdata['encounter_nr']."&op_nr=".$pdata['op_nr']."&dept_nr=$dept_nr&saal=$saal&pyear=$pyear&pmonth=$pmonth&pday=$pday";?>');
}

function resettimeframe()
{
	//window.parent.OPLOGINPUT.location.replace('oplogtime.php?filename=<?php echo $filename; ?>&rnd=<?php echo $r; ?>');
	window.parent.OPLOGINPUT.location.replace('<?php echo "oplogtime.php?sid=$sid&lang=$lang&internok=$internok&enc_nr=".$pdata['encounter_nr']."&op_nr=".$pdata['op_nr']."&dept_nr=$dept_nr&saal=$saal&pyear=$pyear&pmonth=$pmonth&pday=$pday";?>');
}

function resetlogdisplays()
{
	window.parent.OPLOGMAIN.location.replace('<?php echo "oplogmain.php?sid=$sid&lang=$lang&internok=$internok&gotoid=".$pdata['op_nr']."&dept_nr=$dept_nr&saal=$saal&thisday=$thisday"; ?>');
}

function cleartimeframes()
{
	window.parent.OPLOGIMGBAR.location.replace('blank.htm');
	window.parent.OPLOGINPUT.location.replace('blank.htm');
}

function resetall()
{
	resetlogdisplays();resettimebars();resettimeframe();
}

function isnum(val,idx)
{
	xdoc=document.oppflegepatinfo;
	if (isNaN(val))
	{
		xval3="";
		for(i=0;i<val.length;i++)
		{
			xval2=val.slice(i,i+1);
			//if (!isNaN(xval3 + xval2)) {xval3=xval3 + xval2;}

			if (isNaN(xval2))
			{
				xdoc.elements[idx].value=xval2;
				setTime(xdoc.elements[idx]);
				return;
			}
		}
		xdoc.elements[idx].value=xval3;

	}
	else
	{
		v3=val;
		if((v3==24)&&(v3.length==2)) v3="00";
		if (v3>24) 
		{

		
			switch(v3.length)
			{
			
				case 2: v1=v3.slice(0,1); v2=v3.slice(1,2);
						if(v2<6) v3="0"+v1+"."+v2; else v3=v3.slice(0,1); break;
				case 3: v1=val.slice(0,2); v2=val.slice(2,3);

						if(v2<6) v3=v1+"."+v2; 
							else v3=v3.slice(0,2);
						break;
				case 4: v3=val.slice(0,3); break;
			}
			
			
//			alert("Zeitangabe ist ungültig! (ausserhalb des 24H Zeitrahmens)");
	
		}
		switch(v3.length)
			{
				
				case 2: v1=v3.slice(0,1);v2=v3.slice(1,2);
						if(v2==".") v3="0"+v3;break;
		
				case 3: v1=v3.slice(0,2);v2=v3.slice(2,3);
						if(v2!=".") if(v2<6) v3=v1+"."+v2; else v3=v1; break;
				case 4: if(v3.slice(3,4)>5) v3=v3.slice(0,3); break;
			}
		if(v3.length>5) v3=v3.slice(0,v3.length-1);
		xdoc.elements[idx].value=v3;
	}
	
}
	
function isvalnum(val,idx)
{
	xdoc=document.oppflegepatinfo;

		xval3="";
		for(i=0;i<val.length;i++)
		{
		xval2=val.slice(i,i+1);
		if (!isNaN(xval2))
			{
				xval3=xval3 + xval2;
				/*
				if (xval3.length>8) 
				{ 
				alert("Die Aufnahmenummer hat maximal 8 Ziffern!"); 
				xdoc.elements[idx].value=xval3.slice(0,8);
				return; }
				*/
			}
		}
		xdoc.elements[idx].value=xval3;
}

function isgdatum(val,idx)
{
	xdoc=document.oppflegepatinfo;

		xval3="";
		for(i=0;i<val.length;i++)
		{
		xval2=val.slice(i,i+1);
		if ((!isNaN(xval2))||(xval2=="."))
			{
				if(xval2==".")
				{
				 if(val.length>1) xval3=xval3+xval2;
				}
				else 
				{
					 xval3=xval3+xval2;					
				}
			}
		}
		switch (xval3.length)
		{
			case 2: v1=xval3.slice(0,1);
					v2=xval3.slice(1,2);
					if(v2==".")
					{
						if (v1==0) xval3=""; else xval3="0"+xval3;
					}
					else {
					if ((v1+v2)<1) xval3=""; 
						else if ((v1+v2)>31) xval3="0"+v1+"."+v2; 
							
					}
					 break;
			case 3: v1=xval3.slice(0,2);
					v2=xval3.slice(2,3);
					if (v2!=".") xval3=v1+"."+v2; 
					break;
			case 4: v1=xval3.slice(0,3);
					v2=xval3.slice(3,4);
					if (v2!=".") xval3=v1+v2; else xval3=v1;
					break;
			case 5: v1=xval3.slice(0,3);
					v2=xval3.slice(3,4);
					v3=xval3.slice(4,5);
					if (v3==".")
					{
						if (v2==0) xval3=v1+v2; 
							else xval3=v1+"0"+v2+v3;
					}
					else if((v2+v3)<1) xval3=v1+v2;
						else if((v2+v3)>12) xval3=v1+"0"+v2+"."+v3;
					break;
			case 6: v1=xval3.slice(0,5);
					v2=xval3.slice(5,6);
					if (v3!=".")
					{
						if (v2==0) xval3=v1 
							else xval3=v1+"."+v2;
					}
					break;
		}
 	if ((xval3.length>6)&&(xval3.slice(xval3.length-1,xval3.length)=="."))xval3=xval3.slice(0,xval3.length-1);
	if (xval3.length>10) xval3=xval3.slice(0,10);
	xdoc.elements[idx].value=xval3;

}

function checksubmit()
{
	
	xdoc=document.oppflegepatinfo;
	if ((xdoc.pname.value=="")&&(xdoc.gebdatum.value=="")&&(xdoc.enc_nr.value==""))
	{
		xdoc.enc_nr.focus();
	}
	else
	{	
	xdoc.submit();
	}
	return false;
}

function searchpat()
{
	d=document.oppflegepatinfo;
	window.location.href="<?php echo "$thisfile?sid=$sid&mode=search&enc_nr=" ?>"+d.enc_nr.value+"&pname="+d.pname.value+"&gebdatum="+d.gebdatum.value;

}

function getinfo(m)
{
	urlholder="<?php echo "op-pflege-log-getinfo.php?sid=$sid&lang=$lang&dept_nr=$dept_nr&saal=$saal&op_nr=$op_nr&enc_nr=$enc_nr&pday=$pday&pmonth=$pmonth&pyear=$pyear&winid=";?>"+m;
	getinfowin=window.open(urlholder,"getinfo","width=800,height=500,menubar=no,resizable=yes,scrollbars=yes");
}
function openfolder(pid,pdata){
	urlholder="<?php echo $root_path; ?>modules/nursing/nursing-station-patientdaten.php<?php echo URL_REDIRECT_APPEND; ?>&pn="+pid+"&patient=" + pdata + "&dept_nr=<?php echo "$dept_nr&pday=$pday&pmonth=$pmonth&pyear=$pyear&op_shortcut=".$_COOKIE['ck_op_pflegelogbuch_user'.$sid]; ?>";
	patientwin=window.open(urlholder,pid,"width=700,height=450,menubar=no,resizable=yes,scrollbars=yes");
	}

function openDRGComposite()
{
<?php if($cfg['dhtml'])
	echo '
			w=window.parent.screen.width;
			h=window.parent.screen.height;';
	else
	echo '
			w=800;
			h=650;';
?>
	
	drgcomp_<?php echo $pdata[encounter_nr]."_".$op_nr."_".$dept_nr."_".$saal ?>=window.open("<?php echo $root_path ?>modules/drg/drg-composite-start.php?sid=<?php echo "$sid&lang=$lang&display=composite&pn=".$pdata['encounter_nr']."&edit=$edit&ln=$lname&fn=$fname&bd=$bdate&opnr=$op_nr&dept_nr=$dept_nr&oprm=$saal"; ?>","drgcomp_<?php echo $pdata['encounter_nr']."_".$op_nr."_".$dept_nr."_".$saal ?>","menubar=no,resizable=yes,scrollbars=yes, width=" + (w-15) + ", height=" + (h-60));
	window.drgcomp_<?php echo $pdata[encounter_nr]."_".$op_nr."_".$dept_nr."_".$saal ?>.moveTo(0,0);
}
//-->
</script>

<script language="javascript" src="<?php echo $root_path; ?>js/showhide-div.js"></script>
<script language="javascript" src="<?php echo $root_path; ?>js/setdatetime.js"></script>
<style type="text/css">
.v10_n{font-family:verdana;font-size:10;color=#0000cc;}
</style>
<?php
require($root_path.'include/core/inc_js_gethelp.php');
require($root_path.'include/core/inc_css_a_hilitebu.php');
?>
</HEAD>

<BODY bgcolor="#cde1ec" topmargin=0 leftmargin=0 marginwidth=0 onLoad="
<?php 
switch($mode)
{
	case 'saveok': echo 'resetall();';
						//echo 'resettimebars();resettimeframe();reseteditmain();';
						break;
	//case 'save': echo 'resetall();';break;
	case "fresh": echo 'resetlogdisplays();cleartimeframes();';break;
	case "chgdept": break;
	case "notimereset": break;
	case 'search': break;
	case 'edit': echo 'resettimebars();resettimeframe();'; break;
	default: echo 'resetlogdisplays();';
}
if(!$patientfound) echo 'document.oppflegepatinfo.enc_nr.focus();';
?>
"  marginheight="0" bgcolor="silver" alink="#0000ff" vlink="#0000ff" link="#0000ff" >

<FORM METHOD="post" ACTION="oploginput.php?mode=save" name="oppflegepatinfo" onSubmit="return checksubmit()">

<TABLE  CELLPADDING=0 CELLSPACING=0 border=0 width=100%>
<TR class="wardlisttitlerow">
<TD>

<font size=1>
<?php if($op_nr) : ?>
	<?php echo $LDOpNr ?> <FONT SIZE="3" ><b> <?php echo $op_nr; ?> </b></FONT>
<?php endif ?>

<?php echo $LDDate ?>: 

<?php
	echo formatDate2Local($thisday,$date_format);
?>

&nbsp;
<?php
if($datafound||$patientfound){
?>

<a href="javascript:document.oppflegepatinfo.submit()"><img <?php echo createLDImgSrc($root_path,'savedisc.gif','0') ?> width=99 height=24 align=absmiddle alt="<?php echo $LDSaveLatest ?>"></a>
<?php
}
?>
</TD>

<td align=right>
<?php 
if($op_nr) { 
?>

<?php } ?>
<?php 
if($datafound) { 
?>
<A onClick="document.oppflegepatinfo.xx2.value='drg'"
    href="javascript:openDRGComposite()"><img <?php echo createLDImgSrc($root_path,'drg.gif','0','absmiddle') ?> 
	alt="<?php echo $LDDRG ?>"></a><A onClick="document.oppflegepatinfo.xx2.value='material'"
    href="op-logbuch-material-parentframe.php?sid=<?php echo "$sid&lang=$lang&op_nr=$op_nr&enc_nr=".$pdata['encounter_nr']."&dept_nr=$dept_nr&saal=$saal&pday=$pday&pmonth=$pmonth&pyear=$pyear"; ?>" target="OPLOGMAIN"><img <?php echo createLDImgSrc($root_path,'material.gif','0','absmiddle') ?> 
	alt="<?php echo $LDUsedMaterial ?>"></a><!-- <A onClick="document.oppflegepatinfo.xx2.value='container'"
    href="op-logbuch-material-parentframe.php?sid=<?php echo "$sid&lang=$lang&mode=cont&op_nr=$op_nr&enc_nr=".$pdata['encounter_nr']."&dept_nr=$dept_nr&saal=$saal&pday=$pday&pmonth=$pmonth&pyear=$pyear"; ?>" target="OPLOGMAIN"><img <?php echo createLDImgSrc($root_path,'instrument.gif','0','absmiddle') ?> 
	alt="<?php echo $LDContainer ?>"></a>--><?php } ?> <a href="javascript:gethelp('oplog.php','create','<?php echo $mode ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0','absmiddle') ?>
	alt="<?php echo $LDHelp ?>"></a><a href="javascript:if(!window.parent.opener.closed)window.parent.opener.focus();window.parent.close();"><img <?php echo createLDImgSrc($root_path,'close2.gif','0','absmiddle') ?> 
	alt="<?php echo $LDClose ?>"></a><br>
</td>
</TR>

<tr class="wardlisttitlerow">
<td colspan=2 align=right>
<?php 
if($datafound) { 
?>
<A href="oplogmain.php?sid=<?php echo "$sid&lang=$lang&op_nr=$op_nr&enc_nr=".$pdata['encounter_nr']."&dept_nr=$dept_nr&saal=$saal&thisday=$thisday"; ?>" 
	target="OPLOGMAIN"><img <?php echo createLDImgSrc($root_path,'showlogbook.gif','0','absmiddle') ?>
	alt="<?php echo $LDClk2DropMenu ?>"></a><?php 
}
?><a 
	href="oploginput.php?sid=<?php echo "$sid&lang=$lang&dept_nr=$dept_nr&saal=$saal" ?>&mode=fresh"><img <?php echo createLDImgSrc($root_path,'newpat2.gif','0','absmiddle') ?> 
	alt="<?php echo $LDStartNewDocu ?>"></a><A href="op-pflege-logbuch-xtsuch-start.php?sid=<?php echo "$sid&lang=$lang&internok=$internok&dept_nr=$dept_nr&saal=$saal"; ?>&user=<?php echo str_replace(' ','+',$op_pflegelogbuch_user); ?>" target="_parent"><img <?php echo createLDImgSrc($root_path,'searchlamp.gif','0','absmiddle') ?> 
	alt="<?php echo $LDSearchPatient ?>"></a><A href="op-pflege-logbuch-arch-start.php?sid=<?php echo "$sid&lang=$lang&internok=$internok&dept_nr=$dept_nr&saal=$saal"; ?>&user=<?php echo str_replace(' ','+',$op_pflegelogbuch_user); ?>"  
	target="_parent"><img <?php echo createLDImgSrc($root_path,'archive.gif','0','absmiddle') ?> 
	alt="<?php echo $LDArchive ?>"></a><br>

</td>
</tr>


</TABLE>

<?php
if(($mode=='search'||$mode=='paginate')&&!$datafound){
	
	echo '<center>'; 

	if($linecount){
	
	$append="&dept_nr=$dept_nr&saal=$saal&op_nr=$op_nr&pday=$pday&pmonth=$pmonth&pyear=$pyear";

	# Preload  common icon images
	$img_male=createComIcon($root_path,'spm.gif','0');
	$img_female=createComIcon($root_path,'spf.gif','0');
	$bgimg='tableHeaderbg3.gif';
	$tbg= 'background="'.$root_path.'gui/img/common/'.$theme_com_icon.'/'.$bgimg.'"';

	if ($linecount) echo str_replace("~nr~",$totalcount,$LDSearchFound).' '.$LDShowing.' '.$pagen->BlockStartNr().' '.$LDTo.' '.$pagen->BlockEndNr().'.';
		else echo str_replace('~nr~','0',$LDSearchFound); 
	echo ' <font  class="prompt">'.$LDPlsClk1.'</font><br>';

?>

			
				<table cellpadding=0 cellspacing=0 border=0>
				<tr>
				<td>	
			<img <?php echo createMascot($root_path,'mascot1_r.gif','0','bottom') ?>>
			</td>
				<td valign=top>
				<table cellpadding=1 cellspacing=0 border=0 class="frame">
				
				<tr>
				<td>
				<table cellpadding=2 cellspacing=0 border=0 class="submenu">

				<tr class="wardlisttitlerow">

    			 <td><b>
	  			<?php echo $pagen->makeSortLink($LDPatientNr,'encounter_nr',$oitem,$odir,$append);  ?></b></td>
      			<td><b>
	  			<?php echo $pagen->makeSortLink($LDSex,'sex',$oitem,$odir,$append);  ?></b></td>
      			<td><b>
	  			<?php echo $pagen->makeSortLink($LDLastName,'name_last',$oitem,$odir,$append);  ?></b></td>
      			<td><b>
	  			<?php echo $pagen->makeSortLink($LDName,'name_first',$oitem,$odir,$append);  ?></b></td>
      			<td><b>
	  			<?php echo $pagen->makeSortLink($LDBday,'date_birth',$oitem,$odir,$append);  ?></b></td>
				</tr>
				
				
				
<?php	

   		while($pdata=$result->FetchRow()){
			$ahref="<a href=\"oploginput.php".URL_APPEND."&mode=get&enc_nr=".$pdata['encounter_nr']."&dept_nr=$dept_nr&saal=$saal&op_nr=$op_nr&pday=$pday&pmonth=$pmonth&pyear=$pyear\">";
			
			echo '<tr ><td><FONT  SIZE=2>'.$ahref;
			if($sk&&stristr($pdata['encounter_nr'],$sk)) echo '<u><b><span style="background:yellow"> '.$pdata['encounter_nr'].'</span></b></u>';
 					else echo $pdata['encounter_nr'];
			echo '</a></td><td>';
			echo $ahref;
			switch($pdata['sex']){
					case 'f': echo '<img '.$img_female.'>'; break;
					case 'm': echo '<img '.$img_male.'>'; break;
					default: echo '&nbsp;'; break;
			}	
				
			echo '</a></td><td><FONT  SIZE=2>'.$ahref;
				if($sk&&stristr($pdata['name_last'],$sk)) echo '<u><b><span style="background:yellow"> '.$pdata['name_last'].'</span></b></u>';
 					else echo $pdata['name_last'];				
			echo '</a></td><td><FONT  SIZE=2>'.$ahref;
				if($sk&&stristr($pdata['name_first'],$sk)) echo '<u><b><span style="background:yellow"> '.$pdata['name_first'].'</span></b></u>';
 					else echo $pdata['name_first'];				
			echo '</a></td><td><FONT  SIZE=2>';
				if($sk&&stristr($pdata['date_birth'],$sk)) echo '<u><b><span style="background:yellow"> '.formatDate2Local($pdata['date_birth'],$date_format).'</span></b></u>';
 					else echo formatDate2Local($pdata['date_birth'],$date_format);				
 				echo '</td></tr> ';
		}	
			echo '
						<tr><td colspan=4><font size=2>'.$pagen->makePrevLink($LDPrevious,$append).'</td>
						<td align=right><font size=2>'.$pagen->makeNextLink($LDNext,$append).'</td>
						</tr>';
	}else{
		echo '
			<font color="#800000" size=4>'.$LDPatientNotFound.'</font>
			<font size=2 ><br>'.$LDPlsEnoughData;
	}
	echo '	
				</table>
				</td>
				</tr>
				</table>
				</td>
			
			</tr>
			</table>
			</center>
			';
}
?>

<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="internok" value="<?php echo $internok; ?>">
<input type="hidden" name="encoder" value="<?php echo $_COOKIE['ck_op_pflegelogbuch_user'.$sid]; ?>">
<input type="hidden" name="op_nr" value="<?php echo $op_nr; ?>">
<input type="hidden" name="thisday"  value="<?php echo $thisday; ?>">
<input type="hidden" name="op_date"  value="<?php echo $thisday; ?>">
<input type="hidden" name="dept_nr" value="<?php echo $dept_nr; ?>">
<input type="hidden" name="saal" value="<?php echo $saal; ?>">
<input type="hidden" name="xx2" value="">

<table border=0 bgcolor="#9c9c9c" cellpadding=0 cellspacing=0>
  <tr>
    <td>

<TABLE  CELLPADDING=1 CELLSPACING=1 border=0 class="v10_n">
<tr bgcolor="#fefefe" height=180>
	<TD valign="top" width=150><font  size=1>

<?php
if($pdata['encounter_nr']=='')
 	{
	 echo $LDPatientNr.': <br>
		<INPUT NAME="enc_nr" TYPE="text" VALUE="" onKeyUp="isvalnum(this.value,this.name)" SIZE="9" ><br>
		'.$LDLastName.', '.$LDName.'<br>
		<INPUT NAME="pname" TYPE="text" VALUE="" SIZE="20"><BR>
		'.$LDBday.'<br>
		<INPUT NAME="gebdatum" TYPE="text" VALUE="" SIZE="20" onKeyUp="isgdatum(this.value,this.name)"><p>
		<center><input type="submit" value="'.$LDSearchPatient.'"></center>
		<input type="hidden" name="mode" value="search">
		';
	}
	else
	{ echo '
		<a href="javascript:openfolder(\''.$pdata['encounter_nr'].'\')">
		<img '.createComIcon($root_path,'info2.gif','0').' alt="'.str_replace("~tagword~",$lname,$LDOpenPatientFolder).'"></a>
		<font color="#000000" size=2>';
		//echo ($pdata['encounter_class_nr']==1)?($pdata['encounter_nr']+$GLOBAL_CONFIG['patient_inpatient_nr_adder']) : ($pdata['encounter_nr']+$GLOBAL_CONFIG['patient_outpatient_nr_adder']);
		echo $pdata['encounter_nr'];
		echo '</font><br>
		<font  size=2>'.strtr($lname,"+"," ").', '.strtr($fname,"+"," ").'</font><br>
		<font color="#000000" >'.formatDate2Local($bdate,$date_format).'</font><p>
		<font color="#000000">'.$pdata['addr_str'].' '.$pdata['addr_str_nr'].'<br>'.$pdata['addr_zip'].' '.$pdata['citytown_name'].'</font>
		<input type="hidden" name="enc_nr" value="'.$pdata['encounter_nr'].'">
		<input type="hidden" name="mode" value="save">';
	}
?> 
	</TD>

<TD valign="top" width=130><font  size=1  color="<?php if($datafound) echo "#0000cc"; else echo "#3f3f3f"; ?>">

<?php 
if($datafound){
	 echo '<a href="'.$root_path.'modules/drg/drg-icd10.php?sid='.$sid.'&lang='.$lang;
	 echo "&pn=".$pdata['encounter_nr']."&ln=$lname&fn=$fname&bd=$bdate&opnr=$op_nr&dept_nr=$dept_nr&oprm=$saal";
	 echo '" target="OPLOGMAIN">'.$LDDiagnosis.':</a><br>
	<textarea name="diagnosis" cols=16 rows=8 wrap="physical" ></textarea>';
}else{
	echo $LDDiagnosis;
}
?>
</TD>

<TD valign=top width=140 >
<?php 
if($datafound) 
{
	echo'
	<font  size=1 color="#000000">';

	$ebuf=array("operator","assistant","scrub_nurse","rotating_nurse");
	$jbuf=array("operator","assist","scrub","rotating");
	$tbuf=array("O","A","I","S");
	//$cbuf=array("Operateur","Assistent","Instrumenteur","Springer");
	for($n=0;$n<sizeof($ebuf);$n++)
	{
		echo '<a href="javascript:getinfo(\''.$jbuf[$n].'\')">'.$cbuf[$n].'</a><br>';
		if(!$pdata[$ebuf[$n]])
		{ echo "<br>"; continue;}
		$dbuf=explode("~",$pdata[$ebuf[$n]]);
		for($i=0;$i<sizeof($dbuf);$i++)
		{
			parse_str(trim($dbuf[$i]),$elems);
			if($elems[n]=='') continue;
			else echo '&nbsp;'.$elems[n]." ".$tbuf[$n].$elems[x]."<br>";
		}
	}	
}
 else
 {
	echo '
	<font  size=1 color="#3f3f3f">';
		while(list($x,$v)=each($cbuf)) echo "$v<p>";
}
?>

</TD>

<TD valign=top width=150>
<font  size=1  color="<?php if($datafound) echo "#0000cc"; else echo "#3f3f3f"; ?>">
<?php if($datafound) : ?>
<?php echo $LDAna ?><br>
	<select NAME="anesthesia"   SIZE="1">
	<?php
	
	/* Print anesthesia types */
	
	 while(list($x,$v)=each($LDAnaTypes))
	 {
		 echo '
		<option value="'.$x.'"';
		
		if($pdata['anesthesia']==$x) echo ' selected';
		
		echo '>'.$v.'</option>';
	 }
	?>
	</select>
	

<BR>
	<a href="javascript:getinfo('ana')"><?php echo $LDAnaDoc ?></a><br>
	<?php
	
	/* Print anesthesia doctor */
		if($pdata['an_doctor'])
		{ 
			echo '<font color="#000000">';
			$dbuf=explode('~',$pdata['an_doctor']);
			for($i=0;$i<sizeof($dbuf);$i++)
			{
				parse_str(trim($dbuf[$i]),$elems);
				if($elems['n']=='') continue;
				else echo '&nbsp;'.$elems['n'].' N'.$elems['x'].'<br>';
			}
			echo '</font>';
		}
	?>
<?php else : ?>
	<?php echo "$LDAna<p>$LDAnaDoc" ?>
<?php endif ?>

	<p>

<table cellpadding="0" cellspacing="0" border=0 width=100% class="v10_n"> 
<tr>
<td>
<?php
/*
	$eo=explode("~",$pdata['entry_out']);
	parse_str($eo[0],$eobuf);

	 $cc=explode("~",$pdata['cut_close']);
	parse_str($cc[0],$ccbuf);
*/
	$eo=explode("~",$pdata['entry_out']);
	for($i=0;$i<sizeof($eo);$i++)
	{
		parse_str($eo[$i],$eobuf);
		if(trim($eobuf['s'])) break;
	}
	 
	 $cc=explode("~",$pdata['cut_close']);
	for($i=0;$i<sizeof($cc);$i++)
	{
		parse_str($cc[$i],$ccbuf);
		if(trim($ccbuf['s'])) break;
	}
?>

<font  size=1 color="<?php if($datafound) echo "#0000cc"; else echo "#3f3f3f"; ?>">
	<?php echo $LDOpCut ?>:
	<?php if($datafound) : ?>
	<br><INPUT NAME="cut_time" TYPE="text" VALUE="<?php echo strtr($ccbuf['s'],':','.'); ?>" SIZE="6" onKeyUp="isnum(this.value,this.name)">
	<?php else : ?>
	<p>
	<?php endif ?>
	<BR>
	<?php echo $LDOpClose ?>:
	<?php if($datafound) : ?>
	<br><INPUT NAME="close_time" TYPE="text" VALUE="<?php echo strtr($ccbuf['e'],':','.'); ?>" SIZE="6" onKeyUp="isnum(this.value,this.name)">
	<?php endif ?>
</td>
<td><font  size=1 color="<?php if($datafound) echo "#0000cc"; else echo "#3f3f3f"; ?>">
	<?php echo $LDOpInFull ?>:
	<?php if($datafound) : ?>
	<br><INPUT NAME="entry_time" TYPE="text" VALUE="<?php echo strtr($eobuf['s'],':','.'); ?>" SIZE="6" onKeyUp="isnum(this.value,this.name)">
	<?php else : ?>
	<p>
	<?php endif ?>
	<BR>
	<?php echo $LDOpOutFull ?>:
	<?php if($datafound) : ?>
	<br><INPUT NAME="exit_time" TYPE="text" VALUE="<?php echo strtr($eobuf['e'],':','.'); ?>" SIZE="6" onKeyUp="isnum(this.value,this.name)">
	<?php endif ?>
</td>
</tr>
</table>



</TD>


<TD valign="top" width=160><font  size=1 
color="<?php if($datafound) echo "#0000cc"; else echo "#3f3f3f"; ?>">
<?php if($datafound) 
	{
	 echo '<a href="'.$root_path.'modules/drg/drg-ops301.php?sid='.$sid.'&lang='.$lang;
	 echo "&pn=".$pdata['encounter_nr']."&ln=$lname&fn=$fname&bd=$bdate&opnr=$op_nr&dept_nr=$dept_nr&oprm=$saal";
	echo '" target="OPLOGMAIN">'.$LDTherapy.'/'.$LDOperation.'</a><br>
	<TEXTAREA NAME="op_therapy" COLS="18" ROWS="8"></TEXTAREA>';
	}
	else echo $LDTherapy.'/'.$LDOperation;
?>
</TD>

<TD valign="top" width=140><font  size=1 color="<?php if($datafound) echo "#0000cc"; else echo "#3f3f3f"; ?>"><?php echo $LDOpMainElements[result] ?><br>
<?php if($datafound) echo '
<TEXTAREA NAME="result_info" Content-Type="text/html"
	COLS="18" ROWS="8"></TEXTAREA>';
?>
</TD>

</TR>
</TABLE>
</td>
  </tr>
</table>
</FORM>
</BODY>
</HTML>
