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

//$db->debug=1;

/**
* The getMailNum() function counts the number of mails in different boxes (inbox,sent,drafts,trash)
*
* param $element = element name (the box being checked)
* param $username = email address to be searched
*
* global $link = the database link handle created by the inc_db_makelink.php include
* global $dbtable = the table for the mailboxes
*
* return = number of mails in the box
*/
function getMailNum($element_name,$username)
{
	global $db; // the db connection object created with ADODB
	global $dbtable;
	
    $sql="SELECT $element_name FROM $dbtable WHERE  email='".addslashes($username)."'";
	if($ergebnis=$db->Execute($sql)) {
        if($ergebnis->RecordCount()) {
            $cont=$ergebnis->FetchRow();
            $bufa=explode('_',$cont[$element_name]);
            if((sizeof($bufa)==1)&&($bufa[0]=='')) return 0; else return sizeof($bufa);
        }
    } else { return 0;}
}

/**
* Set some initial values
*/
$thisfile=basename(__FILE__);

if(!isset($folder)) $folder='inbox';
if(!isset($mode)) $mode='';

//init db parameters
$dbtable='care_mail_private';
$breakfile='intra-email-pass.php'.URL_APPEND;

$linecount=0;
$modetypes=array('sendmail','listmail','compose');

/* Load the date formatter */
require_once($root_path.'include/inc_date_format_functions.php');



