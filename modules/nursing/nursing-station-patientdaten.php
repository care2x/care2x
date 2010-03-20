<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');

$lang_tables[]='departments.php';
define('LANG_FILE','nursing.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');

/**
Load custom file - note that by default we will assume english
**/

$custom_lang_file = $root_path."language/".$lang.'/lang_'.$lang.'_custom.php';
include($custom_lang_file);


/**
* If the script call comes from the op module replace the user cookie with the user info from op module
*/
//$db->debug=true;
if(isset($op_shortcut)&&$op_shortcut){
	$_COOKIE['ck_pflege_user'.$sid]=$op_shortcut;
	setcookie('ck_pflege_user'.$sid,$op_shortcut,0,'/');
	$edit=1;
}elseif($_COOKIE['ck_op_pflegelogbuch_user'.$sid]){
	setcookie('ck_pflege_user'.$sid,$_COOKIE['ck_op_pflegelogbuch_user'.$sid],0,'/');
	$edit=1;
}elseif($_COOKIE['aufnahme_user'.$sid]){
	setcookie('ck_pflege_user'.$sid,$_COOKIE['aufnahme_user'.$sid],0,'/');
	$edit=1;
}elseif(!$_COOKIE['ck_pflege_user'.$sid]){
	if($edit) {header('Location:'.$root_path.'language/'.$lang.'/lang_'.$lang.'_invalid-access-warning.php'); exit;}; 
}
/* Load the visual signalling defined constants */
require_once($root_path.'include/inc_visual_signalling_fx.php');
require_once($root_path.'global_conf/inc_remoteservers_conf.php');

/* Retrieve the SIGNAL_COLOR_LEVEL_ZERO = for convenience purposes */
$z = SIGNAL_COLOR_LEVEL_ZERO;
/* Retrieve the SIGNAL_COLOR_LEVEL_FULL = for convenience purposes */
$f = SIGNAL_COLOR_LEVEL_FULL;

$_SESSION['sess_user_origin']='nursing';

/* Create department object and load all medical depts */
require_once($root_path.'include/care_api_classes/class_department.php');
$dept_obj= new Department;
$medical_depts=$dept_obj->getAllActiveSort( 'name_formal' );
/* Create encounter object */
require_once($root_path.'include/care_api_classes/class_encounter.php');
$enc_obj= new Encounter;

/* Load global configs */
include_once($root_path.'include/care_api_classes/class_globalconfig.php');
$GLOBAL_CONFIG=array();
$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
$glob_obj->getConfig('patient_%');	

