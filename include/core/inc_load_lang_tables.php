<?php
/* This routine includes the language tables which are listed in the array $lang_tables */
for($tc=0;$tc<sizeof($lang_tables);$tc++) {
    if(file_exists($root_path.'language/'.$lang.'/lang_'.$lang.'_'.$lang_tables[$tc]))    include($root_path.'language/'.$lang.'/lang_'.$lang.'_'.$lang_tables[$tc]);
       else include($root_path.'language/'.LANG_DEFAULT.'/lang_'.LANG_DEFAULT.'_'.$lang_tables[$tc]);
}
/*
for($tc=0;$tc<sizeof($lang_tables);$tc++) {
    if(file_exists($root_path.'language/'.$lang.'/lang_'.$lang.'_'.$lang_tables[$tc]))    include_once($root_path.'language/'.$lang.'/lang_'.$lang.'_'.$lang_tables[$tc]);
       else include_once($root_path.'language/'.LANG_DEFAULT.'/lang_'.LANG_DEFAULT.'_'.$lang_tables[$tc]);
}
*/
?>
