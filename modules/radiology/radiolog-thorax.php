

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE>RAdiologie</TITLE>

</HEAD>

<BODY bgcolor=black onLoad="if (window.focus) window.focus()">

<center ><img src="http://192.168.0.2/radiology/xrayfilms/thorax.jpg"><br>
<FONT    SIZE=4  FACE="Arial" color=white>

Thorax aufnahme: Rechtsseitiger Pneumothorax. Die rechte Lunge ist zu einem schattendichten Gebilde in Hilusnähe
kollabiert.
</FONT>
<p>
<form>
<input type="button" value="Schliessen" onClick="window.top.location.replace('radiolog-xray-javastart.php?sid=<?php echo $sid ?>')">

</form>
</center>
<p>






</BODY>
</HTML>
