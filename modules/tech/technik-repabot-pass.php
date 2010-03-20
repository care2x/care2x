<?php 
if(($sid==NULL)||($sid!=$$ck_sid_buffer)) { header("location:invalid-access-warning.php"); exit;}

require_once($root_path.'include/inc_config_color.php');

srand(time()*1000);
$r=rand(1,1000);
$dbname="maho";
$allowedarea="System_Admin";
$fileforward="technik.php";
$thisfile="technik-repabot-pass.php";
$breakfile="technik.php";

require($root_path."include/inc_passcheck_f2f.php"); // loads the validarea and logentry functions

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
										setcookie(ck_technik_repabot_user,$zeile[mahopass_name]);	
										setcookie(ck_technik_repabot_src,"repabotpass");	
										//logentry($zeile[mahopass_name],"*","IP:".$REMOTE_ADDR."Technik Repabot Launch OK'd",$thisfile,$fileforward);
										header("Location: $fileforward?sid=$sid&stb=1");
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
 <TITLE>Repabot Aktivieren</TITLE>
 
 <?php 
require($root_path.'include/inc_css_a_hilitebu.php');
?>
 
</HEAD>

<BODY  <?php if (!$nofocus) echo 'onLoad="document.passwindow.userid.focus()"'; echo  ' bgcolor='.$cfg['body_bgcolor']; 
 if (!$cfg['dhtml']){ echo ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } 
?>>

<p>
<FONT    SIZE=-1  FACE="Arial">

<P>
<FONT  COLOR=#cc6600  SIZE=5  FACE="verdana"> <b>Repabot Aktivieren</b></font>
<p>
<table width=100% border=0 cellpadding="0" cellspacing="0"> 
<tr>
<td colspan=3><FONT   SIZE=2  FACE="verdana,Arial">Dieser Bereich ist passwortgeschützt!<br></td>
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

$errbuf="Apotheke Bestellung ";

switch($passtag)
{
case 1:$errbuf=$errbuf."Falsche Eingabe"; echo '<img src=../img/cat-fe.gif >';break;
case 2:$errbuf=$errbuf."Keine Berechtigung"; echo '<img src=../img/cat-noacc.gif >';break;
default:$errbuf=$errbuf."Zugang gesperrt"; echo '<img src=../img/cat-sperr.gif >'; 
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
<img <?php echo createComIcon($root_path,'small_help.gif','0') ?>> <a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>">Was ist der Bestellbot?.</a><br>
<img <?php echo createComIcon($root_path,'small_help.gif','0') ?>> <a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>">Was kann der Bestellbot?</a><br>
<HR>
<p>

<?php
// write the copyright thing
require($root_path."include/inc_copyrite.php");
 ?>


</FONT>


</BODY>
</HTML>
