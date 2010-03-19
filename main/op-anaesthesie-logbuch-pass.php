<?php 
$dbname="maho";
$allowedarea="OP";
$fileforward="op-anaesthesie-logbuch-pass.php";
$thisfile="op-anaesthesie-logbuch-pass.php";
$breakfile="op-doku.php";
$passtag=0;

setcookie(op_pflegelogbuch_user,"");

function validarea($area,$zeile2,$range)
{
   for ($i=0;$i<$range;$i++)
      if(($zeile2[$i]==$area)or($zeile2[$i]=="alle")) return 1;
  return 0;
}

//function logentry($userid,$key,$report,$remark1,$remark2)
/*{
			$logpath="logs/access/".date(Y)."/";
			if (file_exists($logpath))
			{
				$logpath=$logpath.date("d_m_Y").".log";
				$file=fopen($logpath,"a");
				if ($file)
				{	if ($userid=="") $userid="blank"; 
					$line=date("d.m.Y").'  '.date("H.i").'  '.$report.'  Username='.$userid.'  Password='.$key.'  Fileaccess='.$remark1.'  Fileforward='.$remark2;
					fputs($file,$line);fputs($file,"\r\n");
					fclose($file);
				}
			}
}*/


if ($versand=="Abschicken")
{

				$link=mysql_connect("localhost","httpd","");
				if ($link)
 				{ if(mysql_select_db($dbname,$link)) 
					{	$sql='SELECT * FROM mahopass WHERE mahopass_id="'.$username.'"';
						$ergebnis=$db->Execute($sql);
						if($ergebnis)
							{$zeile=$ergebnis->FetchRow();
								if (($zeile[mahopass_password]==$keyword)&&($zeile[mahopass_id]==$username))
								{	
									if (!($zeile[mahopass_lockflag]))
									{
										if (validarea($allowedarea,$zeile,mysql_num_fields($ergebnis)))
										{				
										setcookie(op_pflegelogbuch_user,$zeile[mahopass_name]);	
										//logentry($zeile[mahopass_name],"****","OP Pflege Logbuch Access OK'd",$thisfile,$fileforward);
										header("Location: ".$fileforward."?route=validroute");
										exit;
										}else {$passtag=2;};
									}else $passtag=3;
								}else {$passtag=1;};
							}
							else {$passtag=1;};
	
					};
				
				}
				 else 
				{ echo "Verbindung zur Datenbank konnte nicht hergestellt werden.<br>"; }
}


?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE>OP Pflege Logbuch</TITLE>
</HEAD>

<BODY BACKGROUND="leinwand.gif">


<FONT    SIZE=-1  FACE="Arial">

<P>
<img src="../img/monitor2.jpg">
<FONT  COLOR=#cc6600  SIZE=9  FACE="verdana"> <b>OP Anästhesie Logbuch</b></font>

<table width=100% border=0 cellpadding="0" cellspacing="0"> 
<tr>
<td colspan=3><img src=../img/einga-b.gif border=0></td>
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


<?php if (($username!="")or($keyword!='')&&($passtag)) 
{
echo '<FONT  COLOR="red"  SIZE=+2  FACE="Arial"><STRONG>';

$errbuf="OP Pflege Logbuch ";

switch($passtag)
{
case 1:$errbuf=$errbuf."Falsche Eingabe"; echo 'Sorry, aber Ihre Eingaben sind falsch. Versuchen Sie es noch ein mal.';break;
case 2:$errbuf=$errbuf."Keine Berechtigung"; echo 'Sie sind nicht berechtigt in den Bereich zu gehen!';break;
default:$errbuf=$errbuf."Zugang gesperrt"; echo 'Ihre Zugangsberechtigung ist gesperrt. Setzen Sie sich bitte mit der EDV in Verbindung.'; 
}



echo '</STRONG></FONT><P>';

}
?>

<table width=50% border=1 cellpadding="20">
<tr>
<td bgcolor="#ffffaa">
<p><br>
<FORM action="<?php echo $thisfile ?>" method="post" name="passwindow">
<INPUT type="hidden" name="usernum" value="861661832">
<INPUT type="hidden" name="cpv" value="1">
<font face="Arial,Verdana"  color="#000000" size=-1>
Benutzername eingeben:<br></font>
<INPUT type="text" name=username size="14" maxlength="25"> <p>
<font face="Arial,Verdana"  color="#000000" size=-1>Passwort eingeben:</font><br>
<INPUT type="password" name="keyword" size="14" maxlength="25"> 
<input type=hidden name=direction value="<?php echo $direction; ?>">
<input type=hidden name="versand" value="Abschicken">
<INPUT type="image"  src="../img/abschic.gif" border=0></font>

</FORM>

<script language="javascript">
<!-- 
   if(document.passwindow.username)
	
	document.passwindow.reset();
 document.passwindow.username.focus();
	
-->

</script>

<FORM action="<?php echo $breakfile ?>"  name=cancelbut>
<INPUT type="image"  src="../img/abbrech.gif" border=0></font></FORM>



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
<img src="../img/small_help.gif"> <a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>">Einführung in das OP Logbuch</a><br>
<img src="../img/small_help.gif"> <a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>">Wie mache ich was mit OP Logbuch?</a><br>
<HR>
<p>

<FONT    SIZE=1  FACE="Arial" color=gray>
Copyright © 2000 by Elpidio Latorilla<p>
All programs and scripts are not to be copied nor modified without permission from Elpidio Latorilla.<br>
If you want to use the scripts or some of the scripts for your own purposes
please contact Elpidio Latorilla at <a href=mailto:elpidio@care2x.org, >elpidio@care2x.org, </a>.
</FONT>


</FONT>


</BODY>
</HTML>
