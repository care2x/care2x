<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','or.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/core/inc_front_chain_lang.php');

/* Check the date values */
if(!isset($pyear)||empty($pyear)) $pyear=date('Y');
if(!isset($pmonth)||empty($pmonth)) $pmonth=date('m');
if(!isset($pday)||empty($pday)) $pday=date('d');

$opabt=get_meta_tags('../global_conf/'.$lang.'/op_tag_dept.pid');

$dbtable='care_standby_duty_report';

$thisfile='spediens-bdienst-zeit-erfassung.php';
if($retpath=='spec') $breakfile="spediens.php".URL_APPEND;
 else $breakfile="op-doku.php".URL_APPEND;

/********************************* Resolve the department and op room ***********************/
	    /* Load date formatter */
        include_once($root_path.'include/core/inc_date_format_functions.php');
        
		
		if($mode=='save')
		{
				
				$history_txt=$encoder." ".date('Y-m-d H:i:s')."\n\r";

					//echo $sql." checked <br>";
				for($i=0;$i<$maxelement;$i++)
				{
					$tg='tag'.$i;
					if($$tg)
					{
						$dt='date'.$i;
						$an='standby_name'.$i;
						$av='standby_start'.$i;
						$ab='standby_end'.$i;
						$rn='oncall_name'.$i;
						$rv='oncall_start'.$i;
						$rb='oncall_end'.$i;
						$op='op_room'.$i;
						$dg='diagnosis'.$i;
						$td='report_nr'.$i;
						$en='encoding'.$i;
						$hist='history'.$i;
						
						if($$td)
							{

							// $dbuf=htmlspecialchars($dbuf);
								$sql="UPDATE $dbtable 
										SET standby_name='".$$an."',
											  standby_start='".convertTimeToStandard($$av)."',
										      standby_end='".convertTimeToStandard($$ab)."',
    						                  oncall_name='".$$rn."',
										      oncall_start='".convertTimeToStandard($$rv)."',
										      oncall_end='".convertTimeToStandard($$rb)."',
										      op_room='".$$op."',
										      diagnosis_therapy='".htmlspecialchars($$dg)."',
											  encoding='".$$en." ~e=$encoder&a=$a_enc&r=$r_enc&d=".date('Y-m-d')."&t=".date('H:i:s')."',
											  history='".$$hist."Updated: ".$history_txt."'
										WHERE report_nr='".$$td."'";
											
								if($ergebnis=$db->Execute($sql))
       							{
									//echo $sql." new update <br>";
									//
									//header("location:$thisfile?sid=$sid&saved=1&dept=$dept&pmonth=$pmonth&pyear=$pyear");
								}
								else
								{
									echo "$sql <p>";
									exit;
								}//end of else
							}// end of if rows
							else
							{
							 if($$dt&&($$an||$$rn)&&$$op&&$$dg)
							  {
							  
							  	list($id,$im,$iy)=explode(".",$$dt);
								if(strlen($id)<2) $id="0".$id;
								if(strlen($im)<2) $im="0".$im;
								
							 	$sql="INSERT INTO $dbtable 
									(
										dept,
										date,
										standby_name,
										standby_start,
										standby_end,
										oncall_name,
										oncall_start,
										oncall_end,
										op_room,
										diagnosis_therapy,
										encoding,
										status,
										history,
										modify_id,
										create_id,
										create_time
									) 
									VALUES 
									( 
										'".$dept."',
										'".formatDate2STD($$dt,$date_format)."',
										'".$$an."',
										'".convertTimeToStandard($$av)."',
										'".convertTimeToStandard($$ab)."',
										'".$$rn."',
										'".convertTimeToStandard($$rv)."',
										'".convertTimeToStandard($$rb)."',
										'".$$op."',
										'".htmlspecialchars($$dg)."',
										'e=$encoder&a=$a_enc&r=$r_enc&d=".date('Y-m-d')."&t=".date('H:i:s')."',
										'pending',
										'Created: ".$history_txt."',
										'".$_COOKIE[$local_user.$sid]."',
										'".$_COOKIE[$local_user.$sid]."',
										NULL
									)";

									if(!$ergebnis=$db->Execute($sql))  echo "<p>".$sql."<p>$LDDbNoSave"; 
								 } // end of if
							}// end of else	
					  } // end of if $$tg
				}// end of for
			header("location:$thisfile?sid=$sid&lang=$lang&saved=1&dept=$dept&pmonth=$pmonth&pyear=$pyear&pday=$pday&retpath=$retpath");
		 }// end of if(mode==save)
		 else
		 {
			$sql="SELECT * FROM $dbtable WHERE  date='$pyear-$pmonth-$pday'";
			if(date('Hi')<830) // if time is early morning recover the data of yesterday
			{
				if ($pday==1)
				{
 					if ($pmonth==1)
					{
						$tm=12;
						$td=31;
						$ty=$pyear-1;
    				}
 					else
					{
	 					$tm=$pmonth-1;
						$td=31;
						while (!checkdate($tm,$td,$pyear)) $td--;
					}
				}
				else 
				{
						$td=$pday-1; $tm=$pmonth; $ty=$pyear;
				}
				$sql.=" OR  date='$ty-$tm-$td'   ORDER BY date";
			}
			//echo $sql."<br>file found!";
			if($ergebnis=$db->Execute($sql))
       		{
				$rows=0; 
				while( $result=$ergebnis->FetchRow())
				{
					if($result) $content[]=$result;
					 $rows++;
				}
				if($rows)
				{
					mysql_data_seek($ergebnis,0);
					//echo $sql."<br>file found!";
				}
			}
				else echo "<p>".$sql."<p>$LDDbNoRead"; 
	 	}// end of else

