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

$thisfile='intra-email-read.php';

$dbtable='care_mail_private';

//$db->debug=1;

$linecount=0;
$modetypes=array('sendmail','listmail');
$breakfile="intra-email.php".URL_APPEND."&mode=listmail";
		
		switch($folder)
		{
			case 'inbox':$sql="SELECT * FROM $dbtable WHERE  sender='$from'
																AND send_dt='$date'
																AND send_stamp='$s_stamp'"; break;
		 	case 'sent': $sql="SELECT * FROM $dbtable WHERE  recipient='$from'
																AND send_dt='$date'
																AND send_stamp='$s_stamp'"; break;
			default: $sql="SELECT * FROM $dbtable WHERE  ( sender='$from' OR recipient='$from' )
																AND send_dt='$date'
																AND send_stamp='$s_stamp'"; break;
		}
				if($ergebnis=$db->Execute($sql))
				{ 
					if($ergebnis->RecordCount())
					{
						$content=$ergebnis->FetchRow();
						// update user to tag the file as read
						if(!isset($read)||!$read)
						{
							$dbtable='care_mail_private_users';
							$sql="SELECT $folder, lastcheck FROM $dbtable WHERE  email='".$_COOKIE[$local_user.$sid]."'";
							if($ergebnis=$db->Execute($sql)) 
							{			
								if($ergebnis->RecordCount())
								{
									$result=$ergebnis->FetchRow();
									$inb=explode('_',trim($result[$folder]));
									for($i=0;$i<sizeof($inb);$i++)
									{
										$buf="t=$s_stamp&r=$read&f=$from&s=$subj&d=$date&z=$size";
										//echo "$buf<br>$inb[$i]<br>";
										if(!strcmp($buf,trim($inb[$i])))
											{	
												$inb[$i]=str_replace('r=0','r=1',$inb[$i]);
												$result[$folder]=implode('_',$inb);
									
												$sql="UPDATE $dbtable SET $folder='".$result[$folder]."', lastcheck='".$result[lastcheck]."'
																		WHERE email='".$_COOKIE[$local_user.$sid]."'";
								                $db->BeginTrans();
								                $ok=$db->Execute($sql);
								                if($ok){
												    $db->CommitTrans(); 
												} else { 
												    $db->RollbackTrans();
													echo "$LDDbNoUpdate<br>$sql"; 
												} 
											}
									}
								}
							}else { echo "$LDDbNoRead<br>$sql"; } 

						}// end of if !read
					} //end of if rows
					else
					{
						$mailok=0;
					}
				}else { echo "$LDDbNoRead<br>$sql"; } 
				
# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common');

# Title in toolbar
 $smarty->assign('sToolbarTitle',"$LDIntraEmail - $LDRead");

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('intramail.php','read','$mode','$folder')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('title',"$LDIntraEmail - $LDRead");

 # Collect extra javascript code

ob_start();
?>

<script language="javascript" >
<!-- 

function submitForm(r)
{
	d=document.mailform;
	d.reply.value=r;
	d.submit();
}

function printer_v()
{
<?php		$buf="&s_stamp=$content[send_stamp]&from=$content[sender]&date=".strtr($content['send_dt']," ","+")."&folder=$folder";
?>
	urlholder="intra-email-printer.php?sid=<?php echo "$sid&lang=$lang$buf"; ?>";
	<?php echo 'echowin'.$sid ?>=window.open(urlholder,"<?php echo 'echowin'.$sid ?>","width=700,height=600,menubar=no,resizable=yes,scrollbars=yes");
	//window.location.href=urlholder
	}
// -->
</script> 

<?php 

$sTemp = ob_get_contents();
ob_end_clean();

$smarty->append('JavaScript',$sTemp);

# Start buffering page output

ob_start();

?>

<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">

<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2>


<?php
if(!isset($mode)) $mode='';
 echo '
  &nbsp; <b><a href="intra-email.php'.URL_APPEND.'&mode=listmail">'.$LDInbox.'</a> | <a href="intra-email.php'.URL_APPEND.'&mode=compose">'.$LDNewEmail.'</a> | <a href="intra-email-addrbook.php'.URL_APPEND.'&mode='.$mode.'&folder='.$folder.'">'.$LDAddrBook.'</a> | <a href="intra-email-options.php'.URL_APPEND.'">'.$LDOptions.'</a> | <a href="javascript:gethelp(\'intramail.php\',\'read\',\''.$mode.'\',\''.$folder.'\')">'.$LDHelp.'</a></b>
  <hr color=#000080>
   &nbsp; <FONT  color="#800000">'.$_COOKIE[$local_user.$sid].'</font> &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
   <font size=1><a href="intra-email.php'.URL_APPEND.'&mode=listmail&l2h='.$l2h.'&folder='.$folder.'">
   <img '.createComIcon($root_path,'l_arrowgrnsm.gif','0','middle').'> '.$LDBack2.' ';
