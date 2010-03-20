<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','nursing.php');
$local_user='ck_pflege_user';
require_once($root_path.'include/inc_front_chain_lang.php');
?>
<?php html_rtl($lang); ?>

<?php echo setCharSet(); ?>
<title></title>

</head><center>
<body>
<p>
&nbsp;
<p>
&nbsp;
<p>
<!-- <img src="<?php echo "../imgcreator/nobellist.php?sid=$sid&lang=$lang&station=$station&c=$c"; ?>" border=0  alt="<?php echo $LDClkHere ?>">
 -->
 <table border=0>
   <tr>
     <td><img <?php echo createMascot($root_path,'mascot1_r.gif') ?>></td>
     <td><font size=3 face="verdana,arial" color="#990000"><b>
	 <?php 
	 echo $LDNoOccList.' '.$LDFromWard.'<font color="#0000ff">'.strtoupper($station).'</font> '.$LDWithinLast.' '.($c-1).$LDDays.' '.$LDAvailable;
     ?></b>
	 </font>
	  </td>
   </tr>
 </table>
 
 <p>
<a href="nursing-station.php?<?php echo "sid=$sid&lang=$lang&edit=$edit&list=1&mode=fresh&station=$station"; ?>">
<?php echo $LDClkHere.' '.$LDToCreateNewList ?>...</a>
</center>
</body>
</html>