/* Establish db connection */
if(!isset($db)||!$db) include($root_path.'include/inc_db_makelink.php');
if($dblink_ok)
{	
    /* Load date formatter */
	include_once($root_path.'include/inc_date_format_functions.php');
		$enc_obj->where=" encounter_nr=$pn";
	    if( $enc_obj->loadEncounterData($pn)) {
/*			switch ($enc_obj->EncounterClass())
			{
		    	case '1': $full_en = ($pn + $GLOBAL_CONFIG['patient_inpatient_nr_adder']);
		                   break;
				case '2': $full_en = ($pn + $GLOBAL_CONFIG['patient_outpatient_nr_adder']);
							break;
				default: $full_en = ($pn + $GLOBAL_CONFIG['patient_inpatient_nr_adder']);
			}						
*/
			$full_en=$pn;
			
			if( $enc_obj->is_loaded){
				$result=&$enc_obj->encounter;		
				$rows=$enc_obj->record_count;	

					if($result['is_discharged']) $edit=0;
					
					$event_table= 'care_encounter_event_signaller';
					
					/* If mode = save_event_changes, save the color bar status */
					
					if($mode=='save_event_changes')
					{
					   $sql_buf='';
					   
					   /* prepare the rose_x part sql query */
					   
					   for ($i=1;$i<25;$i++)
					   {
					       $buf='rose_'.$i;
						   
						   $sql_buf.=$buf." ='".$$buf."', ";
					   }

					   /* prepare the green_x part */

					   for ($i=1;$i<8;$i++)
					   {
					       $buf='green_'.$i;

						   $sql_buf.=$buf."='".$$buf."', ";
					   }
					   
					   /* append the additional color event signallers */
					   
					   $sql_buf.="yellow='$yellow', black='$black', blue_pale='$blue_pale', brown='$brown',
					                   pink='$pink', yellow_pale='$yellow_pale', red='$red', green_pale='$green_pale',
									   violet='$violet', blue='$blue', biege='$biege', orange='$orange'";
					   
					   
					   $sql = "UPDATE $event_table SET $sql_buf WHERE encounter_nr='$pn'";
					 
					 //  echo $sql; 

					   if ($event_result=$enc_obj->Transact($sql))
					   {
					     if (!$db->Affected_Rows())
					      {
                            /* If entry not yet existing, insert data */
							
					        /* prepare the rose_x part sql query */
					       
						    $set_str='';
							$sql_buf='';
					   
					        for ($i=1;$i<25;$i++)
					       {
						   
					          $buf='rose_'.$i;
							  
							  $set_str.=$buf.', ';

						       $sql_buf.="'".$$buf."', ";
					       }

					       /* prepare the green_x part */

					       for ($i=1;$i<8;$i++)
					      {
					          $buf='green_'.$i;

							  $set_str.=$buf.', ';

						       $sql_buf.="'".$$buf."', ";
					       }

					   /* append the additional color event signallers */

					   $set_str.='yellow, black, blue_pale, brown,
					                   pink, yellow_pale, red, green_pale,
									   violet, blue, biege, orange';

					   /* prepare the values part */

					   $sql_buf.="'$yellow', '$black', '$blue_pale', '$brown',
					                   '$pink', '$yellow_pale', '$red', '$green_pale',
									   '$violet', '$blue', '$biege', '$orange'";

						$sql = "INSERT INTO $event_table (encounter_nr, $set_str) VALUES ('$pn', $sql_buf)";

					    if($event_result=$enc_obj->Transact($sql))
					    {
					       $event=&$_POST;

						   $mode='changes_saved';
						    //echo "ok insertd $sql";
					    }
						else
						{
						    //echo "failed insert $sql";
						    $mode='';
						}

				      }
					  else
					  {
					      $mode='changes_saved';
						   //echo "update ok $sql";
					  }
					}
					else
					{
					      $mode='';
						   //echo " failed update $sql";
					}
			    }
				
				//echo $sql;

			   if(!isset($mode) || ($mode=='') || ($mode=='changes_saved'))
			   {
					/* Get the color event signaller data */
					
					$sql="SELECT * FROM ".$event_table." WHERE encounter_nr='".$pn."'";
					
					if($event_result=$db->Execute($sql))
					{
					   if($event_result->RecordCount()) 
					   {
					      $event=$event_result->FetchRow();
						}
					    else
						{
						   /* If no event entry yet, create event array with zeros */
						   $event=array('yellow'=>$z,'black'=>$z,'blue_pale'=>$z,'brown'=>$z,'pink'=>$z,'yellow_pale'=>$z,'red'=>$z,'green_pale'=>$z,'violet'=>$z,'blue'=>$z,'biege'=>$z,'orange'=>$z);
						   /* Add the green_n */
						   for ($i=1;$i<8;$i++)
						   {
						       $event['green_'.$i]=$z;
						    }
							/* Add the rose_n */
						   for ($i=1;$i<25;$i++)
						   {
						       $event['rose_'.$i]=$z;
						    }
					    }
							
					}
			   }
			} // end of if($rows)
	  }else{ // end of if ($ergebnis)
	  	echo "<p>$sql$LDDbNoRead"; 
		exit;
	}
}else{
	echo "$LDDbNoLink<br>$sql<br>"; 
}
		
$fr=strtolower(str_replace('.','-',($result['encounter_nr'].'_'.$result['name_last'].'_'.$result['name_first'].'_'.$result['date_birth'])));

# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('nursing');

# Title in toolbar
 $smarty->assign('sToolbarTitle',"$LDPatDataFolder $station");

 # hide return button
 $smarty->assign('pbBack',FALSE);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('patient_folder.php','$nodoc','','$station','Main folder')");

 # href for close button
 $smarty->assign('breakfile','javascript:window.close()');

 # Window bar title
 $smarty->assign('sWindowTitle',ucfirst($result[name_last]).",".ucfirst($result[name_first])." ".$result[date_birth]." ".$LDPatDataFolder);

 # Body Onload js
 $sOnLoadJs = 'onLoad="initwindow();';
 if($mode=='changes_saved') $sOnLoadJs = $sOnLoadJs.'window.opener.location.reload();';
 $sOnLoadJs = $sOnLoadJs.'"';
 $smarty->assign('sOnLoadJs',$sOnLoadJs);

# Collect js code

ob_start();

?>

<script language="javascript">
<!-- 
  var urlholder;
  var changed_flag=0;