if(in_array($mode,$modetypes)) 
{
    if(!isset($db) || !$db) include_once($root_path.'include/inc_db_makelink.php');
    if($dblink_ok) {	
					// sendmail (save to db) module
		switch($mode)
		{
			case 'sendmail';
			{
						$uid=uniqid('');
						$sdate=date('YmdHis');
						$sql="INSERT INTO $dbtable
						(	recipient,
							sender,
							sender_ip,
							cc,
							bcc,
							subject,
							body,
							sign,
							ask4ack,
							reply2,
							attachment,
							attach_type,
							read_flag,
							mailgroup,
							maildir,
							exec_level,
							exclude_addr,
							send_dt,
							send_stamp,
							uid
							 ) 
						VALUES (
							'$recipient',
							'".$_COOKIE[$local_user.$sid]."',
							'$REMOTE_ADDR',
							'$cc', 
							'$bcc', 
							'$subject',
							'".htmlspecialchars($body_txt)."',
							'',
							'$ack', 
							'".$_COOKIE[$local_user.$sid]."', 
							'', 
							'', 
							'0', 
							'', 
							'', 
							'1', 
							'',
							'".date('Y-m-d H:i:s')."',
							'".date('Y-m-d H:i:s')."',
							'$uid'
							)";
					  /// the send_stamp is left out to force its auto update

						$db->BeginTrans();
						$ok=$db->Execute($sql);
						if($ok&&$db->CommitTrans())
						{ 						
							$saveok=true;
							$sendok=1;
						//	if($folder=="inbox") $folder="sent";
							//echo "q ok ".$sql;
							$dbtable='care_mail_private_users';
							$sql="SELECT $folder, lastcheck FROM $dbtable WHERE email='".$_COOKIE[$local_user.$sid]. "'";
							if($ergebnis=$db->Execute($sql))
							{
								$content=$ergebnis->FetchRow();
								if(strlen($subject)>30) $sub=substr($subject,0,30).'...';
									else $sub=$subject;
								$buf="t=".date('Y-m-d H:i:s')."&r=1&f=$recipient&s=$sub&d=".date('Y-m-d H:i:s')."&z=".strlen($body_txt)."&u=$uid\r\n";
								if($content[$folder]=='') $content[$folder]=$buf;
									else  $content[$folder].='_'.$buf;
								if(empty($content['lastcheck'])) $content['lastcheck']='0001-01-01 00:00:00';
								$sql="UPDATE $dbtable SET $folder='".$content[$folder]."' , lastcheck='".$content['lastcheck']."'
																WHERE email='".$_COOKIE[$local_user.$sid]. "'";
							    $db->BeginTrans();
						        $ok=$db->Execute($sql);
						        if($ok&&$db->CommitTrans()) { 
								    //echo "$LDDbNoUpdate<br>$sql"; 
						        }else { 
							        $db->RollbackTrans();
						            echo "$LDDbNoSave<br>$sql"; 
						        } 
							}else { 
								echo "$LDDbNoRead<br>$sql"; 
							} 
						}else { 
							$db->RollbackTrans();
						    echo "$LDDbNoSave<br>$sql"; 
						} 
						break;
			}// end of sendmail module
			
			case 'listmail':
			{
				// set dbtable to users
				$dbtable='care_mail_private_users';
				// get the last check timestamp
				$sql="SELECT $folder, lastcheck FROM $dbtable WHERE email='".$_COOKIE[$local_user.$sid]."'";
				
				if($ergebnis=$db->Execute($sql))
				{ 
					if($ergebnis->RecordCount())
					{
					  $content=$ergebnis->FetchRow();
					  
					  if($folder=='inbox')
					  {
						// if last check time stamp found check for  new mails
						$dbtable='care_mail_private';
						if(empty($content['lastcheck'])) $content['lastcheck']=DBF_NODATETIME;
						$sql="SELECT * FROM $dbtable WHERE ( recipient $sql_LIKE '%".$_COOKIE[$local_user.$sid]."%'
																	OR cc $sql_LIKE '%".$_COOKIE[$local_user.$sid]."%'
																	OR bcc $sql_LIKE '%".$_COOKIE[$local_user.$sid]."%')
																	AND send_stamp > '".$content['lastcheck']."'";
						//echo $sql;
						if($ergebnis=$db->Execute($sql))
							{ 
								if($ergebnis->RecordCount())
								{
									$newmail=1;		
									
									while ($mails=$ergebnis->FetchRow())
									{
										if(strlen($mails['subject'])>30) $sub=substr($mails['subject'],0,30).'...';
										 	else $sub=$mails['subject'];
										$buf="t=".$mails['send_stamp']."&r=0&f=".$mails['sender']."&s=$sub&d=".$mails['send_dt']."&z=".strlen($mails['body'])."\r\n";
										if($content['inbox']=='') $content['inbox']=$buf;
											else  $content[inbox].="_".$buf;
									}
									
									$dbtable='care_mail_private_users';
									
									$sql="UPDATE $dbtable SET inbox='".$content['inbox']."', lastcheck ='".date('Y-m-d H:i:s')."' WHERE email='".$_COOKIE[$local_user.$sid]. "'";
							        $db->BeginTrans();
						            $ok=$db->Execute($sql);
						            if($ok) {
									    $db->CommitTrans();
									} else { 
									    $db->RollbackTrans();
                                        echo "$LDDbNoUpdate<br>$sql";
									} 
								}
							}else { echo "$LDDbNoRead<br>$sql"; } 
				  		 } // end of if folder == inbox
					}
					else
					{
						// if last check data not available 
						$userok=0;
					}
				}else {echo "$db_sqlquery_fail<p> $sql <p> $LDDbNoRead";};
				
				// get the number of filed mails in every folder
				$dbtable='care_mail_private_users';
				
				if($folder!='inbox') 
				 {
                   $inbnum=getMailNum('inbox',$_COOKIE[$local_user.$sid]);
                }
				else 
				{ 
				   $newmails=0; $newmails=substr_count($content[inbox],'r=0');
				 }
				
				if($folder!='sent') 
				 {
	                   $sentnum=getMailNum('sent',$_COOKIE[$local_user.$sid]);
			     }
				if($folder!='drafts') 
				 {
	                   $drafnum=getMailNum('drafts',$_COOKIE[$local_user.$sid]);
				}
				if($folder!='trash') 
				 {
	                   $trasnum=getMailNum('trash',$_COOKIE[$local_user.$sid]);
				}
				break;
			}// end of case listmail
			
		} // end of switch mode

	if(($mode=='sendmail')||($mode=='compose'))
			{
				// set dbtable to users
				$dbtable='care_mail_private_users';
				
				$sql="SELECT addr_quick FROM $dbtable WHERE  email='".$_COOKIE[$local_user.$sid]. "'";

					if($ergebnis=$db->Execute($sql))
					{
						if($ergebnis->RecordCount())
						{
							$content=$ergebnis->FetchRow();
							$qa=explode('; ',trim($content['addr_quick']));
							//foreach($qa as $v) echo $v;
						}
					}else { echo "$LDDbNoRead<br>$sql"; } 
			} // end of if mode sendmail or compose
	 if($reply)
	 {
	 	$dbtable='care_mail_private';
		
		if($reply<2)   $sql='SELECT subject, body '; else $sql='SELECT * ';

		$sql.="FROM $dbtable WHERE  recipient='$recipient'
																AND sender='$sender'
																AND reply2='$reply2'
																AND send_dt='$send_dt'
																AND send_stamp='$send_stamp'";
																
				if($ergebnis=$db->Execute($sql))
				{ 
					if($ergebnis->RecordCount())
					{
						$content=$ergebnis->FetchRow();
						
						$subject=$content['subject'];
						
						switch($reply)
						{
							case 1:	if($reply2) $recipient=$reply2; else $recipient=$sender;
										$body_txt="\r\n\r\n\r\n\r\n\r\n\r\n$sender schrieb: am: $send_dt Uhr\r\n****\r\n".$content['body'];
										break;
    						case 2: $recipient=$content['recipient'];
										$ack=$content['ask4ack'];
										$cc=$content['cc'];
										$bcc=$content['bcc'];
										$subject=$content['subject'];
										$body_txt=$content['body'];
										break;
							case 3:	$recipient=''; $subject=$content['subject']; 
$body_txt="Forward>>
Original Nachricht:
An: $content[recipient]
Von: $content[sender]";
if($content[cc]) $body_txt.="
CC: $content[cc]";
if($content[bcc]) $body_txt.="
BCC: $content[bcc]";

$body_txt.="

$content[body]";
										break;
						}
					}
				}else { echo "$LDDbNoRead<br>$sql"; } 
				//echo $sql;
	  } // end of if reply
	}
  		else { echo "$LDDbNoLink<br>$sql"; } 
} // end of if mode!=""

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common');
 
 # Prepare title
 $sTemp = "$LDIntraEmail - ";

	if($mode=='compose'){
		$sTemp.=$LDComposeMail;
	}else{
		switch($folder){
			case 'inbox':  $sTemp.=$LDInbox; break;
			case 'sent':   $sTemp.=$LDSent; break;
			case 'drafts': $sTemp.=$LDDrafts; break;
			case 'trash':  $sTemp.=$LDRecycle; break;
			default:
		}
	}

