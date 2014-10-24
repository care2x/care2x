<?php
$returnfile=$_SESSION['sess_file_return'];

require('./gui_bridge/default/gui_std_tags.php');

//$_SESSION['sess_file_return']=$thisfile;

function createTR($ld_text, $input_val, $colspan = 1)
{
    global $toggle, $root_path;
?>

<tr>
<td bgColor="#eeeeee" ><FONT SIZE=-1  FACE="Arial,verdana,sans serif"><?php echo $ld_text ?>:
</td>
<td colspan=<?php echo $colspan; ?> bgcolor="#ffffee"><FONT SIZE=-1  FACE="Arial,verdana,sans serif"><?php echo $input_val; ?>
</td>
</tr>

<?php
$toggle=!$toggle;
}

echo StdHeader();
echo setCharSet(); 
?>
 <TITLE><?php echo $title ?></TITLE>

<script  language="javascript">
<!-- 

<?php require($root_path.'include/core/inc_checkdate_lang.php'); ?>

function popRecordHistory(table,pid) {
	urlholder="./record_history.php<?php echo URL_REDIRECT_APPEND; ?>&table="+table+"&pid="+pid;
	HISTWIN<?php echo $sid ?>=window.open(urlholder,"histwin<?php echo $sid ?>","menubar=no,width=400,height=550,resizable=yes,scrollbars=yes");
}

-->
</script>
<?php 
require($root_path.'include/core/inc_js_gethelp.php'); 
require($root_path.'include/core/inc_css_a_hilitebu.php');

//gjergji : new calendar
require_once ('../../js/jscalendar/calendar.php');
$calendar = new DHTML_Calendar('../../js/jscalendar/', $lang, 'calendar-system', true);
$calendar->load_files();
//end : gjergji
?>

</HEAD>


<BODY bgcolor="<?php echo $cfg['bot_bgcolor'];?>" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 onLoad="if (window.focus) window.focus();" 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>


<table width=100% border=0 cellspacing="0"  cellpadding=0 >

<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp;<?php echo $page_title ?></STRONG> 
<font size=+2>(<?php echo $encounter_nr; ?>)</font></FONT>
</td>

<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align="right">
<a href="<?php echo $returnfile.URL_APPEND.'&pid='.$_SESSION['sess_pid'].'&target='.$target.'&mode=show&type_nr='.$type_nr; ?>" ><img 
<?php echo createLDImgSrc($root_path,'back2.gif','0'); ?> <?php if($cfg['dhtml'])echo'class="fadeOut" ';?>><a 
href="javascript:gethelp('admission_how2new.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'class="fadeOut" >';?></a><a href="<?php 
 echo $breakfile; ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseWin ?>"   <?php if($cfg['dhtml'])echo'class="fadeOut" >';?></a>
</td>
</tr>

<?php
/* Create the tabs */

require('./gui_bridge/default/gui_tabs_medocs.php');

?>

<tr>
<td colspan=3   bgcolor="<?php echo $cfg['body_bgcolor']; ?>">

<FONT    SIZE=-1  FACE="Arial">

<table border=0 cellspacing=1 cellpadding=0 width=100%>
<tr bgcolor="#ffffff">
<td colspan=3 valign="top">

<table border=0 width=100% cellspacing=1 cellpadding=3>
<?php
if($is_discharged){
?>
  <tr>
    <td bgcolor="red" colspan=3>&nbsp;<FONT    SIZE=2  FACE="verdana,Arial" color="#ffffff"><img <?php echo createComIcon($root_path,'warn.gif','0','absmiddle'); ?>> <b><?php echo $LDPatientIsDischarged; ?></b></font></td>
  </tr>

<?php
}
?>
<tr>
<td bgColor="#eeeeee"><FONT SIZE=-1  FACE="Arial">
<?php 
echo $LDAdmitNr;
?>
</td>
<td width="30%"  bgcolor="#ffffee"><FONT SIZE=-1  FACE="Arial" color="#800000">
<?php 
 echo ($_SESSION['sess_en']) ;
?>
</td>

<td valign="top" rowspan=8 align="center" bgcolor="#ffffee" ><FONT SIZE=-1  FACE="Arial"><img <?php echo $img_source; ?>>
</td>
</tr>

<tr>
<td bgColor="#eeeeee"><FONT SIZE=-1  FACE="Arial"><?php echo $LDTitle ?>:
</td>
<td  bgcolor="#ffffee"><FONT SIZE=-1  FACE="Arial">
<?php echo $title ?>
</td>