function initwindow(){
	if (window.focus) window.focus();
	window.resizeTo(800,600);
}

function getinfo(patientID){
	urlholder="nursing-station.php?route=validroute&patient=" + patientID + "&user=<?php echo $aufnahme_user.'"' ?>;
	patientwin=window.open(urlholder,patientID,"width=700,height=600,menubar=no,resizable=yes,scrollbars=yes");
}

function enlargewin(){
	window.moveTo(0,0);
	 window.resizeTo(1000,740);
}

function xmakekonsil(v)
{ 
    var x=v;
/*	if((v=="patho")||(v=="inmed")||(v=="radio")||(v=="baclabor")||(v=="blood")||(v=="chemlabor"))
	{
*/	
	   if((v=="inmed")||(v=="allamb")||(v=="unfamb")||(v=="sono")	||(v=="nuklear"))
	   {
	     v="generic";
	   }
	   location.href="nursing-station-patientdaten-doconsil-"+v+".php?sid=<?php echo "$sid&lang=$lang&edit=$edit&station=$station&pn=$pn&konsil="; ?>"+x+"&target="+v;
/*	}
	else 
	{v="radio";
	location.href="ucons.php?sid=<?php echo "$sid&lang=$lang&station=$station&pn=$pn&konsil="; ?>"+v;
	}
*/	//enlargewin();
}
function makekonsil(d)
{ 
	if(d!=""){
	   location.href="nursing-station-patientdaten-doconsil-router.php?sid=<?php 
	   //echo "$sid&lang=$lang&edit=$edit&station=$station&pn=$pn&dept_nr=";
	   echo "$sid&lang=$lang&edit=$edit&station=$station&pn=$pn&dept_id=";
	   ?>"+d;
	}
}
function pullbar(cb)
{
    var buf;
	
	eval("buf = document.patient_folder." + cb.name + ".value");
	
	buf=parseInt(buf);
	
	if((buf == '<?php echo $f ?>') || (buf) || (buf==<?php echo $f ?>))
	{ eval("document."+cb.name+".src='<?php echo $root_path; ?>gui/img/common/default/qbar_<?php echo $z ?>_"+cb.name+".gif'");
		 eval("document.patient_folder." + cb.name + ".value = <?php echo $z ?>");
	}
		else 
		{
		 eval("document."+cb.name+".src='<?php echo $root_path; ?>gui/img/common/default/qbar_<?php echo $f ?>_"+cb.name+".gif'");
		 eval("document.patient_folder." + cb.name + ".value = <?php echo $f ?>");
		}
	changed_flag=1;
}

function pullGreenbar(cb)
{
    var buf;
	
	eval("buf = document.patient_folder." + cb.name + ".value");
	
     buf=parseInt(buf);
	
	if((buf == '<?php echo $f ?>') || (buf) || (buf==<?php echo $f ?>))
	{ eval("document."+cb.name+".src='<?php echo $root_path; ?>gui/img/common/default/qbar_<?php echo $z ?>_green.gif'");
		 eval("document.patient_folder." + cb.name + ".value = <?php echo $z ?>");
	}
		else 
		{
		 eval("document."+cb.name+".src='<?php echo $root_path; ?>gui/img/common/default/qbar_<?php echo $f ?>_green.gif'");
		 eval("document.patient_folder." + cb.name + ".value = <?php echo $f ?>");
		}
	changed_flag=1;
}

function pullRosebar(cb)
{
    var buf;
	
	eval("buf = document.patient_folder." + cb.name + ".value");
	
     buf=parseInt(buf);
	
	if((buf == '<?php echo $f ?>') || (buf) || (buf==<?php echo $f ?>))
	{ eval("document."+cb.name+".src='<?php echo $root_path; ?>gui/img/common/default/qbar_<?php echo $z ?>_rose.gif'");
		 eval("document.patient_folder." + cb.name + ".value = <?php echo $z ?>");
	}
		else 
		{
		 eval("document."+cb.name+".src='<?php echo $root_path; ?>gui/img/common/default/qbar_<?php echo $f ?>_rose.gif'");
		 eval("document.patient_folder." + cb.name + ".value = <?php echo $f ?>");
		}
	changed_flag=1;
}