# Title in toolbar
 $smarty->assign('sToolbarTitle',$sTemp);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('intramail.php','mail','$mode','$folder','$sendok')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('title',$sTemp);
 
 # Set body onLoad javascript
 if($mode=='compose') $smarty->assign('sOnLoadJs','onLoad="document.mailform.recipient.focus()"');

# Collect extra javascript code

ob_start();

?>

<script language="javascript" >
<!-- 
var feld="recipient";

<?php
if($mode=='listmail')
echo '
function chkDelete(d,m)
{
 	for (i=0;i<m;i++){
							if(eval("d.del"+i+".checked"))
								if(confirm("'.$LDConfirmDelete.'")) return true;
								else {
											for (i=0;i<m;i++) if(eval("d.del"+i+".checked")) eval("d.del"+i+".checked=false");
											d.sel_all.checked=false;
											break;
										}
							}
	return false;		
}

function selectAll(s,m)
{
	if(s.checked) v="true"; else v="false";
	d=document.listform;
	for(i=0;i<m;i++) eval("d.del"+i+".checked="+v);
}
';
?>
<?php if(($mode=='compose')||($mode=='sendmail')) : ?>

function save2draft()
{
	d=document.mailform;
	d.folder.value="drafts";
	if(d.subject.value=="") d.subject.value="<?php echo $LDSubject ?>:";
	d.submit();
}

