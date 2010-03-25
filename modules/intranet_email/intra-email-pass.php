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
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/core/inc_front_chain_lang.php');
require_once('includes/inc_intramail_domains.php');

$thisfile=basename(__FILE__);
$forwardfile='intra-email.php'.URL_REDIRECT_APPEND.'&mode=listmail';
$breakfile=$root_path.'main/startframe.php'.URL_APPEND;

// reset all 2nd level lock cookies
require($root_path.'include/core/inc_2level_reset.php');

$dbtable='care_mail_private_users';

//$db->debug=1;

$linecount=0;
$onError='';
if(!isset($mode)) $mode='';
if(!isset($password)) $password='';
if(!isset($dept)) $dept='';
if(!isset($username)) $username='';

if($mode!='')
{
		if(($mode=='access')&&($password!='')&&($username!='')&&($dept!=''))
			{
				$sql="SELECT * FROM $dbtable WHERE email='$username@$dept'";
				if($ergebnis=$db->Execute($sql))
				{ 
					if($ergebnis->RecordCount())
					{
						$content=$ergebnis->FetchRow();
						if(md5($password)==$content['pw'])
						{
						    /**
						    * Init crypt to use 2nd level key and encrypt the sid.
						    * Store to cookie the "$ck_2level_sid.$sid"
							* There is no need to call another include of the inc_init_crypt.php since it is already included at the start 
							* of the script that called this script.
							*/
    						$enc_2level = new Crypt_HCEMD5($key_2level, makeRand());
							$ciphersid=$enc_2level->encodeMimeSelfRand($sid);
							setcookie(ck_2level_sid.$sid,$ciphersid);
							setcookie('ck_intra_email_user'.$sid,$content[email]);
							header("location:$forwardfile"); 
							exit;
						} else $onError=$LDErrorLogin;
					}
					else
					{
						// if last check data not available 
						$newuser=1;
					}
				}else { echo "$LDDbNoRead<br>$sql"; }
			}// end of if password...
			
		if($mode=='register')
		{
            /**
			* Check if the username is already used
			*/
			if(!isset($addr)) $addr='';
			if(!isset($pw1)) $pw1='';
			if(!isset($pw2)) $pw2='';
			if(!isset($name)) $name='';
			
			$sql="SELECT * FROM $dbtable WHERE email='$addr@$dept'";
			if($ergebnis=$db->Execute($sql))
			{ 
				if($ergebnis->RecordCount())
				{
					$addr='';
				}
				   else $nameError='';
			}
		
			if($nameError=='')
			{
			  //check the input data
			  if(($name=='')||($addr=='')||($pw1==''))
			   {
			        $regError=$LDErrorForm;
			   }
				else{
						if($pw1==$pw2)
						{
						$sql="INSERT INTO $dbtable 
										( 	user_name,
											email,
											alias,
											pw 
										)
										VALUES
										(	'$name',
											'$addr@$dept',
											'$alias',
											'".md5($pw1)."'
										)";			
/*								$sql="INSERT INTO $dbtable 
										( 	user_name,
											email,
											alias,
											pw 
										)
										VALUES
										(	'$name',
											'$addr@$dept',
											'$alias',
											'".crypt($pw1)."'
										)";			
*/							
							$db->BeginTrans();
							$ok=$db->Execute($sql);
							if($ok&&$db->CommitTrans())
							{
								setcookie('ck_intra_email_user'.$sid,$addr.'@'.$dept);
								header("location:intra-email.php".URL_REDIRECT_APPEND."&usr=$name");
								exit;
							} 
							else	 
							 { 
							     $db->RollbackTrans();
							      echo "$LDDbNoSave<br>$sql"; 
							  } 				
						}else 
							{ 
							   $regError=$LDErrorPassword;
							}
					  }
		   } // end of if($regError)
		   $newuser=1;
		}
} // end of if mode!=""

if(($mode=='access')&&(($username=='')||($password=='')))  $onError=$LDErrorIncomplete;

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common');

# Title in toolbar
 $smarty->assign('sToolbarTitle',$LDIntraEmail);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('intramail.php','pass','$newuser')");

 # href for close button
 //$smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('title',$LDIntraEmail);

 # Body onLoad javascript code
 if($onError) $smarty->assign('sOnLoadJs','onLoad="document.loginform.username.focus();document.loginform.username.select();"');
	else if(!$newuser) $smarty->assign('sOnLoadJs','onLoad="document.loginform.username.focus()"');

if($regError) $smarty->assign('sOnLoadJs','onLoad="document.regform.pw1.focus()"');
 elseif($nameError) $smarty->assign('sOnLoadJs','onLoad="document.regform.addr.focus()"');
  elseif ($mode=='register') $smarty->assign('sOnLoadJs','onLoad="document.regform.name.focus()"');

# Collect extra javascript code

$sTemp = '<script language="javascript" >
<!-- 

function pruf(d){
	pw=d.password;
	usr=d.username;
	var p=pw.value;
	var u=usr.value;
	if((u=="")||(u==" "))
	{
		usr.value="";
		usr.focus();
		return false;
	}else	if((p=="")||(p==" ")){
		pw.value="";
		pw.focus();
		return false;
	}else {
	return true;
	}
}

// -->
</script>';


$smarty->append('JavaScript',$sTemp);

# Start buffering page output

ob_start();

?>