switch($folder)
{
		case 'inbox': echo $LDInbox; break;
		case 'sent': echo $LDSent; break;
		case 'drafts': echo $LDDrafts; break;
		case 'trash': echo $LDRecycle; break;
}
echo '</a></font>';
// ******************************** Read email ***************************************
if(1)
{
echo '<ul><form name="mailform" action="intra-email.php" method="post">  
	<table border=0 cellspacing=1 cellpadding=3>
    <tr>
      <td bgcolor="#f9f9f9" align=right><FONT size=1 color="#000080">'.$LDFrom.':</td>
      <td   bgcolor="#f9f9f9"><FONT size=1 >'.$content['sender'].'
          </td>
    </tr>
    <tr>
      <td bgcolor="#f9f9f9" align=right><FONT size=1 color="#000080">'.$LDReply2.':</td>
      <td   bgcolor="#f9f9f9"><FONT size=1 >'.$content['reply2'].'
          </td>
    </tr>
    <tr>
      <td bgcolor="#f9f9f9" align=right><FONT size=1 color="#000080">'.$LDTo.':</td>
      <td   bgcolor="#f9f9f9"><FONT size=1 >'.$content['recipient'].'
          </td>
    </tr>
      <td bgcolor="#f9f9f9" align=right><FONT size=1 color="#000080">'.$LDCC.' (CC)</td>
      <td  bgcolor="#f9f9f9"><FONT size=1 >'.$content['cc'].'</td>
    </tr>
    <tr>
      <td bgcolor="#f9f9f9" align=right><FONT size=1 color="#000080">'.$LDBCC.' <a href="#" title="'.$LDBCCTxt.'"><font color=#0000ff><u>(BCC)</u></font></a></td>
      <td  bgcolor="#f9f9f9"><FONT size=1 >'.$content['bcc'].'</td>
    </tr>
    <tr>
      <td bgcolor="#f9f9f9" align=right><FONT size=1 color="#000080">'.$LDSubject.':</td>
      <td  bgcolor="#f9f9f9"><FONT size=1 >'.$content['subject'].'</td>
    </tr>';
	/*
    <tr>
      <td bgcolor="#f9f9f9" align=right><FONT size=1 color="#000080">Anhang:</td>
      <td  bgcolor="#f9f9f9"><FONT size=1 color="#000080"><a href="#">Zeigen <img src="../img/bul_arrowgrnsm.gif" width=12 height=12 border=0 align=absmiddle></a></td>
    </tr>
	*/
echo '
  </table>
 	 <input type="hidden" name="sid" value="'.$sid.'">
    <input type="hidden" name="lang" value="'.$lang.'">
    <input type="hidden" name="mode" value="compose">
  <input type="hidden" name="recipient" value="'.$content['recipient'].'">
  <input type="hidden" name="sender" value="'.$content['sender'].'">
  <input type="hidden" name="reply2" value="'.$content['reply2'].'">
  <input type="hidden" name="send_dt" value="'.$content['send_dt'].'">
  <input type="hidden" name="send_stamp" value="'.$content['send_stamp'].'">
  <input type="hidden" name="folder" value="'.$folder.'">
  <input type="hidden" name="reply" value="0">';

  switch($folder)
  {
  	case 'inbox': if($_COOKIE[$local_user.$sid]!=$content['sender']) 
							{ $inp=0; echo '<input type="button" value="'.$LDReply.'" onClick="submitForm(1)"> '; break; }
								else echo '<input type="button" value="'.$LDBack.'" onClick="window.location.href=\'intra-email.php'.URL_REDIRECT_APPEND.'&mode=listmail&folder=inbox&l2h='.$l2h.'\'"> '; break;
  	case 'sent': if($_COOKIE[$local_user.$sid]!=$content['recipient'])
							{ $inp=1; echo '<input type="button" value="'.$LDResend.'" onClick="submitForm(2)"> ';break; }
								else  echo '<input type="button" value="'.$LDBack.'" onClick="window.location.href=\'intra-email.php'.URL_REDIRECT_APPEND.'&mode=listmail&folder=sent&l2h='.$l2h.'\'"> '; break;
  	case 'drafts':$inp=1; echo '
 								 <input type="button" value="'.$LDNewEmail.'" onClick="submitForm(2)"> '; break;
  	case 'trash':if($_COOKIE[$local_user.$sid]!=$content['recipient'])
						{	$inp=1; echo ' <input type="button" value="'.$LDResend.'" onClick="submitForm(2)"> '; 	break;}
									else { $inp=0; echo '  <input type="button" value="'.$LDReplyAgain.'" onClick="submitForm(1)"> ';} break;
   }
 $buf="&t=$s_stamp&r=$read&f=$from&s=".strtr($subj," ","+")."&d=".strtr($date," ","+")."&z=$size";
 if($folder!="drafts") echo '
    <input type="button" value="'.$LDForward.'" onClick="submitForm(3)"> ';
		$buf="&t=$s_stamp&r=$read&f=$from&s=".strtr($subj," ","+")."&d=".strtr($date," ","+")."&z=$size";
 echo '
	<input type="button" value="'.$LDDelete.'" onClick="if(confirm(\''.$LDAskDeleteMail.'\')) window.location.href=\'intra-email-delete.php'.URL_REDIRECT_APPEND.'&maxrow=1&create=1&folder='.$folder.'&l2h='.$l2h.$buf.'\';">';
 echo '
	 &nbsp; &nbsp; &nbsp; <a href="javascript:printer_v()" title="'.$LDClk4printer.'">'.$LDPrinterVersion.' <img '.createComIcon($root_path,'bul_arrowgrnsm.gif','0','bottom').'></a>	
	
  </form>
  </ul>
  ';
}
 
?>
  

<p>
</td>
</tr>
<tr>
<td bgcolor="#ffffee"  colspan=2 height=50% valign=top>
<UL><p><br><pre>
<?php
echo nl2br($content['body']);
?>
</pre>
</ul>
</td>
</tr>
</table>

<?php

 $sTemp = ob_get_contents();
 ob_end_clean();

 # Assign to main template object
	$smarty->assign('sMainFrameBlockData',$sTemp);

 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');

?>
