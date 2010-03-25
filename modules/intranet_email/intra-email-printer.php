<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','intramail.php');
$local_user='ck_intra_email_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');

$thisfile=basename(__FILE__);

$dbtable='care_mail_private';

    /* Load the date formatter */
    include_once($root_path.'include/core/inc_date_format_functions.php');
    
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
					
					if($rows=$ergebnis->RecordCount())
					{
						$content=$ergebnis->FetchRow();
						// update user to tag the file as read
					} //end of if rows
					else
					{
						$mailok=0;
					}
				}else { echo "$LDDbNoRead<br>$sql"; } 
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>

<?php 
require($root_path.'include/core/inc_js_gethelp.php');
require($root_path.'include/core/inc_css_a_hilitebu.php');
?>
</HEAD>

<BODY bgcolor="#ffffff" onLoad="if (window.focus) window.focus()">
<table border=0 cellpadding=1 cellspacing=1 bgcolor="white" width="100%">
  <tr>
    <td><pre><?php echo $LDFrom; ?></pre></td>
    <td><pre><b><?php echo $content['sender']; ?></b></pre></td>
  </tr>
  <tr>
    <td><pre><?php echo $LDReply2; ?></pre></td>
    <td><pre><b><?php echo $content['reply2']; ?></b></pre></td>
  </tr>
  <tr>
    <td><pre><?php echo $LDTo; ?></pre></td>
    <td><pre><b><?php echo $content['recipient']; ?></b></pre></td>
  </tr>
  <tr>
    <td><pre>CC</pre></td>
    <td><pre><b><?php echo $content['cc']; ?></b></pre></td>
  </tr>
  <tr>
    <td><pre>BCC</pre></td>
    <td><pre><b><?php echo $content['bcc']; ?></b></pre></td>
  </tr>
  <tr>
    <td><pre><?php echo $LDSubject; ?></pre></td>
    <td><pre><b><?php echo $content['subject']; ?></b></pre></td>
  </tr>
<!--   <tr>
    <td><pre><?php echo $LDAttach; ?></pre></td>
    <td><pre></pre></td>
  </tr>
 -->  
 <tr>
    <td><pre><?php echo $LDDate.':'.$LDTime; ?></pre></td>
    <td><pre><?php echo '<b>'.formatDate2Local($content['send_dt'],$date_format).' '.convertTimeToLocal(formatDate2Local($content['send_dt'],$date_format,0,1)).'</b>'; ?></pre></td>
  </tr>
 <tr>
    <td colspan="2">
		<hr><pre>
<?php
	//$content[body]=chunk_split($content[body],100);
	echo nl2br($content['body']);
?></pre>
<hr>
		</td>
  </tr>

</table>



<p><FONT face="verdana,Arial" size=2 >
<b>< <a href="javascript:window.print()"><?php echo $LDPrint ?></a> ></b><p>
<b>< <a href="javascript:window.close()"><?php echo $LDClose ?></a> ></b>
</FONT>


</BODY>
</HTML>
