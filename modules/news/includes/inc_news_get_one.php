<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (stristr($_SERVER['SCRIPT_NAME'],'inc_news_get_one.php')) 
	die('<meta http-equiv="refresh" content="0; url=../">');

$sql='SELECT nr,title,preface,body,pic_mime,art_num, author, submit_date FROM care_news_article WHERE nr='.$nr;

    if($ergebnis=$db->Execute($sql)) {
        $news=$ergebnis->FetchRow();
    }
?>
