<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require_once('./roots.php');
require_once($root_path.'include/core/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','editor.php');
$local_user='ck_cafenews_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');

$fileforward='cafenews-read.php';

$dept_nr=2; /* 2  = cafeteria */

if(($artnum)&&($mode=='save'))
{
    include($root_path.'modules/news/includes/inc_news_save.php');
}
?>
