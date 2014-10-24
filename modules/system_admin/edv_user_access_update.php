<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
define('LANG_FILE','edp.php');
$local_user='ck_edv_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');

require_once($root_path.'include/core/inc_config_color.php');

/**
* The following require loads the access areas that can be assigned for
* user permissions.
*/
require($root_path.'include/core/inc_accessplan_areas_functions.php');

$breakfile="edv.php?sid=".$sid."&lang=".$lang;

?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">

<?php html_rtl($lang); ?>
	<HEAD>
<?php echo setCharSet(); ?>
<?php 
require($root_path.'include/core/inc_css_a_hilitebu.php');
?>
<script language="javascript">
<!-- 

function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="<?php echo $root_path; ?>help-router.php<?php echo URL_REDIRECT_APPEND ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
// -->
</script>
	</HEAD>

	<BODY topmargin=0 leftmargin=0 marginheight=0 marginwidth=0 bgcolor=<?php echo $cfg['bot_bgcolor']?>>


	<table width=100% border=0 cellspacing=0 >
	<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="45"><FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> &nbsp; <?php echo "$LDEDP $LDUpdateRight" ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  class="fadeOut" >';?></a><a href="javascript:gethelp('edp.php','access','update')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'class="fadeOut" >';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDClose ?>"  <?php if($cfg['dhtml'])echo'class="fadeOut" >';?></a></td>
</tr>
	<tr bgcolor="<?php echo $cfg['body_bgcolor']?>">
	<td colspan=2><p><br>
	<ul>
<?php
// initialize error flags
$error=0;
$errorname=0;
$erroruser=0;
$errorpass=0;
$errorbereich=0;

// get date and time 

$curdate=date('Y-m-d');
$curtime=date('H:i:s');

/* Establish db connection */
if(!isset($db)||!$db) include($root_path.'include/core/inc_db_makelink.php');
if($dblink_ok)
{	

    if ($mode=='save')
 	{
	//remove spaces
	$username=trim(strtr($username,"+"," "));
	$userid=trim($userid);
	$pass=trim($pass);	

	// start checking input data for errors
	if ($username==""){ $error=1; $errorname=1;};
	if ($userid==""){$error=1; $erroruser=1;};
	if ($pass==""){$error=1; $errorpass=1;};
	if (($bereich1=="")and($bereich2=="")and($bereich3=="")and
		($bereich4=="")and($bereich5=="")and($bereich6=="")and($bereich7==""))
		{ $error=1; $errorbereich=1;};

	if($error==0) 
	{	
		echo "<table bgcolor=#dddddd border=1 cellpadding=10 cellspacing=1>
				<tr>
				<td colspan=3><FONT    SIZE=-1  FACE=Arial>";
				
				//include('../include/core/inc_db_makelink.php');
	
						$sql='UPDATE care_users SET  
								login_id="'.$userid.'", 
								password="'.$pass.'", 
								area1="'.$bereich1.'", 
								area2="'.$bereich2.'", 
								area3="'.$bereich3.'", 
								area4="'.$bereich4.'", 
								area5="'.$bereich5.'", 
								area6="'.$bereich6.'", 
								area7="'.$bereich7.'", 
								area8="'.$bereich8.'", 
								area9="'.$bereich9.'", 
								area10="'.$bereich10.'", 
								s_date="'.$curdate.'", 
								s_time="'.$curtime.'",
								modify_id="'.$_COOKIE[$local_user.$sid].'"  
							WHERE name="'.$username.'"';

						if($db->Execute($sql))
						{ 
						echo mysql_affected_rows()." $LDDataSaved <p>"; 
						echo $LDAccessIndex[0].": ".$username."<br>";
						echo $LDAccessIndex[1].": ".$userid."<br>";
						echo $LDAccessIndex[2].": ".$pass."<br>";
						echo $LDAccessIndex[4].": <br>";
						if($bereich1!="") echo "$LDArea  1: ".$bereich1."<br>";
						if($bereich2!="") echo "$LDArea  2: ".$bereich2."<br>";
						if($bereich3!="") echo "$LDArea  3: ".$bereich3."<br>";
						if($bereich4!="") echo "$LDArea  4: ".$bereich4."<br>";
						if($bereich5!="") echo "$LDArea  5: ".$bereich5."<br>";
						if($bereich6!="") echo "$LDArea  6: ".$bereich6."<br>";
						if($bereich7!="") echo "$LDArea  7: ".$bereich7."<br>";
						if($bereich8!="") echo "$LDArea  8: ".$bereich8."<br>";
						if($bereich9!="") echo "$LDArea  9: ".$bereich9."<br>";
						if($bereich10!="") echo "$LDArea  10: ".$bereich10."<br>";

						}
							else { echo "$LDDbNoSave<br>$sql"; } 

		echo '</td>
				</tr>
				</table>
				<FONT    SIZE=-1  FACE=Arial>
				<p>
				<FORM method="get" action="edv_user_access_edit.php">
				<input type="hidden" name="sid" value="'.$sid.'">
				<input type="hidden" name="lang" value="'.$lang.'">
				<INPUT type="submit"  value="'.$LDOK.'"></font></FORM>
				<p>
				<FORM method="get" action="edv_user_access_list.php">
				<input type="hidden" name="sid" value="'.$sid.'">
				<input type="hidden" name=lang value="'.$lang.'">
				<INPUT type="submit"  value="'.$LDListActual.'"></font></FORM>
				<p>
				</FONT>';

     	};

 	}
 	else
	 {
 						$sql='SELECT * FROM care_users WHERE login_id="'.$itemname.'"';
						$ergebnis=$db->Execute($sql);
						if($ergebnis)
							 {
								$zeile=$ergebnis->FetchRow();
								$username=$zeile['name'];
								if ($mode!='save')
								 {
								$userid=$zeile['login_id'];
								$pass=$zeile['password'];
								$bereich1=$zeile['area1'];
								$bereich2=$zeile['area2'];
								$bereich3=$zeile['area3'];
								$bereich4=$zeile['area4'];
								$bereich5=$zeile['area5'];
								$bereich6=$zeile['area6'];
								$bereich7=$zeile['area7'];
								$bereich8=$zeile['area8'];
								$bereich9=$zeile['area9'];
								$bereich10=$zeile['area10'];
								}
							};	
	}
}
  else { echo "$LDDbNoLink<br>$sql"; } 
 