function isColorBarUpdated()
{
   if (changed_flag==1) return true;
     else return false;
}
function winClose(){
	window.opener.location.reload();
	window.close();
}
function openDRGComposite(){
<?php if($cfg['dhtml'])
	echo '
			w=window.parent.screen.width;
			h=window.parent.screen.height;';
	else
	echo '
			w=800;
			h=650;';
?>
	
	drgcomp_<?php echo $_SESSION['sess_full_en']."_".$op_nr."_".$dept_nr."_".$saal ?>=window.open("<?php echo $root_path ?>modules/drg/drg-composite-start.php<?php echo URL_REDIRECT_APPEND."&display=composite&pn=".$pn."&edit=$edit&ln=$name_last&fn=$name_first&bd=$date_birth&dept_nr=$dept_nr&oprm=$saal"; ?>","drgcomp_<?php echo $encounter_nr."_".$op_nr."_".$dept_nr."_".$saal ?>","menubar=no,resizable=yes,scrollbars=yes, width=" + (w-15) + ", height=" + (h-60));
	window.drgcomp_<?php echo $_SESSION['sess_full_en']."_".$op_nr."_".$dept_nr."_".$saal ?>.moveTo(0,0);
} 

//-->
</script>
<?php

$sTemp = ob_get_contents();
ob_end_clean();
$smarty->append('JavaScript',$sTemp);

# Buffer page output

ob_start();

?>

<ul>

	<form method="post" name="patient_folder"
		onSubmit="return isColorBarUpdated()">
 

<?php

