<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
$root_path='../../';
require_once($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System beta 1.0.08 - 2003-10-05
* GNU General Public License
* Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','editor.php');
$local_user='ck_editor_user';
require_once($root_path.'include/inc_front_chain_lang.php');

$fileforward='headline-read.php';

$dept_nr=$_SESSION['sess_dept_nr'];

if(($artnum)&&($mode=='save'))
{
    include($root_path.'include/inc_news_save.php');
}

?>
