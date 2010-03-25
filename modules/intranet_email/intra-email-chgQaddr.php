<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
/**
* CARE 2X Integrated Hospital Information System beta 1.0.09 - 2003-11-25
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','intramail.php');
$local_user='ck_intra_email_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');

require_once($root_path.'include/core/inc_config_color.php'); // load color preferences

$thisfile=basename(__FILE__);

//init db parameters
$dbtable='care_mail_private_users';

$linecount=0;
if(!isset($mode)) $mode='';

if(!isset($db) || !$db) include_once($root_path.'include/core/inc_db_makelink.php');
if($dblink_ok) {	
    $sql='SELECT addr_book, lastcheck FROM '.$dbtable.' WHERE  email="'.addslashes($eadd).'"';
    if($ergebnis=$db->Execute($sql)) { 
	    if($ergebnis->RecordCount()) {
            $content=$ergebnis->FetchRow();
        } //end of if rows

    } else { echo "$LDDbNoRead<br>$sql"; } 
	
	if($mode=='saveQadd'){
        $buf='';
        for($i=0;$i<5;$i++) {
            $abuf="qadres$i";//echo "$abuf<br>".$$abuf."<br>";
            if($$abuf=='') continue;
			if($buf=='') $buf=$$abuf;
				else $buf.="; ".$$abuf; //echo "$buf<br>".$$abuf."<br>";
		}
				$sql='UPDATE '.$dbtable.' SET addr_quick="'.$buf.'", lastcheck="'.$content['lastcheck'].'" WHERE  email="'.addslashes($eadd).'"';
			
			$db->BeginTrans();
			$ok=$db->Execute($sql);
			if($ok&&$db->CommitTrans()) { 				
			    $saveok=1;
			} else { 
			    $db->RollbackTrans();
			    echo "$LDDbNoUpdate<br>$sql"; 
			} 
    }
		
	$sql='SELECT addr_quick FROM '.$dbtable.' WHERE  email="'.addslashes($eadd).'"';
	if($ergebnis=$db->Execute($sql)) { 
		if($ergebnis->RecordCount()) {
            $result=$ergebnis->FetchRow();
		} //end of if rows
	}else { echo "$LDDbNoRead<br>$sql"; } 
} else { echo "$LDDbNoLink<br>$sql"; } 


?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE><?php echo "$LDIntraEmail $LDQuickAddr"; ?></TITLE>

 <script language="javascript" >
<!-- 
var chgTag=false;
<?php if($saveok) echo "var saveTag=true;"; 
else echo "var saveTag=false;"; 
?>

function chkform(d)
{
 	if(!chgTag) return false;
	return true;		
}

function selectAll(s,m)
{
	if(s.checked) v="true"; else v="false";
	d=document.addrlist;
	for(i=0;i<m;i++) eval("d.del"+i+".checked="+v);
}

function enterQadd()
{
	d=document.qaselect;
	s=d.quick.length;
	if((s==5)||(d.adrs.selectedIndex==-1)) 
	{	d.adrs.selectedIndex=-1; return;}
	idx=d.adrs.selectedIndex;
	var opt= new Option(d.adrs.options[idx].text,d.adrs.options[idx].text);
	d.quick.options[d.quick.length]=opt;
	eval("d.qadres"+s+".value='"+d.adrs.options[idx].text+"'");
	d.adrs.selectedIndex=-1;
	chgTag=true;
}
function delQadd()
{
	d=document.qaselect;
	if(d.quick.selectedIndex==-1) return false;
	idx=d.quick.selectedIndex;
	d.quick.options[idx]=null;
	eval("d.qadres"+idx+".value=''");
	chgTag=true;
}

function closeit()
{
if(saveTag) window.opener.location.reload();
window.close();
}
// -->
</script> 

<?php 
require($root_path.'include/core/inc_js_gethelp.php');
require($root_path.'include/core/inc_css_a_hilitebu.php');
?></HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 onLoad="if (window.focus) window.focus()" 
<?php 
 if (!$cfg['dhtml']){ echo ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>
 
<?php if($mode=="saveQadd") : ?>
<script language=javascript>

</script>
<?php endif;?>

<?php //foreach($argv as $v) echo "$v "; ?>
<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>"  height="30">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG>&nbsp;<?php echo "$LDIntraEmail $LDQuickAddr"; ?></STRONG></FONT></td>
</tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top >

<FONT face="Verdana,Helvetica,Arial" size=2>

<FONT face="Verdana,Helvetica,Arial" size=2 color=#800000><b><?php echo $eadd; ?></b>
<p><br>

<form name=qaselect onSubmit="return chkform(this)">
<table border=0>
  <tr>
  <td align=center valign=top><FONT face="Verdana,Helvetica,Arial" size=2 color=#800000>
  		<b><?php echo $LDAddrBook ?></b></td><td></td>
  <td align=center valign=top><FONT face="Verdana,Helvetica,Arial" size=2 color=#800000>
  		<b><?php echo $LDQuickAddr ?>:<br><font size=1>< <?php echo $LDMaximum; ?> 5 ></b></td><td></td>
    </tr>
	<tr><td><select name="adrs" size=5>
<?php
$a_info=explode("_",$content[addr_book]);
	for ($i=0;$i<sizeof($a_info);$i++)
	{
		parse_str($a_info[$i],$c);
		echo' <option value="'.trim($c[e]).'">'.trim($c[e]).'</option>';
	}
?>
        </select>
        
        </td>
    <td><input type="button" value="<?php echo $LDInsertAddr; ?> >>" onClick="enterQadd()">
        </td>
    <td>
<?php
echo '
	<select name="quick" size=5>';
	$c=explode("; ",trim($result[addr_quick]));
	$maxrow=sizeof($c);
	if(($maxrow==1)&&(trim($c[0])=="")) $maxrow=0;
	for ($i=0;$i<$maxrow;$i++)
	{
		echo' 
				<option value="'.trim($c[$i]).'">'.trim($c[$i]).'</option>';
	}
	echo '	
		</select>';
	for ($i=0;$i<5;$i++)
	{
		echo' 
				<input type="hidden" name="qadres'.$i.'" value="'.trim($c[$i]).'">';
	}
?>

          
        </td>
    <td><input type="button" value="<?php echo $LDDelete ?> >>" onClick="delQadd()">
        </td>
  </tr>
   <tr>
  <td ></td>
  <td></td>
  <td ><input type="hidden" name="mode" value="saveQadd">
  			<input type="hidden" name="sid" value="<?php echo $sid; ?>">
     		<input type="hidden" name="lang" value="<?php echo $lang; ?>">
     		<input type="hidden" name="eadd" value="<?php echo $eadd; ?>">
       <p>
		&nbsp;<input type="submit" value="<?php echo $LDSave; ?>"></td>
	<td></td>
    </tr>

</table>

</form>


  &nbsp; &nbsp;
   <font size=1><a href="javascript:closeit()">
   <img <?php echo createComIcon($root_path,'l_arrowgrnsm.gif','0','middle') ?>> <?php echo $LDClose; ?>
</a></font>
  
  
</FONT>
<p>
</td>
</tr>

</table>        

</FONT>


</BODY>
</HTML>