# internal function for the following lines of code only
function ha(){
	global $edit;
	if ($edit) return '<a href="#">';
}
function he(){
	global $edit;
	if ($edit) return 'onClick="javascript:pullbar(this)"></a><a href="#">';
		else return  '>';
}
function hx(){
	global $edit;
	if ($edit) return 'onClick="javascript:pullbar(this)"></a>';
		else return '>';
}
function gx(){
	global $edit;
	if ($edit) return 'onClick="javascript:pullGreenbar(this)"></a>';
		else return '>';
}
function rx(){
	global $edit;
	if ($edit) return 'onClick="javascript:pullRosebar(this)"></a>';
		else return '>';
}

       /* Now create the first group of color event signaller */
        echo '<table   cellpadding="0" cellspacing=0 border="0" >
		<tr bgcolor="#696969" ><td colspan="3" ><nobr>'.ha().'<img 
		'.createComIcon($root_path,'qbar_'.$event['yellow'].'_yellow.gif','0').' name="yellow" '.he().'<img 
		'.createComIcon($root_path,'qbar_'.$event['black'].'_black.gif','0').' name="black" '.he().'<img 
		'.createComIcon($root_path,'qbar_'.$event['blue_pale'].'_blue_pale.gif','0').' name="blue_pale" '.he().'<img 
		'.createComIcon($root_path,'qbar_'.$event['brown'].'_brown.gif','0').' name="brown" '.he().'<img 
		'.createComIcon($root_path,'qbar_'.$event['pink'].'_pink.gif','0').' name="pink" '.he().'<img 
		'.createComIcon($root_path,'qbar_'.$event['yellow_pale'].'_yellow_pale.gif','0').' name="yellow_pale" '.he().'<img 
		'.createComIcon($root_path,'qbar_'.$event['red'].'_red.gif','0').' name="red" '.he().'<img
		'.createComIcon($root_path,'qbar_'.$event['green_pale'].'_green_pale.gif','0').' name="green_pale" '.he().'<img
		'.createComIcon($root_path,'qbar_'.$event['violet'].'_violet.gif','0').' name="violet" '.he().'<img
		'.createComIcon($root_path,'qbar_'.$event['blue'].'_blue.gif','0').' name="blue" '.he().'<img
		'.createComIcon($root_path,'qbar_'.$event['biege'].'_biege.gif','0').' name="biege" '.hx().'<img
		'.createComIcon($root_path,'qbar_trans.gif','0').'>'.ha().'<img
		'.createComIcon($root_path,'qbar_'.$event['orange'].'_orange.gif','0').' name="orange" '.hx().'<img
		'.createComIcon($root_path,'qbar_trans.gif','0').'><img
		'.createComIcon($root_path,'qbar_trans.gif','0').'><img
		'.createComIcon($root_path,'qbar_trans.gif','0').'>';
		
		/* Create the green bars */
		/* Note $h is used here as counter  */
		for($h=1;$h<8;$h++)
		{ 
		  echo ha().'<img
		 '.createComIcon($root_path,'qbar_'.$event['green_'.$h].'_green.gif','0').' alt="'.$LDFullDayName[$h].'"  name="green_'.$h.'" '.gx();
		  }
		 echo '<img
		'.createComIcon($root_path,'qbar_trans.gif','0').'>';
		
		/* Create the rose bars*/
		/* Note $h is used here as counter  */
		for($h=1;$h<25;$h++)
		{ 

		  echo '<img 
			 '.createComIcon($root_path,'qbar_'.$event['rose_'.$h].'_rose.gif','0').' alt="'.$h.' '.$LDHour.'"  name="rose_'.$h.'">';
			if(($h==6)||($h==12)||($h==18))
		 	echo'<img
			  '.createComIcon($root_path,'qbar_trans.gif','0').'>';
		 }
		 
		 /* Create the tag links */
		echo '</td></nobr>
		</tr>
		<tr bgcolor="#696969" ><td colspan="3" ><nobr>
		<table cellpadding=0 width=100%>
		<tr><td bgcolor=333333><font color=white><b>'.$LDCharts.'<b></font></td></tr>
		<tr><td>
		<table cellpadding=3><tr><td><input type="button" onClick="javascript:enlargewin();window.location.href=\'nursing-station-patientdaten-custom-inout.php'.URL_REDIRECT_APPEND.'&station='.$station.'&pn='.$pn.'&edit='.$edit.'\'" value="'.$IO_title.'"></td>
		<td><input type="button" onClick="javascript:enlargewin();window.location.href=\'nursing-station-patientdaten-custom-ddc.php'.URL_REDIRECT_APPEND.'&station='.$station.'&pn='.$pn.'&edit='.$edit.'\'" value="'.$DDC_title.'"></td>
		<td><input type="button" onClick="javascript:enlargewin();window.location.href=\'nursing-station-patientdaten-kurve.php'.URL_REDIRECT_APPEND.'&station='.$station.'&dept_nr='.$dept_nr.'&pn='.$pn.'&edit='.$edit.'\'" value="'.$LDFeverCurve.'"></td>
		</tr>
		<tr><td>
		<input type="button" onClick="javascript:enlargewin();window.location.href=\'nursing-station-patientdaten-custom-tc.php'.URL_REDIRECT_APPEND.'&station='.$station.'&pn='.$pn.'&edit='.$edit.'\'" value="'.$TC_title.'"></td>
		<td><input type="button" onClick="javascript:enlargewin();window.location.href=\'nursing-station-patientdaten-custom-noc.php'.URL_REDIRECT_APPEND.'&station='.$station.'&pn='.$pn.'&edit='.$edit.'\'" value="'.$NOC_title.'"></td>
		<td><input type="button" onClick="javascript:enlargewin();window.location.href=\'nursing-getmedx.php'.URL_REDIRECT_APPEND.'&station='.$station.'&dept_nr='.$dept_nr.'&pn='.$pn.'&edit='.$edit.'\'" value="'.$DailyTherapy.'"></td>
		</tr></table>
		</td></tr>
		<tr><td bgcolor=333333><font color=white><b>'.$LDReports.'<b></font></td></tr>
		<tr><td>
		<table cellpadding=3><tr>
		<td><input type="button" onClick="javascript:enlargewin();window.location.href=\'nursing-station-patientdaten-pbericht.php'.URL_REDIRECT_APPEND.'&station='.$station.'&pn='.$pn.'&edit='.$edit.'\'" value="'.$LDNursingReport.'"></td>
		<td><input type="button" onClick="javascript:enlargewin();window.location.href=\''.$root_path.'main/diagnostics-report-start.php'.URL_REDIRECT_APPEND.'&station='.$station.'&pn='.$pn.'&edit='.$edit.'&header='.$result['name_last'].',+'.$result['name_first'].'+'.formatDate2Local($result['date_birth'],$date_format).'\'" value="'.$LDReports.'"></td>
		';
		echo '<td><input type="button" onClick="javascript:window.location.href=\''.$root_path.'modules/laboratory/labor_datalist_noedit.php'.URL_REDIRECT_APPEND.'&station='.$station.'&pn='.$pn.'&user_origin='.$user_origin.'&edit='.$edit.'\'" value="'.$LDLabReports.'"></td>';
		
		//<input type="button" value="'.$LDRootData.'"><input 
		//type="button" value="'.$LDNursingPlan.'">
		echo '</tr></table></td></tr>';
		echo '<tr><td bgcolor=333333><font color=white><b>'.$LDOther.'<b></font></td></tr>';
		echo '<tr><td><table cellpadding=3><tr><td>';
		echo '<input 
		type="button" onClick="javascript:openDRGComposite()" value="'.$LDDRG.'"></td><td>';
		echo '<td><input type="button" onClick="javascript:enlargewin();window.location.href=\'nursing-station-patientdaten-todo.php'.URL_REDIRECT_APPEND.'&station='.$station.'&pn='.$pn.'&edit='.$edit.'\'" value="'.$LDDocsPrescription.'"></td>';
		echo '<td><input type="button" onClick="javascript:enlargewin();window.location.href=\''.$root_path.'modules/fotolab/fotos-start.php'.URL_REDIRECT_APPEND.'&pn='.$pn.'&station='.$station.'&fileroot='.$fr.'&edit='.$edit.'\'" value="'.$LDPhotos.'"></td></tr></table></td></tr></table>';
		
		
		/* Create the select  menu in edit mode */
