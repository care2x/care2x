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

define('DEFAULT_NR_OF_BEDS',2); // Define here the default number of beds if the bed value is empty or 0

define('LANG_FILE','nursing.php');
$local_user='ck_edv_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');

$thisfile=basename(__FILE__);
$breakfile='nursing-station-info.php?sid='.$sid.'&lang='.$lang;
/* Load the ward object */
require_once($root_path.'include/care_api_classes/class_ward.php');
$ward_obj=new Ward($ward_nr);

//$db->debug=1;

if(isset($mode) && $mode=='save_beds'){
	$saved_ok=false;
	
	// Set the values common to all rooms 
	$_POST['date_create']=date('Y-m-d');
	$_POST['history']="Created: ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."\n";
	//$_POST['modify_id']=$_SESSION['sess_user_name'];
	$_POST['create_id']=$_SESSION['sess_user_name'];
	$_POST['create_time']=date('YmdHis');
	//$db->debug=1;
	for($i=$room_nr_start;$i<=$room_nr_end;$i++){

		if(!$ward_obj->RoomExists($i)){
			$beds='beds'.$i;
			$info='info'.$i;
			$_POST['room_nr']=$i;
			if(empty($$beds)) $$beds=DEFAULT_NR_OF_BEDS;
			$_POST['nr_of_beds']=$$beds;
			if(empty($$info)) $_POST['info'] = ' ';
				else $_POST['info']=$$info;
			if($ward_obj->saveWardRoomInfoFromArray($_POST)) $saved_ok=true;
			//echo $ward_obj->getLastQuery().'<p>';
		}
	}
	
	if($saved_ok){
		//gjergji : commented it out for the changing of the magament
		//header("location:nursing-station.php".URL_REDIRECT_APPEND."&edit=1&ward_nr=$ward_nr&retpath=ward_mng");
		header("location:nursing-station-info.php".URL_REDIRECT_APPEND."&edit=0&mode=show&ward_id=$station&ward_nr=$ward_nr");
		//end : gjergji
		exit;
	}else{
		echo $ward_obj->getLastQuery();
	}
}else{
	/* Get the ward's data */
	$ward=&$ward_obj->getWardInfo($ward_nr);
}
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>

<script language="javascript">
<!-- 
function checkForm(f){
	var i;
	var v;
	var ret=true;
	for(i=<?php echo $ward['room_nr_start']; ?>;i<=<?php echo $ward['room_nr_end']; ?>;i++){
		eval("v=f.beds"+i+".value;");
		if(isNaN(v)||v==""||v==" "||v=="  "||v<1||!v){
			ret=false;
			break;
		}
	}
	if(ret){
		return true;
	}else{
		alert("<?php echo $LDNrOfBedsRoom.' '.$ward['roomprefix']; ?> "+i+" <?php echo $LDIsNotANumber; ?>!");
		eval("f.beds"+i+".focus();");
		eval("f.beds"+i+".select();");
		return false;
	}
}
// -->
</script>

<?php
require($root_path.'include/core/inc_js_gethelp.php');
require($root_path.'include/core/inc_css_a_hilitebu.php');
?>
<style type="text/css" name="formstyle">
td.pblock{ font-family: verdana,arial; font-size: 12}
td.pv{ font-family: verdana,arial; font-size: 12; color: #0000cc}

div.box { border: solid; border-width: thin; width: 100% }

div.pcont{ margin-left: 3; }

</style>

</HEAD>

<BODY bgcolor=<?php echo $cfg['body_bgcolor']; ?> onLoad="if (window.focus) window.focus()" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>


<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp; <?php echo "$LDNursing $LDStation - $LDProfile" ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  class="fadeOut" >';?></a><a href="javascript:gethelp('nursing_ward_mng.php','<?php echo $mode ?>','<?php echo $edit ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'class="fadeOut" >';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseAlt ?>"  <?php if($cfg['dhtml'])echo'class="fadeOut" >';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2>
 <ul>
<?php if(is_array($ward)) { ?>
<p><br>
<?php 	

$room_nr=$ward['room_nr_end']-$ward['room_nr_start'];

$bgc=$root_path.'gui/img/skin/default/tableHeaderbg3.gif';
$bgc2='#eeeeee';

?>
<form action="nursing-station-new-createbeds.php" method="post" name="newbeds" onSubmit="return checkForm(this)">

<table border=0 cellpadding=2 cellspacing=1>
  <tr>
    <td class=pblock background="<?php echo $bgc ?>">&nbsp;<b><?php echo $LDStation ?></b>:</td>
    <td class=pblock bgcolor="<?php echo $bgc2 ?>"  colspan=2>&nbsp; <?php echo $ward['name'] ?><br></td>
  </tr> 
  <tr>
    <td class=pblock background="<?php echo $bgc ?>">&nbsp;<b><?php echo $LDWard_ID ?></b>:</td>
    <td class=pblock bgcolor="<?php echo $bgc2 ?>" colspan=2>&nbsp; <?php echo $ward['ward_id'] ?><br></td>
  </tr> 
  <tr>
    <td class=pblock colspan=3>&nbsp;</td>
  </tr> 
  <tr>
    <td class=pblock colspan=3><font face="Verdana, Arial" size=-1><?php echo $LDEnterAllFields ?></td>
  </tr> 

<?php 
$bgc=$root_path.'gui/img/skin/default/tableHeaderbg3.gif';
echo '<tr>
		<td background="'.$bgc.'"><font face="verdana,arial" size="2" >&nbsp;<b>'.$LDRoom.'</b></td>
		<td background="'.$bgc.'"><font face="verdana,arial" size="2" >&nbsp;<nobr><b>'.$LDBedNr.'</b></nobr></td>
		<td background="'.$bgc.'"><font face="verdana,arial" size="2" > <b>&nbsp; '.$LDRoomShortDescription.' &nbsp;</b></td>
		</tr>';
$toggle=0;
	for($i=$ward['room_nr_start'];$i<=$ward['room_nr_end'];$i++){
		if($toggle)	$trc='#dedede';
			else $trc='#efefef';
		$toggle=!$toggle;
		echo '
	<tr bgcolor="'.$trc.'">
    <td>&nbsp;<font face="Verdana, Arial" size=2>'.strtoupper($ward['roomprefix']).' '.$i.'&nbsp;&nbsp;&nbsp;
	</td> 
	<td>&nbsp;<font color="#ff0000"><b>*</b><input type="text" name="beds'.$i.'" size=2 maxlength=2 value="2">
     &nbsp;  
	</td> 
	<td>&nbsp; <input type="text" name="info'.$i.'" size=60 maxlength=100 value="">
	</td> 
	</tr>';
	}
?>
</table>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="ward_nr" value="<?php echo $ward['nr'] ?>">
<input type="hidden" name="mode" value="save_beds">
<input type="hidden" name="room_nr_start" value="<?php echo $ward['room_nr_start'] ?>">
<input type="hidden" name="room_nr_end" value="<?php echo $ward['room_nr_end'] ?>">
<p>
<input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0') ?>>
</form>
<p>
  <?php } ?>
  
 <font face="Verdana, Arial" size=2>

</FONT>

</ul>

<p>
</td>
</tr>
</table>        
<p>
<?php
require($root_path.'include/core/inc_load_copyrite.php');
?>
</BODY>
</HTML>
