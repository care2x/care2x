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
require_once($root_path.'include/inc_config_color.php'); // load color preferences

$thisfile=basename(__FILE__);
$breakfile='intra-email.php.'.URL_APPEND.'&mode=listmail';

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>

 <script language="javascript" >
<!-- 

function submitForm(r)
{
	d=document.mailform;
	d.reply.value=r;
	d.submit();
}

function echoer_v()
{
<?php		$buf="&s_stamp=".$content['send_stamp']."&from=".$content['sender']."&date=".strtr($content['send_dt']," ","+")."&folder=$folder";
?>
	urlholder="intra-email-echoer.php<?php echo URL_REDIRECT_APPEND.$buf; ?>";
	echowin=window.open(urlholder,"echowin","width=700,height=600,menubar=no,resizable=yes,scrollbars=yes");
	//window.location.href=urlholder
	}
// -->
</script> 

<?php 
require_once($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>

</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>
<?php echo $test ?>
<?php //foreach($argv as $v) echo "$v "; ?>
<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="30"><FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> <?php echo "$LDIntraEmail - $LDOptions" ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align=right><a href="javascript:history.back();"><img <?php echo createLDImgSrc($root_path,'back2.gif','0','absmiddle') ?> style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a><a href="javascript:gethelp()"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0','absmiddle') ?> style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a><a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0','absmiddle') ?> style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2>

<FONT face="Verdana,Helvetica,Arial" size=2>
<?php
 echo '
<FONT face="Verdana,Helvetica,Arial" size=2>
  &nbsp; <b><a href="intra-email.php'.URL_APPEND.'&mode=listmail">'.$LDInbox.'</a> | 
  <a href="intra-email.php'.URL_APPEND.'&mode=compose">'.$LDNewEmail.'</a> | 
  <a href="intra-email-addrbook.php'.URL_APPEND.'&mode='.$mode.'&folder='.$folder.'">'.$LDAddrBook.'</a> | 
  <a href="javascript:gethelp()">'.$LDHelp.'</a>| 
  <a href="intra-email-pass.php'.URL_APPEND.'">'.$LDLogout.'</a></b>
  <hr color=#000080>
   &nbsp; <FONT  color="#800000">'.$_COOKIE[$local_user.$sid].'</font>
   ';
/* echo '
<FONT face="Verdana,Helvetica,Arial" size=2>
  &nbsp; <b><a href="intra-email.php'.URL_APPEND.'&mode=listmail">'.$LDInbox.'</a> | 
  <a href="intra-email.php'.URL_APPEND.'&mode=compose">'.$LDNewEmail.'</a> | 
  <a href="intra-email-addrbook.php'.URL_APPEND.'&mode='.$mode.'&folder='.$folder.'">'.$LDAddrBook.'</a> | '.$LDOptions.' | 
  <a href="javascript:gethelp()">'.$LDHelp.'</a>| 
  <a href="intra-email-pass.php'.URL_APPEND.'">'.$LDLogout.'</a></b>
  <hr color=#000080>
   &nbsp; <FONT  color="#800000">'.$_COOKIE[$local_user.$sid].'</font>
   ';
*/   
// ******************************** Read email ***************************************
 
?>
  <p>
  <table border=0 cellpadding=5 >
    <tr>
      <td >&nbsp;</td>
      <td bgcolor="#0066aa"><FONT face="Verdana,Helvetica,Arial" size=2 color="#ffffff"><b><?php echo $LDUrInfo ?></b></td>
      <td >&nbsp;</td>
      <td bgcolor="#0066aa"><FONT face="Verdana,Helvetica,Arial" size=2 color="#ffffff"><b><?php echo $LDEmailProc ?></b></td>
    </tr>
    <tr>
      <td></td>
      <td valign=top><FONT face="Verdana,Helvetica,Arial" size=2 ><a href="#"><b><?php echo $LDProfile ?></b></a><br>
	  		&nbsp;<?php echo $LDProfileTxt ?><p>
			<a href="#"><b><?php echo $LDPassword ?></b></a><br>
			&nbsp; <?php echo $LDPasswordChange ?><p>
			<a href="#"><b><?php echo $LDSecretQ ?></b></a><br>
			&nbsp;<?php echo $LDSecretQChange ?><p>
			<a href="#"><b><?php echo $LDMemberDir ?></b></a><br>
			&nbsp;<?php echo $LDMemberDirTxt ?></td>
      <td></td>
      <td valign=top><FONT face="Verdana,Helvetica,Arial" size=2 ><a href="#"><b><?php echo $LDReply2 ?>:</b></a><br>
	  		&nbsp;<?php echo $LDReply2Txt ?><p>
			<a href="#"><b><?php echo $LDEmailAddr ?></b></a><br>
			&nbsp;<?php echo $LDEmailAddrChange ?><p>
			<a href="#"><b><?php echo $LDSignature ?></b></a><br>
			&nbsp;<?php echo $LDSignatureTxt ?></td>
    </tr>
  </table>
  
</FONT>
<p>
</td>
</tr>
<tr>
<td bgcolor=<?php echo $cfg['bot_bgcolor']; ?>  colspan=2>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</td>
</tr>
</table>        
&nbsp;
</FONT>
</BODY>
</HTML>