/*		if($edit){
			$ChkUpOptions=get_meta_tags($root_path.'global_conf/'.$lang.'/konsil_tag_dept.pid');
		
			echo '<select 
			name="konsiltyp" size="1" onChange=makekonsil(this.value)>
			<option value="">'.$LDChkUpRequests.'</option>';

			while(list($x,$v)=each($ChkUpOptions))
			echo'
			<option value="'.$x.'">'.$v.'</option>';
			echo '
			</select>';
		}
*/
		if($edit){
		
			echo '<table cellpadding=3><tr><td><select name="konsiltyp" size="1" onChange=makekonsil(this.value)>
			<option value="">'.$LDChkUpRequests.'</option>';

			while(list($x,$v)=each($medical_depts)){
				$subDepts = $dept_obj->getAllSubDepts($v['nr']);
				echo'<option value="'.$v['nr'].'~'.$v['id'].'">';
				$buffer=$v['LD_var'];
				if(isset($$buffer)&&!empty($$buffer)) echo $$buffer;
					else echo $v['name_formal'];
				echo '</option>';
			    //added subdepts
				if($subDepts) {
			    		while (list($y,$sDept) = each($subDepts)) {
            				echo'<option value="'.$sDept['nr'].'~'.$sDept['id'].'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<sup>L</sup>&nbsp;';
            				$buffer=$sDept['LD_var'];
            				if(isset($$buffer)&&!empty($$buffer)) echo $$buffer;
            				else echo $sDept['name_formal'];
            				echo '</option>';
			    		}
			    }	
			}
			echo '
			</select></td></tr></table>';
		}
		
		/* Create frames witht the skins */
		echo '
		</nobr>
		</td>
		</tr>
		<tr bgcolor="#696969" >
		<td colspan=3   background="'.createBgSkin($root_path,'folderskin2.jpg').'">&nbsp;</td>
		</tr>';
/**
*  Display the patient's basic info
* By default, the png image label displayed
* To use the html display form uncomment the code within the PATIENT_INFO_HTML tags
*  and comment out the code within the PATIENT_INFO_IMAGE tags
*/		
/*	

#..................... START...... PATIENT_INFO_HTML

	echo'
		<tr  bgcolor="#696969"><td   background="'.createBgSkin('../','folderskin2.jpg').'"><font face="verdana,arial" size="2" ><b>&nbsp;&nbsp;</b></td>
		<td bgcolor="aqua"><font face="verdana,arial" size="2" >&nbsp;<b>'.$result[encounter_nr].'</b></td>
		<td   background="'.createBgSkin('../','folderskin2.jpg').'"><font face="verdana,arial" size="2" ><b>&nbsp;</b></td>
		</tr>';

#..................... END....... PATIENT_INFO_HTML
		
*/
echo '
<tr  bgcolor="#696969" >
	<td  background="'.createBgSkin($root_path,'folderskin2.jpg').'" width="10%">&nbsp;</td>
		<td valign="top" bgcolor="#ffffff"><font face="verdana,arial" size="2">';

//..................... START...... PATIENT_INFO_HTML

/*
echo '<ul>'.$result[title].'<br>
		<b>'.ucfirst($result[name]).', '.ucfirst($result[name_first]).'</b> <br>
		<font color=maroon>'.formatDate2Local($result[date_birth],$date_format).'</font> <p>
		'.nl2br($result[address]);

echo '<p>'.strtoupper($station).' &nbsp; &nbsp; '.$result[kasse].' '.$result[kassename];
//echo '<p><IMG SRC="http://www.barcodemill.com/cgi-bin/barcodemill/bcmill/barcode.gif?height=30&symbol=1&content='.$result[encounter_nr].'" align="left">';

if(file_exists('../cache/barcodes/en_'.$result['encounter_nr'].'.png')) echo '<br><img src="../cache/barcodes/en_'.$result[encounter_nr].'.png" border=0>';
else echo "<br><img src='../classes/barcode/image.php?code=$result[encounter_nr]&style=68&type=I25&width=180&height=50&xres=2&font=5' border=0>";
echo '</ul>';
*/
// echo '<p>'.$pday.'.'.$pmonth.'.'.$pyear;

