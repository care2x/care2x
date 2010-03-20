<?php 
if(($sid==NULL)||($sid!=$$ck_sid_buffer)) { header("location:invalid-access-warning.php"); exit;}

require_once($root_path.'include/inc_config_color.php');
require_once($root_path.'include/access_log.php');
$logs = new AccessLog();

srand(time()*1000);
$r=rand(1,1000);
$dbname="maho";

$allowedarea="System_Admin";

$fileforward="edv-datenbank.php";
$thisfile="edv-datenbank-pass.php";
$breakfile="edv.php";

if($_COOKIE['ck_login_logged'.$sid]&&$_COOKIE['ck_login_userid'.$sid])
{
 header("location: passcheck-intern.php?sid=$sid&lang=$lang&allowedarea=$allowedarea&fileforward=$fileforward&retfilepath=$thisfile");
 exit;
}
//setcookie(ck_edv_db_user,"");

function validarea($area,$zeile2,$range)
{
   for ($i=0;$i<$range;$i++)
      if(($zeile2[$i]==$area)or($zeile2[$i]=="alle")) return 1;
  return 0;
}


if ($versand=="Abschicken")
{

				$link=mysql_connect("localhost","httpd","");
				if ($link)
 				{ if(mysql_select_db($dbname,$link)) 
					{	$sql='SELECT * FROM mahopass WHERE mahopass_id="'.$userid.'"';
						$ergebnis=$db->Execute($sql);
						if($ergebnis)
							{$zeile=$ergebnis->FetchRow();
								if (($zeile[mahopass_password]==$keyword)&&($zeile[mahopass_id]==$userid))
								{	
									if (!($zeile[mahopass_lockflag]))
									{
										if (validarea($allowedarea,$zeile,mysql_num_fields($ergebnis)))
										{				
										setcookie(ck_edv_db_user,$zeile[mahopass_name]);	
										$logs->writeline(date('Y-m-d').'/'.date('H:i'),'',$REMOTE_ADDR,'EDV DB verwalten Access OK',$zeile[mahopass_name],'','',$thisfile,$fileforward,0);
										//logentry($zeile[mahopass_name],"*","IP:".$REMOTE_ADDR."EDV DB verwalten Access OK'd",$thisfile,$fileforward);
										header("Location: $fileforward?sid=$$ck_sid_buffer");
										exit;
										}else {$passtag=2;};
									}else $passtag=3;
								}else {$passtag=1;};
							}
							else {$passtag=1;};
	
					};
				
				}
				 else 
				{ echo "Verbindung zur Datenbank konnte nicht hergestellt werden.<br>"; $passtag=5;}
}


?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE>EDV - Datenbank Verwalten</TITLE>
 
 <?php if($cfg['dhtml'])
{ echo'
	<script language="javascript" src="../js/hilitebu.js">
	</script>
	
	 <STYLE TYPE="text/css">
	A:link  {text-decoration: none; color: '.$cfg['body_txtcolor'].';}
	A:hover {text-decoration: underline; color: '.$cfg['body_hover'].';}
	A:active {text-decoration: none; color: '.$cfg['body_alink'].';}
	A:visited {text-decoration: none; color: '.$cfg['body_txtcolor'].';}
	A:visited:active {text-decoration: none; color: '.$cfg['body_alink'].';}
	A:visited:hover {text-decoration: underline; color: '.$cfg['body_hover'].';}
	</style>';
}
?>
 
</HEAD>

<BODY  <?php if (!$nofocus) echo 'onLoad="document.passwindow.userid.focus()"'; echo  ' bgcolor='.$cfg['body_bgcolor']; 
 if (!$cfg['dhtml']){ echo ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } 
?>>

<p>
<FONT    SIZE=-1  FACE="Arial">

<P>
<FONT  COLOR=#cc6600  SIZE=5  FACE="verdana"> <b>Datenbank Verwalten</b></font>
<p>
<table width=100% border=0 cellpadding="0" cellspacing="0"> 
<tr>
<td colspan=3><img src=../img/einga-b.gif border=0  width=130 height=25><!-- <a href="op-pflege-logbuch-such-pass.php?sid=<?php echo $$ck_sid_buffer;?>"><img src="../img/such-gray.gif" border=0 width=130 height=25 <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="op-pflege-logbuch-arch-pass.php?sid=<?php echo $$ck_sid_buffer;?>"><img src="../img/arch-gray.gif" border=0 width=130 height=25 <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a> --></td>
</tr>

<tr>
<td bgcolor=#333399 colspan=3>
<FONT   SIZE=1  FACE="Arial"><STRONG>&nbsp;</STRONG></FONT>
</td>
</tr>

<tr bgcolor="#DDE1EC">
<td bgcolor=#333399><font size=1>&nbsp;</td>

<td>

<p><br>
<center>


<?php if ((($userid!=NULL)||($keyword!=NULL))&&($passtag!=NULL)) 
{
echo '<FONT  COLOR="red"  SIZE=+2  FACE="Arial"><STRONG>';

$errbuf="EDV - DB verwalten ";

switch($passtag)
{
case 1:$errbuf=$errbuf."Falsche Eingabe"; echo '<img src=../img/cat-fe.gif align=left>';break;
case 2:$errbuf=$errbuf."Keine Berechtigung"; echo '<img src=../img/cat-noacc.gif align=left>';break;
default:$errbuf=$errbuf."Zugang gesperrt"; echo '<img src=../img/warn.gif align=left>'; 
}


//logentry($userid,$keyword,$errbuf,$thisfile,$fileforward);


echo '</STRONG></FONT><P>';

}
?>

<table  border=0 cellpadding=0 cellspacing=0>
<tr>
<?php if(!$passtag) echo'
<td>

<img src="../img/ned2r.gif" border=0 width=100 height=138 >
</td>
';
?>
<td bgcolor="#999999" valign=top>

<table cellpadding=1 bgcolor=#999999 cellspacing=0>
<tr>
<td>
<table cellpadding=20 bgcolor=#eeeeee >
<tr>
<td>

<p>
<FORM action="<?php echo $thisfile; ?>" method="post" name="passwindow">

<font color=maroon size=3>
<b>Passwort ist erforderlich!</b></font><p>
<font face="Arial,Verdana"  color="#000000" size=-1>
Benutzername eingeben:<br></font>
<INPUT type="text" name="userid" size="14" maxlength="25"> <p>
<font face="Arial,Verdana"  color="#000000" size=-1>Passwort eingeben:</font><br>
<INPUT type="password" name="keyword" size="14" maxlength="25"> 
<input type="hidden" name="versand" value="Abschicken">
<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="image" src="../img/abschic.gif" border=0 width=110 height=24>
</font>
</FORM>

<FORM action="<?php echo $breakfile;?>"  name=cancelbut>
<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="image" src="../img/abbrech.gif" border=0 width=103 height=24>
                                                       </font></FORM>

</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>        

<p><br>

</center>

</td>
<td bgcolor=#333399><font size=1>&nbsp;</td>
</tr>

<tr >
<td bgcolor="#333399" colspan=3><font size=1>
&nbsp; 
</td>
</tr>


</table>        

<p>
<img src="../img/small_help.gif"> <a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>">Einführung in die SQL Datenbank.</a><br>
<img src="../img/small_help.gif"> <a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>">Wie mache ich was hier?</a><br>
<HR>
<p>

<?php
require($root_path.'include/inc_load_copyrite.php');
?>


</FONT>


</BODY>
</HTML>
