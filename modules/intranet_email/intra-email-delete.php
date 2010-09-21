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


if(!isset($maxrow)||(isset($maxrow)&&empty($maxrow))||!isset($folder)||(isset($folder)&&empty($folder))) { header("location:intra-email.php".URL_REDIRECT_APPEN."&mode=listmail"); exit;}
if(isset($create) && $create) {
    $del0="t=$t&r=$r&f=$f&s=$s&d=$d&z=$z";
} else {
    for($i=0;$i<$maxrow;$i++) {
		$delbuf="del$i"; 
		if(isset($$delbuf) && $$delbuf){ $delok=1;	break;}
	}

if(!isset($delok)||!$delok) { 
    header("location:intra-email.php".URL_REDIRECT_APPEND."&mode=listmail"); exit;}
}

//$db->debug=1;

require_once($root_path.'include/core/inc_config_color.php'); // load color preferences
//echo $del0;
$thisfile=basename(__FILE__);
//foreach($arg as $v) echo "$v<br>"; //init db parameters
$dbtable='care_mail_private_users';

$linecount=0;
$modetypes=array('sendmail','listmail');

							$sql="SELECT $folder, lastcheck FROM $dbtable WHERE  email='".$_COOKIE[$local_user.$sid]."'";
							if($ergebnis=$db->Execute($sql)) 
							{			
								if($ergebnis->RecordCount())
								{
									$result=$ergebnis->FetchRow();
									$inb=explode("_",trim($result[$folder]));
									for($i=0;$i<sizeof($inb);$i++)
									{
										for($n=0;$n<$maxrow;$n++)
										{
											$delbuf="del$n";
											if(!isset($$delbuf)||!$$delbuf) continue;
											$delbuf2=trim(strtr($$delbuf,"+"," "));
											//echo "$delbuf2<br>$inb[$i]<br>"; 
											if(stristr($delbuf2,trim($inb[$i])))
											{
												$trash=array_splice($inb,$i,1);
												$i--;
												break;
											}
										}
									}
									$result[$folder]=implode("_",$inb);
									$sql="UPDATE $dbtable SET $folder='".$result[$folder]."', lastcheck='".$result['lastcheck']."'
																		WHERE email='".$_COOKIE[$local_user.$sid]."'";

								    $db->BeginTrans();
								    $ok=$db->Execute($sql);
								    if($ok&&$db->CommitTrans()) { 

										// update the recyle folder 
										if($folder!='trash')
										{
											$sql="SELECT trash, lastcheck FROM $dbtable WHERE  email='".$_COOKIE[$local_user.$sid]."'";
											if($ergebnis=$db->Execute($sql)) 
											{			
												if($ergebnis->RecordCount())
												{
													$result=$ergebnis->FetchRow();
													//echo "$maxrow ";
													for($n=0;$n<$maxrow;$n++)
													{
														$delbuf="del$n";
														if(!isset($$delbuf)||!$$delbuf) continue;
														$delbuf2=trim(strtr($$delbuf,"+"," "));
														//echo $delbuf2."<br>";
														if($result['trash']=="") $result['trash']=$delbuf2."\r\n";
														else $result['trash'].="_".$delbuf2."\r\n";
													}
													$sql="UPDATE $dbtable SET trash='".$result['trash']."', lastcheck='".$result['lastcheck']."'
																		WHERE email='".$_COOKIE[$local_user.$sid]."'";
  								                   $db->BeginTrans();
								                   $ok=$db->Execute($sql);
								                   if($ok) {
												       $db->CommitTrans();
												   } else { 
												      $db->RollbackTrans();
													  echo "$LDDbNoUpdate<br>$sql";
												   } 
												}
											//echo $sql;
											} else { echo "$LDDbNoRead<br>$sql"; } 
										}
										header("location:intra-email.php?sid=$sid&lang=$lang&mode=listmail&l2h=$l2h&folder=$folder");
									}else {
									   $db->RollbackTrans();
									   echo "$LDDbNoUpdate<br>$sql"; 
									} 
								}
				}else { echo "$LDDbNoRead<br>$sql"; } 
?>