?>


<?php if ($error==1)
{
echo "<FONT  COLOR=red  SIZE=+1  FACE=Arial>$LDInputError<p>";
}

?>


<?php if ((($error==1)and($mode=='save'))or(($error==0)and($mode==""))) :; ?>

<form method="post" action="edv_user_access_update.php">
<table border=0 cellpadding=0 cellspacing=0 bgcolor=#666666>
<tr><td>

<table border="0" cellpadding="5" cellspacing="1">
<tr bgcolor="#dddddd">
<td>

<FONT    SIZE=-1  FACE="Arial" color=#000080>
<?php echo $LDName ?>: 
<font color=#800000>
<br>
<?php
 echo " ".$username;
 echo "<input type=hidden name=username value=".strtr($username," ","+").">";
?>

<br>
</td>
<td><FONT    SIZE=-1  FACE="Arial" color=#000080>
<?php if ($erroruser) {echo "<font color=red > <b>$LDUserId</b>";} 
else { echo $LDUserId;} ?>
<br>
<input type=text name=userid
<?php if ($userid!="") echo "value=".$userid ; ?>
><br>
</td>
<td><FONT    SIZE=-1  FACE="Arial" color=#000080>
<?php if ($errorpass) {echo "<font color=red > <b>$LDPassword</b>";} 
else { echo $LDPassword;} ?>
<br>
<input type=text name=pass
<?php if ($pass!="") echo "value=".$pass ; ?>
><br>
</td>
</tr>
<tr bgcolor="#dddddd">
<td  colspan=3><FONT    SIZE=-1  FACE="Arial"  color=#000080>
<?php if ($errorbereich) {echo "<font color=red > <b>$LDAllowedArea</b> </font>";} 
else { echo $LDAllowedArea;} ?>
</td>
</tr>
<tr bgcolor="#dddddd">
<td valign=top><FONT    SIZE=-1  FACE="Arial" color=#000080>
<p>
<?php echo $LDArea ?> 1:
<select name=bereich1 size=1>
<?php createselecttable($bereich1) ?>
</select>
<p>
<?php echo $LDArea ?> 2:
<select name=bereich2 size=1>
<?php createselecttable($bereich2) ?>
</select>
<p>
<?php echo $LDArea ?> 3:
<select name=bereich3 size=1>
<?php createselecttable($bereich3) ?>
</select>
<p>
<?php echo $LDArea ?> 4:
<select name=bereich4 size=1>
<?php createselecttable($bereich4) ?>
</select>
<p>
<?php echo $LDArea ?> 5:
<select name=bereich5 size=1>
<?php createselecttable($bereich5) ?>
</select>
<br>
</td>
<td valign=top><FONT    SIZE=-1  FACE="Arial" color=#000080>
<p>
<?php echo $LDArea ?> 6:
<select name=bereich6 size=1>
<?php createselecttable($bereich6) ?>
</select>
<p>
<?php echo $LDArea ?> 7:
<select name=bereich7 size=1>
<?php createselecttable($bereich7) ?>
</select>
<p>
<?php echo $LDArea ?> 8:
<select name=bereich8 size=1>
<?php createselecttable($bereich8) ?>
</select>
<p>
<?php echo $LDArea ?> 9:
<select name=bereich9 size=1>
<?php createselecttable($bereich9) ?>
</select>
<p>
<?php echo $LDArea ?> 10:
<select name=bereich10 size=1>
<?php createselecttable($bereich10) ?>
</select>
<br>
</td>
<td  valign="top"><FONT    SIZE=1  FACE="verdana,Arial">
<font color=#000080 size=2><?php echo $LDAllowedArea ?>:</font><p>
<font size=2>
<?php 
/** 
* The following line calls the function contained in core/inc_accessplan_areas_functions.php
*/
printAccessAreas();
?>

</td>
</tr>
<tr bgcolor="#dddddd">
<td colspan=3><FONT    SIZE=-1  FACE="Arial">
<p>
<input type="hidden" name="itemname" value="<?php echo $itemname ?>">
<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="mode" value="save">
<input type="submit" value="<?php echo $LDSave ?>"> &nbsp;
<input type="reset"  value="<?php echo $LDReset ?>">
</td>
</tr>

</table>
</td></tr>
</table>
</form>

<p>
<FORM method=get action="edv_user_access_list.php" >
<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<INPUT type="submit"  value="<?php echo $LDCancel ?>"></font></FORM>
<p>
</FONT>

<?php endif; ?>


</ul>
<p>
</td>
</tr>
</table>        
<p>

<?php
require($root_path.'include/core/inc_load_copyrite.php');
?>

</FONT>


</BODY>
</HTML>
