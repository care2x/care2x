<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi("inc_news_get.php",$PHP_SELF)) 
	die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/

$dbtable='care_news_article';
$today=date('Y-m-d');

/* Establish db connection */
if(!isset($db) || !$db) include_once($root_path.'include/inc_db_makelink.php');

if($dblink_ok)
{
    
		$str_sql="SELECT nr,title,preface,body,pic_mime FROM ".$dbtable." 
					WHERE dept_nr=".$dept_nr;
						
		$stat_pending=" AND status<>'pending'";
		$order_by_desc=" ORDER BY create_time DESC";

		for($i=1;$i<=$news_num_stop;$i++) 
		{
		  $sql=$str_sql." AND art_num='".$i."'";
		  $publish_when=" AND publish_date='".$today."'";
          if(defined('MODERATE_NEWS') && (MODERATE_NEWS==1))
		  {
		 	 $sql.=$publish_when.$stat_pending;
          }
		  else
		  {
		     $sql.=$publish_when;
		  }
		  
		  $sql.=$order_by_desc;
					
			if($ergebnis=$db->Execute($sql))
       		{
				if($rows=$ergebnis->RecordCount())
				{
					$art[$i]=$ergebnis->FetchRow();
				}
				else // if no file found get the last entry
				{
		          
				  $sql=$str_sql." AND art_num='".$i."'";
				  $publish_when=" AND publish_date<'".$today."'";
                  
				  if(defined('MODERATE_NEWS') && (MODERATE_NEWS==1))
		          {
					$sql.=$publish_when.$stat_pending;
                  }
		          else
		          {
					$sql.=$publish_when;
				  }									
				
				  $sql.=$order_by_desc;
				  			
				   if($ergebnis=$db->Execute($sql))
       			   {
					  if($rows=$ergebnis->RecordCount())
					  {
						$art[$i]=$ergebnis->FetchRow();
					  }
				   }
				}
			}
		}
  } else { echo "$LDDbNoLink $sql<br>"; }

?>