//..................... END....... PATIENT_INFO_HTML

//..................... START...... PATIENT_INFO_IMAGE

echo '<img src="'.$root_path.'main/imgcreator/barcode_label_single_large.php?sid='.$sid.'&lang='.$lang.'&fen='.$full_en.'&en='.$pn.'" width=282 height=178 align="left" hspace=5 vspace=5>';

//..................... END....... PATIENT_INFO_IMAGE

/* Create the colorbar legend table */

echo '
<table border=0 cellspacing=1 cellpadding=0>
  <tr>
    <td bgcolor="#ffff00"><font size=1>&nbsp;&nbsp;&nbsp;</font></td>
    <td><font size=1><nobr>&nbsp;'.$LDQueryDoctor.'</nobr></font></td>
  </tr>
  <tr>
  <tr>
    <td bgcolor="#000000"><font size=1>&nbsp;</td>
    <td><font size=1><nobr>&nbsp;'.$LDDoctorInfo.'</nobr></font></td>
  </tr>
  <tr>
  <tr>
    <td bgcolor="#81eff5"><font size=1>&nbsp;</td>
    <td><font size=1><nobr>&nbsp;'.$LDTestConsultRequested.'</nobr></td>
  </tr>
  <tr>
  <tr>
    <td bgcolor="#804408"><font size=1>&nbsp;</td>
    <td><font size=1><nobr>&nbsp;'.$LDDiagnosticsReport.'</nobr></td>
  </tr>
  <tr>
  <tr>
    <td bgcolor="#f598cb"><font size=1>&nbsp;</td>
    <td><font size=1>&nbsp;'.$LDInfusionTherapy.'</td>
  </tr>
  <tr>
  <tr>
    <td bgcolor="#ebf58d"><font size=1>&nbsp;</td>
    <td><font size=1>&nbsp;'.$LDMonitorFluidDischarge.'</td>
  </tr>
  <tr>
  <tr>
    <td bgcolor="#ff0000"><font size=1>&nbsp;</td>
    <td><font size=1>&nbsp;'.$LDBloodProgram.'</td>
  </tr>
  <tr>
  <tr>
    <td bgcolor="#00ff00"><font size=1>&nbsp;</td>
    <td><font size=1><nobr>&nbsp;'.$LDAntibioticsProgram.'</nobr></td>
  </tr>
  <tr>
  <tr>
    <td bgcolor="#dd36fc"><font size=1>&nbsp;</td>
    <td><font size=1>&nbsp;'.$LDAnticoagProgram.'</td>
  </tr>
  <tr>
  <tr>
    <td bgcolor="#0000ff"><font size=1>&nbsp;</td>
    <td><font size=1>&nbsp;'.$LDNurseReport.'</td>
  </tr>
  <tr>
  <tr>
    <td bgcolor="#f5ddc6"><font size=1>&nbsp;</td>
    <td><font size=1><nobr>&nbsp;'.$LDSpecialCare.'</nobr></td>
  </tr>
  <tr>
  <tr>
    <td bgcolor="#fdad29"><font size=1>&nbsp;</td>
    <td><font size=1>&nbsp;'.$LDDaily.'</td>
  </tr>
  <tr>

</table>
';


echo '
		</td>
		<td   background="'.createBgSkin($root_path,'folderskin2.jpg').'" >&nbsp;
		</td>
		</tr>
		<tr bgcolor="#696969" >
		<td colspan=3  background="'.createBgSkin($root_path,'folderskin2.jpg').'">&nbsp;</td>
		</tr>
		</table>
		';
?>
<input type="hidden" name="sid" value="<?php echo $sid ?>"> <input
		type="hidden" name="lang" value="<?php echo $lang ?>"> <input
		type="hidden" name="dept_nr" value="<?php echo $dept_nr ?>"> <input
		type="hidden" name="pn" value="<?php echo $pn ?>">

