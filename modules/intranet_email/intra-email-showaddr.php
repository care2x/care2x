<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.2 - 2006-07-10
* GNU General Public License
* Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','intramail.php');
$local_user='ck_intra_email_user';
require_once($root_path.'include/inc_front_chain_lang.php');
// check the info params for completeness
$addr=trim($addr);
if(!isset($mode)) $mode='';
if(!isset($addr)) $addr='';

if(($mode=='saveadd')&&($addr=='')) { header("location:intra-email-addrbook.php".URL_REDIRECT_APPEND); exit;}
require_once($root_path.'include/inc_config_color.php'); // load color preferences

$thisfile=basename(__FILE__);

$dbtable='care_mail_private_users';

$linecount=0;
$modetypes=array('sendmail','listmail');

$sql="SELECT addr_book, lastcheck FROM $dbtable WHERE  email='".$_COOKIE[$local_user.$sid]."'";

if($ergebnis=$db->Execute($sql))
{
	if($ergebnis->RecordCount())
	{
		$content=$ergebnis->FetchRow();

	} //end of if rows

}else { echo "$LDDbNoRead<br>$sql"; }


?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE><?php echo "$LDIntraEmail - $LDAddrBook" ?></TITLE>

 <script language="javascript" >
<!-- 
function applyAddr()
{
	var v;
	d=document.addrlist;
	odm=window.opener.document.mailform; 
	for(i=0;i<d.maxrow.value;i++)
	{
		eval("v=d.sel"+i)
 		if(v[0].checked)
		{
			if(odm.recipient.value=="") eval("odm.recipient.value=d.eaddr"+i+".value");
								else eval("odm.recipient.value=odm.recipient.value+'; '+d.eaddr"+i+".value");
		}
 		if(v[1].checked)
		{
			 if(odm.cc.value=="") eval("odm.cc.value=d.eaddr"+i+".value");
								else eval("odm.cc.value=odm.cc.value+'; '+d.eaddr"+i+".value");
		}
 		if(v[2].checked)
		{
			if(odm.bcc.value=="") eval("odm.bcc.value=d.eaddr"+i+".value");
								else eval("odm.bcc.value=odm.bcc.value+'; '+d.eaddr"+i+".value");
		}

	}
	d.reset();
}

function resit(d)
{

	for(i=0;i<3;i++)
	d[i].checked=false;
}


// -->
</script> 

<?php 
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?></HEAD>

