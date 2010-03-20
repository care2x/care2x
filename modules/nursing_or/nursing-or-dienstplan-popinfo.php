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
define('LANG_FILE','doctors.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');

require_once($root_path.'include/care_api_classes/class_personell.php');
$pers_obj=new Personell;
$person=&$pers_obj->getPersonellInfo($nr);

require_once($root_path.'include/care_api_classes/class_department.php');
$dept_obj=new Department;
$dept=&$dept_obj->getPhoneInfo($dept_nr);

require_once($root_path.'include/care_api_classes/class_globalconfig.php');
$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
$glob_obj->getConfig('person_%');
/* Check whether config foto path exists, else use default path */			
$default_photo_path='fotos/registration';
$photo_filename=$person['photo_filename'];
$photo_path = (is_dir($root_path.$GLOBAL_CONFIG['person_foto_path'])) ? $GLOBAL_CONFIG['person_foto_path'] : $default_photo_path;
require_once($root_path.'include/inc_photo_filename_resolve.php');
?>
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
<TITLE><?php echo $LDInfo4Duty ?></TITLE>

<script language="javascript">

function closethis()
{
	window.opener.focus();
	window.close();
}

</script>

<STYLE type=text/css>
div.box { border: double; border-width: thin; width: 100%; border-color: black; }
</style>

</HEAD>
<BODY  background=img/winbg2.gif TEXT="#000000" LINK="#0000FF" VLINK="#800080" onLoad="if (window.focus) window.focus()"  >

<font face=verdana,arial size=5 color=maroon>
<b>
<?php
echo ucfirst($person['name_last']).', '.ucfirst($person['name_first']);
?>
</b>
<img <?php echo $img_source; ?> width=137 align="right">
</font>
<p>

<table border=0 >
<tr>
<td bgcolor=#ffffcc><img <?php echo createComIcon($root_path,'authors.gif','0','',FALSE) ?>>&nbsp;<font face=verdana,arial size=2 ><?php echo $LDContactInfo ?><br></font>
</td>
</tr>
<tr>
<td><UL><font face=verdana,arial size=2 ><b><?php echo $LDBeeper ?>:</b><font color=red> <?php echo $person['funk1']; ?><br>
<font color=navy><b><?php echo $LDPhone ?>:</b> <?php echo $person['inphone1']; ?><br></font></ul>
</td>
</tr>
<tr>
<td bgcolor=#ffffcc><img <?php echo createComIcon($root_path,'listen-sm-legend.gif','0','',FALSE) ?>>&nbsp;<font face=verdana,arial size=2 ><?php echo $LDOnCallContactInfo ?><br></font>
</td>
</tr>
<tr>
<td><UL><font face=verdana,arial size=2 ><b><?php echo $LDBeeper ?>:</b><font color=red> <?php echo $dept['funk1']; ?>
<br>
<font color=navy><b><?php echo $LDPhone ?>:</b> <?php echo $dept['inphone1']; ?><br></font></ul>
</td>
</tr>

<!-- Temporarily deactivated 
<tr>
<td bgcolor=#ffffcc><img <?php echo createComIcon($root_path,'warn.gif') ?>>&nbsp;<font face=verdana,arial size=2 ><b><?php echo $LDMoreInfo ?></b><br></font>
</td>
</tr>

<tr>
<td><font face=verdana,arial size=2 ><?php echo $pinfo["info"]; ?></font>
</td>
</tr>
 -->
</table>
<p>

<a href="javascript:closethis()"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseWindow ?>"></a>

</BODY>

</HTML>