<?php
# If in edit mode create the hidden items
if($edit){
?>

<input type="hidden" name="yellow"
		value="<?php echo $event['yellow'] ?>"> <input type="hidden"
		name="black" value="<?php echo $event['black'] ?>"> <input
		type="hidden" name="blue_pale"
		value="<?php echo $event['blue_pale'] ?>"> <input type="hidden"
		name="brown" value="<?php echo $event['brown'] ?>"> <input
		type="hidden" name="pink" value="<?php echo $event['pink'] ?>"> <input
		type="hidden" name="yellow_pale"
		value="<?php echo $event['yellow_pale'] ?>"> <input type="hidden"
		name="red" value="<?php echo $event['red'] ?>"> <input type="hidden"
		name="green_pale" value="<?php echo $event['green_pale'] ?>"> <input
		type="hidden" name="violet" value="<?php echo $event['violet'] ?>"> <input
		type="hidden" name="blue" value="<?php echo $event['blue'] ?>"> <input
		type="hidden" name="biege" value="<?php echo $event['biege'] ?>"> <input
		type="hidden" name="orange" value="<?php echo $event['orange'] ?>"> <input
		type="hidden" name="green_1" value="<?php echo $event['green_1'] ?>">
	<input type="hidden" name="green_2"
		value="<?php echo $event['green_2'] ?>"> <input type="hidden"
		name="green_3" value="<?php echo $event['green_3'] ?>"> <input
		type="hidden" name="green_4" value="<?php echo $event['green_4'] ?>">
	<input type="hidden" name="green_5"
		value="<?php echo $event['green_5'] ?>"> <input type="hidden"
		name="green_6" value="<?php echo $event['green_6'] ?>"> <input
		type="hidden" name="green_7" value="<?php echo $event['green_7'] ?>">
	<input type="hidden" name="rose_1"
		value="<?php echo $event['rose_1'] ?>"> <input type="hidden"
		name="rose_2" value="<?php echo $event['rose_2'] ?>"> <input
		type="hidden" name="rose_3" value="<?php echo $event['rose_3'] ?>"> <input
		type="hidden" name="rose_4" value="<?php echo $event['rose_4'] ?>"> <input
		type="hidden" name="rose_5" value="<?php echo $event['rose_5'] ?>"> <input
		type="hidden" name="rose_6" value="<?php echo $event['rose_6'] ?>"> <input
		type="hidden" name="rose_7" value="<?php echo $event['rose_7'] ?>"> <input
		type="hidden" name="rose_8" value="<?php echo $event['rose_8'] ?>"> <input
		type="hidden" name="rose_9" value="<?php echo $event['rose_9'] ?>"> <input
		type="hidden" name="rose_10" value="<?php echo $event['rose_10'] ?>">
	<input type="hidden" name="rose_11"
		value="<?php echo $event['rose_11'] ?>"> <input type="hidden"
		name="rose_12" value="<?php echo $event['rose_12'] ?>"> <input
		type="hidden" name="rose_13" value="<?php echo $event['rose_13'] ?>">
	<input type="hidden" name="rose_14"
		value="<?php echo $event['rose_14'] ?>"> <input type="hidden"
		name="rose_15" value="<?php echo $event['rose_15'] ?>"> <input
		type="hidden" name="rose_16" value="<?php echo $event['rose_16'] ?>">
	<input type="hidden" name="rose_17"
		value="<?php echo $event['rose_17'] ?>"> <input type="hidden"
		name="rose_18" value="<?php echo $event['rose_18'] ?>"> <input
		type="hidden" name="rose_19" value="<?php echo $event['rose_19'] ?>">
	<input type="hidden" name="rose_20"
		value="<?php echo $event['rose_20'] ?>"> <input type="hidden"
		name="rose_21" value="<?php echo $event['rose_21'] ?>"> <input
		type="hidden" name="rose_22" value="<?php echo $event['rose_22'] ?>">
	<input type="hidden" name="rose_23"
		value="<?php echo $event['rose_23'] ?>"> <input type="hidden"
		name="rose_24" value="<?php echo $event['rose_24'] ?>"> <input
		type="hidden" name="mode" value="save_event_changes"> <input
		type="submit" value="<?php echo $LDSaveChanges ?>">
<?php
}

  //echo '<a href="javascript:winClose()"><img '.createLDImgSrc($root_path,'close2.gif','0','absmiddle').'></a>';
?>

</form>

</ul>
<?php

$sTemp = ob_get_contents();
ob_end_clean();

# Assign page output to the mainframe template

$smarty->assign('sMainFrameBlockData',$sTemp);
 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');

?>
