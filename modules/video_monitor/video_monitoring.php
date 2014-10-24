<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');

define('LANG_FILE','specials.php');
define('NO_2LEVEL_CHK',1);

require_once($root_path.'include/core/inc_front_chain_lang.php');
$breakfile=$root_path.'main/spediens.php?sid='.$sid.'&lang='.$lang;
require($root_path.'global_conf/inc_remoteservers_conf.php');
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>

<script language="javascript">
var cam1=new Image();
var cam2=new Image();
var cam3=new Image();
var cam4=new Image();

    cam1.src="http://192.168.11.158/view/index.shtml";
	cam2.src="http://localhost/care2x/modules/video_monitor/cam_img/cam_002.jpg";
	cam3.src="http://localhost/care2x/modules/video_monitor/cam_img/cam_003.jpg";
	cam4.src="http://localhost/care2x/modules/video_monitor/cam_img/cam_004.jpg";

function show()
{
	document.images.pic1.src=cam1.src;
	document.images.pic2.src=cam2.src;
	document.images.pic3.src=cam3.src;
	document.images.pic4.src=cam4.src;	
	//setTimeout("show()",5000);
}

function changeCamera(obj, c)
{
   eval("cam" + c + ".src='<?php echo $cam_http_1 ?>" + obj.value + "';" );
   
   show();
}

</script>
</HEAD>
<BODY bgcolor="#000000" marginwidth="0" marginheight="0" topmargin="0" leftmargin="0" onLoad="setInterval('show()',3000)">
	
<form>
<table border=0>
  <tr>
    <td><iframe src ="http://prova:prova@192.168.11.158/view/index.shtml" width="800px" height="800px">
 

</td>
    <td><img src="<?php echo $cam_http_2 ?>cam_002.jpg" border=0 width=320 height=240 name="pic2"><br>
<select name="Cam2" onChange="changeCamera(this,2)">
 	<option value="cam_001.jpg"> Camera 1</option>
 	<option value="cam_002.jpg" selected> Camera 2</option>
 	<option value="cam_003.jpg"> Camera 3</option>
 	<option value="cam_004.jpg"> Camera 4</option>
 	<option value="cam_005.jpg"> Camera 5</option>
 	<option value="cam_006.jpg"> Camera 6</option>
 	<option value="cam_007.jpg"> Camera 7</option>
 	<option value="cam_008.jpg"> Camera 8</option>
 	<option value="cam_009.jpg"> Camera 9</option>
 	<option value="cam_010.jpg"> Camera 10</option>
  	<option value="cam_011.jpg"> Camera 11</option>
 	<option value="cam_012.jpg"> Camera 12</option>
 	<option value="cam_013.jpg"> Camera 13</option>
 	<option value="cam_014.jpg"> Camera 14</option>
 	<option value="cam_015.jpg"> Camera 15</option>
 	<option value="cam_016.jpg"> Camera 16</option>
 	<option value="cam_017.jpg"> Camera 17</option>
 	<option value="cam_018.jpg"> Camera 18</option>
 	<option value="cam_019.jpg"> Camera 19</option>
 	<option value="cam_020.jpg"> Camera 20</option>
</select>
</td>
  </tr>
  <tr>
    <td><img src="<?php echo $cam_http_3 ?>cam_003.jpg" border=0 width=320 height=240 name="pic3"><br>
<select name="Cam3" onChange="changeCamera(this,3)">
 	<option value="cam_001.jpg"> Camera 1</option>
 	<option value="cam_002.jpg"> Camera 2</option>
 	<option value="cam_003.jpg" selected> Camera 3</option>
 	<option value="cam_004.jpg"> Camera 4</option>
 	<option value="cam_005.jpg"> Camera 5</option>
 	<option value="cam_006.jpg"> Camera 6</option>
 	<option value="cam_007.jpg"> Camera 7</option>
 	<option value="cam_008.jpg"> Camera 8</option>
 	<option value="cam_009.jpg"> Camera 9</option>
 	<option value="cam_010.jpg"> Camera 10</option>
  	<option value="cam_011.jpg"> Camera 11</option>
 	<option value="cam_012.jpg"> Camera 12</option>
 	<option value="cam_013.jpg"> Camera 13</option>
 	<option value="cam_014.jpg"> Camera 14</option>
 	<option value="cam_015.jpg"> Camera 15</option>
 	<option value="cam_016.jpg"> Camera 16</option>
 	<option value="cam_017.jpg"> Camera 17</option>
 	<option value="cam_018.jpg"> Camera 18</option>
 	<option value="cam_019.jpg"> Camera 19</option>
 	<option value="cam_020.jpg"> Camera 20</option>
</select>
</td>
    <td><img src="<?php echo $cam_http_4 ?>cam_004.jpg" border=0 width=320 height=240 name="pic4"><br>
<select name="Cam4" onChange="changeCamera(this,4)">
 	<option value="cam_001.jpg"> Camera 1</option>
 	<option value="cam_002.jpg"> Camera 2</option>
 	<option value="cam_003.jpg"> Camera 3</option>
 	<option value="cam_004.jpg" selected> Camera 4</option>
 	<option value="cam_005.jpg"> Camera 5</option>
 	<option value="cam_006.jpg"> Camera 6</option>
 	<option value="cam_007.jpg"> Camera 7</option>
 	<option value="cam_008.jpg"> Camera 8</option>
 	<option value="cam_009.jpg"> Camera 9</option>
 	<option value="cam_010.jpg"> Camera 10</option>
 	<option value="cam_011.jpg"> Camera 11</option>
 	<option value="cam_012.jpg"> Camera 12</option>
 	<option value="cam_013.jpg"> Camera 13</option>
 	<option value="cam_014.jpg"> Camera 14</option>
 	<option value="cam_015.jpg"> Camera 15</option>
 	<option value="cam_016.jpg"> Camera 16</option>
 	<option value="cam_017.jpg"> Camera 17</option>
 	<option value="cam_018.jpg"> Camera 18</option>
 	<option value="cam_019.jpg"> Camera 19</option>
 	<option value="cam_020.jpg"> Camera 20</option>
 </select>
</td>
  </tr>
</table>
</form>

<p>
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  alt="<?php echo $LDClose ?>" align="middle"></a>


</BODY>
</HTML>
