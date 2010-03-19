<?php
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.02 - 30.07.2002
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/

/* Simple hit counter. Counts all including revisits */

if(!isset($HTTP_REFERER)) $HTTP_REFERER='';
if(!isset($HTTP_USER_AGENT)) $HTTP_USER_AGENT='';
if(!isset($REMOTE_ADDR)) $REMOTE_ADDR='';

$datum=date('Y_m_d');
$fname=$root_path."counter/hits/$datum.txt";
$fname2=$root_path.'counter/hitcount.txt';
$count=get_meta_tags($fname2);

if($fp=fopen($fname,'a')) {
    if($fp2=fopen($fname2,'w+')); {
        fputs($fp,"date=".date('Y-m-d')."&tstamp=".date('H:i:s')."&ip=$REMOTE_ADDR&port=$REMOTE_PORT&agent=$HTTP_USER_AGENT&ref=$HTTP_REFERER\r\n");
        fclose($fp);
        if(($count['hit']==NULL)||($count['hit']==0)) $count['hit']=1; 
            else $count['hit']=$count['hit']+1;
        fputs($fp2,'<meta name="hit" content="'.$count['hit'].'">');
        fclose($fp2);
    }
}
?>