function chkCompose(d)
{
	if((d.recipient.value=="")&&(d.folder.value!="drafts"))
	{
		alert("<?php echo $LDAlertNoRecipient ?>");
		d.recipient.focus();
		return false;
	}
	if((d.subject.value=="")||(d.subject.value=="Betreff:"))
	{
		if(confirm("<?php echo $LDAlertNoSubject ?>")) return true;
		d.subject.focus();
		return false;
	}
	if((d.body_txt.value==""))
	{
		alert("<?php echo $LDAlertNoText ?>");
		d.body_txt.focus();
		return false;
	}

}
	function useadd(a)
	{
		if (feld=="subject") 
		{	document.mailform.subject.focus();
			return;
		}
		if(eval("document.mailform."+feld+".value==''")) eval("document.mailform."+feld+".value=a");
			else eval("document.mailform."+feld+".value=document.mailform."+feld+".value + '; '+a");
		eval("document.mailform."+feld+".focus()");
	}
	
function showAll()
{
	url="intra-email-showaddr.php?sid=<?php echo "$sid&lang=$lang&mode=$mode&folder=$folder&l2h=$l2h" ?>";
	//window.location.href=url;
	addrwin=window.open(url,"addrwin","width=600,height=500,menubar=no,resizable=yes,scrollbars=yes");
}
function chgQuickAddr()
{
	url="intra-email-chgQaddr.php?sid=<?php echo "$sid&lang=$lang&eadd=".$_COOKIE[$local_user.$sid] ?>";
	addrwin=window.open(url,"addrwin","width=600,height=500,menubar=no,resizable=yes,scrollbars=yes");
}
<?php endif; ?>
// -->
</script> 

<?php

$sTemp = ob_get_contents();
ob_end_clean();

$smarty->append('JavaScript',$sTemp);

# Start buffering page output

ob_start();

/**
* Top horizontal nav bar
*/
 echo '
  &nbsp; <b>';
  if($mode!='listmail') echo '<a href="intra-email.php'.URL_APPEND.'&mode=listmail">'.$LDInbox.'</a> | ';
  	else echo $LDInbox.' | ';
  if($mode!='compose') echo '<a href="intra-email.php'.URL_APPEND.'&mode=compose">'.$LDNewEmail.'</a> | ';
  	else echo $LDNewEmail.' | ';
	echo '<a href="intra-email-addrbook.php'.URL_APPEND.'&mode='.$mode.'&folder='.$folder.'">'.$LDAddrBook.'</a> | 
	<a href="javascript:gethelp(\'intramail.php\',\'mail\',\''.$mode.'\',\''.$folder.'\',\''.$sendok.'\')">'.$LDHelp.'</a>| 
	<a href="intra-email-pass.php'.URL_APPEND.'">'.$LDLogout.'</a></b>
  <hr color=#000080>
   &nbsp; <FONT  color="#800000">'.$_COOKIE[$local_user.$sid].'<br>
