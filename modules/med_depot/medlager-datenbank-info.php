<?php if(($sid==NULL)||($sid!=$$ck_sid_buffer)) { header("location:invalid-access-warning.php"); exit;}
require_once($root_path.'include/core/inc_config_color.php');

$thisfile="medlager-datenbank-info.php";
$breakfile="medlager-datenbank-functions.php";

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE> Medicallager Datenbank - Information </TITLE>

 <script language="javascript" >
<!-- 
function closewin()
{
	location.href='apotheke.php?sid=<?php echo $$ck_sid_buffer.'&uid='.$r;?>';
}

function pruf(d)
{
	if(d.keyword.value=="")
	{
		d.keyword.focus();
		 return false;
	}
	return true;
}

// -->
</script> 

<?php 
require($root_path.'include/core/inc_js_gethelp.php');
require($root_path.'include/core/inc_css_a_hilitebu.php');
?></HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 onLoad="document.suchform.keyword.focus()"
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<a name="pagetop"></a>

<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="45">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> &nbsp; Medicallager Datenbank - Information</STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<!-- <a href="#" onClick=history.back(1)><img src="../img/zuruck.gif" border=0 <?php if($cfg['dhtml'])echo'class="fadeOut" >';?></a> -->
<a href="#"><img src="../img/hilfe.gif" border=0 width=93 height=41  <?php if($cfg['dhtml'])echo'class="fadeOut" >';?></a>
<a href="apotheke.php?sid=<?php echo $$ck_sid_buffer;?>"><img src="../img/fenszu.gif" border=0 width=93 height=41  <?php if($cfg['dhtml'])echo'class="fadeOut" >';?></a></td></tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2>
<ul>
<FONT face="Verdana,Helvetica,Arial" size=2>
<p><br>
  <form action="<?php echo $thisfile?>" method="get" name="suchform" onSubmit="return pruf(this)">
  <table border=0 cellspacing=2 cellpadding=3>
    <tr bgcolor=#ffffdd>
      <td colspan=2><FONT face="Verdana,Helvetica,Arial" size=2 color="#800000">Geben Sie den Suchbegriff ein.</font>
	  </td>
    </tr>
    <tr bgcolor=#ffffdd>
      <td align=right><FONT face="Verdana,Helvetica,Arial" size=2>Suchbegriff:</td>
      <td><input type="text" name="keyword" size=40 maxlength=40>
          </td>
    </tr>
   

    <tr >
      <td ><input type="submit" value="Suchen" >
           </td>
      <td align=right><input type="reset" value="Löschen" onClick="document.suchform.keyword.focus()">
                      </td>
    </tr>
  </table>
  <input type="hidden" name="sid" value="<?php echo $sid?>">
  <input type="hidden" name="mode" value="search">
  </form>
<hr>

<b>Anforderung für Reparatur<br>
Anmeldung eines Schaden<br>
Heizung<br>
Entsorgung<br>
EDV<br></b>
<ul>
	IP Addresse von Rechner<br>
	Drucker
</ul>
<b>Klimaanlage<br>
Reinigung<br>
Strom, Elektrizität<br>
Telefon<br>
Wasser, Versorgung</b>


<form action="<?php echo $breakfile?>" method="post" >
<input type="hidden" name="sid" value="<?php echo $sid?>">
<input  type="image" src="../img/abbrech.gif" border=0 width=103 height=24 alt="Zurück zu Datenbank Menuauswahl">
</form>
<?php if ($from=="multiple")
echo '
<form name=backbut onSubmit="<?php echo $breakfile ?>">
<input type="hidden" name="sid" value="<?php echo $sid?>">
<input type="submit" value="Zurück" onClick="history.back()">
</form>
';
?>
</ul>

</FONT>
<p>
</td>
</tr>

<tr>
<td bgcolor=<?php echo $cfg['bot_bgcolor']; ?> height=70 colspan=2>

<?php
require("../language/$lang/".$lang."_copyrite.php");

 ?>

</td>
</tr>
</table>        
&nbsp;




</FONT>


</BODY>
</HTML>