<BODY bgcolor=<?php echo $cfg['body_bgcolor']; ?> topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 onLoad="if (window.focus) window.focus()" 
<?php 
 if (!$cfg['dhtml']){ echo ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>
<?php echo $test ?>
<?php //foreach($argv as $v) echo "$v "; ?>
<table width=100% border=0  cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" >
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG>&nbsp;<?php echo "$LDIntraEmail - $LDAddrBook" ?></STRONG></FONT></td>
</tr>

</table>   

<FONT face="Verdana,Helvetica,Arial" size=2>

 <?php
 
echo '
	<font color="#800000">&nbsp;'.$_COOKIE[$local_user.$sid].'</font>';
// ******************************** show address book***************************************

 	$arrlist=explode("_",strtolower($content[addr_book]));
	if($l2h) rsort($arrlist); else sort($arrlist); 
	reset($arrlist);
	$maxrow=sizeof($arrlist);
	if(($maxrow==1)&&($arrlist[0]=="")) $maxrow=0;
	
 	echo '</b>
		<form name="addrlist" action="intra-email-addrbook.php" method="post"  onSubmit="return chkDelete(this,'.sizeof($arrlist).')">
	';
	if ($maxrow>6) echo '&nbsp;
  	<input type="button" value="applyAddr()">
	<br>';
	echo '	<table border=0 cellspacing=0 width=100% cellpadding=0>
	<tr ><td  colspan=6 height=1><img src="'.$root_path.'gui/img/common/default/pixel.gif" border=0 height=3 width=1></td></tr>
     <tr bgcolor="#0060ae">
       <td>&nbsp;</td>
       <td><FONT face="Arial" size=1 color="#ffffff"><b>'.$LDTo.':</b><br>
           </td>
       <td><FONT face="Arial" size=1 color="#ffffff"><b>CC:</b><br>
           </td>
       <td><FONT face="Arial" size=1 color="#ffffff"><b>BCC:</b><br>
           </td>
       <td><FONT face="Verdana,Helvetica,Arial" size=2 >';
	   if($l2h) echo '<a href="'.$thisfile.''.URL_APPEND.'&l2h=0&mode='.$mode.'&folder='.$folder.'" title="'.$LDSortName.'"><img src="'.$root_path.'gui/img/common/default/arw_down.gif" '; else echo '<a href="'.$thisfile.''.URL_APPEND.'&l2h=1&mode='.$mode.'&folder='.$folder.'" title="'.$LDSortName.'"><img src="'.$root_path.'gui/img/common/default/arw_up.gif" ';
	   echo '
	   width=12 height=20 border=0 align=absmiddle alt="'.$LDSortName.'"><font color="#ffffff"> &nbsp;<b>'.$LDName.','.$LDFirstName.':</b></td>
       <td><FONT face="Verdana,Helvetica,Arial" size=2 color="#ffffff">&nbsp;&nbsp;<b>'.$LDAlias.'/'.$LDShortName.':
		</b></td>
		<td><FONT face="Verdana,Helvetica,Arial" size=2 color="#ffffff"> <b>'.$LDEmailAddr.':</b></font></a></td>
	        </tr>';
	for($i=0;$i<sizeof($arrlist);$i++)
	   {
	    parse_str(trim($arrlist[$i]),$minfo);
		//$buf="intra-email-read.php?sid=$sid&ua=$ck_intra_email_user&s_stamp=$minfo[t]&read=$minfo[r]&from=$minfo[f]&subj=".strtr($minfo[s]," ","+")."&date=".strtr($minfo[d]," ","+")."&size=$minfo[z]&l2h=$l2h&folder=$folder";
 		//$delbuf="n=$minfo[n]&a=$minfo[a]&e=$minfo[e]";
     	echo ' <tr bgcolor="#ffffff">
       		<td>&nbsp;</td>
			<td>	<input type="radio" name="sel'.$i.'" value="to"><br>
           	</td>
			<td>	<input type="radio" name="sel'.$i.'" value="cc"><br>
           	</td>
			<td>	<input type="radio" name="sel'.$i.'" value="bcc">&nbsp;<a href="javascript:resit(document.addrlist.sel'.$i.')" title="'.$LDJustReset.'"><img src="'.$root_path.'gui/img/common/default/redpfeil.gif" border=0 width=4 height=7 align="absmiddle"></a><br>
           	</td>
       		<td><FONT face="Verdana,Helvetica,Arial" size=1>&nbsp; &nbsp; &nbsp; <a href="#" title="'.$LDMoreInfo.'">'.ucwords($minfo[n]).'</a></td>
       		<td><FONT face="Verdana,Helvetica,Arial" size=1>&nbsp;&nbsp;'.$minfo[a].'</td>
       		<td><input type="hidden" name="eaddr'.$i.'" value="'.$minfo[e].'">
             <FONT face="Verdana,Helvetica,Arial" size=1>&nbsp;&nbsp;'.$minfo[e].'</td>
	    	</tr>
			<tr ><td bgcolor="#66aace" colspan=7 height=1><img src="'.$root_path.'gui/img/common/default/pixel.gif" border=0 height=1 width=1></td></tr>';
		}
	echo '
	<tr ><td  colspan=7 height=1><img src="'.$root_path.'gui/img/common/default/pixel.gif" border=0 height=3 width=1></td></tr>
	</table>';
	if($maxrow) echo '&nbsp;
		<input type="button" value="'.$LDTakeOver.'" onClick="applyAddr()">&nbsp; <input type="reset" value="'.$LDReset.'">
                                                                 ';
	echo '
		<br><input type="hidden" name="task" value="delete">
	<input type="hidden" name="maxrow" value="'.$maxrow.'">
	<input type="hidden" name="sid" value="'.$sid.'">
 	<input type="hidden" name="lang" value="'.$lang.'">
 	<input type="hidden" name="l2h" value="'.$l2h.'">
 	<input type="hidden" name="folder" value="'.$folder.'">
	<input type="hidden" name="mode" value="'.$mode.'">
 </form>	
	';

?>
  &nbsp; &nbsp;
   <font size=1><a href="javascript:window.close()" >
   <img <?php echo createComIcon($root_path,'l_arrowgrnsm.gif','0','middle') ?>> <?php echo $LDClose ?>
</a></font>
</FONT>
</BODY>
</HTML>