<p><br><ul>
<?php if($onError!="") echo '
	<img '.createMascot($root_path,'mascot1_r.gif','0','bottom').'><FONT face="Verdana,Helvetica,Arial" size=2 color="#800000"> '.$onError.'</font>';
?>
  <form action="<?php echo $thisfile ?>" method="get" name="loginform" onSubmit="return pruf(this)">
  <table border=0 cellspacing=2 cellpadding=3>
    <tr bgcolor=#ffffdd>
      <td align=center colspan=2><FONT face="Verdana,Helvetica,Arial" size=3 color="#800000"><b><?php echo $LDLogin ?>:</b></td>
    </tr>
    <tr bgcolor=#ffffdd>
      <td align=right><FONT face="Verdana,Helvetica,Arial" size=2><b><?php echo $LDUrEmailAddr ?>:</b></td>
      <td><input type="text" name="username" size=20 maxlength=40 value="<?php echo  $username ?>"><FONT face="Verdana,Helvetica,Arial" size=2 color=#0000ff>@<select name="dept" size=1>
<?php 
   
     while(list($x,$v)=each($LDEmailDomains))
	 {
		 echo '
		<option value="'.$v.'"';
		if (stristr($dept,$x)) echo 'selected'; 
		echo '>'.$v.'</option>';
	}
	reset($LDEmailDomains);
?>                                                   
         </select>
		  </td>
    </tr>
    <tr bgcolor=#ffffdd>
      <td align=right><FONT face="Verdana,Helvetica,Arial" size=2><b><?php echo $LDPassword ?>:</b></td>
      <td><input type="password" name="password" size=20 maxlength=40>
          </td>
    </tr>

    <tr >
   
	 <td align="right" colspan=2><input type="image" <?php echo createLDImgSrc($root_path,'login.gif','0'); ?>>
    </td>
    
    </tr>
  </table>
  <input type="hidden" name="sid" value="<?php echo $sid ?>">
  <input type="hidden" name="lang" value="<?php echo $lang ?>">
  <input type="hidden" name="mode" value="access">
  </form> 
  
<?php if($newuser) : ?>
<HR>
<table border=0>
  <tr>
    <td><img <?php echo createMascot($root_path,'mascot1_r.gif','0','bottom') ?>></td>
    <td><FONT face="Verdana,Helvetica,Arial" size=2 color="#990000">
<?php 
if ($regError) echo $regError;
    elseif($nameError) echo $nameError;
	  else echo $LDNotRegUser; 
?>
  </td>
  </tr>
</table>
<form name=regform action="<?php echo $thisfile ?>" method=post>
<table border=0>
  <tr bgcolor=#f9f9f9>
    <td><FONT face="Verdana,Helvetica,Arial" size=2>&nbsp;<?php echo "$LDName, $LDFirstName" ?>:</td>
    <td colspan=2><FONT face="Verdana,Helvetica,Arial" size=2><input type="text" name="name" size=25 maxlength=40 value="<?php echo $name ?>">
                                                              </td>
  </tr>
  <tr bgcolor=#f9f9f9>
    <td><FONT face="Verdana,Helvetica,Arial" size=2>&nbsp;<?php echo $LDChoiceAddr ?>:<br></td>
    <td><FONT face="Verdana,Helvetica,Arial" size=2><input type="text" name="addr" size=25 maxlength=40 value="<?php echo $addr ?>"></td>
    <td><FONT face="Verdana,Helvetica,Arial" size=2 color="#800000"><b>@</b>
		<select name="dept" size=1>
<?php 
     while(list($x,$v)=each($LDEmailDomains))
	 {
		 echo '
		<option value="'.$v.'"';
		if (stristr($dept,$x)) echo "selected"; 
		echo '>'.$v.'</option>';
	}
?>
         </select>
    </td>
  </tr>
  <tr bgcolor=#f9f9f9>
    <td><FONT face="Verdana,Helvetica,Arial" size=2>&nbsp;<?php echo $LDAlias ?>:</td>
    <td colspan=2><FONT face="Verdana,Helvetica,Arial" size=2><input type="text" name="alias" size=25 maxlength=40 value="<?php echo $alias ?>" ></td>
  </tr>
  <tr bgcolor=#f9f9f9>
    <td><FONT face="Verdana,Helvetica,Arial" size=2>&nbsp;<?php echo $LDChoicePassword ?>:</td>
    <td colspan=2><FONT face="Verdana,Helvetica,Arial" size=2><input type="password" name="pw1" size=25 maxlength=40 ></td>
  </tr>
  <tr bgcolor=#f9f9f9>
    <td><FONT face="Verdana,Helvetica,Arial" size=2>&nbsp;<?php echo $LDPassword2x ?>:</td>
    <td colspan=2><input type="password" name="pw2" size=25 maxlength=40></td>
  </tr>
  <tr >
    <td>&nbsp;<!-- <input type="reset" value="<?php echo $LDReset ?>"> --></td>
    <td colspan=2 align=right><input type="image" <?php echo createLDImgSrc($root_path,'register.gif','0'); ?>></td>
  </tr>
</table>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="mode" value="register">
</form>
 

<?php endif ?>
<?php if (!$newuser)echo '
<p><br>
<a href="'.$thisfile.''.URL_APPEND.'&newuser=1">'.$LDNewReg.' <img '.createComIcon($root_path,'bul_arrowgrnsm.gif','0','bottom').'></a>
';
?>
</ul>

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