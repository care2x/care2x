<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (stristr('inc_currency_set.php',$_SERVER['SCRIPT_NAME'])) 
	die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/

if(!isset($mode)) $mode='';

if(!isset($db) || !$db) include_once($root_path.'include/core/inc_db_makelink.php');


if($dblink_ok)
{

 if(($mode=='save')&&($old_main_item!=$new_main_item))
 {
  	$new_main_currency=0;

       $sql="UPDATE care_currency SET status='main', 
       		modify_id='".$_COOKIE['ck_cafenews_user'.$sid]."',
		modify_time='".date('YmdHis')."'
		WHERE item_no=".$new_main_item;

	   $date_result= $db->Execute($sql);

	   if($db->Affected_Rows())
	  {
	  
  	      $new_main_currency=1;
      
	      $sql="UPDATE care_currency SET status='',  modify_time='".date('YmdHis')."' WHERE item_no=".$old_main_item;
	  
	      $date_result=$db->Execute($sql);
      
	  }
		 
 }  
 elseif (($mode=='delete') && $item_no)
 {
 
    $sql="DELETE FROM care_currency WHERE item_no=".$item_no;
	
	if(!$db->Execute($sql)) echo "$LDDbNoDelete<p>";
	
 } 
 
  $sql="SELECT * FROM care_currency WHERE status<>'hidden' ORDER BY short_name";
  if($ergebnis=$db->Execute($sql))
  {
     $rows=$ergebnis->RecordCount();
  } // else get default from ini file
  
} else { echo "$LDDbNoLink<br> $sql<br>"; }

?>