# Start the smarty templating
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('nursing');

# Added for the common header top block

 $smarty->assign('sToolbarTitle',"$LDOnCallDuty ".$opabt['$dept']);

 $smarty->assign('pbHelp',"javascript:gethelp('op_duty.php','dutydoc','$rows')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',"$LDOnCallDuty ".$opabt['$dept']);

# Buffer page output

ob_start();
?>

<script language="javascript">
<!--
	var newdataflag=0;
	var speichern=0;
	
function winreset(){ newdataflag=0;}

function newdata(d)
{ 
newdataflag=1; 
eval("document.reportform.tag"+d+".value=1");
}

<?php
switch($retpath)
{
	case "op": $rettarget="op-doku.php?sid=$sid"; break;
	case "spec": $rettarget="spediens.php?sid=$sid"; break;
	default: $rettarget="op-doku.php?sid=$sid"; break;
}
?>

function closeifok()
{ 
	if (newdataflag==0)
	{ window.location.href="<?php echo $breakfile ?>";} 
	else
	{
		 if(confirm("<?php echo $LDAlertNotSavedYet ?>"))	{ window.document.reportform.submit();}
	}
}

	function timecheck() {
		var jetzt=new Date()
		var stunden=jetzt.getHours()
		var minuten=jetzt.getMinutes()
		if (minuten<10) { minuten="0" + minuten }
		return stunden + ":" + minuten;
		}

function isnum(val,idx)
{
	xdoc=document.reportform;
	if (isNaN(val))
	{
		xval3="";
		for(i=0;i<val.length;i++)
		{
		xval2=val.slice(i,i+1);
		//if (!isNaN(xval3 + xval2)) {xval3=xval3 + xval2;}
		
		/* If input is not numeric envoke the auto-date-entry function */
		if (isNaN(xval2))
		 {
			xdoc.elements[idx].value=xval2;
			setTime(xdoc.elements[idx],'<?php echo $lang ?>');
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
	

function isgdatum(val,idx)
{
		xdoc=document.reportform;
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
			else
			{
			xdoc.elements[idx].value=xval2;
			setDate(xdoc.elements[idx]);
			return;
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

<?php require($root_path.'include/core/inc_checkdate_lang.php'); ?>

//-->
</script>

<?php

$sTemp = ob_get_contents();
ob_end_clean();

$smarty->append('JavaScript',$sTemp);

# Buffer page output
ob_start();

?>

<form name="reportform" method="post" action="<?php echo $thisfile ?>">

<table width=100% border=0 cellspacing="0" cellpadding=3>

<tr class="wardlisttitlerow">

<?php 

for ($i=0;$i<sizeof($LDDutyElements);$i++){
	echo '<td>&nbsp;'.$LDDutyElements[$i].'</td>';
};
?>
</tr>

<?php
$entries=sizeof($content)+2; $toggle=0;
//gjergji : new calendar
require_once ('../js/jscalendar/calendar.php');
$calendar = new DHTML_Calendar('../js/jscalendar/', $lang, 'calendar-system', true);
$calendar->load_files();
//end : gjergji
for ($i=0;$i<$entries;$i++)
{
echo '
<tr ';
if($toggle){ echo 'class="wardlistrow2"';}else { echo 'class="wardlistrow1"'; }
$toggle=!$toggle;
echo '>
<td rowspan=2 valign=top>';
	
//gjergji : new calendar
echo $calendar->show_calendar($calendar,$date_format,'date'.$i,$content[$i]['date']);	
//end : gjergji

echo '
</td>
<td>
	<FONT color=#ff0000>
	<b>'.$LDStandbyInit.'</b>
	</FONT>
</td>
<td valign=top>
	<input type=text name="standby_name'.$i.'" value="'.$content[$i]['standby_name'].'" size=20 width=20 onKeyUp=newdata(\''.$i.'\') >
</td>
<td valign=top>
	<input type=text name="standby_start'.$i.'" value="'.convertTimeToLocal($content[$i]['standby_start']).'" size=5 maxlength=5 onKeyUp="isnum(this.value,this.name);newdata(\''.$i.'\');">
</td>
<td valign=top>
	<input type=text name="standby_end'.$i.'" value="'.convertTimeToLocal($content[$i]['standby_end']).'" size=5 maxlength=5  onKeyUp="isnum(this.value,this.name);newdata(\''.$i.'\');">
</td>
<td rowspan=2 valign=top>
	<input type=text name="op_room'.$i.'" size=3 value="';
	
if($content[$i]['op_room']) echo $content[$i]['op_room']; else echo $saal;

echo '" onKeyUp=newdata(\''.$i.'\')>

</td>
<td  rowspan="2">
	<textarea  name="diagnosis'.$i.'" cols="30" rows="2" onKeyUp=newdata(\''.$i.'\')>'.$content[$i]['diagnosis_therapy'].'</textarea>
</td>
</tr>

<tr ';
if($toggle){ echo 'class="wardlistrow1"';}else { echo 'class="wardlistrow2"'; }

echo '>
<td >
	<FONT color=green>
	<b>'.$LDOncallInit.'</b>
	</FONT>
</td>
<td valign=top>
	<input type=text name="oncall_name'.$i.'" value="'.$content[$i]['oncall_name'].'" size=20 width=20 onKeyUp=newdata(\''.$i.'\')>
</td>
<td valign=top>
	<input type=text name="oncall_start'.$i.'" value="'.convertTimeToLocal($content[$i]['oncall_start']).'" size=5  maxlength=5 onKeyUp="isnum(this.value,this.name);newdata(\''.$i.'\');">
</td>
<td valign=top>
	<input type=text name="oncall_end'.$i.'" value="'.convertTimeToLocal($content[$i]['oncall_end']).'" size=5  maxlength=5 onKeyUp="isnum(this.value,this.name);newdata(\''.$i.'\');">
	<input type="hidden" name="report_nr'.$i.'" value="'.$content[$i]['report_nr'].'">
	<input type="hidden" name="encoding'.$i.'" value="'.$content[$i]['encoding'].'">
	<input type="hidden" name="history'.$i.'" value="'.$content[$i]['history'].'">
	<input type="hidden" name="tag'.$i.'" value="';
if($content[$i]['tid']) echo '1';
echo '">
</td>
</tr>
';
}

?>

</table>
<p>

<table cellpadding="0" cellspacing=5 >
	<tr>
		<td>
			<?php echo $LDStandbyPerson ?>:  <input type=text name="a_enc" size=30 value="<?php if(isset($a_enc)) echo $a_enc; else echo $_COOKIE['ck_login_username']; ?>">
		</td>
		<td>
			&nbsp; <?php echo $LDOnCallPerson ?>:  <input type=text name="r_enc" size=30 value="<?php if(isset($r_enc)) echo $r_enc; ?>">
		</td>
	<tr>
		<td colspan="2">&nbsp;
		</td>
	</tr>
	<tr>
		<td valign="top">
			<input type="hidden" name="maxelement" value="<?php echo $entries ?>">
			<input type="hidden" name="dept" value="<?php echo $dept ?>">
			<input type="hidden" name="sid" value="<?php echo $sid ?>">
			<input type="hidden" name="lang" value="<?php echo $lang ?>">
			<input type="hidden" name="pyear" value="<?php echo $pyear ?>">
			<input type="hidden" name="pmonth" value="<?php echo $pmonth ?>">
			<input type="hidden" name="pday" value="<?php echo $pday ?>">
			<input type="hidden" name="encoder" value="<?php echo $encoder ?>">
			<input type="hidden" name="retpath" value="<?php echo $retpath ?>">
			<input type="hidden" name="mode" value="save">
			<!-- <input type=submit value="<?php echo $LDSave ?>">
			-->
			<input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0','absmiddle') ?>>
			<input type=reset value="<?php echo $LDReset ?>" onClick=winreset()>
		</td>
		<td align="right">
			<!-- <INPUT TYPE="BUTTON" VALUE="<?php echo $LDPrint ?>" ONCLICK="if (window.echo) {window.echo();} else {window.alert('<?php echo $LDAlertNoechoer ?>');}">
			-->
			<img <?php echo createLDImgSrc($root_path,'printout.gif','0','absmiddle') ?> ONCLICK="if (window.print) {window.print();} else {window.alert('<?php echo $LDAlertNoechoer ?>');}">
			&nbsp;&nbsp;<a href="javascript:closeifok()"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> align=absmiddle></a>
		</td>
	</tr>
</table>
</form>

<?php

$sTemp = ob_get_contents();
ob_end_clean();

$smarty->assign('sMainFrameBlockData',$sTemp);

 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');

?>