';
/*	echo '<a href="intra-email-addrbook.php'.URL_APPEND.'&mode='.$mode.'&folder='.$folder.'">'.$LDAddrBook.'</a> | 
	<a href="intra-email-options.php'.URL_APPEND.'">'.$LDOptions.'</a> | 
	<a href="javascript:gethelp(\'intramail.php\',\'mail\',\''.$mode.'\',\''.$folder.'\',\''.$sendok.'\')">'.$LDHelp.'</a>| 
	<a href="intra-email-pass.php'.URL_APPEND.'">'.$LDLogout.'</a></b>
  <hr color=#000080>
   &nbsp; <FONT  color="#800000">'.$_COOKIE[$local_user.$sid].'</font><br>
';
*//**
* Compose routine
*/
if(($mode=='compose')||($mode=='sendmail'))
{
echo '<ul><form name="mailform" action="'.$thisfile.'" method="post" onSubmit="return chkCompose(this)">';
	if(($mode=='sendmail')&&($sendok)) 
	{

		echo '<img '.createMascot($root_path,'mascot1_r.gif','0','bottom').'> <font class="prompt">';
		if($folder=='drafts') echo $LDEmail2Drafts;
		 else echo $LDEmailSent;
		 echo '</font>';
	}
echo '
  
<table border=0 cellspacing=1 cellpadding=3 width="80%" height="80%">
    <tr>
      <td bgcolor="#f3f3f3" align=right><FONT face="Verdana,Helvetica,Arial" size=2 color="#000080">'.$LDRecipient.':</td>
      <td   bgcolor="#f3f3f3"><FONT face="Verdana,Helvetica,Arial" size=2 >';
	  if($sendok) echo $recipient; else echo '<input type="text" name="recipient" size=40 maxlength=40 value="'.$recipient.'" onFocus="feld=\'recipient\'">';
	  echo '
          </td>
      <td   rowspan=6 bgcolor="#f3f3f3" valign=top>';
	  if(!$sendok) 
	  {
	  	echo '
	  			<FONT face="Verdana,Helvetica,Arial" size=2 color="#000080">
	  							'.$LDQuickAddr.':</font><FONT face="Verdana,Helvetica,Arial" size=2><p>';
						for($i=0;$i<sizeof($qa);$i++)
						{	
								echo '
	  							 <a href="javascript:useadd(\''.$qa[$i].'\')" title="'.$LDInsertAddr.'" ><img '.createComIcon($root_path,'arrow-blu.gif','0','middle').'> '.$qa[$i].'</a><br>';
						}
		echo '
                        <p><input type="button" value="'.$LDShowAll.'" onClick="showAll()">
                            <input type="button" value="'.$LDChange.'" onClick="chgQuickAddr()">
                            <br>';
		}
	echo '
          </td>
    </tr>
    <tr>
      <td bgcolor="#f3f3f3""&nbsp;</td>
      <td   bgcolor="#f3f3f3">';
	  if(!$sendok)
	  {
	  	echo '
	  	<input type="checkbox" name="ack" value="1" ';
 		if($ack) echo "checked"; 
 		echo '><FONT face="Verdana,Helvetica,Arial" size=1>'.$LDAskAck;
 		}
	echo '
          </td>
    </tr>
    <tr>
      <td bgcolor="#f3f3f3" align=right><FONT face="Verdana,Helvetica,Arial" size=2 color="#000080">'.$LDCC.' (CC)</td>
      <td  bgcolor="#f3f3f3">';
	  if($sendok) echo '<FONT face="Verdana,Helvetica,Arial" size=2 >'.$cc;
	  	else echo '<input type="text" name="cc" size=40 maxlength=40 value="'.$cc.'" onFocus="feld=\'cc\'">';
	echo '
	</td>
    </tr>
    <tr>
      <td bgcolor="#f3f3f3" align=right><FONT face="Verdana,Helvetica,Arial" size=2 color="#000080">'.$LDBCC.' <a href="#" title="'.$LDBCCTxt.'"><font color="#0000ff"><u>(BCC)</u></font></a></td>
      <td  bgcolor="#f3f3f3">';
	   if($sendok) echo '<FONT face="Verdana,Helvetica,Arial" size=2 >'.$bcc;
	  	else echo '<input type="text" name="bcc" size=40 maxlength=40 value="'.$bcc.'" onFocus="feld=\'bcc\'">';
	echo '
	</td>
    </tr>
    <tr>
      <td bgcolor="#f3f3f3" align=right><FONT face="Verdana,Helvetica,Arial" size=2 color="#000080">'.$LDSubject.':</td>
      <td  bgcolor="#f3f3f3">';
	  if($sendok) echo '<FONT face="Verdana,Helvetica,Arial" size=2 >'.$subject;
	  	else echo '<input type="text" name="subject" size=40 maxlength=150 value="'.$subject.'"  onFocus="feld=\'subject\'">';
	echo '
	</td>
    </tr>';
 /*   <tr>
      <td bgcolor="#f3f3f3" align=right><FONT face="Verdana,Helvetica,Arial" size=2 color="#000080">Anhang:</td>
      <td  bgcolor="#f3f3f3"><input type="button" name="attach"  value="Einf�gen/Aktualisieren" ></td>
    </tr>
*/
 		echo'
 	   <tr>
      <td colspan=3 bgcolor="#f3f3f3">';
	  if(!$sendok)
	  {
			echo '
	       <input type="submit" value="'.$LDSend.'">';
			if($folder!="drafts") echo '
 			<input type="button" value="'.$LDSave2Draft.'"  onClick=save2draft()>';
 			echo '
 	 			<input type="reset" value="'.$LDReset.'" align=right onClick=document.mailform.recipient.focus()>      
			   <br><textarea name="body_txt" cols=77 rows=14 wrap="physical">'.$body_txt.'</textarea><br>
         		<input type="submit" value="'.$LDSend.'">
			 ';
			if($folder!="drafts") echo '
 			<input type="button" value="'.$LDSave2Draft.'"  onClick=save2draft()>';
			/*echo ' 
		     <input type="reset" value="'.$LDReset.'"  onClick=document.mailform.recipient.focus()>';*/
	}
	else echo '<FONT face="Verdana,Helvetica,Arial" size=2 >'.nl2br($body_txt);
	echo '
	    </td>
    </tr>

  </table>
 	 <input type="hidden" name="sid" value="'.$sid.'">
 	 <input type="hidden" name="lang" value="'.$lang.'">
    <input type="hidden" name="mode" value="sendmail">
	<input type="hidden" name="folder" value="sent">
   </form>
  </ul>
  ';
}
//******************************************* list mail *******************************
 if($mode=='listmail')
 { 	// prepare inbox for display
	$arrlist=explode('_',$content[$folder]);
	if(!$l2h) rsort($arrlist); else sort($arrlist); 
	reset($arrlist);
	$maxrow=sizeof($arrlist);
	if(($maxrow==1)&&($arrlist[0]=='')) $maxrow=0;
	
	/* Load common icons */
	$img_closemail=createComIcon($root_path,'c-mail.gif','0');
	$img_openmail=createComIcon($root_path,'o-mail.gif','0');
	$img_closefolder=createComIcon($root_path,'cf.gif','0');
	$img_openfolder=createComIcon($root_path,'of.gif','0');
	$img_uparrow=createComIcon($root_path,'arw_up.gif','0');
	$img_dwnarrow=createComIcon($root_path,'arw_down.gif','0');
	
	echo'
  <table border=0>
    <tr>
      <td valign=top><FONT color="#0000f0"><nobr>
	  		';
/**
*  Left nav bar for mailboxes
*/
	if($folder=='inbox')
	echo '<img '.$img_openfolder.'> <b>'.$LDInbox.' </b>';
		else echo '<a href="'.$thisfile.URL_APPEND.'&mode=listmail&l2h='.$l2h.'"><img '.$img_closefolder.'> '.$LDInbox.'</a>';
	echo '<font size=1 face=verdana,arial color="#0"> (';
	if($folder=='inbox') echo $maxrow; else echo $inbnum; 
		echo ')</font>';
		
	echo '<br>';
	if($folder=='sent') 
	echo '<img '.$img_openfolder.'> <b>'.$LDSent.'</b>';
		else echo '<a href="'.$thisfile.URL_APPEND.'&mode=listmail&l2h='.$l2h.'&folder=sent"><img '.$img_closefolder.'> '.$LDSent.'</a>';
	echo '<font size=1 face=verdana,arial color="#0"> (';
	if($folder=='sent') echo $maxrow; else echo $sentnum; 
		echo ')</font>';
		
	echo '<br>';
	if($folder=='drafts') echo '<img '.$img_openfolder.'> <b>'.$LDDrafts.'</b>';
		else echo '<a href="'.$thisfile.URL_APPEND.'&mode=listmail&l2h='.$l2h.'&folder=drafts"><img '.$img_closefolder.'> '.$LDDrafts.'</a>';
	echo '<font size=1 face=verdana,arial color="#0"> (';
	if($folder=='drafts') echo $maxrow; else echo $drafnum; 
		echo ')</font>';
		
	echo '<br>';
	if($folder=='trash') echo '<img '.$img_openfolder.'> <b>'.$LDRecycle.'</b>';
		else echo '<a href="'.$thisfile.URL_APPEND.'&mode=listmail&l2h='.$l2h.'&folder=trash"><img '.$img_closefolder.'> '.$LDRecycle.'</a>';
	echo '<font size=1 face=verdana,arial color="#0"> (';
	if($folder=='trash') echo $maxrow; else echo $trasnum; 
		echo ')</font>';
/**
* End of left nav bar for mailboxes
*/
	echo '<br>
	</td>
      <td valign=top><img src="'.$root_path.'gui/img/common/default/pixel.gif" border=0 width=10 height=1>			
	</td>
      <td valign=top><FONT face="Verdana,Helvetica,Arial" size=2>		';
	  
if($maxrow)
{
	echo '<FONT face="Verdana,Helvetica,Arial" size=5 color="#0000f0"><b>';
	switch($folder)
	{
		case 'inbox': echo "$LDInbox</b><br><img ".$img_closemail."><font size=1 color=#0> ".str_replace('~nr~',$newmails,$LDEmailCount)."</font>"; break;
		case 'sent': echo $LDSent; break;
		case 'drafts': echo $LDDrafts; break;
		case 'trash': echo $LDRecycle; break;
	}
	echo '</font>
		<form name="listform" action="intra-email-delete.php" method="post" onSubmit="return chkDelete(this,'.sizeof($arrlist).')">
		<input type="submit" value="'.$LDDelete.'"> &nbsp;  &nbsp; 
		<br>	<table border=0 cellspacing=0 cellpadding=0>
    <tr ><td colspan=6 height=1><img src="'.$root_path.'gui/img/common/default/pixel.gif" border=0 height=4 width=1></td></tr>
	 <tr bgcolor="#0060ae">
       <td>&nbsp;</td>
       <td>	<input type="checkbox" name="sel_all" value="1" onClick="selectAll(this,'.$maxrow.')"><br>
           </td>
       <td><FONT face="Verdana,Helvetica,Arial" size=2 color="#ffffff">&nbsp;&nbsp;<b>';
	if($folder=='inbox') echo "$LDFrom:"; else echo "$LDTo:/$LDFrom:";
	echo '
		</b></td>
       <td><FONT face="Verdana,Helvetica,Arial" size=2 color="#ffffff">&nbsp;&nbsp;<b>'.$LDSubject.':</b></td>
       <td><FONT face="Verdana,Helvetica,Arial" size=2 color="#ffffff">&nbsp;';
	   if($l2h) echo '<a href="'.$thisfile.URL_APPEND.'&l2h=0&mode=listmail&folder='.$folder.'" title="'.$LDSortDate.'"><img '.$img_uparrow; else echo '<a href="'.$thisfile.URL_APPEND.'&l2h=1&mode=listmail&folder='.$folder.'" title="'.$LDSortDate.'"><img '.$img_dwnarrow;
	   echo '
	   width=12 height=20 border=0 align=absmiddle alt="'.$LDSortDate.'"> <font color="#ffffff"><b>'.$LDDate.' '.$LDTime.':</b></font></a></td>
       <td><FONT face="Verdana,Helvetica,Arial" size=2 color="#ffffff">&nbsp;&nbsp;<b>'.$LDSize.':</b>&nbsp;</td>
	        </tr>';
			
	/* Create the mail list */
			
	for($i=0;$i<sizeof($arrlist);$i++)
	   {
	    parse_str(trim($arrlist[$i]),$minfo);
		$buf="intra-email-read.php?sid=$sid&lang=$lang&ua=$ck_intra_email_user&s_stamp=$minfo[t]&read=$minfo[r]&from=$minfo[f]&subj=".strtr($minfo[s]," ","+")."&date=".strtr($minfo[d]," ","+")."&size=$minfo[z]&l2h=$l2h&folder=$folder";
     	if($minfo[r]) {echo '<tr bgcolor="#ffffff">';} else {echo ' <tr bgcolor="#ffeeee">';}
		echo '<td>&nbsp;';
		if($minfo[r]) echo '<a href="'.$buf.'"><img '.$img_openmail.' alt="'.$LDReadEmail.'"><br></a>';
       		else echo '<img '.$img_closemail.' alt="'.$LDReadEmail.'"><br>';
		$delbuf="t=$minfo[t]&r=$minfo[r]&f=$minfo[f]&s=$minfo[s]&d=$minfo[d]&z=$minfo[z]";
     	echo '
       		</td>
			<td>	<input type="checkbox" name="del'.$i.'" value="'.strtr($delbuf," ","+").'"><br>
           	</td>
       		<td><FONT face="Verdana,Helvetica,Arial" size=1>&nbsp;&nbsp;<a href="'.$buf.'" title="'.$LDReadEmail.'">'.$minfo['f'].'</a></td>
       		<td><FONT face="Verdana,Helvetica,Arial" size=1>&nbsp;&nbsp;<a href="'.$buf.'" title="'.$LDReadEmail.'">'.$minfo['s'].'</a></td>
       		<td><FONT face="Verdana,Helvetica,Arial" size=1>&nbsp;&nbsp;<a href="'.$buf.'" title="'.$LDReadEmail.'">'.formatDate2Local($minfo['d'],$date_format).' '.convertTimeToLocal(formatDate2Local($minfo['d'],$date_format,0,1)).'</a></td>
       		<td align=right><FONT face="Verdana,Helvetica,Arial" size=1>&nbsp;&nbsp;<a href="'.$buf.'" title="'.$LDReadEmail.'">'.$minfo['z'].'&nbsp;</a></td>
	    	</tr>
			<tr ><td bgcolor="#66aace" colspan=6 height=1><img src="'.$root_path.'gui/img/common/default/pixel.gif" border=0 height=1 width=1></td></tr>';
		}
	echo '
	<tr ><td colspan=6 height=1><img src="'.$root_path.'gui/img/common/default/pixel.gif" border=0 height=4 width=1></td></tr>
	</table>
	<input type="hidden" name="mode" value="listmail">
	<input type="hidden" name="maxrow" value="'.$maxrow.'">
	<input type="hidden" name="sid" value="'.$sid.'">
 	<input type="hidden" name="lang" value="'.$lang.'">
 	<input type="hidden" name="l2h" value="'.$l2h.'">
 	<input type="hidden" name="folder" value="'.$folder.'">
  <input type="submit" value="'.$LDDelete.'">
	</form>	
	';
} // end of if maxrow
else 
{
	echo '<img '.createMascot($root_path,'mascot1_r.gif','0','middle').'>
			<FONT class="prompt">';
	switch($folder)
	{
		case 'inbox': $fbuf=$LDInbox; break;
		case 'sent': $fbuf=$LDSent; break;
		case 'drafts': $fbuf=$LDDrafts; break;
		case 'trash': $fbuf=$LDRecycle; break;
	}
	echo str_replace('~tagword~',$fbuf,$LDFolderEmpty).'</font>';
}
   echo '  </td>
    </tr>
  </table>
  
  ';
}elseif($mode==''){
	echo'<center>
	<img '.createMascot($root_path,'mascot1_r.gif','0','middle').'> 
	<FONT face="Verdana,Helvetica,Arial" size=3 color="#800000">
	'.$LDWelcome.' '.$usr.'</font><p>
	<FONT face="Verdana,Helvetica,Arial" size=2 > 
	<a href="'.$thisfile.URL_APPEND.'&mode=listmail">'.$LDNoteIntra.'</a>
	</center>';
}


 $sTemp = ob_get_contents();
 ob_end_clean();

 # Assign to main template object
	$smarty->assign('sMainFrameBlockData',$sTemp);

 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');

?>
