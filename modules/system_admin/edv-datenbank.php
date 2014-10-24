<?php if (($sid=="")or($sid==NULL)or($sid!=$$ck_sid_buffer)or($ck_edv_db_user==""))
{header("Location: invalid-access-warning.php"); exit;}

require_once($root_path.'include/core/inc_config_color.php');


//create unique id
$r=uniqid("");

//erase relevant cookies
setcookie(ck_edvzugang_user,"");
setcookie(ck_edvzugang_src,"");
setcookie(ck_edv_db_user,"");
setcookie(ck_edv_sql_user,"");
setcookie(ck_edv_sysadmin,"");

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE> EDV - Datenbank</TITLE>

<script language="javascript" >
<!-- 
function closewin()
{
	location.href='edv.php?sid=<?php echo $$ck_sid_buffer.'&uid='.$r;?>';
}
// -->
</script> 
 
<?php 
require($root_path.'include/core/inc_css_a_hilitebu.php');
?>
</HEAD>

<BODY  topmargin=0 leftmargin=0  marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>


<table width=100% border=0 cellspacing=0 height=100%>

<tr valign=top height=10>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" ><FONT  COLOR="<?php echo  $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG>&nbsp; &nbsp; EDV Datenbank mit Menuführung</STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<a href="#" onClick=history.back()><img src="../img/zuruck.gif" border=0 <?php if($cfg['dhtml'])echo'class="fadeOut" >';?></a>
<a href="#"><img src="../img/hilfe.gif" border=0  <?php if($cfg['dhtml'])echo'class="fadeOut" >';?></a>
<a href="startframe.php?sid=<?php echo $$ck_sid_buffer;?>"><img src="../img/fenszu.gif" border=0  <?php if($cfg['dhtml'])echo'class="fadeOut" >';?></a></td></tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2><p><br>
<ul><FONT 
                  face="Verdana,Helvetica,Arial" size=2>
			
<?php
$curtime=date("H.i");
if ($curtime<"9.00") echo "Guten Morgen ";
if (($curtime>"9.00")and($curtime<"18.00")) echo "Guten Tag ";
if ($curtime>"18.00") echo "Guten Abend ";
echo "$ck_edv_db_user!";

?>
				  

<p>
<a href="#">Neue Datenbank erstellen</a><br>
<a href="#">Neue Tabelle erstellen</a><br>
<a href="#">Neue Daten eingeben</a><br>
<a href="#">Vorhandene Daten aktualisieren</a><br>
<a href="#">Daten löschen</a><br>
<a href="#">Tabelle löschen</a><br>
<a href="#">Datenbank löschen</a><br>
<a href="#">Daten Suchen</a><p>
<a href="#" onClick=closewin()><img src="../img/close.gif" border=0  alt="Dieses Fenster schliessen." align="middle"></a>

<p>
</ul>

</FONT>

</td>
</tr>

<tr valign=top  >
<td bgcolor=<?php echo $cfg['bot_bgcolor']; ?> height=70 colspan=2>
<?php
require($root_path.'include/core/inc_load_copyrite.php');
?>
</td>
</tr>
</table>        
&nbsp;

</BODY>
</HTML>
