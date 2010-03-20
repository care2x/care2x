<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
//if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
//require("../language/".$lang."/lang_".$lang."_drg.php");
require("../req/config-color.php");

$toggle=0;


$fielddata="diagnosis_code,description";

$keyword=trim($keyword);

if(($keyword)and($keyword!=" "))
  {
$dbhost="localhost";  //,,, format is "host:port" 
$dbname="drg";
$dbusername="httpd";
$dbpassword="";
$dbtable="icd10";

/***************** the ff: is to establish connection DO NOT EDIT ..................
  							the variable $DBLink_OK will be tested in the script to determine
							wether the link is established or not
***************************************************************************** */
 if ($link=mysql_connect($dbhost,$dbusername,$dbpassword))
 {
	if(mysql_select_db($dbname,$link)) 
	{	
		$DBLink_OK=1;
	}
	else $DBLink_OK=0; 
}


			$sql='SELECT '.$fielddata.' FROM '.$dbtable.' WHERE diagnosis_code LIKE "%'.$keyword.'%" OR description LIKE "%'.$keyword.'%" LIMIT 0,50';
        	$ergebnis=mysql_query($sql,$link);
			$linecount=0;
			if($ergebnis)
       		{
				while ($zeile=mysql_fetch_array($ergebnis)) $linecount++;
				
			}
			 else {print "<p>".$sql."<p>$LDDbNoRead";};

}

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <TITLE></TITLE>
 
  <script language="javascript">
<!-- 
function pruf(d)
{
	if((d.keyword.value=="")||(d.keyword.value==" ")) return false;
}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?=$lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
// -->
</script>
 
  <? 
require("../req/css-a-hilitebu.php");
?>
 
</HEAD>

<BODY  onLoad="document.searchdata.keyword.select();document.searchdata.keyword.focus();" bgcolor=<? print $cfg['body_bgcolor']; ?>
<? if (!$cfg['dhtml']){ print ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<FONT    SIZE=-1  FACE="Arial">
<ul>
<FORM action="drg-search-icd10.php" method="post" name="searchdata" onSubmit="return pruf(this)">
<font face="Arial,Verdana"  color="#000000" size=-1>
<input type="hidden" name="sid" value="<? print $ck_sid; ?>">
<B><?=$LDKeywordPrompt ?></B></font><p>
<font size=3><INPUT type="text" name="keyword" size="14" maxlength="40" onfocus=this.select() value="<? print $keyword ?>"></font> 
<INPUT type="submit" name="versand" value="<?=$LDSEARCH ?>"></FORM>

<p>
<a href="startframe.php?sid=<? print "$ck_sid&lang=$lang"; ?>"><img src="../img/<?="$lang/$lang" ?>_cancel.gif" width=103 height=24 border=0></a>
<p>

<?
			if ($linecount>0) 
				{ 
					print "".str_replace("~nr~",$linecount,$LDPhoneFound)."<p>";
					mysql_data_seek($ergebnis,0);
					print "<form><table border=0 cellpadding=1 cellspacing=1> <tr bgcolor=#0000aa>";

						print"<td></td><td><font face=arial size=2 color=#ffffff><b>ICD-10 Code</b></td>";
						print"<td><font face=arial size=2 color=#ffffff><b>Beschreibung</b></td>";
		
					print "</tr>";
					while($zeile=mysql_fetch_array($ergebnis))
					{
						print "<tr bgcolor=";
						if($toggle) { print "#efefef>"; $toggle=0;} else {print "#ffffff>"; $toggle=1;};
						print '<td><input type="checkbox" name="sel'.$i.'"></td>';
						for($i=0;$i<mysql_num_fields($ergebnis);$i++) 
						{
							print '<td><font face=arial size=2>';
							if($zeile[$i]=="")print "&nbsp;"; else print $zeile[$i];
							print "</td>";
						}
						print "</tr>";
					}
					print "</table></form>";
					if($linecount>15)
					{
						print '
						<p><font color=red><B>Neue Suche:</font>
						<FORM action="search-icd10.php" method="post" onSubmit="return pruf(this)" name="form2">
						<font face="Arial,Verdana"  color="#000000" size=-1>
						Suchbegriff eingeben. z.B. Name oder Abteilung, u.s.w.</B><p>
						<INPUT type="text" name="keyword" size="14" maxlength="25" value="'.$keyword.'"> 
						<INPUT type="submit" name="versand" value="'.$LDSEARCH.'"></font></FORM>
						<p>
						<FORM action="startframe.php" >
						<input type="hidden" name="sid" value="'.$ck_sid.'">
						<input type="hidden" name="lang" value="'.$lang.'">
      
						<INPUT type="submit"  value="'.$LDCancel.'"></FORM>
						<p>';
					}
				}


?>
</ul>
&nbsp;
</FONT>


</FONT>


</BODY>
</HTML>