</tr>
<tr>
<td bgColor="#eeeeee"><FONT SIZE=-1  FACE="Arial"><?php  echo $LDLastName ?>:
</td>
<td  bgcolor="#ffffee"><FONT SIZE=-1  FACE="Arial" color="#990000"><b><?php echo $name_last; ?></b>
</td>
</tr>

<tr>
<td bgColor="#eeeeee"><FONT SIZE=-1  FACE="Arial"><?php echo $LDFirstName ?>:
</td>
<td bgcolor="#ffffee"><FONT SIZE=-1  FACE="Arial" color="#990000"><b><?php echo $name_first; ?></b>
</td>
</tr>

<?php
if (!$GLOBAL_CONFIG['person_name_2_hide']&&$name_2)
{
createTR($LDName2,$name_2);
}

if (!$GLOBAL_CONFIG['person_name_3_hide']&&$name_3)
{
createTR( $LDName3,$name_3);
}

if (!$GLOBAL_CONFIG['person_name_middle_hide']&&$name_middle)
{
createTR($LDNameMid,$name_middle);
}

if (!$GLOBAL_CONFIG['person_name_maiden_hide']&&$name_maiden)
{
createTR($LDNameMaiden,$name_maiden);
}

if (!$GLOBAL_CONFIG['person_name_others_hide']&&$name_others)
{
createTR($LDNameOthers,$name_others);
}
?>

<tr>
<td bgColor="#eeeeee"><FONT SIZE=-1  FACE="Arial"><?php echo $LDBday ?>:
</td>
<td  bgcolor="#ffffee" ><FONT SIZE=-1  FACE="Arial"  color="#990000">
<b><?php       echo @formatDate2Local($date_birth,$date_format);  ?></b>
</td>

</tr>

<tr>
<td bgColor="#eeeeee" ><FONT SIZE=-1  FACE="Arial"><?php  echo $LDSex ?>: 
</td>
<td bgcolor="#ffffee" ><FONT SIZE=-1  FACE="Arial"><?php if($sex=="m") echo  $LDMale; elseif($sex=="f") echo $LDFemale ?>
</td>
</tr>


<?php
if($mode=='show'){
	if($rows){
			$bgimg='tableHeaderbg3.gif';
			$tbg= 'background="'.$root_path.'gui/img/common/'.$theme_com_icon.'/'.$bgimg.'"';
		?>
		</table>
		<table border=0 cellpadding=4 cellspacing=1 width=100%>
		  <tr bgcolor="#f6f6f6">
		    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDDate; ?></td>
		    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDDiagnosis; ?></td>
		    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDTherapy; ?></td>
		    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDDetails; ?></td>
		    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDBy; ?></td>
		  </tr>
		<?php
			$toggle=0;
			while($row=$result->FetchRow()){
				if($toggle) $bgc='#efefef';
					else $bgc='#f0f0f0';
				$toggle=!$toggle;
			?>
			
			
			  <tr  bgcolor="<?php echo $bgc; ?>"  valign="top">
			    <td><FONT SIZE=-1  FACE="Arial"><?php if(!empty($row['date'])) echo @formatDate2Local($row['date'],$date_format); else echo '?'; ?></td>
			    <td><FONT SIZE=-1  FACE="Arial" color="#000033"><?php if(!empty($row['diagnosis'])) echo substr($row['diagnosis'],0,$GLOBAL_CONFIG['medocs_text_preview_maxlen']).'<br>'; ?>
				<?php
					if(!empty($row['short_notes'])) echo '[ '.$row['short_notes'].' ]';
				?>
				</td>
			    <td><FONT SIZE=-1  FACE="Arial" color="#000033"><?php if(!empty($row['therapy'])) echo substr($row['therapy'],0,$GLOBAL_CONFIG['medocs_text_preview_maxlen']).'<br>'; ?>
			
				</td>    <td align="center"><a href="<?php echo $thisfile.URL_APPEND.'&pid='.$_SESSION['sess_pid'].'&encounter_nr='.$_SESSION['sess_en'].'&target='.$target.'&mode=details&type_nr='.$type_nr.'&nr='.$row['nr']; ?>"><img <?php echo createComIcon($root_path,'info3.gif','0'); ?>></a></td>
			    <td><FONT SIZE=-1  FACE="Arial"><?php if($row['personell_name']) echo $row['personell_name']; ?></td>
			  </tr>
			
			<?php
			}
		?>
		</table>
		
		<?php	
	}else{
		?>
		</table>
		<table border=0>
		  <tr>
		    <td><img <?php echo createMascot($root_path,'mascot1_r.gif','0','absmiddle') ?>></td>
		    <td><font color="#000099" SIZE=3  FACE="verdana,Arial"> <b>
			<?php 
				echo $norecordyet;
			?></b></font></td>
		  </tr>
		</table>
		<?php
	}
}elseif($mode=='details'){

	$TP_aux_notes=nl2br($row['aux_notes']);
	
	if(stristr($row['short_notes'],'marre_keshille_mjekesore')) $TP_YesNo=$LDYes; 
		else $TP_YesNo=$LDNo; 
		
	$TP_diagnosis=nl2br($row['diagnosis']);
	$TP_therapy=nl2br($row['therapy']);
	$TP_date=formatDate2Local($row['date'],$date_format);
	$TP_personell_name=$row['personell_name'];
	# Load and output the template 
	$TP_form=$TP_obj->load('medocs/tp_medocs_showdata.htm');
	eval("echo $TP_form;");
	
	# Create a new form
}else {
	?>
	<form method="post" name="entryform">
	<?php 
	
		$TP_date_validate='value="'.formatDate2Local(date('Y-m-d'),$date_format).'" onBlur="IsValidDate(this,\''.$date_format.'\')" onKeyUp="setDate(this,\''.$date_format.'\',\''.$lang.'\')"';
		$TP_href_date="javascript:show_calendar('entryform.date','".$date_format."')";
	
		$dfbuffer="LD_".strtr($date_format,".-/","phs");
		$TP_date_format=$$dfbuffer;
	
		$TP_img_calendar=createComIcon($root_path,'show-calendar.gif','0','absmiddle');
		
		$TP_user_name=$_SESSION['sess_user_name'];
		# Load and output the template 
		$TP_form=$TP_obj->load('medocs/tp_medocs_newform.htm');
		eval("echo $TP_form;");
	?>
	<input type="hidden" name="encounter_nr" value="<?php echo $_SESSION['sess_en']; ?>">
	<input type="hidden" name="pid" value="<?php echo $_SESSION['sess_pid']; ?>">
	<input type="hidden" name="modify_id" value="<?php echo $_SESSION['sess_user_name']; ?>">
	<input type="hidden" name="create_id" value="<?php echo $_SESSION['sess_user_name']; ?>">
	<input type="hidden" name="create_time" value="null">
	<input type="hidden" name="mode" value="create">
	<input type="hidden" name="target" value="<?php echo $target; ?>">
	<input type="hidden" name="edit" value="<?php echo $edit; ?>">
	<input type="hidden" name="is_discharged" value="<?php echo $is_discharged; ?>">
	<input type="hidden" name="history" value="Created: <?php echo date('Y-m-d H:i:s'); ?> : <?php echo $_SESSION['sess_user_name']."\n"; ?>">
	<input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0'); ?>>
	
	</form>
	<?php
} 

if(($mode=='show'||$mode=='details')&&!$is_discharged){
?>

<p>
<img <?php echo createComIcon($root_path,'bul_arrowgrnlrg.gif','0','absmiddle'); ?>>
<a href="<?php echo $thisfile.URL_APPEND.'&pid='.$_SESSION['sess_pid'].'&encounter_nr='.$_SESSION['sess_en'].'&target='.$target.'&mode=new&type_nr='.$type_nr; ?>"> 
<?php echo $LDEnterNewRecord; ?>
</a><br>
<?php
} 
if(($mode!='show'&&!$nolist) ||($mode=='show'&&$nolist&&$rows>1)){
?>
<img <?php echo createComIcon($root_path,'l-arrowgrnlrg.gif','0','absmiddle'); ?>>
<a href="<?php echo $thisfile.URL_APPEND.'&pid='.$_SESSION['sess_pid'].'&encounter_nr='.$_SESSION['sess_en'].'&target='.$target.'&mode=show&type_nr='.$type_nr; ?>"> 
<?php echo $LDShowDocList; ?>
</a>
<?php
} 
?>
</td>
<!-- Load the options table  -->
<td rowspan=2  valign="top">
&nbsp;
</td>
</tr>

</table>
<p>

<?php 
if($parent_admit) {
	include('./include/bottom_controls_admission_options.inc.php');
}else{
	include('./include/bottom_controls_registration_options.inc.php');
}
?>

<p>
</ul>

</FONT>
<p>
</td>
</tr>
</table>        
<ul>
<p>
<a href="<?php echo $breakfile?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?> alt="<?php echo $LDCancelClose ?>"></a>

<p>
</ul>
<?php
require($root_path.'include/core/inc_load_copyrite.php');
 ?>
</FONT>
<?php
StdFooter();
?>
